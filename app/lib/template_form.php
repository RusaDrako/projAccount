<?php

namespace app\lib;

/**
 * Шаблоны элементов формы
 * @package app\lib
 */
class template_form {

	protected static function update_template($template, array $params){
		return str_replace(array_keys($params), $params, $template);
	}

	protected static function get_id(...$names){
		return implode('__', $names);
	}

	protected static function get_name($group_name, $name){
		return $group_name ? "{$group_name}[{$name}]" : $name;
	}


	public static $template_input_checkbox=<<<HTML
<label class="form-control form-check-label">
	<input type="checkbox" id=":item_id" name=":item_name" :checked class="form-control form-check-input form-check-inline"> :text
</label>
HTML;

	public static function create_input_checkbox($name, $value, $text, $group_name=''){
		$params=[
			':item_id'=>static::get_id($group_name, $name),
			':item_name'=>static::get_name($group_name, $name),
			':checked'=>$value?'checked':'',
			':text'=>$text,
		];
		return static::update_template(static::$template_input_checkbox, $params);
	}


	public static $template_input_date=<<<HTML
<input type="date" id=":item_id" name=":item_name" value=":value" class="form-control">
HTML;

	public static function create_input_date($name, $value, $group_name=''){
		$params=[
			':item_id'=>static::get_id($group_name, $name),
			':item_name'=>static::get_name($group_name, $name),
			':value'=>$value,
		];
		return static::update_template(static::$template_input_date, $params);
	}


	public static $template_input_text=<<<HTML
<input type="text" id=":item_id" name=":item_name" value=":value" class="form-control">
HTML;

	public static function create_input_text($name, $value, $group_name=''){
		$params=[
			':item_id'=>static::get_id($group_name, $name),
			':item_name'=>static::get_name($group_name, $name),
			':value'=>$value,
		];
		return static::update_template(static::$template_input_text, $params);
	}


	public static $template_textarea=<<<HTML
<textarea id=":item_id" name=":item_name" class="form-control form-text">:value</textarea>
HTML;

	public static function create_textarea($name, $value, $group_name=''){
		$params=[
			':item_id'=>static::get_id($group_name, $name),
			':item_name'=>static::get_name($group_name, $name),
			':value'=>$value,
		];
		return static::update_template(static::$template_textarea, $params);
	}


	public static $template_select=<<<HTML
<select class="form-control" id=":item_id" name=":item_name">
	<option value="">---</option>
	:options
</select>
HTML;

	public static $template_select_option=<<<HTML
<option value=":value" :selected>:title</option>
HTML;

	public static function create_select($list, $name, $value, $group_name=''){
		$arr_option=[];
		foreach($list as $k=>$v){
			$params=[
				':title'=>$v,
				':selected'=>($value==$k ? ' selected' : ''),
				':value'=>$k,
			];
			$arr_option[]=static::update_template(static::$template_select_option, $params);
		}

		$params=[
			':item_id'=>static::get_id($group_name, $name),
			':item_name'=>static::get_name($group_name, $name),
			':options'=>implode("\n\t", $arr_option),
		];
		return static::update_template(static::$template_select, $params);
	}

	public static function get_array_for_create_select($collection, $key_name, $title_name){
		$result=[];
		foreach($collection ? $collection->iterator() : [] as $v){
			$result[$v->$key_name]=$v->$title_name;
		}
		return $result;
	}

}