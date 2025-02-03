<?php
namespace app\module\log_error\model\log_error;

//use Elbrus\Framework\registry\registry;

/**
 */
class item extends \RD_Obj_Item {



	/* * Подготовка данных к var_dump() и серилизации JSON (JsonSerializable) * /
	protected function __preparationData($arr) {
		$arr = parent::__preparationData($arr);
		return $arr;
	}



	/** Настройки объекта */
	protected function setting() {

		# Ключевое поле объекта
		$this->set_column_id('id_log_error');        # ID записи

		# Основные свойства объекта (соответствуют столбцам таблицы)
		$column = [
			'id_log_error'          => 'ID',          # ID записи
//			'user_id'               => 'USER_ID',     # ID пользователя
			'log_error_type'        => 'TYPE',        # Тип ошибки
			'log_error_message'     => 'MESSAGE',     # Сообщение об ошибках
			'log_error_file'        => 'FILE',        # Файл
			'log_error_line'        => 'LINE',        # Номер строки
			'log_error_request'     => 'REQUEST',     # Входящие данные
//			'log_error_backtrace'   => 'BACKTRACE',   # Бэктрайс
			'log_error_create'      => 'CREATED',     # Дата создания
		];
		foreach ($column as $k => $v) {
			$this->set_column_name($k, $v);
		}

/*		# Дополнительные свойства объекта
		$column = [
			'COLUMN_NAME',
		];
		foreach ($column as $k => $v) {
			$this->set_add_data($v, $v);
		}/**/

		# Генерируемые свойства объекта
		$function = [
			'TITLE'        => function() {return $this->FILE_SHORT . " ({$this->LINE})";},
			'FILE_SHORT'   => function() {return substr($this->FILE, strlen(\registry::call()->get('FOLDER_ROOT')));},
		];
		foreach ($function as $k => $v) {
			$this->set_gen_data($k, $v);
		}/**/

/*		# Дополнительные объекты работы с данными
		$object = [
			'COLUMN_NAME'     => new \object\_common\contact\phone(),
		];
		foreach ($object as $k => $v) {
			$this->set_sub_obj($k, $v);
		}/**/
	}

/**/
}
