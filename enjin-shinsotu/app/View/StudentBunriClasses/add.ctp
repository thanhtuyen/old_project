<div class="studentBunriClasses form">
<?php echo $this->Form->create('StudentBunriClass'); ?>
	<fieldset>
		<legend><?php echo __('Add Student Bunri Class'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
