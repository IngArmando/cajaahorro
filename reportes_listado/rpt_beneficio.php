<?php 
	session_start();
	require_once("../modelo/clst_beneficio.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_beneficio=new clst_beneficio;
	$laMatriz=$objt_beneficio->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_beneficios"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("nombre"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("descripcion"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_ini"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_fin"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("max_dias_aprob"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("min_dias_aprob"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("min_dias_antiguedad"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("icono"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("mostrar"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("tipo_beneficio"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("tasa_interes"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["nombre"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["descripcion"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_ini"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_fin"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["max_dias_aprob"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["min_dias_aprob"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["min_dias_antiguedad"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["icono"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["mostrar"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["tipo_beneficio"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["tasa_interes"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>