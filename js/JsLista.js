$(document).ready(function(){


//Inicio Validaciones
  	$('.ui.form')
  	.form({
    	on: 'blur', 
      keyboardShortcuts: false,   	
    	inline : true,
  		fields: {

        Nombre: {
          identifier: 'Nombre',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'minLength[3]',
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
          text:"Operacion exitosa",
          showCancelButton: false,
          confirmButtonText: "Continuar",
          confirmButtonColor: "#2185d0",
        },function(){
          window.location="ConfigLista.php";
        }
        );
      },1500);
    });
}
}

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