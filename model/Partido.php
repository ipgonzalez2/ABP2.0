<?php

require_once(__DIR__."/../core/ValidationException.php");

class Partido {


	private $id_partido;


    private $fecha_partido;
    

    private $precio_partido;
    

    private $estado_partido;


	private $fecha_fin_inscripcion;
	
	private $hora_partido;
	
	

    public function __construct($id_partido=NULL, $fecha_partido=NULL, $precio_partido=NULL,
    $estado_partido=NULL, $fecha_fin_inscripcion=NULL, $hora_partido=NULL) {
		$this->id_partido = $id_partido;
        $this->fecha_partido = $fecha_partido;
        $this->precio_partido = $precio_partido;
        $this->estado_partido = $estado_partido;
		$this->fecha_fin_inscripcion = $fecha_fin_inscripcion;
		$this->hora_partido = $hora_partido;
	}
	

	public function getIdPartido() {
		return $this->id_partido;
	}


	public function setIdPartido($id_partido) {
		$this->id_partido = $id_partido;
	}


	public function getFechaPartido() {
		return $this->fecha_partido;
	}


	public function setFechaPartido($fecha_partido) {
		$this->fecha_partido = $fecha_partido;
    }
    
    

	public function getPrecioPartido() {
		return $this->precio_partido;
	}


	public function setPrecioPartido($precio_partido) {
		$this->precio_partido = $precio_partido;
    }

 
	public function getEstadoPartido() {
		return $this->estado_partido;
	}


	public function setEstadoPartido($estado_partido) {
		$this->estado_partido = $estado_partido;
    }


	public function getFechaFinInscripcion() {
		return $this->fecha_fin_inscripcion;
	}


	public function setFechaFinInscripcion($fecha_fin_inscripcion) {
		$this->fecha_fin_inscripcion = $fecha_fin_inscripcion;
	}

	public function getHoraPartido() {
		return $this->hora_partido;
	}


	public function setHoraPartido($hora_partido) {
		$this->hora_partido = $hora_partido;
	}
	
	public function checkIsValidForRegister() {
		$errors = array();
		$fechaActual = date('d-m-Y');

		if (strlen($this->fecha_partido) < 11 || $this->fecha_partido<$fechaActual || $this->fecha_partido<$this->fecha_fin_inscripcion) {
			$errors["fecha_partido"] = "Debe tener al menos 11 caracteres y no puede ser anterior al dia de hoy";

		}
		if (strlen($this->fecha_fin_inscripcion) < 11 || $this->fecha_fin_inscripcion<$fechaActual || $this->fecha_fin_inscripcion>$this->fecha_partido) {
			$errors["fecha_fin_inscripcion"] = "La fecha de inscripcion debe tener al menos 11 caracteres y no puede ser anterior al dia de hoy";
		}
		if (strlen($this->precio_partido) < 2) {
			$errors["precio_partido"] = "El precio del partido debe tener al menos 2 caracteres";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}



}
