/* MAIN */
$(document).ready(function () {
    $("#btnReservar").click(function () {
        enviarFormulario();
    });

    getHabitaciones();

    $("#cboHotel").change(function () {
        getHabitaciones();
    });

    $("#carousel-promo").carousel({
        interval: 5000
    });

    $("#carousel-news").carousel({
        interval: 5000
    });
});

function enviarFormulario() {
    $("#frmBooking").submit();
}

function getHabitaciones() {
    var id = $("#cboHotel").val();
    var URL = $contextPath + '/webservices/habitaciones.ws.php';
    var data = {id: id};
    $.post(URL, data, function (data) {
        $("#cboHabitacion").empty();
        for(var i=0;i<data.length;i++) {
            $("#cboHabitacion").append(new Option(data[i].NOMBRE, data[i].ID));
        }
    });
}