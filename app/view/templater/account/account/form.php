<?php $this->templater->display('wallet/transaction_category/title');?>

<?php
/*
<div class="row">
	<div class="col">
		<h4>Категории</h4>
	</div>
	<div class="col-2 align-content-center text-end">
		<?php if($this->input['id']?:0){ ?>
			<a href="/<?= $this->url_path_root ?>/transaction_category/item/<?= $this->input['id'] ?>">Назад</a> |
		<?php } ?>
	</div>
</div>
*/
?>

<div class="row">
	<div class="col-10 col-md-8 col-lg-6 col-lx-4 offset-1 offset-md-2 offset-lg-3 offset-lx-4">
		<div class="bg-success-subtle p-2 py-2">
			<form method="post">
				Заголовок<br>
				<input class="form-control" id="new_title" type="text" name="transaction_category[title]" value="<?= $this->input['title']; ?>" style="min-width: 400px; width: 100%; padding: 5px;">
				<br>
				Описание<br>
				<textarea class="form-control" id="new_description" name="transaction_category[description]" style="min-width: 400px; width: 100%; min-height: 100px; padding: 5px;"><?= $this->input['description'] ?></textarea>
				<br>
				Цвет<br>
				<div class="row">
					<div class="col-10">
						<textarea class="form-control" id="new_signature" name="transaction_category[color]" style="min-width: 200px; width: 100%; min-height: 100px; padding: 5px;"><?= $this->input['color'] ?></textarea>
					</div>
					<div class="col-2" style="background-color: <?= $this->item->COLOR_CSS ?>">
					</div>
				</div>
				<br>
				<?php if($this->err){ ?>
					<br><pre style="color: #800;"><?php implode('<br>', $this->err) ?></pre>
				<?php } ?>
				<button class="form-control bg-primary text-white" name="is_submit" value="1">Сохранить</button>
			</form>
		</div>
	</div>
</div>
