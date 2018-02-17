<?php 
	session_start();
	require_once("../modelo/clst_usuario_clave.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_usuario_clave=new clst_usuario_clave;
	$laMatriz=$objt_usuario_clave->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_usuario_claves"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("id_usuario"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("clave"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_ini"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_fin"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_usuario"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["clave"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_ini"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_fin"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>