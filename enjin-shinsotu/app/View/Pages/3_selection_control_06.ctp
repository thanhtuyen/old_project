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

          <?php echo $this->Html->script('plugins/switchery/switchery.js'); ?>

  <!-- end script -->      
<script>
        $(document).ready(function(){
           var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#1AB394' });
        });
        

      


    </script>


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

                <div class="row wrapper border-bottom page-heading">
                  <div class="col-lg-12">
                    <div class="wrapper wrapper-content animated fadeIn pd-bottom-none">
                      <div class="row">
                        <div class="col-lg-8">
                          <div class="tabs-container ibox">
                            <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#tab-2">書類選考</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-1">1 次選考</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-3">2次選考</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-4">3次選考</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-5">4次選考</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-6">最終選考</a></li>
                            </ul>
                            <div class="tab-content">

                              <!-- tab2 -->
                              <div id="tab-2" class="tab-pane active">
                                <div class="panel-body  pd-bottom-none">
                                  <div class="ibox-title">
                                    <h5>候補者情報</h5>
                                  </div>

                                  <div class="ibox-content">
                                    <form method="get" class="form-horizontal">

                                      <div class="form-group"><label class="col-sm-4 control-label">選考履歴ID</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            1234567
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">候補者名</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            <a class='text-navy' href="">候補者名</a>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">候補者ID</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            <a class='text-navy' href="">123456</a>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">選考段階名</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            最終選考
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">選考ステータス</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            合格
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">選考開始予定日時</label>                        
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            YYYY/MM/DD HH:SS
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group"><label class="col-sm-4 control-label">選考開始予定日時</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            YYYY/MM/DD HH:SS
                                          </div>
                                        </div>


                                        <!-- end table 2-->
                                        <!-- form 2 -->

                                        <!-- end form 2 -->

                                      </div>  
                                      <!-- form 2 -->   


                                      <div class="form-group"><label class="col-sm-4 control-label">求人票ID</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            <a class='text-navy' href="">ABC1 23456</a>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">求人票タイトル</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            求人票タイトル
                                          </div>
                                        </div>
                                      </div>




                                      <div class="form-group"><label class="col-sm-4 control-label">選考ステータスオプション</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            オプション内容
                                          </div>
                                        </div>                             
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">掲示年収</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            400万円
                                          </div>
                                        </div>                                 
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">コメント</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            選考履歴に対する、 コメント＆メモ
                                          </div>
                                        </div>                                  
                                      </div>
                                      <div class="form-group"><label class="col-sm-4 control-label">訪問先情報</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            訪問先情報
                                          </div>
                                        </div>                                  
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">流入元企業への選考ステータスの公開可否</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            選考履歴に対する、 コメント＆メモ
                                          </div>
                                        </div>                                  
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">候補者への選考ステータスの公開可否</label>

                                        <div class="col-sm-8">
                                            <div class="col-sm-8">
                                          <input type="checkbox" checked="" class="js-switch" id="">
                                        </div>
                                        </div>
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">訪問先情報</label>

                                        <div class="col-sm-8">
                                          <div class="col-sm-8">
                                         <input type="checkbox" checked="" class="js-switch_2" id=""> 
                                       </div>
                                        </div>
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">最終更新者タイプ</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            採用担当者
                                          </div>
                                        </div>                                  
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">最終更新者採用担当者ID</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            <a class='text-navy' href="">live1234</a>
                                          </div>
                                        </div>                                  
                                      </div>

                                      <div class="form-group"><label class="col-sm-4 control-label">最終更新流入元担当者ID</label>
                                        <div class="col-sm-8">
                                          <div class="form-control border-none">
                                            <a class='text-navy' href="">mynavi12345678</a>
                                          </div>
                                        </div>                            
                                      </div>
                                      <div class="button_cen element-detail-box ">
                                        <button class="w-75 btn btn-default btn-sm">削除</button>
                                      </div>
                                    </form>
                                  </div> 
                                  <!-- end form 3-->



                                </div>
                              </div>
                              <!-- end tab 2-->

                              <!-- tab 1 -->
                              <div id="tab-1" class="tab-pane">
                              </div>
                              <!-- end tab -1-->

                              <!-- tab 3 -->
                              <div id="tab-3" class="tab-pane">
                              </div>
                              <!-- end tab 3-->

                              <!-- tab 4-->

                              <!-- tab 5-->



                            </div>
                          </div>
                          <div class='ibox'>
                            <div class="ibox-title">
                              <h5>書類選考採用担当者</h5>
                              <div class="ibox-tools">
                                <a class="collapse-link">
                                  <i class="fa fa-chevron-up"></i>
                                </a>
                              </div>
                            </div>
                            <div class="ibox-content">
                              <h5>面接官（採用担当者）選考履歴</h5>
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>採用担当者名</th>
                                    <th>評価ランク</th>
                                    <th>評価スコア</th>
                                    <th>評価コメント</th>
                                    <th>操作</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>柏井 こたろー</td>
                                    <td>不合格</td>
                                    <td>500</td>
                                    <td>コメントコメント</td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <td>宮崎 範浩</td>
                                    <td>合格</td>
                                    <td>Thornton</td>
                                    <td>コメントコメント</td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <td>土屋 則幸</td>
                                    <td>合格</td>
                                    <td>the Bird</td>
                                    <td>コメントコメント</td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <td>三橋 和広</td>
                                    <td>合格</td>
                                    <td>the Bird</td>
                                    <td>コメントコメント</td>
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
                                    <td>ABC123456</td>
                                  </tr>   
                                  <tr>
                                    <th>求人票タイトル</th>
                                    <td>求人票タイトル</td>
                                  </tr>    
                                  <tr>
                                    <th>募集要項</th>
                                    <td>仕事の内容を掲載</td>
                                  </tr> 
                                  <tr>
                                    <th>職種タイプ</th>
                                    <td>営業</td>
                                  </tr> 
                                  <tr>
                                    <th>初任給</th>
                                    <td>24万円</td>
                                  </tr> 
                                  <tr>
                                    <th>待遇</th>
                                    <td>待遇内容を掲載</td>
                                  </tr> 
                                  <tr>
                                    <th>応募資格</th>
                                    <td>応募資格を掲載</td>
                                  </tr> 
                                  <tr>
                                    <th>募集人数</th>
                                    <td>10人</td>
                                  </tr> 
                                   <tr>
                                    <th>募集期限</th>
                                    <td>仕事の内容を掲載</td>
                                  </tr>   
                                   <tr>
                                    <th>公開開始日時</th>
                                    <td>YYYY/MM/DD</td>
                                  </tr>   
                                   <tr>
                                    <th>募集エリア</th>
                                    <td>yyyy /mm /dd hh:mm</td>
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
                                    <th class="w-47per">求人票ID</th>
                                    <td>株式会社ネオネオ</td>
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
                                    <td>2017/11/30</td>
                                  </tr>
                                  <tr>
                                    <th>設立年月日</th>
                                    <td>2000年11月</td>
                                  </tr>
                                  <tr>
                                    <th>従業員数</th>
                                    <td>200人</td>
                                  </tr>
                                  <tr>
                                    <th>売上高</th>
                                    <td>100,000,000円</td>
                                  </tr>
                                  <tr>
                                    <th>業種</th>
                                    <td>IT・通信・インターネット</td>
                                  </tr>
                                  <tr>
                                    <th>市場</th>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <th>備考</th>
                                    <td></td>
                                  </tr>
                                </tbody>
                              </table>


                            </div>

                          </div>
                          <!--end ibox 2-->
                          <!--end table 2-->
                        </div>
                      </div>/
                    </div>
                    <!-- end content -->

                  </div>
                </div>
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

        </body>


        </html>

