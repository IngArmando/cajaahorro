<?php
	@session_start();
	
	include_once('../securimage/securimage.php');
	  $securimage = new Securimage();
	
	require_once("../modelo/MSesion.php");
	$user = new clsSesion;
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		
		$datosConfiguracion = $user->getArrayConfigurar();
//--------------------------------------------------------------------
//   Inicio de sesión
//--------------------------------------------------------------------
		if($_POST["evento"]=="iniciar"){
			$user->usuario = $_POST["user"];
			$user->clave = md5($_POST["pass"]);

			if ($securimage->check($_POST['captcha_code']) == false) {
			  header("location: ../vista/pub/CaptchaError.php");
			  exit;
			}

			$sesion = $user->login();
			//0 = fallido, 1=exitoso, 2=clave incorrecta, 3=se bloqeo el usuario, 4=usuario incorrecto, 5=max sessiones abiertas, 9=intento de hackeo
			if($sesion==1){
				if(isset($_SESSION["userTemporal"]) && !empty($_SESSION["userTemporal"])){
					header("location: ../vista/sis/UsuarioActivar.php"); //enviar a la vista de por primera vez
				}else if(isset($_SESSION["userActivo"]) && !empty($_SESSION["userActivo"])){
					header("location: ../vista/sis/Inicio.php"); //enviar a la vista del menú
				}
			}else{
				switch ($sesion) {
					case '0': $msj = "error inesperado"; $tipoMensaje = "error"; break;
					case '2': case '4': header("location: ../vista/pub/LoginError.php"); break;
					case '3': $msj = header("location: ../vista/pub/UserBloq.php"); break;
					case '5': $msj = header("location: ../vista/pub/UserSesLim.php"); $tipoMensaje="alerta"; break;
					case '9': $msj = header("location: ../vista/pub/Hacking.php");
				}
			}
		}

//--------------------------------------------------------------------
//   Actualización de seguridad en el primer inicio de sesión
//--------------------------------------------------------------------
		if($_POST["evento"]=="PrimerInicio")
		{
			$ok = false;
			$dataClave = $user->searchLastPassword();
			$user->BEGIN();
			$user->clave=md5($_POST["pass"]);
			$user->usuario = $_SESSION["idUsuario"];
			echo '1';
			if($user->insertPassword($dataClave["id_usuario_clave"]))
			{
				$i=0;
				echo "2";
				foreach ($_POST["txtPregunta"] as $key => $pregunta) 
				{
					$user->pregunta = $pregunta;
					$user->respuesta = $_POST["txtRespuesta"][$key];
					if($user->insertAnswerQuestion())
					{
						$ok = true;
					}
					else
					{
						$ok = false;
						break; exit();
					}
				}
				if($ok)
				{ 
					echo "3";
					$user->COMMIT();
					$_SESSION["userActivo"] = $_SESSION["userTemporal"]; // creamos la sesion del usuario normal
					//cambiamos el status a 1 para indicar que inicio sesion, y cambiamos el valor del campo InicioSesion, para indicar que hay una sesion activa
					$user->changeStatus($_SESSION["idUsuario"],1);
					$user->changeLogin($_SESSION["idUsuario"]);
					$user->insertarBitacora($_SESSION["idUsuario"],"El usuario ha configurado su contraseña, preguntas y respuestas de seguridad");
					unset($_SESSION["userTemporal"]); //destruimos la sesion temporal
					header("location: ../vista/sis/Inicio.php");
				}
				else
				{
					echo "4";
					$user->ROLLBACK();
					$msj = "Error inespeardo en la actualización de datos, por favor contacte al administrador del sistema";
				}
			}
			else
			{
				$msj = "Su Clave Actual es incorrecta";
			}
		}//Fin de Actualizar datos

//--------------------------------------------------------------------
//   Recuperacion de contraseña
//--------------------------------------------------------------------

		if($_POST["evento"]=="OlvidoClave") {
			if($idUserOlvido = $user->getUserId($_POST["txtUsuario"])){
				$arrPreguntasAzar = array();
				$_SESSION["userOlvido"]=$idUserOlvido;
				$arrPreguntasRepuestas = $user->listAnswerQuestion($idUserOlvido);
				$cantPreguntasRepuestas = count($arrPreguntasRepuestas);
				$cantConfPregResp = $datosConfiguracion["maxPreguntasRespuesta"];
				$cantidadReal = ($cantConfPregResp > $cantPreguntasRepuestas)?$cantPreguntasRepuestas:$cantConfPregResp;
				$cantFor = ceil(($cantidadReal / 2)+1);
				$a = 0;
				for ($i=0; $i < $cantFor; $i++) { 
					$nro = rand() % 2;
					if($nro == 1){
						$arrPreguntasAzar[$a++] = $arrPreguntasRepuestas[$i];
					}
				}
			}else{
				$errorMsj = "Error, Usuario no encontrado";
			}
		}

		if($_POST["evento"]=="ComprobarPreguntas") {
			$cambioClave = true;
			foreach($_POST["txtPregunta"] as $it=>$pregunta){
				$user->pregunta = $pregunta;
				$user->respuesta = $_POST["txtRepuesta"][$it];
				$error = $user->comprobarRespuesta();
				if(!$error){
					$cambioClave = false;
					$errorMsj = "ERROR, preguntas y respuestas incorrectas";
					unset($_SESSION["userOlvido"]);
					break;
				}
			}

		}

		if($_POST["evento"]=="CambiarNuevaClave") {
			if($_POST["txtClaveNueva"]==$_POST["txtClaveNueva2"]){
				$user->usuario=$_SESSION["userOlvido"];
				$user->claveNueva=md5($_POST["txtClaveNueva"]);
				$user->changePassword(2);
				$errorMsj = "Clave Cambiada exitosamente";
			}else{
				$errorMsj = "ERROR, las claves no concuerdan";
			}
			unset($_SESSION["userOlvido"]);
		}

	}//Fin del REQUEST_METHOD
	
?>