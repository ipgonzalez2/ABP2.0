<?php


require_once(__DIR__."/../core/PDOConnection.php");


class UserMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	public function save($user) {
		$stmt = $this->db->prepare("INSERT INTO usuario values (?,?,?,?,?,?,?,?,?)");
		$stmt->execute(array(NULL,$user->getUsername(), $user->getPasswd(), $user->getNombre(), $user->getEmail(),
		$user->getRol(), $user->getSexo(), $user->getNivel(), $user->getSocio()));
	}

	public function edit($user) {
		$stmt = $this->db->prepare("UPDATE usuario SET 
		username = ?,
		passwd = ?,
		nombre = ?,
		email = ?
		WHERE id_usuario = ?");
		$stmt->execute(array($user->getUsername(), $user->getPasswd(), $user->getNombre(),
		$user->getEmail(), $user->getIdusuario()));
	}

	public function setSocio($user, $estado) {
		$stmt = $this->db->prepare("UPDATE usuario SET 
		socio = ?
		WHERE id_usuario = ?");
		
		$stmt->execute(array($estado, $user));
	}

	public function delete($id_usuario) {
		$stmt = $this->db->prepare("DELETE FROM usuario WHERE id_usuario = ?"); 
		$stmt->execute(array($id_usuario));
	}

	
	public function usernameExists($username) {
		$stmt = $this->db->prepare("SELECT count(username) FROM usuario where username=?");
		$stmt->execute(array($username));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}


	public function isValidUser($username, $passwd) {
		$stmt = $this->db->prepare("SELECT count(username) FROM usuario where username=? and passwd=?");
		$stmt->execute(array($username, $passwd));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	public function findByUserEmail($username) {
		$stmt = $this->db->prepare("SELECT email FROM usuario where username=?");
		$stmt->execute(array($username));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return new User(
			$user["email"]
			);
		} else {
			return NULL;
		}
	}

	public function findByUserID($username) {
		$stmt = $this->db->prepare("SELECT id_usuario FROM usuario where username=?");
		$stmt->execute(array($username));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return $user["id_usuario"];
		} else {
			return NULL;
		}
	}

	public function getNumSocios(){
		$stmt1 = $this->db->prepare("SELECT count(id_usuario) FROM usuario where rol=?");
		$stmt1->execute(array("deportista"));
		$numUsuarios = $stmt1->fetch(PDO::FETCH_ASSOC);
	
		$stmt = $this->db->prepare("SELECT count(id_usuario) FROM usuario where socio=?");
		$stmt->execute(array(true));
		$numSocios = $stmt->fetch(PDO::FETCH_ASSOC);

		$valores = array();
		array_push($valores, ($numSocios["count(id_usuario)"]/$numUsuarios["count(id_usuario)"]) * 100);
		array_push($valores, $numSocios["count(id_usuario)"]);
		array_push($valores, $numUsuarios["count(id_usuario)"]);

		return $valores;
	}

	public function findByUserRol($username) {
		$stmt = $this->db->prepare("SELECT rol FROM usuario where username=?");
		$stmt->execute(array($username));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return $user["rol"];
		} else {
			return NULL;
		}
	}

	public function findEntrenador() {
		$stmt = $this->db->prepare("SELECT * FROM usuario where rol=?");
		$stmt->execute(array("entrenador"));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return new User(
			$user["id_usuario"],
			$user["username"],
			$user["passwd"],
			$user["nombre"],
			$user["email"],
			$user["rol"],
			$user["sexo"],
			$user["nivel"],
			$user["socio"]);
		} else {
			return NULL;
		}
	}

	public function findUser($id_usuario){
		$stmt = $this->db->prepare("SELECT * FROM usuario WHERE id_usuario=?");
		$stmt->execute(array($id_usuario));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return new User(
			$id_usuario,
			$user["username"],
			$user["passwd"],
			$user["nombre"],
			$user["email"],
			$user["rol"],
			$user["sexo"],
			$user["nivel"],
			$user["socio"]);
		} else {
			return NULL;
		}
	}

	public function findUserLogin($login){
		$stmt = $this->db->prepare("SELECT * FROM usuario WHERE username=?");
		$stmt->execute(array($login));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return new User(
			$user["id_usuario"],
			$user["username"],
			$user["passwd"],
			$user["nombre"],
			$user["email"],
			$user["rol"],
			$user["sexo"],
			$user["nivel"]);
		} else {
			return NULL;
		}
	}
}
