<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Cargos
//--------------------------------------------------------------------
class Socio extends CModeloDatos  {
     private $IdPersona;
     private $Nacionalidad;
     private $Cedula;
     private $Nombre1;
     private $Nombre2;
     private $Apellido1;
     private $Apellido2;
     private $FechaNac;
     private $Sexo;
     private $Dir;
     private $EstadoCivil;
     private $CodFijo;
     private $TelfFijo;
     private $CodMovil;
     private $TelfMovil;
     private $CodOficina;
     private $TelfOficina;
     private $Condicion;
     private $Sede;
     private $Categoria;
     private $Dedicacion;
     private $TipoDocente;
     private $Salario;
     private $FechaIngreso;
     private $Email;
     private $LugarNac;
     private $TipoPersona;
     private $FondoComun;
     private $Ciudad;
     private $Parroquia;
     private $Estatus;
     
     private $IdUser;
     private $Cargo;
     private $FechaIni;
     private $CondicionUser;
     private $aporte;


//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->IdPersona    = "";
       $this->Nacionalidad = "";
       $this->Cedula       = "";
       $this->Nombre1      = "";
       $this->Nombre2      = "";
       $this->Apellido1    = "";
       $this->Apellido2    = "";
       $this->FechaNac     = "";
       $this->Sexo         = "";
       $this->Dir          = "";
       $this->EstadoCivil  = "";
       $this->CodFijo      = "";
       $this->TelfFijo     = "";
       $this->CodMovil     = "";
       $this->TelfMovil    = "";
       $this->CodOficina   = "";
       $this->TelfOficina  = "";
       $this->Condicion    = "";
       $this->Sede         = "";
       $this->Categoria    = "";
       $this->Dedicacion   = "";
       $this->TipoDocente  = "";
       $this->Salario      = "";
       $this->FechaIngreso = "";
       $this->Email        = "";
       $this->LugarNac     = "";
       $this->TipoPersona  = "";
       $this->FondoComun   = "";
       $this->Ciudad       = "";
       $this->Parroquia    = "";
       $this->Estatus      = "";
       
       $this->IdUser       = "";
       $this->Cargo        = "";
       $this->FechaIni     = "";
       $this->CondicionUser= "";
       $this->aporte= "";


     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdPersona    ( $valor ){  $this->IdPersona    = $valor;   }
    public function setNacionalidad ( $valor ){  $this->Nacionalidad = $valor;   }
    public function setCedula       ( $valor ){  $this->Cedula       = $valor;   }
    public function setNombre1      ( $valor ){  $this->Nombre1      = $valor;   }
    public function setNombre2      ( $valor ){  $this->Nombre2      = $valor;   }
    public function setApellido1    ( $valor ){  $this->Apellido1    = $valor;   }
    public function setApellido2    ( $valor ){  $this->Apellido2    = $valor;   }
    public function setFechaNac     ( $valor ){  $this->FechaNac     = $valor;   }
    public function setSexo         ( $valor ){  $this->Sexo         = $valor;   }
    public function setDir          ( $valor ){  $this->Dir          = $valor;   }
    public function setEstadoCivil  ( $valor ){  $this->EstadoCivil  = $valor;   }
    public function setCodFijo      ( $valor ){  $this->CodFijo      = $valor;   }
    public function setTelfFijo     ( $valor ){  $this->TelfFijo     = $valor;   }
    public function setCodMovil     ( $valor ){  $this->CodMovil     = $valor;   }
    public function setTeflMovil    ( $valor ){  $this->TelfMovil    = $valor;   }
    public function setCodOficina   ( $valor ){  $this->CodOficina   = $valor;   }
    public function setTelfOficina  ( $valor ){  $this->TelfOficina  = $valor;   }
    public function setCondicion    ( $valor ){  $this->Condicion    = $valor;   }
    public function setSede         ( $valor ){  $this->Sede         = $valor;   }
    public function setCategoria    ( $valor ){  $this->Categoria    = $valor;   }
    public function setDedicacion   ( $valor ){  $this->Dedicacion   = $valor;   }
    public function setTipoDocente  ( $valor ){  $this->TipoDocente  = $valor;   }
    public function setSalario      ( $valor ){  $this->Salario      = $valor;   }
    public function setFechaIng     ( $valor ){  $this->FechaIngreso = $valor;   }
    public function setEmail        ( $valor ){  $this->Email        = $valor;   }
    public function setLugarNac     ( $valor ){  $this->LugarNac     = $valor;   }
    public function setTipoPersona  ( $valor ){  $this->TipoPersona  = $valor;   }
    public function setFondoComun   ( $valor ){  $this->FondoComun   = $valor;   }
    public function setCiudad       ( $valor ){  $this->Ciudad       = $valor;   }
    public function setParroquia    ( $valor ){  $this->Parroquia    = $valor;   }
    public function setEstatus      ( $valor ){  $this->Estatus      = $valor;   }

    public function setIdUser       ( $valor ){  $this->IdUser       = $valor;   }
    public function setCargo        ( $valor ){  $this->Cargo        = $valor;   }
    public function setFechaIni     ( $valor ){  $this->FechaIni     = $valor;   }
    public function setaporte     ( $valor ){  $this->aporte     = $valor;   }

    public function __set($a,$b){
        $this->$a = filter_var($b,FILTER_SANITIZE_STRING);
    }
    //--------------------------------------------------------------------
    //       Obtener Tipo de Docente 
    //--------------------------------------------------------------------
    public function getTipoDocente($ced){
        $consulta = $this->ejecutar("SELECT tipo_docente FROM cappiutep.t_persona where cedula = '$ced'");
        $data = $this->getArreglo($consulta);
        return $data["tipo_docente"];
    }

    //--------------------------------------------------------------------
    //       Obtener Cargo en la Caja de Ahorro 
    //--------------------------------------------------------------------
    public function getCargo($ced){
        $consulta = $this->ejecutar("SELECT pc.id_cargo_caja AS cargo
                                    FROM cappiutep.t_persona AS s
                                    INNER JOIN cappiutep.t_persona_caja AS pc ON s.id_persona = pc.id_persona
                                       WHERE cedula = '$ced';");
        $data = $this->getArreglo($consulta);
        return $data["cargo"];
    }

    //--------------------------------------------------------------------
    //       Obtener Haberes del Socio
    //--------------------------------------------------------------------

    public function getHaberes($idPersona){
        $consulta = $this->ejecutar("SELECT (saldo - saldo_bloq_prestamo - saldo_bloq_fianza) as saldo FROM cappiutep.t_haberes WHERE id_persona = $idPersona ORDER BY id_haberes DESC LIMIT 1");
        $data = $this->getArreglo($consulta);
        return $data["saldo"];
    }

    public function obtenerHaberes($idPersona){
        $consulta = $this->ejecutar("SELECT * FROM cappiutep.t_haberes WHERE id_persona = $idPersona ORDER BY id_haberes DESC LIMIT 1");
        return $this->getArreglo($consulta);
    }

    //--------------------------------------------------------------------
    //       Obtener Haberes del Socio
    //--------------------------------------------------------------------

    public function getEmail($ced){
        $consulta = $this->ejecutar("SELECT email FROM cappiutep.t_persona where cedula = '$ced'");
        $data = $this->getArreglo($consulta);
        return $data["email"];
    }

//--------------------------------------------------------------------
//       Obtener Siguiente ID Persona
//--------------------------------------------------------------------

    public function SigID() {
      $sql = "SELECT MAX(id_persona) AS mayor FROM cappiutep.t_persona";
      $registro =  $this->consulta( $sql );
      if ($fila = $this->getArreglo( $registro )) $num = $fila['mayor']+1;
      return $num;
    }

//--------------------------------------------------------------------
//       Obtener Siguiente ID Usuario
//--------------------------------------------------------------------

    public function SigIDUser() {
      $sql = "SELECT MAX(id_usuario) AS mayor FROM cappiutep.t_usuario";
      $registro =  $this->consulta( $sql );
      if ($fila = $this->getArreglo( $registro )) $num = $fila['mayor']+1;
      return $num;
    }

//--------------------------------------------------------------------
//       Registrar
//--------------------------------------------------------------------
    public function registrar($fco,$fce,$aptco,$aptce)
    {

       $this->crearConexion();
       $this->query( "BEGIN" );
       //PASO 1 de 5 - Se registra la persona en la BD
       echo $sql="INSERT INTO cappiutep.t_persona (
                                              id_persona,
                                              nacionalidad,
                                              cedula,
                                              nombre1,
                                              nombre2,
                                              apellido1,
                                              apellido2,
                                              fecha_nacimiento,
                                              direccion,
                                              cod_telf_fijo,
                                              telf_fijo,
                                              cod_telf_movil,
                                              telf_movil,
                                              id_condicion,
                                              id_sede,
                                              salario,
                                              categ_docente,
                                              dedic_docente,
                                              tipo_docente,
                                              fecha_ini_docente,
                                              email,
                                              lugarnac,
                                              id_tipo_persona,
                                              fondocomun,
                                              id_parroquia,
                                              aporte_cesantia,
                                              aporte_comun,
                                              fcesantia,
                                              fcomun
                                              )
                                        VALUES
                                              (
                                                $this->IdPersona, 
                                               '$this->Nacionalidad', 
                                                $this->Cedula, 
                                               '$this->Nombre1', 
                                               '$this->Nombre2', 
                                               '$this->Apellido1', 
                                               '$this->Apellido2', 
                                               '$this->FechaNac', 
                                               '$this->Dir', 
                                               '$this->CodFijo', 
                                               '$this->TelfFijo', 
                                               '$this->CodMovil', 
                                               '$this->TelfMovil', 
                                               149, 
                                               7, 
                                               0, 
                                               '$this->Categoria', 
                                               '$this->Dedicacion', 
                                               '$this->TipoDocente', 
                                               '$this->FechaIngreso', 
                                               '$this->Email',
                                               '$this->LugarNac',
                                               $this->TipoPersona,
                                               '$this->FondoComun', 
                                               0,
                                               '$aptce',
                                               '$aptco',
                                               '$fce',
                                               '$fco'
                                              )"; 
        $hecho = $this->query( $sql );
        //PASO 2 de 5 -  Se registra como miembro de la caja de ahorros
        if ( $hecho ){
           $sql = "INSERT INTO cappiutep.t_persona_caja
                                                      (
                                                      id_persona,
                                                      id_cargo_caja,
                                                      fecha_ini
                                                     )
                                             VALUES (
                                                      $this->IdPersona,
                                                      1,
                                                     '$this->FechaIni'
                                                     )";
           $hecho = $this->query( $sql );
         }
        //PASO 3 de 5 -  Se le crea un usuario
        if ( $hecho ){
           $sql = "INSERT INTO cappiutep.t_usuario
                                                      (
                                                      id_usuario,
                                                      nombre,
                                                      id_persona
                                                     )
                                             VALUES (
                                                      $this->IdUser,
                                                      $this->Cedula,
                                                      $this->IdPersona
                                                     )";
           $hecho = $this->query( $sql );
         }
        
         //PASO 4 de 5 - Se le asigna una contraseña inicial
        if ( $hecho ){
           $sql = "INSERT INTO cappiutep.t_usuario_clave
                                                      (
                                                      id_usuario,
                                                      clave,
                                                      fecha_ini
                                                     )
                                             VALUES (
                                                       $this->IdUser,
                                                      '".md5($this->Cedula)."',
                                                      '$this->FechaIni'
                                                     )";
           $hecho = $this->query( $sql );
         }
        
         //PASO 5 de 5 - Se le asignan los servicios basicos al usuario
        if ( $hecho ){
           $sql = "INSERT INTO cappiutep.t_servicio_operacion 
                                                  (id_servicio,id_operacion,id_usuario)
                                             VALUES   
                                                  ( 1,2,$this->IdUser),
                                                  ( 3,4,$this->IdUser),
                                                  ( 4,2,$this->IdUser),
                                                  ( 5,4,$this->IdUser),
                                                  ( 5,7,$this->IdUser),
                                                  ( 6,4,$this->IdUser),
                                                  ( 6,7,$this->IdUser),
                                                  ( 7,4,$this->IdUser),
                                                  ( 7,7,$this->IdUser)
                                                    ;";
           $hecho = $this->query( $sql );
         }

        if ( $hecho )// Si se realizaron los 5 pasos, guarda de lo contrario Cancela
            $this->query( "COMMIT" );
        else
            $this->query( "ROLLBACK" );  
        return $hecho;
    }

    public function registrarBanco() {
        return $this->query("INSERT INTO cappiutep.t_persona_cuenta_banco(id_persona,id_banco,num_cuenta,tipo_cuenta) VALUES('$this->IdPersona','$this->id_banco','$this->num_cuenta','$this->tipo_cuenta')");
    }

    public function modificar()
    {

       $this->crearConexion();
       echo $sql = "UPDATE cappiutep.t_persona SET
                                              nombre1='$this->Nombre1',
                                              nombre2='$this->Nombre2',
                                              apellido1='$this->Apellido1',
                                              apellido2='$this->Apellido2',
                                              direccion='$this->Dir',
                                              telf_fijo='$this->TelfFijo',
                                              telf_movil='$this->TelfMovil',
                                              email='$this->Email',
                                              lugarnac='$this->LugarNac',
                                              id_tipo_persona=$this->TipoPersona,
                                              fondocomun='$this->FondoComun'
                                        WHERE
                                              id_persona=$this->IdPersona";
       return $this->query($sql);
  }

  public function modificar2($p1,$p2,$p3,$p4)
    {

       $this->crearConexion();
       echo $sql = "UPDATE cappiutep.t_persona SET
                                              nombre1='$this->Nombre1',
                                              nombre2='$this->Nombre2',
                                              apellido1='$this->Apellido1',
                                              apellido2='$this->Apellido2',
                                              direccion='$this->Dir',
                                              telf_fijo='$this->TelfFijo',
                                              telf_movil='$this->TelfMovil',
                                              email='$this->Email',
                                              lugarnac='$this->LugarNac',
                                              id_tipo_persona=$this->TipoPersona,
                                              fondocomun='$this->FondoComun',
                                              fcomun='".$p1."',
                                              aporte_comun='".$p2."',
                                              fcesantia='".$p3."',
                                              aporte_cesantia='".$p4."'
                                        WHERE
                                              id_persona=$this->IdPersona"; 
       return $this->query($sql);
  }


//--------------------------------------------------------------------
//       Asignar Cargo
//--------------------------------------------------------------------
   public function asigCargo()
    {

       $this->crearConexion();
       $this->query( "BEGIN" );
       //PASO 1 de 3 - Se asigna el cargo a la persona
       $sql="UPDATE cappiutep.t_persona_caja SET id_cargo_caja = '$this->Cargo' WHERE id_persona = '$this->IdPersona' ";
       $hecho = $this->query( $sql );
       
       //PASO 2 de 3 -  Se revocan los servicios del usuario
       if ( $hecho ){
           $sql = "DELETE FROM cappiutep.t_servicio_operacion WHERE id_usuario = '$this->IdUser' ";
           $hecho = $this->query( $sql );
         }

      //PASO 3 de 3 -  Dependiendo del cargo se le asignan nuevos permisos
        if ( $hecho ){
          
          switch ($this->Cargo) {//Cargo Asociado
            case 1: $sql = "INSERT INTO cappiutep.t_servicio_operacion 
                                        (id_servicio,id_operacion,id_usuario)
                                  VALUES( 1,2,$this->IdUser),
                                        ( 3,4,$this->IdUser),
                                        ( 4,2,$this->IdUser),
                                        ( 5,4,$this->IdUser),
                                        ( 5,7,$this->IdUser),
                                        ( 6,4,$this->IdUser),
                                        ( 6,7,$this->IdUser),
                                        ( 7,4,$this->IdUser),
                                        ( 7,7,$this->IdUser);";
                     $hecho = $this->query( $sql );
              break;

            case 2:case 3:case 4:case 5: //Cargos Administrativos
                  $sql = "INSERT INTO cappiutep.t_servicio_operacion 
                                        (id_servicio,id_operacion,id_usuario)
                                  VALUES( 1,2,$this->IdUser),
                                        ( 3,4,$this->IdUser),
                                        ( 4,2,$this->IdUser),
                                        ( 5,4,$this->IdUser),
                                        ( 5,7,$this->IdUser),
                                        ( 6,4,$this->IdUser),
                                        ( 6,7,$this->IdUser),
                                        ( 7,4,$this->IdUser),
                                        ( 7,7,$this->IdUser),
                                        ( 8,6,$this->IdUser),
                                        ( 8,5,$this->IdUser),
                                        ( 8,4,$this->IdUser),
                                        ( 9,2,$this->IdUser),
                                        ( 10,2,$this->IdUser),
                                        ( 11,4,$this->IdUser),
                                        ( 11,1,$this->IdUser),
                                        ( 11,2,$this->IdUser),
                                        ( 11,3,$this->IdUser),
                                        ( 12,1,$this->IdUser),
                                        ( 12,2,$this->IdUser),
                                        ( 12,3,$this->IdUser),
                                        ( 12,4,$this->IdUser),
                                        ( 13,1,$this->IdUser),
                                        ( 13,2,$this->IdUser),
                                        ( 13,3,$this->IdUser),
                                        ( 13,4,$this->IdUser),
                                        ( 14,1,$this->IdUser),
                                        ( 14,2,$this->IdUser),
                                        ( 14,3,$this->IdUser),
                                        ( 14,4,$this->IdUser)
                                        ;";
                     $hecho = $this->query( $sql );
              break;
            }
          }    

    if ( $hecho )// Si se realizaron los 3 pasos correctamente guardar, de lo contrario Cancelar
        $this->query( "COMMIT" );
      else
        $this->query( "ROLLBACK" );  
      return $hecho;
  }

//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
  /*public function consultar()  
    {
        $sql="SELECT s.*, e.id_estado AS estado , m.id_municipio AS municipio, p.id_parroquia AS parroquia
              FROM cappiutep.t_persona AS s
              INNER JOIN cappiutep.t_parroquia AS p ON s.id_parroquia = p.id_parroquia
              INNER JOIN cappiutep.t_municipio AS m ON p.id_municipio = m.id_municipio
              INNER JOIN cappiutep.t_estado    AS e ON m.id_estado    = e.id_estado
               WHERE id_persona = $this->IdPersona";
        return $this->consulta( $sql );

    }*/
    public function consultar()  
    {
        $sql="SELECT *
              FROM cappiutep.t_persona 
               WHERE id_persona = $this->IdPersona";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Consultar cedula, para validacion
//--------------------------------------------------------------------
    public function busCedula()
    {
        $sql="SELECT * FROM cappiutep.t_persona WHERE cedula = '$this->Cedula'";
        return $this->consulta( $sql );
    }

    public function getById($id) {
        $consulta = $this->consulta("SELECT * FROM cappiutep.t_persona WHERE id_persona = '$id'");
        return $this->getArreglo($consulta);
    }

//--------------------------------------------------------------------
//       Consultar cedula, para validacion
//--------------------------------------------------------------------
    public function actualizarDatos()  
    {
        $sql="UPDATE cappiutep.t_persona
              SET  cod_telf_movil = '$this->CodMovil',
                   telf_movil     = '$this->TelfMovil',
                   cod_telf_fijo  = '$this->CodFijo',
                   telf_fijo      = '$this->TelfFijo',
                   id_parroquia   = '$this->Parroquia',
                   salario        = '$this->Salario'
              WHERE id_persona = $this->IdPersona";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Consultar datos del socio por cedula
//--------------------------------------------------------------------
    public function busCedulaDetalle()  
    {
        $sql="SELECT s.*, e.id_estado AS estado , m.id_municipio AS municipio, p.id_parroquia AS parroquia, se.nombre_largo AS sede, 
                     td.nombre_largo AS tdocente,cd.nombre_largo AS cdocente,dd.nombre_largo AS ddocente, pc.fecha_ini AS fechaAfi, pc.id_persona_caja AS id_persona_caja
              FROM cappiutep.t_persona AS s
              INNER JOIN cappiutep.t_parroquia    AS p  ON s.id_parroquia          = p.id_parroquia
              INNER JOIN cappiutep.t_municipio    AS m  ON p.id_municipio          = m.id_municipio
              INNER JOIN cappiutep.t_estado       AS e  ON m.id_estado             = e.id_estado
              LEFT JOIN cappiutep.t_lista_valor  AS se ON s.id_sede::integer      = se.id_lista_valor
              LEFT JOIN cappiutep.t_lista_valor  AS td ON s.tipo_docente::integer = td.id_lista_valor
              LEFT JOIN cappiutep.t_lista_valor  AS cd ON s.categ_docente::integer= cd.id_lista_valor
              LEFT JOIN cappiutep.t_lista_valor  AS dd ON s.dedic_docente::integer= dd.id_lista_valor
              INNER JOIN cappiutep.t_persona_caja AS pc ON s.id_persona            = pc.id_persona
                 WHERE cedula = '$this->Cedula';";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Consultar email, para validacion
//--------------------------------------------------------------------
    public function busEmail()  
    {
        $sql="SELECT * FROM cappiutep.t_persona WHERE email = '$this->Email'";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Consultar email, para validacion
//--------------------------------------------------------------------
    public function getIdPerCaja()  
    {
       $sql="SELECT pc.id_persona FROM cappiutep.t_persona_caja AS pc WHERE pc.id_persona = '$this->IdPersona'";
        return $this->consulta( $sql );

    }

    //--------------------------------------------------------------------
    //       Consultar Antigüedad
    //--------------------------------------------------------------------
    public function busAntig(){
        $sql="SELECT *,(current_date-fecha_ini) AS antiguedad 
        FROM cappiutep.t_persona_caja WHERE id_persona='$this->IdPersona'";
          return $this->consulta( $sql );
    }

    //--------------------------------------------------------------------
    //       Consultar Haberes
    //--------------------------------------------------------------------
    public function busHaber() {
        $sql="SELECT * FROM cappiutep.t_haberes WHERE id_persona='$this->IdPersona' ORDER BY id_haberes DESC LIMIT 1";
        return $this->consulta( $sql );
    }

//--------------------------------------------------------------------
//       Consultar Haberes
//--------------------------------------------------------------------
    public function busActiv(){
        $sql="SELECT * FROM cappiutep.t_bitacora_acceso WHERE id_user='$this->IdPersona' LIMIT 5";
          return $this->consulta( $sql );
    }
//--------------------------------------------------------------------
//       Consultar Haberes
//--------------------------------------------------------------------
    public function busCargo(){
        $sql="SELECT a.*,b.*,c.nombre as Cargo,d.id_usuario as user
                FROM cappiutep.t_persona AS a
                INNER JOIN cappiutep.t_persona_caja      AS b ON a.id_persona=b.id_persona
                INNER JOIN cappiutep.t_cargo_caja_ahorro AS c ON b.id_cargo_caja=c.id_cargo_caja
                INNER JOIN cappiutep.t_usuario           AS d ON a.id_persona=d.id_persona
        WHERE a.id_persona='$this->IdPersona'";
          return $this->consulta( $sql );
    }

//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


  public function listar()  
  {

    echo $sql="SELECT a.*,b.*,c.nombre,d.nombre_largo
              FROM
                 cappiutep.t_persona AS a
                 INNER JOIN cappiutep.t_persona_caja      AS b ON a.id_persona=b.id_persona
                 INNER JOIN cappiutep.t_cargo_caja_ahorro AS c ON c.id_cargo_caja=b.id_cargo_caja
                 INNER JOIN cappiutep.t_lista_valor       AS d ON a.id_condicion=d.id_lista_valor";

    $MarcasSelect = array();
    $pos=0;   
    $MarcasSelect[$pos++] =" <table class='ui celled center aligned table' id='Tabla'>";    
    $MarcasSelect[$pos++] =" <thead><tr>
                  <th >C.I.</th>
                  <th >Nombre y Apellido</th>
                  <th >Cargo</th>
                  <th >F Comun</th>
                  <th >F Cesantia</th>
                  <th class='collapsing'>Condición</th>
                  <th >Acciones</th>
                </tr></thead>
                <tbody>"; 
    
    $resulSet = $this->consulta( $sql ) ; 
    while($row= $this->getArreglo($resulSet))   
    { 
        $edit ="'AdminSociosEditar.php?id=".$row['id_persona']."'";
        $cargo="'AdminSociosCargo.php?id=".$row['id_persona']."'";
        $acciones='<div class="ui large buttons">
                  <div class="ui icon button" data-content="Editar" data-variation="basic" onclick="window.location='.$edit.'">
                    <i class="edit icon"></i>
                  </div>
                  <div class="ui icon button" data-content="Asignar Cargo" data-variation="basic" onclick="window.location='.$cargo.'">
                    <i class="exchange icon"></i>
                  </div>
                  </div>
                  
                 ';
    
      switch ($row['nombre_largo']) {
        case 'Solvente':
          $status="<div class='ui green horizontal fluid label'> Solvente </div>";
          break;

            case 'No Solvente':
              $status="<div class='ui yellow horizontal fluid label'> No Solvente   </div>";
              break;

        case 'Retirado':
          $status="<div class='ui gray horizontal fluid label'> Retirado   </div>";
          break;

      }   

      if($row['fcomun'] == 1){ $ima="../../image/bien.jpg"; }else{ $ima="../../image/malo.png"; }
      if($row['fcesantia'] == 1){ $imac="../../image/bien.jpg"; }else{ $imac="../../image/malo.png"; }

      $MarcasSelect[$pos++]="<tr>
                   <td>".$row['cedula']."</td>
                   <td>".$row['nombre1']." ".$row['apellido1']."</td>
                   <td>".$row['nombre']."</td>
                   <td><img src='".$ima."' style='width:20%;'></td>
                   <td><img src='".$imac."' style='width:20%;'></td>
                   <td>".$status."</td>
                   <td>".$acciones."</td>
                  </tr>";
    }
    $MarcasSelect[$pos++]="</tbody></table>";
    return $MarcasSelect;
  } 


    public function listar2()  
  {

     $sql="SELECT a.*
              FROM
                 cappiutep.t_persona AS a
                 INNER JOIN cappiutep.t_lista_valor       AS d ON a.id_condicion=d.id_lista_valor";

    $MarcasSelect = array();
    $pos=0;   
    $MarcasSelect[$pos++] =" <table class='ui celled center aligned table' id='Tabla'>";    
    $MarcasSelect[$pos++] =" <thead><tr>
                  <th >C.I.</th>
                  <th >Nombre y Apellido</th>
                  <th >Cargo</th>
                  <th >F Comun</th>
                  <th >F Cesantia</th>
                  <th class='collapsing'>Condición</th>
                  <th >Acciones</th>
                </tr></thead>
                <tbody>"; 
    
    $resulSet = $this->consulta( $sql ) ; 
    while($row= $this->getArreglo($resulSet))   
    { 
        $edit ="'AdminSociosEditar.php?id=".$row['id_persona']."'";
        $cargo="'AdminSociosCargo.php?id=".$row['id_persona']."'";
        $acciones='<div class="ui large buttons">
                  <div class="ui icon button" data-content="Editar" data-variation="basic" onclick="window.location='.$edit.'">
                    <i class="edit icon"></i>
                  </div>
                  <div class="ui icon button" data-content="Asignar Cargo" data-variation="basic" onclick="window.location='.$cargo.'">
                    <i class="exchange icon"></i>
                  </div>
                  </div>
                  
                 ';
    
      switch ($row['nombre_largo']) {
        case 'Solvente':
          $status="<div class='ui green horizontal fluid label'> Solvente </div>";
          break;

            case 'No Solvente':
              $status="<div class='ui yellow horizontal fluid label'> No Solvente   </div>";
              break;

        case 'Retirado':
          $status="<div class='ui gray horizontal fluid label'> Retirado   </div>";
          break;

      }   

      if($row['fcomun'] == 1){ $ima="../../image/bien.jpg"; }else{ $ima="../../image/malo.png"; }
      if($row['fcesantia'] == 1){ $imac="../../image/bien.jpg"; }else{ $imac="../../image/malo.png"; }

      $MarcasSelect[$pos++]="<tr>
                   <td>".$row['cedula']."</td>
                   <td>".$row['nombre1']." ".$row['apellido1']."</td>
                   <td>".$row['nombre']."</td>
                   <td><img src='".$ima."' style='width:20%;'></td>
                   <td><img src='".$imac."' style='width:20%;'></td>
                   <td>".$status."</td>
                   <td>".$acciones."</td>
                  </tr>";
    }
    $MarcasSelect[$pos++]="</tbody></table>";
    return $MarcasSelect;
  } 


//--------------------------------------------------------------------
//       Listar haberes
//--------------------------------------------------------------------


  public function listarHaber($id_per)  
  {

    $sql="SELECT * FROM cappiutep.t_haberes WHERE id_persona = $id_per order by fecha_cierre desc";

    $MarcasSelect = array();
    $pos=0;   
    $MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";    
    $MarcasSelect[$pos++] =" <thead><tr>
                  <th>Fecha</th>
                  <th>Saldo</th>
                  <th>Bloqueado (Préstamos)</th>
                  <th>Bloqueado (Fianzas)</th>
                  <th>Total</th>
                  <th>Disponible</th>
                </tr></thead>
                <tbody>"; 
    
    $resulSet = $this->consulta( $sql ) ; 
    while($row= $this->getArreglo($resulSet))   
    {       

      $saldo_total=$row['saldo']-$row['saldo_bloq_prestamo']-$row['saldo_bloq_fianza'];
      $saldo_disp=$saldo_total*0.8;
      $MarcasSelect[$pos++]="<tr>
                   <td>".date('d/m/Y',strtotime( $row['fecha_cierre'] ))."</td>
                   <td>".number_format($row['saldo'])."</td>
                   <td>".number_format($row['saldo_bloq_prestamo'])."</td>
                   <td>".number_format($row['saldo_bloq_fianza'])."</td>
                   <td>".number_format($saldo_total)."</td>
                   <td>".number_format($saldo_total)."</td>
                  </tr>";
    }
    $MarcasSelect[$pos++]="</tbody></table>";
    return $MarcasSelect;
  } 

//--------------------------------------------------------------------
//       Listar haberes
//--------------------------------------------------------------------

  public function haberesReporte($id_per){
      $consulta = $this->ejecutar("SELECT * FROM cappiutep.t_haberes WHERE id_persona = $id_per ORDER BY fecha_cierre DESC;");
      while($data = $this->getArreglo($consulta)) $datos[] = $data;
      return $datos;
    }

//--------------------------------------------------------------------
//       Listar Actividad Reciente
//--------------------------------------------------------------------


	public function listarActvidad($user)	
	{

		$sql="SELECT * FROM cappiutep.t_bitacora_acceso WHERE  id_usuario=(SELECT a.id_usuario FROM cappiutep.t_usuario as a WHERE nombre='".$user."')  ORDER BY id_bitacora_acceso  DESC LIMIT 5";

		$MarcasSelect = array();
		$pos=0;
		$resulSet = $this->consulta( $sql ) ; 
		while($row= $this->getArreglo($resulSet))		
		{				

			$MarcasSelect[$pos++]='
                            <div class="small event">
                              <label>
                                <i class="angle right icon"></i>
                              </label>
                              <div class="content">
                                  <div class="summary">'.$row['mensaje'].
                                  '<div class="date">'.date('d/M/Y',strtotime( $row['fecha'])).', '.date('h:m A',strtotime( $row['hora'])).'
                                    </div>
                                  </div>
                                </div>
                              </div> 
                                  ';
		}
		$MarcasSelect[$pos++]="</tbody></table>";
		return $MarcasSelect;
	}	

//--------------------------------------------------------------------
//       Listar actividad reciente del usuario
//--------------------------------------------------------------------
    public function listByUser($usuario){
      $consulta = $this->ejecutar("SELECT * FROM cappiutep.t_bitacora_acceso WHERE id_usuario = '$usuario' ORDER BY id_bitacora_acesso DESC");
      while($data = $this->getArreglo($consulta)) $datos[] = $data;
      return $datos;
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
    


//--------------------------------------------------------------------
//       Reporte
//--------------------------------------------------------------------

public function reporte($cargo,$sede)
    {
        if ($sede != '') 
        {
          $sedeb=" AND s.id_sede::integer = $sede";
        }

        if ($cargo != '') 
        {
          $cargob=" AND s.tipo_docente::integer = $cargo";
        }

      $datos=NULL;
      
      $consulta = $this->ejecutar("SELECT s.*, se.nombre_largo AS sede,td.nombre_largo AS tdocente FROM cappiutep.t_persona AS s
              LEFT JOIN cappiutep.t_lista_valor  AS se ON s.id_sede::integer      = se.id_lista_valor
              LEFT JOIN cappiutep.t_lista_valor  AS td ON s.tipo_docente::integer = td.id_lista_valor
              WHERE s.nombre1!='' "
                 .$sedeb.$cargob);
      while($data = $this->getArreglo($consulta)) $datos[] = $data;
      return $datos;

    }
//--------------------------------------------------------------------
//       Reporte cuenta por tipo de cargo
//--------------------------------------------------------------------

public function cuentaporcargo()
    {

      $datos=NULL;
      
      $consulta = $this->ejecutar("SELECT COUNT(s.id_persona) as cant, td.nombre_largo AS tipo FROM cappiutep.t_persona AS s 
              LEFT JOIN cappiutep.t_lista_valor  AS td ON s.tipo_docente::integer = td.id_lista_valor
        GROUP BY tipo");
      while($data = $this->getArreglo($consulta)) $datos[] = $data;
      return $datos;

    }
//--------------------------------------------------------------------
//       Reporte cuenta por tipo de sede
//--------------------------------------------------------------------

public function cuentaporsede()
    {

      $datos=NULL;
      
      $consulta = $this->ejecutar("SELECT COUNT(s.id_persona) as cant, td.nombre_largo AS tipo FROM cappiutep.t_persona AS s 
              LEFT JOIN cappiutep.t_lista_valor  AS td ON s.id_sede::integer = td.id_lista_valor
        GROUP BY tipo");
      while($data = $this->getArreglo($consulta)) $datos[] = $data;
      return $datos;

    }

  }
//  Fin de la clase
?>