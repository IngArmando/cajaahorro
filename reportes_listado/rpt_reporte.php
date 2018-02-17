<?php 
	session_start();
	require_once("../modelo/clst_reporte.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_reporte=new clst_reporte;
	$laMatriz=$objt_reporte->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_reportes"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("descripcion"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("url"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["descripcion"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["url"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>