<?php
session_start();
  include('../../modelo/MConfiguracion.php');
  $OConf = new Configuracion;
  $registro=$OConf -> consultar();
  while ( $fila = $OConf->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Conf) { $Conf; }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Configuraciones | Sistema</title> 
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
  <script src="../../js/JsConfiguracion.js"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
  <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->


</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->         

  <div class="ui container"> 

    <h2 class="ui center aligned small block icon inverted header">
      <i class="settings  icon"></i>
      Configuraciones de Sistema
    </h2>

    <form class="ui large form" method="POST" action="../../controlador/CConfiguracion.php" id="formulario" name="formulario">
          
    <h4 class="ui dividing header">Contraseña</h4>
      
      <div class="three fields">
        <div class="field">
          <label>Longitud Mínima</label>
          <input type="number" id="LonMin" name="LonMin" min="4" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['clave_long_min'] ?>">
        </div>
        <div class="field">
          <label>Longitud Máxima</label>
          <input type="number" id="LonMax" name="LonMax" max="50" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['clave_long_max'] ?>">
        </div>
        <div class="field">
          <label>Máximo de intentos fallidos<i class="circle help icon" data-title="Ayuda" data-content="Número de intentos de inicio de sesión fallidos que permite el sistema antes de bloquear un usuario." data-variation="basic"></i></label>
          <input type="number" id="Intentos" name="Intentos"  min="0" max="99" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['clave_intentos_fallidos'] ?>">
        </div>        
      </div> 

      <div class="three fields">
        <div class="field">
          <label>Días de caducidad</label>
          <input type="number" id="Cadu" name="Cadu"  min="1" max="999" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['clave_dias_caducidad'] ?>">
        </div>
        <div class="field">
          <label>Notificar antes de caducar<i class="circle help icon" data-title="Ayuda" data-content="Cantidad de días en que el sistema notificará al usuario que su contraseña va a expirar." data-variation="basic"></i></label>
          <input type="number" id="NotCadu" name="NotCadu"  min="1" max="50" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['clave_dias_antes'] ?>">
        </div>
        <div class="field">
          <label>Diferente a anteriores</label>
          <input type="number" id="Dif" name="Dif"  min="1" max="999" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['clave_dif_anterior'] ?>">
        </div>        
      </div>
      <p>Debe tener las siguientes características:<p>
      <div class="four fields">
        <div class="field">
	        <div class="ui toggle checkbox">
	          <input type="checkbox" name="Mayus" id="Mayus" <?php if($Conf['clave_mayus']=='1') echo "checked"; ?>>
	          <label for="Mayus"><b>Una mayúscula</b></label>
	        </div>
        </div>  
        <div class="field">
	        <div class="ui toggle checkbox">
	          <input type="checkbox" name="Minus" id="Minus" <?php if($Conf['clave_minus']=='1') echo "checked"; ?>>
	          <label for="Minus"><b>Una minúscula</b></label>
	        </div>
        </div>  
        <div class="field">
	        <div class="ui toggle checkbox">
	          <input type="checkbox" name="Num" id="Num" <?php if($Conf['clave_num']=='1') echo "checked"; ?>>
	          <label for="Num"><b>Un número</b></label>
	        </div>
        </div>  
        <div class="field">
	        <div class="ui toggle checkbox">
	          <input type="checkbox" name="CarEsp" id="CarEsp" <?php if($Conf['clave_caracteres']=='1') echo "checked"; ?>>
	          <label for="CarEsp"><b>Un caracter especial</b></label>
	        </div>
        </div>       
      </div>
      <div class="six wide field">
      	<label>Caracteres especiales permitidos</label>
          <input type="text" id="CarPer" name="CarPer" maxlength="15" value="<?php echo $Conf['clave_caracteres_validos'] ?>">
      </div>

    <h4 class="ui dividing header">Contraseña</h4>
    <div class="three fields">
        <div class="field">
          <label>Minutos para expiración</label>
          <input type="number" id="Exp" name="Exp"  min="1" max="999" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['sesion_min_expira'] ?>">
        </div>
        <div class="field">
          <label>Notificar antes de expiración<i class="circle help icon" data-title="Ayuda" data-content="Cantidad de minutos en que el sistema notificará al usuario que su sesión va a expirar." data-variation="basic"></i></label>
          <input type="number" id="NotExp" name="NotExp"  min="1" max="50" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['sesion_min_antes'] ?>">
        </div>
        <div class="field">
          <label>Número máximo de sesiones abiertas<i class="circle help icon" data-title="Ayuda" data-content="Número de sesiones activas simultaneas que puede tener un usuario." data-variation="basic"></i></label>
          <input type="number" id="MaxSes" name="MaxSes" min="1" max="50" onkeypress="return soloNumeros(event)" value="<?php echo $Conf['max_sesiones_abiertas'] ?>">
        </div>        
      </div>

    <h4 class="ui dividing header">Notificaciones Automáticas</h4>
      <div class="centered two fields">
        <div class="field">
	        <div class="ui toggle checkbox">
	          <input type="checkbox" name="Email" id="Email" <?php if($Conf['not_correo']=='1') echo "checked"; ?>>
	          <label for="Email"><b>Correos Electrónicos</b></label>
	        </div>
        </div>  
        <div class="field">
	        <div class="ui toggle checkbox">
	          <input type="checkbox" name="SMS" id="SMS" <?php if($Conf['not_telf']=='1') echo "checked"; ?>>
	          <label for="SMS"><b>Mensajes de Texto</b></label>
	        </div>
        </div>      
      </div>   

      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera">
        <input type="button" class="ui primary button" value="Guardar Cambios" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="window.location='Inicio.php'">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>