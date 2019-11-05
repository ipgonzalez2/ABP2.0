<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class Calendario {

	/**
	* The reservation name of the reservation
	* @var string
	*/
	private $id_calendario;

	/**
	* The reservation name of the reservation
	* @var string
	*/
    private $fecha_calendario;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $estado_calendario;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $pista_calendario;

	
	
	/** 
	* The constructor
	*
	* @param string $fecha_calendario The name of the reservation
	* @param string $Precio The password of the reservation
	*/
    public function __construct($id_calendario=NULL, $fecha_calendario=NULL, $estado_calendario=NULL,
    $pista_calendario=NULL) {
		$this->id_calendario = $id_calendario;
        $this->fecha_calendario = $fecha_calendario;
        $this->estado_calendario = $estado_calendario;
        $this->pista_calendario = $pista_calendario;
	}
	
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getIdCalendario() {
		return $this->id_calendario;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $fecha_calendario The tipoPista of this reservation
	* @return void
	*/
	public function setIdCalendario($id_calendario) {
		$this->id_calendario = $id_calendario;
	}

	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getFechaCalendario() {
		return $this->fecha_calendario;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $fecha_calendario The tipoPista of this reservation
	* @return void
	*/
	public function setFechaCalendario($fecha_calendario) {
		$this->fecha_calendario = $fecha_calendario;
    }
    
    
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getEstadoCalendario() {
		return $this->estado_calendario;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $fecha_calendario The tipoPista of this reservation
	* @return void
	*/
	public function setEstadoCalendario($estado_calendario) {
		$this->estado_calendario = $estado_calendario;
    }
    
    
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getPistaCalendario() {
		return $this->pista_calendario;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $fecha_calendario The tipoPista of this reservation
	* @return void
	*/
	public function setPistaCalendario($pista_calendario) {
		$this->pista_calendario = $pista_calendario;
    }
    
    
	
	


}
