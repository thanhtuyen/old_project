<?php
//RefererCompany edit VIEW
//*
echo $this->element( 'back_nav',  array('text' => __('流入元担当者詳細｜%d %s', $id, $name)) );?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
  <div class="full-content">
    <div class="col-lg-8">
      <div class="ibox">
        <!-- title -->
        <div class="ibox-title">
          <h5>流入元企業情報</h5>
        </div>

        <!-- content -->
        <div class="ibox-content bg-white p-sm clearfix">
          <div class="">
            <?php echo $this->Form->create('RefererCompany', array('type' => 'post', 'class' => 'form-horizontal form-edit'))?>

              <div class="form-group">
                <label class="col-sm-4 control-label">会社ID</label>
                <div class="col-sm-8">
                  <div class="form-control border-none">
                    <?php echo $id;
                    echo $this->Form->input('id');?>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">企業名</label>
                <div class="col-sm-8">
                  <div class="form-control border-none">
                    <?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => false, 'div' => false))?>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">流人元タイプ</label>
                <div class="col-sm-8">
                  <div class="form-control border-none">
                    <?php echo $this->Form->input('influx_original_type', array('class' => 'btn btn-white', 'options' => $influxOriginalType, 'label' => false, 'div' => false))?>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">都道府県</label>
                <div class="col-sm-8">
                  <div class="form-control border-none">
                    <?php echo $this->Form->input('prefecture_id', array('class' => 'btn btn-white', 'label' => false, 'div' => false))?>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">市区町村</label>
                <div class="col-sm-8">
                  <div class="form-control border-none">
                    <?php echo $this->Form->input('city_id', array('class' => 'btn btn-white', 'label' => false, 'div' => false))?>
                  </div>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="tb-footer text-center btn-clear">
                  <?php echo $this->Html->link(__('キャンセル'), array('action' => 'index'), array('class' => 'text-navy'))?>
                  <button class="btn btn-primary w-95" id="btn-save" type="submit"><?php echo __('変更')?></button>
                </div>
              </div>
            </form>  
          </div> 
        </div>  
        <!-- end content -->
      </div>
    </div>
  </div>
</div>

<?php echo $this->element('b_back_nav')?>
<?php
return;
//*/
//OLD InfStaff edit VIEW
?>
<!-- css -->
<?php echo $this->Html->css('enjin/25_08_recruiters_details.css'); ?>
<!-- end css -->
<!-- Custom and plugin javascript -->
<?php echo $this->Html->script('inspinia.js'); ?>
<?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
<!-- Peity -->
<?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>
<!-- end script -->

<?php echo $this->element( 'back_nav',  array('text' => __('流入元担当者詳細｜%d %s', $infStaff['InfStaff']['id'], $infStaff['InfStaff']['name'])) );?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">

<!-- content -->   
<div class="full-content">
  <div class="col-lg-8">
    <div class="ibox">
      <div class="ibox-title">
        <h5>採用担当者情報</h5>                             
      </div>
      <div class="ibox-content bg-white p-sm clearfix show-data">
        <?php echo $this->Form->create('InfStaff', array('type'=>'post', 'class'=>'form-horizontal form-edit')); ?>
        <div class="col-lg-2 m-t-lg">
          <?php echo $this->Html->image("bootstrap/icon_avatar.png", array("class" => "img-reponsive center-block",)); ?>
          <p class="text-center m-t">顔写真</p>
        </div>

        <div class="col-lg-10">
         
            <div class="form-group">
              <label class="col-sm-4 control-label">採用担当者ID</label>
              <div class="col-sm-8">
                <div class="form-control border-none"><?php echo $infStaff['InfStaff']['id']; ?></div>
                <?php echo $this->Form->input('id');?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">氏</label>
              <div class="col-sm-8">
                <?php echo $this->Form->input('InfStaff.first_name', array('label'=>false, 'class'=>'form-control', 'type' => 'text')); ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">名</label>
              <div class="col-sm-8">
                <?php echo $this->Form->input('InfStaff.last_name', array('label'=>false, 'class'=>'form-control')); ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">メール</label>
              <div class="col-sm-8">
                <?php echo $this->Form->input('InfStaff.mail_address', array('label'=>false, 'class'=>'form-control')); ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">電話</label>
              <div class="col-sm-8">
                <?php echo $this->Form->input('InfStaff.tel', array('label'=>false, 'class'=>'form-control')); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label">ステータス</label>
              <div class="col-sm-8">
                <?php echo $this->Form->input('InfStaff.status', array(
                  'label'=> false,
                  'options' => $inf_status,
                  'class' => 'form-control'
                )); ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">最終更新採用担当者</label>
              <div class="col-sm-8">
                <div class="form-control border-none">
                  
                  <a class='text-navy' href="../../RecRecruiters/view/<?php echo $infStaff['RecRecruiter']['id'];?>"><?php echo $infStaff['RecRecruiter']['last_name']; ?>  <?php echo $infStaff['RecRecruiter']['first_name']; ?></a>

                </div>
              </div>
            </div>      
            <div class="form-group">
              <label class="col-sm-4 control-label"><?php echo __('最終ログイン')?></label>
              <div class="col-sm-8">
                <div class="form-control border-none"><?php echo $infStaff['InfStaff']['last_login_date'];?></div>
              </div>
            </div>
        </div>
                    <!-- action -->
            <div class='col-lg-12 txt-align'>
              <a class='text-navy m-r-md' href="../view/<?php echo $infStaff['InfStaff']['id'];?>">キャンセル</a>     
                <?php echo $this->Form->submit('編集', 
                  array(
                    'type'=> 'submit',
                    'class' => "btn btn-primary w-95",
                    'div' => false
                )); ?>
            </div>
            <!-- end action -->
          <?php $this->Form->end();?>
      </div>
    </div>
  </div>
</div>
<!-- end content -->