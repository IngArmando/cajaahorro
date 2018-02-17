<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Cargos
//--------------------------------------------------------------------
class BitOpe extends CModeloDatos  {
    private $IdBitOpe;
    private $IdUser;
    private $Serv;
    private $ip;
    private $Fecha;
    private $Hora;
    private $Oper;
    private $navegador;
    private $Msg;

    //--------------------------------------------------------------------
    //       Constructor
    //--------------------------------------------------------------------
    public function __construct()  {
        parent::__construct();
        $this->IdBitOpe = "";
        $this->IdUser   = "";
        $this->Serv     = "";
        $this->Fecha    = "";
        $this->Hora     = "";
        $this->Oper     = "";
        $this->Msg      = "";
        $this->ip = $this->getRealIP();
        $this->navegador=$this->getBrowser();
    }
    //--------------------------------------------------------------------
    //       Metodos Set
    //--------------------------------------------------------------------

    public function setIdBitOpe ( $valor ){  $this->IdBitOpe = $valor;   }
    public function setIdUser   ( $valor ){  $this->IdUser   = $valor;   }
    public function setServ     ( $valor ){  $this->Serv     = $valor;   }
    public function setIp       ( $valor ){  $this->Ip       = $valor;   }
    public function setFecha    ( $valor ){  $this->Fecha    = $valor;   }
    public function setHora     ( $valor ){  $this->Hora     = $valor;   }
    public function setOper     ( $valor ){  $this->Oper     = $valor;   }
    public function setNav      ( $valor ){  $this->Nav      = $valor;   }
    public function setMsg      ( $valor ){  $this->Msg      = $valor;   }

    public function registrar($usuario,$servicio,$operacion,$mensaje) {
        $sql = "INSERT INTO cappiutep.t_bitacora_general(id_usuario,servicio,ip,fecha,hora,operacion,navegador,mensaje) VALUES($usuario,'$servicio','$this->ip',CURRENT_DATE,CURRENT_TIME,'$operacion','$this->navegador','$mensaje')";
        return $this->ejecutar($sql);
    }

	public function listar() {
		$sql="SELECT a.*,b.nombre,c.nombre1,c.apellido1
              FROM
                 cappiutep.t_bitacora_general AS a
                 INNER JOIN cappiutep.t_usuario AS b ON a.id_usuario=b.id_usuario
                 INNER JOIN cappiutep.t_persona AS c ON b.nombre = c.cedula";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";		
		$MarcasSelect[$pos++] =" <thead><tr>
                  <th>N°</th>
									<th>Usuario</th>
                  <th>Servicio</th>
                  <th>Operaci&oacute;n</th>
                  <th>Mensaje</th>
									<th class='collapsing'>Fecha</th>
                  <th class='collapsing'>Hora</th>
                  <th class='collapsing'>IP</th>
									<th class='collapsing'>Navegador</th>
								</tr></thead>
								<tbody>";	
		
		$resulSet = $this->consulta( $sql ) ; 
		while($row= $this->getArreglo($resulSet))		
		{
			$MarcasSelect[$pos++]="<tr>
									 <td>".$row['id_bitacora_general']."</td>
									 <td>".$row['nombre1']." ".$row['apellido1']."</td>
                   <td>".$row['servicio']."</td>
                   <td>".$row['operacion']."</td>
                   <td>".$row['mensaje']."</td>
                   <td>".$row['fecha']."</td>
                   <td>".$row['hora']."</td>
                   <td>".$row['ip']."</td>
                   <td>".$row['navegador']."</td>
									</tr>";
		}
		$MarcasSelect[$pos++]="</tbody></table>";
		return $MarcasSelect;
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
    
    public function  getRealIP() {
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip_cliente =( !empty($_SERVER['REMOTE_ADDR']) ) ?$_SERVER['REMOTE_ADDR']:( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR']:"unknown" );
            // los proxys van añadiendo al final de esta cabecera las direcciones ip que van "ocultando". 
            //Para localizar la ip real del usuario se comienza a mirar por el principio hasta encontrar una dirección ip 
            //que no sea del rango privado. En caso de no encontrarse ninguna se toma como valor el REMOTE_ADDR
            $entrantes = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
            reset($entrantes);
            while (list(, $entrante) = each($entrantes)) {
                $entrante = trim($entrante);
                if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entrante, $lista_ip) ) {
                    //las ip privadas mas conocidas para local y proxy local, si en dado caso se usa otra aplicarla en el array
                    $ip_privada = array(
                          '/^0\./',
                          '/^127\.0\.0\.1/',
                          '/^192\.168\..*/',
                          '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                          '/^10\..*/'
                    );
                    $ip_encontrada = preg_replace($ip_privada, $ip_cliente, $lista_ip[1]);
                    if ($ip_cliente != $ip_encontrada) {
                       $ip_cliente = $ip_encontrada;
                       break;
                    }
                }
            }
        }else{
            $ip_cliente =( !empty($_SERVER['REMOTE_ADDR']) ) ?$_SERVER['REMOTE_ADDR']:( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR']: "desconocida" );
        }
        return ($ip_cliente=="::1")?"localhost":$ip_cliente;
    }
   
    function getBrowser() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $browser = explode(" ",$userAgent);
        return end($browser);
    }  
}
//  Fin de la clase
?>