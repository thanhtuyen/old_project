<!DOCTYPE html>
<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>22_08</title>

  <?php echo $this->Html->css('bootstrap/animate'); ?>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>
  <?php echo $this->Html->css('enjin/10_ver06.css'); ?>
  <?php echo $this->Html->css('plugins/clockpicker/clockpicker'); ?>
  <?php echo $this->Html->css('plugins/datapicker/datepicker3'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3'); ?>
  <?php echo $this->Html->css('plugins/fullcalendar/fullcalendar.css'); ?>


  <?php echo $this->Html->css('plugins/dataTables/dataTables.bootstrap'); ?>
  <?php echo $this->Html->css('plugins/dataTables/dataTables.responsive'); ?>
  <?php echo $this->Html->css('plugins/dataTables/dataTables.tableTools.min'); ?>
  <?php echo $this->Html->css('enjin/02_selection.css'); ?>

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

  <!-- Date range picker -->
  <?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>

  <!-- Data picker -->
  <?php echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js'); ?>


  <!-- Data table -->
  <?php echo $this->Html->script('plugins/jeditable/jquery.jeditable.js'); ?>
  <?php echo $this->Html->script('plugins/dataTables/jquery.dataTables.js'); ?>
  <?php echo $this->Html->script('plugins/dataTables/dataTables.bootstrap.js'); ?>
  <?php echo $this->Html->script('plugins/dataTables/dataTables.responsive.js'); ?>
  <?php echo $this->Html->script('plugins/dataTables/dataTables.tableTools.min.js'); ?>

  <!-- script for display a list inside areatext -->



  <script>
    $(document).ready(function(){
      $('.dataTables-example').dataTable({
        responsive: true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
          "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
        },
        "bPaginate": true,
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

        $('#data_1 .input-group.date').datepicker({
          todayBtn: "linked",
          keyboardNavigation: false,
          forceParse: false,
          calendarWeeks: true,
          autoclose: true
        });




        /* full calendar
        --------------------------------*/

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

</body>

</html>
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

</head>

<body class='detailsscreen'>

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
              <h2>エージェント管理</h2>
            </div>
          </div>
          <div class="wrapper wrapper-content row animated fadeInRight clearfix">
            <!-- content -->   



            <!--table 3 content-->

            <div class='col-lg-12'>
                <!-- <div class='col-lg-12 wrapper-content-large-border border_content_table'>

                  <div class='content_border_title'> 送信先
                    <div class='clear'></div>
                  </div> -->
                  <div class="ibox no-margin-bottom">
                    <div class="ibox-title">
                      <h5>流入元企業一</h5>

                    </div>
                    <div class="ibox-content bg-gray clearfix form-edit2 p-sm">
                      <form>

                        <div class="form-group clearfix">
                          <div class="col-lg-12">
                            <label class="col-lg-1 pull-left">候補者</label>
                            <div class="col-lg-3">
                              <select class="form-control">
                                <option value="1">流入元担当者</option>
                                <option value="2">候補者</option>
                                <option value="3">採用担当者</option>
                              </select>
                            </div>
                          </div>
                        </div>


                        

                        <div class='form-group clearfix'>
                          <div class="col-lg-4">
                            <label class="col-sm-1 pull-left">氏</label>

                            <div class="col-sm-10"> 
                              <input class='form-control' type='text' value='Textbox'>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <label class="col-sm-1 pull-left">名</label>
                            <div class="col-sm-10"> 
                              <input class='form-control' type='text' value='Textbox'>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <label class="col-sm-5 pull-left">メールアドレス</label>

                            <div class="col-sm-7"> 
                              <input class='form-control' type='text' value='Textbox'>
                            </div>
                          </div>
                        </div>

                        <div class="form-group clearfix">
                          <div class="col-lg-3">
                            <label class="pull-left">送信期間</label>
                            <div id="data_1">

                              <div class="input-group date">
                                <span class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control ct-select1" value="03/04/2014">
                              </div>

                            </div>
                          </div>
                          <div class="col-lg-3">
                            <label class="pull-left1">か ら</label>
                            <div id="data_1">
                              <div class="input-group date">
                                <span class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control" value="03/04/2014">
                              </div>
                            </div>
                          </div>
                          <label class="pull-left">ま で</label>
                        </div>

                        <div class="form-group clearfix">

                          <div class="col-lg-4">
                            <label class="pull-left">送信ステータス</label>
                            <select class="form-control ct-select2">
                              <option value="1"> 成功 </option>
                              <option value="2">3 成功 </option>
                              <option value="3">4 成功</option>
                            </select>
                          </div>

                          <div class="col-lg-8">
                            <label class="pull-left">テンプレート</label>
                            <select class="form-control ct-select2">
                              <option value="1">テンプレート選択</option>
                              <option value="2">テンプレート選択</option>
                              <option value="3">テンプレート選択</option>
                            </select>
                          </div>
                          
                        </div>


                        <div class="form-group clearfix">
                          <div class="col-lg-4">
                            <label class="pull-left">求人票</label>
                            <select class="form-control ct-select2">
                              <option value="1"> 求人票選択 </option>
                              <option value="2">3 2016年度新卒・営業 </option>
                              <option value="3">4 2016年度新卒・営業</option>
                            </select>
                          </div>

                          <div class="col-lg-8 row">
                            <label class="pull-left">イベント</label>
                            <select class="form-control ct-select2">
                              <option value="1">ナビ</option>
                              <option value="2">ナビ</option>
                              <option value="3">2016年度新卒・営業</option>
                            </select>
                          </div>
                          
                        </div>



                        <div class="from_calen">
                          <button type="button" class="btn btn-primary btn-sm">検索</button>
                          <button type="button" class="btn btn-primary btn-sm">ク リ ア</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="clear"></div>

                  <div class="ibox-content">
                    <button type="button" class="btn btn-primary btn-sm m-b-sm">印 刷</button>
                    <div class="col-lg-6 pull-right">
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
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th><u>メール送信ID</u></th>                              
                          <th><u>送信日時</u></th>
                          <th><u>送信先</u></th>
                          <th><u>会社名／大学名</u></th>
                          <th><u>メールアドレス</u></th>
                          <th><u>テンプレート</u></th> 
                          <th><u>送信ステータス</u></th>                                         
                        </tr>

                      </thead>
                      <tbody>
                        <tr> 
                          <td class='button_cen'><a href="">MAIL00001</a></td>                              
                          <td class='button_cen'><a href="">2015/07/19　10:00</a></td>
                          <td class='button_cen'>田中　太郎</td>
                          <td class='button_cen'>輪瀬田大学</td>
                          <td class='button_cen'><a href="">t.tanaka@gmail.com</a></td>
                          <td class='button_cen'>会社説明会A</td>
                          <td class='button_cen'>成功</td>
                        </td>
                      </tr>
                      <tr> 
                        <td class='button_cen'><a href="">MAIL00001</a></td>                              
                        <td class='button_cen'><a href="">2015/07/19　10:00</a></td>
                        <td class='button_cen'>田中　太郎</td>
                        <td class='button_cen'>輪瀬田大学</td>
                        <td class='button_cen'><a href="">t.tanaka@gmail.com</a></td>
                        <td class='button_cen'>会社説明会A</td>
                        <td class='button_cen'>成功</td>
                      </td>
                    </tr>
                    <tr> 
                      <td class='button_cen'><a href="">MAIL00001</a></td>                              
                      <td class='button_cen'><a href="">2015/07/19　10:00</a></td>
                      <td class='button_cen'>田中　太郎</td>
                      <td class='button_cen'>輪瀬田大学</td>
                      <td class='button_cen'><a href="">t.tanaka@gmail.com</a></td>
                      <td class='button_cen'>会社説明会A</td>
                      <td class='button_cen text-danger'>成功</td>
                    </td>
                  </tr>
                  <tr> 
                    <td class='button_cen'><a href="">MAIL00001</a></td>                              
                    <td class='button_cen'><a href="">2015/07/19　10:00</a></td>
                    <td class='button_cen'>田中　太郎</td>
                    <td class='button_cen'>輪瀬田大学</td>
                    <td class='button_cen'><a href="">t.tanaka@gmail.com</a></td>
                    <td class='button_cen'>会社説明会A</td>
                    <td class='button_cen'>成功</td>
                  </td>
                </tr>
                <tr> 
                  <td class='button_cen'><a href="">MAIL00001</a></td>                              
                  <td class='button_cen'><a href="">2015/07/19　10:00</a></td>
                  <td class='button_cen'>田中　太郎</td>
                  <td class='button_cen'>輪瀬田大学</td>
                  <td class='button_cen'><a href="">t.tanaka@gmail.com</a></td>
                  <td class='button_cen'>会社説明会A</td>
                  <td class='button_cen'>成功</td>
                </td>
              </tr>
              <tr> 
                <td class='button_cen'><a href="">MAIL00001</a></td>                              
                <td class='button_cen'><a href="">2015/07/19　10:00</a></td>
                <td class='button_cen'>田中　太郎</td>
                <td class='button_cen'>輪瀬田大学</td>
                <td class='button_cen'><a href="">t.tanaka@gmail.com</a></td>
                <td class='button_cen'>会社説明会A</td>
                <td class='button_cen'>成功</td>
              </td>
            </tr>

          </tbody>
          <tfoot>
            <tr>
              <th><u>メール送信ID</u></th>                              
              <th><u>送信日時</u></th>
              <th><u>送信先</u></th>
              <th><u>会社名／大学名</u></th>
              <th><u>メールアドレス</u></th>
              <th><u>テンプレート</u></th> 
              <th><u>送信ステータス</u></th>                                   
            </tr>
          </tfoot>
        </table>

        <button type="button" class="btn btn-primary btn-sm m-b-sm">印 刷</button>
        <!------------pagination-------------->

        <div class="col-lg-6 pull-right">
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

  </div><!-- ligne solid-->

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
</div>



