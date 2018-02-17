<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Cargos
//--------------------------------------------------------------------
class Modulo extends CModeloDatos  {
     private $IdModulo;
     private $Desc;
     private $IdIcon;
     private $IdPadre;
     private $Pos;
     private $Status;


//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->IdModulo = "";
       $this->Desc     = "";
       $this->IdIcon   = "";
       $this->IdPadre  = "";
       $this->Pos      = "";
       $this->Status   = "";


     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdModulo ( $valor ){  $this->IdModulo = $valor;   }
    public function setDesc     ( $valor ){  $this->Desc     = $valor;   }
    public function setIdIcon   ( $valor ){  $this->IdIcon   = $valor;   }
    public function setIdPadre  ( $valor ){  $this->IdPadre  = $valor;   }
    public function setPos      ( $valor ){  $this->Pos      = $valor;   }
    public function setStatus   ( $valor ){  $this->Status   = $valor;   }

//--------------------------------------------------------------------
//       Registrar
//--------------------------------------------------------------------

    public function registrar() {
        $sql = "INSERT INTO cappiutep.t_modulo(
                            descripcion,
                            id_icono,
                            id_padre,
                            posicion                            
                           )
                       VALUES (
                             '$this->Desc',
                             $this->IdIcon,
                             $this->IdPadre,
                             $this->Pos
                             );";
       return $this->consulta( $sql );
    }

//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
    public function consultar()  
    {
        $sql="SELECT * FROM cappiutep.t_modulo 
               WHERE id_modulo = $this->IdModulo";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
    public function modificar()  
    {
        $sql="UPDATE cappiutep.t_modulo 
              SET descripcion = '$this->Desc',
                  id_icono    = $this->IdIcon,
                  id_padre    = $this->IdPadre,
                  posicion    = $this->Pos
               WHERE id_modulo = $this->IdModulo";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function activar()  
    {
        $sql="UPDATE cappiutep.t_modulo
                 SET estatus = '1'
               WHERE id_modulo= $this->IdModulo";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function desactivar()  
    {
        $sql="UPDATE cappiutep.t_modulo
                 SET estatus = '0'
               WHERE id_modulo= $this->IdModulo";
        return $this->consulta( $sql );

    }


    public function listarModulos()
    {
      $registro = $this->ejecutar("SELECT a.*,b.icono
              FROM
                 cappiutep.t_modulo AS a
                 LEFT JOIN cappiutep.t_icono AS b ON a.id_icono=b.id_icono
                 ORDER BY a.descripcion ASC;");
      while($data = $this->setArreglo($registro)) $datos[] = $data;
      return $datos;
    }
//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


	public function listar()	
	{

		$sql="SELECT a.*,b.icono
              FROM
                 cappiutep.t_modulo AS a
                 LEFT JOIN cappiutep.t_icono AS b ON a.id_icono=b.id_icono
                 ORDER BY a.descripcion ASC;";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";		
		$MarcasSelect[$pos++] =" <thead><tr>
                  <th>Icono</th>
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
					$acciones="<a class='ui labeled icon button' data-content='Editar' data-variation='basic' href='ConfigModuloEditar.php?id=".$row['id_modulo']."'>
                       <i class='edit icon'></i>
                       Editar
                     </a>
                     <a class='ui red icon button' data-content='Desactivar' data-variation='basic' href='../../controlador/CModuloOff.php?id=".$row['id_modulo']."'>
                       <i class='remove icon'></i>
                     </a>
                     ";
					break;

        case '0':
          $status="<div class='ui red horizontal fluid label'>Inactivo</div>";
          $acciones="<a class='ui green icon button' data-content='Activar' data-variation='basic' href='../../controlador/CModuloOn.php?id=".$row['id_modulo']."'>
                       <i class='checkmark icon'></i>
                     </a>";
          break;

			}		

			$MarcasSelect[$pos++]="<tr>
									 <td><i class='large ".$row['icono']." icon'><i/></td>
									 <td >".$row['descripcion']."</td>
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