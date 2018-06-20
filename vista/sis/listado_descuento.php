<?php
session_start();
    require_once("../../controlador/CRoles.php");
    include_once("../../modelo/MCombo.php");
    $combo = new Combo();

     include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();


    if (isset($_SESSION["userActivo"]))
    {
        $OSocio -> setCedula($_SESSION["userActivo"]);
        $registro=$OSocio -> busCedula();
        while ( $fila = $OSocio->setArreglo( $registro ))
          $datos[] = $fila;
      foreach ($datos as $Soc) { $Soc; }

    }

             
    if($Soc['fcomun'] == 1){ $conectado =2;  $sql="SELECT * from cappiutep.t_persona where fcomun='1' order by apellido1 asc"; }
    if($Soc['fcesantia'] == 1){ $conectado =1;  $sql="SELECT * from cappiutep.t_persona where fcesantia='1' order by apellido1 asc";}


?>
<html lang="es">
<head>
  <title>Liatado de Descuento</title> 
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
  <div class="panel-heading">DESCUENTOS</div>
  <div class="panel-body">
        
    <table class="table table-bordered">

        <tr>
          <th width="20%">Año</th>
          <th width="20%">Mes</th>
          <th>Beneficios</th>

        </tr>

        <tr>
            <td>
              <select class="ui search dropdown selection" id="ano">
                <?php
                  for ($d=2017; $d<=date(Y); $d++) { 
                    # code...
                    echo '<option value="'.$d.'" '; if(date(Y) == $d) echo 'selected'; echo '>'.$d.'</option>';
                  }
                ?>
              </select>
            </td>
            
              <td>
              <select class="ui search dropdown selection" id="mes">
                <?php
                  for ($g=1; $g<=12; $g++) { 
                    # code...
                    echo '<option value="'.$g.'" '; if(date(m) == $g) echo 'selected'; echo '>'.meses($g).'</option>';
                  }
                ?>
              </select>
            </td>

             <td><?php $tagcbotp=$combo->gen_combo2("SELECT * from cappiutep.t_tipo_persona","id_tipo_persona","nombre", isset($_GET[''])?$_GET['']:'','txtUsuario',' class="ui search dropdown selection" onchange="ver_bienes(this.value,'.$conectado.')"');
                  foreach ($tagcbotp as $tagtp){echo $tagtp;}
            ?>   
            </td>
        </tr>
    </table>

    <form method="post" name="" action="reportes/descuento/general.php" target="blanck">
    	<input type="hidden" name="fondo" value="<?php echo $conectado;?>">
     <div class="" id="muestra_tabla"></div>
    </form>
       

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
  
  function ver_bienes(a,fo) {
    // body...

    

    ms= document.getElementById('mes');
    an= document.getElementById('ano');

    me=ms.value;
    anos=an.value;

    $("#muestra_tabla").load('load_table.php?cod='+a+'&me='+me+'&ano='+anos+'&fo='+fo);
  }
</script>