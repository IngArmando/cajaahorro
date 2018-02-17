<?php
session_start();
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];

  $IdPersona  = trim( $_POST['IdPersona'] );
  $IdUser     = trim( $_POST['IdUser'] );
  $NuevoCargo = trim( $_POST['NuevoCargo'] );

//--------------------------------------------------------------------
//    Llamado de clase y creación de objeto
//--------------------------------------------------------------------
   include_once("../modelo/MSocio.php");
    $OSocio = new Socio();

    $OSocio->setIdPersona ( $IdPersona  );
    $OSocio->setCargo     ( $NuevoCargo );
    $OSocio->setIdUser    ( $IdUser     );
    $OSocio->asigCargo();



//Fin del controlador  
?>