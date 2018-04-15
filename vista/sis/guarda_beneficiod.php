<?php

	 @include_once('../../modelo/MPgsql.php');
          $dbg=new CModeloDatos;

          $descu= $_GET['descu'] + $_GET['montobe'];

          $sqlg="update cappiutep.t_detalle_amortizacion set descontado='".$descu."' ,deposito='".$_GET['montobe']."' where id_detalle_amortizacion='".$_GET['benefi']."' ";
          $dbg->ejecutar($sqlg);
	echo '
		
	';
	


?>
