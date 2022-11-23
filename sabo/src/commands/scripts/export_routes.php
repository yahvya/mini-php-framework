<?php

assert($argc >= 2,'Veuillez saisir le chemin de racine du projet');

$projet_root_path = $argv[1];

require_once($projet_root_path . 'vendor/autoload.php');

echo "{$projet_root_path}/export_routes.json";

if(file_exists("{$projet_root_path}config/routes.php") )
	@file_put_contents($argc >= 3 ? $argv[2] : "{$projet_root_path}/export_routes.json",json_encode(require_once("{$projet_root_path}config/routes.php"),JSON_PRETTY_PRINT) );