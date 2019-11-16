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
		$stmt->execute(array(0,$pareja->getDeportista1(), $pareja->getDeportista2(),
		$pareja->getCategoriaNivel(), $pareja->getGrupo()));
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
    
}