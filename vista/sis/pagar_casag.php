<?php

@include_once('../../modelo/MPgsql.php');

echo 'Casa -> '.$_POST['casa'].' ano -> '.$_POST['ano'].' Mes -> '.$_POST['mes'];

echo '<br>';

	foreach ($_POST['cedula'] as $posi => $valor) {
		# code...

	/*	$dbv=new CModeloDatos;
		$sqlv="update cappiutep.t_compra set descontado='".$_POST['descontado'][$posi]."' where id_compra='".$valor."' ";

		if($dbv->ejecutar($sqlv)){
			//include('genera_csvcasa.php');
			echo '<script>


				alert("Operacion Realizada Correctamente");
				close();
			</script>';
		}
*/
		//echo ' Detallle -> '.$valor.' Monto -> '.$_POST['descontado'][$posi].'<br>';

		//echo 'Cedula -> '.$valor.' Descontado -> '.$_POST['descontar'][$posi];

		//echo '<br>';
		$dbv=new CModeloDatos;

		 $sq="insert into cappiutep.t_compra (id_persona,id_casa_comercial,descripcion,monto,estatus,ano,mes,descontado) values('".$valor."','".$_POST['casa']."','ninguna','".$_POST['descontar'][$posi]."','1','".$_POST['ano']."','".$_POST['mes']."','".$_POST['descontar'][$posi]."')";
		if($dbv->ejecutar($sq)){
			//include('genera_csvcasa.php');
			echo '<script>


				alert("Operacion Realizada Correctamente");
				close();
			</script>';
		}

		//echo '<br>';
	}
?>