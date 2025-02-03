<?php

namespace tests\cases\api;

require_once('api__api__v1___class.php');



/**  */
class api__api__v1__account__create__Test extends api__api__v1___class {

	protected $link = 'api/v1/account/create';


//	/** */
//	public function test__null() {
//		$set = [
////			'title'       => null,
//		];
//		$result = $this->_postApiResult($set);
//		$this->_check_error($result, '1000', 'Не указан идентификатор счёта');
//	}
//
//	/** */
//	public function test__fail() {
//		$set = [
//			'guid'       => 'test_account_not',
//		];
//		$result = $this->_postApiResult($set);
//		$this->_check_error($result, '2000', 'Данные не найдены');
//	}

	/** */
	public function test__ok() {
		$set = [
			'title' => 'test_account_new',
		];
		$result = $this->_postApiResult($set);
var_dump($result);


		$this->assertTrue($result['ok'], 'Возвращает результат');

		_check::check_account($result["result"],'test_account_new');
		$this->assertTrue(is_array($result["result"]), "Результат не является массивом: {$result["result"]}");
	}

/**/
}
