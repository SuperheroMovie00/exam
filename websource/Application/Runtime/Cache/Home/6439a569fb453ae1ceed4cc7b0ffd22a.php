<?php if (!defined('THINK_PATH')) exit();?>
<div toplayer="1" class="wrap-box wrap-pb2 " id="<?php echo $funcid;?>" summaryid="Testx" baseurl="<?php echo U('Testx/index'); ?>">

   <div class="wrap-box-info ">
      <div class="wrap-title abe-ofl">
         <div class="tit abe-fl">测试表111</div>
         <div class="abe-fr">


               <a href="javascript:void(0);"  class=" vi-blue " onclick="return _asr.openLink('','<?php echo "$funcid"; ?>','刷新',1); "><i class="iconfont ">&#xe611;</i> 刷新</a>

         </div>
      </div>

      <div class="order-step">
         <dl>
            <?php if(is_array($step)): $i = 0; $__LIST__ = $step; if( count($__LIST__) == 0) : echo ""; else: foreach($__LIST__ as $key=>$item): if($key>0): ?>
                        <dd <?php if($item['type']=='after') echo "class='after'"; elseif ($item['type']=='current') echo "class='current'"; elseif ($item['type']=='cancel') echo "class='cancel-faq'"; ?>><i class="iconfont">&#xe619;</i></dd>
                        <?php endif; ?>
                        <dt <?php if($item['type']=='after') echo "class='after'"; elseif ($item['type']=='current') echo "class='current'"; elseif ($item['type']=='cancel') echo "class='cancel-faq'"; ?>>
                           <div <?php if($item['type']=='cancel') echo "class='iconfont'"; ?> ><?php echo $item['no'];?></div>
                           <span><?php echo $item['desc'];?></span>
                           <time><?php echo $item['time'];?></time>
                        </dt>
                    <?php endforeach; endif; endif; ?>
           </dl>
      </div>

      <div class="table-box">
         <div class="table-in">
            <div class="pub-par-title ppt-ico-box">
               <span class="abe-fl vi-blue abe-ft14">基本信息</span>
               <div class="faq-ico-box abe-fl">
                  <!-- icon 图标样例 -->
<!--
                  <?php if($search["is_manual"]==1): ?><div class="faq-ico"><img src="/Public/images/Home/faq-shou.png" alt=""></div><?php endif; ?>
                  <?php if($search["is_split"]==1): ?><div class="faq-ico"><img src="/Public/images/Home/faq-chai.png" alt=""></div><?php endif; ?>
                  <?php if($search["is_copy"]==1): ?><div class="faq-ico"><img src="/Public/images/Home/faq-copy.png" alt=""></div><?php endif; ?>
                  <?php if($search["status"]==0): ?><div class="faq-ico"><img src="/Public/images/Home/faq-gua.png" alt=""></div><?php endif; ?>
                  <?php if($search["lock_status"]==1): ?><div class="faq-ico"><img src="/Public/images/Home/faq-suo.png" alt=""></div><?php endif; ?>
                  <?php if($search["confirm_order"]==1 && $search["confirm_status"]==1): ?><div class="faq-ico"><img src="/Public/images/Home/faq-shen.png" alt=""></div><?php endif; ?>
                  <?php if($search["confirm_order"]==1 && $search["confirm_status"]==0): ?><div class="faq-ico"><img src="/Public/images/Home/faq-wen.png" alt=""></div><?php endif; ?>
                  <?php if($search["cancel_status"]==1): ?><div class="faq-ico"><img src="/Public/images/Home/faq-zuofei.png" alt=""></div><?php endif; ?>
                  <?php if($search["assign_result"]==2 || $search["assign_result"]==3): ?><div class="faq-ico"><img src="/Public/images/Home/faq-que.png" alt=""></div><?php endif; ?>
                  <?php if($search["payment_status"]==0): ?><div class="faq-ico faq-ico-wfk"><img src="/Public/images/Home/wfk.png" alt=""></div><?php endif; ?> -->
               </div>
               <div class="abe-fr">


          <?php if (isset($rights['edit_base']) && $rights['edit_base']): ?>
          <?php if ($search['status']==0): ?>
               <a href="javascript:void(0);"  class=" vi-blue vi-blue mlg_10 " onclick="return _asr.popupFun('<?php echo U("/Home/Testx/index?func=edit_base&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Testx/index?func=edit_base&id=$search[id]","");?>'); "> 编辑</a>
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
             <th>编码</th>
             <td><a href="javascript:void(0);" class="vi-blue"  onclick="return _asr.openLink('<?php echo U("/Home/Question/index?func=view&no=$search[testx_no]"); ?>','<?php echo filterFuncId( U("/Home/Question/index?func=view&no=$search[testx_no]") ,"");?>', '题库详情' ,0); " ><?php echo $search["testx_no"]; ?></a></td>
             <th>知识点</th>
             <td><?php echo $search["category_name"]; ?></td>
             <th>创建时间</th>
             <td><?php echo system_format("DT", $search["create_time"],1); ?><em class="abe-space-sm"></em><?php echo $search["create_user"]; ?></td>
             <td colspan="2" rowspan="3">
                 <a style="display: block; line-height: 0;" href="<?php echo $search["img"]?$search["img"]:"link"; ?>" target="_blank" class="vi-blue"   >
                   <img src="<?php echo $search["img"]?$search["img"]:"link"; ?>" class="" style=" max-width:100%; max-height:200px; " />
                 </a></td>
           </tr>
           <tr class= "odd">
             <th>类型</th>
             <td><?php echo get_table_Testx_type("$search[type]","name","") ; ?></td>
             <th>导入时间</th>
             <td><?php echo system_format("DT", $search["import_time"],1); ?></td>
             <th>修改时间</th>
             <td><?php echo system_format("DT", $search["modify_time"],1); ?><em class="abe-space-sm"></em><?php echo $search["modify_user"]; ?></td>
           </tr>
           <tr class= "even">
             <th>名称</th>
             <td><?php echo $search["name"]; ?></td>
             <th>导入人员</th>
             <td><?php echo $search["import_user"]; ?></td>
             <th>状态</th>
             <td><?php echo get_table_Testx_status("$search[status]","name","") ; ?></td>
           </tr>

        </tbody>
     </table>
         </div>
      </div>





       <div class="table-box">
         <div class="table-in">
            <form action="<?php echo U('Testx/index?func=view'); ?>" id="<?php echo "$funcid"; ?>-Search" method="get">
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
                    <form id="<?php echo "$funcid"; ?>-Result"  action="<?php U('Testx/op'); ?>" method="post">
                      <input type="hidden" name="<?php echo "$funcid"; ?>-last-url" id="<?php echo "$funcid"; ?>-last-url" value="<?php echo $__last_url; ?>" />
                      <input type="hidden" name="funcid" value="<?php echo "$funcid"; ?>" />
                      <input type="hidden" name="pfuncid" value="<?php echo "$pfuncid"; ?>" />
                      <input type="hidden" name="id" value="<?php echo $search["id"]; ?>" />
                      <input type="hidden" name="_lastchanged" value="<?php echo $search["lastchanged"]; ?>" />
                      <table border="0" cellspacing="0" cellpadding="0" class="pub-table-par pub-table-par-tdc pub-t-faq">
                        <colgroup>
                          <col style="width: 40px ;">
                          <col style="width: 60px ;">
                          <col style="width: 80px ;">
                          <col style="width: 80px ;">
                          <col style="width: 100px ;">
                          <col style="width: auto" >
                        </colgroup>
                        <tbody>
                          <tr>
                            <th><input type="checkbox"  onclick="_asr.selectAll(this);"> &nbsp;#</th>
                            <th>操作</th>
                            <th>类型A</th>
                            <th class="abe-txtl">编码A</th>
                            <th class="abe-txtl">名称A</th>
                           <th></th >
                          </tr>
                          <?php if(is_array($list)): $i = 0; $__LIST__ = $list; if( count($__LIST__) == 0) : echo ""; else: foreach($__LIST__ as $key=>$master): $mod = ($i % 2 );++$i; ?>
                                  <tr <?php if($mod == "1"): ?>class="even"<?php endif; if($mod == "0"): ?>class="odd"<?php endif; ?>>
                                    <!-- 选择 -->
                                    <td><input type="checkbox" name="Key[]" data-type="select" onclick="_asr.selectMulit(this);" value="<?php echo $master['id'] ;?>">&nbsp; <?php echo $i + ($page_size * ($p - 1)); ?></td>
                                    <td>
                            <div class="faq-icon">


          <?php if (isset($rights['master_edit']) && $rights['master_edit']): ?>
          <?php if ($master[status]==0): ?>
               <a href="javascript:void(0);"  class=" vi-blue vi-blue " onclick="return _asr.popupFun('<?php echo U("/Home/Testx/index?func=edit&id=$master[id]") ; ?>', '<?php echo filterFuncId("/Home/Testx/index?func=edit&id=$master[id]","");?>'); "><i class="iconfont abe-ft15">&#xe63f;</i></a>
          <?php endif; ?>
          <?php endif; ?>



          <?php if (isset($rights['master_delete']) && $rights['master_delete']): ?>
          <?php if ($master[status]==0): ?>
               <a href="javascript:void(0);"  class=" vi-blue vi-blue " onclick="return _asr.confirm('确认操作', '请确认是否删除测试表111?', '<?php echo "测试表111 : $master[testx_no]"; ?>', '<?php echo U("/Home/Testx/index?func=delete&type=1&id=$master[id]") ; ?>','',''); "><i class="iconfont vi-red">&#xe61d;</i></a>
          <?php endif; ?>
          <?php endif; ?>

                            </div></td>
                                    <td><?php echo get_table_TestxDetail_typea("$master[typea]","name","") ; ?></td>
                                    <td  class=" abe-txtl "><a href="javascript:void(0);" class="vi-blue"  onclick="return _asr.openLink('<?php echo U("/Home/Question/index?func=view&no=$master[codea]"); ?>','<?php echo filterFuncId( U("/Home/Question/index?func=view&no=$master[codea]") ,"");?>', '题库详情' ,0); " ><?php echo $master["codea"] ; ?></a></td>
                                    <td  class=" abe-txtl "><?php echo $master["namea"] ; ?></td>
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
                    <form id="<?php echo "$funcid"; ?>-Result"  action="<?php U('Testx/op'); ?>" method="post">
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
                                    <td><?php echo get_table_Testx_status("$master[status]","name","") ; ?></td>
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
          <?php if ($search['status']==0): ?>
               <input type="button" value="信息编辑" class="btn btn-blue mlg_10 " default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/Testx/index?func=edit_base&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Testx/index?func=edit_base&id=$search[id]","");?>'); " />
          <?php endif; ?>
          <?php endif; ?>



          <?php if (isset($rights['order_detail']) && $rights['order_detail']): ?>
          <?php if ($search['status']==0): ?>
               <input type="button" value="明细编辑" class="btn btn-blue mlg_10 " default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/Testx/index?func=detail_edit&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Testx/index?func=detail_edit&id=$search[id]","");?>'); " />
          <?php endif; ?>
          <?php endif; ?>



          <?php if (isset($rights['status_on']) && $rights['status_on']): ?>
          <?php if ($search['status']=='0'): ?>
               <input type="button" value="转有效" class="btn btn-blue mlg_10 " default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/Testx/index?func=status_on&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Testx/index?func=status_on&id=$search[id]","");?>'); " />
          <?php endif; ?>
          <?php endif; ?>



          <?php if (isset($rights['status_off']) && $rights['status_off']): ?>
          <?php if ($search['status']=='1'): ?>
               <input type="button" value="转无效" class="btn btn-org mlg_10 " default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/Testx/index?func=status_off&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Testx/index?func=status_off&id=$search[id]","");?>'); " />
          <?php endif; ?>
          <?php endif; ?>

          <div class="abe-fr">


          <?php if (isset($rights['order_delete']) && $rights['order_delete']): ?>
          <?php if ($search['status']==0): ?>
               <input type="button" value="记录删除" class="btn btn-org mrg_10 " default-status="1" onclick="return _asr.confirm('确认操作', '请确认是否进行 信息删除 操作?', '', '<?php echo U("/Home/Testx/index?func=delete&id=$search[id]") ; ?>','','<?php echo "$funcid"; ?>-Result'); " />
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


    <?php echo W('Summary/javascript',array('Testx'));?>


    </script>