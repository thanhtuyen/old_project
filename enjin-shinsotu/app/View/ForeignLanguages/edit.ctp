<div class="foreignLanguages form">
<?php echo $this->Form->create('ForeignLanguage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Foreign Language'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('status', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
