<div class="canQualifications form">
<?php echo $this->Form->create('CanQualification'); ?>
	<fieldset>
		<legend><?php echo __('Add Can Qualification'); ?></legend>
	<?php
		echo $this->Form->input('can_candidate_id');
		echo $this->Form->input('qualification_id');
		echo $this->Form->input('qualification',array('type' => 'text'));
		echo $this->Form->input('score');
		echo $this->Form->input('acquisition_date');
		echo $this->Form->input('status', array( 'options' => $selStatus ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
