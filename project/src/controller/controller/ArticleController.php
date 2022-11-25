<?php

namespace Controller\Controller;

use \Model\Model\ArticleModel;
use \Model\Exception\ModelException;

class ArticleController extends AbstractController
{
	public function show_article(mixed $article_name):void
	{	
		
	}

	public function create_article():void
	{
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			try
			{
				$article = new ArticleModel();

				$article
					->set_column("article_title",$_POST["article_title"])
					->set_column("article_content",$_POST["article_content"]);

				$this->redirect($this->route("Article:show_article",["article_name" => "presentation-du-mini-framework"]) );
			}
			catch(ModelException $e)
			{
				if($e->is_displayable() )
					$this->render("article/creation_page.twig",["error_message" => $e->getMessage()]);
				else
					die("check your code");
			}
		}
		else $this->render("article/creation_page.twig");
	}
}

