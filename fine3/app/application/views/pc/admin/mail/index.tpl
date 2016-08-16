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
<th>送信メールID</th>
<th>infoタイプ</th>
<th>送信先アドレス</th>
<th>件名</th>
<th>送信日時</th>
<th>  </th>
</tr>
</thead>
<tbody>


{%foreach from=$result key=k item=v%}
<tr id="item{%$v['contact_id']%}" class="gradeX">
<td class="text-center"><div class="checkbox checkbox-single margin-none"><label class="checkbox-custom"><i class="fa fa-fw fa-square-o"></i><input type="checkbox" checked="checked"></label></div></td>
<td><a href="{%base_url('admin/mail/detail')%}/{%$v['contact_id']%}">{%$v['contact_id']%}</a></td>
<td>{%$v['type']%}</td>
<td>{%$v['email']%}</td>
<td><a href="{%base_url('admin/mail/detail')%}/{%$v['contact_id']%}">{%$v['title']%}</a></td>
<td>{%$v['created']%}</td>
<td><a href="{%base_url('admin/mail/detail')%}/{%$v['contact_id']%}"><p class="btn btn-primary">詳細</p></a></td>
</tr>
{%/foreach%}


</tbody>
</table>
{%include file="pc/admin/shared/_pagerfantaHtml.html"%}
{%include file="pc/admin/shared/_footer.html"%}
