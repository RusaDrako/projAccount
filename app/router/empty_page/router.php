<?php

namespace app\router\empty_page;

//use app\ctrl\account\ctrl_transaction;
//use app\ctrl\account\ctrl_account;
//use app\ctrl\account\ctrl_transaction_plan;
//use app\model\account\transaction\data;
//
//$group = \router::call()->get_group(1);
//
//\view_app::call()->variable('url_path_root', $group);

/////** */
////$func=function($id=0) use ($group){
////	list($item_obj, $input, $err)=ctrl_transaction::update_item($id, \request::call()->get('transaction'), \request::call()->get('is_submit'));
////	if(!$err && \request::call()->get('is_submit') && !$id){
////		\redirect::redirectNow("/{$group}/transaction/edit/".$item_obj->getKey());
////		exit;
////	}
////
////	$list_account=ctrl_account::get_all();
////
////	\view_app::call()->variable('item', $item_obj);
////	\view_app::call()->variable('input', $input);
////	\view_app::call()->variable('list_account', $list_account);
////	\view_app::call()->variable('err', $err);
////	\view_app::call()->variable('is_new', 1);
////	\view_app::call()->page('account/transaction/form');
////};
////# Добавить запись
////\router::call()->any("/{$group}/transaction/new/", $func);
////\router::call()->any("/{$group}/transaction/edit/{id}/", $func);
//
///** */
//$func = function ($id=0) {
//	$item=ctrl_transaction::get_by_id($id);
//	\view_app::call()->page('account/transaction/item', ['item'=> $item]);
//};
//\router::call()->any("/{$group}/transaction/item/{id}", $func);
//
///** */
//$func = function () {
//	$list=ctrl_transaction::get_all();
//	\view_app::call()->page('account/transaction/list', ['list_obj'=> $list]);
//};
//\router::call()->any("/{$group}/transaction/", $func);
//
//
//
//
//
/////** */
////$func=function($id=0) use ($group){
////	list($item_obj, $input, $err)=ctrl_account::update_item($id, \request::call()->get('account'), \request::call()->get('is_submit'));
////	if(!$err && \request::call()->get('is_submit') && !$id){
////		\redirect::redirectNow("/{$group}/category/edit/".$item_obj->getKey());
////		exit;
////	}
////
////	\view_app::call()->variable('item', $item_obj);
////	\view_app::call()->variable('input', $input);
////	\view_app::call()->variable('err', $err);
////	\view_app::call()->variable('is_new', 1);
////	\view_app::call()->page('account/account/form');
////};
////# Добавить запись
////\router::call()->any("/{$group}/account/new/", $func);
////\router::call()->any("/{$group}/account/edit/{id}/", $func);
//
///** */
//$func = function ($id=0) {
//	$item=ctrl_account::get_by_id($id);
//	\view_app::call()->page('account/account/item', ['item'=> $item]);
//};
//\router::call()->any("/{$group}/account/item/{id}", $func);
//
///** */
//$func = function () {
//	$list=ctrl_account::get_all();
//	\view_app::call()->page('account/account/list', ['list_obj'=> $list]);
//};
//\router::call()->any("/{$group}/account/", $func);
//
//
//
//
//
/////** */
////$func=function($id=0) use ($group){
////	list($item_obj, $input, $err)=ctrl_transaction_plan::update_item($id, \request::call()->get('transaction_plan'), \request::call()->get('is_submit'));
////	if(!$err && \request::call()->get('is_submit') && !$id){
////		\redirect::redirectNow("/{$group}/plan/edit/".$item_obj->getKey());
////		exit;
////	}
////
////	$list_account=ctrl_account::get_all();
////
////	\view_app::call()->variable('item', $item_obj);
////	\view_app::call()->variable('input', $input);
////	\view_app::call()->variable('list_account', $list_account);
////	\view_app::call()->variable('err', $err);
////	\view_app::call()->variable('is_new', 1);
////	\view_app::call()->page('account/transaction_plan/form');
////};
////# Добавить запись
////\router::call()->any("/{$group}/plan/new/", $func);
////\router::call()->any("/{$group}/plan/edit/{id}/", $func);
////
/////** */
////$func = function ($id=0) {
////	$item=ctrl_transaction_plan::get_by_id($id);
////	\view_app::call()->page('account/transaction_plan/item', ['item'=> $item]);
////};
////\router::call()->any("/{$group}/plan/item/{id}", $func);
////
/////** */
////$func = function () {
////	$list=ctrl_transaction_plan::get_all();
////	\view_app::call()->page('account/transaction_plan/list', ['list_obj'=> $list]);
////};
////\router::call()->any("/{$group}/plan/", $func);
