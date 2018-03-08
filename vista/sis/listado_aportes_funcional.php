<?php
session_start();
    require_once("../../controlador/CRoles.php");

    include_once("../../modelo/MCombo.php");
    $combo = new Combo();

    

    	switch ($_POST['evento']) {
    		case 'guardar':{
    			include_once("../../modelo/MPgsql.php");

    			
    			foreach ($_POST['cedula'] as $key => $valor) {
    				# code...
    				$obj= new CModeloDatos;
    				 $sql="insert into cappiutep.aporte (id_persona,tipo,ano, mes, aporte,sb,porcentaje,estatus,aportado) values('".$valor."','".$_POST['tipo']."','".date(Y)."','".date(m)."','".$_POST['aporte'][$key]."','".$_POST['sb'][$key]."','".$_POST['porce'][$key]."','0','0')"; 
    				$obj->ejecutar($sql);
    			}
    			 

    		}
    			# code...
    			break;
    		
    		default:
    			# code...
    			break;
    	}
?>

<html lang="es">
<head>
  <title>Configurar Aportes</title> 
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

	<form method="post" action="">

  <div class="panel panel-primary">
  <div class="panel-heading">Configuracion de Aportes <?php //$_SESSION['tipou']; ?></div>
  <div class="panel-body">
        
    <table class="table table-bordered">

        <tr>
          <th>Banco</th>

        </tr>

        <tr>
            
             <td>
                <b> <center> <?php
                  if($_SESSION['tipou'] == 2 AND $_SESSION['fondocos'] == 1){
                    echo 'FONDO COMUN';

                    $yu=2;
                  }else{
                    echo 'FONDO DE CESANTIA'.$_SESSION['fondocos'].'**';
                    $yu=1;
                    

                  }
                 ?></center></b>
              <?php /* $tagcbotp=$combo->gen_combo("SELECT * from cappiutep.t_beneficio","id_beneficio","nombre", isset($_GET[''])?$_GET['']:''.$yu,'txtUsuario',' class="ui search dropdown selection" onchange="ver_bienes(this.value)"');
                  foreach ($tagcbotp as $tagtp){echo $tagtp;}*/

                  echo strtoupper('<b>MES '.meses(date(m)).'</b>');
            ?>   
            </td>
        </tr>
    </table>

    <div class="" id="muestra_tabla"></div>

    <input type="hidden" name="tipo" value="<?php echo  $yu;?>">

  </div>
</div>

</form>
    
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
    
    $("#muestra_tabla").load('load_aporte.php?cod='+a);
  }
</script>

<?php
  echo '<script>
                      ver_bienes('.$yu.');
                    </script>';
?>

