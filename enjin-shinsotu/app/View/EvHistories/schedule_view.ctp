<!-- title -->
<?php echo $this->element('back_nav', array('text' => __('イベント詳細｜%s　会社説明会', $evScheduleByEvents[0]["EvEvent"]["name"]), 'url' => array('action' => 'view', $id)))?>
<!-- end title -->

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
  <!-- content -->   
  <div class='full-content'>
    <div class="col-lg-8">
      <div class="tabs-container ibox">
        <ul class="nav nav-tabs">

        <?php foreach ($evScheduleByEvents as $evScheduleByEvent): ?>
          <li class="inactive <?php if (!empty($evScheduleByEvent['EvSchedule']['active'])) { 
            echo $evScheduleByEvent['EvSchedule']['active'];}?>">
            <a href="<?php echo $this->webroot;?>EvHistories/schedule_view/<?php echo $id; ?>/<?php echo $evScheduleByEvent['EvSchedule']['id']; ?>">
              <?php echo date('Y', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>年<?php echo date('m', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>月<?php echo date('d', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>日</a>
            </li>
        <?php endforeach;?>

          <li class="inactive"><a href="<?php echo $this->webroot;?>EvHistories/schedule_regist/<?php echo $id; ?>">+</a></li>
        </ul>
        <div class="tab-content">

          <!-- tab Active -->
          <div id="tab" class="tab-pane active">
            <!-- start tab-->
            <div class="panel-body  show-data hiden-return">                            
              <div class="ibox-content ">


              <?php $k=1; reset($evScheduleByEvents);?>
              <?php foreach ($evScheduleByEvents as $evScheduleByEvent): ?>    
                <form method="post" class="form-horizontal form-edit <?php if (!empty($evScheduleByEvent['EvSchedule']['active'])) { echo 'active';}?>" style="display: <?php if (!empty($evScheduleByEvent['EvSchedule']['active'])) { echo 'block';} else {echo 'none';} ?>">

                  <div class="form-group"><label class="col-sm-4 control-label">開催日時</label>
                    <div class="col-sm-8">
                      <div class="form-control border-none showFields" id="holding_date_view">
                        <?php echo date('Y', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>年<?php echo date('m', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>月<?php echo date('d', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>日 <?php echo date('H:i', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>
                      </div>

                      <!-- START Click Edit Button to show -->
                    <div class="form-group f_left col-sm-4 data_1 editFields display-none">
                      <div class="input-group date">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" class="form-control" name="data[EvSchedule][holding_date]" value="<?php echo date('Y/m/d', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>" >
                      </div>
                    </div>
                    <div class="input-group clockpicker f_right_calendar editFields display-none" data-autoclose="true">
                      <input type="text" class="form-control" name="data[EvSchedule][holding_date_time]" value="<?php echo date('H:i', strtotime($evScheduleByEvent["EvSchedule"]["holding_date"])); ?>" >
                    </div>
                    <!-- END Click Edit Button to show -->  

                    </div>
                  </div>    


                  <div class="form-group"><label class="col-sm-4 control-label">終了日時</label>
                    <div class="col-sm-8">
                      <div class="form-control border-none showFields"><?php echo date('Y', strtotime($evScheduleByEvent["EvSchedule"]["end_date"])); ?>年<?php echo date('m', strtotime($evScheduleByEvent["EvSchedule"]["end_date"])); ?>月<?php echo date('d', strtotime($evScheduleByEvent["EvSchedule"]["end_date"])); ?>日 <?php echo date('H:i', strtotime($evScheduleByEvent["EvSchedule"]["end_date"])); ?>
                      </div>

                      <!-- START Click Edit Button to show -->
                      <div class="form-group form-edit f_left col-sm-4 data_1 editFields display-none" id="">
                        <div class="input-group date">
                          <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </span>
                          <input type="text" class="form-control"  name="data[EvSchedule][end_date]" value="<?php echo date('Y/m/d', strtotime($evScheduleByEvent["EvSchedule"]["end_date"])); ?>">
                        </div>
                      </div>
                      <div class="input-group clockpicker f_right_calendar editFields display-none" data-autoclose="true">
                        
                        <input type="text" class="form-control" name="data[EvSchedule][end_date_time]" value="<?php echo date('H:i', strtotime($evScheduleByEvent["EvSchedule"]["end_date"])); ?>" >
                      </div>
                      <!-- END Click Edit Button to show -->  

                    </div>
                  </div>  
                  <div class="form-group"><label class="col-sm-4 control-label">個別テーマ</label>
                    <div class="col-sm-8">
                      <div class="form-control border-none showFields">
                        <?php echo $evScheduleByEvent["EvSchedule"]["individual_theme"]; ?>
                      </div>

                      <!-- START Click Edit Button to show -->
                        <input type="text" class="form-control editFields display-none " name="data[EvSchedule][individual_theme]" value="<?php echo $evScheduleByEvent["EvSchedule"]["individual_theme"]; ?>">
                      <!-- END Click Edit Button to show --> 
                    </div>
                  </div>  
                  <div class="form-group"><label class="col-sm-4 control-label">当日内容</label>
                    <div class="col-sm-8">
                      <div class="form-control border-none h-auto showFields">
                        <?php echo $evScheduleByEvent["EvSchedule"]["day_content"]; ?>
                      </div>
                      <!-- START Click Edit Button to show -->
                          <textarea class='form-control editFields display-none' rows='6'><?php echo $evScheduleByEvent["EvSchedule"]["day_content"]; ?>
                        </textarea>
                      <!-- END Click Edit Button to show --> 
                    </div>
                  </div>  
                  <div class="form-group"><label class="col-sm-4 control-label">定員数</label>
                    <div class="col-sm-8 showFields">
                      <div class="form-control border-none "><?php echo $evScheduleByEvent["EvSchedule"]["capacity"]; ?>人</div>
                    </div>  
                      <!-- START Click Edit Button to show -->
                      <div class="col-sm-5 editFields display-none">
                      <span class="">
                        <input type="number" class="form-control w40 pull-left m-r-sm" value="<?php echo $evScheduleByEvent["EvSchedule"]["capacity"]; ?>">
                        <span class='sp-text-pg'>人</span>
                        <div class='clearfix'></div>
                      </span>
                      </div>
                      <!-- END Click Edit Button to show --> 
                    
                  </div>  
                  <div class="form-group"><label class="col-sm-4 control-label">募集締切日</label>
                    <div class="col-sm-8">
                      <div class="form-control border-none showFields"><?php echo date('Y', strtotime($evScheduleByEvent["EvSchedule"]["wanted_deadline"])); ?>年<?php echo date('m', strtotime($evScheduleByEvent["EvSchedule"]["wanted_deadline"])); ?>月<?php echo date('d', strtotime($evScheduleByEvent["EvSchedule"]["wanted_deadline"])); ?>日</div>

                      <!-- START Click Edit Button to show -->
                      <div class="form-group f_left col-sm-4 data_1 editFields display-none" id="">
                        <div class="input-group date">
                          <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </span>
                          <input type="text" class="form-control" value="<?php echo date('Y/m/d', strtotime($evScheduleByEvent["EvSchedule"]["wanted_deadline"])); ?>">
                        </div>
                      </div>
                      <!-- END Click Edit Button to show --> 

                    </div>
                  </div>  
                  <div class="form-group"><label class="col-sm-4 control-label">開催場所</label>
                    <div class="col-sm-8">
                      <div class="form-control border-none showFields"><?php echo $evScheduleByEvent["EvSchedule"]["venue"]; ?></div>
                      <!-- START Click Edit Button to show -->
                      
                      <input type="text" class="form-control editFields display-none" value="<?php echo $evScheduleByEvent["EvSchedule"]["venue"]; ?>">
                      
                      <!-- END Click Edit Button to show --> 

                    </div>
                  </div>      
                  <div class="form-group"><label class="col-sm-4 control-label">開催費用</label>
                    <div class="col-sm-8">
                      <div class="form-control border-none showFields"><?php echo $evScheduleByEvent["EvSchedule"]["holding_cost"]; ?>円</div>
                      <!-- START Click Edit Button to show -->
                      
                      <span class="editFields display-none">
                        <input type="text" class="form-control w40 pull-left m-r-sm" value="<?php echo $evScheduleByEvent["EvSchedule"]["holding_cost"]; ?>">
                        <span class='sp-text-pg'>円</span>
                        <div class='clearfix'></div>
                      </span>
                      
                      <!-- END Click Edit Button to show --> 
                    </div>
                  </div>                                                                                
                
                <div class="btn-clear show-data hiden-return" style="display: <?php if (!empty($evScheduleByEvent['EvSchedule']['active'])) { echo 'block';} else {echo 'none';} ?>">
                  <a class="btnBack btn editFields text-navy" style="display: inline-block;"> キャンセル </a>
                  <button type='submit' class="btnScheduleEdit btn btn-primary w-95">編集</button>
                  <button class="btnScheduleSubmit btn btn-primary w-95 display-none" type="submit">編集</button>
                </div>
              </form>  
              <?php $k++; ?> 
              <?php endforeach; ?>


                
              </div> 
            </div>
          </div>
          <!-- end Active Table-->
          <!-- end Active Table-->
          <!-- end Active Table-->
          <!-- end Active Table-->

          <div id="tab_new" class="tab-pane inactive">
            <div class="panel-body">                            
              <div class="ibox-content" style="display: block;">
                

                <!-- START FORM --- ----- --- -->
                <?php echo $this->Form->create('EvSchedule', array('type'=>'post', 'class'=>'form-horizontal form-edit')); ?>
                <input type="hidden" name="data[EvSchedule][ev_event_id]" id=""  value="<?php echo $id;?>" />
                  <div class="form-group"><label class="col-sm-4 control-label">開催日時</label>
                    <div class="col-sm-8">
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
                        <input type="text" name="holding_date_time" class="form-control" value="" >
                      </div>                                                                        
                    </div>
                  </div>
                  <div class="form-group form-edit"><label class="col-sm-4 control-label">終了日時</label>
                    <div class="col-sm-8">
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
                        <input type="text" name="end_date_time" class="form-control" value="" >
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
                  <div class="form-group form-edit"><label class="col-sm-4 control-label">募集締切日</label>
                    <div class="col-sm-8">
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
                        <input type="text" name="wanted_deadline_time" class="form-control" value="" >
                      </div>  
                    </div>
                  </div>
                  <div class="form-group"><label class="col-sm-4 control-label">開催場所</label>
                    <div class="col-sm-8">

                      <?php echo $this->Form->input('EvSchedule.venue',array('type'=>'text','class' => 'form-control','label' =>false)); ?>
                    </div>
                  </div>
                  <div class="form-group"><label class="col-sm-4 control-label">開催費用</label>
                    <div class="col-sm-2">
                      <span>
                        <?php echo $this->Form->input('EvSchedule.holding_cost',array('type'=>'text','class' => 'form-control w40 pull-left m-r-sm','label' =>false)); ?>  
                        <span class='sp-text-pg'>円</span>
                        <div class='clearfix'></div>
                      </span>
                    </div>
                  </div>                                                            
                  <div class="btn-clear text-center">
                    
                      <button class="btn-tab btn-primary w-95" type="submit">登録する</button>
                    
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

<?php echo $this->element('b_back_nav', array('action'=>'view',$id))?>

<script>

$('.editFields').css("display","none");

$(document).ready(function() {

  // clock 
  $('.clockpicker').clockpicker();


    $('.btnScheduleEdit').on('click',function(){
        $('.editFields').css("display","block");
        $('.showFields').css("display","none");
        $('.btnBack').css("display","inline-block");
        $('.btnScheduleEdit').css("display","none");
        $('.btnScheduleSubmit').css("display","inline-block");
        
        return false;
    });

    $('#btnBack').on('click',function(){
        
        $('.editFields').css("display","none");
        $('.showFields').css("display","block");
        return false;
    });

});
</script>