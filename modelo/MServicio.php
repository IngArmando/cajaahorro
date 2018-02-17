<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Cargos
//--------------------------------------------------------------------
class Servicio extends CModeloDatos  {
     private $IdServicio;
     private $IdModulo;
     private $Desc;
     private $IdTipoVis;
     private $IdIcon;
     private $Status;
     private $Pos;
     private $URL;


//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->IdServicio = "";
       $this->IdModulo   = "";
       $this->Desc       = "";
       $this->IdTipoVis  = "";
       $this->IdIcon     = "";
       $this->Status     = "";
       $this->Pos        = "";
       $this->URL        = "";

     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdServicio ( $valor ){  $this->IdServicio = $valor;   }
    public function setIdModulo   ( $valor ){  $this->IdModulo   = $valor;   }
    public function setDesc       ( $valor ){  $this->Desc       = $valor;   }
    public function setIdTipoVis  ( $valor ){  $this->IdTipoVis  = $valor;   }
    public function setIdIcon     ( $valor ){  $this->IdIcon     = $valor;   }
    public function setPos        ( $valor ){  $this->Pos        = $valor;   }
    public function setURL        ( $valor ){  $this->URL        = $valor;   }
    public function setStatus     ( $valor ){  $this->Status     = $valor;   }

//--------------------------------------------------------------------
//       Registrar
//--------------------------------------------------------------------

    public function registrar() {
        $sql = "INSERT INTO cappiutep.t_servicio(
                            id_servicio,
                            id_modulo,
                            descripcion,
                            id_tipo_vista,
                            id_icono,
                            url,
                            posicion                            
                           )
                       VALUES (
                             $this->IdServicio,
                             $this->IdModulo,
                             '$this->Desc',
                             $this->IdTipoVis,
                             $this->IdIcon,
                             '$this->URL',
                             $this->Pos
                             );";
       return $this->consulta( $sql );
    }

//--------------------------------------------------------------------
//       Obtener Siguiente ID 
//--------------------------------------------------------------------

    public function SigID() {
      $sql = "SELECT MAX(id_servicio) AS mayor FROM cappiutep.t_servicio";
      $registro =  $this->consulta( $sql );
      if ($fila = $this->getArreglo( $registro )) $num = $fila['mayor']+1;
      return $num;
    }
//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
    public function modificar()  
    {
        $sql="UPDATE cappiutep.t_servicio 
              SET descripcion    = '$this->Desc',
                  id_modulo      = $this->IdModulo,
                  id_tipo_vista  = $this->IdTipoVis,
                  id_icono       = $this->IdIcon,
                  posicion       = $this->Pos,
                  url            = '$this->URL'
               WHERE id_servicio = $this->IdServicio";
        return $this->consulta( $sql );

    }
//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
    public function consultar()  
    {
        $sql="SELECT * FROM cappiutep.t_servicio
               WHERE id_servicio = $this->IdServicio";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function activar()  
    {
        $sql="UPDATE cappiutep.t_servicio
                 SET estatus = '1'
               WHERE id_servicio= $this->IdServicio";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function desactivar()  
    {
        $sql="UPDATE cappiutep.t_servicio
                 SET estatus = '0'
               WHERE id_servicio= $this->IdServicio";
        return $this->consulta( $sql );

    }


    public function listarServicios($modulo)
    {
      $registro=$this->ejecutar("SELECT * FROM cappiutep.t_servicio where id_modulo ='$modulo'");
      while($data = $this->setArreglo($registro)) $datos[] = $data;
      return $datos;
    }

//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


	public function listar()	
	{

		$sql="SELECT a.*,b.descripcion as modulo,c.icono
              FROM
                 cappiutep.t_servicio AS a
                 LEFT  JOIN cappiutep.t_icono  AS c ON a.id_icono=c.id_icono
                 INNER JOIN cappiutep.t_modulo AS b ON a.id_modulo=b.id_modulo
                 ORDER BY a.descripcion ASC;;";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";		
		$MarcasSelect[$pos++] =" <thead><tr>
                  <th>Icono</th>
                  <th>Servicio</th>
									<th>Módulo</th>
                  <th class='collapsing'>Estatus</th>
									<th class='collapsing'>Acciones</th>
								</tr></thead>
								<tbody>";	
		
		$resulSet = $this->consulta( $sql ) ; 
		while($row= $this->getArreglo($resulSet))		
		{	
		
			switch ($row['estatus']) {
				case '1':
          $status="<div class='ui green horizontal fluid label'> Activo </div>";
					$acciones="<a class='ui labeled icon button' data-content='Editar' data-variation='basic' href='ConfigServicioEditar.php?id=".$row['id_servicio']."'>
                       <i class='edit icon'></i>
                       Editar
                     </a>
                     <a class='ui red icon button' data-content='Desactivar' data-variation='basic' href='../../controlador/CServicioOff.php?id=".$row['id_servicio']."'>
                       <i class='remove icon'></i>
                     </a>
                     ";
          break;

        case '0':
          $status="<div class='ui red horizontal fluid label'> Inactivo   </div>";
          $acciones="<a class='ui green icon button' data-content='Activar' data-variation='basic' href='../../controlador/CServicioOn.php?id=".$row['id_servicio']."'>
                       <i class='checkmark icon'></i>
                     </a>";
          break;

			}		

			$MarcasSelect[$pos++]="<tr>
									 <td><i class='large ".$row['icono']." icon'><i/></td>
                   <td >".$row['descripcion']."</td>
									 <td >".$row['modulo']."</td>
									 <td class='collapsing'>".$status."</td>
									 <td class='collapsing'>".$acciones."</td>
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