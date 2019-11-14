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
class CalendarioMapper {

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
	* @param User $calendario The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($calendario) {
		$stmt = $this->db->prepare("INSERT INTO calendario values (?,?,?)");
        $stmt->execute(array($calendario->getFechaCalendario(), 
        $calendario->getEstadoCalendario(), $calendario->getHoraCalendario()));
	}

	public function getHoras($fecha,$numPistas) {
		$horasFijas = array("09:00:00", "10:30:00", "12:00:00", "13:30:00", "15:00:00", "16:30:00", "18:00:00", "19:30:00", "21:00:00");
		$stmt = $this->db->prepare("SELECT HORA_CALENDARIO FROM calendario where FECHA_CALENDARIO=? AND ESTADO_CALENDARIO=?");
        $stmt->execute(array($fecha,"OCUPADO"));
		
		$horas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$horasOcupadas = array();

		foreach ($horas_db as $hora) {
			$stmt = $this->db->prepare("SELECT COUNT(PISTA_CALENDARIO) FROM calendario where FECHA_CALENDARIO=? AND ESTADO_CALENDARIO=? AND HORA_CALENDARIO=?");
			$stmt->execute(array($fecha,"OCUPADO",$hora["HORA_CALENDARIO"]));
			$count = $stmt->fetch(PDO::FETCH_ASSOC);
			if($count["COUNT(PISTA_CALENDARIO)"]==$numPistas){
			array_push($horasOcupadas, $hora["HORA_CALENDARIO"]);
			}
		}
		
		return array_diff($horasFijas, $horasOcupadas);
	}


}
