<div class="countries view">
<h2><?php echo __('Country'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($country['Country']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($country['Country']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Iso Id'); ?></dt>
		<dd>
			<?php echo h($country['Country']['iso_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($country['Country']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($country['Country']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($country['Country']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Can Candidates'); ?></h3>
	<?php if (!empty($country['CanCandidate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Last Name Kana'); ?></th>
		<th><?php echo __('Last Name En'); ?></th>
		<th><?php echo __('Mid Name'); ?></th>
		<th><?php echo __('Mid Name En'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('First Name Kana'); ?></th>
		<th><?php echo __('First Name En'); ?></th>
		<th><?php echo __('Face Photo'); ?></th>
		<th><?php echo __('Mail Address'); ?></th>
		<th><?php echo __('Unique Id'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Tel'); ?></th>
		<th><?php echo __('Extension Number'); ?></th>
		<th><?php echo __('Direct Extension'); ?></th>
		<th><?php echo __('Cell Number'); ?></th>
		<th><?php echo __('Cell Mail'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Post Code'); ?></th>
		<th><?php echo __('Prefecture Id'); ?></th>
		<th><?php echo __('Residence'); ?></th>
		<th><?php echo __('Home Country Id'); ?></th>
		<th><?php echo __('Home Post Code'); ?></th>
		<th><?php echo __('Home Prefecture Id'); ?></th>
		<th><?php echo __('Home Residence'); ?></th>
		<th><?php echo __('Home Tel'); ?></th>
		<th><?php echo __('Birthday'); ?></th>
		<th><?php echo __('Sex'); ?></th>
		<th><?php echo __('Membership'); ?></th>
		<th><?php echo __('Referer Company Id'); ?></th>
		<th><?php echo __('Inf Contract Id'); ?></th>
		<th><?php echo __('Join Possible Date'); ?></th>
		<th><?php echo __('Mynavi Id'); ?></th>
		<th><?php echo __('Rikunavi Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Last Modified Type'); ?></th>
		<th><?php echo __('Inf Staff Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Bar Code Id'); ?></th>
		<th><?php echo __('Remark'); ?></th>
		<th><?php echo __('Updatable Flag'); ?></th>
		<th><?php echo __('Lock Flag'); ?></th>
		<th><?php echo __('Student Regist Date'); ?></th>
		<th><?php echo __('Student Modified Date'); ?></th>
		<th><?php echo __('Last Login Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($country['CanCandidate'] as $canCandidate): ?>
		<tr>
			<td><?php echo $canCandidate['id']; ?></td>
			<td><?php echo $canCandidate['last_name']; ?></td>
			<td><?php echo $canCandidate['last_name_kana']; ?></td>
			<td><?php echo $canCandidate['last_name_en']; ?></td>
			<td><?php echo $canCandidate['mid_name']; ?></td>
			<td><?php echo $canCandidate['mid_name_en']; ?></td>
			<td><?php echo $canCandidate['first_name']; ?></td>
			<td><?php echo $canCandidate['first_name_kana']; ?></td>
			<td><?php echo $canCandidate['first_name_en']; ?></td>
			<td><?php echo $canCandidate['face_photo']; ?></td>
			<td><?php echo $canCandidate['mail_address']; ?></td>
			<td><?php echo $canCandidate['unique_id']; ?></td>
			<td><?php echo $canCandidate['password']; ?></td>
			<td><?php echo $canCandidate['rec_company_id']; ?></td>
			<td><?php echo $canCandidate['tel']; ?></td>
			<td><?php echo $canCandidate['extension_number']; ?></td>
			<td><?php echo $canCandidate['direct_extension']; ?></td>
			<td><?php echo $canCandidate['cell_number']; ?></td>
			<td><?php echo $canCandidate['cell_mail']; ?></td>
			<td><?php echo $canCandidate['country_id']; ?></td>
			<td><?php echo $canCandidate['post_code']; ?></td>
			<td><?php echo $canCandidate['prefecture_id']; ?></td>
			<td><?php echo $canCandidate['residence']; ?></td>
			<td><?php echo $canCandidate['home_country_id']; ?></td>
			<td><?php echo $canCandidate['home_post_code']; ?></td>
			<td><?php echo $canCandidate['home_prefecture_id']; ?></td>
			<td><?php echo $canCandidate['home_residence']; ?></td>
			<td><?php echo $canCandidate['home_tel']; ?></td>
			<td><?php echo $canCandidate['birthday']; ?></td>
			<td><?php echo $canCandidate['sex']; ?></td>
			<td><?php echo $canCandidate['membership']; ?></td>
			<td><?php echo $canCandidate['referer_company_id']; ?></td>
			<td><?php echo $canCandidate['inf_contract_id']; ?></td>
			<td><?php echo $canCandidate['join_possible_date']; ?></td>
			<td><?php echo $canCandidate['mynavi_id']; ?></td>
			<td><?php echo $canCandidate['rikunavi_id']; ?></td>
			<td><?php echo $canCandidate['status']; ?></td>
			<td><?php echo $canCandidate['last_modified_type']; ?></td>
			<td><?php echo $canCandidate['inf_staff_id']; ?></td>
			<td><?php echo $canCandidate['rec_recruiter_id']; ?></td>
			<td><?php echo $canCandidate['bar_code_id']; ?></td>
			<td><?php echo $canCandidate['remark']; ?></td>
			<td><?php echo $canCandidate['updatable_flag']; ?></td>
			<td><?php echo $canCandidate['lock_id']; ?></td>
			<td><?php echo $canCandidate['student_regist_date']; ?></td>
			<td><?php echo $canCandidate['student_modified_date']; ?></td>
			<td><?php echo $canCandidate['last_login_date']; ?></td>
			<td><?php echo $canCandidate['created']; ?></td>
			<td><?php echo $canCandidate['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'can_candidates', 'action' => 'view', $canCandidate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'can_candidates', 'action' => 'edit', $canCandidate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'can_candidates', 'action' => 'delete', $canCandidate['id']), array(), __('Are you sure you want to delete # %s?', $canCandidate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
