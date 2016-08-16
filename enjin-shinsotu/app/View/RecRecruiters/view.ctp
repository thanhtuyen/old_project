<?php
//tailored
$recRecruiter = $recRecruiter['RecRecruiter'];

$tel = $recRecruiter['tel'];
$xlength=strlen($tel);
$tel = substr( $tel, 0, 3 );
$tel = str_pad( $tel, $xlength, "x");

if(empty($recRecruiter['face_photo']))
$recRecruiter['face_photo'] = $this->webroot. 'img/bootstrap/icon_avatar.png';

//CSS
echo $this->Html->css('enjin/25_08_recruiters_details');

echo $this->element( 'back_nav',  array('text' => __('採用担当者詳細｜%d %s', $recRecruiter['id'], $recRecruiter['name']), 'noBtn' => true) );?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
	<div class="col-lg-8">
		<div class="ibox">
			<div class="ibox-title">
				<h5><?php echo __('求人票詳細')?></h5><?php //求人票詳細?>
				<div class="ibox-tools">
					<?php
					echo $this->Form->input(__('編集'),
						array('type' => 'button', 'class' => 'show-data btn btn-primary btn-xs', 'div' => false, 'label' => false, 'onclick' => "window.location.href='" .$this->Html->url(array(
									"controller" => "rec_recruiters",
									"action" => "edit", $recRecruiter['id'])). "'"));?><?php //編集?>
				</div>
			</div>
			<div class="ibox-content bg-white p-sm clearfix show-data">
				<div class="col-lg-2 m-t-lg">
					<?php echo $this->Html->image($recRecruiter['face_photo'], array('class' => 'img-reponsive center-block', 'alt' => __('顔写真'), 'width' => '100%'))?>
				</div>
				<div class="col-lg-10">
					<form method="get" class="form-horizontal" id="1156349976">
						<div class="row form-group">
							<label class="col-sm-4 control-label">採用担当者ID</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><?php echo $recRecruiter['id']?></div>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-4 control-label">名前</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><?php echo $recRecruiter['first_name']?> <?php echo $recRecruiter['last_name']?></div>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-4 control-label">部署</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><?php echo empty($recDepartments[$recRecruiter['rec_department_id']]) ? 'N/A' : $recDepartments[$recRecruiter['rec_department_id']]?></div>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-4 control-label">採用者タイプ</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><?php echo $focalPointType[$recRecruiter['focal_point_type']]?></div>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-4 control-label">メール</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><a class='text-navy' href="mailto:<?php echo $recRecruiter['mail']?>"><?php echo $recRecruiter['mail']?></a></div>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-4 control-label">パスワード</label>
							<div class="col-sm-8">
								<div class="form-control border-none">............</div>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-4 control-label">電話</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><?php echo $tel?></div>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-4 control-label">決裁者フラグ</label>
							<div class="col-sm-8">
								<div class="form-control border-none">
									<div class="switch">
										<div class="onoffswitch">
											<?php echo $this->Form->checkbox('approval_flag',
												array('hiddenField' => false, 'class' => 'onoffswitch-checkbox',
													'id' => 'cb1', 'checked' => $recRecruiter['approval_flag'] == 0))?>
											<label class="onoffswitch-label" for="cb1">
												<span class="onoffswitch-inner"></span>
												<span class="onoffswitch-switch"></span>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-sm-4 control-label">最終ログイン</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><?php echo $recRecruiter['last_login_date']?></div>
							</div>
						</div>                                      
					</form>
				</div>
			</div>   
		</div>
	</div>
</div>
<br>
<br>
<?php

return;
//original
?>
<div class="recRecruiters view">
	<h2><?php echo __('Rec Recruiter'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Focal Point Type'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['focal_point_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mail'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['mail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rec Department'); ?></dt>
		<dd>
			<?php echo $this->Html->link($recRecruiter['RecDepartment']['id'], array('controller' => 'rec_departments', 'action' => 'view', $recRecruiter['RecDepartment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Face Photo'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['face_photo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tel'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['tel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Approval Flag'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['approval_flag']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fac Manager'); ?></dt>
		<dd>
			<?php echo $this->Html->link($recRecruiter['FacManager']['id'], array('controller' => 'fac_managers', 'action' => 'view', $recRecruiter['FacManager']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Login Date'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['last_login_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($recRecruiter['RecRecruiter']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Can Candidates'); ?></h3>
	<?php if(!empty($recRecruiter['CanCandidate'])): ?>
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
		<?php foreach($recRecruiter['CanCandidate'] as $canCandidate): ?>
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
<div class="related">
	<h3><?php echo __('Related Can Custom Attributes'); ?></h3>
	<?php if(!empty($recRecruiter['CanCustomAttribute'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Can Candidate Id'); ?></th>
			<th><?php echo __('Can Custom Field Id'); ?></th>
			<th><?php echo __('Value'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Rec Recruiter Id'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($recRecruiter['CanCustomAttribute'] as $canCustomAttribute): ?>
		<tr>
			<td><?php echo $canCustomAttribute['id']; ?></td>
			<td><?php echo $canCustomAttribute['can_candidate_id']; ?></td>
			<td><?php echo $canCustomAttribute['can_custom_field_id']; ?></td>
			<td><?php echo $canCustomAttribute['value']; ?></td>
			<td><?php echo $canCustomAttribute['status']; ?></td>
			<td><?php echo $canCustomAttribute['rec_recruiter_id']; ?></td>
			<td><?php echo $canCustomAttribute['created']; ?></td>
			<td><?php echo $canCustomAttribute['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'can_custom_attributes', 'action' => 'view', $canCustomAttribute['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'can_custom_attributes', 'action' => 'edit', $canCustomAttribute['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'can_custom_attributes', 'action' => 'delete', $canCustomAttribute['id']), array(), __('Are you sure you want to delete # %s?', $canCustomAttribute['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Can Custom Fields'); ?></h3>
	<?php if(!empty($recRecruiter['CanCustomField'])): ?>
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
		<?php foreach($recRecruiter['CanCustomField'] as $canCustomField): ?>
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
	<h3><?php echo __('Related Can Notices'); ?></h3>
	<?php if(!empty($recRecruiter['CanNotice'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Can Candidate Id'); ?></th>
			<th><?php echo __('Notice'); ?></th>
			<th><?php echo __('Register Type'); ?></th>
			<th><?php echo __('Rec Recruiter Id'); ?></th>
			<th><?php echo __('Inf Staff Id'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($recRecruiter['CanNotice'] as $canNotice): ?>
		<tr>
			<td><?php echo $canNotice['id']; ?></td>
			<td><?php echo $canNotice['can_candidate_id']; ?></td>
			<td><?php echo $canNotice['notice']; ?></td>
			<td><?php echo $canNotice['register_type']; ?></td>
			<td><?php echo $canNotice['rec_recruiter_id']; ?></td>
			<td><?php echo $canNotice['inf_staff_id']; ?></td>
			<td><?php echo $canNotice['status']; ?></td>
			<td><?php echo $canNotice['created']; ?></td>
			<td><?php echo $canNotice['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'can_notices', 'action' => 'view', $canNotice['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'can_notices', 'action' => 'edit', $canNotice['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'can_notices', 'action' => 'delete', $canNotice['id']), array(), __('Are you sure you want to delete # %s?', $canNotice['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Ev Histories'); ?></h3>
	<?php if(!empty($recRecruiter['EvHistory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Can Candidate Id'); ?></th>
			<th><?php echo __('Ev Schedule Id'); ?></th>
			<th><?php echo __('After Score'); ?></th>
			<th><?php echo __('After Comment'); ?></th>
			<th><?php echo __('Rec Recruiter Id'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($recRecruiter['EvHistory'] as $evHistory): ?>
		<tr>
			<td><?php echo $evHistory['id']; ?></td>
			<td><?php echo $evHistory['can_candidate_id']; ?></td>
			<td><?php echo $evHistory['ev_schedule_id']; ?></td>
			<td><?php echo $evHistory['after_score']; ?></td>
			<td><?php echo $evHistory['after_comment']; ?></td>
			<td><?php echo $evHistory['rec_recruiter_id']; ?></td>
			<td><?php echo $evHistory['status']; ?></td>
			<td><?php echo $evHistory['created']; ?></td>
			<td><?php echo $evHistory['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'ev_histories', 'action' => 'view', $evHistory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ev_histories', 'action' => 'edit', $evHistory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ev_histories', 'action' => 'delete', $evHistory['id']), array(), __('Are you sure you want to delete # %s?', $evHistory['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Ev Personnels'); ?></h3>
	<?php if(!empty($recRecruiter['EvPersonnel'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Ev Event Id'); ?></th>
			<th><?php echo __('Rec Recruiter Id'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($recRecruiter['EvPersonnel'] as $evPersonnel): ?>
		<tr>
			<td><?php echo $evPersonnel['id']; ?></td>
			<td><?php echo $evPersonnel['ev_event_id']; ?></td>
			<td><?php echo $evPersonnel['rec_recruiter_id']; ?></td>
			<td><?php echo $evPersonnel['status']; ?></td>
			<td><?php echo $evPersonnel['created']; ?></td>
			<td><?php echo $evPersonnel['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'ev_personnels', 'action' => 'view', $evPersonnel['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ev_personnels', 'action' => 'edit', $evPersonnel['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ev_personnels', 'action' => 'delete', $evPersonnel['id']), array(), __('Are you sure you want to delete # %s?', $evPersonnel['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Inf Job Vote Publics'); ?></h3>
	<?php if(!empty($recRecruiter['InfJobVotePublic'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Job Vote Id'); ?></th>
			<th><?php echo __('Referer Company Id'); ?></th>
			<th><?php echo __('Inf Contract Id'); ?></th>
			<th><?php echo __('Start Date'); ?></th>
			<th><?php echo __('Rec Recruiter Id'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($recRecruiter['InfJobVotePublic'] as $infJobVotePublic): ?>
		<tr>
			<td><?php echo $infJobVotePublic['id']; ?></td>
			<td><?php echo $infJobVotePublic['job_vote_id']; ?></td>
			<td><?php echo $infJobVotePublic['referer_company_id']; ?></td>
			<td><?php echo $infJobVotePublic['inf_contract_id']; ?></td>
			<td><?php echo $infJobVotePublic['start_date']; ?></td>
			<td><?php echo $infJobVotePublic['rec_recruiter_id']; ?></td>
			<td><?php echo $infJobVotePublic['status']; ?></td>
			<td><?php echo $infJobVotePublic['created']; ?></td>
			<td><?php echo $infJobVotePublic['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'inf_job_vote_publics', 'action' => 'view', $infJobVotePublic['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'inf_job_vote_publics', 'action' => 'edit', $infJobVotePublic['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'inf_job_vote_publics', 'action' => 'delete', $infJobVotePublic['id']), array(), __('Are you sure you want to delete # %s?', $infJobVotePublic['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Inf Staffs'); ?></h3>
	<?php if(!empty($recRecruiter['InfStaff'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Last Name'); ?></th>
			<th><?php echo __('First Name'); ?></th>
			<th><?php echo __('Mail Address'); ?></th>
			<th><?php echo __('Unique Id'); ?></th>
			<th><?php echo __('Password'); ?></th>
			<th><?php echo __('Referer Company Id'); ?></th>
			<th><?php echo __('Tel'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Rec Recruiter Id'); ?></th>
			<th><?php echo __('Last Login Date'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($recRecruiter['InfStaff'] as $infStaff): ?>
		<tr>
			<td><?php echo $infStaff['id']; ?></td>
			<td><?php echo $infStaff['last_name']; ?></td>
			<td><?php echo $infStaff['first_name']; ?></td>
			<td><?php echo $infStaff['mail_address']; ?></td>
			<td><?php echo $infStaff['unique_id']; ?></td>
			<td><?php echo $infStaff['password']; ?></td>
			<td><?php echo $infStaff['referer_company_id']; ?></td>
			<td><?php echo $infStaff['tel']; ?></td>
			<td><?php echo $infStaff['status']; ?></td>
			<td><?php echo $infStaff['rec_recruiter_id']; ?></td>
			<td><?php echo $infStaff['last_login_date']; ?></td>
			<td><?php echo $infStaff['created']; ?></td>
			<td><?php echo $infStaff['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'inf_staffs', 'action' => 'view', $infStaff['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'inf_staffs', 'action' => 'edit', $infStaff['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'inf_staffs', 'action' => 'delete', $infStaff['id']), array(), __('Are you sure you want to delete # %s?', $infStaff['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Job Offer Staffs'); ?></h3>
	<?php if(!empty($recRecruiter['JobOfferStaff'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Job Votes Id'); ?></th>
			<th><?php echo __('Rec Recruiter Id'); ?></th>
			<th><?php echo __('Last Modified Recruiter Id'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($recRecruiter['JobOfferStaff'] as $jobOfferStaff): ?>
		<tr>
			<td><?php echo $jobOfferStaff['id']; ?></td>
			<td><?php echo $jobOfferStaff['job_vote_id']; ?></td>
			<td><?php echo $jobOfferStaff['rec_recruiter_id']; ?></td>
			<td><?php echo $jobOfferStaff['last_modified_recruiter_id']; ?></td>
			<td><?php echo $jobOfferStaff['status']; ?></td>
			<td><?php echo $jobOfferStaff['created']; ?></td>
			<td><?php echo $jobOfferStaff['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'job_offer_staffs', 'action' => 'view', $jobOfferStaff['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'job_offer_staffs', 'action' => 'edit', $jobOfferStaff['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'job_offer_staffs', 'action' => 'delete', $jobOfferStaff['id']), array(), __('Are you sure you want to delete # %s?', $jobOfferStaff['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Job Select Targets'); ?></h3>
	<?php if(!empty($recRecruiter['JobSelectTarget'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Job Vote Id'); ?></th>
			<th><?php echo __('Attain Deadline Date'); ?></th>
			<th><?php echo __('Screening Stage Id'); ?></th>
			<th><?php echo __('Target Select Id'); ?></th>
			<th><?php echo __('Select Judgment Type'); ?></th>
			<th><?php echo __('Target Number'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Rec Recruiter Id'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($recRecruiter['JobSelectTarget'] as $jobSelectTarget): ?>
		<tr>
			<td><?php echo $jobSelectTarget['id']; ?></td>
			<td><?php echo $jobSelectTarget['job_vote_id']; ?></td>
			<td><?php echo $jobSelectTarget['attain_deadline_date']; ?></td>
			<td><?php echo $jobSelectTarget['screening_stage_id']; ?></td>
			<td><?php echo $jobSelectTarget['target_select_id']; ?></td>
			<td><?php echo $jobSelectTarget['select_judgment_type']; ?></td>
			<td><?php echo $jobSelectTarget['target_number']; ?></td>
			<td><?php echo $jobSelectTarget['status']; ?></td>
			<td><?php echo $jobSelectTarget['rec_recruiter_id']; ?></td>
			<td><?php echo $jobSelectTarget['created']; ?></td>
			<td><?php echo $jobSelectTarget['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'job_select_targets', 'action' => 'view', $jobSelectTarget['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'job_select_targets', 'action' => 'edit', $jobSelectTarget['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'job_select_targets', 'action' => 'delete', $jobSelectTarget['id']), array(), __('Are you sure you want to delete # %s?', $jobSelectTarget['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Job Votes'); ?></h3>
	<?php if(!empty($recRecruiter['JobVote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Title'); ?></th>
			<th><?php echo __('Rec Department Id'); ?></th>
			<th><?php echo __('Requirement'); ?></th>
			<th><?php echo __('Jobtype Id'); ?></th>
			<th><?php echo __('Treatment'); ?></th>
			<th><?php echo __('Qualification Require'); ?></th>
			<th><?php echo __('Wanted Person'); ?></th>
			<th><?php echo __('Wanted Deadline'); ?></th>
			<th><?php echo __('Start Salary'); ?></th>
			<th><?php echo __('Start Date'); ?></th>
			<th><?php echo __('Recruitment Area Id'); ?></th>
			<th><?php echo __('Wanted Year'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Rikunavi Id'); ?></th>
			<th><?php echo __('Mynavi Id'); ?></th>
			<th><?php echo __('Rec Recruiter Id'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($recRecruiter['JobVote'] as $jobVote): ?>
		<tr>
			<td><?php echo $jobVote['id']; ?></td>
			<td><?php echo $jobVote['title']; ?></td>
			<td><?php echo $jobVote['rec_department_id']; ?></td>
			<td><?php echo $jobVote['requirement']; ?></td>
			<td><?php echo $jobVote['jobtype_id']; ?></td>
			<td><?php echo $jobVote['treatment']; ?></td>
			<td><?php echo $jobVote['qualification_require']; ?></td>
			<td><?php echo $jobVote['wanted_person']; ?></td>
			<td><?php echo $jobVote['wanted_deadline']; ?></td>
			<td><?php echo $jobVote['start_salary']; ?></td>
			<td><?php echo $jobVote['start_date']; ?></td>
			<td><?php echo $jobVote['recruitment_area_id']; ?></td>
			<td><?php echo $jobVote['wanted_year']; ?></td>
			<td><?php echo $jobVote['status']; ?></td>
			<td><?php echo $jobVote['rikunavi_id']; ?></td>
			<td><?php echo $jobVote['mynavi_id']; ?></td>
			<td><?php echo $jobVote['rec_recruiter_id']; ?></td>
			<td><?php echo $jobVote['created']; ?></td>
			<td><?php echo $jobVote['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'job_votes', 'action' => 'view', $jobVote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'job_votes', 'action' => 'edit', $jobVote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'job_votes', 'action' => 'delete', $jobVote['id']), array(), __('Are you sure you want to delete # %s?', $jobVote['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Mail Templates'); ?></h3>
	<?php if(!empty($recRecruiter['MailTemplate'])): ?>
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
		<?php foreach($recRecruiter['MailTemplate'] as $mailTemplate): ?>
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
	<h3><?php echo __('Related Ml Send Histories'); ?></h3>
	<?php if(!empty($recRecruiter['MlSendHistory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Send Mail Address'); ?></th>
			<th><?php echo __('Can Candidate Id'); ?></th>
			<th><?php echo __('Inf Staff Id'); ?></th>
			<th><?php echo __('Rec Recruiter Id'); ?></th>
			<th><?php echo __('Mail Template Id'); ?></th>
			<th><?php echo __('System Mail Template Id'); ?></th>
			<th><?php echo __('Send Recruiter Id'); ?></th>
			<th><?php echo __('Send Result'); ?></th>
			<th><?php echo __('Send Date'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($recRecruiter['MlSendHistory'] as $mlSendHistory): ?>
		<tr>
			<td><?php echo $mlSendHistory['id']; ?></td>
			<td><?php echo $mlSendHistory['send_mail_address']; ?></td>
			<td><?php echo $mlSendHistory['can_candidate_id']; ?></td>
			<td><?php echo $mlSendHistory['inf_staff_id']; ?></td>
			<td><?php echo $mlSendHistory['rec_recruiter_id']; ?></td>
			<td><?php echo $mlSendHistory['mail_template_id']; ?></td>
			<td><?php echo $mlSendHistory['system_mail_template_id']; ?></td>
			<td><?php echo $mlSendHistory['send_recruiter_id']; ?></td>
			<td><?php echo $mlSendHistory['send_result']; ?></td>
			<td><?php echo $mlSendHistory['send_date']; ?></td>
			<td><?php echo $mlSendHistory['created']; ?></td>
			<td><?php echo $mlSendHistory['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'ml_send_histories', 'action' => 'view', $mlSendHistory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ml_send_histories', 'action' => 'edit', $mlSendHistory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ml_send_histories', 'action' => 'delete', $mlSendHistory['id']), array(), __('Are you sure you want to delete # %s?', $mlSendHistory['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Referer Companies'); ?></h3>
	<?php if(!empty($recRecruiter['RefererCompany'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo __('Rec Company Id'); ?></th>
			<th><?php echo __('Influx Original Type'); ?></th>
			<th><?php echo __('Prefecture Id'); ?></th>
			<th><?php echo __('City Id'); ?></th>
			<th><?php echo __('Mycompany'); ?></th>
			<th><?php echo __('Rec Recruiter Id'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($recRecruiter['RefererCompany'] as $refererCompany): ?>
		<tr>
			<td><?php echo $refererCompany['id']; ?></td>
			<td><?php echo $refererCompany['name']; ?></td>
			<td><?php echo $refererCompany['rec_company_id']; ?></td>
			<td><?php echo $refererCompany['influx_original_type']; ?></td>
			<td><?php echo $refererCompany['prefecture_id']; ?></td>
			<td><?php echo $refererCompany['city_id']; ?></td>
			<td><?php echo $refererCompany['mycompany']; ?></td>
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
	<?php if(!empty($recRecruiter['School'])): ?>
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
		<?php foreach($recRecruiter['School'] as $school): ?>
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
<div class="related">
	<h3><?php echo __('Related Screening Stages'); ?></h3>
	<?php if(!empty($recRecruiter['ScreeningStage'])): ?>
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
		<?php foreach($recRecruiter['ScreeningStage'] as $screeningStage): ?>
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
	<h3><?php echo __('Related Sel Histories'); ?></h3>
	<?php if(!empty($recRecruiter['SelHistory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Job Vote Id'); ?></th>
			<th><?php echo __('Can Candidate Id'); ?></th>
			<th><?php echo __('Screening Stage Id'); ?></th>
			<th><?php echo __('Select Status Id'); ?></th>
			<th><?php echo __('Select Option Id'); ?></th>
			<th><?php echo __('Comment'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Visited Info'); ?></th>
			<th><?php echo __('Annual Income'); ?></th>
			<th><?php echo __('Start Date'); ?></th>
			<th><?php echo __('End Date'); ?></th>
			<th><?php echo __('Influx Propriety'); ?></th>
			<th><?php echo __('Candidate Propriety'); ?></th>
			<th><?php echo __('Last Modified Type'); ?></th>
			<th><?php echo __('Rec Recruiter Id'); ?></th>
			<th><?php echo __('Inf Staff Id'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach($recRecruiter['SelHistory'] as $selHistory): ?>
		<tr>
			<td><?php echo $selHistory['id']; ?></td>
			<td><?php echo $selHistory['job_vote_id']; ?></td>
			<td><?php echo $selHistory['can_candidate_id']; ?></td>
			<td><?php echo $selHistory['screening_stage_id']; ?></td>
			<td><?php echo $selHistory['select_status_id']; ?></td>
			<td><?php echo $selHistory['select_option_id']; ?></td>
			<td><?php echo $selHistory['comment']; ?></td>
			<td><?php echo $selHistory['status']; ?></td>
			<td><?php echo $selHistory['visited_info']; ?></td>
			<td><?php echo $selHistory['annual_income']; ?></td>
			<td><?php echo $selHistory['start_date']; ?></td>
			<td><?php echo $selHistory['end_date']; ?></td>
			<td><?php echo $selHistory['influx_propriety']; ?></td>
			<td><?php echo $selHistory['candidate_propriety']; ?></td>
			<td><?php echo $selHistory['last_modified_type']; ?></td>
			<td><?php echo $selHistory['rec_recruiter_id']; ?></td>
			<td><?php echo $selHistory['inf_staff_id']; ?></td>
			<td><?php echo $selHistory['created']; ?></td>
			<td><?php echo $selHistory['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sel_histories', 'action' => 'view', $selHistory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sel_histories', 'action' => 'edit', $selHistory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sel_histories', 'action' => 'delete', $selHistory['id']), array(), __('Are you sure you want to delete # %s?', $selHistory['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Undergraduates'); ?></h3>
	<?php if(!empty($recRecruiter['Undergraduate'])): ?>
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
		<?php foreach($recRecruiter['Undergraduate'] as $undergraduate): ?>
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
