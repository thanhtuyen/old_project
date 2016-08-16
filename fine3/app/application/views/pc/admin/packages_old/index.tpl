{%include file="pc/admin/shared/_header.html"%}
<div class="innerLR">
<a href="{%base_url('manager/packages/add')%}"><button class="btn btn-success btn-plancreate">新しい料金プランを登録する</button></a>
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
<th>料金プランID</th>
<th>プラン名</th>
<th>上限数</th>
<th>単価（円）</th>
<th>上限単位</th>
<th>ステータス</th>
<th></th>
</tr>
</thead>
<tbody>

{%foreach from=$result key=k item=list%}
<tr class="gradeX">
<td class="text-center"><div class="checkbox checkbox-single margin-none">
<label class="checkbox-custom">
<i class="fa fa-fw fa-square-o"></i><input type="checkbox" checked="checked"></label></div></td>
<td><a href="{%base_url('manager/packages/detail')%}/{%$list['package_id']%}">{%$list['package_id']%}</a></td>
<td><a href="{%base_url('manager/packages/detail')%}/{%$list['package_id']%}">{%$list['name']%}</a></td>
<td>{%$list['number']%}</td>
<td>{%$list['fee']%}</td>
<td>{%$list['limit_name']%}</td>

<td>{%status_num_to_string($list['status'])%}　

</td>
<td>
    <a href="{%base_url('manager/packages/edit')%}/{%$list['package_id']%}">
        <button type="button" class="btn btn-primary">編集</button>
    </a>
    <a href="{%base_url('manager/packages/del')%}/{%$list['package_id']%}">
    <button type="button" class="btn btn-default" onClick="return confirmDelete()">削除</button>
    </a>
</td>
</tr>
{%/foreach%}



</tbody>
</table>
    <div class="row"><div class="col-md-6"><div class="dataTables_info" id="DataTables_Table_0_info">Showing {%$quantity['start']%} to {%$quantity['end']%} of {%$quantity['total']%} entries</div></div><div class="col-md-6"><div class="dataTables_paginate paging_bootstrap">

    {%$pagerfantaHtml%}

    </div></div></div>
</div>
</div>
<!-- // Widget END -->

<!-- Content --></div>
{%include file="pc/admin/shared/_footer.html"%}
