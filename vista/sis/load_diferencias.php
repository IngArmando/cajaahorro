<script type="text/javascript">
   var t=0;
 </script>
 <form method="post" action="reportes/descuento/listado_diferencia_rep.php" target="_blanck"> 
 <table class="table table-bordered" id="data_tableh">
  <thead>
            <tr style="background: #EEE;">
              <th width="8%">N-º</th>
              <th width="10%">Dni</th>
              <th width="42%"> Apellidos y Nombres</th>
              <th width="15%">Total Descto</th>
              <th width="15%">Descontado</th>
              <th width="15%">Diferencia</th>

            </tr>
   </thead>
  <tbody>
  	
 	  
     <?php
          @include_once('../../modelo/MPgsql.php');
          $db=new CModeloDatos;

          $sql5="select * from cappiutep.t_beneficio_solicitud where id_beneficio='".$_GET['cod']."' ";

          /*$sql="SELECT *
          FROM cappiutep.t_beneficio_solicitud AS b
          INNER JOIN cappiutep.t_persona_caja AS tpc ON tpc.id_persona=b.id_solicitante
          INNER JOIN cappiutep.t_persona AS tp ON tp.id_persona=tpc.id_persona
          INNER JOIN cappiutep.t_detalle_amortizacion AS amt ON amt.id_beneficio_solicitud=b.id_beneficio_solicitud
          WHERE b.id_beneficio=".$_GET['cod']." and amt.anho='".$_GET['ano']."' and amt.mes='".$_GET['me']."'";
          */
          if($_GET['cod'] =='T'){
             $sql="SELECT * from cappiutep.t_persona order by apellido1";
          }else{
             $sql="SELECT * from cappiutep.t_persona where id_tipo_persona='".$_GET['cod']."' order by apellido1";
          }

          $as=$db->ejecutar($sql);

          while ($row=$db->getArreglo($as)) {
            # code...

            $dbd=new CModeloDatos;

                $sqld="SELECT *
                FROM cappiutep.t_compra AS b
                INNER JOIN cappiutep.t_casa_comercial AS tp ON tp.id_casa_comercial=b.id_casa_comercial
                WHERE b.id_persona=".$row['id_persona']." and b.ano='".$_GET['ano']."' and b.mes='".$_GET['me']."' "; 
                $assd=$dbd->ejecutar($sqld);

                $cuota=0; $descuento=0; $dif=0;
                  while ($rowd=$dbd->getArreglo($assd)) {
                    # code...

                     $cuota+=$rowd['monto'];
                     $descuento+= $rowd['descontado'];
                     $dif+= $rowd['monto'] - $rowd['descontado'];

                   
                  }

                  $dbde=new CModeloDatos;

             $sqlde="SELECT *
              FROM cappiutep.t_beneficio_solicitud AS b
              INNER JOIN cappiutep.t_persona_caja AS tpc ON tpc.id_persona=b.id_solicitante
              INNER JOIN cappiutep.t_persona AS tp ON tp.id_persona=tpc.id_persona
              INNER JOIN cappiutep.t_detalle_amortizacion AS amt ON amt.id_beneficio_solicitud=b.id_beneficio_solicitud
              INNER JOIN cappiutep.t_beneficio AS tb ON tb.id_beneficio=b.id_beneficio
              WHERE b.id_solicitante=".$row['id_persona']." and amt.anho='".$_GET['ano']."' and amt.mes='".$_GET['me']."' "; 

                $assde=$dbde->ejecutar($sqlde);

                  while ($rowde=$dbde->getArreglo($assde)) {
                    # code...

                 $cuota+=$rowde['pago'];
                 $descuento+= $rowde['descontado'];
                 $dif+= $rowde['pago'] - $rowde['descontado'];

                   
                  }


            $o++;
            echo '<script> t++; </script>';

            if($descuento == 0){}else{

            echo '
              <tr>
              	
                  <td width="8%">'.$o.'</td>
                  <td width="10%">'.$row['cedula'].'<input type="hidden" name="cedula['.$o.']" value="'.$row['cedula'].'"></td>
                  <td width="42%">'.$row['apellido1'].' '.$row['apellido2'].' '.$row['nombre1'].' '.$row['nombre2'].' <input type="hidden" name="datoss['.$o.']" value="'.$row['apellido1'].' '.$row['apellido2'].' '.$row['nombre1'].' '.$row['nombre2'].'"></td>
                  <td width="15%">'.number_format($cuota,2).' <input type="hidden" name="descuento['.$o.']" value="'.number_format($descuento,2).'">
                  <input type="hidden" name="descontado['.$o.']" value="'.number_format($cuota,2).'">
                  </td>
                  <td width="15%">'.number_format($descuento,2).'</td>
                  <td width="15%">'.number_format($dif,2).'</td>
                
                
              </tr>
            ';
            $cuota_total+=$cuota;
            $descuento_total+=$descuento;
            $dif_total+=$dif;

          }


                      }

     ?>
    
 </tbody>

 <tfoot>
           <tr style="background: #EEE;">
                      <th width="60%" colspan="3">
                        
                        

                            <input type="hidden" name="tipo" value="<?php echo $_GET['cod'];?>">
                            <input type="hidden" name="ano" value="<?php echo $_GET['ano'];?>">
                            <input type="hidden" name="mes" value="<?php echo $_GET['me'];?>">
                            <center><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-print"></span></button></center>
                      
                      </th>

                      <th width="15%"><input type="" name="" class="form-control" style="width: 90%;" readonly="" value="<?php echo number_format($cuota_total,2); ?>"></th>
                      <th width="15%"><input type="" name="" class="form-control" readonly="" style="width: 90%;" value="<?php echo number_format($descuento_total,2); ?>"></th>
                      <th width="15%"><input type="" name="" class="form-control" readonly="" style="width: 88%;" value="<?php echo number_format($dif_total,2); ?>"></th>

            </tr>
 </tfoot>

   </form>

 </table>


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
        $('#data_table').DataTable();
      } );

  </script>