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
class PistaMapper {

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
	* @param User $pista The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($pista) {
		$stmt = $this->db->prepare("INSERT INTO pista values (?,?)");
		$stmt->execute(array(0,$pista->getTipoPista()));
	}

	public function getNumPistas(){
		$stmt = $this->db->prepare("SELECT COUNT(ID_PISTA) FROM PISTA");
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_ASSOC);
		return $count["COUNT(ID_PISTA)"];
	}


}
