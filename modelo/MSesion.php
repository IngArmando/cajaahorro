<?php 
	include_once("MPgsql.php");
	require_once('MConfiguracion.php');
	require_once("MClaveEncript.php");
	require_once("MHacking.php");
	class clsSesion extends CModeloDatos{
		private $arrayConfigurar,
				$navegador,
				$OConf,
				$claveEncript;
		public  $usuario,
			    $clave,
			    $claveNueva, 
			    $ip;
		public $idPreguntaRespuesta,
		        $pregunta,
		        $respuesta;
        private $nombre,
        		$apellido,
        		$direccion;
        public  $intentoHackeo = 0;
        
		public function __construct(){            
			parent::__construct();
            $this->claveEncript = new clsclaveEncript();
			$this->ip = $this->getRealIP();
			$this->navegador=$this->getBrowser();
		}
        
       /* public function __set($variable,$valor){
        	if (property_exists(__CLASS__, $variable)) {
        		$hackeo = clsHacking::analizar($valor);
        		if($hackeo==1) $this->intentoHackeo=1;
        		$saneado = clsHacking::sanear($valor);
        		$this->$variable = trim(filter_var($saneado,FILTER_SANITIZE_STRING));
        	}
		}*/

		//--------------------------------------------------------------------
		//       Obtener datos de la configuracion del sistema
		//--------------------------------------------------------------------
        public function getArrayConfigurar(){ 
			$registro= $this->consultarConfiguraciones();
			  while ( $fila = $this->setArreglo( $registro ))
			      $datos[] = $fila;
			    foreach ($datos as $this->arrayConfigurar) { $this->arrayConfigurar; }

			return $this->arrayConfigurar;
        }

		//--------------------------------------------------------------------
		//       Genera expresion regular para validar seguridad de la contraseña
		//--------------------------------------------------------------------
        public function RegExpClave(){
            $datos = $this->getArrayConfigurar();
            $clm   = $datos["clave_mayus"];
            $clmm  = $datos["clave_minus"];
            $cn    = $datos["clave_num"];
            $ce    = $datos["clave_caracteres"];
            $e     = $datos["clave_caracteres_validos"];
            $lmmc  = $datos["clave_long_min"];
            $lmc   = $datos["clave_long_max"];
            if($clm==1) $rclm    = "(?=.*[A-Z])"; else $rclm  = NULL ;
            if($clmm==1) $rclmm  = "(?=.*[a-z])"; else $rclmm = NULL ;
            if($cn==1) $rcn      = "(?=.*[0-9])"; else $rcn   = NULL ;
            if($ce==1 && !empty($e)) $re  = "(?=.*[".$e."])"; else $re  = NULL ;
            if($lmmc>0 && $lmc>0) $rml    = "{".$lmmc.",".$lmc."}";
            $regularExpresion = "/^".$rcn."".$rclmm."".$rclm."".$re.".".$rml."$/";
            
            return $regularExpresion;
        }

//--------------------------------------------------------------------
//       Genera texto de ayuda para la seguridad de la contraseña
//--------------------------------------------------------------------
        public function helpClave(){
            $datos = $this->getArrayConfigurar();
            $clm   = $datos["clave_mayus"];
            $clmm  = $datos["clave_minus"];
            $cn    = $datos["clave_num"];
            $ce    = $datos["clave_caracteres"];
            $e     = $datos["clave_caracteres_validos"];
            $lmmc  = $datos["clave_long_min"];
            $lmc   = $datos["clave_long_max"];
            if($clm  == '1')   $rclm  = "<div class='item'><i class='right triangle icon'></i>Debe contener al menos una letra mayúscula.</div>"; else $rclm  = NULL ;
            if($clmm == '1')   $rclmm = "<div class='item'><i class='right triangle icon'></i>Debe contener al menos una letra minúscula.</div>"; else $rclmm = NULL ;
            if($cn   == '1')   $rcn   = "<div class='item'><i class='right triangle icon'></i>Debe contener al menos un número.</div>";           else $rcn   = NULL ;
            if($ce   == '1' && !empty($e)) $re = "<div class='item'><i class='right triangle icon'></i>Debe contener al menos un caracter especial ( ".$e." ).</div> "; else $re  = NULL ;
            if($lmmc>0 && $lmc>0) $rml   = "<div class='item'><i class='right triangle icon'></i>Debe contener un mínimo de ".$lmmc." cracteres, y hasta un máximo de ".$lmc." caracteres.</div>";
            $help = "<div class='ui list'> $rclm $rclmm $rcn $re $rml </div>";
            
            return $help;
        }

//--------------------------------------------------------------------
//       Genera texto de ayuda para la seguridad de la contraseña
//--------------------------------------------------------------------
        public function helpClaveDif(){
            $datos = $this->getArrayConfigurar();
            $difAnt   = $datos["clave_dif_anterior"];
            return $difAnt;
        }

//--------------------------------------------------------------------
//       Chequea cuantas sesiones activas tiene un usuario
//--------------------------------------------------------------------        
		public function checkLogin($usuario){
			$arr = $this->ejecutar("SELECT inicio_sesion FROM cappiutep.t_usuario WHERE id_usuario = '$usuario'");
			$dato = $this->getArreglo($arr);
			if($dato[0]==0)
				$this->logOut();
		}

//--------------------------------------------------------------------
//       Inserta accion en la bitacora de acceso
//--------------------------------------------------------------------
		public function insertarBitacora($usuario,$mensaje){
			return $this->ejecutar("INSERT INTO cappiutep.t_bitacora_acceso(id_usuario, mensaje, fecha, hora, ip, navegador) values($usuario,'$mensaje',CURRENT_DATE,LOCALTIMESTAMP,'$this->ip','$this->navegador')");
		}

		//--------------------------------------------------------------------
		//       Funcion de Inicio de Sesion
		//		 @author Leonardo Alvarado 	
		//
		//       return $entro, 0 = Error,
		//                      1 = Exitoso,
		//                      2 = Contraseña incorrecta,
		//                      3 = Usuario Bloqueado,
		//                      4 = Usuario incorrecto,
		//                      5 = Alcanzo el maximo de sesiones abiertas,
		//                      9 = Intento de hackeo
		//
		//--------------------------------------------------------------------

		public function login(){
			$entro = 0; //variable de control
			//buscamos el usuario
			if($this->intentoHackeo==1){
				$entro = 9;
			}else{
				$dataUsuario = $this->ejecutar("SELECT * FROM cappiutep.t_usuario WHERE nombre = '$this->usuario'");

				if($datos = $this->getArreglo($dataUsuario)){ //preguntamos si existe
					//buscamos la clave activa
					$dataClave = $this->searchLastPassword($datos[0]);//preguntamos si es correcto
					if($dataClave){
						//comparamos las claves
						if($dataClave["clave"]==$this->clave){
							if($this->arrayConfigurar["max_sesiones_abiertas"]==$datos["inicio_sesion"]){
								$entro = 5;
								//el usuario solo se puede logear las veces que diga la configuracion del sistema
								$this->insertarBitacora($datos[0],"El usuario trató de iniciar más sesiones de las permitidas por la configuración del sistema.");
							}else{ 
								//session_regenerate_id();
								$_SESSION["idUsuario"]=$datos[0];
								if($datos["estatus"]==0){ //si el status es 0, creamos una session temporal para que el usuario cambie su clave y sus preguntas y respuestas
									$_SESSION["userTemporal"]=$datos["nombre"];
									unset($_SESSION["userActivo"]);
									$this->insertarBitacora($datos[0],"El usuario inició sesión por primera vez.");
								}else{
									$_SESSION["userActivo"]=$datos["nombre"];
									unset($_SESSION["userTemporal"]);
									//restauramos el nro de intentos fallidos a 0, y sumamos a uno al InicioSesion
									$this->ejecutar("UPDATE cappiutep.t_usuario SET intentos=0 WHERE id_usuario='".$datos[0]."'");
									$this->changeLogin($datos[0]);
									$this->changeStatus($datos[0],1);//Cambiamos en status del usuario al de uno activo
									//guardamos la ultima conexion
									//$this->ejecutar("UPDATE usuario set ultimaconexion=CURRENT_TIMESTAMP WHERE idusuario='".$datos[0]."'");		
									//insertamos los datos en la bitacora
									$this->insertarBitacora($datos[0],"El usuario inició sesión exitosamente.");
								}
								$entro = 1;
							}
						}else{
							//insertamos el intento fallido
							$this->ejecutar("UPDATE cappiutep.t_usuario SET intentos = intentos+1 WHERE id_usuario='".$datos[0]."'");
							
							$maximoFallidos = $this->arrayConfigurar["clave_intentos_fallidos"];
							$usuarioFallido = $datos["intentos"]+1;
							if($maximoFallidos==$usuarioFallido){
								$entro = 3; //se bloqueo el usuario
								$this->changeStatus($datos[0],9);
								$this->insertarBitacora($datos[0],"El usuario ha sido bloqueado por superar el máximo número de intentos por ingresar Usuario/Contraseña incorrecta.");
							}else{
								$entro = 2; //clave incorrecta
								$this->insertarBitacora($datos[0],"El usuario ingresó una contraseña incorrecta.");
							}
							unset($_SESSION);
							session_destroy();
						}
					}
				}else{
					//usuario incorrecto
					$entro = 4;
					$this->insertarBitacora(NULL,"El usuario no existe.");
					unset($_SESSION);
					session_destroy();
				}
			}
			
			return $entro;
		}//fin de la funcion logeo

//--------------------------------------------------------------------
//       Cerrar Sesion
//--------------------------------------------------------------------
		public function logOut(){
			//session_regenerate_id();
			$this->changeLogin($_SESSION["idUsuario"],2);
			unset($_SESSION["precargado"]);
			unset($_SESSION["userActivo"]);
			unset($_SESSION["idUsuario"]);
			session_destroy();
		}
		//--------------------------------------------------------------------
		//       Inserta accion en la bitacora de acceso
		//       
		//		function changeStatus
		//			cambiar el status
		//			@param $usuario = id del usuario
		//			@param $status = status a colocar
		//			return 0 o 1 según la operacion
		//
		//--------------------------------------------------------------------
		public function changeStatus($usuario,$status){
			return $this->ejecutar("UPDATE cappiutep.t_usuario SET estatus='$status' where id_usuario=$usuario");
		}

		//--------------------------------------------------------------------
		//      Acualiza la cantidad de sesiones activas
		//--------------------------------------------------------------------
		public function changeLogin($usuario,$tipo=1){
			if($tipo==1)
				$ejecutar = $this->ejecutar("UPDATE cappiutep.t_usuario SET inicio_sesion = inicio_sesion+1 WHERE id_usuario='$usuario'");
			else
				$ejecutar = $this->ejecutar("UPDATE cappiutep.t_usuario SET inicio_sesion = inicio_sesion-1 WHERE id_usuario='$usuario'");
			return $ejecutar;
		}

		//--------------------------------------------------------------------
		//       Listar actividad reciente del usuario
		//--------------------------------------------------------------------
		public function listByUser($usuario){
			$consulta = $this->ejecutar("SELECT * FROM cappiutep.t_bitacora_acceso WHERE id_usuario = '$usuario' ORDER BY id_bitacora_acesso DESC");
			while($data = $this->getArreglo($consulta)) $datos[] = $data;
			return $datos;
		}

		//--------------------------------------------------------------------
		//       Obtener el ID del usuario
		//--------------------------------------------------------------------
		public function getUserId($psUsuario=""){
			$usuario = ($psUsuario=="")?(isset($_SESSION["userActivo"]))?$_SESSION["userActivo"]:$_SESSION["Temporal"]:$psUsuario;
			$consulta = $this->ejecutar("SELECT id_usuario FROM cappiutep.t_usuario WHERE nombre = '$usuario'");
			$data = $this->getArreglo($consulta);
			return $data[0];
		}


		//--------------------------------------------------------------------
		//      Registrar preguntas de seguridad
		//--------------------------------------------------------------------
		public function insertAnswerQuestion(){
			return $this->ejecutar("INSERT INTO cappiutep.t_usuario_pregunta(id_usuario,pregunta,respuesta) VALUES($this->usuario,'$this->pregunta','$this->respuesta')");
		}

		//--------------------------------------------------------------------
		//       Registra nueva contraseña
		//--------------------------------------------------------------------
		public function insertPassword($idUsuarioClave){
			//actualizamos la fecha fin de la clave actual
			$this->ejecutar("UPDATE cappiutep.t_usuario_clave SET fecha_fin = CURRENT_DATE WHERE id_usuario_clave =$idUsuarioClave");
			//cambiamos la clave insertando un nuevo registro
			return $this->ejecutar("INSERT INTO cappiutep.t_usuario_clave(id_usuario,clave,fecha_ini,fecha_fin) VALUES($this->usuario,'$this->clave',CURRENT_DATE,NULL)");
		}

		//--------------------------------------------------------------------
		//      Recuperacion de contraseña
		//		
		//		function changePassword
		//			cambiar la clave
		//			return 0 = Se cambio la contraseña exitosamente, 
		//		           1 = Es igual a una de las N anteriores, N se define en las configuraciones del sistema
		//		           2 = La contraseña actual no coincide
		//--------------------------------------------------------------------

        public function changePassword($tipo=1){
            $encontrado = 0;
            $cantUltimasClaves = $this->arrayConfigurar["clave_dif_anterior"];
            $claveActual = $this->searchLastPassword($_SESSION["userOlvido"]);

            if($tipo==1){
            	$claveActual = $this->searchLastPassword();
	            if($this->clave == $claveActual["clave"]){
	                $consulta = $this->ejecutar("SELECT clave FROM cappiutep.t_usuario_clave WHERE id_usuario='$this->usuario' ORDER BY id_usuario_clave DESC LIMIT $cantUltimasClaves");
	                while($data = $this->getArreglo($consulta)){
	                    if($data["clave"]==$this->claveNueva){
	                        $encontrado = 1;
	                        $this->insertarBitacora($this->usuario,"Error al intentar cambiar contraseña.");
	                        break;
	                    }
	                }
	            }else{ 
	                $encontrado = 2;
	                $this->insertarBitacora($this->usuario,"Error al intentar cambiar contraseña, la clave actual no coincide.");
	            }
            }else if($tipo==2){
				$this->ejecutar("SELECT clave FROM cappiutep.t_usuario_clave WHERE id_usuario='$this->usuario' ORDER BY id_usuario_clave DESC LIMIT $cantUltimasClaves");
				while($data = $this->getArreglo($consulta)){
                    if($data["clave"]==$this->claveNueva){
                        $encontrado = 1;
                        $this->insertarBitacora($this->usuario,"Error al intentar cambiar contraseña, es igual a una de las últimas $cantUltimasClaves anteriores");
                        break;
                    }
                }
            }
            if($encontrado==0){ 
                $this->clave = $this->claveNueva; 
                $this->insertPassword($claveActual["idusuarioClave"]);
                if($tipo==1)
                	$this->insertarBitacora($this->usuario,"Actualizó su contraseña exitosamente.");
               	else if($tipo==2)
               		$this->insertarBitacora($this->usuario,"Recuperó su contraseña exitosamente.");
            }
            
            return $encontrado;
        }
        
		//--------------------------------------------------------------------
		//       Busca la contraseña actual
		//--------------------------------------------------------------------

		public function searchLastPassword($iduser="") {
			if(isset($iduser) && !empty($iduser)) $idUsuario = $iduser;
			else if(isset($_SESSION["idUsuario"])) $idUsuario = $_SESSION["idUsuario"];
			$consulta = $this->ejecutar("SELECT clave,id_usuario_clave FROM cappiutep.t_usuario_clave where id_usuario='$idUsuario' AND fecha_fin IS NULL");
			return $this->getArreglo($consulta);
			exit;
		}
       

		//--------------------------------------------------------------------
		//       Busca los datos personales de un usuario
		//--------------------------------------------------------------------        
        public function datosSocio() {
            $id = (isset($_SESSION["idUsuario"]))?$_SESSION["idUsuario"]:"";
            $consulta = $this->ejecutar("SELECT s.nombre1,s.apellido1,s.id_tipo_persona,s.fondocomun,s.fcomun,s.fcesantia FROM cappiutep.t_usuario AS u INNER JOIN cappiutep.t_persona AS s ON u.id_persona = s.id_persona WHERE id_usuario=$id");
           
	 		while ($dato = $this->getArreglo($consulta)) $data[] = $dato;
			return $data;
        }
        
		//--------------------------------------------------------------------
		//       Obtiene la IP del cliente (ARREGLAR)
		//--------------------------------------------------------------------     

		public function  getRealIP() {
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $ip_cliente =( !empty($_SERVER['REMOTE_ADDR']) ) ?$_SERVER['REMOTE_ADDR']:( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR']:"unknown" );
                // los proxys van añadiendo al final de esta cabecera las direcciones ip que van "ocultando". 
                //Para localizar la ip real del usuario se comienza a mirar por el principio hasta encontrar una dirección ip 
                //que no sea del rango privado. En caso de no encontrarse ninguna se toma como valor el REMOTE_ADDR
                $entrantes = explode('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
                reset($entrantes);
                while (list(, $entrante) = each($entrantes)) {
                    $entrante = trim($entrante);
                    if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entrante, $lista_ip) ) {
                        //las ip privadas mas conocidas para local y proxy local, si en dado caso se usa otra aplicarla en el array
                        $ip_privada = array(
                              '/^0\./',
                              '/^127\.0\.0\.1/',
                              '/^192\.168\..*/',
                              '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                              '/^10\..*/'
                        );
                        $ip_encontrada = preg_replace($ip_privada, $ip_cliente, $lista_ip[1]);
                        if ($ip_cliente != $ip_encontrada) {
                           $ip_cliente = $ip_encontrada;
                           break;
                        }
                    }
                }
			}else{
            	$ip_cliente =( !empty($_SERVER['REMOTE_ADDR']) ) ?$_SERVER['REMOTE_ADDR']:( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR']: "desconocida" );
            }
			return ($ip_cliente=="::1")?"localhost":$ip_cliente;
        }
       
        function getBrowser() {
        	$userAgent = $_SERVER['HTTP_USER_AGENT'];
        	$browser = explode(" ",$userAgent);
        	return end($browser);
        }
       
		//--------------------------------------------------------------------
		//---------------   FUNCIONES PARA LA SEGURIDAD ----------------------
		//--------------------------------------------------------------------   

		//--------------------------------------------------------------------
		//      Lista los modulos en el menu
		//-------------------------------------------------------------------- 

        public function listarModulosUsuario() {
	 		$idusuario = $_SESSION["idUsuario"];
	 		$consulta = $this->ejecutar("SELECT m.id_modulo,m.estatus,m.descripcion,m.posicion,m.id_icono as idicono,ico.icono
	 			FROM cappiutep.t_modulo AS m
	 			INNER JOIN cappiutep.t_servicio AS s ON s.id_modulo = m.id_modulo
	 			INNER JOIN cappiutep.t_servicio_operacion AS so ON so.id_servicio = s.id_servicio
	 			INNER JOIN cappiutep.t_icono AS ico ON m.id_icono = ico.id_icono
	 			WHERE so.id_usuario::text = '$idusuario'::text 
	 			GROUP BY m.id_modulo,ico.icono
	 			ORDER BY m.posicion");
	 		while ($dato = $this->getArreglo($consulta)) $data[] = $dato; 
			return $data;
	 	}
		//--------------------------------------------------------------------
		//       Lista los servicios en el menu
		//--------------------------------------------------------------------
		public function listarServiciosUsuario($idModulo) {
	 		$idusuario = $_SESSION["idUsuario"];
	 		$consulta = $this->ejecutar("SELECT s.id_servicio,s.descripcion,s.url
				FROM
				  cappiutep.t_servicio as s
				  inner join cappiutep.t_servicio_operacion as so on so.id_servicio = s.id_servicio
				  inner join cappiutep.t_usuario as u on so.id_usuario = u.id_usuario 
				  inner join cappiutep.t_modulo as m on s.id_modulo = m.id_modulo
				WHERE 
				  so.id_usuario = '$idusuario' AND s.id_modulo='$idModulo'

				GROUP BY s.id_servicio,s.descripcion,s.url
				order by s.id_servicio");
	 		while ($dato = $this->getArreglo($consulta)) $data[] = $dato; 
			return $data;
	 	}

		//--------------------------------------------------------------------
		//      Lista los servicios asignados a un usuario
		//-------------------------------------------------------------------- 

		public function listarServiciosAsignados() {
	 		$idusuario = $_SESSION["idUsuario"];
	 		$consulta = $this->ejecutar("SELECT s.idservicio FROM cappiutep.t_servicio_operacion as s WHERE s.idusuario = '$idusuario' GROUP BY s.idservicio order by s.idservicio");
	 		while ($dato = $this->getArreglo($consulta)) $data[] = $dato; 
			return $data;	
	 	}

		//--------------------------------------------------------------------
		//      Lista los servicios y operaciones asignados a un usuario
		//-------------------------------------------------------------------- 
	 	public function listarServicioOperacionUsuario($idusuario) {
	 		$consulta = $this->ejecutar("SELECT so.id_servicio,so.id_operacion, s.id_modulo
	 		FROM cappiutep.t_servicio_operacion as so
	 		inner join cappiutep.t_servicio as s on s.id_servicio = so.id_servicio
	 		WHERE id_usuario = '$idusuario'");
	 		while ($dato = $this->getArreglo($consulta)) $data[] = $dato;
			return $data;
	 	}

		//--------------------------------------------------------------------
		//      Lista las operaciones asignados a un usuario
		//-------------------------------------------------------------------- 
        public function listarOperacionesUsuario($idservicio) {
	 		$idusuario = $_SESSION["idUsuario"];
	 		$consulta = $this->ejecutar("SELECT o.idoperacion,o.descripcion
				FROM
				  cappiutep.t_servicio as s
				  inner join cappiutep.t_servicio_operacion as so on so.idservicio = s.idservicio
				  inner join cappiutep.t_operacion as o on o.id_operacion = so.idOperacion
				WHERE 
				  so.idUsuario = '$idusuario' AND so.idservicio = '$idservicio'
				order by o.id_operacion");
	 		while ($dato = $this->getArreglo($consulta)) $data[] = $dato; 
			return $data;
	 	}
		//--------------------------------------------------------------------
		//      Asigna una operacion/servicio a un usuario
		//-------------------------------------------------------------------- 
		public function guardarServicioOperacion($servicio,$operacion,$usuario) {
	 		$consulta = $this->ejecutar("INSERT INTO cappiutep.t_servicio_operacion(id_servicio,id_operacion,id_usuario) values('$servicio','$operacion','$usuario')");
	 		return pg_affected_rows($consulta);
	 	}

		//--------------------------------------------------------------------
		//      Revoca una operacion/servicio a un usuario
		//-------------------------------------------------------------------- 
	 	public function eliminarServicioOperacion($servicio,$operacion,$usuario) {
	 		$consulta = $this->ejecutar("SELECT id_servicio_operacion FROM cappiutep.t_servicio_operacion where id_servicio='$servicio' and id_operacion='$operacion' and id_usuario='$usuario'");
	 		$dato = $this->getArreglo($consulta);
	 		$consulta = $this->ejecutar("DELETE FROM cappiutep.t_servicio_operacion where id_servicio_operacion='$dato[0]'");
	 		return pg_affected_rows($consulta);
	 	}
		//--------------------------------------------------------------------
		//       Convierte tuplas en arreglos
		//--------------------------------------------------------------------
	    public function setArreglo( $registro )
	    {   return $this->getArreglo( $registro ); }
		//--------------------------------------------------------------------
		//       Consultar configuraciones
		//--------------------------------------------------------------------
	    public function consultarConfiguraciones() {
	        $sql="SELECT * FROM cappiutep.t_configuracion";
	        return $this->consulta( $sql );
	    }
	}//Fin de la clase
?>