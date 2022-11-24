<?php

use \Sabo\Sabo\Route;

// import controllers 

use \Controller\Controller\ArticleController;

/*
	get,post,put args format
		route -> "article/{article_id}/read" (article_id can be past to your controller if the method have an argument named article_id)
		l
		controller_class -> YourController::class
		method_name -> your_method_name
		route_name -> a name for the route (two routes can"t have the same name)

	each routes in a group start with the group routes
*/		

// put yours routes in this array

return Route::generate_from([
	Route::group("article",[
		Route::get("{article_id}/view",ArticleController::class,"show_article","an_article_page"),
		Route::get("{article_id}/edit",ArticleController::class,"show_article_edit","edit_article_page"),
	])
]);