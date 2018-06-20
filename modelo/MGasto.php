<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Cargos
//--------------------------------------------------------------------
class Gasto extends CModeloDatos  {
     private $cod_gasto;
     private $descripcion;
     private $monto;
     private $ano;
     private $mes;
     private $tipo;
     private $fondo;


//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->cod_gasto = "";
       $this->descripcion     = "";
       $this->monto     = "";
       $this->ano     = "";
       $this->mes     = "";
       $this->tipo   = "";
       $this->fondo   = "";


     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setcod_gasto ( $valor ){  $this->cod_gasto = $valor;   }
    public function setdescripcion     ( $valor ){  $this->descripcion     = $valor;   }
    public function setmonto     ( $valor ){  $this->monto     = $valor;   }
    public function setano     ( $valor ){  $this->ano     = $valor;   }
    public function setmes     ( $valor ){  $this->mes     = $valor;   }
    public function settipo   ( $valor ){  $this->tipo   = $valor;   }
    public function setfondo   ( $valor ){  $this->fondo   = $valor;   }

//--------------------------------------------------------------------
//       Registrar
//--------------------------------------------------------------------

    public function registrar() {
        echo $sql = "INSERT INTO cappiutep.gasto(
                detalle,
                tipo,
                mes,
                ano,
                valor,
                fondo
               )
           VALUES (
                 '$this->descripcion',
                 '$this->tipo',
                 '$this->mes',
                 '$this->ano',
                 '$this->monto',
                 $this->fondo
                 );";
       return $this->consulta( $sql );
    }

//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
    public function consultar()  
    {
        $sql="SELECT * FROM cappiutep.gasto 
               WHERE cod_gasto = $this->cod_gasto";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Consultar registro
//--------------------------------------------------------------------
    public function modificar()  
    {
        $sql="UPDATE cappiutep.gasto 
              SET descripcion = '$this->descripcion',
                  id_persona    = '$this->id_persona',
                  id_casa_comercial    = '$this->id_casa_comercial',
                  monto    = '$this->monto',
                  ano    = '$this->ano',
                  mes    = '$this->mes'
               WHERE cod_gasto = $this->cod_gasto";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function activar()  
    {
        $sql="UPDATE cappiutep.gasto
                 SET estatus = '1'
               WHERE cod_gasto= $this->cod_gasto";
        return $this->consulta( $sql );

    }

//--------------------------------------------------------------------
//       Desactivar registro
//--------------------------------------------------------------------
    public function desactivar()  
    {
        $sql="UPDATE cappiutep.gasto
                 SET estatus = '0'
               WHERE cod_gasto= $this->cod_gasto";
        return $this->consulta( $sql );

    }


    public function listarCompras()
    {
      $registro = $this->ejecutar("SELECT a.*,b.icono
              FROM
                 cappiutep.gasto AS a
                 LEFT JOIN cappiutep.t_icono AS b ON a.id_persona=b.id_persona
                 ORDER BY a.descripcion ASC;");
      while($data = $this->setArreglo($registro)) $datos[] = $data;
      return $datos;
    }
//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------

  function meses($me)
  {
    # code...
    if($me == 1){ $mess="Enero" ;}
    if($me == 2){ $mess="Febrero" ;}
    if($me == 3){ $mess="Marzo" ;}
    if($me == 4){ $mess="Abril" ;}
    if($me == 5){ $mess="Mayo" ;}
    if($me == 6){ $mess="Junio" ;}
    if($me == 7){ $mess="Julio" ;}
    if($me == 8){ $mess="Agosto" ;}
    if($me == 9){ $mess="Septiembre" ;}
    if($me == 10){ $mess="Octubre" ;}
    if($me == 11){ $mess="Noviembre" ;}
    if($me == 12){ $mess="Diciembre" ;}

    return $mess;
  }

	public function listar()	
	{

		$sql="SELECT a.*, CONCAT(b.nacionalidad,'-',b.cedula,' / ',b.nombre1,' ',b.apellido1) AS persona, c.descripcion AS casa_comercial
        FROM cappiutep.gasto AS a
          INNER JOIN cappiutep.t_persona AS b ON a.id_persona=b.id_persona
          INNER JOIN cappiutep.t_casa_comercial AS c ON a.id_casa_comercial=c.id_casa_comercial
        ORDER BY a.cod_gasto DESC;";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";		
		$MarcasSelect[$pos++] =" <thead><tr>
                  <th> Fecha </th>
                  <th> Solicitante </th>
									<th> Casa Comercial </th>
                  <th> Monto </th>
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
					$acciones="<a class='ui labeled icon button' data-content='Editar' data-variation='basic' href='Compra_Editar.php?id=".$row['cod_gasto']."'>
                       <i class='edit icon'></i>
                       Editar
                     </a>
                     <a class='ui red icon button' data-content='Desactivar' data-variation='basic' href='../../controlador/CCompraOff.php?id=".$row['cod_gasto']."'>
                       <i class='remove icon'></i>
                     </a>
                     ";
					break;

        case '0':
          $status="<div class='ui red horizontal fluid label'>Inactivo</div>";
          $acciones="<a class='ui green icon button' data-content='Activar' data-variation='basic' href='../../controlador/CCompraOn.php?id=".$row['cod_gasto']."'>
                       <i class='checkmark icon'></i>
                     </a>";
          break;

			}		

			$MarcasSelect[$pos++]="<tr>
									 <td >".$this->meses($row['mes'])." - ".$row['ano']."</td>
                   <td >".$row['persona']."</td>
                   <td >".$row['casa_comercial']."</td>
                   <td >".$row['monto']."</td>
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