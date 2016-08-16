<div class="canDocuments view">
<h2><?php echo __('Can Document'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($canDocument['CanDocument']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Can Candidate'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canDocument['CanCandidate']['id'], array('controller' => 'can_candidates', 'action' => 'view', $canDocument['CanCandidate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ev History'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canDocument['EvHistory']['id'], array('controller' => 'ev_histories', 'action' => 'view', $canDocument['EvHistory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sel History'); ?></dt>
		<dd>
			<?php echo $this->Html->link($canDocument['SelHistory']['id'], array('controller' => 'sel_histories', 'action' => 'view', $canDocument['SelHistory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('File Name'); ?></dt>
		<dd>
			<?php echo h($canDocument['CanDocument']['file_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Extension'); ?></dt>
		<dd>
			<?php echo h($canDocument['CanDocument']['extension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Binary Data'); ?></dt>
		<dd>
			<?php echo h($canDocument['CanDocument']['binary_data']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($canDocument['CanDocument']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($canDocument['CanDocument']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($canDocument['CanDocument']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
