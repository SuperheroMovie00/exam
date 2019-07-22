<?php
namespace Home\Controller;

//
//注释: EffectsCategory - 物品分类信息
//
use Home\Controller\BasicController;
use Org\Util\String;
use Think\Log;
class EffectsCategoryController extends BasicController {

    public function _init() {
        $funcs = $this->getUserRoleList($this->user,array( 'EffectsCategory', '/Home/EffectsCategory', ));
        if ($funcs)
            $this->assign("rights",  $funcs);
        else{
            $funcs = array(
                         array("key"=>"refresh","func"=>"EffectsCategory","Action"=>"refresh") ,
                         array("key"=>"save","func"=>"EffectsCategory","Action"=>"save") ,
                         array("key"=>"search","func"=>"/Home/EffectsCategory","Action"=>"view") ,
                         array("key"=>"detail_import","func"=>"/Home/EffectsCategory","Action"=>"detail_import") ,
                         array("key"=>"detail_select","func"=>"/Home/EffectsCategory","Action"=>"selectproduct") ,
                         array("key"=>"edit_base","func"=>"/Home/EffectsCategory","Action"=>"edit_base") ,
                         array("key"=>"order_edit","func"=>"/Home/EffectsCategory","Action"=>"order_edit") ,
                         array("key"=>"order_delete","func"=>"/Home/EffectsCategory","Action"=>"delete") ,
                         array("key"=>"batch_opt1","func"=>"/Home/EffectsCategory","Action"=>"batch_opt1") ,
                         array("key"=>"batch_opt2","func"=>"/Home/EffectsCategory","Action"=>"batch_opt2") ,
                         array("key"=>"batch_delete","func"=>"/Home/EffectsCategory","Action"=>"batch_delete")
             );
            $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"EffectsCategory"));
    }

    public function index() {
      $data["pfuncid"] = I("request.pfuncid");
      $data["funcid"] = I("request.funcid");
      $data["zindex"] = I("request.zindex/d");
      if(empty($data["funcid"])) $data["funcid"] = "EffectsCategory";
      $this->GetLastUrl($data["funcid"]);

      $func = I("request.func");
      if($func != "saveSelectProduct" && $func != "save") {
        $this->GetLastUrl($data["funcid"]);
      }

      switch ($func) {
      case "search":
          $this->search($data);
          break;
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
        case "loadcategoryinfo":
            $this->loadcategoryinfo($data);
            break;
        case "effects_del":
            $this->effects_del($data);
            break;
      }
    }

////// source for add /////////////////

    private function add($data) {

       //赋初值

        $search["code"] = "";
        $search["name"] = "";
        $search["status"] = "0";  //第一个选项

        $id = I("request.id/d",0);
        $pid = I("request.pid/d",0);
        $companyid = I("request.company_id/d");
        if($id){
           $sql = table("select * from @effects_category where id=$id");
           $search = M()->query($sql);
           if(!$search)
               die;
           $data["search"] = current($search);
           $data["id"] = $data["search"]["id"];
        }else{
            $search["company_id"]=$companyid;
            $search["status"]=1;
            $data["search"] = $search;

            $data['search']['parent_id']=$pid;

        }
        $model_ec=M("EffectsCategory");
        if($data['search']['parent_id']>0)
        {


            $ret=$model_ec->field("name,company_id,code") ->where("id='".$data['search']['parent_id']."'") ->find();
            if($ret){
                $data["search"]["parent_id_name"] = $ret["name"];
                $data["search"]["company_id"] = $ret["company_id"];
            }

        }

        if($id<=0)
        {

            $max_code=$model_ec->where(array("parent_id"=>$data['search']['parent_id']))->order("code desc")->getField("code");

            if(empty($max_code))
            {
                if($ret)
                {
                    $cur_code=$ret["code"];
                }else
                {
                    $cur_code=get_table_Company_byID($data["search"]["company_id"],"code");

                }
                $cur_code.="01";
            }else
            {

                $cur_seq=intval(substr($max_code, -2))+1;
                $cur_p=substr($max_code, 0,strlen($max_code)-2);
                $cur_code=$cur_p.str_pad($cur_seq,2,0,STR_PAD_LEFT);
            }

            $data["search"]["code"] = $cur_code;
        }


        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("EffectsCategory:add");
        echo $html;
    }

    private function save($data) {
       $id=I("request.id/d" );

//       $model = M("effects_category");
//        $input=$model->where(array("id"=>20))->find();
//        $this->ajax_closePopup($data ['funcid']);
//        $this->ajax_func($data ['pfuncid']."_category_add_callback",json_encode($input));
//        $this->ajaxResult();
//        die;
       //读取页面输入数据

       $code = I("request.code");
       $name = I("request.name");
       $parent_id_name = I("request.parent_id_name");
       $parent_id = I("request.parent_id/d",0);
       $approval_require = I("request.approval_require");
       $alarm_days = I("request.alarm_days/d",0);
       $sort = I("request.sort/d",0);
       $status = I("request.status");
       $company_id = I("request.company_id");
       $onlyone = I("request.onlyone");

       //非页面输入字段
       $input = array();

       //数据有效性校验，非空/数值负数，范围/日期与今日比较

       //数据校验 - 必输项不能为空
       if(!verify_value($code,"empty","","")) $this->ajaxError("代码 不能为空");
       if(!verify_value($name,"empty","","")) $this->ajaxError("名称 不能为空");
       if(!verify_value($status,"empty","","")) $this->ajaxError("状态 不能为空");

       if(!verify_value($alarm_days,"nagitive","","")) $this->ajaxError("提前报警 不能为负数");
       //if ($alarm_days < 100 || $alarm_days > 105) $this->ajaxError("校验样例 提前报警值在100-105之间");
       if(!verify_value($sort,"nagitive","","")) $this->ajaxError("排序 不能为负数");
       //if ($sort < 100 || $sort > 105) $this->ajaxError("校验样例 排序值在100-105之间");

       $model = M("effects_category");

       //判断 code 是否重复建立
       $orig = $model->where("code='$code'".($id?" and id!=$id":""))->find();
       if ($orig) $this->ajaxError("代码 $code 已存在");

       if($parent_id>0)
       {
           $parent_info=$model->where(array("id"=>$parent_id))->find();
           if(!$parent_info)
           {
               $this->ajaxError("上级不存在");
           }
           $company_id=$parent_info["company_id"];
       }

       //页面输入字段

       $input["code"] = $code;
       $input["name"] = $name;
       $input["parent_id_name"] = $parent_id_name;
       $input["parent_id"] = $parent_id;
       $input["approval_require"] = $approval_require;
       $input["alarm_days"] = $alarm_days;
       $input["sort"] = $sort;
       $input["onlyone"] = $onlyone;

       $input["status"] = $status;

       $input["modify_user"] = $this->user["id"];
       $input["modify_time"] =  date('Y-m-d H:i:s.n');

       $model->startTrans();
       $result=false;

       //需要存入日志的字段
       $needSave=array(
            'code'=>'代码',
            'name'=>'名称',
            'parent_id'=>'上级',
            'approval_require'=>'审批要求',
            'alarm_days'=>'提前报警',
            'sort'=>'排序',
            'status'=>'状态',
       );

       if(!$id) {
          //新增  建号操作
           $input["company_id"] = $company_id;
          $input["create_user"] = $this->user["id"];
          $input["create_time"] = date('Y-m-d H:i:s.n');

          //新增数据 保存数据库
          $result = $id = $model->add($input);
          //建立操作日志
          $result = $result && createLogCommon('effects_category',$id,'新增物品分类信息','',"*",'code');
       } else {
          //id存在时判断数据库内数据是否存在
          $old=$model->where("id='%d'",array($id))->find();
          if(empty($old)) {
               $this->ajaxError("物品分类信息数据不存在");
          }

          //按主键更新数据
          $result = $model->where("id = $id")->save($input);
          $input["company_id"]=$old["company_id"];
          $isSaveLog=false;
          foreach ($needSave as $key=>$v) {
              if($old[$key]!=$input[$key]) {
                  $isSaveLog=true;
                  break;
              }
          }
          if($isSaveLog){
          //建立操作日志
               $result = $result && createLogCommon('effects_category',$id,'变更物品分类信息',$old,'','','code',$needSave);
          }
       }
       if($result){
           $model->commit();
       }else{
           $model->rollback();
           echo json_encode(array("msg"=>message("物品分类信息保存发生错误")));
           die;
       }

       //完成后跳转

        $input['id']=$id;
       //$this->ajaxReturn($data ['pfuncid'],$data ['funcid'],"refresh", "","closepopup", 1 );
        $this->ajax_closePopup($data ['funcid']);
        $this->ajax_func($data ['pfuncid']."_category_add_callback",json_encode($input));
        $this->ajaxResult();
        //转到view页面
       //$this->ajaxReturn("","",U("EffectsCategory/index?func=view&id=$id"), tabtitle('物品分类',$input["code"] ) );
       die;
    }


//// source for add /////////////////

    private function view($data) {
        $data["p"] = I("request.p/d");
        $data["pagesize"] = I("request.pagesize/d");

        $data["id"] = I("request.id/d");
        $data["no"] = I("request.no");
        if(!$data["id"] && !$data["no"]) {
           $this->ajaxError("物品分类信息查询参数非法");
        }

        //condition
        $condition="";
        $joinsql="";
        //select search fields
        $selectmasterfields="@effects_category.*";

        $selectmasterfields.=",a.name effects_category_name ";


        $sql = table("select #selectfields# from @effects_category  #join# Where #viewkey# #condition# #orderby#");
        $joinsql .= table(" LEFT JOIN @effects_category a ON a.id=@effects_category.parent_id ");
        if($data["id"])
           $viewkey=table("@effects_category.id=$data[id]");
        else
           $viewkey=table("@effects_category.code='$data[no]'");
        $sql = str_replace("#selectfields#",table($selectmasterfields),$sql);
        $sql = str_replace("#join#",$joinsql,$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#","",$sql);
        $search = M()->query($sql);
        if(!$search){
           $this->ajaxError("物品分类信息信息不存在");
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
        $page_size=$data["pagesize"] ;//session("EffectsCategory-".$data["search"]["_tab"]."-PageSize");
        switch($data["search"]["_tab"])
        {

          case "caozuorizhi":
               $data = $this->tab_caozuorizhi_log_common($page_size,$data);
               break;

        }
        $data["search"]["_tab_".$data["search"]["_tab"]."_p"]=$data["p"];
        $data["search"]["_tab_".$data["search"]["_tab"]."_psize"]=$data["page_size"];
        //session("EffectsCategory-".$data["search"]["_tab"]."-PageSize", $data["page_size"]);
        //按tabsheet - 结束

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("EffectsCategory:view");
        echo $html;
    }

    //按tabsheet子程序 - 开始

    private function tab_caozuorizhi_log_common($tab_pagesize,$data)
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
        $viewkey.=" and @log_common.type='effects_category'";
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

        $smo=M('effects_category')->where("id='%d'",array($id))->find();
        if(empty($smo)) {
            $this->ajaxResult("物品分类信息数据不存在");
        }
        if($smo['status']!=1){
            $this->ajaxResult("物品分类信息状态不能删除");
        }

        $count=M('effects_category')->where(array("parent_id"=>$id))->count();
        if($count>0){
            $this->ajaxResult("物品分类下还有子分类，请先删除");
        }

        $count=M('effects_category_list')->where(array("effects_category_id"=>$id))->count();
        if($count>0){
            $this->ajaxResult("物品分类下还有商品，请先删除");
        }



        $result=true;
//        if($smo['status']!=0){
//            $result=M('effects_category')->where("id='%d'",array($id))->save(array('status'=>0,'modify_time'=>date('Y-m-d H:i:s')));
//            $result = $result && createLogCommon('effects_category',$id,'取消物品分类信息','');
//        }else{
            $type=2;
            $result = $result && createLogCommon('effects_category',$id,'删除物品分类信息','');
            $result = $result && M('effects_category')->where("id='%d'",array($id))->delete();
//        }
        return $result;
    }

    private function order_delete($data) {

        $id=I("request.id/d" );
        if(!$id) {
             $this->ajaxResult("物品分类信息参数不存在");
        }

        $m=M();
        $m->startTrans();
        $type=1;
        $info=M("EffectsCategory")->where(array("id"=>$id))->find();
        $r=$this->deleteProcess($id,$type);

        if($r){
            $m->commit();
        }else{
            $m->rollback();
        }

        $this->ajax_hideConfirm();
        $this->ajax_func($data ['funcid']."_category_delete_callback",json_encode($info));
        $this->ajaxResult();



//        if($type==1){
//
//            //$this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideConfirm"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Home/EffectsCategory/index?func=view&id=".$id).  "','".filterFuncId("EffectsCategory_View","id=$data[id]")."','物品分类信息查看', 0","''"));
//        }else{
//            $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideConfirm"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Summary/EffectsCategorySummary/index?func=search&id=".$id).  "','".filterFuncId("EffectsCategorySummary_View","id=$data[id]")."','物品分类信息列表', 0","''"));
//        }
       die;
    }

    private function order_rollback($data) {

        $id=I("request.id/d" );
        if(!$id) {
             $this->ajaxResult("物品分类信息参数不存在");
        }

        $smo=M('effects_category')->where("id='%d'",$id)->find();
        if(empty($smo)) {
            $this->ajaxResult("物品分类信息数据不存在");
        }
        if($smo['status']!=1){
            $this->ajaxResult("物品分类信息非确认状态，不能反审");
        }

        $model=M('effects_category');
        $model->startTrans();
        $result1=$model->where("id='%d'",$id)->save(array(
            'status'=>0,
            'notice_status'=>0,
            'confirm_status'=>0,
        ));

        $result2 = createLogOrder('effects_category',$id,'物品分类信息反审','');
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
             $this->ajaxResult("物品分类信息参数不存在");
        }

        $smo=M('effects_category')->where("id='%d'",$id)->find();
        if(empty($smo)) {
            $this->ajaxResult("物品分类信息数据不存在");
        }
        if($smo['status']!=0 ){
            $this->ajaxResult("物品分类信息非待确认状态，不能确认");
        }


        $model=M('effects_category');
        $model->startTrans();
        $result1=$model->where("id='%d'",$id)->save(array(
            'status'=>1,
            'notice_time'=>date('Y-m-d H:i:s'),
            'notice_status'=>1,
            'confirm_status'=>1,
            'confirm_time'=>date('Y-m-d H:i:s'),
        ));

        $result2 = createLogOrder('effects_category',$id,'物品分类信息确认','');
        if($result1 && $result2){
            $model->commit();
        }else{
            $model->rollback();
        }
        $this->ajaxResult("", "",  array("_asr.hideConfirm","_asr.openLink"), array("''","'','".$data["funcid"]."','刷新', 1"));
    }


    private function search($data) {

        $model=M("Company");
        $categoty_list=$model->where(array("status"=>1))->select();

        foreach ($categoty_list as $k=>$v)
        {
            $this->categroyall_list[]=$v;
            $list_cate=$this->getcategory_list($v["id"],0);
            $categoty_list[$k]["child_nums"]=count($list_cate);
            $categoty_list[$k]["child"]=$list_cate;
            $categoty_list[$k]["show_type"]="0";
        }
        $data["categoty_list"]=$categoty_list;
        $data["pfuncid"]=$data["funcid"];
        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }

        $html = $this->fetch("EffectsCategory:search");
        echo $html;
    }

    public $categroyall_list=array();

    private function getcategory_list($company_id,$id){
        $model_category=M("EffectsCategory");
        $category_list=$model_category->where(array("status"=>1,"company_id"=>$company_id,"parent_id"=>$id))
            ->order("company_id,level")->select();
        foreach ($category_list as $k=>$item) {
                $list=$this->getcategory_list($company_id,$item['id']);
                $category_list[$k]["child"]=$list;
                $category_list[$k]["child_nums"]=count($list);
                $category_list[$k]["show_type"]="1";

        }
        return $category_list;
    }


    private function loadcategoryinfo($data) {
        $data["p"] = I("request.p/d");
        $id = I("get.id/d");
        $type = I("get.t/d");
//        if(empty($id)) {
//            $this->ajaxResult("非法操作");
//        }
        if($type)
        {
        $gm = M("EffectsCategory")->where("id = $id")->find();
        if(empty($gm)) {
            $this->ajaxResult("bom不存在");
        }
        $data["goods_bom"] = $gm;

        $model=M("EffectsCategoryList as ec");

        $page_size = I("request.pagesize/d");
        if($page_size<=0)
        {
            $page_size=10;
        }
        $count=$model->join("__EFFECTS__ e on ec.effects_id=e.id")
            ->where(array("ec.effects_category_id"=>$id))->count();

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


        $list=$model->join("__EFFECTS__ e on ec.effects_id=e.id")
            ->where(array("ec.effects_category_id"=>$id))
            ->limit((($data["p"] - 1) * $page_size). ", $page_size")
            ->select();

        $pageClass = new \Think\Page($count,$page_size);
        $pageClass->rollPage = 8;

        $data["page"] = $pageClass->show_summary($data["funcid"],"");
        $data["page_size"] = $page_size;

        $data["list"] = $list;
//        $data["goods"] = M("goods")->field("id, goods_no, style_info, name, type, bom_id")->where("id = ".$gm["goods_id"])->find();
//
//        if($gm["is_include"]) {
//            $data["list"] = M("goods_bom")->alias("a")->field("a.*, b.style_info")
//                ->join("__GOODS__ as b on a.goods_id = b.id","left")
//                ->where("a.parent_id = ".$id)->select();
//        } else {
//            $tmp = M("goods_bom")->where("id = ".$data["goods"]["bom_id"])->find();
//            $data["list"] = M("goods_bom")->alias("a")->field("a.*, b.style_info")
//                ->join("__GOODS__ as b on a.goods_id = b.id","left")
//                ->where("a.parent_id = ".$tmp["id"])->select();
//        }
//
//        $data["ofuncid"] = I("get.ofuncid");
//        $data["group_id"] = I("get.group_id");
        }
        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("EffectsCategory:info");
        echo $html;
    }

    private function selectProduct($data) {
        $type = I("get.type/d");
        $data["category_id"] = I("request.category_id");
        $data["search"]["category_code"] = I("get.category_code");
        $data["search"]["category_code_name"] = I("get.category_code_name");
        $data["search"]["name"] = I("get.name");
        $data["search"]["prefix"] = I("get.prefix");
        $data["search"]["goods_no"] = I("get.goods_no");
        $data["search"]["namelike"] = I("get.namelike/d");
        $data["search"]["allow_kef"] = I("get.allow_kef/d");
        $data["search"]["jixing"] = I("get.jixing");
        $data["search"]["loaddata"] = I("get.loaddata");


        $data["p"] = I("get.p/d");
        $data["zindex"]=I("get.zindex/d");

        if (!$data["category_id"]) {
            $this->ajaxError("销售订单参数错误");
        }

        $smo = M('EffectsCategory')->where("id='%d' and status=1", array($data["category_id"]))->find();
        if (!$smo) {
            $this->ajaxError("分类不存在或不是有效状态");
        }

        $where = "1=1";
        if($data["search"]["loaddata"]==1) {
//            if (!empty($data["search"]["category_code"])) {
//                $cate = $data["search"]["category_code"];
//                if (!is_array($data["search"]["category_code"])) {
//                    $cate = array($data["search"]["category_code"]);
//                }
//                $wt = "'" . join("','", $cate) . "'";
//                $where .= " AND p.category_code IN ($wt)";
//            }

            if (!empty($data["search"]["prefix"])) {
                $where .= " AND (p.prefix like '%" . $data["search"]["prefix"] . "%'";
                $where .= " or p.name like '%" . $data["search"]["prefix"] . "%'";
                $where .= " or p.code like '%" . $data["search"]["prefix"] . "%')";
            }



            if (!empty($data["search"]["name"])) {
                if ($data["search"]["namelike"]) {
                    $where .= " AND p.name like '%" . $data["search"]["name"] . "%'";
                } else {
                    $where .= " AND p.name = '" . $data["search"]["name"] . "'";
                }
            }

            if (!empty($data["search"]["code"])) {
                $where .= " AND p.code = '" . $data["search"]["code"] . "'";
            }


            $data["page_size"] = I("get.pagesize/d");
            $data["page_size"] = $data["page_size"] <= 0 ? session("selectProduct-PageSize") : $data["page_size"];
            if (!$data["page_size"]) {
                $data["page_size"] = 50;
            }
            //$data["page_size"] = 2;
            session("selectProduct-PageSize", $data["page_size"]);


            $orderby = " ORDER BY p.id";


            $map=array();
            if(!empty($where))
            {
                $map["_string"]=trim($where,"AND");
            }
            $map["company_id"]=$smo["company_id"];
            if ($type == 1) {
                $map["ec.effects_id"]=array("exp"," is null ");
                $sql=M("Effects as p")
                    ->join("left join __EFFECTS_CATEGORY_LIST__ as ec on p.id=ec.effects_id")
                    ->where($map)->buildSql();

            } else {
                $map["p.status"]=1;
                $sql=M("Effects as p")->where($map)->buildSql();

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
            $data["page"] = $pageClass->show_drp($data["funcid"], "编辑物品信息");

        }
        $data["search"]["loaddata"]=1;


        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }

        $html = $this->fetch("EffectsCategory:selectProduct");
        echo $html;
    }

    private function saveSelectProduct($data) {
        $category_id = I("request.category_id");
        $close = I("request.close");

        $id= I("post.id");

        if(empty($id)) {
            $this->ajaxError("物品没有输入");
        }

        $model=M('EffectsCategoryList');
        $smo=M('EffectsCategory')->where("id='%d'",array($category_id))->find();

        if($smo["onlyone"]==1)
        {
            if(count($id)>1)
            {
                $this->ajaxError("此分类只允许单一物品");
            }else
            {
                $tcount=$model->where(array("effects_category_id"=>$category_id))->count();
                if($tcount>0)
                {
                    $this->ajaxError("此分类只允许单一物品");
                }
            }
        }

        $model->startTrans();
        $result=false;
        $qty_total=0;
        $gm=M('Effects');

        $chg_info="";
        $add_info="";
        $del_info="";
        foreach ($id  as $k=>$v) {
            $g = $gm->find($v);
            if (!$g) {
                $this->ajaxError_func("物品信息不存在", $data["funcid"] . "_focus");
            }

            if ($g["status"] != 1) {
                $this->ajaxError_func("物品($g[name])无效状态", $data["funcid"] . "_focus");
            }
            $smd = $model->where("effects_category_id='%d' AND effects_id='%d' ", array($category_id, $v))->find();

            $cur_data = array();
            $cur_data['effects_category_id'] = $category_id;
            $cur_data['effects_id'] = $v;


            if (!empty($smd)) {
            } else {
                $result = $model->add($cur_data);
                if (!$result) {
                    $this->ajaxError_func("分类保存物品($g[name])失败", $data["funcid"] . "_focus");
                }
                $add_info .= ($add_info ? "," : "") . $g['name'] . "=" . $smo["name"];
            }
        }
        $content=$add_info?"添加[$add_info]":"";
        if($chg_info) $content.=($content?", ":"")."变动[$chg_info]";
        if($del_info) $content.=($content?", ":"")."删除[$del_info]";

        $result2 = createLogCommon('effects',$v,"添加分类",$content);
        if(!$result2){
            $this->ajaxError_func("创建销售订单日志失败",$data["funcid"]."_focus");
        }
        $model->commit();


        if($close == "1") {
            $this->ajax_closePopup($data["funcid"]);
            $this->ajax_func($data ['pfuncid']."_load_bom_info",$category_id);
            $this->ajaxReturn();
            //$this->ajaxReturn($data["pfuncid"],$data["funcid"],"refresh");
        } else {
            //$this->ajax_openLink($data["pfuncid"]);
            $this->ajax_func($data["funcid"]."_clear()");

            //$this->ajax_func($data["funcid"]."_show","'". system_format("N3",$smo["qty"],0)."','".system_format("F32",$smo["amount"],0)."','".$smo['details']."'");//array("qty"=>$smo['qty'],"amount"=>$smo["amount"],"count"=>$count)

            $this->ajaxResult();
            //$this->ajaxReturn($data["pfuncid"],$data["funcid"],"refresh","","-");
        }
    }

    private function effects_del($data) {
        $category_id = I("request.category_id");
        $id= I("post.Key");
        if(empty($id)) {
            $this->ajaxError("物品没有输入");
        }

        $model=M('EffectsCategoryList');
        $smo=M('EffectsCategory')->where("id='%d'",array($category_id))->find();


        $model->startTrans();
        $gm=M('Effects');

        $add_info="";
        foreach ($id  as $k=>$v) {
            $g = $gm->find($v);
            if (!$g) {
                $this->ajaxError_func("物品信息不存在", $data["funcid"] . "_focus");
            }

            if ($g["status"] != 1) {
                $this->ajaxError_func("物品($g[name])无效状态", $data["funcid"] . "_focus");
            }
            $smd = $model->where("effects_category_id='%d' AND effects_id='%d' ", array($category_id, $v))->find();

            $cur_data = array();
            $cur_data['effects_category_id'] = $category_id;
            $cur_data['effects_id'] = $v;


            if (!empty($smd)) {
                $result=$model->where($cur_data)->delete();
                if (!$result) {
                    $this->ajaxError("分类删除物品($g[name])失败");
                }
                $add_info .= ($add_info ? "," : "") . $g['name'] . "=" . $smo["name"];
            }
        }
        $content=$add_info?"删除[$add_info]":"";

        $result2 = createLogCommon('effects',$v,"删除分类",$content);
        if(!$result2){
            $this->ajaxError("创建物品日志失败");
        }
        $model->commit();


        $this->ajax_func($data ['funcid']."_load_bom_info",$category_id);
        $this->ajaxReturn();
    }
}
