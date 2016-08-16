  <!-- css -->
  <?php echo $this->Html->css('enjin/25_08_recruiters_details.css'); ?>
  <!-- end css -->

  <!-- script -->
  <?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
  <?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>
  <!-- end script -->

<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>   
    流入元担当者編集｜<?php echo $infStaff['InfStaff']['id']; ?> <?php echo $infStaff['InfStaff']['last_name']; ?> <?php echo $infStaff['InfStaff']['first_name']; ?></h2>
  </div>
</div>

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">

  <!-- content -->   
  <div class="full-content">
    <div class="col-lg-8">
        <?php echo $this->Form->create('InfStaffs', array('class' => 'form-horizontal form-edit'))?>
      <div class="ibox">
        <div class="ibox-title">
          <h5>流入元担当者情報</h5>                             
        </div>
        <div class="ibox-content bg-white p-sm clearfix show-data">
          <div class="col-lg-3 m-t-lg">

            <?php echo $this->Html->image("bootstrap/icon_avatar.png", array("class" => "img-reponsive center-block",)); ?>
            <p class="text-center m-t">顔写真</p>

          </div>
          <div class="col-lg-9">
            <form method="get" class="form-horizontal form-edit">

              <div class="form-group">
                <label class="col-sm-4 control-label">流入元担当者ID</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $infStaff['InfStaff']['id']; ?></div>
                  <?php echo $this->Form->hidden('InfStaff.id');?>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">氏</label>
                <div class="col-sm-8">
                  <?php echo $this->Form->input('InfStaff.last_name', array('class' => 'form-control', 'label' => false, 'div' => false))?>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">名</label>
                <div class="col-sm-8">
                  <?php echo $this->Form->input('InfStaff.first_name', array('class' => 'form-control', 'label' => false, 'div' => false))?>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">メール</label>
                <div class="col-sm-8">
                  <?php echo $this->Form->input('InfStaff.mail_address', array('class' => 'form-control', 'label' => false, 'div' => false))?>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">電話</label>
                <div class="col-sm-8">
                  <?php echo $this->Form->input('InfStaff.tel', array('class' => 'form-control', 'label' => false, 'div' => false))?>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">最終更新採用担当者</label>
                <div class="col-sm-8">
                  <div class="form-control border-none">
                    <a class='text-navy' href="../../RecRecruiters/view/<?php echo $infStaff['InfStaff']['rec_recruiter_id'];?>"><?php echo $infStaff['RecRecruiter']['last_name']; ?>  <?php echo $infStaff['RecRecruiter']['first_name']; ?></a>
                  </div>
                </div>
              </div>      
              <div class="form-group">
                <label class="col-sm-4 control-label">最終ログイン日</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $infStaff['InfStaff']['last_login_date'];?></div>
                </div>
              </div>    

              <!-- action -->
              <div class='col-lg-10 text-center m-t'>
                  <?php echo $this->Html->link(__('キャンセル'), array('controller' => 'InfStaffs','action' => 'view' , $infStaff['InfStaff']['referer_company_id']), array('class' => 'text-navy'))?>
                <?php echo $this->Form->submit('編集', 
                  array(
                    'type'=> 'submit',
                    'class' => "btn btn-primary btn-sm hover-button",
                    'div' => false
                )); ?>
                <div class='clearfix'></div>
              </div>
              <!-- end action -->
            <?php $this->Form->end();?>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end content -->
