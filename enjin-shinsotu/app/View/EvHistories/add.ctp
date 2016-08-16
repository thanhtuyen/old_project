<?php echo $this->element('back_nav', array('text' => __('イベント詳細｜%s', $wEvents["EvEvent"]["name"])))?>

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
              <td class="no-borders ver-mid btn-group btn-block">
                  <select class="form-control" id="recRecruiters">
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
<div class='col-lg-12 border-dot'></div>
<!-- title -->
<div class='col-lg-12 wrapper-content-title top-title color-676a6c'>
  <div class='ibox-title color-676a6c'>
    <h3>イベント開催日程</h3>
  </div>
</div>
<!-- end title -->
<div class='full-content'>
  <div class="col-lg-8">
    <!-- tab container -->
    <div class="tabs-container ibox">
      <ul class="nav nav-tabs">
      <?php foreach( $wEvents['EvSchedule'] as $row ): ?>
        <li><?php echo $this->Html->link($row['holding_date'], array('controller'=>'EvHistories','action' => 'edit',$event_id, $row['id'])); ?></li>
      <?php endforeach; ?>
        <li class="active"><a data-toggle="tab" href="#tab-2" aria-expanded="true">登録してください</a></li>
      </ul>
      <?php echo $this->element("evschedule/add",array("event_id"=>$event_id)); ?>
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

<?php echo $this->element('b_back_nav')?>

  <!-- script -->
  <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
  <?php echo $this->Html->script('bootstrap.min.js'); ?>
  <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>
  <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>
  <!-- Custom and plugin javascript -->
  <?php echo $this->Html->script('inspinia.js'); ?>
  <?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
  <!-- iCheck -->
  <?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>
  <!-- Peity -->
  <?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>
  <?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
  <?php echo $this->Html->script('plugins/fullcalendar/fullcalendar.min.js'); ?>
  <!-- Date range picker -->
  <?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>
  <!-- Data picker -->
  <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>
  <!-- Clock picker -->
  <?php echo $this->Html->script('plugins/clockpicker/clockpicker.js'); ?>
  <?php echo $this->Html->script('plugins/fullcalendar/lang-all.js'); ?>
  <!-- end script -->

  <script>
  $(document).ready(function() {

    $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green'
    });

        /* initialize the calendar
        -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('.data_1 .input-group.date').datepicker({
          todayBtn: "linked",
          keyboardNavigation: false,
          forceParse: false,
          calendarWeeks: true,
          autoclose: true
        });

        $('.clockpicker').clockpicker();

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
                }
              });
      });

</script>
