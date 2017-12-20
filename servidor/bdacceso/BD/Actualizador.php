<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Actualizador{
    
    var $conexion;
    
    public function __construct() {
        $this->conexion = new mysqli("localhost", "root", "", "restaurante");
    }
    
    
    public function cambiarCodigoAdmi($codigo_nuevo, $nombre, $correo){
        $retorno = false;
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        //Sentencia para insertar en el log
        $sql_log = "INSERT INTO log"
                . " (tipo_operacion, nombre_usuario, correo_usuario, valor_antiguo, valor_nuevo, hora, fecha)"
                . " VALUES"
                . " ('Cambio-codigo-reg-admi', '{$nombre}', '{$correo}', (SELECT valor FROM configuraciones WHERE id = 1), '{$codigo_nuevo}', '{$hora}', '{$fecha}')";
        //Ejecutamos la sentencia anterior
        $resultado_log = mysqli_query($this->conexion, $sql_log) or die("No pudo insertar el log: ". mysqli_error($this->conexion));
        
        //Ahora procedemos a cambiar el codigo
        $sql = "UPDATE configuraciones SET valor = '{$codigo_nuevo}' WHERE id = 1";
        
        $resultado = mysqli_query($this->conexion, $sql) or die ("No pudo cambiar el codigo: ". mysqli_error($this->conexion));
        
        if($resultado){
            $retorno = true;
        }
        
        return $retorno;
    }
    
    public function cambiarCodigoMese($codigo_nuevo, $nombre, $correo){
        $retorno = false;
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        //Sentencia para insertar en el log
        $sql_log = "INSERT INTO log"
                . " (tipo_operacion, nombre_usuario, correo_usuario, valor_antiguo, valor_nuevo, hora, fecha)"
                . " VALUES"
                . " ('Cambio-codigo-reg-mesero', '{$nombre}', '{$correo}', (SELECT valor FROM configuraciones WHERE id = 3), '{$codigo_nuevo}', '{$hora}', '{$fecha}')";
        //Ejecutamos la sentencia anterior
        $resultado_log = mysqli_query($this->conexion, $sql_log) or die("No pudo insertar el log: ". mysqli_error($this->conexion));
        
        //Ahora procedemos a cambiar el codigo
        $sql = "UPDATE configuraciones SET valor = '{$codigo_nuevo}' WHERE id = 3";
        
        $resultado = mysqli_query($this->conexion, $sql) or die ("No pudo cambiar el codigo: ". mysqli_error($this->conexion));
        
        if($resultado){
            $retorno = true;
        }
        
        return $retorno;
    }
    
    public function eliminarDesactivarMesa($idmesa, $nombre_mesa, $nombre_admi, $correo_admi){
        $retorno = false;
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        //Sentencia para insertar en el log
        $sql_log = "INSERT INTO log"
                . " (tipo_operacion, nombre_usuario, correo_usuario, valor_antiguo, valor_nuevo, hora, fecha)"
                . " VALUES"
                . " ('Eliminacion-de-mesa', '{$nombre_admi}', '{$correo_admi}', (SELECT id_cliente FROM cliente WHERE id_cliente = {$idmesa}) , 'desactivada (0)', '{$hora}', '{$fecha}')";
        //Ejecutamos la sentencia anterior
        $resultado_log = mysqli_query($this->conexion, $sql_log) or die("No pudo insertar en el log: ". mysqli_error($this->conexion));
        
        //Ahora procedemos a cambiar el codigo
        $sql = "UPDATE cliente SET estado = 0 WHERE id_cliente = {$idmesa}";
        $sql2 = "UPDATE usuario SET estado = 0 WHERE nombre = '{$nombre_mesa}'";
        
        $resultado = mysqli_query($this->conexion, $sql) or die ("No pudo cambiar el estado de la mesa: ". mysqli_error($this->conexion));
        $resultado2 = mysqli_query($this->conexion, $sql2) or die ("No pudo cambiar el estado de la mesa en usuarios: ". mysqli_error($this->conexion));
        
        if($resultado && $resultado2){
            $retorno = true;
        }
        
        return $retorno;
        
        
    }

















    
    public function eliminarDesactivarProducto($id, $nombre_admi, $correo_admi){
        $retorno = false;
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        //Sentencia para insertar en el log
        $sql_log = "INSERT INTO log"
                . " (tipo_operacion, nombre_usuario, correo_usuario, valor_antiguo, valor_nuevo, hora, fecha)"
                . " VALUES"
                . " ('Eliminacion-de-Producto', '{$nombre_admi}', '{$correo_admi}', {$id}, 'desactivada (0)', '{$hora}', '{$fecha}')";
        //Ejecutamos la sentencia anterior
        $resultado_log = mysqli_query($this->conexion, $sql_log) or die("No pudo insertar en el log: ". mysqli_error($this->conexion));
        
        //Ahora procedemos a cambiar el codigo
        $sql = "UPDATE producto SET estado = 0 WHERE id = {$id}";
        
        $resultado = mysqli_query($this->conexion, $sql) or die ("No pudo cambiar el estado del producto: ". mysqli_error($this->conexion));
        
        if($resultado){
            $retorno = true;
        }
        
        return $retorno;
        
        
    }
    



















    public function reactivarMesa($nombre_mesa, $contra,$nombre_admi, $correo_admi){
        $retorno = false;
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        //Sentencia para insertar en el log
        $sql_log = "INSERT INTO log"
                . " (tipo_operacion, nombre_usuario, correo_usuario, valor_antiguo, valor_nuevo, hora, fecha)"
                . " VALUES"
                . " ('Reactivacion-de-mesa', '{$nombre_admi}', '{$correo_admi}', (SELECT id_cliente FROM cliente WHERE nombre_mesa = '{$nombre_mesa}'), 'reactivada (1)', '{$hora}', '{$fecha}')";
        //Ejecutamos la sentencia anterior
        $resultado_log = mysqli_query($this->conexion, $sql_log) or die("No pudo insertar en el log: ". mysqli_error($this->conexion));
        
        //Ahora procedemos a cambiar el codigo
        $sql = "UPDATE cliente SET estado = 1, contra_mesa = '$contra' WHERE nombre_mesa = '{$nombre_mesa}'";
        $sql2 = "UPDATE usuario SET estado = 1, password = '{$contra}' WHERE nombre = '{$nombre_mesa}'";
        
        $resultado = mysqli_query($this->conexion, $sql) or die ("No pudo cambiar el estado de la mesa: ". mysqli_error($this->conexion));
        $resultado2 = mysqli_query($this->conexion, $sql2) or die ("No pudo cambiar el estado de la mesa en usuarios: ". mysqli_error($this->conexion));
        
        if($resultado && $resultado2){
            $retorno = true;
        }
        
        return $retorno;
        
    }
    
    
    
    
    public function reactivarProducto($id, $nombre, $tipo, $desc, $precio, $ruta_img){
        $retorno = false;
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        //Sentencia para insertar en el log
        $sql_log = "INSERT INTO log"
                . " (tipo_operacion, nombre_usuario, correo_usuario, valor_antiguo, valor_nuevo, hora, fecha)"
                . " VALUES"
                . " ('Reactivacion-de-producto', 'Admin id: {$id}', 'Admin id: {$id}', 'eliminado (0)', 'reactivado (1)', '{$hora}', '{$fecha}')";
        
        //Ejecutamos la sentencia anterior
        mysqli_query($this->conexion, $sql_log) or die("No pudo insertar en el log: ". mysqli_error($this->conexion));
        
        
        $sql_reactivar = "UPDATE producto SET descripcion = '{$desc}', ruta_imagen = '{$ruta_img}', tipo_producto = {$tipo}, precio = {$precio}, fecha_registro = '{$fecha}', estado = 1 WHERE nombre = '{$nombre}'";
        
        $resultado = mysqli_query($this->conexion, $sql_reactivar) or die ("No pudoReactivar el producto: ". mysqli_error($this->conexion));
        
        if($resultado){
            $retorno = true;
        }
        
        return $retorno;
        
    }
    
    
    
    
    
    
    
    
    
    
    
    public function editarProducto($id, $nombre, $desc, $precio, $ruta_img){
        $retorno = false;
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        //Sentencia para insertar en el log
        $sql_log = "INSERT INTO log"
                . " (tipo_operacion, nombre_usuario, correo_usuario, valor_antiguo, valor_nuevo, hora, fecha)"
                . " VALUES"
                . " ('Edicion-de-producto', 'Admin id: {$id}', 'Admin id: {$id}', 'editado', 'editado', '{$hora}', '{$fecha}')";
        
        //Ejecutamos la sentencia anterior
        mysqli_query($this->conexion, $sql_log) or die("No pudo insertar en el log: ". mysqli_error($this->conexion));
        
        
        $sql_editar = "UPDATE producto SET descripcion = '{$desc}', ruta_imagen = '{$ruta_img}', precio = {$precio}, nombre = '{$nombre}' WHERE id = {$id}";
        
        $resultado = mysqli_query($this->conexion, $sql_editar) or die ("No editar el producto: ". mysqli_error($this->conexion));
        
        if($resultado){
            $retorno = true;
        }
        
        return $retorno;        
    }
    
    
    
    
    
    
    
    
    
    
    
    public function cerrarPedidos($IP, $CI){
        $ret = false;
        $sql = "UPDATE pedido SET estado = 0 WHERE id_pedido = {$IP} AND cadena_identificadora = '{$CI}' AND estado = 1";
        
        $sql_2 = "UPDATE pedido_enlace SET estado = 0 WHERE id_pedido = {$IP} AND cadena_identificadora = '{$CI}'";
        
        
        $res1 = mysqli_query($this->conexion, $sql) or die ("No pudo actualizar el pedido al salir: " . mysqli_error($this->conexion));
        $res2 = mysqli_query($this->conexion, $sql_2) or die ("No pudo actualizar el enlace de pedido al salir: " . mysqli_error($this->conexion));
        
        if($res1 == true && $res2 == true){
            $ret = true;
        }
        return $ret;
    }
    
    
    
    
    
    
    public function recibirPedido($id_mesero, $id_pedido, $ci){
        $ret = false;
        $sql = "UPDATE pedido SET estado_esperando = 1, id_mesero = {$id_mesero} WHERE id_pedido = {$id_pedido} AND cadena_identificadora = '{$ci}'";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo actualizar el recibimiento del pedido: " . mysqli_error($this->conexion));
        if($res){
            $ret = true;
        }
        return $ret;
    }
    
    public function recibirPedidos($id_mesero, $id_pedido, $ci){
        $ret = false;
        $sql = "UPDATE pedido_enlace SET estado_mesero_recibido = 1, id_mesero = {$id_mesero} WHERE id_pedido = {$id_pedido} AND cadena_identificadora = '{$ci}'";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo actualizar el recibimiento de los pedidos: " . mysqli_error($this->conexion));
        if($res){
            $ret = true;
        }
        return $ret;
    }
    
    
    
    
    
    
    
    
    
    
    public function desactivarCliente($id_cliente){
        $ret = false;
        $sql = "UPDATE cliente SET activo = 0 WHERE id_usuario = {$id_cliente}";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo actualizar el desactivar cliente: " . mysqli_error($this->conexion));
        if($res){
            $ret = true;
        }
        return $ret;
    }
    
    public function activarCliente($id_cliente){
        $ret = false;
        $sql = "UPDATE cliente SET activo = 1 WHERE id_usuario = {$id_cliente}";
        $res = mysqli_query($this->conexion, $sql) or die ("No pudo actualizar el activar cliente: " . mysqli_error($this->conexion));
        if($res){
            $ret = true;
        }
        return $ret;
    }
    
    
    
    
    public function desactivarMesero($id_mesero, $nombre_admi, $correo_admi, $id_admi){
        $retorno = false;
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        //Sentencia para insertar en el log
        $sql_log = "INSERT INTO log"
                . " (tipo_operacion, nombre_usuario, correo_usuario, valor_antiguo, valor_nuevo, hora, fecha)"
                . " VALUES"
                . " ('Eliminacion-de-mesero', '{$nombre_admi}', 'Admin id: {$id_admi} correo: {$correo_admi}', 'Activo (1)', 'Desactivado (0)', '{$hora}', '{$fecha}')";
        
        //Ejecutamos la sentencia anterior
        mysqli_query($this->conexion, $sql_log) or die("No pudo insertar en el log: ". mysqli_error($this->conexion));
        
        
        $sql_eliminar = "UPDATE usuario SET estado = 0 WHERE id = {$id_mesero}";
        
        $resultado = mysqli_query($this->conexion, $sql_eliminar) or die ("No elimino mesero: ". mysqli_error($this->conexion));
        
        if($resultado){
            $retorno = true;
        }
        
        return $retorno;        
    }
    
    
    
    public function entregarProducto($id_pedido, $id_producto, $cad_i){
        $retorno = false;
        $sql = "UPDATE pedido_enlace SET estado_mesero_entregado = 1, estado = 2 WHERE id_pedido = {$id_pedido} AND cadena_identificadora = '{$cad_i}' AND id_producto = {$id_producto}";
        $resultado = mysqli_query($this->conexion, $sql) or die ("eNTREGO EL PRODUCTO UNITARIO: ". mysqli_error($this->conexion));
        if($resultado){
            $retorno = true;
        }
        return $retorno;
    }
    
    public function pedidoEntregado($id_pedido){
        $retorno = false;
        $sql = "UPDATE pedido SET estado_terminado = 1, estado = 2 WHERE id_pedido = {$id_pedido}";
        $resultado = mysqli_query($this->conexion, $sql) or die ("No entrego el pedido: ". mysqli_error($this->conexion));
        if($resultado){
            $retorno = true;
        }
        return $retorno;
    }
    
    public function editarCampoTextoAdmi($campo, $valor_nuevo, $id_usuario){
        $retorno = false;
        $sql = "UPDATE usuario SET {$campo} = '{$valor_nuevo}' WHERE id = {$id_usuario}";
        
        if(strcmp("nombre", $campo)==0){
            $sql2 = "UPDATE administrador SET nombre_admi = '{$valor_nuevo}' WHERE id_usuario = {$id_usuario}";
            
            $resultado = mysqli_query($this->conexion, $sql) or die ("No edito nombre en usuarios ". mysqli_error($this->conexion));
            $resultado2 = mysqli_query($this->conexion, $sql2) or die ("No edito nombre en administrador: ". mysqli_error($this->conexion));
            if($resultado && $resultado2){
                $retorno = true;
            }
        }else{
            $resultado = mysqli_query($this->conexion, $sql) or die ("No edito en usuario: ". mysqli_error($this->conexion));
            if($resultado){
                $retorno = true;
            }
        }
        
        return $retorno;
    }
    
    
    
    
    
    
    public function editarCampoTextoMesero($campo, $valor_nuevo, $id_usuario){
        $retorno = false;
        $sql = "UPDATE usuario SET {$campo} = '{$valor_nuevo}' WHERE id = {$id_usuario}";
        
        if(strcmp("nombre", $campo)==0){
            $sql2 = "UPDATE mesero SET nombre_mesero = '{$valor_nuevo}' WHERE id_usuario = {$id_usuario}";
            
            $resultado = mysqli_query($this->conexion, $sql) or die ("No edito nombre en usuarios ". mysqli_error($this->conexion));
            $resultado2 = mysqli_query($this->conexion, $sql2) or die ("No edito nombre en mesero: ". mysqli_error($this->conexion));
            if($resultado && $resultado2){
                $retorno = true;
            }
        }else{
            $resultado = mysqli_query($this->conexion, $sql) or die ("No edito en usuario: ". mysqli_error($this->conexion));
            if($resultado){
                $retorno = true;
            }
        }
        
        return $retorno;
    }
    
    
    public function cancelarPedido($id_pedido, $cade_id, $id_enlace_pedido){
        $ret = 0;
        
        $sql_cancelar_enlace = "UPDATE pedido_enlace SET estado = 0 WHERE id_enlace_pedido = {$id_enlace_pedido}";
        
        $R1 = mysqli_query($this->conexion, $sql_cancelar_enlace) or die ("No cambio estado del enlace: ". mysqli_error($this->conexion));
        
        if($R1){
            //Comprobamos si hay mas enlaces o si ese es el unico enlace del pedido
            $sql_consultar_enlaces = "SELECT * FROM pedido_enlace WHERE id_pedido = {$id_pedido} AND estado = 1";
            $R2 = mysqli_query($this->conexion, $sql_consultar_enlaces) or die ("No consulto enlaces: ". mysqli_error($this->conexion));
            if(mysqli_num_rows($R2) > 0){
                //hAY ENLACES AUN EN EL PEDIDO
                $ret = 2;
            }else{
                //No hay enlaces activos, ya se puede actualizar el estado del pedido a acabado
                //Verificamos si hay enlaces entregados
                $sql_consultar_enlaces_entregados = "SELECT * FROM pedido_enlace WHERE id_pedido = {$id_pedido} AND estado = 2";
                $R4 = mysqli_query($this->conexion, $sql_consultar_enlaces_entregados) or die ("No consulto enlaces entregados: ". mysqli_error($this->conexion));
                if(mysqli_num_rows($R4) > 0){
                    //hAY ENLACES entregados
                    $sql_entr_pedido = "UPDATE pedido SET estado = 2 WHERE id_pedido = {$id_pedido}";
                    $R5 = mysqli_query($this->conexion, $sql_entr_pedido) or die ("No CANCELO EL PEDIDO: ". mysqli_error($this->conexion));
                    if($R5){
                        //1 para el pedido ha terminado completamente
                        $ret = 2;
                    }
                }else{
                    $sql_terminar_pedido = "UPDATE pedido SET estado = 0 WHERE id_pedido = {$id_pedido}";
                    $R3 = mysqli_query($this->conexion, $sql_terminar_pedido) or die ("No CANCELO EL PEDIDO: ". mysqli_error($this->conexion));
                    if($R3){
                        //1 para el pedido ha terminado completamente
                        $ret = 1;
                    }
                }//Fin del else que nos dice que no entro en enlaces entregados en 2
                
            }//Fin del else que nos dice que entro en donde no hay enlaces activos en 1
            
        }
        return $ret;
    }

    
    public function activarPedido($id_pedido){
        $ret = false;
        $sql = "UPDATE pedido SET estado = 1 WHERE id_pedido = {$id_pedido}";
        $resultado = mysqli_query($this->conexion, $sql) or die ("No reactivo el pedido: ". mysqli_error($this->conexion));
        if($resultado){
            $ret = true;
        }
        return $ret;
    }

        public function actualizarImagen($id, $ruta){
        //$retorno = false;
        //$sql = "UPDATE usuario   SET {$campo} = '{$valor_nuevo}' WHERE id = {$id_usuario}";
    }
    
    
}//Fin de la clase