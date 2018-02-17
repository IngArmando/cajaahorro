 <script type="text/javascript">
   var t=0;
 </script>

<form method="post" action="pagar_casag.php" target="_blanck">
  <input type="hidden" name="ano" value="<?php echo $_GET['ano']; ?>">
  <input type="hidden" name="mes" value="<?php echo $_GET['me']; ?>">
  <input type="hidden" name="casa" value="<?php echo $_GET['cod']; ?>">

 <table class="table table-bordered" id="data_tableh">
  <thead>
            <tr style="background: #EEE; font-weight: bold;">
              <td width="8%">N-º</td>
              <td width="15%">Dni</td>
              <td width="30%">Nombres</td>
              <td width="30%">Apellidos</td>
              <td width="18%">Descuento  <input type="text" name="" id="general" onkeyup="pon_general(this.value)" style="width: 40%; float: right;" class="form-control" value=""> </td>
              
            </tr>
   </thead>
   </table>


   <table class="table table-bordered" id="data_tableh">
     <?php
          @include_once('../../modelo/MPgsql.php');
          $db=new CModeloDatos;

          $sql5="select * from cappiutep.t_beneficio_solicitud where id_beneficio='".$_GET['cod']."' ";

          if($_GET['tipo'] =='T'){
            $sql="SELECT * from cappiutep.t_persona ";
          }else{
            $sql="SELECT * from cappiutep.t_persona where id_tipo_persona='".$_GET['tipo']."'";
          }

          
          

        // echo  $sql="SELECT cedula,nombre1,nombre2,apellido1,apellido2,id_tipo_persona FROM cappiutep.t_persona  where id_tipo_persona=$_GET['tipo']";


          $as=$db->ejecutar($sql);

          while ($row=$db->getArreglo($as)) {
            # code...
            $o++;
                echo '<script> t++; </script>';
           
            echo '
              <tr>
                <td width="8%">'.$o.'</td>
                <td width="15%">'.$row['cedula'].'<input type="hidden" name="cedula['.$o.']" value="'.$row['id_persona'].'"></td>
                <td width="30%">'.$row['nombre1'].' '.$row['nombre2'].'</td>
                <td width="30%">'.$row['apellido1'].' '.$row['apellido2'].'</td>
               
                <td width="18%"><input type="text" class="form-control" name="descontar['.$o.']" id="dsc_'.$o.'" value="" style="width:80%;"></td>
               
              </tr>
            ';
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
       <button class="btn btn-success" type="submit" name="" value="" id="botonera" onclick="return guardart();" ><span class="glyphicon glyphicon-floppy-disk"></span></button>
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