<?php


require_once(__DIR__."/../core/ValidationException.php");

class User {


	private $id_usuario;


	private $username;


	private $passwd;


	private $nombre;


	private $email;


	private $rol;
   

	private $sexo;


	private $nivel;
	

	public function __construct($id_usuario=NULL, $username=NULL, $passwd=NULL, $nombre=NULL, $email=NULL,
	$rol=NULL, $sexo=NULL, $nivel=NULL ) {
		$this->id_usuario = $id_usuario;
		$this->username = $username;
		$this->passwd = $passwd;
		$this->nombre = $nombre;
		$this->email = $email;
		$this->rol = $rol;
		$this->sexo = $sexo;
		$this->nivel = $nivel;
	}
	

	public function getIdUsuario() {
		return $this->id_usuario;
	}


	public function setIdUsuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}


	public function getUsername() {
		return $this->username;
	}


	public function setUsername($username) {
		$this->username = $username;
	}


	public function getPasswd() {
		return $this->passwd;
	}


	public function setPasswd($passwd) {
		$this->passwd = $passwd;
	}


	public function getNombre() {
		return $this->nombre;
	}


	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	
	public function getEmail() {
		return $this->email;
	}


	public function setEmail($email) {
		$this->email = $email;
	}


	public function getRol() {
		return $this->rol;
	}


	public function setRol($rol) {
		$this->rol = $rol;
	}


	public function getSexo() {
		return $this->sexo;
	}


	public function setSexo($sexo) {
		$this->sexo = $sexo;
	}


	public function getNivel() {
		return $this->nivel;
	}


	public function setNivel($nivel) {
		$this->nivel = $nivel;
	}

	
public function checkIsValidForRegister() {
        $errors = array();
        $patternEmail="/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
        $patternDigitosyLetras="/^[-_a-zA-Z0-9.]+$/";
        $patterSoloLetras="/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
        
		if (strlen($this->username) < 5 || !preg_match($patternDigitosyLetras,$this->username)) {
			$errors["username"] = "El usuario debe tener al menos 5 caracteres y deben de ser sólo digitos o letras";
			
		}
		if (strlen($this->passwd) < 5 || !preg_match($patternDigitosyLetras,$this->passwd)) {
			$errors["passwd"] = "La contraseña debe tener al menos 5 caracteres y deben de ser sólo digitos o letras";
			
		}
		if (strlen($this->nombre) < 5 || !preg_match($patterSoloLetras,$this->nombre)) {
			$errors["nombre"] = "El nombre debe tener al menos 5 caracteres y deben de ser únicamente letras";
			
		}
		if (strlen($this->email) < 10 || !preg_match($patternEmail,$this->email)) {
			$errors["email"] = "El email debe tener al menos 10 caracteres";
			
		}
		if (strlen($this->sexo) < 5 ) {
			$errors["sexo"] = "Sex must be at least 5 characters length";
			
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
    }


}
