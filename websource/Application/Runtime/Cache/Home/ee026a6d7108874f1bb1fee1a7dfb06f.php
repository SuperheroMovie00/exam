<?php if (!defined('THINK_PATH')) exit();?>
<div toplayer="1" class="wrap-box wrap-pb2 " id="<?php echo $funcid;?>" summaryid="Templet" baseurl="<?php echo U('Templet/index'); ?>">

   <div class="wrap-box-info ">
      <div class="wrap-title abe-ofl">
         <div class="tit abe-fl">组卷模板</div>
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
               <a href="javascript:void(0);"  class=" vi-blue vi-blue mlg_10 " onclick="return _asr.popupFun('<?php echo U("/Home/Templet/index?func=edit_base&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Templet/index?func=edit_base&id=$search[id]","");?>'); "> 编辑</a>
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
             <th>模板编码</th>
             <td><a href="javascript:void(0);" class="vi-blue"  onclick="return _asr.openLink('<?php echo U("/Home/Templet/index?func=view&id=$search[id]"); ?>','<?php echo filterFuncId( U("/Home/Templet/index?func=view&id=$search[id]") ,"");?>', '组卷模板详情' ,0); " ><?php echo $search["templet_no"]; ?></a></td>
             <th>试卷题量</th>
             <td><?php echo system_format("N3", $search["count"],1); ?></td>
               <th>使用次数</th>
               <td><?php echo system_format("N3", $search["using"],1); ?></td>
               <th>创建时间</th>
               <td><?php echo system_format("DT", $search["create_time"],1); ?><em class="abe-space-sm"></em><?php echo $search["create_user"]; ?></td>
           </tr>
           <tr class= "odd">
               <th>模板标题</th>
               <td><?php echo $search["subject"]; ?></td>
             <th>试卷总分</th>
             <td><?php echo system_format("N3", $search["score"],1); ?></td>
               <th></th>
               <td></td>
               <th>修改时间</th>
               <td><?php echo system_format("DT", $search["modify_time"],1); ?><em class="abe-space-sm"></em><?php echo $search["modify_user"]; ?></td>
           </tr>
           <tr class= "even">
               <th>模板类型</th>
               <td><?php echo get_table_Templet_type("$search[type]","name","") ; ?></td>
               <th>卷面要求</th>
               <td title="<?php echo $search["req_content"]; ?>"><?php echo OverView($search["req_content"],150,"..."); ?></td>
               <th>备注</th>
               <td title="<?php echo $search["remarks"]; ?>"><?php echo OverView($search["remarks"],150,"..."); ?></td>
             <th>状态</th>
             <td><?php echo get_table_Templet_status("$search[status]","name","") ; ?></td>
           </tr>

        </tbody>
     </table>
         </div>
      </div>





       <div class="table-box">
         <div class="table-in">
            <form action="<?php echo U('Templet/index?func=view'); ?>" id="<?php echo "$funcid"; ?>-Search" method="get">
                <input type="hidden" name="<?php echo "$funcid"; ?>-last-url" id="<?php echo "$funcid"; ?>-last-url" value="<?php echo $__last_url; ?>" />
                <input type="hidden" name="funcid" value="<?php echo "$funcid"; ?>" />
                <input type="hidden" name="pfuncid" value="<?php echo "$pfuncid"; ?>" />
                <input type="hidden" name="id" value="<?php echo $search["id"]; ?>" />
                <input type="hidden" name="_lastchanged" value="<?php echo $search["lastchanged"]; ?>" />


                <input type="hidden" name="_tab" value="<?php echo $search["_tab"]; ?>" />

                <input type="hidden" name="_tab_mingxi_p" value="<?php echo $search["_tab_mingxi_p"]; ?>" />
                <input type="hidden" name="_tab_mingxi_psize" value="<?php echo $search["_tab_mingxi_psize"]; ?>" />
                <input type="hidden" name="_tab_shijuan_p" value="<?php echo $search["_tab_shijuan_p"]; ?>" />
                <input type="hidden" name="_tab_shijuan_psize" value="<?php echo $search["_tab_shijuan_psize"]; ?>" />
                <input type="hidden" name="_tab_caozuorizhi_p" value="<?php echo $search["_tab_caozuorizhi_p"]; ?>" />
                <input type="hidden" name="_tab_caozuorizhi_psize" value="<?php echo $search["_tab_caozuorizhi_psize"]; ?>" />

                  <!--表单-->
                  <div class="order-det-ptab">
                    <div class="od-info abe-fl" >
                      <a href="#" onclick="return _asr.tabsheet('<?php echo $funcid;?>', '<?php echo "$funcid"; ?>-Search', 'mingxi');" <?php if($search['_tab'] == 'mingxi'): ?> class="current"<?php endif;?>>模板内容</a>
                      <a href="#" onclick="return _asr.tabsheet('<?php echo $funcid;?>', '<?php echo "$funcid"; ?>-Search', 'shijuan');" <?php if($search['_tab'] == 'shijuan'): ?> class="current"<?php endif;?>>关联试卷</a>
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
                    <form id="<?php echo "$funcid"; ?>-Result"  action="<?php U('Templet/op'); ?>" method="post">
                      <input type="hidden" name="<?php echo "$funcid"; ?>-last-url" id="<?php echo "$funcid"; ?>-last-url" value="<?php echo $__last_url; ?>" />
                      <input type="hidden" name="funcid" value="<?php echo "$funcid"; ?>" />
                      <input type="hidden" name="pfuncid" value="<?php echo "$pfuncid"; ?>" />
                      <input type="hidden" name="id" value="<?php echo $search["id"]; ?>" />
                      <input type="hidden" name="_lastchanged" value="<?php echo $search["lastchanged"]; ?>" />
                      <table border="0" cellspacing="0" cellpadding="0" class="pub-table-par pub-table-par-tdc pub-t-faq">
                        <colgroup>
                          <col style="width: 40px ;">
                          <col style="width: 60px ; display: none">
                            <col style="width: 100px ;">
                          <col style="width: 80px ; ">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 100px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: auto" >
                        </colgroup>
                        <tbody>
                          <tr>
                            <th><input type="checkbox"  onclick="_asr.selectAll(this);"> &nbsp;#</th>
                            <th style="display: none">操作</th>
                              <th class="abe-txtl">标题</th>
                            <th >类型</th>
                            <th>题号</th>
                            <th>分数</th>
                            <th class="abe-txtl">要求知识点</th>
                            <th class="abe-txtl">要求题型</th>
                            <th>套题要求</th>
                            <th>抽取要求</th>
                           <th></th >
                          </tr>
                          <?php if(is_array($list)): $i = 0; $__LIST__ = $list; if( count($__LIST__) == 0) : echo ""; else: foreach($__LIST__ as $key=>$master): $mod = ($i % 2 );++$i; ?>
                                  <tr <?php if(!$master[type]): ?>class="even"<?php endif; if($master[type]): ?>class="odd"<?php endif; ?>>
                                    <!-- 选择 -->
                                    <td><input type="checkbox" name="Key[]" data-type="select" onclick="_asr.selectMulit(this);" value="<?php echo $master['id'] ;?>">&nbsp; <?php echo $i + ($page_size * ($p - 1)); ?></td>
                                    <td style="display: none">
                            <div class="faq-icon">


          <?php if (isset($rights['master_view']) && $rights['master_view']): ?>
               <a href="javascript:void(0);"  class=" vi-blue vi-blue " onclick="return _asr.openLink('<?php echo U("/Home/Templet/index?func=view&id=$master[id]") ; ?>', '<?php echo filterFuncId(U("/Home/Templet/index?func=view&id=$master[id]"),"");?>' , '组卷模板' ,0); "><i class="iconfont abe-ft18">&#xe62e;</i></a>
          <?php endif; ?>



          <?php if (isset($rights['master_edit']) && $rights['master_edit']): ?>
          <?php if ($master[status]==0): ?>
               <a href="javascript:void(0);"  class=" vi-blue vi-blue " onclick="return _asr.popupFun('<?php echo U("/Home/Templet/index?func=edit&id=$master[id]") ; ?>', '<?php echo filterFuncId("/Home/Templet/index?func=edit&id=$master[id]","");?>'); "><i class="iconfont abe-ft15">&#xe63f;</i></a>
          <?php endif; ?>
          <?php endif; ?>



          <?php if (isset($rights['master_delete']) && $rights['master_delete']): ?>
          <?php if ($master[status]==0): ?>
               <a href="javascript:void(0);"  class=" vi-blue vi-blue " onclick="return _asr.confirm('确认操作', '请确认是否删除组卷模板?', '<?php echo "组卷模板 : $master[templet_no]"; ?>', '<?php echo U("/Home/Templet/index?func=delete&type=1&id=$master[id]") ; ?>','',''); "><i class="iconfont vi-red">&#xe61d;</i></a>
          <?php endif; ?>
          <?php endif; ?>

                            </div></td>
                          <td  class=" abe-txtl "><div class="newline newline-l" ><?php echo $master["subject"]; ?></div></td>
                                    <td ><?php echo get_table_TempletDetail_type("$master[type]","name","") ; ?></td>
                          <?php if($master[type] == 0): ?><td><?php echo system_format("N3", $master["seq"],1) ; ?></td>
                                    <td><?php echo system_format("N3", $master["score"],1) ; ?></td>
                                    <td  class=" abe-txtl "><?php echo $master["req_category_name"] ; ?></td>
                                    <td  class="<?php if($master[req_type] == 1): ?>abe-blue<?php endif; ?>"><?php echo $master[req_type]==1?"套题":subcode_view('question:kind',$master['req_kind']) ; ?></td>
                                    <td  class="<?php if($master[req_type] == 1): ?>abe-blue<?php endif; ?>"><?php echo $master[req_type]==1?$master["req_child_count"]."小题，".get_table_TempletDetail_req_child_seq("$master[req_child_seq]","name",""):"" ; ?></td>
                                    <td><?php echo get_table_TempletDetail_extract("$master[extract]","name","") ; ?></td>
                          <?php else: ?>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td><?php endif; ?>
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

              <?php if ($search['_tab']=='shijuan'): ?>
                <div class="table-box">
                  <div class="table-in">
                    <form id="<?php echo "$funcid"; ?>-Result"  action="<?php U('Templet/op'); ?>" method="post">
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
                          <col style="width: 80px ;">
                          <col style="width: 100px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 120px ;">
                          <col style="width: 100px ;">
                          <col style="width: 100px ;">
                          <col style="width: 150px ;">
                          <col style="width: 150px ;">
                          <col style="width: auto" >
                        </colgroup>
                        <tbody>
                          <tr>
                            <th>序号</th>
                            <th>状态</th>
                            <th class="abe-txtl">试卷编码</th>
                            <th>类型</th>
                            <th class="abe-txtl">标题</th>
                            <th>题量</th>
                            <th>总分</th>
                            <th>时间要求(分钟)</th>
                            <th class="abe-txtl">卷面要求</th>
                            <th class="abe-txtl">备注</th>
                            <th>创建时间</th>
                            <th>修改时间</th>
                           <th></th >
                          </tr>
                          <?php if(is_array($list)): $i = 0; $__LIST__ = $list; if( count($__LIST__) == 0) : echo ""; else: foreach($__LIST__ as $key=>$master): $mod = ($i % 2 );++$i; ?>
                                  <tr <?php if($mod == "1"): ?>class="even"<?php endif; if($mod == "0"): ?>class="odd"<?php endif; ?>>
                                    <td><?php echo $i + ($page_size * ($p - 1)); ?></td>
                                    <td><?php echo get_table_Exam_status("$master[status]","name","") ; ?></td>
                                    <td  class=" abe-txtl "><a href="javascript:void(0);" class="vi-blue"  onclick="return _asr.openLink('<?php echo U("/Home/Exam/index?func=view&id=$master[id]"); ?>','<?php echo filterFuncId( U("/Home/Exam/index?func=view&id=$master[id]") ,"");?>', '试卷详情' ,0); " ><?php echo $master["exam_no"] ; ?></a></td>
                                    <td><?php echo get_table_Exam_type("$master[type]","name","") ; ?></td>
                                    <td  class=" abe-txtl "><?php echo $master["subject"] ; ?></td>
                                    <td><?php echo system_format("N3", $master["count"],1) ; ?></td>
                                    <td><?php echo system_format("N3", $master["score"],1) ; ?></td>
                                    <td><?php echo system_format("N3", $master["req_time"],1) ; ?></td>
                                    <td  class=" abe-txtl "><div class="newline"><?php echo OverView($master["req_content"],150,"...") ; ?></div></td>
                                    <td  class=" abe-txtl "><div class="newline"><?php echo OverView($master["remarks"],150,"...") ; ?></div></td>
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
                    <form id="<?php echo "$funcid"; ?>-Result"  action="<?php U('Templet/op'); ?>" method="post">
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
                                    <td><?php echo get_table_Templet_status("$master[status]","name","") ; ?></td>
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



      <div class="blank35"></div>
   </div>

   <div class="data-oper" >
        <?php echo $page; ?>
      <div class="data-oper-in " >


          <?php if (isset($rights['order_edit']) && $rights['order_edit']): ?>
          <?php if ($search['status']==0): ?>
               <input type="button" value="模板编辑" class="btn btn-blue mlg_10 " default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/Templet/index?func=edit_base&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Templet/index?func=edit_base&id=$search[id]","");?>'); " />
               <input type="button" value="内容编辑" class="btn btn-blue mlg_10 " default-status="1" onclick="return _asr.openLink('<?php echo U("/Home/Templet/index?func=manage&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Templet/index?func=manage&id=$search[id]","");?>','模板-<?php echo ($search[subject]); ?>',0); " />
          <?php endif; ?>
          <?php endif; ?>






          <?php if (isset($rights['confirm']) && $rights['confirm']): ?>
          <?php if ($search['status']=='0'): ?>
               <input type="button" value="模板确认" class="btn btn-blue mlg_10 " default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/Templet/index?func=confirm&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Templet/index?func=confirm&id=$search[id]","");?>'); " />
          <?php endif; ?>
          <?php endif; ?>



          <?php if (isset($rights['todummy']) && $rights['todummy']): ?>
          <?php if ($search['status']=='1'): ?>
               <input type="button" value="转草稿编辑" class="btn btn-org mlg_10 " default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/Templet/index?func=todummy&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Templet/index?func=todummy&id=$search[id]","");?>'); " />
          <?php endif; ?>
          <?php endif; ?>

          <?php if (isset($rights['toexam']) && $rights['toexam']): ?>
          <?php if ($search['status']=='1'): ?>
          <input type="button" value="组卷操作" class="btn btn-blue mlg_10 " default-status="1" onclick="return _asr.openLink('<?php echo U("/Home/Templet/index?func=exam&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Templet/index?func=exam&id=$search[id]","");?>','模板-<?php echo ($search[subject]); ?>',0); " />
          <?php endif; ?>
          <?php endif; ?>

<!--

          <?php if (isset($rights['grid']) && $rights['grid']): ?>
          <?php if (($search['status']=='0' || $search['status']=='1')): ?>
               <input type="button" value="明细编辑" class="btn btn-blue mlg_10 " default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/Templet/index?func=grid&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Templet/index?func=grid&id=$search[id]","");?>'); " />
          <?php endif; ?>
          <?php endif; ?>
-->
          <div class="abe-fr">


          <?php if (isset($rights['order_delete']) && $rights['order_delete']): ?>
          <?php if ($search['status']==0): ?>
               <input type="button" value="模板删除" class="btn btn-org mrg_10 " default-status="1" onclick="return _asr.confirm('确认操作', '请确认是否进行 信息删除 操作?', '', '<?php echo U("/Home/Templet/index?func=delete&id=$search[id]") ; ?>','','<?php echo "$funcid"; ?>-Result'); " />
          <?php endif; ?>
          <?php endif; ?>



          <?php if (isset($rights['cancel']) && $rights['cancel']): ?>
          <?php if ($search['status']=='1'): ?>
               <input type="button" value="模板取消" class="btn btn-org mlg_10 " default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/Templet/index?func=cancel&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Templet/index?func=cancel&id=$search[id]","");?>'); " />
          <?php endif; ?>
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


    <?php echo W('Summary/javascript',array('Templet'));?>


    </script>