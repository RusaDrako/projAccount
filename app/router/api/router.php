<?php

namespace app\router\api;

use app\addon\api\api_result;
use app\ctrl\account;
use app\ctrl\account__exception;
use app\ctrl\transaction;
use app\ctrl\transaction__exception;
#use app\model\account\log_request\item;

$group = \router::call()->get_group(1);

$url = "/{$group}/v1";

$key = \registry::call()->get('API_KEY');
$api = new \RusaDrako\api\ClientApi($key);
$api->set_result(new api_result());

$result = $api->get_result();

# Для всех ненайденных маршрутов перенаправление на главную страницу
\router::call()->default(function() use ($result) { $result->error(404, "Страница не найдена"); exit;});


/** */
$func = function () use ($result){
	$account_guid = \request::call()->get('guid');
	$arr = account::get($account_guid);
	$result->result($arr);
};
\router::call()->post("{$url}/account/get/", $func);


/** */
$func = function () use ($result) {
	$account_title = \request::call()->get('title');
	$arr = account::create($account_title);
	$result->result($arr);
};
\router::call()->post("{$url}/account/create/", $func);


/** */
$func = function () use ($result){
	$transaction_guid = \request::call()->get('guid');
	$arr = transaction::get($transaction_guid);
	$result->result($arr);
};
\router::call()->post("{$url}/transaction/get/", $func);


/** */
$func = function () use ($result) {
	$account_guid = \request::call()->get('account_guid', null);
	$transaction_amount = \request::call()->get('amount', 0);
	$transaction_description = \request::call()->get('description', '');
	$transaction_is_receipt = \request::call()->get('is_receipt', null);

	$arr = transaction::create($account_guid, $transaction_is_receipt, $transaction_amount, $transaction_description);
	$result->result($arr);
};
\router::call()->post("{$url}/transaction/create/", $func);


/** */
$func = function () use ($result) {
	$filters=[
		'account_guid'=>\request::call()->get('account_guid', null),
		'from'=>\request::call()->get('from', date('Y-m-d 00:00:00', time()-7*24*60*60)),
		'to'=>\request::call()->get('to', date('Y-m-d 00:00:00', time())),
	];
	$arr = transaction::list($filters);
	$result->result($arr);
};
\router::call()->post("{$url}/transaction/list/", $func);



try {
	# Вызов обработчика маршрутизатора (перед этим указываем страницу по умолчанию)
	\router::call()->router();
	exit;
} catch (account__exception $e) {
	$code = $e->getCode();
	$message = $e->getMessage();
} catch (\Exception $e) {
	$code = $e->getCode();
	$message = $e->getMessage();
}

$result->error($code, $message);
exit;
