<?php
session_start();
	
	include_once("../mdl/m_reppdf.php");
	
	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->Ln(4);

	//Arial bold Italica 6
    $pdf->SetFont('Arial','BI',5);
    //Titulo del Logo
    $pdf->Cell(0,1,'CAJA DE AHORRO Y PRETAMO DE LOS PROFESORES DEL IUTEP ',0,1,'');
    $pdf->Ln(5);

    //TIPO DE PROGRAMA
    $pdf->SetFont('Arial','BI',11);
     $pdf->Cell(165,1,'PROGRAMA: ',0,1,'R');
     $pdf->SetFont('Arial','',11);
	 $pdf->Cell(0,0,utf8_decode($_POST['programa']),'R',0);
     $pdf->Ln(5);

    $pdf->SetFont('Arial','BI',12);
	$pdf->Cell(0,10,utf8_decode('Información del Socio'),0,1,'L');
	$pdf->Ln(2);


	//Nombres
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Nombre:'),'LBT',0);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(45,10,utf8_decode($_POST['nombre']),'BTR',0);

	//Apellidos
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Apellido:'),'LBT',0);//ESPACIO ENTRE EL TITULO Y LAVARIABLE, resultado en la misma linea(0)
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(45,10,utf8_decode($_POST['apellido']),'BTR',0);//salto del linea (1)//largo de la celda,tamaño de lacelda

    //Cedula
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(21,10,utf8_decode('Cedula:'),'LBT',0);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(35,10,utf8_decode($_POST['ci']),'BTR',1);

//FECHA DE INGRESO
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Fecha de Ingreso:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(68,10,utf8_decode($_POST['fechaingreso']),'BTR',0);

//Telefono
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(25,10,utf8_decode('Telf. Móvil:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(75,10,utf8_decode($_POST['telf_mov']),'BTR',1);


//E-mail
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(41,10,utf8_decode('Correo Electrónico:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(149,10,utf8_decode($_POST['email']),'BTR',1);
	$pdf->Ln(5);

	//Antiguedad en la CAJA
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,utf8_decode('Antigüedad en la caja:'),'LBT',0);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(48,10,utf8_decode($_POST['antiguedadcaja']),'BTR',0);

	//Monto Solicitado
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(45,10,utf8_decode('Monto Solicitado:'),'LBT',0);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(13,10,utf8_decode($_POST['cantidad_sol']),'BTR',0);

	//Ingreso Mensual
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(33,10,'Ingreso Mensual:','LBT',0);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(29,10,utf8_decode($_POST['salario']),'BTR',1);
	
	//Plazo a Cancelar
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(21,10,utf8_decode('Plazo a Cancelar:'),'LBT',0);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(64,10,utf8_decode($_POST['id_plazo']),'BTR',0);


//OTRO PROGRAMA DE FINANCIAMIENTO
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(45,10,utf8_decode('Otro Programa:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(60,10,utf8_decode($_POST['otroprograma']),'BTR',1);
	

	//Observaciones
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(40,10,utf8_decode('Observaciones:'),'LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(150,10,utf8_decode($_POST['observaciones']),'BTR',1);

	
//Aprobado Por:
	$pdf->SetFont('Arial','BI',12);
	$pdf->Cell(0,10,utf8_decode('APROBADO POR:'),0,1,'C');
	$pdf->Ln(2);
	
//Elaborado Por:
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(15,10,'Eleborado Por:','LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(176,10,utf8_decode($_POST['cuotas']),'BTR',1);

	//Presidente
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(22,10,'Presidente:','LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(169,10,utf8_decode($_POST['m_cuotas']),'BTR',1);	

	//Tesoreria
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(16,10,'Tesoreria:','LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(175,10,utf8_decode($_POST['motivo']),'BTR',1);

	//Secretario
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(16,10,'Secretario:','LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(175,10,utf8_decode($_POST['motivo']),'BTR',1);


	//consejo de vigilacia
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(16,10,'Secretario:','LBT',0);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(175,10,utf8_decode($_POST['motivo']),'BTR',1);

	$pdf->Output();


?>
