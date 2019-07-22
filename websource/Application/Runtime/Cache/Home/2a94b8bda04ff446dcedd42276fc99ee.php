<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>学业水平测试题库系统</title>
<link rel="shortcut icon" href="/Public/css/images//favicon.ico" type="image/x-icon" /> 
<link type="text/css" rel="stylesheet" href="/Public/css/Common/index.css?t=<?php echo time(); ?>">
    <link type="text/css" rel="stylesheet" href="/Public/css/Common/exam.css?t=<?php echo time(); ?>">
<link type="text/css" rel="stylesheet" href="/Public/css/Common/reset.css">
<link type="text/css" rel="stylesheet" href="/Public/css/Common/foundation-datepicker.min.css">
<script type="text/javascript" src="/Public/javascript/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/Public/javascript/common.js?t=<?php echo time(); ?>"></script>
<script type="text/javascript" src="/Public/javascript/Lucky.js"></script>
<script type="text/javascript" src="/Public/form/js/basic.js"></script>
<script type="text/javascript" src="/Public/javascript/area.js"></script>
<!--<script type="text/javascript" src="/Public/javascript/foundation-datepicker.min.js"></script>-->
<!--<link rel="stylesheet" type="text/css" href="/Public/javascript/flatpickr/flatpickr.min.css">-->
<!--<script src="/Public/javascript/flatpickr/flatpickr.min.js"></script>-->
    <!--<script src="/Public/javascript/flatpickr/flatpickr.l10n.zh.js"></script>-->
    <script type="text/javascript" src="/Public/javascript/pickmeup/pickmeup.js"></script>
    <script type="text/javascript" src="/Public/javascript/pickmeup/pickmeup.zh.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/javascript/pickmeup/pickmeup.css">


    <!--[if lt IE 9]>
<script src="http://apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script>


<![endif]-->
</head>

<body>
<iframe id="ajaxframe" name="ajaxframe" style="display:none"></iframe>
<div class="popup-bg" id="mask" style="display:none;z-index:99999999"></div>
<div class="popup-bg-layer"  id="mask1" style="display:none;"></div>
<div class="pop-scroll-box"  style="display:none;"></div>
<div class="prompt-pop oper-pop ok-pop error-pop" style="display:none;;z-index:300000000" id="confirm">
  <div class="title">
  	<span class="pop-name"></span>
  	<a href="javascript:void(0);" class="close iconfont confirm-cancel">&#xe60d;</a>
  </div>
  <div class="oper-info">
    <div><i class="iconfont">&#xe614;</i></div>
    <p></p>
  </div>
  <div class="oper-sub abe-txtc pdt_30">
  <form>
    <input type="submit" value="确定" class="btn btn-org mrg_10 confirm-submit">
    <input type="button" value="取消" class="btn confirm-cancel">
    <input type="hidden" name="reset-funcid" value="1" />
  </form>
  </div>
</div>
<div class="prompt-pop oper-pop ok-pop error-pop" style="display:none;z-index:300000000" id="message">
  <div class="title">
  	<span class="pop-name"></span>
  	<a href="javascript:void(0);" class="close iconfont confirm-cancel">&#xe60d;</a>
  </div>
  <div class="oper-info">
    <div><i class="iconfont">&#xe614;</i><span></span></div>
    <p></p>
  </div>
  <div class="oper-sub abe-txtc pdt_30">
  <input type="button" value="确定" class="btn btn-org mrg_10 message-ok">
  </div>
</div>

<div class="prompt-pop" style="display:none;z-index:100000000" id="export">
	<div class="title"> <span class="pop-name">数据导出</span><a class="close iconfont">&#xe60d;</a> </div>
	<div class="table-in table-in-pop pdl_40 pdr_40">
    <div class="blank20"></div>
    <table border="0" cellspacing="0" cellpadding="0" class="pub-table">
      <colgroup>
      <col >
      </colgroup>
      <tbody>
        <tr>
          <th class="abe-txtl">选择数据导出方式</th>
        </tr>
        <tr class="even">
          <td class="abe-txtl"><input type="radio" name="export-option" value="1" /> 只导出当前页内数据（缺省） </td>
        </tr>
        <tr class="odd">
          <td class="abe-txtl"><input type="radio" name="export-option" value="0" /> 导出全部页内数据（数据量过大可能会造成服务器卡死）</td>
        </tr>
      </tbody>
    </table>
    <div class="blank50"></div>
    <div class="blank50"></div>
    <div class="oper-sub abe-txtc pdt_30">
      <input type="button" value="确定" class="btn btn-org mrg_10 export-ok">
      <input type="button" value="取消" class="btn export-cancel">
    </div>
  </div>
</div>
<div class="main">
  <header class="header">
    <h1 class="sys-logo abe-fl"></h1>
      <!--
          <?php if(session('CUSTOMER_ID')):?>
          <div class="sys-name"><em class="abe-space"></em><span>使用方: <?php echo ($user['customer_name']); ?></span></div>
    <?php endif; ?>
      -->
      <div class="user-info abe-fr"> <span><?php if(session('CUSTOMER_ID')):?><a href="javascript:void(0);" onclick="return _asr.popupFun('<?php echo U('/Home/Retail/index?func=add'); ?>');" class="btn btn-xs btn-org mrg_10" style="line-height: 18px;">简易划价计算</a><?php endif; ?><em class="vi-blue"><?php echo ($user['name']); ?></em>，您好！</span>
    <a href="javascript:void(0);" class="uhead"><img src="/Public/css/images/uhead.png" alt=""  onerror="this.src='/Public/Home/css/images/uhead.png'"></a><a href="javascript:void(0);" onclick="return _asr.popupFun( '<?php echo U("User/index?func=changepassword") ?>','<?php echo filterFuncId("User/changepassword","");?>'); " class="vi-blue mrg_15" >更改密码</a><a href="/index.php/Home/Auth/logout" class="quit vi-red">退出<i class="iconfont">&#xe610;</i></a> </div>
  </header>
  
  <nav class="nav"> <a href="javascript:void(0);" class="logo"></a>
  	<ul class="par-menu">
        <li class="active" id="menu">
        	<a href="javascript:void(0);" class="show-nav"><div class="item"><i class="iconfont">&#xe60c;</i><em><?php if(count($f_menu) > 0) echo $f_menu[0]["title"]; else echo "菜单" ?></em></div></a>
        	<i class="iconfont hidico" id="hid-btn">&#xe617;</i>
            <ul>
                <?php if(is_array($f_menu)): foreach($f_menu as $key=>$vo): if (!($vo['is_admin'] == 1 && session(C("USER_AUTH_KEY"))!='admin')){ ?>
                    <li data-value="<?php echo ($vo['id']); ?>" ><a href="javascript:void(0);"><i class="iconfont"><?php echo ($vo['ico']); ?></i><em><?php echo ($vo['title']); ?></em></a></li>
                    <?php } endforeach; endif; ?>
            </ul>
        </li>
    </ul>
      <?php if(is_array($f_menu)): foreach($f_menu as $key=>$vo): ?><ul data-parent-value="<?php echo ($vo['id']); ?>" class="par-sub-menu"  style=" height:100%; overflow:auto;<?php if($key!=0){ ?>display:none;<?php } ?>"  >
        <?php if(is_array($s_menu)): foreach($s_menu as $key=>$vo2): if(($vo2['pid'] == $vo['id'])): if (!($vo2['is_admin'] == 1 && session(C("USER_AUTH_KEY"))!='admin')){ ?>

                <li>
            <div class="item"><a href="javascript:void(0);"><i class="iconfont">&#xe618;</i><em><?php echo ($vo2['title']); ?></em></a></div>
            <ul style="display:<?php echo $vo2['default_open']=='1'?'block':'none'; ?>" >
                <?php if(is_array($t_menu)): foreach($t_menu as $key=>$vo3): if(($vo3['pid'] == $vo2['id'])): if ($vo3['name'] == "-" || $vo3['title'] == "-"){ ?>
                        <li class="sep-line"/>
                        <?php } else { ?>
                        <?php if (!($vo3['is_admin'] == 1 && session(C("USER_AUTH_KEY"))!='admin')){ ?>
                        <li><a href="<?php if(trim($vo3['module']) != ''): echo U($vo3['module']); endif; ?>" data-type="<?php echo trim($vo3['model']) == ''?'link':$vo3['model'];?>" data-value="<?php echo ($vo3['name']); ?>"><i class="iconfont">&#xe60c;</i><em><?php echo ($vo3['title']); ?></em></a></li>
                        <?php } ?>
                        <?php } endif; endforeach; endif; ?>
            </ul>
        </li>
          <?php } endif; endforeach; endif; ?>

    </ul><?php endforeach; endif; ?>
      <?php if($notice_open && $notice_title) { ?>
    <div class="rolling-news">
         <a href="javascript:void(0);" onclick="return _asr.openLink('<?php echo U("/Home/Notice/index?func=view");?>', 'notice_show', '<?php echo ($notice_title); ?>', 0)"><?php echo ($notice_title); ?></a>
    </div>
      <?php } ?>
    <div class="icp">
      版权所有  Copyright © 2010-2018 </div>
  </nav>
  <script>
  function showpop(url)
  {
	    _asr.showMask();
		_asr.loadData('', url, "", function(c) {
			$(".prompt-pop").remove();
			$(".pop-scroll-box").append(c);
			$(".pop-scroll-box").show();
			$(".prompt-pop").each(function(){
				var ppw = $(this).width()/2;
				$(this).css({'margin-left':-ppw});			
			});
		});
  }
  $(function(){
      $(".par-sub-menu li:first").attr('data-visable',1).children("ul").show();
      $(".par-sub-menu li").click(function(){
          var status=parseInt($(this).attr('data-visable'));
          if(!status){
              $(this).attr('data-visable',1);
              $(this).children("ul").slideDown();
          }else{
              $(this).attr('data-visable',0);
              $(this).children("ul").slideUp();
          }
          $(".par-sub-menu li").removeClass("active");
          $(this).addClass("active");

      });


  })
  </script>
  <div class="content">
  <div class="win-tab">
      <ul>
        <li class="win-tab-menu" style="display: none;">
        <i class="iconfont">&#xe673;</i>
        <dl>
        </dl>
        </li>
      </ul>
  </div>
      <!--窗口切换-->
      <div class="wrap-box home-bg" id="home-bg">
          <div class="stel" style="font-size: 32px; position: absolute; left: 50px; bottom: 65px;line-height: 40px; color: #0076b4; font-weight: 400;">

              <sub style="font-size: 32px; bottom: 2px;">服务热线</sub><br>021-88888888 转 1234

          </div>
          <div class="sys-tit"><img src="/Public/css/images/sys-bg-wz.png" alt=""></div>
      </div>
      
  </div>
</div>
<div class="popup-bg" id="pop-background" style="display:none;"></div>
<div class="loader-box" style="z-index:100000000">
            <div class="loader">
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
            </div>
          </div>
</body>

</html>