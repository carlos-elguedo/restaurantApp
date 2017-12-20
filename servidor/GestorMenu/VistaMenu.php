<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

require_once '../bdacceso/BD/Insertador.php';
require_once '../bdacceso/BD/Selector.php';
require_once '../funciones/tieneInyeccion.php';
require_once '../funciones/verificacionDatos.php';
require_once '../funciones/manejodatos.php';

$dato1 = addslashes($_POST["tipo"]);

$obj_insertador = new Insertador();
$obj_selector = new Selector();

//Volvemos a verificamos los datos enviados por el usuario
//$dato1 = mysqli_real_escape_string($mysqli,$dato1);
//$dato2 = mysqli_real_escape_string($mysqli,$dato2);

//Empezamos a tomar los datos recibidos en variables
//El identificador de acceso, el correo
$tipo_de_accion = $dato1;

switch ($tipo_de_accion){
    case 1:
        //Para Mostrar los elementos del menu en una TABLA
        $datos_platos = $obj_selector->darPlatosRestaurante();
        $contador_platos = 0;
        $datos_bebidas = $obj_selector->darBebidassRestaurante();
        $contador_bebidas = 0;
        
        if(mysqli_num_rows($datos_platos) > 0){
            //Si hay platos
            echo "<div class='table-wrapper'>";
                echo "<table class='alt'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Imagen</th>";
                            echo "<th>Nombre</th>";
                            echo "<th>Descripcion</th>";
                            echo "<th>Precio</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($res = mysqli_fetch_array($datos_platos)){
                        echo "<tr>";
                            $r = url_imagenes_productos . $res["ruta_imagen"];
                            echo "<td> <img src = '{$r}'></td>";
                            echo "<td>{$res["nombre"]}</td>";
                            echo "<td>{$res["descripcion"]}</td>";
                            echo "<td>{$res["precio"]}</td>";
                        echo "</tr>";
                        $contador_platos++;
                    }
                    echo "</tbody>";
                    echo "<tfoot>";
                        echo "<tr>";
                            echo "<td colspan='3'>Total de platos</td>";
                            echo "<td>{$contador_platos}</td>";
                        echo "</tr>";
                    echo "</tfoot>";
                echo "</table>";
            echo "</div>";
                    
        }else{
            //No hay platos
            echo "Aun no hay platos almacenados";
        }
        
        if(mysqli_num_rows($datos_bebidas) > 0){
            //Si hay bebidas
            echo "<p>Bebidas</p>";
            echo "<div class='table-wrapper'>";
                echo "<table class='alt'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Imagen</th>";
                            echo "<th>Nombre</th>";
                            echo "<th>Descripcion</th>";
                            echo "<th>Precio</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($res = mysqli_fetch_array($datos_bebidas)){
                        echo "<tr>";
                            $r = url_imagenes_productos . $res["ruta_imagen"];
                            echo "<td> <img src = '{$r}'></td>";
                            echo "<td>{$res["nombre"]}</td>";
                            echo "<td>{$res["descripcion"]}</td>";
                            echo "<td>{$res["precio"]}</td>";
                        echo "</tr>";
                        $contador_bebidas++;
                    }
                    echo "</tbody>";
                    echo "<tfoot>";
                        echo "<tr>";
                            echo "<td colspan='3'>Total de bebidas</td>";
                            echo "<td>{$contador_bebidas}</td>";
                        echo "</tr>";
                    echo "</tfoot>";
                echo "</table>";
            echo "</div>";
        }else{
            //No hay bebidas
            echo "Aun no hay bebidas almacenados";
        }
        
        
        break;
        
    case 2:
        //Para  devolver una TABLA con la opcion de eliminar elementos del menu
        //Para Mostrar los elementos del menu en una TABLA
        $datos_platos = $obj_selector->darPlatosRestaurante();
        $contador_platos = 0;
        $datos_bebidas = $obj_selector->darBebidassRestaurante();
        $contador_bebidas = 0;
        
        if(mysqli_num_rows($datos_platos) > 0){
            //Si hay platos
            echo "<p>Platos</p>";
            echo "<div class='table-wrapper'>";
                echo "<table class='alt'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Imagen</th>";
                            echo "<th>Nombre</th>";
                            echo "<th>Precio</th>";
                            echo "<th>Acción</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($res = mysqli_fetch_array($datos_platos)){
                        echo "<tr>";
                            $r = url_imagenes_productos . $res["ruta_imagen"];
                            echo "<td> <img src = '{$r}'></td>";
                            echo "<td>{$res["nombre"]}</td>";
                            echo "<td>{$res["precio"]}</td>";
                            echo "<td><a onclick=\"eliminarAlimentoAdmin({$res["id"]})\" class='button special fit small'>Eliminar</a></td>";
                        echo "</tr>";
                        $contador_platos++;
                    }
                    echo "</tbody>";
                    echo "<tfoot>";
                        echo "<tr>";
                            echo "<td colspan='3'>Total de platos</td>";
                            echo "<td>{$contador_platos}</td>";
                        echo "</tr>";
                    echo "</tfoot>";
                echo "</table>";
            echo "</div>";
                    
        }else{
            //No hay platos
            echo "Aun no hay platos almacenados";
        }
        
        if(mysqli_num_rows($datos_bebidas) > 0){
            //Si hay bebidas
            echo "<p>Bebidas</p>";
            echo "<div class='table-wrapper'>";
                echo "<table class='alt'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Imagen</th>";
                            echo "<th>Nombre</th>";
                            echo "<th>Precio</th>";
                            echo "<th>Acción</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($res = mysqli_fetch_array($datos_bebidas)){
                        echo "<tr>";
                            $r = url_imagenes_productos . $res["ruta_imagen"];
                            echo "<td> <img src = '{$r}'></td>";
                            echo "<td>{$res["nombre"]}</td>";
                            echo "<td>{$res["precio"]}</td>";
                            echo "<td><a onclick=\"eliminarAlimentoAdmin({$res["id"]})\" class='button special fit small'>Eliminar</a></td>";
                        echo "</tr>";
                        $contador_bebidas++;
                    }
                    echo "</tbody>";
                    echo "<tfoot>";
                        echo "<tr>";
                            echo "<td colspan='3'>Total de bebidas</td>";
                            echo "<td>{$contador_bebidas}</td>";
                        echo "</tr>";
                    echo "</tfoot>";
                echo "</table>";
            echo "</div>";
        }else{
            //No hay bebidas
            echo "Aun no hay bebidas almacenados";
        }
        break;

        
        
        
        
        
        
        
    case 3:
        //Para devolver el menu en forma de vision para el cliente
        //echo "llego al 3";
        $datos_platos = $obj_selector->darPlatosRestaurante();
        $contador_platos = 0;
        
        while ($res = mysqli_fetch_array($datos_platos)){
            $r = url_imagenes_productos . $res["ruta_imagen"];
            
            echo "<article class='style1' onclick=\"verPlato({$res["id"]}, '{$res["nombre"]}', '{$res["descripcion"]}', {$res["precio"]}, '{$r}')\">";
                echo "<span class='image'>";
                    echo "<img src='{$r}' alt='' />";
                echo "</span>";
                echo "<a class='ver_plato'>";
                    echo "<h2>{$res["nombre"]}</h2>";
                    echo "<div class='content'>";
                        echo "<p>{$res["descripcion"]}</p>";
                    echo "</div>";
                echo "</a>";
            echo "</article>";
            //echo "<td><a onclick=\"eliminarAlimentoAdmin({$res["id"]})\" class='button special fit small'>Eliminar</a></td>";
            $contador_platos++;
        }
        //echo "<script src='assets/js/transiciones.js'></script>";



                            
                                
                            
              
        break;

        
        
        
        
        
        
        
        

    case 4:
        $datos_bebidas = $obj_selector->darBebidassRestaurante();
        $contador_bebidas = 0;
        
        while ($res = mysqli_fetch_array($datos_bebidas)){
            $r = url_imagenes_productos . $res["ruta_imagen"];
            
            echo "<article class='style1' onclick=\"verBebida({$res["id"]}, '{$res["nombre"]}', '{$res["descripcion"]}', {$res["precio"]}, '{$r}')\">";
                echo "<span class='image'>";
                    echo "<img src='{$r}' alt='' />";
                echo "</span>";
                echo "<a class='ver_bebida'>";
                    echo "<h2>{$res["nombre"]}</h2>";
                    echo "<div class='content'>";
                        echo "<p>{$res["descripcion"]}</p>";
                    echo "</div>";
                echo "</a>";
            echo "</article>";
            $contador_bebidas++;
        }


        break;
        
        
        
        
        
        
        
        
   
    case 5:
        //Para devolver el menu en TABLA DE EDICION
        $datos_platos = $obj_selector->darPlatosRestaurante();
        
        $datos_bebidas = $obj_selector->darBebidassRestaurante();
        
        if(mysqli_num_rows($datos_platos) > 0){
            //Si hay platos
            echo "<p>Platos</p>";
            echo "<div class='table-wrapper'>";
                echo "<table class='alt'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Nombre</th>";
                            echo "<th>Precio</th>";
                            echo "<th>Acción</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($res = mysqli_fetch_array($datos_platos)){
                        $r = url_imagenes_productos . $res["ruta_imagen"];
                        echo "<tr>";
                            echo "<td>{$res["nombre"]}</td>";
                            echo "<td>\${$res["precio"]}</td>";
                            echo "<td><a onclick=\"editarAlimentoAdmin({$res["id"]}, '{$res["nombre"]}', '{$r}', {$res["precio"]}, '{$res["descripcion"]}', '{}')\" class='button special fit small'>Editar</a></td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                echo "</table>";
            echo "</div>";
                    
        }else{
            //No hay platos
            echo "Aun no hay platos almacenados";
        }
        
        if(mysqli_num_rows($datos_bebidas) > 0){
            //Si hay bebidas
            echo "<p>Bebidas</p>";
            echo "<div class='table-wrapper'>";
                echo "<table class='alt'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Nombre</th>";
                            echo "<th>Precio</th>";
                            echo "<th>Acción</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($res = mysqli_fetch_array($datos_bebidas)){
                        $r = url_imagenes_productos . $res["ruta_imagen"];
                        echo "<tr>";
                            echo "<td>{$res["nombre"]}</td>";
                            echo "<td>\${$res["precio"]}</td>";
                            echo "<td><a onclick=\"editarAlimentoAdmin({$res["id"]}, '{$res["nombre"]}', '{$r}', {$res["precio"]}, '{$res["descripcion"]}', '{}')\" class='button special fit small'>Editar</a></td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                echo "</table>";
            echo "</div>";
        }else{
            //No hay bebidas
            echo "Aun no hay bebidas almacenados";
        }
        
        break;
    default:
        
        break;
}

?>
