<div class="jobSelectTargets view">
<h2><?php echo __('Job Select Target'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($jobSelectTarget['JobSelectTarget']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Job Vote'); ?></dt>
		<dd>
			<?php echo $this->Html->link($jobSelectTarget['JobVote']['title'], array('controller' => 'job_votes', 'action' => 'view', $jobSelectTarget['JobVote']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attain Deadline Date'); ?></dt>
		<dd>
			<?php echo h($jobSelectTarget['JobSelectTarget']['attain_deadline_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Screening Stage'); ?></dt>
		<dd>
			<?php echo $this->Html->link($jobSelectTarget['ScreeningStage']['name'], array('controller' => 'screening_stages', 'action' => 'view', $jobSelectTarget['ScreeningStage']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Target Select Id'); ?></dt>
		<dd>
			<?php echo h($jobSelectTarget['JobSelectTarget']['target_select_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Select Judgment Type'); ?></dt>
		<dd>
			<?php echo h($jobSelectTarget['JobSelectTarget']['select_judgment_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Target Number'); ?></dt>
		<dd>
			<?php echo h($jobSelectTarget['JobSelectTarget']['target_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($jobSelectTarget['JobSelectTarget']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Recruiter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($jobSelectTarget['RecRecruiter']['name'], array('controller' => 'rec_recruiters', 'action' => 'view', $jobSelectTarget['RecRecruiter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($jobSelectTarget['JobSelectTarget']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($jobSelectTarget['JobSelectTarget']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
