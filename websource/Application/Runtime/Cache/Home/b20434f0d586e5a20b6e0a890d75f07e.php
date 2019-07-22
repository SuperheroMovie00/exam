<?php if (!defined('THINK_PATH')) exit();?>
<div toplayer="1" class="prompt-pop pop-style3" style="z-index:<?php echo ($zindex); ?>;width:800px;" id="<?php echo $funcid;?>" url="<?php echo U('Question/index'); ?>">

   <div class="title">
       <span class="pop-name"><?php echo $search[id]?'编辑':'新增'; ?>题库信息</span>
       <a href="javascript:void(0);" onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');" class="close iconfont">&#xe60d;</a>
   </div>





<div class="pop-scroll">
   <div class="screening ">
      <form enctype="multipart/form-data" action="<?php echo U('Question/index?func=save'); ?>" id="<?php echo "$funcid"; ?>-Search" method="post">
          <input type="hidden" name="<?php echo "$funcid"; ?>-last-url" id="<?php echo "$funcid"; ?>-last-url" value="<?php echo $__last_url; ?>" />
          <input type="hidden" name="funcid" value="<?php echo "$funcid"; ?>" />
          <input type="hidden" name="pfuncid" value="<?php echo "$pfuncid"; ?>" />
          <input type="hidden" name="id" value="<?php echo $search["id"]; ?>" />
          <input type="hidden" name="_lastchanged" value="<?php echo $search["lastchanged"]; ?>" />
          <ul class="form form-mod-new form-column2">

             <li>
                  <div class="unit-left"><span class="tit"> 选择类型<em class="abe-red mrg_5">*</em></span></div>
                  <div class="unit-mid">
                       <div class="dropdown" id="<?php echo ($funcid); ?>_type">
                           <select class="pbsele dropdown0" name="type">
                              <option value="" <?php if($search['type'] == ''): ?> selected="selected" <?php endif;?> ></option>
                             <?php
 $keyvalue = table_Question_type(); if(is_array($keyvalue)){ $i = 0; $__LIST__ = $keyvalue; ?>
                                    <?php foreach($__LIST__ as $key=>$item): ++$i; ?>
                                 <option value="<?php echo $item['id']; ?>" <?php if($item['id'] == $search['type']): ?> selected="selected" <?php endif;?>><?php echo $item['name']; ?></option>
                                    <?php endforeach; ?>
                             <?php } ?>
                           </select>
                       </div>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>
             <li>
                  <div class="unit-left"><span class="tit"> 知识点码</span></div>
                  <div class="unit-mid">
                       <div class="popup">
                            <input  type="text" class="pbtxt txt0" name="category_code_name" readonly="readonly" value="<?php echo $search['category_code_name']; ?>">
                            <button type="submit" class="txt-search" onclick="return _asr.popup('QuestionCategoryTree','<?php echo "$funcid"; ?>','<?php echo "$funcid"; ?>-Search','Single','category_code','category_code_name'); " <?php if($search["category_code_name"]): ?> style="display:none"<?php endif; ?> ><i class="iconfont">&#xe60e;</i></button>
                            <button type="submit" class="txt-clear" onclick="_asr.setvaluebyname('<?php echo "$funcid"; ?>-Search','category_code','');_asr.setvaluebyname('<?php echo "$funcid"; ?>-Search','category_code_name','');return false;" <?php if(!$search["category_code_name"]): ?> style="display:none"<?php endif; ?> ><i class="iconfont">&#xe616;</i></button>
                       </div>
                      <input type="hidden" name="category_code" value="<?php echo $search['category_code']; ?>">
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>
             <li>
                  <div class="unit-left"><span class="tit"> 编码<em class="abe-red mrg_5">*</em></span></div>
                  <div class="unit-mid">
                       <div class="textbox">
                            <input type="text" class="pbtxt txt0" name="code"  value="<?php echo $search['code']; ?>"  >
                       </div>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>
             <li>
                  <div class="unit-left"><span class="tit"> 名称<em class="abe-red mrg_5">*</em></span></div>
                  <div class="unit-mid">
                       <div class="textbox">
                            <input type="text" class="pbtxt txt0" name="name"  value="<?php echo $search['name']; ?>"  >
                       </div>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>
             <li>
                  <div class="unit-left"><span class="tit"> 选择题型</span></div>
                  <div class="unit-mid">
                       <div class="dropdown" id="<?php echo ($funcid); ?>_kind">
                           <select class="pbsele dropdown0" name="kind">
                              <option value="" <?php if($search['kind'] == ''): ?> selected="selected" <?php endif;?> ></option>
                             <?php
 $keyvalue = subcode('question:kind'); if(is_array($keyvalue)){ $i = 0; $__LIST__ = $keyvalue; ?>
                                    <?php foreach($__LIST__ as $key=>$item): ++$i; ?>
                                 <option value="<?php echo $item['code']; ?>" <?php if($item['code'] == $search['kind']): ?> selected="selected" <?php endif;?>><?php echo $item['name']; ?></option>
                                    <?php endforeach; ?>
                             <?php } ?>
                           </select>
                       </div>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>

             <li class="per100">
                  <div class="unit-left"><span class="tit"> 题干</span></div>
                  <div class="unit-mid">
                       <textarea class="textarea0" name="stem"  style="height: 75px" ><?php echo $search['stem']; ?></textarea>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>

              <li class="per100">
                  <div class="unit-left"><span class="tit">题干描述</span></div>
                  <div class="unit-mid">
                      <textarea class="textarea0" name="description" > <?php echo $search['description']; ?></textarea>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
              </li>

             <li class="per100">
                  <div class="unit-left"><span class="tit">设问</span></div>
                  <div class="unit-mid">
                       <textarea class="textarea0" style="height: 75px" name="quiz" ><?php $str = str_replace('|', "\n", $search['quiz']); echo $str ?></textarea><!--从数据库中取出的时候将管道符替换成换行符-->
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>

             <li class="per100">
                  <div class="unit-left"><span class="tit">答案</span></div>
                  <div class="unit-mid">
                       <textarea class="textarea0" name="answer" ><?php echo $search['answer']; ?></textarea>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>

             <li class="per100">

                  <div class="unit-left"><span class="tit"> 解析 </span></div>
                  <div class="unit-mid">
                       <textarea class="textarea0" name="analysis" ><?php echo $search['analysis']; ?></textarea>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>


             <!--<li>
                  <div class="unit-left"><span class="tit"> 小题数</span></div>
                  <div class="unit-mid">
                       <div class="textbox">
                            <input type="text" class="pbtxt txt0" name="childs"  value="<?php echo $search['childs']; ?>"  >
                       </div>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>-->

             <li class="per100">
                  <div class="unit-left"><span class="tit"> 图像</span></div>
                  <div class="unit-mid">
                       <div class="textbox">
                           <input type="text" readonly class="pbtxt txt0" id="<?php echo $funcid;?>_import" onclick="$('#<?php echo $funcid;?>_import_file').click();" value="<?php echo $search['img']; ?>"   />
                           <input type="file" name="img" style="display: none;" id="<?php echo $funcid;?>_import_file" onchange="<?php echo $funcid;?>_choose();" />
                       </div>
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
               <input type="button" value="提交" class="btn btn-blue mrg_10 " onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Search', '<?php echo U("/Home/Question/index?func=save&id=$search[id]") ; ?>',''); " />

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

            _asr.setvaluebyname(_frm,"type", "" );
            _asr.setvaluebyname(_frm,"category_code_name", "" );
            _asr.setvaluebyname(_frm,"category_code", "" );
            _asr.setvaluebyname(_frm,"code", "" );
            _asr.setvaluebyname(_frm,"name", "" );
            _asr.setvaluebyname(_frm,"kind", "" );
            _asr.setvaluebyname(_frm,"stem", "" );
            _asr.setvaluebyname(_frm,"quiz", "" );
            _asr.setvaluebyname(_frm,"answer", "" );
            _asr.setvaluebyname(_frm,"analysis", "" );
            _asr.setvaluebyname(_frm,"childs", "" );
            _asr.setvaluebyname(_frm,"img", "" );


          $("#<?php echo ($funcid); ?>").find(".selebtn").each(function(){
              $(this).find("a:eq(0)").click();
            });

          $("#<?php echo ($funcid); ?> .city-tags-new .sele-remove").click();
        }

   function <?php echo $funcid;?>_callback(param){
        _asr.closePopup('<?php echo ($funcid); ?>');
   }


        function <?php echo $funcid;?>_choose(){
            $('#<?php echo $funcid;?>_import').val($('#<?php echo $funcid;?>_import_file').val())
        }

    <?php echo W('Summary/javascript',array('Question'));?>

</script>