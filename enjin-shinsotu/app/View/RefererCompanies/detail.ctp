<?php echo $this->element('back_nav', array('text' => __('流入元企業詳細｜ %d　%s', $data['RefererCompany']['id'], $data['RefererCompany']['name']), 'noBtn' => true))?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
	<!-- start .full-content -->
	<div class="full-content clearfix">
		<div class="col-lg-8">
			<div class="ibox">
      
				<div class="ibox-title">
					<h5><?php echo __('流入元企業情報')?></h5>
					<div class="ibox-tools">
						<button type="button" class="btn btn-primary btn-xs" onclick="window.location.href='<?php echo $this->Html->url(array("action" => "edit", $data['RefererCompany']['id']))?>'"><?php echo __('編集')?></button>
					</div>
				</div>
        
				<div class="ibox-content bg-white p-sm">
					<div class="form-horizontal">

						<div class="form-group">
							<label class="col-sm-4 control-label">企業名</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><?php echo h( $data['RefererCompany']['name'] ); ?></div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">流入元企業ID</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><?php echo h( $data['RefererCompany']['id'] ); ?></div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">流入元タイプ</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><?php echo $this->Enjin->getInfluxOriginalTypeName( $data['RefererCompany']['influx_original_type']); ?></div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">都道府県</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><?php echo h( $data['Prefecture']['name'] ); ?></div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">市区町村</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><?php echo h( $data['City']['name'] ); ?></div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">契約</label>
							<div class="col-sm-8">
								<div class="form-control border-none">あり</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">最終更新担当者</label>
							<div class="col-sm-8">
								<div class="form-control border-none"><?php echo $this->Html->link($data['RefererCompany']['rec_recruiter_name'], array('controller' => 'rec_recruiters', 'action' => 'view/', $data['RefererCompany']['rec_recruiter_id']),
										array('class'=>'text-navy')); ?></div>
							</div>
						</div>

					</div>
				</div><!--end .ibox-content-->
			</div>
      
			<div class="ibox">
				<div class="ibox-title">
					<h5>この企業から流入している候補者一覧</h5>
				</div>
	       
				<div class="ibox-content bg-gray clearfix form-edit2 p-sm">
        
					<?php echo $this->Form->create('RefererCompanies',array(
							'class'=>'form-horizontal',
							'type'=>'get',
							'url' => array('controller' => 'RefererCompanies', 'action' => 'detail',$data['RefererCompany']['id'])
						))?>
					<div class="clear"></div>
					<div class="form-group">

						<div class="pull-left m-r-md">
							<label class="pull-left p-xs">求人票</label>
							<?php echo $this->Form->input('jobvote_id', array( 'options'=>$wInfJobVotePublic ,'label'=>false,'div'=>false,'class'=>'form-control ct-select2','value'=>$param['jobvote_id']) ); ?>
						</div>

						<div class="pull-left row m-r-md ">
							<label class="pull-left p-xs">選考段階</label>
							<?php echo $this->Form->input('screeningstage_id', array( 'options'=>$wScreeningStage ,'label'=>false,'div'=>false,'class'=>'form-control ct-select2','value'=>$param['screeningstage_id']) ); ?>
						</div>

					</div>
					<div class="clear"></div>
					<div class="from_calen row">
						<button type="submit" class="btn btn-primary w-95">検索</button>
						<a type="" class="text-navy" id="clearbtn">クリア</a>
					</div>
					<?php echo $this->Form->end()?>
				</div>
			</div><!--end search form-->
           
			<div class="ibox-content">
      
				<!-- table -->
				<div class="table-responsive">
					<div class='row'>
						<div class="col-lg-7">
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

						</div>
						<div class="col-lg-5">
							<?php echo $this->element('pagination1');?>
						</div>
					</div>
            
					<table class="table table-striped tb1 table-bordered table-hover dataTables-example-none1">
						<thead>
							<tr>
								<th class="wsnw"><input type="checkbox" class="i-checks"></th>
								<th class="wsnw"><?php echo __('名前')?></th>
								<th class="wsnw"><?php echo __('求人票')?></th>
								<th class="wsnw"><?php echo __('選考段階')?></th>
								<th class="wsnw"><?php echo __('流入元契約')?></th>
								<th class="wsnw"><?php echo __('操作')?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach( $CanSelJobs as $row ): ?>
							<tr>
								<td><input type="checkbox" class="i-checks cbItem" value="<?php echo $row['CanCandidate']['id'];?>"></td>
								<td><?php echo $this->Html->link($row['CanCandidate']['last_name'] ." ". $row['CanCandidate']['first_name'], array('controller' => 'CanCandidates', 'action' => 'view', $row['CanCandidate']['id'])); ?></td>
								<td><?php echo $this->Html->link( $row['JobVote']['title'], array('controller' => 'JobVotes', 'action' => 'view', $row['JobVote']['id'])); ?></td>
								<td><?php echo h( $row['ScreeningStage']['name'] ); ?></td>
								<td>エンジン固定契約</td>
								<td class="table-button-tdright wsnw">
									<?php
									echo $this->Form->button(__('詳細'), array('class' => 'btn btn-primary btn-xs btn-rtable', 'onclick' => "window.location.href='".$this->Html->url(array('controller' => 'CanCandidates', "action" => "view",$row['CanCandidate']['id']))."'"))//詳 細?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
                    <div class='row'>
                        <div class="col-lg-7">
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

                        </div>
                        <div class="col-lg-5">
                            <?php echo $this->element('pagination1');?>
                        </div>
                    </div>
				</div>
				<!-- end table -->
			</div>
		</div>
		<!-- end left col 8 -->

		<!-- right col 4 -->
		<div class="col-lg-4">
			<div class="ibox">
				<div class="ibox-title">
					<h5>公開求人票一覧</h5>
				</div>
      
				<div class="ibox-content clearfix p-sm">
					<div class="">
						<div class="table-border">
							<table class="table table-bordered no-margin-bottom" id="jobOfferStaffBox">
								<thead>
									<tr>
										<th>求人票</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach( $wInfJobVotePublic as $key => $val ):
									if(!$key) continue;?>
									<tr>
										<td>
											<?php echo $this->Html->link($val, array('controller' => 'JobVotes', 'action' => 'view/', $key ),array('class'=>'text-navy')); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>                      
			</div><!--end ibox 1-->



			<!-- 流入元担当者一覧 -->
			<div class="ibox ">
				<div class="ibox-title">
					<h5>流入元担当者一覧</h5>
					<div class="ibox-tools">
					    <?php echo $this->Html->link('新規登録',array( 'controller'=>'InfStaffs','action'=>'add',$data['RefererCompany']['id']),array('class'=>"btn btn-primary btn-xs" )); ?>
					</div>
				</div>
      
				<div class="ibox-content bg-white p-sm">
					<?php foreach( $data['InfStaff'] as $row ): ?>
					<h3><?php echo $this->Html->link( $row['name'], array('controller' => 'InfStaffs', 'action' => 'view', $row['id'] ),array('class'=>'text-navy')); ?></h3>

					<table class="table table-bordered sb-3">
						<tbody>
							<tr>
								<th class="w-47per">メールアドレス</th>
								<td class="right-table-td"><a class="text-navy" href="mailto:<?php echo h( $row['mail_address'] ); ?>"><?php echo h( $row['mail_address'] ); ?></a></td>
							</tr>   
							<tr>
								<th>電話番号</th>
								<td class="right-table-td"><?php echo h( $row['tel'] ); ?></td>
							</tr> 
							<tr>
								<th>ステータス</th>
								<td class="right-table-td">ステータス表示</td>
							</tr>            
						</tbody>
					</table>
					<?php endforeach; ?>
				</div>
			</div><!--end ibox 2-->
			<!-- end 流入元担当者一覧 -->


			<!-- 流入元契約一覧 -->
			<div class="ibox ">
				<div class="ibox-title">
					<h5>流入元契約一覧</h5>
					<div class="ibox-tools">
					    <?php echo $this->Html->link('新規登録',array( 'controller'=>'InfContracts','action'=>'add',$data['RefererCompany']['id']),array('class'=>"btn btn-primary btn-xs" )); ?>
					</div>
				</div>
      
				<div class="ibox-content bg-white p-sm">
                    <?php $i=0; $total=count($inf); ?>
					<?php foreach( $inf as $row_x ): ?>
					<?php $row = $row_x['InfContract']; $i=$i+1;?>
					<h3><?php echo $this->Html->link( $row['title'], array('controller' => 'InfContracts', 'action' => 'view', $row['id'] ),array('class'=>'text-navy')); ?></h3>
                    <table class="table table-bordered no-margin-bottom sb-3">
						<tbody>
							<tr>
								<th class="w-47per">契約開始日</th>
								<td class="right-table-td"><?php echo $row['start_contract_date'] ?></td>
							</tr>
							<tr>
								<th>契約終了日</th>
								<td class="right-table-td"><?php echo $row['end_contract_date'] ?></td>
							</tr>
							<tr>
								<th>契約タイプ</th>
								<td class="right-table-td"><?php echo $this->Enjin->getContractType( $row['contract_type']); ?></td>
							</tr>
							
							<tr>
								<th>採用Fee</th>
								<td class="right-table-td"><?php echo $this->Enjin->getInfContactFee( $row ); ?></td>
							</tr>
							<?php if(!empty($row_x['InfJobVotePublic']))
							foreach( $row_x['InfJobVotePublic'] as $row ):
							if(!$row) continue;?>
							<tr>
								<th>契約済求人票</th>
								<td class="right-table-td"><a class='text-navy'><?php echo isset($wInfJobVotePublic[ $row['job_vote_id'] ]) ? $wInfJobVotePublic[ $row['job_vote_id'] ] : 'N/A'?></a></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php endforeach; ?>
				</div>
			</div><!--end ibox 3-->
			<!-- end 流入元契約一覧 -->
		</div><!-- end right col-4 -->
	</div><!-- end .full-content -->
    <div class="h-40"></div>
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

<script>
$( document ).ready(function() {
	var data,webroot='<?php echo $this->webroot?>';

	$("#clearbtn").click(function (){
		$(this).parents('form:first').find('select').val('')
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

});

</script>
