<?php
require_once 'models/usuario.php';

class usuarioController{
	
	public function index(){
		require_once 'views/usuario/inicio.php';
	}
	
	public function registro(){
		require_once 'views/usuario/registro.php';
	}
	
	public function save(){
		 if(isset($_POST)){
			$nombre = (isset($_POST['nombre']) && $_POST['nombre']!="") ? $_POST['nombre'] : false;
			$apellidos = (isset($_POST['apellidos']) && $_POST['apellidos']!="") ? $_POST['apellidos'] : false;
			$email = (isset($_POST['email']) && $_POST['email']!="" && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ? $_POST['email'] : false;
			$password = (isset($_POST['password']) && $_POST['password']!="") ? $_POST['password'] : false;
			
		
			
			if($nombre && $apellidos && $email && $password){
				$usuario = new Usuario();
				$usuario->setNombre($nombre);
				$usuario->setApellidos($apellidos);
				$usuario->setEmail($email);
				$usuario->setPassword($password);

				$save = $usuario->save();
				
				if($save===true){
					
					$_SESSION['register'] = "complete";
				}else if($save=="Duplicate entry"){
					$_SESSION['register'] = "emailDuplicado";
				
				}else{
					$_SESSION['register'] = "failed";
				}
			}
			else if($email===false){
				$_SESSION['register'] = "failedEmail";
			}
			else{
				$_SESSION['register'] = "failed";
			}
		}else{
			$_SESSION['register'] = "failed";
		}

		
	
		header("Location:".base_url.'usuario/registro'); 
	}
	
	public function login(){
		
		if(isset($_POST)){
			// Identificar al usuario
			// Consulta a la base de datos
			$usuario = new Usuario();
			$usuario->setEmail($_POST['email']);
			$usuario->setPassword($_POST['password']);
			
			$identity = $usuario->login();
			if($identity && is_object($identity)){
				$_SESSION['identity'] = $identity;
				if($identity->rol == 'admin'){// resvisa si es admonostrador
					$_SESSION['admin'] = true;
				}
				
			}else{
				$_SESSION['error_login'] = 'Identificación fallida !!';
			}
		
		}
		header("Location:".base_url);
	}
	
	public function logout(){
		if(isset($_SESSION['identity'])){
			unset($_SESSION['identity']);
		}
		
		if(isset($_SESSION['admin'])){
			unset($_SESSION['admin']);
		}
		
		header("Location:".base_url);
	}
	
} // fin clase