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
    
    case 2:
        //Para realizar la busqueda de un plato:
        $texto_buscado = addslashes($_POST["d1"]);
        //echo "<script>";
        //echo "console.log('Llego a la bisqueda')";
        //echo "</script>";
        $datos_platos = $obj_selector->darPlatosRestauranteBusqueda($texto_buscado);
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
        if($contador_platos == 0){
            echo "<section style = 'width:100%'><center> <p>No hay resultados para '$texto_buscado'</p> </center></section>";
            echo "<article class='style1'>";
                echo "<span class='image'>";
                    echo "<img src='images/00.jpg' alt='' />";
                echo "</span>";
                echo "<a class='ver_plato'>";
                    echo "<h2>No resultados</h2>";
                    echo "<div class='content'>";
                        echo "<p>Intenta buscando otro plato nuevamente</p>";
                    echo "</div>";
                echo "</a>";
            echo "</article>";
        }
        break;
        
        
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    case 3:
        //Para realizar la busqueda de una bebida:
        $texto_buscado = addslashes($_POST["d1"]);
        //echo "<script>";
        //echo "console.log('Llego a la bisqueda')";
        //echo "</script>";
        $datos_bebidas = $obj_selector->darBebidasRestauranteBusqueda($texto_buscado);
        $contador_bebidas = 0;
        
        
        while ($res = mysqli_fetch_array($datos_bebidas)){
            $r = url_imagenes_productos . $res["ruta_imagen"];
            
            echo "<article class='style1' onclick=\"verBebida({$res["id"]}, '{$res["nombre"]}', '{$res["descripcion"]}', {$res["precio"]}, '{$r}')\">";
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
            $contador_bebidas++;
        }
        //echo "<script src='assets/js/transiciones.js'></script>";
        if($contador_bebidas == 0){
            echo "<section style = 'width:100%'><center> <p>No hay resultados para '$texto_buscado'</p> </center></section>";
            echo "<article class='style1'>";
                echo "<span class='image'>";
                    echo "<img src='images/00.jpg' alt='' />";
                echo "</span>";
                echo "<a class='ver_bebida'>";
                    echo "<h2>No resultados</h2>";
                    echo "<div class='content'>";
                        echo "<p>Intenta buscando otra bebida nuevamente</p>";
                    echo "</div>";
                echo "</a>";
            echo "</article>";
        }
        break;
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    default:
        break;
}



?>