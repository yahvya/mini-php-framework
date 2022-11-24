<?php session_start();

define('ROOT',__DIR__ . '/');

require_once(ROOT . 'vendor/autoload.php');

use \Sabo\Sabo\Router;

new Router(debug_mode: true);