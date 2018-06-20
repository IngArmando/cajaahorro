<?php
session_start();
	
	@include_once("m_reppdf.php");
	 @include_once('../../../../modelo/MPgsql.php');
          $db=new CModeloDatos;
          $db2=new CModeloDatos;
          $db3=new CModeloDatos;

	function meses($me){

	if($me == 1){ $mes='ENERO'; }
	if($me == 2){ $mes='FEBRERO'; }
	if($me == 3){ $mes='MARZO'; }
	if($me == 4){ $mes='ABRIL'; }
	if($me == 5){ $mes='MAYO'; }
	if($me == 6){ $mes='JUNIO'; }
	if($me == 7){ $mes='JULIO'; }
	if($me == 8){ $mes='AGOSTO'; }
	if($me == 9){ $mes='SEPTIEMBRE'; }
	if($me == 10){ $mes='OBTUBRE'; }
	if($me == 11){ $mes='NOVIEMBRE'; }
	if($me == 12){ $mes='DICIEMBRE'; }

	return $mes;
}



//$name=strtoupper(utf8_decode("ASOCIACION DE EMPLEADOS DEL MUNICIPIO "));
$name=strtoupper(utf8_decode("ASOCIACION DE EMPLEADOS DEL MUCNICIPIO PASTAZA DEL MES DE ".meses($_POST['mes'])." DEL ANO ".$_POST['ano']));
	
	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage("L","Letter");

	$pdf->Ln(4);

	//Arial bold Italica 6
    $pdf->SetFont('Arial','BI',10);
    //Titulo del Logo
    $pdf->Cell(0,5,' '.$name,0,1,'C');
    $pdf->Ln(10);


    $pdf->SetFont('Arial','BI',9);
    $pdf->Cell(10,5,utf8_decode('Nº'),1,0,'C');
    $pdf->Cell(30,5,'DNI'.$_POST['dni'].'*',1,0,'C');
    $pdf->Cell(50,5,'NOMBRES',1,0,'C');
    $pdf->Cell(50,5,'APELLIDOS',1,0,'C');
    $pdf->Cell(30,5,'APORTE',1,0,'C');
    $pdf->Cell(30,5,'INTERES',1,0,'C');
    $pdf->Cell(30,5,'LETRA',1,0,'C');
    $pdf->Cell(30,5,'TOTAL',1,1,'C');

    $pdf->SetFont('Arial','',8);


    foreach ($_POST['cedula'] as $key => $value) {
      # code...

        $sqlap="SELECT * from ";
        $sqls="select * from cappiutep.aporte where ano='".date(Y)."' AND mes='".date(m)."' AND  tipo='1' "; 
        $ass=$db2->ejecutar($sqls);
        $rowa=$db2->getArreglo($ass);

        $sql="
              SELECT * from cappiutep.t_beneficio_solicitud as bn
              inner join cappiutep.t_detalle_amortizacion as dt using(id_beneficio_solicitud)
              where bn.id_solicitante='".$_POST['dn'][$key]."' AND bn.id_beneficio='".$_POST['fondo']."'
              AND dt.mes='".$_POST['mes']."' AND dt.anho='".$_POST['ano']."'
        ";
        //echo $sql; exit(); 
        $rs=$db3->ejecutar($sql);
        $rowdt=$db3->getArreglo($rs);


      $t++;

      $total_lineal= $rowa['aporte'] + $rowdt['amortizacion'] + $rowdt['capital'];

      if($rowdt['amortizacion'] == ''){ $amt=number_format(0,2); }else{ $amt=$rowdt['amortizacion']; }
      if($rowdt['capital'] == ''){ $cap=number_format(0,2); }else{ $cap=$rowdt['capital']; }

      $pdf->Cell(10,5,$t,1,0,'C');
      $pdf->Cell(30,5,$value,1,0,'C');
      $pdf->Cell(50,5,utf8_decode($_POST['nombres'][$key]),1,0,'C');
      $pdf->Cell(50,5,utf8_decode($_POST['apellidos'][$key]),1,0,'C');
      $pdf->Cell(30,5,$rowa['aporte'],1,0,'C');
      $pdf->Cell(30,5,$amt.'',1,0,'C');
      $pdf->Cell(30,5,$cap,1,0,'C');
      $pdf->Cell(30,5,$total_lineal,1,1,'C');

      $totala+=$rowa['aporte'];
      $totalam+=$amt;
      $totalcap+=$cap;
      $totalfin+=$total_lineal;

    }

      $pdf->SetFont('Arial','B',9);
      $pdf->Cell(140,5,'TOTALES',1,0,'R');
      $pdf->Cell(30,5,number_format($totala,2),1,0,'C');
      $pdf->Cell(30,5,$totalam,1,0,'C');
      $pdf->Cell(30,5,$totalcap,1,0,'C');
      $pdf->Cell(30,5,$totalfin,1,1,'C');



    

	$pdf->Output();


?>
