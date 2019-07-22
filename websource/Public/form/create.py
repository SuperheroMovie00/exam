#encoding=utf-8

import os,os.path,json,sys,re

tpl="""<?php
namespace Home\Controller;
use Common\Common\CURDTools;
class #className#Controller extends BasicController {
    public function load(){
        $id=intval(I("get.id"));
        $curd=new CURDTools();
        $r=$curd->getToJSONDataQuick("#tableName#","id=$id");

        echo $r;
    }

    public function save(){
        $curd=new CURDTools();

		$luckyId=I("post.lucky_form_id");
        $data=array(
#data#
        );

#passData#


        $curd->setToJSONDataQuick('#tableName#',$data,'',function(){
        	S('#className#',NULL);
        });
    }

    public function view(){
        $id=intval(I("get.id"));
        $curd=new CURDTools();
        $r=$curd->getToJSONDataQuick("#tableName#","id=$id");
		
		$r=json_decode($r);
        
        foreach ($r as $k=>$v) {
            $v->readonly=true;
        }

		$r=json_encode($r);

        echo $r;
    }

    public function del(){
        $id=intval(I("get.id"));
        $curd=new CURDTools();
        $r=$curd->del("#tableName#","id=$id");

    }
	

}
"""

jsTpl=""""""

oldBtn=ur"""onclick="return _asr.openLink\('<\?php echo U\("#className#Add\/index\?func=add&"\) \?>','#className#Add#add#\{\}','(.*)?',0\);" """
newBtn=r"""onclick="getPop(0,'\1','{:U("Home/#className#/get#className#")}','{:U("Home/#className#/save#className#")}',<?php echo "$funcid"; ?>_deal#className#Alert);" """
oldEditBtn=ur"""onclick="return _asr.openLink\('<\?php echo U\("#className#View\/index\?func=edit&id=\$master\[id\]"\) \?>','#className#View#edit#\{id=\$master\[id\]\}','(.*)?',0\);"> """
newEditBtn=r"""onclick="getPop({$master[id]},'\1','{:U("Home/#className#/get#className#")}','{:U("Home/#className#/save#className#")}',<?php echo "$funcid"; ?>_deal#className#Alert);"> """


oldBtn2=ur""" onclick="return _asr.popupFun\('<\?php echo U\("#className#Add/index\?func=add&"\) \?>','#className#Add_add_'\); " """
newBtn2=r"""onclick="getPop(0,'新增<?php echo getTitleName("#className#"); ?>','{:U("Home/#className#/get#className#")}','{:U("Home/#className#/save#className#")}',<?php echo "$funcid"; ?>_deal#className#Alert);" """
oldEditBtn2=ur"""onclick="return _asr.popupFun\('<\?php echo U\("#className#View\/index\?func=edit&id=\$master\[id\]"\) \?>','#className#View_edit_id=\$master\[id\]'\); "> """
newEditBtn2=r"""onclick="getPop({$master[id]},'修改<?php echo getTitleName("#className#"); ?>','{:U("Home/#className#/get#className#")}','{:U("Home/#className#/save#className#")}',<?php echo "$funcid"; ?>_deal#className#Alert);"> """


createFilePath="../../Application/Home/Controller"
createJSFilePath="../../Application/Summary/View"
for parent,dirnames,filenames in os.walk("./conf"):
	for filename in filenames:
		filePath=os.path.join(parent,filename)
		fileTuple=os.path.splitext(filename)
		className=fileTuple[0].split("_")
		classNameString=""
		for c in className:
			classNameString+=c.capitalize()		
		controllerName=createFilePath+"/"+classNameString+"Controller.class.php"
		jsName=createJSFilePath+"/"+classNameString+"Summary/index.html"
		if not os.path.exists(controllerName):
			file_json_object = open(filePath, 'r')
			config = json.loads(file_json_object.read())
			getData=""
			upData=""
			for c in config:
				# if not config[c].has_key('update') or config[c]['update']!=False:
				getData+=("""\t\t'#key#'  =>I("post.{$luckyId}_#key#"),\n""").replace("#key#",c)
				if c=="modify_time":
					upData+="""\t\t$data['modify_time']=date("Y-m-d H:i:s");\n"""
					continue
				if c=="modify_user":
					upData+="""\t\t$data['modify_user']=session(C("USER_AUTH_KEY"));\n"""	
					continue	
				if c=="modify_user_id":
					upData+="""\t\t$data['modify_user_id']=$this->user['id'];\n"""	
					continue									
				if c=="create_time":
					upData+="""\t\t$data['create_time']=intval($data['id'])>0?null:date("Y-m-d H:i:s");\n"""
					continue
				if c=="create_user":
					upData+="""\t\t$data['create_user']=intval($data['id'])>0?null:session(C("USER_AUTH_KEY"));\n"""
					continue
				if c=="create_user_id":
					upData+="""\t\t$data['create_user_id']=intval($data['id'])>0?null:$this->user['id'];\n"""	
					continue						
				if config[c].has_key('update') and config[c]['update']==False:
					upData+="""\t\t$data['#key#']=intval($data['id'])>0?null:$data['#key#'];\n""".replace("#key#",c)
					continue


			file_object = open(controllerName, 'w')

			code=tpl
			code=code.replace("#data#",getData)
			code=code.replace("#passData#",upData)
			code=code.replace("#tableName#",fileTuple[0])
			code=code.replace("#className#",classNameString)
			file_object.write(code)
			file_object.close() 
			if  os.path.exists(jsName):
				html=jsTpl
				html=html.replace("#className#",classNameString)
				file_object = open(jsName, 'a+')
				file_object.write(html)
				file_object = open(jsName, 'r')
				html=file_object.read()
				oldBtnTpl=oldBtn
				newBtnTpl=newBtn
				oldEditBtnTpl=oldEditBtn
				newEditBtnTpl=newEditBtn
				oldBtnTpl2=oldBtn2
				newBtnTpl2=newBtn2
				oldEditBtnTpl2=oldEditBtn2
				newEditBtnTpl2=newEditBtn2

				oldBtnTpl=oldBtnTpl.replace("#className#",classNameString)
				newBtnTpl=newBtnTpl.replace("#className#",classNameString)
				reObj=re.compile(oldBtnTpl)
				result, number = reObj.subn(newBtnTpl, html.decode('utf-8'))

				oldBtnTpl2=oldBtnTpl2.replace("#className#",classNameString)
				newBtnTpl2=newBtnTpl2.replace("#className#",classNameString)
				reObj=re.compile(oldBtnTpl2)
				result, number = reObj.subn(newBtnTpl2, result.decode('utf-8'))

				oldEditBtnTpl=oldEditBtnTpl.replace("#className#",classNameString)
				newEditBtnTpl=newEditBtnTpl.replace("#className#",classNameString)
				reObj=re.compile(oldEditBtnTpl)
				result, number = reObj.subn(newEditBtnTpl, result)

				oldEditBtnTpl2=oldEditBtnTpl2.replace("#className#",classNameString)
				newEditBtnTpl2=newEditBtnTpl2.replace("#className#",classNameString)
				reObj=re.compile(oldEditBtnTpl2)
				result, number = reObj.subn(newEditBtnTpl2, result)				

				file_object = open(jsName, 'w')
				file_object.write(result)
				file_object.close() 
