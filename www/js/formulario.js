/* global RUTA_SERVIDOR */
//var RUTA_SERVIDOR = "http://localhost/AppRestaurante/servidor/";

(function(){
    
    //alert("Ready");
    var formulario_de_registro = document.formulario_registro;
    var	formulario_inicio_sesion = document.formulario_acceso;
    
    var elementos_registro = formulario_de_registro.elements;
    var elementos_acceso = formulario_inicio_sesion.elements;
    
    var edito_seleccionar_tipo_registro = 0;
    
    
    //Mostramos la pantallad e incio
    $("#intro").fadeIn(500, function(){//1500
        setTimeout(function(){
            $("#intro").fadeOut(500, function(){
                $("#principal").fadeIn(500);
            });
        }, 2000);
    });
    
    //PARA VERIFICAR LOS DATOS INGRESADOS POR EL USUARIO
    var validarInputs_registro = function(){
        for (var i = 0; i < elementos_registro.length; i++) {
            // Identificamos si el elemento es de tipo texto, email, password, radio o checkbox
		  if (elementos_registro[i].type == "email" || elementos_registro[i].type == "password" || elementos_registro[i].type == "number" || elementos_registro[i].type == "text") {
              //Este if podria ir mas arriba. pera ya pa que xdxd
              //Si aun no ha escogido el metodo de registro
              if($("#registrar-usando").val() == 0){
                  console.log('El usuario aun no escogido una opcion de registro');
                  alert("Escoge una forma de registro");
                  return false;
              }else{//Si ya escogio una forma de registro
                  //Como ha escogido el correo cambiamos el valor del campo numerico a un valor fake
                  //Ahora si empezamos a comprobar los campos del formulario
                  // Si es tipo texto, email o password vamos a comprobar que esten completados los input
                  if (elementos_registro[i].value.length == 0 ) {
                      console.log('El campo ' + elementos_registro[i].name + ' esta incompleto');
                      elementos_registro[i].className = elementos_registro[i].className + " error";
                      return false;
                  } else {
                      elementos_registro[i].className = elementos_registro[i].className.replace(" error", "");
                  }
              }//Fin del else escogio forma de registro

          }//Fin del if
        }//Fin del for que rectifica los datos del formulario

        return true;
    };//Fin de la funcion valdadr entradas del usuario registro


    //Validar los datos para el formulario login
    var validarInputs_login = function(){
        for (var i = 0; i < elementos_acceso.length; i++) {
            // Identificamos si el elemento es de tipo texto, email, password, radio o checkbox
            if (elementos_acceso[i].type == "text" || elementos_acceso[i].type == "password") {
                // Si es tipo texto, email o password vamos a comprobar que esten completados los input
                if (elementos_acceso[i].value.length == 0) {
                    console.log('El campo ' + elementos_acceso[i].name + ' esta incompleto');
                    elementos_acceso[i].className = elementos_acceso[i].className + " error";
                    return false;
                } else {
                    elementos_acceso[i].className = elementos_acceso[i].className.replace(" error", "");
                }
            }
        }
        return true;
    };//Fin de la funcion valdadr entradas del usuario login

    var enviar_registro = function(e){
        e.preventDefault();
        //alert("ENTRO A ENVIAR");
        if (!validarInputs_registro()) {
            console.log('Falto validar los Input');
        } else if (!validarCheckbox()) {
            console.log('Falto validar Checkbox');
        } else {
            console.log('Enviar registro');

            //Tomamos las variables del formulario con jquery
            var dato1 = $("#registrar-usando").val();
            if(dato1 == 0){
                alert("Por favor selecciona el tipo de usuario a registrar");
            }else{

                var dato2 = $("#codigo_reg").val();
                var dato3 = $("#registro_correo").val();
                var dato4 = $("#registro-nombre").val();
                var dato5 = $("#registro-direccion").val();
                var dato6 = $("#registro-pass").val();
                //COMPROBAMOS EL CORREO
                if(validarEmail(dato3)){
                    //Listo, todo correcto, procedemos a enviar
                    $("#mensajes").append("<div class='modal1'><div class='center1'> <center> <img src='img/gif-load.gif'></center><br><button id = 'cancelar-envio-reg' class='boton-aceptar-cancelar' >Cancelar</button></div></div>"); 
                    $("#cancelar-envio-reg").click(function(eve){
                        alert("Preiono cancelar");
                        $("#mensajes").html("");
                    });
                    $.post(
                        RUTA_SERVIDOR + "registro/registro.php",
                        {dato1:dato1, dato2:dato2, dato3:dato3, dato4:dato4, dato5:dato5, dato6:dato6},
                        function(respuesta){
                            //alert("Envio el post registro.");
                            console.log("Envio el post registro.");
                            console.log("Esto recibio del servidor:\n " + respuesta);
                            //Con esta linea de codigo, tomamos la respuesta del servidor y la colocamos en el documento para realizar las acciones
                            //alert(respuesta);
                            $("#mensajes").html("");
                            $("#mensajes").html(respuesta);	
                        });//fin del post
                }//FIN DEL VALIDA CORREO
            }//fIN DEL ELSE COMPROBO LOS CAMPOS
        }//Fin del else todo los datos llenos
    };//Fin de la funcion enviar registro
    
    
    var enviar_login = function(e){
        e.preventDefault();
        if (!validarInputs_login()) {
            console.log('Falto validar los Input');
        } else {
            console.log('Envia');
            //Codigo de envio
            //Tomamos los datos de inicio de sesion
            var acceso1 = $("#dato_de_acceso").val();
            var acceso2 = $("#pass_acceso").val();

            //Empezamos a verificar
            //Verficamos la talla de el acceso correo
            if(cumpleTalla(acceso1, 5)){
                //Si la contraseña cumple el minimo de caracteres
                if(cumpleTalla(acceso2, 5)){
                    //Procedemos a encriptar la contraseña para un envio seguro
                    var pass_a_enviar = encriptarContra(acceso2);
                    //Mostramos un mensaje de carga mientrase se envian y procesan los datos
                    $("#mensajes").append("<div class='modal1'><div class='center1'> <center> <img src='img/gif-load.gif'></center><br><button id = 'cancelar-envio-login' class='boton-aceptar-cancelar' >Cancelar</button></div></div>"); 
                    $("#cancelar-envio-login").click(function(eve){
                        //alert("Preiono cancelar");
                        $("#mensajes").html("");
                    });
                    //Enviamos los datos al servidor mediante post
                    //Desabilitamos el boton del login para que no reenvie
                    //$("#btn-submit-inicio-sesion").enable(false);
                    $.post(
                        RUTA_SERVIDOR + "acceso/iniciosesion.php",
                        {acceso1:acceso1, acceso2:acceso2},
                        function(respuesta){
                            //alert("Envio el post registro.");
                            console.log("Envio el login al servidor, esto recibio:\n" + respuesta);
                            //Con esta linea de codigo, tomamos la respuesta del servidor y la colocamos en el documento para realizar las acciones
                            $("#mensajes").html("");
                            $("#mensajes").html(respuesta);
                        });//fin del post				
                }else{
                    //Fin de la segunda comprobacion, la de la contraseña para que cumpla el minimo de caracteres
                    alert("La contraseña debe ser minimo de 5 digitos");
                }
            }else{
                //fin de Si el telefono o correo cumple la talla establecda
                alert("El nombre o correo usado para ingresar debe tener minimo 5 caracteres")
            }
	}
};//Fin de la funcion enviar login
    
    /**
    * Funcion que valida el elemento de aceptar los terminos
    * El usuario tiene que aceptar los terminos para poder registrarse
    */
    var validarCheckbox = function(){
        var opciones = document.getElementsByName('terminos'),
        resultado = false;
        for (var i = 0; i < elementos_registro.length; i++) {
            if(elementos_registro[i].type == "checkbox"){
                for (var o = 0; o < opciones.length; o++) {
                    if (opciones[o].checked) {
                        resultado = true;
                        break;
                    }
                }

                if (resultado == false) {
                    elementos_registro[i].parentNode.className = elementos_registro[i].parentNode.className + " error";
                    console.log('El campo checkbox esta incompleto');
                    return false;
                } else {
                    // Eliminamos la clase Error del checkbox
                    elementos_registro[i].parentNode.className = elementos_registro[i].parentNode.className.replace(" error", "");
                    return true;
                }
            }
        }
    };//Fin de la funcion valdadrChecked

    
    //PARA CONTROLAR LOS CAMBIOS EN EL TIPO DE USUARIO A REGISTRAR
    $("#registrar-usando").change(function(eve){
        eve.preventDefault();
        //alert("Cambio : " + $("#registrar-usando").val());
        if($("#registrar-usando").val() == 1 || $("#registrar-usando").val() == 2 && edito_seleccionar_tipo_registro == 0){
            
            
            $("#escogio").fadeIn(1000);
            edito_seleccionar_tipo_registro++;
        }
        
        if($("#registrar-usando").val() == 1){
            //Ha entrado al tipo administrador
            $("#lab-registro-codigo").html("Código para registro de administrador:");
        }
        if($("#registrar-usando").val() == 2){
            //Ha entrado al tipo administrador
            $("#lab-registro-codigo").html("Código para registro de mesero:");
        }
    });
    
    
    //PARA ENTRAR AL FORMULARIO DE REGISTRO
    $("#btn-registrarse").click(function(eve){
        eve.preventDefault();
        $("#img_principal").fadeOut(500);
        $("#acceso").fadeOut(1000, function(){
            $("#registro").fadeIn(1000);
            //limpiarCampos(1);
        });
    });
    
    //PARA SALIR DEL FORMULARIO REGISTRO
    $("#btn-salir-registro").click(function(eve){
        eve.preventDefault();
        $("#registro").fadeOut(1000, function(){
            $("#img_principal").fadeIn(500);
            $("#acceso").fadeIn(1000);
            //limpiarCampos(2);
        });
    });

    
    /**
    * Funciones para el control de los eventos de focus y blur
    */
    var focusInput = function(){
        this.parentElement.children[1].className = "label active";
        this.parentElement.children[0].className = this.parentElement.children[0].className.replace("error", "");
    };

    var blurInput = function(){
        if (this.value <= 0) {
            this.parentElement.children[1].className = "label";
            this.parentElement.children[0].className = this.parentElement.children[0].className + " error";
        }
    };
    
    //Este for es para asignar los eventos de blur y focus a los elementos del formulario de regstro
    for (var i = 0; i < elementos_registro.length; i++) {
        if (elementos_registro[i].type == "text" || elementos_registro[i].type == "email" || elementos_registro[i].type == "password") {
            elementos_registro[i].addEventListener("focus", focusInput);
            elementos_registro[i].addEventListener("blur", blurInput);
        }
    }
    //Este for es para asignar los eventos de blur y focus a los elementos del formulario de inicio de sesion
    
    for (var i = 0; i < elementos_acceso.length; i++) {
        if (elementos_acceso[i].type == "text" || elementos_acceso[i].type == "email" || elementos_acceso[i].type == "password") {
            elementos_acceso[i].addEventListener("focus", focusInput);
            elementos_acceso[i].addEventListener("blur", blurInput);
        }
    }
    
    //Cuando se quiera enviar el formulario registro
    formulario_de_registro.addEventListener("submit", enviar_registro);
    //Cuando se quiera enviar el formulario de inicio de sesion, se llama a la funcion respectiva 
    formulario_inicio_sesion.addEventListener("submit", enviar_login);

    
}());