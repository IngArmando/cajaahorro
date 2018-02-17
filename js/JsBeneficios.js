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
      keyboardShortcuts: false,	
    	inline : true,
  		fields: {

        FechaIni: {
          identifier: 'FechaIni',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          }
          ]
        },

        Icono: {
          identifier: 'Icono',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          }
          ]
        },

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

        Desc: {
          identifier: 'Desc',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
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

        MinDiasAprob: {
          identifier: 'MinDiasAprob',
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
            type   : 'menorQueCampo[MaxDiasAprob]',
            prompt : 'Debe ser menor que los días máximos para aprobación.'
          }
          ]
        },

        MaxDiasAprob: {
          identifier: 'MaxDiasAprob',
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
            type   : 'mayorQueCampo[MinDiasAprob]',
            prompt : 'Debe ser mayor que los días mínimos para aprobación.'
          }
          ]
        },

        MinDiasAnt: {
          identifier: 'MinDiasAnt',
          rules: [
          {
            type   : 'empty',
            prompt : 'No puede estar en blanco.'
          },
          {
            type   : 'integer[0...999]',
            prompt : 'Debe ser un número entero.'
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
          window.location="ConfigBeneficios.php";
        }
        );
      },4000);
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
