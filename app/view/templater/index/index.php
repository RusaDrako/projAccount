<?php
$arr_menu=[
	'Кошелёк'=>[
		'/account/account'=>['title'=>'Счета', 'icon'=>'<i class="fa-regular fa-list"></i>'],
		'/account/transaction'=>['title'=>'Операции', 'icon'=>'<i class="fa-duotone fa-regular fa-file-chart-pie"></i>'],
	],
	'Технические'=>[
		'/db_update'=>['title'=>'Обновление БД', 'icon'=>'<i class="fa-regular fa-regular fa-database"></i>'],
		'/log_error'=>['title'=>'Лог ошибок', 'icon'=>'<i class="fa-regular fa-circle-exclamation"></i>'],
	],
];
?>

<?php foreach($arr_menu as $k => $v){ ?>
	<div class="row">
		<div class="col-12 col-lg-2 text-center">
			<h4><?= $k ?></h4>
		</div>
		<div class="col">
			<div class="row">
				<?php foreach($v as $k_2 => $v_2){ ?>
					<div class="col-4 col-md-3 text-center align-content-center">
						<?= $v_2['icon']?:'' ?>
						<a href="<?= $k_2 ?>" class="text-decoration-none">
							<?= $v_2['title'] ?>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<hr>
<?php } ?>
