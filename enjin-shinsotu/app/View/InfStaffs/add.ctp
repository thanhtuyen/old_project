<?php echo $this->Html->css('enjin/25_08_recruiters_details.css'); ?>
<script>
document.getElementById("uploadfile").onchange = function () {
	var filename = this.value;
	var lastIndex = filename.lastIndexOf("\\");
	if (lastIndex >= 0) {
	  filename = filename.substring(lastIndex + 1);
	}
	document.getElementById("filename").value = filename;
};
</script>

<!-- --------------start contents----------------- -->  
<!-- --------------start contents----------------- -->  
<!-- --------------start contents----------------- -->  
<!-- --------------start contents----------------- -->
<?php $url = '/RefererCompanies/detail/'.$id; ?>
<?php echo $this->element('back_nav', array('text' => __('流入元担当者 新規登録'),'url'=>$url))?>

<div class="row wrapper wrapper-content animated fadeInRight title-button pd-bottom-none">

<div class="margin-top-15 col-lg-8">
  	<div class = "ibox">
    <div class="ibox-title">
    <h5>募集エリア</h5>
 </div>
        <div class="table-border">
        <!-- ------------------- -->
		<div class="ibox-content bg-white p-sm clearfix show-data">
            <div class="col-lg-2 m-t-lg">
                <?php echo $this->Html->image("bootstrap/icon_avatar.png", array(
                "class" => "img-reponsive center-block",
                )); ?>
                <p class="text-center m-t">顔写真</p>
            </div>
          <div class="col-lg-10">
          	<!-- START FORM --- ----- --- -->
            <?php echo $this->Form->create('InfStaff', array('type'=>'post', 'class'=>'form-horizontal form-edit')); ?>
                <div class = "clear10"></div>
                <div class="form-group"><label class="col-sm-4 control-label">氏</label>
                    <div class="col-sm-8">
                    	<?php echo $this->Form->input('InfStaff.first_name', array('label'=>false, 'class'=>'form-control', 'type' => 'text')); ?>
                    </div>
                </div>
                <div class = "clear10"></div>
               	<div class="form-group"><label class="col-sm-4 control-label">名</label>
                    <div class="col-sm-8">

                    	<?php echo $this->Form->input('InfStaff.last_name', array('label'=>false, 'class'=>'form-control')); ?>

                    </div>
                </div>
                <div class = "clear10"></div>
                <div class="form-group"><label class="col-sm-4 control-label">メール</label>
                    <div class="col-sm-8">
                    	<?php echo $this->Form->input('InfStaff.mail_address', array('label'=>false, 'class'=>'form-control')); ?>
                    </div>
                </div>
                <div class = "clear10"></div>
                <div class="form-group"><label class="col-sm-4 control-label">電話</label>
                    <div class="col-sm-8">
                    	<?php echo $this->Form->input('InfStaff.tel', array('label'=>false, 'class'=>'form-control')); ?>
                    </div>
                </div>
            <!-- END FORM --- ------- ------ -->
          </div>
           <div class = "clear15"></div>
            <p class = "text-center btn-clear">
                <a  href="<?php echo $this->HTML->url(array('controller'=>'RefererCompanies','action' => 'detail',$id));?>" class = "margin20 text-center text-navy" ref="#">キャンセル</a>
                <button class=" btn btn-primary">更新</button>
             </p>
			<!-- ------------------- -->
            </div>
          </div>  
            <?php $this->Form->end();?>

        </div>
</div>
</div>
<!-- ---------------end contents------------ --> 
<!-- ---------------end contents------------ --> 
<!-- ---------------end contents------------ -->
<!-- ---------------end contents------------ -->
<?php echo $this->element('b_back_nav',array('url'=>$url))?>