<?php

require_once(__DIR__."/../core/PDOConnection.php");


class PagoMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	public function save($pago) {
		$stmt = $this->db->prepare("INSERT INTO pago values (?,?,?,?,?)");
		$stmt->execute(array(0,$pago->getIdPago(), $pago->getTipoPago(), $pago->getEstadoPago(),
		$pago->getCantidad(), $pago->getReservaPago()));
	}


}
