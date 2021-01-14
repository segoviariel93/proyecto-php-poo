<?php

class Categoria extends Model implements IModel{
	private $id;
	private $nombre;
	
	
	public function __construct() {
		parent::__construct();
		//coneccion con la base de daros echa
	}
	
	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	public function getAll(){
		$categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
		return $categorias;
	}
	
	public function getOne(){
		$categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()}");
		$array= mysqli_fetch_assoc($categoria);
        $this->from($array);
		return ;
	}
	
	public function save(){
		$sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}');";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

    public function delete($id) {
        
    }

    public function from($array) {
		$this->id = $array['id'];
        $this->nombre = $array['nombre'];
    }

    public function get($id) {
	 $id=is_string($id)?intval($id):$id;
        $query = $this->query("SELECT * FROM categorias WHERE id={$id}");            
        $array= mysqli_fetch_assoc($query);
        $this->from($array);
    }

    public function update() {
        
    }

}