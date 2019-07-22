<?php
namespace Home\Controller;

//
//注释: SystemParameter - 系统参数信息
//
use Home\Controller\BasicController;
use Think\Log;
class SystemParameterController extends BasicController {

    public function _init() {
        $funcs = $this->getUserRoleList($this->user,array( ));
        if ($funcs)
            $this->assign("rights",  $funcs);
        else{
            $funcs = array(
             );
            $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"SystemParameter"));
    }

    public function index() {
      $data["pfuncid"] = I("request.pfuncid");
      $data["funcid"] = I("request.funcid");
      $data["zindex"] = I("request.zindex/d");
      if(empty($data["funcid"])) $data["funcid"] = "SystemParameter";
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
//// case for status_off ////
        case "status_off":
          $this->status_off($data);
          break;
        case "status_off_save":
          $this->status_off_save($data);
          break;
//// case for status_on ////
        case "status_on":
          $this->status_on($data);
          break;
        case "status_on_save":
          $this->status_on_save($data);
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

      }
    }

//// source for add - begin ////
    private function add($data) {
       $id = I("request.id/d");
       if(!$id){
          //读接入参数
          $type = I("request.type");
          $code = I("request.code");
          $name = I("request.name");
          $value = I("request.value");
          $sort = I("request.sort/d",0);
          $remarks = I("request.remarks");
          //赋初值
          $search["type"] = $type?$type:"trade";  //第一个选项
          $search["code"] = $code?$code:"";
          $search["name"] = $name?$name:"";
          $search["value"] = $value?$value:"";
          $search["sort"] = $sort?$sort:"";
          $search["remarks"] = $remarks?$remarks:"";
       } else {
          $search = M(system_parameter)->find($id);
          if(!$search){
              $this->ajaxResult("系统参数数据不存在" );
          }
          $data["id"] = $search["id"];
       }
       $data["search"] = $search;
       foreach($data as $key=>$val) {
           $this->assign($key, $val);
       }
       $html = $this->fetch("SystemParameter:add");
       echo $html;
    }
    private function save($data) {
       $id=I("request.id/d" );
       //读取页面输入数据
       $type = I("request.type");
       $code = I("request.code");
       $name = I("request.name");
       $value = I("request.value");
       $sort = I("request.sort/d",0);
       $remarks = I("request.remarks");
       //非页面输入字段
       $input = array();
       //数据有效性校验，非空/数值负数，范围/日期与今日比较
       //数据校验 - 必输项不能为空
       if(!verify_value($type,"empty","","")) $this->ajaxError("类型 不能为空");
       if(!verify_value($code,"empty","","")) $this->ajaxError("代码 不能为空");
       if(!verify_value($name,"empty","","")) $this->ajaxError("名称 不能为空");
       // "数据" 长度超200位，没有生成非空检测
       if(!verify_value($sort,"nagitive","","")) $this->ajaxError("排序 不能为负数");
          if($sort<=0) $sort=99999;
       // "说明" 长度超200位，没有生成非空检测
       $model = M("system_parameter");
       //判断 code 是否重复建立
       $orig = $model->where("code='$code'".($id?" and id!=$id":""))->find();
       if ($orig) $this->ajaxError("代码 $code 已存在");
       //页面输入字段
       $input["type"] = $type;
       $input["code"] = $code;
       $input["name"] = $name;
       $input["value"] = $value;
       $input["sort"] = $sort;
       $input["remarks"] = $remarks;
       $model->startTrans();
       $result=false;
       //需要存入日志的字段
       $needSave=array(
            'type'=>'类型',
            'code'=>'代码',
            'name'=>'名称',
            'sort'=>'排序',
       );
       if(!$id) {
          //新增  建号操作
          //新增数据 保存数据库
          $result = $id = $model->add($input);
          //建立操作日志
          $result = $result && createLogCommon('system_parameter',$id,'新增系统参数','',"*",'code');
       } else {
          //id存在时判断数据库内数据是否存在
          $orig=$model->where("id='%d'",array($id))->find();
          if(empty($orig)) {
               $this->ajaxError("系统参数数据不存在");
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
            $result = $result && createLogCommon('system_parameter',$id,'变更系统参数',$orig,'','','code',$needSave);
          }
       }
       if($result){
           $model->commit();
       }else{
           $model->rollback();
           echo json_encode(array("msg"=>message("系统参数保存发生错误")));
           die;
       }
       //完成后跳转
       //转到summary页面
       $this->ajaxReturn($data ['pfuncid'],$data ['funcid'],"refresh", "","closepopup");
       die;
    }
//// source for add - end ////
//// source for status_off - begin ////
    private function status_off($data) {
        $id = I("request.id/d");
        if(!$id) {
             $this->ajaxResult("系统参数参数不存在");
        }
        $search = M('system_parameter')->find($id);
        if(!$search)
            $this->ajaxResult("系统参数不存在");
        if($search['status']=='7'){
            $this->ajaxResult("系统参数已取消");
        }
        if($search['status']!='1'){
            $this->ajaxResult("系统参数状态已变化，请重新处理");
        }
        $data["search"] = $search;
        $data["id"] = $data["search"]["id"];
        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("SystemParameter:status_off");
        echo $html;
    }
    private function status_off_save($data) {
       $id=I("request.id/d" );
       if(!$id) {
           $this->ajaxResult("系统参数参数不存在");
       }
       //id存在时判断数据库内数据是否存在
       $orig=M("system_parameter")->where("id='%d'",array($id))->find();
       if(empty($orig)) {
           $this->ajaxError("系统参数数据不存在");
       }
       if($orig['status']=='7'){
           $this->ajaxResult("系统参数已取消");
       }
       if($orig['status']!='1'){
           $this->ajaxResult("系统参数状态已变化，请重新处理");
       }
       $reason_tag=I("request.reason_tag" );
       $reason=I("request.reason" );
       if(!($reason_tag.$reason)){
           $this->ajaxResult("系统参数状态回退，需注明原因");
       }
       $statusdesc="状态[无效],";
       $input["status"] = "0";  // "文本类型"
       $content="$statusdesc 备注: ";
       if($reason_tag){
            $content.=$reason_tag;
            if ($reason)$content.=", ".$reason;
       }else{
             $content.=$reason;
       }
       $model = M("system_parameter");
       $model->startTrans();
       //按主键更新数据
       $result = $model->where("id = $id")->save($input);
       //建立操作日志
          $result = $result && createLogCommon('system_parameter',$id,'状态调整',$content);
       if($result){
           $model->commit();
       }else{
           $model->rollback();
           echo json_encode(array("msg"=>message("系统参数保存发生错误")));
           die;
       }
       //完成后关闭并刷新父窗口
       $this->ajaxReturn($data ['pfuncid'],$data ['funcid'],"refresh", "","closepopup");
       die;
    }
//// source for status_off - end ////
//// source for status_on - begin ////
    private function status_on($data) {
        $id = I("request.id/d");
        if(!$id) {
             $this->ajaxResult("系统参数参数不存在");
        }
        $search = M('system_parameter')->find($id);
        if(!$search)
            $this->ajaxResult("系统参数不存在");
        if($search['status']=='7'){
            $this->ajaxResult("系统参数已取消");
        }
        if($search['status']!='0'){
            $this->ajaxResult("系统参数状态已变化，请重新处理");
        }
        $data["search"] = $search;
        $data["id"] = $data["search"]["id"];
        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("SystemParameter:status_on");
        echo $html;
    }
    private function status_on_save($data) {
       $id=I("request.id/d" );
       if(!$id) {
           $this->ajaxResult("系统参数参数不存在");
       }
       //id存在时判断数据库内数据是否存在
       $orig=M("system_parameter")->where("id='%d'",array($id))->find();
       if(empty($orig)) {
           $this->ajaxError("系统参数数据不存在");
       }
       if($orig['status']=='7'){
           $this->ajaxResult("系统参数已取消");
       }
       if($orig['status']!='0'){
           $this->ajaxResult("系统参数状态已变化，请重新处理");
       }
       $reason_tag=I("request.reason_tag" );
       $reason=I("request.reason" );
       $statusdesc="状态[有效],";
       $input["status"] = "1";  // "文本类型"
       $content="$statusdesc 备注: ";
       if($reason_tag){
            $content.=$reason_tag;
            if ($reason)$content.=", ".$reason;
       }else{
             $content.=$reason;
       }
       $model = M("system_parameter");
       $model->startTrans();
       //按主键更新数据
       $result = $model->where("id = $id")->save($input);
       //建立操作日志
          $result = $result && createLogCommon('system_parameter',$id,'状态调整',$content);
       if($result){
           $model->commit();
       }else{
           $model->rollback();
           echo json_encode(array("msg"=>message("系统参数保存发生错误")));
           die;
       }
       //完成后关闭并刷新父窗口
       $this->ajaxReturn($data ['pfuncid'],$data ['funcid'],"refresh", "","closepopup");
       die;
    }
//// source for status_on - end ////
//##combine_for_add_source##

//// source for status confirm ////

//// source for status view ////
    private function view($data) {
        $data["p"] = I("request.p/d");
        $data["pagesize"] = I("request.pagesize/d");

        $data["id"] = I("request.id/d");
        $data["no"] = I("request.no");
        if(!$data["id"] && !$data["no"]) {
           $this->ajaxError("系统参数信息查询参数非法");
        }

        //condition
        $condition="";
        $joinsql="";
        //select search fields
        $selectmasterfields="@system_parameter.*";



        $sql = table("select #selectfields# from @system_parameter  #join# Where #viewkey# #condition# #orderby#");
        if($data["id"])
           $viewkey=table("@system_parameter.id=$data[id]");
        else
           $viewkey=table("@system_parameter.code='$data[no]'");
        $sql = str_replace("#selectfields#",table($selectmasterfields),$sql);
        $sql = str_replace("#join#",$joinsql,$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#","",$sql);
        $search = M()->query($sql);
        if(!$search){
           $this->ajaxError("系统参数信息信息不存在");
        }
        $data["search"] = current($search);

        //step 步骤样例 - 开始
        $step=array();
        $step1=array();
        step_add( $step, '创建时间',$data["search"]['create_time']  ,true);
        step_add( $step, '已确认'  ,$data["search"]['confirm_time'] ,$data["search"]['status']>=1 && $data["search"]['confirm_status']==1);
        step_add( $step, '已通知'  ,$data["search"]['notice_time']  ,$data["search"]['status']>=1 && $data["search"]['notice_status']==1);
        if($data["search"]['status']>=1 && $data["search"]['stock_status']==1){
            step_add( $step, '处理中'  ,$data["search"]['stock_time'],$data["search"]['status']>=1 && $data["search"]['stock_status']==1);
        }
        step_add( $step, '已完成'  ,$data["search"]['complete_time']   ,$data["search"]['status']==2);
        // 取消/挂起步骤
        step_add( $step1, '取消时间'  ,$data["search"]['cancel_time'] ,$data["search"]['cancel_status']==1);
        step_add( $step1, '挂起时间'  ,$data["search"]['hangup_time'] ,$data["search"]['hangup_status']==1);
        $step=getOrderStep($step,$step1);
        $data["step"]=$step;
        //step 步骤样例 - 结束

        //按tabsheet - 开始
        $data["id"] = $data["search"]["id"];
        //按tabsheet - 结束

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("SystemParameter:view");
        echo $html;
    }

    //按tabsheet子程序 - 开始
    //按tabsheet子程序 - 结束

    private function deleteProcess($id) {
        $type=1;
        $smo=M('system_parameter')->where("id='%d'",array($id))->find();
        if(empty($smo)) {
            $this->ajaxResult("系统参数信息数据不存在");
        }
        if($smo['status']!=0){
            $this->ajaxResult("系统参数信息状态不能删除");
        }

        $result=true;
        $result = $result && createLogCommon('system_parameter',$id,($smo['status']?'取消信息':'删除记录'),'');
        if($smo['status']!=0){
            $result = $result && M('system_parameter')->where("id='%d'",array($id))->save(array('status'=>8,'cancel_time'=>date('Y-m-d H:i:s'),'cancel_status'=>1));
        }else{
            $result = $result && M('system_parameter')->where("id='%d'",array($id))->delete();
        }
        return $result;
    }

    private function order_delete($data) {

        $id=I("request.id/d" );
        $type=I("request.type/d" );
        if(!$id) {
             $this->ajaxResult("系统参数信息参数不存在");
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
