<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];
  $Prestamo   = trim( $_POST['prestamo'] );
  $Persona  = trim( $_POST['persona'] );
  $IdDetalle  = trim( $_POST['IdDetalle'] );

//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MPagoDescuento.php");
    $PagoDescuento = new PagoDescuento();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  $PagoDescuento->setIdPersona    ( $Persona   );
  $PagoDescuento->setIdBeneficio  ( $Prestamo  );
  $PagoDescuento->setIdDetalle ( $IdDetalle );

//--------------------------------------------------------------------
//    Selector de operaciones
//--------------------------------------------------------------------

    switch($operacion){
        case "Registrar":
                $PagoDescuento->registrar();
                $PagoDescuento->cambiar_estatus();
                break;

        case "Guardar Cambios":
                $IdMod = trim( $_POST['IdMod'] );
                $PagoDescuento->setIdModulo  ( $IdMod );
                $PagoDescuento->modificar();
                break;
    }

//Fin del controlador  
?>