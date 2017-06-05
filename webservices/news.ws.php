<?php
namespace WebServices;

use \Classes\Constants as cConstants;
use \Classes\cURL as ccURL;

class News
{
    public function getNews() {
        $cURL = new ccURL;
        $cURL->cURL();
        $data = $cURL->get(cConstants::URL_WS_NEWS);
        //Needs to be an array. This works fine in smarty
        $data = json_decode($data, true);

        return $data ['noticiasList'];
    }

    public function viewNews($ulink) {
        $cURL = new ccURL;
        $cURL->cURL();
        $data = $cURL->get(cConstants::URL_WS_VIEW_NEWS.$ulink);
        //Needs to be an array. This works fine in smarty
        $data = json_decode($data, true);

        return $data ['noticiasList'];
    }
}