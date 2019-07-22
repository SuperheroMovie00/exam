<?php if (!defined('THINK_PATH')) exit();?>
<div id="bigdiv">
<div toplayer="1" class="prompt-pop pop-style3" id="<?php echo $funcid;?>" style="z-index:<?php echo ($zindex); ?>;width:900px; height: auto;display: block; " summaryid="RoleNode" baseurl="<?php echo U('RoleNode/index'); ?>">
    <div class="title">
        <span class="pop-name">维护角色组权限</span>
        <a href="javascript:void(0);" onclick="$(this).parents('.prompt-pop').remove();_asr.closePopup('<?php echo ($funcid); ?>');" class="close iconfont">&#xe60d;</a>
    </div>



    <!--<div class="table-box" >
        <div class="table-in" >-->
    <div class="pop-scroll">
        <div class="abe-ft14 pdb_5">角色 - <?php echo $role['name']; ?></div>
        <div class="screening" style="height: 440px;overflow-y: scroll">
            <form action="<?php echo U('RoleNode/index?func=save'); ?>" id="<?php echo "$funcid"; ?>-Search" method="get">
            <input type="hidden" name="<?php echo "$funcid"; ?>-last-url" id="<?php echo "$funcid"; ?>-last-url" value="<?php echo $__last_url; ?>" />
            <input type="hidden" name="funcid" value="<?php echo "$funcid"; ?>" />
            <input type="hidden" name="pfuncid" value="<?php echo "$pfuncid"; ?>" />
            <input type="hidden" name="role_id" value="<?php echo $id; ?>" />
            <table border="0" cellspacing="0" cellpadding="0" class="pub-table-set">
                <colgroup>
                    <col style="width: 180px ;">
                    <col style="width: 180px ;">
                    <col style="width: 200px ;">
                    <col style="width: auto" >
                </colgroup>
                <thead>
                <tr>
                    <th>一级菜单</th><th>二级菜单</th><th>三级菜单</th><th>具体功能</th>
                </tr>
                </thead>
                <tbody>
                <?php $n1_last_title="";$n2_last_title=""; ?>
                <?php foreach($n3 as $k3=>$v3){ ?>
                <?php $n2=$n2_list[$v3['pid']]; $n1=$n1_list[$n2['pid']]; ?>
                <tr class="<?php if($k3%2==0){ ?> odd <?php } ?>">
                    <?php if(isset($n1)){ ?>
                    <td>
                        <?php if($n1_last_title!=$n1['id']){ ?>
                        <?php  $n1_last_title=$n1['id']; ?>
                        <input type="checkbox" name="node_id[]" <?php if(in_array($n1['id'],$node_id_list)){ ?> checked <?php } ?> data-parent="0" data-child="<?php echo count($n2);?>" onclick="<?php echo "$funcid"; ?>_chooseRole(this);"  value="<?php echo ($n1['id']); ?>" /><?php echo ($n1['title']); ?>
                        <?php } ?>
                    </td>
                    <?php } ?>

                    <?php if(isset($n2)){ ?>
                    <td>
                        <?php if($n2_last_title!=$n2['id']){ ?>
                        <?php  $n2_last_title=$n2['id']; ?>
                        <div>
                            <input type="checkbox" name="node_id[]" <?php if(in_array($n2['id'],$node_id_list)){ ?> checked <?php } ?> data-parent="<?php echo ($n2['pid']); ?>" data-child="<?php echo count($n3);?>" value="<?php echo ($n2['id']); ?>" onclick="<?php echo "$funcid"; ?>_chooseRole(this);" /><?php echo ($n2['title']); ?>
                        </div>
                        <?php } ?>
                    </td>
                    <?php } ?>

                    <td>
                        <div ><input type="checkbox" <?php if(in_array($v3['id'],$node_id_list)){ ?> checked <?php } ?> name="node_id[]" data-parent="<?php echo ($v3['pid']); ?>" data-child="<?php echo count($v4);?>" value="<?php echo ($v3['id']); ?>" onclick="<?php echo "$funcid"; ?>_chooseRole(this);" /><?php echo ($v3['title']); ?></div>
                    </td>
                    <td>
                        <?php foreach($n4 as $k4=>$v4){ ?>
                        <?php if($v4['pid']==$v3['id']){ ?>
                        <div ><input type="checkbox" <?php if(in_array($v4['id'],$node_id_list)){ ?> checked <?php } ?> name="node_id[]" value="<?php echo ($v4['id']); ?>" data-parent="<?php echo ($v4['pid']); ?>" data-child="0" onclick="<?php echo "$funcid"; ?>_chooseRole(this);" /><?php echo ($v4['title']); ?></div>
                        <?php } ?>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>

                </tbody>
            </table>
            </form>
        </div>
    </div>

    <div class="pop-sub abe-txtc" >
        <?php if (isset($rights['save']) && $rights['save']): ?>
        <input type="button" value="保存" class="btn btn-blue mrg_10" default-status="1" onclick="return _asr.submit('<?php echo "$funcid"; ?>', '<?php echo "$funcid"; ?>-Search', '<?php echo U("/Home/RoleNode/index?func=save&") ?>',''); " />
        <?php endif; ?>
        <em class="abe-space-sm"></em>
        <input type="button" value="清除" class="btn btn-org mrg_10"  onclick="unchechall()" />
        <input type="button" value="全选" class="btn btn-org mrg_10" onclick="chechall()" />
    </div>

</div>

</div>


<script>

    //取消掉选择的复选框
    function unchechall() {
        //点击
        $("#bigdiv input[type='checkbox']:checked").attr("checked",false);
    }
    //选择所有的复选框
    function chechall() {
        //点击
        $("#bigdiv input[type='checkbox']").attr("checked",true);
    }


    /*此父类的子类取消选中*/
    function parentUnChecked(node){
        var parent=node.val();
        if(parent!="0"){
            $("[data-parent='"+parent+"']").each(function(i,e){
                $(e).attr("checked",false);
                parentUnChecked($(e))
            });
        }
    }

    /*此父类的子类选中*/
    function nodeChecked(node){
        var parent=node.val();
        if(parent!="0"){
            $("[data-parent='"+parent+"']").each(function(i,e){
                $(e).attr("checked",true);
                parentUnChecked($(e))
            });
        }
    }

    /*将父类选中*/
    function parentChecked(node){
        var parent=node.attr("data-parent");
        $("input[name='node_id[]'][value="+node.attr("data-parent")+"]").attr("checked",true)
        if(parent!="0"){
            parentChecked($("input[name='node_id[]'][value="+node.attr("data-parent")+"]"));
        }
    }


    function <?php echo "$funcid"; ?>_chooseRole(o){
        var node=$(o);
        var parent=node.attr("data-parent");

        if(node.is(':checked')){
            if(parent!="0"){        //选择一级分类的时候下面的二级分类不选中（避免用户的体验度下降）
                parentChecked(node);   //点击的时候将此节点的父类选中
                nodeChecked(node);    //点击的时候将所属于此节点的子类选中
            }
        }else{
            parentUnChecked(node);    //如果取消的话将子类一起取消
        }

    }


</script>