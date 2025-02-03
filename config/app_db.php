<?php

use RusaDrako\db_update\DB;

$config=[
	'db'=>[
		'main'=>[
			'connector'=>[
				'name'=>'db',
				'key'=>'MAIN_DB',
				'driver'=>DB::SQL_TYPE__MYSQL,
				'db_name'=>\registry::call()->get('MAIN_DB_DBNAME'), //'account',
			],
			'tables'=>[
				'account'=>[
					"comment"=>"Счёт",
					"columns"=>[
						'guid'          => ["type"=>"guid", 'comment'=>'Внешний идентификатор',],
						'title'         => ["type"=>"text", 'comment'=>'Заголовок',],
						'balance'       => ["type"=>"int", 'comment'=>'Баланс',],
						'is_blocked'    => ["type"=>"date", 'comment'=>'Заблокирован',],
						'date_create'   => ["type"=>"create", 'comment'=>'Дата создания',],
					],
					"indexes"=>[],
				],
				'transaction'=>[
					"comment"=>"Операции",
					"columns"=>[
						'guid'               => ["type"=>"guid", 'comment'=>'Внешний идентификатор',],
						'account_id'         => ["type"=>"id", 'is_null'=>1, 'comment'=>'Кошелёк',],
						'is_receipt'         => ["type"=>"checkbox", 'comment'=>'1 – поступление / 0 - списание',],
						'amount'             => ["type"=>"int", 'comment'=>'Сумма',],
						'description'        => ["type"=>"text", 'is_null'=>1, 'comment'=>'Описание',],
						'date_create'        => ["type"=>"create", 'comment'=>'Дата создания',],
						'create_type'        => ["type"=>"text", 'comment'=>'Тип записи: создана по запросу API / создана вручную',],
						'create_initiator'   => ["type"=>"text", 'comment'=>'Имя инициатора:: имя сервиса / имя администратора',],
					],
					"indexes"=>[],
				],
				'log_request'=>[
					"comment"=>"Запросы (лог)",
					"columns"=>[
						'request'       => ["type"=>"text", 'is_null'=>1, 'comment'=>'Запрос',],
						'response'      => ["type"=>"text", 'is_null'=>1, 'comment'=>'Ответ',],
						'type'          => ["type"=>"text", 'is_null'=>1, 'comment'=>'Тип: OK / Error',],
						'date_create'   => ["type"=>"create", 'comment'=>'Дата создания',],
					],
					"indexes"=>[],
				],
			],
		],
	],
];


$module_config=require(__DIR__ . '/modules.php');
$config['db']=\app\module\module_app::updateConfigDB($config['db'], $module_config);

return $config;
