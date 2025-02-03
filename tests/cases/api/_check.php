<?php

namespace tests\cases\api;


use PHPUnit\Framework\TestCase;

class _check  extends TestCase{

	public static function check_account($data, $title, $balance=0, $is_blocket=null){
		static::assertTrue(is_array($data), "Результат не является массивом: " . var_export($data, 1));
		static::assertArrayHasKey("GUID", $data, "Результат не является массивом: " . var_export($data, 1));
		static::assertArrayHasKey("TITLE", $data, "Результат не является массивом: " . var_export($data, 1));
		static::assertArrayHasKey("BALANCE", $data, "Результат не является массивом: " . var_export($data, 1));
		static::assertArrayHasKey("IS_BLOCKED", $data, "Результат не является массивом: " . var_export($data, 1));

	}
}
