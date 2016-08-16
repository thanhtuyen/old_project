<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application management</title>

    <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
    <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
    <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
    <?php echo $this->Html->css('plugins/switchery/switchery'); ?>
    <?php echo $this->Html->css('bootstrap/animate'); ?>
    <?php echo $this->Html->css('bootstrap/style'); ?>
    <?php echo $this->Html->css('enjin/global'); ?>
    <?php echo $this->Html->css('enjin/email'); ?>
    <?php echo $this->Html->css('enjin/02_selection.css'); ?>
    <?php echo $this->Html->css('plugins/dataTables/dataTables.bootstrap'); ?>
    <?php echo $this->Html->css('plugins/dataTables/dataTables.responsive'); ?>
    <?php echo $this->Html->css('plugins/dataTables/dataTables.tableTools.min'); ?>

</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
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
                        <img src="/enjin_main/enjin-shinsotu/img/bootstrap/logo_enjin.png" alt="logo">                </div>
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
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 row">
                <h2>選考管理｜ 選考履歴一覧</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content row animated fadeInRight clearfix">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>選考履歴サマリ</h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <h3>求人票名を 表示</h3>

                        <div class="table-responsive">
                            <table class="table table-bordered white-bg">
                                <tbody>
                                <tr>
                                    <th class="cl-bg-f5f">選考段階</th>
                                    <th colspan="3" class="cl-bg-f5f">書類選考</th>
                                    <th colspan="3" class="cl-bg-f5f">1次選考</th>
                                    <th colspan="3" class="cl-bg-f5f">2 次選考</th>
                                    <th colspan="3" class="cl-bg-f5f">3 次次選</th>
                                    <th colspan="3" class="cl-bg-f5f">4 次選考</th>
                                    <th colspan="3" class="cl-bg-f5f">最終選考</th>
                                </tr>
                                <tr>
                                    <th rowspan="3" class="cl-bg-f5f td-vertical-align">目標</th>
                                    <td colspan="9" class="cl-bg-f9f">5月 1 日 ま でに2次選考以下の 合格者を 50名 現在50名</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="12" class="bg_pink text-white cl-bg-f55">5月 3日 ま でに
                                        3次選考以上の合格者を 30 名 現在20名
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">5/10 までに最終選考の合格<br>
                                        者を５名<span class="color_red">現在０名</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan="2" class="cl-bg-f5f td-vertical-align">実数</th>
                                    <th class="cl-bg-f9f">合格</th>
                                    <th class="cl-bg-f9f">不合格</th>
                                    <th class="cl-bg-f9f">その他</th>
                                    <th class="cl-bg-f9f">合格</th>
                                    <th class="cl-bg-f9f">不合格</th>
                                    <th class="cl-bg-f9f">その他</th>
                                    <th class="cl-bg-f9f">合格</th>
                                    <th class="cl-bg-f9f">不合格</th>
                                    <th class="cl-bg-f9f">その他</th>
                                    <th class="cl-bg-f9f">合格</th>
                                    <th class="cl-bg-f9f">不合格</th>
                                    <th class="cl-bg-f9f">その他</th>
                                    <th class="cl-bg-f9f">合格</th>
                                    <th class="cl-bg-f9f">不合格</th>
                                    <th class="cl-bg-f9f">その他</th>
                                    <th class="cl-bg-f9f">合格</th>
                                    <th class="cl-bg-f9f">不合格</th>
                                    <th class="cl-bg-f9f">その他</th>
                                </tr>
                                <tr>
                                    <td class="text-cl18a">20</td>
                                    <td class="text-cl18a">10</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">20</td>
                                    <td class="text-cl18a">5</td>
                                    <td class="text-cl18a">1</td>
                                    <td class="text-cl18a">10</td>
                                    <td class="text-cl18a">7</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">10</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <h3>求人票名を 表示</h3>

                        <div class="table-responsive">
                            <table class="table table-bordered white-bg">
                                <tbody>
                                <tr>
                                    <th class="cl-bg-f5f">選考段階</th>
                                    <th colspan="3" class="cl-bg-f5f">書類選考</th>
                                    <th colspan="3" class="cl-bg-f5f">1次選考</th>
                                    <th colspan="3" class="cl-bg-f5f">2 次選考</th>
                                    <th colspan="3" class="cl-bg-f5f">3 次次選</th>
                                    <th colspan="3" class="cl-bg-f5f">4 次選考</th>
                                    <th colspan="3" class="cl-bg-f5f">最終選考</th>
                                </tr>
                                <tr>
                                    <th rowspan="3" class="cl-bg-f5f td-vertical-align">目標</th>
                                    <td colspan="9" class="cl-bg-f9f">5月 1 日 ま でに2次選考以下の 合格者を 50名 現在50名</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="12" class="bg_pink text-white cl-bg-f55">5月 3日 ま でに 3次選考以上の合格者を 40 名 現在20名
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="3">5/10 までに最終選考の合格<br>
                                        者を５名<span class="color_red">現在０名</span></td>
                                </tr>
                                <tr>
                                    <th rowspan="2" class="cl-bg-f5f td-vertical-align">実数</th>
                                    <th class="cl-bg-f5f">合格</th>
                                    <th class="cl-bg-f5f">不合格</th>
                                    <th class="cl-bg-f5f">その他</th>
                                    <th class="cl-bg-f5f">合格</th>
                                    <th class="cl-bg-f5f">不合格</th>
                                    <th class="cl-bg-f5f">その他</th>
                                    <th class="cl-bg-f5f">合格</th>
                                    <th class="cl-bg-f5f">不合格</th>
                                    <th class="cl-bg-f5f">その他</th>
                                    <th class="cl-bg-f5f">合格</th>
                                    <th class="cl-bg-f5f">不合格</th>
                                    <th class="cl-bg-f5f">その他</th>
                                    <th class="cl-bg-f5f">合格</th>
                                    <th class="cl-bg-f5f">不合格</th>
                                    <th class="cl-bg-f5f">その他</th>
                                    <th class="cl-bg-f5f">合格</th>
                                    <th class="cl-bg-f5f">不合格</th>
                                    <th class="cl-bg-f5f">その他</th>
                                </tr>
                                <tr>
                                    <td class="text-cl18a">20</td>
                                    <td class="text-cl18a">10</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">20</td>
                                    <td class="text-cl18a">5</td>
                                    <td class="text-cl18a">1</td>
                                    <td class="text-cl18a">10</td>
                                    <td class="text-cl18a">7</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">10</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                    <td class="text-cl18a">0</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="ibox ibox-bottom float-e-margins">
                    <div class="ibox-title">
                        <h5>選考履歴サマリ</h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content fr-cl">
                        <form>
                            <div class="form-group">
                                <label class="linear_inline">求人票選択</label>
                                <select class="form-control ct-select1">
                                    <option value="1">求人票選択</option>
                                    <option value="2">求人票選択</option>
                                    <option value="3">求人票選択</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                            <div class="form-group">
                                <div class="col-lg-4 row">
                                    <label class="linear_inline">選考段階</label>
                                    <select class="form-control ct-select2">
                                        <option value="1">2 次選考</option>
                                        <option value="2">3 次選考</option>
                                        <option value="3">4 次選考</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 row">
                                    <label class="linear_inline">選考ステータス</label>
                                    <select class="form-control ct-select2">
                                        <option value="1">合格</option>
                                        <option value="2">合格</option>
                                        <option value="3">合格</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 row">
                                    <label class="linear_inline">流入元企業 </label>
                                    <select class="form-control ct-select2">
                                        <option value="1">リ クナビ</option>
                                        <option value="2">リ クナビ</option>
                                        <option value="3">リ クナビ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clear"></div>

                            <div class="from_calen">
                                <label class="linear_inline">開催期間</label>

                                <div class="form-group f_left calen_left" id="data_1">
                                    <div class="input-group date">
                                <span class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </span>
                                        <input type="text" class="form-control" value="03/04/2014">
                                    </div>
                                </div>
                                <label class="linear_inline font_normal">から</label>

                                <div class="form-group f_left calen_left" id="data_1">
                                    <div class="input-group date">
                                <span class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </span>
                                        <input type="text" class="form-control" value="03/04/2014">
                                    </div>
                                </div>
                                <label class="linear_inline font_normal">ま で</label>

                                <div class="clear"></div>
                            </div>
                            <div class="from_calen">
                                <button type="button" class="btn btn-primary btn-sm">検索</button>
                                <a href="#">クリア</a>
                            </div>
                        </form>
                        <!---------------------->
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-6 margin-top-9">
                            <div class="item-gp1">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-white btn-xs dropdown-toggle w-dropdown"><span class="txt-selected">チェ ッ ク のみ</span><span class="caret pull-right"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">チェ ッ ク のみ 1</a></li>
                                        <li><a href="#">チェ ッ ク のみ 2</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="item-gp2">
                                <button type="button" class="btn btn-xs btn-white"><i class="fa fa-envelope-o"></i></button>
                                <button type="submit" class="btn btn-xs btn-white"><i class="fa fa-print"></i></button>
                            </div>
                            <div class="item-gp3">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-white btn-xs dropdown-toggle w-dropdown"><span class="txt-selected">その他</span><span class="caret pull-right"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">その他</a></li>
                                        <li><a href="#">その他 1</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!------------pagination-------------->
                        <div class="col-lg-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0"
                                        tabindex="0" id="DataTables_Table_0_previous">
                                        <a href="#">Previous</a>
                                    </li>
                                    <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0">
                                        <a href="#">1</a></li>
                                    <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                                        <a href="#">2</a>
                                    </li>
                                    <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                                        <a href="#">3</a>
                                    </li>
                                    <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                                        <a href="#">4</a>
                                    </li>
                                    <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                                        <a href="#">5</a>
                                    </li>
                                    <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                                        <a href="#">6</a>
                                    </li>
                                    <li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0"
                                        id="DataTables_Table_0_next">
                                        <a href="#">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTables-example">
                            <thead>
                            <tr>
                                <th class="fix-padding-right td-small-ss">
                                    <div class="i-checks"><label>
                                        <div class="icheckbox_square-green" style="position: relative;"><input
                                                type="checkbox" value="" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper"
                                                 style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                        </div>
                                        <i></i></label>
                                    </div>
                                </th>
                                <th class="td-small">ID</th>
                                <th class="td-medium">候補者名</th>
                                <th class="td-small">選考段階</th>
                                <th class="td-large">選考ステータス</th>
                                <th class="td-small">選考開始予定日時</th>
                                <th class="td-small">選考開始予定日時</th>
                                <th class="td-small-s">面接官数</th>
                                <th class="td-small">流入元</th>
                                <th class="td-small"> 流入元への公開</th>
                                <th class="td-small">公開候補者への公開</th>
                                <th class="td-medium">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="i-checks"><label>
                                        <div class="icheckbox_square-green" style="position: relative;"><input
                                                type="checkbox" value="" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper"
                                                 style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                        </div>
                                        <i></i></label>
                                    </div>
                                </td>
                                <td class=""><a href="#">123456</a></td>
                                <td class=""><a href="#">田 中 太朗</a></td>

                                <td>2次選考</td>
                                <td>
                                    <button class="btn btn-primary btn-xs">合格</button>
                                    <button class="btn btn-primary btn-xs">不合格</button>
                                    <button class="btn btn-primary btn-xs">その他</button>
                                </td>

                                <td>201 5年5月 1 0日 1 0:30</td>
                                <td>201 5年6月 1 0日 1 0:30</td>
                                <td class=""><a href="#">3</a></td>

                                <td>リ ク ナビ</td>
                                <td>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" class="onoffswitch-checkbox" id="example3">
                                            <label class="onoffswitch-label" for="example3">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" class="onoffswitch-checkbox" id="example2">
                                            <label class="onoffswitch-label" for="example2">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-xs">詳 細</button>
                                    <button class="btn btn-default btn-xs">削 除</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="i-checks"><label>
                                        <div class="icheckbox_square-green" style="position: relative;"><input
                                                type="checkbox" value="" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper"
                                                 style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                        </div>
                                        <i></i></label></div>
                                </td>
                                <td class=""><a href="#">223456</a></td>
                                <td class=""><a href="#">田 中 太朗</a></td>
                                <td>2次選考</td>
                                <td>合格
                                </td>
                                <td>201 5年5月 1 0日 1 0:30</td>
                                <td>201 5年6月 1 0日 1 0:30</td>
                                <td class=""><a href="#">3</a></td>
                                <td>リ ク ナビ</td>
                                <td>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" class="onoffswitch-checkbox" id="example1">
                                            <label class="onoffswitch-label" for="example1">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" class="onoffswitch-checkbox" id="example2">
                                            <label class="onoffswitch-label" for="example2">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-xs">詳 細</button>
                                    <button class="btn btn-default btn-xs">削 除</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="i-checks"><label>
                                        <div class="icheckbox_square-green" style="position: relative;"><input
                                                type="checkbox" value="" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper"
                                                 style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                        </div>
                                        <i></i></label></div>
                                </td>
                                <td class=""><a href="#">323456</a></td>
                                <td class=""><a href="#">田 中 太朗</a></td>

                                <td>2次選考</td>
                                <td>不合格</td>
                                <td>201 5年5月 1 0日 1 0:30</td>
                                <td>201 5年6月 1 0日 1 0:30</td>
                                <td class=""><a href="#">3</a></td>

                                <td>リ ク ナビ</td>
                                <td>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" class="onoffswitch-checkbox" id="example1">
                                            <label class="onoffswitch-label" for="example1">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" class="onoffswitch-checkbox" id="example2">
                                            <label class="onoffswitch-label" for="example2">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-xs">詳 細</button>
                                    <button class="btn btn-default btn-xs">削 除</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="i-checks"><label>
                                        <div class="icheckbox_square-green checked" style="position: relative;"><input
                                                type="checkbox" value="" checked=""
                                                style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper"
                                                 style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                        </div>
                                        <i></i></label></div>
                                </td>
                                <td class=""><a href="#">423456</a></td>
                                <td class=""><a href="#">田 中 太朗</a></td>
                                <td>2次選考</td>
                                <td>
                                    <button class="btn btn-primary btn-xs">合格</button>
                                    <button class="btn btn-primary btn-xs">不合格</button>
                                    <button class="btn btn-primary btn-xs">その他</button>
                                </td>
                                <td>201 5年5月 1 0日 1 0:30</td>
                                <td>201 5年6月 1 0日 1 0:30</td>
                                <td class=""><a href="#">3</a></td>
                                <td>リ ク ナビ</td>
                                <td>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" class="onoffswitch-checkbox" id="example3">
                                            <label class="onoffswitch-label" for="example3">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" class="onoffswitch-checkbox" id="example4">
                                            <label class="onoffswitch-label" for="example4">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-xs">詳 細</button>
                                    <button class="btn btn-default btn-xs">削 除</button>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr >
                                <th class="fix-padding-right">
                                    <div class="i-checks"><label>
                                        <div class="icheckbox_square-green" style="position: relative;"><input
                                                type="checkbox" value="" style="position: absolute; opacity: 0;">
                                            <ins class="iCheck-helper"
                                                 style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                        </div>
                                        <i></i></label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>候補者名</th>
                                <th>選考段階</th>
                                <th>選考ステータス</th>
                                <th>選考開始予定日時</th>
                                <th>選考開始予定日時</th>
                                <th>面接官数</th>
                                <th>流入元</th>
                                <th> 流入元への公開</th>
                                <th>公開候補者への公開</th>
                                <th>操作</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="item-gp1">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-white btn-xs dropdown-toggle w-dropdown"><span class="txt-selected">チェ ッ ク のみ</span> <span class="caret pull-right"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">チェ ッ ク のみ 1</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="item-gp2">
                                <button type="button" class="btn btn-xs btn-white"><i class="fa fa-envelope-o"></i></button>
                                <button type="submit" class="btn btn-xs btn-white"><i class="fa fa-print"></i></button>
                            </div>
                            <div class="item-gp3">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-white btn-xs dropdown-toggle w-dropdown"><span class="txt-selected">その他</span><span class="caret pull-right"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">その他</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!------------pagination-------------->
                        <div class="col-lg-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0"
                                        tabindex="0" id="DataTables_Table_0_previous">
                                        <a href="#">Previous</a>
                                    </li>
                                    <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0">
                                        <a href="#">1</a></li>
                                    <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                                        <a href="#">2</a>
                                    </li>
                                    <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                                        <a href="#">3</a>
                                    </li>
                                    <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                                        <a href="#">4</a>
                                    </li>
                                    <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                                        <a href="#">5</a>
                                    </li>
                                    <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0">
                                        <a href="#">6</a>
                                    </li>
                                    <li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0"
                                        id="DataTables_Table_0_next">
                                        <a href="#">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <br />
        <br />
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

<?php echo $this->Html->script('jquery-2.1.1.js'); ?>
<?php echo $this->Html->script('bootstrap.min.js'); ?>
<?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>
<?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>


<!-- Custom and plugin javascript -->
<?php echo $this->Html->script('inspinia.js'); ?>
<?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>

<!-- iCheck -->
<?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>

<!-- Peity -->
<?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    });
</script>
<!-- Chosen -->
<?php echo $this->Html->script('plugins/chosen/chosen.jquery.js'); ?>

<!-- JSKnob -->
<!--<?php echo $this->Html->script('plugins/plugins/jsKnob/jquery.knob.js'); ?>-->

<!-- Input Mask-->

<?php echo $this->Html->script('plugins/jasny/jasny-bootstrap.min.js'); ?>

<!-- Data picker -->

<?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>

<!-- NouSlider -->
<!--<script src="js/plugins/nouslider/jquery.nouislider.min.js"></script>-->

<!-- Switchery -->
<?php echo $this->Html->script('plugins/switchery/switchery.js'); ?>

<!-- IonRangeSlider -->
<?php echo $this->Html->script('plugins/ionRangeSlider/ion.rangeSlider.min.js'); ?>

<!-- iCheck -->
<?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>

<!-- MENU -->
<?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>

<!-- Color picker -->
<?php echo $this->Html->script('plugins/colorpicker/bootstrap-colorpicker.min.js'); ?>

<!-- Clock picker -->
<?php echo $this->Html->script('plugins/clockpicker/clockpicker.js'); ?>

<!-- Image cropper -->
<?php echo $this->Html->script('plugins/cropper/cropper.min.js'); ?>

<!-- Date range use moment.js same as full calendar plugin -->
<?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>

<!-- Date range picker -->
<?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>
<!-- Data Tables -->
<?php echo $this->Html->script('plugins/jeditable/jquery.jeditable.js'); ?>
<?php echo $this->Html->script('plugins/dataTables/jquery.dataTables.js'); ?>
<?php echo $this->Html->script('plugins/dataTables/dataTables.bootstrap.js'); ?>
<?php echo $this->Html->script('plugins/dataTables/dataTables.responsive.js'); ?>
<?php echo $this->Html->script('plugins/dataTables/dataTables.tableTools.min.js'); ?>

<script>
    $(document).ready(function () {

        $('.dataTables-example').dataTable({
            responsive: true,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
            },
            "bPaginate": false,
            "aoColumnDefs" : [ {
                'bSortable' : false,
                'aTargets' : [0]
            } ],
            "order":[[1, 'asc']]
        });

        /* Init DataTables */
        var oTable = $('#editable').dataTable();

        /* Apply the jEditable handlers to the table */
        oTable.$('td').editable( '../example_ajax.php', {
            "callback": function( sValue, y ) {
                var aPos = oTable.fnGetPosition( this );
                oTable.fnUpdate( sValue, aPos[0], aPos[1] );
            },
            "submitdata": function ( value, settings ) {
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition( this )[2]
                };
            },

            "width": "90%",
            "height": "100%"
        } );


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

        $("#download").click(function () {
            window.open($image.cropper("getDataURL"));
        });

        $("#zoomIn").click(function () {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function () {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function () {
            $image.cropper("rotate", 45);
        });

        $("#rotateRight").click(function () {
            $image.cropper("rotate", -45);
        });

        $("#setDrag").click(function () {
            $image.cropper("setDragMode", "crop");
        });

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#data_2 .input-group.date').datepicker({
            startView: 1,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: "dd/mm/yyyy"
        });

        $('#data_3 .input-group.date').datepicker({
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        $('#data_4 .input-group.date').datepicker({
            minViewMode: 1,
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            todayHighlight: true
        });

        $('#data_5 .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, {color: '#1AB394'});

        var elem_2 = document.querySelector('.js-switch_2');
        var switchery_2 = new Switchery(elem_2, {color: '#ED5565'});

        var elem_3 = document.querySelector('.js-switch_3');
        var switchery_3 = new Switchery(elem_3, {color: '#1AB394'});

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });

        $('.demo1').colorpicker();

//        var divStyle = $('.back-change')[0].style;
//        $('#demo_apidemo').colorpicker({
//            color: divStyle.backgroundColor
//        }).on('changeColor', function (ev) {
//            divStyle.backgroundColor = ev.color.toHex();
//        });

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
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

    $("#ionrange_1").ionRangeSlider({
        min: 0,
        max: 5000,
        type: 'double',
        prefix: "$",
        maxPostfix: "+",
        prettify: false,
        hasGrid: true
    });

    $("#ionrange_2").ionRangeSlider({
        min: 0,
        max: 10,
        type: 'single',
        step: 0.1,
        postfix: " carats",
        prettify: false,
        hasGrid: true
    });

    $("#ionrange_3").ionRangeSlider({
        min: -50,
        max: 50,
        from: 0,
        postfix: "°",
        prettify: false,
        hasGrid: true
    });

    $("#ionrange_4").ionRangeSlider({
        values: [
            "January", "February", "March",
            "April", "May", "June",
            "July", "August", "September",
            "October", "November", "December"
        ],
        type: 'single',
        hasGrid: true
    });

    $("#ionrange_5").ionRangeSlider({
        min: 10000,
        max: 100000,
        step: 100,
        postfix: " km",
        from: 55000,
        hideMinMax: true,
        hideFromTo: false
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