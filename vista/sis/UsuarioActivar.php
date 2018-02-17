<?php
session_start();
  include_once ('../../modelo/MSesion.php');
    $OSes = new clsSesion;

?>

<!DOCTYPE html>
<html>
<head>
  <title>CAPPIUTEP | Activar Usuario</title>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador --> 
  <!--  Propiedades -->
  <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
  <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../js/sweetalert2/dist/sweetalert2.css">
  <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->
  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
<body>  
    
  <div class="container"> 
       <form class="ui large form" method="POST" action="../../controlador/CSesion.php" name="formulario">
           <h2 class="ui center aligned small block icon inverted header">
              <i class="user icon"></i>
                Activación de Usuario                
           </h2>
           <p>Bienvenido a CAPPIUTEP en línea, por motivos de seguridad te sugerimos cambiar tu contraseña y crear preguntas secretas con las que podrás recuperarla de ser necesario:</p>
           <div class="ui info message">
             <p>La contraseña debe tener las siguientes características:</p>
             <?php echo $OSes->helpClave(); ?>
           </div>
           <h4 class="ui dividing header">Contraseña</h4>

              <div class="two fields"><!-- Contraseñas -->
                <div class="required field"><!-- Nueva Contraseña -->
                  <label>Nueva Contraseña</label>
                  <div class="ui left icon input">
                    <input type="password" name="pass" id="pass" placeholder="Nueva Contraseña">
                    <i class="lock icon"></i>
                  </div>
                </div>
                <div class="required field"><!-- Confirmar Contraseña -->
                  <label>Confirmar Contraseña:</label>
                    <div class="ui left icon input">
                      <input type="password" name="pass2" id="pass2" placeholder="Confirmar Contraseña">
                      <i class="lock icon"></i>
                  </div>
                </div>
              </div> 

            <h4 class="ui dividing header">Preguntas de Seguridad</h4>
              
              <table class="ui very basic table">
              <?php 
              $configuracion=$OSes->getArrayConfigurar();
              for($i=1;$i<=$configuracion["preguntas_cant"];$i++){ 

              ?>
              <tr>
                <td>
                  <div class="required field">
                    <label>Pregunta <?php echo $i ?>:</label>  
                    <input type="text" name="txtPregunta[]" id="Pregunta">
                </td>
              
                <td>
                  <div class="required field">
                    <label>Respuesta <?php echo $i ?>:</label>
                    <input type="password" name="txtRespuesta[]" id="Respuesta">
                  </div>
                </td>
              </tr>
              <?php } ?>
              </table>
          
          <div class="ui center aligned block inverted header">
            <input type="hidden" name="evento" id="evento" value="PrimerInicio">
            <input type="button" class="ui primary button" value="Continuar" onclick="enviar()" >
          </div>
       </form>
  </div>

  <script type="text/javascript">
  $(document).ready(function(){
  //Inicio Validaciones


      $('.ui.form')
      .form({
        on: 'blur',     
        inline : true,
        fields: {

          pass: {
            identifier: 'pass',
            rules: [
            {
              type   : 'empty',
              prompt : 'Escriba su contraseña.'
            },
            {
              type   : 'regExp[<?php echo $OSes->RegExpClave(); ?>]',
              prompt : 'La contraseña no cumple con los requisitos mínimos de seguridad.'
            }
            ]
          },

          pass2: {
            identifier: 'pass2',
            rules: [
            {
              type   : 'empty',
              prompt : 'Confirme su contraseña.'
            },
            {
              type   : 'match[pass]',
              prompt : 'Las contraseñas no coinciden.'
            }
            ]
          },

          pregunta: {
            identifier: 'Pregunta',
            rules: [
            {
              type   : 'empty',
              prompt : 'Escriba una pregunta secreta.'
            }
            ]
          },

          

          respuesta: {
            identifier: 'Respuesta',
            rules: [
            {
              type   : 'empty',
              prompt : 'Escriba la respuesta secreta.'
            }
            ]
          }
        }
      })
  ;
  //Fin validariones

  });


  function enviar(){ 
 $('form').form('validate form');
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
      $('form').form('submit');
    });
    
  }
}
  </script>
</body>
</html>