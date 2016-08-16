<?php $mailTemplate = $mailTemplateData['MailTemplate']; ?>
<?php echo $this->element('back_nav', array('text' => __('テンプレート詳細')))?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix">
	<!-- content -->   
	<div class='full-content'>


		<div class="col-lg-8">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>テンプレート詳細</h5>
					<div class="ibox-tools">
						<div class="pull-left ibox-tools">
							<?php echo $this->Html->link(__('複製'),array('action'=>'copy', $mailTemplate['MailTemplate']['id']), array('class'=>'btn btn-primary btn-xs')); ?>
						</div>

						<div class="pull-right ibox-tools">
							<?php echo $this->Html->link(__('編集'),array('action'=>'edit', $mailTemplate['MailTemplate']['id']), array('class'=>'btn btn-primary btn-xs')); ?>                               
						</div>
					</div>
				</div>
				<div class="ibox-content clearfix p-sm">
					<div class="">
						<div class="table-border">
							<table class="table table-bordered no-margin-bottom tbl-th-f9">
								<tr>
									<th class="w-30per">テンプレートID</th>
									<td><?php echo h($mailTemplate['MailTemplate']['id']); ?></td>
								</tr>
								<tr>
									<th>テンプレート名</th>
									<td><?php echo h($mailTemplate['MailTemplate']['template']); ?></td>
								</tr>
								<tr>
									<th>用途</th>
									<td><?php echo h($purpose[$mailTemplate['MailTemplate']['purpose_id']]); ?></td>
								</tr>
								<tr>
									<th>対象</th>
									<td><?php echo h($target); ?></td>
								</tr>
							</table>
						</div>
					</div>

				</div>


			</div>

			<div class="ibox">
				<div class="ibox-content clearfix p-sm">
					<div class=''>
						<div class="table-border">
							<table class="table table-bordered no-margin-bottom tbl-th-f9">
								<tr>
									<th>タイトル</th>
									<td><?php echo h($mailTemplate['MailTemplate']['subject']); ?></td>
								</tr>
								<tr>
									<th colspan="2"class="button_cen">内容</th>
								</tr>
								<tr>
									<td colspan="2">
										<?php echo h($mailTemplate['MailTemplate']['body']); ?>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php echo $this->element('b_back_nav')?>

					<?php return; ?>

					<div class="mailTemplates view">
						<?php 
						$mlAttachment = $mailTemplateData['MlAttachment'];
						$mailTemplate = $mailTemplateData['MailTemplate'];

						?>
						<h2><?php echo __('Mail Template'); ?></h2>
						<dl>
							<dt><?php echo __('Id'); ?></dt>
							<dd>
								<?php echo h($mailTemplate['MailTemplate']['id']); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Template'); ?></dt>
							<dd>
								<?php echo h($mailTemplate['MailTemplate']['template']); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Subject'); ?></dt>
							<dd>
								<?php echo h($mailTemplate['MailTemplate']['subject']); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Body'); ?></dt>
							<dd>
								<?php echo h($mailTemplate['MailTemplate']['body']); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Ev Event'); ?></dt>
							<dd>
								<?php echo $this->Html->link($mailTemplate['EvEvent']['name'], array('controller' => 'ev_events', 'action' => 'view', $mailTemplate['EvEvent']['id'])); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Job Vote'); ?></dt>
							<dd>
								<?php echo $this->Html->link($mailTemplate['JobVote']['title'], array('controller' => 'job_votes', 'action' => 'view', $mailTemplate['JobVote']['id'])); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Screening Stage'); ?></dt>
							<dd>
								<?php echo $this->Html->link($mailTemplate['ScreeningStage']['name'], array('controller' => 'screening_stages', 'action' => 'view', $mailTemplate['ScreeningStage']['id'])); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Purpose'); ?></dt>
							<dd>
								<?php echo h($purpose[$mailTemplate['MailTemplate']['purpose_id']]); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Rec Company'); ?></dt>
							<dd>
								<?php echo $this->Html->link($mailTemplate['RecCompany']['company_name'], array('controller' => 'rec_companies', 'action' => 'view', $mailTemplate['RecCompany']['id'])); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Rec Recruiter'); ?></dt>
							<dd>
								<?php echo $this->Html->link($mailTemplate['RecRecruiter']['name'], array('controller' => 'rec_recruiters', 'action' => 'view', $mailTemplate['RecRecruiter']['id'])); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Status'); ?></dt>
							<dd>
								<?php echo h($mailTemplate['MailTemplate']['status']); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Created'); ?></dt>
							<dd>
								<?php echo h($mailTemplate['MailTemplate']['created']); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Modified'); ?></dt>
							<dd>
								<?php echo h($mailTemplate['MailTemplate']['modified']); ?>
								&nbsp;
							</dd>
						</dl>
						<h1>添付ファイル一覧</h1>
						<table>
							<?php foreach ($mlAttachment as $attachment) { ?>
							<tr>
								<td><?php echo $attachment['MlAttachment']['file_name'].'.'.$attachment['MlAttachment']['extension']; ?></td>
								<td class="actions">
									<?php echo $this->Form->postLink(__('Delete'), array('action' => 'fileDelete', $attachment['MlAttachment']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $attachment['MlAttachment']['id']))); ?></td>
								</tr>
								<?php }	?>
							</table>

							<h1>ファイル追加</h1>
							<?php
							echo $this->Form->create('MailTemplate', array('enctype' => 'multipart/form-data', 'action' => 'upload', 'type' => 'file') );
							echo $this->Form->file('binary');
							echo $this->Form->hidden('mailTemplatesId', array('value' => $mailTemplate['MailTemplate']['id']));
							echo $this->Form->end('Save');
							?>
						</div>
