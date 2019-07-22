function delcfm(obj,d_tr) {	
	if (confirm("确认要删除？")) {
		url=$(obj).attr('url');
		$.post(
				url,function(data){
					if(data.error==0){
						alert("删除成功！");
						$("#"+d_tr).remove();
					}else{
						alert(data.msg);//$(obj).attr('url'));
					}
				},"json");	

	}
  }



//切换地区
function toggleArea(area_id,last_parent_id)
{
	var is_cache = $('#ctrl_'+area_id).attr('is_cache');
	var is_open  = $('#ctrl_'+area_id).attr('is_open');	
	var url  = $('#ctrl_'+area_id).attr('url');

	//缓存存在
	if(is_cache == 'yes')
	{
		$('[name="parent_'+area_id+'"]').toggle();
	}
	else
	{
		$.post(
				url,function(data){
					if(data.error==0){						
						for(var item in data.list)
						{
							$('#tr_'+area_id).after(template.render('agentTemplate',{'item':data.list[item],'last_parent_id':last_parent_id}));
						}
						/*
						var html = template.render('agentTemplate', data.list);
						alert(html);
						$('#tr_'+area_id).after(html);
						*/
						//$("#"+d_tr).remove();
					}else{
						alert(data.msg);
					}
				},"json");
		/*
		$.getJSON('{url:/block/area_child}',{"aid":area_id},function(jsonData){
			for(var item in jsonData)
			{
				$('#area_'+area_id).after(template.render('areaRowTemplate',{'item':jsonData[item],'last_parent_id':last_parent_id}));
			}
		});
		*/
		
		
		$('#ctrl_'+area_id).attr('is_cache','yes');
	}

	//是否已经展开
	if(is_open == 'yes')
	{
		$('#ctrl_'+area_id).attr('src',$('#img_open').val());
		$('#ctrl_'+area_id).attr('is_open','no');
	}
	else
	{
		$('#ctrl_'+area_id).attr('src',$('#img_close').val());
		$('#ctrl_'+area_id).attr('is_open','yes');
	}
}



function show_child(d_tr){
	doc_a=$("#"+d_tr).find("a").eq(0);
	doc_a.text("-");
	doc_a.attr("onclick","javascript:hidden_child('"+d_tr+"');");	
	url=doc_a.attr('url');
	
	$.post(
			url,function(data){
				if(data.error==0){
					alert(data.data);
					//$("#"+d_tr).remove();
				}else{
					alert(data.msg);
				}
			},"json");
	alert('展开');
	
}

function hidden_child(d_tr){
	doc_a=$("#"+d_tr).find("a").eq(0);
	doc_a.text("+");
	doc_a.attr("onclick","javascript:show_child('"+d_tr+"');");	
	var name=d_tr.replace("tr_", "parent_");	
	//$(" tr [name='"+name+"']").remove();
	alert('关闭');
}


function update_department(){
	var option_str="";
	var hospital_id=$("[name='hospital_id']").val();
	if(hospital_id>0){
		url=$('#get_department_url').val();
		$.post(
				url,{'hospital_id':hospital_id},function(data){
					if(data.error==0){						
						for(var item in data.list)
						{
							option_str+="<option value='"+data.list[item].id+"'>"+data.list[item].name+"</option>"
						}
						$("[name='department_id']").html(option_str);
					}else{
						alert(data.msg);
					}
				},"json");
	}	
}