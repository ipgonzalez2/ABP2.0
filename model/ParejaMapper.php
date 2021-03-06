<?php

require_once(__DIR__."/../core/PDOConnection.php");

class ParejaMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function save($pareja) {
		$stmt = $this->db->prepare("INSERT INTO pareja values (?,?,?,?,?,?)");
		$stmt->execute(array(0,$pareja->getDeportista1(), $pareja->getDeportista2(),
		$pareja->getCategoriaNivel(), $pareja->getGrupo(), $pareja->getPuntos()));
	}
	
	public function estanInscritos($deportista1, $deportista2, $categorias_niveles) {
		$estanInscritos = false;

		foreach($categorias_niveles as $cn){
			$stmt = $this->db->prepare("SELECT deportista1, deportista2 from pareja where categorianivel=?");
			$stmt->execute(array($cn));

			$deportistas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($deportistas_db as $deportistas){
				if($deportistas["deportista1"] == $deportista1 || $deportistas["deportista1"] == $deportista2 
					|| $deportistas["deportista2"] == $deportista1 || $deportistas["deportista2"] == $deportista2){
						$estanInscritos = true;
					}
			}
		}

		return $estanInscritos;
	}
	
	public function findParejas($cn) {

		$stmt = $this->db->prepare("SELECT * from pareja where categorianivel=? order by id_pareja");
		$stmt->execute(array($cn));

		$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$parejas = array();

		foreach($parejas_db as $pareja){
			array_push($parejas, new Pareja($pareja["id_pareja"], $pareja["deportista1"],
					$pareja["deportista2"], $pareja["categorianivel"], $pareja["grupo"], $pareja["puntos"]));
		}

		return $parejas;
	}

	public function findInscritos($id_usuario) 
	{
		$stmt = $this->db->prepare("SELECT categorianivel FROM pareja where deportista1=? OR deportista2=?");
		$stmt->execute(array($id_usuario, $id_usuario));
		
		$categorias_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$categorias = array();

		foreach ($categorias_db as $categoria_nivel) {
				array_push($categorias, $categoria_nivel["categorianivel"]);
		}

		return $categorias;
	}

	public function actualizarPareja($id_pareja, $id_grupo) 
	{
		$stmt = $this->db->prepare("UPDATE pareja set grupo=? where id_pareja=?");
		$stmt->execute(array($id_grupo, $id_pareja));

	}

	public function findParejasSinGrupo($categorias)
	{
		$parejasSinGrupo = array();

		foreach($categorias as $categoria){
			$stmt = $this->db->prepare("SELECT * from pareja where categorianivel=? and grupo is null");
			$stmt->execute(array($categoria));
			$p = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($p as $pareja){
				array_push($parejasSinGrupo, new Pareja($pareja["id_pareja"], $pareja["deportista1"],
				$pareja["deportista2"], $pareja["categorianivel"], $pareja["grupo"], $pareja["puntos"]));
			}
			
		}

		return $parejasSinGrupo;
		

	}

	public function deletePareja($idPareja){
		$stmt = $this->db->prepare("DELETE from pareja where id_pareja=?");
		$stmt->execute(array($idPareja));
	}

	public function findAll($grupo) {

		$stmt = $this->db->prepare("SELECT * from pareja where grupo=? order by id_pareja");
		$stmt->execute(array($grupo));

		$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$parejas = array();

		foreach($parejas_db as $pareja){
			array_push($parejas, new Pareja($pareja["id_pareja"], $pareja["deportista1"],
					$pareja["deportista2"], $pareja["categorianivel"], $pareja["grupo"], $pareja["puntos"]));
		}

		return $parejas;
	}

	public function findPareja($idPareja) {

		$stmt = $this->db->prepare("SELECT * from pareja where id_pareja=?");
		$stmt->execute(array($idPareja));

		$pareja = $stmt->fetch(PDO::FETCH_ASSOC);

		if($pareja != null) {
			return new Pareja(
			$pareja["id_pareja"],
			$pareja["deportista1"],
			$pareja["deportista2"],
			$pareja["categorianivel"],
			$pareja["grupo"],
			$pareja["puntos"]
			);
		} else {
			return NULL;
		}
	}

	public function findParejaGrupos($grupos, $id_usuario) {

		foreach($grupos as $grupo){
			$stmt = $this->db->prepare("SELECT id_pareja from pareja where grupo=? and (deportista1=? or deportista2=?)");
			$stmt->execute(array($grupo, $id_usuario, $id_usuario));

			$pareja = $stmt->fetch(PDO::FETCH_ASSOC);
			if($pareja!=null){
				return $pareja["id_pareja"];
			}
		}


	}

	public function sumarPuntos($pareja, $puntos) {

			$stmt = $this->db->prepare("UPDATE pareja set puntos = puntos + ? where id_pareja=?");
			$stmt->execute(array($puntos, $pareja));


	}

	public function findGrupo($idPareja) {

		$stmt = $this->db->prepare("SELECT grupo from pareja where id_pareja=?");
		$stmt->execute(array($idPareja));

		$grupo = $stmt->fetch(PDO::FETCH_ASSOC);

		if($grupo!=null){
			return $grupo["grupo"];
		}

		
	}

	public function findParejasGrupo($grupo) {

		$stmt = $this->db->prepare("SELECT * from pareja where grupo=? order by puntos desc");
		$stmt->execute(array($grupo));

		$parejas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$parejas = array();

		foreach($parejas_db as $pareja){
			array_push($parejas, new Pareja($pareja["id_pareja"], $pareja["deportista1"],
					$pareja["deportista2"], $pareja["categorianivel"], $pareja["grupo"], $pareja["puntos"]));
		}

		return $parejas;
	}

	
}