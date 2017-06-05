$(document).ready(function () {

    $("#btnAddCart").click(function (e) {
        e.preventDefault();

        var URL = $contextPath + '/webservices/cart.ws.php';
        var data = {
            'action': 'add',
            'id_prod': $("#hdnPID").val() ,
            'id_cat': $("#hdnCID").val(),
            'cant': $("#txtCantidad").val()
        };

        $.post(URL, data, function (response) {
            if(response.code == '1') {
                window.location = $contextPath + '/cart';
            } else {
                alert(response.msg);
            }
        }, 'json');
    });

    $(".btnAddCartUnit").click(function (e) {
        e.preventDefault();

        var text_tmp = $(this).html();

        $(this).prop('disabled', true);
        $(this).html('Agregando...');

        var URL = $contextPath + '/webservices/cart.ws.php';
        var data = {
            'action': 'add',
            'id_prod': $(this).attr('item-id'),
            'id_cat': $(this).attr('item-cat'),
            'cant': 1
        };

        $.post(URL, data, function (response) {
            if(response.code == '1') {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                getQtyCart();
                showCartDetails();
            } else {
                alert(response.msg);
            }
        }, 'json');

        $(this).prop('disabled', false);
        $(this).html(text_tmp);
    });

    $("#txtCantidad").change(function () {
        var cant = $(this).val();
        var prec = $("#hdnPRECIO").val();
        $("#price").html(parseFloat(cant*prec).toFixed(2));
    });
});

function delCartItem(id) {
    var URL = $contextPath + '/webservices/cart.ws.php';
    var data = {
        'action': 'del',
        'id': id,
    };

    $.post(URL, data, function (response) {
        if(response.code == '1') {
            window.location = $contextPath + '/cart';
        } else {
            alert(response.msg);
        }
    }, 'json');
}