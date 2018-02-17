 <script type="text/javascript">
   var t=0;
 </script>
 <form method="post" action="pagar_casa.php" target="_blanck">
 <table class="table table-bordered" id="data_tableh">
  <thead>
            <tr style="background: #EEE; font-weight: bold;">
              <td>N-º</td>
              <td>Dni</td>
              <td>Nombres</td>
              <td>Apellidos</td>
              <td>Monto</td>
              <td width="18%">Descuento  <input type="text" name="" id="general" onkeyup="pon_general(this.value)" style="width: 40%; float: right;" class="form-control" value=""> </td>
              <td>Diferencia</td>

            </tr>
   </thead>
   <tbody>
     <?php
          @include_once('../../modelo/MPgsql.php');
          $db=new CModeloDatos;

          $sql5="select * from cappiutep.t_beneficio_solicitud where id_beneficio='".$_GET['cod']."' ";

           $sql="SELECT *
          FROM cappiutep.t_compra AS b
          INNER JOIN cappiutep.t_persona AS tp ON tp.id_persona=b.id_persona
          WHERE b.id_casa_comercial=".$_GET['cod']." and b.ano='".$_GET['ano']."' and b.mes='".$_GET['me']."' AND tp.id_tipo_persona='".$_GET['tipo']."'";
          

        // echo  $sql="SELECT cedula,nombre1,nombre2,apellido1,apellido2,id_tipo_persona FROM cappiutep.t_persona  where id_tipo_persona=$_GET['tipo']";


          $as=$db->ejecutar($sql);

          $tr=0;

          while ($row=$db->getArreglo($as)) {
            # code...
              $bq= new CModeloDatos;




            $o++;
                echo '<script> t++; </script>';

                 if($row['descontado'] == '' || $row['descontado'] == 0){
              $pago=$row['monto'];

              $loco="";
            }else{
              $pago=$row['descontado'];
              $loco="readonly";

              $tr++;
            }


            $dife= $row['monto'] - $pago;
            echo '

              <tr>
                <td>'.$o.' '.$row['id_compra'].'<input type="hidden" name="compra['.$o.']" value="'.$row['id_compra'].'"></td>
                <td>'.$row['cedula'].'</td>
                <td>'.$row['nombre1'].' '.$row['nombre2'].'</td>
                <td>'.$row['apellido1'].' '.$row['apellido2'].'</td>
                <td>'.$row['monto'].' <input type="hidden" id="cpt_'.$o.'" value="'.$row['monto'].'"></td>
                <td><input type="text" '.$loco.' class="form-control" name="descontado['.$o.']" id="dsc_'.$o.'" value="'.$pago.'" onkeyup="sumame(this.value,'.$o.')" style="width:80%;"></td>
                <td><div id="dif_'.$o.'">'.$dife.'</div></td>
              </tr>
            ';
          }
     ?>
   </tbody>   
   <tr> 

    <td colspan="3" align="right" style="border:0;">
            <?php
              if($tr >0){  $bf='block'; }else{ $bf='none'; }
            ?>

            <a href="reportes/descuento/descuentocasas_rep.php?cod=<?php echo $_GET['cod']?>&ano=<?php echo $_GET['ano']?>&me=<?php echo $_GET['me']?>&tipo=<?php echo $_GET['tipo']?>" target="_blanck" id="imprime" class="btn btn-default" style="display:<?php echo $bf;?>; width: 10%; "><span class="glyphicon glyphicon-print"></span></a>

      

    </td>

    <td colspan="4" style="border:0;">
       <button class="btn btn-success" type="submit" name="" value="" id="botonera" onclick="return guardart();" ><span class="glyphicon glyphicon-floppy-disk"></span></button>
    </td>

   </tr>        
  </table>

  <input type="hidden" name="" id="canti" value="<?php echo $o;?>">
</form>
  <script type="text/javascript">
      function sumame(d,p){
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
            }else{ div.innerHTML=''+op; }
          
        }

        
      }

      function pon_general(p) {
        // body...
       
         for(y=1; y<=t; y++){

          div=document.getElementById('dif_'+y);
          cap=document.getElementById('cpt_'+y);
          dsc=document.getElementById('dsc_'+y);

          dsc.value=p;
          op=parseFloat(cap.value) - parseFloat(p);

          div.innerHTML=''+op;

         }

      }

      $(document).ready(function() {
        $('#data_table').DataTable();
      } );

      function guardart(){

          btnt=document.getElementById('botonera');
          imp=document.getElementById('imprime');

          if(!confirm("Seguro de Realizar la operacion")){

            return false;
          }else{
            btnt.style.display='none';
            imp.style.display='block';
          return true;

          }
          
      }
  </script>