<?php

namespace Controller\Controller;

use \Model\Model\ArticleModel;

class ArticleController extends AbstractController
{
	public function show_article(mixed $article_name):void
	{
		$article_model = new ArticleModel();

		die();

		$this->render("article/article.twig",["article_name" => $article_name]);
	}
}

