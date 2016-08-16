<div class="cities form">
<?php echo $this->Form->create('City'); ?>
	<fieldset>
		<legend><?php echo __('Add City'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('iso_id');
		echo $this->Form->input('status');
		echo $this->Form->input('prefecture_id', array( 'options' => $status ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
