<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EntradaController
 *
 * @author GiruSolutionsServer
 */
require_once 'models/Entrada.php';
require_once 'models/categoria.php';
require_once 'views/susscess.php';
class EntradaController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function create()
    {
        try {
            if (Utils::isIdentity()) {
                if ($this->existPOST(['categoria_id', 'titulo', 'descripcion'])) {
                    $entrada = new Entrada();
                    $entrada->setCategoria_id($_POST['categoria_id']);
                    $entrada->setUsuario_id(Utils::GetIdentity()->id);
                    $entrada->setTitulo($_POST['titulo']);
                    $entrada->setDescripcion($_POST['descripcion']);
                    $entrada->save();
                    $catedoria_idSeleccionada = $entrada->getCategoria_id();
                    $entradas = $entrada->getByCategoria($entrada->getCategoria_id());
                   // require_once 'views/entrada/index.php';
                    $this->redirect('entrada/listaPorCategoria/' . $entrada->getCategoria_id(), ['success' => 'registro Correcto']);
                }
            } else {
                $this->redirect('usuario', ['error' => 'usuario No autentificado']);
            }
        } catch (Exception $e) {
            error_log("EntradaController::create => error ".$e);
            $this->redirect('', []);
        }
        
    }

    function listaPorCategoria($categoria_id)
    {
        /** @var type $_GET */
        // =$_GET["categoria_id"];
        $catedoria_idSeleccionada = $categoria_id[0];
        $entrada = new  Entrada();
        $entradas = $entrada->getByCategoria($catedoria_idSeleccionada);
        require_once 'views/entrada/index.php';
    }
    function update()
    {
        if ($this->existPOST(['id', 'titulo', 'descripcion'])) {
            $id = $this->getPost('id');
            $entrada = new Entrada();
            $entrada->get($id);
            $entrada->setDescripcion($this->getPost('descripcion'));
            $entrada->setTitulo($this->getPost('titulo'));
            $entrada->update();
            $this->redirect('entrada/listaPorCategoria/' . $entrada->getCategoria_id(), ['success' => 'Actualizacion Correcta']);
        }
    }
    function delete($id)
    {
        $idD = is_string($id[0]) ? intval($id[0]) : $id;
        $entrada = new Entrada();
        $entrada->get($idD);
        $catedoria_idSeleccionada = $entrada->getCategoria_id();
        $entrada->delete($idD);
        $this->redirect('entrada/listaPorCategoria/' . $catedoria_idSeleccionada, ['success' => 'Eliminación Correcta']);
    }


    //put your code here
}
