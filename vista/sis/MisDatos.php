<?php
session_start();

  include_once("../../modelo/MCombo.php");
  $combo = new Combo();

  if(!isset($_SESSION["userActivo"])){
        header("location: ../pub/Acceso.php");
    }

  include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();
    
    if (isset($_SESSION["userActivo"])){
        $OSocio -> setCedula($_SESSION["userActivo"]);
        $registro=$OSocio -> busCedulaDetalle();
        while ( $fila = $OSocio->setArreglo( $registro )) $datos[] = $fila;
        foreach ($datos as $Soc) { $Soc; }
    }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Mis Datos</title>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->
  <!--  Propiedades -->
    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../js/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
    <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->
  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/JsMisDatos.js"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
</head>
<body>  

 <?php include_once('Menu.php'); ?><!-- Menu Lateral -->         
 <div class="ui container"> 
  <h2 class="ui center aligned small block icon inverted header">
    <i class="user icon"></i>
    Mis Datos
  </h2>
  <form class="ui large form" method="POST" action="../../controlador/CMisDatos.php" name="formulario" id="formulario">

    <div class="ui icon info message">
      <i class="large info circle icon"></i>Por favor asegurese de mantener sus datos actualizados. 
    </div>
    <h4 class="ui dividing header">Cambio de Clave</h4>
    <div class="two fields">
      <div class="ui field">
        <label>Clave Actual</label>
        <div class="ui input">
          <input type="password" name="ClaveActual">
        </div>
      </div>

    </div>
    <div class="two fields">
      <div class="ui field">
        <label>Clave Nueva</label>
        <div class="ui input">
          <input type="password" name="ClaveNueva">
        </div>
      </div>

    </div>
    <div class="two fields">
      <div class="ui field">
        <label>Repita Clave Nueva</label>
        <div class="ui input">
          <input type="password" name="ClaveNueva2">
        </div>
      </div>

    </div>
    <button type="submit" class="ui sumbit primary button" name="evento" value="CambiarNuevaClave">Cambiar Clave</button>
    <h4 class="ui dividing header">Datos Personales</h4>
    <div class="two fields">

      <div class="ui field">
        <label>Cédula</label>            
        <div class="ui transparent input">
          <input type="text" name="CI" id="CI" placeholder="Cédula" readonly value="<?php if(isset($Soc['nacionalidad'])) echo $Soc['nacionalidad'].'-'.$Soc['cedula'] ;  ?>">              
        </div>
      </div>

      <div class="ui field"><!-- Fecha de Nacimiento -->
        <label>Fecha de Nacimiento</label>
        <div class="ui transparent input">
          <input type="text" name="FechaNac" id="FechaNac" placeholder="dd/mm/aaaa" readonly value="<?php if(isset($Soc['fecha_nacimiento'])) echo date('d/m/Y',strtotime( $Soc['fecha_nacimiento'])) ?>">
        </div>
      </div>

    </div>

    <div class="ui two fields">

      <div class="field"><!-- Nombre -->
        <label>Nombre</label>
        <div class="ui transparent input">
          <input type="text" name="Nombre" id="Nombre" maxlength="20" placeholder="Nombre" readonly value="<?php if(isset($Soc['nombre1'])) echo $Soc['nombre1'].' '.$Soc['nombre2'] ;  ?>"> 
        </div>
      </div>

      <div class="field">
        <label>Apellido</label>
        <div class="ui transparent input"><!-- Apellido -->
          <input type="text" name="Apellido" id="Apellido" placeholder="Apellido" readonly value="<?php if(isset($Soc['apellido1'])) echo $Soc['apellido1'].' '.$Soc['apellido2'] ;  ?>">
        </div>
      </div>

    </div>

    <div class="ui inline field"><!-- Fecha de Nacimiento -->
      <label>Fecha de inscripción a la Caja de Ahorros</label>
      <div class="ui transparent input">
        <input type="text" name="FechaIns" id="FechaIns"  readonly value="<?php if(isset($Soc['fechaafi'])) echo date('d/m/Y',strtotime( $Soc['fechaafi'])) ?>">
      </div>
    </div> 

    <h4 class="ui dividing header">Información de Contacto</h4>

    <div class="ui two fields"><!-- Telefonos -->
      <div class="field">
        <label>Teléfono Móvil</label>
        <div class="fields">
          <div class="five wide field"><!-- Movil -->
            <?php
            $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=4", "nombre_largo","nombre_largo", isset($Soc['cod_telf_movil'])?$Soc['cod_telf_movil']:'','CodMovil',' class="ui compact dropdown"');
            foreach ($tagcbotp as $tagtp){echo $tagtp;}
            ?>
          </div>
          <div class="field">
            <input type="text" name="TelfMov" id="TelfMov" placeholder="Teléfono Móvil" maxlength="7" onkeypress="return soloNumeros(event)" value="<?php if(isset($Soc['telf_movil'])) echo $Soc['telf_movil'];  ?>">
          </div>
        </div>
      </div>
      <div class="field">
        <label>Teléfono Habitación</label>
        <div class="fields">
          <div class="five wide field"><!-- Fijo -->
            <?php
            $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=5", "nombre_largo","nombre_largo", isset($Soc['cod_telf_fijo'])?$Soc['cod_telf_fijo']:'','CodHab',' class="ui compact dropdown"');
            foreach ($tagcbotp as $tagtp){echo $tagtp;}
            ?>
          </div>
          <div class="field">
            <input type="text" name="TelfHab" id="TelfHab" placeholder="Teléfono Hab." maxlength="7" onkeypress="return soloNumeros(event)" value="<?php if(isset($Soc['telf_fijo'])) echo $Soc['telf_fijo'];  ?>" >
          </div>
        </div>
      </div>
    </div>

    <div class="ui required field"><!-- Email -->
      <label>Correo Electrónico <i class='fitted help circle icon link' data-title="Ayuda" data-content='En éste correo recibirá notificaciones e información importante relacionada a la Caja de Ahorros.' data-variation='basic'></i></label>
      <div class="ui left icon input">
        <input type="text" name="Email" id="Email" placeholder="Correo Electrónico" value="<?php if(isset($Soc['email'])) echo $Soc['email']  ?>" >
        <i class="mail outline icon"></i>
      </div>
    </div>    

    <h4 class="ui dividing header">Datos Residenciales</h4>

    <div class="three fields"><!-- Estado - Municipio - Parroquia -->     

      <div class="ui required field">
        <label>Estado</label>
        <?php
        $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_estado WHERE estatus='1'", "id_estado","estado", isset($Soc['estado'])?$Soc['estado']:'','Estado',' class="ui compact dropdown"');
        foreach ($tagcbotp as $tagtp){echo $tagtp;}
        ?>
      </div>

      <div class="ui required field">
        <label>Municipio</label>
        <?php
        $tagcbotp=$combo->gen_combo_dependiente("SELECT * FROM cappiutep.t_municipio WHERE estatus='1'", "id_municipio","municipio", isset($Soc['municipio'])?$Soc['municipio']:'','Municipio',' class="ui compact dropdown"',"id_estado");
        foreach ($tagcbotp as $tagtp){echo $tagtp;}
        ?>
      </div>

      <div class="ui required field">
        <label>Parroquia</label>
        <?php
        $tagcbotp=$combo->gen_combo_dependiente("SELECT * FROM cappiutep.t_parroquia WHERE estatus='1'", "id_parroquia","parroquia", isset($Soc['id_parroquia'])?$Soc['id_parroquia']:'','Parroquia',' class="ui compact dropdown"',"id_municipio");
        foreach ($tagcbotp as $tagtp){echo $tagtp;}
        ?>
      </div>

    </div>

    <div class="ui required field"><!-- Direccion -->
      <label>Dirección</label>
      <div class="field">
        <textarea name="Dir" id="Dir" rows="2"><?php if(isset($Soc['direccion'])) echo $Soc['direccion'];  ?> </textarea>
      </div>
    </div>

    <h4 class="ui dividing header">Datos Ocupacionales</h4>

      <div class="three fields">
        
        <div class="ui field">
          <label>Fecha de Ingreso <i class='fitted help circle icon link' data-title="Ayuda" data-content='Fecha en la que ingresó como docente a la UPTP.' data-variation='basic'></i></label>
          <div class="ui transparent input">
            <input type="text" name="FechaIng" id="FechaIng" placeholder="N/A" readonly value="<?php if(isset($Soc['fecha_ini_docente'])) echo date('d/m/Y',strtotime( $Soc['fecha_ini_docente'])) ?>">
          </div>
        </div>

        <div class="ui field">
          <label>Sede</label>
          <div class="ui transparent input">
            <input type="text" name="Sede" id="Sede" placeholder="Sede" readonly value="<?php if(isset($Soc['sede'])) echo $Soc['sede'];  ?>">
          </div>
        </div>

        <div class="ui field">
          <label>Salario Mensual</label>
          <div class="ui left labeled input">
            <div class="ui label">Bs.</div>
            <input type="text" id="Salario" name="Salario" placeholder="Salario" onkeypress="return soloNumeros(event)" maxlength="12" value="<?php if(isset($Soc['salario'])) echo $Soc['salario'];  ?>">
          </div>
        </div>

      </div>

      <div class="three fields">

        <div class="ui field">
          <label>Tipo de Docente</label>
          <div class="ui transparent input">
            <input type="text" name="TipoDocente" id="TipoDocente" placeholder="N/A" readonly value="<?php if(isset($Soc['tdocente'])) echo $Soc['tdocente'];  ?>">
          </div>
        </div>

        <div class="ui field">
          <label>Categoria</label>
          <div class="ui transparent input">
            <input type="text" name="Categoria" id="Categoria" placeholder="N/A" readonly value="<?php if(isset($Soc['cdocente'])) echo $Soc['cdocente'];  ?>">
          </div>
        </div>

        <div class="ui field">
          <label>Dedicación</label>
          <div class="ui transparent input">
            <input type="text" name="Dedicacion" id="Dedicacion" placeholder="N/A" readonly value="<?php if(isset($Soc['ddocente'])) echo $Soc['ddocente'];  ?>">
          </div>
        </div>

      </div>


      

          

    <div class="ui error message"></div> 
    <div class="ui center aligned block inverted header">
      <input type="hidden" name="opera" id="opera">
      <input type="hidden" name="IdPersona" id="IdPersona" value="<?php if(isset($Soc['id_persona'])) echo $Soc['id_persona'];  ?>">
      <input type="button" class="ui sumbit primary button" value="Guardar" onclick="enviar(this.value)">
      <input type="button" class="ui red button" value="Cancelar" onclick="window.location='Inicio.php'">   
    </div>
  </form>
</div>  
<?php if(isset($_GET["msj"])): ?>
  <script type="text/javascript">
    swal({
        type:"success",
        text: "<?= $_GET['msj'] ?>",
        showCancelButton: false,
        confirmButtonText: "Continuar",
        confirmButtonColor: "#2185d0",
      });
  </script>
<?php endif; ?>
</body>
</html>