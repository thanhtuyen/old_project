<div class="cities view">
<h2><?php echo __('City'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($city['City']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($city['City']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Iso Id'); ?></dt>
		<dd>
			<?php echo h($city['City']['iso_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($city['City']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($city['City']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($city['City']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prefecture'); ?></dt>
		<dd>
			<?php echo $this->Html->link($city['Prefecture']['name'], array('controller' => 'prefectures', 'action' => 'view', $city['Prefecture']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Rec Companies'); ?></h3>
	<?php if (!empty($city['RecCompany'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Company Name'); ?></th>
		<th><?php echo __('Prefecture Id'); ?></th>
		<th><?php echo __('City Id'); ?></th>
		<th><?php echo __('Remark'); ?></th>
		<th><?php echo __('Deadline'); ?></th>
		<th><?php echo __('Establish Date'); ?></th>
		<th><?php echo __('Represent Tel'); ?></th>
		<th><?php echo __('Represent Mail'); ?></th>
		<th><?php echo __('Employee'); ?></th>
		<th><?php echo __('Figure'); ?></th>
		<th><?php echo __('Business Id'); ?></th>
		<th><?php echo __('Average Salary'); ?></th>
		<th><?php echo __('Average Age'); ?></th>
		<th><?php echo __('Market Id'); ?></th>
		<th><?php echo __('Smtp Address'); ?></th>
		<th><?php echo __('Smtp Id'); ?></th>
		<th><?php echo __('Smtp Password'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Fac Manager Id'); ?></th>
		<th><?php echo __('Api Key'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($city['RecCompany'] as $recCompany): ?>
		<tr>
			<td><?php echo $recCompany['id']; ?></td>
			<td><?php echo $recCompany['company_name']; ?></td>
			<td><?php echo $recCompany['prefecture_id']; ?></td>
			<td><?php echo $recCompany['city_id']; ?></td>
			<td><?php echo $recCompany['remark']; ?></td>
			<td><?php echo $recCompany['deadline']; ?></td>
			<td><?php echo $recCompany['establish_date']; ?></td>
			<td><?php echo $recCompany['represent_tel']; ?></td>
			<td><?php echo $recCompany['represent_mail']; ?></td>
			<td><?php echo $recCompany['employee']; ?></td>
			<td><?php echo $recCompany['figure']; ?></td>
			<td><?php echo $recCompany['business_id']; ?></td>
			<td><?php echo $recCompany['average_salary']; ?></td>
			<td><?php echo $recCompany['average_age']; ?></td>
			<td><?php echo $recCompany['market_id']; ?></td>
			<td><?php echo $recCompany['smtp_address']; ?></td>
			<td><?php echo $recCompany['smtp_id']; ?></td>
			<td><?php echo $recCompany['smtp_password']; ?></td>
			<td><?php echo $recCompany['status']; ?></td>
			<td><?php echo $recCompany['fac_manager_id']; ?></td>
			<td><?php echo $recCompany['api_key']; ?></td>
			<td><?php echo $recCompany['created']; ?></td>
			<td><?php echo $recCompany['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'rec_companies', 'action' => 'view', $recCompany['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'rec_companies', 'action' => 'edit', $recCompany['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'rec_companies', 'action' => 'delete', $recCompany['id']), array(), __('Are you sure you want to delete # %s?', $recCompany['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Referer Companies'); ?></h3>
	<?php if (!empty($city['RefererCompany'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Influx Original Type'); ?></th>
		<th><?php echo __('Prefecture Id'); ?></th>
		<th><?php echo __('City Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($city['RefererCompany'] as $refererCompany): ?>
		<tr>
			<td><?php echo $refererCompany['id']; ?></td>
			<td><?php echo $refererCompany['name']; ?></td>
			<td><?php echo $refererCompany['rec_company_id']; ?></td>
			<td><?php echo $refererCompany['influx_original_type']; ?></td>
			<td><?php echo $refererCompany['prefecture_id']; ?></td>
			<td><?php echo $refererCompany['city_id']; ?></td>
			<td><?php echo $refererCompany['rec_recruiter_id']; ?></td>
			<td><?php echo $refererCompany['status']; ?></td>
			<td><?php echo $refererCompany['created']; ?></td>
			<td><?php echo $refererCompany['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'referer_companies', 'action' => 'view', $refererCompany['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'referer_companies', 'action' => 'edit', $refererCompany['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'referer_companies', 'action' => 'delete', $refererCompany['id']), array(), __('Are you sure you want to delete # %s?', $refererCompany['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
