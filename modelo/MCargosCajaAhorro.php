<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Cargos
//--------------------------------------------------------------------
class Cargos extends CModeloDatos  {
     private $IdCargo;
     private $Nombre;
     private $Desc;
     private $FechaIni;
     private $FechaFin;
     private $TipoCargo;
     private $MinPers;
     private $MaxPers;
     private $Estatus;

//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->IdCargo  = "";
       $this->Nombre   = "";
       $this->Desc     = "";
       $this->FechaIni = "";
       $this->FechaFin = "";
       $this->TipoCargo = "";
       $this->MinPers  = "";
       $this->MaxPers  = "";
       $this->Estatus  = "1";

     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdCargo   ( $valor ){  $this->IdCargo   = $valor;   }
    public function setNombre    ( $valor ){  $this->Nombre    = $valor;   }
    public function setDesc      ( $valor ){  $this->Desc      = $valor;   }
    public function setFechaIni  ( $valor ){  $this->FechaIni  = $valor;   }
    public function setFechaFin  ( $valor ){  $this->FechaFin  = $valor;   }
    public function setTipoCargo ( $valor ){  $this->TipoCargo = $valor;   }
    public function setMinPers   ( $valor ){  $this->MinPers   = $valor;   }
    public function setMaxPers   ( $valor ){  $this->MaxPers   = $valor;   }
    public function setEstatus   ( $valor ){  $this->Estatus   = $valor;   }

//--------------------------------------------------------------------
//       Registrar
//--------------------------------------------------------------------

    public function registrar() {
        $sql = "INSERT INTO cappiutep.t_cargo_caja_ahorro(
        									  nombre,
        									  descripcion,
        									  fecha_ini,
                            tipo_cargo,
                            min_cant_personas,
        									  max_cant_personas
        									 )
        							 VALUES (
        							 	     '$this->Nombre',
        							 		   '$this->Desc',
        							 	     '$this->FechaIni',
        							 	      $this->TipoCargo,
                              $this->MinPers,
        							 	      $this->MaxPers
        							 	     );";
       return $this->consulta( $sql );
    }


//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function activar()  
    {
        $sql="UPDATE cappiutep.t_cargo_caja_ahorro
              	 SET estatus = '1'
               WHERE id_cargo_caja= $this->IdCargo";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function desactivar()  
    {
        $sql="UPDATE cappiutep.t_cargo_caja_ahorro
              	 SET estatus = '0'
               WHERE id_cargo_caja= $this->IdCargo";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function modificar()  
    {
        $sql="UPDATE cappiutep.t_cargo_caja_ahorro 
              	 SET nombre            = '$this->Nombre',
                     descripcion       = '$this->Desc',
                     min_cant_personas = '$this->MinPers',
              	 	   max_cant_personas = '$this->MaxPers',
              	 	   tipo_cargo        = $this->TipoCargo
               WHERE id_cargo_caja = $this->IdCargo;";
        return $this->consulta( $sql );

    }


//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
    public function consultar()  
    {
        $sql="SELECT * FROM cappiutep.t_cargo_caja_ahorro
               WHERE id_cargo_caja = $this->IdCargo";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


	public function listar()	
	{

		$sql="SELECT a.*,b.nombre_largo
              FROM
                 cappiutep.t_cargo_caja_ahorro AS a
                 INNER JOIN cappiutep.t_lista_valor AS b ON a.tipo_cargo=b.id_lista_valor;";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";		
		$MarcasSelect[$pos++] =" <thead><tr>
									<th>Nombre</th>
									<th class='collapsing'>Tipo de Cargo</th>
									<th>Estatus</th>
									<th>Acciones</th>
								</tr></thead>
								<tbody>";	
		
		$resulSet = $this->consulta( $sql ) ; 
		while($row= $this->getArreglo($resulSet))		
		{	
		
				$editar="<a class='ui labeled icon button' href='ConfigCargosCajaAhorroEditar.php?id=".$row['id_cargo_caja']."'>
    						  	<i class='edit icon'></i>
    						  	Editar
                 </a>";
		
			switch ($row['estatus']) {
				case '0':
					$status="<div class='ui red horizontal fluid label'> Desactivado </div>";
					$accion="<a class='ui icon mini green button' data-content='Activar' data-variation='basic' href='../../ctrl/ConfigCargosCajaAhorroActivar.php?id=".$row['id_cargo_caja']."'>
								<i class='checkmark icon'></i>
                             </a>";
					break;

				case '1':
					$status="<div class='ui green horizontal fluid label'> Activo   </div>";
					$accion="<a class='ui icon red mini button' data-content='Desactivar' data-variation='basic' href='../../ctrl/ConfigCargosCajaAhorroDesactivar.php?id=".$row['id_cargo_caja']."'>
								<i class='remove icon'></i>
                             </a>";
					break;

			}		

			$MarcasSelect[$pos++]="<tr>
									 <td>".$row['nombre']."</td>
									 <td >".$row['nombre_largo']."</td>
									 <td class='collapsing'>".$status."</td>
									 <td class='collapsing'><div class='ui buttons'>".$editar.$accion."</div></td>
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