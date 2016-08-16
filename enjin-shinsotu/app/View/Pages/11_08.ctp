<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application management</title>

  <!-- css -->
  <?php echo $this->Html->css('bootstrap/animate'); ?>
  <?php echo $this->Html->css('plugins/clockpicker/clockpicker'); ?>
  <?php echo $this->Html->css('plugins/datapicker/datepicker3'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3'); ?>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('bootstrap/animate'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>
  <?php echo $this->Html->css('enjin/email'); ?>
  <?php echo $this->Html->css('enjin/master'); ?>
  <?php echo $this->Html->css('enjin/02_selection.css'); ?>
  <!-- end css -->

  <!-- script -->
  <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
  <?php echo $this->Html->script('bootstrap.min.js'); ?>
  <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>
  <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>
  <!-- Custom and plugin javascript -->
  <?php echo $this->Html->script('inspinia.js'); ?>
  <?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
  <!-- Peity -->
  <?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>
  <!-- Custom and plugin javascript -->
  <?php echo $this->Html->script('inspinia.js'); ?>
  <?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
  <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>
  <!-- Data picker -->
  <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>
  <!-- iCheck -->
  <?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>
  <!-- Date range use moment.js same as full calendar plugin -->
  <?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
  <!-- Date range picker -->
  <?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>
  <?php echo $this->Html->script('kiwi.js'); ?>
  <!-- end script -->


  
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
              <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">マスタ管理</span></a>
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

                <!-- title content -->
                <div class="row wrapper border-bottom white-bg page-heading">
                  <div class="col-lg-10">
                    <h2>候補者一覧</h2>
                  </div>
                </div>
                <!-- end title content -->

                <!-- content -->
                <div class="wrapper wrapper-content row animated fadeInRight clearfix">
                  <div class="col-lg-12">
                    <!-- ibox-1 -->
                    <div class="ibox  no-margin-bottom">
                      <div class="ibox-title">
                        <h5>候補者一覧</h5>
                      </div>
                      <div class="ibox-content bg-gray clearfix form-edit2 p-sm">
                        <form>
                          <div class="form-group clearfix">
                            <div class="col-lg-4 row">
                              <label class="pull-left p-xs">選考段階</label>
                              <select class="form-control ct-select2">
                                <option value="1">２次選考</option>
                                <option value="2">２次選考</option>
                                <option value="3">２次選考</option>
                              </select>
                            </div>
                            <div class="col-lg-6 row">
                              <label class="pull-left p-xs">選考ステータス</label>
                              <select class="form-control ct-select2">
                                <option value="1">合格</option>
                                <option value="1">合格</option>
                                <option value="1">合格</option>
                              </select>
                            </div>

                          </div>


                          <div class="form-group clearfix">
                            <div class="col-lg-4 row">
                              <label class="pull-left p-xs">流入元企業</label>
                              <select class="form-control ct-select2">
                                <option value="1">リクナビ</option>
                                <option value="1">リクナビ</option>
                                <option value="1">リクナビ</option>
                              </select>
                            </div>
                            <div class="col-lg-5 row">
                              <label class="pull-left p-xs">イベント</label>
                              <select class="form-control ct-select2">
                                <option value="1">会社説明会</option>
                                <option value="1">会社説明会</option>
                                <option value="1">会社説明会</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group clearfix m-l-none">
                            <div class="col-lg-3 row">
                              <label class="pull-left p-xs">氏</label>
                              <div class="col-sm-7">
                                <input class="form-control" type="text" value="Textbox">
                              </div>
                            </div>
                            <div class="col-lg-3 row">
                              <label class="pull-left p-xs">名</label>
                              <div class="col-sm-7">
                                <input class="form-control" type="text" value="Textbox">
                              </div>
                            </div>
                            <div class="col-lg-4 row">
                              <label class="pull-left p-xs">メールアドレス</label>
                              <div class="col-sm-7">
                                <input class="form-control" type="text" value="Textbox">
                              </div>
                            </div>
                          </div>

                          <div class="form-group clearfix">
                            <div class="col-lg-3 row">
                              <label class="pull-left p-xs">送信期間</label>
                              <div class='data_1' id="">
                                <div class="input-group date">
                                  <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                  <input type="text" class="form-control ct-select1" value="03/04/2014">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 row">
                              <label class="pull-left p-xs">か ら</label>
                              <div id="" class='data_1'>
                                <div class="input-group date">
                                  <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                  <input type="text" class="form-control" value="03/04/2014">
                                </div>
                              </div>
                            </div>
                            <label class="pull-left p-xs">ま で</label>
                          </div>







                          <div class="from_calen">
                            <button type="button" class="btn btn-primary btn-sm">登録 </button>
                            <button type="button" class="btn btn-primary btn-sm">クリア</button>

                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- end ibox 1 -->
                    <div class="clear"></div>

                    <div class="ibox no-margin-bottom">
                      <!--end inbox content-->

                      <!-- ibox-content -->
                      <div class="ibox-content">

                        <div class="b-cal four-action m-b">

                          <div class='pull-left m-r-sm'>
                            <select class="btn btn-white" name="agent_id">
                              <option>チェ ッ ク のみ</option>
                              <option>チェ ッ ク のみ</option>
                              <option>チェ ッ ク のみ</option>
                            </select>
                          </div>

                          <div class="pull-left">
                            <button class="m-r-sm btn btn-primary btn-sm">メール</button>
                          </div>
                          <div class="pull-left">
                            <button class="m-r-sm btn btn-primary btn-sm">印刷</button>
                          </div>
                          <div class='pull-left'>
                            <select class="btn btn-white" name="agent_id">
                              <option>その他</option>
                              <option>その他</option>
                              <option>その他</option>     
                            </select>
                          </div>

                          <div class="rope-btn pull-left m-r-sm">|</div>

                          <div class="pull-left hover-button m-r-sm">                          
                            <a href="" type="button" class="btn btn-primary btn-sm">新規候補者登録</a>
                          </div> 
                          <div class="pull-left hover-button m-r-sm">                          
                            <a href="" type="button" class="btn btn-primary btn-sm">参加者CSV登録</a>
                          </div> 

                          <div class="bottom_pagination1">
                            <ul class="pagination m-t-none">
                              <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous"><a href="#">Prev</a>
                              </li>
                              <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0"><a href="#">1</a></li>
                              <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">2</a></li>
                              <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">3</a></li>
                              <li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next"><a href="#">Next</a></li>
                            </ul>
                          </div>
                          <div class="clear"></div>
                        </div>

                        <!------------pagination-------------->


                        <!------------table-------------->  
                        <div class="table-responsive">
                          <table class="table table-center white-tb-th table-striped table-bordered table-center-th-td">
                            <thead>
                             <tr>
                               <th><input type="checkbox" class="i-checks"></th>
                               <th  class='button_cen'><u>候補者ID</u></th>                              
                               <th class='button_cen'><u>候補者名</u></th>
                               <th class='button_cen'><u>メールアドレス</u></th>
                               <th class='button_cen'><u>大学名</u></th>
                               <th class='button_cen'><u>学部名</u></th>
                               <th class='button_cen'><u>電話番号</u></th> 
                               <th class='button_cen'><u>顔写真</u></th> 
                               <th class='button_cen'><u>流入元</u></th> 
                               <th class='button_cen'>操作</th>             
                             </tr>
                           </thead>
                           <tbody>
                            <tr> 
                              <td><input type="checkbox" class="i-checks"></td>                                
                              <td class='button_cen'><a href="">123456</a></td>                              
                              <td class='button_cen'><a href="">田中 太朗</a></td>
                              <td class='button_cen'>t-taro@gmail.com</td>
                              <td class='button_cen'><a href="">輪瀬田大学</a></td>
                              <td class='button_cen'>経済学部</td>
                              <td class='button_cen'>090xxxxxxxx</td>
                              <td class='button_cen'>
                                <img src="/enjin-shinsotu/img/bootstrap/icon_avatar.png" class="img-circle" alt="">
                              </td>
                              <td class='button_cen'>リクナビ</td>
                              <td class="button_cen hover-button">                                 
                                <a href='' type='button' class="btn btn-primary btn-xs cl-white">詳細</a>
                                <a href='' type='button' class="btn btn-primary btn-xs cl-white">削除</a>            
                              </td>

                            </tr>
                            <tr> 
                             <td><input type="checkbox" class="i-checks"></td>
                             <td class='button_cen'><a href="">123456</a></td>                              
                             <td class='button_cen'><a href="">田中 太朗</a></td>
                             <td class='button_cen'>t-taro@gmail.com</td>
                             <td class='button_cen'><a href="">輪瀬田大学</a></td>
                             <td class='button_cen'>経済学部</td>
                             <td class='button_cen'>090xxxxxxxx</td>
                             <td class='button_cen'>
                              <img src="/enjin-shinsotu/img/bootstrap/icon_avatar.png" class="img-circle" alt="">
                            </td>                          
                            <td class='button_cen'>リクナビ</td>                            
                            <td class="button_cen hover-button">                                 
                              <a href='' type='button' class="btn btn-primary btn-xs cl-white">詳細</a>                                
                            </td>
                          </tr>
                          <tr>  
                            <td><input type="checkbox" class="i-checks"></td>
                            <td class='button_cen'><a href="">123456</a></td>                              
                            <td class='button_cen'><a href="">田中 太朗</a></td>
                            <td class='button_cen'>t-taro@gmail.com</td>
                            <td class='button_cen'><a href="">輪瀬田大学</a></td>
                            <td class='button_cen'>経済学部</td>
                            <td class='button_cen'>090xxxxxxxx</td>
                            <td class='button_cen'>
                              <img src="/enjin-shinsotu/img/bootstrap/icon_avatar.png" class="img-circle" alt="">
                            </td>                          
                            <td class='button_cen'>リクナビ</td>
                            <td class="button_cen hover-button">                                 
                              <a href='' type='button' class="btn btn-primary btn-xs cl-white">詳細</a>
                            </td>


                            <tr>     
                              <td><input type="checkbox" class="i-checks"></td>                                 
                              <td class='button_cen'><a href="">123456</a></td>                              
                              <td class='button_cen'><a href="">田中 太朗</a></td>
                              <td class='button_cen'>t-taro@gmail.com</td>
                              <td class='button_cen'><a href="">輪瀬田大学</a></td>
                              <td class='button_cen'>経済学部</td>
                              <td class='button_cen'>090xxxxxxxx</td>
                              <td class='button_cen'>
                                <img src="/enjin-shinsotu/img/bootstrap/icon_avatar.png" class="img-circle" alt="">
                              </td>                          
                              <td class='button_cen'>リクナビ</td>
                              <td class="button_cen hover-button">                                 
                                <a href='' type='button' class="btn btn-primary btn-xs cl-white">詳細</a>
                                <a href='' type='button' class="btn btn-primary btn-xs cl-white">削除</a>            
                              </td>

                            </tr>

                          </tbody>
                          <tfoot>
                            <tr>

                              <th><input type="checkbox" class="i-checks"></th>
                              <th><u>候補者ID</u></th>                              
                              <th><u>候補者名</u></th>
                              <th><u>メールアドレス</u></th>
                              <th><u>大学名</u></th>
                              <th><u>学部名</u></th>
                              <th><u>電話番号</u></th> 
                              <th><u>顔写真</u></th> 
                              <th><u>流入元</u></th> 
                              <th>操作</th>             
                            </tr>
                          </tfoot>
                        </table>


                      </div>

                      <div class="b-cal four-action m-b">

                        <div class='pull-left m-r-sm'>
                          <select class="btn btn-white" name="agent_id">
                            <option>チェ ッ ク のみ</option>
                            <option>チェ ッ ク のみ</option>
                            <option>チェ ッ ク のみ</option>
                          </select>
                        </div>

                        <div class="pull-left">
                          <button class="m-r-sm btn btn-primary btn-sm">メール</button>
                        </div>
                        <div class="pull-left">
                          <button class="m-r-sm btn btn-primary btn-sm">印刷</button>
                        </div>
                        <div class='pull-left'>
                          <select class="btn btn-white" name="agent_id">
                            <option>その他</option>
                            <option>その他</option>
                            <option>その他</option>     
                          </select>
                        </div>

                        <div class="rope-btn pull-left m-r-sm">|</div>
                        <div class="pull-left hover-button m-r-sm">                          
                          <a href="" type="button" class="btn btn-primary btn-sm">新規候補者登録</a>
                        </div>
                        <div class="pull-left hover-button m-r-sm">                          
                          <a href="" type="button" class="btn btn-primary btn-sm">参加者CSV登録</a>
                        </div>                    
                        <div class="bottom_pagination1">
                          <ul class="pagination m-t-none">
                            <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous"><a href="#">Prev</a>
                            </li>
                            <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0"><a href="#">1</a></li>
                            <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">2</a></li>
                            <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">3</a></li>
                            <li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next"><a href="#">Next</a></li>
                          </ul>
                        </div>
                        <div class="clear"></div>
                      </div>




                      <!------------------>

                      <!--table-->




                    </div>
                    <!-- end ibox 2 -->
                  </div>
                </div><!-- end wrapper-->
              </div>
              <!-- end content -->

              <br>
              <br>
              <div class="clearfix"></div>
              <!-- footer -->
              <div class="footer">
                <div>
                  <strong>Copyright</strong>© enjin
                </div>
              </div>
            </div>

          </body>

          </html>

