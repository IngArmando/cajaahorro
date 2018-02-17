<?php 
	include_once("../modelo/MUsuario.php");
	$OUser = new Usuario();

	$operacion = $_POST["opera"];
	$OUser->setIdUser($_POST["IdUser"]);
	

	switch ($operacion) {
		case 'Bloquear':
			$OUser->actualizarStatus('9');
		break;

		case 'Reestablecer':
			$OUser->actualizarStatus('8');
		break;
	}
	header("location: ../vista/sis/ConfigUsuarios.php");
?>