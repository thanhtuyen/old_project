<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>イベント管理 − イベント開催日程 − 詳細画面</title>
  
  <!-- end script -->

  <!-- css -->
  <?php echo $this->Html->css('bootstrap/bootstrap.min.css'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome.css'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom.css'); ?>
  <?php echo $this->Html->css('bootstrap/animate.css'); ?>
  <?php echo $this->Html->css('bootstrap/style.css'); ?>
  <?php echo $this->Html->css('enjin/management_event_calender.css'); ?>

  <?php echo $this->Html->css('plugins/clockpicker/clockpicker'); ?>
  <?php echo $this->Html->css('plugins/datapicker/datepicker3'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3'); ?>


  <?php echo $this->Html->css('plugins/switchery/switchery'); ?>
  <?php // echo $this->Html->css('enjin/candidatesdetails.css'); ?>
  <?php echo $this->Html->css('enjin/global.css'); ?>
  <?php echo $this->Html->css('enjin/master'); ?>
  <?php echo $this->Html->css('enjin/6_06_event_schedule.css'); ?>
  <!-- end css -->



  <!-- script -->
  <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
  <?php echo $this->Html->script('bootstrap.min.js'); ?>
  <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>
  <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>
  <?php echo $this->Html->script('inspinia.js'); ?>
  <!-- end script -->

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
                        <?php echo $this->Html->image("bootstrap/logo_enjin.png", array(
                          "alt" => "logo",
                          )); ?>
                        </div>
                        <div class="select_option m-t-sm">
                          <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle h-30" aria-expanded="false">2015<span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="#">2016</a></li>
                              <li><a href="#">2017</a></li>
                              <li><a href="#">2018</a></li>
                            </ul>
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
                                  <a href="profile.html" class="pull-left">
                                    <img src="/enjin_main/enjin-shinsotu/img/bootstrap/a7.jpg" class="img-circle" alt="">                          </a>
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
                                    <a href="profile.html" class="pull-left">
                                      <img src="/enjin_main/enjin-shinsotu/img/bootstrap/a7.jpg" class="img-circle" alt="">                            </a>
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
                                      <a href="profile.html" class="pull-left">
                                        <img src="/enjin_main/enjin-shinsotu/img/bootstrap/a7.jpg" class="img-circle" alt="">                              </a>
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
                          <!-- title content -->
                          <div class="row wrapper border-bottom white-bg page-heading">
                            <div class="col-lg-10">
                              <h2>イベントカレンダー</h2>
                            </div>
                            <div class="col-lg-2">

                            </div>
                          </div>
                          <!-- content -->
                          <div class="wrapper wrapper-content animated fadeInRight row">
                            <!--start content-->
                            <div class="content">

                              <div class="t-wrapper clearfix">
                                <!-- table 1 -->
                                <table>
                                  <thead>
                                    <tr class="t-header">
                                      <th colspan="12">
                                        <div class="l-btn">
                                          <button class="btn btn-white" type="button"><</button>
                                          <button class="btn btn-white" type="button">></button>
                                          <button class="btn btn-white" type="button">今日</button>
                                        </div>
                                        <span>2015 / 07</span>
                                      </th>
                                    </tr>
                                    <tr class="t-first">
                                      <th class="row1">日</th>
                                      <th class="row1">曜日</th>
                                      <th class="row2">イベント名</th>
                                      <th class="row3">開始時間</th>
                                      <th class="row3">終了時間</th>
                                      <th class="row3">定員数</th>
                                      <th class="row3">申込数</th>
                                      <th class="row3">申込済</th>
                                      <th class="row3">候補者キャ
                                        ンセル</th>
                                        <th class="row3">主催者キャ
                                          ンセル
                                        </th>
                                        <th class="row3">参加済</th>
                                        <th class="row3">無断欠席</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>1</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#">リクナビ就職フェア</a></td>
                                        <td>10:00</td>
                                        <td>18:00</td>
                                        <td>20</td>
                                        <td><a href="#">20</a></td>
                                        <td>19</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>19</td>
                                        <td>1</td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#">リクナビ就職フェア</a></td>
                                        <td>10:00</td>
                                        <td>18:00</td>
                                        <td>20</td>
                                        <td><a href="#">20</a></td>
                                        <td>20</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>19</td>
                                        <td>1</td>
                                      </tr>
                                      <tr>
                                        <td>2</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>3</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>4</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>5</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#">社会社説明会</a></td>
                                        <td>10:00</td>
                                        <td>18:00</td>
                                        <td>20</td>
                                        <td><a href="#">15</a></td>
                                        <td>15</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>15</td>
                                        <td>0</td>
                                      </tr>
                                      <tr>
                                        <td>6</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>7</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>8</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>9</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#">インターン研修</a></td>
                                        <td>10:00</td>
                                        <td>18:00</td>
                                        <td>20</td>
                                        <td><a href="#">8</a></td>
                                        <td>19</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>19</td>
                                        <td>1</td>
                                      </tr>
                                      <tr>
                                        <td>10</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#">リクナビ就職フェア</a></td>
                                        <td>10:00</td>
                                        <td>18:00</td>
                                        <td>20</td>
                                        <td><a href="#">20</a></td>
                                        <td>19</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>19</td>
                                        <td>1</td>
                                      </tr>
                                      <tr>
                                        <td>11</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#">インターン研修</a></td>
                                        <td>10:00</td>
                                        <td>18:00</td>
                                        <td>20</td>
                                        <td><a href="#">20</a></td>
                                        <td>19</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>19</td>
                                        <td>1</td>
                                      </tr>
                                      <tr>
                                        <td>12</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#">インターン研修</a></td>
                                        <td>10:00</td>
                                        <td>18:00</td>
                                        <td>20</td>
                                        <td><a href="#">20</a></td>
                                        <td>19</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>19</td>
                                        <td>1</td>
                                      </tr>
                                      <tr>
                                        <td>13</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#">インターン研修</a></td>
                                        <td>10:00</td>
                                        <td>18:00</td>
                                        <td>20</td>
                                        <td><a href="#">20</a></td>
                                        <td>19</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>19</td>
                                        <td>1</td>
                                      </tr>
                                      <tr>
                                        <td>14</td>
                                        <td>日</td>
                                        <td><a href="#"></a></td>
                                        <td class="tr-align-left padding-left-2"></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>15</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#">リクナビ就職フェア</a></td>
                                        <td>10:00</td>
                                        <td>18:00</td>
                                        <td>20</td>
                                        <td><a href="#">20</a></td>
                                        <td>19</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>19</td>
                                        <td>1</td>
                                      </tr>
                                      <tr class="t-first">
                                        <td>16</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-8">（今日）</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>17</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>18</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>19</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>20</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>21</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>22</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>23</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#">マイナビ就職フェア</a></td>
                                        <td>10:00</td>
                                        <td>18:00</td>
                                        <td>20</td>
                                        <td><a href="#">21</a></td>
                                        <td>19</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>19</td>
                                        <td>1</td>
                                      </tr>
                                      <tr>
                                        <td>24</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>25</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>26</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#">リクナビ就職フェア</a></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>27</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>28</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>29</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>30</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#">インターン研修 </a></td>
                                        <td>10:00</td>
                                        <td>18:00</td>
                                        <td>20</td>
                                        <td><a href="#">6</a></td>
                                        <td>19</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>19</td>
                                        <td>1</td>
                                      </tr>
                                      <tr>
                                        <td>31</td>
                                        <td>日</td>
                                        <td class="tr-align-left padding-left-2"><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="#"></a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                    </tbody>
                                    <thead>
                                      <tr class="t-first">
                                        <th>日</th>
                                        <th>曜日</th>
                                        <th>イベント名</th>
                                        <th>開始時間</th>
                                        <th>終了時間</th>
                                        <th>定員数</th>
                                        <th>申込数</th>
                                        <th>申込済</th>
                                        <th>候補者キャ
                                          ンセル</th>
                                          <th>主催者キャ
                                            ンセル
                                          </th>
                                          <th>参加済</th>
                                          <th>無断欠席</th>
                                        </tr>
                                        <tr class="t-header">
                                          <th colspan="12">
                                            <div class="l-btn">
                                              <button class="btn btn-white" type="button"><</button>
                                              <button class="btn btn-white" type="button">></button>
                                              <button class="btn btn-white" type="button">今日</button>
                                            </div>
                                            <span>2015 / 07</span>
                                          </th>
                                        </tr>
                                      </thead>
                                    </table>
                                    <!-- end table 1-->

                                    <!-- table 2 -->
                                    <div class="table">
                                      <table>
                                        <thead>
                                          <tr class="t-header">
                                            <th colspan="12" class="tr-align-left padding-left-8">
                                              開催日時未定イベント
                                            </th>
                                          </tr>
                                          <tr class=" t-first">
                                            <th class="col-lg-5">イベント名</th>
                                            <th class="col-lg-2">ターゲット選考段階名</th>
                                            <th class="col-lg-2">ターゲット選考段階比較タイプ</th>
                                            <th class="col-lg-3">求人票のタイトル</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="col-lg-5"><a href="#">自社会社説明会</a></td>
                                            <td class="col-lg-2"></td>
                                            <td class="col-lg-2"></td>
                                            <td class="col-lg-3"></td>
                                          </tr>
                                          <tr>
                                            <td class="col-lg-5"><a href="#">自社会社説明会</a></td>
                                            <td class="col-lg-2"></td>
                                            <td class="col-lg-2"></td>
                                            <td class="col-lg-3"></td>
                                          </tr>
                                          <tr>
                                            <td class="col-lg-5"><a href="#">自社会社説明会</a></td>
                                            <td class="col-lg-2"></td>
                                            <td class="col-lg-2"></td>
                                            <td class="col-lg-3"></td>
                                          </tr>
                                          <tr>
                                            <td class="col-lg-5"><a href="#">自社会社説明会</a></td>
                                            <td class="col-lg-2"></td>
                                            <td class="col-lg-2"></td>
                                            <td class="col-lg-3"></td>
                                          </tr>
                                        </tbody>
                                        <thead>
                                         <tr class=" t-first">
                                          <th class="col-lg-5">イベント名</th>
                                          <th class="col-lg-2">ターゲット選考段階名</th>
                                          <th class="col-lg-2">ターゲット選考段階比較タイプ</th>
                                          <th class="col-lg-3">求人票のタイトル</th>
                                        </tr>
                                      </thead>
                                    </table>
                                  </div>
                                  <!-- end table 2 -->
                                </div>
                              </div>
                              <!--end content-->

                              <br>
                              <br>              

                              <div class='clearfix'></div>
                              <div class="footer">
                                <div>
                                  <strong>Copyright</strong>© enjin
                                </div>
                              </div>
                            </div>
                            <!-- endcontent -->
                          </div>
                        </div>


                      </body>

                      </html>
