<?php 
	session_start();
	require_once("../modelo/clst_configuracion.php");
	require_once("clsFpdf.php");
	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas 
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",18);// estilo de letra
	$objt_configuracion=new clst_configuracion;
	$laMatriz=$objt_configuracion->listar();
	$lobjPdf->Cell(0,6,utf8_decode("t_configuracions"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(10);
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(25,6,utf8_decode("vision"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("historia"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("clave_long_min"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("clave_long_max"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("clave_intentos_fallidos"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("clave_dias_caducidad"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("clave_dias_antes"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("clave_dif_anterior"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("clave_mayus"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("clave_minus"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("clave_caracteres"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("clave_caracteres_validos"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("preguntas_cant"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("sesion_min_expira"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("sesion_min_antes"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("porcentaje_patrono"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("porcentaje_socio"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("porcentaje_descuento_min"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("porcentaje_descuento_max"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("num_min_noches"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("num_max_noches"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("num_min_acompañantes"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("num_max_acompañantes"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("num_min_beneficiarios"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("num_max_beneficiarios"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("not_correo"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("not_telf"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("clave_num"),1,0,"C"); 
	$lobjPdf->Cell(25,6,utf8_decode("max_sesiones_abiertas"),1,1,"C"); 
	$liI=0;
	while ($laMatriz[$liI][0]!=null){
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["vision"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["historia"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["clave_long_min"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["clave_long_max"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["clave_intentos_fallidos"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["clave_dias_caducidad"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["clave_dias_antes"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["clave_dif_anterior"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["clave_mayus"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["clave_minus"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["clave_caracteres"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["clave_caracteres_validos"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["preguntas_cant"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["sesion_min_expira"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["sesion_min_antes"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["porcentaje_patrono"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["porcentaje_socio"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["porcentaje_descuento_min"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["porcentaje_descuento_max"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["num_min_noches"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["num_max_noches"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["num_min_acompañantes"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["num_max_acompañantes"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["num_min_beneficiarios"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["num_max_beneficiarios"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["not_correo"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["not_telf"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["clave_num"]),1,0,"C");
		$lobjPdf->Cell(25,6,utf8_decode($laMatriz[$liI]["max_sesiones_abiertas"]),1,1,"C");
		$liI++;
	}
	$lobjPdf->OutPut();

?>