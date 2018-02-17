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

	//Arial bold Italica 6
    $pdf->SetFont('Arial','BI',10);
    //Titulo del Logo
    $pdf->Cell(0,5,' '.$name,0,1,'C');
    $pdf->Cell(0,5,'CONFIDENCIAL - '.meses($_POST['mes']).' Del '.$_POST['ano'],0,1,'C');
    $pdf->Ln(10);

    //TIPO DE PROGRAMA
    $pdf->SetFont('Arial','BI',9);
    $pdf->Cell(25,5,'Nombre',0,0,'l');
    $pdf->Cell(90,5,''.$_POST['persona'],0,1,'l');

    $pdf->Cell(25,5,'cedula',0,0,'l');
    $pdf->Cell(50,5,''.$_POST['cedula'],0,1,'l');

	$pdf->Ln(4);


    $pdf->Cell(70,5,'Casa Comercial',0,0,'l');
    $pdf->Cell(40,5,'Credito',0,0,'l');
    $pdf->Cell(40,5,'Pagado',0,0,'l');
    $pdf->Cell(40,5,'Saldo',0,1,'l');


    $dbd1=new CModeloDatos;

             $sqla="SELECT *,ap.aporte as aporte_a 
            from cappiutep.aporte as ap
                   inner join cappiutep.t_persona as tpe on tpe.id_persona = ap.id_persona
                   where ap.id_persona=".$_POST['dni']." AND ap.ano='".$_POST['ano']."' AND ap.mes='".$_POST['mes']."' ";

                   $apo=$dbd1->ejecutar($sqla);

                   while ($rowap=$dbd1->getArreglo($apo)) {
                     # code...
                    $app++;
                    if($rowap['tipo'] == 2){ $tip="Fondo Comun"; }else{ $tip="Cesantia"; }

                    if($rowap['aportado'] == ''){
                      $descontado=0;
                      $lit='';
                    }else{
                      $descontado=$rowap['aportado'];
                      
                      $lit='readonly';
                    }

                      $dif=$rowap['aporte_a'] - $descontado;

                    $pdf->Cell(70,5,strtoupper('Aporte Fondo: '.utf8_decode($tip)),1,0,'l');
                    $pdf->Cell(40,5,''.$rowap['aporte_a'],1,0,'l');
                    $pdf->Cell(40,5,''.number_format($descontado,2),1,0,'l');
                    $pdf->Cell(40,5,''.number_format($dif,2),1,1,'l');

                    $totales+=$rowap['aporte_a'];
                    $pagado+=$descontado;

                    
                   }

    $dbd=new CModeloDatos;

                $sqld="SELECT *
                FROM cappiutep.t_compra AS b
                INNER JOIN cappiutep.t_casa_comercial AS tp ON tp.id_casa_comercial=b.id_casa_comercial
                WHERE b.id_persona=".$_POST['dni']." and b.ano='".$_POST['ano']."' and b.mes='".$_POST['mes']."' "; 

                $assd=$dbd->ejecutar($sqld);

                 while ($rowd=$dbd->getArreglo($assd)) {
                	# code...

                	if($rowd['descontado'] == ''){

                      $descontado= 0;
                      $dif= $rowd['monto'] - $rowd['descontado']; 
                      
                    }else{
                      $descontado= $rowd['descontado'];
                      $dif= $rowd['monto'] - $rowd['descontado'];
                     
                    }

                    $totales+=$rowd['monto'];
                    $pagado+=$descontado;

                	    $pdf->Cell(70,5,''.utf8_decode($rowd['descripcion']),1,0,'l');
					    $pdf->Cell(40,5,''.$rowd['monto'],1,0,'l');
					    $pdf->Cell(40,5,''.number_format($descontado,2),1,0,'l');
					    $pdf->Cell(40,5,''.number_format($dif,2),1,1,'l');
                }


                   $dbde=new CModeloDatos;

             $sqlde="SELECT *
          FROM cappiutep.t_beneficio_solicitud AS b
          INNER JOIN cappiutep.t_persona_caja AS tpc ON tpc.id_persona=b.id_solicitante
          INNER JOIN cappiutep.t_persona AS tp ON tp.id_persona=tpc.id_persona
          INNER JOIN cappiutep.t_detalle_amortizacion AS amt ON amt.id_beneficio_solicitud=b.id_beneficio_solicitud
          INNER JOIN cappiutep.t_beneficio AS tb ON tb.id_beneficio=b.id_beneficio
          WHERE b.id_solicitante=".$_POST['dni']." and amt.anho='".$_POST['ano']."' and amt.mes='".$_POST['mes']."' "; 

                $assde=$dbde->ejecutar($sqlde);

                  while ($rowde=$dbde->getArreglo($assde)) {
                    # code...

                     $bene++;

                    if($rowde['descontado'] == ''){

                      $descontadobe= 0;
                      $difbe= $rowde['pago'] - $rowde['descontado']; 
                      $genebe='onclick="limpia('.$bene.')"';
                      $listobe='';
                    }else{
                      $descontadobe= $rowde['descontado'];
                      $difbe= $rowde['pago'] - $rowde['descontado'];
                      $genebe='';
                      $listobe='readonly';


                    } 

                    	$totales+=$rowde['pago'];
                    	$pagado+=$descontadobe;

                    	$pdf->Cell(70,5,''.utf8_decode($rowde['nombre']),1,0,'l');
					    $pdf->Cell(40,5,''.$rowde['pago'],1,0,'l');
					    $pdf->Cell(40,5,''.number_format($descontadobe,2),1,0,'l');
					    $pdf->Cell(40,5,''.number_format($difbe,2),1,1,'l');
                   
                  }

	$pdf->Ln(20);

			$saldo=$totales - $pagado;

                    	$pdf->Cell(120,5,'Resumen',0,0,'l');
                    	$pdf->Cell(70,5,'BLAB',0,1,'C');

                    	$pdf->Cell(100,5,'CREDITO',0,0,'l');
                    	$pdf->Cell(20,5,''.$totales,0,1,'l');

                    	$pdf->Cell(100,5,'SUDENCION ESTE MES',0,0,'l');
                    	$pdf->Cell(20,5,'0.00',0,1,'l');

                    	$pdf->Cell(100,5,'DEPOSITO',0,0,'l');
                    	$pdf->Cell(20,5,'0.00',0,1,'l');

                    	$pdf->Cell(120,5,'',0,0,'R');
                    	$pdf->Cell(70,5,''.$_SESSION['usuarios_socio'],0,1,'C');
                    	$pdf->Cell(120,5,'',0,0,'C');

                    	$pdf->Cell(70,5,'TESORERO',0,1,'C');


                    	$pdf->Cell(100,5,'PAGADO',0,0,'l');
                    	$pdf->Cell(20,5,''.number_format($pagado,2),0,1,'l');

                    	$pdf->Cell(100,5,'SALDO',0,0,'l');
                    	$pdf->Cell(20,5,''.number_format($saldo,2),0,1,'l');


  

    

	$pdf->Output();


?>
