<?php if (!defined('THINK_PATH')) exit();?>
<div toplayer="1" class="wrap-box wrap-pb2 " id="<?php echo $funcid;?>" summaryid="ExamDetail" baseurl="<?php echo U('ExamDetail/index'); ?>">

   <div class="wrap-box-info ">
      <div class="wrap-title abe-ofl">
         <div class="tit abe-fl">试卷明细</div>
         <div class="abe-fr">


               <a href="javascript:void(0);"  class=" vi-blue " onclick="return _asr.openLink('','<?php echo "$funcid"; ?>','刷新',1); "><i class="iconfont ">&#xe611;</i> 刷新</a>

         </div>
      </div>


      <div class="table-box">
         <div class="table-in">
            <div class="pub-par-title ppt-ico-box">
               <span class="abe-fl vi-blue abe-ft14">基本信息</span>
               <div class="abe-fr">


          <?php if (isset($rights['edit_base']) && $rights['edit_base']): ?>
          <?php if ($search['status']==0): ?>
               <a href="javascript:void(0);"  class=" vi-blue vi-blue mlg_10 " onclick="return _asr.popupFun('<?php echo U("/Home/ExamDetail/index?func=edit_base&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/ExamDetail/index?func=edit_base&id=$search[id]","");?>'); "> 编辑</a>
          <?php endif; ?>
          <?php endif; ?>

               </div>
            </div>

     <table border="0" cellspacing="0" cellpadding="0" class="pub-table-par">
        <colgroup>
           <col style="width:8%;"/>
           <col style="width:17%;"/>
           <col style="width:8%;"/>
           <col style="width:17%;"/>
           <col style="width:8%;"/>
           <col style="width:17%;"/>
           <col style="width:8%;"/>
           <col style="width:16%;"/>
        </colgroup>
        <tbody>

           <tr class= "even">
             <th>试卷编码</th>
             <td><a href="javascript:void(0);" class="vi-blue"  onclick="return _asr.openLink('<?php echo U("/Home/Templet/index?func=view&no=$search[exam_no]"); ?>','<?php echo filterFuncId( U("/Home/Templet/index?func=view&no=$search[exam_no]") ,"");?>', '组卷模板详情' ,0); " ><?php echo $search["exam_no"]; ?></a></td>
             <th>类型</th>
             <td><?php echo get_table_ExamDetail_type("$search[type]","name","") ; ?></td>
             <th>标题</th>
             <td title="<?php echo $search["subject"]; ?>"><?php echo OverView($search["subject"],150,"..."); ?></td>
             <td colspan="2" rowspan="6">
                 <a style="display: block; line-height: 0;" href="<?php echo $search["question_img"]; ?>" target="_blank" class="vi-blue"   >
                 </a>
                   <img src="<?php echo $search["question_img"]?$search["question_img"]:"link"; ?>" class=""  /></td>
           </tr>
           <tr class= "odd">
             <th>题号</th>
             <td><?php echo system_format("N3", $search["seq"],1); ?></td>
             <th>分数</th>
             <td><?php echo system_format("N3", $search["score"],1); ?></td>
             <th>试题类型</th>
             <td><?php echo get_table_ExamDetail_question_type("$search[question_type]","name","") ; ?></td>
           </tr>
           <tr class= "even">
             <th>试题编码</th>
             <td><a href="javascript:void(0);" class="vi-blue"  onclick="return _asr.openLink('<?php echo U("/Home/Question/index?func=view&no=$search[question_code]"); ?>','<?php echo filterFuncId( U("/Home/Question/index?func=view&no=$search[question_code]") ,"");?>', '题库详情' ,0); " ><?php echo $search["question_code"]; ?></a></td>
             <th>试题名称</th>
             <td><?php echo $search["question_name"]; ?></td>
             <th>知识点码</th>
             <td><?php echo $search["question_category_code"]; ?></td>
           </tr>
           <tr class= "odd">
             <th>试题知识点</th>
             <td><?php echo $search["question_category_name"]; ?></td>
             <th>试题题型</th>
             <td><?php echo subcode_view('question:kind',$search['question_kind']) ; ?></td>
             <th>试题题干</th>
             <td title="<?php echo $search["question_stem"]; ?>"><?php echo OverView($search["question_stem"],150,"..."); ?></td>
           </tr>
           <tr class= "even">
             <th>试题设问</th>
             <td title="<?php echo $search["question_quiz"]; ?>"><?php echo OverView($search["question_quiz"],150,"..."); ?></td>
             <th>试题答案</th>
             <td title="<?php echo $search["question_answer"]; ?>"><?php echo OverView($search["question_answer"],150,"..."); ?></td>
             <th>抽取次数</th>
             <td><?php echo system_format("N3", $search["extract_count"],1); ?></td>
           </tr>
           <tr class= "odd">
             <th>创建时间</th>
             <td><?php echo system_format("DT", $search["create_time"],1); ?><em class="abe-space-sm"></em><?php echo $search["create_user"]; ?></td>
             <th>修改时间</th>
             <td><?php echo system_format("DT", $search["modify_time"],1); ?><em class="abe-space-sm"></em><?php echo $search["modify_user"]; ?></td>
             <th></th>
             <td></td>
           </tr>

        </tbody>
     </table>
         </div>
      </div>





       <div class="table-box">
         <div class="table-in">
            <form action="<?php echo U('ExamDetail/index?func=view'); ?>" id="<?php echo "$funcid"; ?>-Search" method="get">
                <input type="hidden" name="<?php echo "$funcid"; ?>-last-url" id="<?php echo "$funcid"; ?>-last-url" value="<?php echo $__last_url; ?>" />
                <input type="hidden" name="funcid" value="<?php echo "$funcid"; ?>" />
                <input type="hidden" name="pfuncid" value="<?php echo "$pfuncid"; ?>" />
                <input type="hidden" name="id" value="<?php echo $search["id"]; ?>" />
                <input type="hidden" name="_lastchanged" value="<?php echo $search["lastchanged"]; ?>" />


                <input type="hidden" name="_tab" value="<?php echo $search["_tab"]; ?>" />

                <input type="hidden" name="_tab_mingxi_p" value="<?php echo $search["_tab_mingxi_p"]; ?>" />
                <input type="hidden" name="_tab_mingxi_psize" value="<?php echo $search["_tab_mingxi_psize"]; ?>" />
                <input type="hidden" name="_tab_caozuorizhi_p" value="<?php echo $search["_tab_caozuorizhi_p"]; ?>" />
                <input type="hidden" name="_tab_caozuorizhi_psize" value="<?php echo $search["_tab_caozuorizhi_psize"]; ?>" />

                  <!--表单-->
                  <div class="order-det-ptab">
                    <div class="od-info abe-fl" >
                      <a href="#" onclick="return _asr.tabsheet('<?php echo $funcid;?>', '<?php echo "$funcid"; ?>-Search', 'mingxi');" <?php if($search['_tab'] == 'mingxi'): ?> class="current"<?php endif;?>>明细</a>
                      <a href="#" onclick="return _asr.tabsheet('<?php echo $funcid;?>', '<?php echo "$funcid"; ?>-Search', 'caozuorizhi');" <?php if($search['_tab'] == 'caozuorizhi'): ?> class="current"<?php endif;?>>操作日志</a>
                    </div>

              <div class="abe-fl screening pbtab-search pbtab-col2">
<!-- 搜索关闭状态，按需要打开
                 <ul class="form form-mod-new">

                 </ul>

搜索关闭状态，按需要打开 -->

              </div>

              <div class="abe-fr">
              </div>
            </div>
          </form>
        </div>
      </div>



              <?php if ($search['_tab']=='mingxi'): ?>
                <div class="table-box">
                  <div class="table-in">
                    <form id="<?php echo "$funcid"; ?>-Result"  action="<?php U('ExamDetail/op'); ?>" method="post">
                      <input type="hidden" name="<?php echo "$funcid"; ?>-last-url" id="<?php echo "$funcid"; ?>-last-url" value="<?php echo $__last_url; ?>" />
                      <input type="hidden" name="funcid" value="<?php echo "$funcid"; ?>" />
                      <input type="hidden" name="pfuncid" value="<?php echo "$pfuncid"; ?>" />
                      <input type="hidden" name="id" value="<?php echo $search["id"]; ?>" />
                      <input type="hidden" name="_lastchanged" value="<?php echo $search["lastchanged"]; ?>" />
                      <table border="0" cellspacing="0" cellpadding="0" class="pub-table-par pub-table-par-tdc pub-t-faq">
                        <colgroup>
                          <col style="width: 40px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 100px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 100px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 150px ;">
                          <col style="width: 150px ;">
                          <col style="width: auto" >
                        </colgroup>
                        <tbody>
                          <tr>
                            <th><input type="checkbox"  onclick="_asr.selectAll(this);"> &nbsp;#</th>
                            <th class="abe-txtl">模板编码</th>
                            <th>类型</th>
                            <th class="abe-txtl">标题</th>
                            <th>题号</th>
                            <th>分数</th>
                            <th>要求类型</th>
                            <th class="abe-txtl">知识点码</th>
                            <th class="abe-txtl">要求知识点</th>
                            <th class="abe-txtl">要求题型</th>
                            <th>套题小题数</th>
                            <th>套题小题号</th>
                            <th>抽取要求</th>
                            <th>创建时间</th>
                            <th>修改时间</th>
                           <th></th >
                          </tr>
                          <?php if(is_array($list)): $i = 0; $__LIST__ = $list; if( count($__LIST__) == 0) : echo ""; else: foreach($__LIST__ as $key=>$master): $mod = ($i % 2 );++$i; ?>
                                  <tr <?php if($mod == "1"): ?>class="even"<?php endif; if($mod == "0"): ?>class="odd"<?php endif; ?>>
                                    <!-- 选择 -->
                                    <td><input type="checkbox" name="Key[]" data-type="select" onclick="_asr.selectMulit(this);" value="<?php echo $master['id'] ;?>">&nbsp; <?php echo $i + ($page_size * ($p - 1)); ?></td>
                                    <td  class=" abe-txtl "><a href="javascript:void(0);" class="vi-blue"  onclick="return _asr.openLink('<?php echo U("/Home/Templet/index?func=view&no=$master[templet_no]"); ?>','<?php echo filterFuncId( U("/Home/Templet/index?func=view&no=$master[templet_no]") ,"");?>', '组卷模板详情' ,0); " ><?php echo $master["templet_no"] ; ?></a></td>
                                    <td><?php echo get_table_TempletDetail_type("$master[type]","name","") ; ?></td>
                                    <td  class=" abe-txtl "><div class="newline"><?php echo OverView($master["subject"],150,"...") ; ?></div></td>
                                    <td><?php echo system_format("N3", $master["seq"],1) ; ?></td>
                                    <td><?php echo system_format("N3", $master["score"],1) ; ?></td>
                                    <td><?php echo get_table_TempletDetail_req_type("$master[req_type]","name","") ; ?></td>
                                    <td  class=" abe-txtl "><?php echo $master["req_category_code"] ; ?></td>
                                    <td  class=" abe-txtl "><?php echo $master["req_category_name"] ; ?></td>
                                    <td  class=" abe-txtl "><?php echo subcode_view('question:kind',$search['req_kind']) ; ?></td>
                                    <td><?php echo $master["req_child_count"] ; ?></td>
                                    <td><?php echo get_table_TempletDetail_req_child_seq("$master[req_child_seq]","name","") ; ?></td>
                                    <td><?php echo get_table_TempletDetail_extract("$master[extract]","name","") ; ?></td>
                                    <td><?php echo system_format("DT", $master["create_time"],1) ; ?></td>
                                    <td><?php echo system_format("DT", $master["modify_time"],1) ; ?></td>
                                 <td></td>
                                  </tr>
                                  <?php endforeach; ?>
                                <?php
 endif; else: echo "" ;endif; ?>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
              <?php endif; ?>

              <?php if ($search['_tab']=='caozuorizhi'): ?>
                <div class="table-box">
                  <div class="table-in">
                    <form id="<?php echo "$funcid"; ?>-Result"  action="<?php U('ExamDetail/op'); ?>" method="post">
                      <input type="hidden" name="<?php echo "$funcid"; ?>-last-url" id="<?php echo "$funcid"; ?>-last-url" value="<?php echo $__last_url; ?>" />
                      <input type="hidden" name="funcid" value="<?php echo "$funcid"; ?>" />
                      <input type="hidden" name="pfuncid" value="<?php echo "$pfuncid"; ?>" />
                      <input type="hidden" name="id" value="<?php echo $search["id"]; ?>" />
                      <input type="hidden" name="_lastchanged" value="<?php echo $search["lastchanged"]; ?>" />
                      <table border="0" cellspacing="0" cellpadding="0" class="pub-table-par pub-table-par-tdc pub-t-faq">
                        <colgroup>
                          <col style="width: 40px ;">
                          <col style="width: 80px ;">
                          <col style="width: 150px ;">
                          <col style="width: 80px ;">
                          <col style="width: 100px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 100px ;">
                          <col style="width: auto" >
                        </colgroup>
                        <tbody>
                          <tr>
                            <th>序号</th>
                            <th>状态</th>
                            <th>处理时间</th>
                            <th class="abe-txtl">单据号码</th>
                            <th class="abe-txtl">标题</th>
                            <th>明细条数</th>
                            <th class="abe-txtr">数量(件)</th>
                            <th class="abe-txtr">金额(元)</th>
                            <th class="abe-txtl">内容</th>
                           <th></th >
                          </tr>
                          <?php if(is_array($list)): $i = 0; $__LIST__ = $list; if( count($__LIST__) == 0) : echo ""; else: foreach($__LIST__ as $key=>$master): $mod = ($i % 2 );++$i; ?>
                                  <tr <?php if($mod == "1"): ?>class="even"<?php endif; if($mod == "0"): ?>class="odd"<?php endif; ?>>
                                    <td><?php echo $i + ($page_size * ($p - 1)); ?></td>
                                    <td><?php echo $master["status"] ; ?></td>
                                    <td><?php echo system_format("DT", $master["create_time"],1) ; ?></td>
                                    <td  class=" abe-txtl "><a href="javascript:void(0);" class="vi-blue"  onclick="return _asr.openLink('<?php echo orderurl("$master[type]"); ?>','<?php echo filterFuncId( orderurl("$master[type]") ,"");?>', '查看详情' ,0); " ><?php echo $master["order_no"] ; ?></a></td>
                                    <td  class=" abe-txtl "><?php echo $master["subject"] ; ?></td>
                                    <td><?php echo system_format("N3", $master["details"],1) ; ?></td>
                                    <td  class=" abe-txtr "><?php echo system_format("N3", $master["qty"],1) ; ?></td>
                                    <td  class=" abe-txtr "><?php echo system_format("F32", $master["amount"],1) ; ?></td>
                                    <td  class=" abe-txtl "><div><?php echo OverView($master["content"],150,"...") ; ?></div></td>
                                 <td></td>
                                  </tr>
                                  <?php endforeach; ?>
                                <?php
 endif; else: echo "" ;endif; ?>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
              <?php endif; ?>



      <div class="blank5"></div>
   </div>

   <div class="data-oper" >
        <?php echo $page; ?>
      <div class="data-oper-in " >


          <?php if (isset($rights['order_edit']) && $rights['order_edit']): ?>
               <input type="button" value="信息编辑" class="btn btn-blue mlg_10 " default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/ExamDetail/index?func=edit_base&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/ExamDetail/index?func=edit_base&id=$search[id]","");?>'); " />
          <?php endif; ?>

          <div class="abe-fr">


          <?php if (isset($rights['order_delete']) && $rights['order_delete']): ?>
               <input type="button" value="记录删除" class="btn btn-org mrg_10 " default-status="1" onclick="return _asr.confirm('确认操作', '请确认是否进行 信息删除 操作?', '', '<?php echo U("/Home/ExamDetail/index?func=delete&id=$search[id]") ; ?>','','<?php echo "$funcid"; ?>-Result'); " />
          <?php endif; ?>

          </div>
      </div>
   </div>

   <div class="blank30"></div>
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


    <?php echo W('Summary/javascript',array('ExamDetail'));?>


    </script>