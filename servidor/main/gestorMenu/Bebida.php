<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './AlimentoMenu.php';

class Bebida extends AlimentoMenu{
    
    var $litros;
    var $dimensiones;
    
    public function __construct($litros, $dimensiones,$id, $nombre_producto, $precio, $descripcion, $tipo_producto) {
        $this->id = $id;
        $this->nombre_producto = $nombre_producto;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->tipo_producto = $tipo_producto;
        $this->litros = $litros;
        $this->dimensiones = $dimensiones;
        $this->tipo_producto = 2;
    }
    public function getlitros() {
        return $this->litros;
    }

    public function getDimensiones() {
        return $this->dimensiones;
    }

    public function setlitros($litros) {
        $this->litros = $litros;
    }

    public function setDimensiones($dimensiones) {
        $this->dimensiones = $dimensiones;
    }



}