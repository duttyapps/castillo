<?php
$ulink = $Request->getParamater('services');

$Template->assign("title", "Servicios | ");

if(empty($ulink)) {
    header('Location: ../index.php');
    die();
}

$db->where ("LINK", $ulink);
$viewService = $db->getOne('servicios');

$Template->assign("title", $viewService['TITULO'] . " - Servicios | ");
$Template->assign("servicios", $viewService);

if(count($viewService) == 0) {
    \Classes\Utils::save_log('Servicio ID: "' . $ulink . '" no existe.');
}