$(document).ready(function(){

    $.fn.form.settings.rules.menorQueCampo = function(campo,maximo){
      var valido = false; 
      var elemento = document.getElementById(maximo).value;
      var a =parseInt(campo);
      var b =parseInt(elemento);
      if (a<=b)
        valido=true;     
      return valido;
    };

    $.fn.form.settings.rules.mayorQueCampo = function(campo,minimo){
      var valido = false; 
      var elemento = document.getElementById(minimo).value;
      var a =parseInt(campo);
      var b =parseInt(elemento);
      if (a>=b)
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

        ApoPat: {
          identifier: 'ApoPat',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[1...100]',
            prompt : 'Debe ser mayor a cero.'
          }
          ]
        },

        ApoSoc: {
          identifier: 'ApoSoc',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[1...100]',
            prompt : 'Debe ser mayor a cero.'
          }
          ]
        },

        DesMax: {
          identifier: 'DesMax',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[1...100]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'mayorQueCampo[DesMin]',
            prompt : 'Debe ser mayor o igual que el porcentaje de descuento mínimo.'
          }
          ]
        },

        DesMin: {
          identifier: 'DesMin',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...100]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'menorQueCampo[DesMax]',
            prompt : 'Debe ser menor o igual que el porcentaje de descuento máximo.'
          }
          ]
        },

        BenMax: {
          identifier: 'BenMax',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[1...100]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'mayorQueCampo[BenMin]',
            prompt : 'Debe ser mayor o igual que el número mínimo de beneficiarios.'
          }
          ]
        },

        BenMin: {
          identifier: 'BenMin',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...100]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'menorQueCampo[BenMax]',
            prompt : 'Debe ser menor o igual que el número máximo de beneficiarios.'
          }
          ]
        },

        NocMax: {
          identifier: 'NocMax',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[1...100]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'mayorQueCampo[NocMin]',
            prompt : 'Debe ser mayor o igual que el número mínimo de noches a alquilar.'
          }
          ]
        },

        NocMin: {
          identifier: 'NocMin',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[1...100]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'menorQueCampo[NocMax]',
            prompt : 'Debe ser menor o igual que el número máximo de noches a alquilar.'
          }
          ]
        },

        AcoMax: {
          identifier: 'AcoMax',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[1...100]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'mayorQueCampo[AcoMin]',
            prompt : 'Debe ser mayor o igual que el número mínimo de acompañantes.'
          }
          ]
        },

        AcoMin: {
          identifier: 'AcoMin',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...100]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'menorQueCampo[AcoMax]',
            prompt : 'Debe ser menor o igual que el número máximo de acompañantes.'
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
          window.location="ConfigOrganizacionReglas.php";
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
