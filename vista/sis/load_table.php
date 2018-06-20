<script type="text/javascript">
   var t=0;
 </script>

 <center> <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-print"></span> Imprimir</button> </center>

 <input type="hidden" name="ano" value="<?php echo $_GET['ano'];?> ">
 <input type="hidden" name="mes" value="<?php echo $_GET['me']; ?>">


 <table class="table table-bordered" id="data_table">
  <thead>
            <tr style="background: #EEE;">
              <td width="8%">N-º</td>
              <td width="10%">Dni</td>
              <td width="25%">Nombres</td>
              <td width="25%">Apellidos</td>
              <td width="10%">
                 
              </td>

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

            if($_GET['fo'] == 1){ $d="AND fcesantia='1' "; $dt="where fcesantia='1' "; }else{ $d="AND fcomun='1' "; $dt="where fcomun='1' "; }

          if($_GET['cod'] =='T'){
             $sql="SELECT * from cappiutep.t_persona ".$dt." order by apellido1 asc";
          }else{
             $sql="SELECT * from cappiutep.t_persona where id_tipo_persona='".$_GET['cod']."' ".$d." order by apellido1 asc";
          }



          $as=$db->ejecutar($sql);

          while ($row=$db->getArreglo($as)) {
            # code...
            $o++;
            echo '<script> t++; </script>';

            echo '
              <tr>
              	
                  <td width="8%">'.$o.' </td>
                  <td width="10%">'.$row['cedula'].'</td>
                  <td width="35%">'.$row['nombre1'].' '.$row['nombre2'].'</td>
                  <td width="35%">'.$row['apellido1'].' '.$row['apellido2'].'</td>
                  <input type="hidden" name="ano" value="'.$_GET['ano'].'">
                  <input type="hidden" name="mes" value="'.$_GET['me'].'">

                  <td width="5%">


                      <input type="hidden" name="dn[]" value="'.$row['id_persona'].'">
                      <input type="hidden" name="cedula[]" value="'.$row['cedula'].'">
                      <input type="hidden" name="nombres[]" value="'.$row['nombre1'].' '.$row['nombre2'].'">
                      <input type="hidden" name="apellidos[]" value="'.$row['apellido1'].' '.$row['apellido2'].'">

                  <form method="post" action="descuento_gene.php"> 

                      <input type="hidden" name="dni" value="'.$row['id_persona'].'">
                      <input type="hidden" name="ano" value="'.$_GET['ano'].'">
                      <input type="hidden" name="mes" value="'.$_GET['me'].'">
                      <button class="btn btn-success" type="submit" name="" value=""><span class="glyphicon glyphicon-search"></span></button>
                  </form></td>
                
                
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