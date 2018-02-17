<?php
	include("fpdf.php");
	include("clsFpdf.php");

	include_once("../modelo/MSocio.php");
    $OSocio = new Socio();

	include_once("../modelo/MReportes.php");
    $ORep = new Reporte();

 

    $desde2=date('Y-m-d',strtotime(str_replace('/', '-', $_POST['Desde'] )));
    $hasta2=date('Y-m-d',strtotime(str_replace('/', '-', $_POST['Hasta'] )));

    $historia= $ORep->reportesolicitudes($desde2,$hasta2,$_POST['Beneficio'],$_POST['Estatus']);
    $total= $ORep->mostrartotal($desde2,$hasta2,$_POST['Beneficio'],$_POST['Estatus']);
    $porestatus= $ORep->porestados($desde2,$hasta2,$_POST['Beneficio'],$_POST['Estatus']);

	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","IB",14);// estilo de letra
	$lobjPdf->Ln(5);
	$lobjPdf->Cell(0,6,utf8_decode("Reporte General de Solicitudes"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(5);
	$lobjPdf->SetFont("arial","",10);// estilo de letra

	$lobjPdf->Ln(1);

	$lobjPdf->Cell(0,6,utf8_decode("Desde: ".$_POST['Desde']."                  Hasta: ".$_POST['Hasta']),0,1,"C");//titulo del pdf


	$lobjPdf->Ln(3);

	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->setFillColor(39,98,176);
	$lobjPdf->SetTextColor(255);
	$lobjPdf->Cell(10,8,utf8_decode("N°"),1,0,"C",true);
	$lobjPdf->Cell(25,8,utf8_decode("Fecha"),1,0,"C",true);
	$lobjPdf->Cell(45,8,utf8_decode("Socio"),1,0,"C",true);
	$lobjPdf->Cell(35,8,utf8_decode("Monto Solicitado"),1,0,"C",true);
	$lobjPdf->Cell(40,8,utf8_decode("Beneficio"),1,0,"C",true);
	$lobjPdf->Cell(25,8,utf8_decode("Estatus"),1,1,"C",true);
	$lobjPdf->SetFont("arial","",9);
	$lobjPdf->SetTextColor(0);

	if ($historia==NULL) 
	{
		$lobjPdf->Cell(180,8,'No se encontraron resultados.',1,0,'C');
	}
	else
	{
		foreach ($historia as $Lista) {
			switch ($Lista['solestatus']) {
				case '1':
					$estado='En análisis';
					break;
				case '2':
					$estado='Esperando aprobación';
					break;
				case '3':
					$estado='Aprobado';
					break;
				case '4':
					$estado='Liquidado';
					break;
				case '5':
					$estado='Rechazado (Análisis)';
					break;
				case '6':
					$estado='Rechazado (Junta Dir.)';
					break;
			}
			$lobjPdf->Cell(10,8,$OSocio->set_fecha($Lista['id_beneficio_solicitud']),1,0,'C');
			$lobjPdf->Cell(25,8,$OSocio->set_fecha($Lista['fecha']),1,0,'C');
			$lobjPdf->Cell(45,8,utf8_decode($Lista['nombre1']." ".utf8_decode($Lista['apellido1'])),1,0,'L');
			$lobjPdf->Cell(35,8,"Bs. ".number_format($Lista['monto'], 2, ',', '.'),1,0,'R');
			$lobjPdf->Cell(40,8,utf8_decode($Lista['tipo']),1,0,'C');
			$lobjPdf->Cell(25,8, utf8_decode($estado),1,1,'C');
		}
	}


	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","IB",14);// estilo de letra
	$lobjPdf->Ln(5);
	$lobjPdf->Cell(0,6,utf8_decode("Reporte Estadístico de Solicitudes"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(5);
	$lobjPdf->SetFont("arial","",10);// estilo de letra

	$lobjPdf->Ln(2);

	$lobjPdf->Cell(0,6,utf8_decode("Desde: ".$_POST['Desde']."                  Hasta: ".$_POST['Hasta']),0,1,"C");//titulo del pdf

	$lobjPdf->Ln(3);
	$lobjPdf->Cell(0,6,utf8_decode("SOLICITUDES POR TIPO DE PRÉSTAMO"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(2);

	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->setFillColor(39,98,176);
	$lobjPdf->SetTextColor(255);
	$lobjPdf->Cell(15,8,utf8_decode("N°"),1,0,"C",true);
	$lobjPdf->Cell(65,8,utf8_decode("Tipo de Préstamo"),1,0,"C",true);
	$lobjPdf->Cell(40,8,utf8_decode("Cant. de Solicitudes"),1,0,"C",true);
	$lobjPdf->Cell(60,8,utf8_decode("Monto Total"),1,1,"C",true);
	$lobjPdf->SetFont("arial","",9);
	$lobjPdf->SetTextColor(0);

	if ($total==NULL) 
	{
		$lobjPdf->Cell(180,8,'No se encontraron resultados.',1,0,'C');
	}
	else
	{
		foreach ($total as $Totales) {
			$num+=1;
			$lobjPdf->Cell(15,8,$num,1,0,'L');
			$lobjPdf->Cell(65,8,utf8_decode($Totales['tipo']),1,0,'L');
			$lobjPdf->Cell(40,8,$Totales['cant'],1,0,'C');
			$lobjPdf->Cell(60,8,"Bs. ".number_format($Totales['total'], 2, ',', '.'),1,1,'R');
			$totalfinal+=$Totales['total'];
			$cantfinal+=$Totales['cant'];
		}

		$lobjPdf->SetTextColor(255);
		$lobjPdf->SetFont("arial","B",10);// estilo de letra
		$lobjPdf->Cell(80,8,"TOTAL GENERAL",1,0,'L',TRUE);
		$lobjPdf->Cell(40,8,$cantfinal,1,0,'C',TRUE);
		$lobjPdf->Cell(60,8,"Bs. ".number_format($totalfinal, 2, ',', '.'),1,1,'R',TRUE);
	}
	$lobjPdf->SetTextColor(0);

	$lobjPdf->Ln(15);
	$lobjPdf->Cell(0,6,utf8_decode("SOLICITUDES POR ESTATUS"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(2);

	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->setFillColor(39,98,176);
	$lobjPdf->SetTextColor(255);
	$lobjPdf->Cell(15,8,utf8_decode("N°"),1,0,"C",true);
	$lobjPdf->Cell(65,8,utf8_decode("Tipo de Préstamo"),1,0,"C",true);
	$lobjPdf->Cell(40,8,utf8_decode("Cant. de Solicitudes"),1,0,"C",true);
	$lobjPdf->Cell(60,8,utf8_decode("Monto Total"),1,1,"C",true);
	$lobjPdf->SetFont("arial","",9);
	$lobjPdf->SetTextColor(0);

	if ($porestatus==NULL) 
	{
		$lobjPdf->Cell(180,8,'No se encontraron resultados.',1,0,'C');
	}
	else
	{
		foreach ($porestatus as $Estados) {
			switch ($Estados['estatus']) {
				case '1':
					$estado='En análisis';
					break;
				case '2':
					$estado='Esperando aprobación';
					break;
				case '3':
					$estado='Aprobado';
					break;
				case '4':
					$estado='Liquidado';
					break;
				case '5':
					$estado='Rechazado (Análisis)';
					break;
				case '6':
					$estado='Rechazado (Junta Dir.)';
					break;
			}
			$num2+=1;
			$lobjPdf->Cell(15,8,$num2,1,0,'L');
			$lobjPdf->Cell(65,8,utf8_decode($estado),1,0,'L');
			$lobjPdf->Cell(40,8,$Estados['cant'],1,0,'C');
			$lobjPdf->Cell(60,8,"Bs. ".number_format($Estados['total'], 2, ',', '.'),1,1,'R');
			$totalfinal2+=$Estados['total'];
			$cantfinal2+=$Estados['cant'];
		}

		$lobjPdf->SetTextColor(255);
		$lobjPdf->SetFont("arial","B",10);// estilo de letra
		$lobjPdf->Cell(80,8,"TOTAL GENERAL",1,0,'L',TRUE);
		$lobjPdf->Cell(40,8,$cantfinal2,1,0,'C',TRUE);
		$lobjPdf->Cell(60,8,"Bs. ".number_format($totalfinal2, 2, ',', '.'),1,1,'R',TRUE);
	}
	$lobjPdf->SetTextColor(0);
	

	$lobjPdf->OutPut();
?>