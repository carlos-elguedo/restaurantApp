/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




/* global RUTA_SERVIDOR */

function menu_restaurante_platos(){
    $.ajax({
	url: RUTA_SERVIDOR + "GestorMenu/VistaMenu.php",//url del servidor
        data: {tipo:3},
	type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        $("#menu_platos").html("");
        $("#menu_platos").html(res);
    });//fin del done
}











function menu_restaurante_bebidas(){
    $.ajax({
    url: RUTA_SERVIDOR + "GestorMenu/VistaMenu.php",//url del servidor
        data: {tipo:4},
    type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        $("#menu_bebidas").html("");
        $("#menu_bebidas").html(res);
    });//fin del done
}














function mesasActualesAdmi(division){
    
    $.ajax({
	url: RUTA_SERVIDOR + "GestorMesas/GestorMesa.php",//url del servidor
        data: {tipo:2},
	type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        if(division == 1){
            $("#mesas_actuales_admi").html("");
            $("#mesas_actuales_admi").html(res);
        }
        if(division == 2){
            console.log("************");
            $("#mesas_actuales_listar_admi").html("");
            $("#mesas_actuales_listar_admi").html(res);
        }
    });//fin del done
}



















function mesasActualesEliminarAdmi(){
    
    $.ajax({
	url: RUTA_SERVIDOR + "GestorMesas/GestorMesa.php",//url del servidor
        data: {tipo:3},
	type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
	$("#mesas_actuales_eliminar_admi").html("");
        //console.log("MA: " + res);
	$("#mesas_actuales_eliminar_admi").html(res);//ponemos la respuesta del servidor en el documeto
        //console.log("Cerrar la sesion, esto recibio:\n" + res);
    });//fin del done
}




















function traerMenu(division){
    $.ajax({
	url: RUTA_SERVIDOR + "GestorMenu/VistaMenu.php",//url del servidor
        data: {tipo:1},
	type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        if(division == 1){
            $("#ver_menu_admi").html("");
            $("#ver_menu_admi").html(res);
        }
        if(division == 2){
            
        }
    });//fin del done
}


















function traerMenuParaEliminar(division){
    $.ajax({
	url: RUTA_SERVIDOR + "GestorMenu/VistaMenu.php",//url del servidor
        data: {tipo:2},
	type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        if(division == 1){
            $("#eliminar_menu_admi").html("");
            $("#eliminar_menu_admi").html(res);
        }
    });//fin del done
}

function traerMenuParaEditar(division){
    $.ajax({
	url: RUTA_SERVIDOR + "GestorMenu/VistaMenu.php",//url del servidor
        data: {tipo:5},
	type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        if(division == 1){
            $("#editar_menu_admi").html("");
            $("#editar_menu_admi").html(res);
        }
        
    });//fin del done
}


















function eliminarMesaAdmin(id_mesa, nombre_mesa){
        $.ajax({
            url: RUTA_SERVIDOR + "GestorMesas/GestorMesa.php",//url del servidor
            data: {tipo:4, d1:id_mesa, d2:nombre_mesa},
            type: "post"
        }).done(function(res){//cuando ya este listo
            //alert("Envio");
            console.log("Eliminacion: " + res);
            $("#servidor").html("");
            $("#servidor").html(res);
            desaparecerDivision("servidor");
        });//fin del done
    
}
























function eliminarAlimentoAdmin(id){
    console.log("Quiere eliminar elemnto de menu: " + id);
        $.ajax({
            url: RUTA_SERVIDOR + "GestorMenu/AccionesMenu.php",//url del servidor
            data: {tipo:1, d1:id},
            type: "post"
        }).done(function(res){//cuando ya este listo
            //alert("Envio");
            console.log("Eliminacion producto: " + res);
            
            $("#servidor").html("");
            $("#servidor").html(res);
            desaparecerDivision("servidor");
        });//fin del done
}

















function editarAlimentoAdmin(id, nombre, imagen, precio, descripcion){
    console.log("Quiere editar elemnto de menu: " + id);
    
    $("#nombre_alimento_editar").html(nombre);
    $("#al-nombre_editar").val(nombre);
    $("#al-descripcion_editar").val(descripcion);
    $("#imagen_alimento_editar").prop("src", imagen);
    

    'use strict';
    var $teatro_edicion = $('#teatro_editar_alimento'), transition;
    //alert("Dio click");
    $teatro_edicion[0].showModal();
    transition = window.setTimeout(function() {
        $teatro_edicion.addClass('dialog-scale');
        $teatro_edicion.addClass('open');
        
        }, 0.5);
    $('#cancel_editar').on('click', function() {
        //alert("Quiere cancelar")
        $teatro_edicion.removeClass('dialog-scale');
        $teatro_edicion.removeClass('open');
        clearTimeout(transition);
        pegarCodigo_edicion();
    });

    $("#guardar_edicion").click(function(eve){
        eve.preventDefault();
        console.log("Quiere guardar la edicion del producto: " + id);
        
        var img_del_ali = $("#img_ali_a_subir_editar").val();
        var nombre_ali = $("#al-nombre_editar").val();
        var desc_ali = $("#al-descripcion_editar").val();
        var precio_ali = $("#al-precio_editar").val();
        
        if(nombre_ali !== "" && desc_ali !== "" && precio_ali !== ""){
            //alert("Correcto");
            var f = $(this);
            var formData = new FormData(document.getElementById("formulario_edicion_producto"));//obtenemos una referencia al formulario con formData
            formData.append("img_ali_a_subir_editar", "valor");
                //formData.append(f.attr("name"), $(this)[0].files[0]);
                //$("#GuardarTrabajo").disabled = true;
                $.ajax({//enviamos la imagen al servidor por ajax
                    url: RUTA_SERVIDOR + "GestorMenu/GestorMenu.php?d0=2&d1="+nombre_ali+"&d2="+desc_ali+"&d3="+precio_ali+"&d4="+id,
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(res){//cuando ya este listo
                    //alert("Envio el trabajo");
                    console.log("-->" + res);
                    traerMenuParaEditar(1);
                    $('#cancel_editar').click();
                    $("#servidor").append(res);
                    desaparecerDivision("servidor");
                });//fin del done
            }else{
                //Algunos campos estan vacios
                alert("Algun(os) dato(s) esta(n) vacio(s)");
            }

    });

        
}

































function verPlato(id, nombre, descripcion, precio, imagen){
    //console.log("Lledo: " + id + " - "+ nombre + "-"+ descripcion + " - " + precio + " - " + imagen );

    $("#nombre_plato").html(nombre);
    $("#precio_plato").html("$" + precio);
    $("#descripcion_plato").html(descripcion);
    $("#imagen_plato").prop("src", imagen);


    'use strict';
    var $teatro_plato = $('#teatro_ver_plato'), transition;
    //alert("Dio click");
    $teatro_plato[0].showModal();
    transition = window.setTimeout(function() {
        $teatro_plato.addClass('dialog-scale');
        $teatro_plato.addClass('open');
        
        }, 0.5);
    $('#cancel').on('click', function() {
        
        $teatro_plato.removeClass('dialog-scale');
        $teatro_plato.removeClass('open');
        clearTimeout(transition);
        pegarCodigo();
    });

    $("#PEDIR_PLATO").click(function(eve){
        eve.preventDefault();
        console.log("Quiere pedir el elimento de menu: " + id);

        var cantidad = $("#cantidad-plato").val();
        var mensaje_pedido = $("#mensaje_plato").val();

        $.ajax({
            url: RUTA_SERVIDOR + "pedidos/realizar/index.php",//url del servidor
            data: {tipo:1, d1: id, d2: cantidad, d3: mensaje_pedido},
            type: "post"
        }).done(function(res){//cuando ya este listo
            //alert("Envio");
            console.log("REALIZACION DE PEDIDO: " + res);
            $('#cancel').click();
            $("#servidor").html("");
            $("#servidor").html(res);
            desaparecerDivision("servidor");
        });//fin del done

    });


}

















function verProducto_comentario(id_producto, nombre, descripcion, precio, imagen){
    //console.log("Lledo: " + id + " - "+ nombre + "-"+ descripcion + " - " + precio + " - " + imagen );

    $("#nombre_p").html(nombre);
    $("#precio_p").html("$" + precio);
    $("#descripcion_p").html(descripcion);
    $("#imagen_p").prop("src", imagen);


    'use strict';
    var $teatro_p = $('#teatro_ver_producto'), transition;
    //alert("Dio click");
    $teatro_p[0].showModal();
    transition = window.setTimeout(function() {
        $teatro_p.addClass('dialog-scale');
        $teatro_p.addClass('open');
        
        }, 0.5);
    $('#cancel_comentar').on('click', function() {
        $teatro_p.removeClass('dialog-scale');
        $teatro_p.removeClass('open');
        clearTimeout(transition);
        pegarCodigo_comentario();
    });

    $("#COMENTAR").click(function(eve){
        eve.preventDefault();
        console.log("Quiere comentar el producto: " + id_producto);

        var valoracion = $("#cantidad-p-e").val();
        var mensaje = $("#mensaje_p_comentario").val();

        $.ajax({
            url: RUTA_SERVIDOR + "valoraciones/valoraciones.php",//url del servidor
            data: {tipo:1, d1: id_producto, d2: valoracion, d3: mensaje},
            type: "post"
        }).done(function(res){//cuando ya este listo
            //alert("Envio");
            console.log("REALIZACION DE PEDIDO: " + res);
            $('#cancel_comentar').click();
            $("#servidor").html("");
            $("#servidor").html(res);
            desaparecerDivision("servidor");
        });//fin del done

    });


}




function comentariosClientes(){
    $.ajax({
        url: RUTA_SERVIDOR + "valoraciones/valoraciones.php",//url del servidor
        data: {tipo:2},
        type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        $("#comentarios_clientes").html("");
        $("#comentarios_clientes").html(res);
    });//fin del done
}



























function verBebida(id, nombre, descripcion, precio, imagen){
    //console.log("Lledo: " + id + " - "+ nombre + "-"+ descripcion + " - " + precio + " - " + imagen );

    $("#nombre_bebida").html(nombre);
    $("#precio_bebida").html("$" + precio);
    $("#descripcion_bebida").html(descripcion);
    $("#imagen_bebida").prop("src", imagen);



    'use strict';
    var $teatro_bebida = $('#teatro_ver_bebida'), transition;
    //alert("Dio click");
    $teatro_bebida[0].showModal();
    transition = window.setTimeout(function() {
        $teatro_bebida.addClass('dialog-scale');
        $teatro_bebida.addClass('open');
        }, 0.5);
    $('#cancel2').on('click', function() {
        $teatro_bebida.removeClass('dialog-scale');
        $teatro_bebida.removeClass('open');
        clearTimeout(transition);
        pegarCodigo_bebidas();
    });

    $("#PEDIR_BEBIDA").click(function(eve){
        eve.preventDefault();
        console.log("Quiere pedir el elimento de menu: " + id);

        var cantidad = $("#cantidad-bebida").val();
        var mensaje_pedido = $("#mensaje_bebida").val();


        $.ajax({
            url: RUTA_SERVIDOR + "pedidos/realizar/index.php",//url del servidor
            data: {tipo:2, d1: id, d2: cantidad, d3: mensaje_pedido},
            type: "post"
        }).done(function(res){//cuando ya este listo
            //alert("Envio");
            console.log("REALIZACION DE PEDIDO: " + res);
            $('#cancel2').click();
            $("#servidor").html("");
            $("#servidor").html(res);
            desaparecerDivision("servidor");
        });//fin del done

    });


}//Fin de la funcion













function entragarPedido(id_pedido, nomb_mesa, cad){
    console.log("entragar: " + id_pedido + " - " + nomb_mesa + " - " + cad);
    
    
    $.ajax({
        url: RUTA_SERVIDOR + "pedidos/administrar/index.php",//url del servidor
        data: {tipo:5, d1: id_pedido, d2: nomb_mesa, d3:cad},
        type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        console.log("Texto pedidos a entragar: PEDIDO: " + res);
        $("#descripcion_pedido_productos_entragar").html("");
        $("#descripcion_pedido_productos_entragar").html(res);
    });//fin del done
    
    
    'use strict';
    var $teatro_entragar_pedido = $('#teatro_entragar_pedidos'), transition;
    //alert("Dio click");
    $teatro_entragar_pedido[0].showModal();
    transition = window.setTimeout(function() {
        $teatro_entragar_pedido.addClass('dialog-scale');
        $teatro_entragar_pedido.addClass('open');
        }, 0.5);
    $('#cancel_entregar_pedido').on('click', function() {
        $teatro_entragar_pedido.removeClass('dialog-scale');
        $teatro_entragar_pedido.removeClass('open');
        clearTimeout(transition);
        pegarCodigo_entragar_pedido();
    });
    
    
}
















function confirmarEntrgarPedido(id_pedido, id_producto, cad, id_enlace,){
    console.log("CONFIRMAR: " + id_pedido + " - " + id_enlace + " - " + cad + " - " + id_producto);
    $.ajax({
        url: RUTA_SERVIDOR + "pedidos/administrar/index.php",//url del servidor
        data: {tipo:4, d1: id_pedido, d2: id_producto, d3:cad, d4:id_enlace},
        type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        console.log("ENTRAGAR PEDIDO: " + res);
        $("#admi_pedidos").html("");
        $("#admi_pedidos").html(res);
        desaparecerDivision("admi_pedidos");
    });//fin del done
}




















function recibirPedido(id_pedido, nomb_mesa, cad){
    console.log("recibir: " + id_pedido + " - " + nomb_mesa + " - " + cad);
    
    $.ajax({
        url: RUTA_SERVIDOR + "pedidos/administrar/index.php",//url del servidor
        data: {tipo:3, d1: id_pedido, d2: nomb_mesa, d3:cad},
        type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        console.log("RECIBIR PEDIDO: " + res);
        $("#admi_pedidos").html("");
        $("#admi_pedidos").html(res);
        desaparecerDivision("admi_pedidos");
    });//fin del done
    
}






















function VerDetallesPedido(id_pedido, nomb_mesa, cad){
    //console.log("Ver detalles" + id_pedido + " - " + nomb_mesa);
    
    $("#mesa_pedido_activo").html(nomb_mesa);
    
    
    $.ajax({
        url: RUTA_SERVIDOR + "pedidos/administrar/index.php",//url del servidor
        data: {tipo:2, d1: id_pedido, d2: nomb_mesa, d3:cad},
        type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        console.log("CONSULTAR PEDIDO: " + res);
        $("#descripcion_pedido_productos").html("");
        $("#descripcion_pedido_productos").html(res);
    });//fin del done
    
    
    'use strict';
    var $teatro_detalles_pedido_activo = $('#teatro_detalles_pedidos'), transition;
    //alert("Dio click");
    $teatro_detalles_pedido_activo[0].showModal();
    transition = window.setTimeout(function() {
        $teatro_detalles_pedido_activo.addClass('dialog-scale');
        $teatro_detalles_pedido_activo.addClass('open');
        }, 0.5);
    $('#cancel_pedido_activo').on('click', function() {
        $teatro_detalles_pedido_activo.removeClass('dialog-scale');
        $teatro_detalles_pedido_activo.removeClass('open');
        clearTimeout(transition);
        pegarCodigo_detalles_pedido();
    });
}















function cancelarPedido(id_pedido, cad, id_enlace){
    
    console.log("Pedido: " + id_pedido + " cad: " + cad + "Enlace: " + id_enlace);
    $.ajax({
        url: RUTA_SERVIDOR + "pedidos/realizar/index.php",//url del servidor
        data: {tipo:4, d1: id_pedido, d2: cad, d3:id_enlace},
        type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        console.log("CANCELAR PEDIDO: " + res);
        $("#servidor").html("");
        $("#servidor").html(res);
        desaparecerDivision("servidor");
    });//fin del done
}


















function actualizarFunciones(){
    //Aqui iran una lista de funciones que se actualizaran al ser llamada esta funcion
}




















function desaparecerDivision(nombre_division){
    setTimeout(function (){
        $("#"+nombre_division).fadeOut(1000, function (){
            $("#"+nombre_division).html("");
            $("#"+nombre_division).show();
        });
    }, 5000);
    
}


















function pegarCodigo_comentario(){
    $("#teatro_comentarios").html("");
    $("#teatro_comentarios").html('<dialog id="teatro_ver_producto" class="site-dialog">\n\
\n<header class="dialog-header">\
\n<h1 id="nombre_p" style="display: inline">Nombre del producto</h1>\
\n<h1 id="precio_p" style="float: right; display: inline">$Precio</h1>\
\n</header>\
\n<div class="dialog-content">\
\n<span class="image fit"><img id="imagen_p" src="images/mesero_banner.jpg" alt=""></span>\
\n<p id="descripcion_p">Descripción detallada acerca del producto que esta observando.</p>\
\n</div>\
\n<div class="btn-group cf">\
\n<div class="12u$">\
\n<div class="select-wrapper">\
\n<select name="cantidad-p-e" id="cantidad-p-e">\
\n<option value="5"> 5 Estrellas</option>\
\n<option value="4"> 4 Estrellas</option>\
\n<option value="3"> 3 Estrellas</option>\
\n<option value="2"> 2 Estrellas</option>\
\n<option value="1"> 1 Estrellas</option>\
\n</select>\
\n</div>\
\n</div>\
\n<br>\
\n<div class="12u$">\
\n<div class="textarea-wrapper">\
\n<textarea name="mensaje_p_comentario" id="mensaje_p_comentario" placeholder="Exprese aquí sus opiniones acerca del producto que ha recibido" rows="1" style="overflow: hidden; resize: none; height: 59px; font-size: 12px"></textarea>\
\n</div>\
\n</div>\
\n<div class="12u$">\
\n<ul class="actions">\
\n<li><input id="COMENTAR" type="submit" value="VALORAR" class="special"></li>\
\n<li><input id="cancel_comentar" type="reset" value="Cancelar"></li>\
\n</ul>\
\n</div>\
\n</div>\
\n</dialog>');
}








function pegarCodigo_edicion(){
    $("#teatro_editar").html("");
    $("#teatro_editar").html('<dialog id="teatro_editar_alimento" class="site-dialog">\n\
\n<header class="dialog-header">\
\n<h1 id="nombre_alimento_editar" style="display: inline">Nombre del producto</h1>\
\n</header>\
\n<div class="dialog-content">\
\n<form id="formulario_edicion_producto">\
\n<span class="image fit"><img width="200" id="imagen_alimento_editar" src="images/mesero_banner.jpg" alt=""></span>\
\n<div class="6u 12u$(xsmall)">\
\n<input type="text" name="al-nombre_editar" id="al-nombre_editar" value="" placeholder="Nombre">\
\n</div>\
\n<div class="12u$">\
\n<div class="textarea-wrapper"><textarea name="al-descripcion_editar" id="al-descripcion_editar" placeholder="Descripción acerca del producto" rows="1" style="overflow: hidden; resize: none; height: 59px;"></textarea></div>\
\n</div>\
\n<div class="6u 12u$(xsmall)">\
\n<input type="number" name="al-precio_editar" id="al-precio_editar" value="" placeholder="Precio para el publico">\
\n</div>\
\n<div class="6u 12u$(small)">\
\n  <p style="margin-bottom:2px">Elige una imagen para cambiar</p>\
\n<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />\
\n<input type="file" accept="image/*"  id="img_ali_a_subir_editar" name="img_ali_a_subir_editar">\
\n</div>\
\n</form>\
\n</div>\
\n<div class="btn-group cf">\
\n<div class="12u$">\
\n<ul class="actions">\
\n<li><input id="guardar_edicion" type="submit" value="Guardar" class="special"></li>\
\n<li><input id="cancel_editar" type="reset" value="Cancelar"></li>\
\n</ul>\
\n</div>\
\n</div>\
\n</dialog>');
}


function pegarCodigo_entragar_pedido(){
    $("#teatro_m2").html("");
    
    $("#teatro_m2").html('<dialog id="teatro_entragar_pedidos" class="site-dialog">\n\
\n<header class="dialog-header">\
\n<h1 style="display: inline">Entraga de pedido</h1>\
\n<h1 id="mesa_pedido_entragar" style="float: right; display: inline"></h1>\
\n</header>\
\n<div id="descripcion_pedido_productos_entragar" class="dialog-content"></div>\
\n<div class="btn-group cf">\
\n<div class="12u$">\
\n<ul class="actions">\
\n<li><input id="cancel_entregar_pedido" type="reset" value="Cerrar"></li>\
\n</ul>\
\n</div>\
\n</div>\
\n</dialog>');
}                     
                            
                                
                                    
                                
                            
                        
                    













function pegarCodigo_detalles_pedido(){
    $("#teatro_m1").html("");
    
    $("#teatro_m1").html('<dialog id="teatro_detalles_pedidos" class="site-dialog">\n\
\n<header class="dialog-header">\
\n<h1 style="display: inline">Detalles del pedido</h1>\
\n<h1 id="mesa_pedido_activo" style="float: right; display: inline"></h1>\
\n</header>\
\n<div id="descripcion_pedido_productos" class="dialog-content">\
\n</div>\
\n<div class="btn-group cf">\
\n<div class="12u$">\
\n<ul class="actions">\
\n<li><input id="cancel_pedido_activo" type="reset" value="Cerrar"></li>\
\n</ul>\
\n</div>\
\n</div>\
\n</dialog>');
}

                            
                        
                    















function pegarCodigo_bebidas(){
    $("#teatro_2").html("");
    
    $("#teatro_2").html('<dialog id="teatro_ver_bebida" class="site-dialog">\n\
\n<header class="dialog-header">\
\n<h1 id="nombre_bebida" style="display: inline">Nombre de la bebida</h1>\
\n<h1 id="precio_bebida" style="float: right; display: inline">$Precio</h1>\
\n</header>\
\n<div class="dialog-content">\
\n<span class="image fit"><img id="imagen_bebida" src="images/mesero_banner.jpg" alt=""></span>\
\n<p id="descripcion_bebida">Descripción detallada acerca de la bebida que esta observando.</p>\
\n</div>\
\n<div class="btn-group cf">\
\n<div class="12u$">\
\n<div class="select-wrapper">\
\n<select name="cantidad-bebida" id="cantidad-bebida">\
\n<option value="1">Cantidad: 1</option>\
\n<option value="2">Cantidad: 2</option>\
\n<option value="3">Cantidad: 3</option>\
\n<option value="4">Cantidad: 4</option>\
\n<option value="5">Cantidad: 5</option>\
\n<option value="6">Cantidad: 6</option>\
\n</select>\
\n</div>\
\n</div>\
\n<br>\
\n<div class="12u$">\
\n<div class="textarea-wrapper">\
\n<textarea name="mensaje_bebida" id="mensaje_bebida" placeholder="Exprese aquí si tiene alguna sugerencia para recibir esta bebida, por ejemplo: nivel de azucar" rows="1" style="overflow: hidden; resize: none; height: 59px; font-size: 12px"></textarea>\
\n</div>\
\n</div>\
\n<div class="12u$">\
\n<ul class="actions">\
\n<li><input id="PEDIR_BEBIDA" type="submit" value="Pedir bebida" class="special"></li>\
\n<li><input id="cancel2" type="reset" value="Cancelar"></li>\
\n</ul>\
\n</div>\
\n</div>\
\n</dialog>');
}













function pegarCodigo(){
    $("#teatro_1").html("");
    
    $("#teatro_1").html('<dialog id="teatro_ver_plato" class="site-dialog">\
\n<header class="dialog-header">\
\n<h1 id="nombre_plato" style="display: inline">Nombre del plato</h1>\
\n<h1 id="precio_plato" style="float: right; display: inline">$Precio</h1>\
\n</header>\
\n<div class="dialog-content">\
\n<span class="image fit"><img id="imagen_plato" src="images/mesero_banner.jpg" alt=""></span>\
\n <p id="descripcion_plato">Descripción detallada acerca del plato que esta observando.</p>\
\n</div>\
\n<div class="btn-group cf">\
\n<div class="12u$">\
\n<div class="select-wrapper">\
\n<select name="cantidad-plato" id="cantidad-plato">\
\n<option value="1">Cantidad: 1</option>\
\n<option value="2">Cantidad: 2</option>\
\n<option value="3">Cantidad: 3</option>\
\n<option value="4">Cantidad: 4</option>\
\n<option value="5">Cantidad: 5</option>\
\n<option value="6">Cantidad: 6</option>\
\n</select>\
\n</div>\
\n</div>\
\n<br>\
\n<div class="12u$">\
\n<div class="textarea-wrapper">\
\n<textarea name="mensaje_plato" id="mensaje_plato" placeholder="Exprese aquí si tiene alguna sugerencia para recibir este plato, por ejemplo, nivel de sal, o grasa" rows="1" style="overflow: hidden; resize: none; height: 59px; font-size: 12px"></textarea>\
\n</div>\
\n</div>\
\n<div class="12u$">\
\n<ul class="actions">\
\n<li><input id="PEDIR_PLATO" type="submit" value="Pedir plato" class="special"></li>\
\n<li><input id="cancel" type="reset" value="Cancelar"></li>\
\n</ul>\
\n</div>\
\n</div>\
\n</dialog>');
}



function pegarCodigo_salida(){
    $("#confirmarSalida").html("");
    
    $("#confirmarSalida").html('<dialog id="teatro_conf_salida" class="site-dialog">\n\
\n<header class="dialog-header">\
\n<h1>Confirmación para salir</h1>\
\n</header>\
\n<div class="btn-group cf">\
\n<div class="6u 12u$(xsmall)">\
\n<input type="password" name="contra_cliente_salida" id="contra_cliente_salida" value="" placeholder="Contraseña de mesa">\
\n</div>\
\n<div class="12u$">\
\n<ul class="actions">\
\n<li><input id="salir_cliente" type="submit" value="Salir" class="button special fit small"></li>\
\n<li><input id="cancel_salida" type="reset" value="Cancelar" class="button fit small"></li>\
\n</ul>\
\n</div>\
\n</div>\
\n</dialog>');
}

function traerMeseros(){
    $.ajax({
        url: RUTA_SERVIDOR + "GestorMesero/GestorMesero.php",//url del servidor
            data: {tipo:1},
            type: "post"
        }).done(function(res){//cuando ya este listo
            //alert("Envio");
            //console.log("Meseros: " + res);
            $("#meseros_admi").html("");
            $("#meseros_admi").html(res);
        });//fin del done
}





function eliminarMeseroAdmin(id_mesero){
    
    $.ajax({
        url: RUTA_SERVIDOR + "GestorMesero/GestorMesero.php",//url del servidor
        data: {tipo:2, d1:id_mesero},
        type: "post"
    }).done(function(res){//cuando ya este listo
        //alert("Envio");
        console.log("Meseroseliminar: " + res);
        $("#servidor").html("");
        $("#servidor").html(res);
        desaparecerDivision("servidor");
    });//fin del done
}

















function desaparecerElemento(id_elemento){
    setTimeout(function (){
        $("#"+id_elemento).fadeOut(500, function (){
            $("#"+id_elemento).html("");
            $("#"+id_elemento).show();
        });
    }, 2500);
    
}






/**
Estafunciones para cerrar la sesion en el servidor
*/
function cerrarSesion(){
    $.ajax({
	url: RUTA_SERVIDOR + "configuraciones/cerrarSesion.php",//url del servidor
	type: "post"
    }).done(function(res){//cuando ya este listo
	$("#servidor").html("");
	$("#servidor").html(res);//ponemos la respuesta del servidor en el documeto
        //console.log("Cerrar la sesion, esto recibio:\n" + res);
    });//fin del done
}

function cerrarSesionCliente(){
    'use strict';
    var $teatro_confirmar_salida = $('#teatro_conf_salida'), transition;
    //alert("Dio click");
    $teatro_confirmar_salida[0].showModal();
    transition = window.setTimeout(function() {
        $teatro_confirmar_salida.addClass('dialog-scale');
        $teatro_confirmar_salida.addClass('open');
        }, 0.5);
    $('#cancel_salida').on('click', function() {
        $teatro_confirmar_salida.removeClass('dialog-scale');
        $teatro_confirmar_salida.removeClass('open');
        clearTimeout(transition);
        pegarCodigo_salida();
    });
    
    $("#salir_cliente").click(function(eve){
        console.log("Salir");
        var contra = $("#contra_cliente_salida").val();
        if(contra != ""){
            eve.preventDefault();
            $.ajax({
                url: RUTA_SERVIDOR + "configuraciones/cerrarsesionCliente.php",//url del servidor
                type: "post",
                data:{tipo:1, d0:contra, d1: localStorage.getItem('usu'), d2: localStorage.getItem('con')}
            }).done(function(res){//cuando ya este listo
                $("#servidor").html("");
                $("#servidor").html(res);//ponemos la respuesta del servidor en el documeto
                //console.log("Cerrar la sesion, esto recibio:\n" + res);
            });//fin del done
        }else{
            alert("Por favor escribe la contraseña");
        }
        
    });
    
}


function reiniciarSesionCliente(){
    'use strict';
    var $teatro_confirmar_salida = $('#teatro_conf_salida'), transition;
    //alert("Dio click");
    $teatro_confirmar_salida[0].showModal();
    transition = window.setTimeout(function() {
        $teatro_confirmar_salida.addClass('dialog-scale');
        $teatro_confirmar_salida.addClass('open');
        }, 0.5);
    $('#cancel_salida').on('click', function() {
        $teatro_confirmar_salida.removeClass('dialog-scale');
        $teatro_confirmar_salida.removeClass('open');
        clearTimeout(transition);
        pegarCodigo_salida();
    });
    
    $("#salir_cliente").click(function(eve){
        console.log("Salir");
        var contra = $("#contra_cliente_salida").val();
        if(contra != ""){
            eve.preventDefault();
            $.ajax({
                url: RUTA_SERVIDOR + "configuraciones/cerrarsesionCliente.php",//url del servidor
                type: "post",
                data:{tipo:2, d0:contra, d1: localStorage.getItem('usu'), d2: localStorage.getItem('con')}
            }).done(function(res){//cuando ya este listo
                $("#servidor").html("");
                $("#servidor").html(res);//ponemos la respuesta del servidor en el documeto
                //console.log("Cerrar la sesion, esto recibio:\n" + res);
            });//fin del done
        }else{
            alert("Por favor escribe la contraseña");
        }
        
    });
    
}


function iniciarSesion(a1, a2, id){
    $.post(
        RUTA_SERVIDOR + "configuraciones/inicio.php",
        {a1:a1, a2:a2, a3:id},
        function(respuesta){
            //alert("Envio el post registro.");
            //console.log("Envio el login al servidor, esto recibio:\n" + respuesta);
            //Con esta linea de codigo, tomamos la respuesta del servidor y la colocamos en el documento para realizar las acciones
            $("#servidor").html("");
            $("#servidor").html(respuesta);
        });//fin del post				
}