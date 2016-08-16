<div class="facManagers form">
<?php echo $this->Form->create('FacManager'); ?>
	<fieldset>
		<legend><?php echo __('Add Fac Manager'); ?></legend>
	<?php
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('mail');
		echo $this->Form->input('password');
		echo $this->Form->input('status', array( 'options' => $status ));
		echo $this->Form->input('last_login_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
