<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Lista
//--------------------------------------------------------------------
class Organizacion extends CModeloDatos  {
     private $IdOrg;
     private $Razon;
     private $Siglas;
     private $DirFiscal;
     private $Telf;
     private $Email;
     private $Rif;
     private $Nit;
     private $Estatus;

//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

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

     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdOrg    ( $valor ){  $this->IdOrg     = $valor;   }
    public function setRazon    ( $valor ){  $this->Razon     = $valor;   }
    public function setSiglas   ( $valor ){  $this->Siglas    = $valor;   }
    public function setDirFiscal( $valor ){  $this->DirFiscal = $valor;   }
    public function setTelf     ( $valor ){  $this->Telf      = $valor;   }
    public function setEmail    ( $valor ){  $this->Email     = $valor;   }
    public function setRif      ( $valor ){  $this->Rif       = $valor;   }
    public function setNit      ( $valor ){  $this->Nit       = $valor;   }
    public function setEstatus  ( $valor ){  $this->Estatus   = $valor;   }

//--------------------------------------------------------------------
//       Registrar
//--------------------------------------------------------------------

    public function registrar() {
        $sql = "INSERT INTO cappiutep.t_organizacion(
        									  razon_social,
        									  siglas,
        									  dir_fiscal,
        									  telefono,
        									  email,
        									  rif,
        									  nit,
        									  posicion
        									 )
        							 VALUES (
        							 	     '$this->Razon',
        							 		 '$this->Siglas',
        							 	     '$this->NombreCorto',
        							 	     '$this->DirFiscal',
        							 	     '$this->Telf',
        							 	     '$this->Email',
        							 	     '$this->Rif',
        							 	     '$this->Nit'
        							 	     );";
       return $this->consulta( $sql );
    }


//--------------------------------------------------------------------
//       Activar registro
//--------------------------------------------------------------------
    public function activar()  
    {
        $sql="UPDATE cappiutep.t_organizacion
              	 SET estatus = '1'
               WHERE id_organizacion= $this->IdOrg";
        return $this->consulta( $sql );

    }


//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function desactivar()  
    {
        $sql="UPDATE cappiutep.t_organizacion
              	 SET estatus = '0'
               WHERE id_organizacion= $this->IdOrg";
        return $this->consulta( $sql );

    }


//--------------------------------------------------------------------
//       Desactivar registro
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
//       Consultar registro
//--------------------------------------------------------------------
    public function consultar()  
    {
        $sql="SELECT * FROM cappiutep.t_organizacion;";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


	public function listar()	
	{

		$sql="SELECT * FROM cappiutep.t_organizacion;";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";		
		$MarcasSelect[$pos++] =" <thead><tr>
									<th>R.I.F</th>
									<th>Razon Social</th>
									<th>Silgas</th>
									<th>Estatus</th>
									<th>Acciones</th>
								</tr></thead>
								<tbody>";	
		
		$resulSet = $this->consulta( $sql ) ; 
		while($row= $this->getArreglo($resulSet))		
		{	
			
			$editar="<a class='ui labeled icon button' href='ConfigOrganizacionEditar.php?id=".$row['id_organizacion']."'>
						<i class='edit icon'></i>
						Editar
                     </a>";
			

			switch ($row['estatus']) {
				case 'f':
					$status="<div class='ui red horizontal fluid label'> Desactivado </div>";
					$accion="<a class='ui icon mini green button' data-content='Activar' data-variation='basic' href='../../ctrl/CActivar.php?id=".$row['']."'>
								<i class='checkmark icon'></i>
                             </a>";
					break;

				case 't':
					$status="<div class='ui green horizontal fluid label'> Activo   </div>";
					$accion="<a class='ui icon red mini button' data-content='Desactivar' data-variation='basic' href='../../ctrl/CDesactivar.php?id=".$row['']."'>
								<i class='remove icon'></i>
                             </a>";
					break;

			}		

			$MarcasSelect[$pos++]="<tr>
									 <td class='collapsing'>".$row['rif']."</td>
									 <td>".$row['razon_social']."</td>
									 <td >".$row['siglas']."</td>
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