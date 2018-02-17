<?php
session_start();
    require_once("../../controlador/CRoles.php");

    include_once("../../modelo/MCombo.php");
    $combo = new Combo();
?>
<html lang="es">
<head>
  <title>Compras Masivas</title> 
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



 <?php

      if($_POST['evento'] == 'guardar'){

          @include_once('../../modelo/MPgsql.php');

          $re=0;

         //$r='Año -> '.$_POST['ano'] .' Mes -> '.$_POST['mes'].' Casa -> '.$_POST['casa'].'<br>';
         foreach ($_POST['cedula'] as $posi => $value) {
           # code...

         // $r.=' Cedula -> '.$value.' Monto-> '.$_POST['compra'][$posi];

         // $r.='<br>';

         $sqli="insert into cappiutep.t_compra (id_persona,id_casa_comercial,descripcion,monto,estatus,ano,mes) values('".$value."',".$_POST['casa'].",'ninguna','".$_POST['compra'][$posi]."','1','".$_POST['ano']."','".$_POST['mes']."')";

          $gd= new CModeloDatos; 
          $gd2= new CModeloDatos; 

         // echo $sqlau="select * from cappiutep.t_compra where id_persona='".$value."' AND id_casa_comercial=".$_POST['casa']." AND ano='".$_POST['ano']."' AND mes=".$_POST['mes']." ";

        
                  if($gd->ejecutar($sqli)){

                    //echo 'Registro';
                    $re++;

                  }else{

                    //echo 'No Registro * ';
            
                  }
         }

          echo '
        <script>
          swal("Operaciòn Realizada", "Correctamente", "success");
        </script>
      ';
      }




 ?>




  <div class="panel panel-primary">
  <div class="panel-heading">DESCUENTOS CASAS COMERCIALES</div>
  <div class="panel-body">
 <form method="post" action="#">       
    <table class="table table-bordered">

        <tr style="background: #EEE;">
          <th width="20%">Año</th>
          <th width="20%">Mes</th>
          <th>Beneficiarios</th>
          <th>Casas Comerciales</th>

        </tr>

        <tr>
            <td>
              <select class="ui search dropdown selection" id="ano" name="ano">
                <?php
                  for ($d=2017; $d<=date(Y); $d++) { 
                    # code...
                    echo '<option value="'.$d.'"'; if($d == date(Y)) echo 'selected'; echo'>'.$d.'</option>';
                  }
                ?>
              </select>
            </td>
            
              <td>
              <select class="ui search dropdown selection" id="mes" name="mes">
                <?php
                  for ($g=1; $g<=12; $g++) { 
                    # code...
                    echo '<option value="'.$g.'" '; if($g == date(m)) echo 'selected'; echo'>'.meses($g).'</option>';
                  }
                ?>
              </select>
            </td>

              <td>
                <select class="ui search dropdown selection" onchange="ver_bienes(this.value)">
                    <option value="-"></option>

                  <?php

                      @include_once('../../modelo/MPgsql.php');
                      $dbb=new CModeloDatos;

                      $sqlba="select * from cappiutep.t_tipo_persona";

                      $abs=$dbb->ejecutar($sqlba);

                      while ($rowb=$dbb->getArreglo($abs)) {

                          echo '<option value="'.$rowb['id_tipo_persona'].'">'.$rowb['nombre'].'</option>';
                      }

                      echo '<option value="T">Todos</option>';
                  ?>
                    
                </select>
              </td>

             <td><?php $tagcbotp=$combo->gen_combo("SELECT * from cappiutep.t_casa_comercial","id_casa_comercial","descripcion", isset($_GET[''])?$_GET['']:'','casa',' class="ui search dropdown selection"  ');
                  foreach ($tagcbotp as $tagtp){echo $tagtp;}
            ?>   
            </td>
        </tr>
    </table>

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
  
  function ver_bienes(a) {
    // body...

    ms= document.getElementById('mes');
    an= document.getElementById('ano');

    me=ms.value;
    anos=an.value;

    $("#muestra_tabla").load('load_tablemasiva.php?cod='+a+'&me='+me+'&ano='+anos);
  }

  
</script>