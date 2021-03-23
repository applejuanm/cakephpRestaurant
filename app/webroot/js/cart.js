$(document).ready(function() {
    //cada vez que pulsemos enter o cambie el input
    //cambia la operacion del selector .numeric
    $('.numeric').on('keyup change' , function (event) {
        //redondeamos el valor que nos llega
        var cantidad = Math.round($(this).val());
        //con esta funcion que estamos llamando, llamamos a nuestro
        //id lo almacenamos con nuestra vista data-id
        ajaxupdate($(this).attr("data-id"),cantidad);
    });
    //mandamos tanto el id como cantidad, que lo hemos mandado arriba
    function ajaxupdate(id, cantidad) {
        //metodo ayax
        $.ajax({
            type: "POST",
            url: basePath + "pedidos/itemupdate",
            data: {
                id: id,
                cantidad: cantidad
            },
            //nos devuelve un json
            dataType: "json",
            //llenamos el succes, usamos una funcion que mandamos el data desde jsonEnconde
            success: function (data) {
                //lo que tenemos en el html de aqui dentro va a ser diferente
                //id de subtotal
                //si este valor de data_mostrar_pedido id va a ser diferente a datamostrarpedidosubtotal actualizado
                if($('#subtotal_' + data.mostrar_pedido.id).html() != data.mostrar_pedido.subtotal){
                    //mostramos el nuevo valor del subtotal
                    $('#subtotal_' + data.mostrar_pedido.id).html(data.mostrar_pedido.subtotal).animate({
                        backgroundColor : "#ff8"}, 100).animate({backgroundColor: "#fff"}, 500);
                    
                }
                //mostramos el total actualizado
                $('#total').html('€ ' + data.mostrar_pedido.total).animate({
                    backgroundColor : "#ff8"}, 100).animate({backgroundColor: "#fff"}, 500);
            }
                
            
        });
    }
     //seleccionamos nuestro class con una funcion click
     $('.remove').click(function(){
      
        //seteamos el atributo en 0
        ajaxcart($(this).attr("id"), 0);
        return false;

    });
    //funcion con parametro de id y de cantidad 
        function ajaxcart(id, cantidad) {
        
        if(cantidad === 0){
            //si el dom de row es 0, quitamos el elemento de la fila que correspone al DOM y poder quitarlo
            $('#row-' + id).fadeOut(1000, function(){
                //apuntamos a la propiedad del id correspondiente con el metodo remove
                $('#row-' +id).remove();
            });
        }

        $.ajax({
            type: "POST",
            url: basePath + "pedidos/remove",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data){
                //mensaje de borrado
                $('#msg').html('<div class="alert alert-success flash-msg">Pedido Eliminado.</div>');
                $('.flash-msg').delay(2000).fadeOut('slow');
                
                //borra visualmente los campos con animacion
                $('#total').html('$' + data.mostrar_total_remove).animate({backgroundColor: "#ff8"}, 100).animate({backgroundColor: "#fff"}, 500);
                
                //si no hay ningun registro de pedidos, nos redirige al indice de platillos
                if(data.pedidos == "")
                {
                    window.location.replace(basePath + "platillos/index");
                }
            },
            error: function(){
                alert("Tenemos problemas!!");
            }
        });
    }
    
});