<?php
session_start();
	
	@include_once("m_reppdf.php");
	 @include_once('../../../../modelo/MPgsql.php');
          $db=new CModeloDatos;
          $db2=new CModeloDatos;

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

$sqls="select * from cappiutep.t_casa_comercial where id_casa_comercial='".$_POST['casa']."'"; 
$ass=$db2->ejecutar($sqls);
$row2=$db2->getArreglo($ass);


  $tip=$row2['descripcion'];

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
    $pdf->Cell(0,5,'DESCUENTO INDIVIDUAL CASA COMERCIAL ',0,1,'C');
    $pdf->Cell(0,5,''.meses($_POST['mes']).' DEL '.$_POST['ano'],0,1,'C');
    $pdf->Ln(10);

    $pdf->Cell(25,5,' ',0,0,'C');
    $pdf->Cell(140,5,utf8_decode(strtoupper($tip)),1,0,'C');
    $pdf->Cell(25,5,'',0,1,'C');

    $pdf->Ln(2);

    $pdf->Cell(25,5,'CEDULA',1,0,'C');
    $pdf->Cell(90,5,'APELLIDOS Y NOMBRES',1,0,'C');
    $pdf->Cell(25,5,'DESCUENTO',1,0,'C');
    $pdf->Cell(25,5,'DESCONTADO',1,0,'C');
    $pdf->Cell(30,5,'DIFERENCIA',1,1,'C');

    foreach ($_POST['cedula'] as $key => $valor) {
      # code...
     
      $pdf->Cell(25,5,''.$valor,1,0,'C');
      $pdf->Cell(90,5,utf8_decode(''.$_POST['datoss'][$key]),1,0,'L');
      $pdf->Cell(25,5,''.$_POST['monto'][$key],1,0,'C');
      $pdf->Cell(25,5,''.$_POST['descontado'][$key],1,0,'R');
      $pdf->Cell(30,5,''.$_POST['dif'][$key],1,1,'R');

      $p1+=$_POST['monto'][$key];
      $p2+=$_POST['descontado'][$key];
      $p3+=$_POST['dif'][$key];
    }
      $pdf->Cell(115,5,'TOTAL',1,0,'C');
      $pdf->Cell(25,5,''.number_format($p1,2),1,0,'C');
      $pdf->Cell(25,5,''.number_format($p2,2),1,0,'R');
      $pdf->Cell(30,5,''.number_format($p3,2),1,1,'R');


    //TIPO DE PROGRAMA
   /* $pdf->SetFont('Arial','BI',9);
    $pdf->Cell(25,5,'Nombre',0,0,'l');
    $pdf->Cell(90,5,''.$_POST['persona'],0,1,'l');

    $pdf->Cell(25,5,'cedula',0,0,'l');
    $pdf->Cell(50,5,''.$_POST['cedula'],0,1,'l');
*/
	


    

	$pdf->Output();


?>
