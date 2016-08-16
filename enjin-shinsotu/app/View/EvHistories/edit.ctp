<?php echo $this->element('back_nav', array(
                          'text' => __('イベント詳細｜%s', $wEvents["EvEvent"]["name"]),
                          'url' => array(
                            'controller' => 'EvEvents',
                            'action' => 'index'
                            )))?>
<div class="wrapper wrapper-content row animated fadeInRight clearfix evhistories">
  <!-- content -->                     
  <div class='full-content'>
    <!-- イベント情報 -->
    <div class='col-lg-8'>
        <?php echo $this->element("evschedule/event",$wEvents); ?>
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
              <table class="table table-bordered no-margin-bottom" id="eventRegister">
                <thead>
                  <tr>
                    <th>イベント担当者名</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($wEvPersonnel as $recRecruiter): ?>
                  <tr>
                    <td><a class="text-navy" href=""><?php echo $recRecruiter['RecRecruiter']['name']; ?></a></td>
                    <td class="table-button-tdright"><button class="full-width btn btn-default btn-xs ev-histories-delete" data-id="<?php echo $recRecruiter['EvPersonnel']['id']; ?>">削除</button></td>
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
              <td class="no-borders ver-mid">
                  <select class="btn full-width" id="recRecruiters">
                    <?php foreach ($wRecRecruiter as $key=>$val): ?>
                    <option value='<?php echo $key; ?>'><?php echo h($val); ?></option>
                    <?php endforeach; ?>
                  </select>
              </td>
            <td class="no-borders ver-mid">
              <button class="full-width btn btn-primary btn-sm" id="EvHistories">追加</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>             
  </div>                      
</div>
<!-- end イベント担当者登録 -->
</div>

<!-- title -->

   

<!-- end title -->
<div class='full-content'>
  <div class="col-lg-12">
  <h3>イベント開催日程</h3>
</div>
  <div class="col-lg-8">
    <!-- tab container -->
    <div class="tabs-container ibox">
      <ul class="nav nav-tabs">
      <?php $active = $counter = 0; ?>
      <?php foreach( $wEvents['EvSchedule'] as $row ): ?>
        <?php if( $row['id'] == $schedule_id ): ?>
            <?php $active = $counter; ?>
            <li class="active"><?php echo $this->Html->link($row['holding_date'], array('controller'=>'EvHistories','action' => 'edit',$event_id, $row['id']),array('aria-expanded'=>'true','data-toggle'=>'tab')); ?></li>
        <?php else: ?>
            <li><?php echo $this->Html->link($row['holding_date'], array('controller'=>'EvHistories','action' => 'edit',$event_id, $row['id'])); ?></li>
        <?php endif; ?>
        <?php $counter++; ?>
      <?php endforeach; ?>
        <li><?php echo $this->Html->link("＋", array('controller'=>'EvHistories','action' => 'add',$event_id)); ?></li>
      </ul>
      <?php echo $this->element("evschedule/edit",$wEvents['EvSchedule'][ $active ]); ?>
    </div>
    </div>
    <!-- end tab container-->
  <!-- calendar -->
  <div class="col-lg-4">
    <div class="ibox">
      <div class="ibox-title">
        <h5>カレンダー</h5>
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
  <!-- end calendar -->
  <!-- START 選考履歴サマリ -->
  <div class='full-content'>
    <div class='col-lg-12'>
      <div class="ibox float-e-margins no-margin-bottom">
        <div class="ibox-title">
          <h5>イベント参加履歴</h5>
        </div>
     
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
          <div class="btn-group">
            <select class="form-control pull-left btn h-30 status">
              <option>その他</option>
              <option>その他</option>
              <option>その他</option>
            </select>
          </div>
          <button class="btn btn-primary btn-sm  m-l m-r-sm" onclick="window.location.href='<?php echo Router::url(array('action'=>'add'))?>'"><?php echo __('新規候補者登録')?></button>
          <button class="btn btn-primary btn-sm m-r-sm" onclick="window.location.href='<?php echo Router::url(array('action'=>'csv_add'))?>'"><?php echo __('参加者CSV登録')?></button>
        </div>
      </div>

       <!-- table -->
       <div class="table-responsive">
        <table class=" table table-bordered white-tb-th table-striped  tb1-chb " id="evHistoriesTable">
          <thead>
            <tr>
              <th class="wsnw"><input type="checkbox" class="i-checks"></th>
              <th>候補者ID</th>
              <th>名前</th>
              <th>大学名</th>
              <th>参加ステータス</th>
              <th>提出書類</th>
              <th>あなたの評価</th>
              <th>コメント</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($wEvHistory as $row): ?>
            <tr>
              <td><input type="checkbox" class="i-checks cbItem" value="<?php echo $row['CanCandidate']['id']?>"></td>
              <td class="t-align-left"><?php echo $this->Html->link($row['CanCandidate']['id'], array('controller'=>'CanCandidates','action' => 'view', $row['CanCandidate']['id']),array('class'=>'no_cancandidate',)); ?></td>
              <td><?php echo $this->Html->link($row['CanCandidate']['name'], array('controller'=>'CanCandidates','action' => 'view', $row['CanCandidate']['id'])); ?></td>
              <td class="t-align-left"><?php echo h( $wCanCandidate[ $row['CanCandidate']['id']  ] ); ?>
              </td>
              <td class="t-align-left">
                  <?php $options = $this->Enjin->getEvHistoryStatusUses( $row['EvHistory']['status'] ); ?>
                  <?php echo $this->Form->input('evHistoryStatus', array('type'=>'select', 'label'=>false,'data-id'=>$row['EvHistory']['id'] , 'class'=>'form-control evHistoryStatus', 'options'=>$options )); ?>
                  
              </td>
              <td class="t-align-left">
                <span class='dp-inl'>
                    <div class='content_border_button text-with-btn pull-left'>
                      <div>
                        <a class="showDetailCandocument" href="#modal-form" data-can="<?php echo $row['EvHistory']['can_candidate_id']; ?>" data-ev="<?php echo $row['EvHistory']['id']; ?>" data-sel="<?php echo $row['EvHistory']['id']; ?>" id="count_<?php echo $row['CanCandidate']['id']; ?>" data-toggle="modal" data-target="#myModal"><?php echo count($row['CanDocument']); ?></a>
                      </div>
                    </div>
                    <span class="fileUpload btn btn-primary pull-left">
                      <span>ファイル選択</span>
                      <input type="file" class="upload" name="file" data-can="<?php echo $row['EvHistory']['can_candidate_id']; ?>" data-ev="<?php echo $row['EvHistory']['id']; ?>">
                    </span>
                </span>
              </td>



              <td class="t-align-left">
                  <?php echo $this->Form->input('afterScore', array('type'=>'select', 'label'=>false, 'class'=>'form-control t-align-left', 'options'=>$this->Enjin->getAfterScoreArray() ,'default'=>$row['EvHistory']['after_score'])); ?>
            </td>
            
            <td class="t-align-left"><input type='text' id="historyComment" class='form-control' data-id="<?php echo $row['EvHistory']['id']; ?>" value="<?php echo $row['EvHistory']['after_comment']; ?>" /> </td>
            <td class="t-align-left"><button class='btn btn-xs btn-primary evHistoriesUpdate' data-id="<?php echo $row['EvHistory']['id']; ?>">更新</button></td>
          </tr> 
        <?php endforeach; ?>
      </tbody>

      <tfoot>
        <tr>
          <th class="wsnw"><input type="checkbox" class="i-checks"></th>
          <th>候補者ID</th>
          <th>名前</th>
          <th>大学名</th>
          <th>参加ステータス</th>
          <th>提出書類</th>
          <th>あなたの評価</th>
          <th>コメント</th>
          <th>操作</th>
        </tr>
      </tfoot>
    </table>
  </div>
    <!-- action on table -->
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
            <div class="btn-group">
              <select class="form-control pull-left btn h-30 status">
                <option>その他</option>
                <option>その他</option>
                <option>その他</option>
              </select>
            </div>
            <button class="btn btn-primary btn-sm  m-l m-r-sm" onclick="window.location.href='<?php echo Router::url(array('action'=>'add'))?>'"><?php echo __('新規候補者登録')?></button>
            <button class="btn btn-primary btn-sm m-r-sm" onclick="window.location.href='<?php echo Router::url(array('action'=>'csv_add'))?>'"><?php echo __('参加者CSV登録')?></button>
          </div>
 </div>
  <!-- end action on table -->
</div>
  <!-- end table -->



</div>
</div>
</div>
</div>
</div>
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
                                                <div class="no-borders ver-mid">
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

<?php echo $this->element('b_back_nav', array('url' => array('controller' => 'EvEvents', 'action' => 'index'))) ?>

<form id="upload_form">
  <input type="hidden" id="upload_can" name="CanDocuments[can_candidate_id]" value="">
  <input type="hidden" id="upload_ev" name="CanDocuments[ev_history_id]" value="">
  <input type="hidden" id="upload_ev" name="CanDocuments[sel_history_id]" value="0">
</form>

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
  $(document).ready(function() {
    var data,webroot='<?php echo $this->webroot?>';
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
          $(this).remove();
        }
      }
    });
    /**
     * update afterscore and comment
     */
    $('.evHistoriesUpdate').on('click',function(){
        var _id            = $(this).data('id');
        var _after_score   = $(this).parents('tr').find('#afterScore').val();
        var _after_comment = $(this).parents('tr').find('#historyComment').val();
        var _url           = '<?php echo $this->webroot;?>EvHistories/api_update';
        var _data          = 'id='+_id+"&after_score="+_after_score+"&after_comment="+_after_comment;
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: _url,
            data: _data,
            success: function(res){
                if(res.code==0) {
                }
            },
            error: function(e) {
            }
        });
    });
    // file upload
    $(".upload").bind("change", function () {
      var _this = $(this);
      var file = _this.files;
      $('#upload_id').val(_this.data('can'));
      $('#upload_can').val(_this.data('can'));
      $('#upload_ev').val(_this.data('ev'));
      var formdata = new FormData($('#upload_form').get()[0]);
      formdata.append("file", _this.prop("files")[0]);
      var _url = '<?php echo $this->webroot;?>CanDocuments/api_file_upload';
      // XHR で送信
      $.ajax({
          type: "POST",
          data: formdata,
          dataType: 'json',
          processData: false,
          contentType: false,
          url: _url,
          success: function(res, status, xhr){
            if(xhr.status == 200) {
              _this.parents('span.dp-inl').find('.showDetailCandocument').html(res);
            }
          }
      })
      return false;
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
