<?php


require_once(__DIR__."/../core/PDOConnection.php");


class GrupoMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	public function save($grupo) {
		$stmt = $this->db->prepare("INSERT INTO grupo values (?,?,?)");
        $stmt->execute(array(0,$grupo->getCategoriaNivelGrupo(), $grupo->getNumParejas()));
        return $this->db->lastInsertId();
	}

	public function findAll($categoriasNiveles){

		$grupos = array();

		foreach($categoriasNiveles as $cn){
			$stmt = $this->db->prepare("SELECT * from grupo where categorianivel_grupo=?");
			$stmt->execute(array($cn));
			$grupos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($grupos_db as $grupo){
				array_push($grupos, new Grupo($grupo["id_grupo"], $grupo["categorianivel_grupo"],
				$grupo["numParejas"]));
			}
		}

		return $grupos;
	}

	


}
