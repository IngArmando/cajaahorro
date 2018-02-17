$(document)
  .ready(function(){

    var validacionDescripcion ={//validaciones
      descripcion_tr: {
        identifier  : 'descripcion_tr',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor escriba la desccripcion del prestamo.'
          }
        ]
      },
    }
  ;

  $('.ui.form').form(validacionDescripcion,{//funcion que activa las validaciones
    inline: true
  });

});