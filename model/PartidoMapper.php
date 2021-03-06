<?php


require_once(__DIR__."/../core/PDOConnection.php");


class PartidoMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	public function save($partido) {
		$stmt = $this->db->prepare("INSERT INTO partido values (?,?,?,?,?,?)");
		$stmt->execute(array(NULL, $partido->getFechaPartido(), $partido->getPrecioPartido(), 
		$partido->getEstadoPartido(), $partido->getFechaFinInscripcion(), $partido->getHoraPartido()));
	}

	public function findAllPartidos() 
	{
		$stmt = $this->db->prepare("SELECT * FROM partido order by fecha_partido, hora_partido");
		$stmt->execute();
		
		$partidos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$partidos = array();

		foreach ($partidos_db as $partido) {
			array_push($partidos, new Partido($partido["id_partido"],$partido["fecha_partido"], $partido["precio_partido"],
			$partido["estado_partido"], $partido["fecha_fin_inscripcion"], $partido["hora_partido"]));
		}
		return $partidos;
	}

	public function findAllPartidosAbiertos($partidosInscrito) 
	{
		$stmt = $this->db->prepare("SELECT * FROM partido WHERE estado_partido=? order by fecha_partido, hora_partido");
		$stmt->execute(array("abierto"));
		
		$partidos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$partidos = array();

		foreach ($partidos_db as $partido) {
				if(!(in_array($partido["id_partido"],$partidosInscrito))){
					array_push($partidos, new Partido($partido["id_partido"],$partido["fecha_partido"], $partido["precio_partido"],
					$partido["estado_partido"], $partido["fecha_fin_inscripcion"], $partido["hora_partido"]));
				}
		}

		return $partidos;
	}

	public function actualizarPartidos() 
	{
		$stmt = $this->db->prepare("SELECT * FROM partido");
		$stmt->execute();
		
		$partidos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$partidos = array();

		foreach ($partidos_db as $partido) {
			$fechaInscripcionPartido=date("Y-m-d",strtotime($partido["fecha_fin_inscripcion"]));
			$fechaActual=date("Y-m-d",strtotime("Today"));
			if(($fechaInscripcionPartido <= $fechaActual) && ($partido["estado_partido"] == "abierto")){
				$stmt = $this->db->prepare("UPDATE partido SET 
				estado_partido = ? WHERE id_partido = ?");
				$stmt->execute(array("cerrado",$partido["id_partido"]));
			}
		}
	}

	public function deletePartido($idPartido){

		$stmt = $this->db->prepare("DELETE FROM partido WHERE id_partido = ?"); 
		$stmt->execute(array($idPartido));

	}

	public function comprobarPartido($idPartido){

		$stmt = $this->db->prepare("SELECT estado_partido WHERE id_partido = ?"); 
		$stmt->execute(array($idPartido));

		$estado = $stmt->fetch(PDO::FETCH_ASSOC);
		if($estado == "cerrado"){
			$this->actualizarPartidos();
			return false;
		}
		return true;

	}

	public function findPartido($id_partido){
		$stmt = $this->db->prepare("SELECT * FROM partido WHERE id_partido=?");
		$stmt->execute(array($id_partido));
		$partido = $stmt->fetch(PDO::FETCH_ASSOC);

		if($partido != null) {
			return new Partido(
			$id_partido,
			$partido["fecha_partido"],
			$partido["precio_partido"],
			$partido["estado_partido"],
			$partido["fecha_fin_inscripcion"],
			$partido["hora_partido"]);
		} else {
			return NULL;
		}
	}

	public function cerrarPartido($idPartido)
    {
        $stmt = $this->db->prepare("UPDATE partido SET estado_partido = ? WHERE id_partido=?");
        $stmt->execute(array("cerrado",$idPartido));
	}
	
	public function findAllPartidosInscrito($partidosInscrito) 
	{
		$stmt = $this->db->prepare("SELECT * FROM partido");
		$stmt->execute();
		
		$partidos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$partidos = array();

		foreach ($partidos_db as $partido) {
				if((in_array($partido["id_partido"],$partidosInscrito))){
					array_push($partidos, new Partido($partido["id_partido"],$partido["fecha_partido"], $partido["precio_partido"],
					$partido["estado_partido"], $partido["fecha_fin_inscripcion"], $partido["hora_partido"]));
				}
		}

		return $partidos;
	}

	public function getPartidoFecha($fecha, $hora){
		$stmt = $this->db->prepare("SELECT id_partido FROM partido WHERE fecha_partido=? AND hora_partido=? AND estado_partido=?");
		$stmt->execute(array($fecha, $hora, "abierto"));
		$partido = $stmt->fetch(PDO::FETCH_ASSOC);

		if($partido != null) {
			return $partido["id_partido"];
		} else {
			return NULL;
		}
	}

	public function getHoras($fecha,$numPistas){
	$stmt = $this->db->prepare("SELECT hora_partido FROM partido where fecha_partido=? AND estado_partido=?");
    $stmt->execute(array($fecha,"abierto"));
		
		$horas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$horasOcupadas = array();

		foreach ($horas_db as $hora) {
			$stmt = $this->db->prepare("SELECT COUNT(hora_partido) FROM partido where fecha_partido=? AND hora_partido=?");
			$stmt->execute(array($fecha,$hora["hora_partido"]));
			$count = $stmt->fetch(PDO::FETCH_ASSOC);
			if($count["COUNT(hora_partido)"]==$numPistas){
			array_push($horasOcupadas, $hora["hora_partido"]);
			}
		}
		
		return $horasOcupadas;
	}


}
