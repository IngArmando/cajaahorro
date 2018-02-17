<?php 
	session_start();
	require_once("../modelo/clst_carga_fam.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_carga_fam=new clst_carga_fam;
	$laMatriz=$objt_carga_fam->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_carga_fams"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("id_persona_beneficiario"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_persona_socio"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("parentesco"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_afiliacion"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_egreso"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("porcentaje"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_motivo"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("observacion"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_persona_beneficiario"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_persona_socio"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["parentesco"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_afiliacion"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_egreso"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["porcentaje"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_motivo"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["observacion"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>