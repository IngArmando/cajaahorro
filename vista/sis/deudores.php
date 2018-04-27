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

             
    if($Soc['fcomun'] == 1){ $conectado =2;  
        
          $sql="SELECT * from cappiutep.t_persona as tp 
                inner join cappiutep.t_beneficio_solicitud as tbs on tbs.id_solicitante=tp.id_persona
              where tp.fcomun='1' AND tbs.estatus='4' order by tp.apellido1 asc
          "; 
      
      }


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
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/DataTablesConfig.js"></script> <!--Configura Interfaz -->
  <script src="../../js/JsRoles.js"></script> <!--Validaciones --> 
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
 <table class="table table-bordered" id="data_tables" style="font-size: 13px;">
  <thead>
            <tr style="background: #EEE;">
              <td width="5%">N-º</td>
              <td width="10%">Dni</td>
              <td width="20%">Nombres</td>
              <td width="20%">Apellidos</td>
              <td width="10%">Descuento</td>
              <td width="10%">Descontado</td>
              <td width="10%">Diferencia</td>
              <td width="10%">Credito</td>
              <td width="15%">Cuotas</td>
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

              $dbdt=new CModeloDatos;
              $dba=new CModeloDatos;

              if(date(m) == '01'){ $mes=1;}
              if(date(m) == '02'){ $mes=2;}
              if(date(m) == '03'){ $mes=3;}
              if(date(m) == '04'){ $mes=4;}
              if(date(m) == '05'){ $mes=5;}
              if(date(m) == '06'){ $mes=6;}
              if(date(m) == '07'){ $mes=7;}
              if(date(m) == '08'){ $mes=8;}
              if(date(m) == '09'){ $mes=9;}
              if(date(m) == '10'){ $mes=10;}
              if(date(m) == '11'){ $mes=12;}
              if(date(m) == '12'){ $mes=12;}


              $sqldt=" select * from cappiutep.t_detalle_amortizacion where id_beneficio_solicitud='".$row['id_beneficio_solicitud']."' AND anho='".date(Y)."' AND mes='".$mes."' ";
             $asd=$dbdt->ejecutar($sqldt);
              while ($rowdt=$dbdt->getArreglo($asd)) {
                # code...
                $td.='Cuota -> '.$rowdt['pago'].' <br>';

                  $deuda2= $rowdt['descontado'] + $rowdt['deposito'];
                  $deuda=$rowdt['pago'] - $deuda2;
                  $montoc=$rowdt['pago'];


              }





               $sqla="select * from cappiutep.aporte where id_persona='".$row['id_persona']."' AND ano='".date(Y)."' AND mes='".$mes."' ";

              $asa=$dba->ejecutar($sqla);
              while ($rowa=$dba->getArreglo($asa)) {
                # code...
                $aporte=$rowa['aporte'];
                $aportado=$rowa['aportado'] + $rowa['deposito'];
              }

                $suma=$montoc + $aporte;
                $resta= $deuda2 + $aportado;
                $dif=$suma - $resta; 

                $desc=$deuda2 + $aportado;

              if($suma == $desc){}else{


                $sqldt2=" select * from cappiutep.t_detalle_amortizacion where id_beneficio_solicitud='".$row['id_beneficio_solicitud']."' AND anho='".date(Y)."' AND mes>='".$mes."' ";
             $asd2=$dbdt->ejecutar($sqldt2);
              while ($rowdt2=$dbdt->getArreglo($asd2)) {
                # code...
                $td2++;
                $pago+=$rowdt2['pago'];


              }
              $pago= $pago + $dif;

              $k++;

            echo '<script> t++; </script>';

            echo '
              <tr>
                
                  <td width="5%">'.$o.'</td>
                  <td width="10%">'.$row['cedula'].'</td>
                  <td width="20%">'.$row['nombre1'].' '.$row['nombre2'].'</td>
                  <td width="20%">'.$row['apellido1'].' '.$row['apellido2'].'
                      <!--table class="ui table" >
                    <thead>
                        <tr>
                            <th height="10">Nro</th>
                            <th height="20">Mes</th>
                            <th height="40">Año</th>
                            <th height="40">Capital</th>
                            <th height="40">Interés</th>
                            <th height="40">Cuota</th>
                            <th height="40">Saldo</th>
                        </tr>
                    </thead>
                    <tbody id="tablaAmortizacion'.$k.'">

                    </tbody>
                </table--!>
                  </td>
                  <td width="10%">'.$suma.'</td>
                  <td width="10%">'.$resta.'</td>
                  <td width="10%">'.$dif.'</td>
                  <td width="10%">'.$pago.'

                      <input type="hidden" name="Monto" id="Monto'.$k.'" style="background:#EEE;" readonly onkeypress="return soloNumeros(event)" maxlength="10" value="'.$pago.'">
                       <input type="hidden" name="Interes" id="Interes'.$k.'" value="3" readonly>

                  </td>
                  <td width="15%"> <select class="form-control" name="Plazo" id="Plazo'.$k.'" onchange="ncalcularAmortizacion('.$k.',this.value)">'; 

                  for($y=$td2; $y<=48; $y++){

                    echo '<option value="'.$y.'">'.$y.'</option>';
                  }

                  echo' </select></td>
                 
                  <td width="5%"><form method="post" action="vista_prestamo.php"> 

                      <input type="hidden" name="dni" value="'.$row['id_persona'].'">
                      <input type="hidden" name="ano" value="'.$_GET['ano'].'">
                      <input type="hidden" name="mes" value="'.$_GET['me'].'">
                      <input type="checkbox" name="" value="">

                     </td>
                
                
              </tr>
            ';
                 $td=''; $deuda2=0; $deuda=0; $montoc=0; $aporte=0; $aportado=0; $suma=0; $resta=0; $dif=0; $desc=0; $td2=0; $pago=0;
            }
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

function colocarMontoTotalNomina(){
        Monto=$("#Monto").val();
        MontoEspecial=$("#MontoEspecial").val();
        total = Monto - MontoEspecial;
        MontoSolicitarReal=$("#MontoSolicitarReal").val(total);

    }
   
    function calcularAmortizacion(ps,gi){

    
        limpiarTablaAmortizacion2(ps);
        auxHoy = new Date();
        hoy = new Date();
        //alert(hoy.getMonth());
        mes = hoy.getMonth() + 1;
        dia = hoy.getDate();
        anho = hoy.getFullYear();
        hoy = hoy.getDate()+"/"+(hoy.getMonth() + 1)+"/"+hoy.getFullYear();
        prestamo = document.getElementById("Monto"+ps).value;
        //prestamo = 0;
        prestamoActual = 0;
        //cuotas = document.getElementById("Plazo"+ps).value;
        cuotas = gi;
       // cantGiros = cuotas / 12 * 2;
        cantGiros = gi;
         //interes = document.getElementById("Interes"+ps).value;
        interes = 3;
        diasAnho = 360;
        cuota = prestamo / cantGiros;
        if(mes>=7){
            entro = 1;
            primermes = 12;
            segundomes = 7;
            diferencia = primermes - segundomes;
            primerafecha = dia+"/12/"+anho;
        }else{
            entro = 2;
            primermes = 7;
            segundomes = 12;
            primerafecha = dia+"/7/"+anho;
        }
        fecha = primerafecha;
        tbody = document.getElementById('tablaAmortizacion'+ps);

        for(it = 1;it<=cantGiros;it++){
            row = it-1;
            auxPrestamo = prestamo;
            deuda = prestamo - cuota;
            prestamo = deuda;
            tr=tbody.insertRow(row);
            td0 = tr.insertCell(0);
            td1 = tr.insertCell(1);
            td2 = tr.insertCell(2);
            td3 = tr.insertCell(3);
            td4 = tr.insertCell(4);
            td5 = tr.insertCell(5);

            td0.innerHTML = it;
            if(it==1){
                td1.innerHTML=fecha;
                dias_pasados = calcularDiasRestantes(hoy,fecha);
                giro = (auxPrestamo * interes / diasAnho * dias_pasados) / 100;
            }
            fecha2 = fecha.split("/");
            fecha2 = fecha2[2]+"/"+fecha2[1]+"/"+fecha2[0];
            if(it>1 && it%2==0){
                if(entro==2){
                    auxFecha =  new Date(fecha2);
                    auxFecha.setMonth(auxFecha.getMonth() + 5);
                    auxFecha = auxFecha.getDate()+"/"+(auxFecha.getMonth()+1)+"/"+auxFecha.getFullYear();
                }
                else if(entro==1){
                    auxFecha =  new Date(fecha2);
                    auxFecha.setMonth(auxFecha.getMonth() + 7);
                    auxFecha = auxFecha.getDate()+"/"+(auxFecha.getMonth()+1)+"/"+auxFecha.getFullYear();
                }

                dias_pasados = calcularDiasRestantes(fecha,auxFecha);
                giro = (auxPrestamo * interes / diasAnho * dias_pasados) / 100;

                fecha = auxFecha;
                td1.innerHTML=auxFecha;
            }else if(it>1 && it%2==1){
                if(entro==2){
                    auxFecha =  new Date(fecha2);
                    auxFecha.setMonth(auxFecha.getMonth() + 7);
                    auxFecha = auxFecha.getDate()+"/"+(auxFecha.getMonth()+1)+"/"+auxFecha.getFullYear();
                }
                else if(entro==1){
                    auxFecha =  new Date(fecha2);
                    auxFecha.setMonth(auxFecha.getMonth() + 5);
                    auxFecha = auxFecha.getDate()+"/"+(auxFecha.getMonth()+1)+"/"+auxFecha.getFullYear();
                }

                dias_pasados = calcularDiasRestantes(fecha,auxFecha);
                giro = (auxPrestamo * interes / diasAnho * dias_pasados) / 100;

                fecha = auxFecha;
                td1.innerHTML=auxFecha;
            }         
                

            //td2.innerHTML=cuota.toFixed(2);
            td2.innerHTML=cuota.toFixed(2);
            td3.innerHTML=giro.toFixed(2);
            td4.innerHTML=(parseFloat(cuota)+parseFloat(giro)).toFixed(2);
            td5.innerHTML=deuda.toFixed(2);
        } 
    }

  /*    for(u=1; u<=t; u++){
        //        calcularAmortizacion(u);
        cu=document.getElementById("Plazo"+u);
        calcularAmortizacion(u,cu.value);

      }*/


</script>