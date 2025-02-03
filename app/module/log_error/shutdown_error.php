<?php
namespace app\module\log_error;

class shutdown_error {

	protected static $is_send_always=false;
	protected static $is_test=true;
	protected static $folder_root="";
	protected static $module_set=[];
	protected static $request=null;
	protected static $telegram_bot=null;
	protected static $telegram_template=":err_title: :err_message:".PHP_EOL.PHP_EOL/*.":err_backtrace:".PHP_EOL.PHP_EOL*/.":err_request:";

	/**
	 * Регистрирует обработчик ошибки
	 * @param array $module_set
	 * @param bool $is_test
	 * @param false $is_send_always
	 */
	public static function reg_shutdown_error_function(array $module_set, $request, $folder_root, $is_test=true, $is_send_always=false){
		static::$module_set = $module_set;
		static::$request = $request;
		static::$folder_root = $folder_root;
		static::$is_send_always = $is_send_always;
		static::$is_test = $is_test;
		\register_shutdown_function('\app\module\log_error\shutdown_error::shutdown_error');
	}

	/**
	 * Объект подключения к ТГ
	 * @param $telegram_bot
	 */
	public static function set_telegram_bot($telegram_bot){
		static::$telegram_bot = $telegram_bot;
	}

	/**
	 * Возвращает шаблон сообщения для ТГ
	 */
	public static function get_telegram_template(){
		return static::$telegram_template;
	}

	/**
	 * Устанавливает шаблон сообщения для ТГ
	 * @param string $telegram_template
	 */
	public static function set_telegram_template(string $telegram_template){
		static::$telegram_template = $telegram_template;
	}

	/** Обработки ошибок */
	public static function shutdown_error() {
		$error = error_get_last();
		if (!isset($error['type']))          { return; }
		if (in_array($error['type'], [8]))   { return; }
		$request = static::$request ? static::$request->get_list() : [];
		try {
			$log_error_item = static::save_error($request, $error);
		} catch(\Exception $e) {
			echo 'Не удалось записать информацию об ошибке. Причина:';
			echo '<br>';
			var_dump($e);
		}

		static::msg_to_telegram($request, "{$log_error_item->ID}: {$error['file']} ({$error['line']}) \n\n {$error['message']}");
	}

	/** Сохранение данных */
	protected static function save_error(array $request, $error){
		# Настройка модуля ошибок
		\app\module\log_error\module::setErrLogSave(static::$module_set);
		# Сохранение информации об ошибке
		$log_error_item=\app\module\log_error\cntr\cntr::saveError($request, $error['type'], $error['message'], $error['file'], $error['line']);
		return $log_error_item;
	}

	/** Отправляет сообщения об ошибке в телеграм
	 * @param string $msg Сообщение
	 * @param string $title Заголовок
	 * @param bool $send_all Маркер принудительной отправки
	 */
	protected static function msg_to_telegram(array $request, $msg, $title = 'Ошибка'){
		if (!static::$telegram_bot) {return;}
		# Неотправлять сообщения если это тестовый режим и нет отметки о принудительной отправке
		if (!static::$is_send_always && static::$is_test) {return;}
//		$str_backtrace = static::error_backtrace_data(3);
		# Проверяем существование библиотеки
		try{
			# Составляем сообщение
			$str_msg=static::$telegram_template;
			$str_msg=str_replace(":err_message:", $msg, $str_msg);
			$str_msg=str_replace(":err_title:", $title, $str_msg);
//			$str_msg=str_replace(":err_backtrace:", $str_backtrace, $str_msg);
			$str_msg=str_replace(":err_request:", \json_encode($request), $str_msg);

			# отправляем сообщение
			if (static::$is_test) {
				echo '<hr>';
				echo '<pre>';
				echo $str_msg;
				echo '</pre>';
				echo '<hr>';
			} else {
				static::$telegram_bot->send(\registry::call()->get('TELEGRAM_SYSTEM_TO_ERROR'), $str_msg);
			}
		}catch(\Exception $e){
			echo PHP_EOL;
			echo PHP_EOL;
			echo 'Упс! Всё! Сообщение не отправлено (((';
		}
	}


	///**
	// * Формирует отчёт для телеграмма
	// * @param int $start_level
	// * @return string
	// */
	//protected static function error_backtrace_data(int $start_level=0) {
	//	$backtrace = \debug_backtrace();
	//	$len_folder = \strlen(static::$folder_root);
	//	for($i=0; $i<$start_level; $i++){
	//		\array_shift($backtrace);
	//	}
	//	$arr_backtrace = [];
	//	foreach($backtrace as $k => $v) {
	//		$arr_backtrace[] = [
	//			'file' => isset($v['file']) ? substr($v['file'], $len_folder) : '',
	//			'line' => $v['line'] ?: '',
	//			'class' => $v['class'] ?: '',
	//			'function' => $v['function'] ?: '',
	//		];
	//	}
	//	array_reverse($arr_backtrace);
	//	$_arr_backtrace = [];
	//	foreach($arr_backtrace as $k => $v) {
	//		$_arr_backtrace[] = "{$v['file']} ({$v['line']})\n{$v['class']} -> {$v['function']}";
	//	}
	//	return implode("\n\n", $_arr_backtrace);
	//}

}
