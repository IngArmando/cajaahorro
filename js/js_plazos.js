$(document)
  .ready(function(){

var validacionPlazo ={//validaciones

      dias: {//conmre de la validacion
        identifier  : 'dias_plazo',//id del campo que valida
        rules: [//reglas de validacion
          {//regla #1
            type   : 'empty',
            prompt : 'Indique los días del plazo.'
          }
        ]
      },//fin de la validacion de 1 campo
     
      descripcion: {//conmre de la validacion
        identifier  : 'nombre_plazo',//id del campo que valida
        rules: [//reglas de validacion
          {//regla #1
            type   : 'empty',
            prompt : 'Indique la descripción del plazo.'
          }
        ]
      },//fin de la validacion de 1 campo

    }
  ;

  $('.ui.form').form(validacionPlazo,{//funcion que activa las validaciones
    inline: true
  });

});


 function val_dias_plazos(valor)
 {	
 dias_plazos = valor;
     
     if(dias_plazos.req < 4 || isNaN(dias_plazos))
     	{   
     	 alert("Limite de Caracteres.");
         document.f_plazos.dias_plazos.value="";
        }
       else
       {
     	 digito_inicio = dias_plazos.substring(0,1);   
         if (digito_inicio == 0)
         {
         	alert("Limite de Caracteres.");
         	document.f_plazos.dias_plazos.value="";
         }         
    	}   	 
 }

 function val_descripcion_plazos(valor)
 {  
  descripcion_plazos= valor;
     if(descripcion_plazos.length < 8 || isNaN(descripcion_plazos))
      {   
       alert("codigo inválido.");
         document.f_plazos.descripcion_plazos.value="";
        }
       else
       {
       digito_inicio = descripcion_plazos.substring(0,1);   
         if (digito_inicio == 0)
         {
          alert("codigo inválido.");
          document.descripcion_plazos.id_plazos.value="";
         }         
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

