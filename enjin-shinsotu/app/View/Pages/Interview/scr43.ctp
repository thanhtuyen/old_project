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
    <?php echo $this->Html->css('enjin/master'); ?>
    <!-- css -->
    <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
    <?php echo $this->Html->script('bootstrap.min.js'); ?>
    <?php echo $this->Html->script('inspinia');?>
    <?phpe cho $this->Html->script('jquery-2.1.1');?>
    <?php echo $this->Html->script('jquery-ui.custom.min');?>
    <?php echo $this->Html->script('jquery.tmpl');?>
    <?php echo $this->Html->script('bootstrap.min');?>
    <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu');?>
    <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min');?>

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
                    選考履歴｜1234567 田中 太朗
                </h2>
            </div>
        </div>
        <!---------------------------end header------------------------------>
        <!---------------------------content------------------------------>
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
                                            <li class="">
                                                <a data-toggle="tab" href="#tab-1" aria-expanded="false">書類選考</a>
                                            </li>
                                            <li class="">
                                                <a data-toggle="tab" href="#tab-2" aria-expanded="false">1次選考</a>
                                            </li>
                                            <li class="active">
                                                <a data-toggle="tab" href="#tab-3" aria-expanded="true">2次選考</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="tab-1" class="tab-pane active">
                                                <div class="mrb15 mrt15">
                                                    <h5>提出書類1</h5>
                                                </div>
                                                <div class="pd-bottom-none form-edit">
                                                    <div class="ibox no-margin-bottom">
                                                        <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                                                            <form method="get" class="form-horizontal">

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">選考履歴ID</label>
                                                                    <div class="col-sm-8 text">
                                                                        <span>1234567</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">候補者名</label>
                                                                    <div class="col-sm-8 text">
                                                                        <a href="#">田中 太朗</a>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">候補者ID</label>
                                                                    <div class="col-sm-8 text">
                                                                        <a href="#">987654</a>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">選考段階名</label>
                                                                    <div class="col-sm-8 text">
                                                                        <span>２次面接</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">選考ステータス</label>
                                                                    <div class="col-sm-8 text">
                                                                        <select class="form-control" style="width: 100px;">
                                                                            <option>合格</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">選考開始予定日時</label>
                                                                    <div class="col-sm-8 text">
                                                                        <span>YYYY / MM / D D H H : SS</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">選考終了予定日時</label>
                                                                    <div class="col-sm-8 text">
                                                                        <span>y y y y / mm / dd hh : s s</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">求人票ID</label>
                                                                    <div class="col-sm-8 text">
                                                                        <a href="#">ABC123456</a>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">求人票タイトル</label>
                                                                    <div class="col-sm-8 text">
                                                                        <span>求人票タイトル</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">選考ステータスオプション</label>
                                                                    <div class="col-sm-8 text">
                                                                        <span>オプション内容</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">掲示年収</label>
                                                                    <div class="col-sm-8 text">
                                                                        <span>400万円</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">コメント</label>
                                                                    <div class="col-sm-8 text">
                                                                        <span>選考履歴に対する、コメント＆メモ</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">訪問先情報</label>
                                                                    <div class="col-sm-8 text">
                                                                        <span>訪問先情報</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">
                                                                        流入元企業への<br />
                                                                        選考ステータスの公開可否
                                                                    </label>
                                                                    <div class="col-sm-8 text">
                                                                        <span>ON</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">
                                                                            流入元企業への<br />
                                                                            選考ステータスの公開可否
                                                                    </label>
                                                                    <div class="col-sm-8 text">
                                                                        <span>OFF</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">最終更新者タイプ</label>
                                                                    <div class="col-sm-8 text">
                                                                        <span>採用担当者</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label pt0">最終更新流入元担当者ID</label>
                                                                    <div class="col-sm-8 text">
                                                                        <a href="#">mynavi12345678</a>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="btn-clear">
                                                                        <input type="button" value="削除" class="btn btn-primary w-95 h-34 m-r-25" />
                                                                        <input type="button" value="更新" class="btn btn-primary w-95 h-34" />
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

                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>最終選考採用担当者</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content clearfix p-sm pd-bottom-none">
                                <h5>面接官（採用担当者）選考履歴</h5>
                                <div class="ibox no-margin-bottom">
                                    <div class="bg-white p-sm custom-padding">
                                        <div class="row">
                                            <table class="table table-bordered no-margin-bottom">

                                                <thead>
                                                <tr>
                                                    <th>採用担当者名</th>
                                                    <th>評価ランク</th>
                                                    <th class="col-lg-2">評価スコア</th>
                                                    <th>評価コメント</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <tr class="kitem-edit0">
                                                    <td><a href="/enjin_main/new-enjin/RecRecruiters/view/1" class="text-navy">採用 太郎</a>                                        </td>
                                                    <td>
                                                        <select name="data[eval_rank]" class="form-control select-w100" id="eval_rank">
                                                            <option value=""></option>
                                                            <option value="0">保留</option>
                                                            <option value="1">合格</option>
                                                            <option value="9">不合格</option>
                                                        </select>                                        </td>
                                                    <td><div class="input number"><input name="data[evaluation_score]" class="form-control" type="number" value="" id="evaluation_score"></div></td>
                                                    <td><div class="input "><input name="data[evaluation_comment]" class="form-control" type="" value="" id="evaluation_comment"></div>                                        </td>
                                                    <td>
                                                        <div class="margin-lf10">
                                                            <div class="hidden assign-situation-id" data-id="2"></div>
                                                            <div class="float-lf margin-right5">
                                                                <button class="full-width btn btn-xs btn-primary kbt-update" data-order="0" data-id="1">更新</button></div>
                                                            <div class="float-lf">
                                                                <button class="full-width btn btn-xs btn-primary kbt-delete" id="selRecDelete" data-id="1">解除</button></div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr class="kitem-hide kitem-view0" style="display: none;">
                                                    <td><a href="/enjin_main/new-enjin/RecRecruiters/view/1" class="text-navy">採用 太郎</a></td>
                                                    <td class="eval_rank"></td>
                                                    <td class="eval_score">
                                                    </td>
                                                    <td class="eval_comment"></td>
                                                    <td>
                                                        <div class="margin-lf10">
                                                            <div class="hidden assign-situation-id" data-id="2"></div>
                                                            <div class="float-lf margin-right5">
                                                                <button class="full-width btn btn-xs btn-primary kbt-edit" data-order="0" data-id="1">修正</button></div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><a href="/enjin_main/new-enjin/RecRecruiters/view/2" class="text-navy">採用 次郎</a></td>
                                                    <td></td>
                                                    <td>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!------------------  end content -------------------------->
                            <!------------------  end content -------------------------->
                        </div>
                    </div>
                    <!--layout right-->
                    <div class="col-lg-4">
                        <div class="ibox ">

                            <div class="ibox-title">
                                <h5>求人票情報</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="ibox-content clearfix p-sm pd-bottom-none">
                                <div class="bg-white custom-padding">
                                    <div class="row">
                                        <table class="table table-bordered sb-3 no-margin-bottom table-event">
                                            <tbody>
                                            <tr>
                                                <td class="col-sm-4">選考段階</td>
                                                <td class="col-sm-8">ABC123456</td>
                                            </tr>
                                            <tr>
                                                <td>求人票タイトル</td>
                                                <td>求人票タイトル</td>
                                            </tr>
                                            <tr>
                                                <td>募集要項</td>
                                                <td>仕事の内容を掲載</td>
                                            </tr>
                                            <tr>
                                                <td>職種タイプ</td>
                                                <td>営業</td>
                                            </tr>
                                            <tr>
                                                <td>初任給</td>
                                                <td>24万円</td>
                                            </tr>
                                            <tr>
                                                <td>待遇</td>
                                                <td>待遇内容を掲載</td>
                                            </tr>
                                            <tr>
                                                <td>応募資格</td>
                                                <td>応募資格を掲載</td>
                                            </tr>
                                            <tr>
                                                <td>募集人数</td>
                                                <td>10人</td>
                                            </tr>
                                            <tr>
                                                <td>募集期限</td>
                                                <td>YYYY / MM / D D</td>
                                            </tr>
                                            <tr>
                                                <td>公開開始日時</td>
                                                <td>y y y y / mm / dd hh:mm</td>
                                            </tr>
                                            <tr>
                                                <td>募集エリア</td>
                                                <td>エリア名</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>自社情報</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content clearfix p-sm pd-bottom-none">
                                <div class="ibox no-margin-bottom">
                                    <div class="bg-white p-sm custom-padding">
                                        <div class="row">
                                            <table class="table table-bordered sb-3 no-margin-bottom table-event">
                                                <tbody>
                                                <tr>
                                                    <td class="col-sm-4">企業名</td>
                                                    <td class="col-sm-8">株式会社ネオネオ</td>
                                                </tr>
                                                <tr>
                                                    <td>都道府県</td>
                                                    <td>東京都</td>
                                                </tr>
                                                <tr>
                                                    <td>市区町村</td>
                                                    <td>新宿区</td>
                                                </tr>
                                                <tr>
                                                    <td>契約期間</td>
                                                    <td>2017 / 11 / 30</td>
                                                </tr>
                                                <tr>
                                                    <td>設立年月日</td>
                                                    <td>2000年11月</td>
                                                </tr>
                                                <tr>
                                                    <td>従業員数</td>
                                                    <td>200人</td>
                                                </tr>
                                                <tr>
                                                    <td>売上高</td>
                                                    <td>100,000,000円</td>
                                                </tr>
                                                <tr>
                                                    <td>業種</td>
                                                    <td>IT・通信・インターネット</td>
                                                </tr>
                                                <tr>
                                                    <td>市場</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>備考</td>
                                                    <td></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!------------------  end content -------------------------->
                            <!------------------  end content -------------------------->
                        </div>
                        <!-- end content -->
                    </div>
                </div>
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
