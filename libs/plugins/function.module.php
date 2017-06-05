<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.module.php
 * Type:     function
 * Name:     module
 * Purpose:  include php and tpl files from modules folder
 * -------------------------------------------------------------
 */
function smarty_function_module($params, &$smarty)
{
    global $Request, $db;

    if(empty($params['name'])) {
        $params['name'] = 'main';
    }

    $module_dir = "./modules/";
    $template_dir = "./templates/";
    $module_name = $params['name'];
    $module_php = $module_dir . $module_name . '/' . $module_name . '.php';
    $module_tpl = $template_dir . $module_name . '/' . $module_name . '.tpl';

    if(!file_exists($module_php)) {
        trigger_error("error: php module $module_php doesn't exists.");
        return;
    }

    if(!file_exists($module_tpl)) {
        trigger_error("error: tpl module $module_tpl doesn't exists.");
        return;
    }
    
    $tpl = $smarty->createTemplate($module_tpl);
    include($module_php);
    $output = $tpl->fetch();

    echo $output;
}