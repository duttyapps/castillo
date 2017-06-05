<?php

$action = $Request->getParamater('action');
$view = $Request->getParamater('view');
$cat = $Request->getParamater('category');
$subcat = $Request->getParamater('subcategory');
$page = $_GET['page'] ?: 1;
$filter = $_GET['filter'] ?: 0;

$pageLimit = 16;

function getCategorias() {
    $db = MysqliDb::getInstance();
    $db->orderBy('NOMBRE', 'ASC');
    $db->where('ACTIVO', '1');
    return $db->get('categoria_productos');
}

function getProductos($cat = '', $subcat = '', &$total_pages = null) {
    global $page, $pageLimit, $filter;
    $db = MysqliDb::getInstance();
    if($cat) {
        $db->where('LINK', $cat);
        $cat_res = $db->getOne('categoria_productos');
        $cat_id = $cat_res['ID'];
        $db->where('ID_CAT', $cat_id);
    }
    if($subcat) {
        $db->where('ID_SUBCAT', $subcat);
    }

    $db->pageLimit = $pageLimit;
    //filters
    // 0: ID, 1: HIGH PRICE, 2: LOW PRICE
    if($filter == 0) {
        $db->orderBy('ID', 'DESC');
    } elseif ($filter == 1) {
        $db->orderBy('PRECIO', 'DESC');
    } elseif ($filter == 2) {
        $db->orderBy('PRECIO', 'ASC');
    } else {
        $db->orderBy('ID', 'DESC');
    }

    $prod = $db->arraybuilder()->paginate('productos', $page);
    $total_pages = $db->totalPages;
    return $prod;
}

function countProductos($cat = '', $subcat = '') {
    $db = MysqliDb::getInstance();
    if($cat) {
        $db->where('LINK', $cat);
        $cat_res = $db->getOne('categoria_productos');
        $cat_id = $cat_res['ID'];
        $db->where('ID_CAT', $cat_id);
    }
    if($subcat) {
        $db->where('ID_SUBCAT', $subcat);
    }

    $db->get('productos');
    return $db->count;
}

function getProducto($view) {
    $db = MysqliDb::getInstance();
    $db->where('LINK', $view);
    $db->orderBy('ID', 'DESC');
    return $db->get('productos')[0];
}

function getCategoriaNombre($id, $idn = '') {
    $db = MysqliDb::getInstance();
    if(empty($idn)) {
        $db->where('LINK', $id);
    } else {
        $db->where('ID', $idn);
    }
    $db->orderBy('ID', 'DESC');
    return $db->getValue('categoria_productos', 'NOMBRE');
}

function getSubCategoriaNombre($id) {
    $db = MysqliDb::getInstance();
    $db->where('ID', $id);
    $db->orderBy('ID', 'DESC');
    return $db->getValue('subcategoria_productos', 'NOMBRE');
}

$Template->assign("categorias", getCategorias());
$Template->assign("action", $action);

if(empty($action)) {
    $Template->assign("title", "Tienda Online | ");
    if ($cat) {
        $total_pages = 0;
        $total_prod = countProductos($cat, $subcat);
        $Template->assign("productos", getProductos($cat, $subcat, $total_pages));
        $Template->assign("categoria", getCategoriaNombre($cat));
        $Template->assign("subcategoria", getSubCategoriaNombre($subcat));
        $Template->assign("total_pages", $total_pages);
        $Template->assign("page", $page);
        $Template->assign("page_limit", $pageLimit);
        $Template->assign("total_prod", $total_prod);
        $Template->assign("title", getCategoriaNombre($cat) . " - Tienda Online | ");
    } else {
        $total_pages = 0;
        $total_prod = countProductos($cat, $subcat);
        $Template->assign("productos", getProductos('', '', $total_pages));
        $Template->assign("total_pages", $total_pages);
        $Template->assign("page", $page);
        $Template->assign("page_limit", $pageLimit);
        $Template->assign("total_prod", $total_prod);
    }
}

if($action == 'view') {
    $prod = getProducto($view);
    $Template->assign("title", $prod['NOMBRE'] . " en " . getCategoriaNombre('', $prod['ID_CAT']) . " - Tienda Online | ");
    $Template->assign("categoria", getCategoriaNombre('', $prod['ID_CAT']));
    $db->where('ID', $prod['ID_CAT']);
    $cat_link = $db->getValue('categoria_productos', 'LINK');
    $Template->assign("cat_link", $cat_link);
    $Template->assign("producto", $prod);
}