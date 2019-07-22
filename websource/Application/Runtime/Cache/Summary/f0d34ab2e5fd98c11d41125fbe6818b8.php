<?php if (!defined('THINK_PATH')) exit();?>
<tr style="display:" detail="1" id="<?php echo ($funcid); ?>-detail">
  <td colspan="99" style="padding:0;">
  <!-- 明细表 -->
    <table border="0" cellspacing="0" cellpadding="0" class="pub-table-in ta-tr-hover" style=" width:100%;">
      <colgroup>
        <col style="width: 40px ;">
        <col style="width: 80px ;">
        <col style="width: 80px ;">
        <col style="width: 80px ;">
        <col style="width: 80px ;">
        <col style="width: 80px ;">
        <col style="width: 80px ;">
        <col style="width: 100px ;">
        <col style="width: 100px ;">
        <col style="width: 80px ;">
        <col style="width: 100px ;">
        <col style="width: 80px ;">
        <col style="width: 150px ;">
        <col style="width: 150px ;">
        <col style="width:auto" >
      </colgroup>
      <tbody>
        <tr>
          <th>序号</th>
          <th class=" abe-txtl ">试卷编码</th>
          <th>类型</th>
          <th>题号</th>
          <th>分数</th>
          <th>试题类型</th>
          <th class=" abe-txtl ">试题编码</th>
          <th class=" abe-txtl ">试题名称</th>
          <th class=" abe-txtl ">试题知识点</th>
          <th class=" abe-txtl ">试题题型</th>
          <th class=" abe-txtl ">试题图像</th>
          <th>抽取次数</th>
          <th>创建时间</th>
          <th>修改时间</th>
          <th/>
      </tr>
      <?php foreach($list as $detail_key=>$detail): $detail_mod = ($di % 2 );++$di;?>
      <tr <?php if(($detail_mod) == "1"): ?>class="even"<?php endif; if(($detail_mod) == "0"): ?>class="odd"<?php endif; ?>>
        <td class="align=c"><?php echo $di."."; ?></td>
        <td class=" abe-txtl "><a href="javascript:void(0);" class="vi-blue"  onclick="return _asr.openLink('<?php echo U("/Home/Templet/index?func=view&no=$detail[exam_no]"); ?>','<?php echo filterFuncId( U("/Home/Templet/index?func=view&no=$detail[exam_no]") ,"");?>', '组卷模板详情' ,0); " ><?php echo $detail["exam_no"]; ?></a></td>
        <td><?php echo get_table_ExamDetail_type("$detail[type]","name","") ; ?></td>
        <td><?php echo system_format("N3", $detail["seq"],1); ?></td>
        <td><?php echo system_format("N3", $detail["score"],1); ?></td>
        <td><?php echo get_table_ExamDetail_question_type("$detail[question_type]","name","") ; ?></td>
        <td class=" abe-txtl "><a href="javascript:void(0);" class="vi-blue"  onclick="return _asr.openLink('<?php echo U("/Home/Question/index?func=view&no=$detail[question_code]"); ?>','<?php echo filterFuncId( U("/Home/Question/index?func=view&no=$detail[question_code]") ,"");?>', '题库详情' ,0); " ><?php echo $detail["question_code"]; ?></a></td>
        <td class=" abe-txtl "><?php echo $detail["question_name"]; ?></td>
        <td class=" abe-txtl "><?php echo $detail["question_category_name"]; ?></td>
        <td class=" abe-txtl "><?php echo subcode_view('question:kind',$detail['question_kind']) ; ?></td>
        <td class=" abe-txtl "><?php if($detail["question_img"]): ?><a href="<?php echo $detail["question_img"] ;?>" target="_blank" class="vi-blue"   >图像</a><?php endif; ?></td>
        <td><?php echo system_format("N3", $detail["extract_count"],1); ?></td>
        <td><?php echo system_format("DT", $detail["create_time"],1); ?></td>
        <td><?php echo system_format("DT", $detail["modify_time"],1); ?></td>
        <td/>
     </tr>
     <?php endforeach; ?>
     </tbody>
     </table>

     </td>
  </tr>