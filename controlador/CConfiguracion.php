<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];

  $LonMin   = trim( $_POST['LonMin'] );
  $LonMax   = trim( $_POST['LonMax'] );
  $Intentos = trim( $_POST['Intentos'] );
  $Cadu     = trim( $_POST['Cadu'] );
  $NotCadu  = trim( $_POST['NotCadu'] );
  $Dif      = trim( $_POST['Dif'] );

  $DiaMaxPrestamo      = trim( $_POST['DiaMaxPrestamo'] );

  $Mayus = 0;
  if(isset( $_POST['Mayus'] ) && trim( $_POST['Mayus'] )=='on')
    $Mayus=1;

  $Minus = 0;
  if(isset( $_POST['Minus'] ) && trim( $_POST['Minus'] )=='on')
    $Minus=1;

  $Num = 0;
  if(isset( $_POST['Num'] ) && trim( $_POST['Num'] )=='on')
    $Num=1;

  $CarEsp = 0;
  if(isset( $_POST['CarEsp'] ) && trim( $_POST['CarEsp'] )=='on')
    $CarEsp=1;

  $CarPer    = trim( $_POST['CarPer'] );
  $Exp    = trim( $_POST['Exp'] );
  $NotExp    = trim( $_POST['NotExp'] );
  $MaxSes    = trim( $_POST['MaxSes'] );

  $Email = 0;
  if(isset( $_POST['Email'] ) && trim( $_POST['Email'] )=='on')
    $Email=1;

  $SMS = 0;
  if(isset( $_POST['SMS'] ) && trim( $_POST['SMS'] )=='on')
    $SMS=1;

//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MConfiguracion.php");
    $OConfig = new Configuracion();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OConfig->setLongMin  ( $LonMin );
  $OConfig->setLongMax  ( $LonMax );
  $OConfig->setIntentos ( $Intentos );
  $OConfig->setCadu     ( $Cadu );
  $OConfig->setNotCadu  ( $NotCadu );
  $OConfig->setDif      ( $Dif );
  $OConfig->setMayus    ( $Mayus );
  $OConfig->setMinus    ( $Minus );
  $OConfig->setNum      ( $Num );
  $OConfig->setCarEsp   ( $CarEsp );
  $OConfig->setCarPer   ( $CarPer );
  $OConfig->setExp      ( $Exp );
  $OConfig->setNotExp   ( $NotExp );
  $OConfig->setMaxSes   ( $MaxSes );
  $OConfig->setNotEmail ( $Email );
  $OConfig->setSMS      ( $SMS );
  $OConfig->setDiaMaxPrestamo( $DiaMaxPrestamo );

  $OConfig->config_sistema();

//Fin del controlador  
?>