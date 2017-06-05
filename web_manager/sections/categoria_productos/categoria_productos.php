<?php
date_default_timezone_set('America/Lima');
include '../../connection.php';

$act = $_GET['action'];

if($act == 'getCategorias') {
    header('Content-Type: application/json');
    $db->orderBy('ID');
    echo json_encode($db->get('categoria_productos'));
}