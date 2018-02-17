<?php
session_start();

  include_once("../../modelo/MCombo.php");
  $combo = new Combo();

  include_once("../../modelo/MPagoDescuento.php");
  $PagoDescuento = new PagoDescuento();

  $DatosPrestamo = $PagoDescuento->consultaBeneficio($_GET['id_prestamo']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Pagos y Descuentos</title> 
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
  <script src="../../js/JsModulo.js"></script> <!--Validaciones --> 
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
      Pagos y Descuentos
    </h2>
    <h3 class="ui center aligned dividing header">Registrar Pago y Descuento</h3>

    <form class="ui large form" method="POST" action="../../controlador/CPagoDescuento.php" id="formulario" name="formulario">
      <p>Los campos marcados con * son obligatorios: </p>

      <div class="two fields">
        <div class="required field">
          <label>Socio o Nómina</label>
          <?php
             $tagcbotp=$combo->gen_combo("SELECT id_persona,CONCAT(nacionalidad,'-',cedula,' / ',nombre1,' ',apellido1) AS datos FROM cappiutep.t_persona WHERE estatus='1'", "id_persona","datos", isset($_GET[''])?$_GET['']:'','persona',' class="ui search dropdown" onchange="filtrar_prestamo();" ');
             foreach ($tagcbotp as $tagtp){echo $tagtp;}
          ?>
          <!--input type="text" name="id_persona" id="id_persona" value="<?php echo $_GET['id_persona']; ?>"-->
        </div>
        
        <div class="required field">
          <label>Préstamo</label>
          <?php
             $tagcbotp=$combo->gen_combo("SELECT id_beneficio_solicitud,CONCAT('Cod: (',id_beneficio_solicitud,') / Fecha: (',fecha,') / Monto: (',monto,') ') AS datos FROM cappiutep.t_beneficio_solicitud WHERE id_solicitante='".$_GET['id_persona']."' AND estatus='4'", "id_beneficio_solicitud","datos", isset($_GET[''])?$_GET['']:'','prestamo',' class="ui search dropdown" onchange="filtrar_prestamo()"');
             foreach ($tagcbotp as $tagtp){echo $tagtp;}
          ?>
        </div>        
      </div>

      <!--CAMPOS CON LOS DATOS DEL PRÉSTAMO-->

      <input type="hidden" name="IdDetalle" id="IdDetalle">

      <div class="two fields">
        <div class="field">
          <label>Cuota</label>
          <input type="text" id="Cuota" name="Cuota" readonly>
        </div>
        
        <div class="field">
          <label> Fecha </label>
          <input type="text" id="Fecha" name="Fecha" value="<?php echo date('d-m-Y'); ?>" readonly>
        </div>        
      </div>
  
      <?php if ( $_GET['id_prestamo'] > 0 ) { ?>
        <div id="divDetalleAmortizacion">
          <table class="ui table table-striped table-condensed">
              <thead>
                  <tr>
                      <th height="10">Nro</th>
                      <th height="20">Mes</th>
                      <th height="40">Año</th>
                      <th height="40">Capital</th>
                      <th height="40">Interés</th>
                      <th height="40">Cuota</th>
                      <th height="40">Saldo</th>
                      <th height="40">Estado</th>
                  </tr>
              </thead>
              <tbody id="tablaAmortizacion">
                <?php
                  $DetalleAmortizacion = $PagoDescuento->consultaDetalleAmortizacion($_GET['id_prestamo']);
                  $entrar = '1';
                  foreach ($DetalleAmortizacion as $Arr) {
                    //$color =  ( $Arr['estatus'] == '0' ) ? "red" : "yellow";
                    if ( $Arr['estatus'] == '0' )
                    {
                      $Estado = "<label class='label label-default'> PENDIENTE </label>";
                      $color = "";
                      if ( $Arr['estatus'] == '0' && $entrar == '1' )
                      {
                        $entrar = '0';
                        $Estado = "<label class='label label-danger'> EN CURSO </label>";
                        echo "<script>document.getElementById('Cuota').value = ".$Arr['pago']."</script>";
                        echo "<script>document.getElementById('IdDetalle').value = ".$Arr['id_detalle_amortizacion']."</script>";
                      }
                    }
                    else
                    {
                      $Estado = "<label class='label label-success'> PAGADO </label>";
                      $color = "";
                    }
                    echo "
                      <tr style='background:$color'>
                        <td>".$Arr['nro']."</td>
                        <td>".$Arr['mes']."</td>
                        <td>".$Arr['anho']."</td>
                        <td>".$Arr['capital']."</td>
                        <td>".$Arr['amortizacion']."</td>
                        <td>".$Arr['pago']."</td>
                        <td>".$Arr['saldo']."</td>
                        <td>".$Estado."</td>
                      </tr>
                    ";
                  }
                ?>
              </tbody>
          </table>

        </div>
      <?php } ?>

      <div class="ui center aligned block inverted header">
        <input type="hidden" name="opera" id="opera">
        <input type="button" class="ui primary button" value="Registrar" onclick="enviar(this.value)">
        <div class="ui negative button" onclick="window.location='PagoDescuento.php'">
          Cancelar
        </div>
      </div>
    </form>
  </div>
  <script type="text/javascript">
    function filtrar_prestamo()
    {
      self.location="?id_persona="+document.getElementById('persona').value+"&id_prestamo="+document.getElementById('prestamo').value;

    }
    document.getElementById('persona').value = "<?php echo $_GET['id_persona']; ?>";
    document.getElementById('prestamo').value = "<?php echo $_GET['id_prestamo']; ?>";

function enviar(operacion)
{ 
  if ( $('form').form('is valid') )
  {
    swal({
      text: "¿Está seguro de realizar ésta acción?",
      type: "info",
      showCancelButton: true,
      cancelButtonText: "Cancelar",
      cancelButtoncolor: "#d01919",
      confirmButtonText: "Aceptar",
      confirmButtonColor: "#2185d0",
      closeOnConfirm: false,
    },
    function(){
      swal.disableButtons();
      setTimeout(function(){
        document.formulario.opera.value=operacion;
        $("#formulario").submit(function(e){
          var postData = $(this).serialize();
          var formURL = $(this).attr("action");
          $.ajax({
            url : formURL,
            type: "POST",
            data : postData
          });
          e.preventDefault(); 
        });
        $("#formulario").submit();
        swal({
          type:"success",
          text:"Operacion exitosa",
          showCancelButton: false,
          confirmButtonText: "Continuar",
          confirmButtonColor: "#2185d0",
        },function(){
          window.location="PagoDescuento.php";
        }
        );
      },1500);
    });
}
}
  </script>
</body>
</html>