<?php
    session_start();
    if(!isset($_SESSION["userActivo"])){
        header("location: ../pub/Acceso.php");
    }
    include_once("../../modelo/MCombo.php");
    $combo = new Combo();
    include_once("../../modelo/MBeneficios.php");
    $OBenef = new Beneficio();
    $tasaInteres = $OBenef->get_tasa_interes(2);
    include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();
    $tipoDocente = $OSocio->getTipoDocente($_SESSION["userActivo"]);
    if (isset($_SESSION["userActivo"])){
        $OSocio -> setCedula($_SESSION["userActivo"]);
        $registro=$OSocio -> busCedula();
        while ( $fila = $OSocio->setArreglo( $registro )) $datos[] = $fila;
        foreach ($datos as $Soc) { $Soc; }
    }
    $haberesSocio = $OSocio->getHaberes($Soc["id_persona"]);
    $debe = false;
    if($bloqueadoPrestado>0 || $bloqueadoFianza>0){
        $debe = true;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Retiros</title>

    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->

    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
    <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
    <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->

    <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
    <script src="../../js/main.js"></script> <!--Configura Interfaz -->
    <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
    <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
    <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>
<body>  
    <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->
    <div class="ui container"> 
        <h2 class="ui center aligned small block icon inverted header">
            <i class="share square icon"></i>
            Retiro Total                
        </h2>
        <form class="ui large form" method="POST" name="formulario" id="formulario" autocomplete="off" action="../../controlador/CSolicitudRetiroParcial.php">
        
            <h3 class="ui center aligned header"> Solicitud de Retiro Total </h3> 
            <?php if(!$debe): ?>
            <p>
              Los campos marcados con * son obligatorios.
            </p>
            <h4 class="ui dividing header">Datos de la solicitud</h4>
            
              <div class="inline field">
                <label>Monto a retirar</label>
                <div class="ui transparent input">
                  <input type="text" value="<?php if (isset($haberesSocio)) echo "Bs. ".number_format($haberesSocio, 2, ',', '.') ?>">
                </div>
              </div> 

              <div class="required field"><!-- Guardar en observaciones, borrar este comentario despues -->
                <label>Motivo del Retiro</label>
                <textarea id="observacion" name="observacion" class="ui textarea" rows="3" maxlength="150"></textarea>
              </div>       


            <div class="ui message">
                <p align="justify">
                  En caso de que la presente solicitud fuese resuesta favorable,
                  se liquidaran la totalidad de sus haberes y quedará desvinculado
                  de la caja de ahorro y sus beneficios.
                </p>
                <div class="ui center aligned basic segment">
                    <div class="field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="terminos" id="terminos">
                            <label for="terminos"><b>He leído, entiendo y estoy de acuerdo con las condiciones descritas.<b></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui center aligned block inverted header">
                <input type="hidden" name="opera" id="opera" value="Solicitar">
                <input type="hidden" name="monto" id="monto" value="<?php if (isset($haberesSocio)) echo $haberesSocio ?>">
                <input type="button" class="ui primary button" value="Solicitar" name="btnSolicitar" onclick="enviar(this.value)">
                <a class="ui red button" href="Retiros.php">Cancelar</a>
            </div>
            <?php endif; ?>
            <?php if($debe): ?>
            <h4 class="ui dividing header">Deuda</h4>
            <div class="ui message">
                <p align="justify">
                    Usted no puede hacer un retiro total ya que tiene una deuda de <?=number_format($bloqueadoPrestado,"2",",",".")." Bs." ?> por motivo de prestamo
                    y una deuda de <?=number_format($bloqueadoFianza,"2",",",".")." Bs." ?> por motivo de fianzas para un total <?= number_format(intval($bloqueadoPrestado + $bloqueadoFianza),"2",",",".")." ." ?>
                </p>
            </div>
            <div class="ui center aligned block inverted header">
                <a class="ui red button" href="Retiros.php">Volver</a>
            </div>
            <?php endif; ?>
        </form>
    </div>
</body>
<script type="text/javascript">
     

    $(document).ready(function(){
    
      

    //Inicio Validaciones
        $('.ui.form')
        .form({
          on: 'submit',     
          inline : true,
          fields: {


            observacion: {
              identifier: 'observacion',
              rules: [
              {
                type   : 'minLength[10]',
                prompt : 'Debe contener al menos 10 caractéres.'
              }
              ]
            }

            
          }
        })
    ;
    
    //Fin validariones
    });


  

    function enviar(operacion) { 
      if ( $('form').form('is valid') ){
        switch(operacion){
            case "Solicitar":
                var redireccion="Retiros.php";
            break;
            case "Aprobar":
            case "Rechazar":
            case "Registrar":
                var redireccion="GestionSolicitudes.php";
            break;
        }

        swal({
          text: "¿Está seguro de realizar ésta acción?",
          type: "info",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtoncolor: "#d01919",
          confirmButtonText: "Aceptar",
          confirmButtonColor: "#2185d0",
          closeOnConfirm: false,
        },
        function(){
             swal.disableButtons();
                setTimeout(function(){
                    document.formulario.opera.value=operacion;
                    $("#formulario").submit(function(e){
                      var postData = $(this).serialize();
                      var formURL = $(this).attr("action");
                      $.ajax({
                        url : formURL,
                        type: "POST",
                        data : postData
                      });
                      e.preventDefault(); 
                    });
                    $("#formulario").submit();
                    swal({
                        type:"success",
                        text:"Operacion exitosa",
                        showCancelButton: false,
                        confirmButtonText: "Continuar",
                        confirmButtonColor: "#2185d0",
                    },function(){
                        window.location=redireccion;
                    }
                );
              },1500);
            });
        }
    }
</script>

</html>
