<?php 
	session_start();
	require_once("../modelo/clst_cargo_caja_ahorro.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_cargo_caja_ahorro=new clst_cargo_caja_ahorro;
	$laMatriz=$objt_cargo_caja_ahorro->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_cargo_caja_ahorros"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("nombre"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("descripcion"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_ini"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_fin"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("tipo_cargo"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("min_cant_personas"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("max_cant_personas"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["nombre"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["descripcion"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_ini"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_fin"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["tipo_cargo"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["min_cant_personas"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["max_cant_personas"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>