<?php 
//echo 'Funciono '.$_POST['mnn']; exit();
session_start();

//echo 'NNNNNN* '.$_POST["opera"]; exit();
	include_once("../modelo/MBeneficios.php");
	$OBenef = new Beneficio();

	$OBenef->setIdBeneficio($_POST["idSolicitud"]);
	$OBenef->observacion = $_POST["observacion"];
	$operacion = $_POST["mnn"];

	//Para enviar correos
    include_once("../modelo/MEmail.php");
  	$mail = new SendMail();

  	include_once("../modelo/MSocio.php");
    $OSocio = new Socio();
	$solicitud=$OBenef->buscarSolicitud($_POST["idSolicitud"]);
    $Email  = $solicitud['email'];
	
	switch ($operacion) {
		case 'Liquidar':
			if($OBenef->liquidarSolicitud())
			{
				$mensaje = "
		        	Estimado Socio, le notificamos que Su prestamo a sido liquidado Sastifactoriamente
			        <br/>
			        <br/>
		        	NOTA: este es un mensaje enviado por sistema, por favor no responda al mismo ya que no será atendido 
		        	por ninguna persona en la institución.
		        	<br/>
		        	<br/>
					Notificacion automática: Este mensaje y cualquier archivo que se adjunte contiene información 
					privilegiada y confidencial. Es para uso exclusivo del destinatario. Si usted ha recibido esta 
					comunicación por error, por favor avisenos inmediatamente.
			        ";
			        $mail->to($Email);
			        $mail->message($mensaje);
			        $mail->SendAMail();
			}
		break;

		case 'Rechazar':
			if($OBenef->recharzarSolicitud())
			{
				$mensaje = "
		        	Estimado Socio, lamentamos informarle que su solicitud ha sido
		        	rechazada, para más información comuniquese con el personal de CAPPIUTEP ó revise 
		        	las observaciones de la misma por sistema.
			        <br/>
			        <br/>
			        <br/>
		        	NOTA: este es un mensaje enviado por sistema, por favor no responda al mismo ya que no será atendido 
		        	por ninguna persona en la institución.
		        	<br/>
		        	<br/>
					Notificacion automática: Este mensaje y cualquier archivo que se adjunte contiene información 
					privilegiada y confidencial. Es para uso exclusivo del destinatario. Si usted ha recibido esta 
					comunicación por error, por favor avisenos inmediatamente.
			        ";
		        $mail->to($Email);
		        $mail->message($mensaje);
		        $mail->SendAMail();
			}
			
		break;

		case 'Atrasar':
			if($OBenef->atrasarSolicitud())
			{
					$_SESSION['msj']='Liquidacion Suspendida Exitosamente';
				$mensaje = "
		        	Estimado Socio, lamentamos informarle que su solicitud ha sido
		        	rechazada, para más información comuniquese con el personal de CAPPIUTEP ó revise 
		        	las observaciones de la misma por sistema.
			        <br/>
			        <br/>
			        <br/>
		        	NOTA: este es un mensaje enviado por sistema, por favor no responda al mismo ya que no será atendido 
		        	por ninguna persona en la institución.
		        	<br/>
		        	<br/>
					Notificacion automática: Este mensaje y cualquier archivo que se adjunte contiene información 
					privilegiada y confidencial. Es para uso exclusivo del destinatario. Si usted ha recibido esta 
					comunicación por error, por favor avisenos inmediatamente.
			        ";
		        $mail->to($Email);
		        $mail->message($mensaje);
		        $mail->SendAMail();

			}else{
				$_SESSION['msj']='Error';
			}
			
			
		break;
	}
	$_SESSION['msj']="Operacion Realizada Correctamente";
	header("location: ../vista/sis/liquidar_prestamos.php");
?>