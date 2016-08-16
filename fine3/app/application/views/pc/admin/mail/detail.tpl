{%include file="pc/admin/shared/_header.html"%}
{%include file="pc/admin/contact/_nav.tpl"%}
<div class="innerLR plan_form">
<div class="widget widget-heading-simple widget-body-white" >
<table class="plan_form">
<tr>
<th>カテゴリ</th>
<td>{%$data['type']%}
</td>
</tr>
<tr>
<th>宛先</th>
<td>{%$data['email']%}
</td>
</tr>
<tr>
<th>件名</th>
<td>{%$data['title']%}</td>
</tr>
<tr>
<th>本文</th>
<td>{%$data['content']%}</td>
</tr>
<tr>
<th>送信日時</th>
<td>{%$data['created']%}</td>
</tr>
</table>
<!-- widget --></div>
<div class="form-group">
<a href="{%base_url()%}admin/mail/index">
<p class="btn btn-default">一覧に戻る</p>
</a>
</div>

</form>
<!-- separater --></div>

<!-- innnerLR --></div>
<!-- Content --></div>
{%include file="pc/admin/shared/_footer.html"%}
