<?php
date_default_timezone_set('America/Lima');

include 'includes/db.connection.php';
include 'libs/SmartyBC.class.php';
include 'classes/utils.class.php';
include 'classes/modules.class.php';

use Classes\WebRequest as cWebRequest;

//Server Request
$Request = new cWebRequest();
//Setting template
$Template = new SmartyBC();
$Template->assign("path", \Classes\Utils::getContextPath());
$module = $Request->getModuleName();
$Template->assign("module", $module);
$Template->assign("module_css", \Classes\Utils::loadModuleCSS($Request->getModuleName()));
$Template->assign("module_js", \Classes\Utils::loadModuleJS($Request->getModuleName()));
try {
    $tpl_tmp = './' . $module . '/' . $module . '.tpl';
    $mod_tmp = 'modules/' . $module . '/' . $module . '.php';

    if (!file_exists($mod_tmp) && !file_exists('./templates/' . $tpl_tmp)) {
        throw new Exception('404');
    }

    @include($mod_tmp);

    if(file_exists('./templates/' . $tpl_tmp)) {
        $Template->display($tpl_tmp);
    }
} catch (Exception $e) {
    @include('modules/404-notfound/404-notfound.php');
    $Template->display('./404-notfound/404-notfound.tpl');
    \Classes\Utils::save_log($e, 1);
}