<?php session_start();

define('ROOT',__DIR__ . '/');

require_once(ROOT . 'vendor/autoload.php');

# test
use \Model\Model\ArticleModel;
use \Model\Cond\ColumnCond;


$reflection_class = new ReflectionClass(ArticleModel::class);

$column_instance = $reflection_class->getProperty("article_name")->getAttributes(ColumnCond::class)[0]->newInstance();

$column_instance->is_valid("nom-article ");
var_dump($column_instance->get_error_message() );
die();
# fin test

use \Sabo\Sabo\Router;

new Router(debug_mode: true);