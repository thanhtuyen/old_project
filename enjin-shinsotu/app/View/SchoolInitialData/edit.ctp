<div class="schoolInitialData form">
<?php echo $this->Form->create('SchoolInitialData'); ?>
	<fieldset>
		<legend><?php echo __('Edit School Initial Data'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('school_class_id', array( 'options' => $schoolClass ));
		echo $this->Form->input('public_private_class_id', array( 'options' => $publicPrivateClass ));
		echo $this->Form->input('school_rank', array( 'options' => $schoolRank ));
		echo $this->Form->input('country_id');
		echo $this->Form->input('prefecture_id');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
