<?php
namespace Classes;

use \Classes\Utils as cUtils;

class WebRequest
{
    private $module_name;

    function __construct()
    {
        $this->module_name = cUtils::cleanModuleName(explode("/", $_SERVER['PATH_INFO'])[1]);
    }

    function getModuleName() {
        if($this->module_name != "") {
            $module_file_php = 'modules/' . $this->module_name . '/' . $this->module_name . '.php';
            if (file_exists($module_file_php)) {
                return $this->module_name;
            } else {
                /*cUtils::showError("El módulo {$this->module_name} no existe.");
                cUtils::save_log("El módulo {$this->module_name} no existe.", 1);*/
                return;
            }
        } else return 'main';
    }

    /**
     * Función para obtener valor post ó get de envío
     *
     * @param String  $param Parámetro get ó post
     * @param integer $post  Opcional. Forzar tipo post (0 = GET OR POST, 1 = POST)
     *
     * @author Carlos Arce <carlosarcesh@gmail.com>
     * @return Valor
     */
    function getParamater($param, $post = 0) {
        if($post == 0) {
            if(empty($_POST[$param])) {
                $strTmp = explode($param . '/', $_SERVER['PATH_INFO'])[1];
                $strTmp = explode("/", $strTmp)[0];
            } else {
                $strTmp = $_POST[$param];
            }
        } else {
            $strTmp = $_POST[$param];
        }

        return $strTmp;
    }
}