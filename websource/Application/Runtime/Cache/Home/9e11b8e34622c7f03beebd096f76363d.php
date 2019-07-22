<?php if (!defined('THINK_PATH')) exit();?>
<div class="prompt-pop" data-type="grid" id="<?php echo $funcid ?>" style="z-index: <?php echo ($zindex); ?>;" funcid="<?php echo ($funcid); ?>" last-url="<?php echo ($__last_url); ?>">
  <div class="title">
      <span class="pop-name">编辑试卷 - <?php echo $search['exam_no']; ?></span>
      <a href="javascript:void(0);" onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');" class="close iconfont">&#xe60d;</a>
  </div>
  <div class="trees-box" >
    <div>
      <div class="screening new-filter">
        <form action="<?php echo U('Exam/index?func=detail_edit'); ?>" id="<?php echo $funcid;?>-Search-Form" method="get" verify="1">
          <input type="hidden" name="id" value="<?php echo ($id); ?>" />
          <input type="hidden" name="funcid" value="<?php echo ($funcid); ?>" />
          <input type="hidden" name="pfuncid" value="<?php echo ($pfuncid); ?>" />
          <input type="hidden" name="zindex" value="<?php echo ($zindex); ?>" />
          <input type="hidden" name="loaddetail" value="<?php echo ($search['loaddetail']); ?>" />
          <ul class="nf-ul form form-mod-new abe-fl">

            <li> <div class="unit-left">搜索关键字</div>
              <div class="unit-mid">
                <div class="txt-box">
                  <input type="text" name="_keyword" autocomplete="off" value="<?php echo ($search['_keyword']); ?>" class="pbtxt txt0" verify="empty?1" tips="至少输入一个搜索项" onKeyDown="<?php echo ($funcid); ?>_keydown(this);">
                </div>
              </div>
            </li>
          </ul>
          <div class="nf-tsub abe-fl clearfix">
             <input type="submit" value="搜索信息"   class="btn btn-org abe-fl" id="<?php echo ($funcid); ?>_goods"   onclick="$('#<?php echo $funcid; ?>-Search-Form').attr('verify', '0');return _asr.submit('<?php echo $funcid;?>', this, '<?php echo U('Exam/index?func=detail_edit&type=0'); ?>')">
             <a href="#" class="nf-faqbtn mlg_10">操作帮助<i class="iconfont mlg_5">&#xe62a;</i></a>
             <input type="submit" value="保存输入信息，我要继续添加" class="btn btn-blue abe-fr" id="<?php echo ($funcid); ?>_save"   onclick="return _asr.submit('<?php echo $funcid;?>', '<?php echo $funcid;?>-Result-Form', '<?php echo U('Exam/index?func=detail_save'); ?>');">
          </div>
        </form>
      </div>
      <div class="nf-faqtip">
        1. 输入搜索关键字后按回车执行"搜索信息"，定位在首个搜到记录上，按tab键进行选择，输入数据后按回车可以提交保存，提交成功后回关键字输入<br>
        2. 将已提交的信息中输入数量改为0，保存后会从当前保存信息中删除此记录<br>
        <span class="abe-red">3. 在当前页上完成所要商品输入/修改数量，必须先提交保存后才能翻页或再次搜索，否则输入信息丢失</span>
      </div>
      <div class="table-box">
        <div class="table-in" style="height: 350px;">
          <form action="<?php echo U('Exam/index?func=detail_save'); ?>" method="post" id="<?php echo $funcid;?>-Result-Form">
             <input type="hidden" name="id" value="<?php echo ($id); ?>" />
             <input type="hidden" name="funcid" value="<?php echo ($funcid); ?>" />
             <input type="hidden" name="pfuncid" value="<?php echo ($pfuncid); ?>" />
             <input type="hidden" name="p" value="<?php echo ($p); ?>" />
             <input type="hidden" name="zindex" value="<?php echo ($zindex); ?>" />

             <table border="0" cellspacing="0" cellpadding="0" class="pub-table-par pub-t-faq">
               <colgroup>
                 <col style="width:40px; display: none ">
                 <col style="width:40px;">
                 <col style="width: 80px ;">
                 <col style="width: 100px ;">
                 <col style="width: 80px ;">
                 <col style="width: 100px ;">
                 <col style="width: 80px ;">
                 <col style="width: 100px ;">
                 <col style="width: 80px ;">
                 <col style="width: 80px ;">
                 <col style="width: 80px ;">
                 <col style="width: auto" >
               </colgroup>
               <tbody>
                 <tr>
                   <th style="display:none"></th>
                   <th>#<?php if($existdetail): ?><input type="checkbox">删除<?php endif; ?></th>
                   <th class="abe-txtl">试题编码</th>
                   <th class="abe-txtl">试题名称</th>
                   <th>试题类型</th>
                   <th class="abe-txtl">试题知识点</th>
                   <th>类型</th>
                   <th class="abe-txtl">标题</th>
                   <th>题号</th>
                   <th>分数</th>
                   <th>抽取次数</th>
               <th></th >
                 </tr>
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list; if( count($__LIST__) == 0) : echo ""; else: foreach($__LIST__ as $key=>$master): $mod = ($i % 2 );++$i; ?>
                 <tr class="<?php echo($key%2==0)?"odd":"even";?> <?php echo ($master['_did'])?"highline":($master[status]=='0'?"redline":""); ?>">
                   <td style="display:none">
                       <input type="checkbox" name="_id[]"  value="<?php echo ($master["id"]); ?>" <?php if($master['_did'] > 0): ?>checked<?php endif; ?> />
                   </td>
                   <td><?php echo $key +1+ ($page_size * ($p - 1)); ?><input type="hidden" name="_did_<?php echo ($master['id']); ?>" value="<?php echo ($master["_did"]); ?>" />
                       <?php if($master['_did'] > 0): ?><input type="checkbox" name="del[]"  value="<?php echo ($master["_did"]); ?>" /><?php endif; ?>
                       </td>
                   <td  class=" abe-txtl " tag="question_code"><?php echo $master["question_code"] ; ?></td>
                   <td  class=" abe-txtl " tag="question_name"><?php echo $master["question_name"] ; ?></td>
                   <td   tag="question_type"><?php echo get_table_ExamDetail_question_type("$master[question_type]","name","") ; ?></td>
                   <td  class=" abe-txtl " tag="question_category_name"><?php echo $master["question_category_name"] ; ?></td>
                   <td   tag="type">
                       <?php if($master['_did'] || $master['status']=="1" ): ?>
                       <div class="dropdown" id="<?php echo ($funcid); ?>_type">
                           <select class="pbsele dropdown pbsele-80" name="type_<?php echo ($master['id']); ?>" onblur="return <?php echo $funcid ?>_check(this);">
                              <option value="" <?php if($search['type'] == ''): ?> selected="selected" <?php endif;?> ></option>
                             <?php
 $keyvalue = table_ExamDetail_type(); if(is_array($keyvalue)){ $i = 0; $__LIST__ = $keyvalue; ?>
                                    <?php foreach($__LIST__ as $key=>$item): ++$i; ?>
                                 <option value="<?php echo $item['id']; ?>" <?php if($item['id'] == $master['type']): ?> selected="selected" <?php endif;?>><?php echo $item['name']; ?></option>
                                    <?php endforeach; ?>
                             <?php } ?>
                           </select>
                       </div>
                       <?php else: ?>
                             <?php echo get_table_Question_status($master["status"],"name"); ?>
                       <?php endif; ?></td>
                   <td  class=" abe-txtl " tag="subject">
                       <div class="textbox">
                       <?php if($master['_did'] || $master['status']=="1" ): ?>
                         <input type="text" class="pbtxt pbtxt-80 abe-txtc " name="subject_<?php echo ($master['id']); ?>" value="<?php echo $master['subject'] ; ?>" onblur="return <?php echo $funcid ?>_check(this);" >
                       <?php else: ?>
                             <?php echo get_table_Question_status($master["status"],"name"); ?>
                       <?php endif; ?>
                       </div></td>
                   <td   tag="seq">
                       <div class="textbox">
                       <?php if($master['_did'] || $master['status']=="1" ): ?>
                         <input type="text" class="pbtxt pbtxt-80 abe-txtc " name="seq_<?php echo ($master['id']); ?>" value="<?php echo $master['seq'] ==0?'':$master['seq'] ; ?>" onblur="return <?php echo $funcid ?>_check(this);" >
                       <?php else: ?>
                             <?php echo get_table_Question_status($master["status"],"name"); ?>
                       <?php endif; ?>
                       </div></td>
                   <td   tag="score">
                       <div class="textbox">
                       <?php if($master['_did'] || $master['status']=="1" ): ?>
                         <input type="text" class="pbtxt pbtxt-80 abe-txtc " name="score_<?php echo ($master['id']); ?>" value="<?php echo $master['score'] ==0?'':$master['score'] ; ?>" onblur="return <?php echo $funcid ?>_check(this);" >
                       <?php else: ?>
                             <?php echo get_table_Question_status($master["status"],"name"); ?>
                       <?php endif; ?>
                       </div></td>
                   <td>
                       <div class="textbox">
                       <?php if($master['_did'] || $master['status']=="1" ): ?>
                         <input type="text" class="pbtxt pbtxt-80 abe-txtc " name="extract_count_<?php echo ($master['id']); ?>" value="<?php echo $master['extract_count'] ==0?'':$master['extract_count'] ; ?>" onblur="return <?php echo $funcid ?>_check(this);" >
                       <?php else: ?>
                             <?php echo get_table_Question_status($master["status"],"name"); ?>
                       <?php endif; ?>
                       </div></td>
                   <td></td>
                 </tr>
         <?php endforeach; ?>
         <?php
 endif; else: echo ""; endif; ?>
                </tbody>
             </table>
          </form>
        </div>
        <div class="blank15"></div>
        <?php echo $page; ?>
      </div>
    </div>
  </div>
  <div class="pop-sub ">
    <div class="nf-sdata">
      <!-- 暂时关闭条件  <?php if($statinfo): endif; ?>   -->
      <div class="abe-fl pdr_10 "><?php echo $statinfo; ?></div>
      <input type="submit" value="显示已保存信息"  class="btn btn-org abe-fl "  id="<?php echo ($funcid); ?>_order"   onclick="$('#<?php echo $funcid; ?>-Search-Form').attr('verify', '0');return _asr.submit('<?php echo $funcid;?>', '<?php echo $funcid;?>-Search-Form', '<?php echo U('Exam/index?func=detail_edit&type=1');?>')">
    </div>
    <div class="abe-fr pdr_40 ">
        <input type="submit" value="输入完成，保存退出" class="btn btn-blue mrg_10" onclick="return _asr.submit('<?php echo $funcid;?>', '<?php echo $funcid;?>-Result-Form', '<?php echo U('Exam/index?func=detail_save&close=1'); ?>');">
        <input type="submit" value="取消" class="btn btn-org" onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');">
    </div>
  </div>
</div>

<script>
      function <?php echo $funcid ?>_init(){
          var _this = $("#<?php echo $funcid ?>");
          var ppw = _this.width()/2;
          _this.css({'margin-left':-ppw});
          if($("#<?php echo ($funcid); ?>-Result-Form table tr").length>1)
        $("#<?php echo ($funcid); ?>-Result-Form table tr:eq(1)").find("input[name*='subject_']").focus();
      }

      function <?php echo $funcid ?>_refresh() {
          _asr.submit('<?php echo $funcid;?>', $("#<?php echo $funcid ?>").find("form").eq(1), '');
      }

      function <?php echo $funcid ?>_check(o) {
        var _val = $(o).val();

/* 判断是否输入的数值
          var dval = parseFloat($(o).val());
          if(isNaN(dval)) return false;
*/
        $(o).parents("tr").find("input[type=checkbox][name='_id[]']").prop("checked", _val!='');

/* 是否存在页面，输入后自动计算的，如输入数量计算金额
          var purchase_price, packing_qty;
        purchase_price = $(o).parents("tr").find("td[tag=purchase_price]").html();
        packing_qty = $(o).parents("tr").find("td[tag=packing_qty]").html();
        purchase_price = parseFloat(purchase_price);
        if(isNaN(purchase_price)) purchase_price = 0.0;
        packing_qty = parseFloat(packing_qty);
        if(isNaN(packing_qty) || packing_qty == 0)  packing_qty = 1.0;

        $(o).parents("tr").find("td[tag=purchase_qty]").html((qty * packing_qty).toFixed(0));
        $(o).parents("tr").find("td[tag=purchase_amount]").html((qty * packing_qty * purchase_price).toFixed(2));
*/
    }

    function <?php echo $funcid ?>_clear() {
        $("#<?php echo $funcid;?>-Result-Form").find("tr").not(":first").remove();
        var _form = $("#<?php echo $funcid; ?>-Search-Form");
        _form.find("input[name=_keyword]").val("");
        _form.find("input[name=goods_no]").val("");
        _form.find("input[name=name]").val("");
        _form.find("button.txt-clear").trigger("click");
        _form.find("input[name=_keyword]").focus();
    }

    function <?php echo $funcid ?>_show(statinfo) {
        $("#<?php echo ($funcid); ?>_show_num").html(statinfo);
    }

    function <?php echo $funcid ?>_focus()
    {
        var isfind=false;
        $("#<?php echo ($funcid); ?>-Result-Form table tr").each(function(){
            var cur=$(this).find("input[name*='subject_']").val();
            if(cur!=undefined && cur!="")
            {
                $(this).find("input[name*='subject_']").focus();
                isfind=true;
                return false;
            }
        });
        if(!isfind)
        {
            if($("#<?php echo ($funcid); ?>-Result-Form table tr").length>1)
                $("#<?php echo ($funcid); ?>-Result-Form table tr:eq(1)").find("input[name*='subject_']").focus();
        }
    }

</script>