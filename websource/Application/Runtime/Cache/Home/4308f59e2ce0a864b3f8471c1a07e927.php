<?php if (!defined('THINK_PATH')) exit();?>
<div class="new-trees-scroll" >
	<div class="new-trees-scroll-in">

		<div class="pub-par-title ppt-ico-box">
			<span class="abe-fl vi-blue abe-ft14">模板名称：<?php echo ($templet_info['subject']); ?>(<?php echo ($templet_info['templet_no']); ?>), 共<?php echo ($templet_info['count']); ?>题, 满分<?php echo ($templet_info['score']); ?>分</span>
			<div class="abe-fr">
				<?php if($templet_detail): ?><a href="javascript:void(0);" class="vi-blue pdr_10" onclick="return <?php echo ($pfuncid); ?>_load_bom_info(<?php echo ($templet_detail['id']); ?>)"><i class="iconfont">&#xe611;</i> 刷新</a><?php endif; ?>
			</div>
		</div>
		<div class="table-box">
			<div class="table-in">
				<table border="0" cellspacing="0" cellpadding="0" class="pub-table-par">
					<colgroup>
						<col style="width:8%;">
						<col style="width:17%;">
						<col style="width:8%;">
						<col style="width:17%;">
						<col style="width:8%;">
						<col style="width:17%;">
						<col style="width:8%;">
						<col style="width:16%;">
					</colgroup>
					<tbody>
					<tr class="even">
						<th>标题类型</th>
						<td><?php echo get_table_TempletDetail_type($templet_detail['type'],"name"); ?></td>
						<th>试题题号</th>
						<td><?php echo $templet_detail['seq']?$templet_detail['seq']:""; ?></td>
						<th>要求分类</th>
						<td><?php echo get_table_TempletDetail_req_unit($templet_detail['req_unit'],"name"); ?></td>
					</tr>

					<tr class="odd">
						<th>标题名称</th>
						<td><?php echo ($templet_detail['subject']); ?></td>
						<th>试题分数</th>
						<td><?php echo $templet_detail['type']?"":$templet_detail['score']." 分"; ?></td>
						<th>要求知识点</th>
						<td><?php echo ($templet_detail['req_category_name']); ?></td>

					</tr>
					<tr class="even">
						<th>标题补充</th>
						<td><?php echo ($templet_detail['additional']); ?></td>
						<th>抽取方式</th>
						<td><?php echo $templet_detail['type']?"":get_table_TempletDetail_extract($templet_detail['extract'],"name"); ?></td>
						<th>要求试题</th>
						<td><?php echo $templet_detail['type']?"":get_table_TempletDetail_req_type($templet_detail['req_type'],"name"); ?></td>

					</tr>
					<tr class="odd">
						<th>排序码</th>
						<td><?php echo ($templet_detail['sort']); ?></td>
						<th>要求题型</th>
						<td><?php echo subcode_view('question:kind',$templet_detail['req_kind']); ?></td>
						<th>套题要求</th>
						<td><?php echo $templet_detail['req_type']?"包含".$templet_detail['req_child_count']."小题, ".($templet_detail['req_child_seq']?"子题分配题号":"子题无题号"):""; ?></td>

					</tr>

					</tbody>
				</table>
			</div>
			<div class="tree-wl-title">
				<div class="abe-fl vi-blue abe-ft14 pdt_10">抽取的题目</div>

			</div>
		</div>

		<div class="table-box" id="<?php echo ($pfuncid); ?>_exam_list">
			<div class="table-in">
				<form id="<?php echo $funcid; ?>-Result"  action="<?php U('/Home/EffectsCategory/op'); ?>" method="post">

					<table border="0" cellspacing="0" cellpadding="0" class="pub-table">
						<colgroup>
							<col style="width: 40px ;">
							<col style="width: 40px ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
							<col style="width: auto ;">
						</colgroup>
						<tbody>
						<tr>
							<th><input type="checkbox" onclick="_asr.selectAll(this);"></th>
							<th>序号</th>
							<th></th>
							<th>标题</th>
							<th>类型</th>
							<th>题号</th>
							<th>分数</th>
							<th>试题类型</th>
							<th>试题编号</th>
							<th>创建时间</th>
						</tr>
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list; if( count($__LIST__) == 0) : echo ""; else: foreach($__LIST__ as $key=>$master): $mod = ($i % 2 );++$i; ?>
						<tr <?php if($mod == "1"): ?>class="even"<?php endif; if($mod == "0"): ?>class="odd"<?php endif; ?>>
						<!-- 选择 -->
						<td><input type="checkbox" name="Key[]" data-type="select" onclick="" value="<?php echo $master['id'] ;?>"></td>
						<!-- 序号 -->
						<td><?php echo $i + ($page_size * ($p - 1)); ?></td>
						<td>
							<?php if($master["type"] == 0 and $master["question_type"] < 2): ?><a href="javascript:void(0);" class="btn btn-blue btn-sma" onclick="return _asr.confirm('重抽题目','请确认是否要重抽此题目?','', '<?php echo U("/Home/Templet/index?func=select_question&tid=".$master["templet_id"]."&Key=".$master["id"]."&pfuncid=".$funcid); ?>');">重抽试题</a><?php endif; ?>
						</td>
						<td class=" abe-txtl "><input type="hidden" name="id" value="<?php echo $master['id']; ?>" /><?php echo $master['subject']; ?></td>
						<td><?php echo get_table_ExamDetail_type($master['type'],"name"); ?></td>
						<td><?php echo $master['type']?"":system_format("N3", $master['seq'],1); ?></td>
						<td><?php echo $master['type']?"":system_format("N3", $master["score"],1); ?></td>

						<td><?php echo $master['type']?"":get_table_ExamDetail_question_type($master['question_type'],"name"); ?></td>

						<td>
							<?php if($master["type"] == 0 and $master["question_type"] < 2): ?><a href="javascript:void(0);"  class=" vi-blue vi-blue " onclick="return _asr.openLink('<?php echo U("/Home/Question/index?func=view&id=$master[question_id]") ; ?>', '<?php echo filterFuncId(U("/Home/Exam/index?func=view&id=$master[question_id]"),"");?>' , '题库-<?php echo ($master['question_code']); ?>' ,0); "><i class="iconfont abe-ft18">&#xe62e;</i></a><?php endif; ?>
								<?php echo $master['type']?"":system_format("N3", $master["question_code"],1); ?></td>
					<!-- date:2019-6-18 原因：将原来的不能查看改为可以查看抽取的试题   <td><?php echo $master['type']?"":$master["question_name"]; ?></td>-->
						<td><?php echo $master["create_time"]; ?></td>
						</tr>
						<?php endforeach; ?>
						<?php
 endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</form>
			</div>
			<div class="blank15"></div>
		</div>
		<div class="data-oper abe-txtc">
			<div class="talbe-page">
				<?php echo $page; ?>
			</div>
			<div class="data-oper-in">
				<div class="abe-fl">
					<span class="pdr_10 ">当前已选择<i class="abe-ft16 vi-org"> 0 </i>条</span>
			<?php if($search[status] == 0): ?><input type="button" class="btn btn-blue mrg_10 " value="校验模板" onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Result', '<?php echo U("/Home/Templet/index?func=check_templet&id=".$templet_id) ; ?>',''); ">
				<input type="button" class="btn btn-blue mlg_10 " value="模板确认" onclick="return _asr.popupFun('<?php echo U("/Home/Templet/index?func=confirm&id=$templet_id") ; ?>', '<?php echo filterFuncId("/Home/Templet/index?func=confirm&id=$templet_id","");?>'); " /><?php endif; ?>
			<?php if($search[status] == 1): ?><input type="button" class="btn btn-blue mrg_10 " value="抽取试卷" onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Result', '<?php echo U("/Home/Templet/index?func=create_exam&tid=".$templet_id) ; ?>',''); ">
					<input type="button" class="btn btn-blue mrg_10 " value="重抽试题" onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Result', '<?php echo U("/Home/Templet/index?func=select_question&tid=".$templet_id) ; ?>',''); "><?php endif; ?>

				</div>

			</div>
		</div>

	</div>
</div>
<script>
	$(function(){
		$("#<?php echo ($funcid); ?> .data-oper .talbe-page").find("a").each(function(){
			$(this).removeAttr("onclick");

			if($(this).attr("href")!=undefined)
			{
                $(this).attr("load_url",$(this).attr("href"));
                $(this).removeAttr("href");
			}

			$(this).bind("click",function(){
				var _url=$(this).attr("load_url");
				return _asr.loadData('<?php echo ($funcid); ?>', _url, null, <?php echo $funcid ?>_append_info);
			});
		});
    });
</script>