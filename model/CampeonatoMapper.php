<?php


require_once(__DIR__."/../core/PDOConnection.php");


class CampeonatoMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function save($campeonato) {
		$stmt = $this->db->prepare("INSERT INTO campeonato values (?,?,?,?,?,?,?)");
        $stmt->execute(array(NULL, $campeonato->getNombreCampeonato(), $campeonato->getFechaInicio(), 
        $campeonato->getFechaFin(), $campeonato->getPrecioCampeonato(), 
		$campeonato->getFechaLimiteInscripcion(), $campeonato->getEstadoCampeonato()));
		return $this->db->lastInsertId();
	}

	public function findAllCampeonatos() 
	{
		$stmt = $this->db->prepare("SELECT * FROM campeonato");
		$stmt->execute();
		
		$campeonatos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$campeonatos = array();

		foreach ($campeonatos_db as $campeonato) {
			array_push($campeonatos, new Campeonato($campeonato["id_campeonato"],
			$campeonato["nombre_campeonato"], $campeonato["fecha_inicio"],
			$campeonato["fecha_fin"], $campeonato["precio_campeonato"],
			$campeonato["fecha_limite_inscripcion"],$campeonato["estado_campeonato"]));
		}
		return $campeonatos;
	}

	public function findAllCampeonatosAbiertos($campeonatosInscrito) 
	{
		$stmt = $this->db->prepare("SELECT * FROM campeonato WHERE estado_campeonato=?");
		$stmt->execute(array("abierto"));
		
		$campeonatos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$campeonatos = array();

		foreach ($campeonatos_db as $campeonato) {
				if(!(in_array($campeonato["id_campeonato"],$campeonatosInscrito))){
					array_push($campeonatos, new Campeonato($campeonato["id_campeonato"],$campeonato["nombre_campeonato"], $campeonato["fecha_inicio"],
					$campeonato["fecha_fin"], $campeonato["precio_campeonato"], $campeonato["fecha_limite_inscripcion"], $campeonato["estado_campeonato"]));
				}
		}

		return $campeonatos;
	}

	public function findCampeonato($id_campeonato){
		$stmt = $this->db->prepare("SELECT * FROM campeonato WHERE id_campeonato=?");
		$stmt->execute(array($id_campeonato));
		$campeonato = $stmt->fetch(PDO::FETCH_ASSOC);

		if($campeonato != null) {
			return new Campeonato(
			$id_campeonato,
			$campeonato["nombre_campeonato"],
			$campeonato["fecha_inicio"],
			$campeonato["fecha_fin"],
			$campeonato["precio_campeonato"],
			$campeonato["fecha_limite_inscripcion"],
			$campeonato["estado_campeonato"]);
		} else {
			return NULL;
		}
	}

	public function cerrarCampeonato($idcampeonato)
    {
        $stmt = $this->db->prepare("UPDATE campeonato SET estado_campeonato = ? WHERE id_campeonato=?");
        $stmt->execute(array("cerrado",$idcampeonato));
	}
	
	public function findAll($campeonatos) 
	{
		$stmt = $this->db->prepare("SELECT * FROM campeonato");
		$stmt->execute();
		
		$campeonatos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$campeonatosInscrito = array();

		foreach ($campeonatos_db as $campeonato) {
				if((in_array($campeonato["id_campeonato"],$campeonatos))){
					array_push($campeonatosInscrito, new Campeonato($campeonato["id_campeonato"],$campeonato["nombre_campeonato"], $campeonato["fecha_inicio"],
					$campeonato["fecha_fin"], $campeonato["precio_campeonato"], $campeonato["fecha_limite_inscripcion"], $campeonato["estado_campeonato"]));
				}
		}

		return $campeonatosInscrito;
	}

	public function deleteCampeonato($idcampeonato)
    {
        $stmt = $this->db->prepare("DELETE from campeonato WHERE id_campeonato=?");
        $stmt->execute(array($idcampeonato));
	}


}
