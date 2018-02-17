<?php session_start();
    include_once("../modelo/MSesion.php"); 
    $objSesion2 = new clsSesion;
    if($_POST["evento"]=="CambiarNuevaClave") {
       if($_POST["ClaveNueva"]!=$_POST["ClaveNueva2"]){
            $msj = "la clave nueva no coincide";

        }else{   

            $objSesion2->usuario = $_SESSION["idUsuario"];           
            $objSesion2->clave = $_POST["ClaveActual"];
            $objSesion2->claveNueva = $_POST["ClaveNueva"];

            $funcion = $objSesion2->changePassword();

            if($funcion==0){
                $msj = "su clave ha sido cambiada con exito";
            }   
            else if($funcion==1){
                $msj = "su clave no puede ser igual a las ultimas  anteriores";
            }else if($funcion==2){
                $msj = "su clave actual no coincide";
            }

        }
    }
    header("location: ../vista/sis/MisDatos.php?msj=".$msj);

//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------

  $IdPersona   = trim( $_POST['IdPersona'] );
  $CodMov      = trim( $_POST['CodMovil'] );
  $TelfMov     = trim( $_POST['TelfMov'] );
  $CodHab      = trim( $_POST['CodHab'] );
  $TelfHab     = trim( $_POST['TelfHab'] );
  $Email       = trim( $_POST['Email'] );
  $Parroquia   = trim( $_POST['Parroquia'] );
  $Dir         = trim( $_POST['Dir'] );
  $Salario     = trim( $_POST['Salario'] );


//--------------------------------------------------------------------
//    Llamado de clase y creación de objeto
//--------------------------------------------------------------------
   include_once("../modelo/MSocio.php");
    $OSocio = new Socio();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
  
  $OSocio->setIdPersona    ( $IdPersona    );
  $OSocio->setDir          ( $Dir          );
  $OSocio->setCodMovil     ( $CodMov       );
  $OSocio->setTeflMovil    ( $TelfMov      );
  $OSocio->setCodFijo      ( $CodHab       );
  $OSocio->setTelfFijo     ( $TelfHab      );
  $OSocio->setSalario      ( $Salario      );
  $OSocio->setEmail        ( $Email        );
  $OSocio->setParroquia    ( $Parroquia    );

  
  $OSocio->actualizarDatos();

 
  



//Fin del controlador  
?>