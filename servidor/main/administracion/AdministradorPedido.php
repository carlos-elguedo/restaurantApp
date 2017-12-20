<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../pedidos/Pedido.php';

class AdministradorPedido{
    
    var $id;
    var $pedido;
    
    public function __construct($id, $pedido) {
        $this->id = $id;
        $this->pedido = $pedido;
    }

    
    public function confirmarPedido($pedido) {
        
    }
    
    public function recibirPedido($pedido) {
        
    }
    
    public function entregarPedido($pedido) {
        //$pedido = $entregar;
    }
    
    public function Pedido($pedido) {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getPedido() {
        return $this->pedido;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPedido($pedido) {
        $this->pedido = $pedido;
    }
    
}