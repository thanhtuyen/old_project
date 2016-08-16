<?php echo $this->element('back_nav', array('text' => __('候補者情報｜%d %s', h($canCandidate['CanCandidate']['id']), h($canCandidate['CanCandidate']['name']))))?>
      
    <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
        <div class="content">

          <div class="plist-two-layout">

            <div class="col-lg-8">
              <div class='ibox'>
                <div class="ibox-title">
                  <h5>候補者情報</h5>
                  <div class="ibox-tools">
                  <a class="btn btn-primary btn-xs" href="../edit/<?php echo h($canCandidate['CanCandidate']['id']);?>">編集</a>
                  </div>
                </div>
                <div class='ibox-content bg-white p-sm'>
                  <div class="">
                    <div class="tabs-container">
                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1">基本データ</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2">付随データ</a></li>
                      </ul>
                      <div class="tab-content">
                        <div id="tab-2" class="tab-pane">
                          <div class="panel-body form-info">
                            <div class="ibox-title">
                              <h5>提出書類1</h5>
                            </div>
                            <div class="ibox-content bg-white p-sm pd-right-none">
                                <?php if(!empty($canCandidate['CanDocument'])):?>
                                <?php   foreach($canCandidate['CanDocument'] as $row => $doc):?>
                                <form method="get" class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-4 control-label">ファイル</label>
                                        <div class="col-sm-8">
                                            <div class="form-control border-none">
                                              <?php 
                                                $url = '../../CanDocuments/download/' . $canCandidate['CanCandidate']['id'] . '/' . $doc['id'];
                                              ?>
                                              <a class='text-navy' target="_blank" href="<?php echo $url;?>"><?php echo h($doc['file_name'] . '.' . $doc['extension']); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php   endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <div class="ibox-title">
                              <h5>語学</h5>
                            </div>
                            <div class="ibox-content bg-white p-sm pd-right-none">
                                <?php if(!empty($canCandidate['CanLanguage'])):?>
                                <?php   foreach($canCandidate['CanLanguage'] as $row => $lang):?>
                                <form method="get" class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-4 control-label">言語</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">
                                          <?php echo ($lang['foreign_language_id'] == '99')? h($lang['foreign_language']): h($this->enjin->getAddForeignLanguageName($lang['foreign_language_id'])); ?>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-4 control-label">レベル</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none"><?php echo h($this->enjin->getAddLevelName($lang['level_id']));?></div>
                                      </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-4 control-label">海外在住年数</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none"><?php echo h($lang['oversea_life']); ?>年</div>
                                      </div>
                                    </div>
                                </form>
                                <?php   endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <div class="ibox-title">
                              <h5>特記事項</h5>
                            </div>
                            <div class="ibox-content bg-white p-sm pd-right-none">
                                <?php if(!empty($canCandidate['CanNotice'])):?>
                                <?php   foreach($canCandidate['CanNotice'] as $row => $note):?>
                                <form method="get" class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-4 control-label">コメント</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none h-auto"><?php echo h($note['notice']); ?></div>
                                      </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-4 control-label">コメンテーター</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">
                                        <?php if($note['register_type'] == 0 && isset($RecRecruiter[$note['rec_recruiter_id']])):?>
                                          <?php echo $this->Html->link($RecRecruiter[$note['rec_recruiter_id']], array('controller'=>'RecRecruiters','action'=>'view',$note['rec_recruiter_id'])); ?>
                                        <?php endif;?>
                                        <?php if($note['register_type'] == 1 && isset($InfStaff[$note['inf_staff_id']])):?>
                                          <?php echo $this->Html->link($InfStaff[$note['inf_staff_id']], array('controller'=>'RecRecruiters','action'=>'view',$note['rec_recruiter_id'])); ?>
                                        <?php endif;?>
                                        </div>
                                      </div>
                                    </div>
                                </form>
                                <?php   endforeach; ?>
                                <?php endif; ?>
                            </div>


                            <div class="ibox-title">
                              <h5>候補者カスタム属性</h5>
                            </div>
                            <div class="ibox-content bg-white p-sm pd-right-none">
                                <?php if(!empty($canCandidate['CanCustomAttribute'])):?>
                                <?php   foreach($canCandidate['CanCustomAttribute'] as $row => $custom):?>
                                <form method="get" class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-4 control-label"><?php echo h($canCustomFields[$custom['can_custom_field_id']]);?></label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none"><?php echo h($custom['value']); ?></div>
                                      </div>
                                    </div>
                                </form>
                                <?php   endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <div class="ibox-title">
                                <h5>資格</h5>
                            </div>
                            <div class="ibox-content bg-white p-sm pd-right-none">
                                <?php if(!empty($canCandidate['CanQualification'])):?>
                                <?php   foreach($canCandidate['CanQualification'] as $row => $qual):?>
                                <form method="get" class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-4 control-label">資格</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">
                                            <?php if(is_null($qual['qualification_id'])):?>
                                                <?php echo $qual['qualification'];?>
                                            <?php else: ?>
                                                <?php echo $this->enjin->getQualificationsName($qual['qualification_id']);?>
                                            <?php endif;?>
                                        </div>
                                      </div>
                                    </div>
                                    <?php if(!empty($qual['score'])): ?>
                                    <div class="form-group"><label class="col-sm-4 control-label">スコア</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none"><?php echo $qual['score'];?></div>
                                      </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-group"><label class="col-sm-4 control-label">取得年月</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none"><?php echo !empty($qual['acquisition_date'])? h($this->enjin->getDateYm($qual['acquisition_date'])): ''; ?></div>
                                      </div>
                                    </div>
                                </form>
                                <?php   endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <div class="ibox-title">
                              <h5>学歴</h5>
                            </div>

                            <?php if(!empty($canCandidate['CanEducation'])):?>
                            <?php   foreach($canCandidate['CanEducation'] as $row => $edu):?>
                             <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                              <form method="get" class="form-horizontal">
                                <div class="form-group"><label class="col-sm-4 control-label">学校</label>
                                  <div class="col-sm-8">
                                    <div class="form-control border-none">
                                    <?php if(!empty($edu['school_id']) && !empty($schools[$edu['school_id']])):?>
                                      <?php echo h($schools[$edu['school_id']]);?>
                                    <?php else: ?>
                                      <?php echo h($edu['school']);?>
                                    <?php endif;?>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">学部</label>
                                  <div class="col-sm-8">
                                    <div class="form-control border-none">
                                    <?php if(!empty($edu['undergraduate_id']) && !empty($undergraduates[$edu['undergraduate_id']])):?>
                                      <?php echo h($undergraduates[$edu['undergraduate_id']]);?>
                                    <?php else: ?>
                                      <?php echo h($edu['undergraduate']);?>
                                    <?php endif;?>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">学科名</label>
                                  <div class="col-sm-8">
                                    <div class="form-control border-none"><?php echo h($edu['department']);?></div>
                                  </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">学生申請文理区分</label>
                                  <div class="col-sm-8">
                                    <div class="form-control border-none"><?php echo h($this->enjin->getBunriClassName($edu['student_bunri_class_id'])); ?></div>
                                  </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">管理用文理区分</label>
                                  <div class="col-sm-8">
                                    <div class="form-control border-none"><?php echo h($this->enjin->getBunriClassName($edu['manage_bunri_class_id'])); ?></div>
                                  </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">ゼミ</label>
                                  <div class="col-sm-8">
                                    <div class="form-control border-none"><?php echo h($edu['seminar']);?></div>
                                  </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">専攻テーマ</label>
                                  <div class="col-sm-8">
                                    <div class="form-control border-none"><?php echo h($edu['major_theme']);?></div>
                                  </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">サークル</label>
                                  <div class="col-sm-8">
                                    <div class="form-control border-none"><?php echo h($edu['circle']);?></div>
                                  </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">入学年月</label>
                                  <div class="col-sm-8">
                                    <div class="form-control border-none"><?php echo !empty($edu['admission_date'])? h($this->enjin->getDateYm($edu['admission_date'] . ' ')): ''; ?></div>
                                  </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">卒業(予定)年月</label>
                                  <div class="col-sm-8">
                                    <div class="form-control border-none"><?php echo !empty($edu['graduation_date'])? h($this->enjin->getDateYm($edu['graduation_date'] . ' ')): ''; ?></div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <?php   endforeach; ?>
                            <?php endif; ?>

                          </div>
                        </div>
                        <div id="tab-1" class="tab-pane active">
                          <div class="panel-body form-edit p-sm">


                            <div class='ibox no-margin-bottom'>
                              <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                                <form method="get" class="form-horizontal">
                                  <div class="form-group">
                                    <label class="col-sm-4 control-label">氏名</label>
                                    <div class="text">
                                      <span><?php echo h($canCandidate['CanCandidate']['last_name']); ?><?php echo !empty($canCandidate['CanCandidate']['mid_name'])? h(' ' . $canCandidate['CanCandidate']['mid_name']):''; ?> <?php echo h($canCandidate['CanCandidate']['first_name']); ?></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-4 control-label">name</label>
                                    <div class="text">
                                      <span><?php echo h($canCandidate['CanCandidate']['first_name_en']); ?><?php echo !empty($canCandidate['CanCandidate']['mid_name_en'])? h(' ' . $canCandidate['CanCandidate']['mid_name_en']):''; ?> <?php echo h($canCandidate['CanCandidate']['last_name_en']); ?></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-4 control-label">フリガナ</label>
                                    <div class="text">
                                      <span><?php echo h($canCandidate['CanCandidate']['last_name_kana']); ?> <?php echo h($canCandidate['CanCandidate']['first_name_kana']); ?></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-4 control-label">顔写真URL</label>
                                    <div class="col-sm-8 text">
                                      <?php if(!empty($canCandidate['CanCandidate']['face_photo'])):?>
                                      	<?php echo $this->Html->image($canCandidate['CanCandidate']['face_photo'], array("alt" => "face_photo",)); ?><br />
                                        <a href="<?php echo h($canCandidate['CanCandidate']['face_photo']); ?>" class="text-navy"><?php echo h($canCandidate['CanCandidate']['face_photo']); ?></a>
                                      <?php endif; ?>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">メールアドレス</label>
                                      <div class="text">
                                        <span class="text-navy"><?php echo h($canCandidate['CanCandidate']['mail_address']); ?></span>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">電話番号</label>
                                      <div class="text">
                                        <span><?php echo h($canCandidate['CanCandidate']['tel']); ?></span>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">携帯電話番号</label>
                                      <div class="text">
                                        <span><?php echo h($canCandidate['CanCandidate']['cell_number']); ?></span>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">携帯メールアドレス</label>
                                      <div class="text">
                                        <span class="text-navy"><?php echo h($canCandidate['CanCandidate']['cell_mail']); ?></span>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">居住国</label>
                                      <div class="text">
                                        <span><?php echo $canCandidate['Country']['name']; ?></span>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">郵便番号</label>
                                      <div class="text">
                                        <span><?php echo h($canCandidate['CanCandidate']['post_code']); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">都道府県</label>
                                      <div class="text">
                                        <span><?php echo $canCandidate['Prefecture']['name']; ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">居住地</label>
                                      <div class="text">
                                        <span><?php echo h($canCandidate['CanCandidate']['residence']); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">帰省先国</label>
                                      <div class="text">
                                        <span><?php echo !empty($canCandidate['CanCandidate']['home_country_id'])? $Country[$canCandidate['CanCandidate']['home_country_id']]: ''; ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">帰省先郵便番号</label>
                                      <div class="text">
                                        <span><?php echo h($canCandidate['CanCandidate']['home_post_code']); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">帰省先都道府県</label>
                                      <div class="text">
                                        <span><?php echo !empty($canCandidate['CanCandidate']['home_prefecture_id'])? $Prefecture[$canCandidate['CanCandidate']['home_prefecture_id']] : ''; ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">帰省先居住地</label>
                                      <div class="text">
                                        <span><?php echo h($canCandidate['CanCandidate']['home_residence']); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">帰省先電話番号</label>
                                      <div class="text">
                                        <span><?php echo h($canCandidate['CanCandidate']['home_tel']); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">生年月日</label>
                                      <div class="text">
                                        <span><?php echo !empty($canCandidate['CanCandidate']['birthday'])? h($this->enjin->getDate($canCandidate['CanCandidate']['birthday'] . ' ')): ''; ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">性別</label>
                                      <div class="text">
                                        <span><?php echo h($this->enjin->getSexName($canCandidate['CanCandidate']['sex'])); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">所属グループ</label>
                                      <div class="text">
                                        <span><?php echo h($canCandidate['CanCandidate']['membership']); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">流入元企業ID</label>
                                      <div class="text">
                                        <span><?php echo h($canCandidate['RefererCompany']['id']); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">流入元契約ID</label>
                                      <div class="text">
                                        <span><?php echo h($canCandidate['InfContract']['id']); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">入社可能年月</label>
                                      <div class="text">
                                        <span><?php echo !empty($canCandidate['CanCandidate']['join_possible_date'])? h($this->enjin->getDateYm($canCandidate['CanCandidate']['join_possible_date'])): ''; ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">マイナビID</label>
                                      <div class="text">
                                        <span><?php echo h($canCandidate['CanCandidate']['mynavi_id']); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">リクナビID</label>
                                      <div class="text">
                                        <span><?php echo h($canCandidate['CanCandidate']['rikunavi_id']); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">学生登録日時</label>
                                      <div class="text">
                                        <span><?php echo h($this->enjin->getDateTime($canCandidate['CanCandidate']['created'])); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">学生更新日時</label>
                                      <div class="text">
                                        <span><?php echo h($this->enjin->getDateTime($canCandidate['CanCandidate']['modified'])); ?></span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">最終ログイン日</label>
                                      <div class="text">
                                        <span><?php echo !empty($canCandidate['CanCandidate']['last_login_date'])? h($this->enjin->getDate($canCandidate['CanCandidate']['last_login_date'] . ' ')): ''; ?></span>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--<div class=""></div>-->
              </div>
              <!--layout right-->
              <div class="col-lg-4">
                <div class="ibox">
                  <div class="ibox-title">
                    <h5>選考履歴</h5>
                    <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                    </div>
                  </div>
                  <div class="ibox-content clearfix p-sm pd-bottom-none" id="SelHistoryBox">
                    <?php if(!empty($canCandidate['CanSelJob'])):?>
                    <?php   foreach($canCandidate['CanSelJob'] as $row => $sel):?>
                    <div class='ibox-title pd-none-left'>
                      <h5><a class='text-navy' href="../../JobVotes/view/<?php echo $sel['job_vote_id']; ?>"><?php echo !empty($ViewJobVote[$sel['job_vote_id']])? h($ViewJobVote[$sel['job_vote_id']]): ''; ?></a></h5>
                    </div>
                    <div class='ibox-content bg-white p-sm'>
                    <form method="get" class="form-horizontal">
                       <div class="form-group form-g-info">
                        <label class="col-sm-5 control-label  pd-none-left">選考段階</label>
                        <div class="col-sm-7">
                          <div class="form-control border-none"><?php echo !empty($ScreeningStage[$sel['screening_stage_id']])? h($ScreeningStage[$sel['screening_stage_id']]): '';?></div>
                        </div>
                      </div>
                      <div class="form-group form-g-info">
                        <label class="col-sm-5 control-label  pd-none-left">選考ステータス </label>
                        <div class="col-sm-7">
                          <div class="form-control border-none"><?php echo h($this->enjin->getSelStatusName($sel['select_status_id']));?></div>
                        </div>
                      </div>
                    </form>
                    </div>
                    <?php   endforeach; ?>
                    <?php endif; ?>

              </div>
              <div class='ibox-content clearfix bg-sl-btn pd-9'>
                <table class='table no-margin-bottom'>
                  <tbody>
                    <tr>
                      <td class='no-borders ver-mid btn-group btn-block'>
                        <?php
                            echo $this->Form->input('', array(
                                'empty'    => '選択',
                                'type'     => 'select',
                                'options'  => $JobVote,
                                'class'    => 'btn btn-white btn-sm  btn-block',
                                'label'    => false,
                                'div'      => false,
                                'error'    => false,
                                'required' => false,
                                'id' => 'SelJobVote'
                            ));
                        ?>

                      </td>                      <td class='no-borders ver-mid'>
                        <button class="full-width btn btn-primary btn-sm" id="AddJobVote">追加</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="ibox ">
              <div class="ibox-title">
                <h5>イベント参加履歴</h5>
                <div class="ibox-tools">
                  <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                  </a>
                </div>
              </div>
              <div class="ibox-content clearfix p-sm pd-bottom-none" id="EvHistoryBox">
                <?php if(!empty($EvSchedule)):?>
                <?php   foreach($EvSchedule as $row => $event):?>

                <div class='ibox no-margin-bottom'>
                  <div class='ibox-title pd-none-left'>
                    <h5><?php echo $this->Html->link($event['EvSchedule']['individual_theme'], array('controller'=>'EvHistories','action'=>'view',$event['EvSchedule']['ev_event_id']),array( 'class'=>'text-navy' ) ); ?></h5>
                    <div class="ibox-tools">
                      <a class="close-link">
                        <i class="fa fa-times"></i>
                      </a>
                    </div>
                  </div>
                  <div class='ibox-content bg-white p-sm'>
                   <form method="get" class="form-horizontal">
                     <div class="form-group form-g-info">
                      <label class="col-sm-5 control-label  pd-none-left">開催日時</label>
                      <div class="col-sm-7">
                        <div class="form-control border-none"><?php echo h($this->enjin->getDateTime($event['EvSchedule']['holding_date'])); ?></div>
                      </div>
                    </div>
                    <div class="form-group form-g-info">
                      <label class="col-sm-5 control-label  pd-none-left">参加ステータス</label>
                      <div class="col-sm-7">
                        <div class="no-borders ver-mid btn-group btn-block">
                        <?php
                            echo $this->Form->input('', array(
                                'empty'    => '選択',
                                'type'     => 'select',
                                'options'  => Configure::read('ev_history_status'),
                                'class'    => 'btn btn-white btn-sm  btn-block evstatus',
                                'label'    => false,
                                'div'      => false,
                                'error'    => false,
                                'required' => false,
                                'value'    => $event['EvHistory']['status'],
                                'data-id'  => $event['EvHistory']['id'],
                                'disabled' => ($event['EvHistory']['status'] >= 2),
                            ));
                        ?>
                        </div>
                      </div>
                    </div>
                    <?php if(isset($EvHistoryDocument[$event['EvHistory']['id']])):?>
                    <div class="form-group form-g-info">
                      <label class="col-sm-5 control-label  pd-none-left">ファイル</label>
                      <div class="col-sm-7">
                        <div class="form-control border-none h-auto">
                            <?php 
                              $url  = '../../CanDocuments/download/' . $canCandidate['CanCandidate']['id'] . '/' . $EvHistoryDocument[$event['EvHistory']['id']]['id'];
                            ?>
                            <a class='text-navy' href="<?php echo $url;?>" target="_blank"><?php echo $EvHistoryDocument[$event['EvHistory']['id']]['file'];?></a>
                        </div>
                      </div>
                    </div>
                  <?php endif;?>
                    <div class="form-group form-g-info">
                      <label class="col-sm-5 control-label  pd-none-left">評価</label>
                      <div class="col-sm-7">
                        <div class="form-control border-none"><?php echo h($this->enjin->getAfterScoreName($event['EvHistory']['after_score']));?></div>
                      </div>
                    </div>
                    <div class="form-group form-g-info">
                      <label class="col-sm-5 control-label  pd-none-left">コメント</label>
                      <div class="col-sm-7">
                        <div class="form-control border-none h-auto"><?php echo h($event['EvHistory']['after_comment']);?></div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <?php   endforeach; ?>
              <?php endif; ?>
          </div>
          <div class='ibox-content clearfix bg-sl-btn pd-9'>
            <table class='table no-margin-bottom'>
              <tbody>
                <tr>
                  <td class='no-borders ver-mid btn-group btn-block'>
                        <?php
                            echo $this->Form->input('', array(
                                'empty'    => '選択',
                                'type'     => 'select',
                                'options'  => $EvEvent,
                                'class'    => 'btn btn-white btn-sm  btn-block',
                                'label'    => false,
                                'div'      => false,
                                'error'    => false,
                                'required' => false,
                                'id' => 'EvSchedule'
                            ));
                        ?>
                  </td>
                  <td class='no-borders ver-mid'>
                    <button class="full-width btn btn-primary btn-sm" id="AddSelEv">追加</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- end content -->
      </div>
    </div>
  </div>
</div>

<?php echo $this->element('b_back_nav')?>

<script id="SelHistoryTmpl" type="text/x-jquery-tmpl">
<div class='ibox-title pd-none-left'>
  <h5><a class='text-navy' href="../../JobVotes/view/${job_vote_id}">${job_vote_name}</a></h5>
</div>
<div class='ibox-content bg-white p-sm'>
<form method="get" class="form-horizontal">
   <div class="form-group form-g-info">
    <label class="col-sm-5 control-label  pd-none-left">選考段階</label>
    <div class="col-sm-7">
      <div class="form-control border-none">${sel_screening_stage_name}</div>
    </div>
  </div>
  <div class="form-group form-g-info">
    <label class="col-sm-5 control-label  pd-none-left">選考ステータス </label>
    <div class="col-sm-7">
      <div class="form-control border-none">${select_status_name}</div>
    </div>
  </div>
</form>
</div>
</script>

<script id="EvHistoryTmpl" type="text/x-jquery-tmpl">
  <div class='ibox no-margin-bottom'>
    <div class='ibox-title pd-none-left'>
      <h5><a class='text-navy' href="../../EvHistories/view/${ev_event_id}">${individual_theme}</a></h5>
      <div class="ibox-tools">
        <a class="close-link">
          <i class="fa fa-times"></i>
        </a>
      </div>
    </div>
    <div class='ibox-content bg-white p-sm'>
     <form method="get" class="form-horizontal">
       <div class="form-group form-g-info">
        <label class="col-sm-5 control-label  pd-none-left">開催日時</label>
        <div class="col-sm-7">
          <div class="form-control border-none">${holding_date}</div>
        </div>
      </div>
      <div class="form-group form-g-info">
        <label class="col-sm-5 control-label  pd-none-left">参加ステータス</label>
        <div class="col-sm-7">
          <div class="no-borders ver-mid btn-group btn-block">
          <?php
              echo $this->Form->input('', array(
                  'empty'    => '選択',
                  'type'     => 'select',
                  'options'  => Configure::read('ev_history_status'),
                  'class'    => 'btn btn-white btn-sm  btn-block evstatus',
                  'label'    => false,
                  'div'      => false,
                  'error'    => false,
                  'required' => false,
                  'value'    => 0,
                  'data-id'  => '${ev_history_id}',
              ));
          ?>
          </div>
        </div>
      </div>
      <div class="form-group form-g-info">
        <label class="col-sm-5 control-label  pd-none-left">評価</label>
        <div class="col-sm-7">
          <div class="form-control border-none"></div>
        </div>
      </div>
      <div class="form-group form-g-info">
        <label class="col-sm-5 control-label  pd-none-left">コメント</label>
        <div class="col-sm-7">
          <div class="form-control border-none h-auto"></div>
        </div>
      </div>
    </form>
  </div>
</div>
</script>

<script>
/* Set SelHistory */
$('#AddJobVote').on('click', function(){
    if($('#SelJobVote').val() == ''){
        alert('求人を選択してください。');
        return;
    }
    var _url = '<?php echo $this->webroot;?>CanCandidates/SetSelHistory/<?php echo h($canCandidate['CanCandidate']['id']);?>/' + $('#SelJobVote').val();
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _url,
        success: function(res){
          console.log( res );
            if(res.status) {
                if(res.data) {
                    $("#SelHistoryTmpl").tmpl(res.data).appendTo("#SelHistoryBox");
                }
            }
        }
    });
});/* Set EvHistory */
$('#AddSelEv').on('click', function(){
    if($('#EvSchedule').val() == ''){
        alert('イベントを選択してください。');
        return;
    }
    var _url = '<?php echo $this->webroot;?>CanCandidates/SetEvHistory/<?php echo h($canCandidate['CanCandidate']['id']);?>/' + $('#EvSchedule').val();
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res.status) {
                if(res.data) {
                    $("#EvHistoryTmpl").tmpl(res.data).appendTo("#EvHistoryBox").find('.evstatus').data('id', res.data.ev_history_id);
                }
            }
        }
    });
});

/* Update EvHistory.Statas */
$(document).on('change','.evstatus',function(){
    var _this = $(this);
    if(_this.val() == ''){
        alert('参加ステータスを選択してください。');
        return;
    }
    var _url = '<?php echo $this->webroot;?>CanCandidates/UpdateEvHistory/' + _this.data('id') + '/' + _this.val();
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: _url,
        success: function(res){
            if(res.status) {
                alert('参加ステータスを更新しました。');
                if(_this.val() >= '2'){
                  _this.attr('disabled', 'disabled');
                }
            }else{
                alert('参加ステータスの更新に失敗しました。');
            }
        }
    });
});

</script>
