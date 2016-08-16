<div class="recCompanies view">
<h2><?php echo __('Rec Company'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Name'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['company_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prefecture'); ?></dt>
		<dd>
			<?php echo $this->Html->link($recCompany['Prefecture']['name'], array('controller' => 'prefectures', 'action' => 'view', $recCompany['Prefecture']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo $this->Html->link($recCompany['City']['name'], array('controller' => 'cities', 'action' => 'view', $recCompany['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remark'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['remark']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deadline'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['deadline']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Establish Date'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['establish_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Represent Tel'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['represent_tel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Represent Mail'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['represent_mail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Employee'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['employee']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Figure'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['figure']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Business'); ?></dt>
		<dd>
			<?php echo h($addBusiness[$recCompany['RecCompany']['business_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Average Salary'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['average_salary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Average Age'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['average_age']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market'); ?></dt>
		<dd>
			<?php echo h($addMarket[$recCompany['RecCompany']['market_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Smtp Address'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['smtp_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Smtp Id'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['smtp_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Smtp Password'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['smtp_password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fac Manager'); ?></dt>
		<dd>
			<?php echo $this->Html->link($recCompany['FacManager']['name'], array('controller' => 'fac_managers', 'action' => 'view', $recCompany['FacManager']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Api Key'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['api_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($recCompany['RecCompany']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Can Candidates'); ?></h3>
	<?php if (!empty($recCompany['CanCandidate'])): ?>
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
	<?php foreach ($recCompany['CanCandidate'] as $canCandidate): ?>
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
	<h3><?php echo __('Related Can Custom Fields'); ?></h3>
	<?php if (!empty($recCompany['CanCustomField'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Field Name'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recCompany['CanCustomField'] as $canCustomField): ?>
		<tr>
			<td><?php echo $canCustomField['id']; ?></td>
			<td><?php echo $canCustomField['created']; ?></td>
			<td><?php echo $canCustomField['modified']; ?></td>
			<td><?php echo $canCustomField['field_name']; ?></td>
			<td><?php echo $canCustomField['rec_company_id']; ?></td>
			<td><?php echo $canCustomField['rec_recruiter_id']; ?></td>
			<td><?php echo $canCustomField['type']; ?></td>
			<td><?php echo $canCustomField['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'can_custom_fields', 'action' => 'view', $canCustomField['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'can_custom_fields', 'action' => 'edit', $canCustomField['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'can_custom_fields', 'action' => 'delete', $canCustomField['id']), array(), __('Are you sure you want to delete # %s?', $canCustomField['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Ev Events'); ?></h3>
	<?php if (!empty($recCompany['EvEvent'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Job Vote Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Screening Stage Id'); ?></th>
		<th><?php echo __('Screening Stage Type'); ?></th>
		<th><?php echo __('Target Select Id'); ?></th>
		<th><?php echo __('Contents'); ?></th>
		<th><?php echo __('Rikunavi Id'); ?></th>
		<th><?php echo __('Mynavi Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recCompany['EvEvent'] as $evEvent): ?>
		<tr>
			<td><?php echo $evEvent['id']; ?></td>
			<td><?php echo $evEvent['name']; ?></td>
			<td><?php echo $evEvent['rec_company_id']; ?></td>
			<td><?php echo $evEvent['job_vote_id']; ?></td>
			<td><?php echo $evEvent['type']; ?></td>
			<td><?php echo $evEvent['screening_stage_id']; ?></td>
			<td><?php echo $evEvent['screening_stage_type']; ?></td>
			<td><?php echo $evEvent['target_select_id']; ?></td>
			<td><?php echo $evEvent['contents']; ?></td>
			<td><?php echo $evEvent['rikunavi_id']; ?></td>
			<td><?php echo $evEvent['mynavi_id']; ?></td>
			<td><?php echo $evEvent['status']; ?></td>
			<td><?php echo $evEvent['created']; ?></td>
			<td><?php echo $evEvent['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'ev_events', 'action' => 'view', $evEvent['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ev_events', 'action' => 'edit', $evEvent['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ev_events', 'action' => 'delete', $evEvent['id']), array(), __('Are you sure you want to delete # %s?', $evEvent['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Mail Templates'); ?></h3>
	<?php if (!empty($recCompany['MailTemplate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Template'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Ev Event Id'); ?></th>
		<th><?php echo __('Job Vote Id'); ?></th>
		<th><?php echo __('Screening Stage Id'); ?></th>
		<th><?php echo __('Purpose Id'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recCompany['MailTemplate'] as $mailTemplate): ?>
		<tr>
			<td><?php echo $mailTemplate['id']; ?></td>
			<td><?php echo $mailTemplate['template']; ?></td>
			<td><?php echo $mailTemplate['subject']; ?></td>
			<td><?php echo $mailTemplate['body']; ?></td>
			<td><?php echo $mailTemplate['ev_event_id']; ?></td>
			<td><?php echo $mailTemplate['job_vote_id']; ?></td>
			<td><?php echo $mailTemplate['screening_stage_id']; ?></td>
			<td><?php echo $mailTemplate['purpose_id']; ?></td>
			<td><?php echo $mailTemplate['rec_company_id']; ?></td>
			<td><?php echo $mailTemplate['rec_recruiter_id']; ?></td>
			<td><?php echo $mailTemplate['status']; ?></td>
			<td><?php echo $mailTemplate['created']; ?></td>
			<td><?php echo $mailTemplate['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'mail_templates', 'action' => 'view', $mailTemplate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'mail_templates', 'action' => 'edit', $mailTemplate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'mail_templates', 'action' => 'delete', $mailTemplate['id']), array(), __('Are you sure you want to delete # %s?', $mailTemplate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Rec Departments'); ?></h3>
	<?php if (!empty($recCompany['RecDepartment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Department Name'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Hr Flag'); ?></th>
		<th><?php echo __('Fac Manager Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recCompany['RecDepartment'] as $recDepartment): ?>
		<tr>
			<td><?php echo $recDepartment['id']; ?></td>
			<td><?php echo $recDepartment['department_name']; ?></td>
			<td><?php echo $recDepartment['parent_id']; ?></td>
			<td><?php echo $recDepartment['rec_company_id']; ?></td>
			<td><?php echo $recDepartment['hr_flag']; ?></td>
			<td><?php echo $recDepartment['fac_manager_id']; ?></td>
			<td><?php echo $recDepartment['status']; ?></td>
			<td><?php echo $recDepartment['created']; ?></td>
			<td><?php echo $recDepartment['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'rec_departments', 'action' => 'view', $recDepartment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'rec_departments', 'action' => 'edit', $recDepartment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'rec_departments', 'action' => 'delete', $recDepartment['id']), array(), __('Are you sure you want to delete # %s?', $recDepartment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Recruitment Areas'); ?></h3>
	<?php if (!empty($recCompany['RecruitmentArea'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Area'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recCompany['RecruitmentArea'] as $recruitmentArea): ?>
		<tr>
			<td><?php echo $recruitmentArea['id']; ?></td>
			<td><?php echo $recruitmentArea['area']; ?></td>
			<td><?php echo $recruitmentArea['rec_company_id']; ?></td>
			<td><?php echo $recruitmentArea['status']; ?></td>
			<td><?php echo $recruitmentArea['created']; ?></td>
			<td><?php echo $recruitmentArea['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'recruitment_areas', 'action' => 'view', $recruitmentArea['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'recruitment_areas', 'action' => 'edit', $recruitmentArea['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'recruitment_areas', 'action' => 'delete', $recruitmentArea['id']), array(), __('Are you sure you want to delete # %s?', $recruitmentArea['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Referer Companies'); ?></h3>
	<?php if (!empty($recCompany['RefererCompany'])): ?>
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
	<?php foreach ($recCompany['RefererCompany'] as $refererCompany): ?>
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
	<h3><?php echo __('Related Schools'); ?></h3>
	<?php if (!empty($recCompany['School'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('School Class Id'); ?></th>
		<th><?php echo __('Public Private Class Id'); ?></th>
		<th><?php echo __('School Rank'); ?></th>
		<th><?php echo __('Prefecture Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recCompany['School'] as $school): ?>
		<tr>
			<td><?php echo $school['id']; ?></td>
			<td><?php echo $school['rec_company_id']; ?></td>
			<td><?php echo $school['name']; ?></td>
			<td><?php echo $school['school_class_id']; ?></td>
			<td><?php echo $school['public_private_class_id']; ?></td>
			<td><?php echo $school['school_rank']; ?></td>
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
<div class="related">
	<h3><?php echo __('Related Screening Stages'); ?></h3>
	<?php if (!empty($recCompany['ScreeningStage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Order'); ?></th>
		<th><?php echo __('Last Select Flag'); ?></th>
		<th><?php echo __('Select Overview'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recCompany['ScreeningStage'] as $screeningStage): ?>
		<tr>
			<td><?php echo $screeningStage['id']; ?></td>
			<td><?php echo $screeningStage['name']; ?></td>
			<td><?php echo $screeningStage['order']; ?></td>
			<td><?php echo $screeningStage['last_select_flag']; ?></td>
			<td><?php echo $screeningStage['select_overview']; ?></td>
			<td><?php echo $screeningStage['rec_company_id']; ?></td>
			<td><?php echo $screeningStage['rec_recruiter_id']; ?></td>
			<td><?php echo $screeningStage['status']; ?></td>
			<td><?php echo $screeningStage['created']; ?></td>
			<td><?php echo $screeningStage['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'screening_stages', 'action' => 'view', $screeningStage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'screening_stages', 'action' => 'edit', $screeningStage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'screening_stages', 'action' => 'delete', $screeningStage['id']), array(), __('Are you sure you want to delete # %s?', $screeningStage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related System Mail Templates'); ?></h3>
	<?php if (!empty($recCompany['SystemMailTemplate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Template'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Ev Event Id'); ?></th>
		<th><?php echo __('Job Vote Id'); ?></th>
		<th><?php echo __('Screening Stage Id'); ?></th>
		<th><?php echo __('Purpose Id'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recCompany['SystemMailTemplate'] as $systemMailTemplate): ?>
		<tr>
			<td><?php echo $systemMailTemplate['id']; ?></td>
			<td><?php echo $systemMailTemplate['template']; ?></td>
			<td><?php echo $systemMailTemplate['subject']; ?></td>
			<td><?php echo $systemMailTemplate['body']; ?></td>
			<td><?php echo $systemMailTemplate['ev_event_id']; ?></td>
			<td><?php echo $systemMailTemplate['job_vote_id']; ?></td>
			<td><?php echo $systemMailTemplate['screening_stage_id']; ?></td>
			<td><?php echo $systemMailTemplate['purpose_id']; ?></td>
			<td><?php echo $systemMailTemplate['rec_company_id']; ?></td>
			<td><?php echo $systemMailTemplate['rec_recruiter_id']; ?></td>
			<td><?php echo $systemMailTemplate['status']; ?></td>
			<td><?php echo $systemMailTemplate['created']; ?></td>
			<td><?php echo $systemMailTemplate['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'system_mail_templates', 'action' => 'view', $systemMailTemplate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'system_mail_templates', 'action' => 'edit', $systemMailTemplate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'system_mail_templates', 'action' => 'delete', $systemMailTemplate['id']), array(), __('Are you sure you want to delete # %s?', $systemMailTemplate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Undergraduates'); ?></h3>
	<?php if (!empty($recCompany['Undergraduate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Rec Company Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Rec Recruiter Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recCompany['Undergraduate'] as $undergraduate): ?>
		<tr>
			<td><?php echo $undergraduate['id']; ?></td>
			<td><?php echo $undergraduate['rec_company_id']; ?></td>
			<td><?php echo $undergraduate['name']; ?></td>
			<td><?php echo $undergraduate['rec_recruiter_id']; ?></td>
			<td><?php echo $undergraduate['status']; ?></td>
			<td><?php echo $undergraduate['created']; ?></td>
			<td><?php echo $undergraduate['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'undergraduates', 'action' => 'view', $undergraduate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'undergraduates', 'action' => 'edit', $undergraduate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'undergraduates', 'action' => 'delete', $undergraduate['id']), array(), __('Are you sure you want to delete # %s?', $undergraduate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
