<?php
$ulink = $Request->getParamater('pages');

$Template->assign("title", "Páginas | ");

if(empty($ulink)) {
    header('Location: ../index.php');
    die();
}

//Ver noticia
$db->where ("LINK", $ulink);
$viewPage = $db->getOne('paginas');

$Template->assign("pagina", $viewPage);

if(empty($viewPage)) {
    \Classes\Utils::save_log('Página ID: "' . $ulink . '" no existe.');
}