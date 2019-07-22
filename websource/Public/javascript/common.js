var _asr = [];
(function(){
	_asr = {
		nav_seed: 0,
		zindex: 2000,
		srcElement: null,
		popupcall: new Array(),
		submitpool: new Array(),
		//host: "http://106.14.62.211",
		host_array: window.location.href.match(/http:\/\/\S+?\/{1}/),
		host: "",
		skip: [],
		index:"/index.php/Home/Index/index",
		viewParamList: {},
		init: function() {
			this.host = this.host_array && this.host_array.length > 0 ? this.host_array[0].substring(0, this.host_array[0].length - 1) : window.location.href;
			this.skip = [this.host ,"/index.php/Home/Index/index", "/index.php/Home/Auth/login"];
			var _this = this;
			$("#menu").click(function() {
				var _ul = $(this).find("ul");
				if(_ul.css("display") == "none") {
					_ul.css("display", "block");
				} else {
					_ul.css("display", "none");
				}
			});
			
			$("#menu ul li").click(function() {
				$(".par-sub-menu").hide();
				var _data_value = $(this).attr("data-value");
				var _name = $(this).find("em").html();
				$("#menu .show-nav em").html(_name);
				var _show_ul = $(".par-sub-menu[data-parent-value=" + _data_value + "]");
				_show_ul.show();
				var _show_li = _show_ul.find("li").eq(0);
				if(_show_li.attr("data-visable") != "1") {
					_show_li.trigger("click");
				}
				
				//var _index = $("#menu ul li").index(this);
				//$(".par-sub-menu").eq(_index-1).show();
			});
			
			$("#hid-btn").click(function(){
				$(".main").toggleClass( "main-hid", 1000 );
				$(this).toggleClass( "hid-faq", 1000 );
			    return false;
			});
			
			$("a[data-type=link]").click(function() {
				var _that = $(this);
				$(".popup-bg").hide();
				_this.openLink(_that.attr("href"), _that.attr("data-value"), _that.find("em").html(), 1);
				return false;
			});
			
			$("a[data-type=pop]").click(function() {
				var _that = $(this);
				_this.popupFun(_that.attr("href"), _that.attr("data-value"));
				//_this.openLink(_that.attr("href"), _that.attr("data-value"), _that.find("em").html(), 0);
				return false;
			});
			
			if(window.location.href != this.host && window.location.href != this.host + "/") {
				var _op_ = this.getUrlParam("_op_");
				if(_op_ == this.host || _op_ == this.host + "/") _op_ = "";
				if(_op_ && _op_.indexOf( this.host + this.index) == 0) _op_ = "";
				if(_op_) {
					var oparray = _op_.split("/");
					var opurl = "";
					var max = oparray[0] == "" ? 7 : 6;
					for(var i = 0; i < max; i++) {
						if(oparray[i] == "") continue;
						opurl += "/" + oparray[i];
					}
					if(opurl.indexOf(".html") < 0)
						opurl += ".html";
					var menu = $(".par-sub-menu a[href='" + this.filterId(opurl) +"']");
					if(menu.size() > 0) {
						var reg = new RegExp("(&|[\?]|\/)funcid(=|\/)[\\w|\\d|_]+", "g");
						_op_ = _op_.replace(reg, "");
						
						var parent_id = menu.parents("ul.par-sub-menu").attr("data-parent-value");
						
						$(".par-sub-menu").hide();
						var _name = $("#menu li[data-value="+parent_id+"]").find("em").html();
						$("#menu .show-nav em").html(_name);
						var _show_ul = $(".par-sub-menu[data-parent-value=" + parent_id + "]");
						_show_ul.show();
						
						var subli = menu.parent().parent().parent();
						if(subli.attr("class") != "active") {
							subli.attr("class","active");
							subli.attr("data-visable", "1");
							subli.find("ul").eq(0).css("display", "block")
						}
						
						this.openLink(_op_, menu.attr("data-value"), menu.find("em").html(), 0);
					} else {
						this.openLink(_op_, this.createFuncId(), "", 0);
					}
				}
				
				var skipcheck = true;
				for(var s in this.skip) {
					if(window.location.href.indexOf(this.host + this.skip[s]) == 0) {
						skipcheck = false;
						break;
					}
				}
				if(skipcheck) {
					window.location.href = this.index + "?_op_=" + encodeURIComponent(window.location.href);
				}
			}
		},
		
		openLink: function(url, key, name, refresh, target){
			if(typeof refresh == 'undefined') refresh = 0;
			if(refresh == 1 && (typeof(key) == "undefined" || key == "")) {
                var _p = $(event.srcElement).parents("[toplayer][toplayer=1]");
				if(_p.size() == 0) {
					this.message("错误","funcid不存在","错误信息");
					return false;
				}
				key = _p.attr("id");
			}

			if(typeof(key) == "undefined" || key == "") key = this.createFuncId();
			if(url == '' && refresh == 1) {
				url = decodeURIComponent($("#" + this.filterId(key) + "-last-url").val());
                if(url.indexOf("&__refresh=") < 0 && url.indexOf("?__refresh=") < 0 && url.indexOf("/__refresh/") < 0) {
                    if(url.indexOf('?') >= 0) {
                        url += "&__refresh=1";
                    } else {
                        url += "?__refresh=1";
                    }
                }
			}
			
			var unique = 0;
			if(refresh == 1)
				unique = 0;

			if(typeof unique != "undefined" && unique == 1) {
				++this.nav_seed;
				key = key + "_" + this.nav_seed;
			}

			if($("#"+key).size() > 0) {
				if(!$("#"+key).parent().hasClass("content")) {
                    target = $("#"+key);
				}
			}

			if(typeof(target) == 'undefined') {
				if(this.switchTab(key, name) || refresh == 1) {
					this.getLink(url, key, null);
				}
			} else {
				this.getLink(url, key, target);
			}

			this.viewParamList[key] = {};
			
			return false;
		},
		
		getLink: function(url, key, obj) {
			if(typeof(key) == "undefined" || key == "") key = this.createFuncId();
			this.load(key, url, obj);
		},
		
		switchTab: function(id, name) {
			var _tmpid = this.filterId(id);
			var _tab = $("a[data-type=menu][data-value=" + _tmpid + "]");
			if(_tab.size() > 0) {
				if(_tab.parent().attr("class") == "active") return;
				
				_tab.parents("ul").find("li").removeAttr("class");
				_tab.parent().attr("class", "active");
			}
			
			$(".win-tab li[class!=win-tab-menu]").removeAttr("class");
            $(".wrap-box").each(function() {
                if($(this).parent().hasClass("content")) {
                    $(this).hide();
                }
            });
			//$(".wrap-box").hide();
			if($("#" + _tmpid + "-Tab").size() > 0) {
				var _menudl = $("div.win-tab li.win-tab-menu dl dd a[funcid=" + _tmpid + "]");
				if(_menudl.size() > 0) {
					this.arrangeTab(_tmpid, _menudl.html());
					_menudl.remove();
					$("#" + _tmpid + "-Tab").show();
				}
				$("#" + _tmpid + "-Tab").attr("class", "active");
				$("#" + _tmpid).show();
                this.resizePage(_tmpid);
				if(_menudl.size() == 0) {
					this.arrangeTab();
				}
				
				return false;
			} else {
				if(typeof name != 'undefined' && name != "") {
					this.arrangeTab(_tmpid, name);
					
					var _tab = "<li class=\"active\" id=\"" + id + "-Tab\" onclick=\"_asr.switchTab('" + id + "')\"><i class=\"iconfont\">&#xe609;</i><em>" + name +"</em><a href=\"javascript:void(0);\" class=\"iconfont close\" onclick=\"_asr.closeTab(this, '" + id + "')\">&#xe60d;</a></li>";
					$(_tab).insertBefore($(".win-tab ul li.win-tab-menu"));
					//$(".win-tab ul li.win-tab-menu").append(_tab);
					return true;
				}
				
				return false;
			}
		},
		
		closeTab: function(o, id) {
			var _obj;
			if(typeof(o) == "string") {
				id = o;
				_obj = $("#"+ id + "-Tab");
			} else {
				_obj = $(o).parent();
			}
			var _tmpid = this.filterId(id);
			var _show = _obj.next();
			if(_show.size() == 0 || _show.attr("class") == "win-tab-menu")
				_show = _obj.prev();
			
			$("#" + _tmpid).remove();
			_obj.remove();
			$("a[data-type=menu][data-value=" + _tmpid + "]").parent().removeAttr("class");
			
			if(_show.size() > 0) {
				this.switchTab(_show.attr("id").replace("-Tab", ""));
			} else {
				this.arrangeTab();
			}
			if(typeof(event) != "undefined") {
				event.stopPropagation();
			}

            delete this.viewParamList[id];
			
			return false;
		},
		
		arrangeTab: function(id, name) {
			var _max_width = $("div.win-tab").width();
			
			if(typeof(id) == "undefined") {
				if($("div.win-tab li[class!=win-tab-menu]").size() == 0 && $("div.win-tab li.win-tab-menu dl dd a").size() == 0) {
					$("#home-bg").show();
					$("div.win-tab li.win-tab-menu").hide();
					return false;
				}
				
				$("div.win-tab li.win-tab-menu dl dd a").each(function() {
					var _total_width = 0;
					$("div.win-tab li[class!=win-tab-menu]:!hidden").each(function(){
						_total_width += $(this)[0].scrollWidth;
					});
					
					name = $(this).html();
					if(_max_width - _total_width >=  105 + (name.length * 12)) {
						$(this).remove();
						$("#" + $(this).attr("funcid") + "-Tab").show();
					} else {
						return false;
					}
				});
			} else {
				var _total_width = 0;
				$("div.win-tab li[class!=win-tab-menu]:!hidden").each(function(){
					_total_width += $(this)[0].scrollWidth;
				});
				
				while(_max_width - _total_width <  105 + (name.length * 12)) {
					var _hideli = $("div.win-tab li").not(":hidden").eq(0);
					if(_hideli.attr("id") == id + "-Tab") {
						_hideli = $("div.win-tab li").not(":hidden").eq(1);
					}
					_hideli.hide();
					$("div.win-tab li.win-tab-menu dl").append("<dd><a href=\"javascript:void(0);\" funcid=\"" + _hideli.attr("id").replace("-Tab", "") + "\" onclick=\"_asr.switchTab('" + _hideli.attr("id").replace("-Tab", "") + "', '" + _hideli.find("em").html() + "');\"><em class=\"iconfont\">" + _hideli.find("i").html() + "</em>" + _hideli.find("em").html() + "</a></dd>");
					
					_total_width = 0;
					$("div.win-tab li[class!=win-tab-menu]:!hidden").each(function(){
						_total_width += $(this)[0].scrollWidth;
					});
					if(_max_width < _total_width) break;
				}
			}
			
			if($("div.win-tab li.win-tab-menu dl dd a").size() == 0) {
				$("div.win-tab li.win-tab-menu").hide();
			} else {
				$("div.win-tab li.win-tab-menu").show();
			}
		},
		
		submit: function(id, formid, url, download, func, title) {
			if(typeof(title) != 'undefined' && title != '') {
				title += "|";
				var t = title.split("|");
				return this.confirm("操作确认", t[0], t[1], url, func, formid, download);
			}
			var _this = this;
			var _form = "";
			
			var _tmpid = this.filterId(id);
			
			if(typeof formid == "string") {
				formid = this.filterId(formid);
				if(formid != "") {
					formid = this.filterId(formid);
					_form = $("#" + formid);
				} else {
					_form = $("#__form-"+_tmpid+"__");
					
					if(_form.size() == 0) {
						$("body").append("<form id=\"__form-"+id+"__\" target=\"\" action=\"" + url + "\" style=\"display:none;\" method=\"post\"></form>");
						_form = $("#__form-"+_tmpid+"__");
					} else {
						_form.attr("action", url);
					}
				}
			} else {
				if($(formid).prop("tagName") == "FORM") {
					_form = $(formid);
				} else {
					_form = $(formid).parents("form");
				}
			}
			
			if(_form.size() == 0) return false;
			
			if(this.submitpool.hasOwnProperty(_tmpid) && this.submitpool[_tmpid]) {
				return false;
			}
			
			var _verify_ok = true;
			var _verify_group = {};
			var _verify_group_msg = {}
			if(_form.attr("verify") == "1") {
                _form.find("[verify][verify!='']").each(function() {
                    var _that = $(this);
                    var _verify = _that.attr("verify").split("|");
                    var _tips = "";
                    if(typeof(_that.attr("tips")) != "undefined") {
                        _tips = _that.attr("tips").split("|");
                    }
                    var _group = "";
                    for(var _v in _verify) {
                        if(_verify[_v].indexOf("?")>=0) {
                            var _g = _verify[_v].split("?");
                            if(_g[1] != "") {
                                if(!_verify_group.hasOwnProperty(_g[1])) {
                                    _verify_group[_g[1]] = false;
                                    _verify_group_msg[_g[1]] = _tips[_v];
                                }
                                _group = _g[1];
                                _verify[_v] = _g[0];
                            }
                        }

                        if(_verify[_v] == "empty") {
                            var _empty = false;
                            if(_that.attr("type") == "checkbox") {
                                _empty = _that.prop();
                            } else {
                                _empty = _that.val() == "";
                            }
                            if(_empty) {
                                if(_group=="") {
                                    _verify_ok = false;
                                    _that.focus();
                                    if(_tips != "")
                                        _this.message("提示",_tips[_v],"");
                                    return false;
                                }
                            } else {
                                if(_group!="") {
                                    _verify_group[_g[1]] = true;
                                }
                            }
                        }else if(_verify[_v].indexOf(":")>=0) {
                            var _curverify=_verify[_v].split(":");
                            if(_curverify[0]=="gt"){
                                if(parseFloat(_that.val())>parseFloat(_curverify[1]))
                                {
                                    if(_group=="") {
                                        _verify_ok = false;
                                        _that.focus();
                                        if(_tips != "")
                                            _this.message("提示",_tips[_v],"");
                                        return false;
                                    }
                                } else {
                                    if(_group!="") {
                                        _verify_group[_g[1]] = true;
                                    }
                                }
                            }
                        }
                    }
                });
			}

            for(var _v in _verify_group) {
                if(!_verify_group[_v]) {
                    _this.message("提示",_verify_group_msg[_v],"");
                    return false;
                }
            }
			
			if(_verify_ok) {
				try {
					download = parseInt(download);
				} catch(e2) {
					download = 0;
				}
				
				if(_form.find("input[type=hidden][name=funcid]").size() == 0) {
					_form.append("<input type='hidden' name='funcid' value='" + id + "' />");
				}
				
				var _reset = _form.find("input[type=hidden][name=reset-funcid]");
				if(_reset.size() > 0 && _reset.val() == 1) {
					_form.find("input[type=hidden][name=funcid]").val(id);
				}
				if(_form.find("input[type=hidden][name=__ajax]").size() == 0) {
					_form.append("<input type='hidden' name='__ajax' value='1' />");
				}
				
				if(typeof(download) != "undefined" && download == 1) {
                    var _ajaxframe = $('#ajaxframe');
                    if(_ajaxframe.loading) {
                        return false;
                    }
                    _ajaxframe.loading = 1;
                    _ajaxframe.unbind('load');
                    _ajaxframe.bind('load', function() {
                        _this.ajaxReturn(document.getElementById('ajaxframe').contentDocument.body.innerHTML, _tmpid)
                        _ajaxframe.loading = 0;
                    });

					$("#__ajax-form__").remove();
					var _ajaxForm = _form.clone();
					_ajaxForm.html("");
					
					var _sourceitem = _form.find("select,textarea,input[type!=button][type!=submit]");
					
					for(var i = 0;i < _sourceitem.size(); i++) {
						var _cloneitem = _sourceitem.eq(i).clone();
						_cloneitem.val(_sourceitem.eq(i).val());
						if(_sourceitem[0].tagName == "input") {
							if(_sourceitem.prop("checked")) {
								_cloneitem.prop("checked", true);
							} else {
								_cloneitem.prop("checked", false);
							}
						}
						
						_ajaxForm.append(_cloneitem);
					}
					
					_ajaxForm.attr("id", "__ajax-form__");
					_ajaxForm.attr("target", "ajaxframe");
					_ajaxForm.attr("action", url);
					_ajaxForm.attr("method", "post");
					_ajaxForm.css("display", "none");
					$("body").append(_ajaxForm);
					
					_ajaxForm.submit();
					return false;
				} else if(typeof(download) != "undefined" && download == 2) {
					var _ajaxframe = $('#ajaxframe');
					if(_ajaxframe.loading) {
						return false;
					}
                    if(typeof(url) != "undefined" && $.trim(url)!='')
                        _form.attr("action", url);
					_form.attr("target", "ajaxframe");
					_ajaxframe.loading = 1;
					_ajaxframe.unbind('load');
					_ajaxframe.bind('load', function() {
						_this.ajaxReturn(document.getElementById('ajaxframe').contentDocument.body.innerHTML, _tmpid)
//						successfun(document.getElementById('ajaxframe').contentDocument.body.innerHTML);
						_ajaxframe.loading = 0;
					});
                    _form.submit();
                    return false;
				}
				
				if(typeof(_form.attr("action")) == "undefined" && (typeof(url) == 'undefined' || url == "")) {
					url = $("#" + _tmpid).attr("baseurl");
				}
				
				if(typeof url != 'undefined' && url != "") {
					var _originalUrl = _form.find("input[type=hidden][name=__original-url]");
					if(_originalUrl.size() > 0) {
						_originalUrl.val(_form.attr("action"));
					} else {
						_form.append("<input type='hidden' name='__original-url' value='" + _form.attr("action") + "' />");
					}
					_form.attr("action", url);
				}
				
				var _method = typeof _form.attr("method") == 'undefined' ? "get" : _form.attr("method");
				this.submitpool[_tmpid] = true;
                if(_method.toLowerCase() == "get") {
                    this.ajax(_tmpid, _form.attr("action"), _method, _form.serialize(), $("#"+_tmpid), func);
                } else {
                    this.ajax(_tmpid, _form.attr("action"), _method, new FormData(_form[0]), $("#"+_tmpid), func);
                }
			}

			return false;
		}, 
		isLabel: function(obj) {
			if(typeof(obj) == 'undefined' || $(obj).size() == 0) return true;
			var _label = true;
			if($(obj).parents("div.content").size() == 0) {
				_label = false;
			}
			return _label;
		},
		selectAll: function(o, s) {
			if(typeof s == "undefined" || s == "") {
                s = "table-box";
			}
			var _form = $(o).parents("div."+s);
			if(_form.size() == 0) return;
			
			_form.find("input[type=checkbox][data-type=select]").not(":disabled").prop("checked", $(o).prop("checked"));
			this.verify(o, s);
			this.showSelectInfo(o);
		},
		selectSingle: function(o) {
			var _form = $(o).parents("div.table-box");
			if(_form.size() == 0) return;
			if($(o).prop("checked") == true) {
				_form.find("input[type=checkbox][data-type=select]").each(function() {
					if($(this).val() != $(o).val()) {
						$(this).prop("checked", false);
					}
				});
			}
			
			this.verify(o);
			this.showSelectInfo(o);
		},
		selectMulit: function(o) {
			this.verify(o);
			this.showSelectInfo(o);
		},
		
		verify: function(o, s) {
            if(typeof s == "undefined" || s == "") {
                s = "table-box";
            }
			var _condition = new Array();
			var _form = $(o).parents("div."+s);
			var _div = _form.parents("div[toplayer][toplayer=1]").find("div.data-oper div.data-oper-in");
            if(!_div){
                _div = _form.parents("div[toplayer][toplayer=1]").find("div.wrap-nmd-top div.data-oper div.data-oper-in");
            }
			//var _div = _form.next();// _form.find("div.data-oper");
			if(_form.find("input[type=checkbox][data-type=select]:checked").size() == 0) {
				_div.find("input[verify][verify=1]").each(function(){
					if(typeof $(this).attr("default-status") != "undefined" && $(this).attr("default-status") == 1) {
						$(this).removeAttr("disabled");
						$(this).attr("class", $(this).attr("class").replace(" disabled", ""));
					} else {
						$(this).attr("disabled","disabled");
						if($(this).attr("class").indexOf("disabled") < 0) {
							$(this).attr("class", $(this).attr("class") + " disabled");
						}
					}
				});
				return false;
			}
			
			
			_div.find("input[verify][verify=1]").each(function(){
				var _b = true;
				var _that = this;
				var _col_name = $(this).attr("column");
				
				_form.find("input[type=checkbox][data-type=select]:checked").each(function() {
					var _input = $(this).siblings("input[type=hidden][name=" + _col_name + "]");
					if(_input.size() == 0 || _input.val() == "0") {
						_b = false;
					}
					
					return _b;
				});
				
				if(_b) {
					$(_that).removeAttr("disabled");
					$(_that).attr("class", $(_that).attr("class").replace(" disabled", ""));
				} else {
					$(_that).attr("disabled","disabled");
					var _attr = $(_that).attr("class");
					if(_attr.indexOf("disabled") < 0) {
						$(_that).attr("class", _attr + " disabled");
					}
				}
			});
			
			_div.find("input[verify][verify=0]").each(function(){
				$(this).removeAttr("disabled");
				$(this).attr("class", $(this).attr("class").replace(" disabled", ""));
			});
			
			/*
			_form.find("input[type=checkbox][data-type=select]:checked").each(function() {
				var _col_name = $(this).attr("column");
				if(_col_name == "") return true;
				if(!_condition.hasOwnProperty(_col_name)) {
					_condition[_condition] = true;
				}
				
				var _col_value = $(this).attr("column-value");
				if(_condition[_condition] == true) {
					_div.find("input").each(function() {
						if($(this).attr("column") == _col_name) {
							if($(this).attr("column-value") != _col_value) {
								_condition[_condition] = false;
								$(this).attr("disabled","disabled");
								$(this).attr("class", "azaa");
							}
						}
					});
				}
			});
			*/
		},
		showSelectInfo: function(o) {
			var _form = $(o).parents("div[toplayer][toplayer=1]");
			var _selectCount = _form.find("input[type=checkbox][data-type=select]:checked").size();
			_form.find("div.data-oper span.pdr_15 i").html(_selectCount);
		},
		popup: function(c, k, f, m, cf, nf, v) {
			f = this.filterId(f);
			if(typeof(cf) == "string") {
				cf = this.filterId(cf);
				nf = this.filterId(nf);
			}
			
			k = c + "_popup";
			var url = "/index.php/Home/Popup/index?func="+c+"&selecttype=" + m;
			
			var _src = $(event.srcElement);
			var _relation = _src.attr("relation");
			if(typeof _relation != "undefined" && _relation != "") {
				var _relationStr = "";
				if(_relation.indexOf("|") >= 0) {
					var _relationArray = _relation.split("|");
					for(var i=0;i<_relationArray.length;i++) {
						_relationStr += "&";
						var _relationElement = _src.parents("form").find("[name=" +_relationArray[i]　+ "]");
						if(_relationElement.size() > 0) {
							_relationStr += _relationArray[i] + "=" + encodeURIComponent(_relationElement.val());
						}
					}
				} else {
					var _relationElement = _src.parents("form").find("[name=" +_relation　+ "]");
					if(_relationElement.size() > 0) {
						_relationStr += "&" + _relation + "=" + encodeURIComponent(_relationElement.val());
					}
				}
				
				if(_relationStr != "") {
					url += _relationStr;
				}
			}
			
			var form = $("#"+ f);
			if(form.size() == 0) return false;
			
			var b;
			var d;
			if(typeof(cf) == "string") {
				b = form.find("[name=" + cf + "]");
				d = form.find("[name=" + nf + "]");
				
				if(typeof(v) == "undefined" || v == "") v = b.val();
			} else {
				b = cf;
				d = (!nf)?"":nf;
			}
			
			return this.popupFun(url, k, v, b, d);
		},
		popupFun: function(url, key, value, targetcode, targetname) {
			if(typeof(url) == 'undefined' || url == "") return false;
			if(typeof(key) == "undefined" || key == "") key = this.createFuncId();
			
			var _tmpid = this.filterId(key);
			this.showLoading();
			var _this = this;
			var _p, _pe;
			if(event.srcElement.toString() == "[object XMLHttpRequest]") {
				_pe = $(this.srcElement);
			} else {
				_pe = $(event.srcElement);
			}
			
			_p = _pe.parents("[toplayer][toplayer=1]");
			if(_p.size() == 0) {
				_p = _pe.parents("div.prompt-pop");
				if(_p.size() == 0) {
                    var toplayers = $("div[toplayer][toplayer=1]");
                    toplayers.each(function() {
                        if($(this).css("display") != "none") {
                            _p = $(this);
                            return false;
                        }
                    });
				}
			}
			var _pfuncid = "";
			if(_p.size() > 0) {
				_pfuncid = _p.eq(0).attr("id");
			}
			
			_this.zindex= _this.zindex + 2;
			$.ajax({
				type:"get",
				url: url,
				data: {funcid:_tmpid, value:value, zindex:_this.zindex, pfuncid: _pfuncid, "__ajax":"1"},
				success: function(c) {
					if(c == "") {
						_this.hideLoading();
						return false;
					}

					try {
						var c_bak=c;
						c = eval("(" + c + ")");
                        _this.ajaxReturn(c_bak);
                        return false;

                        if(c.msg) {
							if(c.msg_desc!= "undefined" && c.msg_desc!="")
							{
								_this.message("提示",c.msg,c.msg_desc);
							}else
						   {
						   		_this.message("提示",c.msg,"");
						   }
							_this.hideLoading();
							return false;
						}
					} catch(e) {
						
					}
					
					var zi = _this.zindex - 1;
					var _mask = "<div class=\"popup-bg\" id=\"" + _tmpid + "_mask\" style=\"z-index:" + zi + ";\"></div>"
					$("body").append(_mask);
					$("body").append(c);
					
					$("#" + _tmpid).find("input[type!=hidden]").eq(0).focus();
					
					_this.calcpop();
					if(typeof(targetcode) != 'undefined' && targetcode != null) {
						if(typeof(targetcode) == "function") {
							_this.popupcall[_tmpid] = function(pkey) {
								var _jsonData = new Array();
								$("#"+_tmpid+" input[type=checkbox][j]:checked").each(function() {
									_jsonData.push(JSON.parse($(this).attr("j")));
								});
								
								$("#"+_tmpid+" input[type=radio][j]:checked").each(function() {
									_jsonData.push(JSON.parse($(this).attr("j")));
								});
								
								if(_jsonData.length == 0) {
									_this.message("错误","至少选择一条数据","");
									return false;
								}
								
								targetcode(_jsonData,targetname, _tmpid, pkey);
							}
						} else {
							_this.popupcall[_tmpid] = function() {
								var _popupvalue = "";
								var _popupshow = "";
								$("#"+_tmpid+" input[type=checkbox][j]:checked").each(function() {
									if(_popupvalue != "") _popupvalue += "|";
									if(_popupshow != "") _popupshow += "|";
									_popupvalue += $(this).val();
									_popupshow += $(this).attr("show");
								});
								
								$("#"+_tmpid+" input[type=radio][j]:checked").each(function() {
									if(_popupvalue != "") _popupvalue += "|";
									if(_popupshow != "") _popupshow += "|";
									_popupvalue += $(this).val();
									_popupshow += $(this).attr("show");
								});
								
								if(_popupvalue == "") {
									_this.message("错误","至少选择一条数据","");
									return false;
								}
								
								$(targetcode).val(_popupvalue);
								$(targetname).val(_popupshow);
								
								$(targetname).parent().find(".txt-clear").show();
								$(targetname).parent().find(".txt-search").hide();

								_this.closePopup(_tmpid);
							}
						}
					}
					
					_this.hideLoading();
				},
				error: function(e) {
					_this.hideLoading();
					_this.message("错误",e.statusText,"错误信息");
				}
			});
			
			return false;
		}, 
		closePopup: function(key) {
			key = this.filterId(key);
			$("#"+key).remove();
			$("#"+key+"_mask").remove();
		},
		returnPopup: function(key, pkey) {
			if(this.popupcall.hasOwnProperty(key) && typeof(this.popupcall[key]) == "function") {
				this.popupcall[key](pkey);
			}
		},
		loadData: function(id, url, target, func, group, groupId) {
			if(typeof(id) == "undefined" || id == "") id = this.createFuncId();
			if(func == "detail") {
				return this.showDetail(id,event.srcElement,url, group, groupId);
			}
			if(url == "") return;
			
			var callbackfunc;
			if(typeof(func) == "string") {
				try {
					if(typeof(eval(id + "_"+func)) == "function") {
						callbackfunc = eval(id + "_"+func);
					}
				} catch(e) {
					callbackfunc = "";
				}
				
			} else {
				callbackfunc = func;
			}
			this.load(id, url, target, callbackfunc);
			return false;
		},
		showMask: function() {
			$("#mask").show();
		},
		hideMask: function() {
			$("#mask").hide();
		}, 
		showLoading: function() {
			this.showMask();
			$(".loader-box").show();
		},
		hideLoading: function() {
			this.hideMask();
			$(".loader-box").hide();
		},
		showSearch: function(o) {
			var _button = $(o);
			var _div = _button.parents(".screening");
			var _ul = _div.find("ul").eq(1);
            var _searchexpand = _div.find('input[name="_searchexpand"]');
			if(_ul.size() == 0) return false;
			
			var _children = _ul.children();
			_children = _children.eq(_children.size() - 1);
			var _bottom = _children.offset().top - _ul.offset().top + _children.height();
			
			var _height = 0;
			
			if(_ul.css("display") == "none") {
				_ul.height(0);
				_ul.css("display", "");
				_bottom = _children.offset().top - _ul.offset().top + _children.height();
				if(_height <_bottom) {
					var i = setInterval(function(){
						if(_height <_bottom) {
							_height += 3;
							_ul.height(_height);
						} else {
							clearInterval(i);
							_button.html(_button.html().replace("展开选项", "隐藏选项"));
						}
					}, 1);
				} else {
					_button.html(_button.html().replace("展开选项", "隐藏选项"));
				}
                _searchexpand.val(1);
			} else {
				_height = _ul.height();
				if(_height > 0) {
					var i = setInterval(function(){
						if(_height > 0) {
							_height -= 3;
							_ul.height(_height);
						} else {
							_ul.hide();
							clearInterval(i);
							_button.html(_button.html().replace("隐藏选项", "展开选项"));
						}
					}, 1);
				} else {
					_button.html(_button.html().replace("隐藏选项", "展开选项"));
				}
                _searchexpand.val(0);
			}
			
			/*
			var _height = _ul.height();
			
			var posline0 = _ul.find(".pos-line").eq(0);
			var posline1 = _ul.find(".pos-line").eq(1);
			
			var div = posline0.next();
			if(div.size() == 0 || div[0].tagName !== "DIV") return;
			
			var _mim_height = posline0.offset().top - _ul.offset().top - posline0.height() - 5;
			var _max_height = posline1.offset().top - _ul.offset().top - posline1.height() - 5;
			
			if(_height > _mim_height && typeof(_ul.attr("style")) != "undefined" && _ul.attr("style") != "") {
				var i = setInterval(function(){
					if(_height > _mim_height) {
						_height--;
						_ul.height(_height);
						//_ul.css("height", _height);
					} else {
						clearInterval(i);
						_button.html(_button.html().replace("隐藏选项", "展开选项"));
					}
				}, 1);
			} else {
				var recalc = false;
				if(_ul.attr("style") == "" || typeof(_ul.attr("style")) == "undefined") {
					_ul.attr("style","height:"+ _mim_height + "px");
					recalc = true;
				}
				div.show();
				if(recalc) {
					_max_height = posline1.offset().top - _ul.offset().top - posline1.height() - 5;
				}
				var i = setInterval(function(){
					if(_height < _max_height) {
						_height++;
						_ul.height(_height);
						//_ul.css("height", _height);
					} else {
						clearInterval(i);
						_button.html(_button.html().replace("展开选项", "隐藏选项"));
					}
				}, 1);
			}
			*/
			return false;
		}, 
		showExport: function(_id, _formid, _url, _page) {
			var _export = $("#export");
			var _cancel = _export.find("input.export-cancel");
			var _ok = _export.find("input.export-ok");
			var _this = this;
			_cancel.unbind();
			_ok.unbind();
			_export.find(".title a").unbind();

            var zi = ++this.zindex;
            var _mask = "<div class=\"popup-bg\" id=\"export-bg\" style=\"z-index:" + zi + ";\"></div>";
            $("body").append(_mask);
            zi = ++this.zindex;
            _export.css("z-index", zi);
			_cancel.bind("click", function() {
				$("#export-bg").remove();
				_export.hide();
			});
			
			_export.find(".title a").bind("click", function() {
                $("#export-bg").remove();
				_export.hide();
			});
			
			_ok.bind("click", function() {
				var _radio = _export.find("input[type=radio]:checked");
				if(_radio.size() == 0) {
					_this.message("错误","请选择导出选项","");
					return false;
				}
				
				var _export_url = _url;
				if(_radio.val() == 1) {
					if(_export_url.indexOf('?') >= 0) {
						_export_url += "&p="+_page;
					} else {
						_export_url += "?p="+_page;
					}
				}
				
				return _this.submit(_id, _formid, _export_url, '1');
			});

			$("#export").show();
			this.calcpop();
		}, 
		changePageSize: function(o, _funcid, _url,page_size_name) {
//			var _box;
//			var _tag = false;
//			if($(o).parents(".prompt-pop").size() > 0) {
//				_box = $(o).parents(".prompt-pop");
//				var _funcid = _box.attr("funcid");
//				var _url = decodeURIComponent(_box.attr("last-url"));
//			} else {
//				_box = $(o).parents(".wrap-box");
//				var _funcid = _box.find("input[type=hidden][name=funcid]").val();
//				var _url = decodeURIComponent(_box.find("input[type=hidden][name=" + _funcid + "-last-url]").val());
//				_tag = true;
//			}
			
//			if(typeof(_url) == "undefined" || _url == "") {
//				
//			}

            page_size_name=!page_size_name?'pagesize':page_size_name

			if(_url[0] != "/") _url = "/" + _url;
			
			if(_url.indexOf("&"+page_size_name+"=") < 0 && _url.indexOf("?"+page_size_name+"=") < 0 &&  _url.indexOf("/"+page_size_name+"/") < 0) {
				if(_url.indexOf('?') >= 0) {
					_url += "&"+page_size_name+"=" + $(o).val();
				} else {
					_url += "?"+page_size_name+"=" + $(o).val();
				}
			} else {
				var _s = "?";
				var _p = "=";
				if(_url.indexOf("&"+page_size_name+"=") >= 0) {
					_s = "&";
				} else if(_url.indexOf("/"+page_size_name+"/") >= 0) {
					_s = "/";
					_p = "/";
				}
                var reg = new RegExp("(&|[\?]|\/)"+page_size_name+"(=|\/)\\d+", "g");
                _url = _url.replace(reg, _s + page_size_name + _p + $(o).val());
			}
			
			this.loadData(_funcid, _url, $("#"+_funcid));
		},
		load: function(id, url, target, func) {
			if(typeof url == "undefined" || url == "" || url == "javascript:void(0);") return false;
			var _that = this;
			var _tmpid = this.filterId(id);
			
			if(url.indexOf("&funcid=") < 0 && url.indexOf("?funcid=") < 0 && url.indexOf("/funcid/") < 0) {
				if(url.indexOf('?') >= 0) {
					url += "&funcid=" + encodeURIComponent(id);
				} else {
					url += "?funcid=" + encodeURIComponent(id);
				}
			}
			
			this.ajax(_tmpid, url, "get", "", target, func);
		},
		ajax: function(id, _url, _method, _data, _target, _func) {
            var _config = {
                type:_method,
                url:_url,
                dataType : "text",
                data:_data,
                success: function(c) {
                    _that.ajaxReturn(c, _tmpid, _target, _func);
                    _that.submitpool[_tmpid] = false;
                },
                error: function(e) {
                    _that.submitpool[_tmpid] = false;
                    _that.hideLoading();
                    _that.message("错误",e.statusText,"");
                }
            }

            var _pfuncid = "";
            var _pe = $("#" + id).parent();
            if(_pe.size() > 0 && !_pe.hasClass("content")) {
                var _p = _pe.parents("[toplayer][toplayer=1]");
                if(_p.size() > 0) {
                    _pfuncid = _p.eq(0).attr("id");
				}
            }
            if(_pfuncid == "" || _pfuncid == 0) {
                var _p = $(event.srcElement).parents("[toplayer][toplayer=1]");
                if(_p.size() > 0) {
                    _pfuncid = _p.attr("id");
                }
            }


            var _tmpid = this.filterId(id);
			if(typeof(_data) == 'undefined' || _data == "") {
                _data = {"__ajax": "1"};
                if(_pfuncid != "" && _pfuncid != 0) {
                    _data["pfuncid"] = _pfuncid;
				}
				//_data = {"__ajax": "1", "pfuncid":_pfuncid};
			} else if(typeof(_data) == "string") {
				if(!_data.match(/__ajax=1/g)) {
					_data += "&__ajax=1";
				}
                if(_pfuncid != "" && _pfuncid != 0 && !_data.match(/pfuncid/g)) {
                    _data += "&pfuncid="+_pfuncid;
                }
			} else if(_data.toString() == "[object FormData]") {
				if(!_data.has("__ajax")) {
                    _data.append("__ajax", 1);
				}
                if(_pfuncid != "" && _pfuncid != 0 && !_data.has("pfuncid")) {
                    _data.append("pfuncid", _pfuncid);
                }
                _config.dataType = "json";
                _config.contentType = false;
                _config.processData = false;
			} else {
                if(!_data.hasOwnProperty("__ajax")) {
                    _data["__ajax"] = "1";
				}
                if(_pfuncid != "" && _pfuncid != 0 && !_data.hasOwnProperty("pfuncid")) {
                    _data["pfuncid"] = _pfuncid;
                }
			}

            _config.data = _data;

			var _that = this;
			this.showLoading();
			$.ajax(_config);
			
			event.preventDefault();
		},
		ajaxReturn: function(c, id, _target, func) {
			var _tmpid = this.filterId(id);
			var _that = this;
            this.submitpool[_tmpid] = false;
			if(false) {
				_that.message("错误","系统错误","");
			} else {
                try {
                	var objc;
                	if(typeof(c) == "object") {
                        objc = c;
					} else {
                        objc = eval("(" + c + ")");
					}

                    if(objc.msg) {
                        var msg_func;
                        if (objc.msg_func != "undefined" && objc.msg_func != "")
                        {
                            msg_func=eval(objc.msg_func);
                        }else
                        {
                            msg_func="";
                        }
                        if(objc.msg_desc!= "undefined" && objc.msg_desc!="")
                        {
                            _that.message("提示",objc.msg,objc.msg_desc,msg_func);
                        }else
                        {
                            _that.message("提示",objc.msg,"",msg_func);
                        }
                    } else {
			if(typeof(func) == "function") {
                        	func(c);
                    	}
		    }
                    if(typeof(func) != "function") { 
                    if(typeof(objc.func) != "undefined") {
                        if(typeof(objc.func) == "Array" || typeof(objc.func) == "object") {
                            for(var _serverfunc in objc.func) {
                                if(objc.funcParam[_serverfunc] != "") {
                                    eval(objc.func[_serverfunc] + "(" + objc.funcParam[_serverfunc] + ")");
                                } else {
                                    eval(objc.func[_serverfunc]);
                                }
                            }
                        } else if(typeof(eval(objc.func)) != "function") {
                            if(objc.funcParam != "") {
                                eval(objc.func + "(" + objc.funcParam + ")");
                            } else {
                                eval(objc.func);
                            }
                        }
                    } else {
                        try {
                            if(objc.callback == "1" && typeof(eval(id + "_callback")) == "function") {
                                if(objc.funcParam != "") {
                                    eval(id + "_callback(" + objc.funcParam + ")");
                                } else {
                                    eval(id + "_callback()");
                                }
                            }
                        } catch(e1) {

                        }
                    }
		    
                    if(objc.link) {
                        window.location.href = objc.link;
                    }
		    }
                } catch(e) {
                    if(typeof(func) == "function") {
                        func(c);
                    } else {
						if(typeof(c) == "string") {
							// if(c.indexOf("<div toplayer=\"1\"") != 0 && c.indexOf("<div class=\"wrap-box\"") != 0) {
							//     if(c.indexOf("<div class=\"prompt-pop") != 0) {
							//         c = "<div toplayer=\"1\" class=\"wrap-box\" id=\"" + id + "\" summaryid=\""+id+"\" >" + c + "</div>";
							//     }
							// }

                            var _tab = $("#" + _tmpid + "-Tab");
                            if(_tab.size() > 0 && !_tab.hasClass("active")) {
								c = $(c);
								if(c.attr("toplayer") == "1") {
                                    c.css("display", "none");
								}
							}

                            if(typeof(_target) == "string" && _target != "") {
                                if(_target.substr(0, 1) != "#") {
                                    _target = "#" + _target;
                                }
                            }

							if(typeof(_target) != "undefined" && $(_target).size() > 0) {
								$(_target).replaceWith(c);
								$("#"+_tmpid).find("input[type!=hidden]").eq(0).focus();
							} else {
								if($("#"+_tmpid).size() > 0) {
									$("#"+_tmpid).replaceWith(c);
									var bgIsShow = true;
									$(".popup-bg").each(function() {
										if($(this).css("display") != "none") {
											var z1, z2;
											z1 = parseInt($(this).css("z-index"));
											if(isNaN(z1)) {
												z1 = 0;
											}
											z2 = parseInt($("#"+_tmpid).css("z-index"));
											if(isNaN(z2)) {
												z2 = 0;
											}

											if(z1 > z2) {
												bgIsShow = false;
											}
										}
									});
									if(bgIsShow) {
										$("#"+_tmpid).find("input[type!=hidden]").eq(0).focus();
									}
								} else {
									$("div.content").eq(0).append(c);
								}
							}
							this.resizePage(_tmpid);

							try {
								if(typeof(eval(_tmpid+"_init")) == "function") {
									eval(_tmpid+"_init('" + _tmpid + "')");
								}
							} catch(e1) {

							}
						}
					}
                }
			}
			_that.calcpop();
			_that.hideLoading();
		},
		resizePage: function(_tmpid) {
            if($("#"+_tmpid).hasClass("wrap-nmd")) {
                var weight = $("#"+_tmpid).find('.wrap-box-info').innerHeight() - $("#"+_tmpid).find('.wrap-title').outerHeight() - $("#"+_tmpid).find('.sub-box').outerHeight() - 5;
                if(weight > 0) {
                    $("#"+_tmpid).find('.wrap-nmd-box').height(weight);
                }
            }
		},
		tabsheet: function(_id, _form, _val, _func) {
			var form = $("#"+this.filterId(_form));
			var _originalUrl = form.find("input[type=hidden][name=__original-url]");
			if(_originalUrl.size() > 0) {
				_originalUrl = _originalUrl.val();
				if(_originalUrl != form.attr("action")) {
					form.attr("action", _originalUrl);
				}
			}
			
		    form.find("input[type=hidden][name=_tab]").val(_val);
		    this.submit(_id, _form, "", 0, _func);
		    return false;
		}, 
		
		showDetail: function(id, obj, url, group, groupId) {
			var _tr = $(obj).parents("tr");
			if(typeof(groupId) != "undefined" && groupId != "") {
                //_tr.parent().find("tr[group="+group+"][group-id!="+groupId+"]").remove();
                var children = _tr.parent().find("tr[group='"+group+"'][group-id='"+groupId+"']");
                if(children.size() > 0) {
                	if(children.eq(0).css("display") == "none") {
                        _tr.find("a[group='"+group+"'][group-id='"+groupId+"']").show();
                        children.show();
					} else {
                        _tr.find("a[group='"+group+"'][group-id='"+groupId+"']").hide();
                        this.hideDetail(_tr.parents("table"), group, false);
					}
					return false;
				} else {
                    _tr.find("a[group='"+group+"'][group-id='"+groupId+"']").show();
                    _tr.find("a[group='"+group+"'][group-id!='"+groupId+"']").hide();
				}
                this.hideDetail(_tr.parents("table"), group, true);
			} else {
                var _next = _tr.next();
                if(_next.size() > 0 && typeof(_next.attr("detail")) != "undefined" && _next.attr("detail") == "1") {
                    if(_next.css("display") == "none") {
                        _next.css("display", "");
                    } else {
                        _next.css("display", "none");
                    }
                    return false;
                }
			}

			var callbackfunc;
			callbackfunc = function(c) {
				if(c.trim(" ") == "") {
					return false;
				}
				$(c).insertAfter(_tr);
			}
			
			this.load(id, url, "", callbackfunc);
			return false;
		},
		hideDetail: function(root, group, remove) {
			var _that = this;
            var children = root.find("tr[group='"+group+"']");
            if(children.size() > 0) {
                children.each(function() {
                	var ctr = $(this).find("a[group]");
                    ctr.hide();
                    _that.hideDetail(root, ctr.attr("group"), remove)
				});
                if(remove) {
                    children.remove();
				} else {
                    children.hide();
				}
			}
		},
		showSide: function(id, url, func) {
            if(typeof(id) == "undefined" || id == "") id = this.createFuncId();
            var _tmpid = this.filterId(id);
            var _this = this;
			this.loadData(_tmpid, url, null, function(c) {
				$(".presc-pop-menu").html(c);
                $(".presc-pop-menu").animate({right:"0"});
				$("#side-background").show();
                $("#side-background").unbind();
                $("#side-background").bind("click", function() {
                    $(".presc-pop-menu").animate({right:"-700px"});
                    $("#side-background").hide();
				});

                _this.popupcall[_tmpid] = function(pkey) {
                    func(pkey);
				}
			});
		},
		hideSide: function() {
            $(".presc-pop-menu").animate({right:"-700px"});
            $("#side-background").hide();
		},
		refreshSide: function(formId) {
			this.submit("", formId, "", 0, function(c) {
                $(".presc-pop-menu").html(c);
			})
		},
		addParam: function(url, param, val) {
			if(url.indexOf("&"+param+"=") < 0 && url.indexOf("?"+param+"=") < 0 && url.indexOf("/"+param+"/") < 0) {
                if(url.indexOf('?') >= 0) {
                    url += "&";
                } else {
                    url += "?";
                }
                url += param + "=" + val;
			}

            return url;
		},
        toggleRadio: function(o, c) {
			o=$(o);
			if(o.hasClass(c)) return false;
			o.siblings().removeClass(c);
			o.addClass(c);
			b=o.attr("bind-name");
            k=o.attr("bind-value");
			x = o.parents("div[toplayer=1]").find("input[type=radio][name="+b+"][value="+k+"]");
			if(x.size() > 0) {
				x.prop("checked", true);
			}
			return false;
		},
		setvaluebyname: function(formid, fieldname, val) {
			fieldname = this.filterId(fieldname);
			var target = $("#"+formid).find("[name="+fieldname+"]");
			target.each(function() {
				var _this = $(this);
				switch(this.tagName) {
				case "INPUT":
					if(_this.attr("type") == "text" || _this.attr("type") == "hidden") {
						_this.val(val);
						_this.parent().find(".txt-clear").hide();
						_this.parent().find(".txt-search").show();
					} else if(_this.attr("type") == "checkbox" || _this.attr("type") == "radio") {
						_this.prop("checked", val);
					}
					break;
				case "SELECT":
				case "TEXTAREA":
					_this.val(val);
					break;
				}
			});
		},
		getvaluebyname: function(formid, fieldname) {
			fieldname = this.filterId(fieldname);
			var target = $("#"+formid).find("[name="+fieldname+"]");
			var result = "";
			target.each(function() {
				var _this = $(this);
				switch(this.tagName) {
				case "LABEL":
					result += (result!=""?"|":"")+_this.text();
					break;
				case "INPUT":
					if(_this.attr("type") == "text" || _this.attr("type") == "hidden") {
						result += (result!=""?"|":"")+_this.val();
					} else if(_this.attr("type") == "checkbox") {
						if(_this.prop("checked")) {
							result +=(result!=""?"|":"")+_this.val();
						}
					} else if(_this.attr("type") == "radio") {
						if(_this.prop("checked")) {
							result += (result!=""?"|":"")+_this.val();
						}
					}
					break;
				case "SELECT":
				case "TEXTAREA":
					result += (result!=""?"|":"")+_this.val();
					break;
				default:
					result += (result!=""?"|":"")+_this.val();
					break;
				}
			});
			
			return result;
		},
		calcpop: function() {
			$(".prompt-pop").each(function(){
				var _pop_this = $(this);
				if(_pop_this.css("display") != "none") {
					var ppw = _pop_this.width()/2;
					_pop_this.css({'margin-left':-ppw});
					
//					var _title = _pop_this.find(".title");
//					var _pop_sub = _pop_this.find(".pop-sub");
//					var _v1 = _title.size() > 0 ? _title.height() : 0;
//					var _v2 = _pop_sub.size() > 0 ? _pop_sub.height() : 0;
					
					var pph = _pop_this.outerHeight()/2;
					_pop_this.css({'margin-top': -pph});
				}
			});
		}, 
		confirm: function(title1, title2, title3, url, func, formid, download) {
			var popConfirm = $("#confirm");
			if(popConfirm.css("display") == "none") {
				popConfirm.find(".pop-name").html(title1);
				popConfirm.find("div.oper-info div span").html("");
				$("<span>"+title2+"</span>").insertAfter(popConfirm.find("div.oper-info div i"));
				popConfirm.find("div.oper-info p").html(title3);
				var _form = popConfirm.find("form");
				if(typeof(url) != "undefined" && url != "")
					_form.attr("action", url);
				
				var zi = ++this.zindex;
				var _mask = "<div class=\"popup-bg\" id=\"confirm-bg\" style=\"z-index:" + zi + ";\"></div>"
				$("body").append(_mask);
				zi = ++this.zindex;
				popConfirm.css("z-index", zi);
				
				var _funcid;
				var _p = $(event.srcElement).parents("[toplayer][toplayer=1]");
				if(_p.size() == 0) {
					if(typeof(formid) == "undefined") {
						_funcid = this.createFuncId();
					} else if(typeof(formid) == "string") {
						_p = $("#" + formid).parents("[toplayer][toplayer=1]");
						_funcid = _p.eq(0).attr("id");
					} else {
						_p = $(formid).parents("[toplayer][toplayer=1]");
						_funcid = _p.eq(0).attr("id");
					}
				} else {
					_funcid = _p.eq(0).attr("id");
				}
				_form.find(".confirm-submit").unbind();
				_form.find(".confirm-cancel").unbind();
				popConfirm.find(".title a").unbind();
				var el = this;
				_form.find(".confirm-submit").bind("click", function() {
					var _cb;
					if(typeof(func) == "function") {
						_cb = function(c) {
							func(c);
							if((typeof(url) != "undefined" && url != "") || (typeof(formid) != "undefined" && formid != "")) {
								el.hideLoading();
								el.hideConfirm();
							}
						}
					}
				  el.hideConfirm();
					if((typeof(url) != "undefined" && url != "") || (typeof(formid) != "undefined" && formid != "")) {
						if(typeof(formid) != "undefined" && formid != "") {
                            return el.submit(_funcid, formid, url, download , _cb);
						} else {
							if(typeof(url) != "undefined" && url != "")
                                return el.submit(_funcid, _form, url, download , _cb);
							else
								_cb();
								return false;
						}
					} else {
						_cb();
						return false;
					}
				});
				popConfirm.find(".title a").bind("click", function() {
					el.hideConfirm();
				});
				_form.find(".confirm-cancel").bind("click", function() {
					el.hideConfirm();
				});
				
				popConfirm.show();
				this.calcpop();
				return false;
			}
		},
		hideConfirm: function() {
			$("#confirm-bg").remove();
			$("#confirm").hide();
		},
		message: function(title1, title2, title3, func) {
			var popMessage = $("#message");
			if(popMessage.css("display") == "none") {
				this.hideConfirm();
				if(typeof(title1) == "undefined" || title1 == undefined || title1 == "undefined") {
					title1 = "提示";
				}
				if(typeof(title2) == "undefined" || title2 == undefined || title2 == "undefined") {
					title2 = "";
				}
				if(typeof(title3) == "undefined" || title3 == undefined || title3 == "undefined") {
					title3 = "";
				}
				popMessage.find(".pop-name").html(title1);
				popMessage.find("div.oper-info div span").html(title2);
				popMessage.find("div.oper-info p").html(title3);
				
				var zi = ++this.zindex;
				var _mask = "<div class=\"popup-bg\" id=\"message-bg\" style=\"z-index:" + zi + ";\"></div>"
				$("body").append(_mask);
				zi = ++this.zindex;
				popMessage.css("z-index", zi);
				
				popMessage.find(".message-ok").unbind();
				popMessage.find("a.close").unbind();
				var _that = this;
				var closeFunc = function() {
					if(typeof(func) == "function") {
						func();
					}

					$("#message-bg").remove();
					popMessage.hide();
					if(typeof(func) != "function") {
						var element = _that.getMaxZIndexElement();
						if(element != null) {
							element.find("input[type=text]").eq(0).focus();
						}
					}
				}
				popMessage.find(".message-ok").bind("click", function() {
					closeFunc();
				});

				popMessage.find("a.close").bind("click", function() {
					closeFunc();
				});				
				popMessage.show();
				popMessage.find("input[type=button].message-ok").focus();
				this.calcpop();
			}
		},

		getMaxZIndexElement: function () {
			var element = null;
			var maxZ = -1;
			$('body div').each(function() {
				if($(this).css("display") == "none") {
					return true;
				}
				var zIndex = parseInt($(this).css("z-index")) || -1;
				if(zIndex > maxZ) {
					element = $(this);
					maxZ = zIndex;
				}
			});

			return element;
		},
		createFuncId: function() {
			var rand = Math.random() * 1000;
			rand = rand.toString().replace(".", "");
			var d = new Date();
			var s = d.getTime();
			return "funcid_" + s + rand;
		}, 
		filterId: function(id) {
			if(typeof(id) == "undefined") id = this.createFuncId();
			var key = id.replace(/:/g, "\\:");
			key = key.replace(/#/g, "\\#");
			key = key.replace(/\{/g, "\\{");
			key = key.replace(/\}/g, "\\}");
			key = key.replace(/\[/g, "\\[");
			key = key.replace(/\]/g, "\\]");
			key = key.replace(/\./g, "\\.");
			key = key.replace(/\=/g, "\\=");
			key = key.replace(/\$/g, "\\$");
			key = key.replace(/\^/g, "\\^");
			return key;
		}, 
		selebtn_click: function(obj,value){
			$(obj).parent().find("input[type=hidden]").val(value);
			$(obj).siblings("a").removeClass("active");
			$(obj).addClass("active");
		}, 
		getUrlParam: function (name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return unescape(r[2]); return null;
        },
        selectCheck: function(o) {
        	var _checked = $(o).parents(".sim-info").find("input[type=checkbox]:checked");
        	var _show = $(o).parents(".sim-sele").find(".sim-value");
        	var _size = _checked.size();
        	if(_size == 0) {
        		_show.html("");
        	} else if(_size == 1) {
        		_show.html(_checked.parent().text());
        	} else {
        		_show.html("已选择 " + _size +" 项");
        	}
        	return true;
        },
        clearCheck: function(id) {
        	$("#" + id).find("input[type=checkbox]").prop("checked", false);
        	$("#" + id).find("div.sim-value").html("");
        },
        addClass: function(o, s) {
        	var c = o.attr("class");
        	if(c == undefined) c = "";
        	if(c == s) return false;
        	var a = c.split(" ");
        	var b = "";
        	for(var k in a) {
        		if(a[k] == "") continue;
        		if(a[k] == s) return false;
        		if(b != "") b += " ";
        		b += a[k];
        	}
        	if(b != "") b += " ";
        	b += s;
        	o.attr("class", b);
        },
        removeClass: function(o, s) {
        	var c = o.attr("class");
        	if(c == undefined) c = "";
        	if(c == s) {
        		o.attr("class", "");
        		return false;
        	}
        	var a = c.split(" ");
        	var b = "";
        	for(var k in a) {
        		if(a[k] == "") continue;
        		if(a[k] != s) {
        			if(b != "") b += " ";
            		b += a[k];
        		}
        	}
        	o.attr("class", b);
        },
        parseInt: function(k) {
        	k = parseInt(k);
        	if(isNaN(k)) return 0;
        	return k;
        },
        parseFloat: function(k) {
        	k = parseFloat(k);
        	if(isNaN(k)) return 0;
        	return k;
        },
		getPinyin: function(o, t) {
			var k = $(o);
            $.ajax({
                type:"GET",
                url:"/index.php/Home/Index/getPinyin",
                dataType : 'text',
                data:{text:k.val()},
                success: function(c) {
					$(t).val(c);
                },
                error: function(e) {

                }
            });
		},
		addRow: function(f, trn, ecn, func) {
			var _template = {
				"sales":""
			}
			var _form, _tr, _ecn;
			if(typeof f == 'string') {
                _form = $("#"+f);
			} else {
                _form = $(f);
			}

			if(ecn != "") {
                _ecn = ecn.split("|");
			} else {
                _ecn = new Array();
			}

            trn = parseInt(trn);
			if(isNaN(trn) || trn == 0) {
                _tr = _form.find("tr:last");
                if(_tr.size() == 0) {
                	return false;
				}
			} else {
				_tr = _form.find("tr").eq(trn-1);
				if(_tr.size() == 0) {
                    _tr = _form.find("tr:last");
                    if(_tr.size() == 0) {
                        return false;
                    }
				}
			}
			_tr = _tr.clone();
			var _index = 1;
			_tr.find("td").each(function() {
				var _findRetention = false;
				if(_ecn.length > 0) {
					for(var _i = 0;_i < _ecn.length;_i++) {
						if(_ecn[_i] == _index) {
                            _findRetention = true;
						}
					}
				}

				if(_findRetention) {
					$(this).find("input").val("");
				} else {
					$(this).html("");
				}

                _index++;
			});

            _form.find("table").append(_tr);
            if(typeof func == "function") {
                func(_tr);
			}
            return false;
		}
	};
})();

$(function(){
	_asr.init();
})
