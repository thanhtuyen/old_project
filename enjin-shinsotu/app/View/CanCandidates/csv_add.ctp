<!-- titile -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>候補者 CSV 登録</h2>
    </div>
</div>
<!-- end title -->
<!-- content -->
<div class="wrapper wrapper-content row animated fadeInRight clearfix">

    <div class='full-content'>
        
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                    <h5>CSV ファイル送信</h5>
                </div>
                      <div class="ibox-content clearfix p-sm" id="csvAdd">
                        <?php echo $this->Form->create('CanCandidates',array('action'=>'csv_add','type'=>'file', 'class'=>"form-horizontal form-edit")); ?>
           

                          <div class="form-group"><label class="col-sm-2 control-label">言語</label>
                            <div class="col-sm-4">
            
                               <?php echo $this->Form->input('navigators', array('class' => 'form-control', 'label' => false, 'options' => $navigators )); ?>
                            </div>
                          </div>

                          <div class="form-group"><label class="col-sm-2 control-label">入社可能年月</label>
                            <div class="col-sm-4">
                              <div class="form-group data_4 mg-left-none" id="">
                                <div class="input-group date">
                                  <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                  <?php echo $this->Form->input('joinPossibleDate', array(
                                        'class' => 'form-control',
                                        'type' => '',
                                        'label' => false,
                                        'dateFormat' => 'YM',
                                        'monthNames' => false,
                                        'maxYear' => date('YM') +5,
                                        'minYear' => date('YM'),
                                         )); ?>

                                </div>

                                
                              </div>
                            </div>
                          </div>


                          <div class="form-group bg-sl-btn fix-height">
                        <div class="fix-medium">
                            <label class="col-sm-2 control-label">ファイル選択</label>
                            <div class="col-sm-10">
                                <div class="col-sm-8">
                                    <div class="choosefile">
                                        <div class="choosefile">
                                        <?php echo $this->Form->input('CsvFile',array( 'label'=>'','type'=>'file', 'class' =>'upload pull-left', 'id'=>'uploadfile',
                                        'div' =>array( 'class' => 'fileUpload  btn-upload row')
                                        )); ?>
                                        <i class="fa fa-folder-o icon-folder"></i>
                                    </div>
                                    </div>

                                    <div class="inputfile row">
                                        <input type="text" placeholder="" id="filename" class="form-control bg-white" readonly="true">
                                    </div>
                                </div>
                                <div class="form-submit-button col-sm-4">
                                    <button class="btn pull-left btn-primary btn-sm mrt3" type="submit">ファイル送信</button>
                                </div>
                            </div>
                        </div>
                    </div>

                          

                
          
         

                        
                       
      


        <?php echo $this->Form->end() ?>
    <div class='wrapper-content-large-border wrapper-content-theight bg-white'>
        <div class='wraper-process-bar'>
            <?php if (!empty($errors) || !empty($successCount)): ?>
                <div class='proress-bar'>
                    <div class="progress progress-striped active m-b-sm p-bar-status">
                        <div style="width: 100%;" class="progress-bar"></div>
                    </div>
                </div>
                <div class='proress-bar title-upload-progress'>
                    <label class='control-label'>登録成功<?php echo $successCount; ?>件／登録エラー<?php echo count($errors); ?>件</label>
                </div>
                <table class="table table-bordered ">
                    <thead>
                    <tr>
                        <th class="">行 </th>
                        <th class="">名前</th>
                        <th class="">エラー内容</th>
                    </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($errors as $line => $value): ?>
                    <tr>
                        <td><?php echo $line; ?>行目</td>
                        <td><?php echo $value['name']; ?>  </td>
                        <td><?php echo $value['messege']; ?></td>
                    </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class='border-bar google-map fade'>
                    <div class='progress-textarea'>
                          <textarea rows='13' class='form-control border-none bg-white' readonly='true'>
<?php foreach ($errors as $value): ?>
<?php echo $value['csv']; ?>

<?php endforeach; ?>
                        </textarea>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- end content -->
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
<style>

@-webkit-keyframes fadeInDown {
    0% {
        filter: alpha(opacity=0);
        -moz-opacity:0;
        opacity:0;
    }
    100% {
        filter: alpha(opacity=100);
        -moz-opacity:1;
        opacity:1;

    }
}
.fade {
    -webkit-animation-name: fadeInDown;
    -webkit-animation-duration: 2s;
    -webkit-animation-fill-mode:forwards;
}

</style>
<?php return;?>
<fieldset>
	<legend><?php echo __('CanCandidates csv_add'); ?></legend>

	<h1>ファイル追加</h1>
	<div>
	<?php
	    echo $this->Form->create('CanCandidates',array('action'=>'csv_add','type'=>'file'));
		echo $this->Form->input('navigators', array( 'options' => $navigators ));
		echo $this->Form->input('joinPossibleDate', array(
										'type' => 'date',
										'dateFormat' => 'YM',
										'monthNames' => false,
										'maxYear' => date('YM') +5,
										'minYear' => date('YM'),
										 )
		);
	    echo $this->Form->input('CsvFile',array('label'=>'','type'=>'file'));
	    echo $this->Form->end('Upload');
	?>
	<?php if (isset($error)) {
		foreach ($error as $msg){
			echo '<div style="padding:5px;margin:5px;color:red;">';
			echo $msg."<br/>";
			echo "</div>";
		}
	} ?>
	</div>
</fieldset>
