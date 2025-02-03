<?php

namespace config\shutdown;

/** Функция со статистикой */
function shutdown_error() {
	$error = error_get_last();
	if (!isset($error['type']))          { return; }
	if (in_array($error['type'], [8]))   { return; }
	try {
		$log_error_item = \factory::getModel('log_error')->newItem();
//		$log_error_item->setProp('USER_ID',   class_exists('User', false) ? \User::call()->ID : null);
		$log_error_item->setProp('TYPE',      $error['type']);
		$log_error_item->setProp('MESSAGE',   $error['message']);
		$log_error_item->setProp('FILE',      $error['file']);
		$log_error_item->setProp('LINE',      $error['line']);
		$log_error_item->setProp('REQUEST',   json_encode(\request::call()->get_list()));
		$log_error_item->save();
	} catch(\Exception $e) {
		echo 'Не удалось записать информацию об ошибке. Причина:';
		echo '<br>';
		var_dump($e);
	}
	error_msg_to_telegram("{$log_error_item->ID}: {$error['file']} ({$error['line']}) \n\n {$error['message']}");
}



/** Функция отправки сообщения об ошибке в телеграм
* @param string $msg Сообщение
* @param string $title Заголовок
* @param bool $send_all Маркер принудительной отправки
*/
function error_msg_to_telegram($msg, $title = 'Ошибка', $send_all = true) {
	$arr_backtrace = error_backtrace_data(2);
	# Неотправлять сообщения если это тестовый режим и нет отметки о принудительной отправке
	if (!$send_all && \registry::call()->get('test')) {return;}
	# Проверяем существование библиотеки
	try{
		if (!\class_exists('RusaDrako\telegram_notification\Bot')) { return;}
		$bot = new \RusaDrako\telegram_notification\Bot(\registry::call()->get('TELEGRAM_SYSTEM_TOKEN'));
		# Составляем сообщение
		$host = \registry::call()->get('SITE_HOST');
		$time = \registry::call()->get('TS_NOW_DT');
		$icon = \registry::call()->get('TELEGRAM_SYSTEM_TO_ERROR_ICON');
		$str_msg = "{$icon} {$time}: {$host} => {$title}: {$msg}"
			. PHP_EOL . PHP_EOL . $arr_backtrace
			. PHP_EOL . PHP_EOL . \json_encode(\request::call()->get_list());

		# отправляем сообщение
		if (\registry::call()->get('test')) {
			echo '<hr>';
			echo $str_msg;
			echo '<hr>';
		} else {
			$bot->send(\registry::call()->get('TELEGRAM_SYSTEM_TO_ERROR'), $str_msg);
		}
	}catch(\Exception $e){
		echo PHP_EOL;
		echo PHP_EOL;
		echo 'Упс! Всё! Сообщение не отправлено (((';
	}
}



/**
 * @param int $start_level
 * @return string
 */
function error_backtrace_data(int $start_level=0) {
	$backtrace = \debug_backtrace();
	$len_folder = \strlen(\registry::call()->get('FOLDER_ROOT'));
	for($i=0; $i<$start_level; $i++){
		\array_shift($backtrace);
	}
	$arr_backtrace = [];
	foreach($backtrace as $k => $v) {
		$arr_backtrace[] = [
			'file' => isset($v['file']) ? substr($v['file'], $len_folder) : '',
			'line' => $v['line'] ?: '',
			'class' => $v['class'] ?: '',
			'function' => $v['function'] ?: '',
		];
	}
	array_reverse($arr_backtrace);
	$_arr_backtrace = [];
	foreach($arr_backtrace as $k => $v) {
		$_arr_backtrace[] = "{$v['file']} ({$v['line']})\n{$v['class']} -> {$v['function']}";
	}
	return implode("\n\n", $_arr_backtrace);
}
