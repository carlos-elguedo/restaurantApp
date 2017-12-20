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
        //Para realizar un pedido de plato
    	$id_plato = addslashes($_POST["d1"]);
    	$cantidad_plato = addslashes($_POST["d2"]);
    	$comentario_plato = addslashes($_POST["d3"]);
        
        
        //Vemos si tiene un pedido activo
        if(isset($_SESSION["PEDIDO"])){
            //Ya ha realizado otra peticion
            //echo "SEGUNDA VEZ :" . $id_plato . " - " . $cantidad_plato . " - " . $comentario_plato;
            $ID_PEDIDO = $_SESSION["PEDIDO"];
            $CI_PEDIDO = $_SESSION["PEDIDO_C_I"];
            
            //sACAMOS SI HA ¿Y ALGUN MESERO ATENDIENDO EL PEDIDO:
            $id_mesero = $obj_selector->sacarMeseroAtendedor($ID_PEDIDO);            
            $estado_recibido = 0;
            
            if($id_mesero != 0){
                $estado_recibido = 1;
            }
            
            //Añadimos el nuevo producto
            //iNSERTAMOS EL ENLACE:
            $inserto_enlace = $obj_insertador->insertarEnlaceDePedido($ID_PEDIDO, $id_plato, $_SESSION["ID"], $comentario_plato, $cantidad_plato, $CI_PEDIDO, $id_mesero, $estado_recibido);
            
            if($inserto_enlace){
                //Se ha realizado el pedido correctamente a nivel de base de datos
                //aCTIVAMOS EL PEDIDO SI ESTABA DESACTIVADO:
                $obj_actualizador->activarPedido($ID_PEDIDO);
                //Procedemos a crear la logica del pedido
                echo "<label style='color:green'>Se ha realizado un nuevo pedido correctamente</label>";
                
            }else{
                //echo "Mal: ". $comentario_plato . " - " . $cantidad_plato . " - " . $id_plato;
                echo "<label style='color:green'>No pudo realizar el pedido correctamente</label>";
            }
            
            
            
            
        }else{
            //Es su primera peticion
            //echo "PRIMERA VEZ :" . $id_plato . " - " . $cantidad_plato . " - " . $comentario_plato;
            //Como es la primera vez, vamos a crear el objeto pedido y lo asociamos con el cliente actual
            $DATOS_CLIENTE = $obj_selector->darDatosUsuario($_SESSION["ID"], $_SESSION["TIPO_USUARIO"]);
            
            $inserto_pedido = $obj_insertador->insertarPedidoNuevo($_SESSION["ID"]);
            
            if(strcmp($inserto_pedido, "mal") == 0){
                //No pudo insertar el pedido
                echo "mal: " . $inserto_pedido;
            }else{
                
                
                //Inserto correctamente y ya tenemos el identificador
                //echo "bien" . $inserto_pedido;
                
                //Procedemos a sacar el id del pedido, para realiazar el enlace
                $id_pedido = $obj_selector->darIdPedido($inserto_pedido, $_SESSION["ID"]);
                
                //echo "bien: " . $inserto_pedido . " - " . $id_pedido;
                
                //Ya tenemos el id del pedido, procedemos a almacenarlo el la tsbla de enlaces
                $inserto_enlace = $obj_insertador->insertarEnlaceDePedido($id_pedido, $id_plato, $_SESSION["ID"], $comentario_plato, $cantidad_plato, $inserto_pedido, 0, 0);
                
                if($inserto_enlace){
                    //Se ha realizado el pedido correctamente a nivel de base de datos
                    //Procedemos a crear la logica del pedido
                    //echo "bien, gracias a Dios: ";
                    
                    $datos_plato = $obj_selector->darDatosProducto($id_plato);
                    
                    $_SESSION["PEDIDO"] = $id_pedido;
                    $_SESSION["PEDIDO_C_I"] = $inserto_pedido;
                    
                    echo "<label style='color:green'>Se ha realizado el pedido correctamente</label>";
                    
                }else{
                    //echo "Mal: ". $comentario_plato . " - " . $cantidad_plato . " - " . $id_plato;
                    echo "<label style='color:green'>No pudo realizar el pedido correctamente</label>";
                }
                
            }//Fin del else que nos dice que el pedido lo inserto correctamente

            
          
        }//Fin del else que nos dice que el pedido esta vacio, y es la primera vez que lo hace
    	
    break;
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    case 2:
        //Para realizar un pedido de una bebida
    	$id_bebida = addslashes($_POST["d1"]);
    	$cantidad_bebida = addslashes($_POST["d2"]);
    	$comentario_bebida = addslashes($_POST["d3"]);

        //Vemos si tiene un pedido activo
        if(isset($_SESSION["PEDIDO"])){
            //Ya ha realizado otra peticion
            $ID_PEDIDO = $_SESSION["PEDIDO"];
            $CI_PEDIDO = $_SESSION["PEDIDO_C_I"];
            
            //sACAMOS SI HA ¿Y ALGUN MESERO ATENDIENDO EL PEDIDO:
            $id_mesero = $obj_selector->sacarMeseroAtendedor($ID_PEDIDO);
            $estado_recibido = 0;
            
            if($id_mesero != 0){
                $estado_recibido = 1;
            }
            
            //Añadimos el nuevo producto
            //iNSERTAMOS EL ENLACE:
            $inserto_enlace = $obj_insertador->insertarEnlaceDePedido($ID_PEDIDO, $id_bebida, $_SESSION["ID"], $comentario_bebida, $cantidad_bebida, $CI_PEDIDO, $id_mesero, $estado_recibido);
            
            if($inserto_enlace){
                //Se ha realizado el pedido correctamente a nivel de base de datos
                //aCTIVAMOS EL PEDIDO SI ESTABA DESACTIVADO:
                $obj_actualizador->activarPedido($ID_PEDIDO);
                echo "<label style='color:green'>Se ha realizado un nuevo pedido correctamente</label>";
                echo "<script>";
                echo "pedido();";
                echo "</script>";
                
            }else{
                //echo "Mal: ". $comentario_plato . " - " . $cantidad_plato . " - " . $id_plato;
                echo "<label style='color:green'>No pudo realizar el pedido correctamente</label>";
            }
            
        }else{
            //Es su primera peticion
            //Como es la primera vez, vamos a crear el objeto pedido y lo asociamos con el cliente actual
            $DATOS_CLIENTE = $obj_selector->darDatosUsuario($_SESSION["ID"], $_SESSION["TIPO_USUARIO"]);
            
            $inserto_pedido = $obj_insertador->insertarPedidoNuevo($_SESSION["ID"]);
            
            if(strcmp($inserto_pedido, "mal") == 0){
                //No pudo insertar el pedido
                echo "No se pudo registrar el pedido: " . $inserto_pedido;
                
            }else{
                //Inserto correctamente y ya tenemos el identificador
                //Procedemos a sacar el id del pedido, para realiazar el enlace
                $id_pedido = $obj_selector->darIdPedido($inserto_pedido, $_SESSION["ID"]);
                
                //Ya tenemos el id del pedido, procedemos a almacenarlo el la tsbla de enlaces
                $inserto_enlace = $obj_insertador->insertarEnlaceDePedido($id_pedido, $id_bebida, $_SESSION["ID"], $comentario_bebida, $cantidad_bebida, $inserto_pedido, 0, 0);
                
                if($inserto_enlace){
                    //Se ha realizado el pedido correctamente a nivel de base de datos
                    //Procedemos a crear la logica del pedido
                    
                    $datos_bebidas = $obj_selector->darDatosProducto($id_bebida);
                    
                    $_SESSION["PEDIDO"] = $id_pedido;
                    $_SESSION["PEDIDO_C_I"] = $inserto_pedido;
                    
                    echo "<label style='color:green'>Se ha realizado el pedido correctamente</label>";
                    echo "<script>";
                    echo "pedido();";
                    echo "</script>";
                    
                }else{
                    //echo "Mal: ". $comentario_plato . " - " . $cantidad_plato . " - " . $id_plato;
                    echo "<label style='color:green'>No pudo realizar el pedido correctamente</label>";
                }
                
            }//Fin del else que nos dice que el pedido lo inserto correctamente

            
          
        }//Fin del else que nos dice que el pedido esta vacio, y es la primera vez que lo hace
        
        
    break;
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    case 3:
        //Para pedir por parte del cliente el estado del pedido activo
        //echo "Llego al estado del pedido";
        
        //Vemos si tiene un pedido activo
        if(isset($_SESSION["PEDIDO"])){
            //YA TIENE UN PEDIDO ACTIVO
            $ID_PEDIDO = $_SESSION["PEDIDO"];
            $CI_PEDIDO = $_SESSION["PEDIDO_C_I"];
            $contador_de_productos = 0;
            $total_cuenta = 0;
            
            //TRAEMOS LOS ENLACES:
            $pedidos_enlace =$obj_selector->traerEnlaces($ID_PEDIDO, $CI_PEDIDO);
            
            if(mysqli_num_rows($pedidos_enlace) > 0){
                echo "<div class='table-wrapper'>";
                    echo "<table class='alt'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Imagen</th>";
                                echo "<th>Nombre</th>";
                                echo "<th>Estado</th>";
                                echo "<th>Cant.</th>";
                                echo "<th>Precio</th>";
                                
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        
                        
                        
                while ($res = mysqli_fetch_array($pedidos_enlace)){
                    $producto = $obj_selector->darDatosProducto($res["id_producto"]);
                    $estado_mesero_recibido = $res["estado_mesero_recibido"];
                    $estado_mesero_plato_entregado = $res["estado_mesero_entregado"];
                    $estado = "";
                    if($estado_mesero_recibido == 0){
                        $estado = "Esperando por ser atendido";
                    }else{
                        $estado = "Preparando el producto";
                    }
                    if($estado_mesero_plato_entregado == 1){
                        $estado = "Ya ha recibido este pedido";
                    }
                    
                    
                    //Bien, ya estamos dentro, con los enlaces en este array res
                            echo "<tr>";
                                $r = url_imagenes_productos . $producto["ruta_imagen"];
                                echo "<td> <img src = '{$r}'></td>";
                                echo "<td>{$producto["nombre"]}</td>";
                                echo "<td>{$estado}";
                                if($estado_mesero_recibido == 0){
                                    //Puede cancerlarlo
                                    echo "<br<";
                                    echo "<a onclick = \"cancelarPedido({$res["id_pedido"]}, '{$res["cadena_identificadora"]}', {$res["id_enlace_pedido"]})\" class='button special fit small'>Cancelar</a>";
                                }else{
                                    echo "</td>";
                                }
                                echo "<td>{$res["cantidad"]}</td>";
                                echo "<td>\${$producto["precio"]}</td>";
                            echo "</tr>";
                        $total_cuenta += ($producto["precio"] * $res["cantidad"]);
                        $contador_de_productos++;
                }
                        echo "</tbody>";
                        echo "<tfoot>";
                            echo "<tr>";
                                echo "<td colspan='4'>Total a pagar</td>";
                                echo "<td>\${$total_cuenta}</td>";
                            echo "</tr>";
                        echo "</tfoot>";
                    echo "</table>";
                echo "</div>";
            }else{
                //No trajo los enlaces del producto
                echo "<section style = 'width:100%'><center> <p>No has realizado un pedido</p> </center></section>";
                echo "<center style = 'width:100%'>";
                echo "<article class='style1>";
                    echo "<span class='image'>";
                        echo "<img src='images/admi_ban.png'' alt='' />";
                    echo "</span>";
                    echo "<a class='ver_plato'>";
                        echo "<h2></h2>";
                        echo "<div class='content'>";
                            echo "<p></p>";
                        echo "</div>";
                    echo "</a>";
                echo "</article>";
                echo "</center>";
            }
            
            
        }else{
            //No tiene pedidos activos
            echo "<section style = 'width:100%'><center> <p>No has realizado un pedido</p> </center></section>";
            echo "<center style = 'width:100%'>";
            echo "<article class='style1>";
                echo "<span class='image'>";
                    echo "<img src='images/admi_ban.png'' alt='' />";
                echo "</span>";
                echo "<a class='ver_plato'>";
                    echo "<h2></h2>";
                    echo "<div class='content'>";
                        echo "<p></p>";
                    echo "</div>";
                echo "</a>";
            echo "</article>";
            echo "</center>";
            
        }//Fin del else que nos dice que el pedido esta vacio, y es la primera vez que lo hace
        
        
        break;
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    case 4:
        //Para cancelar un pedido
        //echo "Llego cancelar";
        //Para cancelar el pedido cambiamos el estado del enlace del pedido
        $id_pedido = addslashes($_POST["d1"]);
        $cad_id = addslashes($_POST["d2"]);
        $id_enlace_p = addslashes($_POST["d3"]);
        
        switch ($obj_actualizador->cancelarPedido($id_pedido, $cad_id, $id_enlace_p)){
            case 0:
                //No ha podido cancelar el pedido
                echo "<label style='color:green'>No se ha podido cancelar el pedido</label>";
                break;
            case 1:
                //El pedido ha terminado completamente
                unset($_SESSION["PEDIDO"]);
                echo "<label style='color:green'>El pedido ha sido cancelado completamente</label>";
                echo "<script>";
                echo "pedido();";
                echo "</script>";
                break;
            case 2:
                //El pedido aun tiene pedido activo
                echo "<label style='color:green'>Ha cancelado el pedido, aun quedan productos</label>";
                echo "<script>";
                echo "pedido();";
                echo "</script>";
                break;
            default :
                break;
        }
        break;
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    case 5:
        
        //cOMPROBAMOS SI HA REALIZADO UN PEDIDO
        if(isset($_SESSION["PEDIDO"])){
            $ID_PEDIDO = $_SESSION["PEDIDO"];
            $CI_PEDIDO = $_SESSION["PEDIDO_C_I"];
            $pedidos_enlace =$obj_selector->traerEnlaces($ID_PEDIDO, $CI_PEDIDO);
            $tiene_val_dispo = false;
            
            if(mysqli_num_rows($pedidos_enlace) > 0){
                echo "<section class = 'tiles'>";
                while ($res = mysqli_fetch_array($pedidos_enlace)){
                    $producto = $obj_selector->darDatosProducto($res["id_producto"]);
                    $estado_mesero_recibido = $res["estado_mesero_recibido"];
                    $estado_mesero_plato_entregado = $res["estado_mesero_entregado"];
                    
                    
                    if($estado_mesero_plato_entregado == 1){
                        $r = url_imagenes_productos . $producto["ruta_imagen"];
            
                        echo "<article class='style1' onclick=\"verProducto_comentario({$res["id_producto"]}, '{$producto["nombre"]}', '{$producto["descripcion"]}', {$producto["precio"]}, '{$r}')\">";
                        echo "<span class='image'>";
                        echo "<img src='{$r}' alt='' />";
                        echo "</span>";
                        echo "<a class='ver_plato'>";
                        echo "<h2>{$producto["nombre"]}</h2>";
                        echo "<div class='content'>";
                        echo "<p>{$producto["descripcion"]}</p>";
                        echo "</div>";
                        echo "</a>";
                        echo "</article>";
                        $tiene_val_dispo = true;
                    }//Fin del if que nos dice que un plato ya esta entregado por lo tanto ya se puede valorar
                    
                }//Fin del hile
                if(!$tiene_val_dispo){
                    echo "<p width='100%'>Aún no puedes realizar las valoraciones, por favor espera a recibir tu pedido</p>";
                }
                echo "</section>";
            }else{
                //No trajo enlaces
                echo "<figure>";
                echo "<img src='images/val.png'>";
                echo "</figure>";
                echo "<p>Aquí podras realizar comentarios y valoraciones acerca<br> de los productos que hayas consumido en el restaurante</p>";
            }
            
            
            
            
        }else{
            //Aun no ha realizado un pedido
            echo "<figure>";
            echo "<img src='images/val.png'>";
            echo "</figure>";
            echo "<p>Aquí podras realizar comentarios y valoraciones acerca<br> de los productos que hayas consumido en el restaurante</p>";
        }
        
        break;
    
    
    
    
    
    
    
    
    
    default:

    break;
}


