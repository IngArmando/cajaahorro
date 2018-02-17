<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];

  $IdLista        = trim( $_POST['IdLista'] );
  $NombreLargo    = trim( $_POST['NombreLargo'] );
  $NombreCorto    = trim( $_POST['NombreCorto'] );
  $Posicion       = 'NULL';
  $IdPadre        = 'NULL';
  if (isset($_POST['Posicion']) && $_POST['Posicion']!= NULL)
    $Posicion       = trim( $_POST['Posicion'] );
  if (isset($_POST['IdPadre']) && $_POST['IdPadre']!= NULL)
    $IdPadre       = trim( $_POST['IdPadre'] );

//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../mdl/MListaValores.php");
    $OListaValores = new ListaValores();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OListaValores->setIdLista    ( $IdLista    );
  $OListaValores->setNombreLargo( $NombreLargo );
  $OListaValores->setNombreCorto( $NombreCorto );
  $OListaValores->setPosicion   ( $Posicion );
  $OListaValores->setIdPadre    ( $IdPadre );

//--------------------------------------------------------------------
//    Selector de operaciones
//--------------------------------------------------------------------

  switch($operacion){
    case "Registrar":
            $OListaValores->registrar();
            break;

    case "Guardar Cambios":
            $IdListaValor = trim( $_POST['IdListaValor'] );
            $OListaValores->setIdListaValor  ( $IdListaValor );
            $OListaValores->modificar();
            break;

 
  
  }



//Fin del controlador  
?>