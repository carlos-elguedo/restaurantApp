<?php
require_once ('Usuario.php');
require './pedidos/Pedido.php';

/**
 * @author Jhony Luna, Rafael Castellar Zamir Martelo
 * @version 1.0
 * @created 29-oct-2017 02:06:22 p.m.
 */

class Mesero extends Usuario{
    
    var $id;
    var $id_mesero;
    var $rutaImagen;
    var $direccion;
    

    function Trabajador_Independiente(){
        
    }
    public function __construct($datos) {
            parent::__construct($datos);
    }


    public function getId() {
        return $this->id;
    }

    public function getId_mesero() {
        return $this->id_mesero;
    }

    public function getRutaImagen() {
        return $this->rutaImagen;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setId_mesero($id_mesero) {
        $this->id_mesero = $id_mesero;
    }

    public function setRutaImagen($rutaImagen) {
        $this->rutaImagen = $rutaImagen;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function recibirPedido($pedido){
        
    }
    public function entregarPedido($pedido) {
        
    }
    



}
?>