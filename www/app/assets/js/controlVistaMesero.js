/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* global RUTA_SERVIDOR */

$(document).ready(function (){
    //alert("Todo listo");
    $.ajaxSetup({"cache": false});
    setInterval("consultarPedidos()", 1500);
    setInterval("AdministracionPedidos()", 2000);
    setInterval("ClientesActivos()", 2500);
    setInterval("pedidosAtendidos()", 1500);
    /**
     * Controlador 5
     * Para controlar la opcion en el menu lateral para ir a la pantalla del menu del restaurante
     */
    $("#lateral_mesa_inicio").click(function(ev){
        ev.preventDefault();
        //alert("Se dio click");
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_CLIENTES_MESERO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_CLIENTES_MESERO").hide();
        $("#PANTALLA_PEDIDOS_MESERO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_PEDIDOS_MESERO").hide();
        $("#PANTALLA_HISTORIAL_MESERO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_HISTORIAL_MESERO").hide();
        
        
        $("#PANTALLA_INICIO_MESERO").show();
        $("#PANTALLA_INICIO_MESERO").addClass("FOCO_PRINCIPAL");
        $(".volver_atras_inicio_mesero").hide();
        
        $(".volver_atras_inicio_mesero").click();
    });
    
    $("#lateral_mesa_pedidos").click(function(eve){
        eve.preventDefault();
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_CLIENTES_MESERO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_CLIENTES_MESERO").hide();
        $("#PANTALLA_INICIO_MESERO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_INICIO_MESERO").hide();
        $("#PANTALLA_HISTORIAL_MESERO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_HISTORIAL_MESERO").hide();
        
        
        $("#PANTALLA_PEDIDOS_MESERO").show();
        $("#PANTALLA_PEDIDOS_MESERO").addClass("FOCO_PRINCIPAL");
        $(".volver_atras_inicio_mesero").hide();
    });
    
    $("#lateral_mesa_clientes").click(function(eve){
        eve.preventDefault();
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_INICIO_MESERO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_INICIO_MESERO").hide();
        $("#PANTALLA_PEDIDOS_MESERO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_PEDIDOS_MESERO").hide();
        $("#PANTALLA_HISTORIAL_MESERO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_HISTORIAL_MESERO").hide();
        
        
        $("#PANTALLA_CLIENTES_MESERO").show();
        $("#PANTALLA_CLIENTES_MESERO").addClass("FOCO_PRINCIPAL");
        $(".volver_atras_inicio_mesero").hide();
    });
    
    $("#lateral_mesa_historial").click(function(eve){
        eve.preventDefault();
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_CLIENTES_MESERO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_CLIENTES_MESERO").hide();
        $("#PANTALLA_PEDIDOS_MESERO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_PEDIDOS_MESERO").hide();
        $("#PANTALLA_INICIO_MESERO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_INICIO_MESERO").hide();
        
        
        $("#PANTALLA_HISTORIAL_MESERO").show();
        $("#PANTALLA_HISTORIAL_MESERO").addClass("FOCO_PRINCIPAL");
        $(".volver_atras_inicio_mesero").hide();
    });
    
 
    $("#a_bot_editar_perfil_mesero").click(function (eve){
        console.log("Dio click");
        $(".pantalla_inicio_inicio_m").fadeOut(500, function(){
            $("#volver_atras_inicio_mesero").show();
            $(".pantalla_inicio_e_p_m").fadeIn(500);
            $(".pantalla_inicio_inicio_m").removeClass("foco");
            $(".pantalla_inicio_e_p_m").addClass("foco");
        });
    });
    
    
    $("#volver_atras_inicio_mesero").click(function (){
        //alert("Quiere volver atras");
        $(".pantalla_inicio_inicio_m").addClass("foco");
        $(".pantalla_inicio_inicio_m").fadeIn(500);
        
        $(".pantalla_inicio_e_p_m").hide("foco");
        $(".pantalla_inicio_e_p_m").removeClass("foco");
        
        $("#volver_atras_inicio_mesero").hide();
    });
 
    $("#a_bot_ayuda_mesero").click(function (eve){
        eve.preventDefault();
        if ($(this).hasClass('abierto')) {
            $("#a_bot_ayuda_mesero").html("Ver ayuda");
            $("#seccion_ayuda_mesero").fadeOut(1000);
            $(this).removeClass('abierto');
        } else {
            $("#a_bot_ayuda_mesero").html("Cerrar ayuda");
            $("#seccion_ayuda_mesero").fadeIn(1000);
            $(this).addClass('abierto');
        }
    });
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   $(".lat_cerrar_sesion").click(function (eve){
        eve.preventDefault();
        cerrarSesion();
    });
});































function consultarPedidos(){
    //console.log("*************************************");
    $.ajax({
        type:"POST",
        data:{ tipo : 1},
        url:RUTA_SERVIDOR + "pedidos/administrar/pedidosActivos.php"
    }).done(function(info){
        //alert("act: "+ info);
        $("#alerta_pedidos").html("");
        $("#alerta_pedidos").html(info);
    });
}



function AdministracionPedidos(){
    //console.log("*************************************");
    $.ajax({
        type:"POST",
        data:{ tipo : 1},
        url:RUTA_SERVIDOR + "pedidos/administrar/index.php"
    }).done(function(info){
        //console.log("Admi: "+ info);
        $("#pedidosActivosDivision").html("");
        $("#pedidosActivosDivision").html(info);
    });
}






function pedidosAtendidos(){
    $.ajax({
        type:"POST",
        data:{ tipo : 3},
        url:RUTA_SERVIDOR + "pedidos/administrar/pedidosActivos.php"
    }).done(function(info){
        //console.log("Admi: "+ info);
        $("#pedidosAtendidosDivision").html("");
        $("#pedidosAtendidosDivision").html(info);
    });
}

















function ClientesActivos(){
    //console.log("*************************************");
    $.ajax({
        type:"POST",
        data:{ tipo : 2},
        url:RUTA_SERVIDOR + "pedidos/administrar/pedidosActivos.php"
    }).done(function(info){
        //console.log("clientes activos: "+ info);
        $("#clintesActivosDivision").html("");
        $("#clintesActivosDivision").html(info);
    });
}



function guardarEdicionUsuario(tipo){
    switch (tipo){
        case 1:
            //Para cambiar el nombre
            console.log(1);
            var nombre = $("#perfil_nombre").val();
            if( cumpleTalla(nombre, 6)){
                $.ajax({
                    url: RUTA_SERVIDOR + "configuraciones/Datos.php",//url del servidor
                    data: {tipo:10, dato:nombre},
                    type: "post"
                }).done(function(res){//cuando ya este listo
                    console.log("-->" + res);
                    $("#servidor_datos").html("");
                    $("#servidor_datos").html(res);//ponemos la respuesta del servidor en el documeto
                    desaparecerDivision("servidor_datos");
                });//fin del done
            }else{
                alert("El tecto ingresado no cumple la longitud minima (6 caracteres)");
            }
            break;
        case 2:
            //Para cambiar el correo
            console.log(2);
            var correo = $("#perfil_correo").val();
            if(validarEmail(correo)){
                $.ajax({
                    url: RUTA_SERVIDOR + "configuraciones/Datos.php",//url del servidor
                    data: {tipo:11, dato:correo},
                    type: "post"
                }).done(function(res){//cuando ya este listo
                    console.log("-->" + res);
                    $("#servidor_datos").html("");
                    $("#servidor_datos").html(res);//ponemos la respuesta del servidor en el documeto
                    desaparecerDivision("servidor_datos");
                });//fin del done
            }
            break
        case 3:
            //Para cambiar la direccion
            console.log(3);
            var direccion = $("#perfil_direccion").val();
            if(cumpleTalla(direccion, 10)){
                $.ajax({
                    url: RUTA_SERVIDOR + "configuraciones/Datos.php",//url del servidor
                    data: {tipo:12, dato:direccion},
                    type: "post"
                }).done(function(res){//cuando ya este listo
                    console.log("-->" + res);
                    $("#servidor_datos").html("");
                    $("#servidor_datos").html(res);//ponemos la respuesta del servidor en el documeto
                    desaparecerDivision("servidor_datos");
                });//fin del done
            }else{
                alert("La dirección ingresada es muy corta");
            }
            break;
        default:
            break;
    }
}



function editarDato(tipo){
    switch (tipo){
        case 1:
            
            $("#correo").fadeOut();
            $("#direccion").fadeOut();
            $("#nombre").fadeIn(10);
            $("#boton_guardar").html('<a onclick="guardarEdicionUsuario(1)" class="button small fit">Guardar</a>')
            break;
        case 2:
            $("#nombre").fadeOut();
            $("#direccion").fadeOut();
            $("#correo").fadeIn(10);
            $("#boton_guardar").html('<a onclick="guardarEdicionUsuario(2)" class="button small fit">Guardar</a>')
            break;
        case 3:
            $("#correo").fadeOut();
            $("#nombre").fadeOut();
            $("#direccion").fadeIn(10);
            $("#boton_guardar").html('<a onclick="guardarEdicionUsuario(3)" class="button small fit">Guardar</a>')
            break;
        
        default:
            break;
    }
}