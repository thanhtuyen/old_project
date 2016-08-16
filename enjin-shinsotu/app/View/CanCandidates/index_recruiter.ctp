<?php
$z[] = '';
$z[] = $this->Form->create('search', array('type'=>'get'));
$z[] = $this->form->input(__('ScreeningStage'), array(
		'label' => false, 'div' => false,
		'class' => 'form-control dib ct-select2',
		'default' => $scrStage_id,
		'empty' => __('Select'),
		'options' => $scrStages
	));//選考段階
$z[] = $this->form->input(__('select_status_id'), array(
		'label' => false, 'div' => false,
		'class' => 'form-control dib ct-select2',
		'default' => $selHis_ssid,
		'empty' => __('Select'),
		'options' => $sel_judge_types
	));//選考ステータス
$z[] = $this->form->input(__('RefererCompany'), array(
		'label' => false, 'div' => false,
		'class' => 'form-control dib ct-select2',
		'default' => ( $refCom_id ) ? $refCom_id : '',
		'empty' => __('Select'),
		'options' => $refCom
	));//流入元企業
if($refCom){
	$tmp = array_keys($refCom);
	$refCom = array_merge(array_fill(1, end($tmp)-2, 'N/A'), $refCom);//fill empty indexes
}
$z[] = $this->form->input(__('EvEvent'), array(
		'label' => false, 'div' => false,
		'class' => 'form-control dib ct-select2',
		'default' => $evEvent_id,
		'empty' => __('Select'),
		'options' => $evEvents
	));//イベント
$z[] = $this->form->input(__('last_name'), array(
		'label' => false, 'div' => false,
		'value' =>  $lname,
		'class' => 'form-control ct-select2'
	));//氏
$z[] = $this->form->input(__('first_name'), array(
		'label' => false, 'div' => false,
		'value' =>  $fname,
		'class' => 'form-control ct-select2'
	));//名
$z[] = $this->form->input(__('mail_address'), array(
		'label' => false, 'div' => false,
		'type' => 'email',
		'value' =>  $email,
		'class' => 'form-control ct-select1'
	));//メールアドレス
$z[] = $this->form->input(__('start_date'), array(
		'type' => 'text',
		'label' => false, 'div' => false,
		'value' =>   $selHis_sdate,
		'class' => 'form-control'
	));//先行期間開始日
$z[] = $this->form->input(__('end_date'), array(
		'type' => 'text',
		'label' => false, 'div' => false,
		'value' =>   $selHis_edate,
		'class' => 'form-control ct-select1'
	));//先行期間終了日
$z[] = $this->form->end();

//print form parts
//why? to separate dynamic elements from static elements
function ex(&$stack){
	echo next($stack);
}

//CSS
//echo $this->Html->css('plugins/dataTables/dataTables.bootstrap');
//echo $this->Html->css('plugins/dataTables/dataTables.responsive');
//echo $this->Html->css('plugins/dataTables/dataTables.tableTools.min');
echo $this->Html->css('plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox');

//test, same company as login user, this case it's 1

echo $this->element('back_nav', array('text' => __('候補者一覧'), 'noBtn' => true))?>

<!-- end top bar -->
<div class='wrapper wrapper-content row animated fadeInRight clearfix'>
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-title">
				<h5><?php echo __('候補者一覧')?></h5>
			</div>

			<div class="ibox-content bg-gray clearfix form-edit2 p-sm">
				<?php ex($z)//start form?>
				<div class="">

					<label for="ScreeningStage" class="dib p-xs"><?php echo __('選考段階')?></label>
					<?php ex($z)?>

					<label for="ScreeningStage" class="dib p-xs"><?php echo __('選考ステータス')?></label>
					<?php ex($z)?>

				</div><!-- 1st options row -->


				<div class="">

					<label for="ScreeningStage" class="dib p-xs"><?php echo __('流入元企業')?></label>
					<?php ex($z)?>

					<label for="ScreeningStage" class="dib p-xs"><?php echo __('イベント')?></label>
					<?php ex($z)?>

				</div><!-- 2nd options row -->

				<div class="clearfix">
					<div class="fl">
						<label class="fl p-xs"><?php echo __('氏')?></label>

						<?php ex($z)?>

					</div>
					<div class="fl">
						<label class="fl p-xs"><?php echo __('名')?></label>

						<?php ex($z)?>

					</div>
					<div class="fl">
						<label class="fl p-xs"><?php echo __('メールアドレス')?></label>

						<?php ex($z)?>

					</div>
				</div><!-- 3rd options row -->

				<div class="form-group row">
					<div class="col-lg-3 p-r-none">
						<label class="fl p-xs">選考期間</label>
						<div class="data_1">
							<div class="input-group date">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<?php ex($z)?>
							</div>
						</div>
					</div>

					<div class="col-lg-3 clearfix pd-none-left">
						<label class="fl p-xs">から</label>
						<div class="data_1">
							<div class="input-group date">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<?php ex($z)?>
							</div>
						</div>
					</div>

					<label class="col-md-1 p-xs">まで</label>
				</div><!-- last options row -->

				<div class="from_calen">
					<?php echo $this->form->button(__('検索'),
						array('type'=>'submit', 'class'=>'btn btn-primary')); ?>

					<?php echo $this->Html->link('クリア', array('action' => 'index'),array('class'=>'text-navy', 'id' => 'clearbtn')); ?>
				</div><!-- action buttons -->
				<?php ex($z)//end form?>
			</div><!-- end ibox 1 -->

			<div class="ibox-content">
			<div class='row'>
				<div class="col-lg-8">
					<div class="btn-group">
						<select class="form-control pull-left btn h-30 linked">
							<option value>チェックのみ</option>
							<option value=1>すべて</option>
						</select>
					</div>

					<button type="button" class="btn btn-sm btn-white mailIco" data-toggle="modal" data-target="#selTmpl">
						<i class="fa fa-envelope-o"></i>
					</button>
					<button type="submit" class="btn btn-sm btn-white">
						<i class="fa fa-print" onclick="window.print()"></i>
					</button>
					<button class="btn btn-primary btn-sm  m-l m-r-sm" onclick="window.location.href='<?php echo Router::url(array('action'=>'add'))?>'"><?php echo __('新規候補者登録')?></button>
					<button class="btn btn-primary btn-sm m-r-sm" onclick="window.location.href='<?php echo Router::url(array('action'=>'csv_add'))?>'"><?php echo __('参加者CSV登録')?></button>
				</div>

				<!------------pagination--------------> 
				<div class="col-lg-4">
					<?php echo $this->element('pagination1');?>
				</div>
				<!--pagination-->
			</div>
			
			<div class="table-responsive">
				<!-- table -->
				<table class="table table-striped table-bordered table-hover tb1 tbl-data dataTables-example-none1">
					<thead>
						<tr>
							<th class="wsnw"><input type="checkbox" class="i-checks"></th>
							<th class="wsnw"><?php echo __('候補者ID'); ?></th>
							<th class="wsnw"><?php echo __('候補者名'); ?></th>
							<th class="wsnw"><?php echo __('メールアドレス'); ?></th>
							<th class="wsnw"><?php echo __('大学名'); ?></th>
							<th class="wsnw"><?php echo __('学部名'); ?></th>
							<th class="wsnw"><?php echo __('電話番号'); ?></th> 
							<th class="wsnw"><u><?php echo __('顔写真')?><u></th> 
							<th class="wsnw"><?php echo __('流入元'); ?></th> 
							<th class="wsnw"><?php echo __('操作')?></th>                                                       
						</tr>
					</thead>
					<tbody>
						<?php
						$flag = 1;
						?>
						<?php foreach($canCandidates as $canCandidate): ?>
						<?php
						$edu		= $canCandidate['CanEducation'];
						$school 	= $this->Enjin->getSchoolName($edu);
						$undergra	= $this->Enjin->getUnderGraduateName($edu);
						$selHis		= $canCandidate['SelHistory'];
						$can		= $canCandidate['CanCandidate'];

						if(!$can['face_photo'])
						$can['face_photo'] = "bootstrap/icon_avatar.png";

						?>
						<tr>
							<td><input type="checkbox" class="i-checks cbItem" value="<?php echo $can['id']?>"></td>
							<td><a><?php echo $this->HTML->link(h($can['id']),array('action'=>'view',$can['id'])); ?></a></td>
							<td><a><?php echo $this->HTML->link(h($can['name']),array('action'=>'view',$can['id'])); ?></a></td>
							<td><?php echo h($can['mail_address']); ?></td>
							<td><?php echo $school; ?></td>
							<td><?php echo $undergra; ?></td>
							<td><?php echo h($can['tel']); ?></td>
							<td><?php echo $this->Html->image($can['face_photo'], array("alt" => "portrait"))?></td>
							<td><?php echo $refCom ? $refCom[$can['referer_company_id']] : 'empty'?></td>
							<td class="table-button-tdright wsnw">
								<?php
								echo $this->Form->button(__('詳細'), array('class' => 'btn btn-primary btn-xs btn-rtable', 'onclick' => "window.location.href='" . $this->webroot . "CanCandidates/view/".$can['id']."'"))//詳 細?>
								<?php echo $this->Form->postLink(__('削除'), array('controller'=>'CanCandidates', 'action' => 'delete', $can['id']), array('class' => 'btn btn-default btn-xs btn-rtable cl-white', 'confirm' => __('Are you sure you want to delete # %s?', $can['id']))); //削 除?>
							</td>
						</tr>
						<?php $flag = 1 - $flag;?>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<th><input type="checkbox" class="i-checks"></th>
							<th><?php echo __('候補者ID'); ?></th>
							<th><?php echo __('候補者名'); ?></th>
							<th><?php echo __('メールアドレス'); ?></th>
							<th><?php echo __('大学名'); ?></th>
							<th><?php echo __('学部名'); ?></th>
							<th><?php echo __('電話番号'); ?></th> 
							<th><u><?php echo __('顔写真')?><u></th> 
							<th><?php echo __('流入元'); ?></th> 
							<th><?php echo __('操作')?></th>                                                
						</tr>
					</tfoot>
				</table>
				<!-- end table -->
			</div>
			
			<div class='row'>
				<div class="col-lg-8">
					<div class="btn-group">
						<select class="form-control pull-left btn h-30 linked">
							<option value>チェックのみ</option>
							<option value=1>すべて</option>
						</select>      
					</div>

					<button type="button" class="btn btn-sm btn-white mailIco" data-toggle="modal" data-target="#selTmpl">
						<i class="fa fa-envelope-o"></i>
					</button>
					<button type="submit" class="btn btn-sm btn-white">
						<i class="fa fa-print" onclick="window.print()"></i>
					</button>

					<div class="btn-group p-r b-r2">
						<select class="form-control pull-left btn h-30 w-100">
							<option>その他</option>
							<option>その他</option>
							<option>その他</option>
						</select>  
					</div>

					<button class="btn btn-primary btn-sm m-l m-r-sm" onclick="window.location.href='<?php echo Router::url(array('action'=>'add'))?>'"><?php echo __('新規候補者登録')?></button>
					<button class="btn btn-primary btn-sm m-r-sm" onclick="window.location.href='<?php echo Router::url(array('action'=>'csv_add'))?>'"><?php echo __('参加者CSV登録')?></button>

				</div>
				
				<!------------pagination--------------> 
				<div class="col-lg-4">
					<?php echo $this->element('pagination1');?>
				</div>
				<!--pagination-->
			</div>
			<!-- end table -->
			</div><!--end ibox 2-->

		</div>

		
	</div><!-- end .col-lg-12-->
</div><!-- end .wrapper-content -->

<div class="modal inmodal" id="selTmpl" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content animated fadeIn">
			<div class="modal-header">
				<h4 class="modal-title">Template selection</h4>
				<small class="font-bold">Select an email template then send email to selected data</small>
			</div>
			<div class="modal-body">
				
				<table class="table table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>Template</th>
						</tr>
					</thead>
					<tbody>
						<?php $idx=1;
						foreach($mailTmpl as $key => $row){?>
							<tr>
								<td><div class='i-checks'>
										<label>
											<input class='' type="radio" value="<?php echo $key?>" name="emailTmpl">
										</label>
									</div>
								</td>
								<td><?php echo $row?></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>

				<div id="ajaxReport"></div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" id="mailBtn">Send Now</button>
			</div>
		</div>
	</div>
</div>
<?php
//JS
echo $this->Html->script('plugins/dataTables/jquery.dataTables');
echo $this->Html->script('plugins/dataTables/dataTables.bootstrap');
echo $this->Html->script('plugins/dataTables/dataTables.responsive');
echo $this->Html->script('plugins/dataTables/dataTables.tableTools.min');
echo $this->Html->script('plugins/dataTables/dataTables.tableTools.min');
echo $this->Html->script('plugins/datapicker/bootstrap-datepicker');
?>
<script>
	$( document ).ready(function() {
			var data,webroot='<?php echo $this->webroot?>';
			$('.data_1 .input-group.date').datepicker({
					todayBtn: "linked",
					keyboardNavigation: false,
					forceParse: false,
					calendarWeeks: true,
					autoclose: true,
					format: 'yyyy/mm/dd'
				});
			//checkbox group
			$('.table-responsive th .iCheck-helper').click(function(){
					if($(this).prev()[0].checked)
					$('.table-responsive .i-checks').iCheck('check');
					else
					$('.table-responsive .i-checks').iCheck('uncheck');
				});
			//match selectbox
			$('.linked').change(function(){
					var tmp = 1 - $('.linked').index(this);
					$('.linked')[tmp].value=$(this).val();
				});
			//send mail
			$('.mailIco').click(function (){
					data=[];//clean data befor send
					$("#ajaxReport").html('');//clean report

					if(!$('.linked')[0].value)//only selected, pour data
					$('.cbItem').each(function (){if(this.checked) data.push(this.value)});
					console.log( data);
				});
			$("#mailBtn").click(function (){
					if($('.linked')[0].value){//all follow search options
						$.post(webroot+'MlSendHistories/send_search_by_candidate',
							{"mail_template_id" : $("input[name=emailTmpl]:checked").val()},
							function (res){
								if(typeof res.code == 'undefined')
								return false;
								$("#ajaxReport").append("All emails were sent.");
							}).fail(function (res) {
								$("#ajaxReport").append("Fail to send the emails.");
							});

						return false;
					}

					sendMail();
				});

			function sendMail(){
				$.post(webroot+'MlSendHistories/send_simple',
					{"can_candidate_ids" : data, "mail_template_id" : $("input[name=emailTmpl]:checked").val()},
					function (res){
						if(typeof res.code == 'undefined')
						return false;
						$("#ajaxReport").append("An email was sent to #" +data+ "<br>");
					}).fail(function (res) {
						$("#ajaxReport").append("Fail to send email to #" +data+ "<br>");
					});
			}

			$('#clearbtn').click(function (){
					var tmp = $(this).parents('form:first')[0].elements,type;
					
					for(var item in tmp){
						type = tmp[item].nodeName;
					
						switch (type)
						{
							case "INPUT":
							case "SELECT":
							tmp[item].value = "";break;
							break;
							default:
							break;
						}
					}

					return false;
				});
		});
</script>
<?php
return;
//original?>
<div class="canCandidates index">
	<h2><?php echo __('Can Candidates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('last_name'); ?></th>
				<th><?php echo $this->Paginator->sort('first_name'); ?></th>
				<th><?php echo $this->Paginator->sort('mail_address'); ?></th>
				<th><?php echo $this->Paginator->sort('tel'); ?></th>
				<th><?php echo $this->Paginator->sort('post_code'); ?></th>
				<th><?php echo $this->Paginator->sort('prefecture_id'); ?></th>
				<th><?php echo $this->Paginator->sort('residence'); ?></th>
				<th><?php echo $this->Paginator->sort('birthday'); ?></th>
				<th><?php echo $this->Paginator->sort('sex'); ?></th>
				<th><?php echo $this->Paginator->sort('referer_company_id'); ?></th>
				<th><?php echo $this->Paginator->sort('mynavi_id'); ?></th>
				<th><?php echo $this->Paginator->sort('rikunavi_id'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($canCandidates as $canCandidate): ?>
			<tr>
				<td><?php echo h($canCandidate['CanCandidate']['id']); ?>&nbsp;</td>
				<td><?php echo h($canCandidate['CanCandidate']['last_name']); ?>&nbsp;</td>
				<td><?php echo h($canCandidate['CanCandidate']['first_name']); ?>&nbsp;</td>
				<td><?php echo h($canCandidate['CanCandidate']['mail_address']); ?>&nbsp;</td>
				<td><?php echo h($canCandidate['CanCandidate']['tel']); ?>&nbsp;</td>
				<td><?php echo h($canCandidate['CanCandidate']['post_code']); ?>&nbsp;</td>
				<td>
					<?php echo h($canCandidate['Prefecture']['name']); ?>
				</td>
				<td><?php echo h($canCandidate['CanCandidate']['residence']); ?>&nbsp;</td>
				<td><?php echo h($canCandidate['CanCandidate']['birthday']); ?>&nbsp;</td>
				<td><?php echo $this->enjin->getSexName($canCandidate['CanCandidate']['sex']); ?>&nbsp;</td>
				<td>
					<?php echo h($canCandidate['RefererCompany']['name']); ?>
				</td>
				<td><?php echo h($canCandidate['CanCandidate']['mynavi_id']); ?>&nbsp;</td>
				<td><?php echo h($canCandidate['CanCandidate']['rikunavi_id']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $canCandidate['CanCandidate']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $canCandidate['CanCandidate']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $canCandidate['CanCandidate']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $canCandidate['CanCandidate']['id']))); ?>
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
		?></p>
	<div class="paging">
		<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>
</div>
