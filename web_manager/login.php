<?php
date_default_timezone_set('America/Lima');

session_start();

include 'connection.php';
require '../classes/remote_ip.class.php';

use \Classes\RemoteAddress as cRemoteAddress;
$rIP = new cRemoteAddress();

$action = $_POST['action'];

if($action == 'login') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $db->where("USUARIO", $user);
    $db->where("PASSWORD", $pass);
    $response = $db->getOne("segt_administrator");

    if(count($response) > 0) {
        $data = Array(
            'ULT_CON' => $db->now(),
            'ULT_IP' => $rIP->getIpAddress()
        );
        $db->where('USUARIO', $user);

        $db->update('segt_administrator', $data);

        foreach ($response as $k => $v) {
            $_SESSION['ADM_' . $k] = $v;
        }

        header('location: panel.php');
    } else {
        unset($_SESSION['ADM_USUARIO']);
        header('location: index.php?1');
    }

} elseif ($action == 'logout') {
    unset($_SESSION['ADM_USUARIO']);
    header('location: index.php?2');
} elseif(!isset($_SESSION['ADM_USUARIO'])) {
    header('location: index.php?3');
}