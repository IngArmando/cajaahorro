<?php

	include("fpdf.php");
	include("clsFpdf.php");

	include_once("../modelo/MSocio.php");
    $OSocio = new Socio();

 	if (isset($_SESSION["userActivo"])){
      $OSocio -> setCedula($_SESSION["userActivo"]);
      $registro=$OSocio -> busCedulaDetalle();
      while ( $fila = $OSocio->setArreglo( $registro ))
          $datos[] = $fila;
      foreach ($datos as $Soc) { $Soc; }
    }

    $haberes= $OSocio->haberesReporte($Soc['id_persona']);

	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",14);// estilo de letra
	$lobjPdf->Ln(3);
	$lobjPdf->Cell(0,6,utf8_decode("Estado de Cuentas"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(5);
	$lobjPdf->SetFont("arial","",12);// estilo de letra
	$lobjPdf->Cell(0,6,utf8_decode("Socio"),0,1,"L");//titulo del pdf
	
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(80,7,utf8_decode("Nombre y Apellido"),"LTR",0,"L");
	$lobjPdf->Cell(50,7,utf8_decode("C.I. Nº"),"LTR",0,"L");
	$lobjPdf->Cell(0,7,utf8_decode("Fecha de Ingreso"),"LTR",1,"L");
	$lobjPdf->SetFont("arial","",11);
	$lobjPdf->Cell(80,7,utf8_decode($Soc['nombre1']." ".$Soc['nombre2']." ".$Soc['apellido1']." ".$Soc['apellido2']),"LBR",0,"L");
	$lobjPdf->Cell(50,7,utf8_decode($Soc['nacionalidad'].'-'.$Soc['cedula']),"LBR",0,"C");
	$lobjPdf->Cell(0,7,utf8_decode($OSocio->set_fecha($Soc['fechaafi'])),"LBR",1,"C");
	$lobjPdf->SetFont("arial","",11);

	$lobjPdf->Ln(3);

	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->setFillColor(39,98,176);
	$lobjPdf->SetTextColor(255);
	$lobjPdf->Cell(35,8,utf8_decode("Fecha"),1,0,"C",true);
	$lobjPdf->Cell(55,8,utf8_decode("Saldo"),1,0,"C",true);
	$lobjPdf->Cell(55,8,utf8_decode("Saldo Bloqueado (Préstamo)"),1,0,"C",true);
	$lobjPdf->Cell(0,8,utf8_decode("Saldo Bloqueado (Fianza)"),1,1,"C",true);
	$lobjPdf->SetFont("arial","",9);
	$lobjPdf->SetTextColor(0);

	foreach ($haberes as $Haber) {
		$lobjPdf->Cell(35,8,$OSocio->set_fecha($Haber['fecha_cierre']),1,0,'C');
		$lobjPdf->Cell(55,8,"Bs. ".number_format($Haber['saldo'], 2, ',', '.'),1,0,'C');
		$lobjPdf->Cell(55,8,"Bs. ".number_format($Haber['saldo_bloq_prestamo'], 2, ',', '.'),1,0,'C');
		$lobjPdf->Cell(0,8, "Bs. ".number_format($Haber['saldo_bloq_fianza'], 2, ',', '.'),1,1,'C');
	}

	

	$lobjPdf->SetTextColor(0);
	$lobjPdf->OutPut();
?>