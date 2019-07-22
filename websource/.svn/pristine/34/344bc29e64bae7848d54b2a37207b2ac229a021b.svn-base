<?php namespace Summary\Controller;
//
//注释: TempletDetailSummary - 组卷模板明细列表
//
use Home\Controller\BasicController;
use Think\Log;
class TempletDetailSummaryController extends BasicController {

    public function _init() {
        $funcs = $this->getUserRoleList($this->user,array( 'TempletDetailSummary', '/Home/TempletDetail', '/Home/%table%', ));
        if ($funcs)
            $this->assign("rights",  $funcs);
        else{
            $funcs = array(
                         array("key"=>"refresh","func"=>"TempletDetailSummary","Action"=>"refresh") ,
                         array("key"=>"search","func"=>"TempletDetailSummary","Action"=>"search") ,
                         array("key"=>"export","func"=>"TempletDetailSummary","Action"=>"export") ,
                         array("key"=>"master_view","func"=>"/Home/TempletDetail","Action"=>"view") ,
                         array("key"=>"master_edit","func"=>"/Home/TempletDetail","Action"=>"edit") ,
                         array("key"=>"status","func"=>"/Home/%table%","Action"=>"%action%")
             );
            $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"TempletDetailSummary"));
    }

    public function index() {
         try {
        $data["pfuncid"] = I("request.pfuncid");
        $data["funcid"] = I("request.funcid");
        $data["zindex"] = I("request.zindex/d");
        if(empty($data["funcid"])) $data["funcid"] = "TempletDetailSummary";
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
          //$this->ajaxResult("组卷模板明细列表后台错误");
          $this->ajaxResult($e->getMessage());
      }
    }


    private function columnsetting_define(){
        return array(
            'templet_no'=>'模板编码',
            'type'=>'类型',
            'seq'=>'题号',
            'score'=>'分数',
            'req_type'=>'要求类型',
            'req_category_name'=>'要求知识点',
            'req_kind'=>'要求题型',
            'req_child_count'=>'套题小题数',
            'req_child_seq'=>'套题小题号',
            'extract'=>'抽取要求',
            'create_time'=>'创建时间',
            'modify_time'=>'修改时间',
        );
    }

    private function columnsetting($data){
        $data['user_code']=session(C("USER_AUTH_KEY"));
        $data['summary']='TempletDetailSummary';
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

        $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideMask()"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Summary/TempletDetailSummary/index?func=search&").  "','".filterFuncId("TempletDetailSummary_Search","id=0")."','组卷模板明细列表', 1",""));


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
       $search["templet_no"] = I("request.templet_no");
       $search["type"] = I("request.type");
       $search["seq"] = I("request.seq");
       $search["seq2"] = I("request.seq2");
       $search["score"] = I("request.score");
       $search["score2"] = I("request.score2");
       $search["req_type"] = I("request.req_type");
       $search["req_category_code_name"] = I("request.req_category_code_name");
       $search["req_category_code"] = I("request.req_category_code");
       $search["req_category_name"] = I("request.req_category_name");
       $search["req_kind"] = I("request.req_kind");
       $search["req_child_count"] = I("request.req_child_count");
       $search["req_child_seq"] = I("request.req_child_seq");
       $search["extract"] = I("request.extract");
       $search["create_time"] = I("request.create_time");
       $search["create_time2"] = I("request.create_time2");

       //判断首次装载是否要赋予缺省值
       if($firstloading){
       }



       $condition="";
       $condition_templet_detail="";
       if($bsearch) {
           //关键字条件
           if($search["_showsearch"]=="hide"  ){
               if($search["_keyword"]){
                   $condition_keyword = "";
                   $condition_keyword = join_condition($condition_keyword,"@templet_detail.templet_no",$search["_keyword"],"char", "both" , 0, "" );
                   $condition_templet_detail = " AND ( ". $condition_keyword .")";
               }
           }else{
               //高级搜索condition
               $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.templet_no",$search["templet_no"],"char");
               $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.type",$search["type"],"int");
               $condition_templet_detail = join_condition2($condition_templet_detail,"@templet_detail.seq",$search["seq"],$search["seq2"],"int");
               $condition_templet_detail = join_condition2($condition_templet_detail,"@templet_detail.score",$search["score"],$search["score2"],"int");
               $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.req_type",$search["req_type"],"int");
               $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.req_category_code",$search["req_category_code"],"char");
               $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.req_category_name",$search["req_category_name"],"char","both");
               $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.req_kind",$search["req_kind"],"char");
               $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.req_child_count",$search["req_child_count"],"int");
               $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.req_child_seq",$search["req_child_seq"],"int");
               $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.extract",$search["extract"],"int");
               $condition_templet_detail = join_condition2($condition_templet_detail,"@templet_detail.create_time",$search["create_time"],$search["create_time2"],"datetime");
           }

           //增加 tab 条件
           $condition_templet_detail = $this->tabsheet_condition($condition_templet_detail ,$search["_tab"]);
           //select fields
           $selectfields=" @templet_detail.id ";
           $selectfields.=", @templet_detail.templet_no ";
           $selectfields.=", @templet_detail.type ";
           $selectfields.=", @templet_detail.seq ";
           $selectfields.=", @templet_detail.score ";
           $selectfields.=", @templet_detail.req_type ";
           $selectfields.=", @templet_detail.req_category_name ";
           $selectfields.=", @templet_detail.req_kind ";
           $selectfields.=", @templet_detail.req_child_count ";
           $selectfields.=", @templet_detail.req_child_seq ";
           $selectfields.=", @templet_detail.extract ";
           $selectfields.=", @templet_detail.create_time ";
           $selectfields.=", @templet_detail.modify_time ";


           $page_size = I("request.pagesize/d");
           if ($page_size<=0){
               $page_size = session("TempletDetailSummary-PageSize");
               if (!$page_size) {
                    $page_size = 10;
               }
           }
           session("TempletDetailSummary-PageSize", $page_size);


           $join="";
           $count_sql = "select count(*) as cnt from @templet_detail  #join#  where 1=1 #condition#";  // ' for skip replace $condition
           $count_sql = str_replace("#join#",$join,$count_sql);
           $count_sql = str_replace("#condition#",$condition_templet_detail,$count_sql);
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
           $sql = "select #selectfields# from @templet_detail  #join# Where 1=1 #condition# #orderby#";
           $sql = str_replace("#selectfields#",$selectfields,$sql);
           $sql = str_replace("#join#",$join,$sql);
           $sql = str_replace("#condition#",$condition_templet_detail,$sql);
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
        $html = $this->fetch("TempletDetailSummary:index");
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

        if(empty($data["funcid"])) $data["funcid"] = "TempletDetailSummary";
        if(!$p){
           $p = 1;
           $export_all = 1;
        }

        $show_list = array();

        $data['summary']='TempletDetailSummary';
        $usc = M('user_summary_column')->field("column")->where("user_code='%s' AND summary='%s' AND `show`='1'",array(session(C("USER_AUTH_KEY")),$data['summary']))->select();
        if($usc){
           foreach ($usc as $v) {
              $show_list[$v['column']]=1;
           }
        }

        $search["_tab"] = $this->tabsheet_check(I("request._tab"));
        $tab = $search["_tab"];

        $search["templet_no"] = I("request.templet_no");
        $search["type"] = I("request.type");
        $search["seq"] = I("request.seq");
        $search["seq2"] = I("request.seq2");
        $search["score"] = I("request.score");
        $search["score2"] = I("request.score2");
        $search["req_type"] = I("request.req_type");
        $search["req_category_code_name"] = I("request.req_category_code_name");
        $search["req_category_code"] = I("request.req_category_code");
        $search["req_category_name"] = I("request.req_category_name");
        $search["req_kind"] = I("request.req_kind");
        $search["req_child_count"] = I("request.req_child_count");
        $search["req_child_seq"] = I("request.req_child_seq");
        $search["extract"] = I("request.extract");
        $search["create_time"] = I("request.create_time");
        $search["create_time2"] = I("request.create_time2");


        //condition
        $condition="";
        $condition_templet_detail="";

        //读取关键字搜索内容
        $search["_keyword"] = I("request._keyword");
        if($search["_showsearch"]=="hide"  ){
            if($search["_keyword"]){
                $condition_keyword = "";
                $condition_keyword = join_condition($condition_keyword,"@templet_detail.templet_no",$search["_keyword"],"char", "both" , 0, "" );
                $condition_templet_detail = " AND ( ". $condition_keyword . ")";
            }
        }else{
        //高级搜索condition
           $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.templet_no",$search["templet_no"],"char");
           $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.type",$search["type"],"int");
           $condition_templet_detail = join_condition2($condition_templet_detail,"@templet_detail.seq",$search["seq"],$search["seq2"],"int");
           $condition_templet_detail = join_condition2($condition_templet_detail,"@templet_detail.score",$search["score"],$search["score2"],"int");
           $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.req_type",$search["req_type"],"int");
           $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.req_category_code",$search["req_category_code"],"char");
           $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.req_category_name",$search["req_category_name"],"char","both");
           $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.req_kind",$search["req_kind"],"char");
           $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.req_child_count",$search["req_child_count"],"int");
           $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.req_child_seq",$search["req_child_seq"],"int");
           $condition_templet_detail = join_condition($condition_templet_detail,"@templet_detail.extract",$search["extract"],"int");
           $condition_templet_detail = join_condition2($condition_templet_detail,"@templet_detail.create_time",$search["create_time"],$search["create_time2"],"datetime");
        }
        $condition_templet_detail = $this->tabsheet_condition($condition_templet_detail ,$search["_tab"]);

        //select fields
        $selectfields="@templet_detail.id ";
        $selectfields.=",@templet_detail.templet_no ";
        $selectfields.=",@templet_detail.type ";
        $selectfields.=",@templet_detail.seq ";
        $selectfields.=",@templet_detail.score ";
        $selectfields.=",@templet_detail.req_type ";
        $selectfields.=",@templet_detail.req_category_name ";
        $selectfields.=",@templet_detail.req_kind ";
        $selectfields.=",@templet_detail.req_child_count ";
        $selectfields.=",@templet_detail.req_child_seq ";
        $selectfields.=",@templet_detail.extract ";
        $selectfields.=",@templet_detail.create_time ";
        $selectfields.=",@templet_detail.modify_time ";


        $str_header = "";
        if ($show_list['templet_no']==1 || empty($show_list)){
            $str_header .= "模板编码,";
        }
        if ($show_list['type']==1 || empty($show_list)){
            $str_header .= "类型,";
        }
        if ($show_list['seq']==1 || empty($show_list)){
            $str_header .= "题号,";
        }
        if ($show_list['score']==1 || empty($show_list)){
            $str_header .= "分数,";
        }
        if ($show_list['req_type']==1 || empty($show_list)){
            $str_header .= "要求类型,";
        }
        if ($show_list['req_category_name']==1 || empty($show_list)){
            $str_header .= "要求知识点,";
        }
        if ($show_list['req_kind']==1 || empty($show_list)){
            $str_header .= "要求题型,";
        }
        if ($show_list['req_child_count']==1 || empty($show_list)){
            $str_header .= "套题小题数,";
        }
        if ($show_list['req_child_seq']==1 || empty($show_list)){
            $str_header .= "套题小题号,";
        }
        if ($show_list['extract']==1 || empty($show_list)){
            $str_header .= "抽取要求,";
        }
        if ($show_list['create_time']==1 || empty($show_list)){
            $str_header .= "创建时间,";
        }
        if ($show_list['modify_time']==1 || empty($show_list)){
            $str_header .= "修改时间,";
        }
        $str_header .= "\r\n";

        $join="";

       $count_sql = "select count(*) as cnt from @templet_detail  #join#  where 1=1 #condition#";  // ' for skip replace $condition
       $count_sql = str_replace("#join#",$join,$count_sql);
       $count_sql = str_replace("#condition#",$condition_templet_detail,$count_sql);

       $count_sql = table($count_sql);
       $count_sql = str_replace("·mailchar·","@",$count_sql);
       $count = M()->query($count_sql);
       $count = $count[0]["cnt"];

           $total_page=0;

        if(!$export_all) {
           $page_size = I("request.pagesize/d");
           $page_size = $page_size <= 0 ? session("TempletDetailSummary-PageSize") : $page_size;
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

        $sql = "select #selectfields# from @templet_detail  #join# Where 1=1 #condition# #orderby#";   // ' for skip replace $selectfields,$condition,$orderby
        $sql = str_replace("#selectfields#",$selectfields,$sql);
        $sql = str_replace("#join#",$join,$sql);
        $sql = str_replace("#condition#",$condition_templet_detail,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($p - 1) * $page_size). ", ".$page_size;

        $sql = table($sql);
        $sql = str_replace("·mailchar·","@",$sql);
        $list = M()->query($sql);

        foreach($list as $master) {
            $str_line="";
            if ($show_list['templet_no']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["templet_no"])."\t,";
            }
            if ($show_list['type']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_TempletDetail_type("$master[type]","name"))."\t,";
            }
            if ($show_list['seq']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("N3", $master["seq"]))."\t,";
            }
            if ($show_list['score']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("N3", $master["score"]))."\t,";
            }
            if ($show_list['req_type']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_TempletDetail_req_type("$master[req_type]","name"))."\t,";
            }
            if ($show_list['req_category_name']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["req_category_name"])."\t,";
            }
            if ($show_list['req_kind']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(subcode_view('question:kind',$master['req_kind']))."\t,";
            }
            if ($show_list['req_child_count']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["req_child_count"])."\t,";
            }
            if ($show_list['req_child_seq']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_TempletDetail_req_child_seq("$master[req_child_seq]","name"))."\t,";
            }
            if ($show_list['extract']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_TempletDetail_extract("$master[extract]","name"))."\t,";
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
        $str = mb_convert_encoding("TempletDetailSummary", 'gbk', 'utf-8');
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
