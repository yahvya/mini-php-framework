<?php session_start();

define('ROOT',__DIR__ . '/');

require_once(ROOT . 'vendor/autoload.php');

$routes = require_once(ROOT . 'config/routes.php');