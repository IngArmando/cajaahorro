<?php
session_start();
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
  $operacion = $_POST['opera'];
  $User      = trim( $_POST['User'] );


//--------------------------------------------------------------------
//    Llamado de clase y creación de objeto
//--------------------------------------------------------------------
  var_dump($_POST);
    include("../modelo/MRecuperar.php");
    $ORec = new Recuperar();
        
    //Para enviar correos
    include_once("../modelo/MEmail.php");
  	$mail = new SendMail();

    include_once("../modelo/MSocio.php");
    $OSocio = new Socio();
    $_SESSION['email']  = $OSocio->getEmail($User);


//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $ORec->setUser    ( $User    );


//--------------------------------------------------------------------
//    Selector de operaciones
//--------------------------------------------------------------------

  switch($operacion){
    case "Rec1":          
                $UserOlvido = $ORec->checkUser();  
            		if($UserOlvido!='' && $UserOlvido!=NULL)
            		{
                  $_SESSION['userTemp']=$UserOlvido;
                  header("location: ../vista/pub/Recuperar2.php");
            		}
                else
                  header('location: ../vista/pub/UserNo.php');
            	break;


    case "Rec2":

        foreach ($_POST["Pregunta"] as $index => $Preg) {

            $ORec->setPreg($Preg);
            $ORec->setResp($_POST["Respuesta"][$index]);
            $Valido=$ORec->PregResp();

            if($Valido==0)
            {
              session_destroy();
              header('location: ../vista/pub/Acceso.php');
            }
            else
            {
              $_SESSION['Preguntas']='Si';
              header('location: ../vista/pub/Recuperar3.php');
            }
            
        }
    break;

    case "Rec3":

                $ORec->setIdUser ($_SESSION["userTemp"]);
                $ORec->setPass   (md5($_POST["pass"]));
                $ORec->setDifAnt ($_POST["ant"]);
                $Valido=$ORec->AntePass();
                $Correo=$_SESSION['email'];
                if($Valido='SISA')
                  {
                    $Valido=$ORec->NuevoPass();
                    $mensaje = "
                            Estimado usuario, le notificamos que su contraseña ha sido cambiada, su nueva contraseña
                            es ".$_POST['pass']."
                            <br/>
                            <br/>
                            <br/>
                            NOTA: este es un mensaje enviado por sistema, por favor no responda al mismo ya que no será atendido 
                            por ninguna persona en la institución.
                            <br/>
                            <br/>
                            Notificacion automática: Este mensaje y cualquier archivo que se adjunte contiene información 
                            privilegiada y confidencial. Es para uso exclusivo del destinatario. Si usted ha recibido esta 
                            comunicación por error, por favor avisenos inmediatamente.
                            ";
                      $mail->to();
                      $mail->message($mensaje);
                      $mail->SendAMail();

                    session_destroy();
                    header('location: ../vista/pub/PassSi.php');
                  }
                 else
                  {
                    session_destroy();
                    header('location: ../vista/pub/PassNo.php');
                  }
            break;

 
  
  }



//Fin del controlador  
?>