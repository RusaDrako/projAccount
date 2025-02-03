<?php $this->templater->display('wallet/transaction_category/title'); ?>
<hr>

<div class="row">
	<div class="col">
		<h4>
			Категория # <?= $this->item->ID; ?>: <?= $this->item->TITLE; ?>
		</h4>
	</div>
	<div class="col-2 align-content-center text-end">
		<a class="bg-primary icon" href="/<?= $this->url_path_root ?>/category/edit/<?= $this->item->ID ?>"><i class="fa-solid fa-edit"></i></a>
	</div>
</div>

<div class="row">
	<div class="col-6">
		<h5>Описание</h5>
		<div class="row mx-2 border border-success-subtle">
			<div class="col">
				<?= $this->item->DESCRIPTION ?>
			</div>
		</div>
	</div>
	<div class="col-6">
		<h5>Цвет</h5>
		<div class="row mx-2 border border-success-subtle">
			<div class="col">
				<?= $this->item->COLOR ?>
			</div>
		</div>
	</div>
</div>
