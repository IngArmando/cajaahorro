<?php session_start();

	require_once("../modelo/MBeneficios.php");
	$objBeneficio = new Beneficio;

	//Para enviar correos
    include_once("../modelo/MEmail.php");
  	$mail = new SendMail();

  	include_once("../modelo/MSocio.php");
    $OSocio = new Socio();
    
	if($_POST["opera"]=="Liquidar") {
		$objBeneficio->monto        = $_POST['Monto'];
		$objBeneficio->FormaPago    = $_POST["FormaPago"];
		$objBeneficio->RefPago      = $_POST["NroRef"];
		$objBeneficio->observacion  = $_POST["Observ"];
		$objBeneficio->idSolicitud  = $_POST["idSolicitud"];
		$objBeneficio->setIdBeneficio($_POST["idSolicitud"]);
		$objBeneficio->IdBeneficio = $_POST["idSolicitud"];
		$objBeneficio->solicitante  = $_SESSION["userActivo"];

		$solicitud=$objBeneficio->buscarSolicitud($_POST["idSolicitud"]);

		$objBeneficio->idpersona = $solicitud["id_persona"];
	    $Email  = $solicitud['email'];
			
		$tipoLiquidacion = ($_POST["id_beneficio"]==4 || $_POST["id_beneficio"]==7)?2:1;

		if($_POST["id_beneficio"]==2){
			$hayFiadores = $objBeneficio->buscarFiadores($_POST["idSolicitud"]);
			if($hayFiadores)
				$tipoLiquidacion = 3;
			else
				$tipoLiquidacion = 1;

		}

		if($objBeneficio->procesarLiquidacion($tipoLiquidacion))//Si guarda correctamente mandamos el email
		{	
			if($objBeneficio->generarLiquidacion()) {

				foreach($_POST["cedulasocio"] as $idx => $cedula) {
					$objBeneficio->cedulafiador=$cedula;
					$objBeneficio->restarHaberesFianza($_POST["cantidadprestada"][$idx]);
				}
				
			  	$mensaje = "
				        	Estimado Socio, le notificamos que su solicitud por el monto
				        	de Bs. ".number_format($_POST['Monto'], 2, ',', '.')." ha sido liquidada,
				        	bajo el número de referencia ".$_POST['NroRef'].".
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
		}
	}
	
?>