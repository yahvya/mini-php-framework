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
	private int $id;

	#[
		TableColumn("article_name","varchar:255"),
		ColumnCond(new RegexCond("^[a-z0-9\-]{5,}$","le nom de l'article est incorrect","i") )
	]
	private string $article_name;
}

