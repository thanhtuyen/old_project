<div class="recCompanies index">
	<h2><?php echo __('Rec Companies'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('company_name'); ?></th>
			<th><?php echo $this->Paginator->sort('prefecture_id'); ?></th>
			<th><?php echo $this->Paginator->sort('city_id'); ?></th>
			<th><?php echo $this->Paginator->sort('remark'); ?></th>
			<th><?php echo $this->Paginator->sort('deadline'); ?></th>
			<th><?php echo $this->Paginator->sort('establish_date'); ?></th>
			<th><?php echo $this->Paginator->sort('represent_tel'); ?></th>
			<th><?php echo $this->Paginator->sort('represent_mail'); ?></th>
			<th><?php echo $this->Paginator->sort('employee'); ?></th>
			<th><?php echo $this->Paginator->sort('figure'); ?></th>
			<th><?php echo $this->Paginator->sort('business_id'); ?></th>
			<th><?php echo $this->Paginator->sort('average_salary'); ?></th>
			<th><?php echo $this->Paginator->sort('average_age'); ?></th>
			<th><?php echo $this->Paginator->sort('market_id'); ?></th>
			<th><?php echo $this->Paginator->sort('smtp_address'); ?></th>
			<th><?php echo $this->Paginator->sort('smtp_id'); ?></th>
			<th><?php echo $this->Paginator->sort('smtp_password'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('fac_manager_id'); ?></th>
			<th><?php echo $this->Paginator->sort('api_key'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($recCompanies as $recCompany): ?>
	<tr>
		<td><?php echo h($recCompany['RecCompany']['id']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['company_name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($recCompany['Prefecture']['name'], array('controller' => 'prefectures', 'action' => 'view', $recCompany['Prefecture']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($recCompany['City']['name'], array('controller' => 'cities', 'action' => 'view', $recCompany['City']['id'])); ?>
		</td>
		<td><?php echo h($recCompany['RecCompany']['remark']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['deadline']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['establish_date']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['represent_tel']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['represent_mail']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['employee']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['figure']); ?>&nbsp;</td>
		<td><?php echo h($addBusiness[$recCompany['RecCompany']['business_id']]); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['average_salary']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['average_age']); ?>&nbsp;</td>
		<td><?php echo h($addMarket[$recCompany['RecCompany']['market_id']]); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['smtp_address']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['smtp_id']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['smtp_password']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['status']); ?>&nbsp;</td>
		<td>
                    <?php echo $this->Html->link($recCompany['FacManager']['name'], array('controller' => 'fac_managers', 'action' => 'view', $recCompany['FacManager']['id'])); ?>
                </td>
		<td><?php echo h($addMarket[$recCompany['RecCompany']['market_id']]); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['api_key']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['created']); ?>&nbsp;</td>
		<td><?php echo h($recCompany['RecCompany']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $recCompany['RecCompany']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $recCompany['RecCompany']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $recCompany['RecCompany']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $recCompany['RecCompany']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
