<?php
date_default_timezone_set('America/Lima');
include '../../connection.php';

include '../../classes/utils.class.php';

use \AdminClasses\Utils as Utils;

$act = $_GET['action'];

if($act == 'getPromociones') {
    header('Content-Type: application/json');
    $db->orderBy('ID');
    echo json_encode($db->get('promociones P',null, "P.*, DATE_FORMAT(FECHA_INI, '%d/%m/%Y') AS FECHA_INI, DATE_FORMAT(FECHA_FIN, '%d/%m/%Y') AS FECHA_FIN, if(FECHA_FIN>=STR_TO_DATE('".date('Y-m-d')."', '%Y-%m-%d'),'1', '0') AS VENCIDO"));
}

if($act == 'getPromocion') {
    $id = $_GET['pID'];
    header('Content-Type: application/json');
    $db->where('ID', $id);
    echo json_encode($db->getOne('promociones', "NOMBRE, DATE_FORMAT(FECHA_INI, '%d/%m/%Y') AS FECHA_INI, DATE_FORMAT(FECHA_FIN, '%d/%m/%Y') AS FECHA_FIN, ACTIVO, LINK"));
}

if($act == 'actualizarEstado') {
    $estado = $_GET['est'];
    $id = $_GET['pID'];
    $data = Array(
        'ACTIVO' => $estado
    );
    $db->where ('ID', $id);
    if ($db->update ('promociones', $data))
        echo '1';
    else {
        echo $db->getLastError();
    }
}

if($act == 'grabar') {
    $nombre = $_POST['txtNombre'];
    $di = explode('/', $_POST['txtFechaIni']);
    $fecha_ini = date('y-m-d', strtotime($di[2].'-'.$di[1].'-'.$di[0]));
    $df = explode('/', $_POST['txtFechaFin']);
    $fecha_fin = date('y-m-d', strtotime($df[2].'-'.$df[1].'-'.$df[0]));
    $estado = $_POST['rdEstado'];
    $enlace = $_POST['txtEnlace'];

    $data = Array(
        'NOMBRE' => $nombre,
        'FECHA_REG' => $db->now(),
        'FECHA_INI' => $fecha_ini,
        'FECHA_FIN' => $fecha_fin,
        'ACTIVO' => $estado,
        'LINK' => $enlace
    );

    $id = $db->insert ('promociones', $data);

    if($id) {
        $upload_image = Utils::uploadImage($_FILES['file'], 'promociones', $id);
        if($upload_image == '1') {
            header('location: ../../panel.php?do=promociones&status=success');
        } else {
            $db->where('ID', $id);
            $db->delete('promociones');
            header('location: ../../panel.php?do=promociones&status=error&msg=' . $upload_image);
        }
    } else {
        header('location: ../../panel.php?do=promociones&status=error&msg=' . $db->getLastError());
    }
}

if($act == 'actualizar') {
    $id = $_GET['pID'];
    $nombre = $_POST['txtNombre'];
    $di = explode('/', $_POST['txtFechaIni']);
    $fecha_ini = date('y-m-d', strtotime($di[2].'-'.$di[1].'-'.$di[0]));
    $df = explode('/', $_POST['txtFechaFin']);
    $fecha_fin = date('y-m-d', strtotime($df[2].'-'.$df[1].'-'.$df[0]));
    $estado = $_POST['rdEstado'];
    $enlace = $_POST['txtEnlace'];

    $data = Array(
        'NOMBRE' => $nombre,
        'FECHA_INI' => $fecha_ini,
        'FECHA_FIN' => $fecha_fin,
        'ACTIVO' => $estado,
        'LINK' => $enlace
    );

    $db->where ('ID', $id);
    if($db->update('promociones', $data)) {
        if(!empty($_FILES['file']['name'])) {
            $upload_image = Utils::uploadImage($_FILES['file'], 'promociones', $id);
        } else {
            $upload_image = '1';
        }
        if($upload_image == '1') {
            header('location: ../../panel.php?do=promociones&status=success');
        } else {
            header('location: ../../panel.php?do=promociones&status=error&msg=' . $upload_image);
        }
    } else {
        header('location: ../../panel.php?do=promociones&status=error&msg=' . $db->getLastError());
    }
}

if($act == 'eliminar') {
    $id = $_GET['pID'];
    $db->where ('ID', $id);
    if($db->delete('promociones', $data)) {
        Utils::removeImage('promociones', $id);
        echo '1';
    } else {
        echo $db->getLastError();
    }
}