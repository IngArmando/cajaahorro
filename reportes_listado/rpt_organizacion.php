<?php 
	session_start();
	require_once("../modelo/clst_organizacion.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_organizacion=new clst_organizacion;
	$laMatriz=$objt_organizacion->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_organizacions"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("razon_social"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("siglas"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("telefono"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("dir_fiscal"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("email"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("rif"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("nit"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["razon_social"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["siglas"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["telefono"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["dir_fiscal"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["email"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["rif"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["nit"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>