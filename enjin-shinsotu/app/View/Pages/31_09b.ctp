<!DOCTYPE html>
<html>

<head>
  <?php echo $this->Html->charset('utf-8'); ?> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>候補者管理 − 候補者登録</title>

  <?php echo $this->Html->css('enjin/animate'); ?>
  <?php echo $this->Html->css('bootstrap/bootstrap.min'); ?>
   <?php echo $this->Html->css('plugins/datapicker/datepicker3'); ?>
  <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3'); ?>
  <?php echo $this->Html->css('font-awesome/css/font-awesome'); ?>
  <?php echo $this->Html->css('plugins/iCheck/custom'); ?>
  <?php echo $this->Html->css('bootstrap/style'); ?>
  <?php echo $this->Html->css('enjin/global'); ?>
  <?php echo $this->Html->css('enjin/email'); ?>
  <?php echo $this->Html->css('enjin/master'); ?>







  <!-- ================================================JSSSS==================================================== -->
   <?php echo $this->Html->script('plugins/fullcalendar/moment.min.js'); ?>
              <?php echo $this->Html->script('jquery-2.1.1.js'); ?>
              <?php echo $this->Html->script('bootstrap.min.js'); ?>
              <?php echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js'); ?>
              <?php echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js'); ?>
              <?php echo $this->Html->script('inspinia.js'); ?>
              <?php echo $this->Html->script('plugins/pace/pace.min.js'); ?>
              <?php echo $this->Html->script('jquery-ui.custom.min.js'); ?>
              <?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>
              <!-- Switchery -->
              <?php echo $this->Html->script('plugins/switchery/switchery.js'); ?>
              <!-- Date range picker -->
              <?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>


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


              <script>
              $(document).ready(function(){
                $('.i-checks').iCheck({
                  checkboxClass: 'icheckbox_square-green',
                  radioClass: 'iradio_square-green',
                });
              });
              document.getElementById("uploadfile").onchange = function () {
                var filename = this.value;
                var lastIndex = filename.lastIndexOf("\\");
                if (lastIndex >= 0) {
                  filename = filename.substring(lastIndex + 1);
                }
                document.getElementById("filename").value = filename;
              };

              </script>
              <script>
              $(document).ready(function(){

                var $image = $(".image-crop > img")
                $($image).cropper({
                  aspectRatio: 1.618,
                  preview: ".img-preview",
                  done: function(data) {
                    // Output the result data for cropping image.
                  }
                });

                var $inputImage = $("#inputImage");
                if (window.FileReader) {
                  $inputImage.change(function() {
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

                $("#download").click(function() {
                  window.open($image.cropper("getDataURL"));
                });

                $("#zoomIn").click(function() {
                  $image.cropper("zoom", 0.1);
                });

                $("#zoomOut").click(function() {
                  $image.cropper("zoom", -0.1);
                });

                $("#rotateLeft").click(function() {
                  $image.cropper("rotate", 45);
                });

                $("#rotateRight").click(function() {
                  $image.cropper("rotate", -45);
                });

                $("#setDrag").click(function() {
                  $image.cropper("setDragMode", "crop");
                });

                $('.data_1 .input-group.date').datepicker({
                  todayBtn: "linked",
                  keyboardNavigation: false,
                  forceParse: false,
                  calendarWeeks: true,
                  autoclose: true
                });

                $('#data_2 .input-group.date').datepicker({
                  todayBtn: "linked",
                  keyboardNavigation: false,
                  forceParse: false,
                  calendarWeeks: true,
                  autoclose: true
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
                var switchery = new Switchery(elem, { color: '#1AB394' });

                var elem_2 = document.querySelector('.js-switch_2');
                var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

                var elem_3 = document.querySelector('.js-switch_3');
                var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

                $('.i-checks').iCheck({
                  checkboxClass: 'icheckbox_square-green',
                  radioClass: 'iradio_square-green'
                });

                $('.demo1').colorpicker();

                var divStyle = $('.back-change')[0].style;
                $('#demo_apidemo').colorpicker({
                  color: divStyle.backgroundColor
                }).on('changeColor', function(ev) {
                  divStyle.backgroundColor = ev.color.toHex();
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
                  dateLimit: { days: 60 },
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
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                  }
                }, function(start, end, label) {
                  console.log(start.toISOString(), end.toISOString(), label);
                  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                });


});
var config = {
  '.chosen-select'           : {},
  '.chosen-select-deselect'  : {allow_single_deselect:true},
  '.chosen-select-no-single' : {disable_search_threshold:10},
  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
  '.chosen-select-width'     : {width:"95%"}
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

$(".dial").knob();

$("#basic_slider").noUiSlider({
  start: 40,
  behaviour: 'tap',
  connect: 'upper',
  range: {
    'min':  20,
    'max':  80
  }
});

$("#range_slider").noUiSlider({
  start: [ 40, 60 ],
  behaviour: 'drag',
  connect: true,
  range: {
    'min':  20,
    'max':  80
  }
});

$("#drag-fixed").noUiSlider({
  start: [ 40, 60 ],
  behaviour: 'drag-fixed',
  connect: true,
  range: {
    'min':  20,
    'max':  80
  }
});


</script>



</head>

<body class="csv">

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

                    <!-- --------------start contents----------------- -->  
                    <!-- --------------start contents----------------- -->  
                    <!-- --------------start contents----------------- -->  
                    <!-- --------------start contents----------------- -->  
                  <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                      <h2>求人募集エリア</h2>
                    </div>
                  </div>

            <div class="row wrapper wrapper-content animated fadeInRight title-button pd-bottom-none">
                <div class = "clear10"></div>
                <div class="margin-top-15 col-lg-6">
                  <div class = "ibox">
                    <div class="ibox-title">
                    <h5>募集エリア</h5>
                  </div>
                  <div class="ibox-content clearfix p-sm">

                          <div class="">
                            <div class="table-border">
                            <!-- ------------------- -->
                              <form method="get" class="form-horizontal">
                                <div class="form-group"><label class="col-sm-4 control-label">流入元契約I D</label>
                                  <div class="col-sm-8">
                                    <div class="form-control border-none">contrac t0001</div>
                                  </div>
                                </div>
                              <div class="form-group"><label class="col-sm-4 control-label">タイトル</label>
                                <div class="col-sm-8"><input type="text" class="form-control" value="エンジン固定契約"></div>
                              </div>
                              <div class = "clear10"></div>
                              <div class="form-group data_1" id=""><label class="col-sm-4 control-label">契約開始日</label>
                                  <div class="col-sm-4">
                                    <div class="input-group date">
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                      <input type="text" class="form-control" value="2012/04">
                                    </div>
                                  </div>
                                </div>
                                <div class = "clear10"></div>
                                <div class="form-group data_1" id=""><label class="col-sm-4 control-label">契約開始日</label>
                                  <div class="col-sm-4">
                                    <div class="input-group date">
                                      <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                      <input type="text" class="form-control" value="2012/04">
                                    </div>
                                  </div>
                                </div>
                                <div class = "clear10"></div>
                                <div class="form-group"><label class="col-sm-4 control-label">契約タイプ</label>
                                  <div class="col-sm-4">
                                   
                                    <select class="form-control">
                                      <option>固定</option>
                                      <option>年収割合</option>
                                      <option>無制限</option>


                                    </select>
                                  </div>
                                </div>
                                <div class = "clear10"></div>
                                <div class="form-group"><label class="col-sm-4 control-label">採用Fe e 固定単価</label>
                                  <div class="col-sm-8"><input type="text" class="form-control" value="100,000円"></div>
                                </div>
                                <div class = "clear10"></div>
                              <div class="form-group"><label class="col-sm-4 control-label">ステータス</label>
                                  <div class="col-sm-4">
                                  
                                    <select class="form-control">
                                      <option>文系</option>
                                      <option>文系</option>
                                      <option>文系</option>

                                    </select>
                                  </div>
                                </div>
                              </form>

              <!-- ------------------- -->

                            </div>
                            <div class = "clear15"></div>
                            <p class = "text-center">
                            <a  class = "margin20 text-center text-navy" ref="#">キャンセル</a>
                            <a href="31_09" class=" btn btn-primary btn-sm">更新</a>
                          </p>
                          </div>  
                        </div>
                        </div>
                          
                </div>
                    <!-- ---------------end contents------------ --> 
                    <!-- ---------------end contents------------ --> 
                    <!-- ---------------end contents------------ --> 
                    <!-- ---------------end contents------------ --> 
                    
                <br>
                <br>
                <div class='clearfix'></div>
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