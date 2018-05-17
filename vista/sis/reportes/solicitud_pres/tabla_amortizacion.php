<?php
session_start();
	
	@include_once("m_reppdf2.php");
	 
$name=strtoupper(utf8_decode("ASOCIACION DE EMPLEADOS DEL MUNICIPIO PASTAZA "));

	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage("P","Letter");

	$pdf->Ln(4);

	//Arial bold Italica 6
    $pdf->SetFont('Arial','BI',10);
    //Titulo del Logo
    $pdf->Cell(0,5,' '.$name,0,1,'C');
    $pdf->Ln(2);
     $pdf->SetFont('Arial','',9);
    $pdf->Cell(0,5,'TABLA DE AMORTIZACION',0,1,'C');
    $pdf->Ln(10);

    if($_POST['bene'] == 1){ $bene=' Fondo Cesantia'; }else{ $bene=' Fondo Comun';}

    $pdf->Cell(20,5,'Socio',1,0,'C');
    $pdf->Cell(100,5,$_POST['nombre'].$bene,1,1,'L');


    $pdf->Ln(4);



    $pdf->Cell(40,5,'Fecha',1,0,'C');
    $pdf->Cell(40,5,'Monto',1,0,'C');
    $pdf->Cell(40,5,'Cuotas',1,1,'C');


    $pdf->Cell(40,5,''.$_POST['fecha'],1,0,'C');
    $pdf->Cell(40,5,$_POST['monto'],1,0,'C');
    $pdf->Cell(40,5,$_POST['cuotas'],1,1,'C');

  $pdf->Ln(10);


    $pdf->Cell(10,5,'',0,0,'C');
    $pdf->Cell(180,5,'DETALLE AMORTIZACION',1,1,'C');

    $pdf->Cell(10,5,'',0,0,'C');
    $pdf->Cell(10,5,'Nro',1,0,'C');
    $pdf->Cell(30,5,utf8_decode('Año'),1,0,'C');
    $pdf->Cell(30,5,'Mes',1,0,'C');
    $pdf->Cell(30,5,'Saldo',1,0,'C');
    $pdf->Cell(30,5,'Cuota',1,0,'C');
    $pdf->Cell(30,5,'Descontado',1,0,'C');
    $pdf->Cell(20,5,'',1,1,'C');


foreach ($_POST['nro'] as $key => $value) {
  # code...

  $pdf->Cell(10,5,'',0,0,'C');
    $pdf->Cell(10,5,$value,1,0,'C');
    $pdf->Cell(30,5,$_POST['ano'][$key],1,0,'C');
    $pdf->Cell(30,5,$_POST['mes'][$key],1,0,'C');
    $pdf->Cell(30,5,$_POST['saldo'][$key],1,0,'C');
    $pdf->Cell(30,5,$_POST['pago'][$key],1,0,'C');
    $pdf->Cell(30,5,$_POST['descontado'][$key],1,0,'C');
    $pdf->Cell(20,5,$_POST['image'][$key],1,1,'C');

}





    
	$pdf->Output();


?>
