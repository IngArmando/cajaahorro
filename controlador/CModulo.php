<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];
  $Des   = trim( $_POST['Des'] );
  $Icon  = trim( $_POST['Icon'] );
  
  $Padre = "NULL";
    if(isset($_POST['Padre']) && $_POST['Padre']!="")
      $Padre=trim( $_POST['Padre'] );
  
  $Pos   = "NULL";
    if(isset($_POST['Pos']))
        $Pos=trim( $_POST['Pos'] );

//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MModulo.php");
    $OMod = new Modulo();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OMod->setDesc    ( $Des   );
  $OMod->setIdIcon  ( $Icon  );
  $OMod->setIdPadre ( $Padre );
  $OMod->setPos     ( $Pos   );

//--------------------------------------------------------------------
//    Selector de operaciones
//--------------------------------------------------------------------

    switch($operacion){
        case "Registrar":
                $OMod->registrar();
                break;

        case "Guardar Cambios":
                $IdMod = trim( $_POST['IdMod'] );
                $OMod->setIdModulo  ( $IdMod );
                $OMod->modificar();
                break;
    }

//Fin del controlador  
?>