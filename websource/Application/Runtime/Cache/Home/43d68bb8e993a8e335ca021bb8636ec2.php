<?php if (!defined('THINK_PATH')) exit();?>
<div class="prompt-pop pop-style2" id="<?php echo ($funcid); ?>" style="z-index:<?php echo ($zindex); ?>">
	<input type="hidden" name="selecttype" value="<?php echo ($selecttype); ?>" />
  <div class="title"><span class="pop-name">选择知识点信息</span><a href="javascript:void(0);" class="close iconfont" onclick="_asr.closePopup('<?php echo ($funcid); ?>');">&#xe60d;</a> </div>
   <div class="pop-scroll">
        <div class="trees-nav trees-nav-pop abe-posclear" style="width: 100%; background:#fff;">
            <div>
                <em class="abe-space"></em>
                <span class="mtg_10">搜索:</span>
                <input type="text" class="txt0" name="<?php echo ($funcid); ?>-Search" id="<?php echo ($funcid); ?>-Search" style="width:50%; height:20px; margin-left: 10px" />
                <em class="abe-space"></em>
                <span class="mtg_10">只在当前显示的信息内进行搜索</span>
            </div>
            <ul>
                <li><input j='{}' data-id="0" type="<?php echo (strtolower($selecttype)== 'multi'?'checkbox':'radio'); ?>" name="code[]" value="0" show="无上级">无上级</li>
                <?php foreach($treedatas as $v) { ?>
                <li><input j='<?php echo json_encode($v); ?>' data-id="<?php echo $v['id']; ?>" type="<?php echo (strtolower($selecttype)== 'multi'?'checkbox':'radio'); ?>" name="code[]" value="<?php echo $v['code']; ?>" show="<?php echo $v['full_path']; ?>"><?php echo $v['name']; ?></li>
                <?php } ?>
            </ul>
     
    </div></div>
  <div class="pop-sub abe-txtc">
    <input type="submit" value="选择" class="btn btn-org mrg_10" onclick="_asr.returnPopup('<?php echo ($funcid); ?>');">
    <input type="submit" value="取消" class="btn" onclick="_asr.closePopup('<?php echo ($funcid); ?>');">
  </div>
  <script>
      function <?php echo ($funcid); ?>_show(_t) {
          if($(_t).attr("data-id") == 0) {
              return false;
          }
          $("#<?php echo ($funcid); ?> .trees-nav ul li").removeClass("active");
          $(_t).parent().addClass("active");
          var _this = $(_t).parent();
          if(_this.attr("expand") == "1") return true;
          _this.attr("expand", "1");
          var url = "<?php echo U('/Home/Popup/index?func=QuestionCategoryTree&excludeId='.$excludeId.'&selecttype='.$selecttype.'&onlyData=1');?>";

          $.ajax({
              type:"GET",
              url:url,
              dataType : 'text',
              data:{parent_id:$(_t).attr("data-id")},
              success: function(c) {
                  c = eval("(" + c + ")");
                  if(c.length == 0) return false;
                  var html = "<li><ul>";
                  for(var s in c) {
                      html += '<li><input j=\'' + JSON.stringify(c[s]) + '\' data-id="'+c[s]["id"]+'" type="<?php echo (strtolower($selecttype)== 'multi'?'checkbox':'radio'); ?>" name="code[]" value="'+c[s]["code"]+'" show="'+c[s]["full_path"]+'">'+c[s]["name"]+'</li>';
                  }
                  html += "</ul></li>";
                  $(html).insertAfter(_this);
                  <?php echo ($funcid); ?>_unbind();
                  <?php echo ($funcid); ?>_bind();
              },
              error: function(e) {

              }
          });
      }
      function <?php echo ($funcid); ?>_bind() {
          $("#<?php echo ($funcid); ?> .trees-nav ul li input").click(function(){
              <?php echo ($funcid); ?>_show($(this));
          });
      }

      function <?php echo ($funcid); ?>_unbind() {
          $("#<?php echo ($funcid); ?> .trees-nav ul li input").unbind();
      }
      <?php echo ($funcid); ?>_bind();

      $(function() {
          $("#<?php echo ($funcid); ?>-Search").bind("keyup", function() {
              var _serachText = $(this).val();
              $("#<?php echo ($funcid); ?> div.trees-nav-pop li").each(function() {
                  if(_serachText == "") {
                      $(this).show();
                  } else {
                      if($(this).text().indexOf(_serachText) >= 0) {
                          $(this).show();
                          var _attr = $(this).find("input").attr("j");
                          while(_attr != undefined && _attr != "") {
                              var _json = eval("(" + _attr + ")");
                              if(_json["parent_id"] == 0) {
                                  break;
                              }
                              var _parent = $("#<?php echo ($funcid); ?> div.trees-nav-pop li input[data-id=" + _json["parent_id"] + "]");
                              if(_parent.size() == 0) {
                                  break;
                              }
                              _parent.parent().show();
                              _attr = _parent.attr("j");
                          }
                      } else {
                          $(this).hide();
                      }
                  }
              });
              if(_serachText != "") {
                  $("#<?php echo ($funcid); ?> div.trees-nav-pop li").each(function() {
                      if($(this).css("display") == "none") {
                          return true;
                      }

                      var _next = $(this).next();
                      var _id = $(this).find("input").eq(0).attr("data-id");
                      if(_next.size()>0) {
                          var _attr = _next.find("input").eq(0).attr("j");
                          var _json = eval("(" + _attr + ")");
                          if(_json["parent_id"] == _id) {
                              _next.find("li").show();
                          }
                      }
                  });
              }
          });
      });
  </script>
</div>