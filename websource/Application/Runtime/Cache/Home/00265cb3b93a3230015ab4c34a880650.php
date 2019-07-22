<?php if (!defined('THINK_PATH')) exit();?>
<div class="new-trees-scroll" >
	<div class="new-trees-scroll-in">

	<div class="pub-par-title ppt-ico-box">
		<span class="abe-fl vi-blue abe-ft14"></span>
		<div class="abe-fr">

			<input type="button" class="btn btn-blue mrg_10 btn-sm"  style=" position: relative; top: -2px;" value="新增分类" onclick="return <?php echo ($pfuncid); ?>_category_add();">
			<?php if($goods_bom): ?><a href="javascript:void(0);" class="vi-blue pdr_10" onclick="return <?php echo ($pfuncid); ?>_load_bom_info(<?php echo ($goods_bom['id']); ?>)"><i class="iconfont">&#xe611;</i> 刷新</a><?php endif; ?>
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
					<th>分类编码</th>
					<td><?php echo $goods_bom['code']; ?></td>
					<th>分类名称</th>
					<td><?php echo $goods_bom['name']; ?></td>
					<th>审批要求</th>
					<td><?php echo get_table_EffectsCategory_approval_require($goods_bom['approval_require'],"name"); ?></td>
			<th>单一物品</th>
			<td><?php echo ($goods_bom['onlyone']==1?"是":"") ; ?></td>
        </tr>
        <tr class="odd">
					<th>变动时间</th>
					<td><?php echo system_format("DT", $goods_bom["modify_time"],1); ?></td>
					<th>状态</th>
					<td><?php echo get_table_Effects_status($goods_bom['status'],"name"); ?></td>
			<th></th><td></td>
			<th></th><td></td>
        </tr>
       		</tbody>
		</table>
		</div>
		<div class="tree-wl-title">
			<div class="abe-fl vi-blue abe-ft14 pdt_10">物品分类下物品信息</div>
			<div class="abe-fl" style="display: none;">
				<?php if($goods_bom['group_id'] == $group_id && ($goods_bom['is_include'] || $goods_bom["parent_id"] == 0) && $goods["type"] != 0 && $goods["type"] != 3) { ?>
				<input type="button" class="btn btn-blue mrg_10 btn-sm" value="添加物料" onclick="return addbom();">
				<?php } ?>
			</div>
			<div class="abe-fr">
				<?php if($goods_bom): ?><input type="button" class="btn btn-org mrg_10 btn-sm" value="编辑" onclick="return _asr.popupFun('<?php echo U("/Home/EffectsCategory/index?func=add&id=".$goods_bom['id']) ?>', '<?php echo filterFuncId("/Home/EffectsCategory_create","id=$goods_bom[id]");?>'); ">
					<input type="button" class="btn btn-red mrg_10 btn-sm" value="删除" onclick="return _asr.confirm('删除分类','请确认是否要删除此分类?','', '<?php echo U("/Home/EffectsCategory/index?func=delete&id=".$goods_bom["id"]) ?>'); "><?php endif; ?>
			</div>
		</div>
	</div>
      
	<div class="table-box">
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
						<th>物品编码</th>
						<th>物品名称</th>
						<th>别名</th>
						<th>排序</th>
						<th>状态</th>
						<th>创建时间</th>
					</tr>
					<?php if(is_array($list)): $i = 0; $__LIST__ = $list; if( count($__LIST__) == 0) : echo ""; else: foreach($__LIST__ as $key=>$master): $mod = ($i % 2 );++$i; ?>
					<tr <?php if($mod == "1"): ?>class="even"<?php endif; if($mod == "0"): ?>class="odd"<?php endif; ?>>
						<!-- 选择 -->
						<td><input type="checkbox" name="Key[]" data-type="select" onclick="" value="<?php echo $master['id'] ;?>"></td>
						<!-- 序号 -->
						<td><?php echo $i + ($page_size * ($p - 1)); ?></td>
						<td>
						<!-- 按钮权限检测 编辑 --->
						<?php if (isset($rights['master_edit']) && $rights['master_edit']): ?>
							<?php if($master['group_id'] == $group_id) { ?>
			               <a href="javascript:void(0);" class="vi-blue " onclick="return _asr.popupFun('<?php echo U("/Home/GoodsBom/index?func=create&id=".$master['goods_id']."&bom_id=".$master['id']."&ofuncid=".$ofuncid) ?>', '<?php echo filterFuncId("/Home/GoodsBom_create","id=$master[id]");?>');"><i class="iconfont">&#xe6d6;</i></a>
			               <?php } ?>
						<?php endif; ?>
			
						<!-- 按钮权限检测 转换 --->
						<?php if (isset($rights['master_transfer_include']) && $rights['master_transfer_include']): ?>
			          	   <?php if(!$master['is_include'] && $master["parent_id"] != 0) { ?>
			               <a href="javascript:void(0);" class="vi-blue " onclick="return _asr.confirm('BOM转换','请确认是否要将此BOM转换为引入物品模式?','', '<?php echo U("/Home/GoodsBom/index?func=transfer_include&id=".$master["id"]) ?>'); "><i class="iconfont">&#xe67a;</i></a>
			               <?php } ?>
						<?php endif; ?>
			
						<!-- 按钮权限检测 删除 --->
						<?php if (isset($rights['master_delete']) && $rights['master_delete']): ?>
							<?php if($master['group_id'] == $group_id) { ?>
			               <a href="javascript:void(0);" class="vi-blue " onclick="return _asr.confirm('删除BOM','请确认是否要删除此BOM?','', '<?php echo U("/Home/GoodsBom/index?func=delete&id=".$master["id"]) ?>'); "><i class="iconfont">&#xe61d;</i></a>
			               <?php } ?>
						<?php endif; ?>
						</td>
						<td><input type="hidden" name="id" value="<?php echo $master['id']; ?>" /><?php echo $master['code']; ?></td>
						<td><?php echo $master['name']; ?></td>
						<td><?php echo $master['alias']; ?></td>
						<td><?php echo $master["sort"]; ?></td>
						<td><?php if($master["status"] == "1") echo "有效"; else echo "无效"; ?></td>
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
					<input type="button" class="btn btn-blue mrg_10 " value="当前分类下新增分类" onclick="return <?php echo ($pfuncid); ?>_category_add();">
					<?php if($goods_bom): ?><input type="button" class="btn btn-blue mrg_10 " value="当前分类下添加将现有物品" onclick="return <?php echo ($pfuncid); ?>_effects_add();">
					<input type="button" class="btn btn-blue mrg_10 " value="当前分类下新增物品" onclick="return <?php echo ($pfuncid); ?>_effects_add();"><?php endif; ?>
				</div>
				<?php if($goods_bom): ?><div class="abe-fr">
					<input type="button" value="删除物品" class="btn btn-red mrg_10 "  verify="1" column="_batch_assign" column-value="1" onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Result', '<?php echo U("/Home/EffectsCategory/index?func=effects_del&category_id=".$goods_bom['id']) ; ?>',''); " />
				</div><?php endif; ?>

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