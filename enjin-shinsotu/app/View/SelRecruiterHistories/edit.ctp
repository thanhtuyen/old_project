<div class="selRecruiterHistories form">
<?php echo $this->Form->create('SelRecruiterHistory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sel Recruiter History'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('sel_history_id');
		echo $this->Form->input('rec_recruiter_id');
		echo $this->Form->input('assign_situation_id', array( 'options' => $assingSituations ));
		echo $this->Form->input('evaluation_rank', array( 'options' => $evaluationRank ));
		echo $this->Form->input('evaluation_score');
		echo $this->Form->input('evaluation_comment');
		echo $this->Form->input('status', array( 'options' => $selStatus ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
