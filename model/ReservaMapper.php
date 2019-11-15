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
class ReservaMapper {

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
	* @param User $reserva The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($reserva) {
		$stmt = $this->db->prepare("INSERT INTO reserva values (?,?,?,?,?,?,?)");
		$stmt->execute(array(0, $reserva->getFecha(), $reserva->getPrecio(),
		$reserva->getUsuarioReserva(), $reserva->getPistaReserva(), $reserva->getHora(), $reserva->getPartidoReserva()));
	}

	public function getNumReservasUser($id_reserva) {
		$stmt = $this->db->prepare("SELECT fecha,hora from reserva where usuario_reserva=?");
		$stmt->execute(array($id_reserva));

		$reservas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$count = 0;
		$fecha_actual = date("Y-m-d");
		$hora_actual = date("H:i:s",time());


		foreach($reservas_db as $reserva){
			if($reserva["fecha"] > $fecha_actual){
				$count++;
			}else if(($reserva["fecha"] == $fecha_actual) && ($reserva["hora"] > $hora_actual)){
				$count++;
			}
		}

		return $count;
	}

	public function getReservasActivas($id_reserva) {
		$stmt = $this->db->prepare("SELECT * from reserva where usuario_reserva=?");
		$stmt->execute(array($id_reserva));

		$reservas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$reservas = array();
		$fecha_actual = date("Y-m-d");
		$hora_actual = date("H:i:s",time());


		foreach($reservas_db as $reserva){
			if(($reserva["fecha"] > $fecha_actual) || (($reserva["fecha"] == $fecha_actual) && ($reserva["hora"] > $hora_actual))){
				array_push($reservas, new Reserva($reserva["id_reserva"], $reserva["fecha"], $reserva["precio"],
				$reserva["usuario_reserva"], $reserva["pista_reserva"], $reserva["hora"], $reserva["partido_reserva"]));
			}
		}

		return $reservas;
	}

	public function findReserva($id_reserva) {
		$stmt = $this->db->prepare("SELECT * from reserva where id_reserva=?");
		$stmt->execute(array($id_reserva));

		$reserva = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($reserva != null) {
			return new Reserva(
			$id_reserva,
			$reserva["fecha"],
			$reserva["precio"],
			$reserva["usuario_reserva"],
			$reserva["pista_reserva"],
			$reserva["hora"],
			$reserva["partido_reserva"]);
		} else {
			return NULL;
		}

		return $reserva;
	}

	public function esPropietario($id_reserva, $id_usuario) {
		$stmt = $this->db->prepare("SELECT count(id_reserva) from reserva where id_reserva=? AND usuario_reserva=?");
		$stmt->execute(array($id_reserva, $id_usuario));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}

	}

	public function deleteReserva($id_reserva) {
		$stmt = $this->db->prepare("DELETE from reserva where id_reserva=?");
		$stmt->execute(array($id_reserva));
		
	}

	public function getPistaPartido($id_partido){
		$stmt = $this->db->prepare("SELECT pista_reserva from reserva where partido_reserva=?");
		$stmt->execute(array($id_partido));

		$pista = $stmt->fetch(PDO::FETCH_ASSOC);


		return $pista["pista_reserva"];
	}


}
