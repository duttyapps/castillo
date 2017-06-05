$(document).ready(function () {

    getQtyCart();

    $('#checkin').datetimepicker({
        disabledHours: 0,
        locale: 'es',
        format: 'DD/MM/YYYY',
        minDate: new Date()
    }).on("dp.change", function (e) {
        $('#checkout').data("DateTimePicker").minDate(e.date);
    });

    $('#checkout').datetimepicker({
        disabledHours: 0,
        locale: 'es',
        format: 'DD/MM/YYYY'
    });
    
    $("#btnHome").click(function () {
        window.location = $contextPath + '/';
    });

    $("*[div-href]").css({'cursor':'pointer'});
    $("*[div-href]").click(function (e) {
        e.preventDefault();
        document.location = $(this).attr('div-href');
    });

    $("#cboFilter").change(function () {
        var n = $(this).val();
        var page = getParameterByName('page') | 1;
        window.location = window.location.href.split('?')[0] + '?page=' + page + '&filter=' + n;
    });

    $("#cart").hover(function() {
        if($("#cart-details").is(':hidden')) {
            showCartDetails();
        }
    });

    $("#btnCloseCartDet").click(function () {
        $("#cart-details").fadeOut('fast');
    });
});

function showCartDetails() {
    $("#cart-details").fadeIn('fast');
    getCartDetails();
}

function getCartDetails() {

    $("#cart-det-list").html('<img src="' + $contextPath + '/images/loading.gif">');

    var URL = $contextPath + '/webservices/cart.ws.php';
    var data = {
        action: 'get'
    };
    $.getJSON(URL, data, function (res) {
        var html = '';
        var total = 0.00;
        var cant = 0;
        $.each(res, function (i, v) {
            html += '<div class="cart-det-list-item clearfix">' +
                '<div id="cart-det-list-item-img"><img src="' + $contextPath + '/images/products/' + v.ID + '.jpg" width="80" height="80"></div>' +
                '<div id="cart-det-list-item-title">' + v.NOMBRE + '</div>' +
                '<div id="cart-det-list-item-span">' + v.DESCRIPCION_CORTA.substr(0, 30) + '</div>' +
                '<div id="cart-det-list-item-qty">Cantidad: ' + v.CANTIDAD + '</div>' +
                '<div id="cart-det-list-item-price">S/ ' + v.PRECIO.toFixed(2) + '</div>' +
                '</div>'
            total += parseFloat(v.PRECIO);
            cant += v.CANTIDAD;
        });

        $("#qty-prod").html(cant);
        $("#subtotal").html('S/ ' + total.toFixed(2));
        $("#cart-det-list").html(html);
    });
}

function getQtyCart() {
    var URL = $contextPath + '/webservices/cart.ws.php';
    var data = {
        action: 'count'
    };
    $.getJSON(URL, data, function (res) {
        $("#cart-qty").html(res.total);
    });
}

function getParameterByName(name, url) {
    if (!url) {
        url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}