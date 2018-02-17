<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Lista
//--------------------------------------------------------------------
class Lista extends CModeloDatos  {
     private $IdLista;
     private $Nombre;
     private $Estatus;
     private $Bloquado;

//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->IdLista = "";
       $this->Nombre = "";
       $this->Estatus = 1;
       $this->Bloquado = "";

     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdLista  ( $valor ){  $this->IdLista   = $valor;   }
    public function setNombre   ( $valor ){  $this->Nombre    = $valor;   }
    public function setBloqueado( $valor ){  $this->Bloqueado = $valor;   }

//--------------------------------------------------------------------
//       Registrar
//--------------------------------------------------------------------

    public function registrar() {
        $sql = "INSERT INTO cappiutep.t_lista(
        									  nombre,
        									  bloqueado
        									 )
        							 VALUES ('$this->Nombre',
        							 	     '$this->Bloqueado');";
       return $this->consulta( $sql );
    }


//--------------------------------------------------------------------
//       Activar registro
//--------------------------------------------------------------------
    public function activar()  
    {
        $sql="UPDATE cappiutep.t_lista 
              	 SET estatus = '1'
               WHERE id_lista= $this->IdLista";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function desactivar()  
    {
        $sql="UPDATE cappiutep.t_lista 
              	 SET estatus = '0'
               WHERE id_lista= $this->IdLista";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Consultar registros
//--------------------------------------------------------------------
    public function consultar()  
    {
        $sql="SELECT * FROM cappiutep.t_lista WHERE id_lista = $this->IdLista";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


	public function listar()	
	{

		$sql="SELECT * FROM cappiutep.t_lista;";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";		
		$MarcasSelect[$pos++] =" <thead><tr>
									<th>Número</th>
									<th>Nombre</th>
									<th>Condición</th>
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
			switch ($row['bloqueado']) {
				case '0':
					$bloqueo="<div class='ui fluid label'><i class='unlock icon'></i> Desbloqueado </div>";
					break;

				case '1':
					$bloqueo="<div class='ui fluid label'><i class='lock icon'></i> Bloqueado   </div>";
					break;

			}

			$MarcasSelect[$pos++]="<tr>
									 <td class='collapsing'>".$row['id_lista']."</td>
									 <td>".$row['nombre']."</td>
									 <td class='collapsing'>".$bloqueo."</td>
									 <td class='collapsing'>".$status."</td>
									 <td class='collapsing'>
									    <a class='ui labeled icon button' data-content='Configurar' data-variation='basic' href='ConfigListaValores.php?id=".$row['id_lista']."'>
											<i class='configure icon'></i>
											Configurar valores
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