<?php


require_once(__DIR__."/../core/ValidationException.php");

class Pago {

	private $id_pago;


    private $tipo_pago;
    
 
    private $estado_pago;
    

    private $cantidad;
    

	private $reserva_pago;

	
	
	
    public function __construct($id_pago=NULL, $tipo_pago=NULL, $estado_pago=NULL,
    $cantidad=NULL, $reserva_pago=NULL) {
		$this->id_pago = $id_pago;
        $this->tipo_pago = $tipo_pago;
        $this->estado_pago = $estado_pago;
        $this->cantidad = $cantidad;
        $this->reserva_pago = $reserva_pago;
	}
	

	public function getIdPago() {
		return $this->id_pago;
	}


	public function setIdPago($id_pago) {
		$this->id_pago = $id_pago;
	}

	
	public function getTipoPago() {
		return $this->tipo_pago;
	}


	public function setTipoPago($tipo_pago) {
		$this->tipo_pago = $tipo_pago;
    }
    
    

	public function getEstadoPago() {
		return $this->estado_pago;
	}


	public function setEstadoPago($estado_pago) {
		$this->estado_pago = $estado_pago;
    }
    
    

	public function getCantidad() {
		return $this->cantidad;
	}


	public function setCantidad($cantidad) {
		$this->cantidad = $cantidad;
    }
    
    

	public function getReservaPago() {
		return $this->reserva_pago;
	}


	public function setReservaPago($reserva_pago) {
		$this->reserva_pago = $reserva_pago;
	}


}
