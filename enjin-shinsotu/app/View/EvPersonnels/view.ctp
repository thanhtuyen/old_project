<div class="evPersonnels view">
<h2><?php echo __('Ev Personnel'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($evPersonnel['EvPersonnel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ev Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evPersonnel['EvEvent']['name'], array('controller' => 'ev_events', 'action' => 'view', $evPersonnel['EvEvent']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Recruiter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evPersonnel['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $evPersonnel['RecRecruiter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($evPersonnel['EvPersonnel']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($evPersonnel['EvPersonnel']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($evPersonnel['EvPersonnel']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
