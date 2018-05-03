<?php session_start();
	

	//echo '****'; exit();
	@include_once('../modelo/MPgsql.php');
	foreach ($_POST['seleccionado'] as $posi => $valor) {
		# code...

	 	$db=new CModeloDatos;
        $dbf=new CModeloDatos;
        $dbud=new CModeloDatos;
        $dbex=new CModeloDatos;
       
        $sqlultimo="SELECT MAX(id_beneficio_solicitud) AS ulti FROM cappiutep.t_beneficio_solicitud";
		$df=$dbf->ejecutar($sqlultimo); $rowu=$dbf->getArreglo($df);
		$ultimo=$rowu['ulti']+1;

		$sqli="INSERT into cappiutep.t_beneficio_solicitud(id_beneficio_solicitud,id_solicitante,id_beneficio,fecha,monto,cuotas,interes_cuotas,estatus,monto_pago_especial,monto_fiado)
			VALUES('".$ultimo."','".$valor."','".$_POST['tipo'][$posi]."','".date('Y-m-d')."','".$_POST['monto'][$posi]."','".$_POST['Plazo'][$posi]."','".$_POST['interes'][$posi]."','4','0','0')";

		if($db->ejecutar($sqli)){

			$sqlup="UPDATE cappiutep.t_beneficio_solicitud set estatus='5' where id_beneficio_solicitud='".$_POST['bene'][$posi]."' ";
			$dbud->ejecutar($sqlup);

			 $sqlli="INSERT INTO cappiutep.t_detalle_liquid(id_solicitud,monto,forma_pago,ref_pago,observacion,estatus) VALUES('".$ultimo."','".$_POST['monto'][$posi]."','202','0000000','Extencion De Prestamo','1')";
			$dbex->ejecutar($sqlli);

			foreach ($_POST['detalle_mes'.$valor] as $key => $value) {
			# code...
				  $dbdt=new CModeloDatos;

				   $sqldt="INSERT INTO cappiutep.t_detalle_amortizacion(nro,mes,anho,capital,amortizacion,pago,saldo,estatus,id_beneficio_solicitud)
				  		  VALUES('".$_POST['detalle_nro'.$valor][$key]."','".$value."','".$_POST['detalle_anho'.$valor][$key]."','".$_POST['detalle_capital'.$valor][$key]."','".$_POST['detalle_amortizacion'.$valor][$key]."','".$_POST['detalle_pago'.$valor][$key]."','".$_POST['detalle_saldo'.$valor][$key]."','0','".$ultimo."')
				  ";

				  $dbdt->ejecutar($sqldt);
			}

		}else{  } 
	}

	echo '<script> location.href="../vista/sis/deudores.php";  </script>';
	
?>