<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../bdacceso/BD/Insertador.php';
require_once '../bdacceso/BD/Selector.php';
require_once '../bdacceso/BD/Actualizador.php';
require_once '../funciones/tieneInyeccion.php';
require_once '../funciones/verificacionDatos.php';
require_once '../funciones/manejodatos.php';


$obj_insertador = new Insertador();
$obj_selector = new Selector();
$obj_actualizador = new Actualizador();


$ID = $_SESSION["ID"];

$ruta = "";
    


$tipo_accion = $_GET["d0"];


switch ($tipo_accion){
    case 1:
        //Para agregar un producto
        
    $archivo = $_FILES['img_ali_a_subir']['tmp_name'];
    $nombreArchivo = $_FILES['img_ali_a_subir']['name'];
    $tipo = $_FILES ['img_ali_a_subir'][ 'type' ];


    $tipo_producto = $_GET["d1"];
    $nombre = $_GET["d2"];
    $descripcion = $_GET["d3"];
    $precio = $_GET["d4"];

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

    if($obj_selector->existeProducto($nombre) == true){

        //Comprobamos si esta activo el producto en cuestion
        if($obj_selector->productoEstaActiva($nombre)){
            //El producto existe y esta activo, por lo tanto no puede añadir uno con el mismo nombre
            echo "<script>";
            echo "alert('Existe un producto con ese mismo nombre en la base de datos')";
            echo "</script>";
        }else{
            //El producto existe pero esta eliminado, por lo que se actualizara el existente
            $ruta = $ID . "-" . $nombre . "." .$tipo2;

            move_uploaded_file($archivo, "../imagenes/menu/" . $ruta);

            $guardo = $obj_actualizador->reactivarProducto($ID, $nombre, $tipo_producto, $descripcion, $precio, $ruta);

            if($guardo){
                $t = "";
                if($tipo_producto == 1){$t = "el plato: ";}else{$t = "la bebida: ";}

                echo '<script>';
                echo '$("#limpiar_nuevo_alimento").click();';
                echo 'alert("Se ha guardado '.$t.$nombre.' correctamente")';
                echo '</script>';
            }else{
                echo '<script>';
                echo 'alert("No pudo guardar el producto")';
                echo '</script>';
            }   
        }
    }else{
        $ruta = $ID . "-" . $nombre . "." .$tipo2;

        move_uploaded_file($archivo, "../imagenes/menu/" . $ruta);

        $guardo = $obj_insertador->insertarProducto($ID, $nombre, $tipo_producto, $descripcion, $precio, $ruta);
        if($guardo){
            $t = "";
            if($tipo_producto == 1){$t = "el plato: ";}else{$t = "la bebida: ";}

            echo '<script>';
            echo '$("#limpiar_nuevo_alimento").click();';
            echo 'alert("Se ha guardado '.$t.$nombre.' correctamente")';
            echo '</script>';
        }else{
            echo '<script>';
            echo 'alert("No pudo guardar el producto")';
            echo '</script>';
        }

    }//Fin del else de que no existia ese nombre en la bd
        break;
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    case 2:
        $archivo = $_FILES['img_ali_a_subir_editar']['tmp_name'];
        $nombreArchivo = $_FILES['img_ali_a_subir_editar']['name'];
        $tipo = $_FILES ['img_ali_a_subir_editar'][ 'type' ];


        $nombre_producto = $_GET["d1"];
        $descripcion_producto = $_GET["d2"];
        $precio_producto = $_GET["d3"];
        $id_producto = $_GET["d4"];

        $producto_viejo = $obj_selector->darDatosProducto($id_producto);
        $imagen_t = "";
        
        //echo "-" . $archivo . "-";
        if(strcmp($archivo,"")==0){
            //echo "esta vacio";
            $imagen_t = $producto_viejo["ruta_imagen"];
        }else{
            //echo "Hay imagen";
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
            
            $ruta = $ID . "-" . $nombre_producto . "." .$tipo2;

            move_uploaded_file($archivo, "../imagenes/menu/" . $ruta);
            
            $imagen_t = $ruta;
        }
        
        $EDICION_CORRECTA = $obj_actualizador->editarProducto($id_producto, $nombre_producto, $descripcion_producto, $precio_producto, $imagen_t);
        
        if($EDICION_CORRECTA){
            
            echo "<label style='color:green'>Se ha editado correctamente correctamente</label>";
        }else{
            echo "<label style='color:green'>No se ha podido editar el producto</label>";
        }
        
        
        
        break;
    default:
        break;
}//Fin del switch

?>