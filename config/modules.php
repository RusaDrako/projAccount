<?php
return [
	\app\module\log_error\module::SET_MODULE_NAME=>[
		'namespace'=>'app\module\log_error',
		'db_alias'=>'main',
		'db_name'=>'db',
		'setting'=>[
//			'token'=>\registry::call()->get('TELEGRAM_BOT_UPLOAD_TOKEN'),
		],
	],
];
