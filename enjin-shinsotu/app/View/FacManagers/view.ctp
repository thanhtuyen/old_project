<div class="facManagers view">
<h2><?php echo __('Fac Manager'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($facManager['FacManager']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($facManager['FacManager']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($facManager['FacManager']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mail'); ?></dt>
		<dd>
			<?php echo h($facManager['FacManager']['mail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($facManager['FacManager']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($facManager['FacManager']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fac Manager'); ?></dt>
		<dd>
			<?php echo $this->Html->link($facManager['FacManager']['fac_manager_id'], array('controller' => 'fac_managers', 'action' => 'view', $facManager['FacManager']['fac_manager_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Login Date'); ?></dt>
		<dd>
			<?php echo h($facManager['FacManager']['last_login_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($facManager['FacManager']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($facManager['FacManager']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
