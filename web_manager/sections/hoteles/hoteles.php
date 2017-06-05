<?php
date_default_timezone_set('America/Lima');
include '../../connection.php';

$act = $_GET['action'];

if($act == 'getHoteles') {
    header('Content-Type: application/json');
    $db->orderBy('ID');
    echo json_encode($db->get('hoteles'));
}

if($act == 'getHotel') {
    header('Content-Type: application/json');
    $id = $_GET['hID'];
    $db->where('ID', $id);
    echo json_encode($db->getOne('hoteles'));
}

if($act == 'getHabitaciones') {
    header('Content-Type: application/json');
    $hid = $_GET['hID'];
    $db->where('HOTEL_ID', $hid);
    $db->orderBy('ID');
    echo json_encode($db->get('hotel_habitaciones'));
}

if($act == 'getHabitacion') {
    header('Content-Type: application/json');
    $hid = $_GET['hID'];
    $habid = $_GET['habID'];
    $db->where('ID', $habid);
    $db->where('HOTEL_ID', $hid);
    echo json_encode($db->getOne('hotel_habitaciones'));
}

if($act == 'grabar') {
    $nombre = $_POST['p_nombre'];
    $descripcion = $_POST['p_descripcion'];
    $estado = $_POST['p_estado'];

    $data = Array(
        'NOMBRE' => $nombre,
        'DESCRIPCION' => $descripcion,
        'ACTIVO' => $estado
    );

    $id = $db->insert ('hoteles', $data);

    if($id) {
        echo '1';
    } else {
        echo $db->getLastError();
    }
}

if($act == 'actualizar') {
    $id = $_GET['hID'];
    $nombre = $_POST['p_nombre'];
    $descripcion = $_POST['p_descripcion'];
    $estado = $_POST['p_estado'];

    $data = Array(
        'NOMBRE' => $nombre,
        'DESCRIPCION' => $descripcion,
        'ACTIVO' => $estado
    );

    $db->where ('ID', $id);
    if($db->update('hoteles', $data)) {
        echo '1';
    } else {
        echo $db->getLastError();
    }
}

if($act == 'eliminar') {
    $id = $_GET['hID'];
    $db->where ('ID', $id);
    if($db->delete('hoteles', $data)) {
        echo '1';
    } else {
        echo $db->getLastError();
    }
}

if($act == 'grabarHabitacion') {
    $hid = $_POST['p_hid'];
    $nombre = $_POST['p_nombre'];
    $cantidad = $_POST['p_cantidad'];
    $capacidad = $_POST['p_capacidad'];
    $precio = $_POST['p_precio'];

    $data = Array(
        'HOTEL_ID' => $hid,
        'NOMBRE' => $nombre,
        'CANTIDAD' => $cantidad,
        'CAPACIDAD' => $capacidad,
        'DISPONIBLE' => $capacidad,
        'PRECIO' => $precio
    );

    $id = $db->insert ('hotel_habitaciones', $data);

    if($id) {
        echo '1';
    } else {
        echo $db->getLastError();
    }
}

if($act == 'actualizarHabitacion') {
    $id = $_GET['habID'];
    $hid = $_POST['p_hid'];
    $nombre = $_POST['p_nombre'];
    $cantidad = $_POST['p_cantidad'];
    $capacidad = $_POST['p_capacidad'];
    $precio = $_POST['p_precio'];

    $data = Array(
        'HOTEL_ID' => $hid,
        'NOMBRE' => $nombre,
        'CANTIDAD' => $cantidad,
        'CAPACIDAD' => $capacidad,
        'DISPONIBLE' => $capacidad,
        'PRECIO' => $precio
    );

    $db->where('ID', $id);
    if($db->update ('hotel_habitaciones', $data)) {
        echo '1';
    } else {
        echo $db->getLastError();
    }
}

if($act == 'eliminarHabitacion') {
    $id = $_GET['habID'];
    $db->where ('ID', $id);
    if($db->delete('hotel_habitaciones', $data)) {
        echo '1';
    } else {
        echo $db->getLastError();
    }
}