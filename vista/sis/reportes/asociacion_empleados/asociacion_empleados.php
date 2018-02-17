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

 $sqls="select * from cappiutep.t_beneficio where id_beneficio='".$_GET['cod']."' "; 
$ass=$db2->ejecutar($sqls);
$row2=$db2->getArreglo($ass);

$name=strtoupper(utf8_decode("ASOCIACION DE EMPLEADOS DEL MUNICIPIO "));
//$name=strtoupper(utf8_decode("ASOCIACION DE EMPLEADOS DEL MUCNICIPIO ".$row2['nombre']." DEL MES DE ".meses($_GET['me'])." DEL ANO ".$_GET['ano']));
	
	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage("P","Letter");

	$pdf->Ln(4);

  $mes = $_GET['mes'];
  $ano = $_GET['ano'];

  /*$ano = '2017';
  $mes = 12;*/

	//Arial bold Italica 6
    $pdf->SetFont('Arial','BI',10);
    //Titulo del Logo
    $pdf->Cell(0,5,' '.$name,0,1,'C');
    $pdf->Cell(0,5,'Comisiones - '.meses($mes).' del '.$ano,0,1,'C');
    $pdf->Ln(10);

    //TIPO DE PROGRAMA
    $pdf->SetFont('Arial','BI',9);
    $pdf->Cell(20,5,'No.',1,0,'C');
    $pdf->Cell(80,5,'Casa Comercial',1,0,'C');
    $pdf->Cell(30,5,'Total',1,0,'C');
    $pdf->Cell(30,5, utf8_decode( 'Comisión' ) ,1,0,'C');
    $pdf->Cell(30,5, utf8_decode( 'V. Comisión.' ) ,1,1,'C');

    $pdf->SetFont('Arial','',9);

    $dbd=new CModeloDatos;

    $sqld="SELECT DISTINCT ON(b.id_casa_comercial) b.id_casa_comercial, b.monto, a.descripcion AS casa_comercial, a.tipo_comision, a.comision 
      FROM cappiutep.t_compra AS b 
      INNER JOIN cappiutep.t_casa_comercial AS a ON a.id_casa_comercial = b.id_casa_comercial 
      WHERE b.ano = '$ano' AND b.mes = $mes";

    $assd=$dbd->ejecutar($sqld);
    $cont = 1;
    while ($rowd=$dbd->getArreglo($assd)) {
    	$pdf->Cell(20,5, $cont ++ ,1,0,'C');
      $pdf->Cell(80,5, utf8_decode( $rowd['casa_comercial'] ) ,1,0,'C');


        $sql_datos = "SELECT monto
          FROM cappiutep.t_compra 
          WHERE ano = '$ano' AND mes = $mes AND id_casa_comercial = $rowd[id_casa_comercial]";

        $datos = $dbd->ejecutar($sql_datos);
        $monto = 0;
        while ( $row_datos = $dbd->getArreglo( $datos ) )
        {
          $monto += $row_datos['monto'];
        }

      if ( $rowd['tipo_comision'] == '1' )
      {
        //$monto = ( $monto + $rowd['comision'] );
        $pdf->Cell(30,5, number_format( $monto , 2 , ',' , '.' ) ,1,0,'C');
        $pdf->Cell(30,5, '$' . number_format( $rowd['comision'] , 2 , ',' , '.' ) ,1,0,'C');
        $pdf->Cell(30,5, number_format( $rowd['comision'] , 2 , ',' , '.' ) ,1,1,'C');
        $comision_total += $rowd['comision'];
      }
      else
      {
        $comision = ( $monto * $rowd['comision'] ) / 100;
        //$monto = ( $monto + $comision );
        $pdf->Cell(30,5, number_format( $monto , 2 , ',' , '.' ) ,1,0,'C');
        $pdf->Cell(30,5, number_format( $rowd['comision'] , 2 , ',' , '.' ) . '%' ,1,0,'C');
        $pdf->Cell(30,5, number_format( $comision , 2 , ',' , '.' ) ,1,1,'C');
        $comision_total += $comision;
      }

      $monto_total += $monto;
    }

  $pdf->Cell(100,5, 'TOTALES' ,1,0,'C');
  $pdf->Cell(30,5, number_format( $monto_total , 2 , ',' , '.' ) ,1,0,'C');
  $pdf->Cell(30,5,'',1,0,'C');
  $pdf->Cell(30,5, number_format( $comision_total , 2 , ',' , '.' ) ,1,1,'C');   

	$pdf->Output();


?>
