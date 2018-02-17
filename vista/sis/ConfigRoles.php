<?php
session_start();
    require_once("../../controlador/CRoles.php");

    include_once("../../modelo/MCombo.php");
    $combo = new Combo();
?>
<html lang="es">
<head>
  <title>Configuraciones | Roles</title> 
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
  <script src="../../js/main.js?"></script> <!--Configura Interfaz -->
  <script src="../../js/DataTablesConfig.js"></script> <!--Configura Interfaz -->
  <script src="../../js/JsRoles.js?"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
  <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->


</head>
<?php include_once('Menu.php'); ?>
<div class="ui container">

    <form class="ui large form">
        <h2 class="ui center aligned small block icon inverted header">
            <i class="users icon"></i>
            Definición de Roles                
        </h2>   
        <a class="ui labeled icon button" href="Inicio.php">
            <i class="left arrow icon"></i>
            Volver
        </a>

        <p>Seleccionar usuario a configurar:</p>

        
        <div class="ui field">
            <label>Usuario:</label>
            <?php $tagcbotp=$combo->gen_combo("SELECT u.id_usuario AS id, concat(u.nombre,' - ',e.nombre1,' ',e.apellido1) AS socio FROM cappiutep.t_usuario AS u INNER JOIN cappiutep.t_persona AS e ON e.cedula = u.nombre","id","socio", isset($_GET[''])?$_GET['']:'','txtUsuario',' class="ui compact search dropdown" onchange="limpiarCheckbox();buscarServiciosAsignados(this.value)"');
                  foreach ($tagcbotp as $tagtp){echo $tagtp;}
            ?>       
        </div>
        <div id="Servs" name="Servs" class="ui hidden"> 
            <div class="ui styled fluid accordion" style="background:#f2f2f2">
                <?php foreach ($modulos as $ir => $modulo):?>
                <div class="inverted title">
                    <i class="ui large <?php echo $modulo['icono'] ?> icon"></i>
                    <?php echo $modulo["descripcion"] ?>
                </div>
                <div class="content">
                    <div class="accordion">
                        <?php   
                            if($servicios = $objServicio->listarServicios($modulo[0])){
                                foreach ($servicios as $index => $servicio){    
                        ?>
                        <div class="title">
                            <?php echo ucwords($servicio["descripcion"]); ?>
                        </div>
                        <div class="content">
                            <?php 
                                if($operaciones = $objOperacion->listarOperacion($servicio["id_tipo_vista"])){
                                  foreach($operaciones as $itO => $operacion){
                            ?>
                            <div class="ui inline toggle checkbox">
                                <input type="checkbox" onclick="guardarBD(this,'<?php echo $operacion[1] ?>','<?php echo strtoupper($modulo['descripcion']) ?>','<?php echo strtoupper($servicio['descripcion']) ?>')" name="<?php echo $modulo[0].'-'.$servicio[0].'-'.$operacion[0] ?>" id="<?php echo $modulo[0].'-'.$servicio[0].'-'.$operacion[0] ?>" nombre="<?php echo $operacion["descripcion"] ?>">
                                <label for="<?php echo $modulo[0].'-'.$servicio[0].'-'.$operacion[0] ?>"><b><?php echo $operacion["descripcion"] ?></b></label>
                            </div><br>
                                <?php } ?>
                            <?php } ?>
                        </div>                    
                        <?php } 
                         } ?>                       
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </form>
</div>
