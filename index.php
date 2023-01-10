<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_cache_expire(30);
    session_start();
}

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set("America/Sao_Paulo");

ini_set('display_errors', 0);
define('DS', DIRECTORY_SEPARATOR);

use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
$app = AppFactory::create();

require_once("routes/route.php");

$app->run();