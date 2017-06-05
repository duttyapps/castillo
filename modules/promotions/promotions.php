<?php
$ulink = $Request->getParamater('promotions');

$Template->assign("title", "Promociones | ");

if(empty($ulink)) {
header('Location: ../index.php');
die();
}

$db->where ("LINK", $ulink);
$viewPromo = $db->getOne('promociones');

$Template->assign("title", $viewPromo['NOMBRE'] . " - Promociones | ");
$Template->assign("promociones", $viewPromo);

if(empty($viewPromo)) {
\Classes\Utils::save_log('Promoción ID: "' . $ulink . '" no existe.');
}