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
class InscripcionPartidoMapper {

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
	* @param User $inscripcionPartido The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($inscripcionPartido) {
		$stmt = $this->db->prepare("INSERT INTO INSCRIPCIONPARTIDO values (?,?)");
        $stmt->execute(array($inscripcionPartido->getIdInscripcionPartido(), 
        $inscripcionPartido->getIdInscripcionUsuario()));
    }
    
    public function getNumInscripciones($idPartido)
    {
        $stmt = $this->db->prepare("SELECT COUNT(ID_INSCRIPCION_USUARIO) AS NUM FROM INSCRIPCIONPARTIDO WHERE ID_INSCRIPCION_PARTIDO=?");
        $stmt->execute(array($idPartido));

        $inscripciones_db = $stmt->fetch(PDO::FETCH_ASSOC);
        $numInscripciones = $inscripciones_db["NUM"];
        
        return $numInscripciones;
    }

    public function findPartidosInscritos($idUsuario){

        $stmt = $this->db->prepare("SELECT ID_INSCRIPCION_PARTIDO FROM INSCRIPCIONPARTIDO WHERE ID_INSCRIPCION_USUARIO=?");
		$stmt->execute(array($idUsuario));
		
		$inscritos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$inscritos = array();

		foreach ($inscritos_db as $inscrito) {
			array_push($inscritos, $inscrito["ID_INSCRIPCION_PARTIDO"]);
		}

		return $inscritos;
    }

    public function getInscritos($idPartido){

        $stmt = $this->db->prepare("SELECT ID_INSCRIPCION_USUARIO FROM INSCRIPCIONPARTIDO WHERE ID_INSCRIPCION_PARTIDO=?");
		$stmt->execute(array($idPartido));
		
		$inscritos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$inscritos = array();

		foreach ($inscritos_db as $inscrito) {
			array_push($inscritos, $inscrito["ID_INSCRIPCION_USUARIO"]);
		}

		return $inscritos;
    }


}
