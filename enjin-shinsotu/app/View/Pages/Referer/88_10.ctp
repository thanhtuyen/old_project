<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>候補者管理 − 候補者詳細</title>


  <!-- css -->
  <?php echo $this->Html->css('bootstrap/bootstrap.min.css'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome.css'); ?>
  <?php echo $this->Html->css('bootstrap/animate.css'); ?>
  <?php echo $this->Html->css('bootstrap/style.css'); ?>
  <?php echo $this->Html->css('enjin/candidatesdetails.css'); ?>
  <?php echo $this->Html->css('enjin/global.code'); ?>
  <?php echo $this->Html->css('enjin/global.group'); ?>
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
  <div id="wrapper" class="page-edit">
    <nav class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
          <li class="nav-header">
            <div class="dropdown profile-element">
              <span>
                <img src="/enjin_main/enjin-shinsotu/img/bootstrap/profile_small.jpg" class="img-circle" alt="">                </span>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David
                    Williams</strong>
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

        <div id="page-wrapper" class="gray-bg" style="min-height: 218px;">
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
          <!------------------ title content -------------------------->


          <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
              <h2>
                <button class="btn btn-sm btn-white">
                  &lt; 戻る
                </button>
                候補者情報 ｜ 01234556 田中 太朗
              </h2>
            </div>
          </div>


          <!------------------  content -------------------------->
          <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
            <div class="content">

              <div class="plist-two-layout">

                <div class="col-lg-8">
                  <div class="ibox">

                    <div class="ibox-title">
                      <h5>候補者情報</h5>
                      <div class="ibox-tools">
                        <button type="button" class="btn btn-primary btn-xs">編集</button>
                      </div>
                    </div>

                    <div class="ibox-content bg-white p-sm">
                      <div class="">
                        <div class="tabs-container">
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">基本データ</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">付随データ</a></li>
                          </ul>
                          <div class="tab-content">
                            <div id="tab-2" class="tab-pane">
                              <div class="panel-body pd-bottom-none form-info">

                                <div class="">
                                  <h5>提出書類1</h5>
                                </div>

                                <div class="ibox-content bg-white p-sm pd-right-none">
                                  <form method="get" class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-4 control-label">ファイル</label>

                                      <div class="col-sm-8">
                                        <div class="form-control border-none"><a class="text-navy" href="">田中太朗_提出書類.txt</a>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                                <div class="">
                                  <h5>語学</h5>
                                </div>

                                <div class="ibox-content bg-white p-sm pd-right-none">
                                  <form method="get" class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-4 control-label">言語</label>

                                      <div class="col-sm-8">
                                        <div class="form-control border-none">スワヒリ語</div>
                                      </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-4 control-label">レベル</label>

                                      <div class="col-sm-8">
                                        <div class="form-control border-none">10</div>
                                      </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-4 control-label">海外在住年数</label>

                                      <div class="col-sm-8">
                                        <div class="form-control border-none">2年</div>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                                <div class="">
                                  <h5>特記事項</h5>
                                </div>

                                <div class="ibox-content bg-white p-sm pd-right-none">
                                  <form method="get" class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-4 control-label">コメント</label>

                                      <div class="col-sm-8">
                                        <div class="form-control border-none h-auto">
                                          海外青年協力隊での功績が認められ、東アフリカより特別市民権を与えられている
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-4 control-label">コメンテーター</label>

                                      <div class="col-sm-8">
                                        <div class="form-control border-none"><a class="text-navy" href="">最要 担当朗</a></div>
                                      </div>
                                    </div>
                                  </form>
                                </div>


                                <div class="">
                                  <h5>候補者カスタム属性</h5>
                                </div>

                                <div class="ibox-content bg-white p-sm pd-right-none">
                                  <form method="get" class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-4 control-label">関連会社</label>

                                      <div class="col-sm-8">
                                        <div class="form-control border-none">バイト経験あり</div>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                                <div class="">
                                  <h5>資格</h5>
                                </div>

                                <div class="ibox-content bg-white p-sm pd-right-none">
                                  <form method="get" class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-4 control-label">資格</label>

                                      <div class="col-sm-8">
                                        <div class="form-control border-none">介護ヘルパー2級</div>
                                      </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-4 control-label">スコア</label>

                                      <div class="col-sm-8">
                                        <div class="form-control border-none">80</div>
                                      </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-4 control-label">取得年月</label>

                                      <div class="col-sm-8">
                                        <div class="form-control border-none">2015/04</div>
                                      </div>
                                    </div>
                                  </form>
                                </div>


                                <div class="">
                                  <h5>学歴</h5>
                                </div>

                                <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                                  <form method="get" class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-4 control-label">学校</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">国立AA大学</div>
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">学部</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">経済学部</div>
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">学科名</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">経営学科</div>
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">学生申請文理区分</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">文系</div>
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">管理用文理区分</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">文系</div>
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">ゼミ</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">現代経済</div>
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">専攻テーマ</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">現代経済</div>
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">サークル</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">旅と鉄道研究会</div>
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">入学年月</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">2012/04</div>
                                      </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-4 control-label">卒業(予定)年月</label>
                                      <div class="col-sm-8">
                                        <div class="form-control border-none">2016/03</div>
                                      </div>
                                    </div>

                                  </form>
                                </div>
                              </div>
                            </div>

                            <div id="tab-1" class="tab-pane active">
                              <div class="panel-body pd-bottom-none form-edit p-sm">
                                <div class="ibox no-margin-bottom">
                                  <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                                    <form method="get" class="form-horizontal">

                                      <div class="form-group">
                                        <label class="col-sm-4 control-label ppt0">氏名</label>
                                        <div class="col-sm-8 text">
                                          <span>田中 太朗</span>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-sm-4 control-label ppt0">name</label>
                                        <div class="col-sm-8 text">
                                          <span>Taro Tanaka</span>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-sm-4 control-label ppt0">フリガナ</label>
                                        <div class="col-sm-8 text">
                                          <span>タ カ ナ タ ロ ウ</span>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-sm-4 control-label avata-text-medium">顔写真URL</label>
                                        <div class="col-sm-8 text">
                                          <img src="/enjin-shinsotu/img/bootstrap/icon_avatar.png" alt="logo" width="70px" height="70px"><br>
                                          <a href="#" class="text-navy">http://facebook.com/0477234/ip/img/photo1
                                            id=0477234</a>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">メールアドレス</label>
                                          <div class="col-sm-8 text">
                                            <span class="text-navy">t-taro1234＠gmail.com</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">電話番号</label>
                                          <div class="col-sm-8 text">
                                            <span>&nbsp;</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">携帯電話番号</label>
                                          <div class="col-sm-8 text">
                                            <span>0901111xxxx</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">携帯メールアドレス</label>
                                          <div class="col-sm-8 text">
                                            <span class="text-navy">t-taro1234＠docomobank.au</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">居住国</label>
                                          <div class="col-sm-8 text">
                                            <span>日本</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">郵便番号</label>
                                          <div class="col-sm-8 text">
                                            <span>1800001</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">都道府県</label>
                                          <div class="col-sm-8 text">
                                            <span>東京都</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">居住地</label>
                                          <div class="col-sm-8 text">
                                            <span>港区赤坂1−14−5</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">帰省先国</label>
                                          <div class="col-sm-8 text">
                                            <span>日本</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">帰省先郵便番号</label>
                                          <div class="col-sm-8 text">
                                            <span>3300074</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">帰省先都道府県</label>
                                          <div class="col-sm-8 text">
                                            <span>埼玉県</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">帰省先居住地</label>
                                          <div class="col-sm-8 text">
                                            <span>さいたま市浦和区北浦和1-21-18</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">帰省先電話番号</label>
                                          <div class="col-sm-8 text">
                                            <span>048-834-xxxx</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">生年月日</label>
                                          <div class="col-sm-8 text">
                                            <span>1993年4月10日</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">性別</label>
                                          <div class="col-sm-8 text">
                                            <span>男性</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">所属グループ</label>
                                          <div class="col-sm-8 text">
                                            <span>-</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">流入元企業ID</label>
                                          <div class="col-sm-8 text">
                                            <span><a href="">COID00001</a></span>
                                          </div>
                                        </div>



                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">流入元契約名</label>
                                          <div class="col-sm-8 text">
                                            <span><a href="">流入元契約</a></span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-sm-4 control-label ppt0">入社可能年月</label>
                                          <div class="col-sm-8 text">
                                            <span>2016年4月</span>
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
                    <div class="ibox ">

                      <div class="ibox-title">
                        <h5>求人票一覧</h5>
                      </div>

                      <div class="ibox-content clearfix p-sm">

                        <h5><a class="text-navy" href="">2016年新卒・営業</a></h5>

                        <table class="table table-bordered sb-3">
                          <tbody>
                            <tr>
                              <th>選考段階</th>
                              <td>2次選考</td>
                            </tr>
                            <tr>
                              <th>選考ステータス</th>
                              <td>合格</td>
                            </tr>                               
                          </tbody>
                        </table>




                        <h5><a class="text-navy" href="">201 6年新卒・一般</a></h5>


                        <table class="table table-bordered subcontents-sb-1">
                          <tbody>
                            <tr>
                              <th>選考段階</th>
                              <td>書類選考</td>
                            </tr>
                            <tr>
                              <th>選考ステータス</th>
                              <td>不合格</td>
                            </tr>                               
                          </tbody>
                        </table>


                      </div>
                      <div class="ibox-content clearfix bg-sl-btn pd-9">
                        <table class="table no-margin-bottom">
                          <tbody>
                            <tr>
                              <td class="no-borders ver-mid btn-group btn-block">
                                <select class="btn btn-white btn-sm  btn-block">
                                  <option>求人票選択1</option>
                                  <option>求人票選択2</option>
                                  <option>求人票選択3</option>
                                </select>
                              </td>
                              <td class="no-borders ver-mid">
                                <button class="full-width btn btn-primary btn-sm">追加</button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="ibox ">
                      <div class="ibox-title">
                        <h5>イベント参加履歴</h5>
                      </div>
                      <div class="ibox-content clearfix p-sm pd-bottom-none">
                        <div class="ibox no-margin-bottom">
                          <div class="pd-none-left clearfix mrb15">
                            <h5 class="mrt0"><a class="text-navy custom-fr14-magrin" href="">2016年新卒就職フェア</a></h5>

                            <div class="ibox-tools mrt-12">
                              <a class="close-link">
                                <i class="fa fa-times"></i>
                              </a>
                            </div>
                          </div>
                          <div class="bg-white p-sm custom-padding">
                            <div class="row">
                              <table class="table table-bordered sb-3 no-margin-bottom table-event">
                                <tbody>
                                  <tr>
                                    <td class="col-sm-4">開催日時

                                    </td><td class="col-sm-8">2015/07/30 12:00</td>
                                  </tr>
                                  <tr>
                                    <td>参加ステータス

                                    </td><td>
                                    <div class="no-borders ver-mid btn-group btn-block">
                                      <select class="btn btn-white btn-sm  btn-block custom-color-select">
                                        <option>参加済</option>
                                        <option>参加済</option>
                                        <option>参加済</option>
                                      </select>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>ファイル</td>
                                  <td><a class="text-navy" href="">アンケート.xlsx <br> チェックシート.jpg</a></td>
                                </tr>
                                <tr>
                                  <td>評価</td>
                                  <td>80</td>
                                </tr>
                                <tr>
                                  <td>コメント</td>
                                  <td>受講態度良し、提出書類も高評価</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="ibox no-margin-bottom">
                        <div class="pd-none-left clearfix">
                          <h5 class="mrt0"><a class="text-navy custom-fr14-magrin" href="">201 6年新卒・一般</a></h5>

                          <div class="ibox-tools mrt-12 mrb15">
                            <a class="close-link">
                              <i class="fa fa-times"></i>
                            </a>
                          </div>
                        </div>
                        <div class="bg-white custom-padding">
                          <div class="row">
                            <table class="table table-bordered sb-3 no-margin-bottom table-event">
                              <tbody>
                                <tr>
                                  <td class="col-sm-4">開催日時

                                  </td><td class="col-sm-8">2015/07/30 12:00</td>
                                </tr>
                                <tr>
                                  <td>参加ステータス

                                  </td><td>
                                  <div class="no-borders ver-mid btn-group btn-block">
                                    <select class="btn btn-white btn-sm  btn-block custom-color-select">
                                      <option>参加済</option>
                                      <option>参加済</option>
                                      <option>参加済</option>
                                    </select>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>ファイル</td>
                                <td><a class="text-navy" href="">アンケート.xlsx <br>チェックシート.jpg</a></td>
                              </tr>
                              <tr>
                                <td>評価</td>
                                <td>80</td>
                              </tr>
                              <tr>
                                <td>コメント</td>
                                <td>受講態度良し、提出書類も高評価</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="ibox-content clearfix bg-sl-btn pd-9">
                    <table class="table no-margin-bottom">
                      <tbody>
                        <tr>
                          <td class="no-borders ver-mid btn-group btn-block">
                            <select class="btn btn-white btn-sm  btn-block">
                              <option>イベント名 2015/08/01 12:00~</option>
                              <option>イベント名 2015/08/01 12:00~</option>
                              <option>イベント名 2015/08/01 12:00~</option>
                            </select>
                          </td>
                          <td class="no-borders ver-mid">
                            <button class="full-width btn btn-primary btn-sm">追加</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!------------------  end content -------------------------->
                  <!------------------  end content -------------------------->
                </div>
                <!-- end content -->
              </div>
            </div>
          </div>
        </div>

        <div class="row wrapper border-bottom white-bg page-heading clearfix">
          <div class="col-lg-10">
            <h2>
              <button class="btn btn-sm btn-white">
                &lt; 戻る
              </button>
            </h2>
          </div>
        </div>
        <br>
        <br>

        <div class="clearfix"></div>
        <div class="footer">
          <div>
            <strong>Copyright</strong>© enjin
          </div>

        </div>
      </div>
    </div>
  </body>
  </html>
