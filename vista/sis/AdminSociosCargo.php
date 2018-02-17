<?php
	session_start();

	include_once("../../modelo/MCombo.php");
	$combo = new Combo();

	include_once("../../modelo/MSocio.php");
	$OSocio = new Socio();
	 if (isset($_GET['id']))
  	{
	    $OSocio -> setIdPersona($_GET['id']);
	    $registro=$OSocio -> busCargo();
	    while ( $fila = $OSocio->setArreglo( $registro ))
	        $datos[] = $fila;
	      foreach ($datos as $Soc) { $Soc; }
  	}

	$hoy=date("d/m/Y");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Socios | Asignar Cargo</title>	
	<!-- Standard Meta -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->
	<!--  Propiedades -->
    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
	<link rel="stylesheet" type="text/css" href="../../js/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
    <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->
	<!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
	<script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
	<script src="../../js/main.js"></script> <!--Configura Interfaz -->
	<script src="../../js/JsSocio.js"></script> <!--Validaciones --> 
	<script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
	<script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
	<script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
	<script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
	
</head>

<body>	
	<?php include_once('Menu.php'); ?> <!-- Menu Lateral -->         
	
	<div class="ui container"> 

		<h2 class="ui center aligned small block icon inverted header">
			<i class="user icon"></i>
			Socio
		</h2>

		<h3 class="ui center aligned dividing block header">Asignar Cargo</h3>

		<form class="ui large form" method="POST" action="../../controlador/CSocioCargo.php" name="formulario" id="formulario">

		<div class="ui three fields">
				<div class="field">
					<label>Cédula</label>
					<div class="ui transparent input"><!-- Nro Cedula -->
						<input type="text" name="Cedu" id="Cedu" value="<?php if(isset($Soc['cedula'])) echo $Soc['nacionalidad'].'-'.$Soc['cedula']; ?>" readonly>
					</div>
				</div>

				<div class="field"><!-- Nombre -->
					<label>Nombre y Apellido</label>
					<div class="ui transparent input">
						<input type="text" name="Nombre" id="Nombre"  value="<?php if(isset($Soc['nombre1'])) echo $Soc['nombre1'].' '.$Soc['apellido1']; ?>" readonly>
					</div>
				</div>

				<div class="field">
					<label>Cargo Actual</label>
					<div class="ui transparent input">
						<input type="text" name="CargAct" id="Nombre1"  value="<?php if(isset($Soc['cargo'])) echo $Soc['cargo']; ?>" readonly>
					</div> 
				</div> 
			</div> 

			<div class="ui dividing header"></div>
			<div class="ui centered segment">
			<div class="four wide field">
				<label>Nuevo Cargo</label>
				<?php
					$tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_cargo_caja_ahorro WHERE estatus='1'", "id_cargo_caja","nombre", isset($Soc[''])?$Soc['']:'','NuevoCargo',' class="ui compact dropdown"');
					foreach ($tagcbotp as $tagtp){echo $tagtp;}
				?>
			</div>  
			</div>  

			<div class="ui error message"></div> 
			<div class="ui center aligned block inverted header">

				<input type="hidden" name="IdPersona" id="IdPersona" value="<?php if(isset($_GET['id'])) echo $_GET['id']; ?>">
				<input type="hidden" name="IdUser" id="IdUser" value="<?php if(isset($Soc['user'])) echo $Soc['user']; ?>">
				<input type="hidden" name="opera" id="opera">
				<input type="button" class="ui sumbit primary button" value="Guardar" onclick="enviar(this.value)">
				<input type="button" class="ui red button" value="Cancelar" onclick="cancelar()">   
			</div>
		</form>
	</div>  
</body>
</html> 