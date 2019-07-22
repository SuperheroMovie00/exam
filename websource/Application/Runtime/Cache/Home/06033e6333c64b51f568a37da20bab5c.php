<?php if (!defined('THINK_PATH')) exit();?>
<div toplayer="1" class="prompt-pop" style="z-index: <?php echo ($zindex); ?>;" id="<?php echo $funcid;?>"  funcid="<?php echo ($funcid); ?>" last-url="<?php echo ($__last_url); ?>">

   <div class="title">
       <span class="pop-name">系统参数 - 转无效</span>
       <a href="javascript:void(0);" onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');" class="close iconfont">&#xe60d;</a>
   </div>





<div class="pop-scroll">
   <div class="screening ">
      <form action="<?php echo U('SystemParameter/index?func=status_off_save'); ?>" id="<?php echo "$funcid"; ?>-Search" method="get" verify="1">
          <input type="hidden" name="<?php echo "$funcid"; ?>-last-url" id="<?php echo "$funcid"; ?>-last-url" value="<?php echo $__last_url; ?>" />
          <input type="hidden" name="funcid" value="<?php echo "$funcid"; ?>" />
          <input type="hidden" name="pfuncid" value="<?php echo "$pfuncid"; ?>" />
          <input type="hidden" name="id" value="<?php echo $search["id"]; ?>" />
          <input type="hidden" name="_lastchanged" value="<?php echo $search["lastchanged"]; ?>" />
          <ul class="form form-mod-new form-column2">

            <li>
                <div class="unit-left">备注说明<em class="abe-red mrg_5 mlg_5">*</em></div>
                <div class="unit-mid">
                    <div><input type="radio"  value="资料错误"  name="reason_tag"  class="mrg_10"> 资料错误</div>
                    <div><input type="radio"  value="信息变化"  name="reason_tag"  class="mrg_10"> 信息变化</div>
                    <div><input type="radio"  value="其他原因"  name="reason_tag"  class="mrg_10"> 其他原因</div>
                </div>
            </li>
            <li class="per100">
                <div class="unit-left"><span class="tit"> <em class="abe-red mrg_5"></em></span></div>
                <div class="unit-mid">
                    <textarea class="textarea0" name="reason" style="height: 120px;" ></textarea>
                    <div class="prompt" style="display:none">
                        <div class="error"><i class="iconfont">&#xe616;</i></div>
                    </div>
                </div>
            </li>

          </ul>
       </form>
    </div>
 </div>
    <div class="pop-sub abe-txtc" >
               <input type="button" value="提交" class="btn btn-blue mrg_10 " onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Search', '<?php echo U("/Home/SystemParameter/index?func=status_off_save&id=$search[id]") ; ?>',''); " />
               <input type="button" value="取消" class="btn btn-org mrg_10 " onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');" />
    </div>




</div>

<script>
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


        /***************************************************************************************/
        /* 前台页面初始化                                                                      */
        /***************************************************************************************/
        function <?php echo $funcid; ?>_init(_id){
            return ;
        }

        /***************************************************************************************/
        /* 前台页面清除                                                                      */
        /***************************************************************************************/
        function <?php echo $funcid; ?>_clearsearch(_frm){



          $("#<?php echo ($funcid); ?>").find(".selebtn").each(function(){
              $(this).find("a:eq(0)").click();
            });

          $("#<?php echo ($funcid); ?> .city-tags-new .sele-remove").click();
        }

   function <?php echo $funcid;?>_callback(param){
        _asr.closePopup('<?php echo ($funcid); ?>');
   }



    <?php echo W('Summary/javascript',array('SystemParameter'));?>

</script>