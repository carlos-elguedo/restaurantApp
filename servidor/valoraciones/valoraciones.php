<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

require_once '../bdacceso/BD/Insertador.php';
require_once '../bdacceso/BD/Selector.php';
require_once '../bdacceso/BD/Actualizador.php';
include '../main/pedidos/Pedido.php';
require_once '../funciones/tieneInyeccion.php';
require_once '../funciones/verificacionDatos.php';
require_once '../funciones/manejodatos.php';

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
        //Para realizar un comentario acerca de un producto
        //echo "1111";
        $id_p = addslashes($_POST["d1"]);
    	$valoracion_p = addslashes($_POST["d2"]);
    	$comentario_p = addslashes($_POST["d3"]);
        
        if($obj_insertador->insertarComentario($id_p, $valoracion_p, $comentario_p, $_SESSION["ID"])){
            echo "<label style='color:green'>Gracias por tu valoracion, la tendremos en cuenta</label>";
        }
        
        break;
        
        
        
        
    case 2:
        //Para pedir de parte del clientes los comentarios ecistentes
        $comentarios = $obj_selector->comentariosRestaurante();
        
        if(mysqli_num_rows($comentarios) > 0){
                echo "<div class='table-wrapper'>";
                    echo "<table class='alt'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Mesa</th>";
                                echo "<th>Plato</th>";
                                echo "<th>Valoracion</th>";
                                echo "<th>Comentario</th>";
                                echo "<th>Fecha</th>";
                                echo "<th>Hora</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        
                while ($res = mysqli_fetch_array($comentarios)){
                    $mesa = $obj_selector->darDatosUsuario($res["cliente"], 3);
                    $producto = $obj_selector->darDatosProducto($res["id_producto"]);
                    
                    echo "<tr>";
                    echo "<td>{$mesa["nombre"]}</td>";
                    echo "<td>{$producto["nombre"]}";
                    echo "<td>{$res["valoracion"]}</td>";
                    echo "<td>{$res["comentario"]}</td>";
                    echo "<td>{$res["fecha"]}</td>";
                    echo "<td>{$res["hora"]}</td>";
                    echo "</tr>";
                    
                    
                }
                
            
            
            
        }else{
            //No hay comentarios en el restaurante
            echo "<p>Aún no existen valoraciones hechas por los clientes en el restaurante.</p>";
        }
        break;
    default :
        break;
}