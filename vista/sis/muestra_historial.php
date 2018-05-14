 <link rel="stylesheet" type="text/css" href="../../css/Bootstrap/css/bootstrap.css">

<br>

	<table class="table table-bordered" style="width: 60%; font-size: 9px;" align="right">
		<tr style="background: #EEE; font-size: 14px; font-weight: bold;"><td align="center" colspan="5">LEYENDA</td></tr>
		<tr>
			<th style="background: #F5A9A9 ;" >Cuotas Pasadas</th>
			<th style="background:#9FF781 ;">Cuota Mes Actual</th>
			<th style="background: #F5DA81;">Cuotas Restantes</th>
			<th ><img src="../../image/malo.png" style="width: 20%;"> Cuotas no Pagada</th>
			<th ><img src="../../image/bien.png" style="width: 20%;"> Cuota Pagada</th>
		</tr>
		
	</table>

<table class="table table-bordered" style="font-size: 13px;">
	<tr style="background: silver;"><th colspan="7"><center>TABLA DE AMORTIZACION</center></th></tr>
	<tr style="background: #EEE; font-weight: bold;">
		<td widtd="5%">Nro</td>
		<td width="" align="center">Año</td>
		<td width="" align="center">Mes</td>
		<td width="" align="center">Saldo</td>
		<td width="" align="center">Monto  Cuota</td>
		<td width="" align="center">Descontado</td>
		<td width="5%" align="center"></td>
	</tr>
	
	<?php
          @include_once('../../modelo/MPgsql.php');
          $db=new CModeloDatos;


         
             $sql="SELECT * from cappiutep.t_detalle_amortizacion as dt where id_beneficio_solicitud='".$_GET['id']."' order by nro asc";
          
          $as=$db->ejecutar($sql);

          while ($row=$db->getArreglo($as)) {

          	$des=$row['descontado'] + $row['deposito'];

          	if($row['mes'] < date(m)){
          		$color='#F5A9A9';
          	}elseif($row['mes'] == date(m) ){
          		$color='#9FF781';
          	}else{
          		$color='#F5DA81';
          	}

          	if($des == $row['pago']){
          		$img='../../image/bien.png';
          	}else{
          		$img='../../image/malo.png';
          	}


          	echo '

          			<tr style="background:'.$color.'; font-weight:bold;">
          				<td>'.$row['nro'].'</td>
          				<td>'.$row['anho'].'</td>
          				<td>'.$row['mes'].'</td>
          				<td>'.$row['saldo'].'</td>
          				<td>'.$row['pago'].'</td>
          				<td>'.$des.'</td>
          				<td><img src="'.$img.'" style="width:80%;"></td>
          			</tr>

          	';

          }
	?>

</table>