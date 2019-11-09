<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class User {

	/**
	* The user name of the user
	* @var string
	*/
	private $id_usuario;

	/**
	* The user name of the user
	* @var string
	*/
	private $username;

	/**
	* The password of the user
	* @var string
	*/
	private $passwd;

	/**
	* The name of the user
	* @var string
	*/
	private $nombre;

	/**
	* The email of the user
	* @var string
	*/
	private $email;

	/**
	* The rol of the user
	* @var string
	*/
	private $rol;
   
	/**
	* The sex of the user
	* @var string
	*/
	private $sexo;

	/**
	* The level of the user
	* @var string
	*/
	private $nivel;
	
	/** 
	* The constructor
	*
	* @param string $username The name of the user
	* @param string $passwd The password of the user
	*/
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
	
	/**
	* Gets the username of this user
	*
	* @return string The username of this user
	*/
	public function getIdUsuario() {
		return $this->id_usuario;
	}

	/**
	* Sets the username of this user
	*
	* @param string $username The username of this user
	* @return void
	*/
	public function setIdUsuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}

	/**
	* Gets the username of this user
	*
	* @return string The username of this user
	*/
	public function getUsername() {
		return $this->username;
	}

	/**
	* Sets the username of this user
	*
	* @param string $username The username of this user
	* @return void
	*/
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getPasswd() {
		return $this->passwd;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setPasswd($passwd) {
		$this->passwd = $passwd;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getNombre() {
		return $this->nombre;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getEmail() {
		return $this->email;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getRol() {
		return $this->rol;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setRol($rol) {
		$this->rol = $rol;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getSexo() {
		return $this->sexo;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setSexo($sexo) {
		$this->sexo = $sexo;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getNivel() {
		return $this->nivel;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setNivel($nivel) {
		$this->nivel = $nivel;
	}

	/**
	* Checks if the current user instance is valid
	* for being registered in the database
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
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
