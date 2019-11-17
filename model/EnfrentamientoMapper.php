<?php

require_once(__DIR__."/../core/PDOConnection.php");

class EnfrentamientoMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function save($enfrentamiento) {
		$stmt = $this->db->prepare("INSERT INTO enfrentamiento values (?,?,?,?,?,?,?,?,?,?)");
		$stmt->execute(array(0,$enfrentamiento->getPareja1(), $enfrentamiento->getPareja2(),
        $enfrentamiento->getResultado1(), $enfrentamiento->getResultado2(), $enfrentamiento->getGrupoEnfrentamiento(),
		$enfrentamiento->getTipoEnfrentamiento(), $enfrentamiento->getEstadoEnfrentamiento(),
		$enfrentamiento->getFechaEnfrentamiento(),$enfrentamiento->getHoraEnfrentamiento()));
	}

	public function getHoras($fecha, $grupo){

		$stmt = $this->db->prepare("SELECT hora_enfrentamiento FROM enfrentamiento where fecha_enfrentamiento=? and grupo_enfrentamiento=?");
		$stmt->execute(array($fecha,$grupo));
			
			$horas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$horasOcupadas = array();
	
			foreach ($horas_db as $hora) {
				array_push($horasOcupadas, $hora["hora_enfrentamiento"]);
			}
			
			return $horasOcupadas;

		}
	
			
	public function jueganParejas($pareja1, $pareja2, $fecha){
		$stmt = $this->db->prepare("SELECT count(id_enfrentamiento)  FROM enfrentamiento where fecha_enfrentamiento=? and (pareja1=? or pareja2=? or pareja1=? or pareja2=?)");
		$stmt->execute(array($fecha,$pareja1,$pareja2,$pareja2,$pareja1));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	public function getEnfrentamientos($grupo){

		$stmt = $this->db->prepare("SELECT * FROM enfrentamiento where grupo_enfrentamiento=? and tipo_enfrentamiento=? order by fecha_enfrentamiento,hora_enfrentamiento");
		$stmt->execute(array($grupo, "liga"));
			
			$enfrentamientos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$enfrentamientos = array();
	
			foreach ($enfrentamientos_db as $enfrentamiento) {
				array_push($enfrentamientos, new Enfrentamiento($enfrentamiento["id_enfrentamiento"],
				$enfrentamiento["pareja1"], $enfrentamiento["pareja2"], $enfrentamiento["resultado1"],
				$enfrentamiento["resultado2"], $enfrentamiento["grupo_enfrentamiento"],
				$enfrentamiento["tipo_enfrentamiento"], $enfrentamiento["estado_enfrentamiento"],
				$enfrentamiento["fecha_enfrentamiento"], $enfrentamiento["hora_enfrentamiento"]));
			}
			
			return $enfrentamientos;

		}

	
}