<?php

namespace Model\Model;

use \PDO;
use \PDOException;
use \Exception;
use \ReflectionClass;
use \ReflectionAttribute;

use \Sabo\Sabo\Router;

use \Model\Attribute\TableColumn;

use \Model\Cond\ColumnCond;

// models are based on mysql
abstract class AbstractModel 
{
	private static PDO $shared_con;

	private static bool $debug_mode = false; 

	private array $properties_data;

	// called by router to init the shared con
	public static function init_con(bool $debug_mode):bool
	{
		self::$debug_mode = $debug_mode;

		$con = self::get_con();

		if($con != NULL)
		{
			self::$shared_con = $con;

			return true;
		}

		return false;
	}

	// return an connexion instance
	public static function get_con():?PDO
	{
		switch(CONFIG_FILE_TYPE)
		{
			case Router::CLASSIC_ENV:
				list("db_host" => $host,"db_name" => $name,"db_user" => $user,"db_password" => $password) = $_ENV;
			; break;

			case Router::JSON_ENV:
				list("host" => $host,"name" => $name,"user" => $user,"password" => $password) = $_ENV["database"];
			; break;

			default:
				if(self::$debug_mode)
					throw new Exception("Bad env format");
				else
					return NULL;
			;
		}

		try
		{
			$con = new PDO("mysql:host={$host};dbname={$name}",$user,$password,[
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8" 
			]);

			return $con;
		}
		catch(PDOException $e)
		{
			if(self::$debug_mode)
				throw $e;
		}

		return NULL;
	}

	// throw exception is model is badly formed
	public function __construct()
	{
		$this->properties_data = [];

		$reflection_class = new ReflectionClass($this);

		foreach($reflection_class->getProperties() as $reflection_property)
		{
			$property_name = $reflection_property->getName();

			$column_attribute = $reflection_property->getAttributes(TableColumn::class);

			$count = count($column_attribute);

			if($count > 1)
				throw new Exception("The model can't have multiple TableColumn attribute");

			if($count == 0)
				continue;

			$this->properties_data[$property_name] = $column_attribute[0]->newInstance()->get_all();

			$conds_attribute = $reflection_property->getAttributes(ColumnCond::class);

			$count = count($conds_attribute);

			if($count > 1)
				throw new Exception("The model can't have multiple ColumnCond attribute");

			$this->properties_data[$property_name]['cond'] =  $count == 0 ? NULL : $conds_attribute[0]->newInstance();
		}
	}
}