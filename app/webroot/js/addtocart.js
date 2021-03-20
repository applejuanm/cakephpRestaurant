$(document).ready(function () {
    $('.addtocart').on('click', function (event) {
        $.ajax({
            type: "POST",
            //controlador + accion a lo que nos va a redirigir
            url: basePath + "pedidos/add",
            data: {
                //corresponde la cantidad de nuestros productos al pedido
                //cada vez que guardemos un pedido que vaya con la cantidad 1
                id: $(this).attr('id'),
                cantidad: 1
            },
            //tipo de dato que recibimos de vuelta
            dataType: "html",
            success: function (data) {
                $('#msg').html('<div class="alert alert-success flash-msg">Platillo agregado al pedido</div>');
                $('.flash-msg').delay(2000).fadeOut('slow');
            },
            error: function () {
                alert('Tenemos problemas!!!');
            }
        });
        
        return false;
    });
});