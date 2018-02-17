<?php


//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];

  $FechaIni     = date('Y-m-d',strtotime(str_replace('/', '-', $_POST['FechaIni'] )));
  $Icono        = trim( $_POST['Icono'] );
  $Nombre       = trim( $_POST['Nombre'] );
  $Desc         = trim( $_POST['Desc'] );
  $MinDiasAprob = trim( $_POST['MinDiasAprob'] );
  $MaxDiasAprob = trim( $_POST['MaxDiasAprob'] );
  $MinDiasAnt   = trim( $_POST['MinDiasAnt'] );


  $presidente  = trim( $_POST['presidente'] );
  $encargado  = trim( $_POST['encargado'] );
  $dia_corte  = trim( $_POST['diacorte'] );
  $sueldobase  = trim( $_POST['sueldobase'] );
  $cod_beneficio  = trim( $_POST['cod_beneficio'] );
  $Interes  = trim( $_POST['Interes'] );
  $valorp  = trim( $_POST['valorp'] );
//--------------------------------------------------------------------
//    Llama a la clase y se crea el objeto
//--------------------------------------------------------------------

    @include_once("../modelo/MBeneficios.php");
    $OBeneficios = new Beneficio();



//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OBeneficios->setFechaIni     ( $FechaIni     );
  $OBeneficios->setIcono        ( $Icono        );
  $OBeneficios->setNombre       ( $Nombre       );
  $OBeneficios->setDescripcion  ( $Desc         );
  $OBeneficios->setMinDiasAprob ( $MinDiasAprob );
  $OBeneficios->setMaxDiasAprob ( $MaxDiasAprob );
  $OBeneficios->setMinDiasAnt   ( $MinDiasAnt   );


  $OBeneficios->setpresidente   ( $presidente   );
  $OBeneficios->setencargado   ( $encargado   );
  $OBeneficios->setdiacorte   ( $dia_corte   );
  $OBeneficios->setsueldobase   ( $sueldobase   );
  $OBeneficios->setInteres   ( $Interes  );

//--------------------------------------------------------------------
//    Selector de operaciones
//--------------------------------------------------------------------

 

  switch($operacion){
    case "Registrar":
            $OBeneficios->registrar();
            break;

    case "Guardar Cambios":
            
            $OBeneficios->modificar_beneficios($cod_beneficio,$valorp);
            break;

 
  
  }



//Fin del controlador  
?>