<?php

//session_start();

include ("conexion/conexion.php");
include ("../bdacceso/BD/Actualizador.php");
require_once '../funciones/Idiomas.php';
include ("funcionesbd.php");
include ("Utilidadesbd.php");

//$conexion = $mlconexion;

class InicioSesion{
    var $usuario;
    //var $selector;
    var $ID;
    var $TIPO_USUARIO;
    var $obj_actualizador;
    
    
    public function __construct($datos) {
        $this->usuario = $datos;
        $this->obj_actualizador = new Actualizador();
        //$this->selector = new Selector();
        
    }//Fin del constructor
    
    
    /**
     * Esta funcion es la principal de esta clase e iniciara la sesion del usuario recibido recibido en su constructor
     */
     public function iniciarSesion(){
        //Objeto para establecer la conexion
        $mysqli = new mysqli("localhost", "root", "", "restaurante");
        //Tomamos esta variable para el control y funcionamiento de la uncion
        $estado_inicio_sesion = 0;
        /* 0->nada
         * 1->correcto
         * 2->contraseña incorrecta
         * 3->dato de acceso no existe
         * 4->Esta en los Preusuarios
         * 
         */
        //Esta variable indica de que forma accedio el usuario, si por correo o por telefono
        $tipo_acceso = 0;
        

        //Tomamos las variables recibidas desde el usuario
        $usuario_dato_acceso   = $this->usuario["a"];
        $usuario_contra_acceso   = $this->usuario["c"];
        //$usuario_lenguaje_acceso   = $this->usuario["l"];
        
        //Definimos el objeto lenguaje
        //$lenguaje_db = new Idiomas($usuario_lenguaje_acceso);
                

        //Creamos las consultas para obtener la forma de acceso
        $sql_correo = "SELECT * FROM usuario WHERE correo ='$usuario_dato_acceso' AND estado = 1;";//sentencia de la consulta
        //$sql_telefono = "SELECT contrasenia, id_usuario, id_persona FROM usuario WHERE telefono ='$usuario_dato_acceso' OR telefono_con_codigo = '$usuario_dato_acceso'";
        
        //Primero comprobamos para el correo
        //Ejecutamnos la consulata y comprobamos que haya sido exitosa
        $resultado_buscar_usuario_correo =  mysqli_query($mysqli, $sql_correo) or die ("No pudo buscar el correo en la tabla usuario: " . mysqli_error());
        
        //Si el numero de filas es mayor a 0, quiere decir que si existe en la tabla usuario un correo como el recibido
        if (mysqli_num_rows($resultado_buscar_usuario_correo) > 0){
            //Indicamos que el ipo de acceso fue el correo
            $tipo_acceso = 1;                
            
            //obtnrmos los datos de la consulta y los almacenamos en esta variable
            $datos = mysqli_fetch_assoc($resultado_buscar_usuario_correo);
            //separamos los datos de la consulta
            $usuPass = $datos["password"];
            $usuID = $datos["id"];
            $usuNombre = $datos["nombre"];
            $this->TIPO_USUARIO = $datos["tipo_usuario"];
            $this->ID = $usuID;
                
            
            //Desencriptamos la contraseña sacada para comprobarla con la recibida desde el usuario
            $contra = desencriptarContraParaBaseDatos($usuPass);
                
            //Ahora compramos que las contraseñas sean iguales
            if(strcmp($usuario_contra_acceso, $contra) == 0){
                //Puede acceder con su correo
                $estado_inicio_sesion = 1;
                
            }else{
            //contraseña incorrecta
            $estado_inicio_sesion = 2;
            }
        }else{
            //si ese correo no existe como correo en la tabla usuarios
            $estado_inicio_sesion = 3;
        }
        
        
        switch ($estado_inicio_sesion){
            
            //Antes de imprimir se debe manejar el IDIOMA
            
            case 0:
                //No ingreso a ninguna parte no se cambio el valor de esta varibale
                echo darCodigoDeAlerta1() . "Intentalo de nuevo" . darCodigoDeAlerta2();
                break;
            case 1:
                //Fue exitoso el inicio de sesion y puede ingresar al sistema
                //echo darCodigoDeAlerta1() . $lenguaje_db->ini_adelante. darCodigoDeAlerta2();
                //Redireccionamos a la pagina principal de la aplicacion
                $_SESSION["ID"] = $this->ID;
                $_SESSION["TIPO_USUARIO"] = $this->TIPO_USUARIO;
                
                echo "<script>";
                //Guardar los datos del usuario en la memoria interna...
                //Guardamos el dato de acceso
                echo "localStorage.setItem('usu', '".$usuario_dato_acceso ."');";
                //La contraseña
                echo "localStorage.setItem('con', '".$usuPass ."');";
                //Guardamos el indicador de inicio de sesion
                //echo "localStorage.setItem('sav', '1');";
                if($this->TIPO_USUARIO == 1){
                    //Es un usuario administrador, lo dirigimos a su pagina de administraicon
                    echo "location.href = 'app/administrador.html?u=$usuNombre';";
                    //echo "$('#admi_name1').html('.$usuNombre.');";
                }
                if($this->TIPO_USUARIO == 2){
                    //Es un usuario mesero, lo dirigimos a su pagina de empleado
                    echo "location.href = 'app/mesero.html';";
                }
                if($this->TIPO_USUARIO == 3){
                    //Es un usuario mesero, lo dirigimos a su pagina de empleado
                    $r = $this->obj_actualizador->activarCliente($this->ID);
                    
                    if($r){
                        echo "location.href = 'app/cliente.html';";
                    }else{
                        echo "alert({$r});";
                    }
                    
                    
                }
                echo "</script>";
                
                break;
            case 2:
                //La contraseña del usuario es incorrecta
                echo darCodigoDeAlerta1() . "La contraseña ingresada es incorrecta" . darCodigoDeAlertaAceptar_permanecer(). darCodigoDeAlerta2();
                break;
            case 3:
                //El correo no existe
                echo darCodigoDeAlerta1() . "El correo ingresado no esta registrado" . darCodigoDeAlertaAceptar_permanecer() . darCodigoDeAlerta2();
                break;
            default :
                echo darCodigoDeAlerta1() . "Intentalo de nuevo" . darCodigoDeAlerta2();
                break;
                
        }
        
        
    }//Fin de la funcion principal inicio de sesion
     
     
    
    
    
    
    
}//Fin de la clase

?>