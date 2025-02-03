<?php

use app\lib\template_form;

$form_name="transaction_plan";

$this->templater->display('wallet/transaction_plan/title');

//var_dump($this->input);
?>

<div class="row">
	<div class="col-10 col-md-8 col-lg-6 col-lx-4 offset-1 offset-md-2 offset-lg-3 offset-lx-4">
		<div class="bg-success-subtle p-2 py-2">
			<form method="post">
				<div class="row mb-2">
					<div class="col-12">
						Категория
					</div>
					<div class="col-12">
						<?= template_form::create_select(template_form::get_array_for_create_select($this->list_transaction_category, 'ID', 'TITLE'), 'transaction_category_id', $this->input['transaction_category_id'], $form_name) ?>
						<?php /*$this->templater->display("wallet/transaction_category/item_select", [
							"list"=>$this->list_transaction_category,
							"group_name"=>"transaction_plan",
							"name"=>"transaction_category_id",
							"select"=>$this->input['transaction_category_id']]); */ ?>

					</div>
				</div>
				<div class="row mb-2">
					<div class="col-12">
						Дата
					</div>
					<div class="col-12">
						<input class="form-control" id="<?= $form_name ?>_date_plan" type="date" name="<?= $form_name ?>[date_plan]" value="<?= $this->input['date_plan']; ?>">
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-12">
						Сумма
					</div>
					<div class="col-12">
						<input class="form-control" id="<?= $form_name ?>_amount" type="text" name="<?= $form_name ?>[amount]" value="<?= $this->input['amount']; ?>">
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-12">
						Описание
					</div>
					<div class="col-12">
						<textarea class="form-control form-text" id="<?= $form_name ?>_description" name="<?= $form_name ?>[description]"><?= $this->input['description'] ?></textarea>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-12">
						<label class="mb-4">
							<input class="form-control form-check-input form-check-inline" id="<?= $form_name ?>_is_income" type="checkbox" name="<?= $form_name ?>[is_income]" <? echo $this->input['is_income']?'checked':''; ?>> Поступление
						</label>
					</div>
				</div>
				<?php if($this->err){ ?>
					<div class="row mb-2">
						<div class="col-12">
							<label>
								<br><pre style="color: #800;"><?php implode('<br>', $this->err) ?></pre>
							</label>
						</div>
					</div>
				<?php } ?>
				<button class="form-control bg-primary text-white" name="is_submit" value="1">Сохранить</button>
			</form>
		</div>
	</div>
</div>
