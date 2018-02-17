<?php @session_start();
	require_once("../modelo/MBeneficios.php");
	$objBeneficio = new Beneficio;
	
	$objBeneficio->idprograma = $_POST["Programa"];
	$objBeneficio->cuotas = $_POST["Plazo"];
	$objBeneficio->monto = $_POST['Monto'];
	$objBeneficio->interes = $_POST['Interes'];
	$objBeneficio->solicitante = $_SESSION["userActivo"];
	
	if($objBeneficio->guardarSolicitud(5)){//Si guarda correctamente mandamos el email	

	    //Para enviar correos
	    include_once("../modelo/MEmail.php");
	  	$mail = new SendMail();

	  	include_once("../modelo/MSocio.php");
	    $OSocio = new Socio();
	    $Email  = $OSocio->getEmail($_SESSION["userActivo"]);

	  	$mensaje = "
		        	Estimado Socio, le notificamos que su solicitud de Financiaminto por el monto
		        	de Bs. ".number_format($_POST['Monto'], 2, ',', '.')." ha sido enviada correctamente
		        	por este medio se le notificará el avance de la misma, tenga un feliz día.
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
        $mail->tocc("edgar.dsh@gmail.com");
        $mail->toccname("Edgar Sarzalejo");
        $mail->message($mensaje);
        $mail->SendAMail();

	}
	
?>