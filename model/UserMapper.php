<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
* Class UserMapper
*
* Database interface for User entities
*
* @author lipido <lipido@gmail.com>
*/
class UserMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Saves a User into the database
	*
	* @param User $user The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($user) {
		$stmt = $this->db->prepare("INSERT INTO USUARIO values (?,?,?,?,?,?,?,?)");
		$stmt->execute(array(NULL,$user->getUsername(), $user->getPasswd(), $user->getNombre(), $user->getEmail(),
		$user->getRol(), $user->getSexo(), $user->getNivel()));
	}

	public function edit($user) {
		$stmt = $this->db->prepare("UPDATE USUARIO SET 
		USERNAME = ?,
		PASSWD = ?,
		NOMBRE = ?,
		EMAIL = ?
		WHERE ID_USUARIO = ?");
		$stmt->execute(array($user->getUsername(), $user->getPasswd(), $user->getNombre(),
		$user->getEmail(), $user->getIdUsuario()));
	}

	public function delete($id_usuario) {
		$stmt = $this->db->prepare("DELETE FROM USUARIO WHERE ID_USUARIO = ?"); 
		$stmt->execute(array($id_usuario));
	}

	/**
	* Checks if a given username is already in the database
	*
	* @param string $username the username to check
	* @return boolean true if the username exists, false otherwise
	*/
	public function usernameExists($username) {
		$stmt = $this->db->prepare("SELECT count(USERNAME) FROM USUARIO where USERNAME=?");
		$stmt->execute(array($username));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	/**
	* Checks if a given pair of username/password exists in the database
	*
	* @param string $username the username
	* @param string $passwd the password
	* @return boolean true the username/passwrod exists, false otherwise.
	*/
	public function isValidUser($username, $passwd) {
		$stmt = $this->db->prepare("SELECT count(username) FROM usuario where username=? and passwd=?");
		$stmt->execute(array($username, $passwd));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	public function findByUserEmail($username) {
		$stmt = $this->db->prepare("SELECT EMAIL FROM usuario where USERNAME=?");
		$stmt->execute(array($username));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return new User(
			$user["EMAIL"]
			);
		} else {
			return NULL;
		}
	}

	public function findByUserID($username) {
		$stmt = $this->db->prepare("SELECT ID_USUARIO FROM usuario where USERNAME=?");
		$stmt->execute(array($username));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return $user["ID_USUARIO"];
		} else {
			return NULL;
		}
	}

	public function findUser($id_usuario){
		$stmt = $this->db->prepare("SELECT * FROM USUARIO WHERE ID_USUARIO=?");
		$stmt->execute(array($id_usuario));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return new User(
			$id_usuario,
			$user["USERNAME"],
			$user["PASSWD"],
			$user["NOMBRE"],
			$user["EMAIL"],
			$user["ROL"],
			$user["SEXO"],
			$user["NIVEL"]);
		} else {
			return NULL;
		}
	}
}
