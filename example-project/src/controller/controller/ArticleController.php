<?php

namespace Controller\Controller;

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
				$article = new ArticleModel();

				$article
					->set_column("article_title",$_POST["article_title"])
					->set_column("article_content",$_POST["article_content"]);

				// example of transation use (you can just use crete method in this type of situation)
				if(ArticleModel::begin_transation() )
				{
					if($article->create() && ArticleModel::commit_transaction() )
						$this->redirect($this->route("Article:show_article",["article_name" => $article->get_column("article_title")]) );

					ArticleModel::rollback_transaction();
				}

				$this->render("article/creation_page.twig",["error_message" => "echec de la création de l'article"]);
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

