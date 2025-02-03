<?php
namespace app\lib;

/** Настройки формирования страницы */
class page_settings{
	/** @var string Заголовок проекта */
	public static $project="";

	/** Возаращает заголовок проекта */
	public static function get_project(){
		return static::$project;
	}


	/** @var string Заголовок раздела */
	public static $title="";

	/** Возаращает заголовок раздела */
	public static function get_title(){
		return static::$title;
	}


	/** @var array Хлебные крошки */
	public static $bread_crumbs=[];

	/** @var array Хлебные крошки */
	public static $bread_crumbs_template='<a href=":link:">:title:</a>';

	/** Возаращает Хлебные крошки */
	public static function get_bread_crumbs($glue=" / "){
		$arr=[];
		foreach(static::$bread_crumbs as $k=>$v){
			if(is_string($k)){
				$arr[]=str_replace(array(':link:', ':title:'), array($k, $v), static::$bread_crumbs_template);
			}else{
				$arr[]=$v;
			}
		}
		return implode($glue, $arr);
	}


	/** @var string Папка нахождения favicon */
	public static $favicon_public_dir="/";

	/** @var string Имя файла favicon */
	public static $favicon="";

	/** Возвращает местоположение файла иконки */
	public static function get_favicon(){
		return static::$favicon_public_dir . static::$favicon;
	}


	/** @var array Верхнее меню ['ссылка'=>'Описание'] */
	public static $menu_top=[];

	/** @var array Меню модуля ['ссылка'=>'Описание'] */
	public static $menu_module=[];
}