<?php
namespace app\model\account\log_request;

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
		$this->set_column_id('id_log_request');        # ID записи

		# Основные свойства объекта (соответствуют столбцам таблицы)
		$column = [
			'id_log_request'   => 'ID',            # ID записи
			'request'          => 'REQUEST',       # Запрос
			'response'         => 'RESPONSE',      # Ответ
			'type'             => 'TYPE',          # Тип: OK / Error
			'date_create'      => 'DATE_CREATE',   # Дата создания
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

/*		# Генерируемые свойства объекта
		$function = [
			'COLOR_CSS'    => function() {return $this->COLOR?"#{$this->COLOR}":"#fff";},
			'TITLE_TEXT'   => function() {return $this->TITLE?:"Не задана";},
			'TITLE_HTML'   => function() {return "<span style=\"background-color: {$this->COLOR_CSS}; padding: 0 5px;\">{$this->TITLE_TEXT}</span>";},

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


	///** Блокировка функции сохранения */
	//public function save() {
	//	if (!$this->key) {
	//		$this->setProp('DATE_CREATE', $this->now());
	//	}
	//	parent::save();
	//}
	//
	///**  */
	//public function now(){
	//	return date('Y-m-d H:i:s');
	//}

/**/
}
