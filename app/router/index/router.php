<?php

namespace app\router\index;

$group = \router::call()->get_group(1);

/** */
$func = function () {
	\view_app::call()->display('index/welcome');
};
# Заглавная страница
\router::call()->any("/", $func);


/** */
$func = function () {
	\view_app::call()->page('index/index');
};
# Заглавная страница
\router::call()->any("/{$group}/", $func);


/** */
$func = function () {
	\view_app::call()->page('index/test');
};
# Заглавная страница
\router::call()->any("/{$group}/test/", $func);
