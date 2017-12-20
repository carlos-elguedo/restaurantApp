<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Selector{
    
    var $conexion;
    
    public function __construct() {
        $this->conexion = new mysqli("localhost", "root", "", "restaurante");
    }
    
    
    
    /**
     * Funcion que devolvera todos lod datos de un usuario
     * @param  $id_usu Indica el id del usuario con la sesion actual
     * @param  $tipo_usuario El tipo de usuario con la sesion actual que quiere pedir los datos
     * @return los datos que del usuario que ha recibido como parametro
     */
    public function darDatosUsuario($id_usu, $tipo_usuario){
         
        $sql_traer_datos = "SELECT * FROM usuario WHERE id = '$id_usu'";
        
        $resultado = mysqli_query($this->conexion, $sql_traer_datos) or die ("No pudo traer los datos de la persona:" . $dato_a_consultar . mysqli_error($this->conexion));
        
        $datos = mysqli_fetch_assoc($resultado);
        
        return $datos;
    }
    
    
    /**
     * Funcion para consultar las mesas existentes en la base de datos
     * @return un array con todos los datos obtenido de la consulta
     */
    public function darMesasRestaurante(){
         
        $sql_traer_datos = "SELECT * FROM cliente WHERE estado = 1";
        
        $resultado = mysqli_query($this->conexion, $sql_traer_datos) or die ("No pudo traer los clientes: " . mysqli_error($this->conexion));
        
        //$datos = mysqli_fetch_array($resultado);
        
        //return $datos;
        return $resultado;
    }
    
    public function existeMesa($nombre_mesa){
        $retorno = false;
        
        $sql = "SELECT * FROM cliente WHERE nombre_mesa = '{$nombre_mesa}'";
        
        $resultado = mysqli_query($this->conexion, $sql) or die ("No pudo consultar si existe esa mesa en la base de datos: " . mysqli_error($this->conexion));
        
        if(mysqli_num_rows($resultado) > 0){
            //Hay algo, por lo tanto no se puede guardar el mismo producto
            $retorno = true;
        }
        return $retorno;
    }
    public function mesaEstaActiva($nombre_mesa){
        $retorno = false;
        
        $sql = "SELECT * FROM cliente WHERE nombre_mesa = '{$nombre_mesa}' AND estado = 1";
        
        $resultado = mysqli_query($this->conexion, $sql) or die ("No pudo consultar si la mesa esta activa: " . mysqli_error($this->conexion));
        
        if(mysqli_num_rows($resultado) > 0){
            //Hay algo, por lo tanto no se puede guardar el mismo producto
            $retorno = true;
        }
        return $retorno;
    }
    
    public function productoEstaActiva($nombre){
        $retorno = false;
        
        $sql = "SELECT * FROM producto WHERE nombre = '{$nombre}' AND estado = 1";
        
        $resultado = mysqli_query($this->conexion, $sql) or die ("No pudo consultar si el producto esta activo: " . mysqli_error($this->conexion));
        
        if(mysqli_num_rows($resultado) > 0){
            //Hay algo, por lo tanto no se puede guardar el mismo producto
            $retorno = true;
        }
        return $retorno;
    }
    
    public function existeProducto($nombre_producto){
        $retorno = false;
        
        $sql = "SELECT * FROM producto WHERE nombre = '{$nombre_producto}'";
        
        $resultado = mysqli_query($this->conexion, $sql) or die ("No pudo consultar si existe ese producto en la base de datos: " . mysqli_error($this->conexion));
        
        if(mysqli_num_rows($resultado) > 0){
            //Hay algo, por lo tanto no se puede guardar el mismo producto
            $retorno = true;
        }
        return $retorno;
    }
    
    public function darPlatosRestaurante(){
         
        $sql_traer_platos = "SELECT * FROM producto WHERE tipo_producto = 1 AND estado = 1";
        
        $resultado = mysqli_query($this->conexion, $sql_traer_platos) or die ("No pudo traer los platos: " . mysqli_error($this->conexion));
        
        return $resultado;
    }
    
    
    public function darPlatosRestauranteBusqueda($busqueda){
         
        $sql_traer_platos = "SELECT * FROM producto WHERE tipo_producto = 1 AND estado = 1 AND (nombre LIKE '%{$busqueda}%' OR descripcion LIKE '%{$busqueda}%')";
        
        $resultado = mysqli_query($this->conexion, $sql_traer_platos) or die ("No pudo traer los platos: " . mysqli_error($this->conexion));
        
        return $resultado;
    }
    
    
    public function darBebidassRestaurante(){
         
        $sql_traer = "SELECT * FROM producto WHERE tipo_producto = 2 AND estado = 1";
        
        $resultado = mysqli_query($this->conexion, $sql_traer) or die ("No pudo traer las bebidas: " . mysqli_error($this->conexion));
        
        return $resultado;
    }
    
    public function darBebidasRestauranteBusqueda($busqueda){
         
        $sql_traer_platos = "SELECT * FROM producto WHERE tipo_producto = 2 AND estado = 1 AND (nombre LIKE '%{$busqueda}%' OR descripcion LIKE '%{$busqueda}%')";
        
        $resultado = mysqli_query($this->conexion, $sql_traer_platos) or die ("No pudo traer los platos: " . mysqli_error($this->conexion));
        
        return $resultado;
    }

    
    public function darIdPedido($identificador, $id_cliente){
        $sql = "SELECT id_pedido FROM pedido WHERE id_cliente = {$id_cliente} AND cadena_identificadora = '{$identificador}'";
        
        $resultado = mysqli_query($this->conexion, $sql) or die ("No pudo traer el id del pedido: " . mysqli_error($this->conexion));
        
        
        $dato = mysqli_fetch_assoc($resultado);
        
        return $dato["id_pedido"];
        
    }
    
    
    public function darDatosProducto($id){
        $sql = "SELECT * FROM producto WHERE id = {$id}";
        
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo traer los datos del producto: " . mysqli_error($this->conexion));
        
        return mysqli_fetch_array($res);
    }
    
    
    public function traerEnlaces($id_pedido, $cadena_identificadora){
        $sql = "SELECT * FROM pedido_enlace WHERE id_pedido = {$id_pedido} AND 	cadena_identificadora = '{$cadena_identificadora}' AND (estado = 1 OR estado_mesero_entregado = 1)";
        
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo traer los enlaces: " . mysqli_error($this->conexion));
        
        return $res;
    }
    
    
    
    
    public function pedidosActivos(){
        $sql = "SELECT COUNT(id_pedido) AS cantidad FROM pedido WHERE estado = 1";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo traer el contador de pedidos" . mysqli_error($this->conexion));
        $d =  mysqli_fetch_assoc($res);
        return $d["cantidad"];
    }
    
    public function clientesActivos(){
        $sql = "SELECT * FROM cliente WHERE activo = 1";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo traer los clientes activos: " . mysqli_error($this->conexion));
        return $res;
    }
    
    
    
    public function traerPedidosActivos(){
        $sql = "SELECT * FROM pedido WHERE estado = 1";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo traer los pedidos activos: " . mysqli_error($this->conexion));
        return $res;
    }
    
    public function pedidoEstaDisponibleParaRecibir($id_pedido, $ci){
        $sql = "SELECT estado_esperando FROM pedido WHERE id_pedido = {$id_pedido} AND cadena_identificadora = '{$ci}'";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo traer el estado de esperando: " . mysqli_error($this->conexion));
        $dat = mysqli_fetch_assoc($res);
        return $dat["estado_esperando"];
    }
    
    
    public function pedidoEstaDisponibleParaEntregar($id_pedido, $ci, $id_mesero){
        $ret = 99;
        $sql = "SELECT estado FROM pedido WHERE id_pedido = {$id_pedido} AND cadena_identificadora = '{$ci}' AND id_mesero = {$id_mesero} AND estado_esperando = 1";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo traer el estado de entragado del pedido: " . mysqli_error($this->conexion));
        if(mysqli_num_rows($res) > 0){
            $dat = mysqli_fetch_assoc($res);
            $ret = $dat["estado"];
        }
        if($ret == 0){
            //El pedido esta cancelado por lo tanto no puede entregar
            $ret = 1;
        }
        if($ret == 1){
            //El pedido esta activo por lo tanto si puede entregar
            $ret = 0;
        }
        if($ret == 2){
            //El pedido ya ha cido entregado
            $ret = 1;
        }
        
        return $ret;
        
    }
    
    
    
    public function darMeserosRestaurante(){
        $sql = "SELECT * FROM usuario WHERE estado = 1 AND tipo_usuario = 2";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo traer meseros: " . mysqli_error($this->conexion));
        return $res;
    }
    
    public function pedidosEstaEntregado($id_pedido){
        $ret = false;
        $sql = "SELECT * FROM pedido_enlace WHERE id_pedido = {$id_pedido} AND estado_mesero_entregado = 0 AND estado = 1";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo consultar pedidos unitarios entregados: " . mysqli_error($this->conexion));
        if(mysqli_num_rows($res) > 0){
            //Hay pedidos sn entregar aun
            $ret = false;
        }else{
            $ret = true;
        }
        return $ret;
    }
    
    public function passCorrectaMesa($mesa, $pass){
        $ret = false;
        $sql = "SELECT * FROM usuario WHERE (correo = '{$mesa}' OR nombre = '$mesa') AND password = '{$pass}'";
        $res = mysqli_query($this->conexion, $sql) or die ("No contraseña correcta: " . mysqli_error($this->conexion));
        if(mysqli_num_rows($res) > 0){
            $ret = false;
        }else{
            $ret = true;
        }
        return $ret;
    }
    
    public function passCorrectaAdmi($id, $pass){
        $ret = false;
        $sql = "SELECT * FROM usuario WHERE id = {$id} AND password = '{$pass}'";
        $res = mysqli_query($this->conexion, $sql) or die ("No contraseña correcta: " . mysqli_error($this->conexion));
        if(mysqli_num_rows($res) > 0){
            $ret = false;
        }else{
            $ret = true;
        }
        return $ret;
    }
    
    
    public function sacarMeseroAtendedor($id_pedido) {
        $sql = "SELECT id_mesero FROM pedido WHERE id_pedido = {$id_pedido}";
        $res = mysqli_query($this->conexion, $sql) or die ("No trajo el id del mesero: " . mysqli_error($this->conexion));
        $dat = mysqli_fetch_assoc($res);
        $r = $dat["id_mesero"];
        return $r;
    }
    
    
    
    public function pedidosAtendidos($id_mesero) {
        $sql = "SELECT * FROM pedido WHERE id_mesero = {$id_mesero} AND (estado = 2 OR estado_terminado = 1) ORDER BY fecha, hora DESC";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo traer los pedidos activos: " . mysqli_error($this->conexion));
        return $res;
    }
    
    
    
    public function comentariosRestaurante(){
        $sql = "SELECT * FROM valoraciones WHERE estado = 1";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo traer meseros: " . mysqli_error($this->conexion));
        return $res;
    }
    
}//Fin de la clase

