$(document).ready(function(){


//Inicio Validaciones
  	$('.ui.form')
  	.form({
    	on: 'blur', 
      keyboardShortcuts: false,   	
    	inline : true,
  		fields: {

        Rif: {
          identifier: 'Rif',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'exactLength[10]',
            prompt : 'Debe contener {ruleValue} caractéres.'
          }
          ]
        },

        Nit: {
          optional : true,
          identifier: 'Nit',
          rules: [
          {
            type   : 'exactLength[10]',
            prompt : 'Debe contener {ruleValue} caractéres.'
          }
          ]
        },

        Siglas: {
          optional : true,
          identifier: 'Siglas',
          rules: [
          {
            type   : 'minLength[3]',
            prompt : 'Debe contener más de {ruleValue} caractéres.'
          }
          ]
        },

        Razon: {
          identifier: 'Razon',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'minLength[5]',
            prompt : 'Debe contener más de {ruleValue} caractéres.'
          }
          ]
        },


        Telf: {
          optional : true,
          identifier: 'Telf',
          rules: [
          {
            type   : 'exactLength[11]',
            prompt : 'Debe contener {ruleValue} caractéres.'
          },
          {
            type   : 'number',
            prompt : 'Número inválido.'
          }
          ]
        },

        Email: {
          optional : true,
          identifier: 'Email',
          rules: [
          {
            type   : 'email',
            prompt : 'Dirección de correo inválida.'
          }
          ]
        },

        DirFiscal: {
          optional : true,
          identifier: 'DirFiscal',
          rules: [
          {
            type   : 'minLength[10]',
            prompt : 'Debe contener más de {ruleValue} caractéres.'
          }
          ]
        },

        Mision: {
          identifier: 'Mision',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'minLength[5]',
            prompt : 'Debe contener más de {ruleValue} caractéres.'
          }
          ]
        },

        Vision: {
          identifier: 'Vision',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'minLength[5]',
            prompt : 'Debe contener más de {ruleValue} caractéres.'
          }
          ]
        },

        Histor: {
          identifier: 'Histor',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'minLength[5]',
            prompt : 'Debe contener más de {ruleValue} caractéres.'
          }
          ]
        },

  			
  		}
  	})
;
//Fin validariones
  })
;


function enviar(operacion)
{ 
  if ( $('form').form('is valid') )
  {
    swal({
      text: "¿Está seguro de realizar ésta acción?",
      type: "info",
      showCancelButton: true,
      cancelButtonText: "Cancelar",
      cancelButtoncolor: "#d01919",
      confirmButtonText: "Aceptar",
      confirmButtonColor: "#2185d0",
      closeOnConfirm: false,
    },
    function(){
      swal.disableButtons();
      setTimeout(function(){
        document.formulario.opera.value=operacion;
        $("#formulario").submit(function(e){
          var postData = $(this).serialize();
          var formURL = $(this).attr("action");
          $.ajax({
            url : formURL,
            type: "POST",
            data : postData
          });
          e.preventDefault(); 
        });
        $("#formulario").submit();
        swal({
          type:"success",
          text:"Operación exitosa",
          showCancelButton: false,
          confirmButtonText: "Continuar",
          confirmButtonColor: "#2185d0",
        },function(){
          window.location="ConfigOrganizacion.php";
        }
        );
      },1500);
    });
}
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
