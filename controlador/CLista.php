<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];

  $Bloqueado = 0;
  $Nombre    = trim( $_POST['Nombre'] );
  if(isset( $_POST['Bloqueado'] ) && trim( $_POST['Bloqueado'] )=='on')
    $Bloqueado=1;

//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MLista.php");
    $OLista = new Lista();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OLista->setNombre   ( $Nombre    );
  $OLista->setBloqueado( $Bloqueado );

//--------------------------------------------------------------------
//    Selector de operaciones
//--------------------------------------------------------------------

  switch($operacion){
    case "Registrar":
            $OLista->registrar();
            break;

    case "Guardar":
            $OLista->modificar();
            break;

 
  
  }



//Fin del controlador  
?>