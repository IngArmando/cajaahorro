<?php
	session_start();

	include_once("../../modelo/MSocio.php");
	include_once("../../modelo/MBeneficios.php");
	$OSocio = new Socio;
	$OBeneficio = new Beneficio;

	if ($OBeneficio->ContAnalisis()>0) 
		{ $pendientes_analisis='<div class="ui red label">'.$OBeneficio->ContAnalisis().'</div>'; }
	else
		{ $pendientes_analisis='<div class="ui gray label">'.$OBeneficio->ContAnalisis().'</div>'; }

	if ($OBeneficio->ContAprob()>0) 
		{ $pendientes_aprobacion='<div class="ui red label">'.$OBeneficio->ContAprob().'</div>'; }
	else
		{ $pendientes_aprobacion='<div class="ui gray label">'.$OBeneficio->ContAprob().'</div>'; }

	if ($OBeneficio->ContLiq()>0) 
		{ $pendientes_liquidacion='<div class="ui red label">'.$OBeneficio->ContLiq().'</div>'; }
	else
		{ $pendientes_liquidacion='<div class="ui gray label">'.$OBeneficio->ContLiq().'</div>'; }

	$CargoCaja = $OSocio->getCargo($_SESSION["userActivo"]);
	if (isset($_SESSION["userActivo"])){
		
		

		$solicitudes = $OBeneficio->ListarSolicitudes(1);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CAPPIUTEP | Gestion de Solicitudes</title>
	<!-- Standard Meta -->
  	<meta charset="utf-8" />
  	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  	<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->   

  	<!--  Propiedades -->

    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->

  	<link rel="stylesheet" type="text/css" href="../../css/Bootstrap/css/bootstrap.css"> <!--Bootstrap -->
  	<link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
  	<link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
  	<link rel="stylesheet" type="text/css" href="../../js/DataTables/media/css/dataTables.bootstrap.css"><!-- Bootstrap Tablas -->
  	<link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->

	<!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->

	<script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
	<script src="../../js/main.js"></script> <!--Configura Interfaz -->
	<script src="../../js/DataTablesConfig.js"></script> <!--Configura Interfaz -->
	<script src="../../js/"></script> <!--Validaciones --> 
	<script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
	<script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
	<script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
	<script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
	<script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
	<script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>

<body>  
	<?php include_once('Menu.php'); ?> <!-- Menu Lateral -->
	<div class="ui container">
		<h2 class="ui center aligned small block icon inverted header">
			<i class="open folder outline icon"></i>
			Gestión de Solicitudes                
		</h2>    

		<a class="ui labeled icon button" onclick="window.location='Inicio.php' ">
			<i class="left arrow icon"></i>
			Volver
		</a> 
		<div class="ui block dividing center aligned header">Solicitudes pendientes</div>
		<?php 
		//$CargoCaja=3; 

		//echo $pendientes_aprobacion.' * '.$pendientes_liquidacion.' * '.$pendientes_analisis;
		switch ($CargoCaja) {
			case '2':
			echo '<div class="ui top attached tabular two item blue menu">
			<a class="item active" data-tab="Análisis">Aprobar/Rechazar'.$pendientes_aprobacion.'</a>
			<a class="item" data-tab="Liquidación">Liquidación'.$pendientes_liquidacion.'</a>
		</div>
		<div class="ui bottom attached tab segment active" data-tab="Análisis">';
			?>
			<form name="formulario" id="formulario" action="../../controlador/CAprobarSolicitud.php" method="POST">
				<table class="ui table celled"  id="Tabla">
					<thead>
						<th>N°</th>
						<th>Solicitante</th>
						<th>Fecha</th>
						<th>Tipo de Solicitud</th>
						<th>Monto Solicitado</th>
						<th>Acciones</th>
					</thead>
					<tbody>
						<?php if($solicitudes): ?>
							<?php $cantAprobados=0 ?>
							<?php foreach($solicitudes as $indexA => $solicitud): ?>
								<?php if($solicitud["estatus"]==2): ?>
									<?php $cantAprobados++; ?>
								<tr>
									<td><?php echo ($cantAprobados) ?></td>
									<td><?php echo $solicitud["solicitante"]; ?></td>
									<td><?php echo $OBeneficio->set_fecha($solicitud["fecha"]); ?></td>
									<td><?php echo $solicitud["tipo"]; ?></td>
									<td><?php echo number_format($solicitud["monto"] + $solicitud["monto_pago_especial"],2,",","."); ?></td>
									<td class="center aligned">
										<div class="ui buttons">
											<input type="hidden" name="idSolicitud" value="<?php echo $solicitud['id_beneficio_solicitud'] ?>">
											<input type="button" class="ui tiny green button" value="Aprobar" onclick="enviar(this.value)">
											<input type="button" class="ui tiny red button" value="Rechazar" onclick="enviar(this.value)">
											<div class="ui icon button" data-content="Ver detalle" data-variation="basic" onclick="verReporte('<?php echo $solicitud['id_beneficio_solicitud'] ?>')">
										      <i class="search icon"></i>
										    </div>
											<?php if($solicitud["tipo"]=="Préstamo Personal"): ?>
											<div class="ui icon button" data-content="Ver tabla de amortización" data-variation="basic" onclick="javascript:window.open('../../fpdf/PDFTablaAmortizacion.php?id=<?php echo $solicitud["id_beneficio_solicitud"] ?>')">
										      <i class="table icon"></i>
										    </div>											
											<?php endif; ?>
											<?php if($solicitud["tipo"]=="Préstamo Especial"): ?>
											<div class="ui icon button" data-content="Ver tabla de amortización" data-variation="basic" onclick="javascript:window.open('../../fpdf/PDFamortizaciondiaria.php?id=<?php echo $solicitud["id_beneficio_solicitud"] ?>')" >
										      <i class="table icon"></i>
										    </div>
											<?php endif; ?>
										    <div class="ui icon button" data-content="Ver haberes" data-variation="basic" onclick="javascript:window.open('haberesSocio.php?id=<?= $solicitud['id_persona'] ?>')" >
										      <i class="archive icon"></i>
										    </div>
										</div>
									</td>
								</tr>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
						<?php if(!$solicitudes): ?>
							<tr>
								<td colspan="6">No hay solicitudes pendientes en éste momento.</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
				<input type="hidden" name="opera" id="opera">
				<input type="hidden" name="observacion" value="">
				<script type="text/javascript">
				/*

					function enviar(operacion){
					    document.getElementById("opera").value=operacion;
					    if(confirm("Esta seguro de realizar esta operación?")){
					        document.formulario.submit();
					    }
					}*/

					function enviar(operacion){ 
				        switch(operacion){
				            case "Solicitar":
				                var redireccion="Prestamos.php";
				            break;
				            case "Procesar":
				            case "Aprobar":
				            case "Rechazar":
				            case "Liquidar":
				                var redireccion="GestionSolicitudes.php";
				            break;
				        }

				    swal({
				          text: "¿Está seguro de realizar ésta acción?",
				          type: "info",
				          showCancelButton: true,
				          cancelButtonText: "Cancelar",
				          cancelButtoncolor: "#d01919",
				          confirmButtonText: "Aceptar",
				          confirmButtonColor: "#2185d0",
				          closeOnConfirm: false,
				    },
				    function(){
				        swal.disableButtons();
				          setTimeout(function(){
				            document.formulario.opera.value=operacion;
				            $("#formulario").submit(function(e){
				              var postData = $(this).serialize();
				              var formURL = $(this).attr("action");
				              $.ajax({
				                url : formURL,
				                type: "POST",
				                data : postData
				            });
				              e.preventDefault(); 
				          });
				            $("#formulario").submit();
				            swal({
				              type:"success",
				              text:"Operacion exitosa",
				              showCancelButton: false,
				              confirmButtonText: "Continuar",
				              confirmButtonColor: "#2185d0",
				          },function(){
				            window.location=redireccion;
				          }
				          );
				        },1500);
				      });
				    }
					
					function verReporte(id){
						window.open("Solicitudver.php?id="+id);
					}

					function verReporteAmortizacion(id) {
						window.open("../../fpdf/PDFTablaAmortizacion.php?id="+id);
					}
				</script>
			</form>
			<?php
			echo '</div>
			<div class="ui bottom attached tab segment" data-tab="Liquidación">';
			?>
			<table class="ui table celled" id="PrestamoLiquidacion">
				<thead>
					<th>N°</th>
					<th>Solicitante</th>
					<th>Fecha</th>
					<th>Tipo de Solicitud</th>
					<th>Monto Solicitado</th>
					<th>Acciones</th>
				</thead>
				<tbody>
					<?php if($solicitudes): ?>
						<?php $cantAnalizados=0; ?>
						<?php foreach($solicitudes as $index => $solicitud): ?>
							<?php if($solicitud["estatus"]==3): ?>
								<?php $cantAnalizados++; ?>
							<tr>
								<td><?php echo ($cantAnalizados) ?></td>
								<td><?php echo $solicitud["solicitante"]; ?></td>
								<td><?php echo $OBeneficio->set_fecha($solicitud["fecha"]); ?></td>
								<td><?php echo $solicitud["tipo"]; ?></td>
								<td><?php echo number_format($solicitud["monto"] + $solicitud["monto_pago_especial"],2,",","."); ?></td>
								<td>
								<form name="" id="" action="../../controlador/CAprobarSolicitud.php" method="POST">
									<input type="hidden" name="opera" id="opera" value="Atrasar">
									<input type="hidden" name="idSolicitud" value="<?php echo $solicitud['id_beneficio_solicitud'] ?>">
									<input type="submit" class="ui tiny red button" value="Atrasar" onclick="javascript:location.href=''">
									<input type="button" class="ui tiny primary button" value="Procesar Liquidacion" onclick="javascript:location.href='PresLiquidacion.php?id=<?php echo $solicitud["id_beneficio_solicitud"] ?>'">
								</form>
								</td>
							</tr>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
					<?php if(!$solicitudes): ?>
						<tr>
							<td colspan="6">No hay solicitudes pendientes en éste momento.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<?php

				echo '</div>';                                

				break;
			}

			 ?>
		</div>
	</div>
	
</body>
</html>