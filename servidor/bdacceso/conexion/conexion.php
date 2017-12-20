<?php
    $servidor = "localhost";
    $usuario = "root";
    $base_de_datos = "restaurante";
    $contra = "";

    
    
    //$conexion = mysqli_connect ($servidor, $usuario, $contra) or die ("No se conecto al servidor: " . mysql_error());
    $mysqli = new mysqli("localhost", "root", "", "restaurante");
    //mysqli_select_db ($conexion, $base_de_datos) or die ("No se conecto a la base de datos: " . mysql_error());
    



?>