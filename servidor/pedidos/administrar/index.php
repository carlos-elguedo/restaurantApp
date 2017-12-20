<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

require_once '../../bdacceso/BD/Insertador.php';
require_once '../../bdacceso/BD/Selector.php';
require_once '../../bdacceso/BD/Actualizador.php';
include '../../main/pedidos/Pedido.php';
require_once '../../funciones/tieneInyeccion.php';
require_once '../../funciones/verificacionDatos.php';
require_once '../../funciones/manejodatos.php';

$dato1 = addslashes($_POST["tipo"]);

$obj_insertador = new Insertador();
$obj_selector = new Selector();
$obj_actualizador = new Actualizador();

//Volvemos a verificamos los datos enviados por el usuario
//$dato1 = mysqli_real_escape_string($mysqli,$dato1);
//$dato2 = mysqli_real_escape_string($mysqli,$dato2);

//Empezamos a tomar los datos recibidos en variables
//El identificador de acceso, el correo
$tipo_de_accion = $dato1;

switch ($tipo_de_accion){
    case 1:
        //Para devolver el panel de administracion de pedidos
        
        
        
        $pedidos_activos = $obj_selector->traerPedidosActivos();
        
        if(mysqli_num_rows($pedidos_activos) > 0){
        
            echo "<div class='table-wrapper'>";
                echo "<table class='alt'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Mesa</th>";
                            echo "<th>Estado</th>";
                            echo "<th>Acción</th>";
                            echo "<th>Detalle</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
            while ($res = mysqli_fetch_array($pedidos_activos)){
                //obtenemos el estado de recibido por parte del mesero
                $estado_mesero_recibido = $res["estado_esperando"];
                //Obtenemos el estadp de producto entregado al cliente
                $estado_mesero_plato_entregado = $res["estado_terminado"];
                //obtenemos los datos de la mesa
                $datos_mesa = $obj_selector->darDatosUsuario($res["id_cliente"], 3);
                        
                //EL estadp que se mostrara en la pantalla del mesero
                $estado = "";
                $texto_accion = "";
                if($estado_mesero_recibido == 0){
                    $estado = "Esperando por ser atendido";
                    $texto_accion = "<a onclick = \"recibirPedido({$res["id_pedido"]}, '{$datos_mesa["nombre"]}', '{$res["cadena_identificadora"]}')\" class='button special fit small'>Recibir</a>";
                    
                }else{
                    $estado = "Preparando el pedido";
                    if($res["id_mesero"] == $_SESSION["ID"]){
                        //eS UN PEDIDO QUE ESTA ATENDIENDO ESTE MESERO
                        $texto_accion = "<a onclick = \"entragarPedido({$res["id_pedido"]}, '{$datos_mesa["nombre"]}', '{$res["cadena_identificadora"]}')\" class='button special fit small'>Entregar</a>";
                    } else {
                        $texto_accion = "Atendido por otro mesero";
                    }
                }
                if($estado_mesero_plato_entregado == 1){
                    $estado = "Pedido entregado";
                }
                            echo "<tr>";
                                echo "<td>{$datos_mesa["nombre"]}</td>";
                                echo "<td>{$estado}</td>";
                                echo "<td>{$texto_accion}</td>";
                                echo "<td><a onclick = \"VerDetallesPedido({$res["id_pedido"]}, '{$datos_mesa["nombre"]}', '{$res["cadena_identificadora"]}')\" class='button special fit small'>Ver detalles</a></td>";
             }//fin del while pedidos activos
                        echo "</tbody>";
                    echo "</table>";
                echo "</div>";
        
        }else{
            //no hay pedidos activos
            echo "<center>No hay pedidos activos</center>";
        }
        break;










        
        
        
        
        
    case 2:
        $id_pedido = addslashes($_POST["d1"]);
    	$nombre_mesa = addslashes($_POST["d2"]);
        $ci_pedido = addslashes($_POST["d3"]);
        
        
        $pedidos_enlace =$obj_selector->traerEnlaces($id_pedido, $ci_pedido);
            
        if(mysqli_num_rows($pedidos_enlace) > 0){
            echo "<div class='table-wrapper'>";
                echo "<table class='alt'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Nombre</th>";
                            echo "<th>Cantidad</th>";
                            echo "<th>Mensaje</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                        
            while ($res = mysqli_fetch_array($pedidos_enlace)){
                $producto = $obj_selector->darDatosProducto($res["id_producto"]);
            
                //Bien, ya estamos dentro, con los enlaces en este array res
                        echo "<tr>";
                            echo "<td>{$producto["nombre"]}</td>";
                            echo "<td>{$res["cantidad"]}</td>";
                            echo "<td>{$res["comentario"]}</td>";
                        echo "</tr>";
            }//Fin del ile
                    echo "</tbody>";
                echo "</table>";
            echo "</div>";
        }else{
            //No trajo los enlaces del producto
            echo "<p>No pudo traer los enlaces de los productos</p>";
        }
        
        
        break;
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    case 3:
        $id_pedido = addslashes($_POST["d1"]);
    	$nombre_mesa = addslashes($_POST["d2"]);
        $ci_pedido = addslashes($_POST["d3"]);
        
        
        $estado_esperando = $obj_selector->pedidoEstaDisponibleParaRecibir($id_pedido, $ci_pedido);
        
        switch ($estado_esperando){
            case 0:
                //Lo puede tomar
                $recibio = $obj_actualizador->recibirPedido($_SESSION["ID"], $id_pedido, $ci_pedido);
                $recibio_enlaces = $obj_actualizador->recibirPedidos($_SESSION["ID"], $id_pedido, $ci_pedido);
                if($recibio && $recibio_enlaces){
                    //Todo bien
                    echo "<label style='color:green'>Has recibido el pedido de: {$nombre_mesa}</label>";
                }else{
                    //No pudo recibir el pedido correctamente
                    echo "<label style='color:green'>No se ha recibido el pedido correctamente</label>";
                }
                break;
            case 1:
                echo "<label style='color:green'>Ya se ha recibido el pedido de: {$nombre_mesa}</label>";
                break;
            default :
                break;
        }
        
        
        
        break;


        
    
    
    
    
    
    
    
    case 4:
        $id_pedido = addslashes($_POST["d1"]);
        $id_producto = addslashes($_POST["d2"]);
        $ci_pedido = addslashes($_POST["d3"]);
        $id_enlace_pedido = addslashes($_POST["d4"]);
        
        //Hay que ver si es un pedido recibido por el y ya lo puede entregar
        $puede_entragar = $obj_selector->pedidoEstaDisponibleParaEntregar($id_pedido, $ci_pedido, $_SESSION["ID"]);
        
        switch ($puede_entragar){
            case 0:
                //Puede entragar
                //echo "<label style='color:green'>Has entragado el pedido a: {$nombre_mesa}</label>";
                //echo "Puede entragar";
                //Tenemos que actualizar el enlace del pedido, y luego comprobar si todos los enlaces del pedido estan entregados
                //Para desactivar el pedido
                $entrego_producto = $obj_actualizador->entregarProducto($id_pedido, $id_producto, $ci_pedido);
                
                if($entrego_producto){
                    if($obj_selector->pedidosEstaEntregado($id_pedido)){
                        //Los pedidos estan entregados totalmente
                        if($obj_actualizador->pedidoEntregado($id_pedido)){
                            //El producto ha sido entregado totalmente
                            echo "<script>";
                            echo "$('#cancel_entregar_pedido').click();";
                            echo "$('#p_estado_entregado').html('¡Ha entregado todo el pedido!');";
                            echo "desaparecerElemento('p_estado_entregado');";
                            echo "</script>";
                            echo "<label style='color:green'>¡Ha entregado todo el pedido!</label>";
                        }else{
                            //No pudo entregar todo el pedido
                            echo "<label style='color:green'>¡No se ha podido entregar el pedido totalmente!</label>";
                        }
                    }else{
                        //Aun faltan pedidos por entregar
                        echo "<script>";
                        echo "$('#cancel_entregar_pedido').click();";
                        echo "entragarPedido({$id_pedido}, '', {$ci_pedido});";
                        echo "$('#p_estado_entregado').html('¡Producto entregado!, aun faltan elementos');";
                        echo "desaparecerElemento('p_estado_entregado');";
                        echo "</script>";
                        echo "<label style='color:green'>¡Producto entregado!, aun faltan elementos</label>";
                    }
                    
                }else{
                    //No pudo entregar el producto unitario
                    echo "<label style='color:green'>¡No se pudo entregar el prodcto!</label>";
                }
                
                break;
            case 1:
                //Ya la ha entregado
                ECHO "<p>Ya lo ha entragado</p>";
                break;
            case 99:
                //Algo fallo
                ECHO "Algo fallo";
                break;
            default:
                break;
        }
        
        
        break;
        
        
    
    
    
    
    
    
    
    
    
    
        
        
        
        
    case 5:
        
        
        $id_pedido = addslashes($_POST["d1"]);
    	$nombre_mesa = addslashes($_POST["d2"]);
        $ci_pedido = addslashes($_POST["d3"]);
        
        
        $pedidos_enlace =$obj_selector->traerEnlaces($id_pedido, $ci_pedido);
            
        if(mysqli_num_rows($pedidos_enlace) > 0){
            echo "<div class='table-wrapper'>";
                echo "<table class='alt'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Nombre</th>";
                            echo "<th>Cantidad</th>";
                            echo "<th>Mensaje</th>";
                            echo "<th>Acción</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                        
            while ($res = mysqli_fetch_array($pedidos_enlace)){
                $producto = $obj_selector->darDatosProducto($res["id_producto"]);
            
                //Bien, ya estamos dentro, con los enlaces en este array res
                        echo "<tr>";
                            echo "<td>{$producto["nombre"]}</td>";
                            echo "<td>{$res["cantidad"]}</td>";
                            echo "<td>{$res["comentario"]}</td>";
                            if($res["estado_mesero_entregado"] == 1){
                                //Ya ha entregado el producto
                                echo "<td>Entregado</td>";
                            }else{
                                echo "<td><a onclick = \"confirmarEntrgarPedido({$res["id_pedido"]}, {$producto["id"]}, '{$res["cadena_identificadora"]}', {$res["id_enlace_pedido"]})\" class='button special fit small'>Entragar</a></td>";
                            }
                            
                        echo "</tr>";
            }//Fin del ile
                    echo "</tbody>";
                echo "</table>";
            echo "</div>";
            echo "<p id = 'p_estado_entregado'></p>";
        }else{
            //No trajo los enlaces del producto
            echo "<p>No pudo traer los enlaces de los productos</p>";
        }
        
        break;
                
        






    
        
        
        
        
    default:
        
        break;
    
}
?>