<?php
namespace WebServices;

include 'classes/curl.class.php';
include 'classes/constants.class.php';

use \Classes\Constants as cConstants;
use \Classes\cURL as ccURL;

class Configuration
{
    public function getConfiguration() {
        $cURL = new ccURL;
        $cURL->cURL();
        $data = $cURL->get(cConstants::URL_WS_CONFIGURATION);
        $data = json_decode($data);

        return $data->configuracion;
    }
}