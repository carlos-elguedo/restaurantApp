/* global RUTA_SERVIDOR */
var RUTA_SERVIDOR = "http://localhost/AppRestaurante/servidor/";

/**
 * Funcion para saber si un elemnto esta en un array
 */
Array.prototype.contains = function(element) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == element) {
            return true;
        }
    }
    return false;
}



/**
 * Esta funcion es para limpiar los campos del formulario especifico
 * Recibe una variable numerica que indica el formulario a limpiar
 */
function limpiarCampos(caso){
    switch(caso){
        case 1:
            document.getElementById("dato_de_acceso").value = "";
            document.getElementById("pass_acceso").value = "";

        break;
        case 2:

        break;
        default:

        break;
    }
}


/**
 * Funcion para saber si una determinada variable cumple con la longitud dada
 * Recibe la cadena a comprobar
 * Recibe la talla a saber 
 */
function cumpleTalla(cadena, minimo){
    var ret = false;


    if(cadena.length >= minimo){
        ret = true;
    }
    //alert(minimo + " - Talla menor bless: " + cadena.length);
    return ret;
}

/**
 * Funcion para saber si una determinada variable cumple con la longitud dada
 * Recibe la cadena a comprobar
 * Recibe la talla a saber 
 */
function cumpleTallaMaxima(cadena, maxima){
    var ret = false;


    if(cadena.length <= maxima){
        ret = true;
    }else{
        
    }
    //alert(minimo + " - Talla menor bless: " + cadena.length);
    return ret;
}

/**
 * Funcion para saber si una determinada variable cumple con la longitud especifica dada
 * Recibe la cadena a comprobar
 * Recibe la talla especifica 
 */
function cumpleTallaEspecifica(cadena, talla){
    var ret = false;


    if(cadena.length == talla){
        ret = true;
        //alert("La talla de: " + cadena + "Es correcta: " + cadena.length + "->" + talla);
    }else{
        //alert("La talla de: " + cadena + "Es mala: " + cadena.length + "->" + talla);
    }
    //alert(minimo + " - Talla menor bless: " + cadena.length);
    return ret;
}


/**
 * Funcion para encriptar la contraseña
 * recibe la contraseña sin encriptar y devuelve la encriptada
 */
function encriptarContra(contra){
    var ret = "";

    ret = contra;

    return ret; 
}

function validarEmail( email ) {
    var ret = false;
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) ){
        alert("La dirección de correo \"" + email + "\" es incorrecta.");
        ret = false;
    }else{
        ret = true;
		//alert("correo correcto: " + email);
        //alert("Email correcto");
    }
    return ret;
}//Fin de la funcion validar correo
