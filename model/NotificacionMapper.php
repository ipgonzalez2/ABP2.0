<?php


require_once(__DIR__."/../core/PDOConnection.php");


class NotificacionMapper {


	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	
	public function save($notificacion) {
		$stmt = $this->db->prepare("INSERT INTO notificacion values (?,?,?)");
		$stmt->execute(array(0,$notificacion->getIdUsuarioNotificacion(), $notificacion->getMensaje()));
	}

	public function findNotificacionesId($id_usuario){

		$stmt = $this->db->prepare("SELECT mensaje FROM notificacion WHERE id_usuario_notificacion=? ORDER BY id_notificacion DESC");
		$stmt->execute(array($id_usuario));
		
		$notificaciones_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$notificaciones = array();

		foreach ($notificaciones_db as $notificacion) {
			array_push($notificaciones, $notificacion["mensaje"]);
		}
		return $notificaciones;
	}


}
