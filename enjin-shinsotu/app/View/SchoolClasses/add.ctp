<div class="schoolClasses form">
<?php echo $this->Form->create('SchoolClass'); ?>
	<fieldset>
		<legend><?php echo __('Add School Class'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
