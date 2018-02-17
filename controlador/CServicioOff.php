<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $Id   = trim( $_GET['id'] );

//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MServicio.php");
    $OServ = new Servicio();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OServ->setIdServicio    ( $Id   );
  $OServ->desactivar();
  header("Location: ../vista/sis/ConfigServicio.php");

//Fin del controlador  
?>