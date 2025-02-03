<?php
namespace app\ctrl;

use app\model\account\account\item;

/**  */
class account{

	static function get_account_model(){
		return \factory::getModel("account\account");
	}


	/** Возвращает данные по счёту */
	public static function get($account_guid){
		if(!$account_guid){ account__exception::throw_err(account__exception::ERR_ACCOUNT_NOT_GUID_CODE);}
		/** @var item $item */
		$account_item=static::get_account_model()->getByGUID($account_guid);
		if(!$account_item){ account__exception::throw_err(account__exception::ERR_ACCOUNT_NOT_FOUND_CODE);}
		return $account_item->get_data();
	}

	/** Создаёт счёт */
	public static function create($title){
		do {
			$guid=account::GUID();
			$item_control=static::get_account_model()->getByGUID($guid);
		} while($item_control);

		/** @var item $item */
		$account_item=\factory::getModel("account\account")->newItem();
		$account_item->setProp('GUID', $guid);
		$account_item->setProp('TITLE', $title);
		$account_item->setProp('BALANCE', 0);
		$account_item->setProp('IS_BLOCKED', NULL);
		$account_item->save();
		return $account_item->get_data();
	}

	static function GUID(){
		if (function_exists('com_create_guid') === true){
			return trim(com_create_guid(), '{}');
		}
		return sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

}