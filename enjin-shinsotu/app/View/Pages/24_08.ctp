<!DOCTYPE html>
<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>24_08</title>



  <?php echo $this->Html->css('enjin/animate'); ?>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>


  <?php echo $this->Html->css('plugins/fullcalendar/fullcalendar.css'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>





  
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


          <!-- Peity -->

          <?php echo $this->Html->script('plugins/peity/jquery.peity.min.js'); ?>


          <?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>

          <?php echo $this->Html->script('plugins/fullcalendar/fullcalendar.min.js'); ?>



          <!-- script for display a list inside areatext -->

          <script>
          $(document).ready(function(){
            $("#selections").children().each(function(){
              $(this).click(function(){
                $("#area").text($("#area").text() + $(this).html() + '\n');
              });
            });
          });
          </script>

          <script>

          $(document).ready(function() {

            $('.i-checks').iCheck({
              checkboxClass: 'icheckbox_square-green',
              radioClass: 'iradio_square-green'
            });

        /* initialize the external events
        -----------------------------------------------------------------*/

        $('#external-events div.external-event').each(function() {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
              });

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1111999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
              });

          });


        /* initialize the calendar
        -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
                right: ''//month,agendaWeek,agendaDay
              },
              editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                  }
                },
                events: [
//                {
//                    title: 'All Day Event',
//                    start: new Date(y, m, 1)
//                },
//                {
//                    title: 'Long Event',
//                    start: new Date(y, m, d-5),
//                    end: new Date(y, m, d-2)
//                },
//                {
//                    id: 999,
//                    title: 'Repeating Event',
//                    start: new Date(y, m, d-3, 16, 0),
//                    allDay: false
//                },
//                {
//                    id: 999,
//                    title: 'Repeating Event',
//                    start: new Date(y, m, d+4, 16, 0),
//                    allDay: false
//                },
//                {
//                    title: 'Meeting',
//                    start: new Date(y, m, d, 10, 30),
//                    allDay: false
//                },
//                {
//                    title: 'Lunch',
//                    start: new Date(y, m, d, 12, 0),
//                    end: new Date(y, m, d, 14, 0),
//                    allDay: false
//                },
//                {
//                    title: 'Birthday Party',
//                    start: new Date(y, m, d+1, 19, 0),
//                    end: new Date(y, m, d+1, 22, 30),
//                    allDay: false
//                },
//                {
//                    title: 'Click for Google',
//                    start: new Date(y, m, 28),
//                    end: new Date(y, m, 29),
//                    url: 'http://google.com/'
//                }
]
});
});

</script>

</head>


</style>

<body class='page24'>

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
                          <?php echo $this->Html->image("bootstrap/a7.jpg", array(
                            "class" => "img-circle",
                            )); ?>
                          </a>
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
                            <?php echo $this->Html->image("bootstrap/a7.jpg", array(
                              "class" => "img-circle",
                              )); ?>
                            </a>
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
                              <?php echo $this->Html->image("bootstrap/a7.jpg", array(
                                "class" => "img-circle",
                                )); ?>
                              </a>
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
                    <h2>自社情報</h2>
                  </div>
                </div>


                <div class="wrapper wrapper-content row animated fadeInRight clearfix">
                  <div class='full-content'>

                    <div class='col-lg-8'>

                      <div class='ibox'>

                        <div class="ibox-title">
                          <h5>自社情報</h5>
                          <div class="ibox-tools">
                            <button type='button' class='btn btn-primary btn-xs'>編集</button>                                
                          </div>
                        </div>
                        <div class='ibox-content bg-white p-sm'>


                          <form method="get" class="form-horizontal">
                            <div class="form-group"><label class="col-sm-4 control-label">ユーザー企業ID</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">company123456</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">企業名</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">株式会社enjin</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">都道府県</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">東京都</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">市区町村</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">港区</div>
                              </div>
                            </div>                    
                            <div class="form-group"><label class="col-sm-4 control-label">備考</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">ー</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">設立年月日</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">2015/01/01</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">代表電話番号</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">03xxxxxxxx</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">代表メールアドレス</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none text-navy">info@enjin.jp</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">従業員数</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">120人</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">売上高</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">1,000,000,000円</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">業種</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">人材派遣</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">平均年収</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">10,000,000円</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">平均年齢</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">32歳</div>
                              </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">市場</label>
                              <div class="col-sm-8">
                                <div class="form-control border-none">ー</div>
                              </div>
                            </div>                       
                          </form>            
                        </div>
                      </div>
                    </div>

                    <!--table 2 content-->
                    <div class="col-lg-4">

                      <div class="ibox">
                        <div class="ibox-title">
                          <h5>部署一覧</h5>
                          
                        </div>
                        <div class="ibox-content clearfix p-sm table-border">


                          <table class="table table-center-th-td table-bordered no-margin-bottom">
                            <thead>
                              <tr>
                                <th>部署名</th>
                                <th class='w-33per'>親部署</th>
                                <th class='w-27per'>人事部フラグ</th>
                                <th>操作</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>営業部</td>
                                <td>ー</td>
                                <td>ー</td>
                                <td class="table-button-tdright"><button class="full-width btn btn-default btn-xs">削除</button></td>
                              </tr>      
                              <tr>
                                <td>開発部</td>
                                <td>ー</td>
                                <td>ー</td>
                                <td class="table-button-tdright"><button class="full-width btn btn-default btn-xs">削除</button></td>
                              </tr>     
                              <tr>
                                <td><input class='form-control ip-sm-tb' type='text' value='部署名'/></td>        

                                <td class='no-borders ver-mid btn-group btn-block'>
                                  <button data-toggle="dropdown" class="btn btn-white btn-sm dropdown-toggle btn-block t-align-left">採用担当<span class="caret sl-btn"></span></button>
                                  <ul class="dropdown-menu">
                                    <li><a href="#">採用担当</a></li>
                                    <li><a href="#">採用担当</a></li>
                                    <li><a href="#">採用担当</a></li>                                     
                                  </ul>
                                </td>                                        
                                <td class="">                         
                                  <button data-toggle="dropdown" class="btn btn-white btn-sm dropdown-toggle btn-block t-align-left">フラグ<span class="caret sl-btn"></span></button>
                                  <ul class="dropdown-menu t-auto">
                                    <li><a href="#">フラグ</a></li>
                                    <li><a href="#">フラグ</a></li>
                                    <li><a href="#">フラグ</a></li>                                     
                                  </ul>      
                                </td>                                
                                <td class="table-button-tdright"><button class="full-width btn btn-primary btn-xs">追加</button></td>
                              </tr>                               
                            </tbody>
                          </table>    

                        </div>                         
                      </div>

                    </div>
                  </div> 

                  <div class='col-lg-12'>
                    <div class="ibox">

                      <div class="ibox-title">
                        <h5>採用担当一覧</h5>                  
                      </div>
                      <div class="ibox-content bg-white clearfix p-sm">

                        <div class="text-right four-action">
                          <div class="pull-left">
                            <button class="btn btn-primary btn-sm">新規追加</button>
                          </div>
                          <div>
                            <span class="sp-text-pg">10件中10件表示</span>
                            <div class="bottom_pagination1 pull-right">
                              <ul class="pagination margin-pag mg-none-bottom pag-pd">
                                <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous"><a href="#">Prev</a>
                                </li>
                                <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0"><a href="#">1</a></li>
                                <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">2</a></li>
                                <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">3</a></li>
                                <li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next"><a href="#">Next</a></li>
                              </ul>
                            </div>
                          </div>
                          

                          <div class="clear"></div>
                        </div>

                        <table class="table table-center-th-td table-bordered no-margin-bottom a-underline">
                          <thead>
                            <tr>
                              <th><u>ID</u></th>                              
                              <th><u>氏名</u></th>
                              <th><u>部署</u></th>
                              <th><u>採用者タイプ</u></th>
                              <th><u>メール</u></th>
                              <th><u>電話</u></th> 
                              <th><u>決裁者フラグ</u></th> 
                              <th><u>最終ログイン日</u></th>
                              <th><u>操作</u></th>             
                            </tr>
                          </thead>
                          <tbody>
                            <tr>                                    
                              <td ><a class='text-navy' href="">st0001</a></td>                              
                              <td ><a class='text-navy' href="">梅原　洸太</a></td>
                              <td >営業部</td>
                              <td >採用部</td>
                              <td ><a class='text-navy' href="">umehara＠enjin.jp</a></td>
                              <td >090xxxxxxxx</td>  
                              <td >
                               <div>
                                <input type="checkbox" class="i-checks" name="input[]">
                              </div>
                            </td>  
                            <td >2015/07/26</td>
                            <td class="table-button-tdright">
                             
                              <a href="" type="button" class="btn btn-primary btn-xs cl-white m-r-sm">詳細</a>
                              <a href="" type="button" class="btn btn-default btn-xs cl-white">削除</a>
                            

                            </td>           
                          </tr>
                          <tr>                                    
                            <td ><a class='text-navy' href="">st0001</a></td>                              
                            <td ><a class='text-navy' href="">梅原　洸太</a></td>
                            <td >営業部</td>
                            <td >採用部</td>
                            <td ><a class='text-navy' href="">umehara＠enjin.jp</a></td>
                            <td >090xxxxxxxx</td>  
                            <td > <div>
                              <input type="checkbox" class="i-checks" name="input[]">
                            </div>
                          </td>  
                          <td >2015/07/26</td>
                          <td class="table-button-tdright">
                            

                            <a href="" type="button" class="btn btn-primary btn-xs cl-white m-r-sm">詳細</a>
                              <a href="" type="button" class="btn btn-default btn-xs cl-white">削除</a>
                          </td>           
                        </tr>
                        <tr>                                    
                          <td ><a class='text-navy' href="">st0001</a></td>                              
                          <td ><a class='text-navy' href="">梅原　洸太</a></td>
                          <td >営業部</td>
                          <td >採用部</td>
                          <td ><a class='text-navy' href="">umehara＠enjin.jp</a></td>
                          <td >090xxxxxxxx</td>  
                          <td >
                           <div>
                            <input type="checkbox" class="i-checks" name="input[]">
                          </div>
                        </td>  
                        <td >2015/07/26</td>
                        <td class="table-button-tdright">
                         <a href="" type="button" class="btn btn-primary btn-xs cl-white m-r-sm">詳細</a>
                              <a href="" type="button" class="btn btn-default btn-xs cl-white">削除</a>
                        </td>           
                      </tr>
                      <tbody>
                      </table> 



                      <div class="text-right four-action m-t">
                        <div class="pull-left">
                          <button class="btn btn-primary btn-sm">新規追加</button>
                        </div>
                        <div>
                          <span class="sp-text-pg">10件中10件表示</span>
                          <div class="bottom_pagination1 pull-right">
                            <ul class="pagination margin-pag mg-none-bottom pag-pd">
                              <li class="paginate_button previous disabled" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_previous"><a href="#">Prev</a>
                              </li>
                              <li class="paginate_button active" aria-controls="DataTables_Table_0" tabindex="0"><a href="#">1</a></li>
                              <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">2</a></li>
                              <li class="paginate_button " aria-controls="DataTables_Table_0" tabindex="0"><a href="#">3</a></li>
                              <li class="paginate_button next" aria-controls="DataTables_Table_0" tabindex="0" id="DataTables_Table_0_next"><a href="#">Next</a></li>
                            </ul>
                          </div>
                        </div>


                        <div class="clear"></div>
                      </div>

                    </div>
                  </div>
                </div>


              </div>   

              <div class="footer">
                <div>
                  <strong>Copyright</strong>© enjin
                </div>

              </div>
            </div>
          </div>




</body>

</html>
