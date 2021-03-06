{%include file="pc/admin/shared/_header.html"%}
{%include file="pc/admin/contact/_nav.tpl"%}
<div class="innerLR">
<div class="widget widget-body-white widget-heading-simple">
<div class="widget-body">

 {%include file="pc/admin/shared/_export_and_search.html"%}


<table class="dynamicTable tableTools table table-striped checkboxs exceptuser">
<thead>
<tr>
<th class="text-center">
<div class="checkbox checkbox-single margin-none">
<label class="checkbox-custom">
<i class="fa fa-fw fa-square-o"></i>
<input type="checkbox">
</label>
</div>
</th>
<th>スカウトID</th>
<th>送信企業</th>
<th>対象求人</th>
<th>ユーザー名</th>
<th>メール本文</th>
<th>送信日時</th>
<th>  </th>
</tr>
</thead>
<tbody>


{%foreach from=$result key=k item=v%}
<tr id="item{%$v['scout_id']%}" class="gradeX">
<td class="text-center"><div class="checkbox checkbox-single margin-none"><label class="checkbox-custom"><i class="fa fa-fw fa-square-o"></i><input type="checkbox" checked="checked"></label></div></td>
<td><a href="{%base_url('admin/scout/detail')%}/{%$v['scout_id']%}">{%$v['scout_id']%}</a></td>
<td><a href="{%base_url('admin/client/detail')%}/{%$v['client_id']%}" target="_blank">{%$v['companyname']%}</a></td>
<td><a href="{%base_url('admin/jobs/detail')%}/{%$v['job_id']%}" target="_blank">{%mb_substr($v['title'],0,10)%}</a></td>
<td><a href="{%base_url('admin/users/detail')%}/{%$v['user_id']%}" target="_blank">{%$v['username']%}</a></td>
<td><a href="{%base_url('admin/scout/detail')%}/{%$v['scout_id']%}">{%mb_substr($v['content_after'],0,10)%}</a></td>
<td>{%$v['created']%}</td>
<td>
<a href="{%base_url('pc/admin/scout/detail')%}/{%$v['scout_id']%}">
<button type="button" class="btn btn-primary">詳細</button>
</a>
</td>
</tr>
{%/foreach%}
</tbody>
</table>

{%include file="pc/admin/shared/_pagerfantaHtml.html"%}

</div>
<!-- // Widget END -->

<!-- Content --></div>
{%include file="pc/admin/shared/_footer.html"%}
