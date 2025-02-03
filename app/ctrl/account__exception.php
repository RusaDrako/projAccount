<?php
namespace app\ctrl;

/**
 */
class account__exception extends \Exception{

	const ERR_ACCOUNT_NOT_GUID_CODE=1000;
	const ERR_ACCOUNT_NOT_GUID_MSG="Не указан идентификатор счёта";

	const ERR_TRANSACTION_NOT_GUID_CODE=1100;
	const ERR_TRANSACTION_NOT_GUID_MSG="Не указан идентификатор транзакции";
	const ERR_TRANSACTION_NOT_AMOUNT_CODE=1101;
	const ERR_TRANSACTION_NOT_AMOUNT_MSG="Не указана сумма транзакции";
	const ERR_TRANSACTION_NOT_IS_RECEIPT_CODE=1102;
	const ERR_TRANSACTION_NOT_IS_RECEIPT_MSG="Не указан тип транзакции";

	const ERR_ACCOUNT_NOT_FOUND_CODE=2000;
	const ERR_ACCOUNT_NOT_FOUND_MSG="Данные счёта не найдены";

	const ERR_TRANSACTION_NOT_FOUND_CODE=2100;
	const ERR_TRANSACTION_NOT_FOUND_MSG="Данные транзакции не найдены";

	private static $errors=[
		account__exception::ERR_ACCOUNT_NOT_GUID_CODE => account__exception::ERR_ACCOUNT_NOT_GUID_MSG,
		account__exception::ERR_TRANSACTION_NOT_GUID_CODE => account__exception::ERR_TRANSACTION_NOT_GUID_MSG,
		account__exception::ERR_TRANSACTION_NOT_AMOUNT_CODE => account__exception::ERR_TRANSACTION_NOT_AMOUNT_MSG,
		account__exception::ERR_TRANSACTION_NOT_IS_RECEIPT_CODE => account__exception::ERR_TRANSACTION_NOT_IS_RECEIPT_MSG,
		account__exception::ERR_ACCOUNT_NOT_FOUND_CODE => account__exception::ERR_ACCOUNT_NOT_FOUND_MSG,
		account__exception::ERR_TRANSACTION_NOT_FOUND_CODE => account__exception::ERR_TRANSACTION_NOT_FOUND_MSG,
	];

	public static function throw_err($code){
//		$code= ;
		$msg= account__exception::$errors[$code]?:"Неизвестная ошибка";
		throw new account__exception($msg, $code);
	}
}