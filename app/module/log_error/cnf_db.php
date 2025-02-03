<?php

return [
	'log_error'=>[
		"comment"=>"Отчёт об шибках",
		"columns"=>[
			'user_id'             => ["type"=>"id", 'is_null'=>1, 'comment'=>'ID пользователя',],
			'log_error_type'      => ["type"=>"text", 'comment'=>'Тип ошибки',],
			'log_error_message'   => ["type"=>"text", 'is_null'=>1, 'comment'=>'Сообщение об ошибках',],
			'log_error_file'      => ["type"=>"text", 'is_null'=>1, 'comment'=>'Адрес',],
			'log_error_line'      => ["type"=>"int", 'is_null'=>1, 'comment'=>'Номер строки',],
			'log_error_request'   => ["type"=>"serialized", 'is_null'=>1, 'comment'=>'Входящие данные',],
			'log_error_create'    => ["type"=>"create", 'comment'=>'Дата создания',],
		],
		"indexes"=>[],
	],
];
