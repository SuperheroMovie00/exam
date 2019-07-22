<?php if (!defined('THINK_PATH')) exit();?>
<div toplayer="1" class="wrap-box" id="<?php echo $funcid;?>" summaryid="GoodsBom" baseurl="<?php echo U('/Home/GoodsBom/index?func=search&id='.$goods_id); ?>">
	<input type="hidden" id="<?php echo ($funcid); ?>-last-url" value="<?php echo ($__last_url); ?>" />
	<input type="hidden" id="<?php echo $funcid;?>-selected-exam-id" value="" />
	<input type="hidden" id="<?php echo $funcid;?>-selected-templet-detail-id" value="" />
	<input type="hidden" id="<?php echo $funcid;?>-root-bom-id" value="<?php echo $goods_bom['id'] ?>" />

   <?php  ?>
   <div class="new-trees-box" style="position:relative;">
        <div class="trees-nav trees-nav-new tree-wl-bg tree-nstyle" style="width:350px;">
            <input type="checkbox" style="display: none;" name="code" value="">
            <div class="trees-nav-new-in" id="<?php echo $funcid;?>-trees-nav-new-in">
                <div class="tree-title vi-blue clearfix"><a class="vi-blue abe-fl" onclick="javascript:<?php echo ($funcid); ?>_clear_active();">模板试卷结构</a>
                   <a href="javascript:void(0);" class="vi-blue abe-fr" onclick="return <?php echo ($funcid); ?>_tree_refresh();"><i class="iconfont">&#xe611;</i> 刷新</a>
                </div>
                <div id="<?php echo ($funcid); ?>_tree">
                <?php if(!empty($templet_list)) { ?>
                        <?php echo showtempletlist($templet_list,$funcid); ?>
                <?php } ?>
                </div>
            </div>
            <div class="data-oper abe-txtc">
                <div class="talbe-page">
                    <input type="button" value="编辑" class="btn btn-org mrg_10" onclick="return <?php echo ($funcid); ?>_detail_edit();">
                    <input type="button" value="删除" class="btn btn-red mrg_20" onclick="return <?php echo ($funcid); ?>_detail_del();">
                    <input type="button" value="上移" class="btn btn-blue mrg_10" onclick="return <?php echo ($funcid); ?>_move_up(0);">
                    <input type="button" value="下移" class="btn btn-blue mrg_10" onclick="return <?php echo ($funcid); ?>_move_up(1);">
                </div>
                <div class="data-oper-in">
                    <input type="button" value="新增标题" class="btn btn-blue mrg_10 btn-sm" onclick="return <?php echo ($funcid); ?>_detail_add(1);">
                    <input type="button" value="新增题目" class="btn btn-blue mrg_10 btn-sm" onclick="return <?php echo ($funcid); ?>_detail_add(0);">
                </div>
            </div>
        </div>

        <div class="new-trees-info" id="<?php echo $funcid;?>-new-trees-info" style="   padding-left:360px;">
            
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

        </div>
    </div>
</div>
<script>
    $(function(){
        $("#<?php echo ($funcid); ?> .new-trees-scroll-in .pub-par-title span").html("<?php echo ($templet['subject']); ?>(<?php echo ($templet['templet_no']); ?>),<?php echo ($templet['count']); ?>题,<?php echo ($templet['score']); ?>分");
    });

	function <?php echo $funcid ?>_refresh_node(parent_id, goods_id) {
		var _list = $("#<?php echo $funcid;?>").find("div[data-parent=parent-<?php echo $funcid;?>-" + parent_id + "]");
		_list.html("");
		var _root = $("#<?php echo $funcid;?>-root-bom-id").val();
		var _funcid = '<?php echo $funcid;?>';
		var _url = '<?php echo U("/Home/GoodsBom/index") ?>' + "?func=loadbom&goods_id=" + goods_id + "&parent_id=" + parent_id + "&r=1&rootbom=" + _root;
		_list.parent().find("i").eq(0).attr("class", "iconfont arrow-deg");
		_asr.loadData(_funcid, _url);
	}



	function <?php echo $funcid ?>_load_bom(obj){
        var cur_div=$(obj).parent().parent().children("ul");
	    $(cur_div).toggle();
        if($(cur_div).is(":hidden"))
        {
            if($(obj).parent().parent().children('a[data-type="0"]').length>0)
            {
                $(obj).parent().parent().find("i:eq(0)").removeClass("arrow-deg");
            }
            else
            {
                $(obj).parent().parent().find("i:eq(0)").find("a").html("&#xe708;");
            }
        }else
        {
            if($(obj).parent().parent().children('a[data-type="0"]').length>0)
            {
                $(obj).parent().parent().find("i:eq(0)").addClass("arrow-deg");
            }
            else
            {
                $(obj).parent().parent().find("i:eq(0)").find("a").html("&#xe707;");
            }

        }

	}
	
	function <?php echo $funcid ?>_load_bom_info(id,t) {
        $("#<?php echo $funcid;?>-selected-templet-detail-id").val(id);

		var _funcid ='<?php echo ($funcid); ?>';
        //"<?php echo $funcid;?>-new-trees-info"; //_asr.createFuncId();
		//var _root = $("#<?php echo $funcid;?>-root-bom-id").val();
        var _exam_id=$("#<?php echo $funcid;?>-selected-exam-id").val();
		var _url = '<?php echo U("/Home/Templet/index") ?>' + "?func=loaddetailinfo&t="+t+"&id=" + id + "&exam_id="+ _exam_id +"&pfuncid=<?php echo $funcid;?>";
		$("#<?php echo $funcid;?>-trees-nav-new-in").find("a").each(function() {
			_asr.removeClass($(this), "active");
		});
        $("a[tree-date-type=title][data-type="+t+"][data-id="+id+"]").addClass("active");
        if($("a[tree-date-type=title][data-type="+t+"][data-id="+id+"]").parent().children("ul").is(":hidden"))
        {
            $("a[tree-date-type=title][data-type="+t+"][data-id="+id+"]").parent().children("ul").show();
            if( $("a[tree-date-type=title][data-type="+t+"][data-id="+id+"]").parent().children("ul").children('li').length>0)
            {
                if(t==0)
                {
                    $("a[tree-date-type=title][data-type="+t+"][data-id="+id+"]").parent().find("i:eq(0)").addClass("arrow-deg");
                }
                else
                {
                    $("a[tree-date-type=title][data-type="+t+"][data-id="+id+"]").parent().find("i:eq(0)").find("a").html("&#xe707;");
                }
            }
        }
		return _asr.loadData(_funcid, _url, null, <?php echo $funcid ?>_append_info);
	}

    function <?php echo ($funcid); ?>_select_company(obj)
    {
        $("#<?php echo $funcid;?>-selected-company-id").val($(obj).attr("data-id"));
        $("#<?php echo $funcid;?>-selected-templet-detail-id").val("");
        $("#<?php echo $funcid;?>-trees-nav-new-in").find("a").each(function() {
            _asr.removeClass($(this), "active");
        });
        $("#<?php echo ($funcid); ?>-new-trees-info .new-trees-scroll .new-trees-scroll-in").children("div:gt(0)").hide();
        $(obj).addClass("active");
    }

	function <?php echo $funcid ?>_load_bom_callback(parent_id, list, r) {
		var _list = $("div[data-parent=parent-<?php echo $funcid;?>-" + parent_id + "]");
		var _html = "<ul>";

		for(var k in list){
			var _url = '<?php echo U("/Home/GoodsBom/index") ?>' + "?func=loadbominfo&id=" + list[k]["id"];
			var _funcid = _asr.createFuncId();
			_html += "<li>";
			_html += "<i class=\"iconfont" + (list[k]['children'] == 0 ? " no-child" : "") + "\"><a href=\"javascript:void(0);\" onclick=\"<?php echo $funcid; ?>_load_bom(" + list[k]["id"] + ", " + list[k]["goods_id"] + ");\"></a></i>";
			_html += "<a href=\"javascript:void(0);\"" + (list[k]['is_include'] == 0 ? "class=\"tree-ch-link\"" : "" ) + " tree-date-type=\"title\" onclick=\"return <?php echo $funcid ?>_load_bom_info(" + list[k]["id"] + ", " + list[k]["goods_id"] + ");\" >" + list[k]["code"] + "-" + list[k]["name"] + (list[k]["link_code"] ? "(" + list[k]["link_code"] + ")" : "") + "</a>";
			_html += "<div data-parent=\"parent-<?php echo $funcid;?>-" + list[k]["id"] + "\"></div>";
			_html += "</li>";
		}

		_html += "</ui>";
		_list.append(_html);
		if(typeof(r) != 'undefined' && r > 0) {
			<?php echo $funcid ?>_load_bom_info(parent_id, r);
		}
	}
	
	function <?php echo $funcid ?>_append_info(c) {
		var _obj = $("#<?php echo $funcid;?>-new-trees-info");
		_obj.empty();
		_obj.html(c);
        //$("#<?php echo ($funcid); ?> .new-trees-scroll-in .pub-par-title span").html($("a[tree-date-type=title].active").attr("data-path"));

    }



	function <?php echo ($funcid); ?>_detail_add(t){

        var pid= $("#<?php echo $funcid;?>-selected-templet-detail-id").val();
		var url = '<?php echo U("/Home/TempletDetail/index"); ?>';
        url += "?func=add&t="+t+"&tid=<?php echo ($templet['id']); ?>&ofuncid=<?php echo $funcid;?>";
        if(pid!=undefined && pid!="" )
        {
            url+="&pid="+pid;
        }
		return _asr.popupFun(url);
	}

    function <?php echo ($funcid); ?>_detail_add_callback(content){
        var curdata=eval(content);
        var pel=undefined;
        var el=$("a[data-type='"+ curdata.type +"'][data-id="+ curdata.id+"]");
        var siocn="";
        if(el.length<=0)
        {
            var title="";
            var class_color="";
            if(content.parent_id==0 || content.parent_id==undefined)
            {
                pel=$("#<?php echo $funcid;?>-trees-nav-new-in");
            }else
            {
                pel=$("a[data-id="+ curdata.parent_id+"]").parent();
            }
            if(content.type!=0)
            {
                siocn="&#xe631;";
                title='['+content.type+'类]'+ content.subject;
            }else
            {
                siocn="&#xe618;";
                if(content.req_type==1)
                {
                    // title= "套题 "+content.score+"分 "+ content.req_category_name +"";
                    title= content.subject+", "+content.score+"分, "+ content.req_category_name +"";
                    class_color="abe-blue";
                }else
                {
                    // title="第"+content.seq+"题 "+content.score+"分 "+ content.req_kind_name +" "+content.req_category_name+"";
                    title=content.subject+", "+content.score+"分, "+ content.req_kind_name +", "+content.req_category_name+"";
                }
            }
            if($(pel).children("ul").length<=0)
            {
                $(pel).append('<ul></ul>');
            }

            var cur_li='<li><i class="iconfont no-child"><a href="javascript:void(0);" onclick="<?php echo ($funcid); ?>_load_bom(this);">'+siocn+'</a></i><a class="'+class_color+'" data-type="'+ curdata.type +'" data-id="'+curdata.id+'"  href="javascript:void(0);" tree-date-type="title" onclick="<?php echo ($funcid); ?>_load_bom_info('+ curdata.id +','+ curdata.type +');" class="'+(curdata.type!=0?"abe-ft14":"")+'">'+ title +'</a>'+ curdata.child_html +'</li>';
            $(pel).children("ul").append(cur_li);
        }else
        {
            if(content.type!=0)
            {
                title='['+content.type+'类]'+content.subject;
            }else
            {
                if(content.req_type==1)
                {
                    title=content.subject+", "+content.score+"分, "+ content.req_category_name +"";
                    if($(el).parent().children("ul").length>0)
                    {
                        $(el).parent().children("ul").remove();
                    }
                    $(el).parent().append(content.child_html);
                }else
                {
                    title=content.subject+", "+content.score+"分, "+ content.req_kind_name +", "+content.req_category_name+"";
                }
            }
            $(el).html(title);
            $(el).click();
        }

    }


    function <?php echo ($funcid); ?>_category_delete_callback(content){
        var curdata=eval(content);
        var pel=undefined;

        $("a[data-type='"+curdata.type+"'][data-id="+ curdata.id +"]").parent().remove();
        if(curdata.parent_id==undefined || curdata.parent_id==0)
        {
            pel=$("a[tree-date-type=title]:eq(0)");
        }else
        {
            pel=$("a[data-id="+ curdata.parent_id +"]");
        }
        $(pel).click();
    }


    function <?php echo ($funcid); ?>_effects_add(){
        var pid = $("#<?php echo $funcid;?>-selected-templet-detail-id").val();
        if(pid==undefined || pid=="")
        {
                _asr.message("警告","必须选择一个分类","");
                return;
        }

        var url = '<?php echo U("/Home/EffectsCategory/index"); ?>';
        url += "?func=detail_add&ofuncid=<?php echo $funcid;?>";
        url +="&category_id="+pid;

        return _asr.popupFun(url);
    }


    function <?php echo ($funcid); ?>_create_exam_callback(msg){
        // var cur_url="<?php echo U('/Home/Templet/index/func/getexam_detail');?>";
        // cur_url+="?id="+id;
        // _asr.loadData("<?php echo ($funcid); ?>",cur_url,"<?php echo ($funcid); ?>_exam_list");
        //$("#<?php echo ($funcid); ?>-selected-exam-id").val($id);
        if(msg!=undefined && msg!="")
        {
            _asr.message("提示",msg);
        }
        if($("#<?php echo ($funcid); ?> a[tree-date-type=title].active").length<=0)
        {
            $("#<?php echo ($funcid); ?> a[tree-date-type=title]:eq(0)").click();
        }else
        {
            $("#<?php echo ($funcid); ?> a[tree-date-type=title].active").click();
        }
    }

    function <?php echo ($funcid); ?>_clear_active(){
        $('#<?php echo ($funcid); ?>-selected-templet-detail-id').val('');
        $("#<?php echo ($funcid); ?> a[tree-date-type=title].active").removeClass("active");
    }


    function <?php echo ($funcid); ?>_move_up(t){
       var cur_el=$("#<?php echo ($funcid); ?> a[tree-date-type=title].active");
       if(cur_el.length<=0)
       {
            $_asr.message("提示","请选择一个项目");
            return;
       }
       var cur_index=$(cur_el).parent().index();
           if(t==1)
           {
               if($(cur_el).parent().next().length<=0)
               {
                   _asr.message("提示","此项目不能下移");
                   return;
               }
               var prev_id=$(cur_el).attr("data-id");
               var id=$(cur_el).parent().next().children("a[tree-date-type=title]").attr("data-id");;
           }else
           {
               if($(cur_el).parent().prev().length<=0)
               {
                   _asr.message("提示","此项目不能上移");
                   return;
               }
               var prev_id=$(cur_el).parent().prev().children("a[tree-date-type=title]").attr("data-id");
               var id=$(cur_el).attr("data-id");
           }
       var _funcid='<?php echo ($funcid); ?>';
       var _url='<?php echo U("/Home/Templet/index/func/move_up");?>';
        _url+="?move_up="+t+"&id="+id+"&pid="+prev_id;
        return _asr.confirm('是否移动此明细','请确认是否要是否移动此明细?','', _url);
        //return _asr.loadData(_funcid, _url, null, <?php echo $funcid ?>_move_up_callback);
    }

    function <?php echo ($funcid); ?>_move_up_callback(t){
        var cur_el=$("#<?php echo ($funcid); ?> a[tree-date-type=title].active").parent();
        if(t=="1")
        {
            var prev_li=$(cur_el).next();
        }else
        {
            var prev_li=$(cur_el).prev();
        }
        if(prev_li.length!=0)
        {
            if(t=="1")
            {
                $(prev_li).after(cur_el);
            }else
            {
                $(prev_li).before(cur_el);
            }
        }
    }

    function <?php echo ($funcid); ?>_detail_edit(){
        var cur_el=$("#<?php echo ($funcid); ?> a[tree-date-type=title].active");
        if(cur_el.length<=0)
        {
            _asr.message("提示信息","请选择一个操作项目");
            return;
        }

        var _funcid='<?php echo ($funcid); ?>';
        var _url='<?php echo U("/Home/TempletDetail/index/func/add");?>';
        _url+="?id="+$(cur_el).attr("data-id");
        return _asr.popupFun(_url, '');
    }

    function <?php echo ($funcid); ?>_detail_del(){
        var cur_el=$("#<?php echo ($funcid); ?> a[tree-date-type=title].active");
        if(cur_el.length<=0)
        {
            _asr.message( "提示信息","请选择一个操作项目");
            return;
        }

        var _funcid='<?php echo ($funcid); ?>';
        var _url='<?php echo U("/Home/TempletDetail/index/func/delete");?>';
        _url+="?pfuncid=<?php echo ($funcid); ?>&id="+$(cur_el).attr("data-id");
        return _asr.confirm('删除模板明细','请确认是否要删除此模板明细?','', _url);
    }

    function <?php echo ($funcid); ?>_tree_refresh(){
        var _url='<?php echo U("/Home/Templet/index/func/tree/id/".$templet_id);?>';
        return _asr.loadData("<?php echo ($funcid); ?>", _url, "<?php echo ($funcid); ?>_tree" );
    }
</script>