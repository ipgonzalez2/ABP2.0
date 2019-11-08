<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class Notificacion {

	/**
	* The reservation name of the reservation
	* @var string
	*/
	private $id_notificacion;

	/**
	* The reservation name of the reservation
	* @var string
	*/
    private $id_usuario_notificacion;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $mensaje;

	
	
	/** 
	* The constructor
	*
	* @param string $id_usuario_notificacion The name of the reservation
	* @param string $Precio The password of the reservation
	*/
    public function __construct($id_notificacion=NULL, $id_usuario_notificacion=NULL, $mensaje=NULL) {
		$this->id_notificacion = $id_notificacion;
        $this->id_usuario_notificacion = $id_usuario_notificacion;
        $this->mensaje = $mensaje;
	}
	
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getIdNotificacion() {
		return $this->id_notificacion;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $id_usuario_notificacion The tipoPista of this reservation
	* @return void
	*/
	public function setIdNotificacion($id_notificacion) {
		$this->id_notificacion = $id_notificacion;
	}

	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getIdUsuarioNotificacion() {
		return $this->id_usuario_notificacion;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $id_usuario_notificacion The tipoPista of this reservation
	* @return void
	*/
	public function setIdUsuarioNotificacion($id_usuario_notificacion) {
		$this->id_usuario_notificacion = $id_usuario_notificacion;
    }
    
    
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getMensaje() {
		return $this->mensaje;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $id_usuario_notificacion The tipoPista of this reservation
	* @return void
	*/
	public function setMensaje($mensaje) {
		$this->mensaje = $mensaje;
    }


}
