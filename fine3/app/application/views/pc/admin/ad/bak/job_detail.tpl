{%include file="pc/admin/shared/_header.html"%}
{%include file="pc/admin/ads/_ads_menu.html"%}
<div class="innerLR plan_form">
<div class="widget widget-heading-simple widget-body-white" >
<div class="widget-head">
<h4 class="heading">ランキングの編集</h4>
<!-- widget-head --></div>
<table class="plan_form">
<tr>
<th>ID</th><td>[ranking|ranking_id]</td>
</tr>
<tr>
<th>タイトル</th>
<td><input type="text" placeholder="[ranking|title]" class="form-control plan_form" /></td>
</tr>
<tr>
<th>エリア</th>
<td><div class="checkbox"><label class="checkbox-custom"><input type="checkbox" name="checkbox" checked="checked"><i class="fa fa-fw fa-square-o checked"></i>全国　</label></div>
<div class="checkbox"><label class="checkbox-custom"><input type="checkbox" name="checkbox"><i class="fa fa-fw fa-square-o"></i>北海道　</label></div>
<div class="checkbox"><label class="checkbox-custom"><input type="checkbox" name="checkbox"><i class="fa fa-fw fa-square-o"></i>東北　</label></div>
<div class="checkbox"><label class="checkbox-custom"><input type="checkbox" name="checkbox"><i class="fa fa-fw fa-square-o"></i>関東　</label></div>
<div class="checkbox"><label class="checkbox-custom"><input type="checkbox" name="checkbox"><i class="fa fa-fw fa-square-o"></i>中部　</label></div>
<div class="checkbox"><label class="checkbox-custom"><input type="checkbox" name="checkbox"><i class="fa fa-fw fa-square-o"></i>近畿　</label></div>
<div class="checkbox"><label class="checkbox-custom"><input type="checkbox" name="checkbox"><i class="fa fa-fw fa-square-o"></i>中国　</label></div>
<div class="checkbox"><label class="checkbox-custom"><input type="checkbox" name="checkbox"><i class="fa fa-fw fa-square-o"></i>四国　</label></div>
<div class="checkbox"><label class="checkbox-custom"><input type="checkbox" name="checkbox"><i class="fa fa-fw fa-square-o"></i>九州　</label></div></td>
</tr>
<tr>
<th>開始日</th>
<td><input class="form-control datepicker1" type="text" value="2013-02-14"  /></td>
</tr>
<tr>
<th>終了日</th>
<td><input class="form-control datepicker1" type="text" value="2013-02-14"  /></td>
</tr>
<tr>
<th>公開非公開</th>
<td><div class="make-switch" data-on="success" data-off="default"><input type="checkbox" checked></div></td>
</tr>
</table>
<!-- widget --></div>

<div class="widget widget-heading-simple widget-body-white mini-div" >
<table class="plan_form">
<div class="widget-head">
<h4 class="heading">表示順：1位</h4>
<!-- widget-head --></div>
<tr>
<th>求人ID</th>
<td><input type="text" placeholder="[r_part|job_id]" class="form-control plan_form" /></td>
</tr>
</table>
<!-- widget --></div>

<div class="widget widget-heading-simple widget-body-white mini-div" >
<table class="plan_form">
<div class="widget-head">
<h4 class="heading">表示順：2位</h4>
<!-- widget-head --></div>
<tr>
<th>求人ID</th>
<td><input type="text" placeholder="[r_part|job_id]" class="form-control plan_form" /></td>
</tr>
</table>
<!-- widget --></div>

<div class="widget widget-heading-simple widget-body-white mini-div" >
<table class="plan_form">
<div class="widget-head">
<h4 class="heading">表示順：3位</h4>
<!-- widget-head --></div>
<tr>
<th>求人ID</th>
<td><input type="text" placeholder="[r_part|job_id]" class="form-control plan_form" /></td>
</tr>
</table>
<!-- widget --></div>

<div class="widget widget-heading-simple widget-body-white mini-div" >
<table class="plan_form">
<div class="widget-head">
<h4 class="heading">表示順：4位</h4>
<!-- widget-head --></div>
<tr>
<th>求人ID</th>
<td><input type="text" placeholder="[r_part|job_id]" class="form-control plan_form" /></td>
</tr>
</table>
<!-- widget --></div>

<div class="widget widget-heading-simple widget-body-white mini-div" >
<table class="plan_form">
<div class="widget-head">
<h4 class="heading">表示順：5位</h4>
<!-- widget-head --></div>
<tr>
<th>求人ID</th>
<td><input type="text" placeholder="[r_part|job_id]" class="form-control plan_form" /></td>
</tr>
</table>
<!-- widget --></div>


<div class="separator"></div>
<div class="form-group">
<a href="ranking.html"><input class="btn btn-primary" type="submit" value="この内容で登録する"></a>
　<a href="ranking.html"><input class="btn btn-default" type="submit" value="削除"></a></div>

{%form_close()%}
<!-- separater --></div>

<!-- innnerLR --></div>
<!-- Content --></div>
{%include file="pc/admin/shared/_footer.html"%}
