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
  <title>Listado Personal</title> 
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
  <div class="panel-heading">AJUSTE DE PRESTAMOS</div>
  <div class="panel-body">
        
    <!--table class="table table-bordered">

        <tr>
          <th width="20%">Año</th>
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
            
             

             <td><?php $tagcbotp=$combo->gen_combo2("SELECT * from cappiutep.t_tipo_persona","id_tipo_persona","nombre", isset($_GET[''])?$_GET['']:'','txtUsuario',' class="ui search dropdown selection" onchange="ver_bienes(this.value)"');
                  foreach ($tagcbotp as $tagtp){echo $tagtp;}
            ?>   
            </td>
        </tr>
    </table!-->

    <div class="" id="muestra_tabla">

      <table class="table table-bordered">
        <tr style="background: #EEE;"><th><center>LISTADO DE DEUDORES </center></th></tr>
      </table>
      
      <script type="text/javascript">
   var t=0;
 </script>
 <table class="table table-bordered" id="data_table">
  <thead>
            <tr style="background: #EEE;">
              <td width="5%">N-º</td>
              <td width="10%">Dni</td>
              <td width="20%">Nombres</td>
              <td width="20%">Apellidos</td>
              <td width="10%"></td>

            </tr>
   </thead>
  <tbody>
    
    
     <?php
          @include_once('../../modelo/MPgsql.php');
          $db=new CModeloDatos;

          $sql5="select * from cappiutep.t_beneficio_solicitud where id_beneficio='".$_GET['cod']."' ";

           

          /*INNER JOIN cappiutep.t_detalle_amortizacion AS amt ON amt.id_beneficio_solicitud=b.id_beneficio_solicitud
          WHERE b.id_beneficio=".$conectado." AND amt.anho='".date(Y)."' and amt.mes='".number_format(date(m))."'";
         

           /*$sql="SELECT *
          FROM cappiutep.t_beneficio_solicitud AS b
          INNER JOIN cappiutep.t_persona_caja AS tpc ON tpc.id_persona=b.id_solicitante
          INNER JOIN cappiutep.t_persona AS tp ON tp.id_persona=tpc.id_persona
          INNER JOIN cappiutep.t_detalle_amortizacion AS amt ON amt.id_beneficio_solicitud=b.id_beneficio_solicitud
          WHERE b.id_beneficio=".$_GET['cod']." and amt.anho='".$_GET['ano']."' and amt.mes='".$_GET['me']."'";
          */
          
           //  $sql="SELECT * from cappiutep.t_persona order by apellido1 asc";

          
          $as=$db->ejecutar($sql);

          while ($row=$db->getArreglo($as)) {
            # code...
            $o++;
            echo '<script> t++; </script>';

            echo '
              <tr>
                
                  <td width="5%">'.$o.' </td>
                  <td width="10%">'.$row['cedula'].'</td>
                  <td width="20%">'.$row['nombre1'].' '.$row['nombre2'].'</td>
                  <td width="20%">'.$row['apellido1'].' '.$row['apellido2'].'</td>
                 
                  <td width="5%"><form method="post" action="vista_prestamo.php"> 

                      <input type="hidden" name="dni" value="'.$row['id_persona'].'">
                      <input type="hidden" name="ano" value="'.$_GET['ano'].'">
                      <input type="hidden" name="mes" value="'.$_GET['me'].'">
                      <button class="btn btn-success" type="submit" name="" value=""><span class="glyphicon glyphicon-search"></span></button></form></td>
                
                
              </tr>
            ';
          }
     ?>
    
 </tbody>


  <script type="text/javascript">
      function sumame(d,p,mt){
        div=document.getElementById('dif_'+p);
        cap=document.getElementById('cpt_'+p);
        dsc=document.getElementById('dsc_'+p);



        op=parseFloat(cap.value) - parseFloat(d);

        if(d == ''){
          div.innerHTML=''+cap.value;
        }else{
            if(parseFloat(d) > parseFloat(cap.value)){
              alert('Monto Mayor');
              div.innerHTML=''+cap.value;
              dsc.value='';
            }else{ 

              $("#dsc_"+p).load('registra_descuento.php?mt='+mt+'&datoi='+d);
              div.innerHTML=''+op; 


        }
          
        }

        
      }

       function pon_general(p) {
        // body...
       
         for(y=1; y<=t; y++){

          div=document.getElementById('dif_'+y);
          cap=document.getElementById('cpt_'+y);
          dsc=document.getElementById('dsc_'+y);

         

          if(p == ''){
            dsc.value=cap.value;
            div.innerHTML='0';
          }else{
                dsc.value=p;
                op=parseFloat(cap.value) - parseFloat(p);

                div.innerHTML=''+op;
          }

         }

      }

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

      

  </script>


    </div>

       

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

    $("#muestra_tabla").load('load_deudores.php?cod='+a+'&me='+me+'&ano='+anos);
  }
</script>