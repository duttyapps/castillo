<?php
date_default_timezone_set('America/Lima');
include '../../connection.php';


$act = $_GET['action'];

if($act == 'getReservas') {
    header('Content-Type: application/json');
    $db->orderBy('ID');
    echo json_encode($db->get('reserva_hotel'));
}

if($act == 'getHotelDesc') {
    $hID = $_GET['hID'];
    $db->where('ID', $hID);
    echo $db->getValue('hoteles', 'NOMBRE');
}

if($act == 'getHabitacionDesc') {
    $hID = $_GET['hID'];
    $habID = $_GET['habID'];

    $db->where('ID', $habID);
    $db->where('HOTEL_ID', $hID);
    echo $db->getValue('hotel_habitaciones', 'NOMBRE');
}