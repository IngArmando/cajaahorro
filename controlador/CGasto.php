<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];
  $id_compra   = trim( $_POST['id_compra'] );
  $descripcion   = trim( $_POST['descripcion'] );
  $monto   = trim( $_POST['monto'] );
  $ano   = trim( $_POST['ano'] );
  $mes   = trim( $_POST['mes'] );
  $tipo   = trim( $_POST['tipo'] );
  $fondo   = trim( $_POST['fondo'] );
  
//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MGasto.php");
    $OCompra = new Gasto();
    $db = new Gasto();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OCompra->setdescripcion    ( $descripcion   );
  $OCompra->setmonto    ( $monto   );
  $OCompra->setano    ( $ano   );
  $OCompra->setmes    ( $mes   );
  $OCompra->settipo    ( $tipo   );
  $OCompra->setfondo    ( $fondo  );
//--------------------------------------------------------------------
//    Selector de operaciones
//--------------------------------------------------------------------
    switch($operacion)
    {
      case "Registrar":{
        if($OCompra->registrar()){

                  $dbg = new Gasto();
                  $sqlultimo="SELECT MAX(cod_gasto) AS ultimo FROM cappiutep.gasto";
                  $asu=$dbg->ejecutar($sqlultimo); $rowul=$dbg->getArreglo($asu);
                  $ultimo=$rowul['ultimo'];

            if($tipo == 2){

              if($fondo == 1){
                     $sqlca="SELECT count(*) as socios from cappiutep.t_persona where fcesantia='1' ";   
                     $sqlp="SELECT * from cappiutep.t_persona where fcesantia='1' ";   
                        }else{
                      $sqlca="SELECT count(*) as socios from cappiutep.t_persona where fcomun='1' ";
                      $sqlp="SELECT * from cappiutep.t_persona where fcomun='1' ";
                }

                  $sa=$db->ejecutar($sqlca); $rowca=$db->getArreglo($sa); 
                  $desco= $monto / $rowca['socios'];

                  $db1 = new Gasto();

                  $saa=$db1->ejecutar($sqlp);
                  while ($rowp=$db1->getArreglo($saa)) {
                    # code...
                  $db2 = new Gasto();

                    $sqlcap="INSERT into cappiutep.contra_aporte (tipo,detalle,monto,id_persona,cod_gasto) values('".$fondo."','".$descripcion."','".$desco."','".$rowp['id_persona']."','".$ultimo."')";
                    $db2->ejecutar($sqlcap);
                  }



            }

            
        }
      }
      break;

      case "Guardar Cambios":
        $id_compra = trim( $_POST['id_compra'] );
        $OCompra->setid_compra  ( $id_compra );
        $OCompra->modificar();
      break;
    }

//Fin del controlador  
?>