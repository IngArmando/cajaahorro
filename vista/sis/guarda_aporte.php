<?php
	 @include_once('../../modelo/MPgsql.php');
          $dbg=new CModeloDatos;
          $dbg1=new CModeloDatos;

           $sqlg="update cappiutep.aporte set estatus='1',aportado='".$_GET['monto']."' where cod_aporte='".$_GET['casas']."' ";
          $dbg->ejecutar($sqlg);

          $tf="SELECT * FROM cappiutep.t_haberes WHERE id_persona = '".$_GET['id']."' order by fecha_cierre desc limit 1";
          $atf=$dbg1->ejecutar($tf);
          $rowtf=$dbg1->getArreglo($atf);
          

	echo '
		
	';
?>
