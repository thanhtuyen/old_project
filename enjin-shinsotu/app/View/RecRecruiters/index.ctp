<?php
//tailored
$recRecruiter = $recRecruiter['RecRecruiter'];

//tel mask
$tel = $recRecruiter['tel'];
$xlength=strlen($tel);
$tel = substr( $tel, 0, 3 );
$tel = str_pad( $tel, $xlength, "x");

//default image
if(empty($recRecruiter['face_photo']))
  $recRecruiter['face_photo'] = $this->webroot. 'img/bootstrap/icon_avatar.png';

//CSS
echo $this->Html->css('enjin/25_08_recruiters_details');

echo $this->element( 'back_nav', array('text' => __('採用担当者詳細｜%d %s', $recRecruiter['id'], $recRecruiter['name']), 'noBtn' => true) );?>

  <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
   <div class="col-lg-8">
    <div class="ibox">
      <div class="ibox-title">
        <h5><?php echo __('求人票詳細')?></h5>
        <div class="ibox-tools">
         <?php
         echo $this->Form->input(__('編集'),
           array('type' => 'button', 'class' => 'show-data btn btn-primary btn-xs', 'div' => false, 'label' => false, 'onclick' => "window.location.href='" .$this->Html->url(array(
            "controller" => "rec_recruiters",
            "action" => "edit", $recRecruiter['id'])). "'"));?>
          </div>
        </div>
        <div class="ibox-content bg-white p-sm clearfix show-data">
          <div class="col-lg-2 m-t-lg">
            <?php echo $this->Html->image($recRecruiter['face_photo'], array('class' => 'img-reponsive center-block', 'alt' => __('顔写真'), 'width' => '100%'))?>
          </div>
          <div class="col-lg-10">
            <form method="get" class="form-horizontal" id="1156349976">
              <div class="row form-group">
                <label class="col-sm-4 control-label">採用担当者ID</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $recRecruiter['id']?></div>
                </div>
              </div>
              <div class="row form-group">
                <label class="col-sm-4 control-label">名前</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $recRecruiter['name']?></div>
                </div>
              </div>
              <div class="row form-group">
                <label class="col-sm-4 control-label">部署</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $recDepartments[$recRecruiter['rec_department_id']]?></div>
                </div>
              </div>
              <div class="row form-group">
                <label class="col-sm-4 control-label">採用者タイプ</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $focalPointType[$recRecruiter['focal_point_type']]?></div>
                </div>
              </div>
              <div class="row form-group">
                <label class="col-sm-4 control-label">メール</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><a class='text-navy' href="mailto:<?php echo $recRecruiter['mail']?>"><?php echo $recRecruiter['mail']?></a></div>
                </div>
              </div>
              <div class="row form-group">
                <label class="col-sm-4 control-label">パスワード</label>
                <div class="col-sm-8">
                  <div class="form-control border-none">............</div>
                </div>
              </div>
              <div class="row form-group">
                <label class="col-sm-4 control-label">電話</label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $tel?></div>
                </div>
              </div>
              <div class="row form-group">
                <label class="col-sm-4 control-label">決裁者フラグ</label>
                <div class="col-sm-8">
                  <div class="form-control border-none">
                    <div class="switch">
                      <div class="onoffswitch">
                       <?php echo $this->Form->checkbox('approval_flag',
                         array('hiddenField' => false, 'class' => 'onoffswitch-checkbox',
                         'id' => 'cb1', 'checked' => $recRecruiter['approval_flag'] == 0))?>
                         <label class="onoffswitch-label" for="cb1">
                          <span class="onoffswitch-inner"></span>
                          <span class="onoffswitch-switch"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <label class="col-sm-4 control-label"><?php echo __('最終ログイン')?></label>
                <div class="col-sm-8">
                  <div class="form-control border-none"><?php echo $recRecruiter['last_login_date']?></div>
                </div>
              </div>                                      
            </form>
          </div>
        </div>   
      </div>
    </div>
  </div>
  <br>
  <br>
  <?php

  return;
//original
  ?>
  <div class="recRecruiters index">
   <h2><?php echo __('Rec Recruiters'); ?></h2>
   <table cellpadding="0" cellspacing="0">
     <thead>
       <tr>
         <th><?php echo $this->Paginator->sort('id'); ?></th>
         <th><?php echo $this->Paginator->sort('last_name'); ?></th>
         <th><?php echo $this->Paginator->sort('first_name'); ?></th>
         <th><?php echo $this->Paginator->sort('focal_point_type'); ?></th>
         <th><?php echo $this->Paginator->sort('mail'); ?></th>
         <th><?php echo $this->Paginator->sort('rec_department_id'); ?></th>
         <th><?php echo $this->Paginator->sort('face_photo'); ?></th>
         <th><?php echo $this->Paginator->sort('tel'); ?></th>
         <th><?php echo $this->Paginator->sort('approval_flag'); ?></th>
         <th><?php echo $this->Paginator->sort('last_login_date'); ?></th>
         <th class="actions"><?php echo __('Actions'); ?></th>
       </tr>
     </thead>
     <tbody>
       <?php foreach ($recRecruiters as $recRecruiter): ?>
       <tr>
        <td><?php echo h($recRecruiter['RecRecruiter']['id']); ?>&nbsp;</td>
        <td><?php echo h($recRecruiter['RecRecruiter']['last_name']); ?>&nbsp;</td>
        <td><?php echo h($recRecruiter['RecRecruiter']['first_name']); ?>&nbsp;</td>
        <td><?php echo $this->Enjin->getFocalPointTypeName($recRecruiter['RecRecruiter']['focal_point_type']); ?>&nbsp;</td> 
        <td>
          <a href="mailto:<?php echo h($recRecruiter['RecRecruiter']['mail'])?>"><?php echo h($recRecruiter['RecRecruiter']['mail'])?></a>
        </td>
        <td>
         <?php echo $this->Html->link($recRecruiter['RecDepartment']['department_name'], array('controller' => 'rec_departments', 'action' => 'view', $recRecruiter['RecDepartment']['id'])); ?>
       </td>
       <td><?php echo h($recRecruiter['RecRecruiter']['face_photo']); ?>&nbsp;</td>
       <td><?php echo h($recRecruiter['RecRecruiter']['tel']); ?>&nbsp;</td>
       <td><?php echo $this->Enjin->getApprovalFlagName($recRecruiter['RecRecruiter']['approval_flag']); ?>&nbsp;</td>
       <td><?php echo h($recRecruiter['RecRecruiter']['last_login_date']); ?>&nbsp;</td>
       <td class="actions">
         <?php echo $this->Html->link(__('View'), array('action' => 'view', $recRecruiter['RecRecruiter']['id'])); ?>
         <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $recRecruiter['RecRecruiter']['id'])); ?>
         <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $recRecruiter['RecRecruiter']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $recRecruiter['RecRecruiter']['id']))); ?>
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
   ?>	</p>
   <div class="paging">
     <?php
     echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
     echo $this->Paginator->numbers(array('separator' => ''));
     echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
     ?>
   </div>
 </div>
