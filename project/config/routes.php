<?php

use \Sabo\Sabo\Route;

use \Controller\Controller\HomeController;

/*
	get,post,put args format
		route -> 'article/{article_id}/read' (article_id can be past to your controller if the method have an argument named article_id)
		l
		controller_class -> YourController::class
		method_name -> your_method_name
		route_name -> a name for the route (two routes can't have the same name)

	each routes in a group start with the group routes
*/		

// put yours routes in this array
	
return Route::generate_from([
	Route::get('/',HomeController::class,'show_home_page','home_page')
]);