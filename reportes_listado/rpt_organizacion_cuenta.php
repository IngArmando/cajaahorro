<?php 
	session_start();
	require_once("../modelo/clst_organizacion_cuenta.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_organizacion_cuenta=new clst_organizacion_cuenta;
	$laMatriz=$objt_organizacion_cuenta->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_organizacion_cuentas"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("id_org"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_banco"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("num_cuenta"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("tipo_cuenta"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_org"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_banco"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["num_cuenta"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["tipo_cuenta"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>