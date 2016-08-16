<?php
//CSS
echo $this->Html->css('plugins/dataTables/dataTables.bootstrap');
echo $this->Html->css('plugins/dataTables/dataTables.responsive');
echo $this->Html->css('plugins/dataTables/dataTables.tableTools.min');
?>

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>メール送信管理</h2>
	</div>
</div>
<div class="wrapper wrapper-content row animated fadeInRight">
	<div class='col-lg-12 mrb20'>
		<div class="ibox no-margin-bottom">
			<div class="ibox-title">
				<h5>送信履歴一覧</h5>

			</div>
			
			<div class="ibox-content bg-gray p-sm">
				<?php echo $this->Form->create('School',array(
						'class'=>'',
						'type'=>'get',
						'url' => array('controller' => 'MlSendHistories', 'action' => 'index')
					))?>

				


 
          <div class="form-group clearfix">
            <div class="pull-left row m-r-md">
              <label class="pull-left p-xs">送信先</label>

              <?php echo $this->Form->input('send_to_id', array( 
									'options' => $SendTo,
									'class'=>'form-control ct-select2',
									'label'=> false, 
									'div'=>false,
									'required'=>false,
									'empty' => '送信先選択',
									'default' => (isset($send_to_id)) ? $send_to_id : '')
							); ?>        
				</div>
          <div class=''></div>
           
          </div>


        

          <div class="form-group clearfix">
            <div class="pull-left row m-r-md">
              <label class="pull-left p-xs">氏</label>

              <?php echo $this->Form->input('last_name', array(
									'class' => 'form-control ct-select2', 
									'label'=> false, 
									'div'=>false,
									'required'=>false,
									'default' => ( isset( $last_name ) ) ? $last_name : '')
							); ?>    
				</div>
            <div class="pull-left row m-r-md ">
              <label class="pull-left p-xs">名</label>

             <?php echo $this->Form->input('first_name', array(
									'class' => 'form-control ct-select2', 
									'label'=> false, 
									'div'=>false,
									'required'=>false,
									'default' => ( isset( $first_name ) ) ? $first_name : '')
							); ?>      
			</div>
            <div class="pull-left row">
              <label class="pull-left p-xs">メールアドレス</label>
              <?php echo $this->Form->input('send_mail_address', array(
									'class' => 'form-control ct-select2', 
									'label'=> false, 
									'div'=>false,
									'required'=>false,
									'default' => ( isset( $send_mail_address ) ) ? $send_mail_address : '')
							); ?>      
			</div>


          </div>


          <div class="form-group clearfix">
            <div class="col-lg-3 p-r-none">
              <label class="pull-left sch-mdev-30 p-xs">送信期間</label>
              <div class="data_1">

							<div class="input-group date">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>

								<?php echo $this->Form->input('date_from', array(
										'class' => 'form-control  ct-select1', 
										'label'=> false, 
										'div'=>false,
										'required'=>false,
										'default' => ( isset( $date_from ) ) ? $date_from : '')
								); ?>

							</div>

						</div>
            </div>
        
            <div class="col-lg-3 row">
              <label class="pull-left p-xs">から</label>
              <div class="data_1">
							<div class="input-group date">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>

								<?php echo $this->Form->input('date_to', array(
										'class' => 'form-control', 
										'label'=> false, 
										'div'=>false,
										'required'=>false,
										'default' => ( isset( $date_to ) ) ? $date_to : '')
								); ?>

							</div>
						</div>            
            </div>
            <label class="pull-left p-xs">まで</label>
            
   
          </div>



          <div class="form-group clearfix">
            <div class="pull-left row m-r-md">
              <label class="pull-left p-xs">送信ステータス</label>
              	<?php echo $this->Form->input('send_result', array( 
								'options' => $SendResult,
								'class'=>'form-control ct-select2',
								'label'=> false, 
								'div'=>false,
								'required'=>false,
								'empty' => '送信先選択',
								'default' => ( isset ( $send_result) ) ? $send_result : '')
						); ?>              
				</div>
            <div class="pull-left row m-r-md ">
              <label class="pull-left p-xs">テンプレート</label>
              <?php echo $this->Form->input('mail_templates', array( 
								'options' => $MailTemplates,
								'class'=>'form-control ct-select2',
								'label'=> false, 
								'div'=>false,
								'required'=>false,
								'empty' => 'テンプレート選択',
								'default' => (isset($mail_templates)) ? $mail_templates : '')
						); ?>              
			</div>
       
          </div>


           <div class="form-group clearfix">
            <div class="pull-left row m-r-md">
              <label class="pull-left p-xs">求人票</label>
					<?php echo $this->Form->input('job_vote', array( 
								'options' => $JobVote,
								'class'=>'form-control ct-select2',
								'label'=> false, 
								'div'=>false,
								'required'=>false,
								'empty' => '求人票選択',
								'default' => (isset($job_vote)) ? $job_vote : '')
						); ?>
              
				</div>
            <div class="pull-left row m-r-md ">
              <label class="pull-left p-xs">イベント</label>
<?php echo $this->Form->input('ev_event', array( 
								'options' => $EvEvent,
								'class'=>'form-control ct-select2',
								'label'=> false, 
								'div'=>false,
								'required'=>false,
								'empty' => 'イベント選択',
								'default' => (isset($ev_event)) ? $ev_event : '')
						); ?>
              
			</div>
          
			
          </div>



			


				

<div class='clearfix'></div>

				<div class="from_calen row">
					<?php echo $this->Form->button('検索',array(
							'class'=>'btn btn-primary btn-sm',
							'div'=>false
						));?>
					<?php echo $this->Html->link(__('クリア'), array('action' => 'index'),array('class'=>'text-29bbef')); ?>
				</div>
				<?php echo $this->Form->end();?>
			</div>
		</div>
		<div class="clear"></div>

		<div class="ibox-content">

            <!--pagination-->
            <div class="text-right clearfix mrb15">
                <div class="pull-left">
                	<button type="submit" class="btn btn-sm btn-white" onclick="window.print();">
						<i class="fa fa-print" onclick="window.print()"></i>
					</button>
           
                </div>
                <div class="bottom_pagination1 pull-right">
                    <ul class="pagination m-t-none">
                        <?php
                            echo $this->Paginator->prev('Prev', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button previous disabled'));
                        echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','class'=>'paginate_button','currentClass'=>'paginate_button active','currentTag'=>'a'));
                        echo $this->Paginator->next('Next', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button next disabled'));
                        ?>
                    </ul>
                </div>
                <span class="sp-text-pg pull-right"><?php echo $this->Paginator->counter("{:count} 件中 {:start}-{:end} 件表示")?>&nbsp;&nbsp;</span>
            </div>
            <!--pagination-->
			<!--     table     -->
			<div class="table-responsive">
				<table class="table table-striped table-bordered no-margin-bottom dataTables-example tb1">
					<thead>
						<tr>
							<th>メール送信ID</th>                              
							<th>送信日時</th>
							<th>送信先</th>
							<th>会社名／大学名</th>
							<th>メールアドレス</th>
							<th>テンプレート</th> 
							<th>送信ステータス</th>                                
						</tr>
					</thead>
					
					<tbody>
						<?php foreach( $mlSendHistories as $mlSendHist ): ?>
						<?php $sendTo = $this->Enjin->getSendTo( $mlSendHist ); ?>
						<tr> 
							<td>
								<?php echo $mlSendHist['MlSendHistory']['id']; ?>
							</td>                              
							<td>
								<?php echo $mlSendHist['MlSendHistory']['send_date']; ?>
							</td>
							<td>
								<?php   
	                                echo $this->html->link( 
	                                        h( $sendTo['sendTo'] ), 
	                                          array( 'controller'=>'CanCandidates',
	                                               'action'=>'edit',
	                                               $sendTo['id'] ),
	                                               array( 'class' => 'text-navy' ) ); ?>
							</td>
							<td><?php echo $sendTo['belong']; ?></td>
							<td><a href=""><?php echo $mlSendHist['MlSendHistory']['send_mail_address']; ?></a></td>
							<td>
								<?php   
                                                echo $this->html->link( 
                                                        h( $mlSendHist['MailTemplate']['template'] ), 
                                                          array( 'controller'=>'MailTemplates',
                                                               'action'=>'view',
                                                               $mlSendHist['MailTemplate']['id'] ),
                                                               array( 'class' => 'text-navy' ) ); ?></td>
							<td><?php echo $SendResult[ $mlSendHist['MlSendHistory']['send_result'] ];  ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					
					<tfoot>
						<tr>
							<th>メール送信ID</th>                              
							<th>送信日時</th>
							<th>送信先</th>
							<th>会社名／大学名</th>
							<th>メールアドレス</th>
							<th>テンプレート</th> 
							<th>送信ステータス</th>                                
						</tr>
					</tfoot>
				</table>
			</div>
            <!--pagination-->
            <div class="text-right clearfix mrt15">
                <div class="pull-left">
                	<button type="submit" class="btn btn-sm btn-white" onclick="window.print();">
						<i class="fa fa-print" onclick="window.print()"></i>
					</button>
           
                </div>
                <div class="bottom_pagination1 pull-right">
                    <ul class="pagination m-t-none">
                        <?php
                  echo $this->Paginator->prev('Prev', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button previous disabled'));
                        echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','class'=>'paginate_button','currentClass'=>'paginate_button active','currentTag'=>'a'));
                        echo $this->Paginator->next('Next', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'paginate_button next disabled'));
                        ?>
                    </ul>
                </div>
                <span class="sp-text-pg pull-right"><?php echo $this->Paginator->counter("{:count} 件中 {:start}-{:end} 件表示")?>&nbsp;&nbsp;</span>
            </div>
            <!--pagination-->
		</div><!-- ligne solid-->
	</div><!--end .col-lg-12-->
</div><!--end .wrapper-content-->
<!-- Mainly scripts -->
<?php
//JS
echo $this->Html->script('plugins/dataTables/jquery.dataTables');
echo $this->Html->script('plugins/dataTables/dataTables.bootstrap');
echo $this->Html->script('plugins/dataTables/dataTables.responsive');
echo $this->Html->script('plugins/dataTables/dataTables.tableTools.min');
echo $this->Html->script('plugins/dataTables/dataTables.tableTools.min');
?>
<!-- script for display a list inside areatext -->
<script>
	$(document).ready(function(){


        $(function () {
            $('.btn-reset').click(function () {
                $('#SchoolIndexForm')[0].reset();
                $('#SchoolSendToId').prop('selectedIndex',0);
                $('#SchoolLastName').val("");
                $('#SchoolFirstName').val("");
                $('#SchoolSendMailAddress').val("");
                $('#SchoolDateFrom').val("");
                $('#SchoolDateTo').val("");
                $('#SchoolSendResult').prop('selectedIndex',0);
                $('#SchoolMailTemplates').prop('selectedIndex',0);
                $('#SchoolJobVote').prop('selectedIndex',0);
                $('#SchoolEvEvent').prop('selectedIndex',0);
            });
        });


		$("#selections").children().each(function(){
            $(this).click(function(){
                    $("#area").text($("#area").text() + $(this).html() + '\n');
                });
            });
		});
</script>