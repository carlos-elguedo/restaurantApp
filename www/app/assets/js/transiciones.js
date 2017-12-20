/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function($) {
    //alert("Llego");
    
    //Para ver el plato
        
    //Para cambio de codigo de administrador
    var $codAdmoi = $('#bot_conf_cod_adm'), $teatro_cam_cod_admi = $('#teatro_conf_cod_adm'), transition;
    $codAdmoi.on('click', function() {
        //alert("Dio click");
        $teatro_cam_cod_admi[0].showModal();
        transition = window.setTimeout(function() {
            $teatro_cam_cod_admi.addClass('dialog-scale');
            }, 0.5);  });
	$('#cancel_cam_cod_adm').on('click', function() {
            $teatro_cam_cod_admi[0].close();
            $teatro_cam_cod_admi.removeClass('dialog-scale');
            clearTimeout(transition);
	});
    //Para cambio de codigo de mesero
    var $codMese = $('#bot_conf_cod_mes'), $teatro_cam_cod_mese = $('#teatro_conf_cod_mes'), transition;
    $codMese.on('click', function() {
        //alert("Dio click");
        $teatro_cam_cod_mese[0].showModal();
        transition = window.setTimeout(function() {
            $teatro_cam_cod_mese.addClass('dialog-scale');
            }, 0.5);  });
	$('#cancel_cam_cod_mes').on('click', function() {
            $teatro_cam_cod_mese[0].close();
            $teatro_cam_cod_mese.removeClass('dialog-scale');
            clearTimeout(transition);
	});
    
    //Para cambiar la contraseña de administrador
    var $camCont = $('#bot_conf_contr'), $teatro_cam_cont = $('#teatro_camb_cont'), transition;
    $camCont.on('click', function() {
        //alert("Dio click");
        $teatro_cam_cont[0].showModal();
        transition = window.setTimeout(function() {
            $teatro_cam_cont.addClass('dialog-scale');
            }, 0.5);  });
	$('#cancel_camb_cont').on('click', function() {
            $teatro_cam_cont[0].close();
            $teatro_cam_cont.removeClass('dialog-scale');
            clearTimeout(transition);
	});
        
})(jQuery);