$(document).ready(function(){

    $(function(){
        $('#txtUsuario').on('change',function(){
            var user = $('#txtUsuario').val();

            if (user!=''){
                $('#Servs').removeClass('ui hidden');
                $('#Servs').addClass('ui container');
            } else {
                $('#Servs').removeClass('ui container');
                $('#Servs').addClass('ui hidden');
            }
        });
    });
});


function guardarBD(that,operacion,modulo,servicio){
    _this = that;
    usuario = document.getElementById("txtUsuario");
    chequeado = _this.checked;
    if(usuario.value!=""){
        if(chequeado){
            //mostrarMensaje("a",operacion,modulo,servicio);// a = asigno
            guardar(_this.name,"guardar");
        }else{
            //mostrarMensaje("e",operacion,modulo,servicio);// e = elimino
            guardar(_this.name,"eliminar");
        }
    }else{
        _this.checked = false;
        alert("Debe seleccionar un Usuario");
    }
}

function guardar(nombre,tipo){
    usuario = document.getElementById("txtUsuario").value;
    arreglo = nombre.split("-");
    idmodulo = arreglo[0]; idservicio = arreglo[1]; idoperacion = arreglo[2];
    console.log(URL_ABSOLUTA);
    $.post(URL_ABSOLUTA+"controlador/CRoles.php",{envio:"ajax",accion:tipo,usuario:usuario,modulo:idmodulo,servicio:idservicio,operacion:idoperacion},function(data){
        console.log(data);
    });
}
function limpiarCheckbox(){
    //$("#rutamensajes").html("");
    checkbox = document.getElementsByTagName("input");
    for(a in checkbox){
        checkbox[a].checked=false;
    }
}
function buscarServiciosAsignados(usuario){
    if(usuario!="") {
        console.log("entro por aqui");
        $.get(URL_ABSOLUTA+"controlador/CRoles.php",{envio:"ajax",obtenerServicios:"1",usuario:usuario},function(data){
            console.log(data);
            datos = JSON.parse(data);
            for(index in datos){
                M_S_O = datos[index]["id_modulo"]+"-"+datos[index]["id_servicio"]+"-"+datos[index]["id_operacion"];
                console.log("id: "+M_S_O+" \n");
                document.getElementById(M_S_O).checked="checked";
            }
        });
    }
}
function todoOperacion(that,servicio,modulo){
    usuario = document.getElementById("usuario").value;
    _this = that;
    id = _this.id;
    if(usuario!=""){
        if(_this.checked==true){
            for(i=1;i<=6;i++){
                boton = document.getElementById(id+"-"+i);
                boton.checked=true;
                nombreBoton = boton.getAttribute("nombre");
                guardarBD(boton,nombreBoton,modulo,servicio);
            }
        }else{
            for(i=1;i<=6;i++){
                boton = document.getElementById(id+"-"+i);
                boton.checked=false;
                nombreBoton = boton.getAttribute("nombre");
                guardarBD(boton,nombreBoton,modulo,servicio);
            }
        }
    }
}
