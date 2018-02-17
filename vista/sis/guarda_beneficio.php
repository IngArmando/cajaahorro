<?php

	 @include_once('../../modelo/MPgsql.php');
          $dbg=new CModeloDatos;

          $sqlg="update cappiutep.t_detalle_amortizacion set descontado='".$_GET['montobe']."' where id_detalle_amortizacion='".$_GET['benefi']."' ";
          $dbg->ejecutar($sqlg);
	echo '
		
	';
	


?>
