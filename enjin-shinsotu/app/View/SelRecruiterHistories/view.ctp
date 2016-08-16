<div class="selRecruiterHistories view">
<h2><?php echo __('Sel Recruiter History'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($selRecruiterHistory['SelRecruiterHistory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sel History'); ?></dt>
		<dd>
			<?php echo $this->Html->link($selRecruiterHistory['SelHistory']['id'], array('controller' => 'sel_histories', 'action' => 'view', $selRecruiterHistory['SelHistory']['id'])); ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Rec Recruiter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($selRecruiterHistory['RecRecruiter']['name'], array('controller' => 'rec_recruiters', 'action' => 'view', $selRecruiterHistory['RecRecruiter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Assign Situation'); ?></dt>
		<dd>
			<?php echo h($assingSituations[$selRecruiterHistory['SelRecruiterHistory']['assign_situation_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evaluation Rank'); ?></dt>
		<dd>
			<?php echo h($selRecruiterHistory['SelRecruiterHistory']['evaluation_rank']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evaluation Score'); ?></dt>
		<dd>
			<?php echo h($selRecruiterHistory['SelRecruiterHistory']['evaluation_score']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evaluation Comment'); ?></dt>
		<dd>
			<?php echo h($selRecruiterHistory['SelRecruiterHistory']['evaluation_comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($selRecruiterHistory['SelRecruiterHistory']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($selRecruiterHistory['SelRecruiterHistory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($selRecruiterHistory['SelRecruiterHistory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
