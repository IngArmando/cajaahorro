<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];

  $Mod    =trim( $_POST['Mod'] );    
  $Des    =trim( $_POST['Des'] );
  $TipVis =trim( $_POST['TipVis'] );    
  $URL    =trim( $_POST['URL'] );    
  
  $Icon    = "NULL";
    if(isset($_POST['Icon']) && $_POST['Icon']!='' )
      $Icon=trim( $_POST['Icon'] );

  $Pos    = "NULL";
    if(isset($_POST['Pos'])&& $_POST['Pos']!='')
        $Pos=trim( $_POST['Pos'] );

//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MServicio.php");
    $OServ = new Servicio();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OServ->setIdModulo  ( $Mod );
  $OServ->setDesc      ( $Des   );
  $OServ->setIdTipoVis ( $TipVis  );
  $OServ->setIdIcon    ( $Icon  );
  $OServ->setPos       ( $Pos   );
  $OServ->setURL       ( $URL   );

//--------------------------------------------------------------------
//    Selector de operaciones
//--------------------------------------------------------------------

  switch($operacion){
    case "Registrar":
            $IdServ= $OServ->SigID();
            $OServ->setIdServicio($IdServ);
            $OServ->registrar();
            break;

    case "Guardar Cambios":
            $IdServ = trim( $_POST['IdServ'] );
            $OServ->setIdServicio  ( $IdServ );
            $OServ->modificar();
            break;

 
  
  }

//Fin del controlador  
?>