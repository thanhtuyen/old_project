<div class="tab-content">
    <div id="tab-2" class="tab-pane active">
      <div class="panel-body">                            
        <div class="ibox-content" style="display: block;">
            <?php echo $this->Form->create('EvHistory',array( 'url'=>array("controller"=>'EvHistories', 'action'=>'edit', $event_id,$id), 'class' => 'form-horizontal form-edit')); ?>
            <?php echo $this->Form->input('id', array('div'=>false , 'label'=>false , 'class'=>'form-control', 'value'=>$id) ); ?>
            <div class="form-group"><label class="col-sm-4 control-label">開催日時</label>
              <div class="col-sm-8 form-info">
                <div class="form-group f_left col-sm-4 data_1" id="">
                  <div class="input-group date">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <?php echo $this->Form->input('holding_date', array('div'=>false , 'label'=>false , 'class'=>'form-control', 'value'=>$this->Enjin->getDateTime2String( $holding_date )) ); ?>
                  </div>
                </div>

                <div class="input-group clockpicker f_right_calendar" data-autoclose="true">
                  <span class="input-group-addon">
                    <span class="fa fa-clock-o"></span>
                  </span>
                    <?php echo $this->Form->input('holding_time', array('div'=>false , 'label'=>false , 'class'=>'form-control wanted_deadline_time', 'value'=>$this->Enjin->getDateTime2String( $holding_date, false )) ); ?>
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
                    <?php echo $this->Form->input('end_date', array('div'=>false , 'label'=>false , 'class'=>'form-control', 'value'=>$this->Enjin->getDateTime2String( $end_date )) ); ?>
                  </div>
                </div>
                <div class="input-group clockpicker f_right_calendar" data-autoclose="true">
                  <span class="input-group-addon">
                    <span class="fa fa-clock-o"></span>
                  </span>
                    <?php echo $this->Form->input('end_time', array('div'=>false , 'label'=>false , 'class'=>'form-control', 'value'=>$this->Enjin->getDateTime2String( $end_date, false )) ); ?>
                </div>                                                                        
              </div>
            </div>  

            <div class="form-group"><label class="col-sm-4 control-label">個別テーマ</label>
              <div class="col-sm-8">
                <?php echo $this->Form->input('individual_theme', array('div'=>false , 'label'=>false , 'class'=>'form-control', 'value'=>$individual_theme) ); ?>
              </div>
            </div>
            <div class="form-group"><label class="col-sm-4 control-label">当日内容</label>
              <div class="col-sm-8">
                <?php echo $this->Form->input('day_content', array('type'=>'textarea','div'=>false , 'label'=>false , 'class'=>'form-control', 'value'=>$day_content) ); ?>
              </div>
            </div>

            <div class="form-group"><label class="col-sm-4 control-label">定員数</label>
              <div class="col-sm-8">
                <span>
                  <?php echo $this->Form->input('capacity', array('type'=>'number','div'=>false , 'label'=>false , 'class'=>'form-control w40 pull-left m-r-sm', 'value'=>$capacity) ); ?>
                  <span class='sp-text-pg'>人</span>
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
                    <?php echo $this->Form->input('wanted_deadline', array('div'=>false , 'label'=>false , 'class'=>'form-control', 'value'=>$wanted_deadline) ); ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group"><label class="col-sm-4 control-label">開催場所</label>
              <div class="col-sm-8">
                <?php echo $this->Form->input('venue', array('div'=>false , 'label'=>false , 'class'=>'form-control', 'value'=>$venue) ); ?>
              </div>
            </div>

            <div class="form-group"><label class="col-sm-4 control-label">開催費用</label>
              <div class="col-sm-8">
                <span>
                  <?php echo $this->Form->input('holding_cost', array('type'=>'number','div'=>false , 'label'=>false , 'class'=>'form-control w40 pull-left m-r-sm' ,'value'=>$holding_cost) ); ?>
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

<script>
    $(document).ready(function () {
        $('.clockpicker').clockpicker();
      });
</script>