$(document).ready(function(){

   //Inicio Validaciones
  	$('.ui.form')
  	.form({
    	on: 'blur',
      keyboardShortcuts: false,	
    	inline : true,
  		fields: {        

        Req: {
          identifier: 'Req',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
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
        idDir=document.formulario.IdBene.value;
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
          window.location="ConfigBeneficioRequisito.php?id="+idDir;
        }
        );
      },1500);
    });
}
}