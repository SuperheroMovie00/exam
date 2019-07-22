<?php namespace Summary\Controller;
//
//注释: NodeSummary - 模块功能列表
//
use Home\Controller\BasicController;
use Think\Log;
class NodeSummaryController extends BasicController {

    public function _init() {
        $funcs = $this->getUserRoleList($this->user,array( 'NodeSummary', '/Home/Node', ));
        if ($funcs)
            $this->assign("rights",  $funcs);
        else{
            $funcs = array(
                         array("key"=>"refresh","func"=>"NodeSummary","Action"=>"refresh") ,
                         array("key"=>"search","func"=>"NodeSummary","Action"=>"search") ,
                         array("key"=>"export","func"=>"NodeSummary","Action"=>"export") ,
                         array("key"=>"status_on","func"=>"/Home/Node","Action"=>"status_on") ,
                         array("key"=>"status_off","func"=>"/Home/Node","Action"=>"status_off")
             );
            $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"NodeSummary"));
    }

    public function index() {
         try {
        $data["pfuncid"] = I("request.pfuncid");
        $data["funcid"] = I("request.funcid");
        $data["zindex"] = I("request.zindex/d");
        if(empty($data["funcid"])) $data["funcid"] = "NodeSummary";
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
          //$this->ajaxResult("模块功能列表后台错误");
          $this->ajaxResult($e->getMessage());
      }
    }


    private function columnsetting_define(){
        return array(
            'status'=>'状态',
            'name'=>'模块名称',
            'title'=>'模块描述',
            'remark'=>'备注',
            'sort'=>'排序',
            'pid'=>'父层',
            'level'=>'级别',
            'module'=>'模块说明',
            'model'=>'启动方式',
            'btn_name'=>'按钮名称',
            'is_admin'=>'超级用户',
            'ico'=>'图标',
            'default_open'=>'缺省展开',
            'side'=>'交易方',
            'menu'=>'菜单',
        );
    }

    private function columnsetting($data){
        $data['user_code']=session(C("USER_AUTH_KEY"));
        $data['summary']='NodeSummary';
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

        $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideMask()"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Summary/NodeSummary/index?func=search&").  "','".filterFuncId("NodeSummary_Search","id=0")."','模块功能列表', 1",""));


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
       $search["name"] = I("request.name");
       $search["title"] = I("request.title");
       $search["remark"] = I("request.remark");
       $search["level"] = I("request.level");
       $search["module"] = I("request.module");
       $search["model"] = I("request.model");
       $search["btn_name"] = I("request.btn_name");
       $search["is_admin"] = I("request.is_admin");
       $search["ico"] = I("request.ico");
       $search["default_open"] = I("request.default_open");
       $search["side"] = I("request.side");
       $search["side2"] = I("request.side2");
       $search["menu"] = I("request.menu");
       $search["menu2"] = I("request.menu2");

       //判断首次装载是否要赋予缺省值
       if($firstloading){
       }



       $condition="";
       $condition_node="";
       if($bsearch) {
           //关键字条件
           if($search["_showsearch"]=="hide"  ){
               if($search["_keyword"]){
                   $condition_keyword = "";
                   $condition_keyword = join_condition($condition_keyword,"@node.name",$search["_keyword"],"char", "both" , 0, "" );
                   $condition_node = " AND ( ". $condition_keyword .")";
               }
           }else{
               //高级搜索condition
               $condition_node = join_condition($condition_node,"@node.status",$search["status"],"int");
               $condition_node = join_condition($condition_node,"@node.name",$search["name"],"char");
               $condition_node = join_condition($condition_node,"@node.title",$search["title"],"char");
               $condition_node = join_condition($condition_node,"@node.remark",$search["remark"],"char","both");
               $condition_node = join_condition($condition_node,"@node.level",$search["level"],"int");
               $condition_node = join_condition($condition_node,"@node.module",$search["module"],"char","both");
               $condition_node = join_condition($condition_node,"@node.model",$search["model"],"char");
               $condition_node = join_condition($condition_node,"@node.btn_name",$search["btn_name"],"char");
               $condition_node = join_condition($condition_node,"@node.is_admin",$search["is_admin"],"int");
               $condition_node = join_condition($condition_node,"@node.ico",$search["ico"],"char");
               $condition_node = join_condition($condition_node,"@node.default_open",$search["default_open"],"int");
               $condition_node = join_condition2($condition_node,"@node.side",$search["side"],$search["side2"],"int");
               $condition_node = join_condition2($condition_node,"@node.menu",$search["menu"],$search["menu2"],"int");
           }

           //增加 tab 条件
           $condition_node = $this->tabsheet_condition($condition_node ,$search["_tab"]);
           //select fields
           $selectfields=" @node.status ";
           $selectfields.=", @node.id ";
           $selectfields.=", @node.name ";
           $selectfields.=", @node.title ";
           $selectfields.=", @node.remark ";
           $selectfields.=", @node.sort ";
           $selectfields.=", @node.pid ";
           $selectfields.=", @node.level ";
           $selectfields.=", @node.module ";
           $selectfields.=", @node.model ";
           $selectfields.=", @node.btn_name ";
           $selectfields.=", @node.is_admin ";
           $selectfields.=", @node.ico ";
           $selectfields.=", @node.default_open ";
           $selectfields.=", @node.side ";
           $selectfields.=", @node.menu ";


           $page_size = I("request.pagesize/d");
           if ($page_size<=0){
               $page_size = session("NodeSummary-PageSize");
               if (!$page_size) {
                    $page_size = 10;
               }
           }
           session("NodeSummary-PageSize", $page_size);


           $join="";
           $count_sql = "select count(*) as cnt from @node  #join#  where 1=1 #condition#";  // ' for skip replace $condition
           $count_sql = str_replace("#join#",$join,$count_sql);
           $count_sql = str_replace("#condition#",$condition_node,$count_sql);
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

           $orderby = $this->get_orderby("@node.sort",$search["_tab"]);
           $sql = "select #selectfields# from @node  #join# Where 1=1 #condition# #orderby#";
           $sql = str_replace("#selectfields#",$selectfields,$sql);
           $sql = str_replace("#join#",$join,$sql);
           $sql = str_replace("#condition#",$condition_node,$sql);
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
        $html = $this->fetch("NodeSummary:index");
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

        if(empty($data["funcid"])) $data["funcid"] = "NodeSummary";
        if(!$p){
           $p = 1;
           $export_all = 1;
        }

        $show_list = array();

        $data['summary']='NodeSummary';
        $usc = M('user_summary_column')->field("column")->where("user_code='%s' AND summary='%s' AND `show`='1'",array(session(C("USER_AUTH_KEY")),$data['summary']))->select();
        if($usc){
           foreach ($usc as $v) {
              $show_list[$v['column']]=1;
           }
        }

        $search["_tab"] = $this->tabsheet_check(I("request._tab"));
        $tab = $search["_tab"];

        $search["status"] = I("request.status");
        $search["name"] = I("request.name");
        $search["title"] = I("request.title");
        $search["remark"] = I("request.remark");
        $search["level"] = I("request.level");
        $search["module"] = I("request.module");
        $search["model"] = I("request.model");
        $search["btn_name"] = I("request.btn_name");
        $search["is_admin"] = I("request.is_admin");
        $search["ico"] = I("request.ico");
        $search["default_open"] = I("request.default_open");
        $search["side"] = I("request.side");
        $search["side2"] = I("request.side2");
        $search["menu"] = I("request.menu");
        $search["menu2"] = I("request.menu2");


        //condition
        $condition="";
        $condition_node="";

        //读取关键字搜索内容
        $search["_keyword"] = I("request._keyword");
        if($search["_showsearch"]=="hide"  ){
            if($search["_keyword"]){
                $condition_keyword = "";
                $condition_keyword = join_condition($condition_keyword,"@node.name",$search["_keyword"],"char", "both" , 0, "" );
                $condition_node = " AND ( ". $condition_keyword . ")";
            }
        }else{
        //高级搜索condition
           $condition_node = join_condition($condition_node,"@node.status",$search["status"],"int");
           $condition_node = join_condition($condition_node,"@node.name",$search["name"],"char");
           $condition_node = join_condition($condition_node,"@node.title",$search["title"],"char");
           $condition_node = join_condition($condition_node,"@node.remark",$search["remark"],"char","both");
           $condition_node = join_condition($condition_node,"@node.level",$search["level"],"int");
           $condition_node = join_condition($condition_node,"@node.module",$search["module"],"char","both");
           $condition_node = join_condition($condition_node,"@node.model",$search["model"],"char");
           $condition_node = join_condition($condition_node,"@node.btn_name",$search["btn_name"],"char");
           $condition_node = join_condition($condition_node,"@node.is_admin",$search["is_admin"],"int");
           $condition_node = join_condition($condition_node,"@node.ico",$search["ico"],"char");
           $condition_node = join_condition($condition_node,"@node.default_open",$search["default_open"],"int");
           $condition_node = join_condition2($condition_node,"@node.side",$search["side"],$search["side2"],"int");
           $condition_node = join_condition2($condition_node,"@node.menu",$search["menu"],$search["menu2"],"int");
        }
        $condition_node = $this->tabsheet_condition($condition_node ,$search["_tab"]);

        //select fields
        $selectfields="@node.status ";
        $selectfields.=",@node.id ";
        $selectfields.=",@node.name ";
        $selectfields.=",@node.title ";
        $selectfields.=",@node.remark ";
        $selectfields.=",@node.sort ";
        $selectfields.=",@node.pid ";
        $selectfields.=",@node.level ";
        $selectfields.=",@node.module ";
        $selectfields.=",@node.model ";
        $selectfields.=",@node.btn_name ";
        $selectfields.=",@node.is_admin ";
        $selectfields.=",@node.ico ";
        $selectfields.=",@node.default_open ";
        $selectfields.=",@node.side ";
        $selectfields.=",@node.menu ";


        $str_header = "";
        if ($show_list['status']==1 || empty($show_list)){
            $str_header .= "状态,";
        }
        if ($show_list['name']==1 || empty($show_list)){
            $str_header .= "模块名称,";
        }
        if ($show_list['title']==1 || empty($show_list)){
            $str_header .= "模块描述,";
        }
        if ($show_list['remark']==1 || empty($show_list)){
            $str_header .= "备注,";
        }
        if ($show_list['sort']==1 || empty($show_list)){
            $str_header .= "排序,";
        }
        if ($show_list['pid']==1 || empty($show_list)){
            $str_header .= "父层,";
        }
        if ($show_list['level']==1 || empty($show_list)){
            $str_header .= "级别,";
        }
        if ($show_list['module']==1 || empty($show_list)){
            $str_header .= "模块说明,";
        }
        if ($show_list['model']==1 || empty($show_list)){
            $str_header .= "启动方式,";
        }
        if ($show_list['btn_name']==1 || empty($show_list)){
            $str_header .= "按钮名称,";
        }
        if ($show_list['is_admin']==1 || empty($show_list)){
            $str_header .= "超级用户,";
        }
        if ($show_list['ico']==1 || empty($show_list)){
            $str_header .= "图标,";
        }
        if ($show_list['default_open']==1 || empty($show_list)){
            $str_header .= "缺省展开,";
        }
        if ($show_list['side']==1 || empty($show_list)){
            $str_header .= "交易方,";
        }
        if ($show_list['menu']==1 || empty($show_list)){
            $str_header .= "菜单,";
        }
        $str_header .= "\r\n";

        $join="";

       $count_sql = "select count(*) as cnt from @node  #join#  where 1=1 #condition#";  // ' for skip replace $condition
       $count_sql = str_replace("#join#",$join,$count_sql);
       $count_sql = str_replace("#condition#",$condition_node,$count_sql);

       $count_sql = table($count_sql);
       $count_sql = str_replace("·mailchar·","@",$count_sql);
       $count = M()->query($count_sql);
       $count = $count[0]["cnt"];

           $total_page=0;

        if(!$export_all) {
           $page_size = I("request.pagesize/d");
           $page_size = $page_size <= 0 ? session("NodeSummary-PageSize") : $page_size;
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

        $orderby="order by @node.sort";
        //$orderby="";

    for ($p;$p<=$total_page;$p++)
    {

        $sql = "select #selectfields# from @node  #join# Where 1=1 #condition# #orderby#";   // ' for skip replace $selectfields,$condition,$orderby
        $sql = str_replace("#selectfields#",$selectfields,$sql);
        $sql = str_replace("#join#",$join,$sql);
        $sql = str_replace("#condition#",$condition_node,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($p - 1) * $page_size). ", ".$page_size;

        $sql = table($sql);
        $sql = str_replace("·mailchar·","@",$sql);
        $list = M()->query($sql);

        foreach($list as $master) {
            $str_line="";
            if ($show_list['status']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_Node_status("$master[status]","name"))."\t,";
            }
            if ($show_list['name']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["name"])."\t,";
            }
            if ($show_list['title']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["title"])."\t,";
            }
            if ($show_list['remark']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["remark"])."\t,";
            }
            if ($show_list['sort']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["sort"])."\t,";
            }
            if ($show_list['pid']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(system_format("N3", $master["pid"]))."\t,";
            }
            if ($show_list['level']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["level"])."\t,";
            }
            if ($show_list['module']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["module"])."\t,";
            }
            if ($show_list['model']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["model"])."\t,";
            }
            if ($show_list['btn_name']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["btn_name"])."\t,";
            }
            if ($show_list['is_admin']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_Node_is_admin("$master[is_admin]","name"))."\t,";
            }
            if ($show_list['ico']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["ico"])."\t,";
            }
            if ($show_list['default_open']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_Node_default_open("$master[default_open]","name"))."\t,";
            }
            if ($show_list['side']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["side"])."\t,";
            }
            if ($show_list['menu']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["menu"])."\t,";
            }
            $str_content .= $str_line . "\r\n";
        }
    }
        header('Content-Type: text/xls');
        header ("Content-type:application/vnd.ms-excel;charset=gbk" );
        $str = mb_convert_encoding("NodeSummary", 'gbk', 'utf-8');
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
          case 'youxiao':
          case 'wuxiao':
              break;
          default:
              $itab='all';
              break;
              $itab='youxiao';
              break;
              $itab='wuxiao';
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
            case 'youxiao':  //有效
                 $scond="@node.status='1'";
                 break;
            case 'wuxiao':  //无效
                 $scond="@node.status='0'";
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
            case 'youxiao':  //有效
                 break;
            case 'wuxiao':  //无效
                 break;
        }
        if($orderby)
            return " order by $orderby";
        else
            return "";
    }


}
