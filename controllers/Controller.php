<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author GiruSolutionsServer
 */
class Controller{

    function __construct(){
        $this->view = new View();
    }

    function loadModel($model){
        $url = 'models/'.$model.'.php';

        if(file_exists($url)){
            require_once $url;

            $modelName = $model.'';
            $this->model = new $modelName();
        }
    }

    function existPOST($params){
        if (!isset($_POST)) {
            return false;
        }
        foreach ($params as $param) {
            if(!isset($_POST[$param])){
                error_log("ExistPOST: No existe el parametro $param" );
                return false;
            }
        }
        error_log( "ExistPOST: Existen parámetros" );
        return true;
    }

    function existGET($params){
        if (!isset($_GET)) {
            return false;
        }
        foreach ($params as $param) {
            if(!isset($_GET[$param])){
                return false;
            }
        }
        return true;
    }

    function getGet($name){
        return $_GET[$name];
    }

    function getPost($name){
        return $_POST[$name];
    }

    function redirect($url, $mensajes = []){
        $data = [];
        $params = '';
        
        foreach ($mensajes as $key => $value) {
            array_push($data, $key . '=' . $value);
        }
        $params = join('&', $data);
        
        if($params != ''){
            $params = '?' . $params;
        }
        header('location: ' . constant('base_url') . $url . $params);
    }
}
?>