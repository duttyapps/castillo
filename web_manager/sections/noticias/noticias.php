<?php
date_default_timezone_set('America/Lima');
include '../../connection.php';

include '../../classes/utils.class.php';

use \AdminClasses\Utils as Utils;

$act = $_GET['action'];

if($act == 'getNoticias') {
    header('Content-Type: application/json');
    $db->orderBy('ID');
    echo json_encode($db->get('noticias N',null, "N.*, DATE_FORMAT(FECHA_REG, '%d/%m/%Y') AS FECHA_REG"));
}

if($act == 'getNoticia') {
    $id = $_GET['nID'];
    header('Content-Type: application/json');
    $db->where('ID', $id);
    echo json_encode($db->getOne('noticias N', "N.*, DATE_FORMAT(FECHA_REG, '%d/%m/%Y') AS FECHA_REG"));
}

if($act == 'grabar') {
    session_start();
    $titulo = $_POST['txtTitulo'];
    $contenido = $_POST['txtContenido'];
    $usuario = $_SESSION['ADM_NOMBRES'];
    $enlace = $_POST['txtEnlace'];

    $data = Array(
        'TITULO' => $titulo,
        'CONTENIDO' => $contenido,
        'FECHA_REG' => $db->now(),
        'USUARIO' => $usuario,
        'LINK' => $enlace
    );

    $id = $db->insert ('noticias', $data);

    if($id) {
        $upload_image = Utils::uploadImage($_FILES['file'], 'noticias', $id);
        if($upload_image == '1') {
            header('location: ../../panel.php?do=noticias&status=success');
        } else {
            $db->where('ID', $id);
            $db->delete('noticias');
            header('location: ../../panel.php?do=noticias&status=error&msg=' . $upload_image);
        }
    } else {
        header('location: ../../panel.php?do=noticias&status=error&msg=' . $db->getLastError());
    }
}

if($act == 'actualizar') {
    session_start();
    $id = $_GET['nID'];
    $titulo = $_POST['txtTitulo'];
    $contenido = $_POST['txtContenido'];
    $usuario = $_SESSION['ADM_NOMBRES'];
    $enlace = $_POST['txtEnlace'];

    $data = Array(
        'TITULO' => $titulo,
        'CONTENIDO' => $contenido,
        'USUARIO' => $usuario,
        'LINK' => $enlace
    );

    $db->where ('ID', $id);
    if($db->update('noticias', $data)) {
        if(!empty($_FILES['file']['name'])) {
            $upload_image = Utils::uploadImage($_FILES['file'], 'noticias', $id);
        } else {
            $upload_image = '1';
        }
        if($upload_image == '1') {
            header('location: ../../panel.php?do=noticias&status=success');
        } else {
            header('location: ../../panel.php?do=noticias&status=error&msg=' . $upload_image);
        }
    } else {
        header('location: ../../panel.php?do=noticias&status=error&msg=' . $db->getLastError());
    }
}

if($act == 'eliminar') {
    $id = $_GET['nID'];
    $db->where ('ID', $id);
    if($db->delete('noticias', $data)) {
        Utils::removeImage('noticias', $id);
        echo '1';
    } else {
        echo $db->getLastError();
    }
}