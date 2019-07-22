<?php namespace Summary\Controller;
//
//注释: CustomerSummary - 客户信息列表
//
use Home\Controller\BasicController;
use Think\Log;
class CustomerSummaryController extends BasicController {

    public function _init() {
        $funcs = $this->getUserRoleList($this->user,array( '/Home/Customer', 'CustomerSummary', ));
        if ($funcs)
            $this->assign("rights",  $funcs);
        else{
            $funcs = array(
                         array("key"=>"add","func"=>"/Home/Customer","Action"=>"add") ,
                         array("key"=>"import","func"=>"/Home/Customer","Action"=>"import") ,
                         array("key"=>"refresh","func"=>"CustomerSummary","Action"=>"refresh") ,
                         array("key"=>"search","func"=>"CustomerSummary","Action"=>"search") ,
                         array("key"=>"export","func"=>"CustomerSummary","Action"=>"export") ,
                         array("key"=>"master_view","func"=>"/Home/Customer","Action"=>"view") ,
                         array("key"=>"master_edit","func"=>"/Home/Customer","Action"=>"edit") ,
                         array("key"=>"master_delete","func"=>"/Home/Customer","Action"=>"delete") ,
                         array("key"=>"status_on","func"=>"/Home/Customer","Action"=>"status_on") ,
                         array("key"=>"status_off","func"=>"/Home/Customer","Action"=>"status_off")
             );
            $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"CustomerSummary"));
    }

    public function index() {
         try {
        $data["pfuncid"] = I("request.pfuncid");
        $data["funcid"] = I("request.funcid");
        $data["zindex"] = I("request.zindex/d");
        if(empty($data["funcid"])) $data["funcid"] = "CustomerSummary";
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
          //$this->ajaxResult("客户信息列表后台错误");
          $this->ajaxResult($e->getMessage());
      }
    }


    private function columnsetting_define(){
        return array(
            'status'=>'状态',
            'type'=>'客户类型',
            'customer_name'=>'上级上级',
            'code'=>'客户代码',
            'name'=>'客户简称',
            'full_name'=>'客户全称',
            'prefix'=>'拼音缩写',
            'province'=>'省份',
            'address'=>'地址',
            'mobile'=>'手机',
            'linkman'=>'联系人',
            'remarks'=>'备注信息',
            'customer_level'=>'层级',
            'create_time'=>'创建时间',
            'modify_time'=>'修改时间',
        );
    }

    private function columnsetting($data){
        $data['user_code']=session(C("USER_AUTH_KEY"));
        $data['summary']='CustomerSummary';
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

        $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideMask()"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Summary/CustomerSummary/index?func=search&").  "','".filterFuncId("CustomerSummary_Search","id=0")."','客户信息列表', 1",""));


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
       $search["type"] = I("request.type");
       $search["parent_id_name"] = I("request.parent_id_name");
       $search["parent_id"] = I("request.parent_id");
       $search["customer_name"] = I("request.customer_name");
       $search["code"] = I("request.code");
       $search["name"] = I("request.name");
       $search["full_name"] = I("request.full_name");
       $search["prefix"] = I("request.prefix");
       $search["province"] = I("request.province");
       $search["address"] = I("request.address");
       $search["mobile"] = I("request.mobile");
       $search["linkman"] = I("request.linkman");
       $search["remarks"] = I("request.remarks");
       $search["customer_level"] = I("request.customer_level");

       //判断首次装载是否要赋予缺省值
       if($firstloading){
       }



       $condition="";
       $condition_customer="";
       if($bsearch) {
           //关键字条件
           if($search["_showsearch"]=="hide"  ){
               if($search["_keyword"]){
                   $condition_keyword = "";
                   $condition_keyword = join_condition($condition_keyword,"a.name",$search["_keyword"],"char", "both" , 0, "" );
                   $condition_keyword = join_condition($condition_keyword,"@customer.code",$search["_keyword"],"char", "both" , 0, "OR" );
                   $condition_keyword = join_condition($condition_keyword,"@customer.name",$search["_keyword"],"char", "both" , 0, "OR" );
                   $condition_keyword = join_condition($condition_keyword,"@customer.prefix",$search["_keyword"],"char", "both" , 0, "OR" );
                   $condition_keyword = join_condition($condition_keyword,"@customer.mobile",$search["_keyword"],"char", "both" , 0, "OR" );
                   $condition_customer = " AND ( ". $condition_keyword .")";
               }
           }else{
               //高级搜索condition
               $condition_customer = join_condition($condition_customer,"@customer.status",$search["status"],"int");
               $condition_customer = join_condition($condition_customer,"@customer.type",$search["type"],"int");
               $condition_customer = join_condition($condition_customer,"@customer.parent_id",$search["parent_id"],"int");
               $condition_a = join_condition($condition_a,"a.name",$search["customer_name"],"char","both");
               $condition_customer = join_condition($condition_customer,"@customer.code",$search["code"],"char");
               $condition_customer = join_condition($condition_customer,"@customer.name",$search["name"],"char","both");
               $condition_customer = join_condition($condition_customer,"@customer.full_name",$search["full_name"],"char","both");
               $condition_customer = join_condition($condition_customer,"@customer.prefix",$search["prefix"],"char");
               $condition_customer = join_condition($condition_customer,"@customer.province",$search["province"],"char");
               $condition_customer = join_condition($condition_customer,"@customer.address",$search["address"],"char","both");
               $condition_customer = join_condition($condition_customer,"@customer.mobile",$search["mobile"],"char");
               $condition_customer = join_condition($condition_customer,"@customer.linkman",$search["linkman"],"char");
               $condition_customer = join_condition($condition_customer,"@customer.remarks",$search["remarks"],"char","both");
               $condition_customer = join_condition($condition_customer,"@customer.customer_level",$search["customer_level"],"int");
           }

           //增加 tab 条件
           $condition_customer = $this->tabsheet_condition($condition_customer ,$search["_tab"]);
           //select fields
           $selectfields=" @customer.status ";
           $selectfields.=", @customer.id ";
           $selectfields.=", @customer.type ";
           $selectfields.=", a.name customer_name ";
           $selectfields.=", @customer.code ";
           $selectfields.=", @customer.name ";
           $selectfields.=", @customer.full_name ";
           $selectfields.=", @customer.prefix ";
           $selectfields.=", @customer.province ";
           $selectfields.=", @customer.address ";
           $selectfields.=", @customer.mobile ";
           $selectfields.=", @customer.linkman ";
           $selectfields.=", @customer.remarks ";
           $selectfields.=", @customer.customer_level ";
           $selectfields.=", @customer.create_time ";
           $selectfields.=", @customer.modify_time ";


           $page_size = I("request.pagesize/d");
           if ($page_size<=0){
               $page_size = session("CustomerSummary-PageSize");
               if (!$page_size) {
                    $page_size = 10;
               }
           }
           session("CustomerSummary-PageSize", $page_size);


           $join="";
           if($condition_a){
              $condition_customer .= $condition_a;
           }
           $count_sql = "select count(*) as cnt from @customer LEFT JOIN @customer a ON a.id=@customer.parent_id  #join#  where 1=1 #condition#";  // ' for skip replace $condition
           $count_sql = str_replace("#join#",$join,$count_sql);
           $count_sql = str_replace("#condition#",$condition_customer,$count_sql);
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

           $orderby = $this->get_orderby("@customer.customer_level,@customer.parent_id,@customer.id",$search["_tab"]);
           $sql = "select #selectfields# from @customer LEFT JOIN @customer a ON a.id=@customer.parent_id  #join# Where 1=1 #condition# #orderby#";
           $sql = str_replace("#selectfields#",$selectfields,$sql);
           $sql = str_replace("#join#",$join,$sql);
           $sql = str_replace("#condition#",$condition_customer,$sql);
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
        $html = $this->fetch("CustomerSummary:index");
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

        if(empty($data["funcid"])) $data["funcid"] = "CustomerSummary";
        if(!$p){
           $p = 1;
           $export_all = 1;
        }

        $show_list = array();

        $data['summary']='CustomerSummary';
        $usc = M('user_summary_column')->field("column")->where("user_code='%s' AND summary='%s' AND `show`='1'",array(session(C("USER_AUTH_KEY")),$data['summary']))->select();
        if($usc){
           foreach ($usc as $v) {
              $show_list[$v['column']]=1;
           }
        }

        $search["_tab"] = $this->tabsheet_check(I("request._tab"));
        $tab = $search["_tab"];

        $search["status"] = I("request.status");
        $search["type"] = I("request.type");
        $search["parent_id_name"] = I("request.parent_id_name");
        $search["parent_id"] = I("request.parent_id");
        $search["customer_name"] = I("request.customer_name");
        $search["code"] = I("request.code");
        $search["name"] = I("request.name");
        $search["full_name"] = I("request.full_name");
        $search["prefix"] = I("request.prefix");
        $search["province"] = I("request.province");
        $search["address"] = I("request.address");
        $search["mobile"] = I("request.mobile");
        $search["linkman"] = I("request.linkman");
        $search["remarks"] = I("request.remarks");
        $search["customer_level"] = I("request.customer_level");


        //condition
        $condition="";
        $condition_customer="";

        //读取关键字搜索内容
        $search["_keyword"] = I("request._keyword");
        if($search["_showsearch"]=="hide"  ){
            if($search["_keyword"]){
                $condition_keyword = "";
                $condition_keyword = join_condition($condition_keyword,"a.name",$search["_keyword"],"char", "both" , 0, "" );
                $condition_keyword = join_condition($condition_keyword,"@customer.code",$search["_keyword"],"char", "both" , 0, "OR" );
                $condition_keyword = join_condition($condition_keyword,"@customer.name",$search["_keyword"],"char", "both" , 0, "OR" );
                $condition_keyword = join_condition($condition_keyword,"@customer.prefix",$search["_keyword"],"char", "both" , 0, "OR" );
                $condition_keyword = join_condition($condition_keyword,"@customer.mobile",$search["_keyword"],"char", "both" , 0, "OR" );
                $condition_customer = " AND ( ". $condition_keyword . ")";
            }
        }else{
        //高级搜索condition
           $condition_customer = join_condition($condition_customer,"@customer.status",$search["status"],"int");
           $condition_customer = join_condition($condition_customer,"@customer.type",$search["type"],"int");
           $condition_customer = join_condition($condition_customer,"@customer.parent_id",$search["parent_id"],"int");
           $condition_a = join_condition($condition_a,"a.name",$search["customer_name"],"char","both");
           $condition_customer = join_condition($condition_customer,"@customer.code",$search["code"],"char");
           $condition_customer = join_condition($condition_customer,"@customer.name",$search["name"],"char","both");
           $condition_customer = join_condition($condition_customer,"@customer.full_name",$search["full_name"],"char","both");
           $condition_customer = join_condition($condition_customer,"@customer.prefix",$search["prefix"],"char");
           $condition_customer = join_condition($condition_customer,"@customer.province",$search["province"],"char");
           $condition_customer = join_condition($condition_customer,"@customer.address",$search["address"],"char","both");
           $condition_customer = join_condition($condition_customer,"@customer.mobile",$search["mobile"],"char");
           $condition_customer = join_condition($condition_customer,"@customer.linkman",$search["linkman"],"char");
           $condition_customer = join_condition($condition_customer,"@customer.remarks",$search["remarks"],"char","both");
           $condition_customer = join_condition($condition_customer,"@customer.customer_level",$search["customer_level"],"int");
        }
        $condition_customer = $this->tabsheet_condition($condition_customer ,$search["_tab"]);

        //select fields
        $selectfields="@customer.status ";
        $selectfields.=",@customer.id ";
        $selectfields.=",@customer.type ";
        $selectfields.=",a.name customer_name ";
        $selectfields.=",@customer.code ";
        $selectfields.=",@customer.name ";
        $selectfields.=",@customer.full_name ";
        $selectfields.=",@customer.prefix ";
        $selectfields.=",@customer.province ";
        $selectfields.=",@customer.address ";
        $selectfields.=",@customer.mobile ";
        $selectfields.=",@customer.linkman ";
        $selectfields.=",@customer.remarks ";
        $selectfields.=",@customer.customer_level ";
        $selectfields.=",@customer.create_time ";
        $selectfields.=",@customer.modify_time ";


        $str_header = "";
        if ($show_list['status']==1 || empty($show_list)){
            $str_header .= "状态,";
        }
        if ($show_list['type']==1 || empty($show_list)){
            $str_header .= "客户类型,";
        }
        if ($show_list['customer_name']==1 || empty($show_list)){
            $str_header .= "上级上级,";
        }
        if ($show_list['code']==1 || empty($show_list)){
            $str_header .= "客户代码,";
        }
        if ($show_list['name']==1 || empty($show_list)){
            $str_header .= "客户简称,";
        }
        if ($show_list['full_name']==1 || empty($show_list)){
            $str_header .= "客户全称,";
        }
        if ($show_list['prefix']==1 || empty($show_list)){
            $str_header .= "拼音缩写,";
        }
        if ($show_list['province']==1 || empty($show_list)){
            $str_header .= "省份,";
        }
        if ($show_list['address']==1 || empty($show_list)){
            $str_header .= "地址,";
        }
        if ($show_list['mobile']==1 || empty($show_list)){
            $str_header .= "手机,";
        }
        if ($show_list['linkman']==1 || empty($show_list)){
            $str_header .= "联系人,";
        }
        if ($show_list['remarks']==1 || empty($show_list)){
            $str_header .= "备注信息,";
        }
        if ($show_list['customer_level']==1 || empty($show_list)){
            $str_header .= "层级,";
        }
        if ($show_list['create_time']==1 || empty($show_list)){
            $str_header .= "创建时间,";
        }
        if ($show_list['modify_time']==1 || empty($show_list)){
            $str_header .= "修改时间,";
        }
        $str_header .= "\r\n";

        $join="";
        if($condition_a){
            $condition_customer .= $condition_a;
        }

       $count_sql = "select count(*) as cnt from @customer LEFT JOIN @customer a ON a.id=@customer.parent_id  #join#  where 1=1 #condition#";  // ' for skip replace $condition
       $count_sql = str_replace("#join#",$join,$count_sql);
       $count_sql = str_replace("#condition#",$condition_customer,$count_sql);

       $count_sql = table($count_sql);
       $count_sql = str_replace("·mailchar·","@",$count_sql);
       $count = M()->query($count_sql);
       $count = $count[0]["cnt"];

           $total_page=0;

        if(!$export_all) {
           $page_size = I("request.pagesize/d");
           $page_size = $page_size <= 0 ? session("CustomerSummary-PageSize") : $page_size;
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

        $orderby="order by @customer.customer_level,@customer.parent_id,@customer.id";
        //$orderby="";

    for ($p;$p<=$total_page;$p++)
    {

        $sql = "select #selectfields# from @customer LEFT JOIN @customer a ON a.id=@customer.parent_id  #join# Where 1=1 #condition# #orderby#";   // ' for skip replace $selectfields,$condition,$orderby
        $sql = str_replace("#selectfields#",$selectfields,$sql);
        $sql = str_replace("#join#",$join,$sql);
        $sql = str_replace("#condition#",$condition_customer,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($p - 1) * $page_size). ", ".$page_size;

        $sql = table($sql);
        $sql = str_replace("·mailchar·","@",$sql);
        $list = M()->query($sql);

        foreach($list as $master) {
            $str_line="";
            if ($show_list['status']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_Customer_status("$master[status]","name"))."\t,";
            }
            if ($show_list['type']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_Customer_type("$master[type]","name"))."\t,";
            }
            if ($show_list['customer_name']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["customer_name"])."\t,";
            }
            if ($show_list['code']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["code"])."\t,";
            }
            if ($show_list['name']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["name"])."\t,";
            }
            if ($show_list['full_name']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["full_name"])."\t,";
            }
            if ($show_list['prefix']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["prefix"])."\t,";
            }
            if ($show_list['province']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["province"])."\t,";
            }
            if ($show_list['address']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["address"])."\t,";
            }
            if ($show_list['mobile']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["mobile"])."\t,";
            }
            if ($show_list['linkman']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["linkman"])."\t,";
            }
            if ($show_list['remarks']==1  || empty($show_list )) {
                $str_line.=$this->csvdata($master["remarks"])."\t,";
            }
            if ($show_list['customer_level']==1  || empty($show_list )) {
                $str_line.=$this->csvdata(get_table_Customer_customer_level("$master[customer_level]","name"))."\t,";
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
        $str = mb_convert_encoding("CustomerSummary", 'gbk', 'utf-8');
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
          case 'quanbu':
          case 'hehuo':
          case 'kehu':
          case 'wuxiao':
              break;
          default:
              $itab='quanbu';
              break;
              if (!session('CUSTOMER_ID')){
              $itab='hehuo';
              break;
              }
              if (!session('CUSTOMER_ID')){
              $itab='kehu';
              break;
              }
              if (!session('CUSTOMER_ID')){
              $itab='wuxiao';
              break;
              }
         }
        return $itab;
    }

    private function tabsheet_condition($scondition, $itab)
    {
        $scond="";
        switch($itab)
        {
            case 'quanbu':  //全部
                 $scond="";
                 break;
            case 'hehuo':  //合伙
                 $scond="@customer.type=0 and @customer.status='1'";
                 break;
            case 'kehu':  //客户
                 $scond="@customer.type=1 and @customer.status='1'";
                 break;
            case 'wuxiao':  //无效
                 $scond="@customer.status!='1'";
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
            case 'quanbu':  //全部
                 break;
            case 'hehuo':  //合伙
                 break;
            case 'kehu':  //客户
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
