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

  <div class="panel panel-primary">
  <div class="panel-heading">DESCUENTOS CASAS COMERCIALES</div>
  <div class="panel-body">
        
    <table class="table table-bordered">

        <tr style="background: #EEE;">
          <th width="20%">Año</th>
          <th width="20%">Mes</th>
          <th>Beneficiarios</th>
          <th>Casas Comerciales</th>

        </tr>

        <tr>
            <td>
              <select class="ui search dropdown selection" id="ano">
                <?php
                  for ($d=2017; $d<=date(Y); $d++) { 
                    # code...
                    echo '<option value="'.$d.'"'; if(date(Y) == $d) echo 'selected'; echo '>'.$d.'</option>';
                  }
                ?>
              </select>
            </td>
            
              <td>
              <select class="ui search dropdown selection" id="mes">
                <?php
                  for ($g=1; $g<=12; $g++) { 
                    # code...
                    echo '<option value="'.$g.'"'; if(date(m) == $g) echo 'selected'; echo '>'.meses($g).'</option>';
                  }
                ?>
              </select>
            </td>

            <td><?php $tagcbotp=$combo->gen_combo("SELECT * from cappiutep.t_tipo_persona","id_tipo_persona","nombre", isset($_GET[''])?$_GET['']:'','beneficiario',' class="ui search dropdown selection" onchange="ver_bienes2(this.value)"');
                  foreach ($tagcbotp as $tagtp){echo $tagtp;}
            ?>   
            </td>

             <td><?php $tagcbotp=$combo->gen_combo("SELECT * from cappiutep.t_casa_comercial","id_casa_comercial","descripcion", isset($_GET[''])?$_GET['']:'','casa',' class="ui search dropdown selection" onchange="ver_bienes(this.value)"');
                  foreach ($tagcbotp as $tagtp){echo $tagtp;}
            ?>   
            </td>
        </tr>
    </table>

    <div class="" id="muestra_tabla"></div>

       

  </div>
</div>
    
</div>

<?php

  function meses($me)
  {
    # code...
    if($me == 1){ $mess="Enero" ;}
    if($me == 2){ $mess="Febrero" ;}
    if($me == 3){ $mess="Marzo" ;}
    if($me == 4){ $mess="Abril" ;}
    if($me == 5){ $mess="Mayo" ;}
    if($me == 6){ $mess="Junio" ;}
    if($me == 7){ $mess="Julio" ;}
    if($me == 8){ $mess="Agosto" ;}
    if($me == 9){ $mess="Septiembre" ;}
    if($me == 10){ $mess="Octubre" ;}
    if($me == 11){ $mess="Noviembre" ;}
    if($me == 12){ $mess="Diciembre" ;}

    return $mess;
  }
 
?>

<script type="text/javascript">
  
  function ver_bienes(a) {
    // body...

    ms= document.getElementById('mes');
    an= document.getElementById('ano');
    bn= document.getElementById('beneficiario');

    me=ms.value;
    anos=an.value;
    bne= bn.value;

    $("#muestra_tabla").load('load_tablecasa.php?cod='+a+'&me='+me+'&ano='+anos+'&tipo='+bne);
  }

  function ver_bienes2(a) {
    // body...

    ms= document.getElementById('mes');
    an= document.getElementById('ano');
    bn= document.getElementById('casa');

    me=ms.value;
    anos=an.value;
    bne= bn.value;

    if(bne == ''){

    }else{
      $("#muestra_tabla").load('load_tablecasa.php?cod='+bne+'&me='+me+'&ano='+anos+'&tipo='+a);
    }

    
  }

  
</script>