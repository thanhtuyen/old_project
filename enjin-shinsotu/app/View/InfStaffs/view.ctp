<!-- css -->
<?php echo $this->Html->css('enjin/25_08_recruiters_details.css'); ?>
<!-- end css -->

<!-- script -->
<!-- Custom and plugin javascript -->
<?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
<!-- Peity -->
<?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>
  <!-- end script -->
<?php echo $this->element('back_nav', array('text' => __('流入元担当者詳細｜%d %s', $infStaff['InfStaff']['id'], $infStaff['InfStaff']['name']), 'url' => array('controller' => 'RefererCompanies', 'action' => 'detail', $infStaff['InfStaff']['referer_company_id'])))?>

<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">

<!-- START content -->   
<div class="full-content">
  <div class="col-lg-8">
    <div class="ibox">
      <div class="ibox-title">
        <h5>流入元担当者情報</h5>
        <div class="ibox-tools">
          <a href="../edit/<?php echo $infStaff['InfStaff']['id']; ?>" type="button" class="btn btn-primary btn-xs">編集</a>
        </div>
      </div>
      <div class="ibox-content bg-white p-sm clearfix show-data">
        <div class="col-lg-2 m-t-lg">
          <?php echo $this->Html->image("bootstrap/icon_avatar.png", array("class" => "img-reponsive center-block",)); ?>
          <p class="text-center m-t">顔写真</p>
        </div>
        <div class="col-lg-10">
          <form method="get" class="form-horizontal form-info">

            <div class="form-group">
              <label class="col-sm-4 control-label">流入元担当者ID</label>
              <div class="col-sm-8">
                <div class="form-control border-none"><?php echo $infStaff['InfStaff']['id']; ?></div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">名前</label>
              <div class="col-sm-8">
                <div class="form-control border-none"><?php echo $infStaff['InfStaff']['name']; ?></div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">メール</label>
              <div class="col-sm-8">
                <div class="form-control border-none h-auto">
                  <a class='text-navy' href=""><?php echo $infStaff['InfStaff']['mail_address']; ?></a>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">電話</label>
              <div class="col-sm-8">
                <div class="form-control border-none"><?php echo $infStaff['InfStaff']['tel']; ?></div>
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
              <label class="col-sm-4 control-label">最終ログイン</label>
              <div class="col-sm-8">
                <div class="form-control border-none"> <?php echo $infStaff['InfStaff']['last_login_date'];?> </div>
              </div>
            </div>                                  
          </form>
        </div>
      </div>   
    </div>
  </div>
</div>

</div>
<!-- END content -->                    

<?php echo $this->element('b_back_nav', array('url'=>array('controller' => 'RefererCompanies', 'action' => 'detail', $infStaff['InfStaff']['referer_company_id'])))?>