<?php 
	session_start();
	require_once("../modelo/clst_solicitud_amortiza.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_solicitud_amortiza=new clst_solicitud_amortiza;
	$laMatriz=$objt_solicitud_amortiza->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_solicitud_amortizas"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("id_solicitud"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("monto"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_concepto"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("forma_pago"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("ref_pago"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_pago"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_motivo_razon"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("observacion"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("amort_fecha_lim_min"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("amort_fecha_lim_max"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_cuenta"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_solicitud"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["monto"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_concepto"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["forma_pago"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["ref_pago"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_pago"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_motivo_razon"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["observacion"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["amort_fecha_lim_min"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["amort_fecha_lim_max"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_cuenta"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>