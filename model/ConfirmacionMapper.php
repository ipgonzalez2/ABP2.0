<?php

require_once(__DIR__."/../core/PDOConnection.php");

class ConfirmacionMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function save($confirmacion) {
		$stmt = $this->db->prepare("INSERT INTO confirmacion values (?,?)");
		$stmt->execute(array($confirmacion->getIdEnfrentamiento(), $confirmacion->getDeportista()));
	}

	public function estaConfirmado($enfrentamiento, $id_usuario) {
		$stmt = $this->db->prepare("SELECT count(id_enfrentamiento) FROM confirmacion where id_enfrentamiento=? and deportista=?");
		$stmt->execute(array($enfrentamiento, $id_usuario));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	public function getNumConfirmaciones($enfrentamiento) {
		$stmt = $this->db->prepare("SELECT count(deportista) FROM confirmacion where id_enfrentamiento=? ");
		$stmt->execute(array($enfrentamiento));

		return $stmt->fetchColumn();
	}

	
}
