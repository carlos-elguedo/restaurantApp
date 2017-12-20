<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ('Menu.php');

/**
 * @author laboratorio sof 1
 * @version 1.0
 * @created 29-oct-2016 02:06:22 p.m.
 */
class AlimentoMenu{
    var $id;
    var $nombre_producto;
    var $precio;
    var $descripcion;
    var $tipo_producto;
    
    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre_producto() {
        return $this->nombre_producto;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getTipo_producto() {
        return $this->tipo_producto;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre_producto($nombre_producto) {
        $this->nombre_producto = $nombre_producto;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setTipo_producto($tipo_producto) {
        $this->tipo_producto = $tipo_producto;
    }



}