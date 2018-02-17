
$(function(){ 
   $('#tipos_prestamo').on('change',function(){
   
	   var tipo = $('#tipos_prestamo').val();
	   
	   if (tipo==1) {
		   	$('#cuotas').prop('min','1');
		   	$('#cuotas').prop('max','2');
		   	$('#plazo').dropdown('set selected','Corto');
		   
		   	
		   	$("#plazo").dropdown('destroy');
	   }else if (tipo==0){
	   
		   	$('#plazo').dropdown('restore defaults');
		   	$('.ui.dropdown').dropdown();

		   	$('#cuotas').val('');
		   	
	   }
   });
});

$(function(){ 
   $('#plazo').on('change',function(){
   
   var plazo = $('#plazo').val();
   var tipo = $('#tipos_prestamo').val();
   switch(plazo)
   {
   	
   	case "1": 
		if(tipo==1){
			$('#cuotas').prop('min','1');
          	$('#cuotas').prop('max','2');
		}else{
			$('#cuotas').prop('min','12');
          	$('#cuotas').prop('max','18');	
		}
   	break;

   	case "2": 
   			  $('#cuotas').prop('min','19');
   			  $('#cuotas').prop('max','36');
   	break;

   	case "3": 
   	          $('#cuotas').prop('min','37');
   	          $('#cuotas').prop('max','48');
   	break;

   }
  
   })
})

$(document)
  .ready(function(){

  	var validacionSocio ={//validaciones

	    tipo: {//nombre de la validacion
	      identifier  : 'tipos_prestamo',//id del campo que valida
	      rules: [//reglas de validacion
	        {//regla #1
	          type   : 'empty',
	          prompt : 'Seleccione un tipo de prestamo.'
	        }
	      ]
	    },//fin de la validacion de 1 campo

	    plazo: {
	      identifier  : 'plazo',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Seleccione un plazo de pago.'
	        }
	      ]
	    },

	    monto: {
	      identifier  : 'monto',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Escriba el monto que desea solicitar.'
	        },
	        {//regla #2
	          type   : 'length[4]',
	          prompt : 'Debe contener al menos 4 caracteres.'
	        },
	        {//regla #2
	          type   : 'maxLength[10]',
	          prompt : 'No puede mas de 10 caracteres.'
	        }
	      ]
	    },

	    motivo: {
	      identifier  : 'motivo',
	      optional   : true,
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Seleccione el motivo'
	        },
	        
	      ]
	    },

	    observaciones: {
	      identifier  : 'observ',
	      optional   : true,
	      rules: [
	        {//regla #2
	          type   : 'length[10]',
	          prompt : 'Debe contener al menos 10 caracteres.'
	        }
	      ]
	    },

	    cuotas: {
	      identifier  : 'cuotas',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Seleccione un número de cuotas.'
	        }
	      ]
	    }

	  }
	;

	$('.ui.form').form(validacionSocio,{//funcion que activa las validaciones
		inline: true
	});



  })
;

function soloLetras(e) {//Valida para que se escriban solo letras
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}


function soloNumeros(e){//Valida para que se escriban ssolo numeros
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " 0123456789,";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }


function enviar(operacion){
	switch(operacion){
		case "Solicitar":
						$('.ui.modal').modal(
						{
						    closable  : false,
						    onDeny    : function(){
						      $('.ui.modal').modal('hide');
							},
						    onApprove : function() {
						      document.f_prestamo.opera.value=operacion;
							  $('.ui.form').form('submit');						      
						    }
						}).modal('show');
						break;

		case "Analizar":
			$('.ui.modal').modal({
			    closable  : false,
			    onDeny    : function(){
			      $('.ui.modal').modal('hide');
				},
			    onApprove : function() {
			      document.f_prestamo.opera.value=operacion;
				  $('.ui.form').form('submit');						      
			    }
			}).modal('show');
						
		break;
		case "Procesar_Analisis":
			$('.ui.modal').modal({
			    closable  : false,
			    onDeny    : function(){
			      $('.ui.modal').modal('hide');
				},
			    onApprove : function() {
			      document.f_prestamo.opera.value=operacion;
				  $('.ui.form').form('submit');						      
			    }
			}).modal('show');
		break;
		case "Aceptar":
			$('.ui.modal').modal({
			    closable  : false,
			    onDeny    : function(){
			      $('.ui.modal').modal('hide');
				},
			    onApprove : function() {
			      document.f_prestamo.opera.value=operacion;
				  $('.ui.form').form('submit');						      
			    }
			}).modal('show');
		break;
    	
		case "Aprobar":
			$('.ui.modal').modal({
			    closable  : false,
			    onDeny    : function(){
			      $('.ui.modal').modal('hide');
				},
			    onApprove : function() {
			      document.f_prestamo.opera.value=operacion;
				  $('.ui.form').form('submit');						      
			    }
			}).modal('show');
		break;

		case "Liquidar":
			$('.ui.modal').modal(
			{
			    closable  : false,
			    onDeny    : function(){
			      $('.ui.modal').modal('hide');
				},
			    onApprove : function() {
			      document.f_prestamo.opera.value=operacion;
				  $('.ui.form').form('submit');						      
			    }
			}).modal('show');
		break;
		// Soporte para Rechazar las solicitudes de prestamo con notificación de correo.
		case "Rechazar":
		$('.ui.modal').modal({
		    closable  : false,
		    onDeny    : function(){
		      $('.ui.modal').modal('hide');
			},
		    onApprove : function() {
		      document.f_prestamo.opera.value=operacion;
			  $('.ui.form').form('submit');						      
		    }
		}).modal('show');
		break;
    }	
}