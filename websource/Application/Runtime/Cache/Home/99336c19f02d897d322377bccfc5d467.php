<?php if (!defined('THINK_PATH')) exit();?>
<div toplayer="1" class="prompt-pop pop-style3" style="z-index:<?php echo ($zindex); ?>;width:900px;" id="<?php echo $funcid;?>" url="<?php echo U('TempletDetail/index'); ?>">
    <div class="title">
       <span class="pop-name">组卷模板信息 - <?php echo $search[id]?'编辑':'新增'; ?></span>
       <a href="javascript:void(0);" onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');" class="close iconfont">&#xe60d;</a>
    </div>
    <div class="pop-scroll">
       <div class="screening ">
          <form enctype="multipart/form-data" action="<?php echo U('TempletDetail/index?func=save'); ?>" id="<?php echo "$funcid"; ?>-Search" method="post">
            <input type="hidden" name="<?php echo "$funcid"; ?>-last-url" id="<?php echo "$funcid"; ?>-last-url" value="<?php echo $__last_url; ?>" />
            <input type="hidden" name="funcid" value="<?php echo "$funcid"; ?>" />
            <input type="hidden" name="pfuncid" value="<?php echo "$pfuncid"; ?>" />
            <input type="hidden" name="id" value="<?php echo $search["id"]; ?>" />
            <input type="hidden" name="templet_id" value="<?php echo $search["templet_id"]; ?>" />
            <input type="hidden" name="parent_id" value="<?php echo $search["parent_id"]; ?>" />
            <input type="hidden" name="_lastchanged" value="<?php echo $search["last changed"]; ?>" />
              <ul class="form form-mod-new form-column2">
    <?php if($t != 0): ?><li>
                    <div class="unit-left"><span class="tit"> 标题类型<em class="abe-red mrg_5">*</em></span></div>
                    <div class="unit-mid">
                        <div class="dropdown" id="<?php echo ($funcid); ?>_type">
                            <select class="pbsele dropdown0" name="type">
                                <option value="" <?php if($search['type'] == ''): ?> selected="selected" <?php endif;?> ></option>
                                <?php
 $keyvalue = table_TempletDetail_type(); if(is_array($keyvalue)){ $i = 0; $__LIST__ = $keyvalue; ?>
                                <?php foreach($__LIST__ as $key=>$item): ++$i; ?>
                                <?php if($t != 0 and $item['id'] > 0): ?><option value="<?php echo $item['id']; ?>" <?php if($item['id'] == $search['type']): ?> selected="selected" <?php endif;?>><?php echo $item['name']; ?></option><?php endif; ?>
                                <?php endforeach; ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="prompt" style="display:none">
                            <div class="error"><i class="iconfont">&#xe616;</i></div>
                        </div>
                    </div>
                </li>
                <li class="per100" >
                    <div class="unit-left"><span class="tit"> 标题名称<em class="abe-red mrg_5">*</em></span></div>
                    <div class="unit-mid">
                        <textarea class="textarea0" name="subject"   ><?php echo $search['subject']; ?></textarea>
                        <div class="prompt" style="display:none">
                            <div class="error"><i class="iconfont">&#xe616;</i></div>
                        </div>
                    </div>
                </li>
                <li class="per100" >
                    <div class="unit-left"><span class="tit"> 标题补充<em class="abe-red mrg_5"></em></span></div>
                    <div class="unit-mid">
                        <textarea class="textarea0" name="additional"   ><?php echo $search['additional']; ?></textarea>
                        <div class="prompt" style="display:none">
                            <div class="error"><i class="iconfont">&#xe616;</i></div>
                        </div>
                    </div>
                </li>
        <?php if($search['type'] > 6 and $search['parents'] and false): ?><li>
                    <div class="unit-left"><span class="tit"> 变更上级<em class="abe-red mrg_5"></em></span></div>
                    <div class="unit-mid">
                        <div class="dropdown" id="<?php echo ($funcid); ?>_newparent">
                            <select class="pbsele dropdown0" name="newparent">
                                <option value="" selected="selected" >不改变</option>
                                <?php
 $keyvalue = $search["parents"]; $i = 0; $__LIST__ = $keyvalue; ?>
                                    <?php foreach($__LIST__ as $key=>$item): ++$i; ?>
                                        <option value="<?php echo $item['id']; ?>" ><?php echo $item['subject']; ?></option>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="prompt" style="display:none">
                            <div class="error"><i class="iconfont">&#xe616;</i></div>
                        </div>
                    </div>
                </li><?php endif; ?>

                <li class="per100" >
                  <div class="unit-left"><span class="tit"> 标题参考</span></div>
                  <div class="unit-mid"> </div>
                </li>
                <li class="per100" style="padding: 0px;height:331px;">
                    <img src="/Public/css/images/title.png" alt="" style="width: 100%; border: 1px solid #ccc;">
                </li><?php endif; ?>
    <?php if($t == 0): ?><li>
                      <div class="unit-left"><span class="tit"> 抽题要求<em class="abe-red mrg_5">*</em></span></div>
                      <div class="unit-mid">
                          <div class="dropdown" id="<?php echo ($funcid); ?>_extract">
                              <select class="pbsele dropdown0" name="extract">
                                  <?php
 $keyvalue = table_TempletDetail_extract(); if(is_array($keyvalue)){ $i = 0; $__LIST__ = $keyvalue; ?>
                                  <?php foreach($__LIST__ as $key=>$item): ++$i; ?>
                                  <option value="<?php echo $item['id']; ?>" <?php if($item['id'] == $search['extract']): ?> selected="selected" <?php endif;?>><?php echo $item['name']; ?></option>
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
                      <div class="unit-left"><span class="tit"> 试题题号<em class="abe-red mrg_5">*</em></span></div>
                      <div class="unit-mid">
                           <div class="textbox">
                                <input type="text" class="pbtxt txt0" name="seq"  value="<?php echo $search['seq']; ?>"  >
                           </div>
                          <div class="prompt" style="display:none">
                              <div class="error"><i class="iconfont">&#xe616;</i></div>
                          </div>
                      </div>
                 </li>
                 <li>
                 </li>
                 <li>
                      <div class="unit-left"><span class="tit"> 试题分数<em class="abe-red mrg_5">*</em></span></div>
                      <div class="unit-mid">
                           <div class="textbox">
                                <input type="text" class="pbtxt txt0" name="score"  value="<?php echo $search['score']; ?>"  >
                           </div>
                          <div class="prompt" style="display:none">
                              <div class="error"><i class="iconfont">&#xe616;</i></div>
                          </div>
                      </div>
                 </li>
                 <li style="display: none">
                      <div class="unit-left"><span class="tit"> 试题类型<em class="abe-red mrg_5">*</em></span></div>
                      <div class="unit-mid">
                           <div class="dropdown" id="<?php echo ($funcid); ?>_req_type">
                               <select class="pbsele dropdown0" name="req_type">
                                 <?php
 $keyvalue = table_TempletDetail_req_type(); if(is_array($keyvalue)){ $i = 0; $__LIST__ = $keyvalue; ?>
                                        <?php foreach($__LIST__ as $key=>$item): ++$i; ?>
                                     <option value="<?php echo $item['id']; ?>" <?php if($item['id'] == $search['req_type']): ?> selected="selected" <?php endif;?>><?php echo $item['name']; ?></option>
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
                      <div class="unit-left"><span class="tit"> 要求知识点<em class="abe-red mrg_5">*</em></span></div>
                      <div class="unit-mid">
                           <div class="popup">
                                <input  type="text" class="pbtxt txt0" name="req_category_code_name" readonly="readonly" value="<?php echo $search['req_category_code_name']; ?>">
                                <button type="submit" id="<?php echo ($funcid); ?>_category_sel" class="txt-search" onclick="return _asr.popup('QuestionCategoryTree','<?php echo "$funcid"; ?>','<?php echo "$funcid"; ?>-Search','Single','req_category_code','req_category_code_name'); " <?php if($search["req_category_code_name"]): ?> style="display:none"<?php endif; ?> ><i class="iconfont">&#xe60e;</i></button>
                                <button type="submit" class="txt-clear" onclick="_asr.setvaluebyname('<?php echo "$funcid"; ?>-Search','req_category_code','');_asr.setvaluebyname('<?php echo "$funcid"; ?>-Search','req_category_code_name','');return false;" <?php if(!$search["req_category_code_name"]): ?> style="display:none"<?php endif; ?> ><i class="iconfont">&#xe616;</i></button>
                           </div>
                          <input type="hidden" name="req_category_code" value="<?php echo $search['req_category_code']; ?>">
                          <div class="prompt" style="display:none">
                              <div class="error"><i class="iconfont">&#xe616;</i></div>
                          </div>
                      </div>
                 </li>
                 <li>
                     <div class="unit-left"><span class="tit"> 要求分类<em class="abe-red mrg_5">*</em></span></div>
                     <div class="unit-mid">
                         <div class="dropdown" id="<?php echo ($funcid); ?>_req_unit">
                             <select class="pbsele dropdown0" name="req_unit">
                                 <option value="" <?php if($search['req_unit'] == ''): ?> selected="selected" <?php endif;?> ></option>
                                 <?php
 $keyvalue = table_TempletDetail_req_unit(); if(is_array($keyvalue)){ $i = 0; $__LIST__ = $keyvalue; ?>
                                 <?php foreach($__LIST__ as $key=>$item): ++$i; ?>
                                 <option value="<?php echo $item['id']; ?>" <?php if($item['id'] == $search['req_unit'] ): ?> selected="selected" <?php endif;?>><?php echo $item['name']; ?></option>
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
                      <div class="unit-left"><span class="tit"> 要求题型<em class="abe-red mrg_5">*</em></span></div>
                      <div class="unit-mid">
                           <div class="dropdown" id="<?php echo ($funcid); ?>_req_kind">
                               <select class="pbsele dropdown0" name="req_kind">
                                  <option value="" <?php if($search['req_kind'] == ''): ?> selected="selected" <?php endif;?> ></option>
                                  <option value="taoti" <?php if($search['req_type'] == '1'): ?> selected="selected" <?php endif;?> >套题</option>
                                 <?php
 $keyvalue = subcode('question:kind'); if(is_array($keyvalue)){ $i = 0; $__LIST__ = $keyvalue; ?>
                                        <?php foreach($__LIST__ as $key=>$item): ++$i; ?>
                                     <option value="<?php echo $item['code']; ?>" <?php if($item['code'] == $search['req_kind'] && $search['req_type'] == '0'): ?> selected="selected" <?php endif;?>><?php echo $item['name']; ?></option>
                                        <?php endforeach; ?>
                                 <?php } ?>
                               </select>
                           </div>
                          <div class="prompt" style="display:none">
                              <div class="error"><i class="iconfont">&#xe616;</i></div>
                          </div>
                      </div>
                 </li>
                 <li></li>
                 <li>
                      <div class="unit-left"><span class="tit"> 套题要求</span></div>
                      <div class="unit-mid">
                           <div class="dropdown" id="<?php echo ($funcid); ?>_req_child_count">
                               <select class="pbsele dropdown1" name="req_child_count">
                                   <option value="" <?php if($search['req_child_count'] == ''): ?> selected="selected" <?php endif;?> ></option>
                                 <?php
 $keyvalue = enums('num','1','9'); if(is_array($keyvalue)){ $i = 0; $__LIST__ = $keyvalue; ?>
                                        <?php foreach($__LIST__ as $key=>$item): ++$i; ?>
                                     <option value="<?php echo $item['id']; ?>" <?php if($item['id'] == $search['req_child_count']): ?> selected="selected" <?php endif;?>><?php echo $item['name']; ?>小题</option>
                                        <?php endforeach; ?>
                                 <?php } ?>
                               </select>
                               <select class="pbsele dropdown1" name="req_child_seq">
                                   <option value="" <?php if(!$search['req_type']): ?> selected="selected" <?php endif;?>></option>
                                   <option value="0" <?php if($search['req_type'] && !$search['req_child_seq']): ?> selected="selected" <?php endif;?>>子题无题号</option>
                                   <option value="1" <?php if($search['req_type'] && $search['req_child_seq']): ?> selected="selected" <?php endif;?>>子题分配题号</option>
                               </select>
                           </div>
                          <div class="prompt" style="display:none">
                              <div class="error"><i class="iconfont">&#xe616;</i></div>
                          </div>
                      </div>
                 </li><?php endif; ?>
              </ul>
           </form>
        </div>
    </div>
    <div class="pop-sub abe-txtc" >
       <input type="button" value="提交" class="btn btn-blue mrg_10 " onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Search', '<?php echo U("/Home/TempletDetail/index?func=save&id=$search[id]") ; ?>',''); " />
       <input type="button" value="取消" class="btn btn-org mrg_10 " onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');" />
    </div>
</div>

<script>
/*
    <?php if($search['id'] == 0 and $t == 0): ?>$(function(){
        $("#<?php echo ($funcid); ?>_category_sel").click();
    });<?php endif; ?>
*/
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



    <?php echo W('Summary/javascript',array('TempletDetail'));?>

</script>