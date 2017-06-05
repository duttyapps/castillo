<?php
namespace Classes;

require 'classes/remote_ip.class.php';

use \Classes\RemoteAddress as cRemoteAddress;

class Utils {

	static function showError($msg) {
        return '<div class="alert alert-danger" role="alert"><b>Error!</b> ' . $msg . '</div>';
    }

    static function showSuccess($msg) {
        return '<div class="alert alert-success" role="alert"><b>Éxito!</b> ' . $msg . '</div>';
    }

    static function showInfo($msg) {
        return '<div class="alert alert-info" role="alert">' . $msg . '</div>';
    }

    static function getContextPath() {
        return (dirname($_SERVER['SCRIPT_NAME']) == '/') ? '' : dirname($_SERVER['SCRIPT_NAME']);
    }

    static function cleanModuleName($str) {
        return preg_replace('/[^a-zA-Z]+/', '', $str);
    }

    static function loadModuleJS($module) {
        if(file_exists('js/modules/' . $module . '/script.js')) {
            return self::createDOM('script', '', array(
                'src' => self::getContextPath() . '/js/modules/' . $module . '/script.js'
            ));
        } else {
            if(file_exists('js/modules/main/script.js')) {
                return self::createDOM('script', '', array(
                    'src' => self::getContextPath() . '/js/modules/main/script.js'
                ));
            } else {
                return '';
            }
        }
    }

    static function loadModuleCSS($module) {
        if(file_exists('css/modules/' . $module . '/style.css')) {
            return self::createDOM('link', null, array(
                'href' => self::getContextPath() . '/css/modules/' . $module . '/style.css',
                'rel' => 'stylesheet'
            ));
        } else {
            if(file_exists('css/modules/main/style.css')) {
                return self::createDOM('link', null, array(
                    'href' => self::getContextPath() . '/css/modules/main/style.css',
                    'rel' => 'stylesheet'
                ));
            } else {
                return '';
            }
        }
    }

    static function createDOM($tag, $val, $attr = array(), $end_slash = false) {
        $DOM = "<$tag";
        if(count($attr) > 0) {
            foreach ($attr as $item => $v) {
                $DOM .= ' ';
                if(!empty($item)) {
                    $DOM .= "$item=\"$v\"";
                } else {
                    $DOM .= "$v";
                }
            }
        }
        if(is_null($val)) {
            if($end_slash) {
                $DOM .= ' />';
            } else {
                $DOM .= '>';
            }
        } else if($val == '') {
            $DOM .= ">$val</$tag>";
        }

        return $DOM;
    }

    /**
     * Función para grabar log del sistema
     *
     * @param String  $str  Texto a grabar en la linea de mensaje
     * @param integer $type Tipo de mensaje (0 = INFO, 1 = ERROR)
     *
     * @author Carlos Arce <carlosarcesh@gmail.com>
     * @return void
     */
    static function save_log($str, $type = 0) {
        $dest = './logs/' . date('Ymd') . '_TiendaWeb.log';
        $rIP = new cRemoteAddress();
        $remote_ip = $rIP->getIpAddress();
        $type_msg = ($type == 0) ? 'INFO' : 'ERROR';
        $nstr = '[' . date("H:i:s") . '] [' . $remote_ip . '] [' . $type_msg . '] ' . $str . PHP_EOL;

        error_log($nstr, 3, $dest);
    }
}