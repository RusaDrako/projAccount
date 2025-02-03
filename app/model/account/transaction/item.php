<?php
namespace app\model\account\transaction;

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
		$this->set_column_id('id_transaction');        # ID записи

		# Основные свойства объекта (соответствуют столбцам таблицы)
		$column = [
			'id_transaction'     => 'ID',                 # ID записи
			'guid'               => 'GUID',               # Внешний идентификатор
			'account_id'         => 'ACCOUNT_ID',         # Кошелёк
			'is_receipt'         => 'IS_RECEIPT',         # 1 – поступление / 0 - списание
			'amount'             => 'AMOUNT',             # Сумма
			'description'        => 'DESCRIPTION',        # Описание
			'date_create'        => 'DATE_CREATE',        # Дата создания
			'create_type'        => 'CREATE_TYPE',        # Тип записи: создана по запросу API / создана вручную
			'create_initiator'   => 'CREATE_INITIATOR',   # Имя инициатора: имя сервиса / имя администратора
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
			'ACCOUNT_OBJ'     => function() {return \factory::getModel('account\account')->getByKey($this->ACCOUNT_ID);},
			'AMOUNT_VIEW'     => function() {return $this->IS_RECEIPT ? $this->AMOUNT: -$this->AMOUNT;},
			'GUID_VIEW'       => function() {return substr($this->GUID, 0, 8)
				. '-' . substr($this->GUID, 8, 4)
				. '-' . substr($this->GUID, 12, 4)
				. '-' . substr($this->GUID, 16, 4)
				. '-' . substr($this->GUID, 20, 12)
				;},
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
			'ACCOUNT_GUID' => $this->ACCOUNT_OBJ ? $this->ACCOUNT_OBJ->GUID : 'Не указано',
			'AMOUNT' => $this->AMOUNT_VIEW,
			'DESCRIPTION' => $this->DESCRIPTION,
			'DATE_CREATE' => $this->DATE_CREATE,
		];
	}

	///** Копирование элемента */
	//public function get_copy() {
	//	$item=new static();
	//	$arr=[
	//		'TRANSACTION_CATEGORY_ID',
	//		'DESCRIPTION',
	//		'AMOUNT',
	//		'IS_INCOME',
	//	];
	//	foreach($arr as $k=>$v){
	//		$item->setProp($v, $this->{$v});
	//	}
	//
	//	return $item;
	//}
	//
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
