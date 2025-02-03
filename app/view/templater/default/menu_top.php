<?php
$arr_menu=[
	'/index'=>'Стартовая',
	'/faq'=>'FAQ',
];
?>
<div class="row menu_top">
<?php foreach($arr_menu as $k => $v){ ?>
	<div class="col-6 col-md-5 col-lg-4 col-xl-2 text-center align-content-center">
		<a href="<?= $k ?>" class="text-light text-decoration-none"><?= $v ?></a>
	</div>
<?php }?>
</div>
