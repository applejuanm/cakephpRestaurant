$(document).ready(function(){
    //selecciono el div del input
    $("#s").autocomplete({
        //a partir de 2 ya coge el nombre del platillo
        minLength: 2,
        //valor donde almacena el item seleccionado
        select: function(event, ui) {
            $("#s").val(ui.item.label);
        },
         //peticion ajax mas la respuesta que nos devuelve
        source: function(request, response) {
            $.ajax({
                url: basePath + "platillos/searchjson",
                //peticion que almacena el termino en un json,
                //luego este termino va a nuestro controlador
                data: {
                    term: request.term
                },
                dataType: "json",
                success: function(data){
                //aplicamos el metodo map
                //a partir de un array/objeto nos va a convertir a datos independientes
                //lo manejamos a partir de un data que estamos manejando desde json
                //que recibe un valor y un indice
                    response($.map(data, function(el, index){
                        return {
                            value: el.Platillo.nombre,
                            nombre: el.Platillo.nombre,
                            foto: el.Platillo.foto,
                            foto_dir: el.Platillo.foto_dir
                        };
                    }));
                }
            });
        }
        //este data nos va almacenar todos los elementos
        //asociados que hemos generado anteriormente en nuestro autocomplete
        //_renderItem lo que hace es controlar cada elemento de la funcion y cada elemento lo devuelve
        //ul es la etiqueta que va a crear e item el valor 
    }).data("ui-autocomplete")._renderItem = function(ul, item){
        return $("<li></li>")
        .data("item.autocomplete", item)
        .append("<a><img width='40' src='" + basePath + "files/platillo/foto/" + item.foto_dir + "/" + item.foto + "' />" + item.nombre +  "</a>")
        .appendTo(ul)
    };
});