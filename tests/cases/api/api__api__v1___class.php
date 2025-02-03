<?php

namespace tests\cases\api;

use PHPUnit\Framework\TestCase;

# Контрольные массивы для проверки ключей
require_once(__DIR__ . '/../../data_set/data__control__class.php');
# Контрольные массивы для проверки ключей
require_once(__DIR__ . '/_check.php');



/**  */
abstract class api__api__v1___class extends TestCase {

	protected $host = 'http://account.localhost/';
	protected $result_json = '';

	/** Вызывается перед каждым запуском тестового метода */
	protected function setUp() : void {}

	/** Вызывается после каждого запуска тестового метода */
	protected function tearDown() : void {}

	/** Запрос данных */
	protected function _getApiResult(array $set, $test = true) {
		# Если тестовый режим
		if ($test) {
			$set['api_test']   = 1;
			$set['test']       = 123;
		}
		$set_arr           = [];
		foreach ($set as $k => $v) {
			$set_arr[] = "{$k}={$v}";
		}
		$set_str = '';
		if ($set_arr) {
			$set_str = '&' . implode('&', $set_arr);
		}
		$url = "{$this->host}{$this->link}{$set_str}";
echo "\r\n\r\n{$url}\r\n\r\n";
		$result_json = file_get_contents($url);
		$this->result_json = $result_json;
echo "{$result_json}\r\n\r\n";
		$result_arr = json_decode($result_json, 1);
		$this->assertNotNull($result_arr, "Ответ сервера неверен: {$this->result_json}");
		return $result_arr;
	}



	/** Запрос данных */
	protected function _postApiResult(array $set, $test = true) {
//		# Если тестовый режим
//		if ($test) {
//			$set['api_test']   = 1;
//			$set['test']       = 123;
//		}
//		$set_arr           = [];
//		foreach ($set as $k => $v) {
//			$set_arr[] = "{$k}={$v}";
//		}
//		$set_str = '';
//		if ($set_arr) {
//			$set_str = '&' . implode('&', $set_arr);
//		}
		$url = "{$this->host}{$this->link}";
//echo "\r\n\r\n{$url}\r\n\r\n";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $set);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result_json = curl_exec($ch);
		curl_close($ch);
		$this->result_json = $result_json;
//echo "{$result_json}\r\n\r\n";
		$result_arr = json_decode($result_json, 1);
//var_dump($result_arr);
//echo "\r\n\r\n";
		$this->assertNotNull($result_arr, "Ответ сервера неверен: {$this->result_json}");
		return $result_arr;
	}



	/** Запрос данных */
	protected function _getApiResult_auth(array $set) {
		return $this->_getApiResult($set, false);
	}



	protected function _check_error($result, $code, $message){
		$this->assertFalse($result["ok"], 'Возвращает результат');
		$this->assertNull($result["result"], 'Возвращает результат');
		$this->assertEquals($code, $result["errCode"], "Неверный код ошибки: {$result["errCode"]}");
		$this->assertEquals($message, $result["errMessage"], "Неверное сообщение об ошибке: {$result["errMessage"]}");
	}

/**/
}
