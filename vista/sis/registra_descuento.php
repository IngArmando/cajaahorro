<?php
	@include_once('../../modelo/MPgsql.php');
          $dbi=new CModeloDatos;

          $sqlii="update cappiutep.t_detalle_amortizacion set descontado='".$_GET['datoi']."' where id_detalle_amortizacion='".$_GET['mt']."' ";

          if($dbi->ejecutar($sqlii)){

          	echo '<script>
          		//alert("'.$_GET['datoi'].'");
          	</script>';
          }
?>