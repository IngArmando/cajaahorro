<?php
	require_once("MPgsql.php"); 
	class Operacion extends CModeloDatos{
		private $articulosPagina,$limite,$paginaActual,$totalRegistro;
		private $cod,$descripcion,$icono;
		public function __set($a,$b){ $this->$a = filter_var($b,FILTER_SANITIZE_STRING); }
		public function incluir(){ 
            return $this->ejecutar("INSERT INTO toperacion(descripcion,icono) VALUES('$this->descripcion','$this->icono')");
        }
		public function eliminar($status){
			return $this->ejecutar("UPDATE toperacion SET estatus='$status' WHERE idOperacion='$this->cod'");
		}
		public function modificar(){ 
			return $this->ejecutar("UPDATE toperacion SET descripcion='$this->descripcion',icono='$this->icono' WHERE idOperacion='$this->cod'"); 
		}
		public function listar($rapida=false,$tipo="",$por="",$reporte=0){
			$tipo=($tipo=="")?"ASC":$tipo;
			$por=($por=="")?" o.descripcion":$por;
			$and=($rapida)?" WHERE o.descripcion like '%$this->descripcion%' ":"";
            $limite=($this->limite)?$this->limite:5;
            $registrosMostrar=($this->paginaActual)?($this->paginaActual*$limite):0;
			if($reporte==0)
				$this->ejecutar("SELECT o.*,oc.descripcion as desIcon FROM toperacion as o inner join ticono as oc on oc.idIcono = o.icono $and ORDER BY $por $tipo LIMIT $registrosMostrar,$limite");
			else
				$this->ejecutar("SELECT descripcion,case when estatus=1 then 'ACTIVO' else 'INACTIVO' end as estatus FROM toperacion");
			while($data = $this->arreglo()) $datos[] = $data;
			return $datos;
		}
		public  function totalRegistros($rapida=false){
        	$and=($rapida)?" WHERE o.descripcion like '%$this->descripcion%' ":"";
            $this->ejecutar("SELECT o.*,oc.descripcion as desIcon FROM toperacion as o inner join ticono as oc on oc.idIcono = o.icono $and");
            $this->totalRegistro = $this->cantidad();
            return $this->totalRegistro;
        }
		public function paginasTotales(){
            return $this->registrosTotales($this->totalRegistro,$this->articulosPagina);
        }

        public function listarOperacion($tipoVista){
        	$registro=$this->ejecutar("SELECT o.*
        		from cappiutep.t_operacion as o 
        		inner join cappiutep.t_vista_operacion as vo on vo.id_operacion = o.id_operacion
        		where vo.id_tipo_vista='$tipoVista'");
        	while($data = $this->setArreglo($registro)) $datos[] = $data;
			return $datos;
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
?>