<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Lista
//--------------------------------------------------------------------
class Configuracion extends CModeloDatos  {
    //ORGANIZACION
     private $IdOrg;
     private $Razon;
     private $Siglas;
     private $DirFiscal;
     private $Telf;
     private $Email;
     private $Rif;
     private $Nit;
     private $Estatus;
     //CONFIGURACIONES
     private $LonMin;
     private $LonMax;
     private $Intentos;
     private $Cadu;
     private $NotCadu;
     private $Dif;
     private $Mayus;
     private $Minus;
     private $Num;
     private $CarEsp;
     private $CarPer;
     private $Exp;
     private $NotExp;
     private $MaxSes;
     private $NotEmail;
     private $SMS;
     //REGLAS
     private $Mision;
     private $Vision;
     private $Histor;
     private $ApoPat;
     private $ApoSoc;
     private $DesMin;
     private $DesMax;
     private $BenMin;
     private $BenMax;
     private $NocMin;
     private $NocMax;
     private $AcoMin;
     private $AcoMax;
     private $DiaMaxPrestamo;
     private $MontoMaxPrestamo;
     private $Moneda;
     private $max_prestamo;
//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {
      //ORGANIZACION
       parent::__construct();
       $this->IdOrg = "";
       $this->Razon     = "";
       $this->Siglas = "";
       $this->DirFiscal = "";
       $this->Telf = "";
       $this->Email = "";
       $this->Rif = "";
       $this->Nit = "";
       $this->Estatus = "1";
     //CONFIGURACIONES
       $this->LonMin = "";
       $this->LonMax = "";
       $this->Intentos = "";
       $this->Cadu = "";
       $this->NotCadu = "";
       $this->Dif = "";
       $this->Mayus = "";
       $this->Minus = "";
       $this->Num = "";
       $this->CarEsp = "";
       $this->CarPer = "";
       $this->Exp = "";
       $this->NotExp = "";
       $this->MaxSes = "";
       $this->NotEmail= "";
       $this->SMS = "";
    //REGLAS
       $this->Mision = "";
       $this->Vision = "";
       $this->Histor = "";
       $this->ApoPat = "";
       $this->ApoSoc = "";
       $this->DesMin = "";
       $this->DesMax = "";
       $this->BenMin = "";
       $this->BenMax = "";
       $this->NocMin = "";
       $this->NocMax = "";
       $this->AcoMin = "";
       $this->AcoMax = "";
       $this->DiaMaxPrestamo = "";
       $this->MontoMaxPrestamo = "";
       $this->Moneda = "";
       $this->max_prestamo = 0;
     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------
    //ORGANIZACION
    public function setIdOrg    ( $valor ){  $this->IdOrg     = $valor;   }
    public function setRazon    ( $valor ){  $this->Razon     = $valor;   }
    public function setSiglas   ( $valor ){  $this->Siglas    = $valor;   }
    public function setDirFiscal( $valor ){  $this->DirFiscal = $valor;   }
    public function setTelf     ( $valor ){  $this->Telf      = $valor;   }
    public function setEmail    ( $valor ){  $this->Email     = $valor;   }
    public function setRif      ( $valor ){  $this->Rif       = $valor;   }
    public function setNit      ( $valor ){  $this->Nit       = $valor;   }
    public function setEstatus  ( $valor ){  $this->Estatus   = $valor;   }
    //CONFIGURACIONES
    public function setLongMin  ( $valor ){  $this->LonMin   = $valor;   }
    public function setLongMax  ( $valor ){  $this->LonMax   = $valor;   }
    public function setIntentos ( $valor ){  $this->Intentos = $valor;   }
    public function setCadu     ( $valor ){  $this->Cadu     = $valor;   }
    public function setNotCadu  ( $valor ){  $this->NotCadu  = $valor;   }
    public function setDif      ( $valor ){  $this->Dif      = $valor;   }
    public function setMayus    ( $valor ){  $this->Mayus    = $valor;   }
    public function setMinus    ( $valor ){  $this->Minus    = $valor;   }
    public function setNum      ( $valor ){  $this->Num      = $valor;   }
    public function setCarEsp   ( $valor ){  $this->CarEsp   = $valor;   }
    public function setCarPer   ( $valor ){  $this->CarPer   = $valor;   }
    public function setExp      ( $valor ){  $this->Exp      = $valor;   }
    public function setNotExp   ( $valor ){  $this->NotExp   = $valor;   }
    public function setMaxSes   ( $valor ){  $this->MaxSes   = $valor;   }
    public function setNotEmail ( $valor ){  $this->NotEmail = $valor;   }
    public function setSMS      ( $valor ){  $this->SMS      = $valor;   }
    //REGLAS
    public function setMision   ( $valor ){  $this->Mision   = $valor;   }
    public function setVision   ( $valor ){  $this->Vision   = $valor;   }
    public function setHistor   ( $valor ){  $this->Histor   = $valor;   }
    public function setApoPat   ( $valor ){  $this->ApoPat   = $valor;   }
    public function setApoSoc   ( $valor ){  $this->ApoSoc   = $valor;   }
    public function setDesMin   ( $valor ){  $this->DesMin   = $valor;   }
    public function setDesMax   ( $valor ){  $this->DesMax   = $valor;   }
    public function setBenMin   ( $valor ){  $this->BenMin   = $valor;   }
    public function setBenMax   ( $valor ){  $this->BenMax   = $valor;   }
    public function setNocMin   ( $valor ){  $this->NocMin   = $valor;   }
    public function setNocMax   ( $valor ){  $this->NocMax   = $valor;   }
    public function setAcoMin   ( $valor ){  $this->AcoMin   = $valor;   }
    public function setAcoMax   ( $valor ){  $this->AcoMax   = $valor;   }
    public function setDiaMaxPrestamo   ( $valor ){  $this->DiaMaxPrestamo   = $valor;   }
    public function setMontoMaxPrestamo   ( $valor ){  $this->MontoMaxPrestamo   = $valor;   }
    public function setMoneda   ( $valor ){  $this->Moneda   = $valor;   }
    public function set_max_prestamo ($valor) { $this->max_prestamo = $valor;}

//--------------------------------------------------------------------
//       Modificar registro
//--------------------------------------------------------------------
    public function modificar()  
    {
        $sql="UPDATE cappiutep.t_organizacion 
                 SET razon_social    = '$this->Razon',
                   siglas          = '$this->Siglas',
                   dir_fiscal      = '$this->DirFiscal',
                   telefono        = '$this->Telf',
                   email           = '$this->Email',
                   rif             = '$this->Rif',
                   nit             = '$this->Nit'
               WHERE id_organizacion = $this->IdOrg;";
        return $this->consulta( $sql );

    }


//--------------------------------------------------------------------
//       Modificar registro
//--------------------------------------------------------------------
    public function config_sistema()  
    {
        $sql="UPDATE cappiutep.t_configuracion 
                 SET clave_long_min           = $this->LonMin,
                     clave_long_max           = $this->LonMax,
                     clave_intentos_fallidos  = $this->Intentos,
                     clave_dias_caducidad     = $this->Cadu,
                     clave_dias_antes         = $this->NotCadu,
                     clave_dif_anterior       = $this->Dif,
                     clave_mayus              = '$this->Mayus',
                     clave_minus              = '$this->Minus',
                     clave_num                = '$this->Num',
                     clave_caracteres         = '$this->CarEsp',
                     clave_caracteres_validos = '$this->CarPer',
                     sesion_min_expira        = $this->Exp,
                     sesion_min_antes         = $this->NotExp,
                     max_sesiones_abiertas    = $this->MaxSes,
                     not_correo               = '$this->NotEmail',
                     not_telf                 = '$this->SMS';";
        return $this->consulta( $sql );
    }



//--------------------------------------------------------------------
//       Modificar registro
//--------------------------------------------------------------------
    public function config_reglas()  
    {
        $sql="UPDATE cappiutep.t_configuracion 
                 SET porcentaje_patrono       = $this->ApoPat,
                     porcentaje_socio         = $this->ApoSoc,
                     porcentaje_descuento_min = $this->DesMin,
                     porcentaje_descuento_max = $this->DesMax,
                     num_min_beneficiarios    = $this->BenMin,
                     num_max_beneficiarios    = $this->BenMax,
                     num_min_noches           = $this->NocMin,
                     num_max_noches           = $this->NocMax,
                     num_min_acompañantes     = $this->AcoMin,
                     num_max_acompañantes     = $this->AcoMax,
                     dia_max_prestamo     = $this->DiaMaxPrestamo,
                     monto_max_prestamo     = $this->MontoMaxPrestamo,
                     moneda                   = '$this->Moneda';";
        return $this->consulta( $sql );
    }


//--------------------------------------------------------------------
//       Modificar registro
//--------------------------------------------------------------------
    public function config_misvishist()  
    {
        $sql="UPDATE cappiutep.t_configuracion 
              	 SET mision   = '$this->Mision',
              	 	   vision   = '$this->Vision',
                     historia = '$this->Histor';";
        return $this->consulta( $sql );
    }


//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
    public function consultar($que="")  
    {
        $que = (isset($que)) ? $que : "*";
         $sql="SELECT $que FROM cappiutep.t_configuracion"; 
        return $this->consulta( $sql );

    }

    public function consultarE()  
    {
        $que = (isset($que)) ? $que : "*";
         $sql="SELECT dia_max_prestamo FROM cappiutep.t_configuracion"; 
        return $this->consulta( $sql );

    }
    
//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
    public function consultarConf($que="")
    {      
      $registro = $this->consultar($que);
      while ( $fila = $this->setArreglo( $registro ))
      $datos[] = $fila;
        foreach ($datos as $Conf) { $Conf; }
      return $Conf;

    }

    public function consultarConfi($que="")
    {      
      $registro = $this->consultarE();
      while ( $fila = $this->setArreglo( $registro ))
      $datos[] = $fila;
        foreach ($datos as $Conf) { $Conf; }
      return $Conf;

    }
//--------------------------------------------------------------------
//       Convierte tuplas en arreglos
//--------------------------------------------------------------------
    public function setArreglo( $registro )
    {   return $this->getArreglo( $registro ); }

//--------------------------------------------------------------------
//       Contar filas en consulta
//--------------------------------------------------------------------
    public function setNoTupla( $registro )
    {   return $this->getNoTupla( $registro ); }   
    
}
//  Fin de la clase.
?>