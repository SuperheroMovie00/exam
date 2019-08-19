<?php if (!defined('THINK_PATH')) exit();?>
<div class="table-in" id="<?php echo ($pfuncid); ?>_examview">

<div class="qmod-bd">
    <div class="qmod">
        <?php foreach($detail as $item) { ?>

        <!--一类标题-->
        <?php if($item['type']=='1'){ ?>
        <div class="paper-title-info abe-txtc" style="padding: 0px">
            <h1 class="font-xst">
                <?php if($item['subject'] != "") { echo ($item['subject']); } if($item['score'] > 0) { ?>(共<?php echo ($item['score']); ?>分)<?php } ?>
            </h1>
        </div>
        <?php } ?>

        <?php  if($item['type']=='2'){ ?>
        <div class="paper-title-info abe-txtc" style="padding: 0px">
            <h2 class="font-ht">
                <?php if($item['subject'] != "") { echo ($item['subject']); } if($item['score'] > 0) { ?>(共<?php echo ($item['score']); ?>分)<?php } ?>
            </h2>
        </div>
        <?php } ?>

        <?php  if($item['type']=='3'){ ?>
        <div class="paper-title-info abe-txtc" style="padding: 0px">
            <h3 class="font-xster">
                <?php if($item['subject'] != "") { echo ($item['subject']); } if($item['score'] > 0) { ?>(共<?php echo ($item['score']); ?>分)<?php } ?>
            </h3>
        </div>
        <?php } ?>

        <ul class="abe-txtl">
        <?php if($item['type']=='4'){ ?>
        <li class="abe-fb"><?php if($item['subject'] != "") { echo ($item['subject']); } ?></li><?php if($item['score'] > 0) { ?>(共<?php echo ($item['score']); ?>分)<?php } ?>
        <?php } ?>


        <?php if($item['type']=='5'){ ?>
        <li class="font-lifive font-s11"><?php if($item['subject'] != "") { echo ($item['subject']); } ?></li><?php if($item['score'] > 0) { ?>(共<?php echo ($item['score']); ?>分)<?php } ?>
        <?php } ?>
        </ul>

        <?php if($item['type']=='6'){ ?>
        <div class="mod-numsix font-xster ">
            <?php if($item['subject'] != "") { echo ($item['subject']); } if($item['score'] > 0) { ?>(共<?php echo ($item['score']); ?>分)<?php } ?>
        </div>
        <?php } ?>


        <?php  if($item['type']=='7'){ ?>
        <div class="qidseven">
            <?php if($item['subject'] != "") { echo ($item['subject']); } if($item['score'] > 0) { ?>(共<?php echo ($item['score']); ?>分)<?php } ?>
        </div>
        <div class="describe">
            <div class="des-tit" style="padding: 0px 0px 0px 20px">
                <?php if($item['additional'] != "") { echo ($item['additional']); } ?>
            </div>
        </div>
        <?php } ?>

        <?php if($item['type']=='8'){ ?>
        <div class="describe">
            <div class="des-tit" style="padding: 0px 0px 0px 20px">
                <em class="triangle"></em>
                <?php if($item['subject'] != "") { echo ($item['subject']); } if($item['score'] > 0) { ?>(共<?php echo ($item['score']); ?>分)<?php } ?>
            </div>
        </div>
        <?php } ?>


        <?php foreach($item['questions'] as $questions) { ?>
        <?php foreach($questions as $row) { ?>
        <dl class="que-item">
            <?php echo ($row['question_stem']); ?> <!--题干 -->

<?php echo ($row['question_description']); ?>
            <dd>
                <?php if($row['question_kind'] == 'xz') { ?>
                    
<?php if(strstr($row["question_quiz"],'/Uploads/img/')==null){ ?>

<ul class="options">
    <!--新加入判读，解决没有题目的时候显示A   19-8-13 -->
    <?php if(count($row['question_quiz_item'])<=1){ ?>
    <?php }else{ ?>
    <?php  foreach($row['question_quiz_item'] as $subKey=>$subItem) { ?>
    <li><em><?php echo chr(65 + $subKey); ?>.</em><?php echo ($subItem); ?></li>
    <?php } ?>
    <?php } ?>
</ul>

<?php }else{ ?>

<!--选择题中选项全部都是图片的情况-->
<ul class="options sq50-img">
    <?php foreach($row['question_quiz_item'] as $subKey=>$subItem) { ?>
    <li><em><?php echo chr(65 + $subKey); ?>.</em><img src=<?php echo ($subItem); ?> alt/></li>
    <?php } ?>
</ul>

<?php } ?>



                <?php } elseif($row['question_kind'] == 'tk') { ?>
                    
                <?php } elseif($row['question_kind'] == 'dx') { ?>
                    <ul class="options">
    <?php foreach($row['question_quiz_item'] as $subKey=>$subItem) { ?>
    <li><em><?php echo chr(65 + $subKey); ?>.</em><?php echo ($subItem); ?></li>
    <?php } ?>
</ul>
                <?php } elseif($row['question_kind'] == 'yd') { ?>
                    
                <?php } elseif($row['question_kind'] == 'zw') { ?>
                    
                <?php } ?>
            </dd>
            <dd>
    <span class="show answer" style="display: none">
        <?php if($row['question_answer']){ ?>     <!--判断解析存在的时候显示解析-->
        <font color="red" size="4">答案：</font> <font size="4"><?php echo ($row['question_answer']); ?></font><br>
        <?php } ?>
    </span>
    <span class="show analysis" style="display: none">
    <?php if($row['question_analysis']){ ?>     <!--判断解析存在的时候显示解析-->
        <font color="red" size="4">解析：</font>  <font size="3"><?php echo ($row['question_analysis']); ?></font>
        <?php } ?>
    </span>
</dd>
        </dl>
        <?php } ?>
        <?php } ?>

        <?php } ?>
    </div>
</div>
</div>
<script>
    $("#<?php echo ($pfuncid); ?>_detailarea2 order-det-ptab a").removeClass("current");
    $("#<?php echo ($pfuncid); ?>_detailarea2 order-det-ptab a:eq(0)").addClass("current");
</script>