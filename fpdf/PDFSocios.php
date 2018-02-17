<?php
	include("fpdf.php");
	include("clsFpdf.php");

	include_once("../modelo/MSocio.php");
    $OSocio = new Socio();

    $lista= $OSocio->reporte($_POST['Cargo'],$_POST['Sede']);
    $total= $OSocio->cuentaporcargo();
    $totalsede= $OSocio->cuentaporsede();
	

	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","IB",14);// estilo de letra
	$lobjPdf->Ln(5);
	$lobjPdf->Cell(0,6,utf8_decode("Listado de Socios"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(5);
	$lobjPdf->SetFont("arial","",10);// estilo de letra

	$lobjPdf->Ln(3);

	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->setFillColor(39,98,176);
	$lobjPdf->SetTextColor(255);
	$lobjPdf->Cell(10,8,utf8_decode("N°"),1,0,"C",true);
	$lobjPdf->Cell(20,8,utf8_decode("C.I."),1,0,"C",true);
	$lobjPdf->Cell(45,8,utf8_decode("Nombre"),1,0,"C",true);
	$lobjPdf->Cell(45,8,utf8_decode("Apellido"),1,0,"C",true);
	$lobjPdf->Cell(45,8,utf8_decode("Cargo"),1,0,"C",true);
	$lobjPdf->Cell(25,8,utf8_decode("Sede"),1,1,"C",true);
	$lobjPdf->SetFont("arial","",8);
	$lobjPdf->SetTextColor(0);

	if ($lista==NULL) 
	{
		$lobjPdf->Cell(180,8,'No se encontraron resultados.',1,0,'C');
	}
	else
	{
		foreach ($lista as $Listado) {
			$n+=1;
			(string)
			$lobjPdf->Cell(10,8,$n,1,0,'C');
			$lobjPdf->Cell(20,8,utf8_decode($Listado['nacionalidad'])."-".$Listado['cedula'],1,0,'L');
			$lobjPdf->Cell(45,8,strtoupper(utf8_decode($Listado['nombre1'])." ".strtoupper(utf8_decode($Listado['nombre2']))),1,0,'L');
			$lobjPdf->Cell(45,8,strtoupper(utf8_decode($Listado['apellido1']))." ".strtoupper(utf8_decode($Listado['apellido2'])),1,0,'L');
			$lobjPdf->Cell(45,8,strtoupper(utf8_decode($Listado['tdocente'])),1,0,'L');
			$lobjPdf->Cell(25,8,strtoupper(utf8_decode($Listado['sede'])),1,1,'C');

		}
	}


	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","IB",14);// estilo de letra
	$lobjPdf->Ln(5);
	$lobjPdf->Cell(0,6,utf8_decode("Reporte Estadístico de Socios"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(5);
	$lobjPdf->SetFont("arial","B",10);// estilo de letra

	$lobjPdf->Ln(3);
	$lobjPdf->Cell(0,6,utf8_decode("SOCIOS INSCRITOS POR TIPO DE CARGO"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(2);

	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->setFillColor(39,98,176);
	$lobjPdf->SetTextColor(255);
	$lobjPdf->Cell(15,8,utf8_decode("N°"),1,0,"C",true);
	$lobjPdf->Cell(65,8,utf8_decode("Tipo de Cargo"),1,0,"C",true);
	$lobjPdf->Cell(40,8,utf8_decode("Cant. de Socios"),1,1,"C",true);
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
			$lobjPdf->Cell(15,8,$num,1,0,'C');
			$lobjPdf->Cell(65,8,utf8_decode($Totales['tipo']),1,0,'L');
			$lobjPdf->Cell(40,8,$Totales['cant'],1,1,'C');
			$cantfinal+=$Totales['cant'];
		}
			$num=0;

		$lobjPdf->SetTextColor(255);
		$lobjPdf->SetFont("arial","B",10);// estilo de letra
		$lobjPdf->Cell(80,8,"TOTAL GENERAL",1,0,'L',TRUE);
		$lobjPdf->Cell(40,8,$cantfinal,1,1,'C',TRUE);
	}
	$lobjPdf->SetTextColor(0);
	$lobjPdf->Ln(3);
	$lobjPdf->Cell(0,6,utf8_decode("SOCIOS INSCRITOS POR SEDE"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(2);

	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->setFillColor(39,98,176);
	$lobjPdf->SetTextColor(255);
	$lobjPdf->Cell(15,8,utf8_decode("N°"),1,0,"C",true);
	$lobjPdf->Cell(65,8,utf8_decode("Tipo de Cargo"),1,0,"C",true);
	$lobjPdf->Cell(40,8,utf8_decode("Cant. de Socios"),1,1,"C",true);
	$lobjPdf->SetFont("arial","",9);
	$lobjPdf->SetTextColor(0);

 	if ($totalsede==NULL) 
	{
		$lobjPdf->Cell(180,8,'No se encontraron resultados.',1,0,'C');
	}
	else
	{
		foreach ($totalsede as $Totales) {
			$num+=1;
			$lobjPdf->Cell(15,8,$num,1,0,'C');
			$lobjPdf->Cell(65,8,utf8_decode($Totales['tipo']),1,0,'L');
			$lobjPdf->Cell(40,8,$Totales['cant'],1,1,'C');
			$cantfinal+=$Totales['cant'];
		}

		$lobjPdf->SetTextColor(255);
		$lobjPdf->SetFont("arial","B",10);// estilo de letra
		$lobjPdf->Cell(80,8,"TOTAL GENERAL",1,0,'L',TRUE);
		$lobjPdf->Cell(40,8,$cantfinal,1,1,'C',TRUE);
	}
	$lobjPdf->SetTextColor(0);


	$lobjPdf->OutPut();
?>