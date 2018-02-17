<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $Id   = trim( $_GET['id'] );

//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MModulo.php");
    $OMod = new Modulo();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OMod->setIdModulo    ( $Id   );
  $OMod->desactivar();
  header("Location: ../vista/sis/ConfigModulo.php");

//Fin del controlador  
?>