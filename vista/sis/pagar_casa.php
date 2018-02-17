<?php

@include_once('../../modelo/MPgsql.php');

	foreach ($_POST['compra'] as $posi => $valor) {
		# code...

		$dbv=new CModeloDatos;
		$sqlv="update cappiutep.t_compra set descontado='".$_POST['descontado'][$posi]."' where id_compra='".$valor."' ";

		if($dbv->ejecutar($sqlv)){
			//include('genera_csvcasa.php');
			echo '<script>


				alert("Operacion Realizada Correctamente");
				close();
			</script>';
		}

		//echo ' Detallle -> '.$valor.' Monto -> '.$_POST['descontado'][$posi].'<br>';
	}
?>