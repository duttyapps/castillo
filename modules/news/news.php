<?php

$ulink = $Request->getParamater('view');

$Template->assign("title", "Noticias | ");

if(empty($ulink)) {
    //Lista de noticias
    $page = (!empty($Request->getParamater('page'))) ? $Request->getParamater('page') : '1';
    $db->pageLimit = 5;
    
    $News = $db->arraybuilder()->paginate("noticias", $page, array(
        'TITULO AS titulo',
        'CONTENIDO AS contenido',
        'FECHA_REG AS fecha',
        'USUARIO AS usuario',
        'LINK AS ulink'
    ));

    $Template->assign("noticias", $News);
    $Template->assign("tamano_col", 12);
    $Template->assign("tamano_contenido", 250);
    $Template->assign("delimitador", "...");
    $Template->assign("truncar", false);
    $Template->assign("curr_pagina", $page);
    $Template->assign("paginas", $db->totalPages);
} else {
    //Ver noticia
    $db->where ("LINK", $ulink);
    $viewNews = $db->get('noticias', 1, array(
        'TITULO AS titulo',
        'CONTENIDO AS contenido',
        'FECHA_REG AS fecha',
        'USUARIO AS usuario',
        'LINK AS ulink'
    ));

    $Template->assign("title", $viewNews[0]['titulo'] . " - Noticias | ");
    $Template->assign("noticias", $viewNews);
    $Template->assign("ver", true);
    $Template->assign("tamano_col", 12);

    if(empty($viewNews)) {
        \Classes\Utils::save_log('Noticia ID: "' . $ulink . '" no existe.');
    }
}