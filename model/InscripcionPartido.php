<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class InscripcionPartido {

	/**
	* The reservation name of the reservation
	* @var string
	*/
	private $id_inscripcion_partido;

	/**
	* The reservation name of the reservation
	* @var string
	*/
    private $id_inscripcion_usuario;
    
   
	
	/** 
	* The constructor
	*
	* @param string $id_inscripcion_usuario The name of the reservation
	* @param string $Precio The password of the reservation
	*/
    public function __construct($id_inscripcion_partido=NULL, $id_inscripcion_usuario=NULL) {
		$this->id_inscripcion_partido = $id_inscripcion_partido;
        $this->id_inscripcion_usuario = $id_inscripcion_usuario;
	}
	
	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getIdInscripcionPartido() {
		return $this->id_inscripcion_partido;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $id_inscripcion_usuario The tipoPista of this reservation
	* @return void
	*/
	public function setIdInscripcionPartido($id_inscripcion_partido) {
		$this->id_inscripcion_partido = $id_inscripcion_partido;
	}

	/**
	* Gets the tipoPista of this reservation
	*
	* @return string The tipoPista of this reservation
	*/
	public function getIdInscripcionUsuario() {
		return $this->id_inscripcion_usuario;
	}

	/**
	* Sets the tipoPista of this reservation
	*
	* @param string $id_inscripcion_usuario The tipoPista of this reservation
	* @return void
	*/
	public function setIdInscripcionUsuario($id_inscripcion_usuario) {
		$this->id_inscripcion_usuario = $id_inscripcion_usuario;
    }
    
    
	
	
	

}
