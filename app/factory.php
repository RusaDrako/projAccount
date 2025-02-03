<?php
namespace app;
use RusaDrako\driver_db\db;

/** Фабрика объектов */
class factory {

	/** Массив созданных объектов */
	private static $obj_model=[];

	/** Вызов объекта БД */
	public static function getModel($alias, ...$arg){
		if (array_key_exists($alias, static::$obj_model)) { return static::$obj_model[$alias];}

		switch($alias){
			case 'account\account': #
			case 'account\transaction': #
			case 'account\log_request': #
				$class_data_name="\\app\\model\\{$alias}\\data";
				$class_item_name="\\app\\model\\{$alias}\\item";
				$class=new $class_data_name(static::getDB('db'), $class_item_name);
				break;

			# Ошибка
			default:
				throw new \Exception("Вызов неопределённой модели: ".\get_called_class()."->{$alias}");
				break;
		}
		static::$obj_model[$alias] = $class;
		return static::$obj_model[$alias];
	}



	/** @var string[] Сообветствие системного имени БД и ключа настроек */
	private static $db_set = [
		'db' => 'MAIN_DB',
	];

	/** @var array Объекты подключения к БД */
	private static $obj_db = [];

	/** Вызов объекта БД */
	public static function getDB($alias) {
		if (!array_key_exists($alias, static::$obj_db)) {
			if (!array_key_exists($alias, static::$db_set)) {
				throw new \Exception("Вызов неопределённого драйвера БД: " . \get_called_class() . "->{$alias}");
			}
			$db = new db();
			$key=static::$db_set[$alias];
			$set=[
				"DRIVER"         =>\registry::call()->get("{$key}_DRIVER"),
				"HOST"           =>\registry::call()->get("{$key}_HOST"),
				"PORT"           =>\registry::call()->get("{$key}_PORT"),
				"USER"           =>\registry::call()->get("{$key}_USER"),
				"PASS"           =>\registry::call()->get("{$key}_PASS"),
				"DBNAME"         =>\registry::call()->get("{$key}_DBNAME"),
				"ENCODING"       =>\registry::call()->get("{$key}_ENCODING"),
				"ENCODING_SYS"   =>\registry::call()->get("{$key}_ENCODING_SYS"),
				"ENCODING_DB"    =>\registry::call()->get("{$key}_ENCODING_DB"),
			];
			$db->setDB($key, $set);
			static::$obj_db[$alias] = $db->getDBConnect($key);
		}
		return static::$obj_db[$alias];
	}



	/** Вызов объектов * /
	public static function getObject($alias, ...$arg) {
		switch($alias){
			# Ошибка
			default:
				throw new \Exception("Вызов неопределённого объекта: ".\get_called_class()."->{$alias}");
				break;
		}
		return $class;
	}

/**/
}
