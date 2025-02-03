<?php
namespace app\model\account\account;

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
		$this->set_column_id('id_account');        # ID записи

		# Основные свойства объекта (соответствуют столбцам таблицы)
		$column = [
			'id_account'    => 'ID',            # ID записи
			'guid'          => 'GUID',          # Внешний идентификатор
			'title'         => 'TITLE',         # Заголовок
			'balance'       => 'BALANCE',       # Описание
			'is_blocked'    => 'IS_BLOCKED',    # Цвет
			'date_create'   => 'DATE_CREATE',   # Дата создания
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
			'GUID_VIEW'       => function() {return substr($this->GUID, 0, 8)
				. '-' . substr($this->GUID, 8, 4)
				. '-' . substr($this->GUID, 12, 4)
				. '-' . substr($this->GUID, 16, 4)
				. '-' . substr($this->GUID, 20, 12)
				;},
			'CAN_OPERATIONS'  => function() {return (bool) !$this->IS_BLOCKED;},
			'CAN_WRITE_OFF'  => function() {return (bool) !$this->IS_BLOCKED;},
			'CAN_RECEIPT'  => function() {return (bool) !$this->IS_BLOCKED;},
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


	/** Блокировка функции сохранения */
	public function get_data() {
		return [
			'GUID' => $this->GUID_VIEW,
			'TITLE' => $this->TITLE,
			'BALANCE' => $this->BALANCE,
			'IS_BLOCKED' => $this->IS_BLOCKED,
		];
	}

	/** Блокировка функции сохранения */
	public function update_balance() {
		$this->setProp("BALANCE", \factory::getModel('account\transaction')->getAccountBalance($this->ID));
	}

	/** Доступны операции */
	public function can_operations() {
		return (bool) !$this->IS_BLOCKED;
	}

	/** Доступны операции пополнения */
	public function CAN_RECEIPT($amount) {
		return $this->can_operations();
	}

	/** Доступны операции списания */
	public function CAN_WRITE_OFF($amount) {
		return (bool) $this->can_operations() && $this-> IS_BLOCKED;
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
