<?php
namespace app\ctrl;

use app\model\account\account\item;

/**
 */
class transaction{

	static function get_account_model(){
		return \factory::getModel('account\account');
	}

	static function get_transaction_model(){
		return \factory::getModel('account\transaction');
	}

	/** Возвращает данные по операции */
	public static function get($transaction_guid){
		if(!$transaction_guid){ account__exception::throw_err(account__exception::ERR_TRANSACTION_NOT_GUID_CODE);}
		/** @var item $item */
		$transaction_item=static::get_transaction_model()->getByGUID($transaction_guid);
		if(!$transaction_item){ account__exception::throw_err(account__exception::ERR_TRANSACTION_NOT_FOUND_CODE);}

		return $transaction_item->get_data();
	}

	/** Создаёт операцию */
	public static function create($account_guid, $transaction_is_receipt, $transaction_amount, $transaction_description="", $create_type="", $create_initiator=""){
		if(!$account_guid)                  { account__exception::throw_err(account__exception::ERR_ACCOUNT_NOT_GUID_CODE);}
		/** @var item $item */
		$account_item=static::get_account_model()->getByGUID($account_guid);
		if(!$account_item)                  { account__exception::throw_err(account__exception::ERR_ACCOUNT_NOT_FOUND_CODE);}

		if(!$transaction_is_receipt===null) { account__exception::throw_err(account__exception::ERR_TRANSACTION_NOT_IS_RECEIPT_CODE);}
		if(!$transaction_amount)            { account__exception::throw_err(account__exception::ERR_TRANSACTION_NOT_AMOUNT_CODE);}

		do {
			$guid=account::GUID();
			$item_control=static::get_transaction_model()->getByGUID($guid);
		}while($item_control);

		/** @var \app\model\account\transaction\item $transaction_item */
		$transaction_item=static::get_transaction_model()->newItem();
		$transaction_item->setProp('GUID', $guid);
		$transaction_item->setProp('ACCOUNT_ID', $account_item->getId());
		$transaction_item->setProp('AMOUNT', $transaction_amount);
		$transaction_item->setProp('DESCRIPTION', $transaction_description);
		$transaction_item->setProp('CREATE_TYPE', $create_type);
		$transaction_item->setProp('CREATE_INITIATOR', $create_initiator);
		$transaction_item->save();

		$account_item->update_balance();
		$account_item->save();
		return $transaction_item->get_data();
	}

}