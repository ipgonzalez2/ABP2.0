<?php

require_once(__DIR__."/../core/ValidationException.php");

class Notificacion {


	private $id_notificacion;

    private $id_usuario_notificacion;
    
    private $mensaje;

	
    public function __construct($id_notificacion=NULL, $id_usuario_notificacion=NULL, $mensaje=NULL) {
		$this->id_notificacion = $id_notificacion;
        $this->id_usuario_notificacion = $id_usuario_notificacion;
        $this->mensaje = $mensaje;
	}
	

	public function getIdNotificacion() {
		return $this->id_notificacion;
	}


	public function setIdNotificacion($id_notificacion) {
		$this->id_notificacion = $id_notificacion;
	}


	public function getIdUsuarioNotificacion() {
		return $this->id_usuario_notificacion;
	}


	public function setIdUsuarioNotificacion($id_usuario_notificacion) {
		$this->id_usuario_notificacion = $id_usuario_notificacion;
    }
    
    
	public function getMensaje() {
		return $this->mensaje;
	}

	
	public function setMensaje($mensaje) {
		$this->mensaje = $mensaje;
    }


}
