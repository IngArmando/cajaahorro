<?php
session_start();

  if (!isset($_SESSION['userTemp'])) {
    session_destroy();
    header('location: acceso.php');
  }


  if (!isset($_SESSION['Preguntas'])) {
    session_destroy();
    header('location: acceso.php');
  }

  include_once ('../../modelo/MSesion.php');
    $OSes = new clsSesion;

?>

<!DOCTYPE html>
<html>
<head>
  <title>Recuperar Contraseña</title>
  
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->   
    
  <!--  Propiedades -->

  <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
  <link rel="stylesheet" type="text/css" href="../../css/Bootstrap/css/bootstrap.css"> <!--Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../js/sweetalert2/dist/sweetalert2.css">
  <link rel="stylesheet" type="text/css" href="../../js/DataTables/media/css/dataTables.bootstrap.css"><!-- Bootstrap Tablas -->
  <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->

  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/DataTablesConfig.js"></script> <!--Configura Interfaz -->
  <script src="../../js/JsLista.js"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
  <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>
<body>  

  <div class="ui container"> 
    <form class="ui large form" method="POST" action="../../controlador/CRecuperar.php" name="formulario">
      <div class="ui center aligned small block icon inverted header">
        <i class='ui help icon'></i>
        Recuperar Contraseña
      </div>

      <div class="ui small three steps">
        <div class="completed step">
          <i class="user icon"></i>
          <div class="content">
            <div class="title">Usuario</div>
          </div>
        </div>
        <div class="completed step">
          <i class="help icon"></i>
          <div class="content">
            <div class="title">Preguntas Secretas</div>
          </div>
        </div>
        <div class="active step">
          <i class="lock icon"></i>
          <div class="content">
            <div class="title">Nueva Contraseña</div>
          </div>
        </div>
      </div> 
      <div class="ui basic segment">
        <p>Para finalizar el proceso, ingrese su nueva contraseña recuerde que no puede ser igual a alguna de las <?php echo $OSes->helpClaveDif();  ?> anteriores y debe tener las siguientes características:</p>
        <?php echo $OSes->helpClave(); ?>
        <div class="ui raised segment">

          <div class="two fields"><!-- Contraseñas -->
            <div class="required field"><!-- Nueva Contraseña -->
              <label>Nueva Contraseña</label>
              <div class="ui left icon input">
                <input type="password" name="pass" id="pass" placeholder="Nueva Contraseña">
                <i class="lock icon"></i>
              </div>
            </div>
            <div class="required field"><!-- Confirmar Contraseña -->
              <label>Confirmar Contraseña</label>
                <div class="ui left icon input">
                  <input type="password" name="pass2" id="pass2" placeholder="Confirmar Contraseña">
                  <i class="lock icon"></i>
              </div>
            </div>
          </div> 
        </div>  
        
      </div>


        <div class="ui center aligned block inverted header">
          <input type="hidden" id="opera" name="opera" value="Rec3">
          <input type="hidden" id="ant" name="ant"     value="<?php echo $OSes->helpClaveDif();  ?>">
          <input class="ui primary button" type="button" value="Continuar" onclick="enviar()">
          <input class="ui red button" type="button" value="Cancelar" onclick="cerrarSesion()">
        </div>
      </form>
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