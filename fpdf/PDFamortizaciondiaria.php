<?php
	if(isset($_GET["id"]) && (is_numeric($_GET["id"]) && $_GET["id"]>0)){
		filter_var($_GET["id"],FILTER_VALIDATE_INT);

		require_once("../modelo/Mbeneficios.php");
		$objBeneficio = new Beneficio;
		$datos = $objBeneficio->buscarSolicitud($_GET["id"]);

		$montoPrestamo = $datos["monto"];
		$mesesApagar = $datos["cuotas"];
		$fechaInicio = $datos["fecha"];
		$Interes = $datos["interes_cuotas"];
		$fechaInicioVE = $objBeneficio->set_fecha($fechaInicio);
		$FechaFinal = date("Y-m-d", strtotime("+$mesesApagar months",strtotime($fechaInicio)));

		//ahora calculo la cantidad de dias entre la fecha de inicio y la fecha final
		$datetime1 = date_create($fechaInicio);
		$datetime2 = date_create($FechaFinal);
		$interval = date_diff($datetime1, $datetime2);
		$dias = $interval->format('%a');
		$dias = 90;
	}
	require_once("token.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/SemanticUI/semantic.css">
</head>
<body>
	<div class="ui container">
		<div class="ui three column grid">
			<div class="ui column">
				<img src="../image/logop.jpg" class="left" width="40%">	
			</div>
			<div class="ui left middle aligned column">
				<p>
					<b>Caja de Ahorro y Préstamo de los Profesores de la UPTP</b><br>
					RIF: J-4015085181	
				</p>
			</div>
			<div class="ui column middle aligned">
				Fecha: <?php echo date("d-m-Y"); ?>
			</div>
		</div>
		<div class="ui eleven grid center aligned">
			<h2>Tabla de Amortización Diaria (Prestamo Especial)</h2>
			<a href="javascript:print()" style="color: red"><i class="ui print outline icon big"></i></a>
		</div>
		<br>
		<table class="ui table striped">
			<thead>
				<tr>
					<th>Nro</th>
					<th>Fecha</th>
					<!--<th>% por Día</th>-->
					<th>Prestamo</th>
					<th>Interes</th>
					<th>Total a Pagar</th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=1;$i<=$dias;$i++): ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo date("d-m-Y", strtotime("+$i days",strtotime($fechaInicio))); ?></td>
						<?php $interesDias = number_format(($i * $Interes / 365),"4",".",","); ?>
						<!--<td><?php echo $interesDias; ?></td>-->
						<td><?php echo $montoPrestamo; ?></td>
						<?php $totalInteres = $interesDias * $montoPrestamo / 100; ?>
						<td><?php echo $totalInteres ?></td>
						<td><?php echo $totalInteres + $montoPrestamo; ?></td>
					</tr>
				<?php endfor; ?>
			</tbody>
		</table>
	</div>
	<div align="center">
		<p>
			<?php echo $tokenGenerado; ?>
		</p>
	</div>
</body>
</html>