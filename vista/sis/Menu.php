<?php
session_start();
  @include("../../modelo/MSesion.php");
  require_once("../../funciones.php");

  $objUsuario = new clsSesion;
  $modulosUsuario = $objUsuario->listarModulosUsuario();
  
  $socios=$objUsuario->datosSocio();

  foreach ($socios as $data => $socio)
?>
<link rel="stylesheet" type="text/css" href="../../js/sweetalert2/dist/sweetalert2.css">
<script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>  
<div class="ui blue sidebar inverted large vertical menu noprint">
    <div class='item'>
        <img class='ui center aligned small image' src='../../image/logop.png?nocache'>
    </div>
    <?php foreach ($modulosUsuario as $index => $modulo) { ?>
        <div class="item">
            <div class="header"><i class="<?php echo $modulo['icono'] ?> icon"></i><?php echo $modulo["descripcion"] ?></div>
            <div class="menu">
                <?php 
                    $servicios = $objUsuario->listarServiciosUsuario($modulo["id_modulo"]);
                    foreach ($servicios as $index2 => $servicio) { 
                ?>
                     <a class="item" onclick="window.location='<?php echo $servicio['url'] ?>'"><?php echo $servicio["descripcion"] ?></a>
                <?php 
                    } 
                ?>
            </div>
        </div>

    <?php } ?>
</div>

    <div class='pusher'>
        <div class='ui blue inverted top fixed large menu noprint'>
            <a class='item' onclick='menu()'>
              <i class='sidebar icon' ></i>
              Menú
          </a>
          <a class='item' href='Inicio.php'>
              <i class='home icon'></i>
              Inicio
          </a>
          <a class='item ' href='#'>
              <i class='user icon'></i>

              <?php
                $_SESSION['tipou']=$socio['id_tipo_persona'];
                $_SESSION['fnd']=$socio['fondocomun'];
              ?>

              <p> Bienvenido, <?php  $_SESSION['usuarios_socio']=$socio['nombre1']." ".$socio['apellido1']; echo $socio['nombre1']." ".$socio['apellido1']; ?> </p>
          </a>
          <div class='right menu'>
              <div class='item'>
                <a class='ui red mini button' onclick="cerrarSesion()">
                  <i class='sign out icon'></i>
                  Salir
              </a> 
          </div>
      </div>     
  </div>