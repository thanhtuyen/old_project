{%include file="pc/admin/shared/_header.html"%}
{%include file="pc/admin/contact/_nav.tpl"%}
<div class="innerLR">
<form action="{%base_url('admin/contact/update')%}/{%$data['contact_id']%}" method="get">
<h2>お問い合わせ内容</h2>
<div class="row innerAll inner-2x">
<div class="col-sm-6">
<dl class="lined_dl">
<dt>問い合わせID</dt>
<dd>{%$data['contact_id']%}</dd>
</dl>
<dl class="lined_dl">
<dt>送信者</dt>
<dd>{%$data['company_name']%}  {%$data['name']%}</dd>
</dl>
<dl class="lined_dl">
<dt>送信者カテゴリ</dt>
<dd>{%$data['type']%}</dd>
</dl>
<dl class="lined_dl">
<dt>メールアドレス</dt>
<dd>{%$data['email']%}</dd>
</dl>

<dl class="lined_dl">
<dt>件名</dt>
<dd>{%$data['title']%}</dd>
</dl>
<dl class="lined_dl">
<dt>内容</dt>
<dd>{%$data['content']%}</dd>
</dl>
<dl class="lined_dl">
<dt>送信日時</dt>
<dd>{%$data['created']%}</dd>
</dl>
<dl class="lined_dl">
<dt>対応状況</dt>
<dd>{%$data['status']%}</dd>
</dl>

<div class="separator"></div>
<div class="form-group">
<input type="hidden" name="contact_id" value="{%$data['contact_id']%}">
<input type="hidden" name="status" value="{%$data['status']%}">
<input class="btn btn-primary" type="submit" value="{%$data['button']%}"></div>
</form>
<!-- separater --></div>
<!-- form-group --></div>


<!-- Content --></div>
{%$alert%}
{%include file="pc/admin/shared/_footer.html"%}
