<?php
session_start();

    if(!isset($_SESSION["userActivo"])){
        header("location: ../pub/inise.php");
    }

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
  <title>Historial Solicitudes</title> 
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
  <div class="panel-heading">HISTORIAL PRESTAMOS</div>
  <div class="panel-body">
        

    <div class="" id="muestra_tabla">

      <table class="table table-bordered">
        <tr style="background: #EEE;"><th><center>Historial </center></th></tr>
      </table>
      
      <script type="text/javascript">
   var t=0;
 </script>

 <table class="table table-bordered" style="width:50%;">
   <tr>
     <th> Fondo </th>
     <th> Estatus </th>
    </tr>
    <tr> 
     <td> 
          <select class="ui search dropdown selection" name="" id="fondo" >
            <?php
              if($conectado == 1){ echo '<option value="1">Cesantia</option>'; }
              if($conectado == 2){ echo '<option value="2">Comun</option>'; }
            ?>
          </select>
     </td>
        
     <td>
        <select class="ui dropdown" name="" id="esta" onchange="ver_deudas(this.value,<?php $Soc['id_persona']; ?>)" readonly>
                   <option value="0">Seleccione</option>
                   <option value="1">En análisis</option>
                   <option value="2">Esperando aprobación</option>
                   <option value="3">Aprobado</option>
                   <option value="4">Liquidado</option>
        </select>
     </td>
   </tr>
 </table>

    
    <div id="ver_historial"></div>

  <script type="text/javascript">

      $(document).ready(function() {
        $('#data_table').DataTable({
        "language": {
            "emptyTable":     "No hay registros",
            "info":           "Mostrando _START_ al _END_ de _TOTAL_ registros.",
            "infoEmpty":      "Motrando 0 al 0 de 0 registros.",
            "infoFiltered":   "(Filtrados de _MAX_ registros en total.)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrar _MENU_ entradas",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron registros.",
            "paginate": {
                "first":      "Inicio",
                "last":       "Final",
                "next":       "Prox.",
                "previous":   "Ant."
            },
            "aria": {
                "sortAscending":  ": Ordenar  de manera ascendente",
                "sortDescending": ": Ordenar  de manera decresiente"
            }
        }
    });
      } );

      
      function ver_deudas(v,id){

            f=document.getElementById('fondo');
            h=document.getElementById('ver_historial');
            e=document.getElementById('esta');

          


              if(v == 0){
                  
                  h.innerHTML='';
              }else{
                v=f.value;
               // alert(v+' * '+e.value);
                $("#ver_historial").load('load_historial.php?cod='+v+'&esta='+e.value+'&id='+id);  
              }

      }

      


  </script>



    </div>

       

  </div>
</div>
    
</div>

