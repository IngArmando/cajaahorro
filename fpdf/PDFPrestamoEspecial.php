<?php

	include("fpdf.php");
	include("clsFpdf.php");
	
	include_once("../modelo/MBeneficioRep.php");
	$OBenef = new Beneficio();
	$datasolicitud=$OBenef->buscarSolicitud($_GET["id"]);


	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",14);// estilo de letra
	$lobjPdf->Ln(3);
	$lobjPdf->Cell(0,6,utf8_decode("Solicitud de Préstamo"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(5);
	$lobjPdf->SetFont("arial","",12);// estilo de letra
	$lobjPdf->Cell(0,6,utf8_decode("Solicitante"),0,1,"L");//titulo del pdf
	


	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(80,7,utf8_decode("Nombre y Apellido"),"LTR",0,"L");
	$lobjPdf->Cell(50,7,utf8_decode("C.I. Nº"),"LTR",0,"L");
	$lobjPdf->Cell(0,7,utf8_decode("Fecha de Ingreso"),"LTR",1,"L");
	$lobjPdf->SetFont("arial","",11);
	$lobjPdf->Cell(80,7,utf8_decode($datasolicitud['nombre1']." ".$datasolicitud['nombre2']." ".$datasolicitud['apellido1']." ".$datasolicitud['apellido2']),"LBR",0,"L");
	$lobjPdf->Cell(50,7,utf8_decode($datasolicitud['nacionalidad']."-".$datasolicitud['cedula']),"LBR",0,"L");
	$lobjPdf->Cell(0,7,utf8_decode($OBenef->set_fecha($datasolicitud['fechaafi'])),"LBR",1,"C");
	$lobjPdf->SetFont("arial","",11);

	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(70,7,utf8_decode("Teléfonos: "),"LTR",0,"L");
	$lobjPdf->Cell(0,7,utf8_decode("Correo Electrónico"),"LTR",1,"L");
	$lobjPdf->SetFont("arial","",11);
	$lobjPdf->Cell(70,7,utf8_decode($datasolicitud['cod_telf_movil']." ".$datasolicitud['telf_movil']."       ".$datasolicitud['cod_telf_fijo']." ".$datasolicitud['telf_fijo']),"LBR",0,"L");
	$lobjPdf->Cell(0,7,utf8_decode($datasolicitud["email"]),"LBR",1,"L");
	$lobjPdf->SetFont("arial","",11);

	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(70,7,utf8_decode("Monto Solicitado "),"LTR",0,"L");
	$lobjPdf->Cell(70,7,utf8_decode("Ingreso Mensual"),"LTR",0,"L");
	$lobjPdf->Cell(0,7,utf8_decode("Tipo de Préstamo"),"LTR",1,"L");
	$lobjPdf->SetFont("arial","",11);
	$lobjPdf->Cell(70,7,"Bs. ".number_format($datasolicitud['monto'], 2, ',', '.'),"LBR",0,"L");
	$lobjPdf->Cell(70,7,"Bs. ".number_format($datasolicitud['salario'], 2, ',', '.'),"LBR",0,"L");
	$lobjPdf->Cell(0,7,utf8_decode("Corto Plazo (Especial)"),"LBR",1,"C");
	$lobjPdf->SetFont("arial","",11);

	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(0,8,utf8_decode("Observaciones"),"LTR",1,"L");
	$lobjPdf->SetFont("arial","",11);
	$lobjPdf->MultiCell(0,8,utf8_decode($datasolicitud["observacion"]),"LBR","J");

	$lobjPdf->SetFont("arial","",10);
	$lobjPdf->Cell(0,4,utf8_decode(""),"LTR",1,"L");
	$lobjPdf->MultiCell(0,7,utf8_decode("En caso de que la presente solicitud fuese resuesta favorable, me comprometo a cumplir con las disposiciones previstas en los Estatutos, Reglamentos y demás normativas legales vigentes, que rigen a ésta Asociacion. "),"LR","J");
	$lobjPdf->Cell(0,6,utf8_decode(""),"LR",1,"R");
	$lobjPdf->MultiCell(0,7,utf8_decode("Así mismo, me comprometo a realizar el depósito correspondiente a la cancelación del crédito recibido, de acuerdo a las condiciones establecidas y aceptadas. (CAPPIUTEP NO HACE DESCUENTOS POR NOMINA POR ESTE CONCEPTO). "),"LR","J");
	$lobjPdf->Cell(0,6,utf8_decode(""),"LR",1,"R");
	$lobjPdf->Cell(0,6,utf8_decode("______________________                            "),"LR",1,"R");
	$lobjPdf->Cell(0,6,utf8_decode("Firma del Solicitante                               "),"LR",1,"R");
	$lobjPdf->Cell(0,4,utf8_decode(""),"LBR",1,"L");
	
	$lobjPdf->Ln(7);
	$lobjPdf->setX(60);
	$lobjPdf->Cell(0,7,utf8_decode("APROBADO POR"),"LTR",1,"C");
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(50,7,utf8_decode("ELABORADO POR"),"LTR",0,"L");
	$lobjPdf->Cell(50,7,utf8_decode("PRESIDENTE"),"LTR",0,"L");
	$lobjPdf->Cell(50,7,utf8_decode("TESORERO"),"LTR",0,"L");
	$lobjPdf->Cell(0,7,utf8_decode("SECRETARIO"),"LTR",1,"L");
	$lobjPdf->SetFont("arial","",11);
	$lobjPdf->Cell(50,20,utf8_decode(""),"LBR",0,"L");
	$lobjPdf->Cell(50,20,utf8_decode(""),"LBR",0,"L");
	$lobjPdf->Cell(50,20,utf8_decode(""),"LBR",0,"L");
	$lobjPdf->Cell(0,20,utf8_decode(""),"LBR",1,"C");
	$lobjPdf->SetFont("arial","",11);

	$lobjPdf->setX(160);
	$lobjPdf->SetFont("arial","B",8);
	$lobjPdf->Cell(0,7,utf8_decode("Vo Bo CONSEJO DE VIGILANCIA"),"LR",1,"C");
	$lobjPdf->setX(160);
	$lobjPdf->Cell(0,20,utf8_decode(""),"LBR",1,"C");


	$lobjPdf->SetTextColor(0);
	$lobjPdf->OutPut();
?>