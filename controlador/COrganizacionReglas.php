<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];

  $ApoSoc = trim( $_POST['ApoSoc'] );
  $ApoPat = trim( $_POST['ApoPat'] );
  $DesMax = trim( $_POST['DesMax'] );
  $DesMin = trim( $_POST['DesMin'] );
  $BenMax = trim( $_POST['BenMax'] );
  $BenMin = trim( $_POST['BenMin'] );
  $NocMax = trim( $_POST['NocMax'] );
  $NocMin = trim( $_POST['NocMin'] );
  $AcoMax = trim( $_POST['AcoMax'] );
  $AcoMin = trim( $_POST['AcoMin'] );
  $DiaMaxPrestamo = trim( $_POST['DiaMaxPrestamo'] );
  $MontoMaxPrestamo = trim( $_POST['MontoMaxPrestamo'] );
  $Moneda = trim( $_POST['Moneda'] );

  

//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MConfiguracion.php");
    $OConfig = new Configuracion();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OConfig->setApoSoc ( $ApoSoc );
  $OConfig->setApoPat ( $ApoPat );
  $OConfig->setDesMax ( $DesMax );
  $OConfig->setDesMin ( $DesMin );
  $OConfig->setBenMax ( $BenMax );
  $OConfig->setBenMin ( $BenMin );
  $OConfig->setNocMax ( $NocMax );
  $OConfig->setNocMin ( $NocMin );
  $OConfig->setAcoMax ( $AcoMax );
  $OConfig->setAcoMin ( $AcoMin );
  $OConfig->setDiaMaxPrestamo ( $DiaMaxPrestamo );
  $OConfig->setMontoMaxPrestamo ( $MontoMaxPrestamo );
  $OConfig->setMoneda ( $Moneda );

  $OConfig->config_reglas();

//Fin del controlador
?>