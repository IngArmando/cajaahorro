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
	<title>ASOCIACIÓN DE EMPLEADOS MUNICIPALES DE PASTAZA</title>
	<link rel="stylesheet" type="text/css" href="../css/SemanticUI/semantic.css">
	<script src="../js/jquery-2.1.4.min.js"></script><!--JQuery -->
	<script src="../js/main.js"></script>
</head>
<body>
	<div class="ui container">
		<div class="ui three column grid">
			<div class="ui column">
				<img src="../image/logop.jpg" class="left" width="40%">	
			</div>
			<div class="ui left middle aligned column">
				<p>
					<b>ASOCIACIÓN DE EMPLEADOS MUNICIPALES DE PASTAZA</b><br>
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
						<th>Plazos</th>
						<th>Interes</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $datos["nacionalidad"]."".$datos["cedula"]."-".$datos["nombre1"]." ".$datos["apellido1"] ?></td>
						<td><?php echo $objBeneficio->set_fecha($datos["fecha"]) ?></td>
						<td><?php echo $datos["monto"]; ?></td>
						<td><?php echo $datos["cuotas"]; ?></td>
						<td><?php echo $datos["interes_cuotas"]; ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<?php 
			if(isset($_GET["id"]) && (is_numeric($_GET["id"]) && $_GET["id"]>0)){
				
			?>
				<table class="ui table striped">
					<thead>
						<tr>
							<th height="40">Nro</th>
                            <th height="40">Mes</th>
                            <th height="40">Año</th>
                            <th height="40">Capital</th>
                            <th height="40">Interés</th>
                            <th height="40">Cuota</th>
                            <th height="40">Saldo</th>
						</tr>
					</thead>
					<tbody id="tablaAmortizacion">
			
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
	<script type="text/javascript">
		window.onload = function() {
			let prestamo = <?= $datos["monto"] ?>;
          	let plazo = <?= $datos["cuotas"] ?>;
          	let interes = <?= $datos["interes_cuotas"] ?>;
          	let tbody = "tablaAmortizacion";
          	amortizacionNueva(prestamo,plazo,interes,tbody);
		}
	</script>
</body>
</html>