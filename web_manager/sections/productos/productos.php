<?php
date_default_timezone_set('America/Lima');
include '../../connection.php';

include '../../classes/utils.class.php';

use \AdminClasses\Utils as Utils;

$act = $_GET['action'];

if($act == 'getProductos') {
    header('Content-Type: application/json');
    $db->orderBy('ID');
    echo json_encode($db->get('productos'));
}

if($act == 'grabar') {
    session_start();
    $categoria = $_POST['cboCategoria'];
    $nombre = $_POST['txtNombre'];
    $descripcion = $_POST['txtDescripcion'];
    $precio = floatval($_POST['txtPrecio']);
    $usuario = $_SESSION['ADM_NOMBRES'];
    $enlace = $_POST['txtEnlace'];
    $stock = $_POST['txtStock'];
    $estado = $_POST['rdEstado'];

    $data = Array(
        'ID_CAT' => $categoria,
        'NOMBRE' => $nombre,
        'DESCRIPCION' => $descripcion,
        'PRECIO' => $precio,
        'FECHA_REG' => $db->now(),
        'ACTIVO' => $estado,
        'USUARIO' => $usuario,
        'LINK' => $enlace,
        'STOCK' => $stock
    );

    $id = $db->insert ('productos', $data);

    if($id) {
        $upload_image = Utils::uploadImage($_FILES['file'], 'products', $id);
        if($upload_image == '1') {
            header('location: ../../panel.php?do=productos&status=success');
        } else {
            $db->where('ID', $id);
            $db->delete('productos');
            header('location: ../../panel.php?do=productos&status=error&msg=' . $upload_image);
        }
    } else {
        header('location: ../../panel.php?do=productos&status=error&msg=' . $db->getLastError());
    }
}