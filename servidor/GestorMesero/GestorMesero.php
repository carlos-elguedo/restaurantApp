<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

require_once '../bdacceso/BD/Selector.php';
require_once '../bdacceso/BD/Actualizador.php';
require_once '../funciones/tieneInyeccion.php';
require_once '../funciones/verificacionDatos.php';
require_once '../funciones/manejodatos.php';

$dato1 = addslashes($_POST["tipo"]);

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
        $meseros = $obj_selector->darMeserosRestaurante();
        echo "<div class='table-wrapper'>";
            echo "<table class='alt'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Nombre</th>";
                        echo "<th>Correo</th>";
                        echo "<th>Dirección</th>";
                        echo "<th>Acción</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
        //for($i = 0; $i< sizeof($datos_clientes); $i++){
        while ($res = mysqli_fetch_array($meseros)){
                    echo "<tr>";
                        echo "<td>{$res["nombre"]}</td>";
                        echo "<td>{$res["correo"]}</td>";
                        echo "<td>{$res["direccion"]}</td>";
                        echo "<td><a onclick=\"eliminarMeseroAdmin({$res["id"]})\" class='button special fit small'>Eliminar</a></td>";
                    echo "</tr>";
        }
                echo "</tbody>";
            echo "</table>";
        echo "</div>";
        break;
        
    case 2:
        $id_mesero = $_POST["d1"];
        $DATOS = $obj_selector->darDatosUsuario($_SESSION["ID"], $_SESSION["TIPO_USUARIO"]);
        $elimino = $obj_actualizador->desactivarMesero($id_mesero, $DATOS["nombre"], $DATOS["correo"], $_SESSION["ID"]);
        
        if($elimino){
            echo "<script>";
            echo "traerMeseros();";
            echo "</script>";
            echo "<label style='color:green'>El mesero ha sido eliminado</label>";
        }else{
            
        }
        
        break;
    default :
        break;
}
