
$(document)
  .ready(function(){

  	var validacionUser ={//validaciones

	    pass1: {//nombre de la validacion
	      identifier  : 'pass',//id del campo que valida
	      rules: [//reglas de validacion
	        {//regla #1
	          type   : 'empty',
	          prompt : 'Por favor escriba su nueva contraseña.'
	        },
	        {//regla #2
	          type   : 'length[6]',
	          prompt : 'Debe contener al menos 6 caracteres.'
	        }
	      ]
	    },//fin de la validacion de 1 campo

	    pass2: {
	      identifier  : 'pass2',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor escriba su nueva contraseña.'
	        },
	        {
	          type   : 'length[6]',
	          prompt : 'Debe contener al menos 6 caracteres.'
	        }
	      ]
	    },

	    pregunta1: {
	      identifier  : 'pregunta1',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Seleccione una pregunta.'
	        }
	      ]
	    },

	    pregunta2: {//nombre de la validacion
	      identifier  : 'pregunta2',//id del campo que valida
	      rules: [//reglas de validacion
	        {//regla #1
	          type   : 'empty',
	          prompt : 'Seleccione una pregunta.'
	        }
	      ]
	    },//fin de la validacion de 1 campo

	    respuesta1: {//nombre de la validacion
	      identifier  : 'respuesta1',//id del campo que valida
	      rules: [//reglas de validacion
	        {//regla #1
	          type   : 'empty',
	          prompt : 'Escriba una respuesta.'
	        }
	      ]
	    },//fin de la validacion de 1 campo

	    respuesta2: {//nombre de la validacion
	      identifier  : 'respuesta2',//id del campo que valida
	      rules: [//reglas de validacion
	        {//regla #1
	          type   : 'empty',
	          prompt : 'Escriba una respuesta.'
	        }
	      ]
	    }//fin de la validacion de 1 campo

	    

	  }
	;

	$('.ui.form').form(validacionUser,{//funcion que activa las validaciones
		inline: true
	});

	

  })
;

var envio = true;
    
verificarExpresion = function(that,valor) {
    _this = that;
    var patron = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!"·$%&/])(?=\S+$).{6,16}$/;
    if(valor!=""){
        if(patron.test(valor)){
            envio = true;
            //$('#'+_this.id).popover('hide');
        }else{ 
        	alert("la contraseña no cumple con los requisitos minimos de seguridad");
            envio = false;
            document.getElementById(_this.id).value="";
            document.getElementById(_this.id).focus();
            //$('#'+_this.id).popover('show');
        }
    }
}

function enviar(operacion){		
   var pass1 = document.f_user.pass.value;
   var pass2 = document.f_user.pass2.value;

   	if (pass1==pass2) {
   		if(envio==true){
			document.f_user.opera.value=operacion;
			$('.ui.form').form('submit');   	
		}else{
			alert("la contraseña no cumple con los requisitos minimos de seguridad");
		}
   	}else
      alert("Las contraseñas no coinciden.");
	
}