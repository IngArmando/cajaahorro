$(function(){ //Envia formulario
   $('#Ingresar').on('click',function(e){
      e.preventDefault();
   
      var user = $('#user').val();
      var pass = $('#pass').val();
   
      $.ajax({
         type: "POST",
         url: "../../ctrl/c_acceso.php",
         data: ('user='+user+'&pass='+pass),
         success: function(respuesta){
            alert(respuesta);
         }
      })
   })
})