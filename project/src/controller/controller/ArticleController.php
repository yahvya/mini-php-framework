<?php

namespace Controller\Controller;

class ArticleController extends AbstractController
{
	public function show_article(int $article_id):void
	{
		echo "affichage article $article_id";
	}	

	public function show_article_edit($article_id):void
	{
		echo "page edit $article_id";
	}
}

