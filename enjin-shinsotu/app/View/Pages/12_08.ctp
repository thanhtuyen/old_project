<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>候補者管理 − 候補者詳細</title>

  <!-- css -->
  <?php echo $this->Html->css('bootstrap/bootstrap.min.css'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome.css'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom.css'); ?>
  <?php echo $this->Html->css('bootstrap/animate.css'); ?>
  <?php echo $this->Html->css('bootstrap/style.css'); ?>
  <?php echo $this->Html->css('plugins/clockpicker/clockpicker'); ?>
  <?php echo $this->Html->css('plugins/datapicker/datepicker3'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3'); ?>
  <?php echo $this->Html->css('plugins/fullcalendar/fullcalendar.css'); ?>
  <?php echo $this->Html->css('plugins/switchery/switchery'); ?>
  <?php echo $this->Html->css('enjin/candidatesdetails.css'); ?>
  <?php echo $this->Html->css('enjin/global.css'); ?>

  <!-- script -->
  <?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
  <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
  <?php echo $this->Html->script('bootstrap.min.js'); ?>
  <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>
  <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>
  <?php echo $this->Html->script('inspinia.js'); ?>
  <?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
  <?php echo $this->Html->script('jquery-ui.custom.min.js'); ?>
  <?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>
  <!-- Peity -->
  <?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>
  <?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
  <?php echo $this->Html->script('plugins/fullcalendar/fullcalendar.min.js'); ?>
  <!-- Date range picker -->
  <?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>
  <!-- Data picker -->
  <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>
  <!-- Switchery -->
  <?php echo $this->Html->script('plugins/switchery/switchery.js'); ?>
  <?php echo $this->Html->script('kiwi.js'); ?>
</head>

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
                  <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David
                    Williams</strong>
                  </span> <span class="text-muted text-xs block">Art Director <b
                  class="caret"></b></span> </span> </a>
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
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">ダッシュボード</span> <span
                  class="fa arrow"></span></a>
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
                  <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">イベント管理</span><span
                    class="fa arrow"></span></a>
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
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">メール送信管理</span><span
                      class="fa arrow"></span></a>
                      <ul class="nav nav-second-level collapse">
                        <li><a href="form_basic.html">Basic form</a></li>
                        <li><a href="form_advanced.html">Advanced Plugins</a></li>
                        <li><a href="form_wizard.html">Wizard</a></li>
                        <li><a href="form_file_upload.html">File Upload</a></li>
                        <li><a href="form_editors.html">Text Editor</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">マスタ管理</span> </a>
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
                      <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">マイページ</span><span
                        class="fa arrow"></span></a>
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
                        <li class="dropdown">
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
                        </li>

                        <li>
                          <a href="login.html">
                            <i class="fa fa-sign-out"></i> Log out
                          </a>
                        </li>
                      </ul>

                    </nav>
                  </div>

                  <!-- title -->
                  <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                      <h2>候補者登録</h2>
                    </div>
                  </div>
                  <!-- end title -->

                  <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
                    <div class="col-lg-8">
                      <div class='ibox'>
                        <div class="ibox-title">
                          <h5>候補者情報</h5>
                          <div class="ibox-tools">
                            <button type='button' class='btn btn-primary btn-xs'>編集</button>
                          </div>
                        </div>
                        <div class='ibox-content bg-white p-sm'>
                          <div class="">
                            <div class="tabs-container">
                              <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1">基本データ</a></li>
                                <li class=""><a href="12_08_02">付随データ</a></li>
                              </ul>
                              <div class="tab-content">

                                <!-- tab container 2 -->
                                <div id="tab-1" class="tab-pane active">
                                  <div class="panel-body form-edit">   
                                    <div class="ibox-content bg-white p-sm pd-right-none">
                                      <form method="get" class="form-horizontal form-edit">

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">氏</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">Last name</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">氏フリガナ</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">ミドルネーム</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">Midname</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">名</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">First name</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">名フリガナ</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">顔写真URL</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">携帯メールアドレス</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">電話番号</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">携帯電話番号</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">携帯メールアドレス</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">居住国</label>
                                          <div class="col-sm-8">
                                            <div class="no-borders ver-mid btn-group btn-block">
                                              <select class="form-control">
                                                <option >日本</option>
                                                <option selected="selected">日本</option>
                                                <option>日本</option>
                                              </select>

                                            </div>
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">郵便番号</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">国都道府県</label>
                                          <div class="col-sm-8">
                                            <div class="no-borders ver-mid btn-group btn-block">
                                              <select class="form-control">
                                                <option >東京都</option>
                                                <option selected="selected">東京都</option>
                                                <option>東京都</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">居住地</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">帰省先国</label>
                                          <div class="col-sm-8">
                                            <div class="no-borders ver-mid btn-group btn-block">

                                              <select class="form-control">
                                                <option >日本</option>
                                                <option selected="selected">日本</option>
                                                <option>日本</option>
                                              </select>

                                            </div>
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">帰省先郵便番号</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">帰省先都道府県</label>
                                          <div class="col-sm-8">
                                            <div class="no-borders ver-mid btn-group btn-block">
                                              <select class="form-control">
                                                <option >北海道</option>
                                                <option selected="selected">北海道</option>
                                                <option>北海道</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">帰省先居住地</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">帰省先電話番号</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group data_1" id="">
                                          <label class="col-sm-4 control-label">生年月日</label>
                                          <div class="col-sm-8">
                                            <div class="input-group date">
                                              <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </span>
                                              <input type="text" class="form-control" value="YYYY / MM / DD">
                                            </div>
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">性別</label>
                                          <div class="col-sm-8 pull-left">

                                            <div class='i-checks pull-left form-control border-none w20'>
                                              <label>
                                                <input class='' type="radio" checked="" id="optionsRadios1" name="optionsRadios">男性
                                              </label>
                                            </div>

                                            <div class='i-checks form-control border-none'>
                                              <label>
                                                <input class='' type="radio" checked="" id="optionsRadios2" name="optionsRadios">女性
                                              </label>
                                            </div>

                                            <div class='clearfix'></div>

                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">所属グループ</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">流入元企業ID</label>
                                          <div class="col-sm-8">
                                            <div class="no-borders ver-mid btn-group btn-block">
                                              <select class="form-control">
                                                <option >1234 リクナビ</option>
                                                <option selected="selected">1234 リクナビ</option>
                                                <option>1234 リクナビ</option>
                                              </select>
                                            </div>
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">流入元契約ID</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">入社可能年月</label>
                                          <div class="col-sm-8">
                                            <div class=''>
                                              <div class="no-borders ver-mid btn-group pull-left">

                                                <select class="form-control">
                                                  <option >2016年</option>
                                                  <option selected="selected">2016年</option>
                                                  <option>2016年</option>
                                                </select>

                                              </div>
                                              <div class="no-borders ver-mid btn-group pull-left col-sm-5">
                                                <select class="form-control">
                                                  <option >4月</option>
                                                  <option selected="selected">4月</option>
                                                  <option>4月</option>
                                                </select>

                                              </div>
                                              <div class='clearfix'></div>
                                            </div>
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">マイナビID</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">リクナビID</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" value="入力">
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">最終更新者</label>
                                          <div class="col-sm-8">
                                            -
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">最終更新流入元担当者ID</label>
                                          <div class="col-sm-8">
                                            -
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">最終更新採用担当者ID</label>
                                          <div class="col-sm-8">
                                            -
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">学生登録日時</label>
                                          <div class="col-sm-8">
                                            -
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">学生更新日時</label>
                                          <div class="col-sm-8">
                                            -
                                          </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">最終ログイン日</label>
                                          <div class="col-sm-8">
                                            -
                                          </div>
                                        </div> 
                                        <div class='button_cen element-detail-box'>
                                          <button type='submit' class='w-75 btn btn-primary btn-sm'>クリア</button>
                                        </div>
                                      </form>
                                    </div>                                       
                                  </div>
                                </div>
                                <!-- end tab container 2 -->

                                <!-- tab container 1 -->

                                <!-- tab container 1 -->

                              </div>

                            </div>
                          </div>

                        </div>
                      </div>


                    </div>



                  </div>


                  <br>
                  <br>              

                  <div class='clearfix'></div>
                  <div class="footer">
                    <div>
                      <strong>Copyright</strong>© enjin
                    </div>
                  </div>

                </body>

                </html>
