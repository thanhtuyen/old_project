<?php
//what:tailored

//CSS
echo $this->Html->css('enjin/page26_08');
//---checkboxes---
echo $this->Html->css('plugins/switchery/switchery');

//h2:選考段階
?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2><?php echo __('選考段階'); ?></h2>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	
	<div class="ibox clearfix no-margin-bottom">
		<div class="ibox-title col-lg-8">
			<?php
//h5:選考段階マスタ
			?>
			<h5><?php echo __('選考段階マスタ'); ?></h5>
			<div class="ibox-tools">
				<?php
//button:編集
				echo $this->Form->button(__('編集'), array('class' => 'btn btn-primary btn-xs', 'div' => false, 'label' => false, 'onclick' => "window.location.href='" .$this->Html->url(array(
					"controller" => "screening_stages",
					"action" => "edit")). "'"));
					?>
				</div>

			</div>
			<div class="ibox-content col-lg-8 bg-gray tb2 form-edit2 p-sm bg-white">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th>
								<?php echo $this->Paginator->sort('order', __('順番')); ?>
							</th>
							<th>
								<?php echo $this->Paginator->sort('name', __('選考段階名')); ?>
							</th>
							<th>
								<?php echo $this->Paginator->sort('select_overview', __('選考概要')); ?>
							</th>
						</tr>

					</thead>
					<tbody>
						<?php foreach ($screeningStages as $screeningStage): ?>
						<tr>
							<?php if($screeningStage['ScreeningStage']['last_select_flag']):?>
							<td class="color_red"><?php echo h('Last'); ?>&nbsp;</td><?php //最 終?>
						<?php else:?>
						<td><?php echo h($screeningStage['ScreeningStage']['order']); ?>&nbsp;</td>
					<?php endif;?>
					<td><?php echo h($screeningStage['ScreeningStage']['name']); ?>&nbsp;</td>
					<td><?php echo h($screeningStage['ScreeningStage']['select_overview']); ?>&nbsp;</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
</div>
</div><!-- end box .wrapper-content -->
<br><br>