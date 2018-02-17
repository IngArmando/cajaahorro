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

$sqls="select * from cappiutep.t_tipo_persona where id_tipo_persona='".$_POST['tipo']."' "; 
$ass=$db2->ejecutar($sqls);
$row2=$db2->getArreglo($ass);

if($_POST['tipo'] == 'T'){
  $tip='PERSONAL EN GENERAL';
}else{
  $tip='PERSONAL A '.$row2['nombre'];
}

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
    $pdf->Cell(0,5,'TOTAL DESCUENTOS DEL PERSONAL',0,1,'C');
    $pdf->Cell(0,5,''.meses($_POST['mes']).' DEL '.$_POST['ano'],0,1,'C');
    $pdf->Ln(10);

    $pdf->Cell(25,5,' ',0,0,'C');
    $pdf->Cell(140,5,utf8_decode(strtoupper($tip)),1,0,'C');
    $pdf->Cell(25,5,'',0,1,'C');

    $pdf->Ln(2);

    $pdf->Cell(25,5,'CEDULA',1,0,'C');
    $pdf->Cell(115,5,'APELLIDOS Y NOMBRES',1,0,'C');
    $pdf->Cell(25,5,'VALOR. DESC',1,0,'C');
    $pdf->Cell(25,5,'TOTAL. DESC',1,1,'C');

    foreach ($_POST['cedula'] as $key => $valor) {
      # code...
      $pdf->Cell(25,5,''.$valor,1,0,'C');
      $pdf->Cell(115,5,utf8_decode(''.$_POST['datoss'][$key]),1,0,'L');
      $pdf->Cell(25,5,''.$_POST['descontado'][$key],1,0,'C');
      $pdf->Cell(25,5,''.$_POST['descuento'][$key],1,1,'C');
      $td+=$_POST['descontado'][$key];
      $tdc+=$_POST['descuento'][$key];
    }

      $pdf->Cell(140,5,'TOTAL',1,0,'C');
      $pdf->Cell(25,5,''.$td,1,0,'C');
      $pdf->Cell(25,5,''.$tdc,1,1,'C');




    //TIPO DE PROGRAMA
   /* $pdf->SetFont('Arial','BI',9);
    $pdf->Cell(25,5,'Nombre',0,0,'l');
    $pdf->Cell(90,5,''.$_POST['persona'],0,1,'l');

    $pdf->Cell(25,5,'cedula',0,0,'l');
    $pdf->Cell(50,5,''.$_POST['cedula'],0,1,'l');
*/
	


    

	$pdf->Output();


?>
