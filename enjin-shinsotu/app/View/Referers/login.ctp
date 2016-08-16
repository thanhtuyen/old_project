<div class="referers form">
<?php echo $this->Form->create('inf_staffs'); ?>
	<fieldset>
		<legend><?php echo __('Referer login'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
