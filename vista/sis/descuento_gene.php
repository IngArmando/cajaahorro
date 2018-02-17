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
  <title>Descuento</title> 
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
          <td width="80%" style="color: white;">DESCUENTOS</td>
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

      <div id="muestra_tabla">
        
           <table class="table table-bordered">

            <tr style="background: #EEE;">
              <th>Descuento</th>
              <th width="15%">V.Descuento</th>
              <th width="15%">V.Descontado</th>
              <th width="15%">Diferencia</th>
            </tr>

            <?php

            $dbd1=new CModeloDatos;

             $sqla="SELECT *,ap.aporte as aporte_a 
            from cappiutep.aporte as ap
                   inner join cappiutep.t_persona as tpe on tpe.id_persona = ap.id_persona
                   where ap.id_persona=".$_POST['dni']." AND ap.ano='".$_POST['ano']."' AND ap.mes='".$_POST['mes']."' ";

                   $apo=$dbd1->ejecutar($sqla);

                   while ($rowap=$dbd1->getArreglo($apo)) {
                     # code...
                    $app++;
                    if($rowap['tipo'] == 2){ $tip="Fondo Comun"; }else{ $tip="Cesantia"; }

                    if($rowap['aportado'] == ''){
                      $descontado=0;
                      $lit='';
                    }else{
                      $descontado=$rowap['aportado'];
                      
                      $lit='readonly';
                    }

                      $dif=$rowap['aporte_a'] - $descontado;


                    echo '
                    <tr>
                        <td><b>Aporte Fondo: </b> : '.$tip.'</td>
                        <td>'.$rowap['aporte_a'].' </td>
                        <td><input type="text" class="form-control" '.$lit.' '.$gene.' id="aporte'.$app.'" onblur="guarda_aporte(this.value,'.$app.','.$rowap['aporte_a'].','.$rowap['cod_aporte'].','.$rowap['id_persona'].')" name="" value="'.number_format($descontado,2).'"></td>
                        <td id="mapp'.$app.'">'.number_format($dif,2).'</td>
                    </tr>';

                    $hg+=$rowap['aporte_a'];
                    $dc+=$dif;
                    $dco+=$descontado;
                   }


            $dbd=new CModeloDatos;

                $sqld="SELECT *
                FROM cappiutep.t_compra AS b
                INNER JOIN cappiutep.t_casa_comercial AS tp ON tp.id_casa_comercial=b.id_casa_comercial
                WHERE b.id_persona=".$_POST['dni']." and b.ano='".$_POST['ano']."' and b.mes='".$_POST['mes']."' "; 

                $assd=$dbd->ejecutar($sqld);

                  while ($rowd=$dbd->getArreglo($assd)) {
                    # code...

                     $casa++;

                    if($rowd['descontado'] == ''){

                      $descontado= 0;
                      $dif= $rowd['monto'] - $rowd['descontado']; 
                      $gene='onclick="limpia('.$casa.')"';
                      $listo='';
                    }else{
                      $descontado= $rowd['descontado'];
                      $dif= $rowd['monto'] - $rowd['descontado'];
                      $gene='';
                      if($rowd['descontado'] == $rowd['monto']){
                        $listo='readonly';
                      }else{
                          $listo='';
                      }
                      
                    }

                    echo '
                    <tr>
                        <td><b>Casa</b> : '.$rowd['descripcion'].' '.$rowd['id_compra'].'</td>
                        <td>'.$rowd['monto'].' </td>
                        <td><input type="text" class="form-control" '.$listo.' '.$gene.' id="casa'.$casa.'" onblur="guarda_casa(this.value,'.$casa.','.$rowd['monto'].','.$rowd['id_compra'].')" name="" value="'.number_format($descontado,2).'"></td>
                        <td id="mdif'.$casa.'">'.number_format($dif,2).'</td>
                    </tr>';
                    $hg+=$rowd['monto'];
                    $dc+=$dif;
                    $dco+=$descontado;



                  }
                  

                   $dbde=new CModeloDatos;

             $sqlde="SELECT *
          FROM cappiutep.t_beneficio_solicitud AS b
          INNER JOIN cappiutep.t_persona_caja AS tpc ON tpc.id_persona=b.id_solicitante
          INNER JOIN cappiutep.t_persona AS tp ON tp.id_persona=tpc.id_persona
          INNER JOIN cappiutep.t_detalle_amortizacion AS amt ON amt.id_beneficio_solicitud=b.id_beneficio_solicitud
          INNER JOIN cappiutep.t_beneficio AS tb ON tb.id_beneficio=b.id_beneficio
          WHERE b.id_solicitante=".$_POST['dni']." and amt.anho='".$_POST['ano']."' and amt.mes='".$_POST['mes']."' "; 

                $assde=$dbde->ejecutar($sqlde);

                  while ($rowde=$dbde->getArreglo($assde)) {
                    # code...

                     $bene++;

                    if($rowde['descontado'] == ''){

                      $descontadobe= 0;
                      $difbe= $rowde['pago'] - $rowde['descontado']; 
                      $genebe='onclick="limpia('.$bene.')"';
                      $listobe='';
                    }else{
                      $descontadobe= $rowde['descontado'];
                      $difbe= $rowde['pago'] - $rowde['descontado'];
                      $genebe='';

                      if($rowde['descontado'] == $rowd['pago']){
                        $listobe='readonly';
                      }else{
                          $listobe='';
                      }

                      

                    } 

                    echo '
                    <tr>
                        <td><b></b> : '.$rowde['nombre'].'</td>
                        <td>'.$rowde['pago'].' </td>
                        <td><input type="text" class="form-control" '.$listobe.' '.$genebe.' id="bene'.$bene.'" onblur="guarda_beneficio(this.value,'.$bene.','.$rowde['pago'].','.$rowde['id_detalle_amortizacion'].')" name="" value="'.number_format($descontadobe,2).'"></td>
                        <td id="mdifbe'.$bene.'">'.number_format($difbe,2).'</td>
                    </tr>';

                    $hg+=$rowde['pago'];
                    $dc+=$dif;
                    $dco+=$descontado;
                    


                  }
                  
                 

            ?>

            <tr>
              <td colspan="4"></td>
            </tr>

             <tr>
              <td colspan=""></td>
              <td colspan=""><input type="" name="" class="form-control" readonly="" value="<?php echo number_format($hg,2); ?>"></td>
              <td colspan=""><input type="" name="" class="form-control" readonly="" value="<?php echo number_format($dco,2); ?>"></td>
              <td colspan=""><input type="" name="" class="form-control" readonly="" value="<?php echo number_format($dc,2); ?>"></td>
            </tr>

            <tr>
              <td colspan="4" align="center">
                <form method="post" action="reportes/descuento/descuento_rep.php" target="_blanck">
                  <input type="hidden" name="mes" value="<?php echo $_POST['mes']; ?>">
                  <input type="hidden" name="ano" value="<?php echo $_POST['ano']; ?>">
                  <input type="hidden" name="dni" value="<?php echo $_POST['dni']; ?>">
                  <input type="hidden" name="cedula" value="<?php echo $rowp['cedula']; ?>">
                  <input type="hidden" name="persona" value="<?php echo $rowp['nombre1'].' '.$rowp['nombre2'].' '.$rowp['apellido1'].' '.$rowp['apellido2']; ?>">
                  <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-print"></span></button>
                </form>
              </td>
            </tr>
          </table>

      </div>

     
    
  </div>
</div>
    
</div>

<script type="text/javascript">
  function enviarr(){
    location.href="listado_descuento.php";
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