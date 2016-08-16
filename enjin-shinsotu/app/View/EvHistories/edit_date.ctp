<!-- title -->
<?php echo $this->element('back_nav', array('text' => __('イベント詳細｜ivent0123456-1~ 2 2015年5月10日 会社説明会')))?>
<!-- end title -->

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none evhistories">
  <!-- content --> 

  <div class='full-content'>

    <!-- イベント情報 -->
    <div class='col-lg-8'>
      <div class="ibox">

        <div class="ibox-title">
          <h5 class="color-676a6c">イベント情報</h5>

          <!-- action change url -->
          <div class="ibox-tools">
            <?php echo $this->Html->link('編集', array('controller'=>'EvEvents','action' => 'edit',$evEvents["EvEvents"]['id']),array('class'=>'btn btn-primary btn-xs')); ?>
          </div>
          <!-- end action -->

        </div>
        <div class="ibox-content bg-white p-sm">
        <form method="get" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-4 control-label">イベント名</label>
            <div class="col-sm-8">
              <div class="form-control border-none"><?php echo $evEvents["EvEvents"]["name"] ?></div>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-4 control-label">求人票ID</label>
            <div class="col-sm-8">
              <div class="form-control border-none"><?php echo $evEvents["EvEvents"]["job_vote_id"] ?></div>     
            </div>               
          </div>

          <div class="form-group"><label class="col-sm-4 control-label">イベント種別</label>
            <div class="col-sm-8">
              <div class="form-control border-none"><?php echo $type[$evEvents["EvEvents"]["type"]]; ?></div>
            </div>
          </div>

          <div class="form-group"><label class="col-sm-4 control-label">ターゲット選考段階ID</label>
            <div class="col-sm-8">
              <div class="form-control border-none"><?php echo $evEvents["EvEvents"]["screening_stage_id"] ?></div>
            </div>
          </div>
          <div class="form-group"><label class="col-sm-4 control-label">ターゲット選考段階比較タイプ</label>
            <div class="col-sm-8">
              <div class="form-control border-none"><?php echo $screening_stage_type[$evEvents["EvEvents"]["screening_stage_type"]] ?></div>
            </div> 
          </div>
          <div class="form-group"><label class="col-sm-4 control-label">ターゲット選考ステータス （（マスタ））</label>
            <div class="col-sm-8">
              <div class="form-control border-none"><?php echo $select_judgment_type[$evEvents["EvEvents"]["status"]] ?></div>
            </div>
          </div>
          <div class="form-group"><label class="col-sm-4 control-label">イベント内容</label>
            <div class="col-sm-8">
              <div class="form-control border-none"><?php echo $evEvents["EvEvents"]["contents"] ?></div>                                
            </div>
          </div>
          <div class="form-group"><label class="col-sm-4 control-label">リクナビID</label>
            <div class="col-sm-8">
              <div class="form-control border-none"><?php echo $evEvents["EvEvents"]["rikunavi_id"] ?></div>                                
            </div>
          </div>
          <div class="form-group"><label class="col-sm-4 control-label">マイナビID</label>
            <div class="col-sm-8">
              <div class="form-control border-none"><?php echo $evEvents["EvEvents"]["mynavi_id"] ?></div>                                
            </div>
          </div>
        </form>                                        
      </div>
      </div>
    </div>
    <!-- end イベント情報 -->

    <!-- イベント担当者登録 -->
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-title">
          <h5>イベント担当者登録</h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>                                                           
          </div>
        </div>
        <div class="ibox-content clearfix p-sm">
          <div class="">
            <div class="table-border">
              <table class="table table-bordered no-margin-bottom">
                <thead>
                  <tr>
                    <th>イベント担当者名</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($recRecruiterByEvents as $recRecruiter): ?>

                  <tr>
                    <td><a class="text-navy" href=""><?php echo $recRecruiter['RecRecruiter']['last_name']; ?> <?php echo $recRecruiter['RecRecruiter']['first_name']; ?></a></td>
                    <td class="table-button-tdright hover-button">
                      <?php echo $this->Html->link(__('削除'),
                        '',
                        array('class' => 'full-width btn btn-default btn-xs cl-white',
                          'data-path' => 'RecRecruiters/api_delete/'.$recRecruiter['RecRecruiter']['id']
                          )
                        );
                     ?>

                    </td>
                  </tr>

                <?php endforeach; ?>                                 
                </tbody>
              </table>    
            </div>
          </div>  
        </div>
        <div class="ibox-content clearfix bg-gray pd-9">
          <table class="table no-margin-bottom">
            <tbody>
              <tr>
                <td class="no-borders ver-mid btn-group btn-block">


                  <select class="form-control" id="recRecruiters">
                      <?php foreach ($recRecruiters as $recRecruiter): ?> 
                        <option><?php echo $recRecruiter["RecRecruiter"]["last_name"]; ?> <?php echo $recRecruiter["RecRecruiter"]['first_name']; ?></option>
                      <?php endforeach; ?>                
                  </select>
                </td>                                
                <td class="no-borders ver-mid">
                  <button class="full-width btn btn-primary btn-sm" id="addRecruiter">追加</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>             
      </div>                      
    </div>
    <!-- end イベント担当者登録 -->

  </div>

  <!-- dot -->
  <div class='col-lg-12 border-dot'></div>

  <!-- イベント開催日程 -->
  <div class='col-lg-12 wrapper-content-title top-title'>
    <div class='title-tab'>
      <h3 class="color-676a6c">イベント開催日程</h3>
    </div>
  </div>
  <!-- end イベント開催日程 -->

  <div class='full-content'>
    <div class="col-lg-8">
      <div class="tabs-container ibox">
        <ul class="nav nav-tabs" data-tabs="tabs">
          <?php $i=1; $holding_date;?>
          <?php foreach ($evScheduleByEvents as $evScheduleByEvent): ?>
            <li class="<?php if (!empty($evScheduleByEvent['EvSchedule']['active'])) { echo $evScheduleByEvent['EvSchedule']['active'];}?>"><a href="<?php echo $evScheduleByEvent['EvSchedule']['id']; ?>"?><?php echo date('Y', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>年<?php echo date('m', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>月<?php echo date('d', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); $holding_date = date('Y-m-d', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>日 </a></li>
          <?php $i++; ?>  
          <?php endforeach;?>

        </ul>

        <?php $k=1; reset($evScheduleByEvents);?>
          <div class="tab-content">
          <?php foreach ($evScheduleByEvents as $evScheduleByEvent): ?>
            <div id="tab<?php echo $k; ?>" class="tab-pane <?php if (!empty($evScheduleByEvent['EvSchedule']['active'])) { echo 'active';}?>">
              <div class="panel-body">                            
                <div class="ibox-content" style="display: <?php if (!empty($evScheduleByEvent['EvSchedule']['active'])) { echo 'block';} else {echo 'none';} ?>">
                  <form method="get" class="form-horizontal">
                    <div class="form-group"><label class="col-sm-4 control-label">開催日時</label>
                      <div class="col-sm-8">
                        <div class="form-control border-none"><?php echo date('Y', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>年<?php echo date('m', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>月<?php echo date('d', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>日 <?php echo date('H:i:s', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?></div>
                      </div>
                    </div>    
                    <div class="form-group"><label class="col-sm-4 control-label">終了日時</label>
                      <div class="col-sm-8">
                        <div class="form-control border-none"><?php echo date('Y', strtotime($evScheduleByEvent["EvSchedule"]["end_date"])); ?>年<?php echo date('m', strtotime($evScheduleByEvent["EvSchedule"]["end_date"])); ?>月<?php echo date('d', strtotime($evScheduleByEvent["EvSchedule"]["end_date"])); ?>日 <?php echo date('H:i:s', strtotime($evScheduleByEvent["EvSchedule"]["end_date"])); ?></div>
                      </div>
                    </div>  
                    <div class="form-group"><label class="col-sm-4 control-label">個別テーマ</label>
                      <div class="col-sm-8">
                        <div class="form-control border-none"><?php echo $evScheduleByEvent["EvSchedule"]["individual_theme"]; ?></div>
                      </div>
                    </div>  
                    <div class="form-group"><label class="col-sm-4 control-label">当日内容</label>
                      <div class="col-sm-8">
                        <div class="form-control border-none h-auto">

                          <li><?php echo $evScheduleByEvent["EvSchedule"]["day_content"]; ?></li>
                          
                        </div>
                      </div>
                    </div>  
                    <div class="form-group"><label class="col-sm-4 control-label">定員数</label>
                      <div class="col-sm-8">
                        <div class="form-control border-none"><?php echo $evScheduleByEvent["EvSchedule"]["capacity"]; ?>人</div>
                      </div>
                    </div>  
                    <div class="form-group"><label class="col-sm-4 control-label">募集締切日</label>
                      <div class="col-sm-8">
                        <div class="form-control border-none"><?php echo date('Y', strtotime($evScheduleByEvent["EvSchedule"]["wanted_deadline"])); ?>年<?php echo date('m', strtotime($evScheduleByEvent["EvSchedule"]["wanted_deadline"])); ?>月<?php echo date('d', strtotime($evScheduleByEvent["EvSchedule"]["wanted_deadline"])); ?>日</div>
                      </div>
                    </div>  
                    <div class="form-group"><label class="col-sm-4 control-label">開催場所</label>
                      <div class="col-sm-8">
                        <div class="form-control border-none">第 <?php echo $evScheduleByEvent["EvSchedule"]["venue"]; ?></div>
                      </div>
                    </div>      
                    <div class="form-group"><label class="col-sm-4 control-label">開催費用</label>
                      <div class="col-sm-8">
                        <div class="form-control border-none"><?php echo $evScheduleByEvent["EvSchedule"]["holding_cost"]; ?>円</div>
                      </div>
                    </div>                                                                                
                    <div class="btn-clear text-center">
                      <button class="btn-tab btn-primary w-95" type="submit">編集</button>
                    </div>
                  </form>
                </div> 
              </div>
            </div>
            <!-- end tab 2-->
            <?php $k++; ?> 
            <?php endforeach; ?>
          </div>
      </div>
    </div>
    <!-- end tab 2015年5月20日 -->

    <div class="col-lg-4">
      <div class="ibox">
      <div class="ibox-title">
        <h5>イベント担当者登録</h5>
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>                                                           
        </div>
      </div>
      <div class="ibox-content clearfix p-sm">
        <div id="calendar" class="fc fc-ltr fc-unthemed">
        </div>
      </div>                               
    </div>

    </div>
</div>
    <!-- table イベント情報 -->
    <div class='full-content col-lg-12'>
      <div class='ibox'>
        <div class="ibox-title">
          <h5 class="color-676a6c">イベント情報</h5>                          
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>                                                           
          </div>
        </div>
        <div class='ibox-content pd-none'>                     
          <div class="ibox-content p-sm bg-white">
            <div class="">
              <div class="four-action">
                <div class='b-cal four-action'>
                  <div class='pull-left m-r-sm'>
                    <div class="no-borders ver-mid btn-group btn-block">
                      <button data-toggle="dropdown" class="m-r-sm btn btn-white btn-sm dropdown-toggle btn-block t-align-left">採用担当者選択<span class="caret sl-btn"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="#">2採用担当者選択</a></li>
                        <li><a href="#">3採用担当者選択</a></li>
                        <li><a href="#">4採用担当者選択</a></li>                                     
                      </ul>
                    </div>
                  </div>
                  <div class='pull-left'>
                    <button type="button" class="btn btn-sm btn-white email">
                      <i class="fa fa-envelope-o"></i>
                    </button>
                  </div>
                  <div class='pull-left'>
                    <button type="submit" class="btn btn-sm btn-white print">
                      <i class="fa fa-print"></i>
                    </button>
                  </div>
                  <div class='pull-left m-r-sm selectagent'>
                    <div class="no-borders ver-mid btn-group btn-block">
                      <button data-toggle="dropdown" class="btn btn-white btn-sm dropdown-toggle btn-block t-align-left">その他<span class="caret sl-btn"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="#">その他</a></li>
                        <li><a href="#">その他</a></li>        
                      </ul>
                    </div>
                  </div>
                  
                  <div class='pull-left newcan'>
                    <a href="<?php echo $this->webroot;?>CanCandidates/add"><button class='btn btn-primary btn-sm m-r-sm new '>新規候補者登録</button></a>
                  </div>
                  <div class='pull-left'>
                    <button class='btn btn-primary btn-sm m-r-sm csv '>参加者CSV登録</button>
                  </div>                    
                  <!-- pagination -->
                    <div class="bottom_pagination1 pull-right">
                        <?php echo $this->element('pagination1')?>
                    </div>
                    
                    <div class='clearfix'></div>
                  <!-- end pagination -->
                  <div class='clear'></div>
                </div>
                <div class="table-responsive enj_res">

                  <table class="table table-center tb1-chb table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class='t-align-left'>
                          <div>
                            <input type="checkbox" class="i-checks" name="input[]">
                          </div>
                        </th>
                        <th>候補者ID</th>
                        <th>名前</th>
                        <th>大学名</th>
                        <th>参加ステータス</th>
                        <th>提出書類</th>
                        <th>あなたの評価</th>
                        <th style="width: 80px">コメント</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($canCandidates as $canCandidate): ?>
              <tr>
                <td>
                  <?php echo $this->Form->input( 'can_candidate_id.', array( "type"=>"checkbox", 'class'=>"i-checks" , 'label'=>false, 'value' => $canCandidate['CanCandidate']['id'],'hiddenField' => true)); ?>
                </td>
                <td><?php echo $this->Html->link($canCandidate['CanCandidate']['id'], array('controller'=>'CanCandidates','action' => 'index', $canCandidate['CanCandidate']['id'])); ?></td>
                <td><a href="#"><?php echo $this->Html->link($canCandidate['CanCandidate']['name'], array('controller'=>'CanCandidates','action' => 'index', $canCandidate['CanCandidate']['id'])); ?></a></td>
                <td><?php if (!empty($canCandidate['CanEducation'][0]['school'])) { echo h($canCandidate['CanEducation'][0]['school']); } ?></td>
                

                <td>
                  <?php $status_default=""; $historyID="";$candidate_id="";$evhistory_id="";$selhistory_id="";?>

                  <?php if( is_array($canCandidate['EvHistory']) && isset($canCandidate['EvHistory'][0]) && $canCandidate['EvHistory'][0]['can_candidate_id'] == $canCandidate['CanCandidate']['id']) {
                        $status_default = $canCandidate['EvHistory'][0]['status'];
                        $historyID=$canCandidate['EvHistory'][0]['id'];
                        $candidate_id=$canCandidate['CanCandidate']['id'];
                        $evhistory_id=$canCandidate['EvHistory'][0]['id'];
                        
                  } ?>
                  <?php echo $this->Form->input('evHistoryStatus', array('type'=>'select', 'label'=>false, 'data-id'=>$historyID, 'class'=>'form-control evHistoryStatus', 'options'=>$evHistoryStatus,'default'=>$status_default)); ?>
                </td>


                <td>
                  <span class='dp-inl'>
                    <a class='text-with-btn pull-left' href="">
                      <div class='content_border_button text-with-btn pull-left'>
                        <div>
                          <?php if( isset($canCandidate['CanDocument'][0]['sel_history_id'])) {
                              $selhistory_id=$canCandidate['CanDocument'][0]['sel_history_id'];
                          }?>
                          
                          <a class="showDetailCandocument" href="#modal-form" data-can="<?php echo $candidate_id; ?>" data-ev="<?php echo $evhistory_id;?>" data-sel="<?php echo $selhistory_id; ?>" id="count_<?php echo $canCandidate['CanCandidate']['id']; ?>" data-toggle="modal" data-target="#myModal"><?php echo count($canCandidate['CanDocument']); ?></a>
                        </div>
                      </div>
                    </a>
                    <button class='btn btn-primary btn-xs pull-right'>ファイル追加</button>
                  </span>

                </td>

                <td>
                  <?php $default = "";?>
                  <?php if( is_array($canCandidate['EvHistory']) && isset($canCandidate['EvHistory'][0]) && $canCandidate['EvHistory'][0]['can_candidate_id'] == $canCandidate['CanCandidate']['id']) {
                        $default = $canCandidate['EvHistory'][0]['after_score'];
                  } ?>
                  
                  <?php echo $this->Form->input('afterScore', array('type'=>'select', 'label'=>false, 'class'=>'form-control t-align-left', 'options'=>$afterScore,'default'=>$default)); ?>
                </td>
                <td><input type='text' class='form-control' value="<?php if (!empty($canCandidate['EvHistory'][0]['after_comment'])) { echo $canCandidate['EvHistory'][0]['after_comment']; } ?>" /></td>                                 
                <td><button class='btn btn-sm btn-primary'>更新</button></td>
              </tr>
              <?php endforeach; ?>

                    </tbody>
                  </table>
                  
                  <!--  -->


                </div>
                <div class='b-cal four-action'>
                  <div class='pull-left m-r-sm'>
                    <div class="no-borders ver-mid btn-group btn-block">
                      <button data-toggle="dropdown" class="m-r-sm btn btn-white btn-sm dropdown-toggle btn-block t-align-left">採用担当者選択<span class="caret sl-btn"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="#">2採用担当者選択</a></li>
                        <li><a href="#">3採用担当者選択</a></li>
                        <li><a href="#">4採用担当者選択</a></li>                                     
                      </ul>
                    </div>
                  </div>
                  <div class='pull-left'>
                    <button type="button" class="btn btn-sm btn-white email">
                      <i class="fa fa-envelope-o"></i>
                    </button>
                  </div>
                  <div class='pull-left'>
                    <button type="submit" class="btn btn-sm btn-white print">
                      <i class="fa fa-print"></i>
                    </button>
                  </div>
                  <div class=' pull-left  m-r-sm selectagent'>
                    <div class="no-borders ver-mid btn-group btn-block">
                      <button data-toggle="dropdown" class="btn btn-white btn-sm dropdown-toggle btn-block t-align-left">その他<span class="caret sl-btn"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="#">その他</a></li>
                        <li><a href="#">その他</a></li>        
                      </ul>
                    </div>
                  </div>
                  
                  <div class='pull-left newcan'>
                    <a href="<?php echo $this->webroot;?>CanCandidates/add"> <button class='btn btn-primary btn-sm m-r-sm new '>新規候補者登録</button> </a>
                  </div>
                  <div class='pull-left'>
                    <button class='btn btn-primary btn-sm m-r-sm csv'>参加者CSV登録</button>
                  </div>                    
                  <!-- pagination -->
        <div class="bottom_pagination1 pull-right">
            <?php echo $this->element('pagination1')?>
            </div>
        <div class='clearfix'></div>
       <!-- end pagination -->
                  <div class='clear'></div>
                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div>
    <!-- end table イベント情報 -->

  
</div>

<?php echo $this->element('b_back_nav')?>

<!-- START POPUP ATTACHMENT FILE UPLOAD -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 b-r">
                        <h3 class="m-t-none m-b pull-left">2015年5月10日 会社説明会 田中 太朗 の提出書類</h3>
                        <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
                        <div class="table-responsive enj_res">
                            <table class="table table-center table-striped table-bordered" id="addCanDocument">
                                <thead>
                                <tr>
                                    <th class="t-align-left">
                                        <input type="checkbox" class="i-checks" name="input[]" data-id="3" value="0"/>
                                    </th>
                                     <th class="">
                                        <div class="b-cal four-action">
                                            <div class="pull-left m-r-sm">
                                                <div class="no-borders ver-mid btn-group btn-block">
                                                    <select class='btn btn-white btn-sm'>
                                                        <option>採用担当者選択</option>
                                                        <option>2採用担当者選択</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="pull-left">
                                                <button class="btn btn-primary btn-sm m-r-sm">ダウンロード</button>
                                            </div>
                                            <div class="pull-left">
                                                <button class="m-r-sm btn btn-primary btn-sm" id="btnDeleteCandocument">削除</button>
                                            </div>
                                             <div class="clear"></div>
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END POPUP ATTACHMENT FILE UPLOAD -->
           
<!-- Custom and plugin javascript -->
<?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
<!-- iCheck -->
<?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>
<!-- Peity -->
<?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>
<?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
<?php echo $this->Html->script('plugins/fullcalendar/fullcalendar.min.js'); ?>
<!-- Date range picker -->
<?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>
<!-- Clock picker -->
<?php echo $this->Html->script('plugins/clockpicker/clockpicker.js'); ?>
<!-- Data Tables -->
<?php echo $this->Html->script('plugins/jeditable/jquery.jeditable.js'); ?>
<?php echo $this->Html->script('plugins/dataTables/jquery.dataTables.js'); ?>
<?php echo $this->Html->script('plugins/dataTables/dataTables.bootstrap.js'); ?>
<?php echo $this->Html->script('plugins/dataTables/dataTables.responsive.js'); ?>
<?php echo $this->Html->script('plugins/dataTables/dataTables.tableTools.min.js'); ?>

<script>
$(document).ready(function() {
  $('.dataTables-example').dataTable({
    responsive: true,
    "dom": 'T<"clear">lfrtip',
    "tableTools": {
      "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
    },
    "bPaginate": true,
    "aoColumnDefs" : [ {
      'bSortable' : false,
      'aTargets' : [0]
    } ],
    "order":[[1, 'asc']]
  });



$('.clockpicker').clockpicker();

/**
 * change status evhistories
 */
$('.evHistoryStatus').change(function(){
    var id=$(this).data('id');
    var status= $(this).find('option:selected').val();
    var _url = '<?php echo $this->webroot;?>EvHistories/api_status';
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _url,
        data:("id="+id+"&status="+status),
        success: function(res){
            if(res.code==0) {

            }
        }
    });
});


    /**
     * handle ajax
     */
    $('#addRecruiter').on('click',function(){
        if($('#recRecruiters').val() == ''){
            alert('採用担当者を選択してください。');
            return;
        }

        var _url            = '<?php echo $this->webroot;?>EvPersonnels/api_add/';
        var _recruiter_id   = $('#recRecruiters').val();
        var _recruiter_name = $('#recRecruiters').find('option:selected').text();

        var _ev_event_id    = '<?php echo $evEvents["EvEvents"]["id"]; ?>';
        var _data           = 'ev_event_id='+_ev_event_id+'&rec_recruiter_id='+_recruiter_id;

        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: _url,
            data: _data,
            success: function(res){
                if(res.code==0) {
                    var arr=new Object();
                        arr.id=res.id;
                        arr.name=_recruiter_name;
                    var newArr=new Array();
                        newArr.push(arr);
                    $("#RecRecruiterTmpl").tmpl(JSON.parse(JSON.stringify(newArr))).appendTo("#eventRegister").find('tbody tr');
                    deleteEvPersion();
                }else{
                    if(res.code!= 0) {
                        alert('登録済みです。');
                    }
                }
            }
        });

        return false;
    });

/**
 * START get list detail candocument
 */
var numTotalItem=0;
var classCurrent='';
$('.showDetailCandocument').on('click',function(){
    var _can     =$(this).data('can');
    classCurrent = _can;
    var _ev      = $(this).data('ev');
    var _sel     = $(this).data('sel');
    var _url     = '<?php echo $this->webroot;?>CanDocuments/api_list';
    var _data    = 'can_candidate_id='+_can+'&ev_history_id='+_ev+'&sel_history_id='+_sel;
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: _url,
        data: _data,
        success: function(res){
            var str='';
            numTotalItem=res.length;
            for(i=0;i<res.length;i++)
            {
                var data = res[i].CanDocument;
                str+='<tr class=item'+data['id']+'>' +
                        '<td>' +
                            '<div class="icheckbox_square-green itemCheck" style="position: relative;"><input type="checkbox" class="i-checks" name="input[]" value="'+data['id']+'" data-id="'+data['id']+'" style="opacity: 0; zoom: 1.5;margin:0;"><ins class="iCheck-helper" style="top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>' +
                        '</td>' +
                        '<td> ' +
                            '<a href="#">'+data['file_name']+'.'+data['extension']+'</a>' +
                        '</td>' +
                       '</tr>';
            }
            $("#addCanDocument").find('tbody').html(str);
            // set checkbox for jquery understant
            $('#addCanDocument th .iCheck-helper').click(function(){
                if($(this).prev()[0].checked) {
                    $("#addCanDocument .itemCheck").addClass("checked");
                    $('#addCanDocument .i-checks').iCheck('check');
                }
                else
                {
                    $('#addCanDocument .i-checks').iCheck('uncheck');
                    $("#addCanDocument .itemCheck").removeClass("checked");
                }
            });

            $('#addCanDocument .itemCheck').click(function(){
                $(this).toggleClass('checked');
                if($(this).hasClass('checked')) {
                    $(this).children()[0].checked=true;
                }
                else
                {
                    $(this).children()[0].checked=false;
                }
            });
            // End set checkbox for jquery understant
        },
        error: function(e) {
        }
    });
});

/**
 * END get list detail candocument
 */

/* full calendar
--------------------------------*/

 $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: ''
      },
      lang: 'ja',
      editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                  }
                },
                events: [
                {
                  // edit event
                  url: '#',
                  start: "<?php echo $holding_date; ?>",
                  //start: "2015-08-25",
                  //end: '2015-05-21',
                  overlap: false,
                  rendering: 'background',
                  color: '#EA6B65'
                },


                <?php foreach ($evScheduleByEvents as $evScheduleByEvent): ?>
                <?php $holding_date = date('Y-m-d', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>
                {
                  // edit event
                  url: "<?php echo $evScheduleByEvent['EvSchedule']['id']; ?>",
                  //start: "<?php echo $holding_date; ?>",
                  start: "<?php echo $holding_date; ?>",
                  overlap: false,
                  rendering: 'background',
                  color: '#F7CECC'
                },
                <?php endforeach;?>


                ]
              });
});

</script>

<style>
.DTTT_container{
  display: none;
}
</style>