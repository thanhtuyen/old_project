<?php
$z[]='';
$z[]=$this->Form->create('EvEvent', array('class'=>'form-horizontal form-edit',));
$z[]=$this->Form->input('name');
$z[]=$this->Form->end(__('Submit'));




function ex(&$stack){
	echo next($stack);
}
?>

<div class="row wrapper border-bottom white-bg page-heading">
                          <div class="col-lg-10">
                            <h2>  
                              Add Ev Event</h2>
                            </div>
                          </div>

                          <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">

                            <div class="plist-two-layout">
                              <!--layout left-->
                              <div class="col-lg-8">
                                <div class="ibox">

                                  <div class="ibox-title">
                                    <h5>Add Ev Event</h5>
                                    
                                  </div>
                                  <div class="ibox-content bg-white">
                                    <!-- <form method="get" class="form-horizontal form-edit" > -->
                                    <?php ex($z)?>
                                    <?php echo $this->Form->create('EvEvent',array('class'=>'form-horizontal form-edit')); ?>

                                      
                                      <div class="form-group">
                                        <!-- <label class="col-sm-4 control-label text-left">Name</label> -->
                                        <?php ex($z)?>
                                        <!-- <div class="col-sm-8"><input type="text" class="form-control" value="イベント名入力"></div> -->
                                      </div>

                                      
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label text-left text-left">Rec Company</label>
                                        <div class="col-sm-8"><input type="text" class="form-control" value="求人票選択"></div>
                                      </div>

                                      

                                      <div class="form-group">
                                        <label class="col-sm-4 control-label text-left">Job Vote</label>
                                        <div class="col-sm-8"><input type="text" class="form-control" value="説明会"></div>
                                      </div>

                                      <!-- textarea -->
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label text-left">Type</label>
                                        <div class="col-sm-8"><input type="text" class="form-control" value="1次選考"></div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-sm-4 control-label text-left">Screening Stage  
                                        </label>
                                        <div class="col-sm-8"><input type="text" class="form-control" value="以前"></div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-sm-4 control-label text-left">Screening Stage Type</label>
                                        <div class="col-sm-8"><input type="text" class="form-control" value="ステータス選択"></div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-sm-4 control-label text-left">Target Select</label>
                                        <div class="col-sm-8"><textarea class="form-control">イベント内容入力</textarea></div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-sm-4 control-label text-left">Contents</label>
                                        <div class="col-sm-8"><input type="text" class="form-control" value="ID入力"></div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-sm-4 control-label text-left">Rikunavi</label>
                                        <div class="col-sm-8"><input type="text" class="form-control" value="ID入力"></div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label text-left">Mynavi</label>
                                        <div class="col-sm-8"><input type="text" class="form-control" value="ID入力"></div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-sm-4 control-label text-left">Status</label>
                                        <div class="col-sm-8"><input type="text" class="form-control" value="ID入力"></div>
                                      </div>

                                      
                                      <div class="btn-clear">
                                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                                      </div>
                                    </form>                                        
                                  </div>
                                </div>


                              </div>

                              
                              <!--layout right-->
                              <div class="col-lg-4">
                                <!--layout calender-->
                                <div class="ibox">
                                  <div class="ibox-title">
                                    <h5>求人担当者登録</h5>
                                    <div class="ibox-tools">
                                      <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                      </a>                                                           
                                    </div>
                                  </div>
                                  

                                  <div class="ibox-content bg-white">
                                    <form method="get" class="form-horizontal ">
                                      <div class="form-group"><label class="col-sm-4 control-label text-left">求人票ID</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none"><a class="text-navy" href="">ABC123456</a></div>
                                        </div>
                                      </div>
                                      <div class="form-group"><label class="col-sm-4 control-label text-left">氏フリガナ</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">求人票タイトル</div>
                                        </div>
                                      </div>        
                                      <div class="form-group"><label class="col-sm-4 control-label text-left">募集要項</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">仕事の内容を掲載</div>
                                        </div>
                                      </div>    
                                      <div class="form-group"><label class="col-sm-4 control-label text-left">職種タイプ</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">営業</div>
                                        </div>
                                      </div>    
                                      <div class="form-group"><label class="col-sm-4 control-label text-left">初任給</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">24万円</div>
                                        </div>
                                      </div>    
                                      <div class="form-group"><label class="col-sm-4 control-label text-left">待遇</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">待遇内容を掲載</div>
                                        </div>
                                      </div>  

                                      <div class="form-group"><label class="col-sm-4 control-label text-left">応募資格</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">応募資格を掲載</div>
                                        </div>
                                      </div>  

                                      <div class="form-group"><label class="col-sm-4 control-label text-left">募集人数</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">10人</div>
                                        </div>
                                      </div>  

                                      <div class="form-group"><label class="col-sm-4 control-label text-left">募集期限</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">YYYY / MM / DD</div>
                                        </div>
                                      </div>  

                                      <div class="form-group"><label class="col-sm-4 control-label text-left">公開開始日時</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">yyyy / mm / dd hh:mm</div>
                                        </div>
                                      </div>  

                                      <div class="form-group"><label class="col-sm-4 control-label text-left">募集エリア</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">エリア名</div>
                                        </div>
                                      </div>                   
                                    </form>
                                    <?php echo $this->Form->end(); ?>                 
                                    <br>

                                  </div>



                                </div>
                                

                              </div>

                              

                            </div>



                          </div>

                          <br>
                          <br>              

                          <div class='clearfix'></div>
                          <div class="footer">
                            <div>
                              <strong>Copyright</strong>© enjin
                            </div>
                          </div>


<div class="evEvents form">
<?php echo $this->Form->create('EvEvent'); ?>
	<fieldset>
		<legend><?php echo __('Add Ev Event'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('rec_company_id', array( 'options' => $recCompanies ));
		echo $this->Form->input('job_vote_id',array('empty' => ''));
		echo $this->Form->input('type', array( 'options' => $type ));
		echo $this->Form->input('screening_stage_id');
		echo $this->Form->input('screening_stage_type', array( 'options' => $screeningStageType ));
		echo $this->Form->input('target_select_id', array( 'options' => $selectJudgmentType ));
		echo $this->Form->input('contents');
		echo $this->Form->input('rikunavi_id',array('type' => 'text'));
		echo $this->Form->input('mynavi_id',array('type' => 'text'));
		echo $this->Form->input('status', array( 'options' => $evStatus ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
