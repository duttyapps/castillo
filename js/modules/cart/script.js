$(document).ready(function () {
    $('*[del-item]').each(function () {
        $(this).click(function (e) {
            e.preventDefault();
            delCartItem($(this).attr('del-item'));
        });
    });
});

function delCartItem(id) {
    var URL = $contextPath + '/webservices/cart.ws.php';
    var data = {
        'action': 'del',
        'id': id,
    };

    $.getJSON(URL, data, function (response) {
        if(response.code == '1') {
            window.location = $contextPath + '/cart';
        } else {
            alert(response.msg);
        }
    });
}