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
		$stmt = $this->db->prepare("INSERT INTO inscripcionpartido values (?,?)");
        $stmt->execute(array($inscripcionPartido->getIdInscripcionPartido(), 
        $inscripcionPartido->getIdInscripcionUsuario()));
    }
    
    public function getNumInscripciones($idPartido)
    {
        $stmt = $this->db->prepare("SELECT COUNT(id_inscripcion_partido) AS num FROM inscripcionpartido WHERE id_inscripcion_partido=?");
        $stmt->execute(array($idPartido));

        $inscripciones_db = $stmt->fetch(PDO::FETCH_ASSOC);
        $numInscripciones = $inscripciones_db["num"];
        
        return $numInscripciones;
    }

    public function findPartidosInscritos($idUsuario){

        $stmt = $this->db->prepare("SELECT id_inscripcion_partido FROM inscripcionpartido WHERE id_inscripcion_partido=?");
		$stmt->execute(array($idUsuario));
		
		$inscritos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$inscritos = array();

		foreach ($inscritos_db as $inscrito) {
			array_push($inscritos, $inscrito["id_inscripcion_partido"]);
		}

		return $inscritos;
    }

    public function getInscritos($idPartido){

        $stmt = $this->db->prepare("SELECT id_inscripcion_usuario FROM inscripcionpartido WHERE id_inscripcion_partido=?");
		$stmt->execute(array($idPartido));
		
		$inscritos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$inscritos = array();

		foreach ($inscritos_db as $inscrito) {
			array_push($inscritos, $inscrito["id_inscripcion_usuario"]);
		}

		return $inscritos;
    }

    public function estaInscrito($id_usuario,$id_partido) {
		$stmt = $this->db->prepare("SELECT count(id_inscripcion_partido) FROM inscripcionpartido where id_inscripcion_partido=? and id_inscripcion_partido=?");
		$stmt->execute(array($id_usuario, $id_partido));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	public function deleteInscripciones($id_partido) {
		$stmt = $this->db->prepare("DELETE FROM inscripcionpartido where id_inscripcion_partido=?");
		$stmt->execute(array($id_partido));
	}


}
