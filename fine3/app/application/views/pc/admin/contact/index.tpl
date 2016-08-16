{%include file="pc/admin/shared/_header.html"%}
{%include file="pc/admin/contact/_nav.tpl"%}
<div class="innerLR">
<div class="widget widget-body-white widget-heading-simple">
<div class="widget-body">
{%include file="pc/admin/shared/_export_and_search.html"%}
<table class="dynamicTable tableTools table table-striped checkboxs exceptuser">
<thead>
<tr>
<th>問い合わせID</th>
<th>送信者カテゴリ</th>
<th>送信者名</th>
<th>送信日時</th>
<th> </th>
</tr>
</thead>
<tbody>



{%foreach from=$result key=k item=v%}
<tr id="item{%$v['contact_id']%}" class="gradeX">
<td><a href="{%base_url('admin/contact/detail')%}/{%$v['contact_id']%}">{%$v['contact_id']%}</a></td>
<td>{%$v['type']%}</td>
<td>{%$v['company_name']%} {%$v['name']%}</td>
<td>{%$v['created']%}</td>
<td><a href="{%base_url('admin/contact/detail')%}/{%$v['contact_id']%}">
<p class="btn btn-primary">詳細</p>
</a></td>
</tr>
{%/foreach%}
</tbody>
</table>
{%include file="pc/admin/shared/_pagerfantaHtml.html"%}
</div>
</div>
<!-- // Widget END -->

<!-- Content --></div>
{%include file="pc/admin/shared/_footer.html"%}
