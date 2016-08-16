<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset('utf-8'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>求人票管理 − 求人詳細</title>

    <!-- css -->
    <?php echo $this->Html->css('bootstrap/animate'); ?>
    <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
    <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
    <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
    <?php echo $this->Html->css('bootstrap/style'); ?>
    <?php echo $this->Html->css('enjin/global'); ?>
    <!-- css -->
</head>

<body class='morejob'>

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








        <!---------------------------copy this content------------------->
        <!---------------------------header------------------------------>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>
                    <button class="btn btn-sm btn-white">
                        &lt; 戻る
                    </button>
                    求人票詳細｜ ID123456 2016年度新卒・営業募集
                </h2>
            </div>
        </div>
        <!---------------------------end header------------------------------>
        <!---------------------------content------------------------------>
        <div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
            <div class='full-content'>
                <!-- left view data -->
                <div class='col-lg-8'>
                    <div class='ibox'>
                        <div class="ibox-title">
                            <h5>求人票詳細</h5>
                            <div class="ibox-tools hover-button">
                                <a href="" type="button" class="cl-white btn btn-primary btn-xs">編集</a>
                            </div>
                        </div>
                        <!--display info content-->
                        <div class='ibox-content bg-white p-sm'>
                            <form method="get" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">タイトル</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none">2016年度新卒・営業募集</div>
                                    </div>
                                </div>
                                <!-- textarea -->
                                <div class="form-group"><label class="col-sm-4 control-label">募集要項</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none mul-text">【職種/仕事内容】
                                            お客様の比率は
                                            ［新規開拓2：既存顧客8］
                                            既存のお客様をフォローするのが
                                            メインのお仕事になります｡
                                            ＜仕事の一日の流れ＞
                                            8:15～ 社員全員で朝礼
                                            9:00～ エリア担当ごとで情報交換､共有
                                            9:30～ 営業先へ一日10件程度訪問
                                            17:30～18:00 帰社OR直帰（お客様先による）
                                            【勤務地】
                                            〒107- 0052 東京都港区赤坂1丁目14-5 アークヒルズエグゼクティブタワー S701
                                            【アクセス】
                                            都営地下鉄南北線・東京メトロ銀座線
                                            溜池山王駅出口13から徒歩7分
                                            都営地下鉄南北線
                                            六本木一丁目出口3から徒歩5分
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">職種タイプ</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none">営業</div>
                                    </div>
                                </div>
                                <!-- textarea -->
                                <div class="form-group"><label class="col-sm-4 control-label">待遇</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none mul-text">【勤務時間】
                                            8:15～17:00
                                            【給与】
                                            月給21万円以上
                                            【休日休暇】
                                            週休2日（隔週土）･日･祝･夏季､
                                            GW､年末年始･年一回創立記念
                                            【待遇・福利厚生】
                                            昇給有､賞与年2回､社保完備､
                                            交通費規定内支給､配偶者手当､
                                            子ども手当､残業手当
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">応募資格</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none">2016年度4月に新卒の資格を持っているもの</div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">募集人数</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none">2人</div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">応募期限</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none">2015/09/30</div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">公開開始日時</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none">2016/06/01</div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">募集エリアID</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none">港区</div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">募集年度</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none">2016年</div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">リリククナナビビID</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none">-</div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">ママイイナナビビID </label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none">-</div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">リクナビID</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none">マイナビID</div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">最終更新担当者</label>
                                    <div class="col-sm-8">
                                        <div class="form-control border-none"><a class='text-navy' href="">宮崎 範浩</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end display info content-->
                    </div>
                </div>
                <!-- end left view data  -->
                <!-- right data select -->
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>求人担当者登録</h5>
                        </div>
                        <!--table right 1-->
                        <div class="ibox-content clearfix p-sm">
                            <div class=''>
                                <div class="table-border">
                                    <table class="table table-bordered no-margin-bottom">
                                        <thead>
                                        <tr>
                                            <th>求人担当者名</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><a class='text-navy' href="">宮崎 範浩</a></td>
                                        </tr>
                                        <tr>
                                            <td><a class='text-navy' href="">高橋 紗季</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--end table right 1-->
                        <!--table right 2-->
                        <div class="ibox-content clearfix p-sm mtop_20">
                            <div class=''>
                                <div class="table-border">
                                    <table class="table table-bordered no-margin-bottom">
                                        <thead>
                                        <tr>
                                            <th>登録イベント名</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><a class='text-navy' href="">2016年新卒就職相談フェア</a></td>
                                        </tr>
                                        <tr>
                                            <td><a class='text-navy' href="">就活ナビ主催 新卒ミーティング2016−2017</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--end table right 2-->
                    </div>
                </div>
                <!-- end right data select -->
            </div>
        </div>
        <!---------------------------end content-------------------------->
        <div class='clearfix'></div>
        <!--button back footer-->
        <div class="row wrapper border-bottom white-bg page-footer clearfix">
            <div class="col-lg-10">
                <h2>
                    <button class="btn btn-sm btn-white">
                        &lt; 戻る
                    </button>
                </h2>
            </div>
        </div>
        <!--end button back footer-->
        <!---------------------------end copy this content------------------->





        <!-- footer -->
        <div class='clearfix'></div>
        <div class="footer">
            <div>
                <strong>Copyright</strong>© enjin
            </div>
        </div>
        <!-- end footer -->

    </div>
</div>

</body>

</html>
