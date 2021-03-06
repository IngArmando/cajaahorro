<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion  =$_POST['opera'];

  $FechaIns    = date('Y-m-d',strtotime(str_replace('/', '-', $_POST['FechaIns'] )));
  $Nacionalidad= trim( $_POST['Nacionalidad'] );
  $CI          = trim( $_POST['CI'] );
  $FechaNac    = date('Y-m-d',strtotime(str_replace('/', '-', $_POST['FechaNac'] )));
  $Nombre1     = trim( $_POST['Nombre1'] );
  $Nombre2     = trim( $_POST['Nombre2'] );
  $Apellido1   = trim( $_POST['Apellido1'] );
  $Apellido2   = trim( $_POST['Apellido2'] );
  $CodMov      = trim( $_POST['CodMovil'] );
  $TelfMov     = trim( $_POST['TelfMov'] );
  $CodHab      = trim( $_POST['CodHab'] );
  $TelfHab     = trim( $_POST['TelfHab'] );
  $Email       = trim( $_POST['Email'] );
  $LugarNac    = trim( $_POST['LugarNac'] );
  $TipoPersona = trim( $_POST['TipoPersona'] );
  $FondoComun  = trim( $_POST['FondoComun'] );
  $Parroquia   = trim( $_POST['Parroquia'] );
  $Dir         = trim( $_POST['Dir'] );
  $aporte         = trim( $_POST['aporte'] );
  $FechaIng    = date('Y-m-d',strtotime(str_replace('/', '-', $_POST['FechaIng'] )));
  $TipoDocente = 514;
    if(isset( $_POST['TipoDocente']) && $_POST['TipoDocente']!=NULL)
      $TipoDocente = trim( $_POST['TipoDocente'] );
  $Categoria   = trim( $_POST['Categoria'] );
  $Dedicacion  = trim( $_POST['Dedicacion'] );
  $Salario 	   = trim( $_POST['Salario'] );
  $Sede        = trim( $_POST['Sede'] );


//--------------------------------------------------------------------
//    Llamado de clase y creación de objeto
//--------------------------------------------------------------------
    include_once("../modelo/MSocio.php");
    $OSocio = new Socio();

    //Para enviar correos
    include_once("../modelo/MEmail.php");
  	$mail = new SendMail();

    include_once("../modelo/MBitacoraOperacion.php");
    $bitacora = new BitOpe;


//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OSocio->setNacionalidad ( $Nacionalidad );
  $OSocio->setCedula       ( $CI           );
  $OSocio->setNombre1      ( $Nombre1      );
  $OSocio->setNombre2      ( $Nombre2      );
  $OSocio->setApellido1    ( $Apellido1    );
  $OSocio->setApellido2    ( $Apellido2    );
  $OSocio->setFechaNac     ( $FechaNac     );
  $OSocio->setDir          ( $Dir          );
  $OSocio->setCodMovil     ( $CodMov       );
  $OSocio->setTeflMovil    ( $TelfMov      );
  $OSocio->setCodFijo      ( $CodHab       );
  $OSocio->setTelfFijo     ( $TelfHab      );
  $OSocio->setSede         ( $Sede         );
  $OSocio->setSalario      ( $Salario      );
  $OSocio->setCategoria    ( $Categoria    );
  $OSocio->setDedicacion   ( $Dedicacion   );
  $OSocio->setTipoDocente  ( $TipoDocente  );
  $OSocio->setFechaIng     ( $FechaIng     );
  $OSocio->setEmail        ( $Email        );
  $OSocio->setLugarNac     ( $LugarNac     );
  $OSocio->setTipoPersona  ( $TipoPersona  );
  $OSocio->setFondoComun   ( $FondoComun   );
  $OSocio->setParroquia    ( $Parroquia    );
  $OSocio->setaporte    ( $aporte    );
  $OSocio->id_banco = $_POST["Banco"];
  $OSocio->num_cuenta = $_POST["txtNroCuenta"];
  $OSocio->tipo_cuenta = $_POST["txtTipoCuenta"];

//--------------------------------------------------------------------
//    Selector de operaciones
//--------------------------------------------------------------------

switch($operacion){
    case "Registrar":

              $IdPersona= $OSocio->SigID();
              $OSocio->setIdPersona    ( $IdPersona );

              $IdUser= $OSocio->SigIDUser();
              $OSocio->setIdUser       ( $IdUser );

					    $OSocio->setCondicion    ( 149        );
		  			  $OSocio->setFechaIni     ( $FechaIns  );
            
            		  if($OSocio->registrar())
            		  {

                        /*$OSocio->registrarBanco();*/

            		  	$mensaje = "
            		  	<h3>Estimado(a) ".$Nombre1." ".$Apellido1."</h3> 
				        <br/> 
				        	Nos complace darle la bienvenida a CAPPIUTEP en línea. A partir de éste momento ya podrá acceder
				        	al sistema. Su nombre de usuario y contraseña son los siguientes:
				        <br/>
				        <br/>
				        	<b>Usuario:</b>".$CI."
				        <br/>
				        	<b>Contreseña:</b>".$CI."
				        <br/>
				        <br/>
				        	Le recomendamos cambiar su contraseña a la brevedad posible y crear sus preguntas
				        	de seguridad para poder recuperar la misma en caso de ser necesario.
				        <br/>
				        	Nuevamente le damos la bienvenida y agradecemos su preferencia, tenga un feliz día.
				        <br/>
				        <br/>
				        <br/>
				        <br/>
				        <br/>
				        	NOTA: este es un mensaje enviado por sistema, por favor no responda al mismo ya que no será atendido 
				        	por ninguna persona en la institución.
				        <br/>
				        <br/>
							Notificacion automatica: Este mensaje y cualquier archivo que se adjunte contiene informacion 
							privilegiada y confidencial. Es para uso exclusivo del destinatario. Si usted ha recibido esta 
							comunicacion por error, por favor avisenos inmediatamente.
				        ";
				        $mail->to($Email);
				        $mail->toname($Nombre1." ".$Apellido1);
				        $mail->message($mensaje);
				        $mail->SendAMail();
                $bitacora->registrar($_SESSION["idusuario"],"Socio","Guardar","Socio Guardado con Exito");
            		  }
            	break;

    case "GUARDAR CAMBIOS":
            $IdPersona = trim( $_POST['IdPersona'] );
            $OSocio->setIdPersona    ( $IdPersona );
            $OSocio->modificar();
            $bitacora->registrar($_SESSION["idusuario"],"Socio","Guardar","Socio Modificado con Exito");
            break;

 
  
  }



//Fin del controlador  
?>