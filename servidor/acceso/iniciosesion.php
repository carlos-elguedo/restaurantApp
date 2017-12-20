<?php

session_start();


require_once '../bdacceso/InicioSesion.php';
require_once '../funciones/tieneInyeccion.php';
require_once '../funciones/verificacionDatos.php';
require_once '../funciones/manejodatos.php';



$dato1 = addslashes($_POST["acceso1"]);
$dato2 = addslashes($_POST["acceso2"]);


//Volvemos a verificamos los datos enviados por el usuario
$dato1 = mysqli_real_escape_string($mysqli,$dato1);
$dato2 = mysqli_real_escape_string($mysqli,$dato2);

//Empezamos a tomar los datos recibidos en variables
//El identificador de acceso, el correo
$post_forma_acceso = $dato1;
    
//La contrase�a, recibida difrada desde el cliente
$post_contra_acceso = $dato2;
//ECHO "llego";
if(tieneTalla($post_contra_acceso, 40) == true){
    if(tieneTalla($post_forma_acceso, 35) == true){
        //Listo, todo normal
        /*La contrase�a recibida la desencriptamos, ya que viene encriptada desde el usuario y la volvemos 
        a encriptar para guardarla en la base de datos*/
        $post_contra_acceso = desencriptarContra($post_contra_acceso);
                
        //Llenamos este array para el manejo de datos de la iniciada de sesion
        $usuario = array(
            "a"=> $post_forma_acceso,
            "c"=> $post_contra_acceso);
        
        //Creamos este objeto inicio sesion del usuari, pasandole los datos recibidos                        
        $objInicioSesion = new InicioSesion($usuario);
                
        //Llamamos a este metodo que se encarga de terminar la tarea de iniciar sesion
        $objInicioSesion->iniciarSesion();        
                
    }else{
        //El correo suppera la talla
        echo darCodigoDeAlerta1(). "El correo ingresado supera la longitud permitida" . darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2();
    }
}else{
    //La contrase�a recibida supera la talla
    echo darCodigoDeAlerta1(). "La contraseña ingresada supera la longitud permitida" . darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2();
} 
?>