$(document)
  .ready(function(){

    var validacionBancos ={//validaciones
      nombre_banco: {
        identifier  : 'nombre_banco',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor escriba el nombre del banco.'
          },
          {
            type   : 'length[5]',
            prompt : 'Debe contener al menos 5 caracteres.'
          }
        ]
      },
    }
  ;

  $('.ui.form').form(validacionBancos,{//funcion que activa las validaciones
    inline: true
  });

    $("#nombre_banco").on("keypress",function(event){
        e = event;
       //compatibilidad con navegadores para saber que tecla se pulso
        key = e.keyCode || e.which;
        //convertimos la letra a minuscula y lo pasamos de int a char
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz.,"; //caracteres admitidos
        especiales = [8,35,36,37,46,39,9];
        tecla_especial = !1;
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }    
        //si no pulse una tecla valida, y la tecla_especial no se pulso
        if(letras.indexOf(tecla) == -1 && !tecla_especial) {
            return!1;
        }
    });

    $("#codigo").on("keypress",function(){
         key = e.keyCode || e.which;
        //console.log(key);
        tecla = String.fromCharCode(key).toLowerCase();
        letras = "0123456789";
        especiales = [8,35,36,37,45,46,39,9];
        tecla_especial = !1;
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
        if(letras.indexOf(tecla) == -1 && !tecla_especial)
            return!1;
    });

});