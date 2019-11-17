<?php
// file: model/Calendario.php

require_once(__DIR__."/../core/ValidationException.php");

class Calendario {

    private $fecha_calendario;

    private $estado_calendario;
    
	private $hora_calendario;

	private $pista_calendario;
	

	
	
	/** 
	* The constructor
	*/
    public function __construct($fecha_calendario=NULL,$pista_calendario=NULL, $estado_calendario=NULL,
    $hora_calendario=NULL) {
		$this->fecha_calendario = $fecha_calendario;
		$this->pista_calendario = $pista_calendario;
        $this->estado_calendario = $estado_calendario;
		$this->hora_calendario = $hora_calendario;
	}
	
	public function getFechaCalendario() {
		return $this->fecha_calendario;
	}

	public function setFechaCalendario($fecha_calendario) {
		$this->fecha_calendario = $fecha_calendario;
	}
	
	public function getPistaCalendario() {
		return $this->pista_calendario;
	}

	public function setPistaCalendario($pista_calendario) {
		$this->pista_calendario = $pista_calendario;
    }
    
	public function getEstadoCalendario() {
		return $this->estado_calendario;
	}

	public function setEstadoCalendario($estado_calendario) {
		$this->estado_calendario = $estado_calendario;
    }
    
	public function gethoraCalendario() {
		return $this->hora_calendario;
	}

	public function sethoraCalendario($hora_calendario) {
		$this->hora_calendario = $hora_calendario;
	}  
	
}
