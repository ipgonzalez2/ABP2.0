<?php

require_once(__DIR__."/../core/PDOConnection.php");

class EnfrentamientoMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function save($enfrentamiento) {
		$stmt = $this->db->prepare("INSERT INTO enfrentamiento values (?,?,?,?,?,?,?)");
		$stmt->execute(array(0,$enfrentamiento->getPareja1(), $enfrentamiento->getPareja2(),
        $enfrentamiento->getResultado1(), $enfrentamiento->getResultado2(), $enfrentamiento->getGrupoEnfrentamiento(),
        $enfrentamiento->getTipoEnfrentamiento()));
	}

	
}