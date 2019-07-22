/**
 * Created by Huajie on 2016/11/8.
 */
var _asr2=[];
(function(){
    _asr2 ={

        getZindexMax:function(){
            var z_index=0;
            $('.prompt-pop').each(function(i,e){
                if(!$(e).is(":hidden") && parseInt($(e).css('z-index'))>z_index){
                    z_index=parseInt($(e).css('z-index'));
                }
            });
            z_index+=100000;
            return z_index;
        },

        getPopup:function(id,title,get_url,set_url,callback,before_callback){
            var z_index=_asr2.getZindexMax();
            $('#pop-background').css("z-index",z_index).show();
            var tp=typeof (callback);
            var js=undefined;
            var bf_tp=typeof (before_callback);
            var bf_js=undefined;
            var rand=Math.random();
            if(tp=='string'){
                js="/Public/form/js/"+callback+".js?rand="+rand;
            }

            if(bf_tp=='string'){
                bf_js="/Public/form/js/"+before_callback+".js?rand="+rand;
            }

            $.ajax({
                url:get_url,
                type:'get',
                dataType:'json',
                data:{id:id,__ajax:1},
                success:function(content) {
                    var l=new Lucky(content,title);
                    l.z_index=z_index;
                    $('body').append(l.create(js));
                    $('body').append(l.create(bf_js,true));
                    var node = $('#'+l.getFormId()).parent();
                    var ppw = node.width()/2;
                    node.css("margin-left",-ppw);
                    node.show();
                    if(set_url){

                        if(bf_tp!='undefined' && bf_tp!='null'){
                            if(bf_tp=='string'){
                                if($.trim(before_callback)){
                                    before_callback= eval($.trim(before_callback));
                                    before_callback(l);
                                }
                            }else if(bf_tp=='function'){
                                if(before_callback.name!=''){
                                    if(before_callback!=undefined)
                                        before_callback(l);
                                }
                            }else{
                                before_callback();
                            }
                        }


                        _asr2.setPopup(l,set_url,callback);
                        var nowTemp = new Date();
                        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

                        $('#'+l.getFormId()+' .luckyDate').on('click',function(){
                            var now = new Date;
                            if($('.date').length>0)
                                pickmeup('.date').destroy();
                            $('.date').removeClass('date')
                            $(this).addClass('date');
                            pickmeup('.date', {
                                format	: 'Y-m-d',
                                date : $(this).val(),
                                locale : 'zh',
                                hide_on_select : true
                            }).show();
                        });
                    }else{
                        node.find('input[type="submit"]').remove();
                        node.on('click','input[type="button"]',function(){
                            $('#pop-background').hide();
                            l.close(1);
                            if(l.dealUrl)
                                $("script[src='"+l.dealUrl+"']").remove();
                        });

                        node.on('click','a.close ',function(){
                            $('#pop-background').hide();
                            l.close(1);
                            if(l.dealUrl)
                                $("script[src='"+l.dealUrl+"']").remove();
                        });
                    }
                    
                    _asr.calcpop();
                }
            });
        },
        setPopup:function(l,set_url,callback){
            var node = $('#'+l.getFormId()).parent();
            node.on('click','input[type="submit"]',function(){

                $.ajax({
                    url:set_url,
                    type:'post',
                    dataType:'json',
                    data:$('#'+l.getFormId()).serialize(),
                    success:function(content) {

                        var tp=typeof (callback);
                        var needAlert=true;

                        if(tp=='string'){
                            needAlert=!(callback.indexOf("nonAlert") > -1);
                        }else if(tp=='function'){
                            if(callback.name!=''){
                                needAlert=!(callback.name.indexOf("nonAlert") > -1);
                            }else{
                                needAlert=false;
                            }
                        }

                        if(needAlert){
                            var msgBox="";
                            if(content.is_err==1){
                                node.hide();
                                msgBox = l.alert('操作失败',content.msg,'error');
                            }else if(content.is_err==0){
                                msgBox = l.alert('操作成功',content.msg,'ok','接下来您可继续其他操作');
                                node.hide();
                            }else{

                                var msg=content.msg
                                if(typeof (msg)=='undefined'){
                                    msg=content.error.input.default_value
                                }

                                msgBox = l.alert('操作失败','操作失败','default',msg,false);
                                node.hide();
                            }
                            $('body').append(msgBox);
                            _asr2.dealLuckyAlert(l,callback);
                        }else{
                            if(tp=='string'){
                                if($.trim(callback)){
                                    callback= eval($.trim(callback));
                                    callback(l);
                                }
                            }else{
                                callback();
                            }
                        }


                    }
                });
                return false;
            });
            node.on('click','input[type="button"]',function(){
                $('#pop-background').hide();
                l.close(1);
                if(l.dealUrl)
                    $("script[src='"+l.dealUrl+"']").remove();
            });

            node.on('click','a.close ',function(){
                $('#pop-background').hide();
                l.close(1);
                if(l.dealUrl)
                    $("script[src='"+l.dealUrl+"']").remove();
            });
        },
        dealLuckyAlert:function(l,callback){
            var z_index=_asr2.getZindexMax();
            l.z_index=z_index;
            var ppw = $('#'+l.getAlertId()).parent().width()/2;
            $('#'+l.getAlertId()).parent().css('margin-left',-ppw);
            var tp=typeof (callback);

            if(tp=='string'){
                if($.trim(callback)){
                    callback= eval($.trim(callback));
                    callback(l);
                }
            }else if(tp=='function'){
                if(callback.name!=''){
                    if(callback!=undefined)
                        callback(l);
                }
            }
        },
        confirmPopup:function(id,title,set_url,msg,tip,btn,callback){
        	set_url=set_url.replace('.html',"/id/"+id+".html");
        	if(typeof(msg) == 'undefined' || msg == '') msg = "确认要删除数据吗？";
        	return _asr.confirm(title, msg, tip, set_url, callback);
        	
        	
            var l=new Lucky('',title);
            var z_index=_asr2.getZindexMax();
            l.z_index=z_index;
            $('#pop-background').css("z-index",z_index).show();

            msg=(msg?msg:'确认要删除数据吗？');
            tip=(tip?tip:'');
            btn=(btn?true:false)
            var msgBox = l.alert(title,msg,'error',tip,btn);
            $('body').append(msgBox);
            var node = $('#'+l.getAlertId()).parent();
            var ppw = node.width()/2;
            var pph = node.height()/2;
            node.css('margin-left',-ppw);
            node.css('margin-top', -pph);
            node.show();
            _asr.calcpop();
            set_url=set_url.replace('.html',"/id/"+id+".html")
            node.on('click','input[type="submit"]',function(){
                _asr.loadData(undefined,set_url,this,function(){
                    $('#pop-background').hide();
                    l.close(2);
                    if(l.dealUrl)
                        $("script[src='"+l.dealUrl+"']").remove();
                    if(callback != undefined){
                        _asr2.dealLuckyAlert(l,callback);
                    }
                });
            });
            node.on('click','input[type="button"]',function(){
                $('#pop-background').hide();
                l.close(2);
                if(l.dealUrl)
                    $("script[src='"+l.dealUrl+"']").remove();
            });

            node.on('click','a.close ',function(){
                $('#pop-background').hide();
                l.close(2);
                if(l.dealUrl)
                    $("script[src='"+l.dealUrl+"']").remove();
            });},
        slideSwitch:function(o){
            var checkbox=$(o).parent().find('.mn-ck')
            if(checkbox.is(':checked')){
                $(o).removeClass('check-xz')
            }else{
                $(o).addClass('check-xz')
            }
        }
    }
})();

$(function(){
    for(a in _asr2){
        _asr[a]=_asr2[a];
    }
})

