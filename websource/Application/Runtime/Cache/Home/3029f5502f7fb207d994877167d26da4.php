<?php if (!defined('THINK_PATH')) exit();?>
<div toplayer="1" class="prompt-pop" style="z-index: <?php echo ($zindex); ?>;" id="<?php echo $funcid;?>" funcid="<?php echo ($funcid); ?>"
     last-url="<?php echo ($__last_url); ?>">

    <div class="title">
        <span class="pop-name">题库数据导入</span>
        <a href="javascript:void(0);" onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');"
           class="close iconfont">&#xe60d;</a>
    </div>


    <form action="<?php echo U('/Home/Question/index?func=import&close=1');?>" method="post"
          id="<?php echo $funcid;?>-Question-import-Form" enctype="multipart/form-data">
        <input type="hidden" name="orderid" value="<?php echo ($orderid); ?>"/>
        <input type="hidden" name="funcid" value="<?php echo ($funcid); ?>"/>
        <input type="hidden" name="pfuncid" value="<?php echo ($pfuncid); ?>"/>
        <input type="checkbox" style="display: none"  name="checkbox_value" id="<?php echo $funcid;?>_checkbox" value="1" >

        <input type="file" style="display:none;" id="<?php echo $funcid;?>_import_file" name="import"
               onchange="<?php echo $funcid;?>_choose();"/>
    </form>

    <form action="<?php echo U('/Home/Question/index?func=img&close=1');?>" method="post"
                   id="<?php echo $funcid;?>-Question-img-Form" enctype="multipart/form-data">
    <input type="hidden" name="orderid" value="<?php echo ($orderid); ?>"/>
    <input type="hidden" name="funcid" value="<?php echo ($funcid); ?>"/>
    <input type="hidden" name="pfuncid" value="<?php echo ($pfuncid); ?>"/>

    <input type="file" style="display:none;" id="<?php echo $funcid;?>_img_file" name="img"
           onchange="<?php echo $funcid;?>_imgchoose();"/>
    </form>



    <ul class="pbform">

        <li>
            <font color="red">*如果有图片请先上传图片压缩文件</font>
        </li>




        <li>
            <span class="tit">
            <em class="abe-red mrg_5"></em>操作文件类型
            </span>
            &ensp; &ensp;
            试题图片(.zip)：<input type="radio" name="filetype1" class="filetype" value="img" checked="checked">
            &ensp; &ensp; &ensp; &ensp; &ensp;
            题库文件(.csv)：<input type="radio" name="filetype1" class="filetype" value="import">
        </li>


        <!--<li>
            <span class="tit">
            <em class="abe-red mrg_5"></em>图片压缩文件
            </span>
            <div class="txt-box">
                <input type="text" id="<?php echo $funcid;?>_img" readonly class="pbtxt"
                       onclick="$('#<?php echo $funcid;?>_img_file').click();" value=""/>
                <input type="button" value="选择文件" class="btn btn-blue"
                       onclick="$('#<?php echo $funcid;?>_img_file').click();"/>
            </div>
        </li>

        <li>
            <span class="tit">
            <em class="abe-red mrg_5"></em>题库文件
            </span>
            <div class="txt-box">
                <input type="text" id="<?php echo $funcid;?>_import" readonly class="pbtxt"
                       onclick="$('#<?php echo $funcid;?>_import_file').click();" value=""/>
                <input type="button" value="选择文件" class="btn btn-blue"
                       onclick="$('#<?php echo $funcid;?>_import_file').click();"/>
            </div>
        </li>
-->


        <li>
            <span class="tit">
                <input type="hidden" name="hidden" id="hidden" >
            <em class="abe-red mrg_5" ></em>导入试题文件
            </span>
            <div class="txt-box">
                <input type="text" id="<?php echo $funcid;?>_type" readonly class="pbtxt"
                       onclick="$('#<?php echo $funcid;?>_'+filetype1+'_file').click();" value=""/>
                <input type="button" value="选择文件" class="btn btn-blue"
                       onclick="$('#<?php echo $funcid;?>_'+filetype1+'_file').click();"/>
            </div>
        </li>

       <!-- $("input[name='filetype1']:checked").val()-->

        <li>
            <span class="tit">
            <em class="abe-red mrg_5"></em>导入题库模板
            </span>


            <div class="txt-box">
                <a href="\Uploads\Uploads\导入题库.csv">点击下载</a>
            </div>
        </li>


        <li>
            <input type="checkbox"  name="value" value="1"  onclick="$('#<?php echo $funcid;?>_checkbox').click();" />
            <span class="tit">编码相同覆盖</span>
        </li>

    </ul>

    <!--svn://106.14.62.211/examination-->
    <div class="pop-sub abe-txtc">
       <!-- <input type="submit" value="提交图片" class="btn btn-blue mrg_10"
               onclick="return _asr.submit('<?php echo $funcid;?>', '<?php echo $funcid;?>-Question-img-Form', '<?php echo U('/Home/Question/index?func=import_save&close=1');?>',2,'','请确认是否开始图片导入?');">-->
        <input type="submit" value="提交" class="btn btn-blue mrg_10"
               onclick="return _asr.submit('<?php echo $funcid;?>','<?php echo $funcid;?>-Question-'+filetype1+'-Form', '<?php echo U('/Home/Question/index?func=import_save&close=1');?>',2,'','请确认是否开始数据导入?');" >
        <input type="submit" value="取消" class="btn btn-org mrg_10"
               onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');">
    </div>


</div>

<script>

       var filetype1= "img";

        $(".filetype").click(function () {
              filetype1= $("input[name='filetype1']:checked").val();

        });



    function <?php echo $funcid;?>_init()
    {
        var _this = $("#<?php echo $funcid ?>");
        var ppw = _this.width() / 2;
        _this.css({'margin-left': -ppw});
    }

    function <?php echo $funcid;?>_refresh()
    {
        _asr.submit('<?php echo $funcid;?>', $("#<?php echo $funcid ?>").find("form").eq(1), '');
    }

    function <?php echo $funcid;?>_choose()
    {
        $('#<?php echo $funcid;?>_type').val($('#<?php echo $funcid;?>_import_file').val());
    }

    function <?php echo $funcid;?>_imgchoose()
    {
        $('#<?php echo $funcid;?>_type').val($('#<?php echo $funcid;?>_img_file').val());
    }




</script>