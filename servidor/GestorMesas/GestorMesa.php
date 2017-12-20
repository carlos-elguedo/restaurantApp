<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

require_once '../bdacceso/BD/Insertador.php';
require_once '../bdacceso/BD/Selector.php';
require_once '../bdacceso/BD/Actualizador.php';
require_once '../funciones/tieneInyeccion.php';
require_once '../funciones/verificacionDatos.php';
require_once '../funciones/manejodatos.php';

$dato1 = addslashes($_POST["tipo"]);

$obj_insertador = new Insertador();
$obj_selector = new Selector();
$obj_actualizador = new Actualizador();

//Volvemos a verificamos los datos enviados por el usuario
//$dato1 = mysqli_real_escape_string($mysqli,$dato1);
//$dato2 = mysqli_real_escape_string($mysqli,$dato2);

//Empezamos a tomar los datos recibidos en variables
//El identificador de acceso, el correo
$tipo_de_accion = $dato1;

switch ($tipo_de_accion){
    case 1:
        //Para agragar una nieva mesa
        $nombre_mesa = addslashes($_POST["dato1"]);
        $contra_mesa = addslashes($_POST["dato2"]);

        //echo "Llego: " . $nombre_mesa . " - " . $contra_mesa;
        $DATOS = $obj_selector->darDatosUsuario($_SESSION["ID"], $_SESSION["TIPO_USUARIO"]);
        
        if($obj_selector->existeMesa($nombre_mesa)){
            //Existe una mesa con ese nombre, por lo que hay que advertirle, o cambiar su estado si esta desactivada
            
            //Como ya existe, comprobamos si esta activa:
            if($obj_selector->mesaEstaActiva($nombre_mesa)){
                //No puede agregar la mesa porque ya existe
                echo "<label style='color:green'>La mesa ya existe y esta activa</label>";
            }else{
                //Puede agregar la mesa cambiandole el estado, reactivandola
                
                if($obj_actualizador->reactivarMesa($nombre_mesa, $contra_mesa, $DATOS["nombre"], $DATOS["correo"])){
                    echo "<label style='color:green'>La mesa ha sido reactivada</label>";
                    echo "<script>";
                    echo "$('#nombre_mesa_nueva').val('');";
                    echo "$('#contra_mesa_nueva').val('');";
                    echo "mesasActualesAdmi(1);";
                    echo "mesasActualesAdmi(2);";
                    echo "mesasActualesEliminarAdmi();";
                    echo "</script>";
                }else{
                    echo "<label style='color:green'>Esta cuenta ya existe y no se ha podido reactivar</label>";
                }
            }//Fin del else 
            
            
            
        }else{
            $resultado = $obj_insertador->insertarMesaNueva($nombre_mesa, $contra_mesa, $DATOS["nombre"], $DATOS["correo"]);
        
            if($resultado){
                echo "<script>";
                echo "$('#nombre_mesa_nueva').val('');";
                echo "$('#contra_mesa_nueva').val('');";
                echo "mesasActualesAdmi(1);";
                echo "mesasActualesAdmi(2);";
                echo "mesasActualesEliminarAdmi();";
                echo "</script>";
                echo "<label style='color:green'>Agrego la mesa correctamente</label>";
            }else{
                echo "No se pudo insertar la mesa";
            }
        }
        
        break;
        
    case 2:
        //Para listar las mesas existentes
        $datos_clientes = $obj_selector->darMesasRestaurante();
        //echo "Llego al caso: ". sizeof($datos_clientes);
        echo "<div class='table-wrapper'>";
            echo "<table class='alt'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Nombre</th>";
                        echo "<th>Contraseña</th>";
                        echo "<th>Fecha de registro</th>";
                        echo "<th>Estado</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
        //for($i = 0; $i< sizeof($datos_clientes); $i++){
        while ($res = mysqli_fetch_array($datos_clientes)){
                    echo "<tr>";
                        echo "<td>{$res["nombre_mesa"]}</td>";
                        echo "<td>{$res["contra_mesa"]}</td>";
                        echo "<td>{$res["fecha_registro"]}</td>";
                        if($res["activo"] == 1){
                            //La mesa esta activa
                            echo "<td><label style='color:green'>Activa</label></td>";
                        }else{
                            //La mesa no esta activa
                            echo "<td><label style='color:black'>Inactiva</label></td>";
                        }
                    echo "</tr>";
        }
        
                echo "</tbody>";
            echo "</table>";
        echo "</div>";
        
        break;
        
    case 3:
        //Para mostrar una lista de las mesas a eliminar
        $datos_clientes = $obj_selector->darMesasRestaurante();
        //echo "Llego al caso: ". sizeof($datos_clientes);
        echo "<div class='table-wrapper'>";
            echo "<table class='alt'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Nombre</th>";
                        echo "<th>Fecha de registro</th>";
                        echo "<th>Acción</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
        //for($i = 0; $i< sizeof($datos_clientes); $i++){
        while ($res = mysqli_fetch_array($datos_clientes)){
                    echo "<tr>";
                        echo "<td>{$res["nombre_mesa"]}</td>";
                        echo "<td>{$res["fecha_registro"]}</td>";
                        echo "<td><a onclick=\"eliminarMesaAdmin({$res["id_cliente"]}, '{$res["nombre_mesa"]}')\" class='button special fit small'>Eliminar</a></td>";
                    echo "</tr>";
        }
        
                echo "</tbody>";
            echo "</table>";
        echo "</div>";
        break;
        
    case 4:
        //Para eliminar la mesa recibida
        $id_mesa = addslashes($_POST["d1"]);
        $nom_mesa = addslashes($_POST["d2"]);
        $DATOS = $obj_selector->darDatosUsuario($_SESSION["ID"], $_SESSION["TIPO_USUARIO"]);
        
        $resultado = $obj_actualizador->eliminarDesactivarMesa($id_mesa, $nom_mesa, $DATOS["nombre"], $DATOS["correo"]);
        if($resultado){
            echo "<script>";
            echo "mesasActualesAdmi(1);";
            echo "mesasActualesAdmi(2);";
            echo "mesasActualesEliminarAdmi();";
            echo "</script>";
            echo "<label style='color:green'>La mesa ha sido eliminada correctamente</label>";
        }else{
            echo "Eliminar la mesa";
        }
        
        break;
    default:
        
        break;
}

?>
