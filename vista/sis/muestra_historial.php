<link rel="stylesheet" type="text/css" href="../../css/Bootstrap/css/bootstrap.css">
<br>

<form method="post" action="reportes/solicitud_pres/tabla_amortizacion.php" >

	<table class="table table-bordered" style="width: 60%; font-size: 9px;" align="right" id="leyenda">
		<tr style="background: #EEE; font-size: 14px; font-weight: bold;"><td align="center" colspan="5">LEYENDA</td></tr>
		<tr>
			<th style="background: #F5A9A9 ;" >Cuotas Pasadas</th>
			<th style="background:#9FF781 ;">Cuota Mes Actual</th>
			<th style="background: #F5DA81;">Cuotas Restantes</th>
			<th ><img src="../../image/malo.png" style="width: 20%;"> Cuotas no Pagada</th>
			<th ><img src="../../image/bien.png" style="width: 20%;"> Cuota Pagada</th>
		</tr>
		
	</table>


  <?php
     @include_once('../../modelo/MPgsql.php');
          $db=new CModeloDatos;
          $db1=new CModeloDatos;

          $sql1="SELECT * from cappiutep.t_beneficio_solicitud as tb
                 inner join cappiutep.t_persona as tp on tp.id_persona=tb.id_solicitante
                where tb.id_beneficio_solicitud='".$_GET['id']."'"; 
          $as1=$db1->ejecutar($sql1); $row1=$db1->getArreglo($as1);


          echo '
                    <input type="hidden" name="fecha" value="'.date('d-m-Y',strtotime($row1['fecha'])).'">
                    <input type="hidden" name="monto" value="'.$row1['monto'].'">
                    <input type="hidden" name="cuotas" value="'.$row1['cuotas'].'">
                    <input type="hidden" name="bene" value="'.$row1['id_beneficio'].'">


                    <input type="hidden" name="nombre" value="'.$row1['cedula'].'  '.$row1['nombre1'].' '.$row1['nombre2'].' '.$row1['apellido1'].' '.$row1['apellido2'].'">
          ';

  ?>   

  <table class="table table-bordered" id="data_table">

     <thead>
        <tr style="background: #EEE; font-size: 14px; font-weight: bold;">
          
          <th>Fecha</th>
          <th>Monto</th>
          <th>Cuotas</th>
          <th width="5%"></th>
        </tr>

        <tr>
             <td><?php echo date('d-m-Y',strtotime($row1['fecha'])); ?></td>
             <td><?php echo $row1['monto']; ?></td>
             <td><?php echo $row1['cuotas']; ?></td>
             <td id="imprime"><button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-print
"></span></button></td>
        </tr>

     </thead>
  </table>      

<table class="table table-bordered" style="font-size: 13px;">
	<tr style="background: silver;"><th colspan="7"><center>TABLA DE AMORTIZACION</center></th></tr>
	<tr style="background: #EEE; font-weight: bold;" id="">
		<td widtd="5%">Nro</td>
		<td width="" align="center">Año</td>
		<td width="" align="center">Mes</td>
		<td width="" align="center">Saldo</td>
		<td width="" align="center">Monto  Cuota</td>
		<td width="" align="center">Descontado</td>
		<td width="5%" align="center"></td>
	</tr>
	
	<?php
          

         
             $sql="SELECT * from cappiutep.t_detalle_amortizacion as dt where id_beneficio_solicitud='".$_GET['id']."' order by nro asc";
          
          $as=$db->ejecutar($sql);

          while ($row=$db->getArreglo($as)) {

          	$des=$row['descontado'] + $row['deposito'];

          	if(($row['mes'] < date(m)) && $row['anho'] == date(Y) ){
          		$color='#F5A9A9';
          	}elseif($row['mes'] == date(m) && $row['anho'] == date(Y)){
          		$color='#9FF781';
          	}else{
          		$color='#F5DA81';
          	}

          	if($des == $row['pago']){
          		$img='../../image/bien.png';
                    $pag='Pagado';
          	}else{
          		$img='../../image/malo.png';
                    $pag='No Pagado';
          	}


          	echo '

          			<tr style="background:'.$color.'; font-weight:bold;">

          				<td>'.$row['nro'].' <input type="hidden" name="nro[]" value="'.$row['nro'].'"></td>
          				<td>'.$row['anho'].'<input type="hidden" name="ano[]" value="'.$row['anho'].'"></td>
          				<td>'.$row['mes'].'<input type="hidden" name="mes[]" value="'.$row['mes'].'"></td>
          				<td>'.$row['saldo'].'<input type="hidden" name="saldo[]" value="'.$row['saldo'].'"></td>
          				<td>'.$row['pago'].'<input type="hidden" name="pago[]" value="'.$row['pago'].'"></td>
          				<td>'.$des.'<input type="hidden" name="descontado[]" value="'.$des.'"></td>
          				<td><img src="'.$img.'" style="width:80%;"> <input type="hidden" name="image[]" value="'.$pag.'"></td>
          			</tr>

          	';

          }
	?>

     <script type="text/javascript">
               
               function imprime(){
                    alert(3);
               }

     </script>

</table>
</form>