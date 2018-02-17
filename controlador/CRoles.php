<?php
	if($_REQUEST["envio"]=="ajax"){
		include("../modelo/MSesion.php");
		$objSesion2 = new clsSesion;
	}else{
		require_once("../../modelo/MModulo.php");
	    require_once ("../../modelo/MServicio.php");
	    require_once ("../../modelo/MOperacion.php");
	    $objModulo = new Modulo;
	    $objServicio = new Servicio;
	    $objOperacion = new Operacion;	

	    $modulos = $objModulo->listarModulos();
	}

	if(isset($_POST["envio"]) && $_POST["envio"]=="ajax"){
		if($_POST["accion"]=="guardar"){
			//echo "entro por el guardar";
			echo $objSesion2->guardarServicioOperacion($_POST["servicio"],$_POST["operacion"],$_POST["usuario"]);
		}else if($_POST["accion"]=="eliminar"){
			//echo "entro por el eliminar";
			echo $objSesion2->eliminarServicioOperacion($_POST["servicio"],$_POST["operacion"],$_POST["usuario"]);
		}
	}
	
	if(isset($_GET["envio"]) && $_GET["envio"]=="ajax"){
		if(isset($_GET["obtenerServicios"]) && $_GET["obtenerServicios"]==1){
			$datos = $objSesion2->listarServicioOperacionUsuario($_GET["usuario"]);
			echo json_encode($datos);
		}
	}
?>