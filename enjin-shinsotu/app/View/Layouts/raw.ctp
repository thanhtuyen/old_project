<?php
//restrict html for html pages
if($this->request->controller=='pages'){
echo $this->fetch('content');
return;
}

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());

//blocks
$this->start('css');
echo $this->Html->css('bootstrap/bootstrap.min');
//echo $this->Html->css('cake.generic');
echo $this->Html->css('font-awesome/css/font-awesome');
//echo $this->Html->css('plugins/iCheck/custom');

echo $this->Html->css('bootstrap/animate');
echo $this->Html->css('bootstrap/style');
echo $this->Html->css('plugins/iCheck/custom.css');
echo $this->Html->css('enjin/global');
echo $this->Html->css('enjin/02_selection.css');
echo $this->Html->css('plugins/dataTables/dataTables.bootstrap');
echo $this->Html->css('plugins/dataTables/dataTables.responsive');
echo $this->Html->css('plugins/dataTables/dataTables.tableTools.min');
echo $this->Html->css('plugins/daterangepicker/daterangepicker-bs3.css');
echo $this->Html->css('plugins/datapicker/datepicker3.css');
echo $this->Html->css('enjin/email');
$this->end();
////

//blocks
$this->start('script');
echo $this->Html->script('jquery-2.1.1.js');
echo $this->Html->script('jquery.tmpl.js');
echo $this->Html->script('bootstrap.min.js');
echo $this->Html->script('plugins/metisMenu/jquery.metisMenu.js');
echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js');

echo $this->Html->script('plugins/iCheck/icheck.min.js');
echo $this->Html->script('plugins/datapicker/bootstrap-datepicker.js');

echo $this->Html->script('inspinia.js');

echo $this->Html->script('plugins/fullcalendar/moment.min.js');

echo $this->Html->script('kiwi.js');
$this->end();


////
?>

<!DOCTYPE html>
<html>

<head>
    <?php echo $this->Html->charset(); ?>
    <title>ENJIN新卒　採用担当者ログイン
    </title>
    <?php
  echo $this->Html->meta('icon');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>

<body>
<div id="content-wrapper">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
</div>
</body>
</html>