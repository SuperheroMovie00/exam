<?php namespace Summary\Controller;
//
//注释: LogOrderSummary - 凭据日志列表
//
use Home\Controller\BasicController;
use Think\Log;
class LogOrderSummaryController extends BasicController {

    public function _init() {
        $funcs = $this->getUserRoleList($this->user,array( 'LogOrderSummary', ));
        if ($funcs)
            $this->assign("rights",  $funcs);
        else{
            $funcs = array(
                         array("key"=>"refresh","func"=>"LogOrderSummary","Action"=>"refresh") ,
                         array("key"=>"search","func"=>"LogOrderSummary","Action"=>"search") ,
                         array("key"=>"export","func"=>"LogOrderSummary","Action"=>"export")
             );
            $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"LogOrderSummary"));
    }

    public function index() {
         try {
        $data["pfuncid"] = I("request.pfuncid");
        $data["funcid"] = I("request.funcid");
        $data["zindex"] = I("request.zindex/d");
        if(empty($data["funcid"])) $data["funcid"] = "LogOrderSummary";
        $this->GetLastUrl($data["funcid"]);

        $func = I("request.func");
        switch ($func)
        {
          case "refresh":
               $this->refresh($data);
               break;
          case "search":
               $this->search($data);
               break;
          case "export":
               $this->export($data);
               break;
          case "columnsetting":
               $this->columnsetting($data);
               break;
          case "columnsettingsave":
               $this->columnsetting_save($data);
               break;
       }
          } catch(\Exception $e) {
          //$this->ajaxResult("凭据日志列表后台错误");
          $this->ajaxResult($e->getMessage());
      }
    }


    private function columnsetting_define(){
        return array(
            'status'=>'状态',
            'create_time'=>'处理时间',
            'type'=>'类型',
            'order_no'=>'单据号码',
            'subject'=>'标题',
            'details'=>'明细条数',
            'qty'=>'数量(件)',
            'amount'=>'金额(元)',
        );
    }

    private function columnsetting($data){
        $data['user_code']=session(C("USER_AUTH_KEY"));
        $data['summary']='LogOrderSummary';
        $data['column']=$this->columnsetting_define();

        $usc = M('user_summary_column')->where("user_code='%s' AND summary='%s' AND `show`='%d'",array(session(C("USER_AUTH_KEY")),$data['summary'],1))->select();
        $data['column_check']=array();
        foreach ($usc as $k=>$v) {
            $data['column_check'][$v['column']]=1;
        }

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Common:columnsetting");
        echo $html;
    }

    private function columnsetting_save($data){
        $data["funcid"] = I("request.funcid");
        $data["column"] = I("request.column");
        $data["column_check"] = I("request.column_check");
        $data["summary"] = I("request.summary");
        $result=true;
        $model=M('user_summary_column');
        $model->startTrans();

        $model->where("user_code='%s' AND summary='%s'",array(session(C("USER_AUTH_KEY")),$data["summary"]))->delete();

        $selectall = count($this->columnsetting_define())==count($data["column_check"]);

        if (!$selectall) {
          foreach ($data["column"] as $k=>$v) {
              $result = $model->add(array(
                  'user_code'=>session(C("USER_AUTH_KEY")),
                  'summary'=>$data['summary'],
                  'column'=>$k,
                  'show'=>isset($data['column_check'][$k])?1:0,
              ));
              if (!$result) break;
          }
        }
        if($result){
            $model->commit();
        }else{
            $model->rollback();
        }

        $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideMask()"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Summary/LogOrderSummary/index?func=search&").  "','".filterFuncId("LogOrderSummary_Search","id=0")."','凭据日志列表', 1",""));


    }


    private function refresh(){
      $this->search();
    }

    private function search($data) {
         $today= date('Y-m-d');
         $month= date('Y-m');
         $year= date('Y');
       $yesterday=date('Y-m-d', strtotime( '-1 day'));

       $search_auth_codes = "";
       $data["p"] = I("request.p/d");
       $__refresh = I("request.__refresh/d");
       $search["_searchexpand"] = I("request._searchexpand");
       $search["_showsearch"] = I("request._showsearch");
       if(empty($search["_showsearch"]) || $__refresh=="1"){
           $search["_showsearch"]="show";
       }
       //读取关键字搜索内容
       $search["_keyword"] = I("request._keyword");

       //首次运行判断及设置
       $firstloading=false;
       $search["_issearch"] = I("request._issearch");
       if($search["_issearch"]!="1" && $search["_issearch"]!="0"){
           $firstloading=true;
           $search["_issearch"] = "1";
       }
       $bsearch = $search["_issearch"] == 1;
       $search["_execsearch"] = $search["_issearch"];
       $search["_issearch"] = 1;  //execsearch必须放在 issearch 前面, 记住前一步状态


       //读取tab参数
       $search["_tab"] = $this->tabsheet_check(I("request._tab"));

       //读取页面参数
       $search["status"] = I("request.status");
       $search["status2"] = I("request.status2");
       $search["create_time"] = I("request.create_time");
       $search["create_time2"] = I("request.create_time2");
       $search["type"] = I("request.type");
       $search["order_no"] = I("request.order_no");
       $search["subject"] = I("request.subject");
       $search["details"] = I("request.details");
       $search["details2"] = I("request.details2");
       $search["qty"] = I("request.qty");
       $search["qty2"] = I("request.qty2");
       $search["amount"] = I("request.amount");
       $search["amount2"] = I("request.amount2");

       //判断首次装载是否要赋予缺省值
       if($firstloading){
       }



       $condition="";
       $condition_log_order="";
       if($bsearch) {
           //关键字条件
           if($search["_showsearch"]=="hide"  ){
               if($search["_keyword"]){
                   $condition_keyword = "";
                   $condition_log_order = " AND ( ". $condition_keyword .")";
               }
           }else{
               //高级搜索condition
               $condition_log_order = join_condition2($condition_log_order,"@log_order.status",$search["status"],$search["status2"],"int");
               $condition_log_order = join_condition2($condition_log_order,"@log_order.create_time",$search["create_time"],$search["create_time2"],"datetime");
               $condition_log_order = join_condition($condition_log_order,"@log_order.type",$search["type"],"char");
               $condition_log_order = join_condition($condition_log_order,"@log_order.order_no",$search["order_no"],"char");
               $condition_log_order = join_condition($condition_log_order,"@log_order.subject",$search["subject"],"char","both");
               $condition_log_order = join_condition2($condition_log_order,"@log_order.details",$search["details"],$search["details2"],"int");
               $condition_log_order = join_condition2($condition_log_order,"@log_order.qty",$search["qty"],$search["qty2"],"decimal");
               $condition_log_order = join_condition2($condition_log_order,"@log_order.amount",$search["amount"],$search["amount2"],"decimal");
           }

           //增加 tab 条件
           $condition_log_order = $this->tabsheet_condition($condition_log_order ,$search["_tab"]);
           //select fields
           $selectfields=" @log_order.status ";
           $selectfields.=", @log_order.id ";
           $selectfields.=", @log_order.create_time ";
           $selectfields.=", @log_order.type ";
           $selectfields.=", @log_order.order_no ";
           $selectfields.=", @log_order.subject ";
           $selectfields.=", @log_order.details ";
           $selectfields.=", @log_order.qty ";
           $selectfields.=", @log_order.amount ";
           $selectfields.=", @log_order.order_id";


           $page_size = I("request.pagesize/d");
           if ($page_size<=0){
               $page_size = session("LogOrderSummary-PageSize");
               if (!$page_size) {
                    $page_size = 10;
               }
           }
           session("LogOrderSummary-PageSize", $page_size);


           $join="";
           $count_sql = "select count(*) as cnt from @log_order  #join#  where 1=1 #condition#";  // ' for skip replace $condition
           $count_sql = str_replace("#join#",$join,$count_sql);
           $count_sql = str_replace("#condition#",$condition_log_order,$count_sql);
           $count_sql = table($count_sql);
           $count_sql = str_replace("·mailchar·","@",$count_sql);
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

           $orderby = $this->get_orderby("",$search["_tab"]);
           $sql = "select #selectfields# from @log_order  #join# Where 1=1 #condition# #orderby#";
           $sql = str_replace("#selectfields#",$selectfields,$sql);
           $sql = str_replace("#join#",$join,$sql);
           $sql = str_replace("#condition#",$condition_log_order,$sql);
           $sql = str_replace("#orderby#",$orderby,$sql);
           $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
           $sql = table($sql);
           $sql = str_replace("·mailchar·","@",$sql);
           $data["list"] = M()->query($sql);


           $pageClass = new \Think\Page($count,$page_size);
           $pageClass->rollPage = 8;
           $data["page"] = $pageClass->show_summary($data["funcid"],"");
           $data["page_size"] = $page_size;

        }
        else
        {
           $data["list"] =array();
           $data["page"] ="";
        }

        $data["search"] = $search;
        $data["tab"] = $search["_tab"];

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("LogOrderSummary:index");
        echo $html;
    }



    private function csvdata($data){
      return '"'.str_replace('"','\"',$data).'"';
    }

    private function export(){
        set_time_limit(0);
        ini_set('memory_limit', '640M');

        $search_auth_codes = "";
        $data["funcid"] = I("request.funcid");
        $p = I("request.p/d");
        $export_all = I("request.export_all/d");
        $search["_showsearch"] = I("request._showsearch");

        if(empty($data["funcid"])) $data["funcid"] = "LogOrderSummary";
        if(!$p){
           $p = 1;
           $export_all = 1;
        }

        $show_list = array();

        $data['summary']='LogOrderSummary';
        $usc = M('user_summary_column')->field("column")->where("user_code='%s' AND summary='%s' AND `show`='1'",array(session(C("USER_AUTH_KEY")),$data['summary']))->select();
        if($usc){
           foreach ($usc as $v) {
              $show_list[$v['column']]=1;
           }
        }

        $search["_tab"] = $this->tabsheet_check(I("request._tab"));
        $tab = $search["_tab"];

        $search["status"] = I("request.status");
        $search["status2"] = I("request.status2");
        $search["create_time"] = I("request.create_time");
        $search["create_time2"] = I("request.create_time2");
        $search["type"] = I("request.type");
        $search["order_no"] = I("request.order_no");
        $search["subject"] = I("request.subject");
        $search["details"] = I("request.details");
        $search["details2"] = I("request.details2");
        $search["qty"] = I("request.qty");
        $search["qty2"] = I("request.qty2");
        $search["amount"] = I("request.amount");
        $search["amount2"] = I("request.amount2");


        //condition
        $condition="";
        $condition_log_order="";

        //读取关键字搜索内容
        $search["_keyword"] = I("request._keyword");
        if($search["_showsearch"]=="hide"  ){
            if($search["_keyword"]){
                $condition_keyword = "";
                $condition_log_order = " AND ( ". $condition_keyword . ")";
            }
        }else{
        //高级搜索condition
           $condition_log_order = join_condition2($condition_log_order,"@log_order.status",$search["status"],$search["status2"],"int");
           $condition_log_order = join_condition2($condition_log_order,"@log_order.create_time",$search["create_time"],$search["create_time2"],"datetime");
           $condition_log_order = join_condition($condition_log_order,"@log_order.type",$search["type"],"char");
           $condition_log_order = join_condition($condition_log_order,"@log_order.order_no",$search["order_no"],"char");
           $condition_log_order = join_condition($condition_log_order,"@log_order.subject",$search["subject"],"char","both");
           $condition_log_order = join_condition2($condition_log_order,"@log_order.details",$search["details"],$search["details2"],"int");
           $condition_log_order = join_condition2($condition_log_order,"@log_order.qty",$search["qty"],$search["qty2"],"decimal");
           $condition_log_order = join_condition2($condition_log_order,"@log_order.amount",$search["amount"],$search["amount2"],"decimal");
        }
        $condition_log_order = $this->tabsheet_condition($condition_log_order ,$search["_tab"]);

        //select fields
        $selectfields="@log_order.status ";
        $selectfields.=",@log_order.id ";
        $selectfields.=",@log_order.create_time ";
        $selectfields.=",@log_order.type ";
        $selectfields.=",@log_order.order_no ";
        $selectfields.=",@log_order.subject ";
        $selectfields.=",@log_order.details ";
        $selectfields.=",@log_order.qty ";
        $selectfields.=",@log_order.amount ";
        $selectfields.=", @log_order.order_id";


        $str_header = "";
        if ($show_list['status']==1 || empty($show_list)){
            $str_header .= "状态,";
        }
        if ($show_list['create_time']==1 || empty($show_list)){
            $str_header .= "处理时间,";
        }
        if ($show_list['type']==1 || empty($show_list)){
            $str_header .= "类型,";
        }
        if ($show_list['order_no']==1 || empty($show_list)){
            $str_header .= "单据号码,";
        }
        if ($show_list['subject']==1 || empty($show_list)){
            $str_header .= "标题,";
        }
        if ($show_list['details']==1 || empty($show_list)){
            $str_header .= "明细条数,";
        }
        if ($show_list['qty']==1 || empty($show_list)){
            $str_header .= "数量(件),";
        }
        if ($show_list['amount']==1 || empty($show_list)){
            $str_header .= "金额(元),";
        }
        $str_header .= "\r\n";

        $join="";

       $count_sql = "select count(*) as cnt from @log_order  #join#  where 1=1 #condition#";  // ' for skip replace $condition
       $count_sql = str_replace("#join#",$join,$count_sql);
       $count_sql = str_replace("#condition#",$condition_log_order,$count_sql);

       $count_sql = table($count_sql);
       $count_sql = str_replace("·mailchar·","@",$count_sql);
       $count = M()->query($count_sql);
       $count = $count[0]["cnt"];

           $total_page=0;

        if(!$export_all) {
           $page_size = I("request.pagesize/d");
           $page_size = $page_size <= 0 ? session("LogOrderSummary-PageSize") : $page_size;
           if(!$page_size) {
              $page_size = 20;
           }


           if($count < $page_size)
              $tmp = 1;
           else{
              $tmp = intval($count / $page_size);
              if($count % $page_size != 0) {
                 $tmp++;
              }
           }

           if($p > $tmp) {
               $p = $tmp;
           }
           $total_page=$p;
        } else {
          $p = 1;
          $page_size = 2000;
          $total_page=ceil($count/$page_size);
        }


        $str_content = "";

        $orderby="";

    for ($p;$p<=$total_page;$p++)
    {

        $sql = "select #selectfields# from @log_order  #join# Where 1=1 #condition# #orderby#";   // ' for skip replace $selectfields,$condition,$orderby
        $sql = str_replace("#selectfields#",$selectfields,$sql);
        $sql = str_replace("#join#",$join,$sql);
        $sql = str_replace("#condition#",$condition_log_order,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($p - 1) * $page_size). ", ".$page_size;

        $sql = table($sql);
        $sql = str_replace("·mailchar·","@",$sql);
        $list = M()->query($sql);

        foreach($list as $master) {
            $str_line="";
            if ($show_list['status']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["status"])."\t,";
            }
            if ($show_list['create_time']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("DT", $master["create_time"]))."\t,";
            }
            if ($show_list['type']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_LogOrder_type("$master[type]","name"))."\t,";
            }
            if ($show_list['order_no']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["order_no"])."\t,";
            }
            if ($show_list['subject']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["subject"])."\t,";
            }
            if ($show_list['details']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("N3", $master["details"]))."\t,";
            }
            if ($show_list['qty']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("N3", $master["qty"]))."\t,";
            }
            if ($show_list['amount']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("F32", $master["amount"]))."\t,";
            }
            $str_content .= $str_line . "\r\n";
        }
    }
        header('Content-Type: text/xls');
        header ("Content-type:application/vnd.ms-excel;charset=gbk" );
        $str = mb_convert_encoding("LogOrderSummary", 'gbk', 'utf-8');
        $str_content = mb_convert_encoding($str_content, 'gbk', 'utf-8');
        $str_header = mb_convert_encoding($str_header, 'gbk', 'utf-8');
        header('Content-Disposition: attachment;filename="' .$str . '.csv"');
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        die($str_header.$str_content);
    }



    private function tabsheet_check($itab)
    {
        switch($itab)
        {
          case 'all':
              break;
          default:
              $itab='all';
              break;
         }
        return $itab;
    }

    private function tabsheet_condition($scondition, $itab)
    {
        $scond="";
        switch($itab)
        {
            case 'all':  //全部
                 $scond="";
                 break;
            default :
                 $scond="";
                 break;
        }
        if ($scond)
        {
            $scondition .= " AND (".$scond.")";
        }
        return $scondition;
    }

    private function get_orderby($orderby, $itab)
    {
        switch($itab)
        {
            case 'all':  //全部
                 break;
        }
        if($orderby)
            return " order by $orderby";
        else
            return "";
    }


}
