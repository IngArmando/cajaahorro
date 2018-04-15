<?php
	 @include_once('../../modelo/MPgsql.php');
      

          function corre_socios(){

         	$dbl=new CModeloDatos;
          $dbl2=new CModeloDatos;
          $dbl3=new CModeloDatos;
          $dbl4=new CModeloDatos;

          		$sqll="select id_persona,fcomun,fcesantia from cappiutep.t_persona where fcomun='1' or fcesantia='1' ";

          $asl=$dbl->ejecutar($sqll);
          while ($rowll=$dbl->getArreglo($asl)) {

          	
          	

          	if($rowll['fcomun'] == 1){

          		 $sqll2="select * from cappiutep.conf_aporte where id_persona='".$rowll['id_persona']."' AND tipoc='2'";

          		$asl2=$dbl2->ejecutar($sqll2);
          		if($rowll2=$dbl2->getArreglo($asl2)){

          			
          		}else{
          			 $sql4="select * from cappiutep.t_beneficio where id_beneficio='2'";
          			$re=$dbl4->ejecutar($sql4); $rowb=$dbl4->getArreglo($re);
          			
          		  $sqll3="insert into cappiutep.conf_aporte(id_persona,tipoc,porcentajec,estatus) values('".$rowll['id_persona']."','2','".$rowb['valorp']."','1')";
          			$dbl3->ejecutar($sqll3);
          		}

          	}

          	if($rowll['fcesantia'] == 1){

          		$sqll2="select * from cappiutep.conf_aporte where id_persona='".$rowll['id_persona']."' AND tipoc='1'";

          		$asl2=$dbl2->ejecutar($sqll2);
          		if($rowll2=$dbl2->getArreglo($asl2)){

          		
          		}else{

          			 $sql4="select * from cappiutep.t_beneficio where id_beneficio='1'";
          			$re=$dbl4->ejecutar($sql4); $rowb=$dbl4->getArreglo($re);
          			
          		  $sqll3="insert into cappiutep.conf_aporte(id_persona,tipoc,porcentajec,estatus) values('".$rowll['id_persona']."','1','".$rowb['valorp']."','1')";
          		
          		$dbl3->ejecutar($sqll3);
          		}

          	}
          }
      }

      function aportes_mensuales(){

      	$obj=new CModeloDatos;
      	$obj1=new CModeloDatos;
      	$obj2=new CModeloDatos;
      	$obj3=new CModeloDatos;

      	$sqlaporte="select * from cappiutep.conf_aporte";
      	$resap=$obj->ejecutar($sqlaporte);
      	echo '<br>';
      	while ($rowapo=$obj->getArreglo($resap)) {
      		# code...

      		if($rowapo['tipoc'] == 1){

      			$sq1="select * from cappiutep.t_beneficio where id_beneficio='1'";
        		$res=$obj3->ejecutar($sq1); $rowo=$obj3->getArreglo($res);

        		$sb=$rowo['sueldo_base'];

        		 $op=($sb * $rowapo['porcentajec']) / 100;



        		 $sqlha="insert into cappiutep.aporte(id_persona,tipo,ano,mes,aporte,sb,porcentaje,estatus) values('".$rowapo['id_persona']."', '1' ,'".date(Y)."', '".date(m)."','".$op."','".$sb."','".$rowapo['porcentajec']."','1')";
        		 $obj1->ejecutar($sqlha);

      			//echo 'Cesantia -> id persona -> '.$rowapo['id_persona'].' porcentaje -> '.$rowapo['porcentajec'].' sb-> '.$sb.' op-> '.$op;


      		}else{
      			//echo 'Comun -> id persona -> '.$rowapo['id_persona'];
      			$sq1="select * from cappiutep.t_beneficio where id_beneficio='2'";
        		$res=$obj3->ejecutar($sq1); $rowo=$obj3->getArreglo($res);

        		$sb=$rowo['sueldo_base'];

        		 $op=($sb * $rowapo['porcentajec']) / 100;



        		 $sqlha="insert into cappiutep.aporte(id_persona,tipo,ano,mes,aporte,sb,porcentaje,estatus) values('".$rowapo['id_persona']."', '2' ,'".date(Y)."', '".date(m)."','".$op."','".$sb."','".$rowapo['porcentajec']."','1')";
        		 $obj1->ejecutar($sqlha);
      		}

      		
      	}

      }

     echo  corre_socios();

     if(date(d) >=1 && date(d) <= 31){ echo aportes_mensuales(); }else{}     
?>