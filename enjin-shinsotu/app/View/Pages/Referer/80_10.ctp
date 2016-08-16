<?php
/*edited by [V]*/
?>
<!DOCTYPE html>
<html><head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	<title>enjin -新卒採用-</title>
<?php
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
?>

<?php
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
?>
	</head>

	<body class="pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="-webkit-transform: translate3d(100%, 0px, 0px);">
				<div class="pace-progress-inner"></div>
			</div>
			<div class="pace-activity"></div></div>
		<div id="wrapper">
			<nav class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<!--menu recruiter-->
					<ul class="nav metismenu" id="side-menu">
						<li class="nav-header">
						</li>
						<li>
							<a href="/Companies/dashbord">
								<i class="fa fa-th-large"></i>
								<span class="nav-label">ダッシュボード</span>
								<span></span>
							</a>
						</li>
						<li>
							<a href="/SelHistories/index">
								<i class="fa fa-diamond"></i>
								<span class="nav-label">選考管理</span>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-bar-chart-o"></i>
								<span class="nav-label">イベント管理</span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse">
								<li><a href="/EvEvents/index">イベントカレンダー</a></li>
								<li><a href="/EvEvents/search">イベント一覧</a></li>
								<li><a href="/EvEvents/add">イベント登録</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-envelope"></i>
								<span class="nav-label">候補者管理</span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse">
								<li><a href="/CanCandidates/index">候補者一覧</a></li>
								<li><a href="/CanCandidates/add">候補者登録</a></li>
								<li><a href="/CanCandidates/csv_add">候補者CSV登録</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-pie-chart"></i>
								<span class="nav-label">求人票管理</span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse">
								<li><a href="/JobVotes/index">求人票一覧</a></li>
								<li><a href="/JobVotes/add">求人票登録</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-flask"></i>
								<span class="nav-label">エージェント管理</span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse">
								<li><a href="/RefererCompanies/index">エージェント企業一覧</a></li>
								<li><a href="/RefererCompanies/add">エージェント企業登録</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-edit"></i>
								<span class="nav-label">メール送信管理</span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse">
								<li><a href="/MlSendHistories/">送信履歴</a></li>
								<li><a href="/MailTemplates/">テンプレート</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-desktop"></i>
								<span class="nav-label">マスタ管理</span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level collapse">
								<li><a href="/RecDepartments/">自社情報</a></li>
								<li><a href="/ScreeningStages/">選考段階</a></li>
								<li><a href="/RecruitmentAreas/">求人募集エリア</a></li>
								<li><a href="/Schools/index">学校マスタ</a></li>
							</ul>
						</li>
					</ul>
					<!--end menu recruiter-->
				</div>
			</nav>

			<div id="page-wrapper" class="gray-bg" style="min-height: 377px;">
				<div class="row border-bottom">
					<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
						<div class="navbar-header">
							<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>    
						</div>

						<div class="nav navbar-top-links navbar-right logo_enjin">
							<img src="/img/logo_enjin2.png" alt="logo">
						</div>

						<div class="nav navbar-top-links navbar-right logo_enjin">
							<div class="btn-group">
							</div>
						</div>
						<ul class="nav navbar-top-links navbar-right">
							<li>
								<!--logout-->
								<a href="http://localhost/Companies/logout">Log out</a>                                        <!--end logout-->
							</li>
						</ul>
					</nav>
				</div>

				<div id="content-wrapper">
					<link rel="stylesheet" type="text/css" href="/css/enjin/page26_08.css"><link rel="stylesheet" type="text/css" href="/css/plugins/switchery/switchery.css"><div class="row wrapper border-bottom white-bg page-heading">
						<div class="col-lg-10">
							<h2>選考段階</h2>
						</div>
					</div>

					<div class="wrapper wrapper-content row animated fadeInRight clearfix pd-bottom-none">
    <div class='col-lg-12'>
    <div class='ibox'>
        <div class='ibox-title'><h5>イベントカレンダー</h5></div>
        <div class='ibox-content bg-white p-sm'>      
            <div class="fc fc-ltr fc-unthemed">
                            <div class="fc-toolbar">
                            <div class="fc-left">
                                <div class="fc-button-group">
                                    <button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left" onclick="location.href=''">
                                        <span class="fc-icon fc-icon-left-single-arrow"></span>
                                    </button>
                                    <button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right" onclick="location.href=''">
                                        <span class="fc-icon fc-icon-right-single-arrow"></span>
                                    </button>
                                </div>
                                <button type="button" class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right" onclick="location.href='<?php echo $this->html->url(array('controller' => 'EvEvents', 'action' => 'index'));?>'">今月</button>
                            </div>
                            <div class="fc-center"><h2>2015/08</h2></div>
                        </div>
                    </div>
            <?php $evHisStatus = $this->Enjin->getEvHistoryStatus(); ?>
                    
            <table class="table table-bordered no-margin-bottom subcontents-sb-1">
                

                <tbody>
                    <tr>
                        <th>日</th>
                        <th>曜日</th>
                        <th>イベント名</th>
                        <th>開始時刻</th>
                        <th>終了時刻</th>
                        <th>定員数</th>
                        <th>申し込み数</th>
                                                <th>予約中</th>
                                                <th>申込済</th>
                                                <th>候補者キャンセル連絡有</th>
                                                <th>主催者キャンセル</th>
                                                <th>参加済</th>
                                                <th>無断欠席</th>
                                                <th>削除</th>
                                            </tr>
                                                                                                                                                                    <tr><td>1&nbsp;</td>
                                <td>土&nbsp;</td>
                                                                <td><a href="/EvHistories/edit/13/25">座談会</a></td>
                                <td>13:00:00</td>
                                <td>16:00:00</td>
                                <td>50</td>
                                <td>6                                                                                                            </td><td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>6</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                                                    </tr>
                                                                                                                                                            <tr>
                                <td>2&nbsp;</td>
                                <td>日&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>3&nbsp;</td>
                                <td>月&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>4&nbsp;</td>
                                <td>火&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>5&nbsp;</td>
                                <td>水&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>6&nbsp;</td>
                                <td>木&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>7&nbsp;</td>
                                <td>金&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                                                                                                            <tr><td>8&nbsp;</td>
                                <td>土&nbsp;</td>
                                                                <td><a href="/EvHistories/edit/3/5">インターン</a></td>
                                <td>09:00:00</td>
                                <td>18:00:00</td>
                                <td>20</td>
                                <td>5                                                                                                            </td><td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>5</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                                                    </tr>
                                                                                                                                                                                                                                                        <tr><td>9&nbsp;</td>
                                <td>日&nbsp;</td>
                                                                <td><a href="/EvHistories/edit/3/6">インターン</a></td>
                                <td>09:00:00</td>
                                <td>18:00:00</td>
                                <td>20</td>
                                <td>0                                                                                                            </td><td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                                                    </tr>
                                                                                                                                                            <tr>
                                <td>10&nbsp;</td>
                                <td>月&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>11&nbsp;</td>
                                <td>火&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>12&nbsp;</td>
                                <td>水&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>13&nbsp;</td>
                                <td>木&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>14&nbsp;</td>
                                <td>金&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                                                                                                            <tr><td>15&nbsp;</td>
                                <td>土&nbsp;</td>
                                                                <td><a href="/EvHistories/edit/1/1">説明会</a></td>
                                <td>10:00:00</td>
                                <td>13:00:00</td>
                                <td>50</td>
                                <td>7                                                                                                            </td><td>0</td>
                                                                            <td>1</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>6</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                                                    </tr>
                                                                                                                            <tr><td></td>
                                <td></td>
                                                                <td><a href="/EvHistories/edit/1/3">説明会</a></td>
                                <td>14:00:00</td>
                                <td>17:00:00</td>
                                <td>50</td>
                                <td>0                                                                                                            </td><td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                                                    </tr>
                                                                                                                                                            <tr>
                                <td>16&nbsp;</td>
                                <td>日&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>17&nbsp;</td>
                                <td>月&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>18&nbsp;</td>
                                <td>火&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>19&nbsp;</td>
                                <td>水&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>20&nbsp;</td>
                                <td>木&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>21&nbsp;</td>
                                <td>金&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                                                                                                            <tr><td>22&nbsp;</td>
                                <td>土&nbsp;</td>
                                                                <td><a href="/EvHistories/edit/5/9">一次選考</a></td>
                                <td>10:00:00</td>
                                <td>13:00:00</td>
                                <td>40</td>
                                <td>5                                                                                                            </td><td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>4</td>
                                                                            <td>1</td>
                                                                            <td>0</td>
                                                                                                    </tr>
                                                                                                                            <tr><td></td>
                                <td></td>
                                                                <td><a href="/EvHistories/edit/5/10">一次選考</a></td>
                                <td>14:00:00</td>
                                <td>17:00:00</td>
                                <td>40</td>
                                <td>0                                                                                                            </td><td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                                                    </tr>
                                                                                                                                                            <tr>
                                <td>23&nbsp;</td>
                                <td>日&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>24&nbsp;</td>
                                <td>月&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>25&nbsp;</td>
                                <td>火&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>26&nbsp;</td>
                                <td>水&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>27&nbsp;</td>
                                <td>木&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>28&nbsp;</td>
                                <td>金&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                                                                                                            <tr><td>29&nbsp;</td>
                                <td>土&nbsp;</td>
                                                                <td><a href="/EvHistories/edit/7/13">二次選考</a></td>
                                <td>10:00:00</td>
                                <td>13:00:00</td>
                                <td>30</td>
                                <td>4                                                                                                            </td><td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>3</td>
                                                                            <td>0</td>
                                                                            <td>1</td>
                                                                                                    </tr>
                                                                                                                            <tr><td></td>
                                <td></td>
                                                                <td><a href="/EvHistories/edit/7/14">二次選考</a></td>
                                <td>14:00:00</td>
                                <td>17:00:00</td>
                                <td>30</td>
                                <td>0                                                                                                            </td><td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                                                    </tr>
                                                                                                                                                            <tr>
                                <td>30&nbsp;</td>
                                <td>日&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                                                                <tr>
                                <td>31&nbsp;</td>
                                <td>月&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                                            </tbody>
                    <tbody><tr>
                        <th>日</th>
                        <th>曜日</th>
                        <th>イベント名</th>
                        <th>開始時刻</th>
                        <th>終了時刻</th>
                        <th>定員数</th>
                        <th>申し込み数</th>
                                                <th>予約中</th>
                                                <th>申込済</th>
                                                <th>候補者キャンセル連絡有</th>
                                                <th>主催者キャンセル</th>
                                                <th>参加済</th>
                                                <th>無断欠席</th>
                                                <th>削除</th>
                                            </tr>
            </tbody></table>
             <div class="fc fc-ltr fc-unthemed mrt15">
                            <div class="fc-toolbar">
                            <div class="fc-left">
                                <div class="fc-button-group">
                                    <button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left" onclick="location.href=''">
                                        <span class="fc-icon fc-icon-left-single-arrow"></span>
                                    </button>
                                    <button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right" onclick="location.href=''">
                                        <span class="fc-icon fc-icon-right-single-arrow"></span>
                                    </button>
                                </div>
                                <button type="button" class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right" onclick="location.href='<?php echo $this->html->url(array('controller' => 'ev_events', 'action' => 'index'));?>'">今日</button>
                            </div>
                            <div class="fc-center"><h2>2015/08</h2></div>
                        </div>
                    </div>
        </div>      
    </div>
    
    <div class='ibox clearfix'>
    <?php if(1):?>
        <div class="ibox-title">
                                    <h5>開催日時未定イベント</h5>                                    
                                  </div>
                                  <div class='ibox-content bg-white p-sm'>
                                    <table class='table table-bordered no-margin-bottom'>
                                        <thead>
                      <tr class="">
                        <th>日</th>
                        <th>曜日</th>
                        <th>イベント名</th>
                        <th>開始時間</th>
                        
                        <th>終了時間</th>
                        <th>定員数</th>
                        <th>申込数</th>
                        <th>申込済</th>
                        <th>候補者キャンセル</th>
                        <th>主催者キャンセル</th>
                        <th>参加済</th>
                        <th>無断欠席</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php //foreach ($nonEvSchedules as $row ): ?>
                      <tr>
                      <td>--</td>
                      <td>--</td>
                        <td><a>abc</a></td>
                        <td>10:00</td>
                        <td>11:15</td>
                        <td>20</td>
                        <td><a>0</a></td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                      </tr>
                    <?php //endforeach;?>
                    
                    <tr>
                      <td>--</td>
                      <td>--</td>
                        <td><a>abc</a></td>
                        <td>10:00</td>
                        <td>11:15</td>
                        <td>20</td>
                        <td><a>0</a></td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                      </tr>
                      
                      <tr>
                      <td>--</td>
                      <td>--</td>
                        <td><a>abc</a></td>
                        <td>10:00</td>
                        <td>11:15</td>
                        <td>20</td>
                        <td><a>0</a></td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                      </tr>
                    </tbody>
                    <thead>
                     <tr class=" t-first">
                        <th>日</th>
                        <th>曜日</th>
                        <th>イベント名</th>
                        <th>開始時間</th>
                        
                        <th>終了時間</th>
                        <th>定員数</th>
                        <th>申込数</th>
                        <th>申込済</th>
                        <th>候補者キャンセル</th>
                        <th>主催者キャンセル</th>
                        <th>参加済</th>
                        <th>無断欠席</th>
                    </tr>
                  </thead>
                                    </table>    
                                  </div><br><br>
                                  <?php endif;?>
    </div>
    
    <div class='ibox clearfix'>
    <?php if(!empty($nonEvSchedules)):?>
        <div class="ibox-title">
                                    <h5>開催日時未定イベント</h5>                                    
                                  </div>
                                  <div class='ibox-content bg-white p-sm'>
                                    <table class='table table-bordered no-margin-bottom'>
                                        <thead>
                      <tr class="">
                        <th class="col-lg-3">イベント名</th>
                        <th class="col-lg-3">ターゲット選考段階名</th>
                        <th class="col-lg-3">ターゲット選考段階比較タイプ</th>
                        <th class="col-lg-3">求人票のタイトル</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($nonEvSchedules as $row ): ?>
                      <tr>
                        <td class="col-lg-3"><?php echo $this->Html->link($row['EvEvent']['name'], array('controller' => 'EvHistories', 'action' => 'add', $row['EvEvent']['id'])); ?></td>
                        <td class="col-lg-3"><?php echo $row['ScreeningStage']['name'] ?></td>
                        <td class="col-lg-3"></td>
                        <td class="col-lg-3"><?php echo $row['JobVote']['title'] ?></td>
                      </tr>
                    <?php endforeach;?>
                    </tbody>
                    <thead>
                     <tr class=" t-first">
                      <th class="col-lg-3">イベント名</th>
                      <th class="col-lg-3">ターゲット選考段階名</th>
                      <th class="col-lg-3">ターゲット選考段階比較タイプ</th>
                      <th class="col-lg-3">求人票のタイトル</th>
                    </tr>
                  </thead>
                                    </table>    
                                  </div><br><br>
                                  <?php endif;?>
    </div>

    </div>

   
    </div><!-- end box .wrapper-content -->
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
	
	</body></html>