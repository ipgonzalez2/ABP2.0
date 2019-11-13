<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class Calendario {


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
	private $hora_calendario;
	

	
	
	/** 
	* The constructor
	*
	* @param string $fecha_calendario The name of the reservation
	* @param string $Precio The password of the reservation
	*/
    public function __construct($fecha_calendario=NULL, $estado_calendario=NULL,
    $hora_calendario=NULL) {
        $this->fecha_calendario = $fecha_calendario;
        $this->estado_calendario = $estado_calendario;
		$this->hora_calendario = $hora_calendario;
	}
	

	

	/**
	* Gets the tipohora of this reservation
	*
	* @return string The tipohora of this reservation
	*/
	public function getFechaCalendario() {
		return $this->fecha_calendario;
	}

	/**
	* Sets the tipohora of this reservation
	*
	* @param string $fecha_calendario The tipohora of this reservation
	* @return void
	*/
	public function setFechaCalendario($fecha_calendario) {
		$this->fecha_calendario = $fecha_calendario;
    }
    
    
	/**
	* Gets the tipohora of this reservation
	*
	* @return string The tipohora of this reservation
	*/
	public function getEstadoCalendario() {
		return $this->estado_calendario;
	}

	/**
	* Sets the tipohora of this reservation
	*
	* @param string $fecha_calendario The tipohora of this reservation
	* @return void
	*/
	public function setEstadoCalendario($estado_calendario) {
		$this->estado_calendario = $estado_calendario;
    }
    
    
	/**
	* Gets the tipohora of this reservation
	*
	* @return string The tipohora of this reservation
	*/
	public function gethoraCalendario() {
		return $this->hora_calendario;
	}

	/**
	* Sets the tipohora of this reservation
	*
	* @param string $fecha_calendario The tipohora of this reservation
	* @return void
	*/
	public function sethoraCalendario($hora_calendario) {
		$this->hora_calendario = $hora_calendario;
	}
	

    
    
	
	


}
