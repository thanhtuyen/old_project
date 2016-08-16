<?php echo $this->element('back_nav', array('text' => '学校マスタ詳細'))?>
<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
	<!-- content -->

	<div class='full-content'>
		<div class='col-lg-8'>

			<div class='ibox'>
				<div class="ibox-title">
					<h5><?php echo h($school['School']['name']); ?></h5>
					<div class="ibox-tools">
						<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $school['School']['id']),array('class'=>'btn btn-primary btn-xs')); ?>                              
					</div>
				</div>
				<div class='ibox-content bg-white'>
					<table class="table no-border-th-td no-margin-bottom no-borders">
						<tbody>
							<tr>
								<th class="text-right w-30per"><?php echo __('ID')?></th>
								<td class="right-table-td"><?php echo h($school['School']['id']); ?></td>
							</tr>   
							<tr>
								<th class="text-right"><?php echo __('学校名'); ?></th>
								<td class="right-table-td"><?php echo h($school['School']['name']); ?></td>
							</tr> 
							<tr>
								<th class="text-right"><?php echo __('学校区分'); ?></th>
								<td class="right-table-td"><?php echo h($schoolClass[$school['School']['school_class_id']]); ?></td>
							</tr> 
							<tr>
								<th class="text-right"><?php echo __('国公立区立区分'); ?></th>
								<td class="right-table-td"><?php echo h($publicPrivateClass[$school['School']['public_private_class_id']]); ?></td>
							</tr> 
							<tr>
								<th class="text-right"><?php echo __('学校ランク'); ?></th>
								<td class="right-table-td"><?php echo h($schoolRank[$school['School']['school_rank']]); ?></td>
							</tr> 
							<tr>
								<th class="text-right"><?php echo __('国'); ?></th>
								<td class="right-table-td"><?php echo $school['Country']['name']; ?></td>
							</tr>

							<tr>
								<th class="text-right"><?php echo __('都道府県'); ?></th>
								<td class="right-table-td"><?php echo $school['Prefecture']['name']; ?></td>
							</tr>
							<tr>
								<th class="text-right"><?php echo __('採用担当者'); ?></th>
								<td class="right-table-td"><?php echo $this->Html->link($school['RecRecruiter']['last_name'].' '.$school['RecRecruiter']['first_name'], array('controller' => 'rec_recruiters', 'action' => 'view', $school['RecRecruiter']['id'])); ?></td>
							</tr>
							<tr>
								<th class="text-right"><?php echo __('状態'); ?></th>
								<td class="right-table-td"><?php echo h($selStatus[$school['School']['status']]); ?></td>
							</tr>
							<!--<tr>
								<th class="text-right"><?php echo __('Created'); ?></th>
								<td class="right-table-td"><?php echo h($school['School']['created']); ?></td>
							</tr>
							<tr>
								<th class="text-right"><?php echo __('Modified'); ?></th>
								<td class="right-table-td"><?php echo h($school['School']['modified']); ?></td>
							</tr>-->   
						</tbody>
					</table>                    
				</div>
			</div>

		</div>
		<div class="col-lg-12">
			
			<div class="ibox-content">
				<!-- table -->
				<div class="table-responsive">

					<?php if (!empty($school['CanEducation'])): ?>
						<table class="table table-striped table-bordered dataTables-example">
							<thead>
								<tr>
									<th><?php echo __('Id'); ?></th>
									<th><?php echo __('Can Candidate Id'); ?></th>
									<th><?php echo __('School Id'); ?></th>
									<th><?php echo __('School'); ?></th>
									<th><?php echo __('Undergraduate Id'); ?></th>
									<th><?php echo __('Undergraduate'); ?></th>
									<th><?php echo __('Department'); ?></th>
									<th><?php echo __('Student Bunri Class Id'); ?></th>
									<th><?php echo __('Manage Bunri Class Id'); ?></th>
									<th><?php echo __('Seminar'); ?></th>
									<th><?php echo __('Major Theme'); ?></th>
									<th><?php echo __('Circle'); ?></th>
									<th><?php echo __('Admission Date'); ?></th>
									<th><?php echo __('Graduation Date'); ?></th>
									<th><?php echo __('Created'); ?></th>
									<th><?php echo __('Modified'); ?></th>
									<th class="actions"><?php echo __('Actions'); ?></th>
								</tr>
								<thead>
									<tbody>
										<?php foreach ($school['CanEducation'] as $canEducation): ?>
											<tr>
												<td><?php echo $canEducation['id']; ?></td>
												<td><?php echo $canEducation['can_candidate_id']; ?></td>
												<td><?php echo $canEducation['school_id']; ?></td>
												<td><?php echo $canEducation['school']; ?></td>
												<td><?php echo $canEducation['undergraduate_id']; ?></td>
												<td><?php echo $canEducation['undergraduate']; ?></td>
												<td><?php echo $canEducation['department']; ?></td>
												<td><?php echo $canEducation['student_bunri_class_id']; ?></td>
												<td><?php echo $canEducation['manage_bunri_class_id']; ?></td>
												<td><?php echo $canEducation['seminar']; ?></td>
												<td><?php echo $canEducation['major_theme']; ?></td>
												<td><?php echo $canEducation['circle']; ?></td>
												<td><?php echo $canEducation['admission_date']; ?></td>
												<td><?php echo $canEducation['graduation_date']; ?></td>
												<td><?php echo $canEducation['created']; ?></td>
												<td><?php echo $canEducation['modified']; ?></td>
												<td class="actions">
													<?php echo $this->Html->link(__('View'), array('controller' => 'can_educations', 'action' => 'view', $canEducation['id'])); ?>
													<?php echo $this->Html->link(__('Edit'), array('controller' => 'can_educations', 'action' => 'edit', $canEducation['id'])); ?>
													<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'can_educations', 'action' => 'delete', $canEducation['id']), array(), __('Are you sure you want to delete # %s?', $canEducation['id'])); ?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							<?php endif; ?>
						</div>
						<!--#table-->
					</div>


				</div>
			</div>

		</div>