<!DOCTYPE html>
<html>

<head>

  <?php echo $this->Html->charset('utf-8'); ?> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>求人票管理 − 求人登録</title>
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
  <!-- end css -->
  <!-- Mainly scripts -->
      <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
      <?php echo $this->Html->script('bootstrap.min.js'); ?>

      <!-- Custom and plugin javascript -->
      <?php echo $this->Html->script('inspinia.js'); ?>
      <?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
      <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>

      <!-- Chosen -->
      <?php echo $this->Html->script('plugins/chosen/chosen.jquery.js'); ?>

      <!-- JSKnob -->
      <?php echo $this->Html->script('plugins/jsKnob/jquery.knob.js'); ?>

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

      <script>
        $(document).ready(function () {

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


          $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
          });

          $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
          });

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


</script>

</head>

<body class='jobregistration'>

  <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
          <li class="nav-header">
            <div class="dropdown profile-element">  <span>
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
                <?php echo $this->Html->image("bootstrap/logo_enjin.png", array("alt" => "logo",)); ?>
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
            <h2>求人票登録</h2>
          </div>
        </div>
        <!-- end title -->

        <div class="wrapper wrapper-content row animated fadeInRight clearfix">
          <!-- content -->    
          <div class='full-content'>
            <div class='col-lg-8'>
              <div class=''>
                <div class="ibox-title"> 
                  <h5>求人票一覧</h5>                  
                </div>

                <!-- form add -->
                <div class="ibox-content bg-white p-sm pd-bottom-none pd-right-none">
                  <form method="get" class="form-horizontal form-edit">

                    <div class="form-group"><label class="col-sm-4 control-label">タイトル</label>
                      <div class="col-sm-8"><input type="text" class="form-control" value="タイトル入力"></div>
                    </div>

                    <div class="form-group"><label class="col-sm-4 control-label">言語</label>
                      <div class="col-sm-8">
                        <select class='form-control' id="select" name="select">
                          <option value="1">部署選択</option>
                          <option value="2">2017</option>
                          <option value="3">2018</option>
                        </select>
                      </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-4 control-label">募集要項</label>
                      <div class="col-sm-8">
                        <textarea cols='0' rows='4' class='form-control'>募集要項入力</textarea>
                      </div>
                    </div>

                    <div class="form-group"><label class="col-sm-4 control-label">職種タイプ</label>
                      <div class="col-sm-8">
                        <select class='form-control' id="select" name="select">
                          <option value="1">職種タイプ選択</option>
                          <option value="2">2017</option>
                          <option value="3">2018</option>
                        </select>
                      </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-4 control-label">待遇</label>
                      <div class="col-sm-8">
                        <textarea cols='0' rows='4' class='form-control'>募集要項入力</textarea>
                      </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-4 control-label">応募資格</label>
                      <div class="col-sm-8">
                        <textarea cols='0' rows='4' class='form-control'>募集要項入力</textarea>
                      </div>
                    </div> 
                    <div class="form-group"><label class="col-sm-4 control-label">応募資格</label>
                      <div class="col-sm-8">
                        <div class="" id="data_1">
                          <input type="number" value="0" class="form-control text-right w-95">
                        </div>
                      </div>
                    </div> 
                    <div class="form-group"><label class="col-sm-4 control-label">応募期限</label>
                    <div class="padding-lf30 col-sm-8">
                        <div class="form-group f_left" id="data_1">
                            <div class="input-group date">
                              <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </span>
                              <input type="text" class="form-control" value="03/04/2014">
                            </div>
                          </div>

                          <div class="input-group clockpicker f_right_calendar" data-autoclose="true">

                            <span class="input-group-addon">
                              <span class="fa fa-clock-o"></span>
                            </span>
                            <input type="text" class="form-control" value="09:30" >
                          </div>
                          <div class="clear"></div>
                        <!--clock-->
                      </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-4 control-label">公開開始日時</label>
                      <div class="padding-lf30 col-sm-8">
                        <div class="form-group f_left" id="data_1">
                            <div class="input-group date">
                              <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </span>
                              <input type="text" class="form-control" value="03/04/2014">
                            </div>
                          </div>

                          <div class="input-group clockpicker f_right_calendar" data-autoclose="true">

                            <span class="input-group-addon">
                              <span class="fa fa-clock-o"></span>
                            </span>
                            <input type="text" class="form-control" value="09:30" >
                          </div>
                          <div class="clear"></div>
                      </div> 

                      <div class="form-group"><label class="col-sm-4 control-label">募集エリアID</label>
                        <div class="padding-lf35 col-sm-8 row">
                          <select class='form-control' id="select" name="select">
                            <option value="1">エリア選択</option>
                            <option value="2">2017</option>
                            <option value="3">2018</option>
                          </select>
                        </div>
                      </div> 

                      <div class="form-group"><label class="col-sm-4 control-label">募集年度</label>
                        <div class="padding-lf35 col-sm-8 row"><input type="text" class="form-control" value="2016年"></div>
                      </div> 

                      <div class="form-group"><label class="col-sm-4 control-label">リクナビID</label>
                        <div class="padding-lf35 col-sm-8 row"><input type="text" class="form-control" value="ID入力"></div>
                      </div> 

                      <div class="form-group"><label class="col-sm-4 control-label">マイナビID</label>
                        <div class="padding-lf35 col-sm-8 row"><input type="text" class="form-control" value="ID入力"></div>
                      </div> 

                      <div class="btn-clear text-center">                          
                        <a href="#" class="text-navy">ク リ ア</a>
                        <button class="btn-tab btn-primary w-95" id="return-edit" type="">登録する</button>
                      </div>
                    </form>
                  </div>
                  <!-- end form add -->

                </div>
              </div>
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
