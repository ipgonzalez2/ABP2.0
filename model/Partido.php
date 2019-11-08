<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class Partido {

	/**
	* The reservation name of the reservation
	* @var string
	*/
	private $id_partido;

	/**
	* The reservation name of the reservation
	* @var string
	*/
    private $fecha_partido;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $precio_partido;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $estado_partido;

    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $fecha_fin_inscripcion;
	
	
	/** 
	* The constructor
	*
	* @param string $fecha_partido The name of the reservation
	* @param string $Precio The password of the reservation
	*/
    public function __construct($id_partido=NULL, $fecha_partido=NULL, $precio_partido=NULL,
    $estado_partido=NULL, $fecha_fin_inscripcion=NULL) {
		$this->id_partido = $id_partido;
        $this->fecha_partido = $fecha_partido;
        $this->precio_partido = $precio_partido;
        $this->estado_partido = $estado_partido;
        $this->fecha_fin_inscripcion = $fecha_fin_inscripcion;
	}
	
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getIdPartido() {
		return $this->id_partido;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $fecha_partido The tipoPista of this reservation
	* @return void
	*/
	public function setIdPartido($id_partido) {
		$this->id_partido = $id_partido;
	}

	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getFechaPartido() {
		return $this->fecha_partido;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $fecha_partido The tipoPista of this reservation
	* @return void
	*/
	public function setFechaPartido($fecha_partido) {
		$this->fecha_partido = $fecha_partido;
    }
    
    
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getPrecioPartido() {
		return $this->precio_partido;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $fecha_partido The tipoPista of this reservation
	* @return void
	*/
	public function setPrecioPartido($precio_partido) {
		$this->precio_partido = $precio_partido;
    }

    /**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getEstadoPartido() {
		return $this->estado_partido;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $fecha_partido The tipoPista of this reservation
	* @return void
	*/
	public function setEstadoPartido($estado_partido) {
		$this->estado_partido = $estado_partido;
    }

    /**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getFechaFinInscripcion() {
		return $this->fecha_fin_inscripcion;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $fecha_partido The tipoPista of this reservation
	* @return void
	*/
	public function setFechaFinInscripcion($fecha_fin_inscripcion) {
		$this->fecha_fin_inscripcion = $fecha_fin_inscripcion;
	}
	
	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->fecha_partido) < 11) {
			$errors["username"] = "Username must be at least 5 characters length";

		}
		if (strlen($this->fecha_fin_inscripcion) < 11) {
			$errors["passwd"] = "Password must be at least 5 characters length";
		}
		if (strlen($this->precio_partido) < 2) {
			$errors["nombre"] = "Name must be at least 5 characters length";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}


}