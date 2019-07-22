<?php namespace Summary\Controller;
//
//注释: TempletProcessSummary - style21列表
//
use Home\Controller\BasicController;
use Think\Log;
class TempletProcessSummaryController extends BasicController {

    public function _init() {
        $funcs = $this->getUserRoleList($this->user,array( 'TempletProcessSummary', ));
        if ($funcs)
            $this->assign("rights",  $funcs);
        else{
            $funcs = array(
                         array("key"=>"refresh","func"=>"TempletProcessSummary","Action"=>"refresh") ,
                         array("key"=>"search","func"=>"TempletProcessSummary","Action"=>"search") ,
                         array("key"=>"export","func"=>"TempletProcessSummary","Action"=>"export") ,
                         array("key"=>"detailarea1","func"=>"TempletProcessSummary","Action"=>"detailarea1") ,
                         array("key"=>"detailarea2","func"=>"TempletProcessSummary","Action"=>"detailarea2")
             );
            $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"TempletProcessSummary"));
    }

    public function index() {
         try {
        $data["pfuncid"] = I("request.pfuncid");
        $data["funcid"] = I("request.funcid");
        //临时替换方案
        $data["funcid"] = str_replace("_detailarea2_detailarea1","_detailarea1",$data["funcid"] );
        $data["funcid"] = str_replace("_detailarea1_detailarea2","_detailarea2",$data["funcid"] );
        $data["zindex"] = I("request.zindex/d");
        if(empty($data["funcid"])) $data["funcid"] = "TempletProcessSummary";
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
          case "detailarea1":
               $this->detailarea1($data);
               break;
          case "detailarea2":
               $this->detailarea2($data);
               break;
          case "columnsetting":
               $this->columnsetting($data);
               break;
          case "columnsettingsave":
               $this->columnsetting_save($data);
               break;
       }
          } catch(\Exception $e) {
          //$this->ajaxResult("style21列表后台错误");
          $this->ajaxResult($e->getMessage());
      }
    }


    private function columnsetting_define(){
        return array(
            'status'=>'状态',
            'templet_no'=>'编码',
            'type'=>'类型',
            'subject'=>'标题',
            'count'=>'题量',
            'score'=>'总分',
            'req_time'=>'时间要求(分钟)',
            'using'=>'使用',
            'create_time'=>'创建时间',
            'modify_time'=>'修改时间',
        );
    }

    private function columnsetting($data){
        $data['user_code']=session(C("USER_AUTH_KEY"));
        $data['summary']='TempletProcessSummary';
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

        $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideMask()"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Summary/TempletProcessSummary/index?func=search&").  "','".filterFuncId("TempletProcessSummary_Search","id=0")."','style21列表', 1",""));


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
           $search["_showsearch"]="hide";
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
       $search["templet_no"] = I("request.templet_no");
       $search["type"] = I("request.type");
       $search["subject"] = I("request.subject");
       $search["count"] = I("request.count");
       $search["count2"] = I("request.count2");
       $search["score"] = I("request.score");
       $search["score2"] = I("request.score2");
       $search["req_time"] = I("request.req_time");
       $search["req_time2"] = I("request.req_time2");
       $search["using"] = I("request.using");
       $search["using2"] = I("request.using2");
       $search["create_time"] = I("request.create_time");
       $search["create_time2"] = I("request.create_time2");

       //判断首次装载是否要赋予缺省值
       if($firstloading){
       }



       $condition="";
       $condition_templet="";
       if($bsearch) {
           //关键字条件
           if($search["_showsearch"]=="hide"  ){
               if($search["_keyword"]){
                   $condition_keyword = "";
                   $condition_keyword = join_condition($condition_keyword,"@templet.templet_no",$search["_keyword"],"char", "both" , 0, "" );
                   $condition_templet = " AND ( ". $condition_keyword .")";
               }
           }else{
               //高级搜索condition
               $condition_templet = join_condition($condition_templet,"@templet.status",$search["status"],"int");
               $condition_templet = join_condition($condition_templet,"@templet.templet_no",$search["templet_no"],"char");
               $condition_templet = join_condition($condition_templet,"@templet.type",$search["type"],"int");
               $condition_templet = join_condition($condition_templet,"@templet.subject",$search["subject"],"char","both");
               $condition_templet = join_condition2($condition_templet,"@templet.count",$search["count"],$search["count2"],"int");
               $condition_templet = join_condition2($condition_templet,"@templet.score",$search["score"],$search["score2"],"int");
               $condition_templet = join_condition2($condition_templet,"@templet.req_time",$search["req_time"],$search["req_time2"],"int");
               $condition_templet = join_condition2($condition_templet,"@templet.using",$search["using"],$search["using2"],"int");
               $condition_templet = join_condition2($condition_templet,"@templet.create_time",$search["create_time"],$search["create_time2"],"datetime");
           }

           //增加 tab 条件
           $condition_templet = $this->tabsheet_condition($condition_templet ,$search["_tab"]);
           //select fields
           $selectfields=" @templet.status ";
           $selectfields.=", @templet.id ";
           $selectfields.=", @templet.templet_no ";
           $selectfields.=", @templet.type ";
           $selectfields.=", @templet.subject ";
           $selectfields.=", @templet.count ";
           $selectfields.=", @templet.score ";
           $selectfields.=", @templet.req_time ";
           $selectfields.=", @templet.using ";
           $selectfields.=", @templet.create_time ";
           $selectfields.=", @templet.modify_time ";


           $page_size = I("request.pagesize/d");
           if ($page_size<=0){
               $page_size = session("TempletProcessSummary-PageSize");
               if (!$page_size) {
                    $page_size = 10;
               }
           }
           session("TempletProcessSummary-PageSize", $page_size);


           $join="";
           $count_sql = "select count(*) as cnt from @templet  #join#  where 1=1 #condition#";  // ' for skip replace $condition
           $count_sql = str_replace("#join#",$join,$count_sql);
           $count_sql = str_replace("#condition#",$condition_templet,$count_sql);
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
           $sql = "select #selectfields# from @templet  #join# Where 1=1 #condition# #orderby#";
           $sql = str_replace("#selectfields#",$selectfields,$sql);
           $sql = str_replace("#join#",$join,$sql);
           $sql = str_replace("#condition#",$condition_templet,$sql);
           $sql = str_replace("#orderby#",$orderby,$sql);
           $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
           $sql = table($sql);
           $sql = str_replace("·mailchar·","@",$sql);
           $data["list"] = M()->query($sql);


           $pageClass = new \Think\Page($count,$page_size);
           $pageClass->rollPage = 1;
           $data["page"] = $pageClass->show_summary($data["funcid"],"","s");
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
        $html = $this->fetch("TempletProcessSummary:index");
        echo $html;
    }

    public function detailarea1($data) {
        $condition="";
        $masterkey="";
        $join="";
        $data["p"] = I("request.p/d");

        $data["tab"] = I("request.tab");
        $search["id"] = I("request.id/d");
        $condition.=" and @exam.templet_id=".$search["id"];
        $masterkey.=" id=".$search["id"];
        $data["search"] = M("templet")->where($masterkey)->find();


        if(!$search)   // no param
           $this->ajaxError("查询参数非法");

        $selectfields="@exam.status ";
        $selectfields.=",@exam.exam_no ";
        $selectfields.=",@exam.subject ";
        $selectfields.=",@exam.type ";
        $selectfields.=",@exam.score ";
        $selectfields.=",@exam.count ";
        $selectfields.=",@exam.modify_time ";
        $selectfields.=", @exam.id";

        $page_size = 50;

        $condition= $condition;
        $count_sql = "select count(*) as cnt from @exam  #join# where 1=1 #condition#";
        $count_sql = str_replace("#condition#",$condition,$count_sql);
        $count_sql = str_replace("#join#",$join,$count_sql);

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

        $orderby="order by @exam.id";
        $sql = "select #selectfields# from @exam  #join# Where 1=1 #condition# #orderby#";
        $sql = str_replace("#selectfields#",$selectfields,$sql);
        $sql = str_replace("#join#",$join,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";

        $sql = table($sql);
        $sql = str_replace("·mailchar·","@",$sql);

        $data["list"] = M()->query($sql);

        $pageClass = new \Think\Page($count,$page_size);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"],"");
        $data["page_size"] = $page_size;

        $data["master"] = M("templet")->where($masterkey)->find();

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("TempletProcessSummary:detailarea1");
        echo $html;
    }
    public function detailarea2($data) {
        $condition="";
        $masterkey="";
        $join="";
        $data["p"] = I("request.p/d");

        $data["tab"] = I("request.tab");
        $search["id"] = I("request.id/d");
        $condition.=" and @exam_detail.exam_id=".$search["id"];
        $masterkey.=" id=".$search["id"];
        $data["search"] = M("exam")->where($masterkey)->find();


        if(!$search)   // no param
           $this->ajaxError("查询参数非法");

        $selectfields="@exam_detail.question_type ";
        $selectfields.=",@exam_detail.question_category_name ";
        $selectfields.=",@exam_detail.seq ";
        $selectfields.=",@exam_detail.score ";
        $selectfields.=", @exam_detail.id";

        $page_size = 50;

        $condition= $condition;
        $count_sql = "select count(*) as cnt from @exam_detail  #join# where 1=1 #condition#";
        $count_sql = str_replace("#condition#",$condition,$count_sql);
        $count_sql = str_replace("#join#",$join,$count_sql);

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

        $orderby="order by @exam_detail.sort";
        $sql = "select #selectfields# from @exam_detail  #join# Where 1=1 #condition# #orderby#";
        $sql = str_replace("#selectfields#",$selectfields,$sql);
        $sql = str_replace("#join#",$join,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";

        $sql = table($sql);
        $sql = str_replace("·mailchar·","@",$sql);

        $data["list"] = M()->query($sql);

        $pageClass = new \Think\Page($count,$page_size);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"],"");
        $data["page_size"] = $page_size;

        $data["master"] = M("templet")->where($masterkey)->find();

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("TempletProcessSummary:detailarea2");
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

        if(empty($data["funcid"])) $data["funcid"] = "TempletProcessSummary";
        if(!$p){
           $p = 1;
           $export_all = 1;
        }

        $show_list = array();

        $data['summary']='TempletProcessSummary';
        $usc = M('user_summary_column')->field("column")->where("user_code='%s' AND summary='%s' AND `show`='1'",array(session(C("USER_AUTH_KEY")),$data['summary']))->select();
        if($usc){
           foreach ($usc as $v) {
              $show_list[$v['column']]=1;
           }
        }

        $search["_tab"] = $this->tabsheet_check(I("request._tab"));
        $tab = $search["_tab"];

        $search["status"] = I("request.status");
        $search["templet_no"] = I("request.templet_no");
        $search["type"] = I("request.type");
        $search["subject"] = I("request.subject");
        $search["count"] = I("request.count");
        $search["count2"] = I("request.count2");
        $search["score"] = I("request.score");
        $search["score2"] = I("request.score2");
        $search["req_time"] = I("request.req_time");
        $search["req_time2"] = I("request.req_time2");
        $search["using"] = I("request.using");
        $search["using2"] = I("request.using2");
        $search["create_time"] = I("request.create_time");
        $search["create_time2"] = I("request.create_time2");


        //condition
        $condition="";
        $condition_templet="";

        //读取关键字搜索内容
        $search["_keyword"] = I("request._keyword");
        if($search["_showsearch"]=="hide"  ){
            if($search["_keyword"]){
                $condition_keyword = "";
                $condition_keyword = join_condition($condition_keyword,"@templet.templet_no",$search["_keyword"],"char", "both" , 0, "" );
                $condition_templet = " AND ( ". $condition_keyword . ")";
            }
        }else{
        //高级搜索condition
           $condition_templet = join_condition($condition_templet,"@templet.status",$search["status"],"int");
           $condition_templet = join_condition($condition_templet,"@templet.templet_no",$search["templet_no"],"char");
           $condition_templet = join_condition($condition_templet,"@templet.type",$search["type"],"int");
           $condition_templet = join_condition($condition_templet,"@templet.subject",$search["subject"],"char","both");
           $condition_templet = join_condition2($condition_templet,"@templet.count",$search["count"],$search["count2"],"int");
           $condition_templet = join_condition2($condition_templet,"@templet.score",$search["score"],$search["score2"],"int");
           $condition_templet = join_condition2($condition_templet,"@templet.req_time",$search["req_time"],$search["req_time2"],"int");
           $condition_templet = join_condition2($condition_templet,"@templet.using",$search["using"],$search["using2"],"int");
           $condition_templet = join_condition2($condition_templet,"@templet.create_time",$search["create_time"],$search["create_time2"],"datetime");
        }
        $condition_templet = $this->tabsheet_condition($condition_templet ,$search["_tab"]);

        //select fields
        $selectfields="@templet.status ";
        $selectfields.=",@templet.id ";
        $selectfields.=",@templet.templet_no ";
        $selectfields.=",@templet.type ";
        $selectfields.=",@templet.subject ";
        $selectfields.=",@templet.count ";
        $selectfields.=",@templet.score ";
        $selectfields.=",@templet.req_time ";
        $selectfields.=",@templet.using ";
        $selectfields.=",@templet.create_time ";
        $selectfields.=",@templet.modify_time ";


        $str_header = "";
        if ($show_list['status']==1 || empty($show_list)){
            $str_header .= "状态,";
        }
        if ($show_list['templet_no']==1 || empty($show_list)){
            $str_header .= "编码,";
        }
        if ($show_list['type']==1 || empty($show_list)){
            $str_header .= "类型,";
        }
        if ($show_list['subject']==1 || empty($show_list)){
            $str_header .= "标题,";
        }
        if ($show_list['count']==1 || empty($show_list)){
            $str_header .= "题量,";
        }
        if ($show_list['score']==1 || empty($show_list)){
            $str_header .= "总分,";
        }
        if ($show_list['req_time']==1 || empty($show_list)){
            $str_header .= "时间要求(分钟),";
        }
        if ($show_list['using']==1 || empty($show_list)){
            $str_header .= "使用,";
        }
        if ($show_list['create_time']==1 || empty($show_list)){
            $str_header .= "创建时间,";
        }
        if ($show_list['modify_time']==1 || empty($show_list)){
            $str_header .= "修改时间,";
        }
        $str_header .= "\r\n";

        $join="";

       $count_sql = "select count(*) as cnt from @templet  #join#  where 1=1 #condition#";  // ' for skip replace $condition
       $count_sql = str_replace("#join#",$join,$count_sql);
       $count_sql = str_replace("#condition#",$condition_templet,$count_sql);

       $count_sql = table($count_sql);
       $count_sql = str_replace("·mailchar·","@",$count_sql);
       $count = M()->query($count_sql);
       $count = $count[0]["cnt"];

           $total_page=0;

        if(!$export_all) {
           $page_size = I("request.pagesize/d");
           $page_size = $page_size <= 0 ? session("TempletProcessSummary-PageSize") : $page_size;
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

        $sql = "select #selectfields# from @templet  #join# Where 1=1 #condition# #orderby#";   // ' for skip replace $selectfields,$condition,$orderby
        $sql = str_replace("#selectfields#",$selectfields,$sql);
        $sql = str_replace("#join#",$join,$sql);
        $sql = str_replace("#condition#",$condition_templet,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($p - 1) * $page_size). ", ".$page_size;

        $sql = table($sql);
        $sql = str_replace("·mailchar·","@",$sql);
        $list = M()->query($sql);

        foreach($list as $master) {
            $str_line="";
            if ($show_list['status']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_Templet_status("$master[status]","name"))."\t,";
            }
            if ($show_list['templet_no']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["templet_no"])."\t,";
            }
            if ($show_list['type']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_Templet_type("$master[type]","name"))."\t,";
            }
            if ($show_list['subject']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["subject"])."\t,";
            }
            if ($show_list['count']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("N3", $master["count"]))."\t,";
            }
            if ($show_list['score']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("N3", $master["score"]))."\t,";
            }
            if ($show_list['req_time']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("N3", $master["req_time"]))."\t,";
            }
            if ($show_list['using']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("N3", $master["using"]))."\t,";
            }
            if ($show_list['create_time']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("DT", $master["create_time"]))."\t,";
            }
            if ($show_list['modify_time']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("DT", $master["modify_time"]))."\t,";
            }
            $str_content .= $str_line . "\r\n";
        }
    }
        header('Content-Type: text/xls');
        header ("Content-type:application/vnd.ms-excel;charset=gbk" );
        $str = mb_convert_encoding("TempletProcessSummary", 'gbk', 'utf-8');
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
          case 'caogao':
          case 'queren':
          case 'quxiao':
              break;
          default:
              $itab='all';
              break;
              $itab='caogao';
              break;
              $itab='queren';
              break;
              $itab='quxiao';
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
            case 'caogao':  //草稿
                 $scond="@templet.status='0'";
                 break;
            case 'queren':  //确认
                 $scond="@templet.status='1'";
                 break;
            case 'quxiao':  //取消
                 $scond="@templet.status='7'";
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
            case 'caogao':  //草稿
                 break;
            case 'queren':  //确认
                 break;
            case 'quxiao':  //取消
                 break;
        }
        if($orderby)
            return " order by $orderby";
        else
            return "";
    }


}
