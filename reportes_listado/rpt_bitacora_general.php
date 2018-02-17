<?php 
	session_start();
	require_once("../modelo/clst_bitacora_general.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_bitacora_general=new clst_bitacora_general;
	$laMatriz=$objt_bitacora_general->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_bitacora_generals"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("id_usuario"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("servicio"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("ip"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("hora"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("operacion"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("navegador"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("mensaje"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_usuario"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["servicio"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["ip"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["hora"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["operacion"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["navegador"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["mensaje"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>