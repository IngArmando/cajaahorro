<?php 
	session_start();
	require_once("../modelo/clst_motivo_proceso.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_motivo_proceso=new clst_motivo_proceso;
	$laMatriz=$objt_motivo_proceso->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_motivo_procesos"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("id_motivo"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_proceso"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_motivo"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_proceso"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>