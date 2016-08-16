<?php
//restrict html for html pages
if($this->request->controller=='pages'){
	echo $this->fetch('content');
	return;
}


//blocks
$this->start('css');
echo $this->Html->css('bootstrap/bootstrap.min');
//echo $this->Html->css('cake.generic');
echo $this->Html->css('font-awesome/css/font-awesome');
//echo $this->Html->css('plugins/iCheck/custom');

echo $this->Html->css('bootstrap/animate');
echo $this->Html->css('bootstrap/style');
echo $this->Html->css('plugins/iCheck/custom.css');

echo $this->Html->css('enjin/02_selection.css');

echo $this->Html->css('plugins/dataTables/dataTables.bootstrap');
echo $this->Html->css('plugins/dataTables/dataTables.responsive');
echo $this->Html->css('plugins/dataTables/dataTables.tableTools.min');
echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3.css');
echo $this->Html->css('plugins/clockpicker/clockpicker.css');
echo $this->Html->css('plugins/datapicker/datepicker3.css');
echo $this->Html->css('plugins/fullcalendar/fullcalendar.css');
echo $this->Html->css('plugins/clockpicker/clockpicker');
echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3');
echo $this->Html->css('plugins/switchery/switchery');
echo $this->Html->css('enjin/email');
echo $this->Html->css('enjin/global');
$this->end();
////

//blocks
$this->start('script');
echo $this->Html->script('jquery-2.1.1');
echo $this->Html->script('jquery-ui.custom.min');
echo $this->Html->script('jquery.tmpl');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('plugins/metisMenu/jquery.metisMenu');
echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min');

echo $this->Html->script('plugins/iCheck/icheck.min');
echo $this->Html->script('plugins/datapicker/bootstrap-datepicker');

echo $this->Html->script('inspinia');

echo $this->Html->script('plugins/fullcalendar/moment.min');
echo $this->Html->script('plugins/fullcalendar/fullcalendar.min');
echo $this->Html->script('plugins/jeditable/jquery.jeditable');
echo $this->Html->script('plugins/dataTables/jquery.dataTables');
echo $this->Html->script('plugins/dataTables/dataTables.bootstrap');
echo $this->Html->script('plugins/dataTables/dataTables.responsive');
echo $this->Html->script('plugins/dataTables/dataTables.tableTools.min');
echo $this->Html->script('plugins/clockpicker/clockpicker');
echo $this->Html->script('plugins/daterangepicker/daterangepicker');
echo $this->Html->script('plugins/pace/pace.min');
echo $this->Html->script('plugins/peity/jquery.peity.min');
echo $this->Html->script('plugins/switchery/switchery');

echo $this->Html->script('kiwi');
$this->end();
////
?>

<!DOCTYPE html>
<html>

<head>
	<?php echo $this->Html->charset(); ?>
	<title>enjin -新卒採用-</title>
	<?php
  echo $this->Html->meta('icon');
  echo $this->fetch('meta');
  echo $this->fetch('css');
  echo $this->fetch('single');
  echo $this->enjin->getCssOrigin($this->name, $this->action);
  echo $this->fetch('script');
  ?>

</head>

<body>
	<div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <?php
                $menu = $this->Enjin->getMenu();
                if ( !empty( $menu ) ) echo $this->element($menu);
                ?>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
<div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>    
                    </div>

                    <div class="nav navbar-top-links navbar-right logo_enjin">
                        <img src="<?php echo $this->webroot; ?>img/logo_enjin2.png" alt="logo">
                    </div>

                    <div class="nav navbar-top-links navbar-right logo_enjin">
                        <div class="btn-group">
                            <?php
                            if (isset($wanted_year)) {
                                ?>
                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle h-30 l-h-7" aria-expanded="false"><?php echo $wantedyear?><span class="caret"></span></button>
                                <ul id="wydd" class="dropdown-menu">
                                    <?php foreach ($wanted_year as $wy): ?>
                                    <li><a href="#"><?php echo $wy;?></a></li>
                                <?php endforeach;?>
                            </ul>
                            <form id="f_wanted_year" method="post">
                                <input type="hidden" name="year" id="year">
                            </form>
                            <script>
                            $( document ).ready(function(){
                                $("#wydd a").click(function (){
                                    $("#year").val(this.innerText);
                                    $("#wydd").prev().html(this.innerText+'<span class="caret"></span>');
                                    //console.log( $(this).prev().html());
                                    //return false;
                                    $.post("<?php echo $this->Html->url(array('controller'=>'JobVotes', 'action'=>'api_set_wanted_year'))?>", $("#f_wanted_year").serialize(), function (data){if(!data.code) location.reload()});
                                    return false;
                                });
                            });
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                                <ul class="nav navbar-top-links navbar-right">
                    <!-- <li class="dropdown">
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
                                </li> -->
                                <li>
                                    <!--logout-->
                                    <?php
                                    echo $this->Html->link(
                                        'Log out',
                                        array(
                                            'controller' => 'Companies',
                                            'action' => 'logout',
                                            'full_base' => true,
                                            )
                                        );
                                        ?>
                                        <!--end logout-->
                                    </li>
                                </ul>
                            </nav>
</div>

<div id="content-wrapper">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
</div>
  
<div class="footer">
    <div>
      <strong>Copyright</strong> Enjin Company © 2015
  </div>
</div>

</div>
<!--end #page-wrapper-->
</div>
<!-- end #wrapper -->
<?php echo $this->element('sql_dump'); ?>
</body>
</html>