$(function(){ //Validacion de duplicados de cedula
   $('#ci').on('blur',function(){
   
   var cedula = $('#ci').val();
   
   $.ajax({
       type: "POST",
       url: "../../ctrl/c_val_cedula.php",
       data: ('cedula='+cedula),
       success: function(respuesta){
          if (respuesta==1) {
               alert('Este número de cedula ya existe.')
          	   $('#ci').val('');
          	};
           
          }
        })
   })
})

$(function(){ //Validacion de duplicados de nro de cuenta
   $('#nro_cuenta').on('blur',function(){
   
   var nro_cuenta = $('#nro_cuenta').val();
   
   $.ajax({
       type: "POST",
       url: "../../ctrl/c_val_cuenta.php",
       data: ('nro_cuenta='+nro_cuenta),
       success: function(respuesta){
          if (respuesta==1) {
               alert('Este número de cuenta ya esta registrado.')
          	   $('#nro_cuenta').val('');
          	};
           
          }
        })
   })
})

$(function(){ //Validacion de duplicados de nro de cuenta
   $('#banco').on('change',function(){
   
   var banco = $('#banco').val();
   
   $.ajax({
       type: "POST",
       url: "../../ctrl/c_codigo_banco.php",
       data: ('banco='+banco),
       success: function(respuesta){
          	   $('#nro_cuenta').val(respuesta);
          }
        })
   })
})

$(document)
  .ready(function(){

  	var validacionSocio ={//validaciones

	    cedula: {//nombre de la validacion
	      identifier  : 'ci',//id del campo que valida
	      rules: [//reglas de validacion
	        {//regla #1
	          type   : 'empty',
	          prompt : 'Por favor escriba su cédula.'
	        },
	        {//regla #2
	          type   : 'maxLength[8]',
	          prompt : 'No puede contener más de 8 caracteres.'
	        }
	      ]
	    },//fin de la validacion de 1 campo

	    nombre: {
	      identifier  : 'nombre',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor escriba su nombre.'
	        },
	        {//regla #2
	          type   : 'length[3]',
	          prompt : 'Debe contener al 3 caracteres.'
	        }
	      ]
	    },

	    apellido: {
	      identifier  : 'apellido',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor escriba su apellido.'
	        },
	        {//regla #2
	          type   : 'length[3]',
	          prompt : 'Debe contener al menos 3 caracteres.'
	        }
	      ]
	    },

	    fecha_nac: {
	      identifier  : 'fecha_nac',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Seleccione una fecha de nacimiento.'
	        }
	      ]
	    },

	    telf_mov: {
	      identifier  : 'telf_mov',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor escriba su número de teléfono móvil.'
	        },
	        {
	          type   : 'length[11]',
	          prompt : 'Número invalido, por favor verifique.'
	        },
	        {
	          type   : 'maxLength[11]',
	          prompt : 'Número invalido, por favor verifique.'
	        }
	      ]
	    },

	    telf_loc: {
	      identifier  : 'telf_loc',
	      optional   : true,
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor escriba su número de teléfono de habitación.'
	        },
	        {
	          type   : 'length[11]',
	          prompt : 'Número invalido, por favor verifique.'
	        },
	        {
	          type   : 'maxLength[11]',
	          prompt : 'Número invalido, por favor verifique.'
	        }
	      ]
	    },

	    email: {
	      identifier  : 'email',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor escriba su correo electrónico.'
	        },
	        {
	          type   : 'email',
	          prompt : 'Dirección de correo invalida, por favor verifique.'
	        }
	      ]
	    },

	    direccion: {
	      identifier  : 'direccion',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor escriba dirección.'
	        }
	      ]
	    },

	    estado: {
	      identifier  : 'estado',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor seleccione un estado.'
	        }
	      ]
	    },

	    ciudad: {
	      identifier  : 'ciudad',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor seleccione una ciudad.'
	        }
	      ]
	    },

	    municipio: {
	      identifier  : 'municipio',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor seleccione un municipio.'
	        }
	      ]
	    },

	    parroquia: {
	      identifier  : 'parroquia',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor seleccione una parroquia.'
	        }
	      ]
	    },

	    cargo: {
	      identifier  : 'cargo',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor seleccione un cargo.'
	        }
	      ]
	    },

	    salario: {
	      identifier  : 'salario',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor introduzca un salario.'
	        }
	      ]
	    },

	    banco: {
	      identifier  : 'banco',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor seleccione un banco.'
	        }
	      ]
	    },

	    nro_cuenta: {
	      identifier  : 'nro_cuenta',
	      rules: [
	        {
	          type   : 'empty',
	          prompt : 'Por favor escriba el número de cuenta.'
	        },
	        {
	          type   : 'length[20]',
	          prompt : 'Número invalido, por favor verifique.'
	        },
	        {
	          type   : 'maxLength[20]',
	          prompt : 'Número invalido, por favor verifique.'
	        }
	      ]
	    },

	  }
	;

	$('.ui.form').form(validacionSocio,{//funcion que activa las validaciones
		inline: true
	});

	//Combos dependientes
	$("#ciudad").chained("#estado");
	$("#municipio").chained("#estado");
	$("#parroquia").chained("#municipio");
  
	//minDate: fecha de comienzo D=días | M=mes | Y=año
	//maxDate: fecha tope D=días | M=mes | Y=año
	$( "#datepicker" ).datepicker({ 
	    	maxDate: "-18Y",
	        changeMonth: true,
            changeYear: true,
            yearRange: "c-85:+0"
	});	

	$( "#datepicker2" ).datepicker({ 
	    	maxDate: "0",
	        changeMonth: true,
            changeYear: true,
            yearRange: "c-85:+0"
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


function enviar(operacion)
{		
	switch(operacion)
	{
		case "Guardar":
						$('.ui.modal').modal(
						{
						    closable  : false,
						    onDeny    : function(){
						      $('.ui.modal').modal('hide');
							},
						    onApprove : function() {
						      document.f_socio.opera.value=operacion;
							  $('.ui.form').form('submit');						      
						    }
						}).modal('show');
						break;
		case "Guardar Cambios":
						$('.ui.modal').modal(
						{
						    closable  : false,
						    onDeny    : function(){
						      $('.ui.modal').modal('hide');
							},
						    onApprove : function() {
						      document.f_socio.opera.value=operacion;
							  $('.ui.form').form('submit');						      
						    }
						}).modal('show');
						break;
		case "Registrar":
						document.f_socio.opera.value=operacion;
						$('.ui.form').form('submit');
						break;
		case "Solicitar":
						document.f_socio.opera.value=operacion;
						$('.ui.form').form('submit');
						break;
	}
	
}