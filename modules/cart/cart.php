<?php
$Template->assign("title", "Carrito de Compras | ");

$Remote = new \Classes\RemoteAddress();

function getDetallesProducto($id, $id_cat) {
    $db = MysqliDb::getInstance();
    $db->where ("ID", $id);
    $db->where ("ID_CAT", $id_cat);
    return $db->getOne('productos');
}

$db->join('productos p', 'p.ID = c.ID_PROD AND p.ID_CAT = c.ID_CAT');
$db->where ("IP_CLIENTE", $Remote->getIpAddress());
$viewProducts = $db->get('carrito_compras c', null, 'c.*, p.PRECIO, p.NOMBRE, p.LINK');

for($i=0;$i<count($viewProducts);$i++) {
    $total = $total + ($viewProducts[$i]['PRECIO']*$viewProducts[$i]['CANTIDAD']);
}

$Template->assign("prod", $viewProducts);
$Template->assign("total", $total);