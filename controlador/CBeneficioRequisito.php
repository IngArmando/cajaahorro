<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $IdBene   = trim( $_POST['IdBene'] );
  $Req      = trim( $_POST['Req'] );
  $Oblig    = '0';
    if(isset( $_POST['Oblig'] ) && trim( $_POST['Oblig'] )=='on')
    $Oblig=1;
  $FechaIni     = date('Y-m-d');
//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../modelo/MBeneficios.php");
    $OBeneficios = new Beneficio();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OBeneficios->setIdBeneficio  ( $IdBene   );
  $OBeneficios->setReq          ( $Req      );
  $OBeneficios->setOblig        ( $Oblig    );
  $OBeneficios->setFechaIniReq  ( $FechaIni );


  $OBeneficios->registrar_req();



//Fin del controlador  
?>