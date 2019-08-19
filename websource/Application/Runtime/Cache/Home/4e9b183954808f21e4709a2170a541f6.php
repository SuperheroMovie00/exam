<?php if (!defined('THINK_PATH')) exit();?>
<div toplayer="1" class="prompt-pop pop-style3" style="z-index:<?php echo ($zindex); ?>;width:900px;" id="<?php echo $funcid;?>" url="<?php echo U('TempletDetail/index'); ?>">
    <div class="title">
        <span class="pop-name">重抽试题</span>
        <a href="javascript:void(0);" onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');" class="close iconfont">&#xe60d;</a>
    </div>
    <div class="pop-scroll">
        <div class="screening ">
            <form enctype="multipart/form-data" action="<?php echo U('Templet/index?func=select_question'); ?>" id="<?php echo "$funcid"; ?>-Search" method="post">
            <input type="hidden" name="<?php echo "$funcid"; ?>-last-url" id="<?php echo "$funcid"; ?>-last-url" value="<?php echo $__last_url; ?>" />
            <input type="hidden" name="funcid" value="<?php echo "$funcid"; ?>" />
            <input type="hidden" name="pfuncid" value="<?php echo "$pfuncid"; ?>" />
            <input type="hidden" name="id" value="<?php echo $exam_detail["id"]; ?>" />
            <input type="hidden" name="templet_id" value="<?php echo $exam_detail["templet_id"]; ?>" />
            <input type="hidden" name="_lastchanged" value="<?php echo $search["lastchanged"]; ?>" />
            <ul class="form form-mod-new form-column2">
                <li class="per100" >
                    <div class="unit-left">抽题规则<em class="abe-red mrg_5 mlg_5">*</em></div>

                    <div class="unit-mid">
                        <div><label class="pbtxt txt0 mrg_10" ><?php echo ($exam_detail['subject']); ?>，<?php echo ($exam_detail['question_category_name']); ?>，<?php echo $exam_detail['question_type']?"套题":subcode_view('question:kind',$exam_detail['question_kind']) ; ?></label> </div>
                    </div>
                </li>
                <li class="per100" >
                    <div class="unit-left">重抽方式<em class="abe-red mrg_5 mlg_5">*</em></div>
                    <div class="unit-mid">
                        <div><input type="radio"  value="1"  name="random"  class="mrg_10" checked="checked" > 随机抽取试题
                            <span style="display: " id="querstionrandom" class="pdl_15">按规则重新随机抽取一题
                                <input type="button" value="重新抽题" class="btn btn-blue btn-sm mlg_10 " onclick="return _asr.confirm('重抽题目','请确认是否要重抽此题目?','', '<?php echo U("/Home/Templet/index?func=select_question&tid=".$exam_detail["templet_id"]."&Key=".$exam_detail["id"]."&pfuncid=".$pfuncid); ?>');" />
                            </span>
                        </div>
                    </div>
                </li>


                <li class="per100">
                    <div class="unit-left"><em class="abe-red mrg_5 mlg_5"></em></div>
                    <div class="unit-mid">
                        <div><input type="radio"  value="0"  name="random" class="mrg_10"> 抽取指定试题
                            <span style="display: none" id="randomforcode" class="pdl_15">输入题号：
                                <input type="text" style="width: 100px"  name="code"  value="<?php echo $search['seq']; ?>"  >
                                <input type="text" style="display: none"  name="lockertype" id="filetype" >
                                 <input type="button" value="重新抽题" class="btn btn-blue btn-sm mrg_10 " onclick="return <?php echo ($funcid); ?>_question_show();" />
                            </span>
                        </div>
                    </div>
                </li>
                   <!-- <li class="per100" style="display: none" id="randomforcode1">
                        <div class="unit-left"><span class="tit"> 输入指定题号<em class="abe-red mrg_5">*</em></span></div>
                        <div class="unit-mid">
                            <div class="textbox">
                                <input type="text" style="width: 200px" class="pbtxt txt0" name="code"  value="<?php echo $search['seq']; ?>"  >
                            </div>
                            <div class="prompt" style="display:none">
                                <div class="error"><i class="iconfont">&#xe616;</i></div>
                            </div>
                        </div>
                    </li>-->





<li class="per100">
    <span>
    1. 选择抽取方式（随机抽取或指定题号），按“重新抽取”按钮进行抽题<br/>
    2. 系统展示抽取的试题，查看确认后按“提交”，系统将当前试题替换到试卷
</span>
    <!--<input type="button" value="查看题目" class="btn btn-blue mrg_10 " onclick="return <?php echo ($funcid); ?>_question_show();" />-->
</li>
            </ul>
            </form>
        </div>
        <div id="<?php echo ($funcid); ?>_question">

        </div>
    </div>
    <div class="pop-sub abe-txtc" >

        <!--<input type="button" value="重新抽题" class="btn btn-blue mrg_10 " onclick="return _asr.confirm('重抽题目','请确认是否要重抽此题目?','', '<?php echo U("/Home/Templet/index?func=select_question&tid=".$exam_detail["templet_id"]."&Key=".$exam_detail["id"]."&pfuncid=".$pfuncid); ?>');" />-->
        <input type="button"  id="fakesubmit"  style="display: " value="提交" class="btn btn-blue mrg_10 " onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');" />
        <input type="button"  id="submit"       style="display:none;" value="提交" class="btn btn-blue mrg_10 " onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Search', '<?php echo U("/Home/Templet/index?func=question_save&id=$exam_detail[id]") ; ?>',''); " />
        <input type="button"    value="取消" class="btn btn-org mrg_10 " onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');" />
    </div>
</div>

<script>
    $(function () {
        $filetype1=1;
    });


    $(".mrg_10").click(function () {
        $filetype1= $("input[name='random']:checked").val();


        if ($filetype1==0){
            $("#randomforcode").show();
            $("#fakesubmit").hide();
            $("#submit").show();
            $("#querstionrandom").hide();
        }
        if ($filetype1==1){
            $("#randomforcode").hide();
            $("#fakesubmit").show();
            $("#submit").hide();
            $("#querstionrandom").show();
        }

        $("#filetype").val($filetype1);
    });





    function <?php echo $funcid; ?>_chooseDate(o) {
        if($('.date').length>0)
            pickmeup('.date').destroy();
        $('.date').removeClass('date')
        $(o).addClass('date');
        pickmeup('.date', {
            format  : 'Y-m-d',
            date : $(o).val(),
            hide_on_select : true,
            locale : 'zh'
        }).show();
    }







    $('.calendar0,.calendar1').on('click',function(){
    <?php echo $funcid; ?>_chooseDate(this)
    });


    /* ************************************************************************************* */
    /* 前台页面初始化                                                                           */
    /* ************************************************************************************* */
    function <?php echo $funcid; ?>_init(_id){
        return ;
    }

    /***************************************************************************************/
    /* 前台页面清除                                                                      */
    /***************************************************************************************/
    function <?php echo $funcid; ?>_clearsearch(_frm){

        _asr.setvaluebyname(_frm,"type", "" );
        _asr.setvaluebyname(_frm,"templet_no", "" );
        _asr.setvaluebyname(_frm,"subject", "" );
        _asr.setvaluebyname(_frm,"seq", "" );
        _asr.setvaluebyname(_frm,"score", "" );
        _asr.setvaluebyname(_frm,"req_type", "" );
        _asr.setvaluebyname(_frm,"req_category_code_name", "" );
        _asr.setvaluebyname(_frm,"req_category_code", "" );
        _asr.setvaluebyname(_frm,"req_kind", "" );
        _asr.setvaluebyname(_frm,"req_child_count", "" );
        _asr.setvaluebyname(_frm,"req_child_seq", "" );
        _asr.setvaluebyname(_frm,"extract", "" );


        $("#<?php echo ($funcid); ?>").find(".selebtn").each(function(){
            $(this).find("a:eq(0)").click();
        });

        $("#<?php echo ($funcid); ?> .city-tags-new .sele-remove").click();
    }

    function <?php echo $funcid;?>_callback(param){
        _asr.closePopup('<?php echo ($funcid); ?>');

    }

    function <?php echo $funcid;?>_select_question_callback(param){
        var url = '<?php echo U("/Home/Templet/index"); ?>';
        url += "?func=questionview&id="+param;
        _asr.loadData('<?php echo ($funcid); ?>_question',url,'<?php echo ($funcid); ?>_question');
        <?php echo ($pfuncid); ?>_select_question_callback();
    }

    function <?php echo $funcid;?>_question_show(){
        var code=$("#<?php echo ($funcid); ?> input[name='code']").val();
        if(code==undefined || code=='')
        {
            _asr.message("提示","请输入题号");
            return;
        }
        var url = '<?php echo U("/Home/Templet/index"); ?>';
        url += "?func=questionview&code="+code+"&t=1&ofuncid=<?php echo $funcid;?>";
        _asr.loadData('<?php echo ($funcid); ?>_question',url,'<?php echo ($funcid); ?>_question');
    }


</script>