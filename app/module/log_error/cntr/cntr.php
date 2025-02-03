<?php
namespace app\module\log_error\cntr;

class cntr {

	public static function saveError($request, $type, $message, $file='', $line='') {
		$log_error_item = \app\module\log_error\module::getModel('log_error')->newItem();
		$log_error_item->setProp('TYPE',      $type);
		$log_error_item->setProp('MESSAGE',   $message);
		$log_error_item->setProp('FILE',      $file);
		$log_error_item->setProp('LINE',      $line);
		$log_error_item->setProp('REQUEST',   json_encode($request));
		$log_error_item->save();
		return $log_error_item;
	}

}