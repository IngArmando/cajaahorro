<?php 
	session_start();
	require_once("../modelo/clst_persona_caja.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_persona_caja=new clst_persona_caja;
	$laMatriz=$objt_persona_caja->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_persona_cajas"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("id_persona"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_cargo_caja"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_ini"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_fin"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("condicion"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_motivo_razon"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("observacion"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_persona"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_cargo_caja"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_ini"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_fin"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["condicion"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_motivo_razon"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["observacion"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>