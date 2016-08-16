<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2><?php echo __('求人募集エリア')?></h2>
	</div>
</div>
<!--header1-->

<div class="row wrapper wrapper-content animated fadeInRight title-button pd-bottom-none">
	<?php echo $this->Form->create('RecruitmentAreas',array('class'=>'form-horizontal')); ?>
	<!-- start contents -->

<div class="col-lg-8">
    <div class = "ibox">
        <div class="ibox-title">
            <h5>募集エリア</h5>
        </div>
        <div class="ibox-content clearfix p-sm">
            <div class="">
                <div class="table-border">
                    <table class="table table-bordered no-margin-bottom" id="table_recruitment_areas">
                        <thead>
                        <tr class = "bg_cols">
                            <th class = "w20 button_cen t-align-left">エリアID</th>
                            <th class="t-align-left">エリア名</th>
                            <th class = "w20x t-align-left">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $index=0;
                         foreach($RecruitmentArea as $key): ?>
                        <tr>
                            <td class="">
                                <?php echo($key['RecruitmentArea']['id']); ?>
                                <input type="hidden" name="data[<?php echo $index; ?>][RecruitmentArea][id]" value="<?php echo($key['RecruitmentArea']['id']); ?>">
                            </td>
                            <td class="text_left">
                                <input type="text" name="data[<?php echo $index; ?>][RecruitmentArea][area]" class="form-control" value="<?php echo($key['RecruitmentArea']['area']); ?>">
                            </td>
                            <td class='ver-mid'><button class="full-width btn btn-default btn-xs btnDelete" data-linked="<?php echo count($key['JobVote']); ?>" data-id="<?php echo($key['RecruitmentArea']['id']); ?>" type="button">削 除</button></td>
                        </tr>
                        <?php $index++; ?>
                        <?php endforeach;?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td></td>
                            <td class=""><input class="form-control height_control" id="frm_input_area" type="text" placeholder="エリア名入力"></td>
                            <td class="ver-mid"><button class="full-width btn btn-primary btn-xs" id="btnAdd" type="button">追加</button></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class = "clear"></div>
                <div class="btn-clear">
                    <?php echo $this->Html->link('キャンセル', array('controller' =>
                    'RecruitmentAreas', 'action' => 'index'), array('class' => 'text-navy')); ?>
                    <button class=" btn btn-primary w-95 h-34" id="btnsubmit" type="button">更新</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end contents -->
<?php echo $this->Form->end(); ?>
<script>
	$(document).ready(function() {
			$("#frm_input_area").focus();
			function add(txtArea)
			{
				var url = window.location.pathname;
				$.ajax({
						type: "POST",
						url: url,
						data: ("area="+txtArea+"&status=addnew"),
						success: function(data)
						{
							$('#content-wrapper').html("");
							$('#content-wrapper').html(data);
							$("#frm_input_area").focus();
						}
					});
				return false;
			}

			function deleteRecruitment(id)
			{
				var url = window.location.pathname;
				$.ajax({
						type: "POST",
						url: url,
						data: ("id="+id+"&status=delete"),
						success: function (data) {
							$('#content-wrapper').html("");
							$('#content-wrapper').html(data);
							$("#frm_input_area").focus();
						}
					});
				return false;
			}

			function submitForm()
			{
				var url = window.location.pathname;
				var txtArea=$('#frm_input_area').val();
				if(txtArea!='') {
					$.ajax({
							type: "POST",
							url: url,
							data: ("area="+txtArea+"&status=addnew"),
							success: function(data)
							{
							}
						});
				}
				$.ajax({
						type: "POST",
						url: url,
						data: $("#RecruitmentAreasEditForm").serialize(),
						success: function(data)
						{
							$('#content-wrapper').html("");
							$('#content-wrapper').html(data);
							$("#frm_input_area").focus();
						}
					});
				return false;
			}

			$('#btnAdd').click(function(){
					var gettext=$('#frm_input_area').val();
					if(gettext!='') {
						var clone_tmp = "<tr>" +
						"<td>新しい</td>" +
						"<td><input type='text' class='form-control' name='area_new[]' value=" + gettext + "></td>" +
						"<td><button class='full-width btn btn-primary btn-sm btnDelete' type='button'>削除</button>" +
						"</tr>";
						$('#table_recruitment_areas tbody').append(clone_tmp);
						$('#frm_input_area').val('');
					}
					$(".btnDelete").on('click',function(){
							$(this).parents('tr').remove();
							deleteRecruitment();
						});
					add(gettext);
				});

			$(".btnDelete").on('click',function(){
					var id1=$(this).data('id');
					//            $(this).parents('tr').remove();
					deleteRecruitment(id1);
				});

			$("#frm_input_area").keypress(function(event){
					if(event.keyCode == 13){
						$('#btnAdd').click();
						return false;
					}
				});

			$("#btnsubmit").click(function(){
					submitForm();
				});
		});
</script>

<?php return;?>
<div class="recruitmentAreas form">
	<?php echo $this->Form->create('RecruitmentArea'); ?>
	<fieldset>
		<legend><?php echo __('Edit Recruitment Area'); ?></legend>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('area');
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
