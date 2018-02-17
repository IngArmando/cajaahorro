<?php
session_start();
	
	include_once("m_reppdf.php");
	
	include_once('../../../../mdl/m_prestamos.php');//Datos del Prestamo
    $o_prestamo = new prestamos;
    $o_prestamo -> setSocio( $_GET['cedulaSocio'] );
    $registro = $o_prestamo->consultarPorSocio();
    while ( $fila = $o_prestamo->setArreglo( $registro ))
        $datos[] = $fila;
    foreach ($datos as $Solicitud) { $Solicitud; }

    include_once('../../../../mdl/m_socio.php');//Datos del socio
    $o_socio = new socio;
    $o_socio -> setCI( $Solicitud['cedula_socio'] );
    $registro = $o_socio->consultar_detalle();
    while ( $fila = $o_socio->setArreglo( $registro ))
        $datos[] = $fila;
    foreach ($datos as $Socio) { $Socio; }

    $fecha_ins = implode("/",array_reverse(explode("-",$Socio['fecha_inscripcion_socio'])));
    if($Solicitud['ci_analista']!=0){
	    $o_socio -> setCI( $Solicitud['ci_analista'] );
	  	$registro = $o_socio->consultar_detalle();
	  	while ( $fila = $o_socio->setArreglo( $registro ))
			$datos[] = $fila;
	    foreach ($datos as $Analista) { $Analista; }
	}
	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->Ln(4);

	//Arial bold Italica 6
    $pdf->SetFont('Arial','BI',5);
    //Titulo del Logo
    $pdf->Cell(0,1,'CAJA DE AHORRO Y PRETAMO DE LOS PROFESORES DEL IUTEP ',0,1,'');
    $pdf->Ln(5);

    $pdf->SetFont('Arial','BI',12);
	$pdf->Cell(0,10,utf8_decode('INFORMACIÓN DEL PRÉSTAMO'),0,1,'L');
	$pdf->Ln(2);


	//FECHA DE SOLICITUD
	$fecha_sol = implode("/",array_reverse(explode("-",$Solicitud["fecha_sol"])));
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Fecha de la Solicitud:')." ".$fecha_sol,'LBT',0);
	//$pdf->SetFont('Arial','',12);
	$pdf->Cell(72,10,"",'BTR',0);

	//STATUS DE SOLICITUD
	$pdf->SetFont('Arial','B',11);
	switch ($Solicitud["status_sol"]) {
		case 0: $status = "Solicitada"; break;
		case 1: $status = "En Analisis"; break;
		case 2: $status = "Analizada"; break;
		case 3: $status = "Aceptada"; break;
		case 4: $status = "Liquidada"; break;
		case 9: $status = "Rechazada"; break;
	}
	$pdf->Cell(22,10,utf8_decode('Estado de la Solicitud:')." ".$status,'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(74,10,"",'BTR',1);

	//Nro de Solicitud
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Nro. de Solicitud:')." ".$Solicitud["nro_sol_prestamo"],'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(48,10,"",'BTR',0);


	//Tipo de prestamo
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Tipo de Prestamo:')." ".$Solicitud['descripcion_tipo_pres'],'LBT',0);//ESPACIO ENTRE EL TITULO Y LAVARIABLE, resultado en la misma linea(0)
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(43,10,"",'BTR',0);
	

	//Plazos
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(21,10,utf8_decode('Plazo de Pago:')." ".$Solicitud['descripcion_plazo'],'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(34,10,"",'BTR',1);

	
	//Monto Solicitado
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(45,10,utf8_decode('Monto Solicitado:')." ".$Solicitud['cantidad_sol'],'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(25,10,"",'BTR',0);
	
		
	//Cuotas
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(15,10,'Nro. de Cuotas:'." ".$Solicitud['cuotas'],'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(50,10,"",'BTR',0);

	$monto = floatval($Solicitud['cantidad_sol'] / $Solicitud['cuotas']);
	//Monto por Cuota
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,'Monto por Cuota:'." ".$monto,'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(33,10,"",'BTR',1);	

	//Motivo del Prestamo
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(16,10,'Motivo del Prestamo: '.$Solicitud["motivo"],'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(174,10,"",'BTR',1);


	//Observaciones
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(40,10,utf8_decode('Observaciones: ').$Solicitud["observaciones"],'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(150,10,"",'BTR',1);

    $pdf->SetFont('Arial','BI',12);
	$pdf->Cell(0,10,utf8_decode('DATOS DEL SOLICITANTE'),0,1,'L');
	$pdf->Ln(2);

	//Cedula
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(21,10,utf8_decode('Cedula: ').$Socio["cedula_socio"],'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(72,10,"",'BTR',0);


	//Fecha de Inscripcion
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(45,10,utf8_decode('Fecha de Inscripcion: ').$fecha_ins,'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(52,10,"",'BTR',1);

	//Nombres
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Nombre: ').$Socio["nombre_socio"],'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(71,10,"",'BTR',0);

	//Apellidos
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Apellido: ').$Socio["apellido_socio"],'LBT',0);//ESPACIO ENTRE EL TITULO Y LAVARIABLE, resultado en la misma linea(0)
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(75,10,"",'BTR',1);//salto del linea (1)//largo de la celda,tamaño de lacelda

	//ANALISTA

	$pdf->SetFont('Arial','BI',12);
	$pdf->Cell(0,10,utf8_decode('ANALISTA'),0,1,'L');
	$pdf->Ln(2);

	//Cedula
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(21,10,utf8_decode('Cédula: ').$Analista["cedula_socio"],'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(169,10,"",'BTR',1);

	//Nombres
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Nombre: '.$Analista["nombre_socio"].''),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(71,10,"",'BTR',0);

	//Apellidos
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Apellido: '.$Analista["apellido_socio"].''),'LBT',0);//ESPACIO ENTRE EL TITULO Y LAVARIABLE, resultado en la misma linea(0)
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(75,10,"",'BTR',1);//salto del linea (1)//largo de la celda,tamaño de lacelda

	//APROBACION

	$pdf->SetFont('Arial','BI',12);
	$pdf->Cell(0,10,utf8_decode('APROBACIÓN'),0,1,'L');
	$pdf->Ln(2);

	//Cedula
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(21,10,utf8_decode('Cedula:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(169,10,"",'BTR',1);

	//Fecha de Aprobacion
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(45,10,utf8_decode('Fecha de Aprobación:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(145,10,"",'BTR',1);


	//Nombres
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Nombre:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(71,10,"",'BTR',0);

	//Apellidos
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Apellido:'),'LBT',0);//ESPACIO ENTRE EL TITULO Y LAVARIABLE, resultado en la misma linea(0)
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(75,10,"",'BTR',1);

	$pdf->Output();


?>
