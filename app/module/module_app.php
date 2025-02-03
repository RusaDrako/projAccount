<?php
namespace app\module;

class module_app {
	protected static $name='';
	protected static $module_title='';

	/** @var string Префикс имён в модуле, для создания параллельных структур */
	protected static $prefix='';

	/** Устанавливает префикс имён в модуле, для создания параллельных структур */
	public static function setPrefixModule(string $value=''){
		static::$prefix=$value;
	}

	/** Возвращает префикс имён в модуле, для создания параллельных структур */
	public static function getInternalName(string $value){
		return static::$prefix . $value;
	}

	/** @var string Корневая папка */
	protected static $url_path_root='';

	public static function setUrlPathRoot(string $value) {
		static::$url_path_root=$value;
	}

	protected static $config=[
		'cntr'=>[],
		'model'=>[],
		'view'=>[],
	];

	/** @var Подключение к БД */
	protected static $db;

	public static function setDB($db) {
		static::$db=$db;
	}


	/** */
	protected static $setting=[];

	public static function setSetting($setting) {
		foreach($setting?:[] as $k=>$v){
			static::$setting[$k]=$v;
		}
	}

	public static function getSetting($name, $default=null) {
		return array_key_exists($name, static::$setting) ? static::$setting[$name] : $default;
	}


	/** Массив созданных объектов */
	protected static $obj_model=[];

	/**  */
	public static function getModel($alias, ...$arg){
		if (array_key_exists($alias, static::$obj_model)) { return static::$obj_model[$alias];}

		if(!array_key_exists($alias, static::$config['model'])){
			throw new \Exception("Вызванная модель не определена: " . static::class . " - {$alias}");
		}

		$namespace=static::getModuleNamespace();

		$class_data_name = $namespace . "\\model\\{$alias}\\" . (static::$config['model']['data']?:'data');
		$class_item_name = $namespace . "\\model\\{$alias}\\" . (static::$config['model']['item']?:'item');

		$class=new $class_data_name(static::$db, $class_item_name);

		static::$obj_model[$alias] = $class;
		return static::$obj_model[$alias];
	}

	/** Массив созданных объектов */
	protected static $obj_cntr=[];

	/**  */
	public static function getController($alias, ...$arg){
		if (in_array($alias, static::$obj_cntr)) { return static::$obj_cntr[$alias];}

		if(!in_array($alias, static::$config['ctrl'])){
			throw new \Exception("Вызванная модель не определена: " . static::class . " - {$alias}");
		}

		$namespace=static::getModuleNamespace();

		$class_name = $namespace . "\\ctrl\\{$alias}";

		$class=new $class_name();

		static::$obj_model[$alias] = $class;
		return static::$obj_model[$alias];
	}

	/** Массив созданных объектов */
	protected static $router;

	/**  */
	public static function getRouter($router/*, $route='/'*/){
		static::$router=$router;
		$file_name = \registry::call()->get('FOLDER_ROOT') . "app/module/" . static::$name . "/router/router.php";
		# Если файл группы маршрутов существует
		if (file_exists($file_name)) {
			# Подгружаем маршруты
			require_once($file_name);
		}
	}

	/**  */
	public static function getModuleNamespace(){
		$namespace=explode('\\', static::class);
		array_pop($namespace);
		return implode('\\', $namespace);
	}

	/**  */
	public static function getModulePath(){
		$namespace=explode('\\', static::class);
		array_pop($namespace);
		return implode('\\', $namespace);
	}

	/**  */
	public static function updateConfigDB($config, $module_config){
		# Проходим по массиву модулей
		foreach($module_config as $k=>$v){
			$alias=$v['db_alias'] ?: 'main';
			if(!$config[$alias] ?: []){
				echo "Не найден алиас {$alias}<br>";
				continue;
			}
			$namespace_arr=explode('\\', $v['namespace']);
			$name=array_pop($namespace_arr);
			# Файл конфига БД
			$file=__DIR__ . "/{$name}/cnf_db.php";
			if(file_exists($file)){
				# Добавляем настройки
				$_config_arr=require($file);
				$config_arr=[];
				static::$prefix=$v['prefix'] ?: '';
				foreach($_config_arr as $k_2=>$v_2){
					$config_arr[static::getInternalName($k_2)]=$v_2;
				}
				$config[$alias]['tables']=array_merge($config[$alias]['tables']?:[], $config_arr);
			}
		}
		return $config;
	}

	/** Обновляем данные конфига */
	public static function updateConfig(array $value){
		foreach($value as $k=>$v){
			if(!array_key_exists($k, static::$config)){
				$module=static::class;
				throw new Exception_module_app("Раздел {$k} в настройках модуля {$module} отсутствует: Обновление не возможно");
			}
			# Разворачиваем массив настроек, что бы новые элементы попали в начало
			$arr=array_reverse(static::$config[$k], 1);
			foreach($v as $k_2=>$v_2){
				$arr[$k_2]=$v_2;
			}
			# Разворачиваем массив настроек назад
			static::$config[$k]=array_reverse($arr, 1);
		}
	}

	/** ссылки к view-папкаv модуля */
	public static function getViewFolders(){
		return static::$config['view']?:[];
	}

}



class Exception_module_app extends \Exception{}
