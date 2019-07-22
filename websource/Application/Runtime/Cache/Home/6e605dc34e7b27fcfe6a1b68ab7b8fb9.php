<?php if (!defined('THINK_PATH')) exit();?>
<div class="table-box" id="<?php echo ($pfuncid); ?>_detailarea2">

<div class="table-in">

  <div class="order-det-ptab">
    <div class="od-info abe-fl" >
      <a href="javascript:void(0);" onclick="_asr.loadData('<?php echo ($pfuncid); ?>_examview','<?php echo U("Templet/index?func=examview&id=$search[id]") ; ?>','<?php echo "$pfuncid"; ?>_examview',<?php echo ($pfuncid); ?>_examview_show()); return false;" >试卷预览</a>
      <a href="javascript:void(0);" onclick="_asr.loadData('<?php echo ($pfuncid); ?>_detailarea2','<?php echo U("Templet/index?func=detailarea2&id=$search[id]") ; ?>','<?php echo "$pfuncid"; ?>_detailarea2'); return false;"  class="current">试题明细</a>
    </div>
    <div class="abe-fl">       试卷编号：  <font color="red"><?php echo $exam_no ?></font> 考卷名称:   <font color="red"><?php echo $examname; ?></font></div>
  </div>

</div>
<div class="table-in" id="<?php echo ($pfuncid); ?>_examview">
  <form id="<?php echo $funcid; ?>-Result"  action="<?php U('/Home/EffectsCategory/op'); ?>" method="post">
    <input type="hidden" id="examid" value="<?php echo ($search[id]); ?>">
    <table border="0" cellspacing="0" cellpadding="0" class="pub-table">
      <colgroup>
        <col style="width: 40px ;">
        <col style="width: 40px ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
        <col style="width: auto ;">
      </colgroup>
      <tbody>


      <tr>
        <th><input type="checkbox" onclick="_asr.selectAll(this);"></th>
        <th>序号</th>
        <th></th>
        <th class=" abe-txtl ">标题</th>
        <th>题号</th>
        <th>分数</th>
        <th class=" abe-txtl ">知识点</th>
        <th>题型</th>
        <th>题目编号</th>
        <th>创建时间</th>
      </tr>


      <?php if(is_array($list)): $i = 0; $__LIST__ = $list; if( count($__LIST__) == 0) : echo ""; else: foreach($__LIST__ as $key=>$master): $mod = ($i % 2 );++$i; ?>
      <tr <?php if($mod == "1"): ?>class="even"<?php endif; if($mod == "0"): ?>class="odd"<?php endif; ?>>
      <!-- 选择 -->
      <td><input type="checkbox" name="Key[]" data-type="select" onclick="" value="<?php echo $master['id'] ;?>"></td>
      <!-- 序号 -->
      <td><?php echo $i + ($page_size * ($p - 1)); ?></td>

      <td>
        <?php if($master["type"] == 0 and $master["question_type"] < 2): ?><a href="javascript:void(0);"  class="btn btn-blue btn-sma" onclick="return _asr.popupFun('<?php echo U("/Home/Templet/index/func/rechoose_question/id/".$master["id"]);?>', '');">重抽试题</a><?php endif; ?>
      </td>

      <td class="abe-txtl"><input type="hidden" name="id" value="<?php echo $master['id']; ?>" /><?php echo $master['subject']; ?></td>
      <td><?php echo $master['type']?"":$master['seq']; ?></td>
      <td><?php echo $master['type']?"":$master["score"]; ?></td>
      <td class="abe-txtl"><?php echo $master['question_category_name']; ?></td>
      <td><?php echo $master['question_type']?"套题":subcode_view('question:kind',$master['question_kind']) ; ?></td>
      <!--date:2019-6-21 原因:放在下面的if判断中   <td class="<?php echo $master['question_id']?'':'abe-red'; ?>"><?php echo $master['type']?"":$master["question_name"]; ?></td>-->
        <!--新添加的可以查看试卷中的题目，不合适重抽-->
        <?php if($master["type"] == 0 and $master["question_id"] > 0): ?><td>
          <a href="javascript:void(0);"  class=" vi-blue vi-blue " onclick="return _asr.openLink('<?php echo U("/Home/Question/index?func=view&id=$master[question_id]") ; ?>', '<?php echo filterFuncId(U("/Home/Exam/index?func=view&id=$master[question_id]"),"");?>' , '题库-<?php echo ($master['question_code']); ?>' ,0); "><i class="iconfont abe-ft18">&#xe62e;</i></a>
          <?php echo $master["question_code"]; ?>
          </td>

        <?php else: ?>
          <td class="<?php echo $master['question_id']?'':'abe-red'; ?>">
            <?php echo $master['type']?"":$master["question_name"]; ?>
          </td><?php endif; ?>

      <td><?php echo $master["create_time"]; ?></td>
      </tr>
      <?php endforeach; ?>
      <?php
 endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
  </form>

  <div class="data-oper abe-txtc" >
    <div class="data-oper-in" >
      <div class="abe-fl" >
        <span class="pdr_10 ">当前已选择<i class="abe-ft16 vi-org"> 0 </i>条</span>
        <input type="button" class="btn btn-blue btn-sma mrg_30" value="重抽试卷" onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Result', '<?php echo U("/Home/Templet/index?func=create_exam&tid=".$master["templet_id"]."&examid=".$examid) ; ?>',''); ">
        <input type="button" value="试卷编辑" class="btn btn-blue btn-sma mrg_10" default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/Exam/index?func=edit_base&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Exam/index?func=edit_base&id=$search[id]","");?>'); " />
        <input type="button" value="试卷确认" class="btn btn-blue btn-sma mrg_30" default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/Exam/index?func=todummy&id=$search[id]") ; ?>', '<?php echo filterFuncId("/Home/Exam/index?func=todummy&id=$search[id]","");?>'); " />
        <input type="button" value="删除试卷" class="btn btn-org btn-sma mrg_10" default-status="1" onclick="return _asr.confirm('确认操作', '请确认是否进行 删除试卷 操作?', '', '<?php echo U("/Home/Templet/index?func=examorder_deleteer&id=$search[id]") ; ?>','','<?php echo "$funcid"; ?>-Result'); " />
      </div>
  </div>

<script>
    function <?php echo ($pfuncid); ?>_examview_show()
    {
        $("#<?php echo ($pfuncid); ?>_detailarea2 .order-det-ptab a").removeClass("current");
        $("#<?php echo ($pfuncid); ?>_detailarea2 .order-det-ptab a:eq(0)").addClass("current");
    }





</script>