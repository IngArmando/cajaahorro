<?php 
	if(isset($_GET["id"]) && (is_numeric($_GET["id"]) && $_GET["id"]>0)){
		filter_var($_GET["id"],FILTER_VALIDATE_INT);

		require_once("../modelo/Mbeneficios.php");
		$objBeneficio = new Beneficio;
		$datos = $objBeneficio->buscarSolicitud($_GET["id"]);
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
			<h2>Tabla de Amortización</h2>
			<a href="javascript:print()" style="color: red"><i class="ui print outline icon big"></i></a>
		</div>
		<br>
		<div class="">
			<table class="ui table">
				<thead>
					<tr>
						<th>Socio</th>
						<th>Fecha del Prestamo</th>
						<th>Monto del Prestamo</th>
						<th>Total Por Nómina</th>
						<th>Total Por Giro Especial</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $datos["nacionalidad"]."".$datos["cedula"]."-".$datos["nombre1"]." ".$datos["apellido1"] ?></td>
						<td><?php echo $objBeneficio->set_fecha($datos["fecha"]) ?></td>
						<td><?php echo number_format($datos["monto"]+$datos["monto_pago_especial"],2,",","."); ?></td>
						<td><?php echo number_format($datos["monto"],2,",","."); ?></td>
						<td><?php echo number_format($datos["monto_pago_especial"],2,",","."); ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<?php 
			if(isset($_GET["id"]) && (is_numeric($_GET["id"]) && $_GET["id"]>0)){
				

				function calcular_dias_restantes($fecha1,$fecha2){
					$date1=date_create($fecha1);
					$date2=date_create($fecha2);
					$diff=date_diff($date1,$date2);
					return $diff->format("%a");
				}
				//vienen de la base de datos
				$prestamo = $datos["monto_pago_especial"];
				$cuotas = $datos["cuotas"];
				$interes = $datos["interes_cuotas"];
				$hoy = $objBeneficio->set_fecha($datos["fecha"],"-","-");
				//fin vienen de la base de datos
				$prestamoActual = $prestamo;
				$cantGiros = $cuotas / 12 * 2;
				$diasAnho = 360;
				$cuota = $prestamo / $cantGiros;
				//aqui calculo si voy a empezar en diciembre o en julio los pagos especiales
				$mesHoy = date("m");
				if($mesHoy>=7){
					$entro = 1;
					$primermes = 12;
					$segundomes = 7;
					$diferencia = $primermes - $segundomes;
					$primerafecha = date("d")."-12-".date("Y");
				}else{
					$entro = 2;
					$primermes = 7;
					$segundomes = 12;
					$primerafecha = date("d")."-7-".date("Y");
				}	
			?>
				<table class="ui table striped">
					<thead>
						<tr>
							<th height="40">Nro</th>
							<th height="40">Fecha</th>
							<th height="40">Amortización</th>
							<th height="40">Interes</th>
							<th height="40">Giro Especial</th>
							<th height="40">Saldo Deudor</th>
						</tr>
					</thead>
					<tbody>
			<?php
				$fecha = $primerafecha;
				for($i=1;$i<=$cantGiros;$i++) {
					$auxPrestamo = $prestamo;
					$deuda = $prestamo - $cuota;
					$prestamo = $deuda;

					echo "<tr>";
					echo "<td height='40'>".intval($i)."</td>";
					if($i==1){
						echo "<td height='40'>".$fecha."</td>";
						$dias_pasados = calcular_dias_restantes($hoy,$fecha);
						$giro = ($auxPrestamo * $interes / $diasAnho * $dias_pasados) / 100;

					}
					if($i>1 && $i%2==0) {
						if($entro==2)
							$auxFecha = date("d-m-Y",strtotime($fecha."+5 month"));
						else if($entro==1)
							$auxFecha = date("d-m-Y",strtotime($fecha."+7 month"));

						$dias_pasados = calcular_dias_restantes($auxFecha,$fecha);
						$giro = ($auxPrestamo * $interes / $diasAnho * $dias_pasados) / 100;

						$fecha = $auxFecha;
						echo "<td height='40'>".$auxFecha."</td>";
					}else if($i>1 && $i%2==1) {
						if($entro==2)
							$auxFecha = date("d-m-Y",strtotime($fecha."+7 month"));
						else if($entro==1)
							$auxFecha = date("d-m-Y",strtotime($fecha."+5 month"));

						$dias_pasados = calcular_dias_restantes($auxFecha,$fecha);
						$giro = ($auxPrestamo * $interes / $diasAnho * $dias_pasados) / 100;

						$fecha = $auxFecha;
						echo "<td height='40'>".$auxFecha."</td>";
					}
					
					echo "<td height='40'>".number_format($cuota,2,",",".")."</td>";
					echo "<td height='40'>".number_format($giro,2,",",".")."</td>";
					$total = floatval($giro)+floatval($cuota);
					echo "<td height='40'>".number_format($total,2,",",".")."</td>";
					echo "<td height='40'>".number_format($deuda,2,",",".")."</td>";

					echo "</tr>";
				}
		?>
			</tbody>
		</table>
		<?php
			}else{
				filter_var($_GET["id"],FILTER_VALIDATE_INT);
				echo "NO HAY DATOS";
			}	
		?>
	</div>

	<div align="center">
		<p>
			<?php echo $tokenGenerado; ?>
		</p>
	</div>

</body>
</html>