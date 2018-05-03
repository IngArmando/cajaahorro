<?php
	ini_set("display_errors","off");
	error_reporting(-1);
	//--------------------------------------------------------------------
	//       Clase CModeloDatos Capa Datos
	//--------------------------------------------------------------------
	class CModeloDatos {
		private $conexion;
		private $servidor;
		private $basedato;
		private $usuario;
		private $clave;
		//--------------------------------------------------------------------
		//       Constructor
		//--------------------------------------------------------------------
		public function CModeloDatos() {
			$this->servidor   = "localhost";
			$this->puerto     = "5432";
			$this->basedato   = "caja2";
			$this->usuario    = "postgres";
			$this->clave      = "5428";	
		}	
		//--------------------------------------------------------------------
		//       Abrir conexión o conectar
		//--------------------------------------------------------------------
		protected function crearConexion() {
			$this->conexion = pg_connect ("host=".$this->servidor." port=".$this->puerto." dbname=".$this->basedato." user=".$this->usuario." password=".$this->clave) or die('No se puede Conectar con el Servidor');
			if ( $this->conexion)
				return true;
			return false;
		}
		//--------------------------------------------------------------------
		//       Ejecutar una sentencia SQL 
		//--------------------------------------------------------------------
	  	public function consulta($query) {
			if ( $this->crearConexion() ) 
				return ( pg_query($this->conexion,$query ) );
			return null;
	  	}
	  	public function ejecutar($query) {
			$this->crearConexion();
			return pg_query($this->conexion,$query );
	  	}
	  	public function ejecutar2($query) {
			$this->crearConexion();
			$consulta = pg_query($this->conexion,$query );
			return (pg_affected_rows($consulta)==-1)?0:1;
	  	}
		//--------------------------------------------------------------------
		//       Convierte Tuplas en un arreglo
		//--------------------------------------------------------------------
	  	public function getArreglo( $registro ) { return pg_fetch_array( $registro );  }
		//--------------------------------------------------------------------
		//       Cantidad de Tuplas o regsitros de una Tabla
		//--------------------------------------------------------------------
	  	public function getNoTupla($resultado) { return pg_num_rows($resultado);  }
		//--------------------------------------------------------------------
		//       Cierra la conexión 
		//--------------------------------------------------------------------
	  	public function cerrar_bd() { @pg_close($this->conexion); }
		//--------------------------------------------------------------------
		//       Funcion query 
		//--------------------------------------------------------------------
	  	public function query( $sql ) { return pg_query($this->conexion,$sql ); }

		public function BEGIN() { $this->crearConexion(); pg_query("BEGIN",$this->conexion); }
		public function COMMIT() { $this->crearConexion(); pg_query("COMMIT",$this->conexion); }
		public function ROLLBACK() { $this->crearConexion(); pg_query("ROLLBACK",$this->conexion); }
		public function set_fecha($fecha,$sep="-",$glue="/") { return implode($glue,array_reverse(explode($sep,$fecha))); }

		public function buscarUltimoId($id,$tabla){
			$consulta = $this->consulta("SELECT max($id) as maximo from $tabla");
			$data = $this->getArreglo($consulta);
			return $data["maximo"];
		}
		public function getIdPersonaCaja(){
			@session_start();
			$consulta = $this->consulta("SELECT pc.id_persona_caja as idpersonacaja
				from cappiutep.t_persona_caja as pc 
				inner join cappiutep.t_persona as p on p.id_persona = pc.id_persona
				inner join cappiutep.t_usuario as u on p.cedula = u.nombre
				where u.id_usuario = ".$_SESSION['idUsuario']);
			$data = $this->getArreglo($consulta);
			return $data["idpersonacaja"];
		}
	}
	//Fin de la clase
?>