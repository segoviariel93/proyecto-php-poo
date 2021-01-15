<?php

class Usuario extends Model implements IModel{
	private $id;
	private $nombre;
	private $apellidos;
	private $email;
	private $password;
	private $rol;

	
	
	public function __construct() {
            parent::__construct();
	}
	
	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getApellidos() {
		return $this->apellidos;
	}

	function getEmail() {
		return $this->email;
	}

	function getPassword() {
		return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
	}

	function getRol() {
		return $this->rol;
	}

	function getImagen() {
		return $this->imagen;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setApellidos($apellidos) {
		$this->apellidos = $this->db->real_escape_string($apellidos);
	}

	function setEmail($email) {
		$this->email = $this->db->real_escape_string($email);
	}

	function setPassword($password) {
		$this->password = $password;
	}

	function setRol($rol) {
		$this->rol = $rol;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	public function save(){
		$error='';
		//aqui se consilta por repetidos
		$sqls = "SELECT * FROM usuarios WHERE email='{$this->getEmail()}' ";
		$saves = $this->db->query($sqls);

		if($saves->num_rows>=1){
			$error="Duplicate entry";
			return $error;
		}
	
		//aqui se guarda
		$sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}',CURDATE(),'user');";
			
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function login(){
		$result = false;
		$email = $this->email;
		$password = $this->password;
		
		// Comprobar si existe el usuario
		$sql = "SELECT * FROM usuarios WHERE email = '$email'";
		$login = $this->db->query($sql);

		if($login && $login->num_rows >= 1){ //verificar con un solo email
			$usuario = $login->fetch_object();
			
			// Verificar la contraseña
			$verify = password_verify($password, $usuario->password);
			
			

			if($verify){
				$result = $usuario;
			}
		}
		
		return $result;
	}

    public function delete($id) {
        
    }

    public function from($array) {
        
    }

    public function get($id) {
        
    }

    public function getAll() {
        
    }

    public function update() {
        
    }

}