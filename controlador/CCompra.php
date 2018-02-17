<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];
  $id_compra   = trim( $_POST['id_compra'] );
  $descripcion   = trim( $_POST['descripcion'] );
  $id_persona  = trim( $_POST['id_persona'] );
  $id_casa_comercial  = trim( $_POST['id_casa_comercial'] );
  $monto   = trim( $_POST['monto'] );
  $ano   = trim( $_POST['ano'] );
  $mes   = trim( $_POST['mes'] );
  
//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MCompra.php");
    $OCompra = new Compra();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OCompra->setdescripcion    ( $descripcion   );
  $OCompra->setid_persona  ( $id_persona  );
  $OCompra->setid_casa_comercial ( $id_casa_comercial );
  $OCompra->setmonto    ( $monto   );
  $OCompra->setano    ( $ano   );
  $OCompra->setmes    ( $mes   );
//--------------------------------------------------------------------
//    Selector de operaciones
//--------------------------------------------------------------------
    switch($operacion)
    {
      case "Registrar":
        $OCompra->registrar();
      break;

      case "Guardar Cambios":
        $id_compra = trim( $_POST['id_compra'] );
        $OCompra->setid_compra  ( $id_compra );
        $OCompra->modificar();
      break;
    }

//Fin del controlador  
?>