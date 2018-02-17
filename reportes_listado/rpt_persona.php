<?php 
	session_start();
	require_once("../modelo/clst_persona.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_persona=new clst_persona;
	$laMatriz=$objt_persona->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_personas"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("nacionalidad"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("cedula"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("nombre1"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("nombre2"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("apellido1"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("apellido2"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_nacimiento"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("sexo"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("direccion"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estado_civil"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("cod_telf_movil"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("telf_movil"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("cod_tel_oficina"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("telf_oficina"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("cod_telf_fijo"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("telf_fijo"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_condicion"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_sede"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("email"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_ciudad"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("id_parroquia"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("estatus"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("tipo_docente"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("categ_docente"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("dedic_docente"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("salario"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("fecha_ini_docente"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["nacionalidad"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["cedula"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["nombre1"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["nombre2"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["apellido1"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["apellido2"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_nacimiento"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["sexo"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["direccion"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estado_civil"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["cod_telf_movil"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["telf_movil"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["cod_tel_oficina"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["telf_oficina"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["cod_telf_fijo"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["telf_fijo"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_condicion"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_sede"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["email"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_ciudad"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["id_parroquia"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["estatus"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["tipo_docente"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["categ_docente"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["dedic_docente"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["salario"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["fecha_ini_docente"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>