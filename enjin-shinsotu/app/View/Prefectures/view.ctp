<div class="prefectures view">
<h2><?php echo __('Prefecture'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($prefecture['Prefecture']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($prefecture['Prefecture']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Iso Id'); ?></dt>
		<dd>
			<?php echo h($prefecture['Prefecture']['iso_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($prefecture['Prefecture']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($prefecture['Prefecture']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($prefecture['Prefecture']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Can Candidates'); ?></h3>
	<?php if (!empty($prefecture['CanCandidate'])): ?>
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
	<?php foreach ($prefecture['CanCandidate'] as $canCandidate): ?>
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
			<td><?php echo $canCandidate['lock_role_flag']; ?></td>
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
<div class="related">
	<h3><?php echo __('Related Rec Companies'); ?></h3>
	<?php if (!empty($prefecture['RecCompany'])): ?>
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
	<?php foreach ($prefecture['RecCompany'] as $recCompany): ?>
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
	<?php if (!empty($prefecture['RefererCompany'])): ?>
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
	<?php foreach ($prefecture['RefererCompany'] as $refererCompany): ?>
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
<div class="related">
	<h3><?php echo __('Related Cities'); ?></h3>
	<?php if (!empty($prefecture['City'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Iso Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Prefecture Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($prefecture['City'] as $city): ?>
		<tr>
			<td><?php echo $city['id']; ?></td>
			<td><?php echo $city['name']; ?></td>
			<td><?php echo $city['iso_id']; ?></td>
			<td><?php echo $city['status']; ?></td>
			<td><?php echo $city['created']; ?></td>
			<td><?php echo $city['modified']; ?></td>
			<td><?php echo $city['prefecture_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cities', 'action' => 'view', $city['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cities', 'action' => 'edit', $city['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cities', 'action' => 'delete', $city['id']), array(), __('Are you sure you want to delete # %s?', $city['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related School Initial Data'); ?></h3>
	<?php if (!empty($prefecture['SchoolInitialData'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('School Class Id'); ?></th>
		<th><?php echo __('Public Private Class Id'); ?></th>
		<th><?php echo __('School Rank'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Prefecture Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($prefecture['SchoolInitialData'] as $schoolInitialData): ?>
		<tr>
			<td><?php echo $schoolInitialData['id']; ?></td>
			<td><?php echo $schoolInitialData['name']; ?></td>
			<td><?php echo $schoolInitialData['school_class_id']; ?></td>
			<td><?php echo $schoolInitialData['public_private_class_id']; ?></td>
			<td><?php echo $schoolInitialData['school_rank']; ?></td>
			<td><?php echo $schoolInitialData['country_id']; ?></td>
			<td><?php echo $schoolInitialData['prefecture_id']; ?></td>
			<td><?php echo $schoolInitialData['status']; ?></td>
			<td><?php echo $schoolInitialData['created']; ?></td>
			<td><?php echo $schoolInitialData['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'school_initial_data', 'action' => 'view', $schoolInitialData['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'school_initial_data', 'action' => 'edit', $schoolInitialData['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'school_initial_data', 'action' => 'delete', $schoolInitialData['id']), array(), __('Are you sure you want to delete # %s?', $schoolInitialData['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Schools'); ?></h3>
	<?php if (!empty($prefecture['School'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('School Class Id'); ?></th>
		<th><?php echo __('Public Private Class Id'); ?></th>
		<th><?php echo __('School Rank'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Prefecture Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($prefecture['School'] as $school): ?>
		<tr>
			<td><?php echo $school['id']; ?></td>
			<td><?php echo $school['rec_company_id']; ?></td>
			<td><?php echo $school['name']; ?></td>
			<td><?php echo $school['school_class_id']; ?></td>
			<td><?php echo $school['public_private_class_id']; ?></td>
			<td><?php echo $school['school_rank']; ?></td>
			<td><?php echo $school['country_id']; ?></td>
			<td><?php echo $school['prefecture_id']; ?></td>
			<td><?php echo $school['rec_recruiter_id']; ?></td>
			<td><?php echo $school['status']; ?></td>
			<td><?php echo $school['created']; ?></td>
			<td><?php echo $school['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'schools', 'action' => 'view', $school['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'schools', 'action' => 'edit', $school['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'schools', 'action' => 'delete', $school['id']), array(), __('Are you sure you want to delete # %s?', $school['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
