<?php

require_once(__DIR__."/../core/ValidationException.php");

class Clase {

	private $id_clase;

    private $usuario_clase;
    
    private $precio;
    
	private $duracion;
	
	private $estado;
	
	private $comentario;
	

    public function __construct($id_clase=NULL, $usuario_clase=NULL,
    $precio=NULL, $duracion=NULL, $estado=NULL, $comentario=NULL) {
        $this->usuario_clase = $usuario_clase;
        $this->precio = $precio;
		$this->duracion = $duracion;
		$this->id_clase = $id_clase;
		$this->estado = $estado;
		$this->comentario = $comentario;
	}

	public function getIdClase() {
		return $this->id_clase;
	}

	public function setIdClase($id_clase) {
		$this->id_clase = $id_clase;
    }

	public function getUsuarioClase() {
		return $this->usuario_clase;
	}

	public function setUsuarioClase($usuario_clase) {
		$this->usuario_clase = $usuario_clase;
    }
    
	public function getPrecio() {
		return $this->precio;
	}

	public function setPrecio($precio) {
		$this->precio = $precio;
    }

	public function getDuracion() {
		return $this->duracion;
	}

	public function setDuracion($duracion) {
		$this->duracion = $duracion;
	}

	public function getEstado() {
		return $this->estado;
	}

	public function setEstado($estado) {
		$this->estado = $estado;
	}
	
	public function getComentario() {
		return $this->comentario;
	}

	public function setComentario($comentario) {
		$this->comentario = $comentario;
    }

    
	
}
