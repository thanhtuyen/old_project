


<?php echo $this->Html->css('plugins/clockpicker/clockpicker'); ?>
<?php echo $this->Html->css('plugins/datapicker/datepicker3'); ?>

<?php echo $this->Html->css('enjin/global'); ?>


<?php echo $this->Html->css('enjin/02_selection.css'); ?>




<!-- Data picker -->
<?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>
<!-- Peity -->
<?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>
<?php echo $this->Html->script('kiwi.js'); ?>

<?php echo $this->Html->script('plugins/clockpicker/clockpicker.js'); ?>

<!-- Image cropper -->
<?php echo $this->Html->script('plugins/cropper/cropper.min.js'); ?>

<!-- Date range use moment.js same as full calendar plugin -->
<?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
<!-- Date range picker -->
<?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>



<?php echo $this->element('back_nav', array('text' => __('選考履歴｜%d %s', h( $selHistory['SelHistory']['id']), h($selHistory['CanCandidate']['name']) )))?>

            <div class="wrapper wrapper-content row animated fadeInRight clearfix">
              <div class="row">
                <div class="col-lg-8">
                  <div class="tabs-container">
     
                    <ul class="nav nav-tabs">
                      <?php foreach( $selHistory['tabData'] as $row ): ?>
                                          
                                          <?php if( $scr_order < $row['SelHistory']['id'] ) $scr_order = $row['ScreeningStage']['order']; ?>

                                          <?php ( $selHistory['SelHistory']['screening_stage_id'] == $row['ScreeningStage']['id'] ) ? $class = 'active' : $class = ''  
                                          ?>

                                       <li class="<?php echo $class; ?>">
                                          <?php echo $this->html->link( $row['ScreeningStage']['name'], array('controller'=>'Selhistories','action'=>'view', $row['SelHistory']['id']) ); ?>
                                       </li>
                                           <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                      <!-- -----------tab-0--------- -->
                  
                      <div id="tab-0" class="tab-pane active">
                        <div class="panel-body ibox">
                            <div class="ibox-title">
                              <h5>候補者情報</h5>
                            </div>
                            <div class="ibox-content">
                              <?php echo $this->Form->create('SelHistory',array('class'=>'form-horizontal'),array()); ?>
                              <?php echo $this->Form->input( 'id' ); ?>
                              <?php echo $this->Form->input( 'job_vote_id',array('type'=>'hidden') ); ?>
                              <?php echo $this->Form->input( 'can_candidate_id',array('type'=>'hidden') ); ?>
                              
                                <div class="form-group"><label class="col-sm-4 control-label">選考履歴ID</label>
                                  <div class="col-sm-8"><div class="form-control border-none"><?php echo h( $selHistory['SelHistory']['id'] ); ?></div></div>
                                </div>

                                <div class="form-group"><label class="col-sm-4 control-label">候補者名</label>
                                  <div class="col-sm-8"><div class="form-control border-none"><a href="#"><?php echo $this->html->link( 
                                                      h( $selHistory['CanCandidate']['name'] ), 
                                                        array( 'controller'=>'CanCandidates',
                                                             'action'=>'edit',
                                                             $selHistory['CanCandidate']['id'] ),
                                                             array( 'class' => 'text-navy' ) ); ?></a></div>
                                  </div>
                                </div>

                                <div class="form-group"><label class="col-sm-4 control-label">候補者ID</label>
                                  <div class="col-sm-8"><div class="form-control border-none"><?php echo $this->html->link( 
                                                      h( $selHistory['CanCandidate']['id'] ), 
                                                        array( 'controller'=>'CanCandidates',
                                                             'action'=>'edit',
                                                             $selHistory['CanCandidate']['id'] ),
                                                             array( 'class' => 'text-navy' ) ); ?></div></div>
                                </div>

                                <div class="form-group"><label class="col-sm-4 control-label">選考段階名</label>
                                  <div class="col-sm-8"><div class="form-control border-none"><?php echo h( $selHistory['ScreeningStage']['name'] ); ?>
                                  <?php echo $this->Form->input( 'screening_stage_id',array( 'type'=>'hidden', 'value'=>$selHistory['SelHistory']['screening_stage_id']) ); ?>
                                  </div></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">選考ステータス</label>

                                  <div class="col-sm-8">
                                    <?php echo $this->Form->input('select_status_id', array(  
                                        'options' => $this->Enjin->getSelectJudgmentTypeOptions( $selHistory['SelHistory']['select_status_id'], $isFirst,$isLast,$isInterviewer),
                                        'class'=>'form-control full-width',
                                        'label'=> false, 
                                        'div'=>false,
                                        'required'=>false,
                                        'default' => (isset($select_status_id)) ? $select_status_id : '' )
                                        );?>
                                  </div>
                                </div>

                                <div class="form-group mbottom15"><label class="col-sm-4 control-label">選考開始予定日時</label>
                                  <div class="col-sm-8 row">
                                    <div class="col-sm-6">
                                      <div class='data_1' id="">
                                        <div class="input-group date">
                                          <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </span><?php $date_option["value"] = $this->Enjin->getDateTime2String($selHistory['SelHistory']['start_date']);
                                                $date_option["label"] = false;
                                                $date_option["class"] = 'form-control ct-select1';
                                                $date_option["type"] = 'text';
                                                echo $this->Form->input('start_date',$date_option ); ?>
                                        </div>
                                      </div>
                                      <!-- end id data_1-->
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="input-group clockpicker" data-autoclose="true">
                                        <span class="input-group-addon">
                                          <span class="fa fa-clock-o"></span>
                                        </span>
                                        <?php $time_option["value"] = $this->Enjin->getDateTime2String($selHistory['SelHistory']['start_date'],false);
                                                $time_option["label"] = false;
                                                $time_option["class"] = 'form-control ct-select1';
                                                echo $this->Form->input('start_time',$time_option ); ?>
                                      </div><!-- end clock-->
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">選考終了予定日時</label>
                                  <div class="col-sm-8 row">
                                    <div class="col-sm-6">
                                      <div class='data_1' id="">
                                        <div class="input-group date">
                                          <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </span>
                                          <?php $date_option["label"] = false;
                                              $date_option["value"] = $this->Enjin->getDateTime2String($selHistory['SelHistory']['end_date']);
                                              $date_option["class"] = 'form-control ct-select1';

                                              echo $this->Form->input('end_date',$date_option); ?>
                                        </div>
                                      </div>
                                      <!-- end id data_1-->
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="input-group clockpicker" data-autoclose="true">
                                        <span class="input-group-addon">
                                          <span class="fa fa-clock-o"></span>
                                        </span>
                                        <?php $time_option["label"] = false;
                                              $time_option["value"] = $this->Enjin->getDateTime2String($selHistory['SelHistory']['end_date'],false);
                                              $time_option["class"] = 'form-control ct-select1';

                                              echo $this->Form->input('end_time',$time_option); ?>
                                      </div><!-- end clock-->
                                    </div>
                                  </div>
                                </div>
                         
                     
                                <div class="form-group"><label class="col-sm-4 control-label">求人票ID</label>
                                  <div class="col-sm-8"><div class="form-control border-none"><?php echo $this->html->link( 
                                                          h( $selHistory['JobVote']['id'] ), 
                                                            array( 'controller'=>'JobVotes',
                                                                 'action'=>'view',
                                                                 $selHistory['JobVote']['id'] ),
                                                                 array( 'class' => 'text-navy' ) ); ?></div></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">求人票タイトル</label>
                                  <div class="col-sm-8"><div class="form-control border-none"><?php echo h( $selHistory['JobVote']['title'] ); ?></div></div>
                                </div>                                        
                     

                                <div class="form-group"><label class="col-sm-4 control-label">選考ステータスオプション</label>
                                  <div class="col-sm-8"><div class="form-control border-none"><?php if( !empty( $selHistory['SelHistory']['select_option_id'] ) )  
                                                              echo h( $selHistory['SelHistory']['select_option_id'] ); ?></div></div>
                                </div>

                                <div class="form-group"><label class="col-sm-4 control-label">掲示年収</label>
                                  <div class="col-sm-8"><div class="form-control border-none"><?php if( !empty( $selHistory['SelHistory']['annual_income'] ) )  
                                                                echo h( $selHistory['SelHistory']['annual_income'] ); ?></div></div>
                                </div>

                                <div class="form-group mbottom15"><label class="col-sm-4 control-label">コメント</label>
                                  <div class="col-sm-8">
                                    <?php echo $this->Form->textarea( 'comment', array( 'rows' => "6", 'class' => "form-control" ) );  ?>
                                  </div>
                                </div>

                                <div class="form-group"><label class="col-sm-4 control-label">訪問先情報</label>
                                  <div class="col-sm-8"><div class="form-control border-none"><?php if( !empty( $selHistory['SelHistory']['visited_info'] ) )  
                                              echo h( $selHistory['SelHistory']['visited_info'] ); ?></div></div>
                                </div>
                              
                                <div class="form-group"><label class="col-sm-4 control-label">流入元企業への選考ステータスの公開可否</label>
                                  <div class="col-sm-8">
                                    <div class="switch form-control border-none">
                                      <div class="onoffswitch">
                                        <?php echo $this->Form->checkbox('influx_propriety',
                                                   array('hiddenField' => false, 'class' => 'onoffswitch-checkbox',
                                                   'id' => 'example2', 'checked' => $selHistory['SelHistory']['influx_propriety'] == 1))?>
                                        <label class="onoffswitch-label" for="example2">
                                          <span class="onoffswitch-inner"></span>
                                          <span class="onoffswitch-switch"></span>
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group"><label class="col-sm-4 control-label">候補者への選考ステータスの公開可否</label>
                                  <div class="col-sm-8"><div class="form-control border-none switch">
                                      <div class="onoffswitch">
                                        <?php echo $this->Form->checkbox('candidate_propriety',
                                               array('hiddenField' => false, 'class' => 'onoffswitch-checkbox',
                                               'id' => 'example3', 'checked' => $selHistory['SelHistory']['candidate_propriety'] == 1))?>
                                        <label class="onoffswitch-label" for="example3">
                                          <span class="onoffswitch-inner"></span>
                                          <span class="onoffswitch-switch"></span>
                                        </label>
                                      </div></div>
                                  </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">最終更新者採用担当者ID</label>
                                  <div class="col-sm-8"><div class="form-control border-none"><?php  if( !empty( $selHistory['SelHistory']['rec_recruiter_id'] ) ) {
                                            echo $this->html->link( 
                                            h( $selHistory['SelHistory']['rec_recruiter_id'] ), 
                                              array( 'controller'=>'RecRecruiters',
                                                   'action'=>'view',
                                                   $selHistory['SelHistory']['rec_recruiter_id'] ),
                                                   array( 'class' => 'text-navy' )  ); } ?></div></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">最終更新流入元担当者ID</label>
                                  <div class="col-sm-8"><div class="form-control border-none"><?php  if( !empty( $selHistory['SelHistory']['inf_staff_id'] ) ) 
                                                echo $this->html->link( 
                                                          h( $selHistory['SelHistory']['inf_staff_id'] ), 
                                                            array( 'controller'=>'RefererCompanies',
                                                                 'action'=>'view',
                                                                 $selHistory['SelHistory']['inf_staff_id'] ),
                                                                 array( 'class' => 'text-navy' ) ); ?></div></div>
                                </div>
                                 <!-- end form 3-->
                              <div class="text-center btn-clear">
                                <?php if($selHistory['SelHistory']['screening_stage_id'] != $firstData['screeningStages']):?>
                                <a class="btn btn-default m-r-md" href="../delete/<?php echo h($selHistory['SelHistory']['id']); ?>">削除</a>
                                <?php endif; ?>
                                <button class="btn btn-primary">更新</button>
                              </div>
                              </form>
                            </div> 
                          </div>
                      </div>
                    </div>

                    <!-- -----end tab-0----- -->
                    </div>
                           <div class = "ibox">
                                <div class="ibox-title">
                                  <h5>最終選考採用担当者</h5>
                                  <div class="ibox-tools">
                                    <a class="collapse-link">
                                      <i class="fa fa-chevron-up"></i>
                                    </a>
                                  </div>
                                </div>
                                <div class="ibox-content p-sm">
                                    <h5><p>面接官（（採用担当者））の登録</p></h5>
                                    <div class='ibox'>
                                        <div class="ibox-content bg-gray clearfix p-sm">
                                            <?php echo $this->Form->create('SelRecruiterHistory',array("url"=>array("controller"=>"Selhistories","action"=>"addInterviewer",$selHistory['SelHistory']['id']))); ?>
                                            <?php echo $this->Form->input('sel_history_id',array("type"=>"hidden","value"=>$selHistory['SelHistory']['id'] )); ?>
                                              <!--to do start1-->
                                              <div>
                                                <div class = "float-lf col-lg-6"> 
                                                  <div><label for="">部署名</label></div>

                                                  <div class='form-group'>
                                                    <?php echo $this->Form->input('rec_department', array( 
                                                      'options' => $RecDepartment,
                                                      'class'=>'full-width btn btn-sm',
                                                      'id' => 'rec_department',
                                                      'label'=> false, 
                                                      'div'=>false,
                                                      'required'=>false,
                                                      'empty' => "",
                                                      'default' => (isset($rec_department)) ? $rec_department : '' )
                                                      ); ?>
                                                  </div>
                                                  

                                                  <div class='form-group'>
                                                    <?php echo $this->Form->input('rec_department_child1', array( 
                                                      'options' =>array( '' ),
                                                      'class'=>'full-width btn btn-sm',
                                                      'id' => 'rec_department_child1',
                                                      'label'=> false, 
                                                      'div'=>false,
                                                      'required'=>false,
                                                      'empty' => "",
                                                      'default' => (isset($rec_department_child1)) ? $rec_department_child1 : '' )
                                                      ); ?>
                                                  </div>

                                                 
                                                  <div class='form-group'>
                                                    <?php echo $this->Form->input('rec_department_child2', array( 
                                                      'options' =>array( '' ),
                                                      'class'=>'full-width btn btn-sm',
                                                      'id' => 'rec_department_child2',
                                                      'label'=> false, 
                                                      'div'=>false,
                                                      'required'=>false,
                                                      'empty' => "",
                                                      'default' => (isset($rec_department_child2)) ? $rec_department_child2 : '' )
                                                      ); ?>
                                                  </div>
                                                </div>

                                                <div class = "float-lf col-lg-6">
                                                  <div class = "margin-lf15"><label for="">採用担当者</label></div>
                                                  <div >
                                                    <div class = "float-lf col-lg-6">
                                                      <?php echo $this->Form->input('rec_recruiter_id', array( 
                                                      'options' =>$recRecruiter,
                                                      'class'=>'full-width btn btn-sm',
                                                      'id' => 'rec_recruiter',
                                                      'label'=> false, 
                                                      'div'=>false,
                                                      'required'=>true,
                                                      'empty' => "",
                                                      'default' => (isset($rec_recruiter)) ? $rec_recruiter : '' )
                                                      ); ?>
                                                    </div>

                                                    <div class = "float-lf col-lg-6">
                                                      <button type="submit" class="margin-lf10 btn btn-primary btn-sm">面接官に追加</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            <?php echo $this->Form->end(); ?>
                                            
                                        </div>
                                        
                                    </div>

                                  <h5><p>面接官（（採用担当者））選考履歴</p></h5>
                                  <script>
                                  $(function(){
                                    var webroot = '<?php echo $this->webroot; ?>';

                                    $('.kitem-hide').hide();

                                    $('.kbt-edit').click(function(){
                                      var current = $(this);
                                      $.post(webroot+'sel_recruiter_histories/api_update',{
                                        "id": $(this).attr('data-id'),
                                        "assign_situation_id": '1'
                                      },function(result){
                                        if(result.code==0){
                                          current.parents('table').find('.kitem-edit'+current.attr('data-order')).show();
                                          current.parents('tr').hide();
                                        }
                                      });
                                    });

                                    $('.kbt-delete').click(function(){
                                      var current = $(this);
                                      $.post(webroot+'sel_recruiter_histories/api_delete/'+current.attr('data-id'),{},
                                        function(result){
                                          if(result.code==0){
                                            current.parents('tr').remove();
                                          }
                                        });
                                    });


                                    $('.kbt-cancel').click(function(){
                                      var current = $(this);
                                      $.post(webroot+'sel_recruiter_histories/api_update',{
                                        "id": $(this).attr('data-id'),
                                        "assign_situation_id": '2'
                                      },function(result){
                                        if(result.code==0){
                                          current.parents('table').find('.kitem-view').show();
                                          current.parents('tr').hide();
                                        }
                                      });
                                    });

                                    $('.kbt-update').click(function(){
                                      var current = $(this);
                                      var wrap = $(this).parents('tr');
                                      var id = $(this).attr('data-id');
                                      var assign_situation_id = wrap.find('.assign-situation-id').attr('data-id');
                                      var eval_rank = wrap.find('#eval_rank').val();
                                      var eval_rank_text = wrap.find('#eval_rank option:selected').text();
                                      var eval_score = wrap.find('#evaluation_score').val();
                                      var eval_comment = wrap.find('#evaluation_comment').val();
                                      $.post(webroot+'sel_recruiter_histories/api_update',{
                                        "id": id,
                                        "assign_situation_id": assign_situation_id,
                                        "evaluation_rank": eval_rank,
                                        "evaluation_score": eval_score,
                                        "evaluation_comment": eval_comment
                                      },function(result){
                                        if(result.code==0){
                                          var showObj = current.parents('table').find('.kitem-view'+current.attr('data-order'));
                                          showObj.find('.eval_rank').html(eval_rank_text);
                                          showObj.find('.eval_score').html(eval_score);
                                          showObj.find('.eval_comment').html(eval_comment);
                                          showObj.show();
                                          current.parents('tr').hide();
                                        }
                                      });
                                    });
                                  });
                                  </script>
                                  <table class="table table-bordered no-margin-bottom">
                                      <thead>
                                        <tr>
                                          <th>採用担当者名</th>
                                          <th>評価ランク</th>
                                          <th class = "col-lg-2">評価スコア</th>
                                          <th>評価コメント</th>
                                          <th>操作</th>
                                        </tr>
                                      </thead>
                                      <tbody>

                                        <?php foreach( $selHistory['SelRecruiterHistory'] as $i => $SelRecruiterHistory ):?>
                                        
                                        <?php if( $SelRecruiterHistory['rec_recruiter_id'] == $rec_company_id ): ?>
                                          <?php switch ( $SelRecruiterHistory['assign_situation_id'] ) : case '0': ?>
                                          
                                          <tr class="kitem-hide kitem-edit<?php echo $i?>">
                                       <td><?php   
                                          echo $this->html->link( 
                                                  h( $SelRecruiterHistory['name'] ), 
                                                    array( 'controller'=>'RecRecruiters',
                                                         'action'=>'view',
                                                         $SelRecruiterHistory['rec_recruiter_id'] ),
                                                         array( 'class' => 'text-navy' ) ); ?>
                                        </td>
                                        <td>
                                          <?php echo $this->Form->input('eval_rank', array( 
                                                      'options' => $evaluation_rank,
                                                      'class'=>'form-control select-w100',
                                                      'label'=> false, 
                                                      'div'=>false,
                                                      'required'=>false,
                                                      'empty' => "",
                                                      'default' => (isset($SelRecruiterHistory['evaluation_rank'])) ? $SelRecruiterHistory['evaluation_rank'] : '' )
                                                      ); ?>
                                        </td>
                                        <td><?php echo $this->Form->input( 'evaluation_score', 
                                                          array( 'type' => 'number', 
                                                                 'class' => 'form-control',
                                                                 'label'=> false,
                                                                 'default' => (isset($SelRecruiterHistory['evaluation_score'])?$SelRecruiterHistory['evaluation_score']:'')
                                                                   ) ); ?></td>
                                        <td><?php echo $this->Form->input( 'evaluation_comment', 
                                                          array( 'type' => '', 
                                                                 'class' => 'form-control',
                                                                 'label'=> false,
                                                                 'default'=> (isset($SelRecruiterHistory['evaluation_comment'])?$SelRecruiterHistory['evaluation_comment']:'')
                                                                   ) ); ?>
                                        </td>
                                        <td>
                                          <div class = "margin-lf10">
                                            <div class="hidden assign-situation-id" data-id="2"></div>
                                            <div class = "float-lf margin-right5">
                                              <button class="full-width btn btn-xs btn-primary kbt-update" data-order="<?php echo $i?>" data-id="<?php echo $SelRecruiterHistory['id'] ?>" >更新</button></div>
                                            <div class = "float-lf">
                                              <button class="full-width btn btn-xs btn-primary kbt-delete" id="selRecDelete" data-id="<?php echo $SelRecruiterHistory['id'] ?>" >解除</button></div>
                                          </div>
                                        </td>
                                        </tr>
                                          <tr>
                                         <td><?php   
                                          echo $this->html->link( 
                                                  h( $SelRecruiterHistory['name'] ), 
                                                    array( 'controller'=>'RecRecruiters',
                                                         'action'=>'view',
                                                         $SelRecruiterHistory['rec_recruiter_id'] ),
                                                         array( 'class' => 'text-navy' ) ); ?></td>
                                        <td><?php if( isset( $SelRecruiterHistory['evaluation_rank'] ) ) 
                                            echo h( $evaluation_rank[ $SelRecruiterHistory['evaluation_rank'] ] ); ?></td>
                                        <td>
                                          <?php if( !empty( $SelRecruiterHistory['evaluation_score'] ) )
                                                echo h( $SelRecruiterHistory['evaluation_score'] ); ?></td>
                                        <td><?php if( !empty( $SelRecruiterHistory['evaluation_comment'] ) )
                                                echo h( $SelRecruiterHistory['evaluation_comment'] ); ?></td>
                                        <td>
                                          <div class = "margin-lf10">
                                            <div class="hidden assign-situation-id" data-id="0"></div>
                                            <div class = "float-lf margin-right5">
                                              <button class="full-width btn btn-xs btn-primary kbt-edit" data-order="<?php echo $i?>" data-id="<?php echo $SelRecruiterHistory['id'] ?>" >評価入力</button></div>
                                            <div class = "float-lf">
                                              <button class="full-width btn btn-xs btn-primary kbt-delete" id="selRecDelete" data-id="<?php echo $SelRecruiterHistory['id'] ?>" >解除</button></div>
                                          </div>
                                        </td>
                                        </tr>
                                        <tr class="kitem-hide kitem-view<?php echo $i?>">
                                       <td><?php   
                                          echo $this->html->link( 
                                                  h( $SelRecruiterHistory['name'] ), 
                                                    array( 'controller'=>'RecRecruiters',
                                                         'action'=>'view',
                                                         $SelRecruiterHistory['rec_recruiter_id'] ),
                                                         array( 'class' => 'text-navy' ) ); ?></td>
                                        <td class="eval_rank"></td>
                                        <td class="eval_score"></td>
                                        <td class="eval_comment"></td>
                                        <td>
                                          <div class = "margin-lf10">
                                          <div class="hidden assign-situation-id" data-id="2"></div>
                                            <div class = "float-lf margin-right5">
                                              <button class="full-width btn btn-xs btn-primary kbt-edit" data-order="<?php echo $i?>" data-id="<?php echo $SelRecruiterHistory['id'] ?>" >修正</button></div>
                                          </div>
                                        </td>
                                        </tr>

                                       <?php       break; ?>

                                       <?php     case '1': ?>
                                       
                                       <tr class="kitem-edit<?php echo $i?>">
                                       <td><?php   
                                          echo $this->html->link( 
                                                  h( $SelRecruiterHistory['name'] ), 
                                                    array( 'controller'=>'RecRecruiters',
                                                         'action'=>'view',
                                                         $SelRecruiterHistory['rec_recruiter_id'] ),
                                                         array( 'class' => 'text-navy' ) ); ?>
                                        </td>
                                        <td>
                                          <?php echo $this->Form->input('eval_rank', array( 
                                                      'options' => $evaluation_rank,
                                                      'class'=>'form-control select-w100',
                                                      'label'=> false, 
                                                      'div'=>false,
                                                      'required'=>false,
                                                      'empty' => "",
                                                      'default' => (isset($SelRecruiterHistory['evaluation_rank'])) ? $SelRecruiterHistory['evaluation_rank'] : '' )
                                                      ); ?>
                                        </td>
                                        <td><?php echo $this->Form->input( 'evaluation_score', 
                                                          array( 'type' => 'number', 
                                                                 'class' => 'form-control',
                                                                 'label'=> false,
                                                                 'default'=>(isset($SelRecruiterHistory['evaluation_score'])?$SelRecruiterHistory['evaluation_score']:'')
                                                                   ) ); ?></td>
                                        <td><?php echo $this->Form->input( 'evaluation_comment', 
                                                          array( 'type' => '', 
                                                                 'class' => 'form-control',
                                                                 'label'=> false,
                                                                 'default'=> (isset($SelRecruiterHistory['evaluation_comment'])?$SelRecruiterHistory['evaluation_comment']:'')
                                                                   ) ); ?>
                                        </td>
                                        <td>
                                          <div class = "margin-lf10">
                                            <div class="hidden assign-situation-id" data-id="2"></div>
                                            <div class = "float-lf margin-right5">
                                              <button class="full-width btn btn-xs btn-primary kbt-update" data-order="<?php echo $i?>" data-id="<?php echo $SelRecruiterHistory['id'] ?>" >更新</button></div>
                                            <div class = "float-lf">
                                              <button class="full-width btn btn-xs btn-primary kbt-delete" id="selRecDelete" data-id="<?php echo $SelRecruiterHistory['id'] ?>" >解除</button></div>
                                          </div>
                                        </td>
                                        </tr>
                                        <tr class="kitem-hide kitem-view<?php echo $i?>">
                                       <td><?php   
                                          echo $this->html->link( 
                                                  h( $SelRecruiterHistory['name'] ), 
                                                    array( 'controller'=>'RecRecruiters',
                                                         'action'=>'view',
                                                         $SelRecruiterHistory['rec_recruiter_id'] ),
                                                         array( 'class' => 'text-navy' ) ); ?></td>
                                        <td class="eval_rank"><?php if( isset( $SelRecruiterHistory['evaluation_rank'] ) ) 
                                            echo h( $evaluation_rank[ $SelRecruiterHistory['evaluation_rank'] ] ); ?></td>
                                        <td class="eval_score">
                                          <?php if( !empty( $SelRecruiterHistory['evaluation_score'] ) )
                                                echo h( $SelRecruiterHistory['evaluation_score'] ); ?></td>
                                        <td class="eval_comment"><?php if( !empty( $SelRecruiterHistory['evaluation_comment'] ) )
                                                echo h( $SelRecruiterHistory['evaluation_comment'] ); ?></td>
                                        <td>
                                          <div class = "margin-lf10">
                                          <div class="hidden assign-situation-id" data-id="2"></div>
                                            <div class = "float-lf margin-right5">
                                              <button class="full-width btn btn-xs btn-primary kbt-edit" data-order="<?php echo $i?>" data-id="<?php echo $SelRecruiterHistory['id'] ?>" >修正</button></div>
                                          </div>
                                        </td>
                                        </tr>
                                       <?php       break; ?>
                                       <?php     case '2': ?>
                                       <tr class="kitem-hide kitem-edit<?php echo $i?>">
                                       <td><?php   
                                          echo $this->html->link( 
                                                  h( $SelRecruiterHistory['name'] ), 
                                                    array( 'controller'=>'RecRecruiters',
                                                         'action'=>'view',
                                                         $SelRecruiterHistory['rec_recruiter_id'] ),
                                                         array( 'class' => 'text-navy' ) ); ?>
                                        </td>
                                        <td>
                                          <?php echo $this->Form->input('eval_rank', array( 
                                                      'options' => $evaluation_rank,
                                                      'class'=>'form-control select-w100',
                                                      'label'=> false, 
                                                      'div'=>false,
                                                      'required'=>false,
                                                      'empty' => "",
                                                      'default' => (isset($SelRecruiterHistory['evaluation_rank'])) ? $SelRecruiterHistory['evaluation_rank'] : '' )
                                                      ); ?>
                                        </td>
                                        <td><?php echo $this->Form->input( 'evaluation_score', 
                                                          array( 'type' => 'number', 
                                                                 'class' => 'form-control',
                                                                 'label'=> false,
                                                                 'default' => (isset($SelRecruiterHistory['evaluation_score'])?$SelRecruiterHistory['evaluation_score']:'')
                                                                   ) ); ?></td>
                                        <td><?php echo $this->Form->input( 'evaluation_comment', 
                                                          array( 'type' => '', 
                                                                 'class' => 'form-control',
                                                                 'label'=> false,
                                                                 'default'=> (isset($SelRecruiterHistory['evaluation_comment'])?$SelRecruiterHistory['evaluation_comment']:'')
                                                                   ) ); ?>
                                        </td>
                                        <td>
                                          <div class = "margin-lf10">
                                            <div class="hidden assign-situation-id" data-id="2"></div>
                                            <div class = "float-lf margin-right5">
                                              <button class="full-width btn btn-xs btn-primary kbt-update" data-order="<?php echo $i?>" data-id="<?php echo $SelRecruiterHistory['id'] ?>" >更新</button></div>
                                            <div class = "float-lf">
                                              <button class="full-width btn btn-xs btn-primary kbt-delete" id="selRecDelete" data-id="<?php echo $SelRecruiterHistory['id'] ?>" >解除</button></div>
                                          </div>
                                        </td>
                                        </tr>
                                       <tr class="kitem-view<?php echo $i?>">
                                       <td><?php   
                                          echo $this->html->link( 
                                                  h( $SelRecruiterHistory['name'] ), 
                                                    array( 'controller'=>'RecRecruiters',
                                                         'action'=>'view',
                                                         $SelRecruiterHistory['rec_recruiter_id'] ),
                                                         array( 'class' => 'text-navy' ) ); ?></td>
                                        <td class="eval_rank"><?php if( isset( $SelRecruiterHistory['evaluation_rank'] ) ) 
                                            echo h( $evaluation_rank[ $SelRecruiterHistory['evaluation_rank'] ] ); ?></td>
                                        <td class="eval_score">
                                          <?php if( !empty( $SelRecruiterHistory['evaluation_score'] ) )
                                                echo h( $SelRecruiterHistory['evaluation_score'] ); ?></td>
                                        <td class="eval_comment"><?php if( !empty( $SelRecruiterHistory['evaluation_comment'] ) )
                                                echo h( $SelRecruiterHistory['evaluation_comment'] ); ?></td>
                                        <td>
                                          <div class = "margin-lf10">
                                          <div class="hidden assign-situation-id" data-id="2"></div>
                                            <div class = "float-lf margin-right5">
                                              <button class="full-width btn btn-xs btn-primary kbt-edit" data-order="<?php echo $i?>" data-id="<?php echo $SelRecruiterHistory['id'] ?>" >修正</button></div>
                                          </div>
                                        </td>
                                        </tr>
                                       <?php       break; ?>
                                       <?php     case '3': ?>
                                       <tr>
                                       <td><?php   
                                          echo $this->html->link( 
                                                  h( $SelRecruiterHistory['name'] ), 
                                                    array( 'controller'=>'RecRecruiters',
                                                         'action'=>'view',
                                                         $SelRecruiterHistory['rec_recruiter_id'] ),
                                                         array( 'class' => 'text-navy' ) ); ?></td>
                                        <td><?php if( isset( $SelRecruiterHistory['evaluation_rank'] ) ) 
                                            echo h( $evaluation_rank[ $SelRecruiterHistory['evaluation_rank'] ] ); ?></td>
                                        <td>
                                          <?php if( !empty( $SelRecruiterHistory['evaluation_score'] ) )
                                                echo h( $SelRecruiterHistory['evaluation_score'] ); ?></td>
                                        <td><?php if( !empty( $SelRecruiterHistory['evaluation_comment'] ) )
                                                echo h( $SelRecruiterHistory['evaluation_comment'] ); ?></td>
                                        <td></td>
                                       <?php       break; ?>


                                       <?php     default: ?>
                                       <?php       # code... ?>
                                       <?php       break; ?>
                                        <?php  endswitch; ?>
                                        
                                      <tr>
                                      <?php else: ?>
                                      <tr>
                                      <td><?php   
                                          echo $this->html->link( 
                                                  h( $SelRecruiterHistory['name'] ), 
                                                    array( 'controller'=>'RecRecruiters',
                                                         'action'=>'view',
                                                         $SelRecruiterHistory['rec_recruiter_id'] ),
                                                         array( 'class' => 'text-navy' ) ); ?></td>
                                        <td><?php if( isset( $SelRecruiterHistory['evaluation_rank'] ) ) 
                                            echo h( $evaluation_rank[ $SelRecruiterHistory['evaluation_rank'] ] ); ?></td>
                                        <td>
                                          <?php if( !empty( $SelRecruiterHistory['evaluation_score'] ) )
                                                echo h( $SelRecruiterHistory['evaluation_score'] ); ?></td>
                                        <td><?php if( !empty( $SelRecruiterHistory['evaluation_comment'] ) )
                                                echo h( $SelRecruiterHistory['evaluation_comment'] ); ?></td>
                                        <td></td>
                                        </tr>

                                    <?php endif; ?>
                                    
                                  <?php endforeach; ?>
                                        
                                      </tbody>
                                </table>

                                  <!-- table -->
                              </div>
                            </div>
                    </div>
                    <div class="col-lg-4">
                      <?php echo $this->element('jobvote',$selHistory['JobVote']); ?>
<?php echo $this->element('reccompany', $RecCompany['RecCompany']); ?>
                      <!--end table 2-->
                    </div>
                  </div>
                  
                </div>
          
                  

                <!-- -------------end content------------- -->
                <!-- -------------end content------------- -->
                <!-- -------------end content------------- -->
                <!-- -------------end content------------- -->
                <!-- -------------end content------------- -->
<?php echo $this->element('b_back_nav')?>

<script>
  $(document).ready(function () {

    var $image = $(".image-crop > img")
    $($image).cropper({
      aspectRatio: 1.618,
      preview: ".img-preview",
      done: function (data) {
          // Output the result data for cropping image.
        }
      });

    var $inputImage = $("#inputImage");
    if (window.FileReader) {
      $inputImage.change(function () {
        var fileReader = new FileReader(),
        files = this.files,
        file;

        if (!files.length) {
          return;
        }

        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          fileReader.readAsDataURL(file);
          fileReader.onload = function () {
            $inputImage.val("");
            $image.cropper("reset", true).cropper("replace", this.result);
          };
        } else {
          showMessage("Please choose an image file.");
        }
      });
    } else {
      $inputImage.addClass("hide");
    }


    $('#data_1 .input-group.date').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true
    });

    $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green'
    });

    $('.clockpicker').clockpicker();

    $('input[name="daterange"]').daterangepicker();

    $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

    $('#reportrange').daterangepicker({
      format: 'MM/DD/YYYY',
      startDate: moment().subtract(29, 'days'),
      endDate: moment(),
      minDate: '01/01/2012',
      maxDate: '12/31/2015',
      dateLimit: {days: 60},
      showDropdowns: true,
      showWeekNumbers: true,
      timePicker: false,
      timePickerIncrement: 1,
      timePicker12Hour: true,
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      opens: 'right',
      drops: 'down',
      buttonClasses: ['btn', 'btn-sm'],
      applyClass: 'btn-primary',
      cancelClass: 'btn-default',
      separator: ' to ',
      locale: {
        applyLabel: 'Submit',
        cancelLabel: 'Cancel',
        fromLabel: 'From',
        toLabel: 'To',
        customRangeLabel: 'Custom',
        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        firstDay: 1
      }
    }, function (start, end, label) {
      console.log(start.toISOString(), end.toISOString(), label);
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
});
</script>

<script>
$(document).on('change','#rec_department',function(){
    if($('#rec_department').val() == ''){
        $('#rec_department_child1 > option').remove();
        $('#rec_department_child2 > option').remove();
        $('#rec_recruiter > option').remove();
        $('#rec_department_child1').append($('<option>').html('select').val(''));
        $('#rec_department_child2').append($('<option>').html('select').val(''));
        $('#rec_recruiter').append($('<option>').html('select').val(''));

        alert('部署を選択してください。');
        return;
    }
    var _url = '<?php echo $this->webroot;?>RecDepartments/listsByParant/' + $('#rec_department option:selected').val();
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res) {  
                    
                    $('#rec_department_child1 > option').remove();
                    $('#rec_department_child2 > option').remove();
                    $('#rec_department_child1').append($('<option>').html('select').val(''));
                    $('#rec_department_child2').append($('<option>').html('select').val(''));
                    $.each(res, function(i, val) {

                       $('#rec_department_child1').append($('<option>').html(val).val(i));
                    });

            }
        }
    });

    var _url = '<?php echo $this->webroot;?>RecRecruiters/listBydepartment/' + $('#rec_department option:selected').val();
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res) {  
                    $('#rec_recruiter > option').remove();
                    $('#rec_recruiter').append($('<option>').html('select').val(''));
                    $.each(res, function(i, val) {

                       $('#rec_recruiter').append($('<option>').html(val).val(i));
                    });

            }
        }
    });
});

$(document).on('change','#rec_department_child1',function(){
    if($('#rec_department_child1').val() == ''){
        var num = '#rec_department';
        alert(num.toString());
        $('#rec_department_child2 > option').remove();
        $('#rec_recruiter > option').remove();
        $('#rec_department_child2').append($('<option>').html('select').val(''));
        $('#rec_recruiter').append($('<option>').html('select').val(''));
    } else {
      var num = '#rec_department_child1';
      var _url = '<?php echo $this->webroot;?>RecDepartments/listsByParant/' + $('#rec_department_child1 option:selected').val();
      $.ajax({
          type: "GET",
          dataType: "JSON",
          url: _url,
          success: function(res){
              if(res) {  
                      
                      $('#rec_department_child2 > option').remove();
                      $('#rec_department_child2').append($('<option>').html('select').val(''));
                      $.each(res, function(i, val) {

                         $('#rec_department_child2').append($('<option>').html(val).val(i));
                      });

              }
          }
      });
    }
    var _url = '<?php echo $this->webroot;?>RecRecruiters/listBydepartment/' + $(num.toString()+' option:selected').val();
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res) {  
                    
                    $('#rec_recruiter > option').remove();
                    $('#rec_recruiter').append($('<option>').html('select').val(''));
                    $.each(res, function(i, val) {

                       $('#rec_recruiter').append($('<option>').html(val).val(i));
                    });

            }
        }
    });
});

$(document).on('change','#rec_department_child2',function(){
    if($('#rec_department_child2').val() == ''){
      var num = '#rec_department_child1';
        $('#rec_department_child2 > option').remove();
        $('#rec_department_child2').append($('<option>').html('select').val(''));
    }else {
      var num = '#rec_department_child2';
    }
    var _url = '<?php echo $this->webroot;?>RecRecruiters/listBydepartment/' + $(num.toString()+' option:selected').val();
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res) {  
                    
                    $('#rec_recruiter > option').remove();
                    $('#rec_recruiter').append($('<option>').html('select').val(''));
                    $.each(res, function(i, val) {

                       $('#rec_recruiter').append($('<option>').html(val).val(i));
                    });

            }
        }
    });
});

//調整中ボタンクリックイベント
$('.updateAdjust').on('click', function(){
    var id = $( this ).data('id');
    var _url = '<?php echo $this->webroot;?>SelRecruiterHistory/update/'+id;

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res.status) {
                if(res.data) {
                    $("#EvHistoryTmpl").tmpl(res.data).appendTo("#EvHistoryBox").find('.evstatus').data('id', res.data.ev_history_id);
                }
            }
        }
    });
});


/* Update  */
$(document).on('change','.evstatus',function(){
    if($(this).val() == ''){
        alert('参加ステータスを選択してください。');
        return;
    }
    var id = $( this ).data('id');
    var _url = '<?php echo $this->webroot;?>SelRecruiterHistory/update/'+id;

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res.status) {
                alert('参加ステータスを更新しました。');
            }else{
                alert('参加ステータスの更新に失敗しました。');
            }
        }
    });
});


</script>
<style>
.DTTT_container{
display: none;
}
.dataTables_info{
display: none;
}
.dataTables_length{
display: none;
}

.dataTables_filter{
display: none;
}
</style>
