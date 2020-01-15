<?php


require_once(__DIR__."/../core/PDOConnection.php");


class PagoMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	public function save($pago) {
		$stmt = $this->db->prepare("INSERT INTO pago values (?,?,?,?,?,?,?,?,?)");
		$stmt->execute(array(NULL,$pago->getUsuarioPago(), $pago->getPrecio(), $pago->getReservaPago(), $pago->getPartidoPago(),
		$pago->getCampeonatoPago(), $pago->getClasePago(), $pago->getEstadoPago(), $pago->getFechaValido()));
	}

	public function remove($pago) {
		$stmt = $this->db->prepare("DELETE FROM pago WHERE id_pago = ?"); 
		$stmt->execute(array($pago));
		}

	public function findPago($id_usuario){
		$stmt = $this->db->prepare("SELECT * FROM pago WHERE usuario_pago=? and fecha_valido is not null");
		$stmt->execute(array($id_usuario));
		$pago = $stmt->fetch(PDO::FETCH_ASSOC);

		if($pago != null) {
			return new Pago(
			$pago["id_pago"],
			$id_usuario,
			$pago["precio"],
			$pago["reserva_pago"],
			$pago["partido_pago"],
			$pago["campeonato_pago"],
			$pago["clase_pago"],
			$pago["estado_pago"],
			$pago["fecha_valido"]);
		} else {
			return NULL;
		}
	}

	
}
