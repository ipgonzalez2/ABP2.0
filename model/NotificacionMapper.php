<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
* Class UserMapper
*
* Database interface for User entities
*
* @author lipido <lipido@gmail.com>
*/
class NotificacionMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Saves a User into the database
	*
	* @param User $notificacion The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($notificacion) {
		$stmt = $this->db->prepare("INSERT INTO notificacion values (?,?,?)");
		$stmt->execute(array(0,$notificacion->getIdUsuarioNotificacion(), $notificacion->getMensaje()));
	}

	public function findNotificacionesId($id_usuario){

		$stmt = $this->db->prepare("SELECT mansaje FROM notificacion WHERE id_usuario_notificacion=?");
		$stmt->execute(array($id_usuario));
		
		$notificaciones_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$notificaciones = array();

		foreach ($notificaciones_db as $notificacion) {
			array_push($notificaciones, $notificacion["mansaje"]);
		}
		return $notificaciones;
	}


}
