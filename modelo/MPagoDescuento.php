<?php
include_once("MPgsql.php");
//--------------------------------------------------------------------
//       Clase Cargos
//--------------------------------------------------------------------
class PagoDescuento extends CModeloDatos  {
     private $IdPagoDescuento;
     private $IdPersona;
     private $IdBeneficio;
     private $IdDetalle;
     private $Status;


//--------------------------------------------------------------------
//       Constructor
//--------------------------------------------------------------------
    public function __construct()  {

       parent::__construct();
       $this->IdPagoDescuento = "";
       $this->IdPersona     = "";
       $this->IdBeneficio   = "";
       $this->IdDetalle  = "";
       $this->Status   = "";


     }
//--------------------------------------------------------------------
//       Metodos Set
//--------------------------------------------------------------------

    public function setIdPagoDescuento ( $valor ){  $this->IdPagoDescuento = $valor;   }
    public function setIdPersona     ( $valor ){  $this->IdPersona     = $valor;   }
    public function setIdBeneficio   ( $valor ){  $this->IdBeneficio   = $valor;   }
    public function setIdDetalle  ( $valor ){  $this->IdDetalle  = $valor;   }
    public function setStatus   ( $valor ){  $this->Status   = $valor;   }

//--------------------------------------------------------------------
//       Registrar
//--------------------------------------------------------------------

    public function registrar() {
        $sql = "INSERT INTO cappiutep.t_pago_descuento(
                            id_persona,
                            id_beneficio_solicitud,
                            id_detalle_amortizacion,
                            fecha,
                            estatus
                           )
                       VALUES (
                             $this->IdPersona,
                             $this->IdBeneficio,
                             $this->IdDetalle,
                             current_date,
                             '1'
                             );";
       return $this->consulta( $sql );
    }

    public function cambiar_estatus()  
    {
        $sql="UPDATE cappiutep.t_detalle_amortizacion 
              SET estatus = '1'
               WHERE id_detalle_amortizacion = $this->IdDetalle";
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
      $registro = $this->ejecutar("SELECT a.fecha,CONCAT(b.cedula,b.nacionalidad,' / ',b.nombre1,' ',b.apellido1) AS persona,c.pago
              FROM
                 cappiutep.t_pago_descuento AS a
                 INNER JOIN cappiutep.t_persona AS b ON b.id_persona=a.id_persona
                 INNER JOIN cappiutep.t_detalle_amortizacion AS c ON c.id_detalle_amortizacion=a.id_detalle_amortizacion
                 ORDER BY a.id_pago_descuento ASC;");
      while($data = $this->setArreglo($registro)) $datos[] = $data;
      return $datos;
    }

    public function consultaBeneficio($id_beneficio_solicitud)
    {
      $registro = $this->ejecutar("SELECT * FROM cappiutep.t_beneficio_solicitud WHERE id_beneficio_solicitud='$id_beneficio_solicitud'");
      while($data = $this->setArreglo($registro)) $datos = $data;
      return $datos;
    }

    public function consultaDetalleAmortizacion($id_beneficio_solicitud)
    {
      $registro = $this->ejecutar("SELECT * FROM cappiutep.t_detalle_amortizacion WHERE id_beneficio_solicitud='$id_beneficio_solicitud' ORDER BY nro ASC");
      while($data = $this->setArreglo($registro)) $datos[] = $data;
      return $datos;
    }
//--------------------------------------------------------------------
//       Listar registros
//--------------------------------------------------------------------


	public function listar()	
	{

		$sql = "SELECT a.fecha,CONCAT(b.cedula,b.nacionalidad,' / ',b.nombre1,' ',b.apellido1) AS persona,c.pago,c.saldo
              FROM
                 cappiutep.t_pago_descuento AS a
                 INNER JOIN cappiutep.t_persona AS b ON b.id_persona=a.id_persona
                 INNER JOIN cappiutep.t_detalle_amortizacion AS c ON c.id_detalle_amortizacion=a.id_detalle_amortizacion
                 ORDER BY a.id_pago_descuento DESC;";

		$MarcasSelect = array();
		$pos=0;		
		$MarcasSelect[$pos++] =" <table class='ui celled center aligned compact table' id='Tabla'>";		
		$MarcasSelect[$pos++] =" <thead><tr>
                  <th>Fecha</th>
                  <th>Persona</th>
									<th>Cuota</th>
                  <th>Saldo</th>
								</tr></thead>
								<tbody>";	
		
		$resulSet = $this->consulta( $sql ) ; 
		while($row= $this->getArreglo($resulSet))		
		{	
		  $Fecha = explode('-',$row['fecha']);
			$MarcasSelect[$pos++]="<tr>
									 <td> ".$Fecha[2].'-'.$Fecha[1].'-'.$Fecha[0]." </td>
									 <td> ".$row['persona']." </td>
                   <td> ".$row['pago']." </td>
                   <td> ".$row['saldo']." </td>
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