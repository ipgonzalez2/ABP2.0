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
		$stmt = $this->db->prepare("INSERT INTO calendario values (?,?,?,?)");
        $stmt->execute(array($calendario->getFechaCalendario(), $calendario->getPistaCalendario(),
        $calendario->getEstadoCalendario(), $calendario->getHoraCalendario()));
	}

	public function getHoras($fecha,$numPistas) {
		$horasFijas = array("09:00:00", "10:30:00", "12:00:00", "13:30:00", "15:00:00", "16:30:00", "18:00:00", "19:30:00", "21:00:00");
		$stmt = $this->db->prepare("SELECT hora_calendario FROM calendario where fecha_calendario=? AND estado_calendario=?");
        $stmt->execute(array($fecha,"ocupado"));
		
		$horas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$horasOcupadas = array();

		foreach ($horas_db as $hora) {
			$stmt = $this->db->prepare("SELECT COUNT(pista_calendario) FROM calendario where fecha_calendario=? AND estado_calendario=? AND hora_calendario=?");
			$stmt->execute(array($fecha,"ocupado",$hora["hora_calendario"]));
			$count = $stmt->fetch(PDO::FETCH_ASSOC);
			if($count["COUNT(pista_calendario)"]==$numPistas){
			array_push($horasOcupadas, $hora["hora_calendario"]);
			}
		}
		
		return array_diff($horasFijas, $horasOcupadas);
	}

	public function getPistaLibre($fecha, $hora, $pistas){
		$stmt = $this->db->prepare("SELECT pista_calendario FROM calendario where fecha_calendario=? AND hora_calendario=? AND estado_calendario=?");
		$stmt->execute(array($fecha,$hora,"ocupado"));
		
		$pistas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$pistasOcupadas = array();

		foreach ($pistas_db as $pista) {
			
			array_push($pistasOcupadas, $pista["pista_calendario"]);
			
		}
		$pistasLibres1 = array_diff($pistas, $pistasOcupadas);
		$pistasLibres = array();
		foreach($pistasLibres1 as $pistaLibre){
			array_push($pistasLibres, $pistaLibre);
		}

		return $pistasLibres[0];
	}

	public function esUltimaPistaLibre($fecha, $hora, $pista, $numPistas){
		$stmt = $this->db->prepare("SELECT COUNT(pista_calendario) FROM calendario where fecha_calendario=? AND hora_calendario=? AND estado_calendario=?");
		$stmt->execute(array($fecha,$hora,"ocupado"));
		
		$pistas_ocupadas = $stmt->fetch(PDO::FETCH_ASSOC);

		return $pistas_ocupadas["COUNT(pista_calendario)"]==($numPistas-1);
	}


}
