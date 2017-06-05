<?php
include '../includes/db.connection.php';
$id = $_POST['id'];
$db->where('HOTEL_ID', $id);
$habitaciones = $db->get('hotel_habitaciones');
header('Content-Type: application/json');
echo json_encode($habitaciones);