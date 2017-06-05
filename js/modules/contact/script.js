$(document).ready(function () {
    $.getScript('https://maps.googleapis.com/maps/api/js?key=AIzaSyCqkv3y4Ks2dfHVdcVPbOWOFd1MUB7ajHk&callback=initMap');
});

function initMap() {
    var myLatLng = {lat: -11.5741397, lng: -77.2713058};

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 17,
        center: myLatLng,
        scrollwheel: false
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Castillo de Chancay'
    });
}