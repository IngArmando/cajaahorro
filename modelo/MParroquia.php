<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Lista
//--------------------------------------------------------------------
class Parroquia extends CModeloDatos  {
     private $IdParroquia;
     private $Parroquia;
     private $Estatus;
     private $IdMunicipio;

//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->IdParroquia = "";
       $this->Parroquia   = "";
       $this->Estatus     = 1;
       $this->IdMunicipio = "";

     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdParroquia ( $valor ){  $this->IdParroquia = $valor;   }
    public function setParroquia   ( $valor ){  $this->Parroquia   = $valor;   }
    public function setEstatus     ( $valor ){  $this->Estatus     = $valor;   }
    public function setIdMunicipio ( $valor ){  $this->IdMunicipio = $valor;   }

//--------------------------------------------------------------------
//       Activar registro
//--------------------------------------------------------------------
    public function activar()  
    {
        $sql="UPDATE cappiutep.t_parroquia 
              	 SET estatus = '1'
               WHERE id_municipio = $this->IdMunicipio";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function desactivar()  
    {
        $sql="UPDATE cappiutep.t_parroquia 
              	 SET estatus = '0'
               WHERE id_municipio = $this->IdMunicipio";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


	public function listar($IdPadre)	
	{

		$sql="SELECT * FROM cappiutep.t_parroquia WHERE id_municipio=$IdPadre;";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";		
		$MarcasSelect[$pos++] =" <thead><tr>
									<th>N°</th>
									<th>Parroquia</th>
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
									 <td class='collapsing'>".$row['id_parroquia']."</td>
									 <td>".$row['parroquia']."</td>
									 <td class='collapsing'>".$status."</td>
									 <td class='collapsing'>
									    
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