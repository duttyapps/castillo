<?php
namespace AdminClasses;


class Utils
{
    static function uploadImage($file, $module, $id) {
        $validextensions = array("jpg");
        $temporary = explode(".", $file["name"]);
        $file_extension = strtolower(end($temporary));

        if ((($file["type"] == "image/jpg")
                || ($file["type"] == "image/jpeg"))
            && ($file["size"] < 500000)
            && in_array($file_extension, $validextensions)){

            if(move_uploaded_file($file["tmp_name"], "../../../images/$module/$id.$file_extension")) {
                return '1';
            } else {
                return 'Ocurrió un error al subir la imágen.<br>'. error_get_last()['message'];
            }
        } else {
            return 'Tipo de imágen o tamaño inválido. Tamaño máximo 500kb.';
        }
    }

    static function removeImage($module, $id) {
        unlink("../../../images/$module/$id.jpg");
    }
}