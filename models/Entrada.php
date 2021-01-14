<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Entrada
 *
 * @author GiruSolutionsServer
 */
class Entrada extends Model implements IModel {

    private $id;
    private $usuario_id;
    private $categoria_id;
    private $titulo;
    private $descripcion;
    private $fecha;

    public function __construct() {
        parent::__construct();
    }

    function getId() {
        return $this->id;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getCategoria_id() {
        return $this->categoria_id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setUsuario_id($usuario_id): void {
        $this->usuario_id = $usuario_id;
    }

    function setCategoria_id($categoria_id): void {
        $this->categoria_id = $categoria_id;
    }

    function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }

    function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    function save() {
        $sql = "INSERT INTO entradas(usuario_id,categoria_id,titulo,descripcion,fecha) VALUES(" . $this->usuario_id . " ," . $this->categoria_id . " ,'" . $this->titulo . "' ,'" . $this->descripcion . "' ,NOW());";
        $save = $this->db->query($sql);
        return $save;
    }

    public function getAll() {
        $entradas=[];
        $resultado= $this->query("SELECT * FROM entradas ORDER BY id DESC;");
        while ($row = mysqli_fetch_assoc($resultado)) {
            $entrada=new Entrada();
            $entrada->from($row) ;
            array_push($entradas, $entrada);
         }
         return $entradas;
    }

    public function getByCategoria($categoria_id) {        
        try {
            $entradas=[];
            //$entradas = $this->db->query("SELECT * FROM entradas ORDER BY id DESC;");
            $resultado = $this->query('SELECT * FROM entradas e WHERE e.categoria_id='. $categoria_id);
            while ($row = mysqli_fetch_assoc($resultado)) {
               $entrada=new Entrada();
               $entrada->from($row) ;
               array_push($entradas, $entrada);
            }
            return $entradas;

            
        } catch (PDOException $exc) {
            error_log('Entrada::getByCategoria' . $exc); // echo $exc->getTraceAsString();
        }
    }

    public function delete($id) {
        $idBorrar= is_string($id)?intval($id):$id;
        $query = $this->query("delete FROM entradas WHERE id={$idBorrar}");            
        return $query;
    }

    public function from($array) {
        $this->id = $array['id'];
        $this->usuario_id = $array['usuario_id'];
        $this->categoria_id = $array['categoria_id'];
        $this->titulo = $array['titulo'];
        $this->descripcion = $array['descripcion'];
        $this->fecha = $array['fecha'];
    }

    public function get($id) {
       
        $query = $this->query("SELECT * FROM entradas WHERE id=".$id);            
        $array= mysqli_fetch_assoc($query);
        $this->from($array);
    }

    public function update() {
        $query = $this->query("update  entradas  
        set titulo='".$this->titulo."' ,descripcion='".$this->descripcion. "' ,fecha='".$this->fecha.
        "' WHERE id=".$this->id);        
            return true;
    }

//put your code here
}
