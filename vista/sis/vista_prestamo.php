<?php
session_start();
    require_once("../../controlador/CRoles.php");

    include_once("../../modelo/MCombo.php");
    $combo = new Combo();

    @include_once('../../modelo/MPgsql.php');
          $dbp=new CModeloDatos;

           $sql2="select * from cappiutep.t_persona where id_persona='".$_POST['dni']."' ";

          $ass=$dbp->ejecutar($sql2);  $rowp=$dbp->getArreglo($ass);
?>
<html lang="es">
<head>
  <title>Prestamos Realizados</title> 
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
  <div class="panel-heading">
      <table class="" style="width: 100%;">
        <tr>
          <td width="80%" style="color: white;">Prestamos Realizados</td>
          <td width="20%"> <button class="btn btn-default" onclick="enviarr()"><span class="glyphicon glyphicon-arrow-left"></span> Volver</button></td>
        </tr>
      </table>
        
  </div>
  <div class="panel-body">

      <table class="table table-bordered">
        <tr style="background: #EEE;">
          <th colspan="3"><center><?php echo $rowp['nombre1'].' '.$rowp['nombre2'].' '.$rowp['apellido1'].' '.$rowp['apellido2']; ?></center></th>
        </tr>
        


      </table>

     <table class="table table-bordered">
       <tr  style="background: #EEE;">
         <th style="width:5%; ">Nº</th>
         <th>Fecha</th>
         <th>Cuotas</th>
         <th>Monto</th>
         <th>Cuotas Atrasadas</th>
         <th>Deuda</th>
         
         <th style="width:5%;"></th>
       </tr>
       <?php
         $db=new CModeloDatos;
         $sql="SELECT *  FROM cappiutep.t_beneficio_solicitud where id_solicitante='".$_POST['dni']."' AND estatus='4' ";
         $as=$db->ejecutar($sql);

          while ($row=$db->getArreglo($as)) {
echo '<form method="post" action="extencion.php">';
            $t++;

         $db2=new CModeloDatos;

          $sqlc="SELECT * FROM cappiutep.t_detalle_amortizacion where id_beneficio_solicitud='".$row['id_beneficio_solicitud']."' AND anho <= '".date(Y)."' AND mes <= '".number_format(date(m))."' order by mes asc";
         $asa=$db2->ejecutar($sqlc);

         $m.='
                <table class="table table-bordered" style="font-size:12px;">
                  <tr style="background:#EEE;">
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Mensualidad</th>
                    <th>Descontado</th>
                  </tr>
                ';
          while ($rowc=$db2->getArreglo($asa)) {
            //if($rowc['mes'] <= date(m)){

            //$ma.=' '.$rowc['mes'].' | '.$rowc['capital'].' | '.$rowc['pago'].'* | '.$rowc['descontado'].'*<br>';
            if($rowc['descontado'] != $rowc['pago']){ 

              $restantes++;
               $m.='
              <tr>
              
                <td>'.$rowc['anho'].'</td>
                <td>'.meses($rowc['mes']).'</td>
                <td>'.$rowc['pago'].'</td>
                <td>'.number_format($rowc['descontado']).'</td>
              
              </tr>
              '; 

            }else{

            }
             //}else{

             //}

           



          }
          $m.='</table>';

            echo '
              <tr>
                <td>'.$t.'</td>
                <td>'.$row['fecha'].'</td>
                <td>'.$row['cuotas'].'</td>
                <td>'.$row['monto'].'</td>
                <td>'.$m.'</td>
                <td>'.$deuda.'</td>
                <td><button class="btn btn-success btn-sm" type="submit" name="" value=""><span class="glyphicon glyphicon-search"></span></button></td>
              </tr>
                </form>
              ';
          }


       ?>
     </table>

     
    
  </div>
</div>
    
</div>

<script type="text/javascript">
  function enviarr(){
    location.href="Listado_deudores.php";
  }
</script>

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

    $("#muestra_tabla").load('load_table.php?cod='+a+'&me='+me+'&ano='+anos);
  }

  function guarda_casa(d,n,m,c){
    var op=0;
    casa=document.getElementById('casa'+n);
    dif=document.getElementById('mdif'+n);
    if(d > m){
     alert('El Monto es mayor al valor de la cuota');
     casa.value=0;
    }else{
      op=parseFloat(m) - parseFloat(d);
      op = op.toFixed(2);
      dif.innerHTML=''+op;
      //casa.readOnly=true;
      casa.setAttribute('onclick','');
      $("#casa"+n).load('guarda_descuento.php?casas='+c+'&monto='+d);
    }
  }

  function guarda_beneficio(d,n,m,c){
    var op=0;
    bene=document.getElementById('bene'+n);
    dife=document.getElementById('mdifbe'+n);
    if(d > m){
     alert('El Monto es mayor al valor de la cuota');
     bene.value=0;
    }else{
      op=parseFloat(m) - parseFloat(d);
      dife.innerHTML=''+op;
      bene.readOnly=true;
      bene.setAttribute('onclick','');
      $("#bene"+n).load('guarda_beneficio.php?benefi='+c+'&montobe='+d);
    }
  }

  function guarda_aporte(d,n,m,c,id){
    var op=0;
    casa=document.getElementById('aporte'+n);
    dif=document.getElementById('mapp'+n);
    if(d > m){
     alert('El Monto es mayor al valor del Aporte');
     casa.value=0;
    }else{
      op=parseFloat(m) - parseFloat(d);
      op = op.toFixed(2);
      dif.innerHTML=''+op;
      
      casa.setAttribute('onclick','');
      $("#aporte"+n).load('guarda_aporte.php?casas='+c+'&monto='+d+'&id='+id);
      casa.readOnly=true;
    }
  }

  function limpia(n){

    casa=document.getElementById('casa'+n);
    casa.value='';
  }
</script>