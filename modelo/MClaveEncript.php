<?php 
	class clsclaveEncript{

		private $clave;
		public function setClaveEncriptada($c){
			$this->$a=filter_var($c,FILTER_SANITIZE_STRING);
		}
		public function encriptar($c){
			$saltoInicio = "$123#";
			$saltoFin = "=Y$Y=";
			$cadena = $saltoInicio.$c.$saltoFin;
			$cadena64 = base64_encode($cadena);
			return $cadena64;
		}	

		public function comparar($claveBD){
			$clave = $this->encriptar($this->clave);
			return($clave==$claveBD)?1:0;
		}

	}

 ?>