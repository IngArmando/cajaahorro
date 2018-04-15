<?php
	 @include_once('../../modelo/MPgsql.php');
          $dbg=new CModeloDatos;
          $dbg1=new CModeloDatos;
          $dbg2=new CModeloDatos;

          $desc= $_GET['des'] + $_GET['monto']; 
           $sqlg="update cappiutep.aporte set aportado='".$desc."'  , estatus='1',deposito='".$_GET['monto']."' where cod_aporte='".$_GET['casas']."' ";
           $dbg->ejecutar($sqlg);

          $tf="SELECT * FROM cappiutep.t_haberes WHERE id_persona = '".$_GET['id']."' order by (fecha_cierre,id_haberes) desc limit 1"; 
          $atf=$dbg1->ejecutar($tf);
          $rowtf=$dbg1->getArreglo($atf);

          $ope=$rowtf['saldo'] + $_GET['monto']; 

          $sqlha="insert into cappiutep.t_haberes(id_persona,saldo,saldo_bloq_prestamo,saldo_bloq_fianza,fecha_cierre) values('".$_GET['id']."','".$ope."','".$rowtf['saldo_bloq_prestamo']."','".$rowtf['saldo_bloq_fianza']."','".date('Y-m-d')."')";

          $tt=$dbg2->ejecutar($sqlha);
          

	echo '
	
	';
?>
