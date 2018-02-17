$(document).ready(function(){


//Inicio Validaciones
  	$('.ui.form')
  	.form({
    	on: 'blur',
      keyboardShortcuts: false,	
    	inline : true,
  		fields: {

        user: {
          identifier: 'user',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          }
          ]
        },

        pass: {
          identifier: 'pass',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          }
          ]
        },

        captcha_code: {
          identifier: 'captcha_code',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          }
          ]
        }
        
  			
  		}
  	})
;
//Fin validariones
  })
;


function enviar()
{	
  if ( $('form').form('is valid') )
  {    
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
    
  }
}