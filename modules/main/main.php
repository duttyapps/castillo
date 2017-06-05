<?php
//HOTELES
$db->where('ACTIVO', 1);
$db->orderBy('NOMBRE', 'ASC');
$hoteles = $db->get("hoteles");

$Template->assign("hoteles", $hoteles);

//PROMOCIONES
$db->where('ACTIVO', 1);
$db->orderBy('ID', 'DESC');
$promociones = $db->get("promociones");

$Template->assign("promociones", $promociones);

//NOTICIAS
$db->orderBy('ID', 'DESC');
$noticias = $db->get('noticias', 4);

$Template->assign("noticias", $noticias);

//PRODUCTOS
$db->where('RECOMENDADO', '1');
$db->orderBy('ID', 'DESC');
$productos = $db->get('productos', 6);

$Template->assign("productos", $productos);