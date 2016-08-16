<div class="infJobVotePublics view">
<h2><?php echo __('Inf Job Vote Public'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($infJobVotePublic['InfJobVotePublic']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Job Vote'); ?></dt>
		<dd>
			<?php echo $this->Html->link($infJobVotePublic['JobVote']['title'], array('controller' => 'job_votes', 'action' => 'view', $infJobVotePublic['JobVote']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Referer Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($infJobVotePublic['RefererCompany']['name'], array('controller' => 'referer_companies', 'action' => 'view', $infJobVotePublic['RefererCompany']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inf Contract'); ?></dt>
		<dd>
			<?php echo $this->Html->link($infJobVotePublic['InfContract']['title'], array('controller' => 'inf_contracts', 'action' => 'view', $infJobVotePublic['InfContract']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($infJobVotePublic['InfJobVotePublic']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Recruiter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($infJobVotePublic['RecRecruiter']['id'], array('controller' => 'rec_recruiters', 'action' => 'view', $infJobVotePublic['RecRecruiter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($infJobVotePublic['InfJobVotePublic']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($infJobVotePublic['InfJobVotePublic']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($infJobVotePublic['InfJobVotePublic']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
