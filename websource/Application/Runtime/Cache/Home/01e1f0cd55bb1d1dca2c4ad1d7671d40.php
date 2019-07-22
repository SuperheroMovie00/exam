<?php if (!defined('THINK_PATH')) exit();?>
<div class="table-in" id="<?php echo ($pfuncid); ?>_question" style="height:300px">

<div class="qmod-bd">
<div class="qmod qmod-mg0">
    <?php foreach($items as $row) { ?>
    <dl class="que-item">
        <?php echo ($row['stem']); ?>
<?php echo ($row['description']); ?>



        <dd>
            <?php if($row['kind'] == 'xz') { ?>
            
<?php if(strstr($row["quiz"],'/Uploads/img/')==null){ ?>

<ul class="options">
    <?php foreach($row['quiz_item'] as $subKey=>$subItem) { ?>
    <li><em><?php echo chr(65 + $subKey); ?>.</em><?php echo ($subItem); ?></li>
    <?php } ?>
</ul>

<?php }else{ ?>
<!--选择题中选项全部都是图片的情况-->
<ul class="options sq50-img">
    <?php foreach($row['quiz_item'] as $subKey=>$subItem) { ?>
    <li><em><?php echo chr(65 + $subKey); ?>.</em><img src=<?php echo ($subItem); ?> alt/></li>
    <?php } ?>
</ul>

<?php } ?>

            <?php } elseif($row['kind'] == 'tk') { ?>
            <?php echo ($row['quiz_item']); ?>
            <?php } elseif($row['kind'] == 'dx') { ?>
            <ul class="options">
    <?php foreach($row['quiz_item'] as $subKey=>$subItem) { ?>
    <li><em><?php echo chr(65 + $subKey); ?>.</em><?php echo ($subItem); ?></li>
    <?php } ?>
</ul>
            <?php } elseif($row['kind'] == 'yd') { ?>
            <div class="des-info">
    <?php echo ($row['quiz_item']); ?>
</div>
            <?php } elseif($row['kind'] == 'zw') { ?>
            <?php echo ($row['quiz_item']); ?>
            <?php } ?>
            <input type="button" value="信息编辑"  class="btn btn-blue pdt_5 blank25" default-status="1" onclick="return _asr.popupFun('<?php echo U("/Home/Question/index?func=edit_base&id=$row[id]"); ?>', '<?php echo filterFuncId("/Home/Question/index?func=edit_base&id=$row[id]","");?>'); " />
        </dd>
        <dd>
    <span class="show answer">
        <?php if($row['answer']){ ?>     <!--判断解析存在的时候显示解析-->
        <font color="red" size="4">答案：</font> <font size="4"><?php echo ($row['answer']); ?></font><br>
        <?php } ?>
    </span>
    <span class="show analysis">
    <?php if($row['analysis']){ ?>     <!--判断解析存在的时候显示解析-->
        <font color="red" size="4">解析：</font>  <font size="3"><?php echo ($row['analysis']); ?></font>
        <?php } ?>
    </span>
</dd>
    </dl>
    <?php } ?>
</div>
</div>
</div>