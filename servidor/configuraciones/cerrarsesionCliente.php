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


$dato1 = addslashes($_POST["tipo"]);

$tipo_de_accion = $dato1;

switch ($tipo_de_accion){
    case 1:
        $c0 = addslashes($_POST["d0"]);
        $c1 = addslashes($_POST["d1"]);
    	$c2 = addslashes($_POST["d2"]);
        
        if(!$obj_selector->passCorrectaMesa($c1, $c0)){
            if(isset($_SESSION["PEDIDO"])){
                //Tiene pedidos activos
                $ID_PEDIDO = $_SESSION["PEDIDO"];
                $CI_PEDIDO = $_SESSION["PEDIDO_C_I"];

                $R = $obj_actualizador->cerrarPedidos($ID_PEDIDO, $CI_PEDIDO);
                $R2 = $obj_actualizador->desactivarCliente($_SESSION["ID"]);
                if($R && $R2){
                    //Se han cerrado los pedidos
                    session_destroy();
                    echo "<script>
                    localStorage.setItem('usu', '');
                    localStorage.setItem('con', '');
                    localStorage.setItem('username', '');

                    location.href = '../index.html';
                    </script>";
                }else{
                    echo "<script>
                        alert('No ha cerrado sesión correctamente');
                        </script>";
                }

            }else{
                //No tiene pededos activos pordemos cerrar sesion
                session_destroy();
                echo "<script>
                localStorage.setItem('usu', '');
                localStorage.setItem('con', '');
                localStorage.setItem('username', '');

                location.href = '../index.html';
                </script>";
            }
        }else{
            //La contraseña no es correcta
            echo "<script>";
            echo "alert('La contraseña no es correcta')";
            echo "</script>";
            
        }
        break;
    
       
        
        
        
        
        
        
        
    case 2:
        //Para reiniciar
        
        $c0 = addslashes($_POST["d0"]);
        $c1 = addslashes($_POST["d1"]);
    	$c2 = addslashes($_POST["d2"]);
        //echo "Llego--" . $obj_selector->passCorrectaMesa($c1, $c0) . " - " . $c0 . " - " . $c1 . " - " . $c2;
        if(!$obj_selector->passCorrectaMesa($c1, $c0)){
            if(isset($_SESSION["PEDIDO"])){
                //Tiene pedidos activos
                $ID_PEDIDO = $_SESSION["PEDIDO"];
                $CI_PEDIDO = $_SESSION["PEDIDO_C_I"];

                $R = $obj_actualizador->cerrarPedidos($ID_PEDIDO, $CI_PEDIDO);
                $R2 = $obj_actualizador->desactivarCliente($_SESSION["ID"]);
                if($R && $R2){
                    //Se han cerrado los pedidos
                    
                    echo "<script>
                    //alert('cerrar sesion correctamente');
                    var a1 = localStorage.getItem('usu');
                    var a2 = localStorage.getItem('con');
                    iniciarSesion(a1, a2, {$_SESSION["ID"]});

                    //location.href = '../index.html';
                    </script>";
                    session_destroy();
                }else{
                    echo "<script>
                        alert('No ha cerrado sesión correctamente');
                        </script>";
                }

            }else{
                //No tiene pededos activos pordemos cerrar sesion
                
                echo "<script>
                //alert('cerrar sesion correctamente');
                var a1 = localStorage.getItem('usu');
                var a2 = localStorage.getItem('con');
                iniciarSesion(a1, a2, {$_SESSION["ID"]});

                //location.href = '../index.html';
                </script>";
                session_destroy();
            }
        }else{
            //La contraseña no es correcta
            echo "<script>";
            echo "alert('La contraseña no es correcta')";
            echo "</script>";
        }
        break;
    default:
        break;
}


?>