<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2><?php echo __('求人募集エリア')?></h2>
	</div>
</div>
<!--end header1-->

<!-- start contents -->
<div class="row wrapper wrapper-content animated fadeInRight title-button pd-bottom-none">
	<div class = "margin-top-5 col-lg-6">
		<div class="ibox">
			<div class="ibox-title">
				<h5><?php echo __('募集エリア')?></h5>
				<div class="ibox-tools">
					<?php echo $this->Html->link('編集', array('controller' =>
							'RecruitmentAreas', 'action' => 'edit'),array('class'=>'btn btn-primary btn-xs')); ?>
				</div>
			</div>
			<div class="ibox-content bg-white p-sm">
				<table class="table table-bordered no-margin-bottom table-center">
					<thead>
						<tr class = "">
							<th class = "t-align-left">エリアID</th>
							<th class="t-align-left">エリア名</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($recruitmentAreas as $recruitmentArea): ?>
						<tr>
							<td class="table-button-tdleft">
								<?php echo h($recruitmentArea['RecruitmentArea']['id']); ?>
							</td>
							<td class="table-button-tdleft text_left">
								<?php echo h($recruitmentArea['RecruitmentArea']['area']); ?>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- end contents -->

<?php return;?>
<div class="recruitmentAreas index">
	<h2><?php echo __('Recruitment Areas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('area'); ?></th>
				<th><?php echo $this->Paginator->sort('rec_company_id'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th><?php echo $this->Paginator->sort('modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($recruitmentAreas as $recruitmentArea): ?>
			<tr>
				<td><?php echo h($recruitmentArea['RecruitmentArea']['id']); ?>&nbsp;</td>
				<td><?php echo h($recruitmentArea['RecruitmentArea']['area']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($recruitmentArea['RecCompany']['id'], array('controller' => 'rec_companies', 'action' => 'view', $recruitmentArea['RecCompany']['id'])); ?>
				</td>
				<td><?php echo h($recruitmentArea['RecruitmentArea']['status']); ?>&nbsp;</td>
				<td><?php echo h($recruitmentArea['RecruitmentArea']['created']); ?>&nbsp;</td>
				<td><?php echo h($recruitmentArea['RecruitmentArea']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $recruitmentArea['RecruitmentArea']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $recruitmentArea['RecruitmentArea']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $recruitmentArea['RecruitmentArea']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $recruitmentArea['RecruitmentArea']['id']))); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<p>
		<?php
		echo $this->Paginator->counter(array(
				'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
		?></p>
	<div class="paging">
		<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>
</div>
