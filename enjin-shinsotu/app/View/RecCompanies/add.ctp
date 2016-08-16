<?php
//CSS
echo $this->Html->css('plugins/clockpicker/clockpicker');

echo $this->element('back_nav', array('text' => __('Rec company Add'), 'noBtn' => true))?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix">
	<!-- content -->
	<div class='full-content'>
		<div class='col-lg-8'>
			<div class='ibox'>
				<div class="ibox-title">
					<h5>Rec company add</h5>
				</div>
				<!-- form add -->
				<div class="ibox-content bg-white p-sm">
					<?php echo $this->Form->create('RecCompany',array('class'=>'form-horizontal form-edit')); ?>
					<?php //echo $this->Form->input('id'); ?>
					<div class="form-group"><label class="col-sm-4 control-label">company name</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">prefecture id</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">City</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">remark</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">deadline</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">establish date</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">represent tel</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">represent mail</label>
						<div class="col-sm-8">
							<?php
							echo $this->Form->input('represent_mail',
								array(
									'type' => 'email',
									'class' => 'form-control',
									'div' => false, 'label' => false
								));
							?>
						</div>
					</div>
					<div class="form-group"><label class="col-sm-4 control-label">employee</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">figure</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">business id</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">average salary</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">average age</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">market id</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">smtp address</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">smtp id</label>
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
					<div class="form-group"><label class="col-sm-4 control-label">smtp_password</label>
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
