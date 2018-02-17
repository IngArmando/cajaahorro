<?php
session_start();
	
	include_once("m_reppdf.php");
	
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
	$pdf->Cell(0,10,utf8_decode('Información del Socio'),0,1,'L');
	$pdf->Ln(2);


	//Nombres
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Nombre:'),'LBT',0);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(45,10,utf8_decode($_POST['nombre_socio']),'BTR',0);

	//Apellidos
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Apellido:'),'LBT',0);//ESPACIO ENTRE EL TITULO Y LAVARIABLE, resultado en la misma linea(0)
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(45,10,utf8_decode($_POST['apellido_socio']),'BTR',0);//salto del linea (1)//largo de la celda,tamaño de lacelda

    //Cedula
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(21,10,utf8_decode('Cedula:'),'LBT',0);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(35,10,utf8_decode($_POST['cedula_socio']),'BTR',1);

 //Direccion
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(40,10,utf8_decode('Dirección:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(150,10,utf8_decode($_POST['direccion_socio']),'BTR',1);

//Monto Solicitado
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(45,10,utf8_decode('Monto Solicitado:'),'LBT',0);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(30,10,utf8_decode($_POST['cantidad_sol']),'BTR',0);

//Plazo Cancelar
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(45,10,utf8_decode('Plazo Cancelar:'),'LBT',0);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(13,10,utf8_decode($_POST['id_plazo']),'BTR',0);

//Tipo Prestamo
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(45,10,utf8_decode('Tipo de Prèstamo:'),'LBT',0);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(12,10,utf8_decode($_POST['id_tipos_prestamo']),'BTR',1);

//Antiguedad en la Caja
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Antigüedad en la Caja:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(43,10,utf8_decode($_POST['antiguedadcaja']),'BTR',0);

//FECHA DE INGRESO
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Fecha de Ingreso:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(40,10,utf8_decode($_POST['fecha_inscripcion_socio']),'BTR',0);

//FECHA DE Solicitud
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Fecha de Solicitud:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(41,10,utf8_decode($_POST['fecha_sol']),'BTR',1);


//Ingreso Mensual
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(41,10,utf8_decode('Ingreso Mensual:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(149,10,utf8_decode($_POST['salario_socio']),'BTR',1);

//Observaciones
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(40,10,utf8_decode('Observaciones:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(150,10,utf8_decode($_POST['observaciones']),'BTR',1);



	$pdf->Output();


?>
