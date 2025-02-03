<?php
$group=static::$url_path_root;
view_app::call()->variable('url_path_root', static::$url_path_root);
view_app::call()->variable('module_title', static::$module_title);


/** */
$func=function($id){
	$log_error_data=static::getModel('log_error');
	$log_error_item=$log_error_data->getByKey($id);

	if(!$log_error_item){
		\view_app::call()->page_error('Заметка не найдена');
	}

	\view_app::call()->variable('item', $log_error_item);
	\view_app::call()->page('log_error/log_error_item');
};
# Запись
\router::call()->any("/{$group}/item/{id}/", $func);


/** */
$func=function(){
	$log_error_data=static::getModel('log_error');

	$log_error_list=$log_error_data->getLastList();
	\view_app::call()->variable('list_obj', $log_error_list);
	\view_app::call()->page('log_error/log_error_list'/*, ['list_obj'=> $report_list, 'input'=>$input, 'err'=>$err]*/);
};
# Список
\router::call()->any("/{$group}/list/", $func);

/** */
$func=function(){
	$log_error_data=static::getModel('log_error');

	$log_error_list=$log_error_data->getLastGroupList();
	\view_app::call()->variable('list_obj', $log_error_list);
	\view_app::call()->page('log_error/log_error_list'/*, ['list_obj'=> $report_list, 'input'=>$input, 'err'=>$err]*/);
};
# Список
\router::call()->any("/{$group}/", $func);
