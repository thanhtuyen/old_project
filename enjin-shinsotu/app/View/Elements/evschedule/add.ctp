<div class="tab-content">
    <div id="tab-2" class="tab-pane active">
      <div class="panel-body">                            
        <div class="ibox-content" style="display: block;">
            <?php echo $this->Form->create('EvHistory',array('controller'=>'EvHistories', 'action'=>'schedule_regist/'. $event_id)); ?>
            <div class="form-group form-edit"><label class="col-sm-4 control-label">開催日時</label>
              <div class="col-sm-8">
                <div class="form-group f_left col-sm-4 data_1" id="">
                  <div class="input-group date">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <?php echo $this->Form->input('holding_date1', array('type'=>'text','div'=>false , 'label'=>false , 'class'=>'form-control') ); ?>
                  </div>
                </div>
                <div class="input-group clockpicker f_right_calendar" data-autoclose="true">
                  <span class="input-group-addon">
                    <span class="fa fa-clock-o"></span>
                  </span>
                    <?php echo $this->Form->input('holding_date2', array('div'=>false , 'label'=>false , 'class'=>'form-control') ); ?>
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
                    <?php echo $this->Form->input('end_date1', array('type'=>'text','div'=>false , 'label'=>false , 'class'=>'form-control') ); ?>
                  </div>
                </div>
                <div class="input-group clockpicker f_right_calendar" data-autoclose="true">
                  <span class="input-group-addon">
                    <span class="fa fa-clock-o"></span>
                  </span>
                    <?php echo $this->Form->input('end_date2', array('div'=>false , 'label'=>false , 'class'=>'form-control') ); ?>
                </div>                                                                        
              </div>
            </div>  

            <div class="form-group"><label class="col-sm-4 control-label">個別テーマ</label>
              <div class="col-sm-8">
                <?php echo $this->Form->input('individual_theme', array('div'=>false , 'label'=>false , 'class'=>'form-control') ); ?>
              </div>
            </div>
            <div class="form-group"><label class="col-sm-4 control-label">当日内容</label>
              <div class="col-sm-8">
                <?php echo $this->Form->input('day_content', array('type'=>'textarea','div'=>false , 'label'=>false , 'class'=>'form-control') ); ?>
              </div>
            </div>

            <div class="form-group"><label class="col-sm-4 control-label">定員数</label>
              <div class="col-sm-8">
                <span>
                  <?php echo $this->Form->input('capacity', array('type'=>'number','div'=>false , 'label'=>false , 'class'=>'form-control w40 pull-left m-r-sm') ); ?>
                  <span class='sp-text-pg'>人</span>
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
                    <?php echo $this->Form->input('wanted_deadline1', array('type'=>'text','div'=>false , 'label'=>false , 'class'=>'form-control') ); ?>
                  </div>
                </div>
                <div class="input-group clockpicker f_right_calendar" data-autoclose="true">
                  <span class="input-group-addon">
                    <span class="fa fa-clock-o"></span>
                  </span>
                    <?php echo $this->Form->input('wanted_deadline2', array('div'=>false , 'label'=>false , 'class'=>'form-control') ); ?>
                </div>
              </div>
            </div>

            <div class="form-group"><label class="col-sm-4 control-label">開催場所</label>
              <div class="col-sm-8">
                <?php echo $this->Form->input('venue', array('div'=>false , 'label'=>false , 'class'=>'form-control') ); ?>
              </div>
            </div>

            <div class="form-group"><label class="col-sm-4 control-label">開催費用</label>
              <div class="col-sm-8">
                <span>
                  <?php echo $this->Form->input('holding_cost', array('type'=>'number','div'=>false , 'label'=>false , 'class'=>'form-control w40 pull-left m-r-sm') ); ?>
                  <span class='sp-text-pg'>円</span>
                  <div class='clearfix'></div>
                </span>
              </div>
            </div>                                                            
            <div class="btn-clear text-center hover-button">
              <?php echo $this->Form->submit(__('登録'),array('class'=>'btn w-95 btn-primary','div'=>false));?>
            </div>
          <?php echo $this->Form->end()?>
        </div> 
      </div>
    </div>
</div>                        
