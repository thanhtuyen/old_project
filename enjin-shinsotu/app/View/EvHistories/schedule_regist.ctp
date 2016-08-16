<!-- titile -->
<?php echo $this->element('back_nav', array('text' => __('イベント詳細｜会社説明会'), 'url' => array('action' => 'view', $id)))?>
<!-- end title -->

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
  <!-- content -->   
  <div class='full-content'>
    <div class="col-lg-8">
      <div class="tabs-container ibox">
        <ul class="nav nav-tabs">
          
          <?php foreach ($evScheduleByEvents as $evScheduleByEvent): ?>
            <li class="inactive"><a  href="<?php echo $this->webroot;?>EvHistories/schedule_view/<?php echo $id; ?>/<?php echo $evScheduleByEvent['EvSchedule']['id']; ?>"><?php echo date('Y', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>年<?php echo date('m', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>月<?php echo date('d', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>日</a></li>
          <?php endforeach;?>

          <li class="active"><a href="" id="schedule_regist_click">+</a></li>
        </ul>
        <div class="tab-content">

          <!-- tab Active -->
          <div id="tab" class="tab-pane inactive ">
            <!-- start tab-->
          </div>
          <!-- end Active Table-->
          <!-- end Active Table-->
          <!-- end Active Table-->
          <!-- end Active Table-->

          <div id="tab_new" class="tab-pane active">
            <div class="panel-body">                            
              <div class="ibox-content" style="display: block;">
                

                <!-- START FORM --- ----- --- -->
                <?php echo $this->Form->create('EvSchedule', array('type'=>'post', 'class'=>'form-horizontal form-edit ')); ?>
                <input type="hidden" name="data[EvSchedule][ev_event_id]" id=""  value="<?php echo $id;?>" />
                  <div class="form-group"><label class="col-sm-4 control-label">開催日時</label>
                    <div class="col-sm-8 form-info">
                      <div class="form-group f_left col-sm-4 data_1" id="">
                        <div class="input-group date">
                          <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </span>

                          <?php echo $this->Form->input('EvSchedule.holding_date',array('type'=>'text','class' => 'form-control','label' =>false)); ?>
                        </div>
                      </div>
                      <div class="input-group clockpicker f_right_calendar" data-autoclose="true">
                        <span class="input-group-addon">
                          <span class="fa fa-clock-o"></span>
                        </span>
                        <input type="text" name="data[EvSchedule][holding_date_time]" class="form-control" value="" >
                      </div>                                                                        
                    </div>
                  </div>
                  <div class="form-group"><label class="col-sm-4 control-label">終了日時</label>
                    <div class="col-sm-8 form-info">
                      <div class="form-group f_left col-sm-4 data_1" id="">
                        <div class="input-group date">
                          <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </span>
                          <?php echo $this->Form->input('EvSchedule.end_date',array('type'=>'text','class' => 'form-control','label' =>false)); ?>
                        </div>
                      </div>
                      <div class="input-group clockpicker f_right_calendar" data-autoclose="true">
                        <span class="input-group-addon">
                          <span class="fa fa-clock-o"></span>
                        </span>
                        <input type="text" name="data[EvSchedule][end_date_time]" class="form-control" value="" >
                      </div>                                                                        
                    </div>
                  </div>
                  <div class="form-group"><label class="col-sm-4 control-label">個別テーマ</label>
                    <div class="col-sm-8">

                      <?php echo $this->Form->input('EvSchedule.individual_theme',array('type'=>'text','class' => 'form-control','label' =>false)); ?>

                    </div>
                  </div>
                  <div class="form-group"><label class="col-sm-4 control-label">当日内容</label>
                    <div class="col-sm-8">

                      <?php echo $this->Form->textarea('EvSchedule.day_content',array('class'=>'form-control','label' =>false,'placeholder'=>'')); ?>


                    </div>
                  </div>
                  <div class="form-group"><label class="col-sm-4 control-label">定員数</label>
                    <div class="col-sm-5">
                      <span>

                        <?php echo $this->Form->input('EvSchedule.capacity',array('type'=>'text','class' => 'form-control w40 pull-left m-r-sm','label' =>false)); ?> <span class='sp-text-pg'>人</span>
                        <div class='clearfix'></div>
                      </span>
                    </div>
                  </div>
                  <div class="form-group"><label class="col-sm-4 control-label">募集締切日</label>
                    <div class="col-sm-8 form-info">
                      <div class="form-group f_left col-sm-4 data_1" id="">
                        <div class="input-group date">
                          <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </span>
                          <?php echo $this->Form->input('EvSchedule.wanted_deadline',array('type'=>'text','class' => 'form-control','label' =>false)); ?>
                        </div>
                      </div>
                      <div class="input-group clockpicker f_right_calendar" data-autoclose="true">
                        <span class="input-group-addon">
                          <span class="fa fa-clock-o"></span>
                        </span>
                        <input type="text" name="data[EvSchedule][wanted_deadline_time]" class="form-control" value="" >
                      </div>  
                    </div>
                  </div>
                  <div class="form-group"><label class="col-sm-4 control-label">開催場所</label>
                    <div class="col-sm-8">

                      <?php echo $this->Form->input('EvSchedule.venue',array('type'=>'text','class' => 'form-control','label' =>false)); ?>
                    </div>
                  </div>
                  <div class="form-group"><label class="col-sm-4 control-label">開催費用</label>
                    <div class="col-sm-5">
                      <span>
                        <?php echo $this->Form->input('EvSchedule.holding_cost',array('type'=>'text','class' => 'form-control w40 pull-left m-r-sm','label' =>false)); ?>  
                        <span class='sp-text-pg'>円</span>
                        <div class='clearfix'></div>
                      </span>
                    </div>
                  </div>                                                            
                  <div class="btn-clear text-center">
                      <a href="<?php echo $this->webroot;?>EvHistories/schedule_view/<?php echo $id; ?>" class="text-navy editFields" style="display: inline-block;"> キャンセル </a>
                      <button class="btn btn-primary w-95" type="submit">登録する</button>
                    
                  </div>
                <?php $this->Form->end();?>
                <!-- END FORM --- ----- --- -->


              </div> 
            </div>
          </div>

        </div>


      </div>
    </div>                
  </div>
</div>   

<!-- footer -->
<?php echo $this->element('b_back_nav', array('url'=>array('action' => 'view', $id)))?>

<script>


$(document).ready(function() {
  
    // clock 
  $('.clockpicker').clockpicker();

        
    $('#btnScheduleEdit').on('click',function(){
        
        $('.editFields').css("display","block");
        $('.showFields').css("display","none");
        $('#btnBack').css("display","inline-block");
        return false;
    });

    $('#schedule_regist_click').on('click',function(){
        
        $('#tab.active').css("display","none");
        $('#tab_new.inactive').css("display","block");
        $( ".nav-tabs li.current.active" ).removeClass( "active" );
        $( ".nav-tabs li.inactive" ).removeClass( "inactive" ).addClass( "active" );
        return false;
    });
    
    
    
});
</script>