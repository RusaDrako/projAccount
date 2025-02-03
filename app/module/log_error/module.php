<?php
namespace app\module\log_error;

class module extends \app_module {

	const SET_MODULE_NAME="log_error";

	public static function setErrLogSave($module_set){
//		# Загрузка модулей
//		$modules=require(\registry::call()->get('FOLDER_ROOT') . 'config/modules.php');
//		$module_set=$modules[$group_name];
//		/** @var app\module\module_app $module_class_name */
//		$module_class_name='app\module\log_error\module';
		# Настройки префикса
		static::setPrefixModule($module_set['prefix']?:'');
		//# Настройки корневого url
		//$module_class_name::setUrlPathRoot($group);
		# Установка базовых настроек модуля
		static::setConfig();
		# Обновление настроек модуля
//		$module_class_name::updateConfig($module_set['config']?:[]);
		# Подключение к БД для моделей
		static::setDB(\factory::getDB($module_set['db_name']));
		# Подключение настроек модуля
//		$module_class_name::setSetting($module_set['setting']);
	}


	public static function setConfig() {
		static::$name='log_error';
		static::$module_title='Лог ошибок';
		static::$config['model']=[
			'log_error'=>[],
		];
		static::$config['view']=[
			'main'=> __DIR__ . '/view/',
		];
	}
}