<?php  session_start();
	
	include_once("../modelo/MBitacoraOperacion.php");
    $bitacora = new BitOpe;

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
			if($OBenef->aprobrarAnalisis())
			{
				$mensaje = "
		        	Estimado Socio, le notificamos que su solicitud de Préstamo Especial ha aprobado
		        	el análisis creditício, posteriormente será evaluada por el Consejo Administrativo
		        	para decidir su aprobacón por este medio se le notificará el resultado de la misma, 
		        	tenga un feliz día.
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
		        $bitacora->registrar($_SESSION["idusuario"],"Prestamo Especial","Analizar","Prestamo Analizado");
			}
		break;
		case 'Rechazar':
			if($OBenef->recharzarAnalisis())
			{
				$mensaje = "
		        	Estimado Socio, lamentamos informarle que su solicitud de Préstamo Especial ha sido
		        	rechazada, para más información comuniquese con el personal de CAPPIUTEP ó revise 
		        	las observaciones del préstamo por sistema.
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
		        $bitacora->registrar($_SESSION["idusuario"],"Prestamo Especial","Rechazar","Prestamo Rechazado");
			}
			
		break;
	}
?>