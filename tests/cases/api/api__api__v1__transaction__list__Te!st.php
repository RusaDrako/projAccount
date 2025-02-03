<?php

namespace tests\cases\api;

require_once('api__api__v1___class.php');



/**
 * @author Петухов Леонид <l.petuhov@okonti.ru>
 * @group api-info
 * @group bonus
 */
class api__api__v1__transaction__list__Te1st extends api__api__v1___class {

	protected $link = 'api/v1';





	/** Ошибка данных */
	public function test__action__err_1() {
		$set = [];
		$result = $this->_getApiResult($set);
//var_dump($result);
		$this->assertFalse($result['ok'], 'Возвращает результат');
		$this->assertEquals('Не указан ID клиента', $result['error_desc'], "Неверный код ошибки: {$result['error']}");
	}





	/** Ошибка данных */
	public function test__action__err_2() {
		$set = [
			'id'   => -3010,
		];
		$result = $this->_getApiResult($set);
//var_dump($result);
		$this->assertFalse($result['ok'], 'Возвращает результат');
		$this->assertEquals('Не указан тип акции для баллов', $result['error_desc'], "Неверный код ошибки: {$result['error']}");
	}





	/** Ошибка данных */
	public function test__action__err_3() {
		$set = [
			'id'            => -3010,
			'action_type'   => 1,
		];
		$result = $this->_getApiResult($set);
//var_dump($result);
		$this->assertFalse($result['ok'], 'Возвращает результат');
		$this->assertEquals('Не указано количество баллов', $result['error_desc'], "Неверный код ошибки: {$result['error']}");
	}





	/** Ошибка данных */
	public function test__action__err_4() {
		$set = [
			'id'            => -3010,
			'action_type'   => 1,
			'amount'        => -1,
		];
		$result = $this->_getApiResult($set);
//var_dump($result);
		$this->assertFalse($result['ok'], 'Возвращает результат');
		$this->assertEquals('Неверное количество баллов', $result['error_desc'], "Неверный код ошибки: {$result['error']}");
	}





	/** Ошибка данных */
	public function test__action__err_5() {
		$set = [
			'id'            => -3010,
			'action_type'   => 2,
			'amount'        => 1000,
		];
		$result = $this->_getApiResult($set);
//var_dump($result);
		$this->assertFalse($result['ok'], 'Возвращает результат');
		$this->assertEquals('Бонус по акции сегодня уже начислялся', $result['error_desc'], "Неверный код ошибки: {$result['error']}");
	}





	/** Всё ок */
	public function test__action__ok() {
		$set = [
			'id'            => -3010,
			'action_type'   => 999,
			'amount'        => 1030,
		];
		$result = $this->_getApiResult($set);
//var_dump($result);
		$this->assertTrue($result['ok'], "Возвращает ошибку: {$result['error_desc']}");

		$result = $result['result'];
		# Контрольный массив для проверки набора ключей (бонусы)
		$result_control = (new data__control__class())->control__bonus_array__ok();

		$this->assertEquals($result_control, array_intersect_key($result_control, $result), 'Несовпадение ключей: не переданы необходимые ключи');
		$this->assertEquals([], array_diff_key($result, $result_control), 'Несовпадение ключей: переданы лишние ключи');

		$str = 'Неправильно сформирован бонус:';
		$this->assertEquals(4,                     $result['TYPE'],          "{$str} тип");
		$this->assertEquals($set['action_type'],   $result['TYPE_SET'],      "{$str} настройки типа");
		$this->assertEquals($set['amount'],        $result['AMOUNT'],        "{$str} сумма");
		$this->assertEquals($set['amount'],        $result['AMOUNT_VIEW'],   "{$str} обработанная сумма");
		$this->assertEquals($set['id'],            $result['CUSTOMER_ID'],   "{$str} ID клиента");

		$date_control = date('Y-m-d', time() + 5*24*60*60);
		$this->assertEquals($date_control,         $result['DATE_ACCOUNTING'],   "{$str} Дата действия не совпадает");

		$this->assertEquals($set['comment'],       '',                       "{$str} комментарий");
	}



	/** Всё ок */
	public function test__action__ok_comment() {
		$set = [
			'id'            => -3010,
			'action_type'   => 999,
			'amount'        => 1030,
			'comment'       => 'test_comment',
		];
		$result = $this->_getApiResult($set);
//var_dump($result);
		$this->assertTrue($result['ok'], "Возвращает ошибку: {$result['error_desc']}");

		$result = $result['result'];
		# Контрольный массив для проверки набора ключей (бонусы)
		$result_control = (new data__control__class())->control__bonus_array__ok();

		$this->assertEquals($result_control, array_intersect_key($result_control, $result), 'Несовпадение ключей: не переданы необходимые ключи');
		$this->assertEquals([], array_diff_key($result, $result_control), 'Несовпадение ключей: переданы лишние ключи');

		$str = 'Неправильно сформирован бонус:';
		$this->assertEquals(4,                     $result['TYPE'],              "{$str} тип");
		$this->assertEquals($set['action_type'],   $result['TYPE_SET'],          "{$str} настройки типа");
		$this->assertEquals($set['amount'],        $result['AMOUNT'],            "{$str} сумма");
		$this->assertEquals($set['amount'],        $result['AMOUNT_VIEW'],       "{$str} обработанная сумма");
		$this->assertEquals($set['id'],            $result['CUSTOMER_ID'],       "{$str} ID клиента");

		$date_control = date('Y-m-d', time() + 5*24*60*60);
		$this->assertEquals($date_control,         $result['DATE_ACCOUNTING'],   "{$str} Дата действия не совпадает");

		$len_result   = mb_strlen($result['COMMENT']);
		$len_set      = mb_strlen($set['comment']);
		$this->assertEquals($set['comment'],
			mb_substr($result['COMMENT'], -$len_set, -1) . mb_substr($result['COMMENT'], $len_result - 1, $len_result),
			"{$str} настройки типа");
	}



/**/
}
