<?php


/**
 * @author laboratorio sof 1
 * @version 1.0
 * @created 29-oct-2016 02:06:22 p.m.
 */
class Pedido{
    
    var $id_pedido;
    var $canasta;
    var $cliente;
    var $tamanio;
    var $cadena_identificadora;
    
    
    function __construct($id, $id_cliente, $cad) {
        $this->canasta = array("numero" => array(
            "id_producto" => "",
            "nombre_producto" => "",
            "comentario_producto" => "",
            "precio_producto" => "",
            "descripcion_producto" => "",
            "cantidad_producto" => "",
            "estado_recibido_cliente" => "",
            "estado_recibido_mesero" => "",
            "estado" => "",
            "imagen" => ""
        ));
        $this->id_pedido = $id;
        $this->cliente = $id_cliente;
        $this->tamanio = 0;
        $this->cadena_identificadora = $cad;
        
        
    }//Fin del constructor
    
    
    
    public function agregarProducto($datos){
        $this->canasta[$this->tamanio]["id_producto"] = $datos["id_producto"];
        $this->canasta[$this->tamanio]["nombre_producto"] = $datos["nombre_producto"];
        $this->canasta[$this->tamanio]["comentario_producto"] = $datos["comentario_producto"];
        $this->canasta[$this->tamanio]["precio_producto"] = $datos["precio_producto"];
        $this->canasta[$this->tamanio]["descripcion_producto"] = $datos["descripcion_producto"];
        $this->canasta[$this->tamanio]["cantidad_producto"] = $datos["cantidad_producto"];
        $this->canasta[$this->tamanio]["estado_recibido_cliente"] = $datos["estado_recibido_cliente"];
        $this->canasta[$this->tamanio]["estado"] = $datos["estado"];
        $this->canasta[$this->tamanio]["imagen"] = $datos["imagen"];
        
        $this->tamanio++;
    }
            
    
    
    public function generarTotalAPagar(){
        $total = 0;
        for($i = 0; $this->tamanio; $i++){
            $total += $this->canasta[$i]["precio_producto"];
        }
        return $total;
    }


    public function getId_pedido() {
        return $this->id_pedido;
    }

    public function getCanasta() {
        return $this->canasta;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getTamanio() {
        return $this->tamanio;
    }

    public function getCadena_identificadora() {
        return $this->cadena_identificadora;
    }

    public function setId_pedido($id_pedido) {
        $this->id_pedido = $id_pedido;
    }

    public function setCanasta($canasta) {
        $this->canasta = $canasta;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function setTamanio($tamanio) {
        $this->tamanio = $tamanio;
    }

    public function setCadena_identificadora($cadena_identificadora) {
        $this->cadena_identificadora = $cadena_identificadora;
    }

    
    
    
    
}
?>