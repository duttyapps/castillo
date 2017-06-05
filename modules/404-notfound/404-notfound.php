<?php
http_response_code(404);
$Template->assign('title', 'Página no encontrada | ');
\Classes\Utils::save_log('[Error 404] Página "' . $_SERVER['PATH_INFO'] . '" no existe.');