<div class="canCustomAttributes view">
<h2><?php echo __('Can Custom Attribute'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($canCustomAttribute['CanCustomAttribute']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Can Candidate'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canCustomAttribute['CanCandidate']['name'], array('controller' => 'can_candidates', 'action' => 'view', $canCustomAttribute['CanCandidate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Can Custom Field'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canCustomAttribute['CanCustomField']['field_name'], array('controller' => 'can_custom_fields', 'action' => 'view', $canCustomAttribute['CanCustomField']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($canCustomAttribute['CanCustomAttribute']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($canCustomAttribute['CanCustomAttribute']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Recruiter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canCustomAttribute['RecRecruiter']['name'], array('controller' => 'rec_recruiters', 'action' => 'view', $canCustomAttribute['RecRecruiter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($canCustomAttribute['CanCustomAttribute']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($canCustomAttribute['CanCustomAttribute']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
