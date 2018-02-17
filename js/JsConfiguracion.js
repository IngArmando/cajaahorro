$(document).ready(function(){

   

    $.fn.form.settings.rules.menorQueCampo = function(campo,maximo){
      var valido = false; 
      var elemento = document.getElementById(maximo).value;
      var a =parseInt(campo);
      var b =parseInt(elemento);
      if (a<b)
        valido=true;     
      return valido;
    };

    $.fn.form.settings.rules.mayorQueCampo = function(campo,minimo){
      var valido = false; 
      var elemento = document.getElementById(minimo).value;
      var a =parseInt(campo);
      var b =parseInt(elemento);
      if (a>b)
        valido=true;     
      return valido;
    };

//Inicio Validaciones
  	$('.ui.form')
  	.form({
    	on: 'blur',
      keyboardShortcuts: false,	
    	inline : true,
  		fields: {        

        LonMin: {
          identifier: 'LonMin',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...50]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'menorQueCampo[LonMax]',
            prompt : 'Debe ser menor que la longitud máxima.'
          }
          ]
        },    

        LonMax: {
          identifier: 'LonMax',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...50]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'mayorQueCampo[LonMin]',
            prompt : 'Debe ser mayor que la longitud mínima.'
          }
          ]
        },

        Intentos: {
          identifier: 'Intentos',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...50]',
            prompt : 'Debe ser un número entero.'
          }
          ]
        },

        Cadu: {
          identifier: 'Cadu',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...999]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'mayorQueCampo[NotCadu]',
            prompt : 'Debe ser mayor que los días antes de la notificación de caducidad.'
          }
          ]
        },

        NotCadu: {
          identifier: 'NotCadu',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...50]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'menorQueCampo[Cadu]',
            prompt : 'Debe ser menor que los días de caducidad.'
          }
          ]
        },

        Dif: {
          identifier: 'Dif',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...50]',
            prompt : 'Debe ser un número entero.'
          }
          ]
        },

       /* CarPer: {
          identifier: 'CarPer',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          }
          ]
        },*/

        Exp: {
          identifier: 'Exp',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...999]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'mayorQueCampo[NotExp]',
            prompt : 'Debe ser mayor que los minutos antes de la notificación de expiración.'
          }
          ]
        },

        NotExp: {
          identifier: 'NotExp',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...50]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'menorQueCampo[Exp]',
            prompt : 'Debe ser menor que los minutos de expiración.'
          }
          ]
        },

        MaxSes: {
          identifier: 'MaxSes',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...50]',
            prompt : 'Debe ser un número entero.'
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
          window.location="ConfigSistema.php";
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
