<?php if (!defined('THINK_PATH')) exit();?>
<div id="<?php echo ($funcid); ?>_tree">
    <?php if(!empty($templet_list)) { ?>
    <?php echo showtempletlist($templet_list,$funcid); ?>
    <?php } ?>
</div>