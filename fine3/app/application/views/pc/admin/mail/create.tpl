{%include file="pc/admin/shared/_header.html"%}
{%include file="pc/admin/contact/_nav.tpl"%}
<div class="innerLR plan_form">
<div class="widget widget-heading-simple widget-body-white" >
{%form_open('admin/mail/register_info')%}
<table class="plan_form">
<tr>
<th>宛先</th>
<td><div class="radio lined_div">
<label class="radio-custom">
<input type="radio" name="type" value="info_user" checked="checked">
<i class="fa fa-circle-o checked"></i> 全ユーザー</label></div>
<div class="radio lined_div">
<label class="radio-custom">
<input type="radio" name="type" value="info_agency">
<i class="fa fa-circle-o"></i> 全紹介会社</label></div>
<div class="radio lined_div">
<label class="radio-custom">
<input type="radio" name="type" value="info_employer">
<i class="fa fa-circle-o"></i> 全園法人</label>
</div>
</td>
</tr>
<tr>
<th>件名</th>
<td><input type="text" placeholder="件名" name="title" class="form-control plan_form" data-validation = "required" data-validation-error-msg="<span style='color:red'>件名を入力してください。</span>"/></td>
</tr>
<tr>
<th>本文</th>
<td><textarea placeholder="メール本文" name="content" class="form-control plan_form" data-validation = "required" data-validation-error-msg="<span style='color:red'>メール本文を入力してください。</span>"cols="80" rows="15"></textarea></td>
</tr>
</table>
<!-- widget --></div>
<div class="form-group">
<input class="btn btn-primary" type="submit" value="この内容で送信する">
<input class="btn btn-default" type="reset" value="キャンセル">
</div>
{%form_close()%}

<!-- innnerLR --></div>
<!-- Content --></div>
{%include file="pc/admin/shared/_footer.html"%}
