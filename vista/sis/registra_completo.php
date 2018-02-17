<?php

	@include_once('../../modelo/MPgsql.php');
          

	foreach ($_POST['cod_detalle'] as $posi => $valor) {
		# code...
		$dbin=new CModeloDatos;
		$sqliin="update cappiutep.t_detalle_amortizacion set descontado='".$_POST['descontado'][$posi]."' where id_detalle_amortizacion='".$valor."' ";

          $dbin->ejecutar($sqliin);

		//echo '-> '.$valor.' Descontado -> '.$_POST['descontado'][$posi].'<br>';
          echo '<script>


				alert("Operacion Realizada Correctamente");
				close();
			</script>';
	}
?>