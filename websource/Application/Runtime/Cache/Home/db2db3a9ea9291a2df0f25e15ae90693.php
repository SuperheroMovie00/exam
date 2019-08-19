<?php if (!defined('THINK_PATH')) exit();?>
<div id="<?php echo ($pfuncid); ?>_detailarea1">
  <div class="table-box">
    <div class="table-in" >
  <table border="0" cellspacing="0" cellpadding="0" class="pub-table" id="table" >
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
    <tbody id="examlist">

    <tr>
      <th>序号</th>
      <th>状态</th>
      <th class=" abe-txtl ">试卷编码</th>
      <th class=" abe-txtl ">标题</th>
      <th>类型</th>
      <th>总分</th>
      <th>题量</th>
      <th>修改时间</th>
      <th/>
    </tr>

    <?php foreach($list as $detail_key=>$detail): $detail_mod = ($di % 2 );++$di;?>
    <tr  <?php if(($detail_mod) == "1"): ?>class="even"<?php endif; if(($detail_mod) == "0"): ?>class="odd"<?php endif; ?> onclick="_asr.loadData('<?php echo "$pfuncid"; ?>_detailarea2','<?php echo U("Templet/index?func=detailarea2&id=$detail[id]") ; ?>','<?php echo "$pfuncid"; ?>_detailarea2'); return false;">
    <td class="align=c" ><?php echo $di."."; ?></td>
    <td>
      <?php echo get_table_Exam_status("$detail[status]","name","") ; ?>
    </td>
    <td class=" abe-txtl "><a href="javascript:void(0);" class="vi-blue"  onclick="return _asr.openLink('<?php echo U("/Home/Exam/index?func=view&id=$detail[id]"); ?>','<?php echo filterFuncId( U("/Home/Exam/index?func=view&id=$detail[id]") ,"");?>', '试卷详情' ,0); " ><?php echo $detail["exam_no"]; ?></a></td>
    <td class=" abe-txtl "><?php echo OverView($detail["subject"],100,"..."); ?></td>
    <td><?php echo get_table_Exam_type("$detail[type]","name","") ; ?></td>
    <td><?php echo system_format("N3", $detail["score"],1); ?></td>
    <td><?php echo system_format("N3", $detail["count"],1); ?></td>
    <td><?php echo system_format("DT", $detail["modify_time"],1); ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
    </div>
  </div>
</div>

    <script>


        /***************************************************************************************/
        /* 页面初始化                                                                      */
        /***************************************************************************************/
        function <?php echo $funcid; ?>_init(_id){
           if($("#<?php echo $funcid; ?>").find("tr").size() > 1) {
            $("#<?php echo $funcid; ?>").find("tr").eq(1).trigger("click")
           }
        }

        /**
         * 2019-7-1
         * 新增的点击试卷改变选中行的背景颜色
         */
        $("#table tr").click(function(){
          $("#table tr td").css("background","");
          $(this).find('td').css("background","blue");
        });


    </script>