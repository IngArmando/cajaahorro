<?php
session_start();

  include_once("../../modelo/MCombo.php");
  $combo = new Combo();

  /*include_once("../../modelo/MCompra.php");

  $OCompra = new Compra();
  $OCompra -> setid_compra($_GET['id']);
  $registro=$OCompra -> consultar();
  while ( $fila = $OCompra->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Compra) { $Compra; }*/
    include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();
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
             
    if($Soc['fcomun'] == 1){ $conectado =2;}
    if($Soc['fcesantia'] == 1){ $conectado =1;}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title> Gaastos Fondo  </title> 
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
  <script src="../../js/JsGasto.js"></script> <!--Validaciones --> 
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
      <i class="cube  icon"></i>
      Compras
    </h2>
    <h3 class="ui center aligned dividing header">Registrar Gastos</h3>

    <form class="ui large form" method="POST" action="../../controlador/CGasto.php" id="formulario" name="formulario">
      <p>Los campos marcados con <span style="color:red">*</span> son obligatorios: </p>

      <input type="hidden" name="fondo" value="<?php echo $conectado; ?>">

    
      <div class="two fields">      

        <div class="required field">
          <label> Descripción </label>
          <textarea id="descripcion" name="descripcion" placeholder="Ingrese aquí la descripción del gasto" ></textarea>
        </div>

        <div class="field">
          <div class="required field">
            <label> Tipo </label>
              
              <select class="ui search dropdown selection" name="tipo">
                <option value="1">Interno</option>
                <option value="2">Colectivo</option>
              </select>

                <br><br>
               <label> Año </label>
                <select class="ui search dropdown selection" name="ano" id="ano">
                  <?php
                    for ($d=2018; $d<=date(Y); $d++) { 
                      # code...
                      echo '<option value="'.$d.'">'.$d.'</option>';
                    }
                  ?>
                </select>

                <br><br>

                 <label> Mes </label>
                  <select class="ui search dropdown selection" name="mes" id="mes">
                    <?php
                      for ($g=1; $g<=date(m); $g++) { 
                        # code...
                        echo '<option value="'.$g.'">'.meses($g).'</option>';
                      }
                    ?>
                  </select>

          </div>
        </div>  

      </div>

      <div class="two fields">
        
        <div class="required field">
          <label> Monto </label>

           <input type="text" id="monto" name="monto" onkeypress="return soloNumeros(event)" >
          
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


      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera" >
        <input type="hidden" name="id_compra" id="id_compra" value="<?php if(isset($_GET['id'])) echo $_GET['id']; ?>">
        <input type="button" class="ui primary button" value="Registrar" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="window.location='compra.php'">
          Cancelar
        </div>
      </div>
    </form>
  </div>
</body>
</html>