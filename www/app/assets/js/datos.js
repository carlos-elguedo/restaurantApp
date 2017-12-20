/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function($) {

$.post(
    RUTA_SERVIDOR,
    function(respuesta){
        console.log("Envio el inicio, esto recibio:\n" + respuesta)
        //Con esta linea de codigo, tomamos la respuesta del servidor y la colocamos en el documento para realizar las acciones
	$("#inicio_datos").html("");
        console.log("Datos: " + respuesta)
	$("#inicio_datos").html(respuesta);
    });//fin del post



})(jQuery);