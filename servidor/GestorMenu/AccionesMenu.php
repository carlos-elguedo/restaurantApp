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
    case 1:
        //Para eliminar un elemento del menu
        $id_producto = addslashes($_POST["d1"]);
        
        $DATOS = $obj_selector->darDatosUsuario($_SESSION["ID"], $_SESSION["TIPO_USUARIO"]);
        
        $res = $obj_actualizador->eliminarDesactivarProducto($id_producto, $DATOS["nombre"], $DATOS["correo"]);
        
        if($res){
            echo "<script>";
            echo "traerMenu(1);";
            echo "traerMenuParaEliminar(1);";
            echo "</script>";
            echo "<label style='color:green'>Ha sido eliminado correctamente</label>";
        }
        
        
        break;
    
    
    
    
    
    default:
        break;
}



?>