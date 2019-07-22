var _asr = [];
(function(){
	_asr = {
		nav_seed: 0,
		zindex: 2000,
		popupcall: new Array(),
		init: function() {
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
				var _index = $("#menu ul li").index(this);
				$(".par-sub-menu").eq(_index-1).show();
			});
			
			$("#hid-btn").click(function(){
				$(".main").toggleClass( "main-hid", 1000 );
				$(this).toggleClass( "hid-faq", 1000 );
			    return false;
			});
			
			$("a[data-type=link]").click(function() {
				var _that = $(this);
				_this.openLink(_that.attr("href"), _that.attr("data-value"), _that.find("em").html(), 0, 1);
				return false;
			});
		},
		
		openLink: function(url, key, name, refresh, unique, target){
			if(typeof refresh == 'undefined') refresh = 0;
			if(url == '' && refresh == 1) {
				url = $("#" + key + "-last-url").val();
			}
			
			if(refresh == 1)
				unique = 0;
			
			if(typeof unique != "undefined" && unique == 1) {
				++this.nav_seed;
				key = key + "_" + this.nav_seed;
			}
			
			if(typeof(target) == 'undefined') {
				if(this.switchTab(key, name) || refresh == 1) {
					this.getLink(url, key, null, unique);
				}
			} else {
				this.getLink(url, key, target, unique);
			}
			
			return false;
		},
		
		getLink: function(url, key, obj, unique) {
			var callbackfunc;
			if(typeof(unique) == "undefined") unique = 0;
			if(typeof(obj) == "undefined" || obj == null || obj == "") {
				if(unique) {
					obj = $("div.content");
				} else {
					obj = $("#"+key);
				}
			}
			
			callbackfunc = function(c) {
				if(unique) {
					$(obj).append(c);
				} else {
					$(obj).replaceWith(c);
				}
			}
			this.load(key, url, unique, obj, callbackfunc);
		},
		
		switchTab: function(id, name) {
			var _tab = $("a[data-type=menu][data-value=" + id + "]");
			if(_tab.size() > 0) {
				if(_tab.parent().attr("class") == "active") return;
			}
			
			_tab.parents("ul").find("li").removeAttr("class");
			_tab.parent().attr("class", "active");
			
			$(".win-tab li").removeAttr("class");
			$(".wrap-box").hide();
			if($("#" + id + "-Tab").size() > 0) {
				$("#" + id + "-Tab").attr("class", "active");
				$("#" + id).show();
				
				return false;
			} else {
				if(typeof name != 'undefined' && name != "") {
					var _tab = "<li class=\"active\" id=\"" + id + "-Tab\" onclick=\"_asr.switchTab('" + id + "')\"><i class=\"iconfont\">&#xe609;</i><em>" + name +"</em><a href=\"javascript:void(0);\" class=\"iconfont close\" onclick=\"_asr.closeTab(this, '" + id + "')\">&#xe60d;</a></li>";
					$(".win-tab ul").append(_tab);
					return true;
				}
				
				return false;
			}
		},
		
		closeTab: function(o, id) {
			var _obj = $(o).parent();
			var _show = _obj.next();
			if(_show.size() == 0)
				_show = _obj.prev();
			
			$("#" + id).remove();
			_obj.remove();
			$("a[data-type=menu][data-value=" + id + "]").parent().removeAttr("class");
			
			if(_show.size() > 0) {
				this.switchTab(_show.attr("id").replace("-Tab", ""));
			}
			
			event.stopPropagation();
		},
		
		submit: function(id, formid, url, download) {
			var _this = this;
			var _form = "";
			//if(typeof formid == "undefined") return;
			
			if(typeof formid == "string") {
				if(formid != "") {
					_form = $("#" + formid);
				} else {
					_form = $("#__form-"+id+"__");
					
					if(_form.size() == 0) {
						$("body").append("<form id=\"__form-"+id+"__\" target=\"\" action=\"" + url + "\" style=\"display:none;\" method=\"post\"></form>");
						_form = $("#__form-"+id+"__");
					} else {
						_form.attr("action", url);
					}
				}
			} else {
				if($(formid).tagName == "FORM") {
					_form = $(formid);
				} else {
					_form = $(formid).parents("form");
				}
			}
			
			if(_form.size() == 0) return false;
			var _verify_ok = true;
			
			_form.find("[verify][verify!='']").each(function() {
				var _that = $(this);
				var _verify = _that.attr("verify").split("|");
				var _tips = _that.attr("tips").split("|");
				for(var _v in _verify) {
					if(_verify[_v] == "empty") {
						if(_that.val() == "") {
							_verify_ok = false;
							_that.focus();
							alert(_tips[_v]);
							return false;
						}
					}
				}
			});
			
			if(_verify_ok) {
				try {
					download = parseInt(download);
				} catch(e2) {
					download = 0;
				}
				
				if(_form.find("input[type=hidden][name=funcid]").size() == 0) {
					_form.append("<input type='hidden' name='funcid' value='" + id + "' />");
				}
				
				if(typeof(download) != "undefined" && download == 1) {
					var _post_data = _form.serialize();
					if(url.indexOf('?') >= 0) {
						url += "&" + _post_data;
					} else {
						url += "?" + _post_data;
					}
					
					var _ajaxForm = $("#__ajax-form__");
					
					if(_ajaxForm.size() == 0) {
						$("body").append("<form id=\"__ajax-form__\" target=\"\" action=\"" + url + "\" style=\"display:none;\" method=\"post\"></form>");
						_ajaxForm = $("#__ajax-form__");
					} else {
						_ajaxForm.attr("action", url);
					}
					
					_ajaxForm.submit();
					return false;
				}
				
				if(typeof(_form.attr("action")) == "undefined" && (typeof(url) == 'undefined' || url == "")) {
					url = $("#" + id).attr("baseurl");
				}
				
				if(typeof url != 'undefined' && url != "") {
					_form.attr("action", url);
				}
				
				this.showLoading();
				var _method = typeof _form.attr("method") == 'undefined' ? "get" : _form.attr("method");
				
				$.ajax({
					type:_method,
					url:_form.attr("action"),
					data:_form.serialize(),
					success: function(c) {
						try {
							c = eval("(" + c + ")");
							if(c.msg) {
								alert(c.msg);
							}
							
							_this.hideLoading();
							
							if(c.link) {
								$("#" + id).remove();
								_this.getLink(c.link, id);
							} else {
								if(c.func && typeof(eval(c.func)) == "function") {
									eval(c.func + "(" + c.funcParam + ")");
								} else {
									try {
										if(c.callback == "1" && typeof(eval(id + "_callback")) == "function") {
											eval(id + "_callback(" + c.funcParam + ")");
										}
									} catch(e1) {
										
									}
								}
							}
						}  catch(e) {
							var _target = $("#" + id);
							var _label = _this.isLabel(_target);
							_target.remove();
							if(_label)
								$("div.content").append(c);
							else
								$("body").append(c);
							
							try {
								if(typeof(eval(id + "_init")) == "function") {
									eval(id + "_init()");
								}
							} catch(e1) {
								
							}
							
							_this.hideLoading();
						}
					},
					error: function(e) {
						_this.hideLoading();
						alert(e.statusText);
					}
				});
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
		selectAll: function(o) {
			var _form = $(o).parents("div.table-box");
			if(_form.size() == 0) return;
			
			_form.find("input[type=checkbox][data-type=select]").prop("checked", $(o).prop("checked"));
			this.verify(o);
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
		},
		selectMulit: function(o) {
			this.verify(o);
		},
		
		verify: function(o) {
			var _condition = new Array();
			var _form = $(o).parents("div.table-box");
			var _div = _form.next();// _form.find("div.data-oper");
			if(_form.find("input[type=checkbox][data-type=select]:checked").size() == 0) {
				_div.find("input").each(function(){
					if(typeof $(this).attr("default-status") != "undefined" && $(this).attr("default-status") == 1) {
						$(this).removeAttr("disabled");
						$(this).attr("class", "btn btn-blue mrg_15");
					} else {
						$(this).attr("disabled","disabled");
						$(this).attr("class", "aaaa");
					}
				});
				return false;
			}
			
			
			_div.find("input[verify][verify=1]").each(function(){
				var _col_name = $(this).attr("column");
				var _col_value = $(this).attr("column-value");
				var _that = this;
				var _b = true;
				_form.find("input[type=checkbox][data-type=select]:checked").each(function() {
					var _td = $(this).parents("tr").find("td[column="+_col_name+"]");
					var _cv = _td.attr("column-value");
					if(_cv.substring(0,1) == "!") {
						if(_col_value == _td.attr("column-value")) {
							_b = false;
						}
					} else {
						if(_col_value != _td.attr("column-value")) {
							_b = false;
						}
					}
					
					return _b;
				});
				
				if(_b) {
					$(_that).removeAttr("disabled");
					$(_that).attr("class", "btn btn-blue mrg_15");
				} else {
					$(_that).attr("disabled","disabled");
					$(_that).attr("class", "aaaa");
				}
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
		popup1: function(c, k, f, m, cf, nf) {
			var url = "/index.php/Home/Popup/index?func="+c+"&selecttype=" + m;
			var form = $("#"+ f);
			if(form.size() == 0) return false;
			return this.popup(url, k,"", form.find("[name=" + cf + "]"), form.find("[name=" + nf + "]"));
		},
		popup: function(url, key, value, targetcode, targetname) {
			if(typeof(url) == 'undefined' || url == "") return false;
			if(typeof(key) == 'undefined' || key == "") return false;
			this.showLoading();
			var _this = this;
			$.ajax({
				type:"get",
				url: url,
				data: {funcid:key, value:value},
				success: function(c) {
					_this.zindex++;
					var _mask = "<div class=\"popup-bg\" id=\"" + key + "_mask\" style=\"z-index:" + _this.zindex + ";\"></div>"
					$("body").append(_mask);
					_this.zindex++;
					var _html = "<div class=\"prompt-pop\" id = \"" + key + "_popup\" style=\"z-index:" + _this.zindex + ";\">" + c + "</div>";
					$("body").append(_html);
					
					if(typeof(target) == "functioin") {
						_this.popupcall[key] = target;
					} else {
						_this.popupcall[key] = function() {
							var _popupvalue = "";
							var _popupshow = "";
							$("#"+key+"_popup input[type=checkbox]:checked").each(function() {
								if(_popupvalue != "") _popupvalue += "|";
								if(_popupshow != "") _popupshow += "|";
								_popupvalue += $(this).val();
								_popupshow += $(this).attr("show");
							});
							
							$(targetcode).val(_popupvalue);
							$(targetname).val(_popupshow);
						}
					}
					
					_this.hideLoading();
				},
				error: function(e) {
					_this.hideLoading();
					alert(e.statusText);
				}
			});
			
			return false;
		}, 
		closePopup: function(key) {
			$("#"+key+"_popup").remove();
			$("#"+key+"_mask").remove();
		},
		returnPopup: function(key) {
			if(this.popupcall.hasOwnProperty(key) && typeof(this.popupcall[key]) == "function") {
				this.popupcall[key]();
			}
			this.closePopup(key);
		},
		loadData: function(id, url, target, func) {
			if(url == "") return;
			var callbackfunc;
			if(typeof(func) == "string") {
				if(typeof(eval(id + "_"+func)) == "function") {
					callbackfunc = eval(id + "_"+func);
				}
			} else {
				callbackfunc = func;
			}
			this.load(id, url, 0, target, callbackfunc);
			return false;
		},
		showMask: function() {
			$("#mask").show();
		},
		hideMask: function() {
			$("#mask").hide();
		}, 
		showLoading: function() {
			//this.showMask();
		},
		hideLoading: function() {
			//this.hideMask();
		},
		showSearch: function(o) {
			var _button = $(o);
			var _div = _button.parents(".screening");
			var _ul = _div.find("ul");
			//var _splitflag = _div.find(".pos-line");
			var _height = _ul.height();// typeof(_ul.css("height")) == "undefined" ? 0 : _ul.css("height");
			//_height = _height.replace("px", "");
			//_height = parseInt(_height);
			var _max_height = _ul.find(".pos-line").offset().top - _ul.offset().top - _ul.find(".pos-line").height();
			
			if(_height > 111) {
				var i = setInterval(function(){
					if(_height > 111) {
						_height--;
						_ul.height(_height);
						//_ul.css("height", _height);
					} else {
						clearInterval(i);
					}
				}, 1);
			} else {
				var i = setInterval(function(){
					if(_height < _max_height) {
						_height++;
						_ul.height(_height);
						//_ul.css("height", _height);
					} else {
						clearInterval(i);
					}
				}, 1);
			}
			
			return false;
		}, 
		changePageSize: function(o, _funcid, _url) {
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
			
			if(_url[0] != "/") _url = "/" + _url;
			
			if(_url.indexOf("&pagesize=") < 0 && _url.indexOf("?pagesize=") < 0 &&  _url.indexOf("/pagesize/") < 0) {
				if(_url.indexOf('?') >= 0) {
					_url += "&pagesize=" + $(o).val();
				} else {
					_url += "?pagesize=" + $(o).val();
				}
			} else {
				var _s = "?";
				var _p = "=";
				if(_url.indexOf("&pagesize=") >= 0) {
					_s = "&";
				} else if(_url.indexOf("/pagesize/") >= 0) {
					_s = "/";
					_p = "/";
				}
				_url = _url.replace(/(&|[\?]|\/)pagesize(=|\/)\d+/g, _s + "pagesize" + _p + $(o).val());
			}
			
			this.loadData(_funcid, _url, $("#"+_funcid));
		},
		load: function(id, url, unique, target, func) {
			if(typeof url == "undefined" || url == "" || url == "javascript:void(0);") return false;
			var _that = this;
			
			if(url.indexOf("&funcid=") < 0 && url.indexOf("?funcid=") < 0 && url.indexOf("/funcid/") < 0) {
				if(url.indexOf('?') >= 0) {
					url += "&funcid=" + id;
				} else {
					url += "?funcid=" + id;
				}
			}
			
			$.get(url, {__ajax : "1"}, function(c) {
				if(c == "false") {
					alert("系统错误");
				} else {
					try {
						c = eval("(" + c + ")");
						if(c.msg) {
							alert(c.msg);
						}
						if(c.func) {
							if(c.funcParam != "") {
								eval(c.func + "(" + c.funcParam + ")");
							} else {
								eval(c.func + "()");
							}
						} else {
							try {
								if(c.callback == "1" && typeof(eval(id + "_callback")) == "function") {
									if(c.funcParam != "") {
										eval(id + "_callback(" + c.funcParam + ")");
									} else {
										eval(id + "_callback()");
									}
								}
							} catch(e1) {
								
							}
						}
					} catch(e) {
						if(typeof(func) == "function") {
							func(c);
						} else {
							if($(target).size() > 0) {
								$(target).replaceWith(c);
							} else {
								$("#"+id).replaceWith(c);
							}
						}
						
						try {
							if(typeof(eval(id+"_init")) == "function") {
								eval(id+"_init('" + key + "')");
							}
						} catch(e1) {
							
						}
						
		    			$(".prompt-pop").each(function(){
		    				var _pop_this = $(this);
		    				if(_pop_this.css("display") != "none") {
		    					var ppw = _pop_this.width()/2;
		    					_pop_this.css({'margin-left':-ppw});
		    				}
		    			});
					}
				}
			})
		},
		tabsheet: function(_id, _form, _val) {
			var form= $("#"+_form);
		     form.find("input[type=hidden][name=tab]").val(val);
		     this.submit(_id, _form);
		     return false;
		}, 
		showDetail: function(id, obj, url) {
			var _tr = $(obj).parents("tr");
			var _next = _tr.next();
			if(_next.size() > 0 && typeof(_next.attr("detail")) != "undefined" && _next.attr("detail") == "1") {
				if(_next.css("display") == "none") {
					_next.css("display", "");
				} else {
					_next.css("display", "none");
				}
				return false;
			}
			
			var callbackfunc;
			callbackfunc = function(c) {
				$(c).insertAfter(_tr);
			}
			
			this.load(id, url, 0, "", callbackfunc);
			return false;
		},
		setvaluebyname: function(formid, fieldname, val) {
			var target = $("#"+formid).find("[name="+fieldname+"]");
			target.each(function() {
				var _this = $(this);
				switch(_this.tagName) {
				case "INPUT":
					if(_this.attr("type") == "text" || _this.attr("type") == "hidden") {
						_this.val(val);
					} else if(_this.attr("type") == "checkbox" || _this.attr("type") == "radio") {
						_this.prop("checked", val);
					}
					break;
				case "SELECT":
					_this.val(val);
					break;
				
				}
			});
		}
	};
})();

$(function(){
	_asr.init();
})