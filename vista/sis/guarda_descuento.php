<?php
	 @include_once('../../modelo/MPgsql.php');
          $dbg=new CModeloDatos;

          $sqlg="update cappiutep.t_compra set descontado='".$_GET['monto']."' where id_compra='".$_GET['casas']."' ";
          $dbg->ejecutar($sqlg);
	echo '
		
	';
?>
