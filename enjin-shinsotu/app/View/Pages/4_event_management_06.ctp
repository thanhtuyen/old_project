<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>候補者管理 − 候補者詳細</title>


  <?php echo $this->Html->css('bootstrap/animate'); ?>
  <?php echo $this->Html->css('plugins/clockpicker/clockpicker'); ?>
  <?php echo $this->Html->css('plugins/datapicker/datepicker3'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3'); ?>

  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>
  <?php echo $this->Html->css('enjin/email'); ?>
  <?php echo $this->Html->css('enjin/master'); ?>
  <?php echo $this->Html->css('enjin/02_selection.css'); ?>
  <?php echo $this->Html->css('plugins/switchery/switchery'); ?>
  <?php echo $this->Html->css('enjin/6_06_event_schedule.css'); ?>


  <!-- Mainly scripts -->
  <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
  <?php echo $this->Html->script('bootstrap.min.js'); ?>
  <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>
  <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>
  <!-- Custom and plugin javascript -->
  <?php echo $this->Html->script('inspinia.js'); ?>
  <?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
  <!-- iCheck -->
  <?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>
  <!-- Data picker -->
  <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>
  <!-- Peity -->
  <?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>
  <?php echo $this->Html->script('kiwi.js'); ?>

  <?php echo $this->Html->script('plugins/clockpicker/clockpicker.js'); ?>

  <!-- Image cropper -->
  <?php echo $this->Html->script('plugins/cropper/cropper.min.js'); ?>

  <!-- Date range use moment.js same as full calendar plugin -->
  <?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
  <!-- Date range picker -->
  <?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>



</head>

<!-- ------------start header and menu------------ -->
<!-- ------------start header and menu------------ -->


<body>
  <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
          <li class="nav-header">
            <div class="dropdown profile-element"> 
             <span>
              <?php echo $this->Html->image("bootstrap/profile_small.jpg", array(
                "class" => "img-circle",
                )); ?>
              </span>
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                  <li><a href="profile.html">Profile</a></li>
                  <li><a href="contacts.html">Contacts</a></li>
                  <li><a href="mailbox.html">Mailbox</a></li>
                  <li class="divider"></li>
                  <li><a href="login.html">Logout</a></li>
                </ul>
              </div>
              <div class="logo-element">
                IN+
              </div>
            </li>
            <li>
              <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">ダッシュボード</span> <span class="fa arrow"></span></a>
              <ul class="nav nav-second-level collapse">
                <li><a href="index.html">Dashboard v.1</a></li>
                <li><a href="dashboard_2.html">Dashboard v.2</a></li>
                <li><a href="dashboard_3.html">Dashboard v.3</a></li>
                <li><a href="dashboard_4_1.html">Dashboard v.4</a></li>
              </ul>
            </li>
            <li>
              <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">選考管理</span></a>
            </li>
            <li>
              <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">イベント管理</span><span class="fa arrow"></span></a>
              <ul class="nav nav-second-level collapse">
                <li><a href="graph_flot.html">Flot Charts</a></li>
                <li><a href="graph_morris.html">Morris.js Charts</a></li>
                <li><a href="graph_rickshaw.html">Rickshaw Charts</a></li>
                <li><a href="graph_chartjs.html">Chart.js</a></li>
                <li><a href="graph_chartist.html">Chartist</a></li>
                <li><a href="graph_peity.html">Peity Charts</a></li>
                <li><a href="graph_sparkline.html">Sparkline Charts</a></li>
              </ul>
            </li>
            <li>
              <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">候補者管理 </span></a>
              <ul class="nav nav-second-level collapse">
                <li><a href="mailbox.html">Inbox</a></li>
                <li><a href="mail_detail.html">Email view</a></li>
                <li><a href="mail_compose.html">Compose email</a></li>
                <li><a href="email_template.html">Email templates</a></li>
              </ul>
            </li>
            <li>
              <a href="metrics.html"><i class="fa fa-pie-chart"></i> <span class="nav-label">求人票管理</span> </a>
            </li>
            <li>
              <a href="widgets.html"><i class="fa fa-flask"></i> <span class="nav-label">エージェント管理</span></a>
            </li>
            <li>
              <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">メール送信管理</span><span class="fa arrow"></span></a>
              <ul class="nav nav-second-level collapse">
                <li><a href="form_basic.html">Basic form</a></li>
                <li><a href="form_advanced.html">Advanced Plugins</a></li>
                <li><a href="form_wizard.html">Wizard</a></li>
                <li><a href="form_file_upload.html">File Upload</a></li>
                <li><a href="form_editors.html">Text Editor</a></li>
              </ul>
            </li>
            <li>
              <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">マスタ管理</span>  </a>
              <ul class="nav nav-second-level collapse">
                <li><a href="contacts.html">Contacts</a></li>
                <li><a href="profile.html">Profile</a></li>
                <li><a href="projects.html">Projects</a></li>
                <li><a href="project_detail.html">Project detail</a></li>
                <li><a href="teams_board.html">Teams board</a></li>
                <li><a href="social_feed.html">Social feed</a></li>
                <li><a href="clients.html">Clients</a></li>
                <li><a href="full_height.html">Outlook view</a></li>
                <li><a href="file_manager.html">File manager</a></li>
                <li><a href="calendar.html">Calendar</a></li>
                <li><a href="issue_tracker.html">Issue tracker</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="article.html">Article</a></li>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="timeline.html">Timeline</a></li>
                <li><a href="pin_board.html">Pin board</a></li>
              </ul>
            </li>
            <li>
              <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">マイページ</span><span class="fa arrow"></span></a>
              <ul class="nav nav-second-level collapse">
                <li><a href="search_results.html">Search results</a></li>
                <li><a href="lockscreen.html">Lockscreen</a></li>
                <li><a href="invoice.html">Invoice</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="login_two_columns.html">Login v.2</a></li>
                <li><a href="forgot_password.html">Forget password</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="404.html">404 Page</a></li>
                <li><a href="500.html">500 Page</a></li>
                <li><a href="empty_page.html">Empty page</a></li>
              </ul>
            </li>
          </ul>

        </div>
      </nav>

      <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
          <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div>
              <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

              </div>
              <div class="nav navbar-top-links navbar-right logo_enjin">
                <?php echo $this->Html->image("logo_enjin2.png", array("alt" => "logo",)); ?>
              </div>
              <div class="select_option m-t-sm">

              </div>
              <div class='nav navbar-top-links navbar-right logo_enjin'>
                <div class="btn-group">
                  <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle h-30 l-h-7" aria-expanded="false">2015<span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#">2016</a></li>
                    <li><a href="#">2017</a></li>
                    <li><a href="#">2018</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <ul class="nav navbar-top-links navbar-right">
            <!--   <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                  <i class="fa fa-comment"></i>  <span class="label label-danger">16</span>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                  <li>
                    <div class="dropdown-messages-box">
                      <a href="profile.html" class="pull-left"></a>
                      <div class="media-body">
                        <small class="pull-right">46h ago</small>
                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                      </div>
                    </div>
                  </li>
                  <li class="divider"></li>
                  <li>
                    <div class="dropdown-messages-box">
                      <a href="profile.html" class="pull-left"></a>
                      <div class="media-body ">
                        <small class="pull-right text-navy">5h ago</small>
                        <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                      </div>
                    </div>
                  </li>
                  <li class="divider"></li>
                  <li>
                    <div class="dropdown-messages-box">
                      <a href="profile.html" class="pull-left"></a>
                      <div class="media-body ">
                        <small class="pull-right">23h ago</small>
                        <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                      </div>
                    </div>
                  </li>
                  <li class="divider"></li>
                  <li>
                    <div class="text-center link-block">
                      <a href="mailbox.html">
                        <i class="fa fa-comment"></i> <strong>Read All Messages</strong>
                      </a>
                    </div>
                  </li>
                </ul>
              </li> -->

              <li>
                <a href="login.html">
                  <i class="fa fa-sign-out"></i> Log out
                </a>
              </li>
            </ul>

          </nav>
        </div>
        <!-- ----------end header and menu---------- -->
        <!-- ----------end header and menu---------- -->

        <!-- --------------start content--------------- -->
        <!-- --------------start content--------------- -->
        <!-- --------------start content--------------- -->
        <!-- --------------start content--------------- -->

        <div class="row wrapper border-bottom white-bg page-heading">
          <div class="col-lg-8">
            <h2>
              <button class="btn btn-white btn-sm" type="submit">< 戻る</button>
              <span>選考履歴｜1234567　田中　太朗</span>
            </h2>
          </div>
        </div>
        <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
          <div class="full-content">
            <div class="col-lg-8">
              <div class="tabs-container">
                <!-- -----------galfkjhsadjfsd -->
                <ul class="nav nav-tabs">
                  <li class=""><a data-toggle="tab" href="#tab-0">書類選考</a></li>
                  <li class=""><a data-toggle="tab" href="#tab-1">1 次選考</a></li>
                  <li class="active"><a data-toggle="tab" href="#tab-2">2次選考</a></li>
                </ul>
                <div class='ibox'>
                  <div class="tab-content">

                    <!-- tab 0 -->
                    <div id="tab-0" class="tab-pane active">
                      <!-- content tab-0 -->
                    </div>
                    <!-- end tab 0 -->

                    <!-- tab-2 -->
                    <div id="tab-2" class="tab-pane active">
                      <div class="panel-body pd-bottom-none">

                        <div class="ibox-title">
                          <h5>候補者情報</h5>
                        </div>

                        <div class="ibox-content pd-bottom-none">
                          <form method="get" class="form-horizontal">
                            <div class="form-group"><label class="col-sm-4 control-label">選考履歴ID</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">1234567</div>
                              </div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">候補者名</label>
                              
                                <div class="col-sm-8">
                                <div class="form-control border-none"><a class='text-navy' href="">田中　太朗</a></div>
                              </div>
                              
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">候補者ID</label>
                              
                              <div class="col-sm-8">
                                <div class="form-control border-none">987654</div>
                              </div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">選考段階名</label>
  
                              <div class="col-sm-8">
                                <div class="form-control border-none">2次面接</div>
                              </div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">選考ステータス</label>
                              <div class="col-sm-8">
                                <select class="form-control select-w100" name="agent_id">
                                  <option>不合格</option>
                                  <option>不合格</option>
                                  <option>その他</option>
                                </select>
                              </div>
                            </div>

                            <div class="form-group mbottom15"><label class="col-sm-4 control-label">選考終了予定日時</label>
                              <div class="col-sm-8">
                                <div class="col-sm-6">
                                  <div class="data_1" id="">
                                    <div class="input-group date">
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                      <input type="text" class="form-control ct-select1" value="03/04/2014">
                                    </div>
                                  </div>
                                  <!-- end id data_1-->
                                </div>
                                <div class="col-sm-6">
                                  <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                      <span class="fa fa-clock-o"></span>
                                    </span>
                                    <input type="text" class="form-control" value="09:30">
                                  </div><!-- end clock-->
                                </div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">選考開始予定日時</label>
                              <div class="col-sm-8">
                                <div class="col-sm-6">
                                  <div class="data_1" id="">
                                    <div class="input-group date">
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                      <input type="text" class="form-control" value="03/04/2014">
                                    </div>
                                  </div>
                                  <!-- end id data_1-->
                                </div>
                                <div class="col-sm-6">
                                  <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                      <span class="fa fa-clock-o"></span>
                                    </span>
                                    <input type="text" class="form-control" value="09:30">
                                  </div><!-- end clock-->
                                </div>
                              </div>
                            </div>

                            <!-- end table 2-->

                            <!-- form 2 -->   


                            <div class="form-group"><label class="col-sm-4 control-label">求人票ID</label>
                              
                              <div class="col-sm-8">
                                <div class="form-control border-none">ABC123456</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">求人票タイトル</label>
                              
                              <div class="col-sm-8">
                                <div class="form-control border-none">求人票タイトル</div>
                              </div>
                            </div>

                            <!-- end form 2 -->
                            <!-- form 3 -->   


                            <div class="form-group"><label class="col-sm-4 control-label">選考ステータスオプション</label>
                               <div class="col-sm-8">
                                <div class="form-control border-none">オプション内容</div>
                              </div>

                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">掲示年収</label>
                              
                                <div class="col-sm-8">
                                <div class="form-control border-none">400万円</div>
                              </div>
                            </div>

                            <div class="form-group mbottom15"><label class="col-sm-4 control-label">コメント</label>
                              <div class="col-sm-8">
                                <textarea type="text" rows="6" class="form-control">選 考 履 歴 に 対 す る 、 コ メ ン ト ＆ メ モ</textarea>
                              </div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">訪問先情報</label>
                              <div class="col-sm-8"><input type="text" class="form-control" value="訪問先情報"></div>
                            </div>


                            <div class="form-group"><label class="col-sm-4 control-label">流入元企業への 選考ステータスの公開可否</label>
                              <div class="col-sm-8">
                                <div class="switch form-control border-none">
                                  <div class="onoffswitch">
                                    <input type="checkbox" checked="" class="onoffswitch-checkbox" id="example2">
                                    <label class="onoffswitch-label" for="example2">
                                      <span class="onoffswitch-inner"></span>
                                      <span class="onoffswitch-switch"></span>
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">流入元企業への 選考ステータスの公開可否</label>
                              <div class="col-sm-8">
                                <div class="switch form-control border-none">
                                  <div class="onoffswitch">
                                    <input type="checkbox" checked="" class="onoffswitch-checkbox" id="example1">
                                    <label class="onoffswitch-label" for="example1">
                                      <span class="onoffswitch-inner"></span>
                                      <span class="onoffswitch-switch"></span>
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">   最終更新者タイプ</label>
                              
                              <div class="col-sm-8">
                                <div class="form-control border-none">採用担当者</div>
                              </div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">最終更新者採用担当者ID</label>
                              
                              <div class="col-sm-8">
                                <div class="form-control border-none"><a class='text-navy' href="">live1234</a></div>
                              </div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label">最終更新流入元担当者ID</label>
                              
                              <div class="col-sm-8">
                                <div class="form-control border-none"><a class='text-navy' href="">mynavi12345678</a></div>
                              </div>
                            </div>

                            <div class="text-center btn-clear">
                              <button class="btn btn-primary w-95 m-r-25">削除</button>
                              <button class="btn btn-primary w-95">更新</button>
                            </div>
                          </form>
                        </div> 
                        <!-- end form 3-->
                      </div>
                      
                    </div>


                  </div>
                  <!-- end tab-2 -->


                </div>

              </div>

              <div class = "ibox">
                <div class="ibox-title">
                  <h5>最終選考採用担当者</h5>
                  <div class="ibox-tools">
                    <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                    </a>
                  </div>
                </div>
                <div class="ibox-content p-sm">
                  <h3><p>面接官（（採用担当者））の登録</p></h3>

                  <div class='ibox'>
                    <div class="ibox-content sch-bg clearfix p-sm">
                      <form method="get" class="form-horizontal">
                        <!--to do start1-->
                        <div>
                          <div class = "float-lf col-lg-6"> 
                            <div><label for="">部署名</label></div>

                            <div class='form-group'>
                              <select class="full-width btn btn-sm">
                                <option>営業部</option>
                              </select>
                            </div>



                            <div class='form-group'>
                              <select class="full-width btn btn-sm" >
                                <option>営業2課</option>

                              </select>
                            </div>

                            <div class='form-group'>
                              <select class="full-width btn btn-sm">
                                <option>ソリューション営業チーム</option>
                              </select>
                            </div>
                          </div>

                          <div class = "float-lf col-lg-6">
                            <div class = "margin-lf15"><label for="">採用担当者</label></div>
                            <div >
                              <div class = "float-lf col-lg-6">
                                <select class="full-width btn btn-sm">
                                  <option>ソリューション営業チーム</option>
                                </select>
                              </div>
                              <div class="col-lg-6">
                                <button type="button" class="margin-lf10 btn btn-primary btn-sm">面接官に追加</button>
                              </div>
                            </div>
                          </div>

                        </div>
                      </form>

                    </div>

                  </div>

                  <h3><p>面接官（（採用担当者））選考履歴</p></h3>

                  <table class="table table-bordered no-margin-bottom">
                    <thead>
                      <tr>
                        <th>採用担当者名</th>
                        <th>評価ランク</th>
                        <th class = "col-lg-2">評価スコア</th>
                        <th>評価コメント</th>
                        <th>操作</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr >
                        <td><a class = "text-navy" href="#">柏井 こたろー</a></td>
                        <td>不合格</td>
                        <td>50</td>
                        <td>コメントコメント</td>
                        <td></td>
                      </tr>
                      <tr class = "show-data">
                        <td><a class = "text-navy" href="#">宮崎 範浩</a></td>
                        <td> </td>
                        <td></td>
                        <td> </td>
                        <td>
                          <div class = "margin-lf10">
                            <div class = "float-lf margin-right5"><button class="p4-show-fr-edit full-width btn btn-xs btn-primary show-data" id=''>評価入力</button></div>
                            <div class = "float-lf"><button class="full-width btn btn-xs btn-primary">解除</button></div>
                          </div>  
                        </td>
                      </tr>



                      <tr class = "show-return hiden-return fr-hiden">
                        <td><a class = "text-navy" href="#">宮崎 範浩</a></td>
                        <td>
                          <div>
                            <select class="form-control select-w100" name="agent_id">
                              <option>合格</option>
                              <option>不合格</option>
                              <option>その他</option>
                            </select>
                          </div>
                        </td>
                        <td><input type="number" class="form-control" value="75"></td>
                        <td>
                          <div><input type="text" class="form-control" value="text box"></div>
                        </td>
                        <td>
                          <div class = "margin-lf10">
                            <div class = "float-lf margin-right5"><button class="p4-save-edit full-width btn btn-xs btn-primary show-return hiden-return fr-hiden" id = "">更新</button></div>
                            <div class = "float-lf"><button class="full-width btn btn-xs btn-primary">解除</button></div>
                          </div>  
                        </td>
                      </tr>

                      <tr class = "edit-return fr-hiden">
                        <td><a class = "text-navy" href="#">宮崎 範浩</a></td>
                        <td>合格</td>
                        <td>75</td>
                        <td> コメントコメント</td>
                        <td>
                          <div class = "margin-lf10">
                            <div class = "float-lf"><button class="p4-edit-return full-width btn btn-xs btn-primary edit-return" id = "">修正</button></div>
                          </div>  
                        </td>
                      </tr>

                      <tr >
                        <td><a class = "text-navy" href="#">宮崎 範浩</a></td>
                        <td>合格</td>
                        <td>75</td>
                        <td>コメントコメント</td>
                        <td>abc</td>
                      </tr>

                      <tr >
                        <td><a class = "text-navy" href="#">土屋 則幸</a></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>

                      <tr>
                        <td><a class = "text-navy" href="#">三橋 和広</a></td>
                        <td>合格</td>
                        <td>74 </td>
                        <td> コメントコメント</td>
                        <td></td>
                      </tr>

                    </tbody>
                  </table>                                      
                  <!-- table -->
                </div>
              </div>

            </div>
            <div class="col-lg-4">
              <!--ibox 1-->
              <div class="ibox">
                <div class="ibox-title">
                  <h5>求人票情報</h5>

                  <div class="ibox-tools">
                    <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                    </a>
                  </div>
                </div>
                <div class="ibox-content clearfix" style="display: block;">
                  <table class="table table-bordered no-margin-bottom subcontents-sb-1">
                    <tbody>
                      <tr>
                        <th class="w-47per">求人票ID</th>
                        <td class="right-table-td">1</td>
                      </tr>   
                      <tr>
                        <th class="">求人票タイトル</th>
                        <td class="right-table-td">新卒採用(技術)</td>
                      </tr> 
                      <tr>
                        <th class="">募集要項</th>
                        <td class="right-table-td">プログラマー募集</td>
                      </tr> 
                      <tr>
                        <th class="">職種タイプ</th>
                        <td class="right-table-td">IT系</td>
                      </tr> 
                      <tr>
                        <th class="">初任給</th>
                        <td class="right-table-td">200,000円</td>
                      </tr> 
                      <tr>
                        <th class="">待遇</th>
                        <td class="right-table-td">サンプル</td>
                      </tr> 
                      <tr>
                        <th class="">応募資格</th>
                        <td class="right-table-td">新卒</td>
                      </tr> 
                      <tr>
                        <th class="">募集人数</th>
                        <td class="right-table-td">51人</td>
                      </tr> 
                      <tr>
                        <th class="">募集期限</th>
                        <td class="right-table-td">2015年12月16日 08:50:00</td>
                      </tr>      
                      <tr>
                        <th class="">公開開始日時</th>
                        <td class="right-table-td">2015年08月20日 11:55:00</td>
                      </tr>     
                      <tr>
                        <th class="">募集エリア</th>
                        <td class="right-table-td">東京hj</td>
                      </tr>             
                    </tbody>
                  </table>
                </div>
                <!--end table 1-->
              </div>
              <!--end ibox 1-->


              <!--ibox 2-->
              <div class="ibox">
                <div class="ibox-title">
                  <h5>自社情報</h5>

                  <div class="ibox-tools">
                    <a class="collapse-link">
                      <i class="fa fa-chevron-up"></i>
                    </a>
                  </div>
                </div>
                <div class="ibox-content clearfix" style="display: block;">

                  <table class="table table-bordered no-margin-bottom subcontents-sb-1">
                    <tbody>
                      <tr>
                        <th>会社名</th>
                        <td>AXAS株式会社</td>
                      </tr>      
                      <tr>
                        <th>都道府県</th>
                        <td>東京都</td>
                      </tr>  
                      <tr>
                        <th>市区町村</th>
                        <td>新宿区</td>
                      </tr>  
                      <tr>
                        <th>契約期間</th>
                        <td>2015年08月31日</td>
                      </tr>  
                      <tr>
                        <th>設立年月日</th>
                        <td>2007年06月</td>
                      </tr>  
                      <tr>
                        <th>従業員数</th>
                        <td>1,000人</td>
                      </tr>  
                      <tr>
                        <th>売上高</th>
                        <td>560,000,000円</td>
                      </tr>  
                      <tr>
                        <th>業種</th>
                        <td>サービス業</td>
                      </tr>  
                      <tr>
                        <th>市場</th>
                        <td>その他</td>
                      </tr>  
                      <tr>
                        <th>備考</th>
                        <td>ユーザー企業１</td>
                      </tr>                                            
                    </tbody>
                  </table>
                </div>

              </div>
              <!--end ibox 2-->
              <!--end table 2-->
            </div>
          </div>

        </div>
        <div class = "clear20"></div>


        <!-- -------------end content------------- -->
        <!-- -------------end content------------- -->
        <!-- -------------end content------------- -->
        <!-- -------------end content------------- -->
        <!-- -------------end content------------- -->
        <div class="row wrapper border-bottom white-bg page-heading clearfix">
          <div class="col-lg-10">
            <h2><button class="btn btn-sm btn-white">
              &lt; 戻る
            </button>   
            <!-- 求人票詳細｜ ID123456 2016年度新卒・営業募集 --></h2>
          </div>
        </div>
        <!-- end before footer -->
        <br /><br />
        <div class="clearfix"></div>
        <div class="footer">
          <div>
            <strong>Copyright</strong>© enjin
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
$(document).ready(function () {

  var $image = $(".image-crop > img")
  $($image).cropper({
    aspectRatio: 1.618,
    preview: ".img-preview",
    done: function (data) {
                // Output the result data for cropping image.
              }
            });

  var $inputImage = $("#inputImage");
  if (window.FileReader) {
    $inputImage.change(function () {
      var fileReader = new FileReader(),
      files = this.files,
      file;

      if (!files.length) {
        return;
      }

      file = files[0];

      if (/^image\/\w+$/.test(file.type)) {
        fileReader.readAsDataURL(file);
        fileReader.onload = function () {
          $inputImage.val("");
          $image.cropper("reset", true).cropper("replace", this.result);
        };
      } else {
        showMessage("Please choose an image file.");
      }
    });
  } else {
    $inputImage.addClass("hide");
  }


  $('#data_1 .input-group.date').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
  });

  $('.i-checks').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green'
  });

  $('.clockpicker').clockpicker();

  $('input[name="daterange"]').daterangepicker();

  $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

  $('#reportrange').daterangepicker({
    format: 'MM/DD/YYYY',
    startDate: moment().subtract(29, 'days'),
    endDate: moment(),
    minDate: '01/01/2012',
    maxDate: '12/31/2015',
    dateLimit: {days: 60},
    showDropdowns: true,
    showWeekNumbers: true,
    timePicker: false,
    timePickerIncrement: 1,
    timePicker12Hour: true,
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    opens: 'right',
    drops: 'down',
    buttonClasses: ['btn', 'btn-sm'],
    applyClass: 'btn-primary',
    cancelClass: 'btn-default',
    separator: ' to ',
    locale: {
      applyLabel: 'Submit',
      cancelLabel: 'Cancel',
      fromLabel: 'From',
      toLabel: 'To',
      customRangeLabel: 'Custom',
      daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
      monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      firstDay: 1
    }
  }, function (start, end, label) {
    console.log(start.toISOString(), end.toISOString(), label);
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  });
});


</script>
<style>
.DTTT_container{
  display: none;
}
.dataTables_info{
  display: none;
}
.dataTables_length{
  display: none;
}

.dataTables_filter{
  display: none;
}
</style>
</body>

</html>
