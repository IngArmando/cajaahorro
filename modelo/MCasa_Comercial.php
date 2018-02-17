<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Cargos
//--------------------------------------------------------------------
class Casa_Comercial extends CModeloDatos  {
     private $id_casa_comercial;
     private $descripcion;
     private $tipo_comision;
     private $comision;
     private $Status;


//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->id_casa_comercial = "";
       $this->descripcion     = "";
       $this->tipo_comision   = "";
       $this->comision  = "";
       $this->Status   = "";


     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setid_casa_comercial ( $valor ){  $this->id_casa_comercial = $valor;   }
    public function setdescripcion     ( $valor ){  $this->descripcion     = $valor;   }
    public function settipo_comision   ( $valor ){  $this->tipo_comision   = $valor;   }
    public function setcomision  ( $valor ){  $this->comision  = $valor;   }
    public function setStatus   ( $valor ){  $this->Status   = $valor;   }

//--------------------------------------------------------------------
//       Registrar
//--------------------------------------------------------------------

    public function registrar() {
        $sql = "INSERT INTO cappiutep.t_casa_comercial(
                descripcion,
                tipo_comision,
                comision
               )
           VALUES (
                 '$this->descripcion',
                 '$this->tipo_comision',
                 '$this->comision'
                 );";
       return $this->consulta( $sql );
    }

//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
    public function consultar()  
    {
        $sql="SELECT * FROM cappiutep.t_casa_comercial 
               WHERE id_casa_comercial = $this->id_casa_comercial";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
    public function modificar()  
    {
        $sql="UPDATE cappiutep.t_casa_comercial 
              SET descripcion = '$this->descripcion',
                  tipo_comision    = '$this->tipo_comision',
                  comision    = '$this->comision'
               WHERE id_casa_comercial = $this->id_casa_comercial";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function activar()  
    {
        $sql="UPDATE cappiutep.t_casa_comercial
                 SET estatus = '1'
               WHERE id_casa_comercial= $this->id_casa_comercial";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function desactivar()  
    {
        $sql="UPDATE cappiutep.t_casa_comercial
                 SET estatus = '0'
               WHERE id_casa_comercial= $this->id_casa_comercial";
        return $this->consulta( $sql );

    }


    public function listarCasa_Comercials()
    {
      $registro = $this->ejecutar("SELECT a.*,b.icono
              FROM
                 cappiutep.t_casa_comercial AS a
                 LEFT JOIN cappiutep.t_icono AS b ON a.tipo_comision=b.tipo_comision
                 ORDER BY a.descripcion ASC;");
      while($data = $this->setArreglo($registro)) $datos[] = $data;
      return $datos;
    }
//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


	public function listar()	
	{

		$sql="SELECT * 
        FROM
          cappiutep.t_casa_comercial
        ORDER BY descripcion ASC;";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";		
		$MarcasSelect[$pos++] =" <thead><tr>
                  <th> Nombre </th>
									<th> Tipo de Comisión </th>
                  <th> Comisión </th>
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
					$acciones="<a class='ui labeled icon button' data-content='Editar' data-variation='basic' href='Casa_Comercial_Editar.php?id=".$row['id_casa_comercial']."'>
                       <i class='edit icon'></i>
                       Editar
                     </a>
                     <a class='ui red icon button' data-content='Desactivar' data-variation='basic' href='../../controlador/CCasa_ComercialOff.php?id=".$row['id_casa_comercial']."'>
                       <i class='remove icon'></i>
                     </a>
                     ";
					break;

        case '0':
          $status="<div class='ui red horizontal fluid label'>Inactivo</div>";
          $acciones="<a class='ui green icon button' data-content='Activar' data-variation='basic' href='../../controlador/CCasa_ComercialOn.php?id=".$row['id_casa_comercial']."'>
                       <i class='checkmark icon'></i>
                     </a>";
          break;

			}		

      $tipo_comision = ( $row['tipo_comision'] == '1' ) ? "<span style='color:blue;'> <b> Pago Fijo </b> </span>" : "<span style='color:red;'> <b> Porcentaje </b> </span>";

			$MarcasSelect[$pos++]="<tr>
									 <td>".$row['descripcion']."</td>
									 <td >".$tipo_comision."</td>
                   <td >".$row['comision']."</td>
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