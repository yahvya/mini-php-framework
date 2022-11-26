<?php

namespace Model\Model;

use \Model\Attribute\TableName;
use \Model\Attribute\TableColumn;

use \Model\Cond\ColumnCond;
use \Model\Cond\RegexCond;

#[TableName("article")]
class ArticleModel extends AbstractModel
{
	#[TableColumn("id","int",TableColumn::PRIMARY_KEY,TableColumn::AUTO_INCREMENT)]
	protected int $id;

	#[
		TableColumn("article_title","varchar:255",TableColumn::TO_ERASE_IN_SERIALIZE),
		ColumnCond(new RegexCond("^.{5,40}$","Veuillez vérifier la longueur du titre") )
	]
	protected string $article_title;

	#[
		TableColumn("article_content","text"),
		ColumnCond(new RegexCond("^.{10,}$","Le contenu de l'article doit contenir au moins 10 caractères") )
	]
	protected string $article_content;

	protected static function get_object_from_row(array $row):self
	{
		$article_model = new ArticleModel();

		$article_model->id = $row["id"];
		$article_model->article_title = $row["article_title"];
		$article_model->article_content = $row["article_content"];

		return $article_model;
	}
}

