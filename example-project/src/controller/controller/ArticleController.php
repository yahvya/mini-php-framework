<?php

namespace Controller\Controller;

use Middleware\Exception\MiddlewareException;
use Middleware\Middleware\ArticleMiddleware;
use \Model\Model\ArticleModel;

use \Model\Exception\ModelException;

use \PDOException;

class ArticleController extends AbstractController
{
	public function show_article(mixed $article_title):void
	{	
		try
		{
			$results = ArticleModel::find(["article_title" => $article_title],just_one: true,return_objects: false);

			if(!empty($results) )
				$view_data["article_data"] = $results[0];
			else 
				$view_data["error_message"] = "Article non trouvé";

			$this->render("article/article.twig",$view_data);
		}
		catch(PDOException){}
		catch(ModelException){}
	}

	public function create_article():void
	{
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			try
			{
				// exemple de remplacement d'un message par défaut
				$article_mdw = new ArticleMiddleware([
					MiddlewareException::MISSED_DATA => "Veuillez vérifier les données saisies ;)"
				]);	

				$article_mdw->create_article();
			}
			catch(MiddlewareException $e)
			{
				$this->set_flash_data("Article:creation_error",$e->is_displayable() ? $e->getMessage() : "Erreur veuillez retenter");
			}

			$this->redirect($this->route("Article:creation_page") );
		}
		else 
		{
			$this->render("article/creation_page.twig",[
				"error_message" => $this->get_flash_data("Article:creation_error"),
				"success_message" => $this->get_flash_data("Article:creation_success"),
			]);
		}
	}
}

