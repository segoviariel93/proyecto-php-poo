<?php

class Utils{
	public static function deleteSession($name){
		if(isset($_SESSION[$name])){
			$_SESSION[$name] = null;
			unset($_SESSION[$name]); //borra la sesion despues de hacer el registro de usuarios
		}
		
		return $name;
	}
	
	public static function isAdmin(){ //para admins logeados
		if(!isset($_SESSION['admin'])){
			header("Location:".base_url);
		}else{
			return true;
		}
	}
	
	public static function isIdentity(){ //par usuarios logeados
		if(!isset($_SESSION['identity'])){
			header("Location:".base_url);
		}else{
			return true;
		}
	}
        public static function GetIdentity(){ //par usuarios logeados
		if(!isset($_SESSION['identity'])){
			header("Location:".base_url);
		}else{                   
                    $usuario=$_SESSION['identity'];
			return $usuario;
		}
	}
	
	public static function showCategorias(){
		require_once 'models/categoria.php';
		$categoria = new Categoria();
		$categorias = $categoria->getAll();
		return $categorias;
	}
	
	
}
