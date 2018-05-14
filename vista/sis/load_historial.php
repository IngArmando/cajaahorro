<table class="table table-bordered" id="data_table">

	<thead>
        <tr style="background: #EEE; font-size: 14px; font-weight: bold;">
          <th width="5%">Nº</th>
          <th>Fecha</th>
          <th>Monto</th>
          <th>Cuotas</th>
          <th width="5%">Amortizacion</th>
        </tr>
     </thead>

     <tbody>
     	 <?php
          @include_once('../../modelo/MPgsql.php');
          $db=new CModeloDatos;


         
             //$sql="SELECT * from cappiutep.t_beneficio_solicitud as tb where id_beneficio='".$_GET['cod']."' and estatus='".$_GET['esta']."' order by fecha DESC";

             $sql="SELECT * from cappiutep.t_beneficio_solicitud as tb where id_solicitante='".$_GET['id']."' and  id_beneficio='".$_GET['cod']."' and estatus='".$_GET['esta']."' order by fecha DESC";
          
          $as=$db->ejecutar($sql);

          while ($row=$db->getArreglo($as)) {
            # code...
            $o++;
            echo '<script> t++; </script>';

            if($row['estatus'] == 1){ $estatus='En Analisis'; }
            if($row['estatus'] == 2){ $estatus='Esperando Aprobacion'; }
            if($row['estatus'] == 3){ $estatus='Aprobado'; }
            if($row['estatus'] == 4){ $estatus='Liquidado';}
            if($row['estatus'] == 5){ $estatus='Saldado Prestamo';}

            echo '
              <tr>
              	
                  <td width="">'.$o.' </td>
                  <td width="">'.date('d-m-Y',strtotime($row['fecha'])).' </td>
                  <td width="">'.$row['monto'].'</td>
                  <td width="">'.$row['cuotas'].' </td>
                  <!--td width="">'.$estatus.' </td!-->
                  <td><button class="btn btn-success" name="" title="Tabla Amortizacion" onclick="abrir_ventana('.$row['id_beneficio_solicitud'].')" value=""><span class="glyphicon glyphicon-list-alt"></span></button></td>
                
                
              </tr>
            ';
          }
     ?>
     </tbody> 
</table>

<script type="text/javascript">
	 function abrir_ventana(d){
	 	window.open("muestra_historial.php?id="+d, "miVentana", "width=1024, height=500, top=85, left=100", true);

	 }
</script>
