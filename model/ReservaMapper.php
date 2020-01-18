<?php


require_once(__DIR__."/../core/PDOConnection.php");


class ReservaMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	public function save($reserva) {
		$stmt = $this->db->prepare("INSERT INTO reserva values (?,?,?,?,?,?,?,?,?)");
		$stmt->execute(array(0, $reserva->getFecha(), $reserva->getPrecio(),
		$reserva->getUsuarioReserva(), $reserva->getPistaReserva(), $reserva->getHora(), $reserva->getPartidoReserva(),
	$reserva->getEnfrentamiento(), $reserva->getClase()));
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
		$stmt = $this->db->prepare("SELECT * from reserva where usuario_reserva=? order by fecha, hora");
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

	public function getPistaEnfrentamiento($id_enfrentamiento){
		$stmt = $this->db->prepare("SELECT pista_reserva from reserva where enfrentamiento=?");
		$stmt->execute(array($id_enfrentamiento));

		$pista = $stmt->fetch(PDO::FETCH_ASSOC);


		return $pista["pista_reserva"];
	}

	public function getHorasReserva($fecha, $id_usuario){
		$stmt = $this->db->prepare("SELECT hora from reserva where fecha=? and usuario_reserva=?");
		$stmt->execute(array($fecha, $id_usuario));

		$horas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$horas = array();

		foreach($horas_db as $hora){
			array_push($horas, $hora["hora"]);
		}


		return $horas;
	}

	public function getHorasClases($fecha){
		$stmt = $this->db->prepare("SELECT hora from reserva where fecha=? and clase is not null");
		$stmt->execute(array($fecha));

		$horas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$horas = array();

		foreach($horas_db as $hora){
			array_push($horas, $hora["hora"]);
		}


		return $horas;
	}

	public function getReservasHora(){
		
		$stmt = $this->db->prepare("SELECT hora, count(id_reserva) from reserva where partido_reserva is null and enfrentamiento is null group by hora  order by count(id_reserva) desc ");
		$stmt->execute(null);

		$horas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$horas = array();

		foreach($horas_db as $hora){
			array_push($horas, $hora["hora"]);
			array_push($horas, $hora["count(id_reserva)"]);
		}


		return $horas;
	}

	public function getTotalSinPartidos(){
		
		$stmt = $this->db->prepare("SELECT count(id_reserva) from reserva where partido_reserva is null and enfrentamiento is null");
		$stmt->execute(null);

		$reservas_db = $stmt->fetch(PDO::FETCH_ASSOC);
		return $reservas_db["count(id_reserva)"];
	}

	public function findClases(){

		$stmt = $this->db->prepare("SELECT r.id_reserva, u.nombre, r.fecha, r.hora, r.pista_reserva, r.clase FROM reserva r, usuario u WHERE r.usuario_reserva = u.id_usuario and r.clase is not null ORDER BY r.fecha, r.hora");
		$stmt->execute(null);
		
		$clases_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$clases = array();

		foreach ($clases_db as $clase) {
			array_push($clases, $clase["nombre"]);
			array_push($clases, $clase["fecha"]);
			array_push($clases, $clase["hora"]);
			array_push($clases, $clase["pista_reserva"]);
			array_push($clases, $clase["clase"]);
			array_push($clases, $clase["id_reserva"]);
		}
		return $clases;
	}

	public function findClasesUsuario($id){

		$stmt = $this->db->prepare("SELECT r.id_reserva, u.nombre, r.fecha, r.hora, r.pista_reserva, r.clase FROM reserva r, usuario u WHERE r.usuario_reserva = u.id_usuario and r.usuario_reserva=? and r.clase is not null ORDER BY r.fecha, r.hora");
		$stmt->execute(array($id));
		
		$clases_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$clases = array();

		foreach ($clases_db as $clase) {
			array_push($clases, $clase["nombre"]);
			array_push($clases, $clase["fecha"]);
			array_push($clases, $clase["hora"]);
			array_push($clases, $clase["pista_reserva"]);
			array_push($clases, $clase["clase"]);
			array_push($clases, $clase["id_reserva"]);
		}
		return $clases;
	}


}
