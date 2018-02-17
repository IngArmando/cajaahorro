<?php 
	session_start();
	require_once("../modelo/clst_periodo.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_periodo=new clst_periodo;
	$laMatriz=$objt_periodo->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_periodos"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("fecha_ini"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_fin"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_ini"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_fin"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>