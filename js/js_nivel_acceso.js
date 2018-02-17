$(document)
  .ready(function(){

    var validacionNivel_acceso ={//validaciones
      nivel_acceso_descripcion: {
        identifier  : 'nivel_acceso_descripcion',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor escriba el nivel de acceso.'
          }
        ]
      },
    }
  ;

  $('.ui.form').form(validacionNivel_acceso,{//funcion que activa las validaciones
    inline: true
  });

});