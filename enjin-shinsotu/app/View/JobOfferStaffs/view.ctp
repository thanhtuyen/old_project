<div class="jobOfferStaffs view">
<h2><?php echo __('Job Offer Staff'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($jobOfferStaff['JobOfferStaff']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Job Votes'); ?></dt>
		<dd>
			<?php echo $this->Html->link($jobOfferStaff['JobVote']['title'], array('controller' => 'job_votes', 'action' => 'view', $jobOfferStaff['JobVote']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Recruiter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($jobOfferStaff['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $jobOfferStaff['RecRecruiter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Modified Recruiter Id'); ?></dt>
		<dd>
			<?php echo h($jobOfferStaff['JobOfferStaff']['last_modified_recruiter_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($jobOfferStaff['JobOfferStaff']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($jobOfferStaff['JobOfferStaff']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($jobOfferStaff['JobOfferStaff']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
