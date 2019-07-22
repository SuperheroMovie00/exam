/**
 * Created by Huajie on 2016/11/7.
 */
function Lucky(tpl,title) {
    this.tpl = tpl;
    this.title = title;
    this.randomId=parseInt(100000000*Math.random());
    this.form_id="form_"+this.randomId+Date.parse(new Date());
    this.isErr=false;
    this.dealUrl=undefined;
    this.z_index=1000;
    if(Lucky._init==undefined) {
        Lucky._init = 1;

        Lucky.prototype.create = function(js,only_load){
            this.dynamicLoadScript(js);
            if(!only_load){
                var html=this.createTitle();
                html+=this.createList();
                html+=this.createTail();
                return html;
            }
        };
        Lucky.prototype.dynamicLoadScript = function(url) {

            if(url==undefined)
                return false;

            if(url.match(/.*Dynamic/)==null)
                return false;

            this.dealUrl=url;
            $("script[src='"+url+"']").remove();
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = url;
            document.head.appendChild(script);
        }

        Lucky.prototype.createTitle = function(){
          return '<div class="prompt-pop" style="display: none;z-index:'+this.z_index+';"><form id="'+this.form_id+'" method="post"><input type="hidden" name="__ajax" value="1" /><div class="title"><span class="pop-name">'+this.title+'</span><a href="javascript:void(0);" class="close iconfont">&#xe60d;</a></div><input type="hidden" name="lucky_form_id" value="'+this.form_id+'" /> ';
        };

        Lucky.prototype.createTail = function(){
            return '<div class="pop-sub abe-txtc"><input type="submit" value="保存" class="btn btn-org mrg_10"><input type="button" value="取消" class="btn"></div></form></div>';
        };

        Lucky.prototype.createList = function(){
            return '<ul class="pbform">'+this.createListBody()+'</ul><div class="blank60"></div>'
        };

        Lucky.prototype.createListBody = function(){
            var html='';
            for(var k in this.tpl){
                html+='<li '+(this.tpl[k].display===false?'style="display:none;"':'')+' ><span class="tit"><em class="abe-red mrg_5">'+(this.tpl[k].require?'*':'')+'</em>'+this.tpl[k].label+'</span><div class="txt-box">'+this.createComponents(this.tpl[k],k) +'</div></li>'
            }
            return html;
        };

        Lucky.prototype.createComponents = function(tpl,k){
            var html='';
            switch (tpl.input.type){
                case 'text':
                    html+=this.createComponentsInputText(tpl,k);
                    break;
                case 'hidden':
                    html+=this.createComponentsInputHidden(tpl,k);
                    break;
                case 'password':
                    html+=this.createComponentsInputPassword(tpl,k);
                    break;
                case 'textarea':
                    html+=this.createComponentsTextArea(tpl,k);
                    break;
                case 'select':
                    html+=this.createComponentsSelect(tpl,k);
                    break;
                case 'search':
                    html+=this.createComponentsSearch(tpl,k);
                    break;
                case 'date':
                    html+=this.createComponentsDate(tpl,k);
                    break;
                case 'label':
                    html+=this.createComponentsLabel(tpl,k);
                    break;
                case 'html':
                    html+=this.createComponentsHtml(tpl,k);
                    break;
            }

            if(tpl.update===false && tpl.input.type != 'label'){
            	if(tpl.notips===true ){            		
            	}else{
            		html+='<div class="prompt"><div class="error"><i class="iconfont"></i>'+tpl.label+'一经保存将不能修改</div> </div>'
            	}
            }
            return html;
        };

        Lucky.prototype.createComponentsInputText = function(tpl,k){
            var nameId=this.getFormId()+"_"+k;
            return '<input type="text" '+(tpl.readonly?'readonly="readonly"':'')+' class="pbtxt" name="'+nameId+'" value="'+tpl.input.default_value+'" />';
        };

        Lucky.prototype.createComponentsInputHidden = function(tpl,k){
            var nameId=this.getFormId()+"_"+k;
            return '<input type="hidden"'+(tpl.readonly?'readonly="readonly"':'')+' class="pbtxt" name="'+nameId+'" value="'+tpl.input.default_value+'" />';
        };

        Lucky.prototype.createComponentsInputPassword = function(tpl,k){
            var nameId=this.getFormId()+"_"+k;
            return '<input type="password" '+(tpl.readonly?'readonly="readonly"':'')+' class="pbtxt" name="'+nameId+'" value="'+tpl.input.default_value+'" />';
        };

        Lucky.prototype.createComponentsSearch = function(tpl,k){
            var nameId=this.getFormId()+"_"+k;
            var nameShow=nameId+"_name";
            return '<div class="txt-search-box"><input type="text" readonly="readonly" class="pbtxt" name="'+nameShow+'" value="'+(tpl.input.value.show==null?'':tpl.input.value.show)+'" />'+'<input type="hidden" class="pbtxt" name="'+nameId+'" value="'+tpl.input.default_value+'" />'+(tpl.readonly?'':
            	'<button type="submit" class="txt-search" onclick=" return '+tpl.input.value.callback.replace("#form_id#",this.getFormId()).replace("#show_id#",nameId).replace("#show_name#",nameShow)+'"><i class="iconfont">&#xe60e;</i></button>')+
            	'<button type="submit" class="txt-clear" onclick="_asr.setvaluebyname(\''+this.getFormId()+'\',\''+nameId+'\',\'\');_asr.setvaluebyname(\''+this.getFormId()+'\',\''+nameShow+'\',\'\');return false;" style="display:none"><i class="iconfont">&#xe616;</i></button>'+'</div>';//'+nameShow==""?'style="display:none"':''+'
        };

        Lucky.prototype.createComponentsDate = function(tpl,k){
            var nameId=this.getFormId()+"_"+k;
            return '<input type="text" '+(tpl.readonly?'readonly="readonly"':'')+' class="pbtxt luckyDate" name="'+nameId+'" value="'+tpl.input.default_value+'" />';
        };

        Lucky.prototype.createComponentsLabel = function(tpl,k){
        	if(tpl.input.value!==undefined){
        		if(tpl.input.value.show!==undefined && tpl.input.value.show!=null){
        			return '<span>'+tpl.input.value.show+'</span>';   
        		}else{
        			return '<span></span>';
        		}
        	}else{
        		return '<span>'+tpl.input.default_value+'</span>'; 
        	}
        };

        Lucky.prototype.createComponentsHtml = function(tpl,k){
            return tpl.input.default_value;
        };

        Lucky.prototype.createComponentsSelect = function(tpl,k){
            var nameId=this.getFormId()+"_"+k;
            var html = '<select'+(tpl.readonly?' disabled="disabled"':'')+' class="pbsele" name="'+nameId+'">';

            for(kk in tpl.input.value){
                html+='<option value="'+kk+'" '+(kk==tpl.input.default_value?'selected':'')+' >'+tpl.input.value[kk]+'</option>'
            }
            return html+'</select>';

        };

        Lucky.prototype.createComponentsTextArea = function(tpl,k){
            var nameId=this.getFormId()+"_"+k;
            return '<textarea'+(tpl.readonly?' readonly="readonly"':'')+' class="pbtextarea" name="'+nameId+'">'+tpl.input.default_value+'</textarea>';
        };

        Lucky.prototype.close = function(type){
            var id='';
            if(type==2)
               id=document.getElementById(this.getAlertId());
            else if(type==1){
               id=document.getElementById(this.form_id);
            }

            if(id && id.parentNode){
                var node=id.parentNode;
                node.parentNode.removeChild(node);
            }

        };

        Lucky.prototype.getFormId = function(){
            return this.form_id
        };

        Lucky.prototype.getAlertId = function(){
            return "alert_"+this.randomId;
        };

        Lucky.prototype.alert = function(title,msg,type,tip,btn){
            this.isErr=false;
            var cls='ok-pop';
            var ico="&#xe615;";
            if(type.toUpperCase()=="ERROR"){
                cls="error-pop";
                ico="&#xe614;";
                this.isErr=true;
            }else if(type.toUpperCase()=="DEFAULT"){
                cls="oper-pop";
                ico="&#xe614;";
            }

            return '<div class="prompt-pop oper-pop '+cls+'" style="z-index:'+this.z_index+';" ><div  id="alert_'+this.randomId+'"><div class="title"><span class="pop-name">'+title+'</span><a href="javascript:void(0);" class="close iconfont">&#xe60d;</a> </div><div class="oper-info"><div> <i class="iconfont">'+ico+'</i>'+msg+'</div><p>'+(tip==undefined?'&nbsp;':tip)+'</p></div><div class="oper-sub abe-txtc pdt_30"><input type="submit" value="确定" class="btn btn-org mrg_10">'+(btn?'<input type="button" value="取消" class="btn">':'')+'</div></div></div>';
        };

    }
}