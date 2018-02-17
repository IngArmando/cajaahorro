<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Lista
//--------------------------------------------------------------------
class ListaValores extends CModeloDatos  {
     private $IdListaValor;
     private $IdLista;
     private $NombreLargo;
     private $NombreCorto;
     private $Posicion;
     private $Estatus;

//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->IdListaValor = "";
       $this->IdLista     = "";
       $this->NombreLargo = "";
       $this->NombreCorto = "";
       $this->IdPadre = "";
       $this->Posicion = "";
       $this->Estatus = "1";

     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdListaValor  ( $valor ){  $this->IdListaValor   = $valor;   }
    public function setIdLista       ( $valor ){  $this->IdLista        = $valor;   }
    public function setNombreLargo   ( $valor ){  $this->NombreLargo    = $valor;   }
    public function setNombreCorto   ( $valor ){  $this->NombreCorto    = $valor;   }
    public function setIdPadre       ( $valor ){  $this->IdPadre        = $valor;   }
    public function setPosicion      ( $valor ){  $this->Posicion       = $valor;   }
    public function setEstatus       ( $valor ){  $this->Estatus        = $valor;   }

//--------------------------------------------------------------------
//       Registrar
//--------------------------------------------------------------------

    public function registrar() {
        $sql = "INSERT INTO cappiutep.t_lista_valor(
        									  id_lista,
        									  nombre_largo,
        									  nombre_corto,
        									  id_padre,
        									  posicion
        									 )
        							 VALUES (
        							 	      $this->IdLista,
        							 		 '$this->NombreLargo',
        							 	     '$this->NombreCorto',
        							 	      $this->IdPadre,
        							 	      $this->Posicion
        							 	     );";
       return $this->consulta( $sql );
    }


//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function activar()  
    {
        $sql="UPDATE cappiutep.t_lista_valor
              	 SET estatus = '1'
               WHERE id_lista_valor= $this->IdListaValor";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function desactivar()  
    {
        $sql="UPDATE cappiutep.t_lista_valor
              	 SET estatus = '0'
               WHERE id_lista_valor= $this->IdListaValor";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function modificar()  
    {
        $sql="UPDATE cappiutep.t_lista_valor 
              	 SET nombre_largo   = '$this->NombreLargo',
              	 	 nombre_corto   = '$this->NombreCorto',
              	 	 posicion       = $this->Posicion,
              	 	 id_padre       = $this->IdPadre
               WHERE id_lista_valor = $this->IdListaValor;";
        return $this->consulta( $sql );

    }


//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
    public function consultar()  
    {
        $sql="SELECT * FROM cappiutep.t_lista_valor
               WHERE id_lista_valor = $this->IdListaValor";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


	public function listar($ListaPadre)	
	{

		$sql="SELECT a.*,b.nombre,b.bloqueado
              FROM
                 cappiutep.t_lista_valor AS a
                 INNER JOIN cappiutep.t_lista AS b ON a.id_lista=b.id_lista WHERE a.id_lista = $ListaPadre;";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";		
		$MarcasSelect[$pos++] =" <thead><tr>
									<th>Posición</th>
									<th>Nombre</th>
									<th>Abreviación</th>
									<th>Estatus</th>
									<th>Acciones</th>
								</tr></thead>
								<tbody>";	
		
		$resulSet = $this->consulta( $sql ) ; 
		while($row= $this->getArreglo($resulSet))		
		{	
			$editar=NULL;
			if ($row['bloqueado']=='f') {
				$editar="<a class='ui labeled icon button' data-content='Editar' data-variation='basic' href='ConfigListaValoresEditar.php?id=".$row['id_lista_valor']."'>
							<i class='edit icon'></i>
							Editar
                         </a>";
			}

			switch ($row['estatus']) {
				case '0':
					$status="<div class='ui red horizontal fluid label'> Desactivado </div>";
					$accion="<a class='ui icon mini green button' data-content='Activar' data-variation='basic' href='../../ctrl/CListaValoresActivar.php?id=".$row['id_lista_valor']."'>
								<i class='checkmark icon'></i>
                             </a>";
					break;

				case '1':
					$status="<div class='ui green horizontal fluid label'> Activo   </div>";
					$accion="<a class='ui icon red mini button' data-content='Desactivar' data-variation='basic' href='../../ctrl/CListaValoresDesactivar.php?id=".$row['id_lista_valor']."'>
								<i class='remove icon'></i>
                             </a>";
					break;

			}		

			$MarcasSelect[$pos++]="<tr>
									 <td class='collapsing'>".$row['posicion']."</td>
									 <td>".$row['nombre_largo']."</td>
									 <td >".$row['nombre_corto']."</td>
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