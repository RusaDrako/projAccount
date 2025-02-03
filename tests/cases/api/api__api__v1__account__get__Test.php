<?php

namespace tests\cases\api;

require_once('api__api__v1___class.php');

/** */
class api__api__v1__account__get__Test extends api__api__v1___class {

	protected $link = 'api/v1/account/get';

	/** */
	public function test__null() {
		$set = [
			'guid'       => null,
		];
		$result = $this->_postApiResult($set);
		$this->_check_error($result, '1000', 'Не указан идентификатор счёта');
	}

	/** */
	public function test__fail() {
		$set = [
			'guid'       => 'test_account_not',
		];
		$result = $this->_postApiResult($set);
		$this->_check_error($result, '2000', 'Данные счёта не найдены');
	}

	/** */
	public function test__ok() {
		$set = [
			'guid'       => 'test_account_1',
		];
		$result = $this->_postApiResult($set);
		$this->assertTrue($result['ok'], 'Возвращает результат');
		$this->assertTrue(is_array($result["result"]), "Результат не является массивом: {$result["result"]}");
	}





/**/
}
