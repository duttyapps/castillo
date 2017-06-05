<?php
include realpath(dirname(__FILE__)) .
    DIRECTORY_SEPARATOR .
    '..' .
    DIRECTORY_SEPARATOR .
    'utils' .
    DIRECTORY_SEPARATOR .
    'configuration.php';

include realpath(dirname(__FILE__)) .
    DIRECTORY_SEPARATOR .
    '..' .
    DIRECTORY_SEPARATOR .
    'classes' .
    DIRECTORY_SEPARATOR .
    'mysqli.class.php';

$db = new MysqliDb(DB_HOST, BD_USER, DB_PASS, DB_DATABASE);