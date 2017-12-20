<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();


//require("../bdacceso/conexion/cerrar.php");

session_destroy();


echo "<script>
    //alert('cerrar sesion correctamente');
    //localStorage.setItem('cus', '');
    //localStorage.setItem('dus', '');
    //localStorage.setItem('sav', '0');
    //localStorage.setItem('img-perfil', '');
    localStorage.setItem('username', '');
    //localStorage.setItem('color', '[200,0,0]');
    
    location.href = '../index.html';
    </script>";
?>