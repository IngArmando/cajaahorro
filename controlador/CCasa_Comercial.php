<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];
  $id_casa_comercial   = trim( $_POST['id_casa_comercial'] );
  $descripcion   = trim( $_POST['descripcion'] );
  $tipo_comision  = trim( $_POST['tipo_comision'] );
  $comision  = trim( $_POST['comision'] );
  
//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MCasa_Comercial.php");
    $OCasaC = new Casa_Comercial();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OCasaC->setdescripcion    ( $descripcion   );
  $OCasaC->settipo_comision  ( $tipo_comision  );
  $OCasaC->setcomision ( $comision );
//--------------------------------------------------------------------
//    Selector de operaciones
//--------------------------------------------------------------------
    switch($operacion){
        case "Registrar":
                $OCasaC->registrar();
                break;

        case "Guardar Cambios":
                $id_casa_comercial = trim( $_POST['id_casa_comercial'] );
                $OCasaC->setid_casa_comercial  ( $id_casa_comercial );
                $OCasaC->modificar();
                break;
    }

//Fin del controlador  
?>