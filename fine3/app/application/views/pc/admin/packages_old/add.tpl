{%include file="pc/admin/shared/_header.html"%}

<div class="innerLR plan_form">
<div class="widget widget-heading-simple widget-body-white" >
<div class="widget-head">
<h4 class="heading">新しい料金プランの登録</h4>
<!-- widget-head --></div>
{%form_open('manager/packages/create')%}
<table class="plan_form">
<tbody><tr>
<th>料金プラン名</th>
<td><input type="text" name="name" placeholder="[package|name]" class="form-control plan_form" data-validation = "required" data-validation-error-msg="<span style='color:red'>　料金プラン名は必須項目です.</span>"></td>
</tr>
<tr>
<th>単価（円）</th>
<td><input type="text" name="fee" placeholder="[package|price]" class="form-control plan_form" data-validation = "required" data-validation-error-msg="<span style='color:red'>　単価（円）は必須項目です.</span>"></td>
</tr>
<tr>
<th>上限数</th>
<td><input type="text" name="number" placeholder="[package|limit]" class="form-control plan_form" data-validation = "required" data-validation-error-msg="<span style='color:red'>　上限数は必須項目です.</span>"></td>
</tr>
<tr>
<th>上限単位</th>
<td>
{%foreach from=$package_group key=group_id item=name%}
<div class="radio lined_div"><label class="">
<input type="radio" name="group_id" value="{%$group_id%}">
<i class="fa"></i>{%$name%}</label>
</div>
{%/foreach%}
</tr>

<tr>
<th>ステータス</th>
<td><div class="make-switch" data-on="success" data-off="default"><input type="radio" name="status" checked></div></td>
</tr>
</tbody></table>
<!-- widget --></div>
<div class="separator"></div>
<div class="form-group">
<input class="btn btn-primary" type="submit" value="この内容で登録する">
<input class="btn btn-default" type="reset" value="キャンセル"></div>

{%form_close()%}
<!-- separater --></div>

<!-- innnerLR --></div>
<!-- Content --></div>
{%include file="pc/admin/shared/_footer.html"%}
