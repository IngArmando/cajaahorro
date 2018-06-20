<?php
session_start();

   include_once("../../modelo/MCombo.php");
    $combo = new Combo();

     include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();
    $db= new Socio();
  /*if(!isset($_SESSION["user_name"])){
        header("location: ../pub/inise.php");
    }*/

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

<!DOCTYPE html>
<html>
<head>
  <title> Gastos Fondo </title>

  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->   

  <!--  Propiedades -->

    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->

  <link rel="stylesheet" type="text/css" href="../../css/Bootstrap/css/bootstrap.css"> <!--Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
  <link rel="stylesheet" type="text/css" href="../../js/DataTables/media/css/dataTables.bootstrap.css"><!-- Bootstrap Tablas -->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->

  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->

  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/DataTablesConfig.js"></script> <!--Configura Interfaz -->
  <script src="../../js/"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
  <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>
<body>  
  <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->

  <div class="ui container">
    <h2 class="ui center aligned small block icon inverted header">
      <i class="cube icon"></i>
      Gasto
    </h2>  
    <a class="ui labeled icon button" href="Inicio.php">
      <i class="left arrow icon"></i>
      Volver
    </a>

    <a class="ui labeled blue icon button" href="gasto_Registrar.php">
      <i class="plus icon"></i>
      Registrar
    </a>

<h4 class="ui centered block dividing header"> Gastos Fondo </h4>
        <table class='ui celled center aligned compact table' id='Tabla'>
            <thead>
              <tr>
                <th>Nº</th>
                <th>Ano</th>
                <th>Mes</th>
                <th>Detalle</th>
                <th>Tipo</th>
                <th>Valor</th>
              </tr>
            </thead>

            <tbody>

              <?php

                $sqlg="select * from cappiutep.gasto where fondo='".$conectado."' order by ano,mes desc";

                $as=$db->ejecutar($sqlg);

                while ($rowg=$db->getArreglo($as)) {
                  # code...
                  $k++;
                  if($rowg['tipo'] == 1){ $tip='Interno'; $val=$rowg['valor']; }else{ $tip='Colectivo'; $val='-'.$rowg['valor'];}
                  echo '
                    <tr>
                      <td>'.$k.'</td>
                      <td>'.$rowg['ano'].'</td>
                      <td>'.meses($rowg['mes']).'</td>
                      <td>'.$rowg['detalle'].'</td>
                      <td>'.$tip.'</td>
                      <td>'.$val.'</td>
                    </tr>
                  ';
                }

              ?>
              
            </tbody>
        </table>
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

</body>
</html>