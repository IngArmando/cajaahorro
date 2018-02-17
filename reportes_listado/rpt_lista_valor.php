<?php 
	session_start();
	require_once("../modelo/clst_lista_valor.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_lista_valor=new clst_lista_valor;
	$laMatriz=$objt_lista_valor->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_lista_valors"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("id_lista"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("nombre_corto"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("nombre_largo"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_padre"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("posicion"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("bloq"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_lista"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["nombre_corto"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["nombre_largo"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_padre"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["posicion"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["bloq"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>