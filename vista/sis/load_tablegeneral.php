 <script type="text/javascript">
   var t=0;
 </script>

 <form method="post" action="reportes/descuento/listado_casas_rep.php" target="_blanck"> 

  <input type="hidden" name="ano" value="<?php echo $_GET['ano']; ?>">
  <input type="hidden" name="mes" value="<?php echo $_GET['me']; ?>">
  <input type="hidden" name="casa" value="<?php echo $_GET['cod']; ?>">

 <table class="table table-bordered" id="data_tableh">
  <thead>
            <tr style="background: #EEE; font-weight: bold;">
              <td width="8%">N-º</td>
              <td width="15%">Dni</td>
              <td width="30%">Apellidos y Nombres</td>
              <td width="17%">Descuento   </td>
              <td width="15%">Descontado   </td>
              <td width="15%">Diferencia  </td>
              
            </tr>
   </thead>
   <!--/table>


   <table class="table table-bordered" id="data_tableh" !-->
     <?php
          @include_once('../../modelo/MPgsql.php');
          $db=new CModeloDatos;

          $sql5="select * from cappiutep.t_beneficio_solicitud where id_beneficio='".$_GET['cod']."' ";

          if($_GET['tipo'] =='T'){
              $sql="
            SELECT * from cappiutep.t_persona as tp, cappiutep.t_compra as tc 
            where tp.id_persona=tc.id_persona AND tc.ano='".$_GET['ano']."' AND tc.mes='".$_GET['me']."' AND tc.id_casa_comercial='".$_GET['cod']."' order by tp.apellido1 ";

          }else{
             $sql="
            SELECT * from cappiutep.t_persona as tp, cappiutep.t_compra as tc 
            where tp.id_tipo_persona='".$_GET['tipo']."'  
            AND tc.id_persona=tp.id_persona AND tc.ano='".$_GET['ano']."' AND tc.mes='".$_GET['me']."' AND tc.id_casa_comercial='".$_GET['cod']."'  order by tp.apellido1";

            /* echo $sql="SELECT *
                FROM cappiutep.t_persona AS b
                INNER JOIN cappiutep.t_compra AS tc ON tc.id_compra=b.id_persona
                INNER JOIN cappiutep.t_casa_comercial AS tca ON tca.id_casa_comercial=tc.id_casa_comercial
                WHERE tc.ano='".$_GET['ano']."' and tc.mes='".$_GET['me']."' "; */
          }

          
          

        // echo  $sql="SELECT cedula,nombre1,nombre2,apellido1,apellido2,id_tipo_persona FROM cappiutep.t_persona  where id_tipo_persona=$_GET['tipo']";


          $as=$db->ejecutar($sql);

          while ($row=$db->getArreglo($as)) {
            # code...
            $o++;
            if($row['descontado'] == ''){
              $descontado=number_format(0,2);
            }else{

              $descontado=number_format($row['descontado'],2);
            }

            $dif= $row['monto'] - $row['descontado'];



             if($row['descontado'] == 0){}else{


                echo '<script> t++; </script>';
            echo '
              <tr>
                <td width="8%">'.$o.'</td>
                <td width="15%">'.$row['cedula'].'<input type="hidden" name="cedula['.$o.']" value="'.$row['cedula'].'"></td>
                <td width="30%"><input type="hidden" name="datoss['.$o.']" value="'.$row['apellido1'].' '.$row['apellido2'].' '.$row['nombre1'].' '.$row['nombre2'].'"> '.$row['apellido1'].' '.$row['apellido2'].' '.$row['nombre1'].' '.$row['nombre2'].'</td> 
                <td width="17%"><input type="hidden" name="monto['.$o.']" value="'.$row['monto'].'">'.$row['monto'].'</td>
                <td width="15%"><input type="hidden" name="descontado['.$o.']" value="'.$descontado.'">'.$descontado.'</td>
                <td width="15%"><input type="hidden" name="dif['.$o.']" value="'.$dif.'">'.number_format($dif,2).'</td>
               
              </tr>
            ';
          }
          }
     ?>

     <tr> 

    <td colspan="3" align="right" style="border:0;">
            <?php
              if($tr >0){  $bf='block'; }else{ $bf='none'; }
            ?>

            <a href="genera_csvcasa.php?cod=<?php echo $_GET['cod']?>&ano=<?php echo $_GET['ano']?>&me=<?php echo $_GET['me']?>&tipo=<?php echo $_GET['tipo']?>" target="_blanck" id="imprime" class="btn btn-default" style="display:<?php echo $bf;?>; width: 10%; "><span class="glyphicon glyphicon-print"></span></a>

      

    </td>

    <td colspan="4" style="border:0;">
       <button class="btn btn-success" type="submit" name="" value="" id="botonera" onclick="" ><span class="glyphicon glyphicon-print"></span></button>
    </td>

   </tr>        
   </tbody>         
  </table>
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

          dsc=document.getElementById('dsc_'+y);

          dsc.value=p;
         

         }

      }

      $(document).ready(function() {
        $('#data_table').DataTable();
      } );

      function guardart() {
        // body...

        btn=document.getElementById("botonera");

        btn.style.display="none";

      }
  </script>