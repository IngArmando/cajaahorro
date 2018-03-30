<?php 
//echo 'Funciono '; exit();
session_start();

//echo 'NNNNNN* '.$_POST["opera"]; exit();
	include_once("../modelo/MBeneficios.php");
	$OBenef = new Beneficio();

	$OBenef->setIdBeneficio($_POST["idSolicitud"]);
	$OBenef->observacion = $_POST["observacion"];
	$operacion = $_POST["opera"];

	//Para enviar correos
    include_once("../modelo/MEmail.php");
  	$mail = new SendMail();

  	include_once("../modelo/MSocio.php");
    $OSocio = new Socio();
	$solicitud=$OBenef->buscarSolicitud($_POST["idSolicitud"]);
    $Email  = $solicitud['email'];
	
	switch ($operacion) {
		case 'Aprobar':
			if($OBenef->aprobrarSolicitud())
			{
				$mensaje = "
		        	Estimado Socio, le notificamos que su solicitud ha sido aprobada y tiene un plazo
		        	de 30 días para acudir a la oficina de CAPPIUTEP y procesar la liquidación de la misma,
		        	recuerde que si aún no ha consignado los documentos necesarios deberá hacerlo. Para más
		        	información comuniquese con el personal de CAPPIUTEP.
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
	$_SESSION['msj']="Entro normal";
	header("location: ../vista/sis/liquidar_prestamos.php");
?>