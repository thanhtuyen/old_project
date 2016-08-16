<?php
echo $this->element( 'back_nav',	array('text' => __('ロック解除｜ロック候補者一覧')) );
?>
  <!-- end title -->

  <!-- content -->
  <div class="wrapper wrapper-content row animated fadeInRight">
    <div class="col-lg-12">

      <!-- table 1 -->
      <div class="ibox  no-margin-bottom">
        <div class="ibox-title">
          <h5>自らがロックしている候補者一覧</h5>
        </div>                   
      </div>
      <div class="clear"></div>
      <div class="ibox ">
        <?php echo $this->Form->create();?>
        <!--end inbox content-->

        <!-- ibox-content -->
        <div class="ibox-content">

          <!--pagination-->
            <div class="text-right clearfix">
              <div class="pull-left">
              <button class="m-r-sm btn btn-primary btn-sm">チェックしたもの全てをロック解除</button>
              </div>
            </div>
            <!--pagination-->

          <!------------table-------------->  
           <div class="table-responsive">
            <table class="table table-striped table-bordered tb1 tbl-data">
              <thead>
                <tr>
                  <th><input type="checkbox" class="i-checks"></th>
                  <th>候補者ID</th>                              
                  <th width="20%">候補者名</th>
                  <th>大学名</th>
                  <th>学部名</th>
                  <th>顔写真</th>
                  <th>生年月日</th> 
                  <th colspan="2">ロックした人</th> 
                  <th>最終更新日時</th> 
                  <th>操作</th>                                            
                </tr>
              </thead>
              <tbody>
                <?php foreach($canCandidates as $canCandidate): ?>
                  <?php
                  $edu    = $canCandidate['CanEducation'];
                  $school  = $this->Enjin->getSchoolName($edu);
                  $undergra = $this->Enjin->getUnderGraduateName($edu);
                  $can    = $canCandidate['CanCandidate'];

                  $can['face_photo'] = "uploads/DS/" .$can['face_photo'];
                  if(!file_exists($can['face_photo']))
                    $can['face_photo'] = "bootstrap/icon_avatar.png";
                  ?>

                  <tr> 
                    <td>
                      <input type="checkbox" class="i-checks cbItem" name="can_id[]" value="<?php echo $can['id']?>">
                    </td>  
                    <td><a class='text-navy' href=""><?php echo h($can['id']); ?></a></td>                              
                    <td><a class='text-navy' href=""><?php echo h($can['name']); ?></a></td>
                    <td><?php echo $school ?></td>
                    <td><?php  echo $undergra ?></td>
                    <td>
                      <!--<img src="/enjin-shinsotu/img/bootstrap/icon_avatar.png" class="img-circle" alt="">-->
                      <?php echo $this->Html->image($can['face_photo'], array("alt" => "portrait"))?>
                    </td>
                    <td><?php echo $can['birthday']?></td>
                    <td><?php echo isset($can['lock_flag_name'])?$can['lock_flag_name']:'';?></td>
                    <td><a class='text-navy' href=""><?php echo isset($can['lock_name'])?$can['lock_name']:'';?></a></td>
                    <td><?php echo $can['modified']?></td>
                    <td class="hover-button">                                
                      <a href='javascript:void(0)' type='button' class="cl-white btn btn-primary btn-xs btn-unlock">ロック解除</a>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
              <thead>
                <tr>
                  <th><input type="checkbox" class="i-checks"></th>
                  <th>候補者ID</th>                              
                  <th>候補者名</th>
                  <th>大学名</th>
                  <th>学部名</th>
                  <th>顔写真</th>
                  <th>生年月日</th> 
                  <th colspan="2">ロックした人</th> 
                  <th>最終更新日時</th> 
                  <th>操作</th>                                            
                </tr>
              </thead>
            </table>
            </div>
            
          <!--pagination-->
            <div class="text-right clearfix">
              <div class="pull-left">
              <button class="m-r-sm btn btn-primary btn-sm">チェックしたもの全てをロック解除</button>
              </div>
            </div>
            <!--pagination-->

          <!------------------>
          <!--table-->
        </div>
        <!-- end ibox 2 -->
        <?php echo $this->Form->end();?>
      </div>
      <!-- end table 1 -->

      <!-- table 2 -->
      <div class="ibox  no-margin-bottom">
        <div class="ibox-title">
          <h5>他者がロックしている候補者一覧</h5>
        </div>                   
      </div>                    
      <div class="clear"></div>
      <div class="ibox">
        <!--end inbox content-->

        <!-- ibox-content -->
        <div class="ibox-content">

          <!------------table-------------->  
          <div class="table-responsive">
            <table class="table table-striped table-bordered tbl-data">
              <thead>
                <tr>                            
                  <th width="20%">候補者名</th>
                  <th>大学名</th>
                  <th>学部名</th>
                  <th>顔写真</th>
                  <th>生年月日</th> 
                  <th colspan="2">ロックした人</th> 
                  <th>最終更新日時</th> 
                  <th>操作</th>                                            
                </tr>
              </thead>
              <tbody>
                <?php foreach($canCandidates2 as $canCandidate): ?>
                  <?php
                  $edu    = $canCandidate['CanEducation'];
                  $school   = $edu[0]['School'];
                  $undergra = $edu[0]['Undergraduate'];
                  $can    = $canCandidate['CanCandidate'];

                  $can['face_photo'] = "uploads/DS/" .$can['face_photo'];
                  if(!file_exists($can['face_photo']))
                    $can['face_photo'] = "bootstrap/icon_avatar.png";
                  ?>

                  <tr> 

                    <td><a class='text-navy' href=""><?php echo h($can['name']); ?></a></td>
                    <td><?php echo $school['status'] ? $edu['school'] : $school['name']?></td>
                    <td><?php  echo $undergra['status'] ? $edu['undergraduate']: $undergra['name']?></td>
                    <td>
                      <!--<img src="/enjin-shinsotu/img/bootstrap/icon_avatar.png" class="img-circle" alt="">-->
                      <?php echo $this->Html->image($can['face_photo'], array("alt" => "portrait"))?>
                    </td>
                    <td><?php echo $can['birthday']?></td>
                    <td><?php echo isset($can['lock_flag_name'])?$can['lock_flag_name']:'';?></td>
                    <td><a class='text-navy' href=""><?php echo isset($can['lock_name'])?$can['lock_name']:'';?></a></td>
                    <td><?php echo $can['modified']?></td>
                    <td class="button_cen hover-button">                                
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
               <thead>
                <tr>                            
                  <th>候補者名</th>
                  <th>大学名</th>
                  <th>学部名</th>
                  <th>顔写真</th>
                  <th>生年月日</th> 
                  <th colspan="2">ロックした人</th> 
                  <th>最終更新日時</th> 
                  <th>操作</th>                                            
                </tr>
              </thead>
            </table>
          </div>
          <!------------------>
          <!--table-->
        </div>
        <!-- end table 2 -->
      </div>

    </div>
  </div>
  <!-- end content -->

  <script>
   $( document ).ready(function() {
      //checkbox group
      $('.table-responsive th .iCheck-helper').click(function(){
        if($(this).prev()[0].checked)
          $('.table-responsive .i-checks').iCheck('check');
        else
          $('.table-responsive .i-checks').iCheck('uncheck');
      });

      $('.btn-unlock').click(function(){
        $(this).parents('tr').find("input[type='checkbox']").attr('checked','checked').parent().addClass('checked');
        $('.btn-unlock-submit').click();
      });
    });
 </script>
 <?php
 return;
//original?>
<div class="canCandidates index">
	<h2><?php echo __('Can Candidates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('last_name'); ?></th>
				<th><?php echo $this->Paginator->sort('first_name'); ?></th>
				<th><?php echo $this->Paginator->sort('mail_address'); ?></th>
				<th><?php echo $this->Paginator->sort('tel'); ?></th>
				<th><?php echo $this->Paginator->sort('post_code'); ?></th>
				<th><?php echo $this->Paginator->sort('prefecture_id'); ?></th>
				<th><?php echo $this->Paginator->sort('residence'); ?></th>
				<th><?php echo $this->Paginator->sort('birthday'); ?></th>
				<th><?php echo $this->Paginator->sort('sex'); ?></th>
				<th><?php echo $this->Paginator->sort('referer_company_id'); ?></th>
				<th><?php echo $this->Paginator->sort('mynavi_id'); ?></th>
				<th><?php echo $this->Paginator->sort('rikunavi_id'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($canCandidates as $canCandidate): ?>
       <tr>
        <td><?php echo h($canCandidate['CanCandidate']['id']); ?>&nbsp;</td>
        <td><?php echo h($canCandidate['CanCandidate']['last_name']); ?>&nbsp;</td>
        <td><?php echo h($canCandidate['CanCandidate']['first_name']); ?>&nbsp;</td>
        <td><?php echo h($canCandidate['CanCandidate']['mail_address']); ?>&nbsp;</td>
        <td><?php echo h($canCandidate['CanCandidate']['tel']); ?>&nbsp;</td>
        <td><?php echo h($canCandidate['CanCandidate']['post_code']); ?>&nbsp;</td>
        <td>
         <?php echo h($canCandidate['Prefecture']['name']); ?>
       </td>
       <td><?php echo h($canCandidate['CanCandidate']['residence']); ?>&nbsp;</td>
       <td><?php echo h($canCandidate['CanCandidate']['birthday']); ?>&nbsp;</td>
       <td><?php echo $this->enjin->getSexName($canCandidate['CanCandidate']['sex']); ?>&nbsp;</td>
       <td>
         <?php echo h($canCandidate['RefererCompany']['name']); ?>
       </td>
       <td><?php echo h($canCandidate['CanCandidate']['mynavi_id']); ?>&nbsp;</td>
       <td><?php echo h($canCandidate['CanCandidate']['rikunavi_id']); ?>&nbsp;</td>
       <td class="actions">
         <?php echo $this->Html->link(__('View'), array('action' => 'view', $canCandidate['CanCandidate']['id'])); ?>
         <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $canCandidate['CanCandidate']['id'])); ?>
         <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $canCandidate['CanCandidate']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $canCandidate['CanCandidate']['id']))); ?>
       </td>
     </tr>
   <?php endforeach; ?>
 </tbody>
</table>
<p>
  <?php
  echo $this->Paginator->counter(array(
    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
    ?></p>
    <div class="paging">
      <?php
      echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
      echo $this->Paginator->numbers(array('separator' => ''));
      echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
      ?>
    </div>
  </div>
