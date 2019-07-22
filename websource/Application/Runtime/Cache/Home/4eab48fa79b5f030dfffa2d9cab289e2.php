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
                <div class="tree-title vi-blue"><a class="vi-blue" onclick="javascript:<?php echo ($funcid); ?>_clear_active();"><?php echo ($templet['subject']); ?>模板结构</a></div>
                <?php if(!empty($templet_list)) { ?>
                <?php echo showtempletlist($templet_list,$funcid); ?>
                <?php } ?>
            </div>
            <div class="data-oper abe-txtc">
                <div class="data-oper-in">


                    <span class="abe-fl ">共<?php echo ($templet['count']); ?>题, 满分<?php echo ($templet['score']); ?>分</span>
                    <input type="button" class="btn btn-blue mrg_10 btn-sm" value="抽取新试卷" onclick="return _asr.confirm('操作确认','请确认是否按此模板抽取新试卷?','', '<?php echo U("/Home/Templet/index?func=create_exam&tid=".$templet_id); ?>');" >
                </div>
            </div>
        </div>

        <div class="new-trees-info" id="<?php echo $funcid;?>-new-trees-info" style="padding-left:360px;">
            <div class="new-trees-scroll" >
                <div class="new-trees-scroll-in">

                <div class="pub-par-title ppt-ico-box">
                    <span class="abe-fl vi-blue abe-ft14">未确认的试卷</span>
                    <div class="abe-fr">
                        <?php if($templet_detail): ?><a href="javascript:void(0);" class="vi-blue pdr_10" onclick="return <?php echo ($pfuncid); ?>_load_bom_info(<?php echo ($templet_detail['id']); ?>)"><i class="iconfont">&#xe611;</i> 刷新</a><?php endif; ?>
                    </div>

                    </div>
                    <div id="<?php echo ($funcid); ?>_detailarea1">
                    <div class="table-box">
                        <div class="table-in" >

                        </div>
                    </div>
                    </div>

                    <div class="table-box" id="<?php echo ($funcid); ?>_detailarea2">
                        <div class="table-in" >
                        </div>
                        <div class="blank15"></div>
                    </div>

                    <div class="data-oper abe-txtc" style="display: none;">
                        <div class="talbe-page">
                            <?php echo $page; ?>
                        </div>
                        <div class="data-oper-in" >
                            <div class="abe-fl" >

                                <span class="pdr_10 ">当前已选择<i class="abe-ft16 vi-org"> 0 </i>条</span>

                                <!--   <input type="button" class= "btn btn-blue mrg_30 " value="重抽试卷" onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Result', '<?php echo U("/Home/Templet/index?func=create_exam&tid=".$templet_id."&examid=".$search['id']) ; ?>',''); ">
                                <input type="button" class="btn btn-blue mrg_10 " value="试卷编辑" onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Result', '<?php echo U("/Home/Templet/index?func=create_exam&tid=".$templet_id."&examid=".$search['id']) ; ?>',''); ">
                                   <input type="button" class="btn btn-blue mrg_30 " value="试卷确认" onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Result', '<?php echo U("/Home/Templet/index?func=create_exam&tid=".$templet_id."&examid=".$search['id']) ; ?>',''); ">
                                   <input type="button" class="btn btn-org mrg_10  " value="删除试卷" onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Result', '<?php echo U("/Home/Templet/index?func=create_exam&tid=".$templet_id."&examid=".$search['id']) ; ?>',''); ">
                               --></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>



<script>

    $(function(){

        // $("#<?php echo ($funcid); ?> .new-trees-scroll-in .pub-par-title span").html("模板名称: <?php echo ($templet['subject']); ?>(<?php echo ($templet['templet_no']); ?>), <br/>共<?php echo ($templet['count']); ?>题, 满分<?php echo ($templet['score']); ?>分");
        _asr.loadData('<?php echo "$funcid"; ?>_detailarea1','<?php echo U("Templet/index?func=detailarea1&id=$templet[id]") ; ?>','<?php echo "$funcid"; ?>_detailarea1');

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
        return;
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
                title=content.subject;
            }else
            {
                siocn="&#xe618;";
                if(content.req_type==1)
                {
                    title="套题 "+content.score+"分 "+ content.req_category_code_name +"";
                }else
                {
                    title="第"+content.seq+"题 "+content.score+"分 "+ content.req_kind_name +" "+content.req_category_code_name+"";
                }
            }
            if($(pel).children("ul").length<=0)
            {
                $(pel).append('<ul></ul>');
            }

            var cur_li='<li><i class="iconfont no-child"><a href="javascript:void(0);" onclick="<?php echo ($funcid); ?>_load_bom(this);">'+siocn+'</a></i><a data-type="'+ curdata.type +'" data-id="'+curdata.id+'"  href="javascript:void(0);" tree-date-type="title" onclick="<?php echo ($funcid); ?>_load_bom_info('+ curdata.id +','+ curdata.type +');" class="'+(curdata.type!=0?"abe-ft14":"")+'">'+ title +'</a>'+ curdata.child_html +'</li>';
            $(pel).children("ul").append(cur_li);
        }else
        {
            if(content.type!=0)
            {
                title=content.subject;
            }else
            {
                if(content.req_type==1)
                {
                    title="套题 "+content.score+"分 "+ content.req_category_code_name +"";
                    if($(el).parent().children("ul").length>0)
                    {
                        $(el).parent().children("ul").remove();
                    }
                    $(el).parent().append(content.child_html);
                }else
                {
                    title="第"+content.seq+"题 "+content.score+"分 "+ content.req_kind_name +" "+content.req_category_code_name+"";
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
        if(msg!=undefined && msg!="")
        {
            _asr.message("提示",msg);
        }
        _asr.loadData('<?php echo "$funcid"; ?>_detailarea1','<?php echo U("Templet/index?func=detailarea1&id=$templet[id]") ; ?>','<?php echo "$funcid"; ?>_detailarea1');
    }

    function <?php echo ($funcid); ?>_clear_active(){
        $('#<?php echo ($funcid); ?>-selected-templet-detail-id').val('');
        $("#<?php echo ($funcid); ?> a[tree-date-type=title].active").removeClass("active");
    }

    function <?php echo ($funcid); ?>_select_question_callback(msg){

        if(msg!=undefined && msg!="")
        {
            _asr.message("提示",msg);
       }

        $("#<?php echo ($funcid); ?>_detailarea2 .order-det-ptab a:eq(1)").click();
    }


    function <?php echo ($funcid); ?>_detail_edit(){
        var cur_el=$("#<?php echo ($funcid); ?> a[tree-date-type=title].active");
        if(cur_el.length<=0)
        {
            _asr.message("请选择一个项目");
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
            _asr.message("请选择一个项目");
            return;
        }

        var _funcid='<?php echo ($funcid); ?>';
        var _url='<?php echo U("/Home/TempletDetail/index/func/delete");?>';
        _url+="?pfuncid=<?php echo ($funcid); ?>&id="+$(cur_el).attr("data-id");
        return _asr.confirm('删除模板明细','请确认是否要删除此模板明细?','', _url);
    }
</script>