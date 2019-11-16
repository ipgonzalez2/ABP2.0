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
class ParejaMapper {

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
	public function save($pareja) {
		$stmt = $this->db->prepare("INSERT INTO pareja values (?,?,?,?,?)");
		$stmt->execute(array(0,$user->getDeportista1(), $user->getDeportista2(),
		$user->getCategoriaNivel(), $user->getGrupo()));
    }
    
}