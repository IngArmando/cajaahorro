<?php @session_start();
    if(!isset($_SESSION["userActivo"])){
        header("location: ../pub/inise.php");
    }

    include_once("../../modelo/MBeneficios.php");
    $OBenef = new Beneficio();
    $tasaInteres = $OBenef->get_tasa_interes(1);

    include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        //obtenemos los datos del prestamo
        $datosSolicitud = $OBenef->buscarSolicitud($id);
        $haberesSocio = $OSocio->getHaberes($datosSolicitud["id_persona"]);
    }

    if (isset($_SESSION["userActivo"])){
        $OSocio -> setCedula($_SESSION["userActivo"]);
        $registro=$OSocio -> busCedula();
        while ( $fila = $OSocio->setArreglo( $registro )) $datos[] = $fila;
        foreach ($datos as $Soc) { $Soc; }
    }

    $tipoDocente = $Soc["tipo_docente"];
    $condiciones = $OBenef->getCondiciones(1,$tipoDocente);

    //OBTENER REQUISITOS
    $requisitos = $OBenef->getRequisitos(1);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Préstamos</title>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->   
  <!--  Propiedades -->

  <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
  <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->

  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
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
      <i class="money icon"></i>
        Préstamos                
    </h2>
    <form class="ui large form" method="POST" action="../../controlador/CPrestamoEspecial.php" name="formulario" id="formulario">
      <h3 class="ui center aligned header"> Analísis de Préstamo Especial </h3> 

        <a class="ui labeled icon button" href="Inicio.php">
          <i class="left arrow icon"></i>
          Volver
        </a> 

        <a class="ui right floated labeled icon button" onclick="verReporte()">
          <i class="print icon"></i>
          Imprimir
        </a>    
     
      <h4 class="ui dividing header">Datos del solicitante</h4>

      <div class="three fields">
        <div class="field">
          <label>Cédula</label>
          <div class="ui transparent input"><!-- Nro Cedula -->
            <input type="text" name="Cedu" id="Cedu" value="<?php if(isset($datosSolicitud['cedula'])) echo $datosSolicitud['nacionalidad'].'-'.$datosSolicitud['cedula']; ?>" readonly>
          </div>
        </div>

        <div class="field"><!-- Nombre -->
          <label>Nombre y Apellido</label>
          <div class="ui transparent input">
            <input type="text" name="Nombre" id="Nombre"  value="<?php if(isset($datosSolicitud['nombre1'])) echo $datosSolicitud['nombre1'].' '.$datosSolicitud['apellido1']; ?>" readonly>
          </div>
        </div>
      </div>

      <h4 class="ui dividing header">Datos de la solicitud</h4>
        
        <div class="three fields">
          
          <div class="field">
            <label>Monto Solicitado (en Bs.):</label>
            <input type="text" name="monto" id="monto" readonly value="<?php echo $datosSolicitud['monto'] ?>">
          </div>

          <div class="field">
            <label>Tasa de Interés (%):</label>
            <input type="text" name="interes" id="interes" value="<?php echo $datosSolicitud['interes_cuotas'] ?>" readonly>
          </div>
    
          <div class="field">
            <label>Total a cancelar:</label>
            <div class="ui transparent input">
              <input type="text" name="total_cancelar" id="total_cancelar" readonly value="<?php printf('%.2f',($datosSolicitud['monto'] * $datosSolicitud['interes_cuotas'] / 100) + $datosSolicitud['monto']) ?>">
            </div>
          </div>

        </div>

      <!--
      <p>IF cargo es de directivo y la solicitud esta en etapa de aprobacion MOSTRAR ANALISTA<p>
    <h4 class="ui dividing header">Analisado por</h4>
      <div class="three fields">
          <div class="field">
            <label>Cédula</label>
            <div class="ui transparent input"> Nro Cedula 
              <input type="text" name="Cedu" id="Cedu" value="<?php if(isset($Soc['cedula'])) echo $Soc['nacionalidad'].'-'.$Soc['cedula']; ?>" readonly>
            </div>
          </div>

          <div class="field"> Nombre 
            <label>Nombre y Apellido</label>
            <div class="ui transparent input">
              <input type="text" name="Nombre" id="Nombre"  value="<?php if(isset($Soc['nombre1'])) echo $Soc['nombre1'].' '.$Soc['apellido1']; ?>" readonly>
            </div>
          </div>
      </div>
  -->

      <div class="field">
        <label>Observación:</label>
        <textarea class="ui textarea" name="observacion" id="observacion" rows="3" style="resize: none"></textarea>
      </div>

      <div class="ui  message">
        <p align="justify">Requisitos a consignar:</p>
        <?php foreach($requisitos as $index => $requisito): ?>
          <div class="field">
            <div class="ui checkbox">
              <input id="terminos" name="terminos" type="checkbox" value="<?php echo $requisito[0] ?>">
              <label ><b><?php echo $requisito[1] ?><b></label>
            </div>
          </div>
        <?php endforeach; ?>
        
        <div class="ui center aligned basic segment">
          <div class="field">
            <div class="ui checkbox">
              <input type="checkbox" name="terminos_analisis" id="terminos_analisis">
              <label for="terminos"><b>El socio cumple con los requisitos para solicitar éste beneficio.<b></label>
            </div>
          </div>
        </div>
      </div>

      <div class="ui error message"></div>
    
      <div class="ui center aligned block inverted header">

          <!-- - - - - - - - - - - -PARA VALIDACIONES - - - - - - - - - - - - - - -->
          <input type="hidden" name="idSolicitud" value="<?php echo $_GET['id'] ?>">
          <input type="hidden" name="opera" id="opera">
          <input type="hidden" name="socio" id="socio" value="<?php if (isset($_SESSION['user'])) echo $_SESSION['user'] ?>">
          
          <!-- - - - - - - - - - - -BOTONES - - - - - - - - - - - - - - -->
          <input type="button" class="ui green button" value="Aprobar" onclick="enviar(this.value)">
          <input type="button" class="ui red button" value="Rechazar" onclick="enviar(this.value)">
          <a class="ui  button" href="GestionSolicitudes.php">Cancelar</a>   
      </div>
    </form>
  </div>  


<script type="text/javascript">

$(document).ready(function(){

    $.fn.form.settings.rules.menorQueCampo = function(campo,maximo){
      var valido = false; 
      var elemento = document.getElementById(maximo).value;
      var a =parseInt(campo);
      var b =parseInt(elemento);
      if (a<b)
        valido=true;     
      return valido;
    };

    $.fn.form.settings.rules.mayorQueCampo = function(campo,minimo){
      var valido = false; 
      var elemento = document.getElementById(minimo).value;
      var a =parseInt(campo);
      var b =parseInt(elemento);
      if (a>b)
        valido=true;     
      return valido;
    };

//Inicio Validaciones
    $('.ui.form')
    .form({
      on: 'submit',     
      inline : true,
      fields: {     
        monto: {
          identifier: 'monto',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'number',
            prompt : 'Sólo puede contener números.'
          }
          ]
        },

        terminos_analisis: {
          identifier: 'terminos_analisis',
          rules: [
          {
            type   : 'checked',
            prompt : 'Verifique los datos de la solicitud antes de proceder.'
          }
          ]
        },

        observacion: {
          optional: true,
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


function soloNumeros(e){//Valida para que se escriban solo numeros
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789,";
    especiales = "8-37-39-46";

    tecla_especial = false
    for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}
/*
function enviar(operacion){
    document.getElementById("opera").value=operacion;
    if(confirm("Esta seguro de realizar esta operación?")){
        document.formulario.submit();
    }
}*/

function verReporte(){
      var id = document.formulario.idSolicitud.value;
      window.open("../../fpdf/PDFPrestamoEspecial.php?id="+id);
    } 

function enviar(operacion){ 
    if ( $('form').form('is valid') ){
        switch(operacion){
            case "Solicitar":
                var redireccion="Prestamos.php";
            break;
            case "Procesar":
            case "Aprobar":
            case "Rechazar":
            case "Liquidar":
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
</body>
</html>
