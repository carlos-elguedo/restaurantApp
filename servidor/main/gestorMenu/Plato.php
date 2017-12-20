<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './AlimentoMenu.php';

class Plato extends AlimentoMenu{
    
    var $peso;
    var $dimensiones;
    
    public function __construct($peso, $dimensiones,$id, $nombre_producto, $precio, $descripcion, $tipo_producto) {
        $this->id = $id;
        $this->nombre_producto = $nombre_producto;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->tipo_producto = $tipo_producto;
        $this->peso = $peso;
        $this->dimensiones = $dimensiones;
        $this->tipo_producto = 1;
    }
    public function getPeso() {
        return $this->peso;
    }

    public function getDimensiones() {
        return $this->dimensiones;
    }

    public function setPeso($peso) {
        $this->peso = $peso;
    }

    public function setDimensiones($dimensiones) {
        $this->dimensiones = $dimensiones;
    }



}