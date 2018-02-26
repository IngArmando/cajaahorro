<script type="text/javascript">
   var t=0;
 </script>
 <table class="table table-bordered" id="data_table">
  <thead>
            <tr style="background: #EEE;">
              <td width="8%">N-º</td>
              <td width="10%">Dni</td>
              <td width="25%">Nombres</td>
              <td width="25%">Apellidos</td>
              <td width="15%">Sueldo Base</td>
              <td width="20%">Porcentaje %</td>
              <td width="10%">Total Aporte</td>

            </tr>
   </thead>
  <tbody>
  	
 	  
     <?php
          @include_once('../../modelo/MPgsql.php');
          $db=new CModeloDatos;
          $dbf=new CModeloDatos;

          $sql5="select * from cappiutep.t_beneficio_solicitud where id_beneficio='".$_GET['cod']."' ";
          $sqlf="select id_beneficio,sueldo_base,valorp  from cappiutep.t_beneficio where id_beneficio='".$_GET['cod']."' ";

          $sqlfj="SELECT *
          FROM cappiutep.t_beneficio AS b
          INNER JOIN cappiutep.t_persona AS tp ON tp.id_persona=tpc.id_persona
          WHERE b.id_beneficio=".$_GET['cod']." and ";

          $df=$dbf->ejecutar($sqlf); $rowf=$dbf->getArreglo($df);

          /*$sql="SELECT *
          FROM cappiutep.t_beneficio_solicitud AS b
          INNER JOIN cappiutep.t_persona_caja AS tpc ON tpc.id_persona=b.id_solicitante
          INNER JOIN cappiutep.t_persona AS tp ON tp.id_persona=tpc.id_persona
          INNER JOIN cappiutep.t_detalle_amortizacion AS amt ON amt.id_beneficio_solicitud=b.id_beneficio_solicitud
          WHERE b.id_beneficio=".$_GET['cod']." and amt.anho='".$_GET['ano']."' and amt.mes='".$_GET['me']."'";
          */
          

            
          if($_GET['cod'] =='T'){
             $sql="SELECT * from cappiutep.t_persona where id_tipo_persona='2' and fcesantia='1' or fcomun='1' order by apellido1 asc";
          }elseif($_GET['cod'] == 1){
             $sql="SELECT * from cappiutep.t_persona where id_tipo_persona='2' and fcesantia='1' order by apellido1 asc";

          }else{
             $sql="SELECT * from cappiutep.t_persona where id_tipo_persona='2' AND fcomun='1' order by apellido1 asc";
          }


          $as=$db->ejecutar($sql);



          while ($row=$db->getArreglo($as)) {
            # code...
            $o++;


           /*  if($_GET['cod'] == 2){

              $valorp=$rowf['valorp'];
             // $u=($rowf['sueldo_base'] * $valorp) / 100;
            }else{

              if($row['aporte'] == ''){
                $valorp=$rowf['valorp'];

              }else{
                $valorp=$row['aporte'];

              }


                            //$u=$rowf['sueldo_base'] - $row['aporte'];

            }
            */
            $valorp=$rowf['valorp'];

            $u=($rowf['sueldo_base'] * $valorp) / 100;



            echo '<script> t++; </script>';

             $sqlap="select * from cappiutep.aporte where mes='".date(m)."' AND ano='".date(Y)."' AND id_persona='".$row['id_persona']."' ";
            $dbap= new CModeloDatos;
            $dfap=$dbap->ejecutar($sqlap);
              
            if($rowap=$dbap->getArreglo($dfap)){
              $reap="readonly";
              $pon++;

            }else{
              $reap='';
            }

              

            echo '
              <tr>
              	
                  <td width="8%">'.$o.' </td>
                  <td width="10%">'.$row['cedula'].' <input type="hidden" name="cedula['.$o.']" value="'.$row['id_persona'].'"></td>
                  <td width="25%">'.$row['nombre1'].' '.$row['nombre2'].'</td>
                  <td width="25%">'.$row['apellido1'].' '.$row['apellido2'].'</td>
                  <td width="20%"><input type="text" id="sb" name="sb['.$o.']" readonly class="form-control" value="'.$rowf['sueldo_base'].'"></td>
                  <td width="20%">
                     <!--input type="text" name="" style="width:60%;" class="form-control" '; if($_GET['cod']== 2){ echo 'readonly value="1"'; }else{ echo 'value="'.$valorp.'"';}; echo '--!>

                     <input type="text" name="porce['.$o.']" style="width:60%;" id="ct_'.$o.'" '.$reap.' class="form-control" value="'.$valorp.'" onkeyup="operaciones(this.value,'.$o.','.$rowf['sueldo_base'].')">
                      
                  </td>
                  <td> '; 

                  

                   echo'<input value="'.number_format($u,2).'" id="tc_'.$o.'" name="aporte['.$o.']" readonly class="form-control" ></td>
                
                
              </tr>
            ';
          }

          if($pon >0){
            $ui='disabled';
          }else{
            $ui='';
          }
     ?>

     
    
 </tbody>

 <tfoot>
   <tr> <td colspan="7" >
      <center> <button class="btn btn-success" type="submit" <?php echo $ui; ?> name="evento" value="guardar">Guardar</button></center>
   </td></tr>
 </tfoot>


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
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron registros."
        },
        "paging":   false,
        "ordering": false,
        "info":     false
        
    });
      } );

        function operaciones(v,p,sb){

        	tc=document.getElementById('tc_'+p);
        	if(v == ''){ v=0; }else{ v=v; }

         // alert(p+' - '+v);
         op=(parseFloat(sb) * parseFloat(v))  / 100;
          tc.value=op;
        }

      

  </script>