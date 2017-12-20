<?php

    session_start();

    require_once '../bdacceso/Registro.php';
    
    require_once '../funciones/tieneInyeccion.php';
    require_once '../funciones/verificacionDatos.php';
    require_once '../funciones/manejodatos.php';
    
    
    
    
    
    //Verificamos los datos enviados por el usuario
    $dato1 = addslashes($_POST["dato1"]);
    $dato2 = addslashes($_POST["dato2"]);
    $dato3 = addslashes($_POST["dato3"]);
    $dato4 = addslashes($_POST["dato4"]);
    $dato5 = addslashes($_POST["dato5"]);
    $dato6 = addslashes($_POST["dato6"]);
    
    //Volvemos a verificamos los datos enviados por el usuario
    $dato1 = mysqli_real_escape_string($mysqli, $dato1);
    $dato2 = mysqli_real_escape_string($mysqli, $dato2);
    $dato3 = mysqli_real_escape_string($mysqli, $dato3);
    $dato4 = mysqli_real_escape_string($mysqli, $dato4);
    $dato5 = mysqli_real_escape_string($mysqli, $dato5);
    $dato6 = mysqli_real_escape_string($mysqli, $dato6);
    
    
    //el tipo de usuario enviado desde la app
    $post_tipo_usu = $dato1;
        
    //Tomamos el pais del usuario
    $post_codigo = $dato2;
        
    //El numero telefonico del usuario
    $post_correo = $dato3;
                
    //Tomamos la contraseña enviada de manera encriptada desde la app
    $post_nombre = $dato4;
        
    //Lenguaje establecido por el usuario en la app
    $post_direccion = $dato5;
        
    //Recibimos la opcion escogida para registrarse
    $post_pass = $dato6;
  
    
        //Ahora comprobamos que el correo no tenga una talla mayor a 25
        //Rectificamos que los demas datos tambien no se pasen de talla
        if(tieneTalla($post_correo, 35) && 
            tieneTalla($post_pass, 50) == true &&
            tieneTalla($post_direccion, 60 ) == true &&
            tieneTalla($post_nombre, 45) == true &&
            tieneTalla($post_codigo, 40) == true
        ){
            //Listo, todos los datos estan correctos
                    
            /*La contraseña recibida la desencriptamos, ya que viene encriptada desde el usuario y la volvemos 
            a encriptar para guardarla en la base de datos*/
            $post_pass = desencriptarContra($post_pass);
                    
            //Llenamos este array para el manejo de datos
            $nuevoUsuario = array(
                "t"=> $post_tipo_usu,
                "cr"=> $post_codigo,
                "c"=> $post_correo,
                "n"=> $post_nombre,
                "d"=> $post_direccion,
                "p"=> $post_pass);
                    
            if($post_tipo_usu == 1 || $post_tipo_usu == "1" || $post_tipo_usu == 2 || $post_tipo_usu == "2"){
                        //Creamos el objeto registro para registrar al usuario
                        $ObjRegistro = new Registro($nuevoUsuario);
                        
                        $ObjRegistro->registrarUsuario();
                        
            } else {
                //Si la opcion de registro escogida no corresponde a ninguna establecida, cancelamos el registro
                echo "La opción escogida como registro, no esta contemplada";
            }
                    
        }else{
            //Para las ultimas comprobaciones
            //Codigo aqui...
            echo "Algun(os) dato(s) recibido(s), superá(n) la longitud permitida";
        }
?>