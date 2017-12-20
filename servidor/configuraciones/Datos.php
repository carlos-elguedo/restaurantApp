<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

require_once '../bdacceso/BD/Actualizador.php';
require_once '../bdacceso/BD/Selector.php';
require_once '../funciones/tieneInyeccion.php';
require_once '../funciones/verificacionDatos.php';
require_once '../funciones/manejodatos.php';

$obj_actualizador = new Actualizador();
$obj_selector = new Selector();

$dato1 = addslashes($_POST["tipo"]);
$dato2 = addslashes($_POST["dato"]);


//Volvemos a verificamos los datos enviados por el usuario
//$dato1 = mysqli_real_escape_string($mysqli,$dato1);
//$dato2 = mysqli_real_escape_string($mysqli,$dato2);

//Empezamos a tomar los datos recibidos en variables
//El identificador de acceso, el correo
$tipo_de_cambio = $dato1;
    
//La contrase�a, recibida difrada desde el cliente
$dato_nuevo_a_cambiar = $dato2;

switch ($tipo_de_cambio){
    case 1:
        //Cambio de codigo de administrador
        $DATOS = $obj_selector->darDatosUsuario($_SESSION["ID"], $_SESSION["TIPO_USUARIO"]);
        //echo $DATOS["nombre"] . " - " . $DATOS["correo"];
        $CAMBIO = $obj_actualizador->cambiarCodigoAdmi($dato_nuevo_a_cambiar, $DATOS["nombre"], $DATOS["correo"]);
        
        if($CAMBIO){
            //echo "Cambio correocto";
            echo "<script>";
            echo "$('#cancel_cam_cod_adm').click();";
            echo "</script>";
            echo "<label style='color:green'>El código ha sido cambiado correctamente</label>";
        } else {
            echo "No se cambio";
        }
        break;
    case 2:
        //Cambio de codigo de mesero
        $DATOS = $obj_selector->darDatosUsuario($_SESSION["ID"], $_SESSION["TIPO_USUARIO"]);
        //echo $DATOS["nombre"] . " - " . $DATOS["correo"];
        $CAMBIO = $obj_actualizador->cambiarCodigoMese($dato_nuevo_a_cambiar, $DATOS["nombre"], $DATOS["correo"]);
        
        if($CAMBIO){
            //echo "Cambio correocto";
            echo "<script>";
            echo "$('#cancel_cam_cod_mes').click();";
            echo "</script>";
            echo "<label style='color:green'>El código de mesero ha sido cambiado correctamente</label>";
        } else {
            echo "No se cambio";
        }
        break;
    case 3:
        //Cambio de contraseña de administrador
        
        break;
    
    
    
    
    case 4:
        //Cambio de nombre de usuario
        $cambio = $obj_actualizador->editarCampoTextoAdmi("nombre", $dato2, $_SESSION["ID"]);
        
        if($cambio){
            echo "<label style='color:green'>Ha sido editado el nombre correctamente</label>";
            echo "<script>";            
            echo "alert('Ha sido editado el nombre correctamente');";
            echo "location.href = 'administrador.html?u=$dato2';";
            echo "</script>";
        }else{
            echo "<label style='color:green'>No se ha podido editar el nombre</label>";
        }
        break;
        
        
    case 5:
        //Cambio de el correo de usuario
        $cambio = $obj_actualizador->editarCampoTextoAdmi("correo", $dato2, $_SESSION["ID"]);
        
        if($cambio){
            echo "<label style='color:green'>Ha sido editado el correo correctamente</label>";
            echo "<script>";
            echo "alert('Ha sido editado el correo correctamente');";
            echo "location.href = 'administrador.html';";
            echo "</script>";
        }else{
            echo "<label style='color:green'>No se ha podido editar el correo</label>";
        }
        break;
        
        
        
    case 6:
        //Cambio de la direccion de usuario
        $cambio = $obj_actualizador->editarCampoTextoAdmi("direccion", $dato2, $_SESSION["ID"]);
        
        if($cambio){
            echo "<label style='color:green'>Ha sido editada la dirección correctamente</label>";
            echo "<script>";
            echo "alert('Ha sido editada la dirección correctamente');";
            echo "location.href = 'administrador.html';";
            echo "</script>";
        }else{
            echo "<label style='color:green'>No se ha podido editar la direccion</label>";
        }
        break;
        
        
    case 8:
        $archivo = $_FILES['img_perfil_a_subir']['tmp_name'];
        $nombreArchivo = $_FILES['img_perfil_a_subir']['name'];
        $tipo = $_FILES ['img_perfil_a_subir'][ 'type' ];

        //Para gestiornar el nombre de la img correctamente:
        $tipo2 = substr($tipo, strrpos($tipo, "/")+1, strlen($tipo));
        $tipo3 = "";

        if($tipo2 == ""){
            $desde = strlen($nombreArchivo) - 6;
            $posible = substr($nombreArchivo, $desde, strlen($nombreArchivo));
            $posicionPunto = strpos($posible, ".");
            $tipo3 = substr($posible, $posicionPunto+1, strlen($posible));
            $tipo2 = $tipo3;
        }
        
        $ruta = $_SESSION["ID"] . "." .$tipo2;

        move_uploaded_file($archivo, "../imagenes/perfil/" . $ruta);

        $guardo = $obj_actualizador->actualizarImagen($_SESSION["ID"], $ruta);

        if($guardo){
            //Guardo la imagen
        }else{
            //No acctualizp
        }
        
        
        
        
        break;
    case 9:
        //Cambio de la direccion de usuario
        $dato3 = addslashes($_POST["dato2"]);
        if(!$obj_selector->passCorrectaAdmi($_SESSION["ID"], $dato2)){
            $cambio = $obj_actualizador->editarCampoTextoAdmi("password", $dato3, $_SESSION["ID"]);
        
            if($cambio){
                echo "<label style='color:green'>Ha sido editada la dirección correctamente</label>";
                echo "<script>";
                echo "alert('Ha sido editada la contraseña correctamente');";
                echo "location.href = 'administrador.html';";
                echo "</script>";
            }else{
                echo "<label style='color:green'>No se ha podido editar la contraseña</label>";
            }
        }else{
            echo "<script>";
            echo "alert('La contraseña antigua no es correcta');";
            echo "</script>";
        }
        
        break;
        
        
    case 10:
        //Cambio de nombre de usuario
        $cambio = $obj_actualizador->editarCampoTextoMesero("nombre", $dato2, $_SESSION["ID"]);
        
        if($cambio){
            echo "<label style='color:green'>Ha sido editado el nombre correctamente</label>";
            echo "<script>";
            echo "alert('Ha sido editado el nombre correctamente');";
            echo "location.href = 'mesero.html?u=$dato2';";
            echo "</script>";
        }else{
            echo "<label style='color:green'>No se ha podido editar el nombre</label>";
        }
        break;
        
        
    case 11:
        //Cambio de el correo de usuario
        $cambio = $obj_actualizador->editarCampoTextoMesero("correo", $dato2, $_SESSION["ID"]);
        
        if($cambio){
            echo "<label style='color:green'>Ha sido editado el correo correctamente</label>";
            echo "<script>";
            echo "alert('Ha sido editado el correo correctamente');";
            echo "location.href = 'mesero.html';";
            echo "</script>";
        }else{
            echo "<label style='color:green'>No se ha podido editar el correo</label>";
        }
        break;
        
        
        
    case 12:
        //Cambio de la direccion de usuario
        $cambio = $obj_actualizador->editarCampoTextoAdmi("direccion", $dato2, $_SESSION["ID"]);
        
        if($cambio){
            echo "<label style='color:green'>Ha sido editada la dirección correctamente</label>";
            echo "<script>";
            echo "alert('Ha sido editada la dirección correctamente');";
            echo "location.href = 'mesero.html';";
            echo "</script>";
        }else{
            echo "<label style='color:green'>No se ha podido editar la direccion</label>";
        }
        break;
        
        
        
        
        
    default:
        
        break;
}

?>