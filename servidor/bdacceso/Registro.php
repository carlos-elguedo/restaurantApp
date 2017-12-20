<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//session_start();

//require_once 'Selector.php';
require_once 'conexion/conexion.php';
require_once '../funciones/Idiomas.php';
include ("funcionesbd.php");
include ("Utilidadesbd.php");


//$conexion = $mlconexion;

class Registro{
    var $usuarioNuevo;
    //var $selector;
    
    
    public function __construct($datos) {
        $this->usuarioNuevo = $datos;
        //$this->selector = new Selector();
        
    }//Fin del constructor
    
    

    /**
     * Esta funcion es la principal de esta clase, registrara un usuario, tiene acciones privilegiadas como de consulta 
     * actualizar y insertar en la base de datos
     */
    public function registrarUsuario(){
        
        //Esta variable es la que indica el estado del registro del nuevo usuario
        $registroExitoso = false;
        $puede_registrarse_con_su_forma_registro_escogida = false;
        $puede_con_correo = false;
        
        //Empezamos sacando los datos recibidos...
        $usuario_nuevo_correo   = $this->usuarioNuevo["c"];
        $usuario_nuevo_nombre = $this->usuarioNuevo["n"];
        $usuario_nuevo_direccion = $this->usuarioNuevo["d"];
        $usuario_nuevo_contra = $this->usuarioNuevo["p"];
        $usuario_nuevo_codigo = $this->usuarioNuevo["cr"];
        $usuario_nuevo_tipo = $this->usuarioNuevo["t"];
        //echo "------------------" . $usuario_nuevo_nombre;
        //$lenguaje_bd = new Idiomas($usuario_nuevo_lenguaje);
        
        
        //Lo primero es comprobar que estos datos ya no esten registrados
        
        if($this->existeCorreoRegistrado($usuario_nuevo_correo) == false){
            //Si entra aqui es porque su correo esta disponible
            $puede_con_correo = true;
        } else {
            $puede_con_correo = false;
        }
        
        
        //Ya tenemos su forma de registro, ahora procedemos con el registro
        if($puede_con_correo == true){
            //Empecemos...
            
            //variabes que contiene codigo dinamico
            $sql_donde = "";
            //$_SESSION["ID"] =;
            
            //Sacamos la forma en que se registro para asignar la consulta
            if($usuario_nuevo_tipo == "1" || $usuario_nuevo_tipo == 1){
                $sql_donde = "administrador";
                //Comprobamos el codigo ingresado por el usuario para saber si puede continuar con el registroo
                $puede_registrarse_con_su_forma_registro_escogida = $this->escorrectoCodigoRegistro($usuario_nuevo_codigo, 1);
            }else{
                $sql_donde = "mesero";
                //Comprobamos el codigo ingresado por el usuario para saber si puede continuar con el registroo
                $puede_registrarse_con_su_forma_registro_escogida = $this->escorrectoCodigoRegistro($usuario_nuevo_codigo, 2);
            }
            
            if($puede_registrarse_con_su_forma_registro_escogida == true){
                //Puede registrarse correctamente
                

                //Antes de seguir comprobamos si el codigo ingresado para el registro es correcto


                $fecha = date("Y-m-d");
                $hora = date("H:i:s");
                $fecha_y_hora = date("Y-m-d H:i:s");



                //Llamamos a esta funcion que genera el codigo de activacion para este usuario
                //$codigo_activacion = generarCodigoActivacion();

                //Encriptamos la contrase�a para guardarla en la base de datos
                $pass_encrip = encriptarContraParaBaseDatos($usuario_nuevo_contra);

                //Enviamos el codigo de activacion a la forma de acceso especificada
                //Aqui falta a quien se lo mandara
                //enviarCodigoDeActivacion($forma_de_activacion, $codigo_activacion);

                //La sentencia para ingresar en la tabla preusuario            
                $sql_insertar_usuario = "INSERT INTO usuario"
                            . " (correo, nombre, direccion, password, tipo_usuario, fecha_registro, estado)"
                            . " VALUES"
                            . " ('$usuario_nuevo_correo', '$usuario_nuevo_nombre', '$usuario_nuevo_direccion', '$usuario_nuevo_contra', $usuario_nuevo_tipo, '$fecha', 1)";

                //Ejecutamos la consulta
                $mysqli = new mysqli("localhost", "root", "", "restaurante");

                $resultadoRegistrarUsuario = mysqli_query($mysqli, $sql_insertar_usuario ) or die("No se registro en la tablas Usuario: ".mysqli_error($mysqli));

                if($resultadoRegistrarUsuario == true){
                    //Antes de imprimir el texto, se debe llamar a una funcion para que devuelva el texto a imprimir, a esta funcion se le pasaria el lengiuaje aqui manejado
                    //Texto de informacion                    
                    //Si entra aqui quiere decir que alguien ya habia preregistrado a ese usuario
                    echo darCodigoDeAlerta1() . "Se ha registrado satisfactoriamente". darCodigoDeAlertaAceptarVirgen() . darCodigoDeAlerta2();

                    echo "<script>";
                    //Guardar los datos del usuario en la memoria interna...
                    //Guardamos el dato de acceso
                    //echo "localStorage.setItem('dus', '".$dato_de_acceso_usuario ."');";
                    //La contrase�a
                    //echo "localStorage.setItem('cus', '".$pre_pass ."');";
                    //Guardamos el indicador de inicio de sesion
                    //echo "localStorage.setItem('sav', '1');";
                    //Primera vez
                    //echo "localStorage.setItem('pri', '1');";
                    $sql_sacar_id = "SELECT id FROM usuario WHERE correo = '{$usuario_nuevo_correo}' AND nombre = '{$usuario_nuevo_nombre}'";
                    
                    $res = mysqli_query($mysqli, $sql_sacar_id) or die ("No pudo consultar el id: " . mysqli_error($mysqli));
                    
                    $dato = mysqli_fetch_assoc($res);
                    
                    if($usuario_nuevo_tipo == 1){
                        //Es un usuario administrador, lo dirigimos a su pagina de administraicon
                        $_SESSION["TIPO_USUARIO"] = 1;
                        $_SESSION["ID"] = $dato["id"];
                        echo "location.href = 'app/administrador.html';";
                    }else{
                        //Es un usuario mesero, lo dirigimos a su pagina de empleado
                        $_SESSION["TIPO_USUARIO"] = 2;
                        $_SESSION["ID"] = $dato["id"];
                        echo "location.href = 'app/mesero.html';";
                    }

                    echo "</script>";

                    /*echo "<script>";
                    echo "$('#cancel').click(function(eve){eve.preventDefault();";
                    echo    "$('#mensajes').html('');";
                    echo    "$('#registro').fadeOut(1000, function(){";
                    echo        "$('#activacion1').fadeIn(1000);";
                    echo        "$('#activacion_info_2_1').append('" .$lenguaje_bd->IdiomaCorreoTelefono($sql_donde) . ": ". $sql_dato_de_registro ."');";
                    echo        "$('#dato_usuario_para_activacion').val('" . $sql_dato_de_registro ."');";
                    echo    "});";
                    echo "});";
                    echo "</script>";    
                    */
                    $mysqli->close();
                    $registroExitoso = true;

                } else {
                    //echo darCodigoDeAlerta1(). "No se podido registrar" . darCodigoDeAlertaAceptar() . darCodigoDeAlerta2();
                    echo darCodigoDeAlerta1(). "No se ha podido registrar, ha ocurrido un error con los datos ingresados" . darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2();
                }
            }else{
                //echo "El codigo ingresado no es correcto";
                echo darCodigoDeAlerta1(). "El codigo ingresado para el registro, no es correcto" . darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2();
            }   
                
        }else{
            echo "El correo ingresado ya esta registrado";
            echo darCodigoDeAlerta1(). "El correo ingresado ya esta registrado" . darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2();
            $registroExitoso = false;
        }
        
        
    }//Fin de la funcion registrar usuario
    
    
    
    
    
    
    
    /**
     * Funcion para saber si en la base de datos existe un usuario con el correo dado, esto para evitar muchas cosas
     * Es muy importante y se llama en cada registro
     * @param type $correo_a_verificar El correo a verificar
     * @return boolean el estado del la consulta, si es true puede registrarse, de lo contrario no
     */
    
    public function existeCorreoRegistrado($correo_a_verificar) {
        $retorno = false;
        $sql = "SELECT * FROM `usuario` WHERE correo = '$correo_a_verificar'";
        $mysqli = new mysqli("localhost", "root", "", "restaurante");
        
        $yaEsta = mysqli_query($mysqli, $sql) or die ("No verificar si eziste el usuario: ". mysqli_error($mysqli));

        if (mysqli_num_rows($yaEsta) > 0){//obtenemos el array de la consulta
            $retorno = true;
        }else{//si no esta ya el correo en bd
            $retorno = false;
        }
        $mysqli->close();
        return $retorno;
    }
    
    /**
     * Esta funcion es para comprobar el codigo de registro recibido desde el usuario, esto con el fin de
     * establecer seguridad a la plataforma y que no cualquiera se pueda registrar como administrador y mesero
     * @param type $codigo
     * @param type $tipo
     * @return boolean
     */
    public function escorrectoCodigoRegistro($codigo, $tipo){
        $retorno = false;
        $sql = "";
        if($tipo == 1){
            $sql = "SELECT * FROM `configuraciones` WHERE nombre = 'codigo_admi' AND valor = '$codigo'";
        }else{
            $sql = "SELECT * FROM `configuraciones` WHERE nombre = 'codigo_mesero' AND valor = '$codigo'";
        }
        $mysqli = new mysqli("localhost", "root", "", "restaurante");
        
        $consulta = mysqli_query($mysqli, $sql) or die ("No se pudo verificar en la tabla configuraciones: ". mysqli_error($mysqli));

        if (mysqli_num_rows($consulta) > 0){//obtenemos el array de la consulta
            $retorno = true;
        }else{//si no esta ya el correo en bd
            $retorno = false;
        }
        $mysqli->close();
        return $retorno;
    }
    
    
}//Fin de la clase

?>