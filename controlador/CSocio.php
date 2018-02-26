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
  $FechaIng    = date('Y-m-d',strtotime(str_replace('/', '-', $_POST['FechaIng'] )));
  $TipoDocente = 160;
    if(isset( $_POST['TipoDocente']) && $_POST['TipoDocente']!=NULL)
      $TipoDocente = trim( $_POST['TipoDocente'] );
  $Categoria   = trim( $_POST['Categoria'] );
  $Dedicacion  = trim( $_POST['Dedicacion'] );
  $Salario 	   = trim( $_POST['Salario'] );
  $Sede        = trim( $_POST['Sede'] );


//--------------------------------------------------------------------
//    Llamado de clase y creación de objeto
//--------------------------------------------------------------------
    @include_once("../modelo/MSocio.php");
    $OSocio = new Socio();

    //Para enviar correos
    @include_once("../modelo/MEmail.php");
  	$mail = new SendMail();

    @include_once("../modelo/MBitacoraOperacion.php");
    $bitacora = new BitOpe;

    @include_once('../modelo/MPgsql.php');
              $dbg=new CModeloDatos;
              $dbg1=new CModeloDatos;
              $dbg2=new CModeloDatos;


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

              $fco=$_POST['fondoco'];
              $fce=$_POST['fondoce'];

              $aptco=$_POST['aporteco'];
              $aptce=$_POST['aportece'];

              if($fco != 1 ){ $fco=0; }else{ $fco=1; }
              if($fce != 1 ){ $fce=0; }else{ $fce=1; }
              if($aptco != 0 ){ $aptco=$aptco; }else{ $aptco=0; }
              if($aptce != 0 ){ $aptce=$aptce; }else{ $aptce=0; }

              

            
            		  if($OSocio->registrar($fco,$fce,$aptco,$aptce))
            		  {

                      $tf="select * from cappiutep.t_persona order by id_persona desc limit 1"; 
                      $atf=$dbg1->ejecutar($tf);
                      $rowtf=$dbg1->getArreglo($atf);

                        $saldos= $aptce + $aptco; 

                               $sqlha="insert into cappiutep.t_haberes(id_persona,saldo,saldo_bloq_prestamo,saldo_bloq_fianza,fecha_cierre) values('".$rowtf['id_persona']."','".$saldos."','0','0','".date('Y-m-d')."')";

                        $tt=$dbg2->ejecutar($sqlha);

                        if($fce == 1){ 
                       echo  $sqlha="insert into cappiutep.aporte(id_persona,tipo,ano,mes,estatus,aportado) values('".$rowtf['id_persona']."', '1' ,'".date(Y)."', '".date(m)."','1','".$aptce."')";
                        $tt=$dbg2->ejecutar($sqlha);
                      }

                      if($fco == 1){ 
                       echo  $sqlha="insert into cappiutep.aporte(id_persona,tipo,ano,mes,estatus,aportado) values('".$rowtf['id_persona']."', '2' ,'".date(Y)."', '".date(m)."','1','".$aptco."')";
                        $tt=$dbg2->ejecutar($sqlha);
                      }
                     




                      /*

                      if($fce == 1){ 
                        $sqlha="insert into cappiutep.t_haberes(id_persona,saldo,saldo_bloq_prestamo,saldo_bloq_fianza,fecha_cierre) values('".$rowtf['id_persona']."','".$aptce."','0','0','".date('Y-m-d')."')";

                        $tt=$dbg2->ejecutar($sqlha);
                      }
*/
                      

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

              $fco=$_POST['fondoco'];
              $fce=$_POST['fondoce'];

              $aptco=$_POST['aporteco'];
              $aptce=$_POST['aportece'];

              if($fco != 1 ){ $fco=0; }else{ $fco=1; }
              if($fce != 1 ){ $fce=0; }else{ $fce=1; }
              if($aptco != 0 ){ $aptco=$aptco; }else{ $aptco=0; }
              if($aptce != 0 ){ $aptce=$aptce; }else{ $aptce=0; }

            if($OSocio->modificar2($fco,$aptco,$fce,$aptce)){

               if($_POST['nuevoco'] == 1){ 
                       echo  $sqlha="insert into cappiutep.aporte(id_persona,tipo,ano,mes,estatus,aportado) values('".$IdPersona."', '2' ,'".date(Y)."', '".date(m)."','1','".$aptco."')";
                        $tt=$dbg2->ejecutar($sqlha);
                      }

                      if($_POST['nuevoce'] == 1){ 
                       echo  $sqlha="insert into cappiutep.aporte(id_persona,tipo,ano,mes,estatus,aportado) values('".$IdPersona."', '1' ,'".date(Y)."', '".date(m)."','1','".$aptce."')";
                        $tt=$dbg2->ejecutar($sqlha);
                      }
            }

            $bitacora->registrar($_SESSION["idusuario"],"Socio","Guardar","Socio Modificado con Exito");
            break;

 
  
  }



//Fin del controlador  
?>