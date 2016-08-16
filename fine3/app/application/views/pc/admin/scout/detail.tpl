{%include file="pc/admin/shared/_header.html"%}
{%include file="pc/admin/contact/_nav.tpl"%}
<div class="innerLR">

<h2>スカウト内容</h2>
<div class="row innerAll inner-2x">
<div class="col-sm-6" style="width:95%;">
<dl class="lined_dl">
<dt>スカウトID</dt>
<dd>{%$data['scout_id']%}</dd>
</dl>
<dl class="lined_dl">
<dt>送信者</dt>
<dd><a href="{%base_url()%}client/detail/{%$data['client_id']%}" target="_blank">{%$data['companyname']%}</a>　（表示企業名: {%$data['display_name']%}）</dd>
</dl>
<dl class="lined_dl">
<dt>対象求人</dt>
<dd><a href="{%base_url('admin/jobs/detail')%}/{%$data['job_id']%}" target="_blank">{%$data['job_id']%} / {%$data['title']%}</a></dd>
</dl>
<dl class="lined_dl">
<dt>ユーザー</dt>
<dd><a href="{%base_url('admin/users/detail')%}/{%$data['user_id']%}" target="_blank">{%$data['user_id']%} / {%$data['username']%}</a></dd>
</dl>
<dl class="lined_dl">
<dt>内容</dt>
<dd>{%$data['content_after']%}</dd>
</dl>
<dl class="lined_dl">
<dt>送信日時</dt>
<dd>{%$data['created']%}</dd>
</dl>

<div class="form-group">
<a href="{%base_url()%}admin/scout/"><button class="btn btn-primary">戻る</button></a>
</div>
<!-- separater --></div>
<!-- form-group --></div>


<!-- Content --></div>
{%include file="pc/admin/shared/_footer.html"%}
