<?php session_start();
	
	require_once("../modelo/MBeneficios.php");
	$objBeneficio = new Beneficio;
	
	$objBeneficio->interes = $_POST['Interes'];
	$objBeneficio->cuotas = $_POST["Plazo"];
	if(isset($_POST["MontoTotalEspecial"]) && $_POST["MontoTotalEspecial"]>0){
		$objBeneficio->monto_especial=$_POST["MontoTotalEspecial"];
		$objBeneficio->monto  = $_POST['MontoNominaReal'];
	}else{
		$objBeneficio->monto  = $_POST['Monto'];
		$objBeneficio->monto_especial=0;
	}

	$objBeneficio->solicitante = $_SESSION["userActivo"];

	$nro = $_POST['detalle_nro'];
	$mes = $_POST['detalle_mes'];
	$anho = $_POST['detalle_anho'];
	$capital = $_POST['detalle_capital'];
	$amortizacion = $_POST['detalle_amortizacion'];
	$pago = $_POST['detalle_pago'];
	$saldo = $_POST['detalle_saldo'];
	
	if($objBeneficio->guardarSolicitud(1)){//Si guarda correctamente mandamos el email	
		$ultimoId = $objBeneficio->ultimoIdSolicitud();
		for($i=0;$i<=max($nro);$i++) {
			$objBeneficio->registrar_detalle($nro[$i],$mes[$i],$anho[$i],$capital[$i],$amortizacion[$i],$pago[$i],$saldo[$i],$ultimoId);
		}
		//empezamos a guardar los fiadores
		/*foreach($_POST["txtCiF"] as $idx => $cedFiador) {
			$objBeneficio->asignarFiador($ultimoId,$cedFiador);
		}*/

	    //Para enviar correos
	    include_once("../modelo/MEmail.php");
	  	$mail = new SendMail();

	  	include_once("../modelo/MSocio.php");
	    $OSocio = new Socio();
	    $Email  = $OSocio->getEmail($_SESSION["userActivo"]);

	  	$mensaje = "
		        	Estimado Socio, le notificamos que su solicitud de Préstamo Personal por el monto
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