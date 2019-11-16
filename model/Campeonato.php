<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class Campeonato {

	/**
	* The reservation name of the reservation
	* @var string
	*/
	private $id_campeonato;

	/**
	* The reservation name of the reservation
	* @var string
	*/
    private $nombre_campeonato;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $fecha_inicio;

    private $fecha_fin;
    
    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $precio_campeonato;

    /**
	* The reservation name of the reservation
	* @var string
	*/
    private $fecha_limite_inscripcion;

    private $estado_campeonato;
	
	
	/** 
	* The constructor
	*
	* @param string $nombre_campeonato The name of the reservation
	* @param string $Precio The password of the reservation
	*/
    public function __construct($id_campeonato=NULL, $nombre_campeonato=NULL, $fecha_inicio=NULL,
    $fecha_fin=NULL,$precio_campeonato=NULL,$fecha_limite_inscripcion=NULL,$estado_campeonato=NULL) {
		$this->id_campeonato = $id_campeonato;
        $this->nombre_campeonato = $nombre_campeonato;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->precio_campeonato = $precio_campeonato;
        $this->fecha_limite_inscripcion = $fecha_limite_inscripcion;
        $this->estado_campeonato = $estado_campeonato;
	}
	
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getIdCampeonato() {
		return $this->id_campeonato;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $nombre_campeonato The tipoPista of this reservation
	* @return void
	*/
	public function setIdCampeonato($id_campeonato) {
		$this->id_campeonato = $id_campeonato;
	}

	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getNombreCampeonato() {
		return $this->nombre_campeonato;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $nombre_campeonato The tipoPista of this reservation
	* @return void
	*/
	public function setNombreCampeonato($nombre_campeonato) {
		$this->nombre_campeonato = $nombre_campeonato;
    }
    
    
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getFechaInicio() {
		return $this->fecha_inicio;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $nombre_campeonato The tipoPista of this reservation
	* @return void
	*/
	public function setFechaInicio($fecha_inicio) {
		$this->fecha_inicio = $fecha_inicio;
    }

    public function getFechaFin() {
		return $this->fecha_fin;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $nombre_campeonato The tipoPista of this reservation
	* @return void
	*/
	public function setFechaFin($fecha_fin) {
		$this->fecha_fin = $fecha_fin;
    }

    /**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getPrecioCampeonato() {
		return $this->precio_campeonato;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $nombre_campeonato The tipoPista of this reservation
	* @return void
	*/
	public function setPrecioCampeonato($precio_campeonato) {
		$this->precio_campeonato = $precio_campeonato;
    }

    /**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getFechaLimiteInscripcion() {
		return $this->fecha_limite_inscripcion;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $nombre_campeonato The tipoPista of this reservation
	* @return void
	*/
	public function setFechaLimiteInscripcion($fecha_limite_inscripcion) {
        $this->fecha_limite_inscripcion = $fecha_limite_inscripcion;
	}
    
    public function getEstadoCampeonato() {
		return $this->estado_campeonato;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $nombre_campeonato The tipoPista of this reservation
	* @return void
	*/
	public function setEstadoCampeonato($estado_campeonato) {
        $this->estado_campeonato = $estado_campeonato;
    }
    
	public function checkIsValidForRegister() {
		$errors = array();
		 $patterSoloLetras="/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
		 $fechaActual = date('d-m-Y');


		if (strlen($this->nombre_campeonato) < 11 || !preg_match($patterSoloLetras,$this->nombre_campeonato)) {
			$errors["nombre_campeonato"] = "El nombre del campeonato debe tener al menos 11 caracteres y deben de ser únicamente letras";

		}

		if (strlen($this->fecha_fin_inscripcion) < 11 || $this->fecha_fin_inscripcion<$fechaActual || $this->fecha_fin_inscripcion>$this->fecha_inicio) {
			$errors["fecha_fin_inscripcion"] = "La fecha de fin de inscripcion es incorrecta o es anterior al dia de hoy";

		}

		if (strlen($this->fecha_inicio) < 2 || $this->fecha_inicio<$fechaActual || $this->fecha_inicio<$this->fecha_fin_inscripcion ) {

			$errors["fecha_inicio"] = "La fecha de inicio es incorrecta";
		}

		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}


}
