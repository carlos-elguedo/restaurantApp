<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author laboratorio sof 1
 * @version 1.0
 * @created 29-oct-2016 02:06:22 p.m.
 */
class Menu{
    
    var $nombre_menu;
    var $id_menu;
    
    public function __construct($nombre_menu, $id_menu) {
        $this->nombre_menu = $nombre_menu;
        $this->id_menu = $id_menu;
    }
    public function getNombre_menu() {
        return $this->nombre_menu;
    }

    public function getId_menu() {
        return $this->id_menu;
    }

    public function setNombre_menu($nombre_menu) {
        $this->nombre_menu = $nombre_menu;
    }

    public function setId_menu($id_menu) {
        $this->id_menu = $id_menu;
    }

    

    
}