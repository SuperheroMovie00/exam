<?php
namespace Home\Controller;

//
//注释: Company - 公司信息
//
use Home\Controller\BasicController;
use Think\Log;
class CompanyController extends BasicController {

    public function _init() {
        $funcs = $this->getUserRoleList($this->user,array( 'Company', '/Home/Company', ));
        if ($funcs)
            $this->assign("rights",  $funcs);
        else{
            $funcs = array(
                         array("key"=>"refresh","func"=>"Company","Action"=>"refresh") ,
                         array("key"=>"save","func"=>"Company","Action"=>"save") ,
                         array("key"=>"search","func"=>"/Home/Company","Action"=>"view") ,
                         array("key"=>"detail_import","func"=>"/Home/Company","Action"=>"detail_import") ,
                         array("key"=>"detail_select","func"=>"/Home/Company","Action"=>"selectproduct") ,
                         array("key"=>"tabxiangmuxinxi","func"=>"/Home/Company","Action"=>"tabxiangmuxinxi") ,
                         array("key"=>"tabchujieshenqing","func"=>"/Home/Company","Action"=>"tabchujieshenqing") ,
                         array("key"=>"tabyanqishenqing","func"=>"/Home/Company","Action"=>"tabyanqishenqing") ,
                         array("key"=>"tabgongsiyonghu","func"=>"/Home/Company","Action"=>"tabgongsiyonghu") ,
                         array("key"=>"tabxinxichulirizhi","func"=>"/Home/Company","Action"=>"tabxinxichulirizhi") ,
                         array("key"=>"edit_base","func"=>"/Home/Company","Action"=>"edit_base") ,
                         array("key"=>"selectUser","func"=>"/Home/Company","Action"=>"selectUser") ,
                         array("key"=>"batch_cancel","func"=>"/Home/Company","Action"=>"delete")
             );
            $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"Company"));
    }

    public function index() {
      $data["pfuncid"] = I("request.pfuncid");
      $data["funcid"] = I("request.funcid");
      $data["zindex"] = I("request.zindex/d");
      if(empty($data["funcid"])) $data["funcid"] = "Company";
      $this->GetLastUrl($data["funcid"]);

      $func = I("request.func");
      if($func != "saveSelectUser" && $func != "save") {
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
        case "selectUser":
          $this->selectUser($data);
          break;
        case "saveSelectUser":
          $this->selectUser_save($data);
          break;
        case "status_on":
          $this->status_changed($data,'1');
          break;
        case "status_off":
          $this->status_changed($data,'0');
          break;
        }
    }



    private function status_changed($data,$to) {

        $id=I("request.id/d" );
        if(!$id) {
            $this->ajaxResult("公司信息参数不存在");
        }
        $content="";
        $model=M('company');

        $smo=$model->where("id='%d'",$id)->find();
        if(empty($smo)) {
            $this->ajaxResult("公司信息数据不存在");
        }
        if($to=='0'){
            if($smo['status']!='1'){
                $this->ajaxResult("公司信息非有效状态");
            }
            $content="调整为失效状态";
        }else{
            if($smo['status']!='0'){
                $this->ajaxResult("公司信息非失效状态");
            }
            $content="调整为有效状态";
        }

        $model->startTrans();
        $result1=$model->where("id='%d'",$id)->save(array(
            'status'=>$to,
            'modify_time'=>date('Y-m-d H:i:s'),
            'modify_user'=>session(C("USER_AUTH_KEY")),
        ));

        $result2 = createLogCommon('company',$id,'状态调整',$content);
        if($result1 && $result2){
            $model->commit();
        }else{
            $model->rollback();
        }
        $this->ajaxResult("", "",  array("_asr.hideConfirm","_asr.openLink"), array("''","'','".$data["funcid"]."','刷新', 1"));
    }

////// source for add /////////////////
    private function add($data) {

       //赋初值

        $search["code"] = "";
        $search["name"] = "";
        $search["status"] = "1";  //第一个选项

        $id = I("request.id/d");
        if($id){
           $sql = table("select * from @company where id=$id");
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
        $html = $this->fetch("Company:add");
        echo $html;
    }

    private function save($data) {
       $id=I("request.id/d" );

       //读取页面输入数据

       $code = I("request.code");
       $name = I("request.name");
       $full_name = I("request.full_name");
       $province = I("request.province");
       $address = I("request.address");
       $postcode = I("request.postcode");
       $mobile = I("request.mobile");
       $linkman = I("request.linkman");
       $status = I("request.status");

       //非页面输入字段
       $input = array();

       //数据有效性校验，非空/数值负数，范围/日期与今日比较

       //数据校验 - 必输项不能为空
       if(!verify_value($code,"empty","","")) $this->ajaxError("公司代码 不能为空");
       if(!verify_value($name,"empty","","")) $this->ajaxError("公司简称 不能为空");
       if(!verify_value($status,"empty","","")) $this->ajaxError("状态 不能为空");

       $model = M("company");

       //判断 code 是否重复建立
       $orig = $model->where("code='$code'".($id?" and id!=$id":""))->find();
       if ($orig) $this->ajaxError("公司代码 $code 已存在");

       //页面输入字段

       $input["code"] = $code;
       $input["name"] = $name;
       $input["full_name"] = $full_name;
       $input["province"] = $province;
       $input["address"] = $address;
       $input["postcode"] = $postcode;
       $input["mobile"] = $mobile;
       $input["linkman"] = $linkman;
       $input["status"] = $status;

       $input["modify_user"] = $this->user["id"];
       $input["modify_time"] =  date('Y-m-d H:i:s.n');

       $model->startTrans();
       $result=false;

       //需要存入日志的字段
       $needSave=array(
            'code'=>'公司代码',
            'name'=>'公司简称',
            'full_name'=>'公司全称',
            'province'=>'省份',
            'address'=>'地址',
            'postcode'=>'邮编',
            'mobile'=>'手机',
            'linkman'=>'联系人',
            'status'=>'状态',
       );

       if(!$id) {
          //新增  建号操作

          $input["create_user"] = $this->user["id"];
          $input["create_time"] = date('Y-m-d H:i:s.n');

          //新增数据 保存数据库
          $result = $id = $model->add($input);
          //建立操作日志
          $result = $result && createLogCommon('company',$id,'新增公司信息','',"*",'code');
       } else {
          //id存在时判断数据库内数据是否存在
          $old=$model->where("id='%d'",array($id))->find();
          if(empty($old)) {
               $this->ajaxError("公司信息数据不存在");
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
               $result = $result && createLogCommon('company',$id,'变更公司信息',$old,'','','code',$needSave);
          }
       }
       if($result){
           $model->commit();
       }else{
           $model->rollback();
           echo json_encode(array("msg"=>message("公司信息保存发生错误")));
           die;
       }

       //完成后跳转
       $this->ajaxReturn($data ['pfuncid'],$data ['funcid'],"refresh", "","closepopup", 1 );
       //转到view页面
       $this->ajaxReturn("","",U("Company/index?func=view&id=$id"), tabtitle('公司',$input["code"] ) );
       die;
    }


//// source for add /////////////////

    private function view($data) {
        $data["p"] = I("request.p/d");
        $data["pagesize"] = I("request.pagesize/d");

        $data["id"] = I("request.id/d");
        $data["no"] = I("request.no");
        if(!$data["id"] && !$data["no"]) {
           $this->ajaxError("公司信息查询参数非法");
        }

        //condition
        $condition="";
        $joinsql="";
        //select search fields
        $selectmasterfields="@company.*";



        $sql = table("select #selectfields# from @company  #join# Where #viewkey# #condition# #orderby#");
        if($data["id"])
           $viewkey=table("@company.id=$data[id]");
        else
           $viewkey=table("@company.code='$data[no]'");
        $sql = str_replace("#selectfields#",table($selectmasterfields),$sql);
        $sql = str_replace("#join#",$joinsql,$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#","",$sql);
        $search = M()->query($sql);
        if(!$search){
           $this->ajaxError("公司信息信息不存在");
        }
        $data["search"] = current($search);


        //按tabsheet - 开始
        $data["id"] = $data["search"]["id"];
        $data["search"]["_tab"] = $this->tabsheet_check(I("request._tab"));
        $page_size=$data["pagesize"] ;//session("Company-".$data["search"]["_tab"]."-PageSize");
        switch($data["search"]["_tab"])
        {

          case "wupinxinxi":
               $data = $this->tab_wupinxinxi_effects($page_size,$data);
               break;
          case "xiangmuxinxi":
               $data = $this->tab_xiangmuxinxi_project($page_size,$data);
               break;
          case "chujieshenqing":
               $data = $this->tab_chujieshenqing_apply($page_size,$data);
               break;
          case "yanqishenqing":
               $data = $this->tab_yanqishenqing_apply_delay($page_size,$data);
               break;
          case "gongsiyonghu":
               $data = $this->tab_gongsiyonghu_company_user($page_size,$data);
               break;
          case "xinxichulirizhi":
               $data = $this->tab_xinxichulirizhi_log_common($page_size,$data);
               break;

        }
        $data["search"]["_tab_".$data["search"]["_tab"]."_p"]=$data["p"];
        $data["search"]["_tab_".$data["search"]["_tab"]."_psize"]=$data["page_size"];
        //session("Company-".$data["search"]["_tab"]."-PageSize", $data["page_size"]);
        //按tabsheet - 结束

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Company:view");
        echo $html;
    }

    //按tabsheet子程序 - 开始

    private function tab_wupinxinxi_effects($tab_pagesize,$data)
    {
        $orderby="";
        $joinsql="";


        $condition = "" ;


        //select detail fields
        $selectfields="@effects.status ";
        $selectfields.=",@effects.id ";
        $selectfields.=",@effects.company_id ";
        $selectfields.=",@effects.type ";
        $selectfields.=",@effects.category_code ";
        $selectfields.=",@effects.code ";
        $selectfields.=",@effects.name ";
        $selectfields.=",@effects.prefix ";
        $selectfields.=",@effects.barcode ";
        $selectfields.=",@effects.content ";
        $selectfields.=",@effects.img ";
        $selectfields.=",@effects.is_kef ";
        $selectfields.=",@effects.is_real ";
        $selectfields.=",@effects.department_id ";
        $selectfields.=",@effects.address ";
        $selectfields.=",@effects.custodian_id ";
        $selectfields.=",@effects.approval_require ";
        $selectfields.=",@effects.allow_borrow ";
        $selectfields.=",@effects.apply_no ";
        $selectfields.=",@effects.create_time ";
        $selectfields.=",@effects.modify_time ";

        $viewkey="@effects.company_id='".$data["search"]["id"]."'";
     //   if(!$viewkey)
     //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @effects  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @effects  #join# Where #viewkey# #condition# #orderby#");

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

    private function tab_xiangmuxinxi_project($tab_pagesize,$data)
    {
        $orderby="";
        $joinsql="";


        $condition = "" ;


        //select detail fields
        $selectfields="@project.status ";
        $selectfields.=",@project.id ";
        $selectfields.=",@project.company_id ";
        $selectfields.=",@project.code ";
        $selectfields.=",@project.name ";
        $selectfields.=",@project.address ";
        $selectfields.=",@project.plan_start_time ";
        $selectfields.=",@project.plan_end_time ";
        $selectfields.=",@project.remarks ";
        $selectfields.=",@project.create_time ";
        $selectfields.=",@project.modify_time ";

        $viewkey="@project.company_id='".$data["search"]["id"]."'";
     //   if(!$viewkey)
     //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @project  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @project  #join# Where #viewkey# #condition# #orderby#");

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

    private function tab_chujieshenqing_apply($tab_pagesize,$data)
    {
        $orderby="";
        $joinsql="";


        $condition = "" ;


        //select detail fields
        $selectfields="@apply.status ";
        $selectfields.=",@apply.id ";
        $selectfields.=",@apply.company_id ";
        $selectfields.=",@apply.apply_no ";
        $selectfields.=",@apply.apply_project_no ";
        $selectfields.=",@apply.department_id ";
        $selectfields.=",@apply.project_name ";
        $selectfields.=",@apply.user_id ";
        $selectfields.=",@apply.plan_start_time ";
        $selectfields.=",@apply.plan_end_time ";
        $selectfields.=",@apply.plan_take_user ";
        $selectfields.=",@apply.bollow_reason ";
        $selectfields.=",@apply.effects_code ";
        $selectfields.=",@apply.effects_name ";
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
        $selectfields.=",@apply.return_remarks ";
        $selectfields.=",@apply.effects_status ";
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

        $viewkey="@apply.company_id='".$data["search"]["id"]."'";
     //   if(!$viewkey)
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
        $selectfields.=",@apply_delay.apply_no ";
        $selectfields.=",@apply_delay.apply_delay_no ";
        $selectfields.=",@apply_delay.department_id ";
        $selectfields.=",@apply_delay.user_id ";
        $selectfields.=",@apply_delay.user_name ";
        $selectfields.=",@apply_delay.effects_id ";
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

        $viewkey="@apply_delay.company_id='".$data["search"]["id"]."'";
     //   if(!$viewkey)
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

    private function tab_gongsiyonghu_company_user($tab_pagesize,$data)
    {
        $orderby="";
        $joinsql="";


        $condition = "" ;


        //select detail fields
        $selectfields="@company_user.company_id ";
        $selectfields.=",@company_user.department_id ";
        $selectfields.=",@company_user.user_id ";
        $selectfields.=",@user.code ";
        $selectfields.=",@user.name ";
        $selectfields.=",@company_user.level ";

        $viewkey="@company_user.company_id='".$data["search"]["id"]."'";
     //   if(!$viewkey)
     //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @company_user LEFT JOIN @user ON @user.id=@company_user.user_id  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @company_user LEFT JOIN @user ON @user.id=@company_user.user_id  #join# Where #viewkey# #condition# #orderby#");

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
        $selectfields.=",@log_common.type ";
        $selectfields.=",@log_common.data_id ";
        $selectfields.=",@log_common.data_code ";
        $selectfields.=",@log_common.subject ";
        $selectfields.=",@log_common.content ";

        $viewkey="@log_common.data_id='".$data["search"]["id"]."'";
        $viewkey.=" and @log_common.type='company'";
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
        $idefault="wupinxinxi";
        switch($itab)
        {

          case "wupinxinxi":
          case "xiangmuxinxi":
          case "chujieshenqing":
          case "yanqishenqing":
          case "gongsiyonghu":
          case "xinxichulirizhi":

              break;
          default:
              $itab=$idefault;
              break;
         }
        return $itab;
    }
    //按tabsheet子程序 - 结束

    private function deleteProcess($id,&$type) {

        $smo=M('company')->where("id='%d'",array($id))->find();
        if(empty($smo)) {
            $this->ajaxResult("公司信息数据不存在");
        }
        if($smo['status']!=0){
            $this->ajaxResult("公司信息状态不能删除");
        }

        $result=true;
        if($smo['status']!=0){
            $result=M('company')->where("id='%d'",array($id))->save(array('status'=>8,'cancel_time'=>date('Y-m-d H:i:s'),'cancel_status'=>1));
            $result = $result && createLogCommon('company',$id,'取消公司信息','');
        }else{
            $type=2;
            $result = $result && createLogCommon('company',$id,'删除公司信息','');
            $result = $result && M('company')->where("id='%d'",array($id))->delete();
        }
        return $result;
    }

    private function order_delete($data) {

        $id=I("request.id/d" );
        if(!$id) {
             $this->ajaxResult("公司信息参数不存在");
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
            $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideConfirm"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Home/Company/index?func=view&id=".$id).  "','".filterFuncId("Company_View","id=$data[id]")."','公司信息查看', 0","''"));
        }else{
            $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideConfirm"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Summary/CompanySummary/index?func=search&id=".$id).  "','".filterFuncId("CompanySummary_View","id=$data[id]")."','公司信息列表', 0","''"));
        }
       die;
    }

    private function order_rollback($data) {

        $id=I("request.id/d" );
        if(!$id) {
             $this->ajaxResult("公司信息参数不存在");
        }

        $smo=M('company')->where("id='%d'",$id)->find();
        if(empty($smo)) {
            $this->ajaxResult("公司信息数据不存在");
        }
        if($smo['status']!=1){
            $this->ajaxResult("公司信息非确认状态，不能反审");
        }

        $model=M('company');
        $model->startTrans();
        $result1=$model->where("id='%d'",$id)->save(array(
            'status'=>0,
            'notice_status'=>0,
            'confirm_status'=>0,
        ));

        $result2 = createLogOrder('company',$id,'公司信息反审','');
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
             $this->ajaxResult("公司信息参数不存在");
        }

        $smo=M('company')->where("id='%d'",$id)->find();
        if(empty($smo)) {
            $this->ajaxResult("公司信息数据不存在");
        }
        if($smo['status']!=0 ){
            $this->ajaxResult("公司信息非待确认状态，不能确认");
        }


        $model=M('company');
        $model->startTrans();
        $result1=$model->where("id='%d'",$id)->save(array(
            'status'=>1,
            'notice_time'=>date('Y-m-d H:i:s'),
            'notice_status'=>1,
            'confirm_status'=>1,
            'confirm_time'=>date('Y-m-d H:i:s'),
        ));

        $result2 = createLogOrder('company',$id,'公司信息确认','');
        if($result1 && $result2){
            $model->commit();
        }else{
            $model->rollback();
        }
        $this->ajaxResult("", "",  array("_asr.hideConfirm","_asr.openLink"), array("''","'','".$data["funcid"]."','刷新', 1"));
    }


    private function selectUser($data) {
        $type = I("get.type/d");
        $data["_pid"] = I("request.id/d");
        $data["search"]["_keyword"] = I("get._keyword");
        $data["search"]["loaddata"] = I("get.loaddata");


        $data["p"] = I("get.p/d");
        $data["zindex"]=I("get.zindex/d");

        if ($data["_pid"]<=0) {
            $this->ajaxError("公司参数错误");
        }

        $smo = M('company')->where("id='%d' and status=1", array($data["_pid"]))->find();
        if (!$smo) {
            $this->ajaxError("公司不存在或非有效状态");
        }
        $where = "";
        if($data["search"]["loaddata"]==1 || 1) {

            if (!empty($data["search"]["_keyword"])) {
                if($data["search"]["_keyword"]=="业务"){
                    $where .= " AND p.type=1 ";
                }elseif($data["search"]["_keyword"]=="管理") {
                    $where .= " AND p.type=0 ";
                }else{
                    $where .= " AND (p.code like '%" . $data["search"]["_keyword"] . "%'";
                    $where .= " or p.name like '%" . $data["search"]["_keyword"] . "%')";
                }
            }



            $data["page_size"] = I("get.pagesize/d");
            $data["page_size"] = $data["page_size"] <= 0 ? session("selectProduct-PageSize") : $data["page_size"];
            if (!$data["page_size"]) {
                $data["page_size"] = 50;
            }
            //$data["page_size"] = 2;
            session("selectProduct-PageSize", $data["page_size"]);

            $pre = C("DB_PREFIX");

            $orderby = " ORDER BY p.id";

            $data["salesinfo"] = $smo;

            if ($type == 1 && 0) {
                $sql = "SELECT p.code, p.name,p.type,p.status ,d.department_id,d.level,d.user_id as _did " .
                    "FROM " . $pre . "company_user as d " .
                    "LEFT JOIN " . $pre . "user as p on d.user_id=p.id " .
                    "WHERE p.code!='admin' and d.company_id='" . $data["_pid"] . "'  "; //AND p.status =1
                $orderby = " ORDER BY d.id";
            } else {
                $sql = "SELECT p.id, p.code, p.name,p.type,p.status ,d.department_id,d.level,d.user_id as _did " .
                    "FROM " . $pre . "user as p " .
                    "LEFT JOIN (select user_id,department_id,level from " . $pre . "company_user where company_id='" . $data["_pid"] . "') as d on d.user_id=p.id " .
                    "WHERE p.code!='admin' $where"; //AND p.status =1
                $orderby = " ORDER BY case when _did>0 then 0 else 1 end , p.status desc,p.type,p.sort,p.name";
            }

            $count_sql = "SELECT count(1) AS cnt FROM (" . $sql . ") a";
            $sql .= $orderby;


            $count = M()->query($count_sql);
            $count = $count[0]["cnt"];
            $data["list_total"] = $count;
            if ($count < $data["page_size"])
                $tmp = 1;
            else {
                $tmp = intval($count / $data["page_size"]);
                if ($count % $data["page_size"] != 0) {
                    $tmp++;
                }
            }
            if (!$data["p"]) {
                $data["p"] = 1;
            }

            if ($data["p"] > $tmp) {
                $data["p"] = $tmp;
            }

            $sql .= " LIMIT " . (($data["p"] - 1) * $data["page_size"]) . ", " . $data["page_size"];

            $data["list"] = M()->query($sql);

            //}
            $pageClass = new \Think\Page($count, $data["page_size"]);
            $pageClass->rollPage = 8;
            $data["page"] = $pageClass->show_drp($data["funcid"], "编辑公司用户信息");

        }
        $data["search"]["loaddata"]=1;


        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }

        $html = $this->fetch("Company:selectUser");
        echo $html;
    }

    private function selectUser_save($data)
    {
        $companyid = I("request._pid");
        $close = I("request.close");

        $id = I("post.id");

        if (empty($id)) {
            $this->ajaxError("没有输入");
        }

        $model = M("company_user");
        $smo = M('company')->where("id='%d'", array($companyid))->find();

        $model->startTrans();
        $result = false;
        $qty_total = 0;

        $gm = M('user');

        $chg_info = "";
        $add_info = "";
        $del_info = "";


        foreach ($id as $k => $v) {
            $g = $gm->find($v);
            if (!$g) {
                $this->ajaxError_func("用户信息不存在", $data["funcid"] . "_focus");
            }

            $department_id = floatval(I("department_id_" . $v));
            $level = I("level_" . $v);
            $action= I("action_" . $v);

            //if ($g["status"] != 1) {
            //    $this->ajaxError_func("用户($g[name])非有效状态", $data["funcid"] . "_focus");
            //}

            $smd = $model->where("company_id='%d' AND user_id='%d' ", array($companyid, $v))->find();

            if($action==1 ){
                if($smd ){
                    $model->where("company_id='%d' AND user_id='%d' ", array($companyid, $v))->delete();
                    $del_info .= ($del_info ? "," : "") . $g['name'];
                }
                continue;
            }


            $cur_data = array();
            $cur_data['company_id'] = $companyid;
            $cur_data['user_id'] = $v;
            $cur_data['department_id'] = $department_id;
            $cur_data['level'] = $level;

            if (!empty($smd)) {
                $model->where("company_id='%d' AND user_id='%d' ", array($companyid, $v))->save($cur_data);
                if ($cur_data['department_id'] != $smd['department_id'] ||
                    $cur_data['level'] != $smd['level']) {
                    $chg_info .= ($chg_info ? "," : "") . $g['name'] . "=部门[$department_id]级别[$level]";
                }
            } else {
                $result = $model->add($cur_data);
                if (!$result) {
                    $this->ajaxError_func("保存公司用户($g[name])失败", $data["funcid"] . "_focus");
                }
                $add_info .= ($add_info ? "," : "") . $g['name'] . "=部门[$department_id]级别[$level]";
            }
        }

        $content=$add_info?"添加[$add_info]":"";
        if($chg_info) $content.=($content?", ":"")."变动[$chg_info]";
        if($del_info) $content.=($content?", ":"")."删除[$del_info]";

        $result2 = createLogCommon('company',$companyid,'编辑用户',$content);
        if(!$result2){
            $this->ajaxError_func("创建公司维护日志失败",$data["funcid"]."_focus");
        }
        $model->commit();

        if($close == "1") {
            $this->ajaxReturn($data["pfuncid"],$data["funcid"],"refresh");
        } else {
            $this->ajax_openLink($data["pfuncid"]);
            $this->ajax_func($data["funcid"]."_clear()");

            $this->ajaxResult();
            //$this->ajaxReturn($data["pfuncid"],$data["funcid"],"refresh","","-");
        }


        if($close == "1") {
            $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideMask()"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'','".$data["pfuncid"]."','刷新', 1",""));
        } else {
            $this->ajaxResult("", "",  array("_asr.openLink", $data["funcid"]."_clear()"), array("'','". $data["pfuncid"]. "','刷新',1", ""));
        }
    }
}
