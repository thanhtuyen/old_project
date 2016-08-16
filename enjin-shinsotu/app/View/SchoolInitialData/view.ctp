<div class="schoolInitialData view">
<h2><?php echo __('School Initial Data'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($schoolInitialData['SchoolInitialData']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($schoolInitialData['SchoolInitialData']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('School Class'); ?></dt>
		<dd>
			<?php echo h($schoolClass[$schoolInitialData['SchoolInitialData']['school_class_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Public Private Class'); ?></dt>
		<dd>
			<?php echo h($publicPrivateClass[$schoolInitialData['SchoolInitialData']['public_private_class_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('School Rank'); ?></dt>
		<dd>
			<?php echo h($schoolRank[$schoolInitialData['SchoolInitialData']['school_rank']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($schoolInitialData['Country']['name'], array('controller' => 'countries', 'action' => 'view', $schoolInitialData['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prefecture'); ?></dt>
		<dd>
			<?php echo $this->Html->link($schoolInitialData['Prefecture']['name'], array('controller' => 'prefectures', 'action' => 'view', $schoolInitialData['Prefecture']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($status[$schoolInitialData['SchoolInitialData']['status']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($schoolInitialData['SchoolInitialData']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($schoolInitialData['SchoolInitialData']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
