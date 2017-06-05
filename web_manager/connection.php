<?php
$file_conf = '..' .
    DIRECTORY_SEPARATOR .
    'utils' .
    DIRECTORY_SEPARATOR .
    'configuration.php';
$file_mysqli = '..' .
    DIRECTORY_SEPARATOR .
    'classes' .
    DIRECTORY_SEPARATOR .
    'mysqli.class.php';

if(file_exists($file_conf)) {
    include $file_conf; include $file_mysqli;
} else {
    include '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $file_conf;
    include '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $file_mysqli;
}

$db = new MysqliDb(DB_HOST, BD_USER, DB_PASS, DB_DATABASE);