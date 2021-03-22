$(document).ready(function() {
    //cada vez que pulsemos enter o cambie el input
    //cambia la operacion
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

});