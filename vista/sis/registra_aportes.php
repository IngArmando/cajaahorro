
<?php

	@include_once('../../modelo/MPgsql.php');
          $dbi=new CModeloDatos;

          


           $sqlii="update cappiutep.conf_aporte set porcentajec='".$_GET['pc']."' where cod_confiaporte='".$_GET['cod']."' ";

          if($dbi->ejecutar($sqlii)){

          	
          }
          
?>