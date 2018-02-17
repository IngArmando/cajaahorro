$(document).ready(function(){


//Inicio Validaciones
  	$('.ui.form')
  	.form({
    	on: 'blur',
      keyboardShortcuts: false,	
    	inline : true,
  		fields: {

        Des: {
          identifier: 'Des',
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


        Mod: {
          identifier: 'Mod',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          }
          ]
        },

        TipVis: {
          identifier: 'TipVis',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          }
          ]
        },

        URL: {
          optional : true,
          identifier: 'URL',
          rules: [
          {
            type   : 'minLength[3]',
            prompt : 'Debe contener más de {ruleValue} caractéres.'
          }
          ]
        },

        Pos: {
          optional : true,
          identifier: 'Pos',
          rules: [
          {
            type   : 'maxLength[3]',
            prompt : 'No debe contener más de {ruleValue} caractéres.'
          },
          {
            type   : 'integer[1..10]',
            prompt : 'Debe ser un número mayor a cero'
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
          window.location="ConfigServicio.php";
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
