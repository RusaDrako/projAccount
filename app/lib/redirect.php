<?php

namespace app\lib;

class redirect{
	/** Настройки перенаправления */
	public static function redirect($url, int $time = null) {
		if ($time) {
			header("Refresh: {$time}; url={$url}");
		} else {
			header('HTTP/1.1 200 Moved Permanently');
			header("Location: {$url}");
		}
	}

	/** Настройки перенаправления и завершение скрипта */
	public static function redirectNow($url) {
		static::redirect($url);
		exit;
	}
}
