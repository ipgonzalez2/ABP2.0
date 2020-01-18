<?php

require_once(__DIR__."/../core/ValidationException.php");

class Reserva {


	private $id_reserva;

	private $fecha;

	private $precio;

	private $usuario_reserva;

	private $pista_reserva;

	private $hora;

	private $partido_reserva;

	private $enfrentamiento;

	private $clase;

	

	public function __construct($id_reserva=NULL, $fecha=NULL, $precio=NULL, $usuario_reserva=NULL,
	$pista_reserva=NULL, $hora=NULL, $partido_reserva=NULL, $enfrentamiento=null, $clase=null) {
		$this->id_reserva = $id_reserva;
		$this->fecha = $fecha;
		$this->precio = $precio;
		$this->usuario_reserva = $usuario_reserva;
		$this->pista_reserva = $pista_reserva;
		$this->hora = $hora;
		$this->partido_reserva = $partido_reserva;
		$this->enfrentamiento = $enfrentamiento;
		$this->clase = $clase;
	}
	
	
	public function getIdReserva() {
		return $this->id_reserva;
	}


	public function setIdReserva($id_reserva) {
		$this->id_reserva = $id_reserva;
	}


	public function getFecha() {
		return $this->fecha;
	}


	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}


	public function getPrecio() {
		return $this->precio;
	}


	public function setPrecio($precio) {
		$this->precio = $precio;
	}


	public function getUsuarioReserva() {
		return $this->usuario_reserva;
	}


	public function setUsuarioReserva($usuario_reserva) {
		$this->usuario_reserva = $usuario_reserva;
	}


	public function getPistaReserva() {
		return $this->pista_reserva;
	}


	public function setPistaReserva($pista_reserva) {
		$this->pista_reserva = $pista_reserva;
	}

	public function getHora(){
		return $this->hora;
	}

	public function setHora($hora){
		$this->hora = $hora;
	}

	public function getPartidoReserva(){
		return $this->partido_reserva;
	}

	public function setPartidoReserva($partido_reserva){
		$this->partido_reserva = $partido_reserva;
	}

	public function getEnfrentamiento(){
		return $this->enfrentamiento;
	}

	public function setEnfrentamiento($enfrentamiento){
		$this->enfrentamiento = $enfrentamiento;
	}

	public function getClase(){
		return $this->clase;
	}

	public function setClase($clase){
		$this->clase = $clase;
	}


	public function checkIsValidForRegister() {
		$errors = array();
		$fechaActual = date('d-m-Y');

		if (strlen($this->fecha) < 5 || $this->fecha<$fechaActual  ) {
			$errors["fecha"] = "La fecha debe tener al menos 5 caracteres y no puede ser anterior al dia de hoy";

		}
		if (strlen($this->precio) < 1) {
			$errors["precio"] = "El precio debe tener al menos un caracter";
		}
		if (strlen($this->pista_reserva) < 1) {
			$errors["pista_reserva"] = "Debe tener al menos un caracter";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "reservation is not valid");
		}

	}
}
