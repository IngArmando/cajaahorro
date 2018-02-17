$(document).ready(function(){

   

    $.fn.form.settings.rules.menorQueCampo = function(campo,maximo){
      var valido = false; 
      var elemento = document.getElementById(maximo).value;
      var a =parseInt(campo);
      var b =parseInt(elemento);
      if (a<=b)
        valido=true;     
      return valido;
    };

    $.fn.form.settings.rules.mayorQueCampo = function(campo,minimo){
      var valido = false; 
      var elemento = document.getElementById(minimo).value;
      var a =parseInt(campo);
      var b =parseInt(elemento);
      if (a>=b)
        valido=true;     
      return valido;
    };

//Inicio Validaciones
  	$('.ui.form')
  	.form({
    	on: 'submit',
      keyboardShortcuts: false,	
    	inline : true,
  		fields: {

        Nombre: {
          identifier: 'Nombre',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'minLength[3]',
            prompt : 'Debe contener más de {ruleValue} caractéres.'
          },
          {
            type   : 'maxLength[40]',
            prompt : 'No debe contener más de {ruleValue} caractéres.'
          }
          ]
        },

        FechaIni: {
          identifier: 'FechaIni',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          }
          ]
        },

        Desc: {
          identifier: 'Desc',
          optional: true,
          rules: [
          {
            type   : 'minLength[5]',
            prompt : 'Debe contener más de {ruleValue} caractéres.'
          },
          {
            type   : 'maxLength[350]',
            prompt : 'No debe contener más de {ruleValue} caractéres.'
          }
          ]
        },

        TipoCargo: {
          identifier: 'TipoCargo',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          }
          ]
        },


        MinPers: {
          identifier: 'MinPers',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...9999]',
            prompt : 'Número inválido.'
          },
          {
            type   : 'menorQueCampo[MaxPers]',
            prompt : 'Debe ser menor que la cantidad máxima de personas con éste cargo.'
          },
          {
            type   : 'maxLength[2]',
            prompt : 'No debe contener más de {ruleValue} caractéres.'
          }
          ]
        },

        MaxPers: {
          identifier: 'MaxPers',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...100]',
            prompt : 'Debe ser un número entero.'
          },
          {
            type   : 'mayorQueCampo[MinPers]',
            prompt : 'Debe ser mayor que la cantidad mínima de personas con éste cargo.'
          },
          {
            type   : 'maxLength[4]',
            prompt : 'No debe contener más de {ruleValue} caractéres.'
          }
          ]
        },
  		}
  	})
;
//Fin validariones

 $(".Fecha").datepicker({//inicializacion selector de fechas
            maxDate: 0,
            minDate: -14,
            changeMonth: true,
            changeYear: true,
            showButtonPanel: false,
        });
   
   //Array para dar formato en español
  $.datepicker.regional['es'] = 
    {

    closeText: 'Cerrar', 
    currentText: 'Hoy',
    prevText: 'Previo', 
    nextText: 'Próximo',
    
    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
    'Jul','Ago','Sep','Oct','Nov','Dic'],
    monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
    dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
    dateFormat: 'dd/mm/yy', firstDay: 0, 
    initStatus: 'Selecciona la fecha', isRTL: false};
   $.datepicker.setDefaults($.datepicker.regional['es']);
  })
;


function enviar(operacion)
{	
  if ( $('form').form('is valid') )
  {
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
          window.location="ConfigCargosCajaAhorro.php";
        }
        );
      },1500);
    });
}
}


function soloNumeros(e){//Valida para que se escriban ssolo numeros
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

function soloLetras(e) {//Valida para que se escriban solo letras
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}