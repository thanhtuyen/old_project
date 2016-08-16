<?php
//what:tailored

//CSS
echo $this->Html->css('enjin/page26_08');
//---checkboxes---
echo $this->Html->css('plugins/switchery/switchery');

echo $this->element('back_nav', array('text' => __('選考段階'), 'noBtn' => true))?>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-8">
			<div class="ibox">
				<div class="ibox-title">
					<?php
//h5:選考段階マスタ?>
				<h5><?php echo __('選考段階マスタ')?></h5>
				</div>

<?php echo $this->Form->create('ScreeningStage'); ?>
				<div class="ibox-content bg-white p-sm table-reponsive">
					<table class="table table-bordered bg-white">
						<thead>
							<tr>
								<th class="col-sm-2">
									<?php echo __('順番')?>
								</th>
								<th class="col-sm-3">
									<?php echo __('選考段階名')?>
								</th>
								<th class="col-sm-4">
									<?php echo __('選考概要')?>
								</th>
								<th class="col-sm-2">
									<?php echo __('有効フラグ')?>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$idx=0;//input indexes
							$last=end($screeningStages);
							$lastOrder=$last['ScreeningStage']['order'];

							?>
							<?php foreach ($screeningStages as $screeningStage)://exist rows
								$screeningStage = $screeningStage['ScreeningStage'];
								$order = $screeningStage['order'];
								//last_select_flag
								if($screeningStage['last_select_flag'])
									break;
							?>
				<tr>
					<td>
						<?php echo $order; ?>
						<?php echo $this->Form->input($idx. '.ScreeningStage.order',
						array('type' => 'hidden'));?>
					</td>

					<td><?php echo $this->Form->input($idx. '.ScreeningStage.name',
					array('label' => false, 'div' => false, 'class' => 'form-control'));?></td>
					<td class="w100"><?php echo $this->Form->input($idx. '.ScreeningStage.select_overview',
					array('label' => false, 'div' => false, 'class' => 'form-control'));?></td>
					<td><?php echo $this->Form->checkbox($idx. '.ScreeningStage.status',
					array('hiddenField' => false, 'class' => 'js-switch', 'checked' => $status[$screeningStage['status']]));?>
					<?php echo $this->Form->input($idx. '.ScreeningStage.id', array('type' => 'hidden'));?>
					</td>
				</tr>
				<?php $idx++; ?>
				<?php endforeach; ?>
				<?php while($order < 10){//disabled rows?>
				<tr>
					<td>
						<?php echo $order;?>
					</td>
					<td><input class="form-control" disabled></td>
					<td class="w100"><input class="form-control" disabled></td>
					<td><?php echo $this->Form->checkbox('dummy',
					array('hiddenField' => false, 'class' => 'js-switch', 'disabled' => true));?></td>
				</tr>
				<?php $order++;}?>
				<?php if($last['ScreeningStage']['last_select_flag'])://last row?>
				<tr>
					<td class="color_red">
						<?php echo h('最終'); ?>
						<?php echo $this->Form->input($idx. '.ScreeningStage.order',
						array('type' => 'hidden'));?>
					</td>

					<td><?php echo $this->Form->input($idx. '.ScreeningStage.name',
					array('label' => false, 'div' => false, 'class' => 'form-control'));?></td>
					<td class="w100"><?php echo $this->Form->input($idx. '.ScreeningStage.select_overview',
					array('label' => false, 'div' => false, 'class' => 'form-control'));?></td>
					<td><?php echo $this->Form->checkbox($idx. '.ScreeningStage.status',
					array('hiddenField' => false, 'class' => 'js-switch', 'checked' => $status[$screeningStage['status']]));?>
					<?php echo $this->Form->input($idx. '.ScreeningStage.id', array('type' => 'hidden'));?>
					</td>
				</tr>
				<?php endif;?>
				</tbody>
				</table>

				<div class="btn-clear">
					<?php
					//a:キャンセル
					echo $this->Html->link(__('キャンセル'), array('controller' => 'screening_stages', 'action' => 'index'), array('class' => 'text-navy m-r-md'));
					//button:更 新
					?>

					<button class="btn btn-primary w-95" type="submit"><?php
					echo __('更新')?></button>
				</div>
				</div>
<?php echo $this->Form->end(); ?>
			</div><!-- end ibox -->
		</div><!-- end col -->
	</div><!-- end row -->
</div><!-- end .wrapper-content -->
<?php
//JS
//echo $this->Html->script('jquery-2.1.1');
//echo $this->Html->script('bootstrap.min');
echo $this->Html->script('plugins/switchery/switchery');
?>
<script>
$(document).ready(function(){
	$(".js-switch").each(function (){
		var tmp=new Switchery($(this)[0], { color: '#1AB394' });
	});
});
</script>