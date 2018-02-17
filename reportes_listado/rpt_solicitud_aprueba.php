<?php 
	session_start();
	require_once("../modelo/clst_solicitud_aprueba.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_solicitud_aprueba=new clst_solicitud_aprueba;
	$laMatriz=$objt_solicitud_aprueba->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_solicitud_apruebas"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("id_persona_caja"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_solicitud_flujo"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("tipoaprobacion"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_persona_caja"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_solicitud_flujo"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["tipoaprobacion"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>