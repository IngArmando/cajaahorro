<?php  


  @include_once('../../modelo/MPgsql.php');
          $db=new CModeloDatos;
$csv_end = "
";
$csv_sep = ";";
//$csv_file = "layout_solicitud.csv";  
$csv="";



echo 'hola mundo';

exit();
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
	$name="DESCUENTO DEL MES DE ".meses($_GET['me'])." DEL ANO ".$_GET['ano'];
	$sql="SELECT *
          FROM cappiutep.t_beneficio_solicitud AS b
          INNER JOIN cappiutep.t_persona_caja AS tpc ON tpc.id_persona=b.id_solicitante
          INNER JOIN cappiutep.t_persona AS tp ON tp.id_persona=tpc.id_persona
          INNER JOIN cappiutep.t_detalle_amortizacion AS amt ON amt.id_beneficio_solicitud=b.id_beneficio_solicitud
          WHERE b.id_beneficio=".$_GET['cod']." and amt.anho='".$_GET['ano']."' and amt.mes='".$_GET['me']."'";

          $as=$db->ejecutar($sql);

           $csv.=" ".$csv_end;

           $csv.=$csv_sep.$csv_sep.$csv_sep.$csv_sep.$csv_sep."LISTADO DE DESCUENTO DEL MES DE ".meses($_GET['me'])." DEL ANO ".$_GET['ano'].$csv_end;
           $csv.=" ".$csv_end;


           $csv.="DNI  ".$csv_sep."   NOMBRES     ".$csv_sep."    APELLIDOS      ".$csv_sep."CUOTA".$csv_sep."DESCUENTO".$csv_sep."DIFERENCIA".$csv_sep.$csv_end;

          while ($row=$db->getArreglo($as)) {

          	$dni++;
            $dif=$row['pago'] - $row['descontado'];
            //$csv.="a".$csv_sep."b".$csv_sep."c".$csv_sep.$csv_end;
          	 $csv.=$row['cedula'].$csv_sep.$row['nombre1'].' '.$row['nombre2'].$csv_sep.$row['apellido1'].' '.$row['apellido2'].$csv_sep.$row['pago'].$csv_sep.$row['descontado'].$csv_sep.$dif.$csv_sep.$csv_end;
    

}

//Generamos el csv de todos los datos  
header("Content-Description: File Transfer");
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=".$name.".csv"); 
echo $csv;

?>  