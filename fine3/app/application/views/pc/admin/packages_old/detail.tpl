{%include file="pc/admin/shared/_header.html"%}

<div class="innerLR plan_form">
<div class="widget widget-heading-simple widget-body-white" >
<div class="widget-head">
<h4 class="heading">新しい料金プランの登録</h4>
<!-- widget-head --></div>
<table class="plan_form">
<tbody><tr>
<th>料金プラン名</th>
<td>{%$package['name']%}</td>
</tr>
<tr>
<th>単価（円）</th>
<td>{%$package['fee']%}</td>
</tr>
<tr>
<th>上限数</th>
<td>{%$package['number']%}</td>
</tr>




<tr>
<th>上限単位</th>
<td>{%$package['limit_name']%}</td>
</tr>

<tr>
<th>ステータス</th>
<td>{%status_num_to_string($package['status'])%}　</td>
</tr>
</tbody></table>
<!-- widget --></div>
<div class="separator"></div>
<div class="form-group">
<input class="btn btn-primary" type="submit" value="この内容で登録する">
　<input class="btn btn-default" type="reset" value="キャンセル"></div>

<!-- separater --></div>

<!-- innnerLR --></div>
<!-- Content --></div>
{%include file="pc/admin/shared/_footer.html"%}
