<?php
namespace Home\Controller;

//
//注释: Department - 部门信息
//
use Home\Controller\BasicController;
use Think\Log;
class DepartmentController extends BasicController {

    public function _init() {
        $funcs = $this->getUserRoleList($this->user,array( 'Department', '/Home/Department', ));
        if ($funcs)
            $this->assign("rights",  $funcs);
        else{
            $funcs = array(
                         array("key"=>"refresh","func"=>"Department","Action"=>"refresh") ,
                         array("key"=>"save","func"=>"Department","Action"=>"save") ,
                         array("key"=>"search","func"=>"/Home/Department","Action"=>"view") ,
                         array("key"=>"detail_import","func"=>"/Home/Department","Action"=>"detail_import") ,
                         array("key"=>"detail_select","func"=>"/Home/Department","Action"=>"selectproduct") ,
                         array("key"=>"edit_base","func"=>"/Home/Department","Action"=>"edit_base") ,
                         array("key"=>"order_edit","func"=>"/Home/Department","Action"=>"order_edit") ,
                         array("key"=>"order_delete","func"=>"/Home/Department","Action"=>"delete") ,
                         array("key"=>"batch_opt1","func"=>"/Home/Department","Action"=>"batch_opt1") ,
                         array("key"=>"batch_opt2","func"=>"/Home/Department","Action"=>"batch_opt2") ,
                         array("key"=>"batch_delete","func"=>"/Home/Department","Action"=>"batch_delete")
             );
            $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"Department"));
    }

    public function index() {
      $data["pfuncid"] = I("request.pfuncid");
      $data["funcid"] = I("request.funcid");
      $data["zindex"] = I("request.zindex/d");
      if(empty($data["funcid"])) $data["funcid"] = "Department";
      $this->GetLastUrl($data["funcid"]);

      $func = I("request.func");
      if($func != "saveSelectProduct" && $func != "save") {
        $this->GetLastUrl($data["funcid"]);
      }

      switch ($func) {
////// case for add /////////////////
        case "import":
          $this->import($data);
          break;
        case "edit":
        case "edit_base":
        case "add":
          $this->add($data);
          break;
        case "save":
          $this->save($data);
          break;
//// case for add /////////////////
        case "view":
          $this->view($data);
          break;
        case "import":
          $this->import($data);
          break;
        case "delete":
          $this->order_delete($data);
          break;
        case "confirm":
          $this->order_confirm($data);
          break;
        case "rollback":
          $this->order_rollback($data);
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

////// source for add /////////////////
    private function add($data) {

       //赋初值

        $search["company_id"] = "";  //第一个选项
        $search["code"] = "";
        $search["name"] = "";
        $search["parent_id"] = "";  //第一个选项
        $search["level"] = "";
        $search["sort"] = "";
        $search["status"] = "1";  //第一个选项

        $id = I("request.id/d");
        if($id){
           $sql = table("select * from @department where id=$id");
           $search = M()->query($sql);
           if(!$search)
               die;
           $data["search"] = current($search);
           $data["id"] = $data["search"]["id"];

        }else{
           $data["search"] = $search;
        }

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Department:add");
        echo $html;
    }

    private function save($data) {
       $id=I("request.id/d" );

       //读取页面输入数据

       $company_id = I("request.company_id");
       $code = I("request.code");
       $name = I("request.name");
       $parent_id = I("request.parent_id");
       $level = I("request.level/d",0);
       $sort = I("request.sort/d",0);
       $status = I("request.status");

       //数据有效性校验，非空/数值负数，范围/日期与今日比较

       //数据校验 - 必输项不能为空
       if(!verify_value($company_id,"empty","","")) {
           $this->ajaxError("公司 不能为空");
       }
       if(!verify_value($code,"empty","","")) {
           $this->ajaxError("代码 不能为空");
       }
       if(!verify_value($name,"empty","","")) {
           $this->ajaxError("名称 不能为空");
       }
       if(!verify_value($status,"empty","","")) {
           $this->ajaxError("状态 不能为空");
       }

       if(!verify_value($level,"nagitive","","")) {
           $this->ajaxError("层级 不能为负数");
       }
       if ($level < 100 || $level > 105){
           $this->ajaxError("校验样例 层级值在100-105之间");
       }
       if(!verify_value($sort,"nagitive","","")) {
           $this->ajaxError("排序 不能为负数");
       }
       if ($sort < 100 || $sort > 105){
           $this->ajaxError("校验样例 排序值在100-105之间");
       }

       $model = M("department");
       //判断 code 是否重复建立
       $cond = "code='$code'";
       if($id){
           $cond .= " and id!=$id";
       }
       $orig = $model->where($cond)->find();
       if ($orig) {
           $this->ajaxError("代码 $code 已存在");
       }

       //页面输入字段

       $input["company_id"] = $company_id;
       $input["code"] = $code;
       $input["name"] = $name;
       $input["parent_id"] = $parent_id;
       $input["level"] = $level;
       $input["sort"] = $sort;
       $input["status"] = $status;

       //非页面输入字段

       $input["modify_user"] = $this->user["id"];
       $input["modify_time"] =  date('Y-m-d H:i:s.n');

       $model->startTrans();
       $result=false;

       //需要存入日志的字段
       $needSave=array(
            'company_id'=>'公司',
            'code'=>'代码',
            'name'=>'名称',
            'parent_id'=>'上级',
            'level'=>'层级',
            'sort'=>'排序',
            'status'=>'状态',
       );

       if(!$id) {
          //新增  建号操作

          $input["create_user"] = $this->user["id"];
          $input["create_time"] = date('Y-m-d H:i:s.n');

          //新增数据 保存数据库
          $result = $id = $model->add($input);
          //建立操作日志
          $result = $result && createLogCommon('department',$id,'新增部门信息','',"*",'code');
       } else {
          //id存在时判断数据库内数据是否存在
          $old=$model->where("id='%d'",array($id))->find();
          if(empty($old)) {
               $this->ajaxError("部门信息数据不存在");
          }

          //按主键更新数据
          $result = $model->where("id = $id")->save($input);

          $isSaveLog=false;
          foreach ($needSave as $key=>$v) {
              if($old[$key]!=$input[$key]) {
                  $isSaveLog=true;
                  break;
              }
          }
          if($isSaveLog){
          //建立操作日志
               $result = $result && createLogCommon('department',$id,'变更部门信息',$old,'','','code',$needSave);
          }
       }
       if($result){
           $model->commit();
       }else{
           $model->rollback();
           echo json_encode(array("msg"=>message("部门信息保存发生错误")));
           die;
       }

       //完成后跳转
       //转到summary页面
       $this->ajaxReturn($data ['pfuncid'],$data ['funcid'],"refresh", "","closepopup");
       die;
    }


//// source for add /////////////////

    private function view($data) {
        $data["p"] = I("request.p/d");
        $data["pagesize"] = I("request.pagesize/d");

        $data["id"] = I("request.id/d");
        $data["no"] = I("request.no");
        if(!$data["id"] && !$data["no"]) {
           $this->ajaxError("部门信息查询参数非法");
        }

        //condition
        $condition="";
        $joinsql="";
        //select search fields
        $selectmasterfields="@department.*";



        $sql = table("select #selectfields# from @department  #join# Where #viewkey# #condition# #orderby#");
        if($data["id"])
           $viewkey=table("@department.id=$data[id]");
        else
           $viewkey=table("@department.code='$data[no]'");
        $sql = str_replace("#selectfields#",table($selectmasterfields),$sql);
        $sql = str_replace("#join#",$joinsql,$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#","",$sql);
        $search = M()->query($sql);
        if(!$search){
           $this->ajaxError("部门信息信息不存在");
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
        $data["search"]["_tab"] = $this->tabsheet_check(I("request._tab"));
        $page_size=$data["pagesize"] ;//session("Department-".$data["search"]["_tab"]."-PageSize");
        switch($data["search"]["_tab"])
        {

          case "caozuorizhi":
               $data = $this->tab_caozuorizhi_log_common($page_size,$data);
               break;

        }
        $data["search"]["_tab_".$data["search"]["_tab"]."_p"]=$data["p"];
        $data["search"]["_tab_".$data["search"]["_tab"]."_psize"]=$data["page_size"];
        //session("Department-".$data["search"]["_tab"]."-PageSize", $data["page_size"]);
        //按tabsheet - 结束

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Department:view");
        echo $html;
    }

    //按tabsheet子程序 - 开始

    private function tab_caozuorizhi_log_common($tab_pagesize,$data)
    {
        $orderby="";
        $joinsql="";

        $data["search"]["tab_caozuorizhi_content"] = I("get.tab_caozuorizhi_content");

        $condition = "" ;

        $condition = join_condition($condition,"@log_common.content",$data["search"]["tab_caozuorizhi_content"],"char","both");

        //select detail fields
        $selectfields="@log_common.status ";
        $selectfields.=",@log_common.id ";
        $selectfields.=",@log_common.create_time ";
        $selectfields.=",@log_common.type ";
        $selectfields.=",@log_common.data_id ";
        $selectfields.=",@log_common.data_code ";
        $selectfields.=",@log_common.subject ";
        $selectfields.=",@log_common.content ";

        $viewkey="data_id='".$data["search"]["id"]."'";
        $viewkey.=" and type='department'";
     //   if(!$viewkey)
     //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @log_common  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @log_common  #join# Where #viewkey# #condition# #orderby#");

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
        $idefault="caozuorizhi";
        switch($itab)
        {

          case "caozuorizhi":

              break;
          default:
              $itab=$idefault;
              break;
         }
        return $itab;
    }
    //按tabsheet子程序 - 结束

    private function deleteProcess($id,&$type) {

        $smo=M('department')->where("id='%d'",array($id))->find();
        if(empty($smo)) {
            $this->ajaxResult("部门信息数据不存在");
        }
        if($smo['status']!=0){
            $this->ajaxResult("部门信息状态不能删除");
        }

        $result=true;
        if($smo['status']!=0){
            $result=M('department')->where("id='%d'",array($id))->save(array('status'=>8,'cancel_time'=>date('Y-m-d H:i:s'),'cancel_status'=>1));
            $result = $result && createLogCommon('department',$id,'取消部门信息','');
        }else{
            $type=2;
            $result = $result && createLogCommon('department',$id,'删除部门信息','');
            $result = $result && M('department')->where("id='%d'",array($id))->delete();
        }
        return $result;
    }

    private function order_delete($data) {

        $id=I("request.id/d" );
        if(!$id) {
             $this->ajaxResult("部门信息参数不存在");
        }

        $m=M();
        $m->startTrans();
        $type=1;
        $r=$this->deleteProcess($id,$type);

        if($r){
            $m->commit();
        }else{
            $m->rollback();
        }

        if($type==1){
            $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideConfirm"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Home/Department/index?func=view&id=".$id).  "','".filterFuncId("Department_View","id=$data[id]")."','部门信息查看', 0","''"));
        }else{
            $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideConfirm"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Summary/DepartmentSummary/index?func=search&id=".$id).  "','".filterFuncId("DepartmentSummary_View","id=$data[id]")."','部门信息列表', 0","''"));
        }
       die;
    }

    private function order_rollback($data) {

        $id=I("request.id/d" );
        if(!$id) {
             $this->ajaxResult("部门信息参数不存在");
        }

        $smo=M('department')->where("id='%d'",$id)->find();
        if(empty($smo)) {
            $this->ajaxResult("部门信息数据不存在");
        }
        if($smo['status']!=1){
            $this->ajaxResult("部门信息非确认状态，不能反审");
        }

        $model=M('department');
        $model->startTrans();
        $result1=$model->where("id='%d'",$id)->save(array(
            'status'=>0,
            'notice_status'=>0,
            'confirm_status'=>0,
        ));

        $result2 = createLogOrder('department',$id,'部门信息反审','');
        if($result1 && $result2){
            $model->commit();
        }else{
            $model->rollback();
        }

        $this->ajaxResult("", "",  array("_asr.hideConfirm","_asr.openLink"), array("''","'','".$data["funcid"]."','刷新', 1"));

    }

    private function order_confirm($data) {

        $id=I("request.id/d" );
        if(!$id) {
             $this->ajaxResult("部门信息参数不存在");
        }

        $smo=M('department')->where("id='%d'",$id)->find();
        if(empty($smo)) {
            $this->ajaxResult("部门信息数据不存在");
        }
        if($smo['status']!=0 ){
            $this->ajaxResult("部门信息非待确认状态，不能确认");
        }


        $model=M('department');
        $model->startTrans();
        $result1=$model->where("id='%d'",$id)->save(array(
            'status'=>1,
            'notice_time'=>date('Y-m-d H:i:s'),
            'notice_status'=>1,
            'confirm_status'=>1,
            'confirm_time'=>date('Y-m-d H:i:s'),
        ));

        $result2 = createLogOrder('department',$id,'部门信息确认','');
        if($result1 && $result2){
            $model->commit();
        }else{
            $model->rollback();
        }
        $this->ajaxResult("", "",  array("_asr.hideConfirm","_asr.openLink"), array("''","'','".$data["funcid"]."','刷新', 1"));
    }



}
