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
        var $id_cliente;	
        var $rutaImagen;
        var $ciudad;
        var $sexo;
        
        
	function Cliente($clienteDB){
            $this->id = $clienteDB["id_usuario"];
            $this->id_cliente = $clienteDB["id_cliente"];//sacamos los datos individualmente
            $this->nombre = $clienteDB["nombre"];
            $this->correo = $clienteDB["correo"];
            $this->edad = $clienteDB["edad"];
            $this->rutaImagen = $clienteDB["ruta_imagen"];
            $this->fechaNac = $clienteDB["fecha_naci"];
            $this->telefono = $clienteDB["telefono"];
            $this->ciudad = $clienteDB["ciudad"];
            $this->sexo = $clienteDB["sexo"];
            
	}
        
        public function __construct($datos) {
            parent::__construct($datos);
        }


        public function buscarTrabajador($trabajadores) {
            //echo "Llego :" . sizeof($trabajadores);
            //echo "Contador :" . count($trabajadores);
            //echo "Llego :" . array_keys($trabajadores);
            
            for($i = 1; $i < sizeof($trabajadores); $i++){
                //echo $trabajadores[$i]["id_usuario"];
                //echo $trabajadores[$i]["id_trabajador"];
                //echo "<br/>";
                
                $id_u = $trabajadores[$i]["id_usuario"];
                $id_t = $trabajadores[$i]["id_trabajador"];
                $fech = $trabajadores[$i]["fecha_naci"];
                $nomb = $trabajadores[$i]["nombre"];
                $corr = $trabajadores[$i]["correo"];
                $serv = $trabajadores[$i]["servicio"];
                $tele = $trabajadores[$i]["telefono"];
                $imag = $trabajadores[$i]["imagen"];
                $edad = $trabajadores[$i]["edad"];
                $ciud = $trabajadores[$i]["ciudad"];
                
                
                echo "<div class='4u 12u$(mobile)''>
			<article class='item'>
                            <a href='../perfil/?cont=$i'
                                class='image fit'><img src='$imag' />
                            </a>
                            <header>
				<h3 class = 'datos'>$nomb</h3>
                                <h3 class = 'datos'>$corr</h3>
                                <h3 class = 'datos'>$edad Años</h3>
                                <h3 class = 'datos'>Ciudad: $ciud</h3>
                            </header>
			</article>
                    </div>";
                
                
            }
            
            /*foreach ($trabajadores as $clave => $valor){
                echo $clave . " - " . $valor . "<br/>";
            }
             */
            
        }
        
        function getId() {
            return $this->id;
        }

        function getId_cliente() {
            return $this->id_cliente;
        }

        function getRutaImagen() {
            return $this->rutaImagen;
        }

        function getCiudad() {
            return $this->ciudad;
        }

        function getSexo() {
            return $this->sexo;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setId_cliente($id_cliente) {
            $this->id_cliente = $id_cliente;
        }

        function setRutaImagen($rutaImagen) {
            $this->rutaImagen = $rutaImagen;
        }

        function setCiudad($ciudad) {
            $this->ciudad = $ciudad;
        }

        function setSexo($sexo) {
            $this->sexo = $sexo;
        }

        
}
?>