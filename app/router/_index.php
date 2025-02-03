<?php

# Получаем ссылку-группу
$group = \router::call()->get_group();



# Для всех ненайденных маршрутов перенаправление на главную страницу
\router::call()->default(function() { echo "Страница не найдена."; exit;});



# Файл группы маршрутов
$group = $group ?: 'empty_page';


//\registry::call()->get('CURRENT_USER');

# Загрузка модулей
$modules=require(\registry::call()->get('FOLDER_ROOT') . 'config/modules.php');

if($group=="module_icon"){
	/** */
	$func = function ($module) use ($modules) {
		# Картинка по-умолчанию
		$img_default=\registry::call()->get('FOLDER_ROOT')."public/img/logo.png";
		# Устанавливаем базовую картинку
		$img=$img_default;
		# Проверяем существование модуля
		if(array_key_exists($module, $modules)){
			$module_set=$modules[$module];
			# Получаем базовый класс модуля
			/** @var app\module\module_app $module_class_name */
			$module_class_name=$module_set['namespace'].'\module';
			# Установка базовых настроек модуля (прописываем иконку)
			$module_class_name::setConfig();
			# Получаем путь к иконке
			$img=$module_class_name::getModuleIcon_Path()?:$img;
		}
		# Картинка не существует
		if(!file_exists($img)){
			$img=$img_default;
			# Картинка не соответствует формату
		}elseif(!in_array(mime_content_type($img), ['image/svg+xml', 'image/png'])){
			$img=$img_default;
		}
		# Выводим иконку
		header('Content-Type:'.mime_content_type($img));
		header('Content-Length: ' . filesize($img));
		readfile($img);
	};
	# Вывод иконки модуля
	\router::call()->any("/{$group}/{module}", $func);
}elseif(array_key_exists($group, $modules)){
	$module_set=$modules[$group];
	# Получаем базовый класс модуля
	/** @var app\module\module_app $module_class_name */
	$module_class_name=$module_set['namespace'] . '\module';
	# Настройки префикса
	$module_class_name::setModulePrefix($module_set['prefix']?:'');
	# Настройки корневого url
	$module_class_name::setUrlPathRoot($group);
	# Установка базовых настроек модуля
	$module_class_name::setConfig();
	# Обновление настроек модуля
	$module_class_name::updateConfig($module_set['config']?:[]);
	# Подключение к БД для моделей
	$module_class_name::setDB(\factory::getDB($module_set['db_name']));
	# Подключение настроек модуля
	$module_class_name::setSetting($module_set['setting']);

	$module_class_name::setModuleTitle($module_set['title']?:$module_class_name::getModuleTitle());

	# Настройка заголовка модуля
	page_settings::$title=$module_class_name::getModuleTitle()?:"Модуль без имени";
	page_settings::$bread_crumbs["/{$group}"]=page_settings::$title;
	# Настройка иконки модуля
	page_settings::$favicon_public_dir="";
	page_settings::$favicon="/module_icon/{$group}/";
	page_settings::$menu_module=$module_class_name::getModuleMenu();

	# Добавляем папки view
	\view_app::call()->getAdapterTemplater()->addRootFolders($module_class_name::getViewFolders());
	# Настройка маршрутизатора
	$module_class_name::getRouter(\router::call());
} else {
	$file_name=\registry::call()->get('FOLDER_ROOT')."app/router/{$group}/router.php";
	# Если файл не существует
	if(!file_exists($file_name)){
		$group='empty_page';
		$file_name=\registry::call()->get('FOLDER_ROOT')."app/router/{$group}/router.php";
	}
	# Подгружаем маршруты
	require_once($file_name);
}


# Вызов обработчика маршрутизатора (перед этим указываем страницу по умолчанию)
\router::call()->router();
