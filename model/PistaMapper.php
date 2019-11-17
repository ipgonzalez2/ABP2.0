<?php


require_once(__DIR__."/../core/PDOConnection.php");


class PistaMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	public function save($pista) {
		$stmt = $this->db->prepare("INSERT INTO pista values (?,?)");
		$stmt->execute(array(0,$pista->getTipoPista()));
	}

	public function getNumPistas(){
		$stmt = $this->db->prepare("SELECT COUNT(id_pista) FROM pista");
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_ASSOC);
		return $count["COUNT(id_pista)"];
	}

	public function getPistas(){
		$stmt = $this->db->prepare("SELECT id_pista FROM pista");
		$stmt->execute();
		$pistas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$pistas = array();

		foreach($pistas_db as $pista){
			array_push($pistas, $pista["id_pista"]);
		}

		return $pistas;
	}


}
