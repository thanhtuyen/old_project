<div class="manages form">
<?php echo $this->Form->create('fac_managers'); ?>
	<fieldset>
		<legend><?php echo __('Manage login'); ?></legend>
	<?php
		echo $this->Form->input('mail');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
