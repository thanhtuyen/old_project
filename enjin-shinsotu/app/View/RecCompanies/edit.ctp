<?php
//CSS
echo $this->Html->css('plugins/clockpicker/clockpicker');
echo $this->element('back_nav', array('text' => __('Rec Company Edit'), 'noBtn' => true))?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix">
	<!-- content -->
	<div class='full-content'>
		<div class='col-lg-8'>
			<div class='ibox'>
				<div class="ibox-title">
					<h5>Rec Company Edit</h5>
				</div>
				<!-- form add -->
				<div class="ibox-content bg-white p-sm">
					<?php echo $this->Form->create('RecCompany',array('class'=>'form-horizontal form-edit')); ?>

					<?php echo $this->Form->input('id'); ?>
					<div class="form-group"><label class="col-sm-4 control-label">企業名</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('company_name',
								array(
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">都道府県</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('prefecture_id',
								array(
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">市区町村</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('city_id',
								array(
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">備考</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('remark',
								array(
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
<?php /*
					<div class="form-group"><label class="col-sm-4 control-label">契約期限</label>
						<div class="col-sm-8 clearfix data_1">
							<div class="input-group date f_left">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<?php
								echo $this->Form->input('deadline',
									array(
										'type' => 'text',
										'class' => 'form-control',
										'div' => false, 'label' => false
									));
								?>
							</div>
							<div class="input-group clockpicker f_right_calendar" data-autoclose="true">
								<span class="input-group-addon">
									<span class="fa fa-clock-o"></span>
								</span>
								<?php //extra field
								echo $this->Form->input('dl_time',
									array(
										'type' => 'text',
										'class' => 'form-control',
										'div' => false, 'label' => false
									));
								?>
							</div>
						</div>
					</div>
*/ ?>
					<div class="form-group"><label class="col-sm-4 control-label">設立年月日</label>
						<div class="col-sm-8 data_1">
							<div class="input-group date">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<?php
								echo $this->Form->input('establish_date',
									array(
										'type' => 'text',
										'class' => 'form-control',
										'div' => false, 'label' => false
									));
								?>
							</div>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">代表電話番号</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('represent_tel',
								array(
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">代表メールアドレス</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('represent_mail',
								array(
									'type' => 'mail',
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">従業員数</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('employee',
								array(
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">売上高</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('figure',
								array(
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">業種</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('business_id',
								array(
									'class' => 'form-control',
									'options' => $addBusiness,
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">平均年収</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('average_salary',
								array(
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">平均年齢</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('average_age',
								array(
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">市場</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('market_id',
								array(
									'class' => 'form-control',
									'options' => $addMarket,
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
<?php /*
					<div class="form-group"><label class="col-sm-4 control-label">SMTPサーバーアドレス</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('smtp_address',
								array(
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">SMTPサーバーID</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('smtp_id',
								array(
									'type' => 'text',
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">SMTPサーバーパスワード</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('smtp_password',
								array(
									'type' => 'text',
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
*/ ?> 
					<div class="btn-clear text-center">
						<?php //echo $this->Form->submit('クリア',array('type' => 'reset','class'=>'btn-hidden','id'=>'reset_data','div'=>false)); ?>
						<?php echo $this->Form->submit('登録する',array('class'=>'btn btn-primary btn-sm','div'=>false)); ?>
					</div>
					<?php echo $this->Form->end(); ?>
				</div>
				<!-- end form add -->
			</div>
		</div>
	</div><!--end .col-lg-8-->
</div>
<!-- end content -->
<?php
//JS
echo $this->Html->script('plugins/clockpicker/clockpicker');
?>
<script>
	$(document).ready(function () {
			// datepicker
			//already format yyy/mm/dd from layouts/default->kiwi.js
			$('.clockpicker').clockpicker();
		});
</script>
<?php

return;
//original?>
<div class="recCompanies form">
	<?php echo $this->Form->create('RecCompany'); ?>
	<fieldset>
		<legend><?php echo __('Add Rec Company'); ?></legend>
		<?php
		echo $this->Form->input('company_name');
		echo $this->Form->input('prefecture_id');
		echo $this->Form->input('city_id');
		echo $this->Form->input('remark');
		echo $this->Form->input('deadline');
		echo $this->Form->input('establish_date');
		echo $this->Form->input('represent_tel');
		echo $this->Form->input('represent_mail');
		echo $this->Form->input('employee');
		echo $this->Form->input('figure');
		echo $this->Form->input('business_id', array( 'options' => $addBusiness ));
		echo $this->Form->input('average_salary');
		echo $this->Form->input('average_age');
		echo $this->Form->input('market_id', array( 'options' => $addMarket ));
		echo $this->Form->input('smtp_address');
		echo $this->Form->input('smtp_id',array('type'=>'text'));
		echo $this->Form->input('smtp_password');
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>





<div class="recCompanies form">
<?php echo $this->Form->create('RecCompany'); ?>
	<fieldset>
		<legend><?php echo __('Edit Rec Company'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('company_name');
		echo $this->Form->input('prefecture_id');
		echo $this->Form->input('city_id');
		echo $this->Form->input('remark');
		echo $this->Form->input('deadline');
		echo $this->Form->input('establish_date');
		echo $this->Form->input('represent_tel');
		echo $this->Form->input('represent_mail');
		echo $this->Form->input('employee');
		echo $this->Form->input('figure');
		echo $this->Form->input('business_id', array( 'options' => $addBusiness ));
		echo $this->Form->input('average_salary');
		echo $this->Form->input('average_age');
		echo $this->Form->input('market_id', array( 'options' => $addMarket ));
		echo $this->Form->input('smtp_address');
		echo $this->Form->input('smtp_id');
		echo $this->Form->input('smtp_password');
		echo $this->Form->input('status', array( 'options' => $status ));
		echo $this->Form->input('fac_manager_id');
		echo $this->Form->input('api_key');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
