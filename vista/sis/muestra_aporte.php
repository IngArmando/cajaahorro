<?php
session_start();
	echo '#'.$_SESSION["personaje"];
?>
<br>

<table class="table table-bordered">
	<tr style="background: #eee;">
		<th>MOVIMIENTOS DEL FONDO <?php if($_GET['tipo'] == 1){ echo 'CESANTIA'; }else{ echo 'COMUN';}  ?></th>
	</tr>
</table>

<table class="table table-bordered" id="data_table">
  <thead>
            <tr style="background: #EEE;">
              <th width="8%">N-º</th>
              <th width="10%">Año</th>
              <th width="25%">Mes</th>
              <th width="25%">Aporte</th>
              <th width="15%">Aportado</th>

            </tr>
   </thead>
  <tbody>
  	<?php
  		@include_once('../../modelo/MPgsql.php');
  		$dbl=new CModeloDatos;
          

          		 $sqll="select * from cappiutep.aporte where id_persona='".$_SESSION["personaje"]."' AND tipo='".$_GET['tipo']."'  ";
          		
         		$asl=$dbl->ejecutar($sqll);
         	
         		while ($rowll=$dbl->getArreglo($asl)) {

         			$r++;
         			if($rowll['aportado'] == ''){ $apt=0; }else{ $apt=$rowll['aportado']; }

         			echo '
         				<tr>
         					<td>'.$r.'</td>
         					<td>'.$rowll['ano'].'</td>
         					<td>'.$rowll['mes'].'</td>
         					<td>'.$rowll['aporte'].'</td>
         					<td>'.$apt.'</td>
         				</tr>
         			';

         			$aportado+=$apt;
         		}
  	?>
  	</tbody>
  	<tfoot>
  		<tr>
  			<td colspan="4" align="right" style="background: #eee;"><b>TOTAL</b></td>
  			<th ><input type="" readonly name="" class="form-control" value="<?php echo number_format($aportado,2); ?>"></th>
  		</tr>
  	</tfoot>
  </table>

  <script type="text/javascript">
  	
  	 $(document).ready(function() {
        $('#data_table').DataTable({

          "language": {
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron registros.",
            "show":    "x"
        },
        "paging":   true,
        "ordering": true,
        "info":     false
        
    });
      } );

  </script>