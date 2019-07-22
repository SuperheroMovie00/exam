<?php
namespace Home\Controller;

//
//注释: Effects - 物品信息
//
use Home\Controller\BasicController;
use Think\Log;
class EffectsController extends BasicController {

    public function _init() {
        $funcs = $this->getUserRoleList($this->user,array( '/Home/Effects', 'Effects', ));
        if ($funcs)
            $this->assign("rights",  $funcs);
        else{
            $funcs = array(
                         array("key"=>"add","func"=>"/Home/Effects","Action"=>"add") ,
                         array("key"=>"refresh","func"=>"Effects","Action"=>"refresh") ,
                         array("key"=>"import","func"=>"/Home/Effects","Action"=>"import") ,
                         array("key"=>"save","func"=>"/Home/Effects","Action"=>"save") ,
                         array("key"=>"search","func"=>"/Home/Effects","Action"=>"view") ,
                         array("key"=>"detail_import","func"=>"/Home/Effects","Action"=>"detail_import") ,
                         array("key"=>"detail_select","func"=>"/Home/Effects","Action"=>"selectproduct") ,
                         array("key"=>"tabyanqishenqing","func"=>"/Home/Effects","Action"=>"tabyanqishenqing") ,
                         array("key"=>"tabwupinyidong","func"=>"/Home/Effects","Action"=>"tabwupinyidong") ,
                         array("key"=>"tabxinxichulirizhi","func"=>"/Home/Effects","Action"=>"tabxinxichulirizhi") ,
                         array("key"=>"edit_base","func"=>"/Home/Effects","Action"=>"edit_base") ,
                         array("key"=>"order_edit","func"=>"/Home/Effects","Action"=>"edit_base") ,
                         array("key"=>"order_delete","func"=>"/Home/Effects","Action"=>"delete") ,
                         array("key"=>"status_on","func"=>"/Home/Effects","Action"=>"status_on") ,
                         array("key"=>"status_off","func"=>"/Home/Effects","Action"=>"status_off") ,
                         array("key"=>"master_view","func"=>"/Home/Effects","Action"=>"view") ,
                         array("key"=>"master_edit","func"=>"/Home/Effects","Action"=>"edit") ,
                         array("key"=>"master_delete","func"=>"/Home/Effects","Action"=>"delete")
             );
            $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"Effects"));
    }

    public function index() {
      $data["pfuncid"] = I("request.pfuncid");
      $data["funcid"] = I("request.funcid");
      $data["zindex"] = I("request.zindex/d");
      if(empty($data["funcid"])) $data["funcid"] = "Effects";
      $this->GetLastUrl($data["funcid"]);

      $func = I("request.func");
      if($func != "saveSelectProduct" && $func != "save") {
        $this->GetLastUrl($data["funcid"]);
      }

      switch ($func) {

//// case for add ////
        case "edit":
        case "edit_base":
        case "add":
          $this->add($data);
          break;
        case "save":
          $this->save($data);
          break;
//// case for import ////
        case "import":
          $this->import($data);
          break;
        case "import_save":
          $this->import_save($data);
          break;
//// case for status_on ////
        case "status_on":
          $this->status_on($data);
          break;
        case "status_on_save":
          $this->status_on_save($data);
          break;
//// case for status_off ////
        case "status_off":
          $this->status_off($data);
          break;
        case "status_off_save":
          $this->status_off_save($data);
          break;
//##combine_for_add_switch_case##

//// case for view ////
        case "view":
          $this->view($data);
          break;
        case "delete":
          $this->order_delete($data);
          break;
        case "detail_delete":
          $this->detail_delete($data);
          break;
        case "detail_add":
          $this->selectProduct($data);
          break;
        case "saveSelectProduct":
          $this->saveSelectProduct($data);
          break;
            default:
          $this->ajax_refresh($data ['funcid']);
          $this->ajaxResult("" );
          break;

      }
    }

//// source for add - begin ////
    private function add($data) {
       $id = I("request.id/d");
       if(!$id){
          //读接入参数
          $company_id = I("request.company_id");
          $category_code = I("request.category_code");
          $code = I("request.code");
          $name = I("request.name");
          $alias = I("request.alias");
          $prefix = I("request.prefix");
          $barcode = I("request.barcode");
          $is_kef = I("request.is_kef");
          $is_real = I("request.is_real");
          $department_id = I("request.department_id");
          $address = I("request.address");
          $custodian_id = I("request.custodian_id");
          $approval_require = I("request.approval_require");
          $allow_borrow = I("request.allow_borrow");
          $limit_days = I("request.limit_days/d",0);
          //赋初值
          $search["company_id"] = $company_id?$company_id:"";  //第一个选项
          $search["category_code"] = $category_code?$category_code:"";
          $search["code"] = $code?$code:"";
          $search["name"] = $name?$name:"";
          $search["alias"] = $alias?$alias:"";
          $search["prefix"] = $prefix?$prefix:"";
          $search["barcode"] = $barcode?$barcode:"";
          $search["is_kef"] = $is_kef?$is_kef:"0";  //第一个选项
          $search["is_real"] = $is_real?$is_real:"0";  //第一个选项
          $search["department_id"] = $department_id?$department_id:"";  //第一个选项
          $search["address"] = $address?$address:"";
          $search["custodian_id"] = $custodian_id?$custodian_id:"";  //第一个选项
          $search["approval_require"] = $approval_require?$approval_require:"0";  //第一个选项
          $search["allow_borrow"] = $allow_borrow?$allow_borrow:"0";  //第一个选项
          $search["limit_days"] = $limit_days?$limit_days:"";
       } else {
          $search = M(effects)->find($id);
          if(!$search){
              $this->ajaxResult("物品信息数据不存在" );
          }
          $data["id"] = $search["id"];
       }
       $data["search"] = $search;
       //检查popup返回name
       if($data['search']['category_code']){
          $ret=M( "effects_category" ) ->field("name") ->where("code='".$data['search']['category_code']."'") ->find();
          if($ret){
               $data["search"]["category_code_name"] = $ret["name"];
          }
       }
       foreach($data as $key=>$val) {
           $this->assign($key, $val);
       }
       $html = $this->fetch("Effects:add");
       echo $html;
    }
    private function save($data) {
       $id=I("request.id/d" );
       //读取页面输入数据
       $company_id = I("request.company_id");
       $category_code_name = I("request.category_code_name");
       $category_code = I("request.category_code");
       $code = I("request.code");
       $name = I("request.name");
       $alias = I("request.alias");
       $prefix = I("request.prefix");
       $barcode = I("request.barcode");
       $content = I("request.content");
       if($_FILES['img'] && $_FILES['img']['error']==0){
           $upload = new \Think\Upload();// 实例化上传类
           $upload->maxSize   =     3145728 ;// 设置附件上传大小
           $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
           $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
           $upload->savePath  =     ''; // 设置附件上传（子）目录
           // 上传文件
           $info = $upload->upload();
           $img=trim($upload->rootPath,'.').$info['img']['savepath'].$info['img']['savename'];
       }else{
           $img=false;
       }
       $is_kef = I("request.is_kef");
       $is_real = I("request.is_real");
       $department_id = I("request.department_id");
       $address = I("request.address");
       $custodian_id = I("request.custodian_id");
       $approval_require = I("request.approval_require");
       $allow_borrow = I("request.allow_borrow");
       $limit_days = I("request.limit_days/d",0);
       //非页面输入字段
       $input = array();
       //数据有效性校验，非空/数值负数，范围/日期与今日比较
       //数据校验 - 必输项不能为空
       if(!verify_value($code,"empty","","")) $this->ajaxError("物品编码 不能为空");
       if(!verify_value($name,"empty","","")) $this->ajaxError("物品名称 不能为空");
       if(!verify_value($limit_days,"nagitive","","")) $this->ajaxError("天数限制 不能为负数");
           //if ($limit_days < 100 || $limit_days > 105) $this->ajaxError("校验样例 天数限制值在100-105之间");
       if($company_id){
           $ret = M("company") ->field("id,code,name,status") ->where(" id='$company_id' ")->find();
           if(!$ret)  $this->ajaxError("所属公司不存在");
           if($ret['status']==0 || $ret['status']==8)   $this->ajaxError("所属公司非有效状态");
       }
       if($category_code){
           $ret = M("effects_category") ->field("id,code,name,status") ->where(" code='$category_code' ")->find();
           if(!$ret)  $this->ajaxError("物品分类不存在");
           if($ret['status']==0 || $ret['status']==8)   $this->ajaxError("物品分类非有效状态");
       }
       if($department_id){
           $ret = M("department") ->field("id,code,name,status") ->where(" id='$department_id' ")->find();
           if(!$ret)  $this->ajaxError("保管部门不存在");
           if($ret['status']==0 || $ret['status']==8)   $this->ajaxError("保管部门非有效状态");
       }
       if($custodian_id){
           $ret = M("user") ->field("id,code,name,status") ->where(" id='$custodian_id' ")->find();
           if(!$ret)  $this->ajaxError("保管人员不存在");
           if($ret['status']==0 || $ret['status']==8)   $this->ajaxError("保管人员非有效状态");
       }
       $model = M("effects");
       //判断 code 是否重复建立
       $orig = $model->where("code='$code'".($id?" and id!=$id":""))->find();
       if ($orig) $this->ajaxError("物品编码 $code 已存在");
       //页面输入字段
       $input["company_id"] = $company_id;
       $input["category_code_name"] = $category_code_name;
       $input["category_code"] = $category_code;
       $input["code"] = $code;
       $input["name"] = $name;
       $input["alias"] = $alias;
       $input["prefix"] = $prefix;
       $input["barcode"] = $barcode;
       $input["content"] = $content;
       if($img!=false)
          $input["img"] = $img;
       $input["is_kef"] = $is_kef;
       $input["is_real"] = $is_real;
       $input["department_id"] = $department_id;
       $input["address"] = $address;
       $input["custodian_id"] = $custodian_id;
       $input["approval_require"] = $approval_require;
       $input["allow_borrow"] = $allow_borrow;
       $input["limit_days"] = $limit_days;
       $input["modify_user"] = session(C("USER_AUTH_KEY"));
       $input["modify_time"] =  date('Y-m-d H:i:s.n');
       $model->startTrans();
       $result=false;
       //需要存入日志的字段
       $needSave=array(
            'company_id'=>'所属公司',
            'category_code'=>'物品分类',
            'code'=>'物品编码',
            'name'=>'物品名称',
            'alias'=>'物品别名',
            'prefix'=>'助记码',
            'barcode'=>'物品条码',
            'is_kef'=>'是否管控',
            'is_real'=>'是否实物',
            'department_id'=>'保管部门',
            'address'=>'保管地点',
            'custodian_id'=>'保管人员',
            'approval_require'=>'审核要求',
            'allow_borrow'=>'允许外借',
            'limit_days'=>'天数限制',
       );
       if(!$id) {
          //新增  建号操作
          $input["create_user"] = session(C("USER_AUTH_KEY"));
          $input["create_time"] = date('Y-m-d H:i:s.n');
          //新增数据 保存数据库
          $result = $id = $model->add($input);
          //建立操作日志
          $result = $result && createLogCommon('effects',$id,'新增物品信息','',"*",'code');
       } else {
          //id存在时判断数据库内数据是否存在
          $orig=$model->where("id='%d'",array($id))->find();
          if(empty($orig)) {
               $this->ajaxError("物品信息数据不存在");
          }
          //按主键更新数据
          $result = $model->where("id = $id")->save($input);
          $isSaveLog=false;
          foreach ($needSave as $key=>$v) {
              if($orig[$key]!=$input[$key]) {
                  $isSaveLog=true;
                  break;
              }
          }
          if($isSaveLog){
            //建立操作日志
            $result = $result && createLogCommon('effects',$id,'变更物品信息',$orig,'','','code',$needSave);
          }
       }
       if($result){
           $model->commit();
       }else{
           $model->rollback();
           echo json_encode(array("msg"=>message("物品信息保存发生错误")));
           die;
       }
       //完成后跳转
       $this->ajaxReturn($data ['pfuncid'],$data ['funcid'],"refresh", "","closepopup", 1 );
       //转到view页面
       $this->ajaxReturn("","",U("Effects/index?func=view&id=$id&pfuncid=".$data ['pfuncid']), tabtitle('物品',$input["code"] ) );
       die;
    }
//// source for add - end ////
//// source for import - begin ////
    private function import($data){
      $data['orderid'] = I("get.id");
      foreach($data as $key=>$val) {
        $this->assign($key, $val);
      }
      $html = $this->fetch("Effects:import");
      echo $html;
    }
    private function cattext($string, $txt)
    {
        if($string)$string.=",";
        return $string.$txt;
    }
    private function import_save($data)
    {
        $orderid = I("request.orderid/d");
        $file = $_FILES;
        /* ========================================== */
        /* 上传文件 - 判断文件类型csv读取内容         */
        /* ========================================== */
        if (empty($file)) {
            $this->ajaxResult("导入失败:请上传csv文件");
        }
        if (isset($file["import"]) && $file["import"]["error"] == 0) {
            if (is_uploaded_file($file['import']['tmp_name'])) {
                if (substr($file['import']['name'], -4) != ".csv") {
                    $this->ajaxResult("导入失败:请上传csv文件");
                }
            }
        }
        /* ==================================================== */
        /* 上传文件 - 标题行列内容、列数、标题行、数据起始行    */
        /* ==================================================== */
        $header = array(
            "company_id" => "所属公司",
            "category_code" => "物品分类",
            "code" => "物品编码",
            "name" => "物品名称",
            "alias" => "物品别名",
            "prefix" => "助记码",
            "barcode" => "物品条码",
            "is_kef" => "是否管控",
            "is_real" => "是否实物",
            "department_id" => "保管部门",
            "address" => "保管地点",
            "custodian_id" => "保管人员",
            "approval_require" => "审核要求",
            "allow_borrow" => "允许外借",
            "limit_days" => "天数限制",
                       );
        $row_header = 1;
        $row_data = 2;
        $field = array_keys($header);
        $field_count = count($field);
        /* =========================== */
        /* 上传文件 - 读取内容         */
        /* =========================== */
        $h = fopen($file['import']['tmp_name'], 'r');
        $importdatas = array();
        $n = 1;
        while ($row = fgetcsv($h)) {
            if ($n < $row_header) {
                $n++;
                continue;
            }
            $num = count($row);
            if ($n == $row_header) {
                if ($field_count != $num) $this->ajaxResult("导入失败:标题列数与模板不一致");
            } else if ($num > $field_count) {
                $num = $field_count;
            }
            for ($i = 0; $i < $num; $i++) {
                if ($n == 1) continue;
                $importdatas[$n][$field[$i]] = mb_convert_encoding($row[$i], 'utf-8', 'gbk');
            }
            $n++;
        }
        fclose($h);
        if ($n < $row_data) $this->ajaxResult("导入失败:文件内没有数据");
        /* =========================== */
        /* 上传文件 - 标题校验         */
        /* =========================== */
        $err = "";
        foreach ($importdatas[$row_header] as $key => $value) {
            if ($header[$key] != $value) $err = $this->cattext($err, $value);
        }
        if ($err) $this->ajaxResult("导入失败:标题列[$err]与模板定义不一致");
        /* =========================== */
        /* 上传文件 - 数据校验         */
        /* =========================== */
        $i = 0;
        foreach ($importdatas as $k => $row) {
            if ($k >= $row_data) {
               $err_type = "";
               $err_empty = "";
               $err_exist = "";
               if(!verify_value($row["code"],"empty","","")) $err_empty=$this->cattext($err_empty, $header["code"]);
               if(!verify_value($row["name"],"empty","","")) $err_empty=$this->cattext($err_empty, $header["name"]);
               if (strlen($row["company_id"])>0) {
               //数值类型校验
                  if (!verify_value($row["company_id"], "num"))
                      $err_type = $this->cattext($err_type, $header["company_id"]);
                  else
                      if ($row["company_id"] < 0) $err_exist = $this->cattext($err_exist, $header["company_id"] . "是负数");
               }
               if (strlen($row["is_kef"])>0) {
               //数值类型校验
                  if (!verify_value($row["is_kef"], "num"))
                      $err_type = $this->cattext($err_type, $header["is_kef"]);
                  else
                      if ($row["is_kef"] < 0) $err_exist = $this->cattext($err_exist, $header["is_kef"] . "是负数");
               }
               if (strlen($row["is_real"])>0) {
               //数值类型校验
                  if (!verify_value($row["is_real"], "num"))
                      $err_type = $this->cattext($err_type, $header["is_real"]);
                  else
                      if ($row["is_real"] < 0) $err_exist = $this->cattext($err_exist, $header["is_real"] . "是负数");
               }
               if (strlen($row["department_id"])>0) {
               //数值类型校验
                  if (!verify_value($row["department_id"], "num"))
                      $err_type = $this->cattext($err_type, $header["department_id"]);
                  else
                      if ($row["department_id"] < 0) $err_exist = $this->cattext($err_exist, $header["department_id"] . "是负数");
               }
               if (strlen($row["custodian_id"])>0) {
               //数值类型校验
                  if (!verify_value($row["custodian_id"], "num"))
                      $err_type = $this->cattext($err_type, $header["custodian_id"]);
                  else
                      if ($row["custodian_id"] < 0) $err_exist = $this->cattext($err_exist, $header["custodian_id"] . "是负数");
               }
               if (strlen($row["approval_require"])>0) {
               //数值类型校验
                  if (!verify_value($row["approval_require"], "num"))
                      $err_type = $this->cattext($err_type, $header["approval_require"]);
                  else
                      if ($row["approval_require"] < 0) $err_exist = $this->cattext($err_exist, $header["approval_require"] . "是负数");
               }
               if (strlen($row["allow_borrow"])>0) {
               //数值类型校验
                  if (!verify_value($row["allow_borrow"], "num"))
                      $err_type = $this->cattext($err_type, $header["allow_borrow"]);
                  else
                      if ($row["allow_borrow"] < 0) $err_exist = $this->cattext($err_exist, $header["allow_borrow"] . "是负数");
               }
               if (strlen($row["limit_days"])>0) {
               //数值类型校验
                  if (!verify_value($row["limit_days"], "num"))
                      $err_type = $this->cattext($err_type, $header["limit_days"]);
                  else
                      if ($row["limit_days"] < 0) $err_exist = $this->cattext($err_exist, $header["limit_days"] . "是负数");
               }
               if(strlen($row["company_id"])>0){
                   $ret = M("company") ->field("id,code,name,status") ->where(" id='".$row["company_id"]."' ")->find();
                   if(!$ret)  $err_exist = $this->cattext($err_exist, $header["company_id"]."不存在");
                   if($ret['status']==0 || $ret['status']>=7) $this->cattext($err_exist, $header["company_id"]."非有效状态");
               }
               if(strlen($row["category_code"])>0){
                   $ret = M("effects_category") ->field("id,code,name,status") ->where(" code='".$row["category_code"]."' ")->find();
                   if(!$ret)  $err_exist = $this->cattext($err_exist, $header["category_code"]."不存在");
                   if($ret['status']==0 || $ret['status']>=7) $this->cattext($err_exist, $header["category_code"]."非有效状态");
               }
               if(strlen($row["department_id"])>0){
                   $ret = M("department") ->field("id,code,name,status") ->where(" id='".$row["department_id"]."' ")->find();
                   if(!$ret)  $err_exist = $this->cattext($err_exist, $header["department_id"]."不存在");
                   if($ret['status']==0 || $ret['status']>=7) $this->cattext($err_exist, $header["department_id"]."非有效状态");
               }
               if(strlen($row["custodian_id"])>0){
                   $ret = M("user") ->field("id,code,name,status") ->where(" id='".$row["custodian_id"]."' ")->find();
                   if(!$ret)  $err_exist = $this->cattext($err_exist, $header["custodian_id"]."不存在");
                   if($ret['status']==0 || $ret['status']>=7) $this->cattext($err_exist, $header["custodian_id"]."非有效状态");
               }
               if ($err_empty || $err_exist || $err_type) {
                   $err .= "第 " . ($i + $row_data) . " 行校验失败\n";
                   if ($err_empty) $err .= "    数据为空: " . $err_empty . "\n";
                   if ($err_exist) $err .= "    数据非法：" . $err_exist . "\n";
                   if ($err_type) $err .= "    类型非法: " . $err_type . "\n";
               }
           }
           $i++;
       }
       //判断 code 是否重复建立
       $i = 0;
       foreach ($importdatas as $k => $row) {
           if ($k >= $row_data){
               $j=0;
               foreach ($importdatas as $k1 => $row1) {
                  if ($k1 >= $row_data and $k1>$k ){
                     if($row["code"]==$row1["code"]){
                         $err .= "第 " . ($i + $row_data). " 与 " . ($j + $row_data). " 行 ".$header["code"] ."\n";
                     }
                  }
                  $j++;
               }
           }
           $i++;
       }
       if ($err) {
           $this->ajaxResult("数据重复:\n" . $err);
       }
       $model = M("effects");
       //关键字重复导入覆盖方式
       $overwrite=true;
       if(!$overwrite){ //非覆盖方式检查是否重复
          //判断 code 是否重复建立
          $i = 0;
          foreach ($importdatas as $k => $row) {
             if ($k >= $row_data){
                $m = $model->where("code='".$row["code"]."'")->find();
                if ($m) $err .= "第 " . ($i + $row_data). " 行 ".$header["code"]."\n";
             }
             $i++;
          }
          if ($err) {
              $this->ajaxResult("数据存在:\n" . $err);
          }
       }
       /* =========================== */
       /* 上传文件 - 数据存储         */
       /* =========================== */
        $model->startTrans();
        $total=0;
        $new=0;
        $edit=0;
        foreach ($importdatas as $row) {
            $input = array();
            $id = 0;
            $m = array();
            //非导入字段-赋初值
            //导入字段
            $input["company_id"] = $row["company_id"];
            $input["category_code"] = $row["category_code"];
            $input["code"] = $row["code"];
            $input["name"] = $row["name"];
            $input["alias"] = $row["alias"];
            $input["prefix"] = $row["prefix"];
            $input["barcode"] = $row["barcode"];
            $input["is_kef"] = $row["is_kef"];
            $input["is_real"] = $row["is_real"];
            $input["department_id"] = $row["department_id"];
            $input["address"] = $row["address"];
            $input["custodian_id"] = $row["custodian_id"];
            $input["approval_require"] = $row["approval_require"];
            $input["allow_borrow"] = $row["allow_borrow"];
            $input["limit_days"] = $row["limit_days"];
            //modify_user/time字段
            $input["modify_user"] = session(C("USER_AUTH_KEY"));
            $input["modify_time"] =  date('Y-m-d H:i:s.n');
            //检查是否存在
            //样例 $m = $model->where("code='".$row["code"]."'")->find();
            $orig = $model->where("code='".$row["code"]."'")->find();
            if (!$orig) {
                  //新增
                $input["create_user"] = session(C("USER_AUTH_KEY"));
                $input["create_time"] =  date('Y-m-d H:i:s.n');
                $result = $id = $model->add($input);
                $new++;
                //建立操作日志
                    $result = $result && createLogCommon('effects', $id, '数据导入(新增)',$orig,'','','code',$header);
            } else {
                  //覆盖
                $id = $orig['id'];
                $result = $model->where("id=$id")->save($input);
                $edit++;
                //建立操作日志
                $result = $result && createLogCommon('effects',$id,'数据导入(覆盖)',$orig,'','','code',$header);
            }
            if (!$result) {
                break;
            }
            $total++;
        }
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
        }
        $this->ajax_hideConfirm();
        $this->ajax_closePopup($data ['funcid']);
        $this->ajax_refresh($data ['pfuncid']);
        $this->ajaxResult("本次导入 $total 条, 新增 $new 条, 覆盖 $edit 条");
        die;
        //$this->ajaxReturn($data ['pfuncid'], $data ['funcid'], "refresh", "", "closepopup");
    }
//// source for import - end ////
//// source for status_on - begin ////
    private function status_on($data) {
        $id = I("request.id/d");
        if(!$id) {
             $this->ajaxResult("物品信息参数不存在");
        }
        $search = M('effects')->find($id);
        if(!$search)
            $this->ajaxResult("物品信息不存在");
        if($search['status']=='7'){
            $this->ajaxResult("物品信息已取消");
        }
        if($search['status']!='0'){
            $this->ajaxResult("物品信息状态已变化，请重新处理");
        }
        $data["search"] = $search;
        $data["id"] = $data["search"]["id"];
        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Effects:status_on");
        echo $html;
    }
    private function status_on_save($data) {
       $id=I("request.id/d" );
       if(!$id) {
           $this->ajaxResult("物品信息参数不存在");
       }
       //id存在时判断数据库内数据是否存在
       $orig=M("effects")->where("id='%d'",array($id))->find();
       if(empty($orig)) {
           $this->ajaxError("物品信息数据不存在");
       }
       if($orig['status']=='7'){
           $this->ajaxResult("物品信息已取消");
       }
       if($orig['status']!='0'){
           $this->ajaxResult("物品信息状态已变化，请重新处理");
       }
       $reason_tag=I("request.reason_tag" );
       $reason=I("request.reason" );
       $statusdesc="状态[正常], ";
       $input["status"] = "1";  // "文本类型"
       $content=$statusdesc."备注: ";
       if($reason_tag){
            $content.=$reason_tag;
            if ($reason)$content.=", ".$reason;
       }else{
             $content.=$reason;
       }
       $input["modify_user"] = session(C("USER_AUTH_KEY"));
       $input["modify_time"] = date('Y-m-d H:i:s.n');
       $model = M("effects");
       $model->startTrans();
       //按主键更新数据
       $result = $model->where("id = $id")->save($input);
       //建立操作日志
          $result = $result && createLogCommon('effects',$id,'状态调整',$content);
       if($result){
           $model->commit();
       }else{
           $model->rollback();
           echo json_encode(array("msg"=>message("物品信息保存发生错误")));
           die;
       }
       //完成后关闭并刷新父窗口
       $this->ajaxReturn($data ['pfuncid'],$data ['funcid'],"refresh", "","closepopup");
       die;
    }
//// source for status_on - end ////
//// source for status_off - begin ////
    private function status_off($data) {
        $id = I("request.id/d");
        if(!$id) {
             $this->ajaxResult("物品信息参数不存在");
        }
        $search = M('effects')->find($id);
        if(!$search)
            $this->ajaxResult("物品信息不存在");
        if($search['status']=='7'){
            $this->ajaxResult("物品信息已取消");
        }
        if($search['status']!='1'){
            $this->ajaxResult("物品信息状态已变化，请重新处理");
        }
        $data["search"] = $search;
        $data["id"] = $data["search"]["id"];
        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Effects:status_off");
        echo $html;
    }
    private function status_off_save($data) {
       $id=I("request.id/d" );
       if(!$id) {
           $this->ajaxResult("物品信息参数不存在");
       }
       //id存在时判断数据库内数据是否存在
       $orig=M("effects")->where("id='%d'",array($id))->find();
       if(empty($orig)) {
           $this->ajaxError("物品信息数据不存在");
       }
       if($orig['status']=='7'){
           $this->ajaxResult("物品信息已取消");
       }
       if($orig['status']!='1'){
           $this->ajaxResult("物品信息状态已变化，请重新处理");
       }
       $reason_tag=I("request.reason_tag" );
       $reason=I("request.reason" );
       if(!($reason_tag.$reason)){
           $this->ajaxResult("物品信息状态回退，需注明原因");
       }
       $statusdesc="退回状态[无效], ";
       $input["status"] = "0";  // "文本类型"
       $content=$statusdesc."备注: ";
       if($reason_tag){
            $content.=$reason_tag;
            if ($reason)$content.=", ".$reason;
       }else{
             $content.=$reason;
       }
       $input["modify_user"] = session(C("USER_AUTH_KEY"));
       $input["modify_time"] = date('Y-m-d H:i:s.n');
       $model = M("effects");
       $model->startTrans();
       //按主键更新数据
       $result = $model->where("id = $id")->save($input);
       //建立操作日志
          $result = $result && createLogCommon('effects',$id,'状态调整',$content);
       if($result){
           $model->commit();
       }else{
           $model->rollback();
           echo json_encode(array("msg"=>message("物品信息保存发生错误")));
           die;
       }
       //完成后关闭并刷新父窗口
       $this->ajaxReturn($data ['pfuncid'],$data ['funcid'],"refresh", "","closepopup");
       die;
    }
//// source for status_off - end ////
//##combine_for_add_source##

//// source for status confirm ////

//// source for status view ////
    private function view($data) {
        $data["p"] = I("request.p/d");
        $data["pagesize"] = I("request.pagesize/d");

        $data["id"] = I("request.id/d");
        $data["no"] = I("request.no");
        if(!$data["id"] && !$data["no"]) {
           $this->ajaxError("物品信息查询参数非法");
        }

        //condition
        $condition="";
        $joinsql="";
        //select search fields
        $selectmasterfields="@effects.*";



        $sql = table("select #selectfields# from @effects  #join# Where #viewkey# #condition# #orderby#");
        if($data["id"])
           $viewkey=table("@effects.id=$data[id]");
        else
           $viewkey=table("@effects.code='$data[no]'");
        $sql = str_replace("#selectfields#",table($selectmasterfields),$sql);
        $sql = str_replace("#join#",$joinsql,$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#","",$sql);
        $search = M()->query($sql);
        if(!$search){
           $this->ajaxError("物品信息信息不存在");
        }
        $data["search"] = current($search);


        //按tabsheet - 开始
        $data["id"] = $data["search"]["id"];
        $data["search"]["_tab"] = $this->tabsheet_check(I("request._tab"));
        $page_size=$data["pagesize"] ;//session("Effects-".$data["search"]["_tab"]."-PageSize");
        switch($data["search"]["_tab"])
        {

          case "chujieshenqing":
               $data = $this->tab_chujieshenqing_apply($page_size,$data);
               break;
          case "yanqishenqing":
               $data = $this->tab_yanqishenqing_apply_delay($page_size,$data);
               break;
          case "wupinyidong":
               $data = $this->tab_wupinyidong_effects_movement($page_size,$data);
               break;
          case "xinxichulirizhi":
               $data = $this->tab_xinxichulirizhi_log_common($page_size,$data);
               break;

        }
        $data["search"]["_tab_".$data["search"]["_tab"]."_p"]=$data["p"];
        $data["search"]["_tab_".$data["search"]["_tab"]."_psize"]=$data["page_size"];
        //session("Effects-".$data["search"]["_tab"]."-PageSize", $data["page_size"]);
        //按tabsheet - 结束

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Effects:view");
        echo $html;
    }

    //按tabsheet子程序 - 开始

    private function tab_chujieshenqing_apply($tab_pagesize,$data)
    {
        $orderby="";
        $joinsql="";


        $condition = "" ;


        //select detail fields
        $selectfields="@apply.status ";
        $selectfields.=",@apply.id ";
        $selectfields.=",@apply.company_id ";
        $selectfields.=",@apply.tx_date ";
        $selectfields.=",@apply.department_id ";
        $selectfields.=",@apply.project_name ";
        $selectfields.=",@apply.user_name ";
        $selectfields.=",@apply.effects_code ";
        $selectfields.=",@apply.effects_name ";
        $selectfields.=",@apply.plan_start_time ";
        $selectfields.=",@apply.plan_end_time ";
        $selectfields.=",@apply.bollow_reason ";
        $selectfields.=",@apply.plan_take_user ";
        $selectfields.=",@apply.bollow_time ";
        $selectfields.=",@apply.bollow_remarks ";
        $selectfields.=",@apply.bollow_status ";
        $selectfields.=",@apply.take_user ";
        $selectfields.=",@apply.take_phone ";
        $selectfields.=",@apply.address ";
        $selectfields.=",@apply.express_name ";
        $selectfields.=",@apply.express_no ";
        $selectfields.=",@apply.return_time ";
        $selectfields.=",@apply.return_user ";
        $selectfields.=",@apply.return_status ";
        $selectfields.=",@apply.effects_status ";
        $selectfields.=",@apply.return_remarks ";
        $selectfields.=",@apply.est_days ";
        $selectfields.=",@apply.apply_delay_times ";
        $selectfields.=",@apply.apply_delay_id ";
        $selectfields.=",@apply.apply_delay_no ";
        $selectfields.=",@apply.approval_require ";
        $selectfields.=",@apply.approval_status ";
        $selectfields.=",@apply.refuse_reason ";
        $selectfields.=",@apply.approval1_user1 ";
        $selectfields.=",@apply.approval1_user2 ";
        $selectfields.=",@apply.approval2_user ";
        $selectfields.=",@apply.overdue_status ";
        $selectfields.=",@apply.create_time ";
        $selectfields.=",@apply.modify_time ";

        $viewkey="@apply.effects_id='".$data["search"]["id"]."'";
     if(!$viewkey)
           $this->ajaxError("查询参数非法");
     //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @apply  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @apply  #join# Where #viewkey# #condition# #orderby#");

        $viewkey = table($viewkey);
        $condition = table($condition);
        $orderby= table($orderby);
        $selectfields= table($selectfields);

        $count_sql = str_replace("#condition#",$condition,$count_sql);
        $count_sql = str_replace("#viewkey#",$viewkey,$count_sql);
        $count_sql = str_replace("#join#",$joinsql,$count_sql);

        $count = M()->query($count_sql);
        $count = $count[0]["cnt"];

        if($count < $page_size)
            $tmp = 1;
        else {
            $tmp = intval($count / $page_size);
            if($count % $page_size != 0) {
                $tmp++;
            }
        }
        if(!$data["p"]) {
            $data["p"] = 1;
        }
        if($data["p"] > $tmp) {
            $data["p"] = $tmp;
        }

        $sql = str_replace("#selectfields#",$selectfields,$search_sql);
        $sql = str_replace("#join#",$joinsql,$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
        $data["list"] = M()->query($sql);
        $pageClass = new \Think\Page($count,$page_size);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"]);
        $data["page_size"] = $page_size;

        return $data;
    }

    private function tab_yanqishenqing_apply_delay($tab_pagesize,$data)
    {
        $orderby="";
        $joinsql="";


        $condition = "" ;


        //select detail fields
        $selectfields="@apply_delay.status ";
        $selectfields.=",@apply_delay.id ";
        $selectfields.=",@apply_delay.company_id ";
        $selectfields.=",@apply_delay.apply_delay_no ";
        $selectfields.=",@apply_delay.tx_date ";
        $selectfields.=",@apply_delay.department_id ";
        $selectfields.=",@apply_delay.user_name ";
        $selectfields.=",@apply_delay.effects_code ";
        $selectfields.=",@apply_delay.effects_name ";
        $selectfields.=",@apply_delay.delay_return ";
        $selectfields.=",@apply_delay.delay_subject ";
        $selectfields.=",@apply_delay.delay_reason ";
        $selectfields.=",@apply_delay.approval_require ";
        $selectfields.=",@apply_delay.approval_status ";
        $selectfields.=",@apply_delay.approval1_user1 ";
        $selectfields.=",@apply_delay.approval1_user2 ";
        $selectfields.=",@apply_delay.approval2_user ";
        $selectfields.=",@apply_delay.create_time ";
        $selectfields.=",@apply_delay.modify_time ";

        $viewkey="@apply_delay.effects_id='".$data["search"]["id"]."'";
     if(!$viewkey)
           $this->ajaxError("查询参数非法");
     //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @apply_delay  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @apply_delay  #join# Where #viewkey# #condition# #orderby#");

        $viewkey = table($viewkey);
        $condition = table($condition);
        $orderby= table($orderby);
        $selectfields= table($selectfields);

        $count_sql = str_replace("#condition#",$condition,$count_sql);
        $count_sql = str_replace("#viewkey#",$viewkey,$count_sql);
        $count_sql = str_replace("#join#",$joinsql,$count_sql);

        $count = M()->query($count_sql);
        $count = $count[0]["cnt"];

        if($count < $page_size)
            $tmp = 1;
        else {
            $tmp = intval($count / $page_size);
            if($count % $page_size != 0) {
                $tmp++;
            }
        }
        if(!$data["p"]) {
            $data["p"] = 1;
        }
        if($data["p"] > $tmp) {
            $data["p"] = $tmp;
        }

        $sql = str_replace("#selectfields#",$selectfields,$search_sql);
        $sql = str_replace("#join#",$joinsql,$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
        $data["list"] = M()->query($sql);
        $pageClass = new \Think\Page($count,$page_size);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"]);
        $data["page_size"] = $page_size;

        return $data;
    }

    private function tab_wupinyidong_effects_movement($tab_pagesize,$data)
    {
        $orderby="";
        $joinsql="";


        $condition = "" ;


        //select detail fields
        $selectfields="@effects_movement.id ";
        $selectfields.=",@effects_movement.company_id ";
        $selectfields.=",@effects_movement.department_id ";
        $selectfields.=",@effects_movement.effects_code ";
        $selectfields.=",@effects_movement.effects_name ";
        $selectfields.=",@effects_movement.type ";
        $selectfields.=",@effects_movement.user_id ";
        $selectfields.=",@effects_movement.remarks ";
        $selectfields.=",@effects_movement.create_time ";

        $viewkey="@effects_movement.effects_id='".$data["search"]["id"]."'";
     if(!$viewkey)
           $this->ajaxError("查询参数非法");
     //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @effects_movement  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @effects_movement  #join# Where #viewkey# #condition# #orderby#");

        $viewkey = table($viewkey);
        $condition = table($condition);
        $orderby= table($orderby);
        $selectfields= table($selectfields);

        $count_sql = str_replace("#condition#",$condition,$count_sql);
        $count_sql = str_replace("#viewkey#",$viewkey,$count_sql);
        $count_sql = str_replace("#join#",$joinsql,$count_sql);

        $count = M()->query($count_sql);
        $count = $count[0]["cnt"];

        if($count < $page_size)
            $tmp = 1;
        else {
            $tmp = intval($count / $page_size);
            if($count % $page_size != 0) {
                $tmp++;
            }
        }
        if(!$data["p"]) {
            $data["p"] = 1;
        }
        if($data["p"] > $tmp) {
            $data["p"] = $tmp;
        }

        $sql = str_replace("#selectfields#",$selectfields,$search_sql);
        $sql = str_replace("#join#",$joinsql,$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
        $data["list"] = M()->query($sql);
        $pageClass = new \Think\Page($count,$page_size);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"]);
        $data["page_size"] = $page_size;

        return $data;
    }

    private function tab_xinxichulirizhi_log_common($tab_pagesize,$data)
    {
        $orderby="";
        $joinsql="";


        $condition = "" ;


        //select detail fields
        $selectfields="@log_common.status ";
        $selectfields.=",@log_common.id ";
        $selectfields.=",@log_common.create_time ";
        $selectfields.=",@log_common.data_id ";
        $selectfields.=",@log_common.data_code ";
        $selectfields.=",@log_common.subject ";
        $selectfields.=",@log_common.content ";

        $viewkey="@log_common.data_id='".$data["search"]["id"]."'";
        $viewkey.=" and @log_common.type='effects'";
     if(!$viewkey)
           $this->ajaxError("查询参数非法");
     //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @log_common  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @log_common  #join# Where #viewkey# #condition# #orderby#");
        $orderby="order by @log_common.id desc";

        $viewkey = table($viewkey);
        $condition = table($condition);
        $orderby= table($orderby);
        $selectfields= table($selectfields);

        $count_sql = str_replace("#condition#",$condition,$count_sql);
        $count_sql = str_replace("#viewkey#",$viewkey,$count_sql);
        $count_sql = str_replace("#join#",$joinsql,$count_sql);

        $count = M()->query($count_sql);
        $count = $count[0]["cnt"];

        if($count < $page_size)
            $tmp = 1;
        else {
            $tmp = intval($count / $page_size);
            if($count % $page_size != 0) {
                $tmp++;
            }
        }
        if(!$data["p"]) {
            $data["p"] = 1;
        }
        if($data["p"] > $tmp) {
            $data["p"] = $tmp;
        }

        $sql = str_replace("#selectfields#",$selectfields,$search_sql);
        $sql = str_replace("#join#",$joinsql,$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
        $data["list"] = M()->query($sql);
        $pageClass = new \Think\Page($count,$page_size);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"]);
        $data["page_size"] = $page_size;

        return $data;
    }



    private function tabsheet_check($itab)
    {
        $idefault="chujieshenqing";
        switch($itab)
        {

          case "chujieshenqing":
          case "yanqishenqing":
          case "wupinyidong":
          case "xinxichulirizhi":

              break;
          default:
              $itab=$idefault;
              break;
         }
        return $itab;
    }
    //按tabsheet子程序 - 结束

    private function deleteProcess($id) {
        $type=1;
        $smo=M('effects')->where("id='%d'",array($id))->find();
        if(empty($smo)) {
            $this->ajaxResult("物品信息数据不存在");
        }
        if($smo['status']!=0){
            $this->ajaxResult("物品信息状态不能删除");
        }

        $result=true;
        $result = $result && createLogCommon('effects',$id,($smo['status']?'取消信息':'删除记录'),'');
        if($smo['status']!=0){
            $result = $result && M('effects')->where("id='%d'",array($id))->save(array('status'=>8,'cancel_time'=>date('Y-m-d H:i:s'),'cancel_status'=>1));
        }else{
            $result = $result && M('effects')->where("id='%d'",array($id))->delete();
        }
        return $result;
    }

    private function order_delete($data) {

        $id=I("request.id/d" );
        $type=I("request.type/d" );
        if(!$id) {
             $this->ajaxResult("物品信息参数不存在");
        }

        $m=M();
        $m->startTrans();
        $r=$this->deleteProcess($id);
        if($r){
            $m->commit();
        }else{
            $m->rollback();
        }

        $this->ajax_hideConfirm();
        if(!$type){
            $this->ajax_closeTab($data ['funcid']);
        }
        $this->ajax_refresh($data ['pfuncid']);
        $this->ajaxResult();
        die;
    }


}
