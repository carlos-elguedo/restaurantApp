/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* global RUTA_SERVIDOR */

$(document).ready(function (){
    //alert("Todo listo cliete");
    $.ajaxSetup({"cache": false});
    setInterval("pedido()", 3000);
    setInterval("valoraciones()", 4000);


    var BUSCO_PLATO = false, BUSCO_BEBIDA = false;
    
    $("#lateral_platos").click(function(ev){
        ev.preventDefault();
        //alert("Se dio click");
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_BEBIDAS").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_BEBIDAS").hide();
        $("#PANTALLA_ESTADO_PEDIDO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_ESTADO_PEDIDO").hide();
        $("#PANTALLA_VALORACIONES").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_VALORACIONES").hide();
        $("#PANTALLA_AYUDA").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_AYUDA").hide();
        
        menu_restaurante_platos();
        $("#PANTALLA_PLATOS").show();
        $("#PANTALLA_PLATOS").addClass("FOCO_PRINCIPAL");
        
    });

    $("#lateral_bebidas").click(function(ev){
        ev.preventDefault();
        //alert("Se dio click");
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_PLATOS").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_PLATOS").hide();
        $("#PANTALLA_ESTADO_PEDIDO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_ESTADO_PEDIDO").hide();
        $("#PANTALLA_VALORACIONES").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_VALORACIONES").hide();
        $("#PANTALLA_AYUDA").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_AYUDA").hide();
        
        
        menu_restaurante_bebidas();
        $("#PANTALLA_BEBIDAS").show();
        $("#PANTALLA_BEBIDAS").addClass("FOCO_PRINCIPAL");
        
    });


    $("#lateral_estado_pedido").click(function(ev){
        ev.preventDefault();
        //alert("Se dio click");
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_PLATOS").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_PLATOS").hide();
        $("#PANTALLA_BEBIDAS").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_BEBIDAS").hide();
        $("#PANTALLA_VALORACIONES").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_VALORACIONES").hide();
        $("#PANTALLA_AYUDA").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_AYUDA").hide();
        
        //pedido();
        $("#PANTALLA_ESTADO_PEDIDO").show();
        $("#PANTALLA_ESTADO_PEDIDO").addClass("FOCO_PRINCIPAL");
        
    });



    $("#lateral_valorar_plato").click(function(ev){
        ev.preventDefault();
        //alert("Se dio click");
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_PLATOS").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_PLATOS").hide();
        $("#PANTALLA_BEBIDAS").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_BEBIDAS").hide();
        $("#PANTALLA_ESTADO_PEDIDO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_ESTADO_PEDIDO").hide();
        $("#PANTALLA_AYUDA").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_AYUDA").hide();
        
            
        $("#PANTALLA_VALORACIONES").show();
        $("#PANTALLA_VALORACIONES").addClass("FOCO_PRINCIPAL");
        
    });



    $("#lateral_ayuda").click(function(ev){
        ev.preventDefault();
        //alert("Se dio click");
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_PLATOS").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_PLATOS").hide();
        $("#PANTALLA_BEBIDAS").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_BEBIDAS").hide();
        $("#PANTALLA_VALORACIONES").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_VALORACIONES").hide();
        $("#PANTALLA_ESTADO_PEDIDO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_ESTADO_PEDIDO").hide();
        
        
        
        $("#PANTALLA_AYUDA").show();
        $("#PANTALLA_AYUDA").addClass("FOCO_PRINCIPAL");
        
    });


    $("#boton_buscar_plato").click(function(){
        var texto_buscado = $("#buscar_plato").val();
        if(texto_buscado != ""){
            //console.log("Buscar: " + $("#buscar_plato").val());
            $.ajax({
                url: RUTA_SERVIDOR + "busqueda/busqueda.php",//url del servidor
                data: {tipo:2, d1:texto_buscado},
                type: "post"
            }).done(function(res){//cuando ya este listo
                //alert("Envio");
                console.log("Busqueda producto servidor: " + res);
                $("#menu_platos").html("");
                $("#menu_platos").html(res);
                //desaparecerDivision("servidor");
                BUSCO_PLATO = true;
            });//fin del done
        }else{
            //Llamamos el menu
            if(BUSCO_PLATO){
                menu_restaurante_platos();
            }
        }
    });//FIN DE LA FUNCION
    
    
    
    $("#buscar_plato").on('keyup', function(event) {
        event.preventDefault();
        var texto_buscado = $("#buscar_plato").val();
        if(texto_buscado != ""){
            //console.log("Buscar: " + $("#buscar_plato").val());
            $.ajax({
                url: RUTA_SERVIDOR + "busqueda/busqueda.php",//url del servidor
                data: {tipo:2, d1:texto_buscado},
                type: "post"
            }).done(function(res){//cuando ya este listo
                //alert("Envio");
                console.log("Busqueda producto servidor: " + res);
                $("#menu_platos").html("");
                $("#menu_platos").html(res);
                //desaparecerDivision("servidor");
                BUSCO_PLATO = true;
            });//fin del done
        }else{
            //Llamamos el menu
            if(BUSCO_PLATO){
                menu_restaurante_platos();
            }
        }
    });
    
    
   
   
   
   
   
   
   
   
   
   
   $("#boton_buscar_bebida").click(function(){
        var texto_buscado = $("#buscar_bebida").val();
        if(texto_buscado != ""){
            //console.log("Buscar: " + $("#buscar_plato").val());
            $.ajax({
                url: RUTA_SERVIDOR + "busqueda/busqueda.php",//url del servidor
                data: {tipo:3, d1:texto_buscado},
                type: "post"
            }).done(function(res){//cuando ya este listo
                //alert("Envio");
                console.log("Busqueda producto servidor: " + res);
                $("#menu_bebidas").html("");
                $("#menu_bebidas").html(res);
                //desaparecerDivision("servidor");
                BUSCO_BEBIDA = true;
            });//fin del done
        }else{
            //Llamamos el menu
            if(BUSCO_BEBIDA){
                menu_restaurante_bebidas();
            }
        }
    });//FIN DE LA FUNCION
    
    
    
    $("#buscar_bebida").on('keyup', function(event) {
        event.preventDefault();
        var texto_buscado = $("#buscar_bebida").val();
        if(texto_buscado != ""){
            //console.log("Buscar: " + $("#buscar_plato").val());
            $.ajax({
                url: RUTA_SERVIDOR + "busqueda/busqueda.php",//url del servidor
                data: {tipo:3, d1:texto_buscado},
                type: "post"
            }).done(function(res){//cuando ya este listo
                //alert("Envio");
                console.log("Busqueda producto servidor: " + res);
                $("#menu_bebidas").html("");
                $("#menu_bebidas").html(res);
                //desaparecerDivision("servidor");
                BUSCO_BEBIDA = true;
            });//fin del done
        }else{
            //Llamamos el menu
            if(BUSCO_BEBIDA){
                menu_restaurante_bebidas();
            }
        }
    });
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   











    
    
    
    menu_restaurante_platos();
    menu_restaurante_bebidas();
    
    
    $("#lateral_reiniciar").click(function (eve){
        eve.preventDefault();
        reiniciarSesionCliente();
    });
    

    $(".lat_cerrar_sesion").click(function (eve){
        eve.preventDefault();
        cerrarSesionCliente();
    });
});
















function pedido(){
    //console.log("---------------");
     $.ajax({
            url: RUTA_SERVIDOR + "pedidos/realizar/index.php",//url del servidor
            data: {tipo:3},
            type: "post"
        }).done(function(res){//cuando ya este listo
            //alert("Envio");
            //console.log("ESTADO DE PEDIDO: " + res);
            $("#estado_pedido").html("");
            $("#estado_pedido").html(res);
            //desaparecerDivision("servidor");
        });//fin del done
}










function valoraciones(){
    //console.log("---------------");
     $.ajax({
            url: RUTA_SERVIDOR + "pedidos/realizar/index.php",//url del servidor
            data: {tipo:5},
            type: "post"
        }).done(function(res){//cuando ya este listo
            //alert("Envio");
            //console.log("ESTADO DE PEDIDO: " + res);
            $("#valoraciones_pantalla").html("");
            $("#valoraciones_pantalla").html(res);
            //desaparecerDivision("servidor");
        });//fin del done
}