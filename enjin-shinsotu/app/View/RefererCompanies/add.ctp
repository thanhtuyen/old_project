<?php echo $this->element('back_nav', array('text' => __('流入元企業追加')))?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
	<div class="full-content">
		<div class="col-lg-8">
			<div class="ibox">
				<!-- title -->
				<div class="ibox-title">
					<h5>流入元企業情報</h5>
			
				</div>

				<!-- content -->
				<div class="ibox-content bg-white p-sm clearfix">
					<div class="">
						<?php echo $this->Form->create('RefererCompany', array('class' => 'form-horizontal form-edit'))?>

							<div class="form-group">
								<label class="col-sm-4 control-label">企業名</label>
								<div class="col-sm-8">
									<div class="form-control border-none">
										<?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => false, 'div' => false))?>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">流人元タイプ</label>
								<div class="col-sm-8">
									<div class="form-control border-none">
										<?php echo $this->Form->input('influx_original_type', array('class' => 'btn btn-white', 'options' => $influxOriginalType, 'label' => false, 'div' => false))?>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">都道府県</label>
								<div class="col-sm-8">
									<div class="form-control border-none">
										<?php echo $this->Form->input('prefecture_id', array('class' => 'btn btn-white', 'label' => false, 'div' => false))?>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">市区町村</label>
								<div class="col-sm-8">
									<div class="form-control border-none">
										<?php echo $this->Form->input('city_id', array('class' => 'btn btn-white', 'label' => false, 'div' => false))?>
									</div>
								</div>
							</div>

							<div class="col-lg-12">
								<div class="tb-footer btn-clear text-center">
									<?php echo $this->Html->link(__('キャンセル'), array('action' => 'index'), array('class' => 'text-navy'))?>
									<button class="btn btn-primary w-95" id="btn-save" type="submit"><?php echo __('登録')?></button>
								</div>
							</div>
						</form>  
					</div> 
				</div>  
				<!-- end content -->
			</div>
		</div>
	</div>
</div>
<?php

return;
//original?>
<div class="refererCompanies form">
	<?php echo $this->Form->create('RefererCompany'); ?>
	<fieldset>
		<legend><?php echo __('Add Referer Company'); ?></legend>
		<?php
		echo $this->Form->input('name');
		echo $this->Form->input('influx_original_type', array( 'options' => $influxOriginalType ));
		echo $this->Form->input('prefecture_id');
		echo $this->Form->input('city_id');
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('status', array( 'options' => $refererStatus ));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
