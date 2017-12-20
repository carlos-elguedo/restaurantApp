<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

require_once '../bdacceso/BD/Actualizador.php';
require_once '../bdacceso/BD/Selector.php';

$obj_actualizador = new Actualizador();
$obj_selector = new Selector();


$mysqli = new mysqli("localhost", "root", "", "restaurante");
$c0 = addslashes($_POST["a1"]);
$c1 = addslashes($_POST["a2"]);
$c2 = addslashes($_POST["a3"]);


if(!$obj_selector->passCorrectaMesa($c0, $c1)){
    //Correcto
    
    $_SESSION["ID"] = $c2;
    $_SESSION["TIPO_USUARIO"] = 3;
                
    echo "<script>";
    echo "location.href = 'cliente.html';";
    echo "</script>";
}else{
    //Acceso incorrecto
}