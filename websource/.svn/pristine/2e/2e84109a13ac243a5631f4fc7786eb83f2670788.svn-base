// JavaScript Document
/*
× JQuery XYMarquee 插件
× email tugenhua@126.com
* date 2011 11 29
* @ example 
* $("#example").XYMarquee({
 *        next : "next",
 *        prev : "prev"                         
 *  })
  **********************************************************************
 *jMarquee o参数可配置项：
* _direction : left || top ,设置滚动方向 （向左或者向上）默认为向左滚动
* _btnNext : 下翻页的ID名称
* _btnPrev : 上翻页的ID名称
* _auto : 布尔值(true为自动滚动,false为手动滚动,默认为true);
* _item : 设置每次滚动元素的个数(默认滚动所有可见部分)
* _speed : 设置每次滚动动画执行时间(单位为毫秒，默认为1000);
* _time : 设置每次动画执行的间隔时间(单位为毫秒 默认为3000);
 **********************************************************************
 *完整的html代码结构：
 *<div id="example">
 *    <div class="scroll">
 *         <ul>
 *           <li></li>
 *           <li></li>
 *           <li></li>
 *           <li></li>
 *         </ul>
 *    </div>
 *    <span class="prev">前一个</span>
 *    <span class="next">下一个</span>
 *</div>
 **********************************************************************
 * 一定要按照我这种结构的话来写代码 否则的话 js无效
 * 本来下面传参 一般情况下用$符合  但是为了我以后在淘宝页面引用js 所以我用了KK 目的是为了防止与淘宝框架KISSY 中的$冲突
 × 此组件 希望可视区的图片数量<总图片数量(可视区图片+隐藏的图片) 这样的效果很好 否则的话 滚动时会有一点点的不怎么美观 
*/
;(function(kk) {
	kk.fn.extend({
		XYMarquee : function(o){
			var defaults = {
				_direction : "left",
				_btnNext : "prev",
				_btnPrev : "next",
				_auto : true,
				_item : null,
				_speed : "1000",
				_time : "3000"	
			};
			var obj = kk.extend(defaults,o);
			return this.each(function(){
				var timer;
				var marquee = true,_self = kk(this),kkWrap = kk("div",_self),kkParent = kk("li",kkWrap).parent(); //获取当前的函数 函数中的最外层div ul
				var count = obj._direction =="left" ? Math.floor(kkWrap.width()/ kk("li", kkWrap).outerWidth()):Math.floor(kkWrap.height() / kk("li", kkWrap).outerHeight()); //定义一个变量count 如果向左的话 那么用	最外层的div的宽度/li的最外层宽度  高度同理
				if(obj._item){count = obj._item;}  //count滚动数量 通过_item赋值
				if(obj._direction =="left"){
					kkParent.css("width",kkWrap.width()*2 + "px");	//如果对象是向左移动的话 那么我让ul的宽度×2
				}else{
					kkParent.css("height",kkWrap.height()*2 + "px"); //如果对象是向上滚动的话 让ul的高度×2 目的是为了循环滚动
				}
				kkWrap.css("overflow","hidden");  //给最外层的div添加overflow:hidden;
				var kkValue = obj._direction =="left" ? kk("li",kkWrap).outerWidth()*count : kk("li",kkWrap).outerHeight()*count;
				// 定义一个变量 如果滚动是向左的话 那么滚动值 是li的宽度×要滚动多少个 同理 如果是向上的话 那么获取li最外层的高度×要滚动多少个
				function scrollNext(){
					if(marquee){
						marquee = false; //这是为了 当我鼠标点击向下按钮时候 让默认滚动停下来 做我点击向下按钮的触发函数
						if(obj._direction == "left"){
							kkParent.animate({
								marginLeft:	-kkValue
							},obj._speed,function(){
								var kkTempWrap = kk("li",kkWrap).slice(0,count); //提取li的个数
								kkParent.append(kkTempWrap); //追加ul后面
								kkParent.css("marginLeft",0); //当父类ul滚动到0时候 也就是li最后一个时候 让marquee = true 那么他又执行上面的false 那么就向左循环滚动了
								marquee = true;
							});	
						}else{
							kkParent.animate({
								marginTop : -kkValue	
							},obj._speed,function(){
								var kkTempWrap = kk("li",kkWrap).slice(0,count);
								kkParent.append(kkTempWrap);
								kkParent.css("marginTop",0);
								marquee = true;	
							});	
						}
							
					}	
				};
				<!-- 向下滚动结束 -->
				
				function scrollPrev(){
					if(marquee){
						var kkTempWrap = kk("li",kkWrap).slice( - count);	//获取li向左滚动的总数量
						marquee = false;
						kkParent.prepend(kkTempWrap);
						if(obj._direction =="left"){
							kkParent.css("marginLeft",-kkValue);
							kkParent.animate({marginLeft : 0},obj._speed,function(){
								marquee = true;	
							});
						}else{
							kkParent.css("marginTop",-kkValue);	
							kkParent.animate({
								marginTop : 0	
							},obj._speed,function(){
								marquee = true;	
							});
						}
					}	
				};
				<!-- 向上滚动结束 -->
				function stopMarquee(){
					clearInterval(timer);	
				}
				<!-- 停止滚动结束 -->
				function autoPlay(){
					timer = setInterval(scrollNext,obj._time);	
				}
				<!-- 开始滚动结束 -->
				if(obj._auto){
					kkWrap.hover(function(){
						stopMarquee();	
					},function(){
						autoPlay();	
					});
					kk("#" + obj._btnPrev, _self).hover(function() {
                        stopMarquee();
                    },function() {
                        autoPlay();
                    });
                    kk("#" + obj._btnNext, _self).hover(function() {
                        stopMarquee();
                    },function() {
                        autoPlay();
                    });
                    autoPlay();
                }
                kk("#" + obj._btnPrev, _self).click(scrollPrev);
                kk("#" + obj._btnNext, _self).click(scrollNext);	
			});	
		}	
	});
})(jQuery);