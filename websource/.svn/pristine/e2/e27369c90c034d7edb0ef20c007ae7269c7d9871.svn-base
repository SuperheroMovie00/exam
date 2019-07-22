<?php namespace Summary\Controller;
//
//注释: QuestionCategorySummary - 知识点分类列表
//
use Home\Controller\BasicController;
use Think\Log;
class QuestionCategorySummaryController extends BasicController {

    public function _init() {
        $funcs = $this->getUserRoleList($this->user,array( '/Home/QuestionCategory', 'QuestionCategorySummary', ));
        if ($funcs)
            $this->assign("rights",  $funcs);
        else{
            $funcs = array(
                         array("key"=>"add","func"=>"/Home/QuestionCategory","Action"=>"add") ,
                         array("key"=>"refresh","func"=>"QuestionCategorySummary","Action"=>"refresh") ,
                         array("key"=>"search","func"=>"QuestionCategorySummary","Action"=>"search") ,
                         array("key"=>"export","func"=>"QuestionCategorySummary","Action"=>"export") ,
                         array("key"=>"master_view","func"=>"/Home/QuestionCategory","Action"=>"view") ,
                         array("key"=>"master_edit","func"=>"/Home/QuestionCategory","Action"=>"edit") ,
                         array("key"=>"master_delete","func"=>"/Home/QuestionCategory","Action"=>"delete") ,
                         array("key"=>"status_on","func"=>"/Home/QuestionCategory","Action"=>"status_on") ,
                         array("key"=>"status_off","func"=>"/Home/QuestionCategory","Action"=>"status_off")
             );
            $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"QuestionCategorySummary"));
    }

    public function index() {
         try {
        $data["pfuncid"] = I("request.pfuncid");
        $data["funcid"] = I("request.funcid");
        $data["zindex"] = I("request.zindex/d");
        if(empty($data["funcid"])) $data["funcid"] = "QuestionCategorySummary";
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
          //$this->ajaxResult("知识点分类列表后台错误");
          $this->ajaxResult($e->getMessage());
      }
    }


    private function columnsetting_define(){
        return array(
            'status'=>'状态',
            'code'=>'代码',
            'name'=>'名称',
            'full_path'=>'路径',
            'level'=>'层级',
            'sort'=>'排序',
            'create_time'=>'创建时间',
            'modify_time'=>'修改时间',
        );
    }

    private function columnsetting($data){
        $data['user_code']=session(C("USER_AUTH_KEY"));
        $data['summary']='QuestionCategorySummary';
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

        $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideMask()"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Summary/QuestionCategorySummary/index?func=search&").  "','".filterFuncId("QuestionCategorySummary_Search","id=0")."','知识点分类列表', 1",""));


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

       $auth_condition=$this->get_auth_condition();

       //读取tab参数
       $search["_tab"] = $this->tabsheet_check(I("request._tab"));

       //读取页面参数
       $search["status"] = I("request.status");
       $search["code"] = I("request.code");
       $search["name"] = I("request.name");
       $search["full_path"] = I("request.full_path");
       $search["level"] = I("request.level");

       //判断首次装载是否要赋予缺省值
       if($firstloading){
       }



       $condition="";
       $condition_question_category="";
       if($bsearch) {
           //关键字条件
           if($search["_showsearch"]=="hide"  ){
               if($search["_keyword"]){
                   $condition_keyword = "";
                   $condition_keyword = join_condition($condition_keyword,"@question_category.code",$search["_keyword"],"char", "both" , 0, "" );
                   $condition_keyword = join_condition($condition_keyword,"@question_category.name",$search["_keyword"],"char", "both" , 0, "OR" );
                   $condition_question_category = " AND ( ". $condition_keyword .")";
               }
           }else{
               //高级搜索condition
               $condition_question_category = join_condition($condition_question_category,"@question_category.status",$search["status"],"int");
               $condition_question_category = join_condition($condition_question_category,"@question_category.code",$search["code"],"char");
               $condition_question_category = join_condition($condition_question_category,"@question_category.name",$search["name"],"char");
               $condition_question_category = join_condition($condition_question_category,"@question_category.full_path",$search["full_path"],"char","both");
               $condition_question_category = join_condition($condition_question_category,"@question_category.level",$search["level"],"int");
           }

           //增加 tab 条件
           $condition_question_category = $this->tabsheet_condition($condition_question_category ,$search["_tab"]);
           //select fields
           $selectfields=" @question_category.status ";
           $selectfields.=", @question_category.id ";
           $selectfields.=", @question_category.code ";
           $selectfields.=", @question_category.name ";
           $selectfields.=", @question_category.full_path ";
           $selectfields.=", @question_category.level ";
           $selectfields.=", @question_category.sort ";
           $selectfields.=", @question_category.create_time ";
           $selectfields.=", @question_category.modify_time ";


           $page_size = 1000;
           session("QuestionCategorySummary-PageSize", $page_size);


           $join="";
           $count_sql = "select count(*) as cnt from @question_category  #join#  where 1=1 #condition#";  // ' for skip replace $condition
           $count_sql = str_replace("#join#",$join,$count_sql);
           $count_sql = str_replace("#condition#",$condition_question_category,$count_sql);
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

           $orderby = $this->get_orderby("code",$search["_tab"]);
           $sql = "select #selectfields# from @question_category  #join# Where 1=1 #condition# #orderby#";
           $sql = str_replace("#selectfields#",$selectfields,$sql);
           $sql = str_replace("#join#",$join,$sql);
           $sql = str_replace("#condition#",$condition_question_category,$sql);
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
        $html = $this->fetch("QuestionCategorySummary:index");
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

        if(empty($data["funcid"])) $data["funcid"] = "QuestionCategorySummary";
        if(!$p){
           $p = 1;
           $export_all = 1;
        }

        $show_list = array();

        $data['summary']='QuestionCategorySummary';
        $usc = M('user_summary_column')->field("column")->where("user_code='%s' AND summary='%s' AND `show`='1'",array(session(C("USER_AUTH_KEY")),$data['summary']))->select();
        if($usc){
           foreach ($usc as $v) {
              $show_list[$v['column']]=1;
           }
        }

        $search["_tab"] = $this->tabsheet_check(I("request._tab"));
        $tab = $search["_tab"];

        $search["status"] = I("request.status");
        $search["code"] = I("request.code");
        $search["name"] = I("request.name");
        $search["full_path"] = I("request.full_path");
        $search["level"] = I("request.level");


        //condition
        $condition="";
        $condition_question_category="";

        //读取关键字搜索内容
        $search["_keyword"] = I("request._keyword");
        if($search["_showsearch"]=="hide"  ){
            if($search["_keyword"]){
                $condition_keyword = "";
                $condition_keyword = join_condition($condition_keyword,"@question_category.code",$search["_keyword"],"char", "both" , 0, "" );
                $condition_keyword = join_condition($condition_keyword,"@question_category.name",$search["_keyword"],"char", "both" , 0, "OR" );
                $condition_question_category = " AND ( ". $condition_keyword . ")";
            }
        }else{
        //高级搜索condition
           $condition_question_category = join_condition($condition_question_category,"@question_category.status",$search["status"],"int");
           $condition_question_category = join_condition($condition_question_category,"@question_category.code",$search["code"],"char");
           $condition_question_category = join_condition($condition_question_category,"@question_category.name",$search["name"],"char");
           $condition_question_category = join_condition($condition_question_category,"@question_category.full_path",$search["full_path"],"char","both");
           $condition_question_category = join_condition($condition_question_category,"@question_category.level",$search["level"],"int");
        }
        $condition_question_category = $this->tabsheet_condition($condition_question_category ,$search["_tab"]);

        //select fields
        $selectfields="@question_category.status ";
        $selectfields.=",@question_category.id ";
        $selectfields.=",@question_category.code ";
        $selectfields.=",@question_category.name ";
        $selectfields.=",@question_category.full_path ";
        $selectfields.=",@question_category.level ";
        $selectfields.=",@question_category.sort ";
        $selectfields.=",@question_category.create_time ";
        $selectfields.=",@question_category.modify_time ";


        $str_header = "";
        if ($show_list['status']==1 || empty($show_list)){
            $str_header .= "状态,";
        }
        if ($show_list['code']==1 || empty($show_list)){
            $str_header .= "代码,";
        }
        if ($show_list['name']==1 || empty($show_list)){
            $str_header .= "名称,";
        }
        if ($show_list['full_path']==1 || empty($show_list)){
            $str_header .= "路径,";
        }
        if ($show_list['level']==1 || empty($show_list)){
            $str_header .= "层级,";
        }
        if ($show_list['sort']==1 || empty($show_list)){
            $str_header .= "排序,";
        }
        if ($show_list['create_time']==1 || empty($show_list)){
            $str_header .= "创建时间,";
        }
        if ($show_list['modify_time']==1 || empty($show_list)){
            $str_header .= "修改时间,";
        }
        $str_header .= "\r\n";

        $join="";

       $count_sql = "select count(*) as cnt from @question_category  #join#  where 1=1 #condition#";  // ' for skip replace $condition
       $count_sql = str_replace("#join#",$join,$count_sql);
       $count_sql = str_replace("#condition#",$condition_question_category,$count_sql);

       $count_sql = table($count_sql);
       $count_sql = str_replace("·mailchar·","@",$count_sql);
       $count = M()->query($count_sql);
       $count = $count[0]["cnt"];

           $total_page=0;

        if(!$export_all) {
           $page_size = I("request.pagesize/d");
           $page_size = $page_size <= 0 ? session("QuestionCategorySummary-PageSize") : $page_size;
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

        $orderby="order by code";
        //$orderby="";

    for ($p;$p<=$total_page;$p++)
    {

        $sql = "select #selectfields# from @question_category  #join# Where 1=1 #condition# #orderby#";   // ' for skip replace $selectfields,$condition,$orderby
        $sql = str_replace("#selectfields#",$selectfields,$sql);
        $sql = str_replace("#join#",$join,$sql);
        $sql = str_replace("#condition#",$condition_question_category,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($p - 1) * $page_size). ", ".$page_size;

        $sql = table($sql);
        $sql = str_replace("·mailchar·","@",$sql);
        $list = M()->query($sql);

        foreach($list as $master) {
            $str_line="";
            if ($show_list['status']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_QuestionCategory_status("$master[status]","name"))."\t,";
            }
            if ($show_list['code']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["code"])."\t,";
            }
            if ($show_list['name']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["name"])."\t,";
            }
            if ($show_list['full_path']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["full_path"])."\t,";
            }
            if ($show_list['level']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["level"])."\t,";
            }
            if ($show_list['sort']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("N", $master["sort"]))."\t,";
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
        $str = mb_convert_encoding("QuestionCategorySummary", 'gbk', 'utf-8');
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
          case 'wuxiao':
          case 'youxiao':
              break;
          default:
              $itab='all';
              break;
              $itab='wuxiao';
              break;
              $itab='youxiao';
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
            case 'wuxiao':  //无效
                 $scond="@question_category.status='0'";
                 break;
            case 'youxiao':  //有效
                 $scond="@question_category.status='1'";
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
            case 'wuxiao':  //无效
                 break;
            case 'youxiao':  //有效
                 break;
        }
        if($orderby)
            return " order by $orderby";
        else
            return "";
    }



    private function get_auth_condition(){

          return ;
    }

}
