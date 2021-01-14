<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'config/parameters.php';
/**
 * Description of app
 *
 * @author GiruSolutionsServer
 */
class app
{
    public function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        /** @var type $url */
        $url = rtrim($url, '/');
        //var_dump($url);
        /*
            controlador->[0]
            metodo->[1]
            parameter->[2]
        */
        $url = explode('/', $url);

        if (empty($url[0]) && !isset($url[1])) {
            $nombre_controlador = controller_default;
            //$nombre_controlador = $url[0].'Controller';

        } elseif (!empty($url[0])) {
            $nombre_controlador = $url[0] . 'Controller';
        } elseif (!isset($url[0]) && !isset($url[1])) {
            $nombre_controlador = controller_default;
        } else {
            app::show_error();
            exit();
        }

        if (class_exists($nombre_controlador)) {

            echo '<script>';
            echo 'console.log(' . json_encode($nombre_controlador) . ')';
            echo '</script>';
            if (isset($_GET['success'])) {
                
                echo '<script>';
                echo 'window.onload=function(){';
                echo 'MostrarMensajeExitoso("'.$_GET['success']. '");';
                echo '};';
                echo '</script>';
            }
            if (isset($_GET['error'])) {
                
                echo '<script>';
                echo 'window.onload=function(){';
                echo 'MostrarMensajeError("'.$_GET['error']. '");';
                echo '};';
                echo '</script>';
            }
            $controlador = new $nombre_controlador();

            if (isset($url[1]) && method_exists($controlador, $url[1])) {
                $action = $url[1];

                if (isset($url[2])) {
                    //el método tiene parámetros
                    //sacamos e # de parametros
                    $nparam = sizeof($url) - 2;
                    //crear un arreglo con los parametros
                    $params = [];
                    //iterar
                    for ($i = 0; $i < $nparam; $i++) {
                        array_push($params, $url[$i + 2]);
                    }
                    //pasarlos al metodo   
                    $controlador->$action($params);
                    //$controller->{$url[1]}($params);
                } else {
                    $controlador->$action();
                }



                //$controlador->$action();
            } elseif (empty($url[0]) && !isset($url[1])) {
                $action_default = action_default;
                $controlador->$action_default();
            } else {
                //show_error();
                echo $nombre_controlador;
            }
        } else {
            App::show_error();
            //echo $nombre_controlador;
        }
    }
   public static function  show_error()
    {
        $error = new errorController();
        $error->index();
    }
    //put your code here
}
