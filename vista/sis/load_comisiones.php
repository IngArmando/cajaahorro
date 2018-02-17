<script type="text/javascript">
   var t=0;
 </script>
 <table class="table table-bordered" id="data_table">
  <thead>
            <tr style="background: #EEE;">
              <td width="5%">N-º</td>
              <td width="40%"> Casa Comercial </td>
              <td width="20%"> Total </td>
              <td width="20%"> Comisión </td>
              <td width="15%"> V. Comisión </td>

            </tr>
   </thead>
  <tbody>
  	
 	  
     <?php
          @include_once('../../modelo/MPgsql.php');
          $db=new CModeloDatos;

          $ano = $_GET['ano'];
          $mes = $_GET['mes'];

          $sql = "SELECT DISTINCT ON(b.id_casa_comercial) b.id_casa_comercial, b.monto, a.descripcion AS casa_comercial, a.tipo_comision, a.comision 
                FROM cappiutep.t_compra AS b 
                INNER JOIN cappiutep.t_casa_comercial AS a ON a.id_casa_comercial = b.id_casa_comercial 
                WHERE b.ano = '$ano' AND b.mes = $mes";

          $datos = $db->ejecutar($sql);

          $monto_total = 0;
          while ( $row = $db->getArreglo( $datos ) ) 
          {
            $o++;

            echo '
              <tr>
              	
                  <td>'.$o.' </td>
                  <td>'.$row['casa_comercial'].'</td>';

              $sql_d = "SELECT monto
                FROM cappiutep.t_compra 
                WHERE ano = '$ano' AND mes = $mes AND id_casa_comercial = $row[id_casa_comercial]";
              $datos_d = $db->ejecutar($sql_d);
              $monto = 0;
              while ( $row_d = $db->getArreglo( $datos_d ) ) 
              {
                $monto += $row_d['monto'];
              }

              if ( $row['tipo_comision'] == '1' )
              {
                //$monto = ( $monto + $row['comision'] );
                echo '
                  <td> ' . number_format( $monto , 2 , ',' , '.' ) . ' </td>
                  <td> $' . number_format( $row['comision'] , 2 , ',' , '.' ) . ' </td>
                  <td> ' . number_format( $row['comision'] , 2 , ',' , '.' ) . ' </td>
                ';
              }
              else
              {
                $comision = ( $monto * $row['comision'] ) / 100;
                //$monto = ( $monto + $comision );
                echo '
                  <td> ' . number_format( $monto , 2 , ',' , '.' ) . ' </td>
                  <td> ' . number_format( $row['comision'] , 2 , ',' , '.' ) . '% </td>
                  <td> ' . number_format( $comision , 2 , ',' , '.' ) . ' </td>
                ';
              }

            echo '
              </tr>
            ';

            $monto_total += $monto;
          }
     ?>
    
  </tbody>
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