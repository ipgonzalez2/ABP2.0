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
class PartidoMapper {

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
	* @param User $partido The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($partido) {
		$stmt = $this->db->prepare("INSERT INTO PARTIDO values (?,?,?,?,?)");
        $stmt->execute(array(NULL, $partido->getFechaPartido(), 
        $partido->getPrecioPartido(), $partido->getEstadoPartido(), $partido->getFechaFinInscripcion()));
	}

	public function findAllPartidos() 
	{
		$stmt = $this->db->prepare("SELECT * FROM PARTIDO");
		$stmt->execute();
		
		$partidos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$partidos = array();

		foreach ($partidos_db as $partido) {
			array_push($partidos, new Partido($partido["ID_PARTIDO"],$partido["FECHA_PARTIDO"], $partido["PRECIO_PARTIDO"],
			$partido["ESTADO_PARTIDO"], $partido["FECHA_FIN_INSCRIPCION"]));
		}
		return $partidos;
	}

	public function findAllPartidosAbiertos() 
	{
		$stmt = $this->db->prepare("SELECT * FROM PARTIDO WHERE ESTADO_PARTIDO=?");
		$stmt->execute(array("ABIERTO"));
		
		$partidos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$partidos = array();

		foreach ($partidos_db as $partido) {
			array_push($partidos, new Partido($partido["ID_PARTIDO"],$partido["FECHA_PARTIDO"], $partido["PRECIO_PARTIDO"],
			$partido["ESTADO_PARTIDO"], $partido["FECHA_FIN_INSCRIPCION"]));
		}
		return $partidos;
	}

	public function deletePartido($idPartido){

		$stmt = $this->db->prepare("DELETE FROM PARTIDO WHERE ID_PARTIDO = ?"); 
		$stmt->execute(array($idPartido));

	}


}
