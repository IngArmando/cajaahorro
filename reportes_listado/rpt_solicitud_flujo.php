<?php 
	session_start();
	require_once("../modelo/clst_solicitud_flujo.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_solicitud_flujo=new clst_solicitud_flujo;
	$laMatriz=$objt_solicitud_flujo->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_solicitud_flujos"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("id_beneficio_flujo"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_solicitud"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_entra"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_sale"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("observacion"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_beneficio_flujo"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_solicitud"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_entra"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_sale"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["observacion"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>