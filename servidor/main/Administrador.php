<?php
//require_once ('Trabajador_Independiente.php');
require_once ('Usuario.php');

/**
 * @author laboratorio sof 1
 * @version 1.0
 * @created 29-oct-2016 02:06:22 p.m.
 */
class Cliente extends Usuario
{

	var $id;
        var $id_administrador;
        var $rutaImagen;
        var $direccion;
        
        
	function Cliente($clienteDB){
            $this->id = $clienteDB["id_usuario"];
            $this->id_cliente = $clienteDB["id_cliente"];//sacamos los datos individualmente
            $this->nombre = $clienteDB["nombre"];
            $this->correo = $clienteDB["correo"];
            $this->edad = $clienteDB["edad"];
            $this->rutaImagen = $clienteDB["ruta_imagen"];
            $this->direccion = $clienteDB["direccion"];            
            
	}
        
        public function __construct($datos) {
            parent::__construct($datos);
        }


        public function buscarTrabajador($trabajadores) {
            
            
        }
        
        
        
        function getId() {
            return $this->id;
        }

        function getRutaImagen() {
            return $this->rutaImagen;
        }

        public function getId_administrador() {
            return $this->id_administrador;
        }

        public function getDireccion() {
            return $this->direccion;
        }

        public function setId_administrador($id_administrador) {
            $this->id_administrador = $id_administrador;
        }

        public function setDireccion($direccion) {
            $this->direccion = $direccion;
        }

                
        function setId($id) {
            $this->id = $id;
        }

        function setRutaImagen($rutaImagen) {
            $this->rutaImagen = $rutaImagen;
        }
        
}
?>