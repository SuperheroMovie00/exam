<?php if (!defined('THINK_PATH')) exit();?>
<div toplayer="1" class="prompt-pop pop-style3" style="z-index:<?php echo ($zindex); ?>;width:800px;" id="<?php echo $funcid;?>" url="<?php echo U('EffectsCategory/index'); ?>">

   <div class="title">
       <span class="pop-name"><?php echo $search[id]?'编辑':'新增'; ?>物品分类信息</span>
       <a href="javascript:void(0);" onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');" class="close iconfont">&#xe60d;</a>
   </div>


<div class="pop-scroll">
   <div class="screening ">
      <form action="<?php echo U('EffectsCategory/index?func=save'); ?>" id="<?php echo "$funcid"; ?>-Search" method="get">
          <input type="hidden" name="<?php echo "$funcid"; ?>-last-url" id="<?php echo "$funcid"; ?>-last-url" value="<?php echo $__last_url; ?>" />
          <input type="hidden" name="funcid" value="<?php echo "$funcid"; ?>" />
          <input type="hidden" name="pfuncid" value="<?php echo "$pfuncid"; ?>" />
          <input type="hidden" name="id" value="<?php echo $search["id"]; ?>" />
          <input type="hidden" name="company_id" value="<?php echo $search["company_id"]; ?>" />
          <input type="hidden" name="_lastchanged" value="<?php echo $search["lastchanged"]; ?>" />
          <input type="hidden" name="loaddata" value="<?php echo ($search['loaddata']); ?>" />
          <ul class="form form-mod-new form-column2">
             <li>
                 <div class="unit-left"><span class="tit">公司名称<em class="abe-red mrg_5">*</em></span></div>
                 <div class="unit-mid">
                     <div class="textbox">
                        <?php echo (get_table_Company_byID($search["company_id"],"name")); ?>
                     </div>
                     <div class="prompt" style="display:none">
                         <div class="error"><i class="iconfont">&#xe616;</i></div>
                     </div>
                 </div>

             </li>
             <li>
                  <div class="unit-left"><span class="tit"> 代码<em class="abe-red mrg_5">*</em></span></div>
                  <div class="unit-mid">
                       <div class="textbox">
                            <input type="text" class="pbtxt txt0" readonly name="code"  value="<?php echo $search['code']; ?>"  >
                       </div>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>
             <li class="per100">
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
                  <div class="unit-left"><span class="tit"> 选择上级</span></div>
                  <div class="unit-mid">
                       <div class="popup">
                            <input  type="text" class="pbtxt txt0" name="parent_id_name" readonly="readonly" value="<?php echo $search['parent_id_name']; ?>">
                       </div>
                      <input type="hidden" name="parent_id" value="<?php echo $search['parent_id']; ?>">
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>
             <li>
                  <div class="unit-left"><span class="tit"> 审批要求</span></div>
                  <div class="unit-mid">
                       <div class="dropdown" id="<?php echo ($funcid); ?>_approval_require">
                           <select class="pbsele dropdown0" name="approval_require">
                             <?php
 $keyvalue = table_EffectsCategory_approval_require(); if(is_array($keyvalue)){ $i = 0; $__LIST__ = $keyvalue; ?>
                                    <?php foreach($__LIST__ as $key=>$item): ++$i; ?>
                                 <option value="<?php echo $item['id']; ?>" <?php if($item['id'] == $search['approval_require']): ?> selected="selected" <?php endif;?>><?php echo $item['name']; ?></option>
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
                  <div class="unit-left"><span class="tit"> 提前报警/天</span></div>
                  <div class="unit-mid">
                       <div class="textbox">
                            <input type="text" class="pbtxt txt0" name="alarm_days"  value="<?php echo $search['alarm_days']; ?>"  >
                       </div>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>
              <li>
                  <div class="unit-left"><span class="tit"> 单一物品</span></div>
                  <div class="unit-mid">
                      <div class="textbox">
                          <input type="checkbox" class="txt0" name="onlyone"  value="1"  <?php echo ($search['onlyone']==1?"checked":"") ?> >
                      </div>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
              </li>
             <li>
                  <div class="unit-left"><span class="tit"> 排序</span></div>
                  <div class="unit-mid">
                       <div class="textbox">
                            <input type="text" class="pbtxt txt0" name="sort"  value="<?php echo $search['sort']; ?>"  >
                       </div>
                      <div class="prompt" style="display:none">
                          <div class="error"><i class="iconfont">&#xe616;</i></div>
                      </div>
                  </div>
             </li>
             <li>
                  <div class="unit-left"><span class="tit"> 选择状态<em class="abe-red mrg_5">*</em></span></div>
                  <div class="unit-mid">
                       <div class="dropdown" id="<?php echo ($funcid); ?>_status">
                           <select class="pbsele dropdown0" name="status">
                              <option value="" <?php if($search['status'] == ''): ?> selected="selected" <?php endif;?> ></option>
                             <?php
 $keyvalue = table_EffectsCategory_status(); if(is_array($keyvalue)){ $i = 0; $__LIST__ = $keyvalue; ?>
                                    <?php foreach($__LIST__ as $key=>$item): ++$i; ?>
                                        <option value="<?php echo $item['id']; ?>" <?php if($item['id'] == $search['status']): ?> selected="selected" <?php endif;?>><?php echo $item['name']; ?></option>
                                    <?php endforeach; ?>
                             <?php } ?>
                           </select>
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
               <input type="button" value="保存" class="btn btn-org mrg_10 " default-status="1" onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Search', '<?php echo U("/Home/EffectsCategory/index?func=save&id=$search[id]") ; ?>',''); " />
               <input type="button" value="取消" class="btn btn-blue mrg_10 " onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');" default-status="1" />
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

            _asr.setvaluebyname(_frm,"code", "" );
            _asr.setvaluebyname(_frm,"name", "" );
            _asr.setvaluebyname(_frm,"parent_id_name", "" );
            _asr.setvaluebyname(_frm,"parent_id", "" );
            _asr.setvaluebyname(_frm,"approval_require", "" );
            _asr.setvaluebyname(_frm,"alarm_days", "" );
            _asr.setvaluebyname(_frm,"sort", "" );
            _asr.setvaluebyname(_frm,"status", "" );


          $("#<?php echo ($funcid); ?>").find(".selebtn").each(function(){
              $(this).find("a:eq(0)").click();
            });

          $("#<?php echo ($funcid); ?> .city-tags-new .sele-remove").click();
        }

   function <?php echo $funcid;?>_callback(param){
        _asr.closePopup('<?php echo ($funcid); ?>');
   }



    <?php echo W('Summary/javascript',array('EffectsCategory'));?>



    </script>