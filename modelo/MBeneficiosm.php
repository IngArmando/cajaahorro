<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Beneficio
//--------------------------------------------------------------------
class Beneficio extends CModeloDatos {
    //BENEFICIOS
    private $IdBeneficio;
    private $Nombre;
    private $Descripcion;
    private $FechaIni;
    private $FechaFin;
    private $MinDiasAprob;
    private $MaxDiasAprob;
    private $MinDiasAnt;
    private $Estatus;
    private $Icono;
    private $Interes;
    //SOLICITUDES
    private $solicitante;
    private $monto;
    //REQUISITOS
    private $Req;
    private $Oblig;
    private $FechaIniReq;
    private $FechaFinReq;
    private $EstatusReq;
    private $FormaPago,$RefPago,$observacion,$idSolicitud,$idprograma,$coutas;
    private $idpersona;
    private $cantidadPrestado;
    private $fiador;
    private $cedulafiador;

    private $presidente;
    private $encargado;
    private $diacorte;
    private $sueldobase;

    //--------------------------------------------------------------------
    //       Constructor
    //--------------------------------------------------------------------
    public function __construct()  {
    //BENEFICIOS
    parent::__construct();
    $this->IdBeneficio  = "";
    $this->Nombre  	   = "";
    $this->Descripcion  = "";
    $this->FechaIni     = "";
    $this->FechaFin     = "";
    $this->MinDiasAprob = "";
    $this->MaxDiasAprob = "";
    $this->MinDiasAnt   = "";
    $this->Estatus      = 1;
    $this->Interes        = "";
    $this->Icono        = "";
    //REQUISITOS
    $this->Req          = "";
    $this->Oblig        = "";
    $this->FechaIniReq  = "";
    $this->FechaFinReq  = "";
    $this->EstatusReq   = "";

    $this->presidente   = "";
    $this->encargado   = "";
    $this->diacorte   = "";
    $this->sueldobase   = "";

    }
    //--------------------------------------------------------------------
    //       Metodos Set
    //--------------------------------------------------------------------
    //BENEFICIOS
    public function setIdBeneficio  ( $valor ){  $this->IdBeneficio  = $valor;   }
    public function setNombre   	( $valor ){  $this->Nombre       = $valor;   }
    public function setDescripcion  ( $valor ){  $this->Descripcion  = $valor;   }
    public function setFechaIni   	( $valor ){  $this->FechaIni     = $valor;   }
    public function setFechaFin   	( $valor ){  $this->FechaFin     = $valor;   }
    public function setMinDiasAprob ( $valor ){  $this->MinDiasAprob = $valor;   }
    public function setMaxDiasAprob ( $valor ){  $this->MaxDiasAprob = $valor;   }
    public function setMinDiasAnt 	( $valor ){  $this->MinDiasAnt   = $valor;   }
    public function setEstatus      ( $valor ){  $this->Estatus      = $valor;   }
    public function setIcono        ( $valor ){  $this->Icono        = $valor;   }
    public function setInteres      ( $valor ){  $this->Interes      = $valor;   }
    //REQUISITOS
    public function setReq          ( $valor ){  $this->Req          = $valor;   }
    public function setFechaIniReq  ( $valor ){  $this->FechaIniReq  = $valor;   }
    public function setFechaFinReq  ( $valor ){  $this->FechaFinReq  = $valor;   }
    public function setOblig        ( $valor ){  $this->Oblig        = $valor;   }
    public function setEstatusReq   ( $valor ){  $this->EstatusReq   = $valor;   }

    public function setpresidente   ( $valor ){  $this->presidente   = $valor;   }
    public function setencargado   ( $valor ){  $this->encargado   = $valor;   }
    public function setdiacorte   ( $valor ){  $this->diacorte   = $valor;   }
    public function setsueldobase   ( $valor ){  $this->sueldobase   = $valor;   }

    public function __set($a,$b){
        $this->$a = filter_var($b,FILTER_SANITIZE_STRING);
    }

    public function get_tasa_interes($valor) {
        $consulta = $this->consulta("SELECT tasa_interes FROM cappiutep.t_beneficio where id_beneficio = $valor ");
        $data = $this->getArreglo($consulta);
        return $data["tasa_interes"];
    }

    public function getCondiciones($tipoPrestamo,$tipoDocente){
        $consulta = $this->consulta("SELECT * FROM cappiutep.t_beneficio_condicion where id_beneficio = $tipoPrestamo AND tipo_docente=$tipoDocente ");
        return $this->getArreglo($consulta);
    }

    public function getRequisitos($idBeneficio){
        $consulta = $this->consulta("SELECT l.id_lista_valor,l.nombre_largo FROM cappiutep.t_lista_valor AS l INNER JOIN cappiutep.t_beneficio_requisito AS r ON r.id_requisito = l.id_lista_valor WHERE r.id_beneficio = $idBeneficio");
        while($data = $this->getArreglo($consulta))$datos[] = $data;
        return $datos;
    }

    public function editarCuotaEspecial($cuota) {
        return $this->ejecutar2("UPDATE cappiutep.t_beneficio_solicitud SET monto_pago_especial = '$cuota' WHERE id_beneficio_solicitud = '$this->IdBeneficio'");
    }

    public function guardarSolicitud($tipo){

        switch($tipo){
            case 1: //aqui vamos a guardar el prestamo especial
                $sql = "INSERT INTO cappiutep.t_beneficio_solicitud(id_solicitante,id_beneficio,fecha,monto,cuotas,interes_cuotas) VALUES( (SELECT pc.id_persona_caja FROM cappiutep.t_persona_caja as pc inner join cappiutep.t_persona as p on p.id_persona = pc.id_persona where p.cedula = '$this->solicitante'),".$tipo.",CURRENT_DATE,'$this->monto',1,'$this->interes' )";
            break;
            case 2: //prestamo personal
                echo $sql = "INSERT INTO cappiutep.t_beneficio_solicitud(id_solicitante,id_beneficio,fecha,monto,cuotas,interes_cuotas,monto_pago_especial,cuotasrestantes,montorestante) VALUES( (SELECT pc.id_persona_caja FROM cappiutep.t_persona_caja as pc inner join cappiutep.t_persona as p on p.id_persona = pc.id_persona where p.cedula = '$this->solicitante'),".$tipo.",CURRENT_DATE,'$this->monto',$this->cuotas,'$this->interes','$this->monto_especial','$this->cuotas','$this->monto')";
            break;
            case 3: //financimiaento
                $sql = "INSERT INTO cappiutep.t_beneficio_solicitud(id_solicitante,id_beneficio,fecha,monto,cuotas,interes_cuotas,observacion) VALUES( (SELECT pc.id_persona_caja FROM cappiutep.t_persona_caja as pc inner join cappiutep.t_persona as p on p.id_persona = pc.id_persona where p.cedula = '$this->solicitante'),".$tipo.",CURRENT_DATE,'$this->monto',$this->cuotas,'$this->interes','$this->observacion')";
            break;
            case 4: //retiro parcial
                $sql = "INSERT INTO cappiutep.t_beneficio_solicitud(id_solicitante,id_beneficio,fecha,monto,observacion,estatus) VALUES( (SELECT pc.id_persona_caja FROM cappiutep.t_persona_caja as pc inner join cappiutep.t_persona as p on p.id_persona = pc.id_persona where p.cedula = '$this->solicitante'),".$tipo.",CURRENT_DATE,'$this->monto','$this->observacion','2')";
            break;
            case 5: //prestamo de vehiculo
                $sql = "INSERT INTO cappiutep.t_beneficio_solicitud(id_solicitante,id_beneficio,fecha,monto,cuotas,interes_cuotas,id_programa) VALUES( (SELECT pc.id_persona_caja FROM cappiutep.t_persona_caja as pc inner join cappiutep.t_persona as p on p.id_persona = pc.id_persona where p.cedula = '$this->solicitante'),".$tipo.",CURRENT_DATE,'$this->monto',$this->cuotas,'$this->interes','$this->idprograma' )";
            break;  
        }
        return $this->ejecutar2($sql);
    }

    public function registrar_detalle($nro,$mes,$anho,$capital,$amortizacion,$pago,$saldo,$id_beneficio_solicitud) {
            $sql = "INSERT INTO cappiutep.t_detalle_amortizacion(
            nro,
            mes,
            anho,
            capital,
            amortizacion,
            pago,
            saldo,
            estatus,
            id_beneficio_solicitud
        )
        VALUES (
        '$nro',
        '$mes',
        '$anho',
        '$capital',
        '$amortizacion',
        '$pago',
        '$saldo',
        '0',
        '$id_beneficio_solicitud');";
        return $this->consulta( $sql );
    }


    public function ListarSolicitudes($estatus=0){
        $consulta = $this->consulta("SELECT bs.*,b.nombre as tipo, concat(p.nombre1,' ',p.apellido1) as solicitante,p.id_persona
            FROM cappiutep.t_beneficio_solicitud as bs 
            inner join cappiutep.t_beneficio as b on b.id_beneficio = bs.id_beneficio
            inner join cappiutep.t_persona_caja as pc on bs.id_solicitante = pc.id_persona_caja
            inner join cappiutep.t_persona as p on p.id_persona = pc.id_persona");
        while($data = $this->getArreglo($consulta)) $datos[] = $data;
        return $datos;
    }

    public function buscarSolicitud($id){
        $consulta = $this->consulta("SELECT bs.*,b.nombre as tipo, per.*, pc.fecha_ini as fechaafi, progra.nombre_largo as programa
        FROM cappiutep.t_beneficio_solicitud as bs 
        inner join cappiutep.t_beneficio as b on b.id_beneficio = bs.id_beneficio 
        inner join cappiutep.t_persona_caja as pc on pc.id_persona_caja = bs.id_solicitante
        inner join cappiutep.t_persona as per on per.id_persona = pc.id_persona
        left join cappiutep.t_lista_valor as progra on progra.id_lista_valor = bs.id_programa
        where bs.id_beneficio_solicitud=$id");
        return $this->getArreglo($consulta);
    }

    public function buscarSolicitudRep($id){
        $consulta = $this->consulta("SELECT bs.*,b.nombre as tipo, per.*, pc.fecha_ini as fechaafi, progra.nombre_largo as programa
        FROM cappiutep.t_beneficio_solicitud as bs 
        inner join cappiutep.t_beneficio as b on b.id_beneficio = bs.id_beneficio 
        inner join cappiutep.t_persona_caja as pc on pc.id_persona_caja = bs.id_solicitante
        inner join cappiutep.t_persona as per on per.id_persona = pc.id_persona
        left join cappiutep.t_lista_valor as progra on progra.id_lista_valor = bs.id_programa
        where bs.id_beneficio_solicitud=$id");
      while($data = $this->getArreglo($consulta)) $datos[] = $data;
      return $datos;
    }
    //--------------------------------------------------------------------
    //       Listar solicitudes de un solo socio
    //--------------------------------------------------------------------

    public function ListarSolicitudesSocio($socio){
        $consulta = $this->consulta("SELECT bs.*,b.nombre as tipo, bs.estatus as solestatus FROM cappiutep.t_beneficio_solicitud as bs inner join cappiutep.t_beneficio as b on b.id_beneficio = bs.id_beneficio where bs.id_solicitante = '$socio' AND bs.estatus!='4'  AND bs.estatus!='5'  AND bs.estatus!='6' ");
        $datos=NULL;
        while($data = $this->getArreglo($consulta)) $datos[] = $data;
        return $datos;
    }
    //--------------------------------------------------------------------
    //       Registrar
    //--------------------------------------------------------------------

    public function asignarFiador($id,$cedula) {
      echo "INSERT INTO cappiutep.t_beneficio_fiador( id_beneficio_solicitud,cedulasocio) VALUES(".$id.",".$cedula.")";
        return $this->ejecutar("INSERT INTO cappiutep.t_beneficio_fiador( id_beneficio_solicitud,cedulasocio) VALUES(".$id.",".$cedula.")");
    }

    public function ultimoIdSolicitud() {
        return $this->buscarUltimoId("id_beneficio_solicitud","cappiutep.t_beneficio_solicitud");
    }

    public function registrar() {
            $sql = "INSERT INTO cappiutep.t_beneficio(
            nombre,
            descripcion,
            fecha_inicio,
            max_dias_aprob,
            min_dias_aprob,
            min_dias_antiguedad,
            icono
        )
        VALUES (
        '$this->Nombre',
        '$this->Descripcion',
        '$this->FechaIni',
        $this->MinDiasAprob,
        $this->MaxDiasAprob,
        $this->MinDiasAnt,
        '$this->Icono');";
        return $this->consulta( $sql );
    }


    //--------------------------------------------------------------------
    //       Activar registro
    //--------------------------------------------------------------------
    public function activar() {
        $sql="UPDATE cappiutep.t_beneficio 
        SET estatus = '1'
        WHERE id_beneficio= $this->IdBeneficio";
        return $this->consulta( $sql );
    }

    //--------------------------------------------------------------------
    //       Desactivar registro
    //--------------------------------------------------------------------
    public function desactivar() {
        $sql="UPDATE cappiutep.t_beneficio 
        SET estatus = '0'
        WHERE id_beneficio= $this->IdBeneficio";
        return $this->consulta( $sql );
    }

    //--------------------------------------------------------------------
    //       Consultar registros
    //--------------------------------------------------------------------
    public function consultar() {
        $sql="SELECT * FROM cappiutep.t_beneficio WHERE id_beneficio = $this->IdBeneficio";
        return $this->consulta( $sql );
    }

    //--------------------------------------------------------------------
    //       Consultar registros
    //--------------------------------------------------------------------
    public function genItem($ID,$Antig,$TipoDocente,$URL) {
        $sql="SELECT a.*,b.*
        FROM
        cappiutep.t_beneficio AS a
        INNER JOIN cappiutep.t_beneficio_condicion AS b ON a.id_beneficio=b.id_beneficio
        WHERE a.id_beneficio = $ID AND b.tipo_docente=$TipoDocente;";
        $registro = $this->consulta( $sql );
        while ( $fila = $this->setArreglo( $registro ))
            $datos[] = $fila;
        foreach ($datos as $Ben) { $Ben; }

        if ($Antig>=$Ben['min_dias_antiguedad']) { 
            $Accion = '<a class="ui right floated primary button" onclick="window.location='."'".$URL."'".'">Solicitar<i class="right chevron icon"></i></a>'; }
        else{ 
            $Accion = '<div class="ui  info message">
            <i class="circle info icon"></i>
            Aún no tiene la antigüedad necesaria para éste beneficio.'.$Antig.' - '.$Ben['min_dias_antiguedad'].'
        </div>';
        }

        $Item='
        <div class="item">
            <div class="icon">
                <i class="large circular inverted blue '.$Ben['icono'].' icon"></i>
            </div>
            <div class="content">
                <div class="header">'.$Ben['nombre'].'</div>
                <div class="description">
                    <p>'.$Ben['descripcion'].'</p>
                </div>
                <div class="extra">
                    '.$Accion.'                    
                </div>
            </div>
        </div>
        ';
        return $Item;
    }

    //--------------------------------------------------------------------
    //       Listar registros
    //--------------------------------------------------------------------

    public function listar() {

        $sql="SELECT * FROM cappiutep.t_beneficio;";

        $MarcasSelect = array();
        $pos=0;   
        $MarcasSelect[$pos++] =" <table class='ui center aligned middle aligned celled table' id='Tabla'>";    
        $MarcasSelect[$pos++] =" <thead><tr>
        <th class='collapsing'>Icono</th>
        <th>Nombre</th>
        <th class='collapsing'>Estatus</th>
        <th class='collapsing'>Acciones</th>
    </tr></thead>
    <tbody>"; 

        $resulSet = $this->consulta( $sql ) ; 
        while($row= $this->getArreglo($resulSet))   {
            switch ($row['estatus']) {
                case '0':
                $status="<div class='ui red horizontal fluid label'> Desactivado </div>";
                $cStatus="<a class='ui green icon button' onclick='window.location='ConfigBeneficioFlujo.php?id=".$row['id_beneficio']."'' data-title='Activar' data-variation='basic'>
                            <i class='check icon'></i>
                          </a>";
                break;

                case '1':
                $status="<div class='ui green horizontal fluid label'> Activo   </div>";
                $cStatus="<a class='ui red icon button' onclick='window.location='ConfigBeneficioFlujo.php?id=".$row['id_beneficio']."'' data-title='Desactivar' data-variation='basic'>
                                <i class='remove icon'></i>
                            </a>";
                break;

            }

            $MarcasSelect[$pos++]="<tr>
            <td class=''><i class='ui big ".$row['icono']." icon'></i></td>
            <td><b>".$row['nombre']."</b></td>
            <td class=''>".$status."</td>
            <td class=''>
                <div class='ui large buttons'>
                    <a class='ui icon button' href='ConfigBeneficioEditar.php?id=".$row['id_beneficio']."'  data-title='Editar' data-variation='basic'>
                        <i class='edit icon'></i>
                    </a>
                    <a class='ui icon button' href='ConfigBeneficioCondicion.php?id=".$row['id_beneficio']."' data-title='Config. Condiciones' data-variation='basic'>
                        <i class='book icon'></i>
                    </a>
                    <a class='ui icon button' href='ConfigBeneficioRequisito.php?id=".$row['id_beneficio']."' data-title='Config. Requisitos' data-variation='basic'>
                        <i class='folder open outline icon'></i>
                    </a>
                    <a class='ui icon button' href='ConfigBeneficioPlazo.php?id=".$row['id_beneficio']."' data-title='Config. Plazos de Pago' data-variation='basic'>
                        <i class='calendar icon'></i>
                    </a>
                    ".$cStatus."
                </div>                 

            </td>
        </tr>";
        }
        $MarcasSelect[$pos++]="</tbody></table>";
        return $MarcasSelect;
    }

    //--------------------------------------------------------------------
    //       Muestra registros en la homepage
    //--------------------------------------------------------------------

    public function mostrar() {
        $sql="SELECT * FROM cappiutep.t_beneficio WHERE estatus='1' AND mostrar='1';";
        $MarcasSelect = array();
        $pos=0;   
        $MarcasSelect[$pos++] =" <div class='ui centered stackacble cards container'>";   

        $resulSet = $this->consulta( $sql ) ; 
        while($row= $this->getArreglo($resulSet)) {
            $MarcasSelect[$pos++]="
            <a class='middle aligned blue card' href='beneficios.php'>
                <div class='content'>
                    <i class='large circular inverted blue right floated ".$row['icono']." icon'></i>
                    <div class='header'>".$row['nombre']."</div>
                </div>
            </a>";
        }
        $MarcasSelect[$pos++]="</div>";
        return $MarcasSelect;
    } 


    //--------------------------------------------------------------------
    //       Muestra registros en la homepage
    //--------------------------------------------------------------------


    public function mostrar_detalle() {

        $sql="SELECT * FROM cappiutep.t_beneficio WHERE estatus='1' AND mostrar='1' ORDER BY nombre;";

        $MarcasSelect = array();
        $pos=0;   

        $resulSet = $this->consulta( $sql ) ; 
        $num= $this->N2L($this->getNoTupla($resulSet));

        $MarcasSelect[$pos++] =" <div class='ui blue inverted pointing tabular ".$num."  item menu'>";   
        $active= 'active';
        while($row= $this->getArreglo($resulSet))   
        {
            $MarcasSelect[$pos++]="
            <div class='item ".$active."' data-tab='".$row['id_beneficio']."'>".$row['nombre']."</div>";
            $active='';
        }
        $MarcasSelect[$pos++]="</div>";

        $active= 'active';
        $resulSet = $this->consulta( $sql ) ; 
        while($row= $this->getArreglo($resulSet))       
        {
            $MarcasSelect[$pos++]="
            <div class='ui ".$active." tab clearing blue segment' data-tab='".$row['id_beneficio']."'>
                <div class='ui dividing header'><i class='big circular blue inverted ".$row['icono']." icon'></i>".$row['nombre']."</div>
                <p align='justify'>".$row['descripcion']."</p>
                <div class='ui dividing header'>Requisitos</div>
            <ul>
            ";

            $requisitos = $this->getRequisitos($row['id_beneficio']);
            foreach($requisitos as $index => $requisito):
             $MarcasSelect[$pos++]='<li>'.$requisito[1].'</li>';        
            endforeach; 
            $MarcasSelect[$pos++]='</ul></div>';      
            unset($datos);  

            $active='';
        }
        $MarcasSelect[$pos++]="</div>";

        return $MarcasSelect;
    }	

    //--------------------------------------------------------------------
    //       Registrar Requisitos de Beneficio
    //--------------------------------------------------------------------

    public function registrar_req() {
        $sql = "INSERT INTO cappiutep.t_beneficio_requisito(
            id_beneficio,
            id_requisito,
            obligatorio,
            fecha_ini,
            estatus
        )
        VALUES (
        $this->IdBeneficio,
        $this->Req,
        '$this->Oblig',
        '$this->FechaIniReq',
        '1');";
        return $this->consulta( $sql );
    }

    //--------------------------------------------------------------------
    //       Listar registros
    //--------------------------------------------------------------------

    public function listar_bene_reqs() {

        $sql="SELECT a.*,b.nombre_largo
        FROM
        cappiutep.t_beneficio_requisito AS a
        INNER JOIN cappiutep.t_lista_valor AS b ON a.id_requisito=b.id_lista_valor
        WHERE id_beneficio=$this->IdBeneficio;";

        $MarcasSelect = array();
        $pos=0;   
        $MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";    
        $MarcasSelect[$pos++] =" <thead><tr>
        <th>Número</th>
        <th>Requisito</th>
        <th>Tipo</th>
        <th>Estatus</th>
        <th>Acciones</th>
    </tr></thead>
    <tbody>"; 

            $resulSet = $this->consulta( $sql ) ; 
            while($row= $this->getArreglo($resulSet))   
            {
                switch ($row['estatus']) {
                case '0':
                $status="<div class='ui red horizontal fluid label'> Desactivado </div>";
                $cStatus="<a class='ui green icon button' onclick='window.location='.php?id=".$row['id_beneficio']."'' data-title='Activar' data-variation='basic'>
                            <i class='check icon'></i>
                          </a>";
                break;

                case '1':
                $status="<div class='ui green horizontal fluid label'> Activo   </div>";
                $cStatus="<a class='ui red icon button' onclick='window.location='.php?id=".$row['id_beneficio']."'' data-title='Desactivar' data-variation='basic'>
                                <i class='remove icon'></i>
                            </a>";
                break;

                }

                switch ($row['obligatorio']) {
                    case '0':
                    $obli="<div class='ui fluid label'> Opcional </div>";
                    break;

                    case '1':
                    $obli="<div class='ui fluid label'> Obligatorio </div>";
                    break;

                }

                $MarcasSelect[$pos++]="<tr>
                <td class='collapsing'>".$row['id_beneficio_requisito']."</td>
                <td>".$row['nombre_largo']."</td>
                <td class='collapsing'>".$obli."</td>
                <td class='collapsing'>".$status."</td>
                <td class='collapsing'>".$cStatus."
                </td>
            </tr>";
        }
        $MarcasSelect[$pos++]="</tbody></table>";
        return $MarcasSelect;
    } 
    //--------------------------------------------------------------------
    //       Convierte tuplas en arreglos
    //--------------------------------------------------------------------
    public function setArreglo( $registro ){
        return $this->getArreglo( $registro ); 
    }
    //--------------------------------------------------------------------
    //       Contar filas en consulta
    //--------------------------------------------------------------------
    public function setNoTupla( $registro ){
        return $this->getNoTupla( $registro ); 
    }
    //--------------------------------------------------------------------
    //       Números a letras
    //--------------------------------------------------------------------
    public function N2L($number){
        $result = array();
        $tens = floor($number / 10);
        $units = $number % 10;

        $words = array(
            'units' => array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eightteen', 'nineteen'),
            'tens' => array('', '', 'twenty', 'thirty', 'fourty', 'fifty', 'sixty', 'seventy', 'eigthy', 'ninety')
        );

        if ($tens < 2) {
            $result[] = $words['units'][$tens * 10 + $units];
        }

        else{
            $result[] = $words['tens'][$tens];
            if ($units > 0){
                $result[count($result) - 1] .= '-' . $words['units'][$units];
            }
        }
        if (empty($result[0])){
            $result[0] = 'Zero';
        }
        return trim(implode(' ', $result));
    }
    //--------------------------------------------------------------------
    //       Consulta solicitudes en espera de analisis
    //--------------------------------------------------------------------
    public function ContAnalisis()  
    {      
        $sql="SELECT * FROM cappiutep.t_beneficio_solicitud WHERE estatus='1';";
        $tuplas = $this->consulta( $sql );
        $numTuplas= $this->getNoTupla($tuplas);
        return $numTuplas;
    }
    //--------------------------------------------------------------------
    //       Consulta solicitudes en espera de aprobacion/rechazo
    //--------------------------------------------------------------------
    public function ContAprob() {
        $sql="SELECT * FROM cappiutep.t_beneficio_solicitud WHERE estatus='2';";
        $tuplas = $this->consulta( $sql );
        $numTuplas= $this->getNoTupla($tuplas);
        return $numTuplas;
    }
    //--------------------------------------------------------------------
    //       Consulta solicitudes en espera de liquidacion
    //--------------------------------------------------------------------
    public function ContLiq() {
        $sql="SELECT * FROM cappiutep.t_beneficio_solicitud WHERE estatus='3';";
        $tuplas = $this->consulta( $sql );
        $numTuplas= $this->getNoTupla($tuplas);
        return $numTuplas;
    }
    //--------------------------------------------------------------------
    //       Calcula las cuotas de un prestamo
    //--------------------------------------------------------------------
    public function calcularCuota($p,$i,$n) {
      //p=monto del prestamo
      //i=interes
      //n=numero de cuotas
      $i=($i/12)/100;
      $cuotas=$p*(($i*pow((1+$i), $n))/((pow((1+$i), $n))-1));
      return number_format($cuotas, 2, ',', '.');
    }
    //FLUJO DE APROBACION
    public function guardarFlujoAprobacion($tipo=1,$tipoaprobacion) {
        if($tipo==1) {//cuando es analizado
            //creo el primer flujo
            if($this->ejecutar2("INSERT INTO cappiutep.t_solicitud_flujo(id_solicitud,fecha_entra,fecha_sale,observacion) VALUES('$this->IdBeneficio',(SELECT fecha FROM cappiutep.t_beneficio_solicitud WHERE id_beneficio_solicitud ='$this->IdBeneficio' ),CURRENT_DATE,'$this->observacion')")){
                $idUltimo = $this->buscarUltimoId("id_solicitud_flujo","cappiutep.t_solicitud_flujo");
                $idPersonaCaja = $this->getIdPersonaCaja();
                //guardo la aprobacion o el rechazo segun sea el caso
                $this->ejecutar2("INSERT INTO cappiutep.t_solicitud_aprueba(id_persona_caja,id_solicitud_flujo,fecha,tipoaprobacion) values('$idPersonaCaja','$idUltimo',CURRENT_DATE,'$tipoaprobacion')");
                if($tipoaprobacion==1){
                    //si el evento fue una aprobacion guardo el siguiente flujo
                    $this->ejecutar2("INSERT INTO cappiutep.t_solicitud_flujo(id_solicitud,fecha_entra,observacion) VALUES('$this->IdBeneficio',CURRENT_DATE,'$this->observacion')");
                }
            }
        }else if($tipo==2) {//cuando es aprobado o liquidado
            if($this->actualizarFlujoAprobacion()) { //actualizo el flujo que viene del analisis que quedo con fecha NULL
                //ahora guardo que operacion si fue rechazado o aprobado
                $idUltimo = $this->buscarUltimoId("id_solicitud_flujo","cappiutep.t_solicitud_flujo");
                $idPersonaCaja = $this->getIdPersonaCaja();
                $this->ejecutar2("INSERT INTO cappiutep.t_solicitud_aprueba(id_persona_caja,id_solicitud_flujo,fecha,tipoaprobacion) values('$idPersonaCaja','$idUltimo',CURRENT_DATE,'$tipoaprobacion')");
                //luego prregunto si fue aprobado creo el nuevo flujo para la liquidacion, de lo contrario no guarda mas flujos
                if($tipoaprobacion==1){
                    $this->ejecutar2("INSERT INTO cappiutep.t_solicitud_flujo(id_solicitud,fecha_entra,observacion) VALUES('$this->IdBeneficio',CURRENT_DATE,'$this->observacion')");
                }
            }
        }
    }
    public function actualizarFlujoAprobacion() {
        $consulta = $this->consulta("SELECT id_solicitud_flujo as id FROM cappiutep.t_solicitud_flujo WHERE id_solicitud = '$this->IdBeneficio' AND fecha_sale IS NULL ORDER BY id_solicitud_flujo LIMIT 1");
        $dato = $this->getArreglo($consulta);
        $id = $dato["id"];
        return $this->ejecutar2("UPDATE cappiutep.t_solicitud_flujo SET fecha_sale=CURRENT_DATE where id_solicitud_flujo = '$id'");
    }

    public function modificar_beneficios($cod_beneficio,$valorp) {

        //echo '###### '.$cod_beneficio; exit();
       // echo "UPDATE cappiutep.t_beneficio SET sueldobase='3400' where id_beneficio = '$cod_beneficio'"; exit();
        echo "UPDATE cappiutep.t_beneficio SET presidente='$this->presidente', encargado='$this->encargado', sueldo_base='$this->sueldobase' , dia_corte='$this->diacorte', tasa_interes='$this->Interes' where id_beneficio = '$cod_beneficio'";
        return $this->ejecutar2("UPDATE cappiutep.t_beneficio SET presidente='$this->presidente', encargado='$this->encargado', sueldo_base='$this->sueldobase' , dia_corte='$this->diacorte', tasa_interes='$this->Interes', valorp='$valorp' where id_beneficio = '$cod_beneficio'");

        /*

        $consulta = $this->consulta("SELECT id_solicitud_flujo as id FROM cappiutep.t_solicitud_flujo WHERE id_solicitud = '$this->IdBeneficio' AND fecha_sale IS NULL ORDER BY id_solicitud_flujo LIMIT 1");
        $dato = $this->getArreglo($consulta);
        $id = $dato["id"];
        return $this->ejecutar2("UPDATE cappiutep.t_solicitud_flujo SET fecha_sale=CURRENT_DATE where id_solicitud_flujo = '$id'");*/
    }

    //aprobar analisis
    public function aprobrarAnalisis() {
        $this->guardarFlujoAprobacion(1,1);
        return $this->ejecutar2("UPDATE cappiutep.t_beneficio_solicitud SET estatus=2 where id_beneficio_solicitud='$this->IdBeneficio'");
    }
    public function recharzarAnalisis() {
        $this->guardarFlujoAprobacion(1,2);
        return $this->ejecutar2("UPDATE cappiutep.t_beneficio_solicitud SET estatus=5 where id_beneficio_solicitud='$this->IdBeneficio'");
    }
    //aprobar solicitud luego de ser analizados 
    public function aprobrarSolicitud() {
        $this->guardarFlujoAprobacion(2,1);
        return $this->ejecutar2("UPDATE cappiutep.t_beneficio_solicitud SET estatus=3 where id_beneficio_solicitud='$this->IdBeneficio'");
    }

    public function recharzarSolicitud() {
        $this->guardarFlujoAprobacion(2,2);
        return $this->ejecutar2("UPDATE cappiutep.t_beneficio_solicitud SET estatus=6 where id_beneficio_solicitud='$this->IdBeneficio'");
    }

    public function generarLiquidacion() {
        $this->guardarFlujoAprobacion(2,0);
        return $this->ejecutar2("UPDATE cappiutep.t_beneficio_solicitud SET estatus=4 where id_beneficio_solicitud='$this->IdBeneficio'");
    }
    public function procesarLiquidacion($tipo=1){
        $this->guardarHaberes($this->monto,$tipo);
        return $this->ejecutar2("INSERT INTO cappiutep.t_detalle_liquid(monto,forma_pago,ref_pago,observacion,id_solicitud) VALUES($this->monto,$this->FormaPago,'$this->RefPago','$this->observacion',$this->idSolicitud)");
    }

    public function getIdSolicitante() {
        $consulta = $this->consulta("SELECT pc.id_persona_caja 
        FROM cappiutep.t_persona_caja as pc 
        inner join cappiutep.t_persona as p on p.id_persona = pc.id_persona 
        where p.cedula = '".$this->solicitante."'");
        return $this->getArreglo($consulta)[0];
    }

    public function getCantidadActual() {
        $idPersonaCaja = $this->getIdSolicitante();
        $consulta = $this->consulta("SELECT COUNT(*) as cant FROM cappiutep.t_beneficio_solicitud where CAST (estatus AS integer) < 4 AND id_solicitante='$idPersonaCaja' ");
        $datos = $this->getArreglo($consulta);
        return $datos["cant"];
    }
    public function getIdPersona() {
        $consulta = $this->ejecutar("SELECT id_persona FROM cappiutep.t_persona WHERE cedula = '$this->cedula'");
        $data = $this->getArreglo($consulta);
        return $data["id_persona"];
    }
    public function guardarHaberes($prestamo,$tipo=1) {
        if($tipo==1) {
            $consulta = $this->consulta("SELECT * FROM cappiutep.t_haberes WHERE id_persona = $this->idpersona ORDER BY id_haberes DESC LIMIT 1");
            $data = $this->getArreglo($consulta);
            $bloqueado = $data["saldo_bloq_prestamo"] + $prestamo;
            return $this->ejecutar2("INSERT INTO cappiutep.t_haberes(id_persona,saldo,saldo_bloq_prestamo,saldo_bloq_fianza) VALUES($this->idpersona,'".$data['saldo']."','".$bloqueado."','".$data['saldo_bloq_fianza']."') ");
        }else if($tipo==2) {
            $consulta = $this->consulta("SELECT * FROM cappiutep.t_haberes WHERE id_persona = $this->idpersona ORDER BY id_haberes DESC LIMIT 1");
            $data = $this->getArreglo($consulta);
            $saldo = $data["saldo"] - $prestamo;
            return $this->ejecutar2("INSERT INTO cappiutep.t_haberes(id_persona,saldo,saldo_bloq_prestamo,saldo_bloq_fianza) VALUES($this->idpersona,'".$saldo."','".$data['saldo_bloq_prestamo']."','".$data['saldo_bloq_fianza']."') ");
        }else if($tipo==3) {
            $consulta = $this->consulta("SELECT * FROM cappiutep.t_haberes WHERE id_persona = $this->idpersona ORDER BY id_haberes DESC LIMIT 1");
            $data = $this->getArreglo($consulta);
            return $this->ejecutar2("INSERT INTO cappiutep.t_haberes(id_persona,saldo,saldo_bloq_prestamo,saldo_bloq_fianza) VALUES($this->idpersona,'".$data['saldo']."','".$data['saldo']."','".$data['saldo_bloq_fianza']."') ");
        }
    }
    public function buscarFiadores($id) {
        $consulta = $this->consulta("SELECT f.*, p.id_persona as idpersona,p.nombre1,p.apellido1 FROM
        cappiutep.t_beneficio_fiador AS f
        INNER JOIN cappiutep.t_persona AS p ON CAST(p.cedula AS integer) =  f.cedulasocio
        WHERE f.id_beneficio_solicitud = $id
        ");
        while($data = $this->getArreglo($consulta))$datos[] = $data;
        return $datos;      
    }
    public function moficarPrestamoFiador() {
        $sql = "UPDATE cappiutep.t_beneficio_fiador SET prestamo = '$this->cantidadPrestado' WHERE id_beneficio_solicitud='$this->IdBeneficio' AND cedulasocio='$this->fiador' ";
        return $this->ejecutar2($sql);
    }
    public function restarHaberesFianza($fianza) {
        $consulta = $this->consulta("SELECT * FROM cappiutep.t_haberes WHERE id_persona = ( SELECT id_persona FROM cappiutep.t_persona WHERE cedula = '$this->cedulafiador' ) ORDER BY id_haberes DESC LIMIT 1");
        $data = $this->getArreglo($consulta);
        return $this->ejecutar2("INSERT INTO cappiutep.t_haberes(id_persona,saldo,saldo_bloq_prestamo,saldo_bloq_fianza) VALUES((SELECT id_persona FROM cappiutep.t_persona WHERE cedula = '$this->cedulafiador'),'".$data['saldo']."','".$data['saldo_bloq_prestamo']."','".$fianza."') ");
    }
}// Fin de la clase
?> 