<?php

require_once "{$_SERVER['DOCUMENT_ROOT']}/app/helpers.php";
$config = require_once "{$_SERVER['DOCUMENT_ROOT']}/config/config.php";
$routes = require_once ("{$_SERVER['DOCUMENT_ROOT']}/config/routes.php");

use app\facades\Config;
use app\kernel\App;

spl_autoload_register(function ($class){
    $filePath = str_replace('\\', '/', $class) . '.php';
    if(file_exists($filePath)) {
        require_once $filePath;
    }
});

Config::setConfig($config);

$app = new App($routes);
$app->handle();

