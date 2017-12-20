<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

require_once '../../bdacceso/BD/Insertador.php';
require_once '../../bdacceso/BD/Selector.php';
include '../../main/pedidos/Pedido.php';

$OBJ_SELECTOR = new Selector();


$dato1 = addslashes($_POST["tipo"]);

$obj_insertador = new Insertador();
$obj_selector = new Selector();


$tipo_de_accion = $dato1;

switch ($tipo_de_accion){
    case 1:

        $pedidos_activos = $OBJ_SELECTOR->pedidosActivos();

        if($pedidos_activos>0){
            echo "<script>";
            //echo "console.log('Algo: ' + {$pedidos_activos});";
            //echo "var texto_viejo = $('.cantidad_pedidos_superior').html();";
            echo "$('.cantidad_pedidos_superior').html('Pedidos ({$pedidos_activos})');";
            echo "$('#lateral_mesa_pedidos').html('Administrar pedidos ({$pedidos_activos})');";
            echo "</script>";
        }else{
            //No hay pedidos activos, no mostramos nada
            echo "<script>";
            echo "$('.cantidad_pedidos_superior').html('');";
            echo "$('#lateral_mesa_pedidos').html('Administrar pedidos');";
            echo "</script>";
        }
        break;
    
        
        
        
        
        
    case 2:
        $mesas = $obj_selector->darMesasRestaurante();
        //echo "Llego al caso: ". sizeof($datos_clientes);
        echo "<div class='table-wrapper'>";
            echo "<table class='alt'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Nombre</th>";
                        echo "<th>Estado</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
        //for($i = 0; $i< sizeof($datos_clientes); $i++){
        while ($res = mysqli_fetch_array($mesas)){
                    echo "<tr>";
                        echo "<td>{$res["nombre_mesa"]}</td>";
                        if($res["activo"] == 1){
                            //La mesa esta activa
                            echo "<td><label style='color:green'>La mesa esta Activa</label></td>";
                        }else{
                            //La mesa no esta activa
                            echo "<td><label style='color:black'>La mesa esta inactiva</label></td>";
                        }
                    echo "</tr>";
        }
        
                echo "</tbody>";
            echo "</table>";
        echo "</div>";
        break;
    
        
        
        
    case 3:
        //Para consultar los pedidos atendidos
        $atendidos = $obj_selector->pedidosAtendidos($_SESSION["ID"]);
        
        if(mysqli_num_rows($atendidos) > 0){
            //hAY ATENDIDOS
            echo "<div class='table-wrapper'>";
                echo "<table class='alt'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Mesa</th>";
                            echo "<th>Fecha</th>";
                            echo "<th>Hora</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
            //for($i = 0; $i< sizeof($datos_clientes); $i++){
            while ($res = mysqli_fetch_array($atendidos)){
                $mesa = $obj_selector->darDatosUsuario($res["id_cliente"], 3);
                
                        echo "<tr>";
                            echo "<td>{$mesa["nombre"]}</td>";
                            echo "<th>{$res["fecha"]}</th>";
                            echo "<th>{$res["hora"]}</th>";
                        echo "</tr>";
            }
                    echo "</tbody>";
                echo "</table>";
            echo "</div>";
        }else{
            //No hay nada atendido
            echo "<center>";
            echo "<p>Aun no has atendido mesas</p>";
            echo "</center>";
        }
        
        break;
    
    
    
    
    default :
        echo "Ninguno";
        break;
}






