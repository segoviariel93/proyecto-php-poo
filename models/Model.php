<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author GiruSolutionsServer
 */
include_once 'models/imodel.php';

class Model {
    function __construct(){
        $this->db = $this->db= Database::connect();
    }

    function query($query){
        return $this->db->query($query);
    }

    function prepare($query){
        return $this->db->prepare($query);
    } //put your code here
}
