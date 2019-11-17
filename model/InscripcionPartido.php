<?php

require_once(__DIR__."/../core/ValidationException.php");

class InscripcionPartido {

	private $id_inscripcion_partido;

    private $id_inscripcion_usuario;
    
    public function __construct($id_inscripcion_partido=NULL, $id_inscripcion_usuario=NULL) {
		$this->id_inscripcion_partido = $id_inscripcion_partido;
        $this->id_inscripcion_usuario = $id_inscripcion_usuario;
	}

	public function getIdInscripcionPartido() {
		return $this->id_inscripcion_partido;
	}

	public function setIdInscripcionPartido($id_inscripcion_partido) {
		$this->id_inscripcion_partido = $id_inscripcion_partido;
	}

	public function getIdInscripcionUsuario() {
		return $this->id_inscripcion_usuario;
	}

	public function setIdInscripcionUsuario($id_inscripcion_usuario) {
		$this->id_inscripcion_usuario = $id_inscripcion_usuario;
    }
    
    
	
	
	

}
