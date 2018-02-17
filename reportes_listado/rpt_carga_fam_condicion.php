<?php 
	session_start();
	require_once("../modelo/clst_carga_fam_condicion.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_carga_fam_condicion=new clst_carga_fam_condicion;
	$laMatriz=$objt_carga_fam_condicion->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_carga_fam_condicions"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("parentesco"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("sexo"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("edad_min"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("edad_max"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("max_personas"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["parentesco"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["sexo"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["edad_min"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["edad_max"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["max_personas"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>