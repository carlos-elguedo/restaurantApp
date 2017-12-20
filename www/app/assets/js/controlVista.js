/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* global RUTA_SERVIDOR */

$(document).ready(function (){
    //alert("Todo listo");
    
    $.ajaxSetup({"cache": false});
    setInterval("mesasActualesAdmi(2)", 2500);
    setInterval("comentariosClientes(2)", 3000);
    /**
     * controlador 1
     * Para controlar las pulsasiones sobre ver y ocultar ayuda
     */
    $("#a_bot_ayuda_admi").click(function (eve){
        eve.preventDefault();
        if ($(this).hasClass('abierto')) {
            $("#a_bot_ayuda_admi").html("Ver ayuda");
            $("#seccion_ayuda").fadeOut(1000);
            $(this).removeClass('abierto');
        } else {
            $("#a_bot_ayuda_admi").html("Cerrar ayuda");
            $("#seccion_ayuda").fadeIn(1000);
            $(this).addClass('abierto');
        }
    });
    
    /**
     * controlador 2
     * Para entrar a las configuraciones rapidas
     */
    $("#a_bot_configuraciones_rap").click(function (eve){
        eve.preventDefault();
        $(".pantalla_inicio_inicio").fadeOut(500, function(){
            $("#volver_atras_inicio").show();
            $(".pantalla_inicio_c_r").fadeIn(500);
            $(".pantalla_inicio_inicio").removeClass("foco");
            $(".pantalla_inicio_c_r").addClass("foco");
        });
    });
    
    
    /**
     * Controlador 3
     * Para la entrear a la pantalla de editar perfil
     */
    $("#a_bot_editar_perfil_admi").click(function (eve){
        eve.preventDefault();
        $(".pantalla_inicio_inicio").fadeOut(500, function(){
            $("#volver_atras_inicio").show();
            $(".pantalla_inicio_e_p").fadeIn(500);
            $(".pantalla_inicio_inicio").removeClass("foco");
            $(".pantalla_inicio_e_p").addClass("foco");
        });
    });
    
   /**
    * Controlador 4
    * Para los botones de volver atras - PANTALLA DE INICIO
    */
    $("#volver_atras_inicio").click(function (eve){
        eve.preventDefault();
        //alert("Quiere volver atras");
        $(".pantalla_inicio_inicio").addClass("foco");
        $(".pantalla_inicio_inicio").fadeIn(500);
        
        $(".pantalla_inicio_c_r").hide("foco");
        $(".pantalla_inicio_c_r").removeClass("foco");
        $(".pantalla_inicio_e_p").hide("foco");
        $(".pantalla_inicio_e_p").removeClass("foco");
        
        $("#volver_atras_inicio").hide();
        
    });
    
    /**
     * Controlador 5
     * Para controlar la opcion en el menu lateral para ir a la pantalla del menu del restaurante
     */
    $("#lateral_inicio").click(function(ev){
        ev.preventDefault();
        //alert("Se dio click");
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_MENU").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_MENU").hide();
        $("#PANTALLA_CLIENTES").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_CLIENTES").hide();
        $("#PANTALLA_MESEROS").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_MESEROS").hide();
        $("#PANTALLA_HISTORIAL").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_HISTORIAL").hide();
        
        $("#PANTALLA_INICIO").show();
        $("#PANTALLA_INICIO").addClass("FOCO_PRINCIPAL");
        $("#volver_atras_inicio").hide();
        $("#volver_atras_cliente").hide();
        $("#volver_atras_menu").hide();
        
        //Mostramos la pantalla principal de esta seccion:
        $("#volver_atras_inicio").click();
    });
    
    $("#lateral_menu").click(function(eve){
        eve.preventDefault();
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_INICIO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_INICIO").hide();
        $("#PANTALLA_CLIENTES").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_CLIENTES").hide();
        $("#PANTALLA_MESEROS").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_MESEROS").hide();
        $("#PANTALLA_HISTORIAL").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_HISTORIAL").hide();
        
        $("#PANTALLA_MENU").show();
        $("#PANTALLA_MENU").addClass("FOCO_PRINCIPAL");
        $("#volver_atras_inicio").hide();
        $("#volver_atras_cliente").hide();
        $("#volver_atras_menu").hide();
        
        //Salimos de cualquier pantalla en donde estuvieran
        $("#volver_atras_menu").click();
    });
    
    $("#lateral_clientes").click(function(eve){
        eve.preventDefault();
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_INICIO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_INICIO").hide();
        $("#PANTALLA_MENU").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_MENU").hide();
        $("#PANTALLA_MESEROS").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_MESEROS").hide();
        $("#PANTALLA_HISTORIAL").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_HISTORIAL").hide();
        
        $("#PANTALLA_CLIENTES").show();
        $("#PANTALLA_CLIENTES").addClass("FOCO_PRINCIPAL");
        $("#volver_atras_inicio").hide();
        $("#volver_atras_cliente").hide();
        $("#volver_atras_menu").hide();
        
        //Salimos de cualquier pantalla en donde estuvieran
        $("#volver_atras_cliente").click();
    });
    
    $("#lateral_empleados").click(function(eve){
        eve.preventDefault();
        traerMeseros();
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_INICIO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_INICIO").hide();
        $("#PANTALLA_MENU").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_MENU").hide();
        $("#PANTALLA_CLIENTES").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_CLIENTES").hide();
        $("#PANTALLA_HISTORIAL").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_HISTORIAL").hide();
        
        $("#PANTALLA_MESEROS").show();
        $("#PANTALLA_MESEROS").addClass("FOCO_PRINCIPAL");
        $("#volver_atras_inicio").hide();
        $("#volver_atras_cliente").hide();
        $("#volver_atras_menu").hide();
    });
    
    $("#lateral_historial").click(function(eve){
        eve.preventDefault();
        $("body").removeClass("is-menu-visible");
        $("#PANTALLA_INICIO").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_INICIO").hide();
        $("#PANTALLA_MENU").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_MENU").hide();
        $("#PANTALLA_MESEROS").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_MESEROS").hide();
        $("#PANTALLA_CLIENTES").removeClass("FOCO_PRINCIPAL");
        $("#PANTALLA_CLIENTES").hide();
        
        $("#PANTALLA_HISTORIAL").show();
        $("#PANTALLA_HISTORIAL").addClass("FOCO_PRINCIPAL");
        $("#volver_atras_inicio").hide();
        $("#volver_atras_cliente").hide();
        $("#volver_atras_menu").hide();
    });
    
    
    /**
     * Controlador 7
     * Controlador para cambiar el codigo de regsitro de administrador
     */
    $("#cam_cod_adm").click(function (eve){
        eve.preventDefault();
        //alert("Bien");
        //$("#cam_cod_adm").desabilitarlo
        var cd_adm_new = $("#nuevo_codigo_admi").val();
        
        if(cumpleTalla(cd_adm_new, 10) == true){
            $.ajax({
                url: RUTA_SERVIDOR + "configuraciones/Datos.php",//url del servidor
                data: {tipo:1, dato:cd_adm_new},
                type: "post"
            }).done(function(res){//cuando ya este listo
                //alert("Envio el " + cd_adm_new);
                $("#servidor_datos").html("");
                $("#servidor_datos").html(res);//ponemos la respuesta del servidor en el documeto
                //console.log("Cerrar la sesion, esto recibio:\n" + res);
            });//fin del done
        }else{
            alert("Ingresa por lo menos 10 caracteres");
        }
    });
    $("#cam_cod_mes").click(function (eve){
        eve.preventDefault();
        //alert("Bien");
        //$("#cam_cod_adm").desabilitarlo
        var cd_mes_new = $("#nuevo_codigo_mese").val();
        
        if(cumpleTalla(cd_mes_new, 10) == true){
            $.ajax({
                url: RUTA_SERVIDOR + "configuraciones/Datos.php",//url del servidor
                data: {tipo:2, dato:cd_mes_new},
                type: "post"
            }).done(function(res){//cuando ya este listo
                //alert("Envio el " + cd_mes_new);
                $("#servidor_datos").html("");
                $("#servidor_datos").html(res);//ponemos la respuesta del servidor en el documeto
                //console.log("Cerrar la sesion, esto recibio:\n" + res);
            });//fin del done
        }else{
            alert("Ingresa por lo menos 10 caracteres");
        }
        
    });
    $("#camb_cont").click(function (eve){
        eve.preventDefault();
        //alert("Bien");
        //$("#cam_cod_adm").desabilitarlo
        var cam_cont_ant = $("#camb_cont_ant").val();
        var cam_cont_new = $("#camb_cont_nue").val();
        
        $.ajax({
            url: RUTA_SERVIDOR + "configuraciones/Datos.php",//url del servidor
            data: {tipo:3, dato:cam_cont_ant, dato2:cam_cont_new},
            type: "post"
        }).done(function(res){//cuando ya este listo
            //alert("Envio el " + cd_adm_new);
            $("#servidor_datos").html("");
            $("#servidor_datos").html(res);//ponemos la respuesta del servidor en el documeto
            //console.log("Cerrar la sesion, esto recibio:\n" + res);
        });//fin del done
        
    });
    
    
    
    /**
     * Controlador 8
     * Gestion de mesas
     */
    $("#a_bot_cliente_agregar").click(function (eve){
        eve.preventDefault();
        //Agregar mesas al restaurante
        mesasActualesAdmi(1);
        $(".pantalla_cliente_inicio").fadeOut(500, function(){
            $("#volver_atras_cliente").show();
            $(".pantalla_cliente_agregar").fadeIn(500);
            $(".pantalla_cliente_inicio").removeClass("foco");
            $(".pantalla_cliente_agregar").addClass("foco");
        });
    });
    
    $("#a_bot_cliente_eliminar").click(function (eve){
        eve.preventDefault();
        //Eliminar mesas al restaurante
        mesasActualesEliminarAdmi();
        $(".pantalla_cliente_inicio").fadeOut(500, function(){
            $("#volver_atras_cliente").show();
            $(".pantalla_cliente_eliminar").fadeIn(500);
            $(".pantalla_cliente_inicio").removeClass("foco");
            $(".pantalla_cliente_eliminar").addClass("foco");
        });
        
    });
    
    $("#a_bot_cliente_listar").click(function (eve){
        eve.preventDefault();
        mesasActualesAdmi(2);
        $(".pantalla_cliente_inicio").fadeOut(500, function(){
            $("#volver_atras_cliente").show();
            $(".pantalla_cliente_listar").fadeIn(500);
            $(".pantalla_cliente_inicio").removeClass("foco");
            $(".pantalla_cliente_listar").addClass("foco");
        });
    });
    
    $("#volver_atras_cliente").click(function (){
        //alert("Quiere volver atras");
        $(".pantalla_cliente_inicio").addClass("foco");
        $(".pantalla_cliente_inicio").fadeIn(500);
        
        $(".pantalla_cliente_agregar").hide("foco");
        $(".pantalla_cliente_agregar").removeClass("foco");
        $(".pantalla_cliente_listar").hide("foco");
        $(".pantalla_cliente_listar").removeClass("foco");
        $(".pantalla_cliente_eliminar").hide("foco");
        $(".pantalla_cliente_eliminar").removeClass("foco");
        
        $("#volver_atras_cliente").hide();
    });
    
    $("#agregar_mesa_nueva").click(function (){
        var nombre_mesa = $("#nombre_mesa_nueva").val();
        var pass_mesa = $("#contra_mesa_nueva").val();
        //alert("Quiere guardar: " + nombre_mesa + " - " + pass_mesa);
        if(cumpleTalla(nombre_mesa, 4) == true && cumpleTalla(pass_mesa, 8) == true ){
            $.ajax({
                url: RUTA_SERVIDOR + "GestorMesas/GestorMesa.php",//url del servidor
                data: {tipo:1, dato1:nombre_mesa, dato2:pass_mesa},
                type: "post"
            }).done(function(res){//cuando ya este listo
                //alert("Envio el " + cd_mes_new);
                $("#servidor").html("");
                $("#servidor").html(res);//ponemos la respuesta del servidor en el documeto
                desaparecerDivision("servidor");
                //console.log("Cerrar la sesion, esto recibio:\n" + res);
            });//fin del done
        }else{
            alert("Los datos ingresados no superan la talla minima (4 y 8 caracteres resp.)");
        }
    });
    
    
    
    /*+
     * Controlador 9
     * Para administracion del menu del restaurante
     */
    $("#a_bot_menu_agregar").click(function (eve){
        eve.preventDefault();
        
        $(".pantalla_menu_inicio").fadeOut(500, function(){
            $("#volver_atras_menu").show();
            $(".pantalla_menu_agregar").fadeIn(500);
            $(".pantalla_menu_inicio").removeClass("foco");
            $(".pantalla_menu_agregar").addClass("foco");
        });
    });
    $("#a_bot_menu_editar").click(function (eve){
        eve.preventDefault();
        //Editar platos y bebidas al restaurante
        traerMenuParaEditar(1);
        $(".pantalla_menu_inicio").fadeOut(500, function(){
            $("#volver_atras_menu").show();
            $(".pantalla_menu_editar").fadeIn(500);
            $(".pantalla_menu_inicio").removeClass("foco");
            $(".pantalla_menu_editar").addClass("foco");
        });
    });
    $("#a_bot_menu_eliminar").click(function (eve){
        eve.preventDefault();
        //Eliminar platos y bebidas al restaurante
        traerMenuParaEliminar(1);
        $(".pantalla_menu_inicio").fadeOut(500, function(){
            $("#volver_atras_menu").show();
            $(".pantalla_menu_eliminar").fadeIn(500);
            $(".pantalla_menu_inicio").removeClass("foco");
            $(".pantalla_menu_eliminar").addClass("foco");
        });
    });
    $("#a_bot_menu_ver").click(function (eve){
        eve.preventDefault();
        traerMenu(1);
        $(".pantalla_menu_inicio").fadeOut(500, function(){
            $("#volver_atras_menu").show();
            $(".pantalla_menu_ver").fadeIn(500);
            $(".pantalla_menu_inicio").removeClass("foco");
            $(".pantalla_menu_ver").addClass("foco");
        });
    });
    
    $("#volver_atras_menu").click(function (){
        //alert("Quiere volver atras");
        $(".pantalla_menu_inicio").addClass("foco");
        $(".pantalla_menu_inicio").fadeIn(500);
        
        $(".pantalla_menu_agregar").hide("foco");
        $(".pantalla_menu_agregar").removeClass("foco");
        $(".pantalla_menu_editar").hide("foco");
        $(".pantalla_menu_editar").removeClass("foco");
        $(".pantalla_menu_eliminar").hide("foco");
        $(".pantalla_menu_eliminar").removeClass("foco");
        $(".pantalla_menu_ver").hide("foco");
        $(".pantalla_menu_ver").removeClass("foco");
        
        $("#volver_atras_menu").hide();
    });
    
    
    /**
     * Controlador 10
     * para los formularios del menu
     */
    
    $("#formulario_agregar_plato").submit(function (eve){
        eve.preventDefault();
        //alert("Guardar plato");
        var tipo_ali = $("#tipo_elimento").val();
        var img_del_ali = $("#img_ali_a_subir").val();
        var nombre_ali = $("#al-nombre").val();
        var desc_ali = $("#al-descripcion").val();
        var precio_ali = $("#al-precio").val();
        //Comprobamos si selecciono un tipo de alimento
        if(tipo_ali != 0){
            if(img_del_ali != "" && nombre_ali != "" && desc_ali != "" && precio_ali != ""){
                //alert("Correcto");
                var f = $(this);
                var formData = new FormData(document.getElementById("formulario_agregar_plato"));//obtenemos una referencia al formulario con formData
                formData.append("img_ali_a_subir", "valor");
                //formData.append(f.attr("name"), $(this)[0].files[0]);
                //$("#GuardarTrabajo").disabled = true;
                $.ajax({//enviamos la imagen al servidor por ajax
                    url: RUTA_SERVIDOR + "GestorMenu/GestorMenu.php?d0=1&d1="+tipo_ali+"&d2="+nombre_ali+"&d3="+desc_ali+"&d4="+precio_ali,
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(res){//cuando ya este listo
                    //alert("Envio el trabajo");
                    console.log(res);
                    $("#servidor").append(res);
                });//fin del done
            }else{
                //Algunos campos estan vacios
                alert("Algun(os) dato(s) esta(n) vacio(s)");
            }
        }else{
            alert("Por favor escoge un tipo de alimento");
        }
    });
    
    
    
    
    
    
    $("#camb_cont").click(function (eve){
        eve.preventDefault();
        var c1 = $("#camb_cont_ant").val();
        var c2 = $("#camb_cont_nue").val();
        if(cumpleTalla(c1, 5) && cumpleTalla(c1, 5)){
            
            
                $.ajax({
                    url: RUTA_SERVIDOR + "configuraciones/Datos.php",//url del servidor
                    data: {tipo:9, dato:c1, dato2:c2},
                    type: "post"
                }).done(function(res){//cuando ya este listo
                    console.log("-->" + res);
                    $("#servidor_datos").html("");
                    $("#servidor_datos").html(res);//ponemos la respuesta del servidor en el documeto
                    desaparecerDivision("servidor_datos");
                });//fin del done
        }else{
            alert('Los dato ingresados no cumplen la minima longitud permitida (5 caracteres)');
        }
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    $(".lat_cerrar_sesion").click(function (eve){
        eve.preventDefault();
        cerrarSesion();
    });
    
    /**
     * Funciones para la correcta visualizacion y presentacion de la aplicacion
     */
    mesasActualesAdmi(1);
    mesasActualesAdmi(2);
    mesasActualesEliminarAdmi();
    traerMenu(1);
    traerMenuParaEliminar(1);
    traerMenuParaEditar(1);
    traerMeseros();
    
});




function guardarEdicionUsuario(tipo){
    console.log(tipo);
    switch (tipo){
        case 1:
            //Para guardar la imagen
            break;
        case 2:
            //Para guardar el nombre
            var nombre = $("#perfil_nombre").val();
            if( cumpleTalla(nombre, 6)){
                $.ajax({
                    url: RUTA_SERVIDOR + "configuraciones/Datos.php",//url del servidor
                    data: {tipo:4, dato:nombre},
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
        case 3:
            //Para guardar el correo
            var correo = $("#perfil_correo").val();
            if(validarEmail(correo)){
                $.ajax({
                    url: RUTA_SERVIDOR + "configuraciones/Datos.php",//url del servidor
                    data: {tipo:5, dato:correo},
                    type: "post"
                }).done(function(res){//cuando ya este listo
                    console.log("-->" + res);
                    $("#servidor_datos").html("");
                    $("#servidor_datos").html(res);//ponemos la respuesta del servidor en el documeto
                    desaparecerDivision("servidor_datos");
                });//fin del done
            }
            break;
        case 4:
            //Para guardar la direccion
            var direccion = $("#perfil_direccion").val();
            if(cumpleTalla(direccion, 10)){
                $.ajax({
                    url: RUTA_SERVIDOR + "configuraciones/Datos.php",//url del servidor
                    data: {tipo:6, dato:direccion},
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
        case 5:
            //Para guardar la edad
            var fecha = $("#perfil_fecha").val();
            if(cumpleTalla(fecha, 4)){
                $.ajax({
                    url: RUTA_SERVIDOR + "configuraciones/Datos.php",//url del servidor
                    data: {tipo:7, dato:fecha},
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
            
    }
    
    
    
    
    
}


function editarDato(tipo){
    switch (tipo){
        case 1:
            $("#nombre").fadeOut();
            $("#correo").fadeOut();
            $("#edad").fadeOut();
            $("#direccion").fadeOut();
            $("#img_perfil").fadeIn(50);
            $("#boton_guardar").html('<a onclick="guardarEdicionUsuario(1)" class="button small fit">Guardar</a>')
            break;
        case 2:
            $("#img_perfil").fadeOut();
            $("#correo").fadeOut();
            $("#edad").fadeOut();
            $("#direccion").fadeOut();
            $("#nombre").fadeIn(50);
            $("#boton_guardar").html('<a onclick="guardarEdicionUsuario(2)" class="button small fit">Guardar</a>')
            break;
        case 3:
            $("#img_perfil").fadeOut();
            $("#nombre").fadeOut();
            $("#edad").fadeOut();
            $("#direccion").fadeOut();
            $("#correo").fadeIn(50);
            $("#boton_guardar").html('<a onclick="guardarEdicionUsuario(3)" class="button small fit">Guardar</a>')
            break;
        case 4:
            console.log("VCuatro");
            $("#img_perfil").fadeOut();
            $("#nombre").fadeOut();
            $("#correo").fadeOut();
            $("#edad").fadeOut();
            $("#direccion").fadeIn(50);
            $("#boton_guardar").html('<a onclick="guardarEdicionUsuario(4)" class="button small fit">Guardar</a>')
            break;
        case 5:
            $("#img_perfil").fadeOut();
            $("#nombre").fadeOut();
            $("#correo").fadeOut();
            $("#direccion").fadeOut();
            $("#edad").fadeIn(50);
            $("#boton_guardar").html('<a onclick="guardarEdicionUsuario(5)" class="button small fit">Guardar</a>')
            break;
        
        default:
            break;
    }
}