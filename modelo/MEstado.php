<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Lista
//--------------------------------------------------------------------
class Estado extends CModeloDatos  {
     private $IdEstado;
     private $Estado;
     private $Estatus;

//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->IdEstado = "";
       $this->Estado = "";
       $this->Estatus = 1;

     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdEstado ( $valor ){  $this->IdEstado = $valor;   }
    public function setEstado   ( $valor ){  $this->Estado   = $valor;   }
    public function setEstatus  ( $valor ){  $this->Estatus  = $valor;   }

//--------------------------------------------------------------------
//       Activar registro
//--------------------------------------------------------------------
    public function activar()  
    {
        $sql="UPDATE cappiutep.t_estado 
              	 SET estatus = '1'
               WHERE id_estado= $this->IdEstado";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function desactivar()  
    {
        $sql="UPDATE cappiutep.t_estado 
              	 SET estatus = '0'
               WHERE id_estado= $this->IdEstado";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function consultar()  
    {
        $sql="SELECT * FROM cappiutep.t_estado WHERE id_estado= $this->IdEstado";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


	public function listar()	
	{

		$sql="SELECT * FROM cappiutep.t_estado ORDER BY estatus ASC;";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";		
		$MarcasSelect[$pos++] =" <thead><tr>
									<th>N°</th>
									<th>Estado</th>
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
					break;

				case '1':
					$status="<div class='ui green horizontal fluid label'> Activo   </div>";
					break;
			}

			$MarcasSelect[$pos++]="<tr>
									 <td class='collapsing'>".$row['id_estado']."</td>
									 <td>".$row['estado']."</td>
									 <td class='collapsing'>".$status."</td>
									 <td class='collapsing'>
									    <a class='ui labeled icon button' data-content='Configurar' data-variation='basic' href='ConfigMunicipio.php?id=".$row['id_estado']."'>
											<i class='configure icon'></i>
											Configurar Municipios
										</a>
									 </td>
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