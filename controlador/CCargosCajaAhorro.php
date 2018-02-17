<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];

  $FechaIni     = date('Y-m-d',strtotime(str_replace('/', '-', $_POST['FechaIni'] )));
  $Nombre       = trim( $_POST['Nombre'] );
  $Desc         = trim( $_POST['Desc'] );
  $TipoCargo    = trim( $_POST['TipoCargo'] );
  $MinDiasAprob = trim( $_POST['MinPers'] );
  $MaxDiasAprob = trim( $_POST['MaxPers'] );
//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../mdl/MCargosCajaAhorro.php");
    $OCargos = new Cargos();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OCargos->setFechaIni     ( $FechaIni     );
  $OCargos->setNombre       ( $Nombre       );
  $OCargos->setDesc         ( $Desc         );
  $OCargos->setTipoCargo    ( $TipoCargo   );
  $OCargos->setMinPers      ( $MinDiasAprob );
  $OCargos->setMaxPers      ( $MaxDiasAprob );

//--------------------------------------------------------------------
//    Selector de operaciones
//--------------------------------------------------------------------

  switch($operacion){
    case "Registrar":
            $OCargos->registrar();
            break;

    case "Guardar Cambios":
            $IdCargo = trim( $_POST['IdCargo'] );
            $OCargos->setIdCargo  ( $IdCargo );
            $OCargos->modificar();
            break;

 
  
  }



//Fin del controlador  
?>