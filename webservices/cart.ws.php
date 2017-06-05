<?php
include '../includes/db.connection.php';
include '../classes/remote_ip.class.php';

$Remote = new \Classes\RemoteAddress();

$act = $_POST['action'] ?: $_GET['action'];

$id_prod = $_POST['id_prod'];
$id_cat = $_POST['id_cat'];
$cant = $_POST['cant'];
$ip_client = $Remote->getIpAddress();

header('Content-Type: application/json');

$result = Array();

if($act == 'get') {
    $db->join('productos p', 'p.ID = c.ID_PROD AND p.ID_CAT = c.ID_CAT');
    $db->where ("IP_CLIENTE", $ip_client);
    $result = $db->get('carrito_compras c', null, 'p.ID, p.PRECIO, p.NOMBRE, p.DESCRIPCION_CORTA, c.CANTIDAD');
}

if($act == 'count') {
    $db->where ("IP_CLIENTE", $ip_client);
    $result['total'] = $db->getValue('carrito_compras', 'IFNULL(SUM(CANTIDAD),0)');
}

if($act == 'add') {
    //edit if exists
    $db->where('ID_PROD', $id_prod);
    $db->where('ID_CAT', $id_cat);
    $db->where('IP_CLIENTE', $ip_client);
    $exists = $db->getOne ("carrito_compras", "count(*) as cnt");

    if($exists['cnt'] == 0) {
        $data = Array (
            'ID_PROD' => $id_prod,
            'ID_CAT' => $id_cat,
            'CANTIDAD' => $cant,
            'IP_CLIENTE' => $ip_client
        );

        if($db->insert ('carrito_compras', $data)) {
            $result['code'] = '1';
            $result['msg'] = 'success';
        } else {
            $result['code'] = '0';
            $result['msg'] = 'Error: ' . $db->getLastError();
        }
    } else {
        $data = Array(
            'CANTIDAD' => $db->inc($cant)
        );
        $db->where('ID_PROD', $id_prod);
        $db->where('ID_CAT', $id_cat);
        $db->where('IP_CLIENTE', $ip_client);

        if($db->update ('carrito_compras', $data)) {
            $result['code'] = '1';
            $result['msg'] = 'success';
        } else {
            $result['code'] = '0';
            $result['msg'] = 'Error: ' . $db->getLastError();
        }
    }
}

if($act == 'del') {
    $id = $_GET['id'];
    $db->where('ID', $id);
    if($db->delete('carrito_compras')) {
        $result['code'] = '1';
        $result['msg'] = 'success';
    } else {
        $result['code'] = '0';
        $result['msg'] = 'Error: ' . $db->getLastError();
    }
}

echo json_encode($result);