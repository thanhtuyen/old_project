<div class="publicPrivateClasses form">
<?php echo $this->Form->create('PublicPrivateClass'); ?>
	<fieldset>
		<legend><?php echo __('Add Public Private Class'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
