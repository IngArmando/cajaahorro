<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Configuraciones | Beneficios</title> 
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
  <script src="../../js/JsBeneficios.js"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->


</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->         

  <div class="ui container"> 

    <h2 class="ui center aligned small block icon inverted header">
      <i class="square plus icon"></i>
      Beneficios
    </h2>
    <h3 class="ui center aligned dividing header">Registrar Beneficios</h3>

    <form class="ui large form" method="POST" action="../../ctrl/CBeneficios.php" id="formulario" name="formulario">
      <p>Todos los campos son obligatorios.</p>
      <div class="three fields">
        <div class="field">
          <label>Fecha Comienzo<i class="help circle small icon" data-content="Fecha desde la que se ofrece éste beneficio."></i></label>
          <input type="text" class="Fecha" id="FechaIni" name="FechaIni" placeholder="Fecha Comienzo" readonly>
        </div>
        <div class="field">
          <label>Icono</label>
          <div class="ui selection search dropdown">
            <input type="hidden" name="Icono" id="Icono">
            <i class="dropdown icon"></i>
            <div class="default text">Icono</div>
            <div class="menu">
              <div class="item" data-value="money"><i class="money icon"></i>Dinero</div>
              <div class="item" data-value="travel"><i class="travel icon"></i>Viaje</div>
              <div class="item" data-value="world"><i class="world icon"></i>Mundo</div>
              <div class="item" data-value="home"><i class="home icon"></i>Casa</div>
              <div class="item" data-value="alarm outline"><i class="alarm outline icon"></i>Alarma</div>
              <div class="item" data-value="heartbeat"><i class="heartbeat icon"></i>Latidos</div>
              <div class="item" data-value="idea"><i class="idea icon"></i>Idea</div>
              <div class="item" data-value="mail outline"><i class="mail outline icon"></i>Correo</div>
              <div class="item" data-value="map"><i class="map icon"></i>Mapa</div>
              <div class="item" data-value="protect"><i class="protect icon"></i>Proteger</div>
              <div class="item" data-value="flag"><i class="flag icon"></i>Bandera</div>
              <div class="item" data-value="in cart"><i class="in cart icon"></i>Comprar</div>
              <div class="item" data-value="lightning"><i class="lightning icon"></i>Relámpago</div>
              <div class="item" data-value="plane"><i class="plane icon"></i>Avión</div>
              <div class="item" data-value="suitcase"><i class="suitcase icon"></i>Maleta</div>
              <div class="item" data-value="user"><i class="user icon"></i>Usuario</div>
              <div class="item" data-value="doctor"><i class="doctor icon"></i>Doctor</div>
              <div class="item" data-value="users"><i class="users icon"></i>Usuarios</div>
              <div class="item" data-value="announcement"><i class="announcement icon"></i>Anuncio</div>
              <div class="item" data-value="male"><i class="male icon"></i>Hombre</div>
              <div class="item" data-value="female"><i class="female icon"></i>Mujer</div>
              <div class="item" data-value="book"><i class="book icon"></i>Libro</div>
              <div class="item" data-value="gift"><i class="gift icon"></i>Regalo</div>
              <div class="item" data-value="photo"><i class="photo icon"></i>Foto</div>
              <div class="item" data-value="car"><i class="car icon"></i>Carro</div>
              <div class="item" data-value="emergency"><i class="emergency icon"></i>Ambulancia</div>
              <div class="item" data-value="building outline"><i class="building outline icon"></i>Edificio</div>
              <div class="item" data-value="first aid"><i class="first aid icon"></i>Primeros Auxilios</div>
              <div class="item" data-value="university"><i class="university icon"></i>Universidad</div>
              <div class="item" data-value="external share"><i class="external share icon"></i>Retiros</div>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label>Nombre</label>
        <input type="text" id="Nombre" name="Nombre" placeholder="Nombre" onkeypress="return soloLetras(event)">
      </div>

      <div class="field">
        <label>Descripción</label>
        <textarea id="Desc" name="Desc"></textarea>
      </div>

      <div class="three fields">
        
        <div class="field">
          <label>Días mínimos para aprobación<i class="help circle small icon" data-content="Número aproximado de días necesarios para aprobar una solicitud del beneficio."></i></label>
          <input type="number" id="MinDiasAprob" name="MinDiasAprob" onkeypress="return soloNumeros(event)" min='0'>
        </div>

        <div class="field">
          <label>Días máximos para aprobación<i class="help circle small icon" data-content="Número aproximado de días que tardará en ser aprobada una solicitud del beneficio, a partir de éste número de días se considerará que está retrasada."></i></label>
          <input type="number" id="MaxDiasAprob" name="MaxDiasAprob" onkeypress="return soloNumeros(event)" min='0'>
        </div>

        <div class="field">
          <label>Días de antigëdad necesaria<i class="help circle small icon" data-content="Número de días de antigüedad necesarios para que el socio pueda disfrutar del beneficio."></i></label>
          <input type="number" id="MinDiasAnt" name="MinDiasAnt" onkeypress="return soloNumeros(event)" min='0'>
        </div>
      </div>

                    
 
      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera">
        <input type="button" class="ui primary button" value="Registrar" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="history.go(-1)">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>