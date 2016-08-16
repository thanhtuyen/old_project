<div class="levels form">
<?php echo $this->Form->create('Level'); ?>
	<fieldset>
		<legend><?php echo __('Edit Level'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
