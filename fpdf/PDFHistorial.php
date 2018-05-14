<?php

	include("fpdf.php");
	include("clsFpdf.php");

	include_once("../modelo/MSocio.php");
    $OSocio = new Socio();

	include_once("../modelo/MReportes.php");
    $ORep = new Reporte();

 	if (isset($_SESSION["userActivo"])){
      $OSocio -> setCedula($_SESSION["userActivo"]);
      $registro=$OSocio -> busCedulaDetalle();
      while ( $fila = $OSocio->setArreglo( $registro ))
          $datos[] = $fila;
      foreach ($datos as $Soc) { $Soc; }
    }

    $desde2=date('Y-m-d',strtotime(str_replace('/', '-', $_POST['Desde'] )));
    $hasta2=date('Y-m-d',strtotime(str_replace('/', '-', $_POST['Hasta'] )));

    $historia= $ORep->historial($Soc['id_persona_caja'],$desde2,$hasta2,$_POST['Beneficio'],$_POST['Estatus']);

	$lobjPdf=new clsFpdf();
	$lobjPdf->AliasNbPages();//conteo de paginas
	$lobjPdf->AddPage("P","Letter");//p vertical o l horizontal
	$lobjPdf->SetFont("arial","I",14);// estilo de letra
	$lobjPdf->Ln(3);
	$lobjPdf->Cell(0,6,utf8_decode("Historial de Solicitudes"),0,1,"C");//titulo del pdf
	$lobjPdf->Ln(5);
	$lobjPdf->SetFont("arial","",12);// estilo de letra
	$lobjPdf->Cell(0,6,utf8_decode("Socio"),0,1,"L");//titulo del pdf
	
	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->Cell(80,7,utf8_decode("Nombre y Apellido"),"LTR",0,"L");
	$lobjPdf->Cell(50,7,utf8_decode("C.I. Nº"),"LTR",0,"L");
	$lobjPdf->Cell(0,7,utf8_decode("Fecha de Ingreso"),"LTR",1,"L");
	$lobjPdf->SetFont("arial","",11);
	$lobjPdf->Cell(80,7,utf8_decode($Soc['nombre1']." ".$Soc['nombre2']." ".$Soc['apellido1']." ".$Soc['apellido2']),"LBR",0,"L");
	$lobjPdf->Cell(50,7,utf8_decode($Soc['cedula']),"LBR",0,"C");
	$lobjPdf->Cell(0,7,utf8_decode($OSocio->set_fecha($Soc['fechaafi'])),"LBR",1,"C");
	$lobjPdf->SetFont("arial","",11);

	$lobjPdf->Ln(3);

	$lobjPdf->SetFont("arial","B",10);
	$lobjPdf->setFillColor(39,98,176);
	$lobjPdf->SetTextColor(255);
	$lobjPdf->Cell(25,8,utf8_decode("N° Solicitud"),1,0,"C",true);
	$lobjPdf->Cell(25,8,utf8_decode("Fecha"),1,0,"C",true);
	$lobjPdf->Cell(35,8,utf8_decode("Monto Solicitado"),1,0,"C",true);
	$lobjPdf->Cell(65,8,utf8_decode("Beneficio"),1,0,"C",true);
	$lobjPdf->Cell(0,8,utf8_decode("Estatus"),1,1,"C",true);
	$lobjPdf->SetFont("arial","",9);
	$lobjPdf->SetTextColor(0);

	if ($historia==NULL) 
	{
		$lobjPdf->Cell(0,8,'No se encontraron resultados.',1,0,'C');
	}
	else
	{
		foreach ($historia as $Lista) {
			switch ($Lista['solestatus']) {
				case '1':
					$estado='En análisis';
					break;
				case '2':
					$estado='Esperando aprobación';
					break;
				case '3':
					$estado='Aprobado';
					break;
				case '4':
					$estado='Liquidado';
					break;
				case '5':
					$estado='Pagado';
					break;
				case '6':
					$estado='Rechazado (Junta Dir.)';
					break;
			}
			$lobjPdf->Cell(25,8,$OSocio->set_fecha($Lista['id_beneficio_solicitud']),1,0,'C');
			$lobjPdf->Cell(25,8,$OSocio->set_fecha($Lista['fecha']),1,0,'C');
			$lobjPdf->Cell(35,8,"Bs. ".number_format($Lista['monto'], 2, ',', '.'),1,0,'C');
			$lobjPdf->Cell(65,8,utf8_decode($Lista['tipo']),1,0,'C');
			$lobjPdf->Cell(0,8, utf8_decode($estado),1,1,'C');

			$lobjPdf->SetFont("arial","B",10);
			$lobjPdf->SetTextColor(255);
			$lobjPdf->Cell(196,8, utf8_decode('Tabla de Amortizacion'),1,1,'C',true);

			$lobjPdf->SetFont("arial","B",8);

			$lobjPdf->Cell(43,8,'xxxx',0,0,'C');
			$lobjPdf->Cell(10,8, utf8_decode('Nº'),1,0,'C',true);
			$lobjPdf->Cell(15,8, utf8_decode('Mes'),1,0,'C',true);
			$lobjPdf->Cell(15,8, utf8_decode('Año'),1,0,'C',true);
			$lobjPdf->Cell(20,8, utf8_decode('Cuota'),1,0,'C',true);
			$lobjPdf->Cell(20,8, utf8_decode('Descontado'),1,0,'C',true);
			$lobjPdf->Cell(20,8, utf8_decode('Estatus'),1,0,'C',true);


		}
	}

	

	$lobjPdf->SetTextColor(0);
	$lobjPdf->OutPut();
?>