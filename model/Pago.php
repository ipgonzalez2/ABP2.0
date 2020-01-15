<?php

require_once(__DIR__."/../core/ValidationException.php");

class Pago {


	private $id_pago;

	private $usuario_pago;

	private $precio;

	private $reserva_pago;

	private $partido_pago;

	private $campeonato_pago;

	private $clase_pago;

    private $estado_pago;

    private $fecha_valido;

	

	public function __construct($id_pago=NULL, $usuario_pago=NULL, $precio=NULL, $reserva_pago=NULL,
	$partido_pago=NULL, $campeonato_pago=NULL, $clase_pago=NULL, $estado_pago=null, $fecha_valido=NULL) {
		$this->id_pago = $id_pago;
		$this->usuario_pago = $usuario_pago;
		$this->precio = $precio;
		$this->reserva_pago = $reserva_pago;
		$this->partido_pago = $partido_pago;
		$this->campeonato_pago = $campeonato_pago;
		$this->clase_pago = $clase_pago;
        $this->estado_pago = $estado_pago;
        $this->fecha_valido = $fecha_valido;
	}
	
	
	public function getIdPago() {
		return $this->id_pago;
	}


	public function setIdPago($id_pago) {
		$this->id_pago = $id_pago;
	}


	public function getUsuarioPago() {
		return $this->usuario_pago;
	}


	public function setUsuarioPago($usuario_pago) {
		$this->usuario_pago = $usuario_pago;
	}


	public function getPrecio() {
		return $this->precio;
	}


	public function setPrecio($precio) {
		$this->precio = $precio;
	}


	public function getReservaPago() {
		return $this->reserva_pago;
	}


	public function setReservaPago($reserva_pago) {
		$this->reserva_pago = $reserva_pago;
	}


	public function getPartidoPago() {
		return $this->partido_pago;
	}


	public function setPartidoPago($partido_pago) {
		$this->partido_pago = $partido_pago;
	}

	public function getCampeonatoPago(){
		return $this->campeonato_pago;
	}

	public function setCampeonatoPago($campeonato_pago){
		$this->campeonato_pago = $campeonato_pago;
	}

	public function getClasePago(){
		return $this->clase_pago;
	}

	public function setClasePago($clase_pago){
		$this->clase_pago = $clase_pago;
	}

	public function getEstadoPago(){
		return $this->estado_pago;
	}

	public function setEstadoPago($estado_pago){
		$this->estado_pago = $estado_pago;
    }
    
    public function getFechaValido(){
        return $this->fecha_valido;
    }

    public function setFechaValido($fecha_valido){
        $this->fecha_valido = $fecha_valido;
    }

}
