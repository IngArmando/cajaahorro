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

 $sqls="select * from cappiutep.t_casa_comercial where id_casa_comercial='".$_GET['cod']."' "; 
$ass=$db2->ejecutar($sqls);
$row2=$db2->getArreglo($ass);

$name=strtoupper(utf8_decode("LISTADO DE DESCUENTO CASA COMERCIAL (".$row2['descripcion'].")  DEL MES DE ".meses($_GET['me'])." DEL ANO ".$_GET['ano']));
	
	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage("L","Letter");

	$pdf->Ln(4);

	//Arial bold Italica 6
    $pdf->SetFont('Arial','BI',10);
    //Titulo del Logo
    $pdf->Cell(0,1,' '.$name,0,1,'C');
    $pdf->Ln(10);

    //TIPO DE PROGRAMA
    $pdf->SetFont('Arial','BI',9);
    $pdf->Cell(25,5,'DNI',1,0,'l');
    $pdf->Cell(60,5,'NOMBRES',1,0,'l');
    $pdf->Cell(60,5,'APELLIDOS',1,0,'l');
    $pdf->Cell(30,5,'CUOTA',1,0,'l');
    $pdf->Cell(40,5,'DESCUENTO',1,0,'l');
    $pdf->Cell(40,5,'DIFERENCIA',1,1,'l');

    $sql="SELECT *
          FROM cappiutep.t_compra AS b
          INNER JOIN cappiutep.t_persona AS tp ON tp.id_persona=b.id_persona
          WHERE b.id_casa_comercial=".$_GET['cod']." and b.ano='".$_GET['ano']."' and b.mes='".$_GET['me']."' AND tp.id_tipo_persona='".$_GET['tipo']."'";

          $as=$db->ejecutar($sql);

          while ($row=$db->getArreglo($as)) {

          	$dni++;
            $dif=$row['monto'] - $row['descontado'];

            $pdf->Cell(25,5,''.$row['cedula'],1,0,'l');
		    $pdf->Cell(60,5,''.utf8_decode($row['nombre1'].' '.$row['nombre2']),1,0,'L');
		    $pdf->Cell(60,5,''.utf8_decode($row['apellido1'].' '.$row['apellido2']),1,0,'L');
		    $pdf->Cell(30,5,''.$row['monto'],1,0,'C');
		    $pdf->Cell(40,5,''.number_format($row['descontado'],2),1,0,'C');
		    $pdf->Cell(40,5,''.number_format($dif,2),1,1,'C');

		    $total_cuota+=$row['monto'];
		    $total_descontado+=$row['descontado'];
		    $total_dif+=$dif;

        }


		    $pdf->Cell(255,5,'',1,1,'R');

		    $pdf->Cell(145,5,'TOTAL',1,0,'C');
		    $pdf->Cell(30,5,''.number_format($total_cuota,2),1,0,'C');
		    $pdf->Cell(40,5,''.number_format($total_descontado,2),1,0,'C');
		    $pdf->Cell(40,5,''.number_format($total_dif,2),1,1,'C');



	$pdf->Output();


?>
