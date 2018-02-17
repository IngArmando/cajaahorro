<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Cargos
//--------------------------------------------------------------------
class BitAcc extends CModeloDatos  {
     private $IdBitAcc;
     private $IdUser;
     private $Msg;
     private $Fecha;
     private $Hora;
     private $Ip;
     private $Nav;


//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->IdBitAcc = "";
       $this->IdUser   = "";
       $this->Msg      = "";
       $this->Fecha    = "";
       $this->Hora     = "";
       $this->Ip       = "";
       $this->Nav      = "";


     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdBitAcc ( $valor ){  $this->IdBitAcc = $valor;   }
    public function setIdUser   ( $valor ){  $this->IdUser   = $valor;   }
    public function setMsg      ( $valor ){  $this->Msg      = $valor;   }
    public function setFecha    ( $valor ){  $this->Fecha    = $valor;   }
    public function setHora     ( $valor ){  $this->Hora     = $valor;   }
    public function setIp       ( $valor ){  $this->Ip       = $valor;   }
    public function setNav      ( $valor ){  $this->Nav      = $valor;   }



//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


	public function listar()	
	{

		$sql="SELECT a.*,b.nombre,c.nombre1,c.apellido1
              FROM
                 cappiutep.t_bitacora_acceso AS a
                 INNER JOIN cappiutep.t_usuario AS b ON a.id_usuario=b.id_usuario
                 INNER JOIN cappiutep.t_persona AS c ON b.nombre = c.cedula
                 ORDER BY id_bitacora_acceso ASC;";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] ="<table class='ui celled relaxed table' id='Tabla'>";		
		$MarcasSelect[$pos++] ="<thead><tr>
                  <th class='one wide'>N°</th>
									<th class='four wide'>Usuario</th>
                  <th class='seven wide'>Evento</th>
                  <th class='one wide'>Fecha</th>
                  <th class='one wide'>Hora</th>
                  <th class='one wide'>IP</th>
                  <th class='one wide'>Navegador</th>
								</tr></thead>
								<tbody>";	
		
		$resulSet = $this->consulta( $sql ) ; 
		while($row= $this->getArreglo($resulSet))		
		{					
      $date=date('d/m/Y',strtotime( $row['fecha']));
      $hour=date('h:i a',strtotime( $row['hora']));
			$MarcasSelect[$pos++]="<tr>
									 <td>".$row['id_bitacora_acceso']."</td>
									 <td>".$row['nombre1']." ".$row['apellido1']."</td>
                   <td>".$row['mensaje']."</td>
                   <td>".$date."</td>
                   <td>".$hour."</td>
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
    
}
//  Fin de la clase
?>