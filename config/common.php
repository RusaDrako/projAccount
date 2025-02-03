<?php
# Загружаем ядро
require_once(__DIR__ . '/../vendor/autoload.php');
\Elbrus::call();


# Если это ajax запрос, то оставляем об этом метку в регистре
if (\request::call()->get('isAjax')) {
	\registry::call()->set('isAjax', true, true);
}


# Формируем короткие псевдонимы для базовых классов
require_once(\registry::call()->get('FOLDER_ROOT') . 'config/shutdown/common.php');

class_alias(\RusaDrako\router\router_add::class, 'router');

class_alias(\app\module\module_app::class, 'app_module');


# Настройки функций логирования и оповещение об ошибках)
# Данные по модулям
$_modules=require(__DIR__ . '/modules.php');
# Регистрация метода перехвата ошибок и настройки
\app\module\log_error\shutdown_error::reg_shutdown_error_function(
	$_modules[\app\module\log_error\module::SET_MODULE_NAME],
	\request::call(),
	\registry::call()->get('FOLDER_ROOT'),
	\registry::call()->get('test'),
	true);
unset($_modules);
# Подключаем оповещение по ТГ
\app\module\log_error\shutdown_error::set_telegram_bot(new \RusaDrako\telegram_notification\Bot(\registry::call()->get('TELEGRAM_SYSTEM_TOKEN')));
# Настройка шаблона сообщения
$host = \registry::call()->get('SITE_HOST');
$time = \registry::call()->get('TS_NOW_DT');
$icon = \registry::call()->get('TELEGRAM_SYSTEM_TO_ERROR_ICON');
$bot_template = "{$icon} {$time}: {$host} => " . \app\module\log_error\shutdown_error::get_telegram_template();
\app\module\log_error\shutdown_error::set_telegram_template($bot_template);


# Активируем маршрутизатор
router::call()->set_server_setting();

# Активируем шаблонизатор
# Используем для активации дополненый файл, но вызывать можем через \view::call()
\app\addon\view::call(new \config\elbrus\view\type_native())
	# Назначаем общеи переменные
	->variable('test', \registry::call()->get('test'))
;


# Базовые настройки страницы (header/footer/menu_top)
\app\lib\page_settings::$favicon_public_dir="/img/";
\app\lib\page_settings::$favicon="logo.png";
\app\lib\page_settings::$project=\registry::call()->get('TITLE_PROJECT');
\app\lib\page_settings::$title=\registry::call()->get('TITLE_PROJECT');
\app\lib\page_settings::$bread_crumbs['/index']=\app\lib\page_settings::$title;
\app\lib\page_settings::$menu_top['/']='Добро пожаловать!';
\app\lib\page_settings::$menu_top['/index']='Карта сайта';
\app\lib\page_settings::$menu_top['/note']='Заметки';
\app\lib\page_settings::$menu_top['/work_report/report']='Отчёт';


# Настройки базовых псевдонимов
class_alias(\app\factory::class, 'factory');
class_alias(\app\addon\view::class, 'view_app');
class_alias(\app\lib\redirect::class, 'redirect');
class_alias(\rusadrako\log\log::class, 'log');
