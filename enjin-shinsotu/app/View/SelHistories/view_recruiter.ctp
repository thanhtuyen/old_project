  <!-- css --> 





  <!-- end css -->



 <!-- script -->
<script>
        $(document).ready(function(){
           var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#1AB394' });
        });
        

      


    </script>

 <!-- end script -->      

<?php echo $this->element('back_nav', array('text' => h( $selHistory['SelHistory']['id']. ' '. $selHistory['CanCandidate']['name'] ) ))?>

                                <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
                                  <div class="full-content">
                                    <div class="">
                                      <div class="">
                                        <div class="col-lg-8">
                                          <div class="tabs-container ibox">
                                            <ul class="nav nav-tabs">
                                              <?php foreach( $selHistory['tabData'] as $row ): ?>
                                                
                                                <?php if( $scr_order < $row['SelHistory']['id'] ) $scr_order = $row['ScreeningStage']['order']; ?>

                                                <?php ( $selHistory['SelHistory']['screening_stage_id'] == $row['ScreeningStage']['id'] ) ? $class = 'active' : $class = ''  
                                                ?>

                                             <li class="<?php echo $class; ?>">
		                                            <?php echo $this->Html->link( $row['ScreeningStage']['name'], array('controller'=>'SelHistories','action'=>'view', $row['SelHistory']['id']) ); ?>
                                             </li>
                                                 <?php endforeach; ?>
                                          </ul>
                                          <div class="tab-content">

                                              <!-- tab2 -->
                                              <div id="tab-2" class="tab-pane active">
                                                <div class="panel-body  pd-bottom-none">
                                                  <div class="ibox-title">
                                                    <h5>候補者情報</h5>
                                                </div>

                                                <div class="ibox-content">
                                                    <form action="<?php echo $this->HTML->url(array('controller'=>'SelHistories','action'=>'delete',$selHistory['SelHistory']['id'])); ?>" method="post" class="form-horizontal">

                                                      <div class="form-group"><label class="col-sm-4 control-label">選考履歴ID</label>
                                                        <div class="col-sm-8">
                                                          <div class="form-control border-none">
                                                            <?php echo h( $selHistory['SelHistory']['id'] ); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group"><label class="col-sm-4 control-label">候補者名</label>
                                                    <div class="col-sm-8">
                                                      <div class="form-control border-none">
                                                        <?php echo $this->html->link( 
                                                        		h( $selHistory['CanCandidate']['name'] ), 
                                                        			array( 'controller'=>'CanCandidates',
                                                        				   'action'=>'edit',
                                                        				   $selHistory['CanCandidate']['id'] ),
                                                        				   array( 'class' => 'text-navy' ) ); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group"><label class="col-sm-4 control-label">候補者ID</label>
                                                <div class="col-sm-8">
                                                  <div class="form-control border-none">
                                                    <?php echo $this->html->link( 
                                                        		h( $selHistory['CanCandidate']['id'] ), 
                                                        			array( 'controller'=>'CanCandidates',
                                                        				   'action'=>'edit',
                                                        				   $selHistory['CanCandidate']['id'] ),
                                                        				   array( 'class' => 'text-navy' ) ); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-4 control-label">選考段階名</label>
                                            <div class="col-sm-8">
                                              <div class="form-control border-none">
                                                <?php echo h( $selHistory['ScreeningStage']['name'] ); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">選考ステータス</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            <?php echo h( $select_judgment_type[ $selHistory['SelHistory']['select_status_id'] ] ); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-4 control-label">選考開始予定日時</label>                        
                                    <div class="col-sm-8">
                                      <div class="form-control border-none">
                                        <?php if( !empty( $selHistory['SelHistory']['start_date'] ) )  
				                				echo h( $selHistory['SelHistory']['start_date'] ); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">選考終了予定日時</label>
                                <div class="col-sm-8">
                                  <div class="form-control border-none">
                                    <?php if( !empty( $selHistory['SelHistory']['end_date'] ) )  
				                				echo h( $selHistory['SelHistory']['end_date'] ); ?>
                                </div>
                            </div>
                        </div>
          

                    <!-- end table 2-->
                    <!-- form 2 -->

                    <!-- end form 2 -->

      
                <!-- form 2 -->   
              

                      <div class="form-group"><label class="col-sm-4 control-label">求人票ID</label>
                        <div class="col-sm-8">
                          <div class="form-control border-none">
                            <?php echo $this->html->link( 
                        		h( $selHistory['JobVote']['id'] ), 
                        			array( 'controller'=>'JobVotes',
                        				   'action'=>'view',
                        				   $selHistory['JobVote']['id'] ),
                        				   array( 'class' => 'text-navy' ) ); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group"><label class="col-sm-4 control-label">求人票タイトル</label>
                    <div class="col-sm-8">
                      <div class="form-control border-none">
                        <?php echo h( $selHistory['JobVote']['title'] ); ?>
                    </div>
                </div>
            </div>

   
    <!-- end form 2 -->
    <!-- form 3 -->   


          <div class="form-group"><label class="col-sm-4 control-label">選考ステータスオプション</label>
            <div class="col-sm-8">
              <div class="form-control border-none">
                <?php if( !empty( $selHistory['SelHistory']['select_option_id'] ) )  
                				echo h( $selHistory['SelHistory']['select_option_id'] ); ?>
            </div>
        </div>                             
    </div>

    <div class="form-group"><label class="col-sm-4 control-label">掲示年収</label>
        <div class="col-sm-8">
          <div class="form-control border-none">
            <?php if( !empty( $selHistory['SelHistory']['annual_income'] ) )  
                				echo h( $selHistory['SelHistory']['annual_income'] ); ?>
        </div>
    </div>                                 
</div>

<div class="form-group"><label class="col-sm-4 control-label">コメント</label>
    <div class="col-sm-8">
      <div class="form-control border-none">
        <?php if( !empty( $selHistory['SelHistory']['comment'] ) )  
    				echo h( $selHistory['SelHistory']['comment'] ); ?>
    </div>
</div>                                  
</div>

<div class="form-group"><label class="col-sm-4 control-label">訪問先情報</label>
  <div class="col-sm-8">
    <div class="form-control border-none">
      <?php if( !empty( $selHistory['SelHistory']['visited_info'] ) )  
  				echo h( $selHistory['SelHistory']['visited_info'] ); ?>
    </div>
  </div>
</div>

<div class="form-group"><label class="col-sm-4 control-label">流入元企業への選考ステータスの公開可否</label>
  <div class="col-sm-8 row">
    <div class='form-control border-none'>
      <div class="switch form-control border-none">
        <div class="onoffswitch">
            <?php echo $this->Form->checkbox('influx_propriety',
               array('hiddenField' => false, 'class' => 'onoffswitch-checkbox',
               'id' => 'example', 'checked' => $selHistory['SelHistory']['influx_propriety'] == 0))?>
          <label class="onoffswitch-label" for="example">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
          </label>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="form-group"><label class="col-sm-4 control-label">候補者への選考ステータスの公開可否</label>
  <div class="col-sm-8 row">
    <div class='form-control border-none'>
      <div class="switch form-control border-none">
        <div class="onoffswitch">
           <?php echo $this->Form->checkbox('candidate_propriety',
                       array('hiddenField' => false, 'class' => 'onoffswitch-checkbox',
                       'id' => 'example2', 'checked' => $selHistory['SelHistory']['candidate_propriety'] == 0))?>
            <label class="onoffswitch-label" for="example2">
              <span class="onoffswitch-inner"></span>
              <span class="onoffswitch-switch"></span>
            </label>
        </div>
      </div>
    </div>     
  </div>
</div>


<div class="form-group"><label class="col-sm-4 control-label">最終更新者タイプ</label>
    <div class="col-sm-8">
      <div class="form-control border-none">
        <?php echo h( $last_modified_type[ $selHistory['SelHistory']['last_modified_type'] ] ); ?>
    </div>
</div>                                  
</div>

<div class="form-group"><label class="col-sm-4 control-label">最終更新者採用担当者ID</label>
    <div class="col-sm-8">
      <div class="form-control border-none">
        <?php  if( !empty( $selHistory['SelHistory']['rec_recruiter_id'] ) ) {
						echo $this->html->link( 
	                		h( $selHistory['SelHistory']['rec_recruiter_id'] ), 
	                			array( 'controller'=>'RecRecruiters',
	                				   'action'=>'index',
	                				   $selHistory['SelHistory']['rec_recruiter_id'] ),
	                				   array( 'class' => 'text-navy' )  ); 
            } ?>
    </div>
</div>                                  
</div>

<div class="form-group"><label class="col-sm-4 control-label">最終更新流入元担当者ID</label>
    <div class="col-sm-8">
      <div class="form-control border-none">
        <?php  if( !empty( $selHistory['SelHistory']['inf_staff_id'] ) ) 
        					echo $this->html->link( 
                        		h( $selHistory['SelHistory']['inf_staff_id'] ), 
                        			array( 'controller'=>'RefererCompanies',
                        				   'action'=>'view',
                        				   $selHistory['SelHistory']['inf_staff_id'] ),
                        				   array( 'class' => 'text-navy' ) ); ?>
    </div>
</div>                            
</div>
<div class="btn-clear">
	<?php if( $selHistory['ScreeningStage']['order'] == $scr_order ): ?>
    <button class="w-95 btn btn-default">削除</button>
<?php endif; ?>
</div>
</form>
</div> 
<!-- end form 3-->



</div>
</div>
<!-- end tab 2-->

<!-- tab 1 -->
<div id="tab-1" class="tab-pane">
</div>
<!-- end tab -1-->

<!-- tab 3 -->
<div id="tab-3" class="tab-pane">
</div>
<!-- end tab 3-->

<!-- tab 4-->

<!-- tab 5-->



</div>
</div>
<div class='ibox'>
    <div class="ibox-title">
      <h5>書類選考採用担当者</h5>
      <div class="ibox-tools">
        <a class="collapse-link">
          <i class="fa fa-chevron-up"></i>
      </a>
  </div>
</div>
<div class="ibox-content">
  <h5>面接官（採用担当者）選考履歴</h5>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>採用担当者名</th>
        <th>評価ランク</th>
        <th>評価スコア</th>
        <th>評価コメント</th>
        <th>操作</th>
    </tr>
</thead>
<tbody>
<?php foreach( $selHistory['SelRecruiterHistory'] as $SelRecruiterHistory ): ?>
    <tr>
	    <td><?php   
				echo $this->html->link( 
            		h( $SelRecruiterHistory['name'] ), 
            			array( 'controller'=>'RecRecruiters',
            				   'action'=>'view',
            				   $SelRecruiterHistory['rec_recruiter_id'] ),
            				   array( 'class' => 'text-navy' ) ); ?></td>
	    <td><?php if( !empty( $SelRecruiterHistory['evaluation_rank'] ) ) 
	    		echo h( $evaluation_rank[ $SelRecruiterHistory['evaluation_rank'] ] ); ?></td>
	    <td><?php if( !empty( $SelRecruiterHistory['evaluation_score'] ) )
	    				echo h( $SelRecruiterHistory['evaluation_score'] ); ?></td>
	    <td><?php if( !empty( $SelRecruiterHistory['evaluation_comment'] ) )
	    				echo h( $SelRecruiterHistory['evaluation_comment'] ); ?></td>
	    <td></td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>

<!-- table -->
</div>
</div>
</div>



<div class="col-lg-4">
<?php echo $this->element('jobvote',$selHistory['JobVote']); ?>
<?php echo $this->element('reccompany', $RecCompany['RecCompany']); ?><!--end table 2-->
</div>
</div>
</div>
<!-- end content -->

</div>
</div>
<?php echo $this->element('b_back_nav')?>