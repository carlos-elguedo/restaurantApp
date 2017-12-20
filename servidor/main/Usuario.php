<?php
/**
 * @author Jhonny Luna, Zamir Martelo, Rafael Castellar
 * @copyright 2017
 */

class Usuario{
    var $id;
    var $nombre;
    var $correo;
    var $edad;
    var $tipo;
    var $pass;

    public function __construct($datos) {
        $this->nombre = $datos["nombres"];
        $this->correo = $datos["email"];
        $this->edad = $datos["edad"];
        $this->tipo = $datos["tipo"];
        $this->pass = $datos["contra"];
    }


    //Getters...
    public function get_Nombres(){
        return $this->nombre;
    }
    public function get_Correo(){
        return $this->correo;
    }
    public function get_Edad(){
        return $this->edad;
    }
    public function get_Tipo(){
        return $this->tipo;
    }
    public function get_Pass(){
        return $this->pass;
    }
    
    public function iniciarSesion($nombre_correo, $pass) {
        $correcto = $iniciarSesion();
        return $correcto;
    }
    
    public function cerrarSesion(){
        $correcto = $cerrarSesion();
        return $correcto;
    }


    public function to_string(){
        return "Nombre: " . $this->nombre . " Correo: " . $this->correo . " Tipo Usuario: " . $this->tipo;
    }

    //Setters...
    public function set_Nombres($valor=''){
        $this->nombre = $valor;
    }
    public function set_Correo($valor=''){
        $this->correo = $valor;
    }
    public function set_Edad($valor=''){
        $this->edad = $valor;
    }
    public function set_Tipo($valor=''){
        $this->tipo = $valor;
    }
    public function set_Pass($valor=''){
        $this->passs = $valor;
    }






}

 ?>