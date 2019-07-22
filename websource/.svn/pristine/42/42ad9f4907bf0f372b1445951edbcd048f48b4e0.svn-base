<?php
namespace Home\Controller;
class PopupController extends BasicController {
  public function index() {
    $func = I("get.func/s", "");
    if (empty($func)) {
      return;
    }
    switch ($func) {
      case "Activity":
           $this->Activity();
           break;
      case "Area":
           $this->Area();
           break;
      case "Brand":
           $this->Brand();
           break;
      case "Buyer":
           $this->Buyer();
           break;
      case "Category":
           $this->Category();
           break;
      case "Customer":
           $this->Customer();
           break;
      case "CustomerTree":
            $this->CustomerTree();
            break;
      case "QuestionCategoryTree":
            $this->QuestionCategoryTree();
            break;
            
      case "EffectsCategory":
           	$this->EffectsCategory();
           	break;
      case "CustomerCategory":
           	$this->CustomerCategory();
           	break;
      case "Deliver":
           $this->Deliver();
           break;
      case "Department":
           $this->Department();
           break;
      case "Device":
      	   $this->Device();
		   break;
      case "Effects":
      	   $this->Effects();
		   break;
      case "Group":
           $this->Group();
           break;
      case "HangupTag":
           $this->HangupTag();
           break;
      case "OrderSwitch":
           $this->OrderSwitch();
           break;
      case "OrderTag":
           $this->OrderTag();
           break;
      case "Payment":
           $this->Payment();
           break;
      case "Platform":
           $this->Platform();
           break;
      case "ReturnReason":
           $this->ReturnReason();
           break;
      case "Role":
           $this->Role();
           break;
      case "Season":
           $this->Season();
           break;
      case "Shop":
           $this->Shop();
           break;
      case "Storage":
           $this->Storage();
           break;
      case "StorageLocation":
           $this->StorageLocation();
           break;           
      case "Style1":
           $this->Style1();
           break;
      case "Style2":
           $this->Style2();
           break;
      case "User":
           $this->User();
           break;
      case "Year":
           $this->Year();
           break;
      case "SelectProduct":
	       $this->SelectProduct();
	       break;
       case "Product":
	       	$this->Product();
	       	break;	       
       	case "Goods":
       		$this->Goods();
       		break;
	       		 
    }
  }

  // Activity , @activity , 活动
  private function Activity() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Activity-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Activity-PageSize", $page_size);
    $arr = table_Activity();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Activity");
    echo $html;
  }

  // Area , @area , 地区
  private function Area() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Area-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Area-PageSize", $page_size);
    $arr = table_Area();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Area");
    echo $html;
  }

  // Brand , @brand , 品牌
  private function Brand() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Brand-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Brand-PageSize", $page_size);
    $arr = table_Brand();
    
    $data["storage_code"] = I("get.storage_code");
    if($data["storage_code"]) {
    	$scs = explode("|", $data["storage_code"]);
    	$scs = implode("','", $scs);
    	$pre = C("DB_PREFIX");
    	$sql = "SELECT distinct(brand_code) as brand_code FROM ".$pre."stock2 WHERE storage_code IN('$scs') AND brand_code <> '' AND brand_code is not null";
    	$brand_code = M()->query($sql);
    	$bcs = array();
    	foreach($brand_code as $bc) {
    		$bcs[] = $bc["brand_code"];
    	}
    	$keys = array_keys($arr);
    	foreach($keys as $key) {
    		if(!in_array($key, $bcs)) {
    			unset($arr[$key]);
    		}
    	}
    }
    
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Brand");
    echo $html;
  }

    // Effects , @effects , 买家
  private function Effects()
  {
      $data["funcid"] = I("get.funcid/s");
      $data["zindex"] = I("get.zindex/d");
      $data["p"] = I("get.p/d");
      $data["company_id"] = I("get.company_id");
      $data["search"] = I("get.search");

      //$page_size = I("get.pagesize/d");
      //$page_size = $page_size <= 0 ? session("Popup-Effects-PageSize") : $page_size;
      //if(!$page_size) {
      //  $page_size = 20;
      //}
      $page_size = 20;

      $where = " and allow_borrow=1 ";
      if ($data["search"]){
          $where .=" AND (code like '%".$data["search"]."%' or prefix like '%".$data["search"]."%' or name like '%".$data["search"]."%' )"  ;
        }

    session("Popup-Effects-PageSize", $page_size);
    $countsql = table("SELECT count(*) as cnt FROM @effects WHERE status = 1");
    $count = M()->query($countsql);
    $count = $count[0]["cut"];
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

    $selectfields="@effects.id";
    $selectfields.=",@effects.code";
    $selectfields.=",@effects.name";
    $selectfields.=",@effects.type";
    $selectfields.=",@effects.company_id";
    $selectfields.=",@effects.department_id";
    $selectfields.=",@effects.custodian_name";
    $selectfields.=",@effects.allow_borrow";
    $selectfields.=",@effects.status";

    $sql = table("SELECT #selectfields# FROM @effects WHERE status = 1 $where");
    $sql = str_replace("#selectfields#",table($selectfields),$sql);
    $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
    $data["popupdata"] = M()->query($sql);

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Effects");
    echo $html;
  }


  // Buyer , @buyer , 买家
  private function Buyer() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Buyer-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Buyer-PageSize", $page_size);
    $countsql = table("SELECT count(*) as cnt FROM @buyer WHERE status = 1");
    $count = M()->query($countsql);
    $count = $count[0]["cut"];
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

    $selectfields="@buyer.id";
    $selectfields.=",@buyer.name";
    $selectfields.=",@buyer.phone";
    $selectfields.=",@buyer.mobile";
    $selectfields.=",@buyer.sex";
    $selectfields.=",@buyer.qq";
    $selectfields.=",@buyer.is_blacklist";
    $selectfields.=",@buyer.status";

    $sql = table("SELECT #selectfields# FROM @buyer WHERE status = 1");
    $sql = str_replace("#selectfields#",table($selectfields),$sql);
    $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
    $data["popupdata"] = M()->query($sql);

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Buyer");
    echo $html;
  }

  // Category , @category , 分类
  private function Category() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    $arr=M('category')->where('status=1')->field('id,name,code,parent_id')->order('parent_id ASC,sort ASC')->select();

    $tmp=array();
    foreach ($arr as $v) {
        $tmp[$v['id']]=$v;
    }

    $ret=getCategoryTree($tmp);
    $html=getTreeData($ret,$selecttype);

    $data["popupdata"] = $html ;


    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Category");
    echo $html;
  }

 // Category , @category , 分类
  private function EffectsCategory() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    $arr=M('effects_category')->where('status=1')->field('id,name,code,parent_id')->order('parent_id ASC,sort ASC')->select();

    $tmp=array();
    foreach ($arr as $v) {
        $tmp[$v['id']]=$v;
    }

    $ret=getCategoryTree($tmp);
    $html=getTreeData($ret,$selecttype);

    $data["popupdata"] = $html ;


    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:EffectsCategory");
    echo $html;
  }

  // Customer , @customer , 供应商
  private function Customer() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    $data ["search"] ["prefix"] = I ( "get.prefix" );
    $data ["search"] ["code"] = I ( "get.code" );
    $data ["search"] ["short_name"] = I ( "get.short_name" );
    $page_size = I("get.pagesize/d");
    $page_size = $page_size <= 0 ? session("Popup-Customer-PageSize") : $page_size;
    if(!$page_size) {
      $page_size = 20;
    }

    $where="";
    if($this->user_shop_id){
          //$where  .= " and s.id=". $this->user_shop_id;
    }
    if($data ["search"] ["prefix"]){
        $where .= " and s.prefix like '%".$data ["search"] ["prefix"]."%'";
    }
    if($data ["search"] ["code"]){
          $where .= " and s.code='".$data ["search"] ["code"]."'";
    }
    if($data ["search"] ["short_name"]){
          $where .= " and s.short_name like '%".$data ["search"] ["short_name"]."%'";
    }



      $join_condtion=null;
      $where_condition="s.status=1";
      if($this->user_shop_id)
      {
          $join_condtion="right join __CUSTOMER_TREE__ as ct on s.id=ct.customer_id";
          $where_condition.=" and ct.parent_id=".$this->user['customer_id'];
      }

    session("Popup-Customer-PageSize", $page_size);

      $model=M("Customer as s");
      $count=$model->join($join_condtion)
          ->where("$where_condition  $where")
      ->count();



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


      $data["popupdata"]=$model->join($join_condtion)
          ->join("left join __CUSTOMER__ as pp on s.parent_id=pp.id")
          ->where("$where_condition  $where")
          ->field("s.id,s.code,s.short_name,s.address,s.prefix,s.phone,s.linkman,s.last_address,s.amount,s.status,pp.short_name as pname")
          ->order("s.customer_level,s.parent_id,s.prefix")
          ->limit(($data["p"] - 1) * $page_size,$page_size)->select();

//    $selectfields="@customer.id";
//    $selectfields.=",@customer.code";
//    $selectfields.=",@customer.short_name";
//    $selectfields.=",@customer.address";
//    $selectfields.=",@customer.phone";
//    $selectfields.=",@customer.linkman";
//    $selectfields.=",@customer.last_address";
//    $selectfields.=",@customer.amount";
//    $selectfields.=",@customer.status";
//
//    $sql = table("SELECT #selectfields# FROM @customer WHERE status = 1");
//    if($where)
//        $sql.=$where;
//
//    $sql = str_replace("#selectfields#",table($selectfields),$sql);
//
//      $sql .= " order by code";
//      $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
//    $data["popupdata"] = M()->query($sql);

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp($data["funcid"], "选择客户1");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Customer");
    echo $html;
  }
  
  // CustomerCategory , @customercategory , 客户分类
  private function CustomerCategory() {
  	$data["funcid"] = I("get.funcid/s");
  	$data["zindex"] = I("get.zindex/d");
  	$data["p"] = I("get.p/d");
  	$data["selecttype"] = I("get.selecttype");
  
  	$arr=M('customer_category')->where('status=1')->field('id,name,code,parent_id')->order('parent_id ASC,sort ASC')->select();
  
  	$tmp=array();
  	foreach ($arr as $v) {
  		$tmp[$v['id']]=$v;
  	}
  
  	$ret=getCategoryTree($tmp);
  	$html=getTreeData($ret,$selecttype);
  
  	$data["popupdata"] = $html ;
  
  
  	foreach($data as $key=>$val) {
  		$this->assign($key, $val);
  	}
  	$html = $this->fetch("Popup:CustomerCategory");
  	echo $html;
  }

    // CustomerCategory , @customercategory , 客户分类
    private function CustomerTree() {
        $data["funcid"] = I("get.funcid/s");
        $data["zindex"] = I("get.zindex/d");
        $data["p"] = I("get.p/d");
        $data["selecttype"] = I("get.selecttype");
        $data["parent_id"] = I("get.parent_id/d", 0);
        $data["excludeId"] = I("get.excludeId/d", 0);
        $onlyData = I("get.onlyData/d", 0);

        $data["customers"]=M('customer')->where('status=1 and parent_id = '.$data["parent_id"]." AND id <>".$data["excludeId"])->field('id,name,id as code,parent_id,code as xcode')->order('prefix ASC,name')->select();
        if($onlyData) {
            echo json_encode($data["customers"]);
            die;
        }
        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Popup:CustomerTree");
        echo $html;
    }

    private function QuestionCategoryTree() {
        $data["funcid"] = I("get.funcid/s");
        $data["zindex"] = I("get.zindex/d");
        $data["p"] = I("get.p/d");
        $data["selecttype"] = I("get.selecttype");
        $data["parent_id"] = I("get.parent_id/d", 0);
        $data["excludeId"] = I("get.excludeId/d", 0);
        $onlyData = I("get.onlyData/d", 0);

        $data["treedatas"]=M('question_category')->where('status=1 and parent_id = '.$data["parent_id"]." AND id <>".$data["excludeId"])->field('id,name,code,parent_id,code as xcode')->order('sort')->select();
        if($onlyData) {
            echo json_encode($data["treedatas"]);
            die;
        }
        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Popup:QuestionCategoryTree");
        echo $html;
    }

    // Deliver , @deliver , 配送方式
  private function Deliver() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Deliver-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Deliver-PageSize", $page_size);
    $arr = table_Deliver();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Deliver");
    echo $html;
  }

  // Department , @department , 部门
  private function Department() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Department-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Department-PageSize", $page_size);
    $arr = table_Department();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Department");
    echo $html;
  }
  
  private function Device() {
  	$data["funcid"] = I("get.funcid/s");
  	$data["zindex"] = I("get.zindex/d");
  	$data["p"] = I("get.p/d");
  	$data["selecttype"] = I("get.selecttype");
  	
  	//$page_size = I("get.pagesize/d");
  	//$page_size = $page_size <= 0 ? session("Popup-Department-PageSize") : $page_size;
  	//if(!$page_size) {
  	//  $page_size = 20;
  	//}
  	$page_size = 20;
  	
  	session("Popup-Device-PageSize", $page_size);
  	$arr = table_Device();
  	$count = count($arr);
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
  	
  	$data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;
  	
  	$pageClass = new \Think\Page($count,$page_size);
  	$pageClass->rollPage = 6;
  	
  	$data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
  	$data["page_size"] = $page_size;
  	
  	foreach($data as $key=>$val) {
  		$this->assign($key, $val);
  	}
  	$html = $this->fetch("Popup:Device");
  	echo $html;
  }

  // Group , @group , 分组
  private function Group() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Group-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Group-PageSize", $page_size);
    $arr = table_Group();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Group");
    echo $html;
  }

  // HangupTag , @hangup_tag , 挂起标签
  private function HangupTag() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-HangupTag-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-HangupTag-PageSize", $page_size);
    $arr = table_HangupTag();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:HangupTag");
    echo $html;
  }

  // OrderSwitch , @order_switch , 转单规则
  private function OrderSwitch() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-OrderSwitch-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-OrderSwitch-PageSize", $page_size);
    $arr = table_OrderSwitch();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:OrderSwitch");
    echo $html;
  }

  // OrderTag , @order_tag , 标签
  private function OrderTag() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-OrderTag-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-OrderTag-PageSize", $page_size);
    $arr = table_OrderTag();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:OrderTag");
    echo $html;
  }

  // Payment , @payment , 支付方式
  private function Payment() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Payment-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Payment-PageSize", $page_size);
    $arr = table_Payment();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Payment");
    echo $html;
  }

  // Platform , @platform , 销售平台
  private function Platform() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Platform-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Platform-PageSize", $page_size);
    $arr = table_Platform();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Platform");
    echo $html;
  }

  // ReturnReason , @return_reason , 退货原因
  private function ReturnReason() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-ReturnReason-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-ReturnReason-PageSize", $page_size);
    $arr = table_ReturnReason();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:ReturnReason");
    echo $html;
  }

    // Role , @role , 角色
    private function Role() {
        $data["funcid"] = I("get.funcid/s");
        $data["zindex"] = I("get.zindex/d");
        $data["p"] = I("get.p/d");
        $data["selecttype"] = I("get.selecttype");

        //$page_size = I("get.pagesize/d");
        //$page_size = $page_size <= 0 ? session("Popup-Role-PageSize") : $page_size;
        //if(!$page_size) {
        //  $page_size = 20;
        //}
        $page_size = 20;

        session("Popup-Role-PageSize", $page_size);
        $arr = table_Role();
        $count = count($arr);
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

        $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

        $pageClass = new \Think\Page($count,$page_size);
        $pageClass->rollPage = 6;

        $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
        $data["page_size"] = $page_size;

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Popup:Role");
        echo $html;
    }

  // Season , @season , 季节
  private function Season() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Season-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Season-PageSize", $page_size);
    $arr = table_Season();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Season");
    echo $html;
  }

  // Shop , @shop , 店铺
  private function Shop() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");
    $data["value"] = explode(',',I("get.value"));

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Shop-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Shop-PageSize", $page_size);
    $arr = table_Shop();
    if(session ( C ( 'USER_AUTH_KEY' )) != "admin") {
    	$shops = $this->user_shop;
    	foreach($arr as $key=>$val) {
    		if(!in_array($key, $shops)) {
    			unset($arr[$key]);
    		}
    	}
    }
    
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Shop");
    echo $html;
  }

  // Storage , @storage , 仓库
  private function Storage() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["code"] = I("get.code");
    $data["name"] = I("get.name");
    $data['is_manual']=I("get.is_manual");
    $data["namelike"] = I("get.namelike/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");
    $data["value"] = explode(',',I("get.value"));

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Storage-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Storage-PageSize", $page_size);
      $arr = M('storage')->where("status=1")->select();
      $data["namelike"]=1;
      $tmp=array();

      foreach ($arr as $v) {

          if($data['is_manual']==1){
              if($v['interface']==0)
                  $tmp[]=$v;
          }


          if(trim($data['code'])!='' && $v['code']==$data['code']){
              $tmp=array($v);
              break;
          }

          if(trim($data['name'])!=''){
              if($data['namelike']==1){
                  if(strstr($v['name'],$data['name'])){
                      $tmp[]=$v;
                  }
              }else{
                  if($v['name']==$data['name']){
                      $tmp[]=$v;
                  }
              }
          }

      }


      if(trim($data['code'])!='' || trim($data['name'])!='' || intval($data['is_manual'])==1){
          $arr=$tmp;
      }
    

    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Storage");
    echo $html;
  }
  
  
  // StorageLocation , @storagelocation , 仓库库位
  private function StorageLocation() {
  	$data["funcid"] = I("get.funcid/s");
  	$data["zindex"] = I("get.zindex/d");
  	$data["code"] = I("get.code");
  	$data["name"] = I("get.name");
  	$data['is_manual']=I("get.is_manual");
  	$data["namelike"] = I("get.namelike/d");
  	$data["p"] = I("get.p/d");
  	$data["selecttype"] = I("get.selecttype");
  	$data["value"] = explode(',',I("get.value"));  	
  	$data["storage_code"] = I("get.storage_code");
  	
  	foreach($_GET as $k=>$v) {
  		if(substr($k, 0, 8) == "goods_id") {
  			$data["goods_id"] = $v;
  			break;
  		}
  	}
  	
  	if(!isset($data["goods_id"])) {
  		$data["goods_id"] = "";
  	}

  	//$page_size = I("get.pagesize/d");
  	//$page_size = $page_size <= 0 ? session("Popup-Storage-PageSize") : $page_size;
  	//if(!$page_size) {
  	//  $page_size = 20;
  	//}
  	$page_size = 10;
  	$where="";
  	if($data["storage_code"]){
  		$where=" and a.storage_code = '".$data["storage_code"]."'";
  	}
  
  	session("Popup-Storage-PageSize", $page_size);
  	if($data["goods_id"]) {
  		$arr = M('storage_location as a')->field("a.*, (b.qty - b.qty_lock) as qty")->join("__STOCK3__ as b on a.code = b.location_code AND b.goods_id = '".$data["goods_id"]."'", "LEFT")->where("a.status=1".$where)->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] )->select();
  	} else {
  		$arr = M('storage_location as a')->where("status=1".$where)->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] )->select();
  	}
  	
  	$data["namelike"]=1;
  	$tmp=array();
  
  	foreach ($arr as $v) {
  
  		if($data['is_manual']==1){
  			if($v['interface']==0)
  				$tmp[]=$v;
  		}
  
  
  		if(trim($data['code'])!='' && $v['code']==$data['code']){
  			$tmp=array($v);
  			break;
  		}
  
  		if(trim($data['name'])!=''){
  			if($data['namelike']==1){
  				if(strstr($v['name'],$data['name'])){
  					$tmp[]=$v;
  				}
  			}else{
  				if($v['name']==$data['name']){
  					$tmp[]=$v;
  				}
  			}
  		}
  
  	}
  
  
  	if(trim($data['code'])!='' || trim($data['name'])!='' || intval($data['is_manual'])==1){
  		$arr=$tmp;
  	}
  
  
  	$count = count($arr);
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
  
  	$data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;
  
  	$pageClass = new \Think\Page($count,$page_size);
  	$pageClass->rollPage = 6;
  
  	$data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
  	$data["page_size"] = $page_size;
  
  	foreach($data as $key=>$val) {
  		$this->assign($key, $val);
  	}
  	$html = $this->fetch("Popup:StorageLocation");
  	echo $html;
  }

  // Style1 , @style1 , 规格1(颜色)
  private function Style1() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["code"] = I("get.code");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");
    $data["value"] = explode(',',I("get.value"));
    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Style1-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Style1-PageSize", $page_size);
    $arr = table_Style1();

    if(trim($data['code'])!=''){
      $tmp=array();
      foreach ($arr as $v) {
          if(strstr($v['code'].$v['name'],$data['code'])){
              $tmp[$v['code']]=$v;
              //break;
          }
      }
      $arr=$tmp;
    }

    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Style1");
    echo $html;
  }

  // Style2 , @style2 , 规格2(尺码)
  private function Style2() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["code"] = I("get.code");
    $data["key"] = I("get.key");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");
    $data["value"] = explode(',',I("get.value"));
    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Style2-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Style2-PageSize", $page_size);
    $arr = table_Style2();

      $tmp=array();
      foreach ($arr as $v) {
          if(trim($data['code'])!=''){
		      $tmp=array();
		      foreach ($arr as $v) {
		          if(strstr($v['code'].$v['name'],$data['code'])){
		              $tmp[$v['code']]=$v;
		              //break;
		          }
		      }
		      $arr=$tmp;
		    }
      }
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Style2");
    echo $html;
  }

  // User , @user , 用户
  private function User() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-User-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-User-PageSize", $page_size);
    $arr = table_User();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:User");
    echo $html;
  }

  // Year , @year , 年份
  private function Year() {
    $data["funcid"] = I("get.funcid/s");
    $data["zindex"] = I("get.zindex/d");
    $data["p"] = I("get.p/d");
    $data["selecttype"] = I("get.selecttype");

    //$page_size = I("get.pagesize/d");
    //$page_size = $page_size <= 0 ? session("Popup-Year-PageSize") : $page_size;
    //if(!$page_size) {
    //  $page_size = 20;
    //}
    $page_size = 20;

    session("Popup-Year-PageSize", $page_size);
    $arr = table_Year();
    $count = count($arr);
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

    $data["popupdata"] = array_slice($arr,(($data["p"] - 1) * $page_size),$page_size) ;

    $pageClass = new \Think\Page($count,$page_size);
    $pageClass->rollPage = 6;

    $data["page"] = $pageClass->show_drp_popup($data["funcid"], "");
    $data["page_size"] = $page_size;

    foreach($data as $key=>$val) {
      $this->assign($key, $val);
    }
    $html = $this->fetch("Popup:Year");
    echo $html;
  }
  
  private function SelectProduct(){
  	//stockin、stockout、stockadjust 不用这段
  	$data["funcid"] = I("get.funcid/s");
  	$data["zindex"] = I("get.zindex/d");
  	$data["p"] = I("get.p/d");
  	$data["ordertype"] = I("request.ordertype");
  	$data["orderid"] = I("request.id");
  	$data["selecttype"] = I("get.selecttype");
  	$data["pfuncid"] = I("get.pfuncid");
  	
  	
  	$ordertype_arr=array(
  			'stockadjust'=>array(
  					'submit_url'=>'Home/StockAdjust/index?func=saveSelectProduct',
  					'table'=>'__STOCK_ADJUST_DETAIL__',
  					'join'=>' left join __STOCK_ADJUST_DETAIL__ d on p.id=d.goods_id and d.stock_adjust_id='.$data['orderid'],
  					'field'=>'d.qty as detail_qty',
  			),
  			'purchase'=>array(
  					'submit_url'=>'Home/Purchase/index?func=saveSelectProduct',
  					'table'=>'__PURCHASE_DETAIL__',
  					'join'=>' left join __PURCHASE_DETAIL__ d on p.id=d.goods_id and d.purchase_id='.$data['orderid'],
  					'field'=>'d.qty as detail_qty,d.price as detail_price',
  			),
  			'purchasereturn'=>array(
  					'submit_url'=>'Home/PurchaseReturn/index?func=saveSelectProduct',
  					'table'=>'__PURCHASE_RETURN_DETAIL__',
  					'join'=>' left join __PURCHASE_RETURN_DETAIL__ d on p.id=d.goods_id and d.purchase_return_id='.$data['orderid'],
  					'field'=>'d.qty as detail_qty,d.price as detail_price',
  			),
  			'stockin'=>array(
  					'submit_url'=>'Home/StockIn/index?func=saveSelectProduct',
  					//'table'=>'__STOCK_IN_DETAIL__',
  					//'join'=>' left join __STOCK_IN_DETAIL__ d on p.id=d.goods_id and d.stock_in_id='.$data['orderid'],
  					//'field'=>'d.qty as detail_qty,d.price as detail_price',
  			),
  			'stockout'=>array(
  					'submit_url'=>'Home/StockOut/index?func=saveSelectProduct',
  					//'table'=>'__STOCK_OUT_DETAIL__',
  					//'join'=>' left join __STOCK_OUT_DETAIL__ d on p.id=d.goods_id and d.stock_out_id='.$data['orderid'],
  					//'field'=>'d.qty detail_qty,d.price as detail_price',
  			),
  		);
  	
  	$cur_ordertype=$ordertype_arr[strtolower($data["ordertype"])];
  	$data["submit_url"]=$cur_ordertype['submit_url'];
  	
  	$data ["search"] ["goods_no"] = I ( "get.goods_no" );
  	$data ["search"] ["category_code"] = I ( "get.category_code" );
  	$data ["search"] ["category_code_name"] = I ( "get.category_code_name" );
  	$data ["search"] ["name"] = I ( "get.name" );
  	$data ["search"] ["barcode"] = I ( "get.barcode" );
  	$data ["search"] ["storage_code"] = I ( "get.storage_code" );
  	$data ["search"] ["storage_code_name"] = I ( "storage_code_name" );
  	$data ["search"] ["is_all"] = I ( "is_all" );
  	
  	//$data ["orderid"] = I ( "order_id" );
  	$data ["search"] ["goods_id"] = I ( "p_id/d" );
  	$data ["product_qty"] = I ( "p_qty/d" );
  	$data ["detail_id"] = I ( "d_id/d" );
  	$data ["is_change"] = I ( "change/b" );
  	$data ["product_price"] = I ( "p_price/d" );
  	$where = array ();
  	$stroage_code = "";
//   	if (($data ["search"] ["is_all"]!="1") && !empty($data ["search"] ["shop_code"]) ) {
//   		$model = M ( "shop" );
//   		$stroage_code = $model->where ( array (
//   				"code" => $data ["search"] ["shop_code"]
//   		) )->getField ( 'deliver_storage_code' );
//   		if (!empty($stroage_code)) {
//   			$where ["s.storage_code"] = $stroage_code;
//   		}
//   	}
  	if(!empty($data["search"]["goods_no"])) {
  		$where["p.goods_no"]=$data["search"]["goods_no"];  		
  	} 	
  	
  	
  	if (! empty ( $data ["search"] ["category_code"] )) {
  		$where ["p.category_code"] = array (
  				"in",
  				$data ["search"] ["category_code"]
  		);
  	}
  	
  	if (! empty ( $data ["search"] ["name"] )) {
  		if ($data ["search"] ["name"]) {
  			$where ["p.name"] = array (
  					"like",
  					"%" . $data ["search"] ["name"] . "%"
  			);
  		} else {
  			$where ["p.name"] = $data ["search"] ["name"];
  		}
  	}
  	
  	if (! empty ( $data ["search"] ["barcode"] )) {
  		$where ["p.barcode"] =array (
  				"like", "%" .$data ["search"] ["barcode"]."%") ;
  	}
  	
  	if ($data ["search"] ["goods_id"] > 0) {
  		if ($data ["is_change"]) {
  			$where ["p.id"] = $data ["search"] ["goods_id"];
  		} else {
  			unset($where ["s.storage_code"]);
  			$where ["p.id"] = $data ["search"] ["goods_id"];
  		}
  	}
  	$where2 = "1=1";
  	$st3_order_by="";
  	if($data["ordertype"] == "stockin") {
  		
  	}elseif($data["ordertype"] == "stockout") {
		if (empty ( $data ["search"] ["storage_code"] ) && empty ( $stroage_code )) {
			$join = "left join __STOCK3__ s on p.id=s.goods_id";
		} else {
			$join = "left join __STOCK3__ s on p.id=s.goods_id and s.storage_code='" . $data ["search"] ["storage_code"] . "'";
			// $where2 = "s.qty-s.qty_lock > 0";
		}
  	}else{
  		if(empty($data["search"]["storage_code"])  && empty($stroage_code))
  		{
  			$join="left join __STOCK1__ s on p.id=s.goods_id";
  		}else{
  			$join="left join __STOCK3__ s on p.id=s.goods_id and s.storage_code='". $data["search"]["storage_code"]."'";
  			$where2 = "s.qty-s.qty_lock > 0";
  		
  			//$join="left join __STOCK2__ s on p.id=s.goods_id and s.storage_code='". $data["search"]["storage_code"]."'";
  			//$join="left join __STOCK3__ s on p.id=s.goods_id and s.storage_code='". $data["search"]["storage_code"]."'";
  		}
  	}

    $cur_field="";
  	if($data['orderid']>=0)
  	{
  		$join.=$cur_ordertype['join'];
  		if(!empty($cur_ordertype['field']))
  		{
  			$cur_field.=",".$cur_ordertype['field']." ";
  		}
  		if($data["ordertype"] == "stockout") {
  			$st3_order_by=",cur_qty asc";
  			$cur_field .= ", s.location_code, s.qty - s.qty_lock as cur_qty ";
  		}
  	}
  	
  	$data ["page_size"] = I ( "get.pagesize/d" );
  	$data ["page_size"] = $data ["page_size"] <= 0 ? session ( "selectProduct-PageSize" ) : $data ["page_size"];
  	if (! $data ["page_size"]) {
  		$data ["page_size"] = 8;
  	}
  	session ( "selectProduct-PageSize", $data ["page_size"] );
  	  	
  	$bl=true;
  	if(strtolower($data["ordertype"])=="stockin"){
  		$stock_in=M('stock_in')->where("id='%d'",$data["orderid"])->find();
  		$data ["search"] ["storage_code"]=$stock_in['storage_code'];
  		if($stock_in['type']>0){//非其他类型读取单据来源中的商品
  			$bl=false;
  			if($stock_in['type']==1){//采购入库 
  				$model = M ( "purchase_detail as pd" );
  				$join = "left join __GOODS__ as p on p.id = pd.goods_id " ;  				
  				$where2=" pd.order_no ='".$stock_in['source_no']."'";
  				$model->join ($join)->field("p.id")
  				->where ( $where )->where($where2)->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] );
  				$count = $model->count ();  				
  			}elseif($stock_in['type']==3){
  				$model = M ( "production_qc_detail as pd" );
  				$join = "left join __GOODS__ as p on p.id = pd.goods_id " ;
  				$where2=" pd.order_no ='".$stock_in['source_no']."'";
  				$model->join ($join)->field("p.id")
  				->where ( $where )->where($where2)->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] );
  				$count = $model->count ();
  			}
  		}
  	}elseif(strtolower($data["ordertype"])=="stockout"){
  		$stock_out=M('stock_out')->where("id='%d'",$data["orderid"])->find();
  		if($stock_out['type']>0){//非其他类型读取单据来源中的商品
  			$bl=false;
  			if($stock_out['type']==1){//销售出库
  				$model = M ( "sales_detail as pd" );
  				$join2 = "left join __GOODS__ as p on p.id = pd.goods_id " ;
  				$where2=" pd.order_no ='".$stock_out['source_no']."'";
  				$model->join ($join2)->field("p.id")
  				->where ( $where )->where($where2)->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] );
  				$count = $model->count ();
  			}
  		}
  	}
  	if($bl){
  		$model = M ( "goods as p" )->join ($join)->field("p.id")
  		->where ( $where )->where($where2)->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] );
  		$count = $model->count ();
  	}
  	

  	if ($count < $data ["page_size"])
  		$tmp = 1;
  		else {
  			$tmp = intval ( $count / $data ["page_size"] );
  			if ($count % $data ["page_size"] != 0) {
  				$tmp ++;
  			}
  		}
  		if (! $data ["p"]) {
  			$data ["p"] = 1;
  		}
  	
  		if ($data ["p"] > $tmp) {
  			$data ["p"] = $tmp;
  		}
  		$bl=true;

  	if(strtolower($data["ordertype"])=="stockin"){
  		$stock_in=M('stock_in')->where("id='%d'",$data["orderid"])->find();  		
  		if($stock_in['type']>0){//非其他类型读取单据来源中的商品
  			$bl=false;
  			if($stock_in['type']==1){//采购入库
  				$model = M ( "purchase_detail as pd" );  				
  				$join = "left join __GOODS__ as p on p.id = pd.goods_id " ;
  				$cur_field=",(pd.qty-pd.stock_qty) as detail_qty,pd.price as detail_price ";
  				$where2=" pd.order_no ='".$stock_in['source_no']."'";
  				$model->join ($join)
  				->field ( "p.* $cur_field" )->where ( $where )->where($where2)->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] ); //,s.qty,s.qty_lock,s.qty-s.qty_lock as cur_qty
  			}elseif($stock_in['type']==1){
  				$model = M ( "production_qc_detail as pd" );
  				$join = "left join __GOODS__ as p on p.id = pd.goods_id " ;
  				$cur_field=",(pd.qty-pd.stock_qty) as detail_qty,pd.price as detail_price ";
  				$where2=" pd.order_no ='".$stock_in['source_no']."'";
  				$model->join ($join)
  				->field ( "p.* $cur_field" )->where ( $where )->where($where2)->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] );
  			}
  			$data ["list"] = $model->select ();  			
  		}
  		$cur_field.=",0 detail_qty,p.purchase_price as detail_price ";
  		//其他类型读取goods表  		
  	}elseif(strtolower($data["ordertype"])=="stockout"){
  		$stock_out=M('stock_out')->where("id='%d'",$data["orderid"])->find();
  		if($stock_out['type']>0){//非其他类型读取单据来源中的商品
  			$bl=false;
  			if($stock_out['type']==1){//销售出库
  				$model = M ( "sales_detail as pd" );
  				$join2 = "left join __GOODS__ as p on p.id = pd.goods_id ".$join ;
  				$cur_field.=",(pd.qty-pd.stock_qty) as detail_qty,p.sell_price as detail_price ";
  				$where2=" pd.order_no ='".$stock_out['source_no']."'";
  				$model->join ($join2)
  				->field ( "p.* $cur_field" )->where ( $where )->where($where2)->order("p.id desc".$st3_order_by)->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] ); //,s.qty,s.qty_lock,s.qty-s.qty_lock as cur_qty
  			}
  			$data ["list"] = $model->select ();
  		}
  		$cur_field.=",0 detail_qty,p.sell_price as detail_price ";
  		//其他类型读取goods表
  	}
  	if($bl){  		
  		$model = M ( "goods as p" );
  		$model->join ($join)
  		->field ( "p.* $cur_field" )->where ( $where )->where($where2)->order("p.id desc".$st3_order_by)->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] ); //,s.qty,s.qty_lock,s.qty-s.qty_lock as cur_qty
  		$data ["list"] = $model->select ();
  	}
  		$pageClass = new \Think\Page ( $count, $data ["page_size"] );
  		$pageClass->rollPage = 8;
  		$data ["page"] = $pageClass->show_drp ( $data ["funcid"], "编辑商品信息" );

        if(in_array($data['ordertype'],array('stock_adjust','stockin','stockout'))){
            $table=array('stockin'=>'stock_in','stockout'=>'stock_out');
            $smo = M($table[$data['ordertype']])->where("id='%d'",array($data["orderid"]))->find();
            $data ["storage_location"] = M('storage_location')->where("storage_code = '%s' AND status = '%d' ",array($smo["storage_code"],1))->select();
        }

  		foreach ( $data as $key => $val ) {
  			$this->assign ( $key, $val );
  		}
  		 
  	$html = $this->fetch("Popup:SelectProduct");
  	echo $html;  	
  }

  private function Product(){
  	$data["funcid"] = I("get.funcid/s");
  	$data["zindex"] = I("get.zindex/d");
  	$data["p"] = I("get.p/d");
  
  
  	$data ["search"] ["goods_no"] = I ( "get.goods_no" );
  	$data ["search"] ["category_code"] = I ( "get.category_code" );
  	$data ["search"] ["category_code_name"] = I ( "get.category_code_name" );
  	$data ["search"] ["name"] = I ( "get.name" );
  	$data ["search"] ["barcode"] = I ( "get.barcode" );
  	$data ["search"] ["storage_code"] = I ( "get.storage_code" );
  	$data ["search"] ["storage_code_name"] = I ( "storage_code_name" );
  	$data ["search"] ["is_all"] = I ( "is_all" );
  
  	//$data ["orderid"] = I ( "order_id" );
  	$data ["search"] ["goods_id"] = I ( "p_id/d" );
  	$data ["product_qty"] = I ( "p_qty/d" );
  	$data ["detail_id"] = I ( "d_id/d" );
  	$data ["is_change"] = I ( "change/b" );
  	$data ["product_price"] = I ( "p_price/d" );
  	$where = array ();
  
  
  	if(!empty($data["search"]["goods_no"])) {
  		$where["p.goods_no"]=$data["search"]["goods_no"];
  	}
  
  
  	if (! empty ( $data ["search"] ["category_code"] )) {
  		$where ["p.category_code"] = array (
  				"in",
  				$data ["search"] ["category_code"]
  		);
  	}
  
  	if (! empty ( $data ["search"] ["name"] )) {
  		if ($data ["search"] ["name"]) {
  			$where ["p.name"] = array (
  					"like",
  					"%" . $data ["search"] ["name"] . "%"
  			);
  		} else {
  			$where ["p.name"] = $data ["search"] ["name"];
  		}
  	}
  
  	if (! empty ( $data ["search"] ["barcode"] )) {
  		$where ["p.barcode"] =array (
  				"like", "%" .$data ["search"] ["barcode"]."%") ;
  	}
  
  
  	if(empty($data["search"]["storage_code"])  && empty($stroage_code))
  	{
  		$join="left join __STOCK1__ s on p.id=s.goods_id";
  	}else
  	{
  		$join="left join __STOCK2__ s on p.id=s.goods_id and s.storage_code='". $data["search"]["storage_code"]."'";
  	}
  
  	$cur_field="";
  
  
  	$data ["page_size"] = I ( "get.pagesize/d" );
  	$data ["page_size"] = $data ["page_size"] <= 0 ? session ( "selectProduct-PageSize" ) : $data ["page_size"];
  	if (! $data ["page_size"]) {
  		$data ["page_size"] = 8;
  	}
  	//session ( "selectProduct-PageSize", $data ["page_size"] );
  
  	$model = M ( "goods as p" );
  	$model->where ( $where )->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] );
  	$count = $model->count ();
  
  	if ($count < $data ["page_size"])
  		$tmp = 1;
  		else {
  			$tmp = intval ( $count / $data ["page_size"] );
  			if ($count % $data ["page_size"] != 0) {
  				$tmp ++;
  			}
  		}
  		if (! $data ["p"]) {
  			$data ["p"] = 1;
  		}
  			
  		if ($data ["p"] > $tmp) {
  			$data ["p"] = $tmp;
  		}
  			
  			
  		$model = M ( "goods as p" );
  		$model->join ($join)
  		->field ( "p.*,s.qty,s.qty_lock,s.qty-s.qty_lock as cur_qty $cur_field" )->where ( $where )->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] );
  		$data ["list"] = $model->select ();
  
  		$pageClass = new \Think\Page ( $count, $data ["page_size"] );
  		$pageClass->rollPage = 8;
  		$data ["page"] = $pageClass->show_drp ( $data ["funcid"], "编辑商品信息" );
  
  
  			
  		foreach ( $data as $key => $val ) {
  			$this->assign ( $key, $val );
  		}
  			
  		$html = $this->fetch("Popup:Product");
  		echo $html;
  }

  private function Goods(){
  	$data["funcid"] = I("get.funcid/s");
  	$data["zindex"] = I("get.zindex/d");
  	$data["p"] = I("get.p/d");
  	$data["selecttype"] = I("get.selecttype");
  	
  
  	$data ["search"] ["goods_no"] = I ( "get.goods_no" );
  	$data ["search"] ["category_code"] = I ( "get.category_code" );
  	$data ["search"] ["category_code_name"] = I ( "get.category_code_name" );
  	$data ["search"] ["name"] = I ( "get.name" );
  	$data ["search"] ["barcode"] = I ( "get.barcode" );
  
  	$where = array ();
  
  	if(!empty($data["search"]["goods_no"])) {
  		$where["p.goods_no"]=$data["search"]["goods_no"];
  	}
  
  
  	if (! empty ( $data ["search"] ["category_code"] )) {
  		$where ["p.category_code"] = array (
  				"in",
  				$data ["search"] ["category_code"]
  		);
  	}
  
  	if (! empty ( $data ["search"] ["name"] )) {
  		if ($data ["search"] ["name"]) {
  			$where ["p.name"] = array (
  					"like",
  					"%" . $data ["search"] ["name"] . "%"
  			);
  		} else {
  			$where ["p.name"] = $data ["search"] ["name"];
  		}
  	}
  
  	if (! empty ( $data ["search"] ["barcode"] )) {
  		$where ["p.barcode"] =array (
  				"like", "%" .$data ["search"] ["barcode"]."%") ;
  	}
  
  
  
  	$cur_field="";
  
  
  	$data ["page_size"] = I ( "get.pagesize/d" );
  	$data ["page_size"] = $data ["page_size"] <= 0 ? session ( "selectProduct-PageSize" ) : $data ["page_size"];
  	if (! $data ["page_size"]) {
  		$data ["page_size"] = 8;
  	}
  	//session ( "selectProduct-PageSize", $data ["page_size"] );
  
  	$model = M ( "goods as p" );
  	$model->where ( $where )->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] );
  	$count = $model->count ();
  
  	if ($count < $data ["page_size"])
  		$tmp = 1;
  		else {
  			$tmp = intval ( $count / $data ["page_size"] );
  			if ($count % $data ["page_size"] != 0) {
  				$tmp ++;
  			}
  		}
  		if (! $data ["p"]) {
  			$data ["p"] = 1;
  		}
  			
  		if ($data ["p"] > $tmp) {
  			$data ["p"] = $tmp;
  		}
  			
  			
  		$model = M ( "goods as p" );

  		
  		$data ["list"] = $model->where ( $where )
  		->limit ( ($data ["p"] - 1) * $data ["page_size"], $data ["page_size"] )
  		->select ();
  
  		$pageClass = new \Think\Page ( $count, $data ["page_size"] );
  		$pageClass->rollPage = 8;
  		$data ["page"] = $pageClass->show_drp ( $data ["funcid"], "选择商品信息" );
  
  			
  		foreach ( $data as $key => $val ) {
  			$this->assign ( $key, $val );
  		}
  			
  		$html = $this->fetch("Popup:Goods");
  		echo $html;
  }

}

