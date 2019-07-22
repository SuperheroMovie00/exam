function summary_area_sel(url,obj,s,t,el_name){
		el=$(obj).parent().parent().parent();
		t=$(obj).parent().parent().attr("t");
		cur_p= $(el).find("dl[rel='city_sel_"+t+"']");
		if(!$(obj).hasClass("active"))
		{			
			cur_a=$(obj);
			var id=$(obj).attr("attr-id");
			$.getJSON(url, {"id": id }, function(json){
				cur_index=$(el).find("dl").index($(cur_a).parent().parent());
				$(el).find("dl:gt("+cur_index+")").each(function(){
					$(this).find("dd").each(function(){
						$(this).html("");
					});
				});														
				curdl=$(el).find("dl[rel='city_sel_"+t+"'] dd");
				$(curdl).html("");
				for(var k=0;k<json.length;k++)
				{
					$(curdl).append('<a href="javascript:"  attr-value="'+json[k].name+'" attr-id="'+ json[k].id +'">'+json[k].name+'</a>')
				}

				$(cur_a).addClass("active").siblings("a").removeClass("active");
				$(el).parent().find("input[name='"+el_name+"']").val("");
				$(el).find("dl .active").each(function(){
				  var curval=$(el).parent().find("input[name='"+el_name+"']").val();
				  if(curval!="")
  					{
						curval+="/";
  					}
					curval+=$(this).html();
					$(el).parent().find("input[name='"+el_name+"']").val(curval);
				});
				
				//cur_p= $(el).find("dl[rel='city_sel_"+t+"']");
				if(cur_p.length>0)
				{s
					cur_t=$(cur_p).attr("t");
					if(cur_t!="undifine" && cur_t!="")
					{
	  					$(el).find("dl[rel='city_sel_"+t+"'] a").bind("click",function(){
	  						summary_area_sel(url,this,t,cur_t,el_name);
	  					});
					}
				}else
					{
						$(el).hide()
					}
				$(el).parent().find(".add-tab a[rel='city_sel_"+s+"']").click();
				var cur_v=$(el).parent().find("input[name='"+el_name+"_"+t+"']").val();
				if(cur_v!="")
				{		  						
					$(el).find("dl[rel='city_sel_"+t+"'] a[attr-value='"+ cur_v +"']").click();
					$(el).parent().find("input[name='"+el_name+"_"+t+"']").val("");
				}		  					
				else
				{
  					if($(curdl).find("a").length==1)
  					{
  						$(curdl).find("a").eq(0).click();
  					}
  					else
  					{
  						$(el).parent().find(".add-tab a[rel='city_sel_"+t+"']").click();
  					}
				}
			});			
			
		}else
		{
				if(cur_p.length<=0)
				{
					$(el).hide();						
				}
		}			
}