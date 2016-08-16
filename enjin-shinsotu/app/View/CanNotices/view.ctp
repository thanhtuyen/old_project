<div class="canNotices view">
<h2><?php echo __('Can Notice'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($canNotice['CanNotice']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Can Candidate'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canNotice['CanCandidate']['id'], array('controller' => 'can_candidates', 'action' => 'view', $canNotice['CanCandidate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notice'); ?></dt>
		<dd>
			<?php echo h($canNotice['CanNotice']['notice']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Register Type'); ?></dt>
		<dd>
			<?php echo h($canNotice['CanNotice']['register_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Recruiter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canNotice['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $canNotice['RecRecruiter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inf Staff'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canNotice['InfStaff']['id'], array('controller' => 'inf_staffs', 'action' => 'view', $canNotice['InfStaff']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($canNotice['CanNotice']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($canNotice['CanNotice']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($canNotice['CanNotice']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
