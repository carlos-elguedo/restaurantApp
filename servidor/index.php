<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

include ("bdacceso/BD/Selector.php");

$ID = $_SESSION["ID"];
$TIPO_USUARIO = $_SESSION["TIPO_USUARIO"];

if($ID != ""){
    
    $selector = new Selector();
    
    //echo "Se conecto bien " . $ID;
    
    $datos_usuario = $selector->darDatosUsuario($ID, $TIPO_USUARIO);
    
    
    $nombre = $datos_usuario["nombre"];
    //$img_perfil = $datos_persona["imagen_perfil"];
    
    
    
    echo "<script>";
    if(!strcmp($nombre, "") == 0){
        echo    "localStorage.setItem('username', '". $nombre ."');";
        if($TIPO_USUARIO == 1){
            echo    "$('#nombre_ad').html('Administrador: ".$nombre."');";
        }
        if($TIPO_USUARIO == 2){
            echo    "$('#nombre_me').html('Mesero: ".$nombre."');";
        }
        if($TIPO_USUARIO == 3){
            
            echo    "$('#nombre_mesa').html('".$nombre."');";
        }
    }
    /*if(!strcmp($img_perfil, "") == 0){
        echo    "localStorage.setItem('img-perfil', '" . $img_perfil . "');";
    }*/
    //echo "setImagenUsuario(localStorage.getItem('img-perfil'));";
    echo "</script>";
    
    
    
    
    
    
    
    
    
    
    
}else{
    echo "Inicia sesion...";
}


?>