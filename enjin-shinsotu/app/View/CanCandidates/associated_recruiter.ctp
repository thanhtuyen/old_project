<!-- title -->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>候補者付随データ編集 ｜ <?php echo h($CanCandidate['CanCandidate']['id']);?> <?php echo h($CanCandidate['CanCandidate']['last_name']); ?> <?php echo h($CanCandidate['CanCandidate']['first_name']); ?></h2>
  </div>
</div>
<!-- end title -->
<!-- content -->
<div class="wrapper wrapper-content row animated fadeInRight clearfix">
  <div class="col-lg-8">
    <div class='ibox'>
      <div class="ibox-title">
        <h5>候補者情報</h5>
        <div class="ibox-tools">
          <button type='button' class='btn btn-primary btn-xs' onclick="$('#CanCandidateAssociatedForm').submit();">編集</button>
        </div>
      </div>
      <div class='ibox-content bg-white p-sm'>
        <div class="">
          <div class="tabs-container">
            <ul class="nav nav-tabs">
              <li class=""><a  href="../edit/<?php echo $CanCandidate['CanCandidate']['id']; ?>">基本データ</a></li>
              <li class="active"><a href="#tab-2">付随データ </a></li>
            </ul>
            <div class="tab-content">
              <!-- tab container 1 -->
              <div id="tab-2" class="tab-pane active">
                <div class="panel-body form-edit p-sm">
                <?php echo $this->Form->create('', array('class' =>'form-horizontal form-edit','type'=>'file', 'enctype' => 'multipart/form-data')); ?>
                <?php echo $this->Form->hidden('id');?>

                  <?php if(!empty($CanCandidate['CanDocument'])):?>
                  <?php   $no = 0; ?>
                  <?php   foreach($CanCandidate['CanDocument'] as $row => $doc):?>
                  <?php     if($row === 'new'): continue; endif; ?>
                  <?php     echo $this->Form->hidden("CanDocument.edit-{$no}.id", array('value'=>$doc['id']));?>
                  <?php     echo $this->Form->hidden("CanDocument.edit-{$no}.delete", array('value'=>'0'));?>
                  <div class='ibox no-margin-bottom'>
                    <div class="ibox-title">
                      <h5>提出書類</h5>
                      <div class="ibox-tools">
                        <a class="close-link">
                          <i class="fa fa-times"></i>
                        </a>
                      </div>
                    </div>
                    <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                        <div class="form-horizontal">
                            <div class="form-group"><label class="col-sm-4 control-label">ファイル</label>
                                <div class="col-sm-8">
                                    <div class="form-control border-none">
                                      <?php 
                                        $url = '../../CanDocuments/download/' . $CanCandidate['CanCandidate']['id'] . '/' . $doc['id'];
                                      ?>
                                      <a class='text-navy' target="_blank" href="<?php echo $url;?>"><?php echo h($doc['file_name'] . '.' . $doc['extension']); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                    </div>
                  <?php     $no++; ?>
                  <?php   endforeach; ?>
                  <?php endif; ?>

                  <div class='ibox no-margin-bottom'>
                    <div class="ibox-title">
                      <h5>提出書類</h5>
                      <div class="ibox-tools">
                        <a class="close-link">
                          <i class="fa fa-times"></i>
                        </a>
                      </div>
                    </div>
                    <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none" id="DocumentBlock">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">ファイル</label>
                          <div class="col-sm-8">
                            <span class="fileUpload btn btn-primary pull-left">
                              <span>ファイル選択</span>
                              <input type="file" class="upload" name="data[CanDocument][new][file][]">
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>



                  <div id="LanguageInsertPoint">
                  <?php if(!empty($this->data['CanLanguage'])):?>
                  <?php   $no = 0; ?>
                  <?php   foreach($this->data['CanLanguage'] as $row => $lang):?>
                  <?php     if($row === 'new'): continue; endif; ?>
                  <?php     echo $this->Form->hidden("CanLanguage.edit-{$no}.id", array('value'=>$lang['id']));?>
                  <?php     if(isset($lang['delete']) && $lang['delete'] == '1') : ;?>
                  <?php       echo $this->Form->hidden("CanLanguage.edit-{$no}.delete", array('value'=>'1'));?>
                  <?php     else : ?>
                  <?php       echo $this->Form->hidden("CanLanguage.edit-{$no}.delete", array('value'=>'0'));?>
                  <div class='ibox no-margin-bottom LanguageBlock'>
                    <div class="ibox-title">
                      <h5>語学</h5>
                      <div class="ibox-tools">
                        <a class="close-link">
                          <i class="fa fa-times"></i>
                        </a>
                      </div>
                    </div>
                    <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                      <div class="form-horizontal">
                        <div class="form-group"><label class="col-sm-4 control-label">言語</label>
                          <div class="col-sm-4">
                            <div class="no-borders ver-mid btn-group btn-block">
                                <?php
                                    echo $this->Form->input("CanLanguage.edit-{$no}.foreign_language_id", array(
                                        'empty'    => '選択',
                                        'type'     => 'select',
                                        'options'  => $foreign_language,
                                        'class'    => 'form-control ForeinLang',
                                        'label'    => false,
                                        'div'      => false,
                                        'error'    => false,
                                        'required' => true,
                                        'value'    => $lang['foreign_language_id'],
                                    ));
                                ?>
                            </div>
                          </div>
                        </div>

                        <div class="form-group sl-language-hiden fr-hiden"><label class="col-sm-4 control-label">外国語</label>
                          <div class="col-sm-8">
                            <?php echo $this->Form->input("CanLanguage.edit-{$no}.foreign_language",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>$lang['foreign_language'],'required' => false,)); ?>
                          </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">レベル</label>
                          <div class="col-sm-4">
                            <div class="no-borders ver-mid btn-group btn-block">
                            <?php
                                echo $this->Form->input("CanLanguage.edit-{$no}.level_id", array(
                                    'empty'    => '選択',
                                    'type'     => 'select',
                                    'options'  => $lang_level,
                                    'class'    => 'form-control',
                                    'label'    => false,
                                    'div'      => false,
                                    'error'    => false,
                                    'required' => true,
                                    'value'    => $lang['level_id'],
                                ));
                            ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group"><label class="col-sm-4 control-label">海外在住年数</label>
                          <div class="col-sm-4">
                            <?php echo $this->Form->input("CanLanguage.edit-{$no}.oversea_life",array('class'=>'form-control','div'=>false,'type'=>'number','label'=>false, 'value'=>$lang['oversea_life'])); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php     endif; ?>
                  <?php     $no++; ?>
                  <?php   endforeach; ?>
                  <?php endif; ?>
                  </div>

                  <?php if(!empty($this->data['CanNotice'])):?>
                  <?php   $no = 0; ?>
                  <?php   foreach($this->data['CanNotice'] as $row => $note):?>
                  <?php     if($row === 'new'): continue; endif; ?>
                  <?php     echo $this->Form->hidden("CanNotice.edit-{$no}.id", array('value'=>$note['id']));?>
                  <?php     if(isset($note['delete']) && $note['delete'] == '1') : ;?>
                  <?php       echo $this->Form->hidden("CanNotice.edit-{$no}.delete", array('value'=>'1'));?>
                  <?php     else : ?>
                   <?php      echo $this->Form->hidden("CanNotice.edit-{$no}.delete", array('value'=>'0'));?>
                  <div class='ibox no-margin-bottom NoticeBlock'>
                    <div class="ibox-title">
                      <h5>特記事項</h5>
                      <div class="ibox-tools">
                        <a class="close-link">
                          <i class="fa fa-times"></i>
                        </a>
                      </div>
                    </div>
                    <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                      <div class="form-horizontal">
                        <div class="form-group"><label class="col-sm-4 control-label">コメント</label>
                          <div class="col-sm-8">
                            <?php 
                              echo $this->Form->textarea("CanNotice.edit-{$no}.notice",array(
                                  'rows'     => 5,
                                  'error'    => false,
                                  'required' => false,
                                  'label'    => false,
                                  'class'    => 'full-width form-control',
                                  'value'    => $note['notice'],
                              )); 
                            ?>
                          </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">コメンテーター</label>
                          <div class="col-sm-8">
                            <div class='pull-left m-r-10'>
                            <?php
                                echo $this->Form->input("CanNotice.edit-{$no}.register_type", array(
                                    'empty'    => '選択',
                                    'type'     => 'select',
                                    'options'  => $register_type,
                                    'class'    => 'form-control RegisterType',
                                    'label'    => false,
                                    'div'      => false,
                                    'error'    => false,
                                    'required' => true,
                                    'value'    => $note['register_type'],
                                ));
                            ?>
                            </div>
                            <div class="col-sm-4 RegisterSelect">
                            <?php
                                echo $this->Form->input("CanNotice.edit-{$no}.rec_recruiter_id", array(
                                    'empty'    => '選択',
                                    'type'     => 'select',
                                    'options'  => $recRecruiters,
                                    'class'    => 'form-control Recruiter',
                                    'label'    => false,
                                    'div'      => false,
                                    'error'    => false,
                                    'required' => false,
                                    'value'    => $note['rec_recruiter_id'],
                                    'style'    => 'display:none;',
                                ));
                            ?>
                            <?php
                                echo $this->Form->input("CanNotice.edit-{$no}.inf_staff_id", array(
                                    'empty'    => '選択',
                                    'type'     => 'select',
                                    'options'  => $infStaffs,
                                    'class'    => 'form-control Staff',
                                    'label'    => false,
                                    'div'      => false,
                                    'error'    => false,
                                    'required' => false,
                                    'value'    => $note['inf_staff_id'],
                                    'style'    => 'display:none;',
                                ));
                            ?>
                            </div>
                            <div class='clearfix'></div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                  <?php     endif; ?>
                  <?php     $no++; ?>
                  <?php   endforeach; ?>
                  <?php endif; ?>
                  <div id="NoticeInsertPoint"></div>

                  <div id="CustomInsertPoint">
                  <?php if(!empty($this->data['CanCustomAttribute'])):?>
                  <?php   $no = 0; ?>
                  <?php   foreach($this->data['CanCustomAttribute'] as $row => $custom):?>
                  <?php     if($row === 'new'): continue; endif; ?>
                  <?php     echo $this->Form->hidden("CanCustomAttribute.edit-{$no}.id", array('value'=>$custom['id']));?>
                  <?php     if(isset($custom['delete']) && $custom['delete'] == '1') : ;?>
                  <?php       echo $this->Form->hidden("CanCustomAttribute.edit-{$no}.delete", array('value'=>'1'));?>
                  <?php     else : ?>
                  <?php       echo $this->Form->hidden("CanCustomAttribute.edit-{$no}.delete", array('value'=>'0'));?>
                  <div class='ibox no-margin-bottom CustomBlock'>
                    <div class="ibox-title">
                      <h5>候補者カスタム属性</h5>
                      <div class="ibox-tools">
                        <a class="close-link">
                          <i class="fa fa-times"></i>
                        </a>
                      </div>
                    </div>
                    <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">


                   <div class="form-horizontal">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">カスタム項目</label>
                          <div class="col-sm-4">
                            <div class="no-borders ver-mid btn-group btn-block">
                              <?php
                                  echo $this->Form->input("CanCustomAttribute.edit-{$no}.can_custom_field_id", array(
                                      'type'     => 'select',
                                      'options'  => $canCustomFields,
                                      'class'    => 'form-control CustomField',
                                      'label'    => false,
                                      'div'      => false,
                                      'error'    => false,
                                      'required' => true,
                                      'value'    => $custom['can_custom_field_id'],
                                  ));
                              ?>
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="no-borders ver-mid btn-group btn-block">
                              <button type='button' data-toggle="modal" class="btn btn-primary Modal" href="#modal-form">
                                マスタ項目追加
                              </button>
                            </div>
                          </div>

                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">値</label>
                          <div class="col-sm-8">
                            <?php echo $this->Form->input("CanCustomAttribute.edit-{$no}.value",array('class'=>'form-control CustomFieldValue','div'=>false,'type'=>'text','label'=>false, 'value'=>$custom['value'],'required' => false,)); ?>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                  <?php     endif; ?>
                  <?php     $no++; ?>
                  <?php   endforeach; ?>
                  <?php endif; ?>
                  </div>

                  <div id="QualificationInsertPoint">
                  <?php if(!empty($this->data['CanQualification'])):?>
                  <?php   $no = 0; ?>
                  <?php   foreach($this->data['CanQualification'] as $row => $qual):?>
                  <?php     if($row === 'new'): continue; endif; ?>
                  <?php     echo $this->Form->hidden("CanQualification.edit-{$no}.id", array('value'=>$qual['id']));?>
                  <?php     if(isset($qual['delete']) && $qual['delete'] == '1') : ;?>
                  <?php       echo $this->Form->hidden("CanQualification.edit-{$no}.delete", array('value'=>'1'));?>
                  <?php     else : ?>
                  <?php       echo $this->Form->hidden("CanQualification.edit-{$no}.delete", array('value'=>'0'));?>
                  <div class='ibox no-margin-bottom QualificationBlock'>
                    <div class="ibox-title">
                      <h5>資格</h5>
                      <div class="ibox-tools">
                        <a class="close-link">
                          <i class="fa fa-times"></i>
                        </a>
                      </div>
                    </div>
                    <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                      <div class="form-horizontal">

                        <div class="form-group">
                          <label class="col-sm-4 control-label">資格</label>
                          <div class="col-sm-8">
                            <?php
                                echo $this->Form->input("CanQualification.edit-{$no}.qualification_id", array(
                                    'empty'    => '選択',
                                    'type'     => 'select',
                                    'options'  => $qualifications,
                                    'class'    => 'btn btn-white Qualification',
                                    'label'    => false,
                                    'div'      => false,
                                    'error'    => false,
                                    'required' => true,
                                    'value'    => $qual['qualification_id'],
                                ));
                            ?>
                          </div>
                        </div>

                        <div class="form-group sl-pro-hiden fr-hiden">
                          <label class="col-sm-4 control-label">資格</label>
                          <div class="col-sm-8">
                            <?php echo $this->Form->input("CanQualification.edit-{$no}.qualification",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>$qual['qualification'],'required' => false,)); ?>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">スコア</label>
                          <div class="col-sm-8">
                            <?php echo $this->Form->input("CanQualification.edit-{$no}.score",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>$qual['score'],'required' => false,)); ?>
                          </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">取得年月</label>
                          <div class="col-sm-8">
                            <div class='pull-left m-r-10'>
                              <?php
                                  if(!empty($qual['acquisition_date'])){
                                    $def['acquisition_date_y'] = date('Y', strtotime($qual['acquisition_date']));
                                  }else{
                                    $def['acquisition_date_y'] = $qual['acquisition_date_y'];
                                  }
                                  echo $this->Form->input("CanQualification.edit-{$no}.acquisition_date_y", array(
                                      'empty'    => '選択',
                                      'type'     => 'select',
                                      'options'  => $qualification_years,
                                      'class'    => 'btn btn-white',
                                      'label'    => false,
                                      'div'      => false,
                                      'error'    => false,
                                      'required' => true,
                                      'value'    => $def['acquisition_date_y'],
                                  ));
                              ?>
                            </div>
                            <div>
                            <?php
                                if(!empty($qual['acquisition_date'])){
                                  $def['acquisition_date_m'] = date('m', strtotime($qual['acquisition_date']));
                                }else{
                                  $def['acquisition_date_m'] = $qual['acquisition_date_m'];
                                }
                                echo $this->Form->input("CanQualification.edit-{$no}.acquisition_date_m", array(
                                    'empty'    => '選択',
                                    'type'     => 'select',
                                    'options'  => $month,
                                    'class'    => 'btn btn-white',
                                    'label'    => false,
                                    'div'      => false,
                                    'error'    => false,
                                    'required' => true,
                                    'value'    => $def['acquisition_date_m'],
                                ));
                            ?>
                            </div>
                            <div class='clearfix'></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php     endif; ?>
                  <?php     $no++; ?>
                  <?php   endforeach; ?>
                  <?php endif; ?>
                  </div>


                  <div id="EducationInsertPoint">
                  <?php if(!empty($this->data['CanEducation'])):?>
                  <?php   $no = 0; ?>
                  <?php   foreach($this->data['CanEducation'] as $row => $edu):?>
                  <?php     if($row === 'new'): continue; endif; ?>
                  <?php     echo $this->Form->hidden("CanEducation.edit-{$no}.id", array('value'=>$edu['id']));?>
                  <?php     if(isset($edu['delete']) && $edu['delete'] == '1') : ;?>
                  <?php       echo $this->Form->hidden("CanEducation.edit-{$no}.delete", array('value'=>'1'));?>
                  <?php     else : ?>
                  <?php       echo $this->Form->hidden("CanEducation.edit-{$no}.delete", array('value'=>'0'));?>
                  <div class='ibox no-margin-bottom EducationBlock'>
                    <div class="ibox-title">
                      <h5>学歴</h5>
                      <div class="ibox-tools">
                        <a class="close-link">
                          <i class="fa fa-times"></i>
                        </a>
                      </div>
                    </div>
                    <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                      <div class="form-horizontal">
                        <div class="form-group"><label class="col-sm-4 control-label">学校</label>
                          <div class="col-sm-8">
                            <div class="no-borders ver-mid btn-group pull-left m-r-10">
                            <?php
                                echo $this->Form->input("CanEducation.edit-{$no}.school_id", array(
                                    'empty'    => array('0'=>'選択'),
                                    'type'     => 'select',
                                    'options'  => $schools,
                                    'class'    => 'form-control School',
                                    'label'    => false,
                                    'div'      => false,
                                    'error'    => false,
                                    'required' => false,
                                    'value'    => $edu['school_id'],
                                ));
                            ?>
                            </div>
<!--
                            <button class='pull-left btn btn-primary m-r-10'>マスタ項目追加</button>
                            <button class='btn btn-primary'>マスタ項目変更</button>
                            <div class='clearfix'></div>
-->
                          </div>
                        </div>
                        <div class="form-group sl-school-hiden fr-hiden"><label class="col-sm-4 control-label">学校</label>
                          <div class="col-sm-8">
                            <?php echo $this->Form->input("CanEducation.edit-{$no}.school",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>$edu['school'],'required' => false,)); ?>
                          </div>
                        </div>

                        <div class="form-group"><label class="col-sm-4 control-label">学部</label>
                          <div class="col-sm-4">
                            <div class="no-borders ver-mid btn-group btn-block">
                            <?php
                                echo $this->Form->input("CanEducation.edit-{$no}.undergraduate_id", array(
                                    'empty'    => array('0'=>'選択'),
                                    'type'     => 'select',
                                    'options'  => $undergraduates,
                                    'class'    => 'form-control Undergraduates',
                                    'label'    => false,
                                    'div'      => false,
                                    'error'    => false,
                                    'required' => false,
                                    'value'    => $edu['undergraduate_id'],
                                ));
                            ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group sl-undergraduate-hiden fr-hiden"><label class="col-sm-4 control-label">学部</label>
                          <div class="col-sm-8">
                            <?php echo $this->Form->input("CanEducation.edit-{$no}.undergraduate",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>$edu['undergraduate'],'required' => false,)); ?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">学科名</label>
                          <div class="col-sm-8">
                            <?php echo $this->Form->input("CanEducation.edit-{$no}.department",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>$edu['department'],'required' => false,)); ?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">学生申請文理区分</label>
                          <div class="col-sm-4">
                            <div class="no-borders ver-mid btn-group btn-block">
                              <?php
                                  echo $this->Form->input("CanEducation.edit-{$no}.student_bunri_class_id", array(
                                      'empty'    => '選択',
                                      'type'     => 'select',
                                      'options'  => $bunri_class,
                                      'class'    => 'form-control',
                                      'label'    => false,
                                      'div'      => false,
                                      'error'    => false,
                                      'required' => true,
                                      'value'    => $edu['student_bunri_class_id'],
                                  ));
                              ?>
                              </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">管理用文理区分</label>
                          <div class="col-sm-4">
                            <div class="no-borders ver-mid btn-group btn-block">
                              <?php
                                  echo $this->Form->input("CanEducation.edit-{$no}.manage_bunri_class_id", array(
                                      'empty'    => '選択',
                                      'type'     => 'select',
                                      'options'  => $bunri_class,
                                      'class'    => 'form-control',
                                      'label'    => false,
                                      'div'      => false,
                                      'error'    => false,
                                      'required' => true,
                                      'value'    => $edu['manage_bunri_class_id'],
                                  ));
                              ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group"><label class="col-sm-4 control-label">ゼミ</label>
                          <div class="col-sm-8">
                            <?php echo $this->Form->input("CanEducation.edit-{$no}.seminar",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>$edu['seminar'],'required' => false,)); ?>
                          </div>
                         </div>
                        <div class="form-group"><label class="col-sm-4 control-label">専攻テーマ</label>
                          <div class="col-sm-8">
                            <?php echo $this->Form->input("CanEducation.edit-{$no}.major_theme",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>$edu['major_theme'],'required' => false,)); ?>
                          </div>
                         </div>
                        <div class="form-group"><label class="col-sm-4 control-label">サークル</label>
                          <div class="col-sm-8">
                            <?php echo $this->Form->input("CanEducation.edit-{$no}.circle",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>$edu['circle'],'required' => false,)); ?>
                          </div>
                         </div>
                        <div class="form-group data_1" id=""><label class="col-sm-4 control-label">入学年月</label>
                          <div class="col-sm-4">
                            <div class="input-group date">
                              <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </span>
                              <?php echo $this->Form->input("CanEducation.edit-{$no}.admission_date",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>$edu['admission_date'],'required' => false,)); ?>
                            </div>
                          </div>
                        </div>

                        <div class="form-group data_1" id=""><label class="col-sm-4 control-label">卒業(予定)年月</label>
                          <div class="col-sm-4">
                            <div class="input-group date">
                              <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </span>
                              <?php echo $this->Form->input("CanEducation.edit-{$no}.graduation_date",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>$edu['graduation_date'],'required' => false,)); ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php     endif; ?>
                  <?php     $no++; ?>
                  <?php   endforeach; ?>
                  <?php endif; ?>
                  </div>

                </div>


                <div class="row ibox-content clearfix bg-sl-btn pd-9">
                  <table class="table no-margin-bottom">
                    <tbody class='pull-right'>
                      <tr>
                        <td class="no-borders ver-mid btn-group btn-block">
                          <select class="form-control" id="AddContentsType">
                            <!--<option value="">提出書類</option>-->
                            <option value="Language">語学</option>
                            <option value="Notice">特記事項</option>
                            <option value="Custom">候補者カスタム属性</option>
                            <option value="Qualification">資格</option>
                            <option value="Education">学歴</option>
                          </select>
                        </td>
                        <td class="no-borders ver-mid">
                          <button type="button" class="w-75 btn btn-primary btn-sm" id="AddContents">追加</button>
                        </td>
                        <div class='clearfix'></div>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class='button_cen element-detail-box btn-clear'>
                  <!--<button class='w-75 btn btn-default btn-sm'>削除</button>-->
                  <button class='btn btn-primary'>更新</button>
                </div>
              </div>
              <!-- tab container 1 -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<div id="modal-form" class="modal fade" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="ibox-title">
          <h5>カスタム項目追加</h5>
        </div>
        <div class='ibox-content bg-white p-sm'>
          <div class="row">
            <div class="col-sm-12 b-r">
              <div class="table-responsive enj_res">
                <h4>カスタム項目</h4>
                <table class="table table-center table-bordered">
                  <tbody>
                    <tr>
                      <th class='bg-thead ver-mid'>
                        <label>カスタム項目名</label>
                      </th>
                      <td>
                        <input class='form-control' value='' id="CustomFieldName">
                      </td>
                    </tr>
                    <tr>
                      <th class='bg-thead ver-mid'>
                        <label>タイプ</label>
                      </th>
                      <td>
                        <?php
                            echo $this->Form->input("", array(
                                'name'     => '',
                                'empty'    => '選択',
                                'type'     => 'select',
                                'options'  => $custom_type,
                                'class'    => 'btn btn-white',
                                'label'    => false,
                                'div'      => false,
                                'error'    => false,
                                'required' => true,
                                'id'       => 'CustomFieldType',
                            ));
                        ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class='button_cen element-detail-box '>
                  <button type="button" class="btn btn-white" data-dismiss="modal">閉じる</button>
                  <button type="button" class="w-75 btn btn-primary btn-sm" id="AddCustomField">追加</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script id="DocumentTmpl" type="text/x-jquery-tmpl">
<div class="col-sm-8">
  <div class="form-control border-none">
    <a class="text-navy remove-file">${file_name}　<i class="fa fa-times-circle"></i></a>
  </div>
</div>
</script>
<script id="DocumentInputTmpl" type="text/x-jquery-tmpl">
<div class="form-horizontal">
  <div class="form-group">
    <label class="col-sm-4 control-label">ファイル</label>
    <div class="col-sm-8">
      <span class="fileUpload btn btn-primary pull-left">
        <span>ファイル選択</span>
        <input type="file" class="upload" name="data[CanDocument][new][file][]">
      </span>
    </div>
  </div>
</div>
</script>

<script id="LanguageTmpl" type="text/x-jquery-tmpl">
<div class='ibox no-margin-bottom LanguageBlock'>
  <div class="ibox-title">
    <h5>語学</h5>
    <div class="ibox-tools">
      <a class="close-link">
        <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
    <div class="form-horizontal">
      <div class="form-group"><label class="col-sm-4 control-label">言語</label>
        <div class="col-sm-4">
          <div class="no-borders ver-mid btn-group btn-block">
              <?php
                  echo $this->Form->input("CanLanguage.new.foreign_language_id.", array(
                      'empty'    => '選択',
                      'type'     => 'select',
                      'options'  => $foreign_language,
                      'class'    => 'form-control ForeinLang',
                      'label'    => false,
                      'div'      => false,
                      'error'    => false,
                      'required' => true,
                      'value'    => '',
                  ));
              ?>
          </div>
        </div>
      </div>

      <div class="form-group sl-language-hiden fr-hiden"><label class="col-sm-4 control-label">外国語</label>
        <div class="col-sm-8">
          <?php echo $this->Form->input("CanLanguage.new.foreign_language.",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>'','required' => false)); ?>
        </div>
      </div>

      <div class="form-group"><label class="col-sm-4 control-label">レベル</label>
        <div class="col-sm-4">
          <div class="no-borders ver-mid btn-group btn-block">
          <?php
              echo $this->Form->input("CanLanguage.new.level_id.", array(
                  'empty'    => '選択',
                  'type'     => 'select',
                  'options'  => $lang_level,
                  'class'    => 'form-control',
                  'label'    => false,
                  'div'      => false,
                  'error'    => false,
                  'required' => true,
                  'value'    => '',
              ));
          ?>
          </div>
        </div>
      </div>
      <div class="form-group"><label class="col-sm-4 control-label">海外在住年数</label>
        <div class="col-sm-4">
          <?php echo $this->Form->input("CanLanguage.new.oversea_life.",array('class'=>'form-control','div'=>false,'type'=>'number','label'=>false, 'value'=>'')); ?>
        </div>
      </div>
    </div>
  </div>
</div>
</script>

<script id="NoticeTmpl" type="text/x-jquery-tmpl">
<div class='ibox no-margin-bottom NoticeBlock'>
  <div class="ibox-title">
    <h5>特記事項</h5>
    <div class="ibox-tools">
      <a class="close-link">
        <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
    <div class="form-horizontal">
      <div class="form-group"><label class="col-sm-4 control-label">コメント</label>
        <div class="col-sm-8">
          <?php 
            echo $this->Form->textarea("CanNotice.new.notice.",array(
                'rows'     => 5,
                'error'    => false,
                'required' => false,
                'label'    => false,
                'class'    => 'full-width form-control',
                'value'    => '',
            )); 
          ?>
        </div>
      </div>

      <div class="form-group"><label class="col-sm-4 control-label">コメンテーター</label>
        <div class="col-sm-8">
          <div class='pull-left m-r-10'>
          <?php
              echo $this->Form->input("CanNotice.new.register_type.", array(
                  'empty'    => '選択',
                  'type'     => 'select',
                  'options'  => $register_type,
                  'class'    => 'form-control RegisterType',
                  'label'    => false,
                  'div'      => false,
                  'error'    => false,
                  'required' => true,
                  'value'    => '',
              ));
          ?>
          </div>
          <div class="col-sm-4 RegisterSelect">
          <?php
              echo $this->Form->input("CanNotice.new.rec_recruiter_id.", array(
                  'empty'    => '選択',
                  'type'     => 'select',
                  'options'  => $recRecruiters,
                  'class'    => 'form-control Recruiter',
                  'label'    => false,
                  'div'      => false,
                  'error'    => false,
                  'required' => false,
                  'value'    => '',
                  'style'    => 'display:none;',
              ));
          ?>
          <?php
              echo $this->Form->input("CanNotice.new.inf_staff_id.", array(
                  'empty'    => '選択',
                  'type'     => 'select',
                  'options'  => $infStaffs,
                  'class'    => 'form-control Staff',
                  'label'    => false,
                  'div'      => false,
                  'error'    => false,
                  'required' => false,
                  'value'    => '',
                  'style'    => 'display:none;',
              ));
          ?>
          </div>
          <div class='clearfix'></div>
        </div>
      </div>

    </div>
  </div>
</div>
</script>
<script id="CustomTmpl" type="text/x-jquery-tmpl">
<div class='ibox no-margin-bottom CustomBlock'>
  <div class="ibox-title">
    <h5>候補者カスタム属性</h5>
    <div class="ibox-tools">
      <a class="close-link">
        <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">


 <div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-4 control-label">カスタム項目</label>
        <div class="col-sm-4">
          <div class="no-borders ver-mid btn-group btn-block">
            <?php
                echo $this->Form->input("CanCustomAttribute.new.can_custom_field_id.", array(
                    'type'     => 'select',
                    'options'  => $canCustomFields,
                    'class'    => 'form-control CustomField',
                    'label'    => false,
                    'div'      => false,
                    'error'    => false,
                    'required' => true,
                    'value'    => '',
                ));
            ?>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="no-borders ver-mid btn-group btn-block">
            <button type='button' data-toggle="modal" class="btn btn-primary Modal" href="#modal-form">
              マスタ項目追加
            </button>
          </div>
        </div>

      </div>

      <div class="form-group"><label class="col-sm-4 control-label">値</label>
        <div class="col-sm-8">
          <?php echo $this->Form->input("CanCustomAttribute.new.value.",array('class'=>'form-control CustomFieldValue','div'=>false,'type'=>'text','label'=>false, 'value'=>'','required' => false)); ?>
        </div>
      </div>

    </div>
  </div>
</div>
</script>
<script id="QualificationTmpl" type="text/x-jquery-tmpl">
<div class='ibox no-margin-bottom QualificationBlock'>
  <div class="ibox-title">
    <h5>資格</h5>
    <div class="ibox-tools">
      <a class="close-link">
        <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
    <div class="form-horizontal">

      <div class="form-group">
        <label class="col-sm-4 control-label">資格</label>
        <div class="col-sm-8">
          <?php
              echo $this->Form->input("CanQualification.new.qualification_id.", array(
                  'empty'    => '選択',
                  'type'     => 'select',
                  'options'  => $qualifications,
                  'class'    => 'btn btn-white Qualification',
                  'label'    => false,
                  'div'      => false,
                  'error'    => false,
                  'required' => true,
                  'value'    => '',
              ));
          ?>
        </div>
      </div>

      <div class="form-group sl-pro-hiden fr-hiden">
        <label class="col-sm-4 control-label">資格</label>
        <div class="col-sm-8">
          <?php echo $this->Form->input("CanQualification.new.qualification.",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>'','required' => false)); ?>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4 control-label">スコア</label>
        <div class="col-sm-8">
          <?php echo $this->Form->input("CanQualification.new.score.",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>'','required' => false)); ?>
        </div>
      </div>

      <div class="form-group"><label class="col-sm-4 control-label">取得年月</label>
        <div class="col-sm-8">
          <div class='pull-left m-r-10'>
            <?php
                echo $this->Form->input("CanQualification.new.acquisition_date_y.", array(
                    'empty'    => '選択',
                    'type'     => 'select',
                    'options'  => $qualification_years,
                    'class'    => 'btn btn-white',
                    'label'    => false,
                    'div'      => false,
                    'error'    => false,
                    'required' => true,
                    'value'    => '',
                ));
            ?>
          </div>
          <div>
          <?php
              echo $this->Form->input("CanQualification.new.acquisition_date_m.", array(
                  'empty'    => '選択',
                  'type'     => 'select',
                  'options'  => $month,
                  'class'    => 'btn btn-white',
                  'label'    => false,
                  'div'      => false,
                  'error'    => false,
                  'required' => true,
                  'value'    => '',
              ));
          ?>
          </div>
          <div class='clearfix'></div>
        </div>
      </div>
    </div>
  </div>
</div>
</script>
<script id="EducationTmpl" type="text/x-jquery-tmpl">
<div class='ibox no-margin-bottom EducationBlock'>
  <div class="ibox-title">
    <h5>学歴</h5>
    <div class="ibox-tools">
      <a class="close-link">
        <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
    <div class="form-horizontal">
      <div class="form-group"><label class="col-sm-4 control-label">学校</label>
        <div class="col-sm-8">
          <div class="no-borders ver-mid btn-group pull-left m-r-10">
          <?php
              echo $this->Form->input("CanEducation.new.school_id.", array(
                  'empty'    => array('0'=>'選択'),
                  'type'     => 'select',
                  'options'  => $schools,
                  'class'    => 'form-control School',
                  'label'    => false,
                  'div'      => false,
                  'error'    => false,
                  'required' => false,
                  'value'    => '',
              ));
          ?>
          </div>
<!--
          <button class='pull-left btn btn-primary m-r-10'>マスタ項目追加</button>
          <button class='btn btn-primary'>マスタ項目変更</button>
          <div class='clearfix'></div>
-->
        </div>
      </div>
      <div class="form-group sl-school-hiden"><label class="col-sm-4 control-label">学校</label>
        <div class="col-sm-8">
          <?php echo $this->Form->input("CanEducation.new.school.",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>'','required' => false)); ?>
        </div>
      </div>

      <div class="form-group"><label class="col-sm-4 control-label">学部</label>
        <div class="col-sm-4">
          <div class="no-borders ver-mid btn-group btn-block">
          <?php
              echo $this->Form->input("CanEducation.new.undergraduate_id.", array(
                  'empty'    => array('0'=>'選択'),
                  'type'     => 'select',
                  'options'  => $undergraduates,
                  'class'    => 'form-control Undergraduates',
                  'label'    => false,
                  'div'      => false,
                  'error'    => false,
                  'required' => false,
                  'value'    => '',
              ));
          ?>
          </div>
        </div>
      </div>
      <div class="form-group sl-undergraduate-hiden"><label class="col-sm-4 control-label">学部</label>
        <div class="col-sm-8">
          <?php echo $this->Form->input("CanEducation.new.undergraduate.",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>'','required' => false)); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">学科名</label>
        <div class="col-sm-8">
          <?php echo $this->Form->input("CanEducation.new.department.",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>'','required' => false)); ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">学生申請文理区分</label>
        <div class="col-sm-4">
          <div class="no-borders ver-mid btn-group btn-block">
            <?php
                echo $this->Form->input("CanEducation.new.student_bunri_class_id.", array(
                    'empty'    => '選択',
                    'type'     => 'select',
                    'options'  => $bunri_class,
                    'class'    => 'form-control',
                    'label'    => false,
                    'div'      => false,
                    'error'    => false,
                    'required' => true,
                    'value'    => '',
                ));
            ?>
            </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">管理用文理区分</label>
        <div class="col-sm-4">
          <div class="no-borders ver-mid btn-group btn-block">
            <?php
                echo $this->Form->input("CanEducation.new.manage_bunri_class_id.", array(
                    'empty'    => '選択',
                    'type'     => 'select',
                    'options'  => $bunri_class,
                    'class'    => 'form-control',
                    'label'    => false,
                    'div'      => false,
                    'error'    => false,
                    'required' => true,
                    'value'    => '',
                ));
            ?>
          </div>
        </div>
      </div>
      <div class="form-group"><label class="col-sm-4 control-label">ゼミ</label>
        <div class="col-sm-8">
          <?php echo $this->Form->input("CanEducation.new.seminar.",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>'','required' => false)); ?>
        </div>
       </div>
      <div class="form-group"><label class="col-sm-4 control-label">専攻テーマ</label>
        <div class="col-sm-8">
          <?php echo $this->Form->input("CanEducation.new.major_theme.",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>'','required' => false)); ?>
        </div>
       </div>
      <div class="form-group"><label class="col-sm-4 control-label">サークル</label>
        <div class="col-sm-8">
          <?php echo $this->Form->input("CanEducation.new.circle.",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>'','required' => false)); ?>
        </div>
       </div>
      <div class="form-group data_1" id=""><label class="col-sm-4 control-label">入学年月</label>
        <div class="col-sm-4">
          <div class="input-group date">
            <span class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </span>
            <?php echo $this->Form->input("CanEducation.new.admission_date.",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>'','required' => false)); ?>
          </div>
        </div>
      </div>

      <div class="form-group data_1" id=""><label class="col-sm-4 control-label">卒業(予定)年月</label>
        <div class="col-sm-4">
          <div class="input-group date">
            <span class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </span>
            <?php echo $this->Form->input("CanEducation.new.graduation_date.",array('class'=>'form-control','div'=>false,'type'=>'text','label'=>false, 'value'=>'','required' => false)); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</script>


<script>
$(function(){

  /* Toggle language input */
  $(document).on('change','.ForeinLang',function(){
    var target = $(this).parents('div.form-horizontal').find('.sl-language-hiden');
    if($(this).val() == '99'){
        target.removeClass("fr-hiden");
    }else{
        target.addClass("fr-hiden");
    }
  });
  $('.ForeinLang').trigger('change');

  /* Toggle language input */
  $(document).on('change','.CustomField',function(){
    var _url = '<?php echo $this->webroot;?>CanCandidates/CheckCustomFieldType/' + $(this).val();
    var _target = $(this).parents('div.form-horizontal').find('.CustomFieldValue');
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _url,
        success: function(res){
          if(res.status) {
              if(res.data == '0'){
                _target.get(0).type = 'text';
              }
              if(res.data == '1'){
                _target.get(0).type = 'number';
              }
          }
        }
    });
  });
  $('.CustomField').trigger('change');

  /* Toggle register select */
  $(document).on('change','.RegisterType',function(){
      var target = $(this).parents('div.form-horizontal').find('.RegisterSelect');
      var rec = target.find('.Recruiter');
      var inf = target.find('.Staff');

      if($(this).val() == '0'){
        rec.show();
        inf.hide();
      }else{
        rec.hide();
        inf.show();
      }
  });
  $('.RegisterType').trigger('change');

  /* Toggle quali input */
  $(document).on('change','.Qualification',function(){
      var target = $(this).parents('div.form-horizontal').find('.sl-pro-hiden');
      if($(this).val() == '99'){
        target.removeClass("fr-hiden");
      }else{
        target.addClass("fr-hiden");
      }
  });
  $('.Qualification').trigger('change');

  /* Toggle quali input */
  var CurrentCustomField;
  $(document).on('click','.Modal',function(){
    $('#modal-form').find(':input').val('');
    CurrentCustomField = $(this).parents('div.form-horizontal').find('.CustomField');
  });

  /* Add CustomField */
  $('#AddCustomField').click(function(){
    if($('#CustomFieldName').val() == ''){
      alert('カスタム項目名を入力してください。');
      $('#CustomFieldName').focus();
      return;
    }
    if($('#CustomFieldType').val() == ''){
      alert('タイプを選択してください。');
      $('#CustomFieldType').focus();
      return;
    }
    var _url = '<?php echo $this->webroot;?>CanCandidates/AddCustomField/';
    $.ajax({
      type: "POST",
      dataType: "JSON",
      url: _url,
      data : {
        'field_name' : $('#CustomFieldName').val(),
        'type' : $('#CustomFieldType').val()
      },
      success: function(res){
        if(res.status) {
          $('.CustomField').each(function(){
            $(this).append($("<option>").val(res.data['id']).text(res.data['field_name']));
          });
          CurrentCustomField.val(res.data['id']).trigger('change');
          $('#modal-form').modal('hide');
          CurrentCustomField.focus();
        }else{
          alert('登録に失敗しました。');
        }
      }
    });
  });

  /* Toggle school input */
  $(document).on('change','.School',function(){
    var target = $(this).parents('div.form-horizontal').find('.sl-school-hiden');
    if($(this).val() == '0'){
        target.removeClass("fr-hiden");
    }else{
        target.addClass("fr-hiden");
    }
  });
  $('.School').trigger('change');

  /* Toggle Undergraduates input */
  $(document).on('change','.Undergraduates',function(){
    var target = $(this).parents('div.form-horizontal').find('.sl-undergraduate-hiden');
    if($(this).val() == '0'){
        target.removeClass("fr-hiden");
    }else{
        target.addClass("fr-hiden");
    }
  });
  $('.Undergraduates').trigger('change');

  // Close ibox function
  $('.close-link').unbind('click');
  $(document).on('click','.close-link',function(){
      var content = $(this).closest('div.ibox');
      content.prev(':hidden').each(function(){
        console.log($(this).attr('name'));
      });
      content.prev(':hidden[name$="\\[delete\\]"]').val('1');
      content.remove();
  });

  /* Add contents function */
  $('#AddContents').click(function(){
    var kind = $('#AddContentsType').val();
    var current = $('.' + kind + 'Block');
    var appendTo = $('#' + kind + 'InsertPoint');
    var template = $('#' + kind + 'Tmpl');
    var current = template.tmpl().appendTo(appendTo);

    if(kind == 'Education'){
      current.find('.data_1 .input-group.date').datepicker({
          todayBtn: "linked",
          keyboardNavigation: false,
          forceParse: false,
          calendarWeeks: true,
          autoclose: true,
          format: 'yyyy/mm/dd',
      });
    }
    var position = current.offset().top;
    $("html,body").animate({
      scrollTop : position
      }, {queue : false}
    );
  });

  $(document).on('change','.upload',function(){
    var filename = this.value;
    var lastIndex = filename.lastIndexOf("\\");
    if (lastIndex >= 0) {
      filename = filename.substring(lastIndex + 1);
    }
    var parents_div = $(this).parents('div.form-horizontal');
    parents_div.find('div.col-sm-8').hide();
    var target = parents_div.find('div.form-group');
    // view file name
    $('#DocumentTmpl').tmpl({file_name:filename}).appendTo(target);
    // add input type:file
    $('#DocumentInputTmpl').tmpl().appendTo($('#DocumentBlock'));
  });

  $(document).on('click','.remove-file',function(){
    var parents_div = $(this).parents('div.form-horizontal').remove();
  });

});
</script>