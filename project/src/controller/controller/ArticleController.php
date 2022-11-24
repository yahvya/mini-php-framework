<?php

namespace Controller\Controller;

class ArticleController extends AbstractController
{
	public function show_article(mixed $article_name):void
	{
		$this->render("article.twig",["article_name" => $article_name]);
	}
}

