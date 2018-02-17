<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------

  $Rif       = trim( $_POST['Rif'] );
  $Nit       = trim( $_POST['Nit'] );
  $Siglas    = trim( $_POST['Siglas'] );
  $Razon     = trim( $_POST['Razon'] );
  $Telf      = trim( $_POST['Telf'] );
  $Email     = trim( $_POST['Email'] );
  $DirFiscal = trim( $_POST['DirFiscal'] );

  $Mision = trim( $_POST['Mision'] );
  $Vision = trim( $_POST['Vision'] );
  $Histor = trim( $_POST['Histor'] );

//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MOrganizacion.php");
    $OOrg = new Organizacion();

    include_once("../modelo/MConfiguracion.php");
    $OConf = new Configuracion();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OOrg->setIdOrg     ( 1 );
  $OOrg->setRif       ( $Rif       );
  $OOrg->setNit       ( $Nit       );
  $OOrg->setSiglas    ( $Siglas    );
  $OOrg->setRazon     ( $Razon     );
  $OOrg->setTelf      ( $Telf      );
  $OOrg->setEmail     ( $Email     );
  $OOrg->setDirFiscal ( $DirFiscal );

  $OConf->setMision ( $Mision );
  $OConf->setVision ( $Vision );
  $OConf->setHistor ( $Histor );

  $OOrg->modificar();
  $OConf->config_misvishist();



//Fin del controlador  
?>