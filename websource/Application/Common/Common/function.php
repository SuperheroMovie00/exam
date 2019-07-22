<?php
	
function is_admin_user(){
  	 return ($_SESSION[C('ADMIN_AUTH_KEY')]==true );
}

function dateModifyByStamp($time,$modify='+0 seconds',$retFormat="")
	{
		$ret=false;
		$ret=strtotime($modify,$time);

		if ($ret && trim($retFormat)!='') {
			return date($retFormat,$ret);
		}

		return $ret;

	}

	function dateModifyByString($date,$modify='+0 seconds',$retFormat="")
	{

		return dateModifyByStamp(strtotime($date),$modify,$retFormat);

	}

	function timeFormatisSame($time1,$time2,$format='Y-m-d'){
		$ret = false;

		if (dateModifyByStamp($time1, '+0 seconds', $format) === dateModifyByStamp($time2, '+0 seconds', $format))
			$ret = true;

		return $ret;
	}

	//获取设备状态信息
	function  getDeviceStatus($status)
	{
		$device=D('Home/Device');
		$status_arr=$device->getStatus();
		$arr=array();
		$arr=array_reduce($status_arr, create_function('$v,$w', '$v[$w["id"]]=$w["title"];return $v;'));
	
		//0空闲/1在用/2维护/3失效
		//$arr = array (0 => '空闲',1=>'在用', 2 => '维护', 3 => '失效' );
		return isset ( $arr [$status] ) ? $arr [$status] : '未知状态';
	}
		
	//秒转换成时间 年 天 小时 分钟 秒
	function Sec2Time($time,$type){
		if(is_numeric($time)){
			$value = array(
					"years" => 0, "days" => 0, "hours" => 0,
					"minutes" => 0, "seconds" => 0,
			);
			$set_arr=array("years" => 31556926, "days" =>86400, "hours" =>3600,
					"minutes" => 60,
			);
	
			$is_find=false;
			foreach ($set_arr as $k=>$val)
			{
				if ($type==$k)
				{
					$is_find=true;
				}
				if($is_find)
				{
					if($time >= $set_arr[$k]){
						$value[$k] = floor($time/$set_arr[$k]);
						$time = ($time%$set_arr[$k]);
					}
				}
			}
			$value["seconds"] = floor($time);
			if($value["years"]>0)
			{
				$t.=$value["years"] ."年";
			}
			if($value["days"]>0)
			{
				$t.=$value["days"] ."天";
			}
			if($value["hours"]>0)
			{
				$t.=$value["hours"] ."小时";
			}
			if($value["minutes"]>0)
			{
				$t.=$value["minutes"] ."分钟";
			}
			if($value["seconds"]>0)
			{
				$t.=$value["seconds"] ."秒";
			}
			Return $t;
	
		}else{
			return (bool) FALSE;
		}
	}
	
	
	if(!function_exists("array_column")){
		function array_column($input, $columnKey, $indexKey = NULL){
			$columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;
			$indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;
			$indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;
			$result = array();
	
			foreach ((array)$input AS $key => $row){
				if ($columnKeyIsNumber){
					$tmp = array_slice($row, $columnKey, 1);
					$tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;
				}else{
					$tmp = isset($row[$columnKey]) ? $row[$columnKey] : NULL;
				}
				if (!$indexKeyIsNull){
					if ($indexKeyIsNumber){
						$key = array_slice($row, $indexKey, 1);
						$key = (is_array($key) && ! empty($key)) ? current($key) : NULL;
						$key = is_null($key) ? 0 : $key;
					}else{
						$key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
					}
				}
				$result[$key] = $tmp;
			}
			return $result;
		}
	}
	
	
	/** 格式化时间戳，精确到毫秒，x代表毫秒 */
	function microtime_format($tag, $time)
	{
		list($usec, $sec) = explode(".", $time);
		$date = date($tag,$usec);
		return trim(str_replace('x', $sec, $date),'.');
			
	}
	
	function mydateformat($value,$format="Y-m-d H:i:s")
	{
		$sresult="";
		if(isset($value))
		{
			if(!empty($value))
			{
				if(strtotime($value)>strtotime('1900-01-01 00:00:00'))
				{
		   			$sresult=date($format,strtotime($value));
				}
			}
		}
		return $sresult;
	}
	
	function verify_value($value,$type,$condition = 0, $regulx = "")
	{
		//empty#nagitive#max#min#rangeboth#mobile#email#url#ip4#ip6#reglux
		switch($type)
		{
			case "empty":
				return rtrim(ltrim($value)) != "";
				break;
			case "negitive":
				return floatval($value) >= 0;
				break;
            case "positive":
				return intval($value) > 0;
				break;
			case "max":
				return floatval($value) <= $condition;
			case "min":
				return floatval($value) >= $condition;
			case "rangeboth":
				return true;
			case "mobile":
				$regulx = "/^(1[3,5,7,8][0-9])[0-9]{8}$/isU";
				break;
			case "url":
				$regulx = "/^http([s]?):\/\/.&/iU";
				break;
			case "ip4":
				$regulx="/^((2[0-4]\d|25[0-5]|[01]?\d\d?)\.){3}(2[0-4]\d|25[0-5]|[01]?\d\d?)$/isU";
				break;
			case "ip6":
				return true;
				break;
			case "email":
				$regulx="/^\w+@\w+.\w+$/isU";
				break;
			case "num":
				return is_numeric($value);
				break;
			case "date":
				$unixTime = strtotime($value);
				if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
					return false;
				}else
				{
					return  true;
				}
				break;
			case "datetime":
				$unixTime = strtotime($value);
				if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
					return false;
				}else
				{
					return  true;
				}
				break;
			default:
				return true;
		}
	
		if ($regulx!='')
		{
			$v = preg_match($regulx, $value, $match);
			return $v != 0;
		}
	}
	
	function message($msg) {
		$count = func_num_args();
		$args = func_get_args();
		for($i = 1; $i<$count; $i++) {
			$msg = str_replace("%".$i,$args[$i], $msg);
		}
		return $msg;
	}
	
	function join_condition($condition, $field, $value,$type="char",$opt="=",$skipcheck=0, $join=" AND ")  //opt = > < >= <= like likeleft likeright
	{
		$value=trim($value);
		$value=str_replace("'","", $value);
		$value=str_replace('"',"", $value);
		if (!$skipcheck)
		{
			if($value === "") return $condition ;
		}
		$condition.=" $join ";

		if(!$opt)$opt="=";
	
		$field = table($field); // erp_
		
		if (strtolower($opt)=="in")
		{
			 if(strstr($value, "|")){
			     $opt="in";
			 } else {
			     $opt="=";
			 }
		}else {
		  if(substr($value, 0, 1) == "!") {
			  $opt = "!=";
			  $value = substr($value, 1);
		  }
		}
		switch($type)
		{
			case "int":
			case "decimal":
			case "float":
			case "bool":
				$value = (float)$value;
				if($opt=="both" || $opt=="left" || $opt=="right") $opt="=";
				if($opt=="in") 
				   $condition.=$field." in (".str_replace("|",",", $value).")";
				else
				   $condition.=$field.$opt.$value;
				break;
			case "date":
			case "datetime":
				if(!$value)
					$tmp ="0000/00/00" ;
				else {
					$tmp = strtotime($value);
					$tmp = date("Y-m-d", $tmp);
				}
				$tmp .= " 00:00:00";
				$condition.=$field.$opt."'$tmp'";
				break;
			case "time":
				if(!$value)
				  $tmp ="0000/00/00 00:00:00" ;
				else {
					$tmp = strtotime($value);
					$tmp = "0000/00/00 ".date("H:i:s", $tmp);
				}
				$condition.=$field.$opt."'$tmp'";
				break;
			case "timestamp":
				if(!$value)
					$tmp ="0000/00/00" ;
				else {
					$tmp = strtotime($value);
					$tmp = date("Y-m-d", $tmp);
				}
				$tmp1 = strtotime($tmp ." 00:00:00");
				$tmp2 = strtotime($tmp ." 23:59:59");
				$condition .= "$field >= '$tmp1' AND $field <= '$tmp2'";
				break;
			default:  //char
                $value=str_replace('@',"·mailchar·", $value);
                if($value=="{空}" || $value=="[空]") {
                    $value="";
                    $opt="=";
                }
				//if(!$value) $value="";
				switch($opt)
				{
					case "in":
						$condition .= $field." in ('".str_replace("|","','", $value)."')";
						break;
					case "both":
						$condition .= $field." like '%$value%'";
						break;
					case "left":
						$condition .= $field." like '$value%'";
						break;
					case "right":
						$condition .= $field." like '%$value'";
						break;
					default:
				     if(strstr($value,'%'))
					      $condition .= $field." like '$value'";
				     else{
				         if(strlen($value)>0)
                             $condition .= $field.$opt."'$value'";
				         else{
                             if($opt=="=")
                                 $condition .= "($field $opt '$value' or $field is null)";
                             else
                                 $condition .= "$field $opt '$value'";
                         }
                     }
						break;
				}
				break;
		}
		return  $condition ;
	}
	
	function join_condition2($condition, $field, $value1, $value2,$type="Char") //$istype:Char/NumFloat 2=Date 3
	{
		if($value1 === "" && $value2 === "") return $condition;
		 
		if($value1 !== "" && $value2 === "")
		{
			$condition=join_condition($condition, $field, $value1,$type,"=");
		}
		else if($value1 === "" && $value2 !== "")
		{
			$condition=join_condition($condition, $field, $value2,$type,"=");
		}
		else
		{
			$field = table($field); // erp_
			$condition.=" AND ";
	
			if ($value1>$value2)
			{
				$value=$value1;
				$value1=$value2;
				$value2=$value;
			}
			switch($type)
			{
				case "int":
				case "decimal":
				case "float":
				case "bool":
					$value1 = (float)$value1;
					$value2 = (float)$value2;
					$condition .= $field." between $value1 and $value2";
					break;
				case "date":
				case "datetime":
					$tmp1 = strtotime($value1);
					$tmp1 = date("Y-m-d", $tmp1)." 00:00:00";
					$tmp2 = strtotime($value2);
					$tmp2 = date("Y-m-d", $tmp2)." 23:59:59";
					$condition .= $field." between '$tmp1' and '$tmp2'";
					break;
				case "time":
					$tmp1 = strtotime($value1);
					$tmp1 = "0000/00/00 ".date("H:i:s", $tmp1);
					$tmp2 = strtotime($value2);
					$tmp2 = "0000/00/00 ".date("H:i:s", $tmp2);
					$condition .= $field." between '$tmp1' and '$tmp2'";
					break;
				case "timestamp":
					$tmp1 = strtotime($value1);
					$tmp1 = strtotime(date("Y-m-d", $tmp1)." 00:00:00");
					$tmp2 = strtotime($value2);
					$tmp2 = strtotime(date("Y-m-d", $tmp2)." 23:59:59");
					$condition .= $field." between '$tmp1' and '$tmp2'";
					break;
				default:
		      $value1=str_replace('@',"·mailchar·", $value1);
		      $value2=str_replace('@',"·mailchar·", $value2);

					$condition .= $field." between '$value1' and '$value2'";
					break;
			}
		}

		//echo "condition=$condition ";
		return  $condition ;
	}

	
	function join_condition_shop($condition, $field, $login_auth_id, $search_auth_id, $auth_condition) {
        if($auth_condition ){
            $customer_tree="(select customer_id from @customer_tree where parent_id=$login_auth_id)";
            $auth_condition = str_replace("#login_customer_id#", $login_auth_id,$auth_condition );
            $auth_condition = str_replace("#customer_tree#", $customer_tree,$auth_condition );
        }
        if($login_auth_id){
            if($auth_condition )
                $condition .= " AND $auth_condition ";
            else
                $condition .= " AND $field=$login_auth_id";
        }
        if($search_auth_id){
            $condition .= " AND $field=$search_auth_id";
        }

		return $condition;

		if(!is_array($search_auth_id)) $search_auth_id = array();
		
		if($_SESSION[C('ADMIN_AUTH_KEY')]!=true)
		{
			$s = explode(",", $login_auth_id);
			foreach($s as $v) {
				if(!in_array($v, $search_auth_id)) {
					$search_auth_id[] = $v;
				}
			}
		}
		if(empty($search_auth_id))
			return $condition;
		
		$shop = table_Shop();
		
		if(count($search_auth_id) != count($shop)) {
			if(count($search_auth_id) == 1) {
				$condition .= " AND $field = ".$search_auth_id[0];
			} else {
				$condition .= " AND $field IN (" . join(",", $search_auth_id) .")";
			}
		}
		return $condition;
	}
	
	function table($sql)
	{
		$pre = C("DB_PREFIX");
		return str_replace("@",$pre, $sql);
	}
	
	function joinfield($fields,$field)
	{
		if($field)
		{
			if($fields) $fields.=",";
			$fields.=$field;
		}
		return $fields;
	}
	
	function get_array_value($key, $name = "") {
		$data= table_shop();
		if(is_array($data)) {
			if(!empty($data)) {
				if(isset($data[$key])) {
					if($name != "" && isset($data[$key][$name]))
						return $data[$key][$name];
					else
						return $data[$key];
				} else {
					foreach($data as $k=>$v) {
						if($v["id"] == $key) {
							if($name != "" && isset($v[$name]))
								return $v[$name];
							else
								return $v;
						}
					}
				}
			}
		} else {
			return $data;
		}
		
		return "你调用错了";
	}
	
	function OverView($str,$len,$prefix) {
		if(mb_strlen($str) > $len) {
			$str = mb_substr($str, 0, $len, "utf-8");
			$str .= $prefix;
		}
		return $str;
	}

	function filterFuncId($str, $funcid="") {

        $str=strtolower($str);
        $funcid=strtolower($funcid);

		$f = array();
		$data = explode("&", $funcid);
		foreach($data as $d) {
			list($key,$val) = explode("=", $d);
			$f[$key] = $val;
		}
	
		ksort($f);

        $k = "";
		foreach ($f as $c) {
			$o = trim($c);
			if($o == "") {
				continue;
			}
			if(!empty($k)) $k .= "_";
			$k .= $c;
		}
		return "f_".(md5($str.$k));
	}
	
function nonEmpty($value,&$msg){	
    $msg=(trim($value)==''?'不能为空':true);   
    return $msg;
}

function isMobile($value,&$msg){
    $msg=(!preg_match("/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/", $value))?"不正确":true;
    return $msg;
}

function maxLength($value,$length,&$msg){
    $msg=mb_strlen($value)>$length?('字符不能超过'.$length):true;
    return $msg;
}


function check_code($table,$code,&$msg){	
    $r=M($table)->where("code='%s'",array($code))->find();
    $msg=(empty($r)?true:"已存在");
    return $msg;
}

function check_customize($table,$code,$field,&$msg){
    $r=M($table)->where("$field='%s'",array($code))->find();
    $msg=(empty($r)?true:"已存在");
    return $msg;
}

function check_customize_id($table,$code,$field,$id,&$msg){
	$r=M($table)->where("$field='%s' AND id<>'%d'",array($code,$id))->find();
	$msg=(empty($r)?true:"已存在");
	return $msg;
}

function check_name($table,$name,$id,&$msg){
    $r=M($table)->where("name='%s' AND id<>'%d'",array($name,$id))->select();
    $msg=(count($r)<1?true:"已存在");
    return $msg;
}
function check_short_name($table,$name,$id,&$msg){
	$r=M($table)->where("short_name='%s' AND id<>'%d'",array($name,$id))->select();
	$msg=(count($r)<1?true:"已存在");
	return $msg;
}
function check_full_name($table,$name,$id,&$msg){
	$r=M($table)->where("full_name='%s' AND id<>'%d'",array($name,$id))->select();
	$msg=(count($r)<1?true:"已存在");
	return $msg;
}
function check_cc_code($table,$name,$pid,&$msg){
	$bl=true;
    if(intval($pid)==0){
        return "";
    }

    if(intval($pid)<=0){
		$msg= "上一级必填";
		$bl=false;
	}
	$cate=M('customer_category')->where("id='%s'",array($pid))->find();
	$level=$cate['level']+1;	 
	if($bl){
		if(preg_match('/[\x{4e00}-\x{9fa5}]+/u',$name)){
			$msg= "不能输入中文";
			$bl=false;
		}
	}
	if($bl){
		$strlength=$level*2;
		if(strlen($name)!= $strlength){			
			$msg= "不符合规范,长度应为".$strlength."位";
			$bl=false;
		}
	}
	if($bl){
		if(substr($name,0,-2)!= $cate['code']){
			$msg= "3不符合规范,前缀必须是".$cate['code'];
			$bl=false;
		}
	}	
	return $msg;
}

function isNumber($value,&$msg){
    $msg=is_numeric($value)?true:'不是数字';
    return $msg;
}

function check_modify($table,$value,$id,$field,&$msg){
    $r=M($table)->where("id='%d'",array($id))->find();
    $msg=($r[$field]==$value?true:"已被修改");
    return $msg;
}

function check_code_list($code,$name,$table){
    $msg='';
    foreach ($name as $k=>$v) {
        $r= M($table)->where("name='%s'",array($v))->find();
        if(!empty($r) && trim($r['code'])!=trim($code[$k]))
            $msg.='名称['.$v.']与代码['.$code[$k].']不匹配';
    }

    return trim($msg)==''?true:$msg;
}

function notSelf($table,$value,$id,&$msg){
    $msg=($value==$id?'不能与自己相同':true);
    return $msg;
}


function checkPassword($pwd,$id,&$msg){
    $msg=true;

    if(strlen($pwd)<6)
        $msg='长度不能小于6位';

//    if(strtolower($pwd)==$pwd || strtoupper($pwd)==$pwd)
//        $msg='密码必须有大小写混合';

//    if(!preg_match('!([a-zA-Z]+\d+)+|(\d+[a-zA-Z]+)+!',$pwd))
//        $msg='必须有英文和数字混合';

//    if(!preg_match("![-=@#$%^&*()_+~,.?;:<>'\"/\\\[\]\|]+!",$pwd,$match))
//        $msg='必须要有特殊字符';

    $keyboardList=array(
        'qwertyuiop',
        "asdfghjkl;'",
        'zxcvbnm,./',
        '1qaz2wsx3edc4rfv5tgb6yhn7ujm8ik,9ol.0p;/',
    );

    foreach ($keyboardList as $v) {
        $keyboardList[]=strrev($v);
    }

    foreach ($keyboardList as $v) {
        if(!getMaxLengthSubString($v,$pwd)){
            $msg='不能使用键盘上的连续字符';
            break;
        }
    }

    $u=M('user')->where("id='%d'",array($id))->find();

    if(!getMaxLengthSubString($u['code'],$pwd,strlen($u['code']))){
        $msg='请不要使用和用户名相关的信息';
    }
//    var_dump(getMaxLengthSubString($u['code'],$pwd,4));exit;

    return $msg;
}

function getMaxLengthSubString($str1,$str2,$max=3,$case=true){

    $len1=strlen($str1);
    $len2=strlen($str2);

    if(!$case){
        $str1=strtolower($str1);
        $str2=strtolower($str2);
    }

    $list=array();
    for($i=0;$i<$len1;$i++){
        for($j=0;$j<$len2;$j++){
            if($str1[$i]==$str2[$j]){
                $list[]=$i;
            }
        }
    }

    $result=true;
    $count=0;
    $last=intval($list[0])-1;

    foreach ($list as $v) {
        if($last+1==$v){
            $last=$v;
            $count++;
        }else{
            $last=$v;
            $count=1;
        }

        if($count>=$max){
            $result=false;
            break;
        }


    }

    return $result;

}

function comparison__date($table,$date1,$date2,$date2_label,$symbol,&$msg){
    $msg=true;
    switch($symbol){
        case 'g':
            $msg=(($date1>$date2)?true:'应大于'.$date2_label);
            break;
        case 'l':
            $msg=(($date1<$date2)?true:'应小于'.$date2_label);
            break;
        case 'ge':
            $msg=(($date1>=$date2)?true:'应不小于'.$date2_label);
            break;
        case 'le':
            $msg=(($date1<=$date2)?true:'应不大于'.$date2_label);
            break;
        case 'e':
            $msg=(($date1==$date2)?true:'与'.$date2_label.'不相等');
            break;
    }

    return $msg;
}

function getTitleName($name){

    $title=array(
        'Activity'=>"活动",
        'Area'=>"地区",
        'Brand'=>"品牌",
        'Category'=>"分类",
        'Customer'=>"供应商",
        'Deliver'=>"快递",
        'Department'=>"部门",
        'HangupTag'=>"挂起",
        'OrderSwitch'=>"转单",
        'OrderTag'=>"订单标签",
        'Payment'=>"支付方式",
        'Platform'=>"销售平台",
        'ReturnReason'=>"退货原因",
        'Season'=>"季节",
        'Shop'=>"店铺",
        'Storage'=>"仓库",
        'Style1'=>"颜色",
        'Style2'=>"尺码",
        'User'=>"用户",
        'Year'=>"年份",


    );

    return $title[$name];
}

	class PlatformType {
		public static $TB = "taobao";
		public static $JD = "jingdong";
		public static $TM = "TM";
		public static $QT = "QT";
	}
	
	class OrderType {
		public static $web = 1;
		public static $sales = 2;
		public static $purchase = 3;
		public static $stockIn = 4;
		public static $stockOut = 5;
		public static $move = 6;
		public static $adjustment = 7;
		public static $check = 8;
		public static $apiupdate = 9;
	}
	
	class ConfirmType {
		public static $message_buyer = 1;
		public static $message_seller = 2;
		public static $buyer_blacklist = 3;
		public static $invoiced = 4;
		public static $area_foreign = 5;
		public static $area_gangaotai = 6;
		public static $change_makeup_pay = 7;
		public static $change_jingdong = 8;
		public static $problem_address = 9;
		public static $goods_forpost = 10;
		public static $refund_all = 11;
		public static $refund_partial = 12;
		public static $manual_order = 13;
	}
	
	function getConfirmTypeInfo() {
		return $ConfirmTypeInfo = array(
				ConfirmType::$message_buyer =>array("control"=>false, "msg"=>"存在买家留言"),
				ConfirmType::$message_seller => array("control"=>false, "msg"=>"存在卖家留言"),
				ConfirmType::$buyer_blacklist => array("control"=>false, "msg"=>"买家在黑名单中"),
				ConfirmType::$invoiced => array("control"=>false, "msg"=>"需要开发票"),
				ConfirmType::$area_foreign => array("control"=>false, "msg"=>"外国订单"),
				ConfirmType::$area_gangaotai => array("control"=>false, "msg"=>"港澳台订单"),
				ConfirmType::$change_makeup_pay => array("control"=>false, "msg"=>"换货补款"),
				ConfirmType::$change_jingdong => array("control"=>false, "msg"=>"京东换货"),
				ConfirmType::$problem_address => array("control"=>false, "msg"=>"地址问题"),
				ConfirmType::$goods_forpost => array("control"=>false, "msg"=>"存在补邮商品"),
				ConfirmType::$refund_all => array("control"=>false, "msg"=>"申请退款(整单)"),
				ConfirmType::$refund_partial => array("control"=>false, "msg"=>"申请退款(部分)")
		);
	}
	
	function incqtyon($goods_id, $order_id, $ordertype, $qty, $trans = false) {
		if($trans) {
			M()->startTrans();
		}
		
		$where_stock1 = "goods_id = $goods_id";
		
		$obj_stock1 = M("stock1");
		
		$stock1 = $obj_stock1->where($where_stock1)->find();
		$goods = M("goods")->where("id = $goods_id")->find();
		if(empty($stock1)) {
			$data = array();
			$data["goods_id"] = $goods_id;
			$data["goods_no"] = $goods["goods_no"];
			$data["qty_in"] = 0;
			$data["qty_out"] = 0;
			$data["qty"] = 0;
			$data["qty_lock"] = 0;
			$data["qty_on"] = $qty;
			$data["modify_time"] = date("Y-m-d H:i:s");
			
			M("stock1")->add($data);
		} else {
			$update = array(
					"qty_on" => array("exp", "qty_on + $qty")
			);
			$obj_stock1->where($where_stock1)->save($update);
		}
		
		if($trans) {
			M()->commit();
		}
		
		return true;
	}
	
	function decqtyon($goods_id, $order_id, $ordertype, $qty, $trans = false) {
		if($trans) {
			M()->startTrans();
		}

		$where_stock1 = "goods_id = $goods_id";
		
		$obj_stock1 = M("stock1");
		$stock1 = $obj_stock1->where($where_stock1)->find();
		if(empty($stock1)) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}
		
		$update = array(
				"qty_on" => array("exp", "qty_on - $qty")
		);
		
		$obj_stock1->where($where_stock1)->save($update);
		
		if($trans) {
			M()->commit();
		}
		
		return true;
	}
	
	function decqtyonandincstock($storage_id, $location_code, $goods_id, $order_id, $order_no, $ordertype, $qty, $trans = false, &$err) {
		if($trans) {
			M()->startTrans();
		}

		
		$where_stock1 = "goods_id = $goods_id";
		
		$obj_stock1 = M("stock1");
		$stock1 = $obj_stock1->where($where_stock1)->find();
		if(empty($stock1)) {
			$err="stock1 not found"; 
			if($trans) {
				M()->rollback();
			}
			return false;
		}
		
		$update = array(
				"qty_on" => array("exp", "qty_on - $qty")
		);
		
		$obj_stock1->where($where_stock1)->save($update);
		
		if(!incstock($storage_id, $location_code, $goods_id, $order_id, $order_no, $ordertype, $qty, false,false,$err)) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}
		
		if($trans) {
			M()->commit();
		}
		
		return true;
	}
	
	function incstock($storage_id, $location_code, $goods_id, $order_id, $order_no, $ordertype, $qty, $trans = false, $nagitive = false, &$err) {
     return stock($storage_id, $location_code,$goods_id, $order_id, $order_no, $ordertype, $qty, true, $trans, $nagitive, $err);
	}
	
	function decstock($storage_id, $location_code, $goods_id, $order_id, $order_no, $ordertype, $qty, $trans = false, $nagitive = false, &$err) {
    return stock($storage_id, $location_code, $goods_id, $order_id, $order_no, $ordertype, $qty, false, $trans, $nagitive, $err);
	}
	
	/*
	function lockstock($storage_id, $goods_id, $product_id, $order_id, $order_no, $ordertype, $qty, $trans = false) {
		return stock($storage_id, $goods_id, $product_id, $order_id, $order_no, $ordertype, 0, $qty, true, $trans);
	}
	
	function releasestock($storage_id, $goods_id, $product_id, $order_id, $order_no, $ordertype, $qty, $trans = false) {
		return stock($storage_id, $goods_id, $product_id, $order_id, $order_no, $ordertype, 0, $qty, false, $trans);
	}
	
	function releaseanddecstock($storage_id, $goods_id, $product_id, $order_id, $order_no, $ordertype, $qty, $trans = false) {
		return stock($storage_id, $goods_id, $product_id, $order_id, $order_no, $ordertype, $qty, $qty, false, $trans);
	}
	*/
	
	function gettradeno($order_id, $ordertype) {
		switch ($ordertype) {
			case OrderType::$web = 1;
				return M("web_trade")->where("id = $order_id")->getField("trade_no");
			case OrderType::$sales = 2;
				return M("sales")->where("id = $order_id")->getField("trade_no");
			case OrderType::$purchase = 3;
				return "";
			case OrderType::$stockIn = 4;
				return "";
			case OrderType::$stockOut = 5;
				return "";
			case OrderType::$move = 6;
				return "";
			case OrderType::$adjustment = 7;
				return "";
			case OrderType::$check = 8;
				return "";
			case OrderType::$apiupdate = 9;
				return "";
			break;
		}
	}
	
	function stock1_lock($goods_id, $order_id, $order_no, $ordertype, $lock, $trans = false) {
		if($trans) {
			M()->startTrans();
		}
		$goods = M("goods")->field("goods_no, name, barcode, style_info, barcode, sell_price")->where("id = ".$goods_id)->find();
		if(empty($goods)) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}

		$where_stock1 = "goods_id = $goods_id";
		$obj_stock1 = M("stock1");
		$stock1 = $obj_stock1->field("qty, qty_lock")->where($where_stock1)->find();
		if(empty($stock1)) {
			$data["goods_id"] = $goods_id;
			$data["goods_no"] = $goods["goods_no"];
			$data["qty"] = 0;
			$data["qty_lock"] = 0;
			$data["qty_miss"] = 0;
			$data["qty_in"] = 0;
			$data["qty_out"] = 0;
			$data["price"] = $goods["sell_price"];
			$data["qty_on"] = 0;
			$data["modify_time"] = date("Y-m-d H:i:s");
			
			$tmp = $obj_stock1->add($data);
			if(!$tmp) {
				if($trans) {
					M()->rollback();
				}
				return false;
			}
		}
		
		$stock_qty_lock = intval($stock1["qty_lock"]);
		$stock_qty = intval($stock1["qty"]);
		
		if($stock_qty_lock + $lock < 0) {
			if($trans) {
				M()->commit();
			}
			return true;
		}
		
		$update = array(
				"qty_lock" => array("exp", "qty_lock + $lock")
		);
		
		if($stock_qty_lock + $lock > $stock_qty) {
			$update["qty_miss"] = array("exp", "qty_lock - qty");
		} else {
			$update["qty_miss"] = 0;
		}
		
		$tmp = $obj_stock1->where($where_stock1)->save($update);
		if($tmp != 1) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}
		
		$data = array();
		$data["goods_id"] = $goods_id;

		$data["goods_no"] = $goods["goods_no"];
		$data["goods_name"] = $goods["name"];
		$data["style_info"] = $goods["style_info"];
		$data["barcode"] = $goods["barcode"];
		
		$data["order_id"] = $order_id;
		$data["order_no"] = $order_no;
		$data["type"] = $ordertype;
		
		$data["qty"] = intval($stock1["qty"]);
		$data["cur_lock"] = $lock;
		$data["qty_lock"] = intval($stock1["qty_lock"]) + $lock;
		
		$data["create_time"] = date("Y-m-d H:i:s");
		$data["create_user"] = session(C("USER_AUTH_KEY"));
		
		M("stock_movement1")->add($data);
		
		if($trans) {
			M()->commit();
		}
		
		return true;
	}
	
	function stock1_releaselock($goods_id, $order_id, $order_no, $ordertype, $lock, $trans = false) {
		return stock1_lock($goods_id, $order_id, $order_no, $ordertype, $lock * -1, $trans = false);
	}
	
	function stock2_lock($storage_id, $goods_id, $order_id, $order_no, $ordertype, $lock, $trans = false) {
		if($trans) {
			M()->startTrans();
		}

		$goods = M("goods")->field("goods_no, name, barcode, style_info, barcode, sell_price")->where("id = ".$goods_id)->find();
		if(empty($goods)) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}

		$where_stock2 = "storage_id = $storage_id AND goods_id = $goods_id";
		$obj_stock2 = M("stock2");
		$stock2 = $obj_stock2->field("qty, qty_lock")->where($where_stock2)->find();
		if(empty($stock2)) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}
		
		$storage_code = M("storage")->where("id = $storage_id")->getField("code");
		if(empty($storage_code)) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}
		
		$stock_qty_lock = intval($stock2["qty_lock"]);
		$stock_qty = intval($stock2["qty"]);
		
		if($stock_qty_lock + $lock < 0) {
			if($trans) {
				M()->commit();
			}
			return true;
		}
		
		$update = array(
				"qty_lock" => array("exp", "qty_lock + $lock")
		);
		
		$tmp = $obj_stock2->where($where_stock2)->save($update);
		if($tmp != 1) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}
// 		$update = array(
// 				"qty_miss" => array("exp", "qty_lock - qty")
// 		);
		
// 		$where_stock2 .= " AND qty_lock > qty";
// 		$obj_stock2->where($where_stock2)->save($update);
		
		$data = array();
		$data["goods_id"] = $goods_id;
		$data["storage_code"] = $storage_code;
		$data["goods_no"] = $goods["goods_no"];
		$data["goods_name"] = $goods["name"];
		$data["style_info"] = $goods["style_info"];
		$data["barcode"] = $goods["barcode"];
		
		$data["order_id"] = $order_id;
		$data["order_no"] = $order_no;
		$data["type"] = $ordertype;
		
		$data["qty"] = $stock2["qty"];
		$data["cur_lock"] = $lock;
		$data["qty_lock"] = $stock2["qty_lock"] + $lock;
		
		$data["create_time"] = date("Y-m-d H:i:s");
		$data["create_user"] = session(C("USER_AUTH_KEY"));
		
		M("stock_movement2")->add($data);
		
		if($trans) {
			M()->commit();
		}
		
		return true;
	}
	
	function stock2_releaselock($storage_id, $goods_id, $order_id, $order_no, $ordertype, $lock, $trans = false) {
		return stock2_lock($storage_id, $goods_id, $order_id, $order_no, $ordertype, $lock * -1, $trans = false);
	}
	
	function stock3_lock($storage_id, $location_code, $goods_id, $order_id, $order_no, $ordertype, $lock, $trans = false) {
		if($trans) {
			M()->startTrans();
		}

		$goods = M("goods")->field("goods_no, name, barcode, style_info, barcode, sell_price")->where("id = ".$goods_id)->find();
		if(empty($goods)) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}

		$where_stock3 = "storage_id = $storage_id AND location_code = '$location_code' AND goods_id = $goods_id";
		$obj_stock3 = M("stock3");
		$stock3 = $obj_stock3->field("qty, qty_lock")->where($where_stock3)->find();
		if(empty($stock3)) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}
		
		$storage_code = M("storage")->where("id = $storage_id")->getField("code");
		if(empty($storage_code)) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}
		
		$stock_qty_lock = intval($stock3["qty_lock"]);
		$stock_qty = intval($stock3["qty"]);
		
		if($stock_qty_lock + $lock < 0) {
			if($trans) {
				M()->commit();
			}
			return true;
		}
		
		$update = array(
				"qty_lock" => array("exp", "qty_lock + $lock")
		);
		
		$tmp = $obj_stock3->where($where_stock3)->save($update);
		if($tmp != 1) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}
		
		if(!stock2_lock($storage_id, $goods_id, $order_id, $order_no, $ordertype, $lock, $trans)) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}

		if(!stock1_lock($goods_id, $order_id, $order_no, $ordertype, $lock, $trans)) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}
		
		$data = array();
		$data["storage_code"] = $storage_code;
		$data["location_code"] = $location_code;
		$data["goods_id"] = $goods_id;
		$data["goods_no"] = $goods["goods_no"];

		$data["goods_name"] = $goods["name"];
		$data["style_info"] = $goods["style_info"];
		$data["barcode"] = $goods["barcode"];
		
		$data["order_id"] = $order_id;
		$data["order_no"] = $order_no;
		$data["type"] = $ordertype;
		
		$data["qty"] = $stock3["qty"];
		$data["cur_lock"] = $lock;
		$data["qty_lock"] = $stock3["qty_lock"] + $lock;
				
		$data["create_time"] = date("Y-m-d H:i:s");
		$data["create_user"] = session(C("USER_AUTH_KEY"));
		
		M("stock_movement3")->add($data);
		
		if($trans) {
			M()->commit();
		}
		
		return true;
	}
	
	function stock3_releaselock($storage_id, $location_code, $goods_id, $order_id, $order_no, $ordertype, $lock, $trans = false) {
		return stock3_lock($storage_id, $location_code, $goods_id, $order_id, $order_no, $ordertype, $lock * -1, $trans = false);
	}
	
	function stock_releaselock($storage_id, $location_code, $goods_id, $order_id, $order_no, $ordertype, $lock, $trans = false) {
		$lock = $lock * -1;
		if(stock1_releaselock($goods_id, $order_id, $order_no, $ordertype, $lock, $trans)) {
			if(stock3_releaselock($storage_id, $location_code, $goods_id, $order_id, $order_no, $ordertype, $lock)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	function stock($storage_id, $location_code, $goods_id, $order_id, $order_no, $ordertype, $qty, $stock_in = false, $trans = false, $nagitive = false, &$errnumber=0) {
     $errnumber=0;
     
		if($trans) {
			M()->startTrans();
		}

		if($stock_in && $location_code == "") {
			$errnumber=10000  ;
			return false;
		}

		$goods = M("goods")->field("goods_no, name, barcode, style_info, barcode, sell_price")->where("id = ".$goods_id)->find();
		if(empty($goods)) {
			if($trans) {
				M()->rollback();
			}
			$errnumber=10001  ;
			return false;
		}
		
		$where_stock1 = "goods_id = $goods_id";
		$where_stock2 = "storage_id = $storage_id AND goods_id = $goods_id";
		$where_stock3 = "storage_id = $storage_id AND location_code = '$location_code' AND goods_id = $goods_id";
		
		$obj_stock1 = M("stock1");
		$obj_stock2 = M("stock2");
		$obj_stock3 = M("stock3");

		$stock1 = $obj_stock1->where($where_stock1)->find();
		
		if(!$stock_in) {
			if(empty($stock1)) {
				if($trans) {
					M()->rollback();
				}
			  $errnumber=10002  ;
				return false;
			}
		}

		$stock2 = $obj_stock2->where($where_stock2)->find();
		if(!$stock_in) {
			if(empty($stock2)) {
				if($trans) {
					M()->rollback();
				}
			  $errnumber=10003  ;
				return false;
			}
		}
		
		$stock3 = $obj_stock3->where($where_stock3)->find();
		
		if(!$stock_in) {
			if(empty($stock3)) {
				if($trans) {
					M()->rollback();
				}
			  $errnumber=10004  ;
				return false;
			}
		}
		

		
		$stock_qty_lock = intval($stock1["qty_lock"]);
		$stock_qty = intval($stock1["qty"]);
		if(!$nagitive) {
			if($stock_in) {
				if($stock_qty + $qty < 0) {
					if($trans) {
						M()->rollback();
					}
			    $errnumber=10005  ;
					return false;
				}
			} else {
				if($stock_qty - $qty < 0) {
					if($trans) {
						M()->rollback();
					}
			    $errnumber=10006  ;
					return false;
				}
			}
		}

		$stock_qty_lock = intval($stock2["qty_lock"]);
		$stock_qty = intval($stock2["qty"]);
		if(!$nagitive) {
			if($stock_in) {
				if($stock_qty + $qty < 0) {
					if($trans) {
						M()->rollback();
					}
			    $errnumber=10007  ;
					return false;
				}
			} else {
				if($stock_qty - $qty < 0) {
					if($trans) {
						M()->rollback();
					}
			    $errnumber=10008  ;
					return false;
				}
			}
		}
		
		$stock_qty_lock = intval($stock3["qty_lock"]);
		$stock_qty = intval($stock3["qty"]);
		if(!$nagitive) {
			if($stock_in) {
				if($stock_qty + $qty < 0) {
					if($trans) {
						M()->rollback();
					}
			    $errnumber=10009  ;
					return false;
				}
			} else {
				if($stock_qty - $qty < 0) {
					if($trans) {
						M()->rollback();
					}
			    $errnumber=10010  ;
					return false;
				}
			}
		}
		

		$storage_code = M("storage")->where("id = $storage_id")->getField("code");
		
		if(empty($stock3)) {
			$data = array();
			$data["storage_id"] = $storage_id;
			$data["storage_code"] = $storage_code;
			$data["location_code"] = $location_code;
			$data["goods_id"] = $goods_id;
			$data["goods_no"] = $goods["goods_no"];
			$data["price"] = $goods["sell_price"];
			$data["qty_in"] = $qty;
			$data["qty_out"] = 0;
			$data["qty"] = $qty;
			$data["qty_lock"] = 0;
			$data["qty_on"] = 0;
			$data["modify_time"] = date("Y-m-d H:i:s");
			
			M("stock3")->add($data);
		} else {
			if($stock_in) {
				$update = array(
						"qty_in" => array("exp", "qty_in + $qty"),
						"qty" => array("exp", "qty + $qty"),
				);
			} else {
				$update = array(
						"qty_out" => array("exp", "qty_out + $qty"),
						"qty" => array("exp", "qty - $qty"),
				);
			}
				
			$update["modify_time"] = date("Y-m-d H:i:s");
				
			$tmp = $obj_stock3->where($where_stock3)->save($update);
			if($tmp !== 1) {
				if($trans) {
					M()->rollback();
				}
			  $errnumber=10011  ;
				return false;
			}
			
		}
		
		
		if(empty($stock2)) {
			$data = array();
			$data["storage_id"] = $storage_id;
			$data["storage_code"] = $storage_code;
			$data["goods_no"] = $goods["goods_no"];
			$data["goods_id"] = $goods_id;
			$data["qty_in"] = $qty;
			$data["qty_out"] = 0;
			$data["qty"] = $qty;
			$data["qty_lock"] = 0;
			$data["qty_on"] = 0;
			$data["modify_time"] = date("Y-m-d H:i:s");
			
			M("stock2")->add($data);
		} else {
			if($stock_in) {
				$update = array(
					"qty_in" => array("exp", "qty_in + $qty"),
					"qty" => array("exp", "qty + $qty"),
				);
			} else {
				$update = array(
					"qty_out" => array("exp", "qty_out + $qty"),
					"qty" => array("exp", "qty - $qty"),
				);
			}
			
			$update["modify_time"] = date("Y-m-d H:i:s");
			
			$tmp = $obj_stock2->where($where_stock2)->save($update);
			if($tmp !== 1) {
				if($trans) {
					M()->rollback();
				}
			  $errnumber=10012  ;
				return false;
			}
		}

		if(empty($stock1)) {
			$data = array();
			$data["goods_id"] = $goods_id;
			$data["goods_no"] = $goods["goods_no"];
			$data["qty_in"] = $qty;
			$data["qty_out"] = 0;
			$data["qty"] = $qty;
			$data["qty_lock"] = 0;
			$data["qty_on"] = 0;
			$data["modify_time"] = date("Y-m-d H:i:s");
			
			M("stock1")->add($data);
		} else {
			if($stock_in) {
				$update = array(
						"qty_in" => array("exp", "qty_in + $qty"),
						"qty" => array("exp", "qty + $qty"),
				);
			} else {
				$update = array(
						"qty_out" => array("exp", "qty_out + $qty"),
						"qty" => array("exp", "qty - $qty"),
				);
			}
			$update["modify_time"] = date("Y-m-d H:i:s");
			$tmp = $obj_stock1->where($where_stock1)->save($update);
			if($tmp !== 1) {
				if($trans) {
					M()->rollback();
				}
			  $errnumber=10013  ;
				return false;
			}
		}

		$data = array();
		$data["storage_code"] = $storage_code;
		$data["goods_id"] = $goods_id;
		$data["goods_no"] = $goods["goods_no"];
		$data["goods_name"] = $goods["name"];
		$data["style_info"] = $goods["style_info"];
		$data["barcode"] = $goods["barcode"];
		
		$data["order_id"] = $order_id;
		$data["order_no"] = $order_no;
		$data["type"] = $ordertype;
		
		if($qty != 0) {
			if($stock_in) {
				$data["qty_in"] = $qty;
				$data["is_stockout"] = 0;
			} else {
				$data["qty_out"] = $qty;
				$data["is_stockout"] = 1;
			}
		} else {
			$data["qty_in"] = 0;
			$data["qty_out"] = 0;
			$data["is_stockout"] = 0;
		}
		
		$data["create_time"] = date("Y-m-d H:i:s");
		$data["create_user"] = session(C("USER_AUTH_KEY"));

		$st2 = $obj_stock2->field("qty, qty_lock")->where($where_stock2)->find();
		$data["qty"] = $st2["qty"];
		$data["qty_lock"] = $st2["qty_lock"];
		M("stock_movement2")->add($data);

		$data["location_code"] = $location_code;
		$st3 = $obj_stock3->field("qty, qty_lock")->where($where_stock3)->find();
		$data["qty"] = $st3["qty"];
		$data["qty_lock"] = $st3["qty_lock"];
		M("stock_movement3")->add($data);
		
		if($trans) {
			M()->commit();
		}
		return true;
	}
	
	function GenOrderNo($table, $gettype= false, &$prefix="")
	{
		$prefix="WMS-";
        $prefix="";
		
		$arr=array("sales"=>array('pre'=> $prefix.'XS', 'url'=>U('/Home/Sales/index/func/view')), 
				"sales_refund"=>array('pre'=> $prefix."XT", 'url'=>U('/Home/SalesRefund/index/func/view')), 
				"purchase"=>array('pre'=> $prefix."JH", 'url'=>U('/Home/Purchase/index/func/view')),
//                "sales"=>array('pre'=> $prefix."PL", 'url'=>U('/Home/Sales/index/func/view')),
				"purchase_return"=>array('pre'=> $prefix."JT",'url'=>U('/Home/PurchaseReturn/index/func/view')),
				"production"=>array('pre'=> $prefix."PP",'url'=>U('/Home/Production/index/func/view')),
				"production_assign"=>array('pre'=> $prefix."PA",'url'=>U('/Home/ProductionAssign/index/func/view')),
				"production_qc"=>array('pre'=> $prefix."PQ",'url'=>U('/Home/ProductionQc/index/func/view')),
				"production_hour"=>array('pre'=> $prefix."PH",'url'=>U('/Home/ProductionHour/index/func/view')),
				"production_stock"=>array('pre'=> $prefix."PS",'url'=>U('/Home/ProductionStock/index/func/view')),
				"production_reg"=>array('pre'=> $prefix."PR",'url'=>U('/Home/ProductionReg/index/func/view')),
				"stock_in"=>array('pre'=> $prefix."SI",'url'=>U('/Home/StockIn/index/func/view')),
				"stock_out"=>array('pre'=> $prefix."SO",'url'=>U('/Home/StockOut/index/func/view')),
				"stock_move"=>array('pre'=> $prefix."SM",'url'=>U('/Home/StockMove/index/func/view')),
				"stock_adjust"=>array('pre'=> $prefix."SA",'url'=>U('/Home/StockAdjust/index/func/view')),
				"stock_check"=>array('pre'=> $prefix."SC",'url'=>U('/Home/StockCheck/index/func/view')),
				"logistic"=>array('pre'=> $prefix."LG",'url'=>U('/Home/Logistic/index/func/view')),
            "fund"=>array('pre'=> $prefix."FD",'url'=>U('/Home/Fund/index/func/view')),
            "retail"=>array('pre'=> $prefix."RT",'url'=>U('/Home/Retail/index/func/view')),
            "trade"=>array('pre'=> $prefix."TD",'url'=>U('/Home/Trade/index/func/view')),
            "exam"=>array('pre'=> $prefix."EX",'url'=>U('/Home/Exam/index/func/view')),
		);
		
		if($gettype)
			return $arr;
		
		$pre = isset($arr[$table]) ? $arr[$table]["pre"] : "";
		$table=strtolower($table);
		list($a1,$a2) = explode(" ", microtime());
		$a = (float)((float)$a1+(float)$a2);
		$a = str_replace(".", "", $a);
		$orderno=$pre.$a.rand(100, 999);
		return  $orderno;
	}

	function GenPrintNo()
	{
		list($a1,$a2) = explode(" ", microtime());
		$a = (float)((float)$a1+(float)$a2);
		$a = str_replace(".", "", $a);
		$orderno=$a.rand(100, 999);
		return  $orderno;
	}
    function getOrderType($type){
        return OrderType::$$type;
    }

    function getError($err){

        $err=explode("_",$err);
        $err_type=$err[0];
        $err_detail=$err[1];


        $global_err_list=array(
            'SUCCESS'=>array('1'=>'处理成功',),
            'CHECKERR'=>array('0'=>'校验错误',),
            'SAVEERR'=>array('-1'=>'数据存储时错误',),
            'FIELDERR'=>array('-10001'=>'字段错误',),
            'RECORDERR'=>array('-10002'=>'记录错误',),
            'FARMATERR'=>array('-10003'=>'接口格式错误',),
            'PERMISSERR'=>array('-10004'=>'权限错误',),
            'UNKNOWERR'=>array('-999999'=>'未知错误',),
        );

        if(trim($err_type)=='' || !isset($global_err_list[$err_type]))
            $err_type='UNKNOWERR';
        if(trim($err_detail)=='')
            $err_detail='UNKNOWERR';

        $status=key($global_err_list[$err_type]);
        $msg=$global_err_list[$err_type][$status];
        $direct=array('SUCCESS','CHECKERR','SAVEERR','UNKNOWERR');
        if(in_array($err_type,$direct)){
            return array('status'=>$status,'message'=>$msg);
        }




        $field_err_list=array(
            'EMPTY'=>array('01'=>'必填字段为空'),
            'TYPE'=>array('02'=>'类型不正确'),
            'INFO'=>array('03'=>'信息不匹配'),
            'NEGATIVE'=>array('04'=>'数量必须非负'),
            'QTYMOREPURCHASE'=>array('05'=>'数量大于采购数量'),
            'MODEINVALID'=>array('06'=>'模式不正确'),
            'QTYNEQPURCHASE'=>array('07'=>'数量不等于采购数量'),
            'QTYNEQDETAILQTY'=>array('08'=>'数量不等于详细数量'),
            'PURCHASEDETAILINFO'=>array('09'=>'采购单商品与API商品信息不匹配'),
            'QTYNEQORDERQTY'=>array('10'=>'数量与通知数量不一致'),
            'UNKNOWERR'=>array('99'=>'未知错误',),
        );

        $record_err_list=array(
            'EMPTY'=>array('01'=>'记录不存在'),
            'NONEMPTY'=>array('02'=>'记录已存在'),
            'INVALID'=>array('03'=>'单据非有效状态'),
            'UNKNOWERR'=>array('99'=>'未知错误',),
        );

        $permiss_err_list=array(
            'EMPTY'=>array('01'=>'没有接口操作权限'),
            'NONRANGE'=>array('02'=>'不在接口范围'),
            'UNKNOWERR'=>array('99'=>'未知错误',),
        );

        $farmat_err_list=array(
            'INVALID'=>array('01'=>'非有效JSON格式'),
            'UNKNOWERR'=>array('99'=>'未知错误',),
        );


        switch($err_type){
            case 'FIELDERR':
                $err_detail=isset($field_err_list[$err_detail])?$field_err_list[$err_detail]:$field_err_list['UNKNOWERR'];
                break;
            case 'RECORDERR':
                $err_detail=isset($record_err_list[$err_detail])?$record_err_list[$err_detail]:$record_err_list['UNKNOWERR'];
                break;
            case 'FARMATERR':
                $err_detail=isset($farmat_err_list[$err_detail])?$farmat_err_list[$err_detail]:$farmat_err_list['UNKNOWERR'];
                break;
            case 'PERMISSERR':
                $err_detail=isset($permiss_err_list[$err_detail])?$permiss_err_list[$err_detail]:$permiss_err_list['UNKNOWERR'];
                break;
        }


        $status.=".".key($err_detail);
        $msg.=".".$err_detail[key($err_detail)];

        return array('status'=>$status,'message'=>$msg);
    }

    function createStockIn($data){

        $data=(array)$data;

        if(trim($data['init_code'])==''){
            return getError('FIELDERR_EMPTY');
        }

        if(trim($data['purchase_order'])==''){
            return getError('FIELDERR_EMPTY');
        }

        if(intval($data['mode'])<0 || intval($data['mode'])>1){
            return getError('FIELDERR_MODEINVALID');
        }

        if(intval($data['qty'])<=0){
            return getError('FIELDERR_NEGATIVE');
        }


        $model=M('stock_in');
        $model->startTrans();
        $p=M('Purchase')->where("order_no='%s'",array($data['purchase_order']))->find();

        if(empty($p)){
            return getError('RECORDERR_EMPTY');
        }

        if(intval($data['qty'])>$p['qty']){
            return getError('FIELDERR_QTYMOREPURCHASE');
        }


        $input["tx_date"] = date('Y-m-d H:i:s');
        $input["storage_code"] = $p['storage_code'];
        $input["in_date"] = date('Y-m-d H:i:s',strtotime($p['indate_require']));
        $input["type"] = $p['type'];
        $input["purchase_order_no"] = $p['order_no'];
        $input["order_qty"] = $data['qty'];
        $input["qty"] = 0;
        $input["amount"] = 0;
        $input["remarks"] = $p['remarks'];
        $input["status"] = 0 ; //"数值类型"
        $input["create_by"]=0;
        $input["modify_time"] = date('Y-m-d H:i:s.n');
        $input["modify_user"] = session(C("USER_AUTH_KEY"));

        $si=$model->where("init_code='%s'",array($data['init_code']))->find();
        $order_id=$si['id'];

        if($si['status']!=0){
            return getError('RECORDERR_INVALID');
        }

        M('stock_in_detail')->where("stock_in_id='%d'",array($si['id']))->delete();

        if(!empty($si)){
            $result=true;
            $model->where("init_code='%s'",array($data['init_code']))->save($input);

        }else{
            $input["init_code"]=$data['init_code'];
            $input["order_no"]=GenOrderNo("stock_in");
            $input["create_time"] = date('Y-m-d H:i:s.n');
            $input["create_user"] = session(C("USER_AUTH_KEY"));
            $result = $order_id = $model->add($input);
        }
        $ret=getError('SAVEERR');

        $si=$model->where("id='%d'",array($order_id))->find();
        $order_no=$si['order_no'];
        if($data['mode']==1){

            $d=array(
                'stockin_order'=>$order_no,
                'detail'=>$data['detail']
            );
            $ret=createStockInDetail($d,false,1);

            if(intval($ret['status'])<=0)
                $result=false;

            if($result){
                $d=array(
                    'stockin_order'=>$order_no,
                    'init_code'=>$data['init_code'],
                    'qty'=>$data['qty']
                );
                $ret=createStockInApproval($d,false,1);

                if(intval($ret['status'])<=0)
                    $result=false;
            }

        }


        if($result)
            $model->commit();
        else{
            $model->rollback();
            return $ret;
        }

        $msg=getError('SUCCESS');
        $msg['data']=array('stockin_order'=>$order_no);
        return $msg;

    }


    function createStockInDetail($data,$trans=true,$mode=0){

        if(trim($data['stockin_order'])==''){
            return getError('FIELDERR_EMPTY');
        }

        $detail=(array)$data['detail'];

        $model=M('stock_in');
        if($trans)
            $model->startTrans();
        $s=$model->where("order_no='%s'",array($data['stockin_order']))->find();

        if(empty($s)){
            return getError('RECORD_EMPTY');
        }

        if($s['status']!=0){
            return getError('RECORD_INVALID');
        }

        $sdm=M('stock_in_detail');
        $pm=M('goods');
        $purm=M('purchase');
        $pur=$purm->where("order_no='%s'",array($s['purchase_order_no']))->find();

        if(empty($pur)){
            return getError('RECORD_EMPTY');
        }

        $err_detail=array();
        $detail_save=array();


        $qty_this=0;

        foreach ($detail as $v) {
            $v=(array)$v;

            if(trim($v['sku'])!='' && trim($v['barcode'])!=''){
               $p = $pm->where("sku='%s' AND barcode='%s'",array($v['sku'],$v['barcode']))->find();
               $msg = getError('FIELDERR_INFO');
            }elseif(trim($v['sku'])!=''){
                $p = $pm->where("sku='%s'",array($v['sku']))->find();
                $msg = getError('RECORDERR_EMPTY');
            }elseif(trim($v['barcode'])!=''){
                $p = $pm->where("barcode='%s'",array($v['barcode']))->find();
                $msg = getError('RECORDERR_EMPTY');
            }else{
                $p = array();
                $msg = getError('FIELDERR_EMPTY');
            }

            if(empty($p)){
                $err_detail[]=array(
                    'sku'=>$v['sku'],
                    'status'=>$msg['status'],
                    'message'=>$msg['message']
                );
            }else{
                $purd=M('purchase_detail')->where("purchase_id='%d' AND goods_id='%d'",array($pur['id'],$p['id']))->find();

                if(empty($purd)){
                    $msg=getError('FIELDERR_PURCHASEDETAILINFO');
                    $err_detail[]=array(
                        'sku'=>$v['sku'],
                        'status'=>$msg['status'],
                        'message'=>$msg['message']
                    );
                }else{

                    $ds=$p;
                    $ds['qty']=$v['qty'];
                    $detail_save[]=$ds;
                }

            }

            if(intval($v['qty'])<0){
                $msg=getError('FIELDERR_NEGATIVE');
                $err_detail[]=array(
                    'sku'=>$v['sku'],
                    'status'=>$msg['status'],
                    'message'=>$msg['message']
                );
            }

            $qty_this+=$v['qty'];
        }


        if($mode==1 && ($s['order_qty']-$s['qty'])!=$qty_this){
            $msg=getError('FIELDERR_QTYNEQDETAILQTY');
            $err_detail[]=array(
                'sku'=>$v['sku'],
                'status'=>$msg['status'],
                'message'=>$msg['message']
            );
        }elseif($model==0){
            if($s['order_qty']-$s['qty']<$qty_this){
                $msg=getError('FIELDERR_QTYMOREPURCHASE');
                $err_detail[]=array(
                    'sku'=>$v['sku'],
                    'status'=>$msg['status'],
                    'message'=>$msg['message']
                );
            }
        }

        if(count($err_detail)>0){
            $msg=getError('CHECKERR');
            $msg['data']=$err_detail;
            return $msg;
        }


        $gm=M('goods');

        $result=true;

        foreach ($detail_save as $v) {
            $g=$gm->where("id='%d'",array($v['goods_id']))->find();
            $input_d['stock_in_id']=$s['id'];
            $input_d['goods_id']=$v['goods_id'];
            $input_d['product_id']=$v['id'];
            $input_d['goods_no']=$v['goods_no'];
            $input_d['goods_name']=$g['name'];
            $input_d['brand_code']=$g['brand_code'];
            $input_d['sku']=$v['sku'];
            $input_d['style_info']=$v['style_info'];
            $input_d['barcode']=$v['barcode'];
            $input_d['order_qty']=$v['qty'];
            $input_d['qty']=$v['qty'];
            $input_d['price']=$g['sell_price'];
            $input_d['amount']=$g['sell_price']*$v['qty'];

            $sd=$sdm->where("stock_in_id='%d' AND goods_id='%d' AND product_id='%d'",array($s['id'],$v['goods_id'],$v['id']))->find();

            if(empty($sd)){
                $result= $result && $sdm->add($input_d);

            }else{
                $result = $sdm->where("stock_in_id='%d' AND goods_id='%d' AND product_id='%d'",array($s['id'],$v['goods_id'],$v['id']))->save($input_d);
                if($result===0)
                    $result=true;
            }

//            $result =$result &&  incqtyon($storage['id'],$v['goods_id'],$v['id'],$s['id'],getOrderType('purchase'),$v['qty']);

        }

        $sd=$sdm->where("stock_in_id='%d'",array($s['id']))->field('SUM(amount) amount')->find();
        $rs=$model->where("id='%d'",array($s['id']))->save(array('amount'=>$sd['amount']));

        if($rs===0)
            $rs=true;
        $result = $result && $rs;

        if($trans){
            if($result)
                $model->commit();
            else{
                $model->rollback();
                return getError('SAVEERR');
            }
        }

        return getError('SUCCESS');

    }

    function createStockInApproval($data,$trans=true,$mode=0){

        if(empty($data)){
            return getError('FARMATERR_INVALID');
        }

        if(trim($data['stockin_order'])==''){
            return getError('FIELDERR_EMPTY');
        }

        if(trim($data['init_code'])==''){
            return getError('FIELDERR_EMPTY');
        }

        $model=M('stock_in');
        if($trans)
            $model->startTrans();
        $s=$model->where("order_no='%s' AND init_code='%s'",array($data['stockin_order'],$data['init_code']))->find();


        if(empty($s)){
            return getError('RECORDERR_EMPTY');
        }

        if($s['status']!=0){
            return getError('RECORDERR_INVALID');
        }

        $id=$s['id'];
        $s=$model->where("id='%d'",array($id))->find();
        $smd=M('stock_in_detail')->where("stock_in_id='%d'",array($id))->select();
        $pdm=M('purchase_detail');
        $qty_total=0;
        $qty_purchase_stock_total=0;
        $storage=M('storage')->where("code='%s'",array($s['storage_code']))->find();
        $purchase=M('purchase')->where("order_no='%s'",array($s['purchase_order_no']))->find();
        $status=1;

        foreach ($smd as $v) {
            $pdt=$pdm->where("purchase_id='%d' AND goods_id='%d' AND product_id='%d'",array($purchase['id'],$v['goods_id'],$v['product_id']))->find();

            if($v['qty']>=0 && !empty($pdt)){
                $qty_total+=$v['qty'];
                $qty_now=$pdt['stock_qty']+$v['qty'];
                $qty_purchase_stock_total+=$qty_now;
                $result2 = decqtyonandincstock($storage['id'],$v['goods_id'],$v['product_id'],$v['stock_in_id'],$data['stockin_order'],getOrderType('stockIn'),$v['qty']);
                $rs=$pdm->where("purchase_id='%d' AND goods_id='%d' AND product_id='%d'",array($purchase['id'],$v['goods_id'],$v['product_id']))->save(array('stock_qty'=>$qty_now));
                if($rs===0)
                    $rs=true;
                $result2 = $result2 && $rs;
            }

            if(!$result2){
                break;
            }
        }


        if($data['qty']!=$s['order_qty']){
            return getError('FIELDERR_QTYNEQORDERQTY');
        }

        if($data['qty']!=$qty_total){
            return getError('FIELDERR_QTYNEQDETAILQTY');
        }

        $pdo = M('purchase_detail')->where("purchase_id='%d' AND stock_qty=qty",array($purchase['id']))->field('COUNT(1) c')->find();
        $pdo2 = M('purchase_detail')->where("purchase_id='%d'",array($purchase['id']))->field('COUNT(1) c')->find();

        $save_data=array('stock_qty'=>$qty_purchase_stock_total,'stock_status'=>1,'stock_time'=>date('Y-m-d H:i:s'),'status'=>$status);
        if($pdo['c']==$pdo2['c']){
            $save_data['status']=2;
            $save_data['complete_time']=date('Y-m-d H:i:s');
            $save_data['complete_by']=0;
        }

        $result2 = $result2 && M('purchase')->where("id='%d'",array($purchase['id']))->save($save_data);

        $result2 = $result2 && createLogOrder('stock_in',$id,'审核入库单','');

        $result1=$model->where("order_no='%s' AND init_code='%s'",array($data['stockin_order'],$data['init_code']))->save(array('status'=>2,'qty'=>$qty_total));

        if($trans){
            if($result1 && $result2){
                $model->commit();
            }else{
                $model->rollback();
                return getError('SAVEERR');
            }
        }
        return getError('SUCCESS');

    }


    function simulationStockIn($purchase_id){
        $model=M('stock_in');
        $model_detail=M('stock_in_detail');
        $model->startTrans();
        $p=M('Purchase')->where("id='%d'",array($purchase_id))->find();
        $pd=M('Purchase_detail')->where("purchase_id='%d'",array($purchase_id))->select();

        $input["order_no"]=GenOrderNo("stock_in");
        $input["tx_date"] = date('Y-m-d H:i:s');
        $input["storage_code"] = $p['storage_code'];
//        $day=rand(-1,1)." day";
        $input["in_date"] = date('Y-m-d H:i:s',strtotime($p['indate_require']));

        $input["type"] = $p['type'];
        $input["purchase_order_no"] = $p['order_no'];
        $input["order_qty"] = $p['qty'];
        $input["qty"] = 0;
        $input["amount"] = 0;
        $input["remarks"] = $p['remarks'];
        $input["status"] = 0 ; //"数值类型"
        $input["create_time"] = date('Y-m-d H:i:s.n');
        $input["create_user"] = session(C("USER_AUTH_KEY"));
        $input["modify_time"] = date('Y-m-d H:i:s.n');
        $input["modify_user"] = session(C("USER_AUTH_KEY"));
        $result = $order_id = $model->add($input);

        $total_qty=0;
        $total_amount=0;
        foreach ($pd as $v) {
            $input_d['stock_in_id']=$order_id;
            $input_d['goods_id']=$v['goods_id'];
            $input_d['product_id']=$v['product_id'];
            $input_d['goods_no']=$v['goods_no'];
            $input_d['goods_name']=$v['goods_name'];
            $input_d['brand_code']=$v['brand_code'];
            $input_d['sku']=$v['sku'];
            $input_d['style_info']=$v['style_info'];
            $input_d['barcode']=$v['barcode'];
            $input_d['order_qty']=$v['qty'];
            $qty=$v['qty'];
            $input_d['qty']=$qty;
            $input_d['price']=$v['price'];
            $input_d['amount']=$v['price']*$qty;
            $total_qty+=$qty;
            $total_amount+=$input_d['amount'];

            $result2=$model_detail->add($input_d);

            if(!$result2){
                break;
            }

        }

       $result3 = $model->where("id='%d'",array($order_id))->save(array('amount'=>$total_amount,'qty'=>$total_qty));

       if($result && $result2 && $result3){
           $model->commit();
       } else{
           $model->rollback();
       }


    }

function simulationStockOut($sales_id,$deliver_code,$deliver_name,$deliver_post){

    $deliver=array(
        'code'=>$deliver_code,
        'name'=>$deliver_name,
        'post'=>$deliver_post,
    );

    $model=M('stock_out');
    $model_detail=M('stock_out_detail');

    $model->startTrans();
    $p=M('sales')->where("id='%d'",array($sales_id))->find();
    $pd=M('sales_detail')->where("sales_id='%d'",array($sales_id))->select();

    $input["order_no"]=GenOrderNo("stock_out");
    $input["tx_date"] = date('Y-m-d H:i:s');
    $input["storage_code"] = $p['storage_code'];
//        $day=rand(-1,1)." day";
    $input["out_date"] = date('Y-m-d H:i:s.n');
    $input['deliver_code']=$deliver['code'];
    $input['deliver_name']=$deliver['name'];
    $input['deliver_post']=$deliver['post'];
    $input["type"] = 1;
    $input["sales_order_no"] = $p['order_no'];
    $input["order_qty"] = $p['qty'];
    $input["qty"] = $p['qty'];
    $input["amount"] = $p['amount'];
    $input["remarks"] = $p['remarks'];
    $input["status"] = 0 ; //"数值类型"
    $input["create_time"] = date('Y-m-d H:i:s.n');
    $input["create_user"] = session(C("USER_AUTH_KEY"));
    $input["modify_time"] = date('Y-m-d H:i:s.n');
    $input["modify_user"] = session(C("USER_AUTH_KEY"));
    $input["create_by"]=1;
    $result = $stock_out_id = $model->add($input);

    $total_qty=0;
    $total_amount=0;
    $result2=true;
    foreach ($pd as $v) {
        $input_d['stock_out_id']=$stock_out_id;
        $input_d['goods_id']=$v['goods_id'];
        $input_d['product_id']=$v['product_id'];
        $input_d['goods_no']=$v['goods_no'];
        $input_d['goods_name']=$v['goods_name'];
        $input_d['brand_code']=$v['brand_code'];
        $input_d['sku']=$v['sku'];
        $input_d['style_info']=$v['style_info'];
        $input_d['barcode']=$v['barcode'];
        $input_d['order_qty']=$v['qty'];
        $qty=$v['qty'];
        $input_d['qty']=$qty;
        $input_d['price']=$v['price'];
        $input_d['amount']=$v['price']*$qty;
        $total_qty+=$qty;
        $total_amount+=$input_d['amount'];

        $result2=$model_detail->add($input_d);

        if(!$result2){
            break;
        }

    }


    $result= $result && $model->where("id='%d'",array($stock_out_id))->save(array(
            'status'=>1,
            'notice_time'=>date('Y-m-d H:i:s'),
            'notice_status'=>1,
            'confirm_status'=>1,
            'confirm_time'=>date('Y-m-d H:i:s'),
        ));


    $result2 = $result2 && createLogOrder('stock_out',$stock_out_id,'审核出库单','');

    $result2 = $result2 && M('sales')->where("id='%d'",$sales_id)->save(array(
            'status'=>6
        ));


    $result=$result && $model->where("id='%d'",array($stock_out_id))->save(array(
            'status'=>2,
            'complete_time'=>date('Y-m-d H:i:s'),
        ));

    $sm=$model->where("id='%d'",array($stock_out_id))->find();
    $smd=M('stock_out_detail')->where("stock_out_id='%d'",array($stock_out_id))->select();
    $storage=M('storage')->where("code='%s'",array($sm['storage_code']))->find();


    foreach ($smd as $v) {

        if($v['qty']>=0){
            $result2 = decstock($storage['id'],$v['goods_id'],$v['product_id'],$v['stock_out_id'],$sm['order_no'],getOrderType('stockOut'),$v['qty']);
        }

        if(!$result2){
            break;
        }
    }


    $result2 = $result2 && createLogOrder('stock_out',$stock_out_id,'完成出库单','');


    if($result && $result2){
        $model->commit();
        return true;
    } else{
        $model->rollback();
        return false;
    }

}
	
	function splitorder($order_id, $split_type, $product_id = 0, $qty = 0, $trans = false,$lock_user="") {
		//$split_type  1按缺货拆分  2拆成1件商品1单   3指定商品数量拆分
		$now = date("Y-m-d H:i:s");
		if(!empty($lock_user))
		{
			$where=" AND lock_status = 1 and lock_user='$lock_user'";
		}else 
		{
			$where=" AND lock_status = 0";
		}
		if($split_type == 2) {
			$order = M("sales")->where("id = $order_id AND status = 3 AND notice_status = 0 AND hangup_status = 0 $where ")->find();
		} else {
			$order = M("sales")->where("id = $order_id AND status = 2 AND hangup_status = 0 $where")->find();
		}
		
		$lastchanged = $order["lastchanged"];
		
		if(empty($order))
			return false;
		if($split_type == 3) {
			$orderdetail = M("sales_detail")->where("sales_id = $order_id AND product_id = $product_id")->find();
		} else {
			$orderdetail = M("sales_detail")->where("sales_id = $order_id")->select();
		}
		
		if(empty($orderdetail))
			return false;
		
		if($trans)
			M()->startTrans();
		
		$new_avg_amount_odd = 0;
		$new_avg_amount = ($order["avg_amount"] - $new_avg_amount_odd) / $order["qty"];
		$pos = strpos($new_avg_amount, ".");
		$new_avg_amount = substr($new_avg_amount, 0, $pos + 3);
		$new_avg_amount_odd = $order["avg_amount"] - ($new_avg_amount * $order["qty"]);
		
		$new_amount_odd = 0;
		$new_amount = ($order["amount"] - $new_amount_odd) / $order["qty"];
		$pos = strpos($new_amount, ".");
		$new_amount = substr($new_amount, 0, $pos + 3);
		$new_amount_odd = $order["amount"] - ($new_amount * $order["qty"]);
		
		$neworder = array();
		$neworder_detail = array();
		$removeids = array();
		$updateids = array();
		
		if($split_type == 1) {
			$neworder = $order;
			unset($neworder["id"]);
			unset($neworder["order_no"]);
			unset($neworder["qty"]);
			unset($neworder["amount"]);
			unset($neworder["weight"]);
			if($order["handle_storage"] == 0) {
				unset($neworder["storage_code"]);
			}
			$neworder["modify_time"] = $now;
			$i = 0;
			$newqty = 0;
			$newweight = 0;
			
			foreach($orderdetail as $od) {
				if(intval($od["oos_qty"]) > 0) {
					$neworder_detail[$i] = $od;
					unset($neworder_detail[$i]["id"]);
					unset($neworder_detail[$i]["sales_id"]);
					unset($neworder_detail[$i]["order_no"]);
					
					$neworder_detail[$i]["qty"] = intval($od["oos_qty"]);
					$neworder_detail[$i]["orig_qty"] = intval($od["oos_qty"]);
					$neworder_detail[$i]["assign_qty"] = 0;
					$neworder_detail[$i]["oos_qty"] = intval($od["oos_qty"]);
					$neworder_detail[$i]["stock_qty"] = 0;
					$neworder_detail[$i]["refund_qty"] = 0;
					$neworder_detail[$i]["amount"] = $new_amount * $neworder_detail[$i]["qty"];
					$neworder_detail[$i]["avg_amount"] = $new_avg_amount * $neworder_detail[$i]["qty"];
					
					$newqty += intval($neworder_detail[$i]["qty"]);
					
					$tmpweight = M("goods")->where("id = ".$neworder_detail[$i]["goods_id"])->getField("weight");
					$newweight += $tmpweight * $neworder_detail[$i]["qty"];
					
					if(intval($od["oos_qty"]) == intval($od["qty"])) {
						$removeids[] = $od["id"];
					} else {
						$updateids[$od["id"]] = intval($od["qty"]) - intval($od["oos_qty"]);
					}
					
					$i++;
				}
			}
			
			if(count($removeids) == count($orderdetail)) {
				if($trans) {
					M()->rollback();
				}
				return false;
			}
			
			if(empty($neworder_detail)) {
				if($trans) {
					M()->rollback();
				}
				return true;
			}
			
			$neworder["assign_status"] = 1;
			//$neworder["assign_time"] = $now;
			$neworder["assign_result"] = 3;
			
			$neworder["qty"] = $newqty;
			$neworder["amount"] = $new_amount * $newqty;
			$neworder["avg_amount"] = $new_avg_amount * $newqty;
			$neworder["weight"] = $newweight;
			$neworder["order_no"] = GenOrderNo("sales");
			$neworder["is_split"] = 1;
			
			$neworder_id = M("sales")->add($neworder);
			
			foreach($neworder_detail as $nod) {
				$nod["sales_id"] = $neworder_id;
				$nod["order_no"] = $neworder["order_no"];
				M("sales_detail")->add($nod);
			}
			
			foreach($removeids as $rid) {
				M("sales_detail")->where("id = $rid")->delete();
			}
			
			$i = 0;
			foreach($updateids as $uid=>$uval) {
				if($i == 0) {
					$save = array("qty"=>$uval, "orig_qty" => $uval, "amount"=>($new_amount * $uval) + $new_amount_odd, "avg_amount"=>($new_avg_amount * $uval) + $new_avg_amount_odd, "oos_qty"=>0);
				} else {
					$save = array("qty"=>$uval, "orig_qty" => $uval, "amount"=>$new_amount * $uval, "avg_amount"=>$new_avg_amount * $uval, "oos_qty"=>0);
				}
				M("sales_detail")->where("id = $uid")->save($save);
				$i++;
			}
			
			$update = array(
				"amount" => array("exp", "(qty - $newqty) * $new_amount + $new_amount_odd"),
				"avg_amount" => array("exp", "(qty - $newqty) * $new_avg_amount + $new_avg_amount_odd"),
				"qty" => array("exp", "qty - $newqty"),
				"weight" => array("exp", "weight - $newweight"),
				"is_split" => 1,
				"assign_status" => 2,
				//"assign_time" => $now,
				"assign_result" => 1,
				"status" => 3,
				"notice_status"=> 0,
				"modify_time" => $now
			);
			
			$tmp = M("sales")->where("id = $order_id AND lastchanged = '$lastchanged'")->save($update);
			if($tmp != 1) {
				if($trans) {
					M()->rollback();
				}
				return null;
			}
		} else if($split_type == 2) {
			if(count($orderdetail) == 1 && $orderdetail[0]["qty"] == 1) {
				if($trans) {
					M()->rollback();
				}
				return array($order_id);
			}
			
			$k = 0;
			$updateids = array();
			$newweight = 0;
			$old_assign_qty = 0;
			$updateids = "";
			foreach($orderdetail as $od) {
				$oos_qty = intval($od["oos_qty"]);
				$over_qty = intval($od["qty"]);
				$weight = 0;
				for($i = 0; $i < $od["qty"];$i++) {
					if($k == 0 && $over_qty == 1) {
						$newweight = M("goods")->where("id = ".$od["goods_id"])->getField("weight");
						break;
					}
					if($k == 0) {
						$updateids = $od["id"];
					}
					
					$weight = M("goods")->where("id = ".$od["goods_id"])->getField("weight");
					
					$neworder[$k."-".$i] = $order;
					unset($neworder[$k."-".$i]["id"]);
					unset($neworder[$k."-".$i]["order_no"]);
					
					$neworder[$k."-".$i]["modify_time"] = $now;
					
					$neworder[$k."-".$i]["qty"] = 1;
					$neworder[$k."-".$i]["amount"] = $new_amount;
					$neworder[$k."-".$i]["avg_amount"] = $new_avg_amount;
					$neworder[$k."-".$i]["weight"] = $weight;
					
					$neworder[$k."-".$i]["assign_status"] = 2;
					//$neworder[$k."-".$i]["assign_time"] = $now;
					
					$neworder_detail[$k."-".$i]["price"] = $od["price"];
					$neworder_detail[$k."-".$i] = $od;
					unset($neworder_detail[$k."-".$i]["id"]);
					unset($neworder_detail[$k."-".$i]["sales_id"]);
					unset($neworder_detail[$k."-".$i]["assign_qty"]);
					unset($neworder_detail[$k."-".$i]["stock_qty"]);
					unset($neworder_detail[$k."-".$i]["refund_qty"]);
					
					$neworder_detail[$k."-".$i]["qty"] = 1;
					$neworder_detail[$k."-".$i]["orig_qty"] = 1;
					
					$neworder_detail[$k."-".$i]["amount"] = $new_amount;
					$neworder_detail[$k."-".$i]["avg_amount"] = $new_avg_amount;
					
					$neworder_detail[$k."-".$i]["assign_qty"] = 1;
					$neworder_detail[$k."-".$i]["oos_qty"] = 0;
					
					$neworder[$k."-".$i]["assign_result"] = 1;
					$neworder[$k."-".$i]["status"] = 3;
					
					$over_qty--;
					if($over_qty == 0) $removeids[] = $od["id"];
				}
				$k++;
			}
			
			$new_ids = array();
			foreach($neworder as $key=>$val) {
				$val["order_no"] = GenOrderNo("sales");
				$val["is_split"] = 1;
				$neworder_id = M("sales")->add($val);
				$new_ids[] = $neworder_id;
				$neworder_detail[$key]["sales_id"] = $neworder_id;
				$neworder_detail[$key]["order_no"] = $val["order_no"];
				M("sales_detail")->add($neworder_detail[$key]);
			}
			
			foreach($removeids as $rid) {
				M("sales_detail")->where("id = $rid")->delete();
			}
			
			if($updateids != "") {
				$update_data["qty"] = 1;
				$update_data["amount"] = $new_amount + $new_amount_odd;
				$update_data["avg_amount"] = $new_avg_amount + $new_avg_amount_odd;
				$update_data["qty"] = 1;
				$update_data["orig_qty"] = 1;
				$update_data["assign_qty"] = 1;
				$update_data["oos_qty"] = 0;
				
				M("sales_detail")->where("id = $updateids")->save(
					$update_data
				);
			}
			
			$update = array(
					"qty" => 1,
					"amount" => $new_amount + $new_amount_odd,
					"avg_amount" => $new_avg_amount + $new_avg_amount_odd,
					"weight" => $newweight,
					"is_split" => 1,
					"assign_status" => 2,
					//"assign_time" => $now,
					"modify_time" => $now
			);
			
			$update["assign_result"] = 1;
			$update["status"] = 3;	
			$update["notice_status"] = 0;
				
			$tmp = M("sales")->where("id = $order_id AND lastchanged = '$lastchanged'")->save($update);
				
			if($tmp != 1) {
				if($trans) {
					M()->rollback();
				}
				return null;
			}
		} else if($split_type == 3) {
			if($orderdetail["qty"] < $qty) {
				if($trans) {
					M()->rollback();
				}
				return false;
			}
			
			$neworder = $order;
			unset($neworder["id"]);
			unset($neworder["order_no"]);
			if($order["handle_storage"] == 0) {
				unset($neworder["storage_code"]);
			}
			
			$neworder["modify_time"] = $now;
			
			//unset($neworder["qty"]);
			//unset($neworder["amount"]);
			//unset($neworder["weight"]);
			$neworder["qty"] -= $qty;
			$neworder["amount"] -= $new_amount * $qty;
			$neworder["avg_amount"] -= $new_avg_amount * $qty;
			$neworder["weight"] -= M("goods")->where("id = $goods_id")->getField("weight") * $qty;
				
			$neworder_detail = $orderdetail;
			unset($neworder_detail["id"]);
			unset($neworder_detail["sales_id"]);
			$neworder_detail["qty"] = $qty;
			$neworder_detail["orig_qty"] = $qty;
			
			$oos_qty = $orderdetail["oos_qty"];
			$assign_qty = $orderdetail["assign_qty"];
			
			$orderdetail["amount"] = $new_amount * $qty;
			$orderdetail["avg_amount"] = $new_avg_amount * $qty;
			
			$update = array();
			$updateids = array();
			if($order["assign_status"] == 2) {
				if($qty != $oos_qty) {
					if($trans) {
						M()->rollback();
					}
					return false;
				}
				if($qty >= $oos_qty) {
					$neworder_detail["oos_qty"] = $oos_qty;
					$updateids["oos_qty"] = 0;
					$neworder_detail["assign_qty"] = $qty - $oos_qty;
					$updateids["assign_qty"] = $orderdetail["qty"] - $qty;
					
					$neworder["assign_status"] = 2;
					$neworder["assign_time"] = $now;
					if($qty == $oos_qty) {
						$neworder["assign_result"] = 3;
					} else {
						$neworder["assign_result"] = 2;
					}
					
					$update["assign_status"] = 2;
					$update["assign_time"] = now;
					$update["assign_result"] = 1;
					$update["status"] = 3;
					$update["notice_status"] = 0;
				} else {
					$neworder_detail["oos_qty"] = $qty;
					$updateids["oos_qty"] = $oos_qty - $qty;
					$neworder_detail["assign_qty"] = 0;
					$updateids["assign_qty"] = $orderdetail["assign_qty"];
					
					$neworder["assign_status"] = 2;
					$neworder["assign_time"] = $now;
					$neworder["assign_result"] = 3;
					
					$update["assign_status"] = 2;
					$update["assign_time"] = now;
					
					if($orderdetail["qty"] > $orderdetail["oos_qty"]) {
						$update["assign_result"] = 2;
					} else {
						$oss_count = M("sales_detail")->where("sales_id = $order_id AND product_id <> $product_id AND qty > oos_qty")->count();
						if($oss_count > 0) {
							$update["assign_result"] = 2;
						} else {
							$update["assign_result"] = 3;
						}
					}
				}
			} else {
				$neworder_detail["oos_qty"] = 0;
				$neworder_detail["assign_qty"] = 0;
			}
			
			$neworder["order_no"] = GenOrderNo("sales");
			$neworder["is_split"] = 1;
			$neworder_id = M("sales")->add($neworder);
			$neworder_detail["sales_id"] = $neworder_id;
			$neworder_detail["order_no"] = $neworder["order_no"];
			M("sales_detail")->add($neworder_detail);
			
			//M("sales_detail")->where("sales_id = $order_id")->save(array());
			
			$detail_update = array(
				"orig_qty" => array("exp", "qty - ". $qty),
				"amount" => array("exp", "(qty - ". $qty .") * $new_amount + $new_amount_odd"),
				"avg_amount" => array("exp", "(qty - ". $qty .") * $new_avg_amount + $new_avg_amount_odd"),
				"qty" => array("exp", "qty - ". $qty)
			);
			
			if(!empty($updateids)) {
				$detail_update["oos_qty"] = $updateids["oos_qty"];
				$detail_update["assign_qty"] = $updateids["assign_qty"];
			}
			
			M("sales_detail")->where("sales_id = $order_id AND product_id = $product_id")->save($detail_update);
			
			$update["orig_qty"] = array("exp", "orig_qty - " . $qty);
			$update["amount"] = array("exp", "(qty - $qty) * $new_amount + $new_amount_odd");
			$update["avg_amount"] = array("exp", "(qty - $qty) * $new_avg_amount + $new_avg_amount_odd");
			$update["weight"] = array("exp", "weight - " . $neworder["weight"]);
			$update["qty"] = array("exp", "qty - " . $qty);
			$update["is_split"] = 1;
			
			$tmp = M("sales")->where("id= $order_id AND lastchanged = '$lastchanged'")->save($update);
			
			if($tmp != 1) {
				if($trans) {
					M()->rollback();
				}
				return null;
			}
		} else {
			if($trans) {
				M()->rollback();
			}
			return false;
		}
		if($trans) {
			M()->commit();
		}
		
		if($split_type == 1 || $split_type == 3) {
			return $neworder_id;
		} else {
			return $new_ids;
		}
		//return true;
	}
	
	function createsales($web_trade, $ConfirmTypeInfo) {
		$auto_cancel = M("system_parameter")->where("code = 'auto_cancel_forpost'")->getField("status");
		
		$platform = M("platform")->where("code= '".$web_trade["platform_code"]."'")->find();
		if(empty($platform)) {
			log_webtrade($web_trade["id"], "transfer", "转单失败", "平台".$web_trade["platform_code"]."不存在", 1, "", "");
			return false;
		}
		$shop = M("shop")->where("code = '".$web_trade["shop_code"]."'")->find();
		if(empty($shop)) {
			log_webtrade($web_trade["id"], "transfer", "转单失败", "店铺".$web_trade["shop_code"]."不存在", 1, "", "");
			return false;
		}
		$wo = array();
		switch ($platform["code"]) {
			case PlatformType::$TB:
				//api_taobao_trade
				$wo = M("api_taobao_trade")->where("tid = '".$web_trade["trade_no"]."' AND status = 'WAIT_SELLER_SEND_GOODS'")->find();
				
				$buyer_message = trim($wo["buyer_memo"]);
				$seller_message = trim($wo["seller_memo"]);
				$invoice_status = $wo["invoice_status"];
				break;
			case PlatformType::$JD:
				$wo = M("api_jingdong_trade")->where("order_id = '".$web_trade["trade_no"]."' AND order_state = 'WAIT_SELLER_STOCK_OUT'")->find();
				
				$buyer_message = trim($wo["order_remark"]);
				$seller_message = trim($wo["vender_remark"]);
				$invoice_status = $wo["invoice_info"] == "不需要开具发票" ? 0 : 1;
				break;
			case PlatformType::$TM:
				break;
			case PlatformType::$QT:
				break;
			default:
				log_webtrade(0, "transfer", "转单失败", "平台".$platform["code"]."不存在", 1, "", "");
				return false;
		}
		
		if(empty($wo)) return false;
		
		$confirm_type = array();
		$confirm_type[ConfirmType::$message_buyer] = (!$ConfirmTypeInfo[ConfirmType::$message_buyer]["control"] || $buyer_message == "") ? false : true;
		$confirm_type[ConfirmType::$message_seller] = (!$ConfirmTypeInfo[ConfirmType::$message_seller]["control"] || $seller_message == "") ? false : true;
		$confirm_type[ConfirmType::$invoiced] = (!$ConfirmTypeInfo[ConfirmType::$invoiced]["control"] || $invoice_status != 1) ? false : true;
		$confirm_type[ConfirmType::$area_foreign] = false; //(!$ConfirmTypeInfo[ConfirmType::$other_country]["control"] || $wo["country"] == "中国") ? false : true;
		
		$buyer = M("buyer")->where("platform_code = '".$platform["code"] ."' AND nick='".$web_trade["buyer_nick"]."'")->find();
		if(empty($buyer)) {
			$buyerdata = array(
					"platform_code" => $platform["code"],
					"shop_code" => $shop["code"],
					"name" => $web_trade["buyer_nick"],
					"nick" => $web_trade["buyer_nick"],
					"phone" => "",
					"mobile" => "",
					"email" => isset($wo["buyer_email"]) ? $wo["buyer_email"] : "",
					"country" => "",
					"province" => "",
					"city" => "",
					"area" => "",
					"street" => "",
					"address" => "",
					"sex" => "",
					"qq" => "",
					"weixin" => "",
					"is_blacklist" => 0,
					//"charge_amount" => "",
					//"charge_count" => "",
					"status" => 1,
					"create_time" => date("Y-m-d H:i:s"),
					"create_user" => session(C("USER_AUTH_KEY")),
					"modify_time" => date("Y-m-d H:i:s"),
					"modify_user" =>session(C("USER_AUTH_KEY"))
			);
			$buyer_id = M("buyer")->add($buyerdata);
		} else {
			$buyer_id = $buyer["id"];
			
			if($ConfirmTypeInfo[ConfirmType::$buyer_blacklist]["control"]) {
				$confirm_type[ConfirmType::$buyer_blacklist] = intval($buyer["is_blacklist"] == 0) ? false : true;
			}
		}
		
		$weight = 0;
		$model = null;
		$detaildata = array();
		$product = array();
		$goods = array();
		$i = 0;
		
		$details = getapiorderdetail($platform["code"], $web_trade["trade_no"]);
		
		if($platform["code"] == "JD") {
			$precent = round(0.01 / $wo["order_total_price"], 4);
		}
		
		$real_amount = 0;
		$avg_amount = 0;
		$total_avg_amount = 0;
		foreach($details as $d) {
			$sku = "";
			$table = "";
			$qtyfield = "";
			$pricefield = "";
			
			switch ($platform["code"]) {
				case PlatformType::$TB:
					$table = "api_taobao_order";
					$sku = $d["outer_sku_id"];
					break;
				case PlatformType::$JD:
					$table = "api_jingdong_order";
					$sku = $d["outer_sku_id"];
					break;
				case PlatformType::$TM:
					break;
				case PlatformType::$QT:
					break;
			}
			
			if($sku != "") {
				if(!isset($product[$sku])) {
					$product[$sku] = M("goods")->where("barcode = '".$sku."'")->find();
				}
			}
			
			if($sku == "" || empty($product[$sku])) {
				$switch_content = "barcode[".$sku."]不存在";
				$update = array(
						"switch_failed" => 1,
						"switch_count" => array("exp", "switch_count + 1"),
						"switch_time" => date("Y-m-d H:i:s"),
						"switch_content" => $switch_content,
						"switch_status" => 0
				);
				M("web_trade")->where("id = " . $web_trade["id"])->save($update);
				log_webtrade($web_trade["id"], "transfer", "转单失败", $switch_content, 1, "", "");
				return false;
			}
			
			if(!isset($goods[$product[$sku]["goods_id"]])) {
				$goods[$product[$sku]["goods_id"]] = M("goods")->where("id = ".$product[$sku]["goods_id"])->find();
			}
			
			if($ConfirmTypeInfo[ConfirmType::$goods_forpost]["control"] && $goods[$product[$sku]["goods_id"]]["type"] == 1) {
				if($auto_cancel) {
					M($table)->where("id = ".$d["id"])->save(array("detail_status"=>0));
					M("web_trade_detail")->where("web_trade_id = ".$web_trade["id"]. " AND goods_no = '".$goods[$product[$sku]["goods_id"]]["goods_no"]."' AND sku = '".$sku."'")->save(array("status"=>0));
					$web_trade["qty"]--;
					continue;
				}
				$switch_content = "barcode[".$sku."]为补邮商品";
				$update = array(
						"switch_failed" => 1,
						"switch_count" => array("exp", "switch_count + 1"),
						"switch_time" => date("Y-m-d H:i:s"),
						"switch_content" => $switch_content,
						"switch_status" => 0
				);
				M("web_trade")->where("id = " . $web_trade["id"])->save($update);
				log_webtrade($web_trade["id"], "transfer", "转单失败", $switch_content, 1, "", "");
				return false;
			}
			
			switch ($platform["code"]) {
				case PlatformType::$TB:
					$table = "api_taobao_order";
					$qtyfield = "num";
					$pricefield = "price";
						
					$amount = floatval($d["payment"]);
					$avg_amount = floatval($d["divide_order_fee"]);
					if(empty($avg_amount))
						$avg_amount = floatval($d["payment"]);
						
					$total_avg_amount += $avg_amount;
					break;
				case PlatformType::$JD:
					$table = "api_jingdong_order";
					$qtyfield = "item_total";
					$pricefield = "jd_price";
						
					$avg_amount = round(floatval($d["jd_price"]) * floatval($wo["order_payment"]) / floatval($wo["order_total_price"]), 2);
					$amount = $avg_amount * floatval($d[$qtyfield]);
						
					$real_amount += $amount;
					if($real_amount > floatval($wo["order_payment"])) {
						$avg_amount -= $real_amount - floatval($wo["order_payment"]);
						$amount -= $real_amount - floatval($wo["order_payment"]);
					}
					$total_avg_amount += $avg_amount;
					break;
				case PlatformType::$TM:
					break;
				case PlatformType::$QT:
					break;
			}
			
			
			$detaildata[$i]["goods_id"] = $product[$sku]["goods_id"];
			$detaildata[$i]["product_id"] = $product[$sku]["id"];
			$detaildata[$i]["shop_id"] = $shop["id"];
			$detaildata[$i]["sku"] = $product[$sku]["sku"];
			$detaildata[$i]["goods_no"] = $product[$sku]["goods_no"];
			$detaildata[$i]["goods_name"] = $goods[$product[$sku]["goods_id"]]["name"];
			$detaildata[$i]["brand_code"] = $goods[$product[$sku]["goods_id"]]["brand_code"];
			$detaildata[$i]["style_info"] = $product[$sku]["style_info"];
			$detaildata[$i]["barcode"] = $product[$sku]["barcode"];
			$detaildata[$i]["orig_sku"] = $product[$sku]["sku"];
			$detaildata[$i]["orig_qty"] = $d["num"];
			$detaildata[$i]["is_gift"] = 0;
			$detaildata[$i]["sub_trade_no"] = $d["oid"];
				
			$detaildata[$i]["qty"] = $d["num"];
			$detaildata[$i]["oos_qty"] = 0;
			$detaildata[$i]["assign_qty"] = 0;
			$detaildata[$i]["stock_qty"] = 0;
			$detaildata[$i]["price"] = $d[$pricefield];
			$detaildata[$i]["refund_qty"] = 0;
			$detaildata[$i]["amount"] = $amount;//$d["payment"];
			$detaildata[$i]["avg_amount"] = $avg_amount;//$d["divide_order_fee"];
				
			$weight += floatval($product[$sku]["weight"]);
				
			$i++;
		}
		
		if(empty($detaildata)) {
			$update = array(
					"switch_failed" => 1,
					"switch_count" => array("exp", "switch_count + 1"),
					"switch_time" => date("Y-m-d H:i:s"),
					"switch_content" => "无明细商品",
					"switch_status" => 0
			);
			M("web_trade")->where("id = " . $web_trade["id"])->save($update);
			log_webtrade($web_trade["id"], "transfer", "转单失败", "无明细商品", 1, "", "");
			return false;
		}
		
		$new_sales_order = array();
		
		$country = "";
		switch ($platform["code"]) {
			case PlatformType::$TB:
				$area = M("area")->where("name = '".$wo["receiver_state"]."' AND type = 2 AND parent_id = 1")->find();
				
				$new_sales_order["order_time"] = $wo["created"];
				$new_sales_order["telphone"] = $wo["receiver_phone"];
				$new_sales_order["mobile"] = $wo["receiver_mobile"];
				$new_sales_order["address"] = replace_address($wo["receiver_address"]);
				$new_sales_order["province"] = $wo["receiver_state"];
				$new_sales_order["city"] = $wo["receiver_city"];
				$new_sales_order["area"] = $wo["receiver_district"];
				$new_sales_order["payment_code"] = "trade_alipay";
				$new_sales_order["payment_time"] = $wo["pay_time"];
				$new_sales_order["payment_voucher"] = $wo["alipay_no"];
				$new_sales_order["invoice_status"] = trim($wo["invoice_name"]) == "" ? 0 : 1;
				$new_sales_order["invoice_title"] = trim($wo["invoice_name"]);
				break;
			case PlatformType::$JD:
				$area = M("area")->where("name = '".$wo["province"]."' AND type = 2 AND parent_id = 1")->find();
				
				$new_sales_order["order_time"] = $wo["order_start_time"];
				$new_sales_order["telphone"] = $wo["telephone"];
				$new_sales_order["mobile"] = $wo["mobile"];
				$ad = replace_address($wo["full_address"]);
				$new_sales_order["address"] = ltrim($ad, $wo["province"].$wo["city"].$wo["county"]) ;
				$new_sales_order["province"] = $wo["province"];
				$new_sales_order["city"] = $wo["city"];
				$new_sales_order["area"] = $wo["county"];
				$new_sales_order["payment_code"] = $wo["pay_type"];
				$new_sales_order["payment_time"] = $wo["order_start_time"];
				$new_sales_order["payment_voucher"] = "";
				$new_sales_order["invoice_status"] = trim($wo["invoice_info"]) == "不需要开具发票" ? 0 : 1;
				$new_sales_order["invoice_title"] = trim($wo["invoice_info"]);
				break;
			case PlatformType::$TM:
				break;
			case PlatformType::$QT:
				break;
		}

		if(empty($area)) {
			$country = "外国";
		} else {
			if(strpos($area["name"], "香港") !== false) {
				$country = "香港";
			} else if(strpos($area["name"], "澳门") !== false) {
				$country = "澳门";
			} else if(strpos($area["name"], "台湾") !== false) {
				$country = "台湾";
			} else if(strpos($area["name"], "海外") !== false) {
				$country = "外国";
			} else {
				$country = "中国";
			}
		}
		
		$confirm_type[ConfirmType::$area_foreign] = ($ConfirmTypeInfo[ConfirmType::$area_foreign]["control"] && $country == "外国") ? true : false;
		$confirm_type[ConfirmType::$area_gangaotai] = ($ConfirmTypeInfo[ConfirmType::$area_gangaotai]["control"] && ($country == "香港" || $country == "澳门" || $country == "台湾")) ? true : false;
		
		$confirm_title = "";
		foreach ($confirm_type as $key=>$ct) {
			if(!$ct) continue;
			if($confirm_title != "") $confirm_title .= ";";
			$confirm_title .= $ConfirmTypeInfo[$key]["msg"];
		}
		
		$data = array(
				"order_no" => GenOrderNo("sales"),
				"trade_no" => $web_trade["trade_no"],
				"order_time" => $new_sales_order["order_time"],
				"web_trade_id" => $web_trade["id"],
				"platform_code" => $platform["code"],
				"shop_id" => $shop["id"],
				"shop_code" => $shop["code"],
				"storage_code" => '',
				//"buyer_id" => $buyer_id,
				"buyer_nick" => $web_trade["buyer_nick"],
				"qty" => $web_trade["qty"],
				"amount" => $web_trade["amount"],
				"avg_amount" => $total_avg_amount,
				"post_fee" => $web_trade["post_fee"],
				"weight" => $weight,
				"is_split"=>0,
				"is_manual"=>0,
				"order_source"=>0,
				"consignee" => $web_trade["receiver_name"],
				"telphone" => $new_sales_order["telphone"],
				"mobile" => $new_sales_order["mobile"],
				"address" => $new_sales_order["address"],
				"country" => $country,//$wo["country"],
				"province" => $new_sales_order["province"],
				"city" => $new_sales_order["city"],
				"area" => $new_sales_order["area"],
				"street" => "",//$wo["street"],
				"remarks" => '',
				"storage_message" => '',
				"buyer_message" => $web_trade["buyer_message"],
				"seller_message" => $web_trade["seller_message"],
				"payment_status" => 1,
				"payment_code" => $new_sales_order["payment_code"],//code_table_Payment("trade_alipay"),
				"payment_time" => $new_sales_order["payment_time"],
				"payment_voucher" => $new_sales_order["payment_voucher"],
				"invoice_status" => $new_sales_order["invoice_status"],
				"invoice_title" => $new_sales_order["invoice_title"],
				"invoice_content" => "",
				"deliver_status" => 0,
				"intercept_status"=>0,
				"assign_status"=>1,
				"assign_result"=>0,
				"platform_status"=>0,
				//"deliver_time" => ,
				//"deliver_id" => 0,
				//"cancel_time" => ,
				"cancel_status" => 0,
				"notice_status" => 0,
				//"notice_time" => ,
				//"confirm_time" => ,
				"confirm_title" => $confirm_title,
				"confirm_status" => in_array(true, $confirm_type) ? 0 : 2,
				"confirm_order" => in_array(true, $confirm_type) ? 1 : 0,
				"status" => in_array(true, $confirm_type) ? 1 : 2,
				"hangup_status" => 0,
				"lock_status" => 0,
				//"hangup_time" =>
				//"hangup_release_time" =>
				"create_time" => date("Y-m-d H:i:s"),
				"create_user" => session('usercode'),
				"modify_time" => date("Y-m-d H:i:s"),
				"modify_user" => session('usercode'),
		);
		
		if($data["confirm_status"] == 2) {
			$data["confirm_time"] = date("Y-m-d H:i:s");
		}
		
		$sales_id = M("sales")->add($data);
		if(empty($sales_id)) {
			log_webtrade($web_trade["id"], "transfer", "转单失败", "创建订单失败", 1, "", "");
			return false;
		}
		
		foreach($detaildata as $dd) {
			$dd["sales_id"] = $sales_id;
			$dd["order_no"] = $data["order_no"];
			$dd["shop_code"] = $shop["code"];
			M("sales_detail")->add($dd);
			
			stock1_lock($dd["goods_id"], $dd["product_id"], $sales_id, $data["order_no"], OrderType::$sales, $dd["qty"]);
		}
		
		foreach ($confirm_type as $key=>$ct) {
			if(!$ct) continue;
			$confirmdata = array();
			$confirmdata["sales_id"] = $sales_id;
			$confirmdata["order_no"] = $data["order_no"];
			$confirmdata["type"] = $key;
			$confirmdata["content"] = $ConfirmTypeInfo[$key]["msg"];
			$confirmdata["create_time"] = date("Y-m-d H:i:s");
			$confirmdata["status"] = 0;
			M("sales_confirm")->add($confirmdata);
		}
		
		M("web_trade")->where("id=".$web_trade["id"])->save(array("sales_order_no"=>$data["order_no"]));
		return $sales_id;
	}
	
	function getapiorderdetail($type, $id) {
		$detail = array();
		switch ($type) {
			case PlatformType::$TB:
				$detail = M("api_taobao_order")->where("tid = '".$id."' AND status = 'WAIT_SELLER_SEND_GOODS' AND detail_status = 1")->select();
				break;
			case PlatformType::$JD:
				$detail = M("api_jingdong_order")->where("order_id = '".$id."' AND detail_status = 1")->select();
				break;
			case PlatformType::$TM:
				break;
			case PlatformType::$QT:
				break;
		}
		
		return $detail;
	}
	
	function releaseorder($order_no, $trans = false) {
		try {
			$sales = M("sales")->where("order_no = '$order_no' AND status <= 3 AND assign_status = 1 AND assign_result != 3 AND notice_status = 0")->find();
			if(empty($sales)) return false;
				
			if($trans) {
				M()->startTrans();
			}
			
			$detail = M("sales_detail")->where("sales_id = ".$sales["id"])->select();
			foreach($detail as $d) {
				$qty = $d["assign_qty"];
				if(!stock1_releaselock($d["goods_id"], $sales["id"], $sales["order_no"], \OrderType::$sales, $qty)) {
					if($trans) {
						M()->rollback();
					}
					return false;
				}
			}
			
			$tmp = M("sales")->where("order_no = '$order_no' AND lastchanged = '".$sales["lastchanged"]."'")->save(array("assign_status"=>1, "assign_result"=>0));
			if(!$tmp) {
				if($trans) {
					M()->rollback();
				}
				return false;
			}
			M("sales_detail")->where("order_no = '$order_no'")->save(array("assign_qty"=>0, "oos_qty"=>0));
			if($trans) {
				M()->commit();
			}
			
			return true;
		} catch(Exception $e) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}		
	}
	
	function cancelorder($order_no, $trans = false) {
		try {
			$sales = M("sales")->where("order_no = '$order_no' AND status != 8 AND deliver_status = 0")->find();
			if(empty($sales)) return false;
			
			if($trans) {
				M()->startTrans();
			}
			
			$tmp = M("sales")->where("order_no = '$order_no' AND status != 8 AND deliver_status = 0")->save(array("status"=>8));
			if(!$tmp) {
				if($trans) {
					M()->rollback();
				}
				return false;
			}
			$stock_out = M("stock_out")->field("id")->where("source_no = '$order_no'")->find();

			if($sales["assign_status"] != 0 && !empty($stock_out)) {
				//$detail = M("sales_detail")->where("sales_id = ".$sales["id"])->select();
				$detail = M("stock_out_location")->field("storage_code, location_code, goods_id, qty")->where("stock_out_id = ".$stock_out["id"])->select();
				foreach($detail as $d) {
					if(!stock3_releaselock(M("storage")->where("code = '".$d["storage_code"]."'")->getField("id"), $d["goods_id"], $sales["id"], $sales["order_no"], \OrderType::$sales, $d["qty"])) {
						if($trans) {
							M()->rollback();
						}
						return false;
					}
				}
				M("stock_out")->where("id = ".$stock_out["id"])->delete();
				M("stock_out_detail")->where("stock_out_id = ".$stock_out["id"])->delete();
				M("stock_out_location")->where("stock_out_id = ".$stock_out["id"])->delete();
			}
			M("sales_detail")->where("order_no = '$order_no'")->save(array("assign_qty"=>0, "oos_qty"=>0));

			log_sales($sales["id"], OrderType::$sales, "订单作废", "订单作废", 0, "", "");
			if($trans) {
				M()->commit();
			}
			
			return true;
		} catch(Exception $e) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}		
	}
	
	function cancelorder_detail($order_no, $trans = false) {
		try {
			$sales = M("sales")->where("order_no = '$order_no' AND status = 8")->find();
			if(empty($sales)) return false;			
			if($trans) {
				M()->startTrans();
			}
			if($sales["assign_status"] != 0) {
				$detail = M("sales_detail")->where("sales_id = ".$sales["id"])->select();
				foreach($detail as $d) {
					if($sales["assign_status"] != 0) {
						if(!stock1_releaselock($d["goods_id"], $sales["id"], $sales["order_no"], \OrderType::$sales, $d["assign_qty"])) {
							if($trans) {
								M()->rollback();
							}
							return false;
						}
					}
				}
			}
			if($trans) {
				M()->commit();
			}
			
			return true;
		} catch(Exception $e) {
			if($trans) {
				M()->rollback();
			}
			return false;
		}		
	}
	
	function mergeorder($orderids, $trans = false) {
		//$orderids = func_get_args();
		if(empty($orderids) || count($orderids) == 1) return false;
		$newqty = 0;
		$newamount = 0;
		$newweight = 0;
		$new_id = array_shift($orderids);
		
		$neworder = M("sales")->where("id = ".$new_id)->find();
		if(empty($neworder)) {
			return false;
		}
		
		$neworder["qty"] = 0;
		$neworder["amount"] = 0;
		$neworder["weight"] = 0;
		unset($neworder["id"]);
		unset($neworder["order_no"]);
		
		$oids = join(",", $orderids);
		$os = M("sales")->where("id IN ($oids)")->select();
		if(count($os) != count($orderids)) {
			return false;
		}
		
		$neworder_detail = array();
		$removeids = array();
		foreach($os as $order) {
			if($order["storage_code"] != $neworder["storage_code"]) {
				return false;
			}
			$neworder["qty"] += intval($order["qty"]);
			$neworder["amount"] += floatval($order["amount"]);
			$neworder["avg_amount"] += floatval($order["avg_amount"]);
			$neworder["weight"] += floatval($order["weight"]);
			
			$id = $order["id"];
			$order_detail = M("sales_detail")->where("sales_id = $id")->select();
			foreach($order_detail as $od) {
				if(isset($neworder_detail[$od["product_id"]])) {
					$neworder_detail[$od["product_id"]]["qty"] += $od["qty"];
					$neworder_detail[$od["product_id"]]["orig_qty"] += $od["orig_qty"];
					$neworder_detail[$od["product_id"]]["oos_qty"] += $od["oos_qty"];
					$neworder_detail[$od["product_id"]]["assign_qty"] += $od["assign_qty"];
					$neworder_detail[$od["product_id"]]["stock_qty"] += $od["stock_qty"];
					$neworder_detail[$od["product_id"]]["refund_qty"] += $od["refund_qty"];
					
					$neworder_detail[$od["product_id"]]["amount"] += $od["amount"];
					$neworder_detail[$od["product_id"]]["avg_amount"] += $od["avg_amount"];
					$neworder_detail[$od["product_id"]]["adjust_amount"] += $od["adjust_amount"];
				} else {
					$neworder_detail[$od["product_id"]] = $od;
					unset($neworder_detail[$od["id"]]);
					unset($neworder_detail[$od["sales_id"]]);
					unset($neworder_detail[$od["order_no"]]);
				}
			}
			
			$removeids[] = $id;
		}
		
		if($trans)
			M()->startTrans();
		
		foreach($removeids as $id) {
			M("sales")->where("id = $id")->save(array("status"=>9));
		}
		
		$neworder["order_no"] = GenOrderNo("sales");
		$neworder_id = M("sales")->add($neworder);
		foreach($neworder_detail as $nod) {
			$nod["sales_id"] = $neworder_id;
			$nod["order_no"] = $neworder["order_no"];
			M("sales_detail")->add($nod);
		}
		
		if($trans)
			M()->commit();
		return true;
	}
	
	function erp_convert_platform_order($orderid = "") {
		set_time_limit(0);
		
		$where = "";
		if($orderid != "") {
			$where = " AND id = $orderid";
		}
		
		$webtrades = M("web_trade")->where("(online_status = 'WAIT_SELLER_SEND_GOODS' OR online_status = 'WAIT_SELLER_STOCK_OUT') AND switch_allow = 1 AND switch_failed = 0 AND switch_status = 0 AND payment_time is not null $where")->limit(5000)->select();
		$product = array();
		
		$sales_id = false;
		
		$ConfirmTypeInfo = getConfirmTypeInfo();
		$orderSwitch = M("order_switch")->where("status = 1 AND is_enabled = 1")->select();
		foreach($orderSwitch as $os) {
			$ConfirmTypeInfo[$os["id"]]["control"] = true;
			$ConfirmTypeInfo[$os["id"]]["msg"] = $os["name"];
		}
		
		foreach($webtrades as $wo) {
			M()->startTrans();
// 			$wo["address"] = str_replace("{", "", $wo["address"]);
// 			$wo["address"] = str_replace("}", "", $wo["address"]);
// 			$wo["address"] = str_replace("｛", "", $wo["address"]);
// 			$wo["address"] = str_replace("｝", "", $wo["address"]);
			
// 			$confirm_type[ConfirmType::$wrong_address] = (!$ConfirmTypeInfo[ConfirmType::$wrong_address]["control"] || (strpos($wo["address"], "{")  === false 
// 					&& strpos($wo["address"], "}")  === false
// 					&& strpos($wo["address"], "｛")  === false 
// 					&& strpos($wo["address"], "｝")  === false)) ? false : true;
			
			$sales_id = createsales($wo, $ConfirmTypeInfo);
			if($sales_id) {
				$update = array(
						"switch_failed" => 0,
						"switch_count" => array("exp", "switch_count + 1"),
						"switch_time" => date("Y-m-d H:i:s"),
						"switch_status" => 1
				);
				M("web_trade")->where("id = " . $wo["id"])->save($update);
			}
			
			M()->commit();
		}
		if($orderid != "") {
			if($sales_id) {
				erp_assign_storage_order($sales_id);
			}
		} else {
			//erp_assign_storage_order();
		}
		
		return true;
	}
	
	function active_stockdeliver($id = "") {
		set_time_limit(0);
		$where = "";
		if($id) {
			$where = " AND id = $id";
		}
		$stock_out = M("stock_out")->where("status = 1 AND confirm_status != 0 $where")->select();
		foreach($stock_out as $so) {
			$stock_out_detail = M("stock_out_detail")->where("stock_out_id = ".$so["id"])->select();
			try {
				M()->startTrans();
				$bt = true;
				$storage = M("storage")->where("code = '".$so["storage_code"]."'")->find();
				foreach($stock_out_detail as $detail) {
					if(empty($storage)) {
						$bt = false;
						break;
					}
				
					$stock_out_location = M("stock_out_location")->where("storage_code = '".$detail["storage_code"]."' AND goods_id = ".$detail["goods_id"]." AND stock_out_id = ".$so["id"])->select();
					foreach($stock_out_location as $sol) {
						if(!stock3_releaselock($storage["id"], $sol["location_code"], $sol["goods_id"], $so["id"], $so["order_no"], OrderType::$stockOut, $sol["qty"])) {
							M()->rollback();
							$bt = false;
							break;
						} else {
							$nagitive = $storage["allow_nagitive"] == 1 ? true : false;
							if(!decstock($storage["id"], $sol["location_code"], $sol["goods_id"], $so["id"], $so["order_no"], OrderType::$stockOut, $sol["qty"], false, $nagitive)) {
								M()->rollback();
								$bt = false;
								break;
							}
						}
					}
					if(!$bt) break;

				}
				if($bt) {
					M("stock_out")->where("id = ".$so["id"])->save(array("status"=>2, "complete_time"=>date("Y-m-d H:i:s")));
					M()->commit();
				} else {
					M()->rollback();
				}
			} catch(Exception $e) {
				M()->rollback();
			}
		}
		if($id)
			return $bt;
	}
	
	function modify_order($sales_id, $type, $goods_id, $qty, $assign_qty = 0, $orig_qty = 0, $goods_id2 = "", $trans = false) {
		if(empty($sales_id) || empty($type)) return false;
		
		$sales = M("sales")->where("id = $sales_id")->find();
		if(empty($sales))
			return false;
		
		if($sales["assign_status"] == 0) {
			return true;
		}
		
		$goods = M("goods")->field("id")->where("id = $goods_id")->find();
		if(empty($goods)) {
			return false;
		}
		
		if($type == "replace") {
			if(empty($goods_id2)) return false;
			$goods2 = M("goods")->field("id")->where("id = $goods_id2")->find();
			if(empty($goods2)) {
				return false;
			}
		}
		
		if($trans)
			M()->startTrans();
		
		$result = false;
		if($type == "add") {
			
		} elseif($type == "delete") {
			$result = stock1_releaselock($goods_id, $sales_id, $sales["order_no"], \OrderType::$sales, $qty);
		} elseif ($type == "modify") {
			if($orig_qty > $qty) {
				if($qty < $assign_qty) {
					$result = stock1_releaselock($goods_id, $sales_id, $sales["order_no"], \OrderType::$sales, $assign_qty - $qty);
					if($result) {
						$lastchanged = M("sales_detail")->where("sales_id = $sales_id AND goods_id = ".$goods_id)->getField("lastchanged");
						$result = M("sales_detail")->where("sales_id = $sales_id AND goods_id = ".$goods_id ." AND lastchanged = '$lastchanged'")->save(array("assign_qty"=>$qty));
					}
				}
				
			}
		} else {
			$result = stock1_releaselock($goods_id, $sales_id, $sales["order_no"], \OrderType::$sales, $assign_qty);
		}
		
		M("sales")->where("id = $sales_id AND assign_status <> 0")->save(array("assign_result"=>2));
		if($trans) {
			if($result)
				M()->commit();
			else 
				M()->rollback();
		}
		
		return $result;
	}
	
	function orderurl($source_no,$folder="") {
		
		$arr = GenOrderNo("", true);
		
		foreach($arr as $k=>$v) {
			if($v["pre"] == substr($source_no, 0, strlen($v["pre"]))) {
				$url = $v["url"];
				if(strpos($url, "?") === false) {
					$url .= "?no=".$source_no;
				} else {
					$url .= "&no=".$source_no;
				}
				if($folder!="" && $folder!="/Home/"){
          $url = str_replace("/Home/",$folder,$url);					
				}
				return $url;
			}
		}
		
		//临时使用，解决测试中单据问题
		$arr = GenOrderNo("", true, $prefix);
		
		foreach($arr as $k=>$v) {
			 $v["pre"] = str_replace($prefix,"",$v["pre"]);
			if($v["pre"] == substr($source_no, 0, strlen($v["pre"]))) {
				$url = $v["url"];
				if(strpos($url, "?") === false) {
					$url .= "?no=".$source_no;
				} else {
					$url .= "&no=".$source_no;
				}
				if($folder!="" && $folder!="/Home/"){
          $url = str_replace("/Home/",$folder,$url);					
				}
				return $url;
			}
		}
		
		return "1";
	}

/**
 * @param string $id
 * @return bool
 */
function erp_assign_stock_out($id = "") {
		active_stockdeliver();
		//$assign_rule = M("system_parameter")->where("code = 'assign_rule'")->getField("value");
		$where = "";
		if($id) {
			$where .= " AND id = $id";
		}
		
		$berr = false;
		$stock_out = M("stock_out")->where("status = 0 AND assign_status <> 1" . $where)->select();
		foreach($stock_out as $stock_out_val) {
			M()->startTrans();
			try {
				$stock_out_detail = M("stock_out_detail")->where("stock_out_id = ".$stock_out_val["id"] ." AND order_qty > qty")->select();
				$sales_qty = array();
				$mqty = 0;
				foreach($stock_out_detail as $stock_out_detail_val) {
					$location = array();
					$aqty = 0;
					$stock3 = M("stock3")->where("storage_code = '".$stock_out_val["storage_code"]."' AND qty - qty_lock > 0 AND goods_no = '".$stock_out_detail_val["goods_no"]."' AND location_code <> '' AND location_code is not null")->order("qty - qty_lock desc")->select();
					if(empty($stock3)) {
						continue;
					}
					foreach($stock3 as $stock3_val) {
						$oos_all = false;
						$s3_qty = floatval($stock3_val["qty"]) - floatval($stock3_val["qty_lock"]);
						$qty = floatval($stock_out_detail_val["order_qty"]) - floatval($stock_out_detail_val["qty"]);
						
						$assign_qty = 0;
						if($s3_qty >= $qty) {
							$assign_qty = $qty;
						} else {
							$assign_qty = $s3_qty;
						}
						
// 						if(!stock1_lock($stock_out_detail_val["goods_id"], $stock_out_val["id"], $stock_out_val["order_no"], OrderType::$stockOut, $assign_qty)) {
// 							E("商品[".$stock_out_detail_val["goods_no"]."] 锁定库存失败,数量:$assign_qty");
// 						}
						
// 						if(!stock2_lock($stock3_val["storage_id"], $stock_out_detail_val["goods_id"], $stock_out_val["id"], $stock_out_val["order_no"], OrderType::$stockOut, $assign_qty)) {
// 							E("商品[".$stock_out_detail_val["goods_no"]."]在仓库[".$stock3_val["storage_code"]."] 锁定库存失败,数量:$assign_qty");
// 						}
						
						if(!stock3_lock($stock3_val["storage_id"], $stock3_val["location_code"], $stock_out_detail_val["goods_id"], $stock_out_val["id"], $stock_out_val["order_no"], OrderType::$stockOut, $assign_qty)) {
							E("商品[".$stock_out_detail_val["goods_no"]."]在仓库[".$stock3_val["storage_code"]."]库位[".$stock3_val["location_code"]."] 锁定库存失败,数量:$assign_qty");
						}
						
						$aqty += $assign_qty;
						$mqty += $assign_qty;
						$location[$stock3_val["location_code"]] = $assign_qty;
						
						$sl = M("stock_out_location")->where("stock_out_id = ".$stock_out_val["id"] . " AND goods_id = ".$stock_out_detail_val["goods_id"]. " AND location_code = '".$stock3_val["location_code"] ."'")->find();
						$data = array();
						if(empty($sl)) {
							$data["stock_out_id"] = $stock_out_val["id"];
							$data["storage_code"] = $stock_out_val["storage_code"];
							$data["location_code"] = $stock3_val["location_code"];
							$data["goods_id"] = $stock_out_detail_val["goods_id"];
							$data["qty"] = $assign_qty;
							$data["assign_type"] = 1;
							$data["assign_time"] = date("Y-m-d H:i:s");
							M("stock_out_location")->add($data);
						} else {
							$data["qty"] = array("exp", "qty + $assign_qty");
							$data["assign_time"] = date("Y-m-d H:i:s");
							M("stock_out_location")->where("id = ".$sl["id"])->save($data);
						}
						if(!isset($sales_qty[$stock_out_detail_val["goods_id"]])) {
							$sales_qty[$stock_out_detail_val["goods_id"]] = $assign_qty;
						} else {
							$sales_qty[$stock_out_detail_val["goods_id"]] += $assign_qty;
						}
						
						$stock_out_detail_val["qty"] += $assign_qty;
						if($stock_out_detail_val["qty"] == $stock_out_detail_val["order_qty"])
							break;
					}
					
					$ls = array();
					if($stock_out_detail_val["location"] != "") {
						$as = explode("|", $stock_out_detail_val["location"]);
						foreach($as as $a) {
							$ps = explode("#", $a);
							$ls[$ps[0]] = $ps[1];
						}
					}
					
					foreach($location as $k=>$l) {
						if(isset($ls[$k])) {
							$ls[$k] += $l;
						} else {
							$ls[$k] = $l;
						}
					}
					
					$lstr = "";
					foreach($ls as $k=>$l) {
						if($lstr != "") $lstr .= "|";
						$lstr .= $k."#".$l;
					}
					
					M("stock_out_detail")->where("id=".$stock_out_detail_val["id"])->save(array("qty"=>array("exp", "qty + $aqty"), "storage_code"=>$stock_out_val["storage_code"], "location"=>$lstr));
				}
				
				$cnt = M("stock_out_detail")->where("stock_out_id = ".$stock_out_val["id"]." AND qty < order_qty")->count();
				
				if($cnt == 0) {
					$assign_status = 1;
				} else {
					$cnt = M("stock_out_detail")->where("stock_out_id = ".$stock_out_val["id"]." AND qty > 0")->count();
					if($cnt == 0) {
						$assign_status = 3;
					} else {
						$assign_status = 2;
					}
				}
				M("stock_out")->where("id = ".$stock_out_val["id"])->save(array("qty"=>array("exp", "qty + $mqty"), "assign_status"=>$assign_status, "assign_time"=>date("Y-m-d H:i:s"), "modify_time"=>date("Y-m-d H:i:s")));
				
				if($stock_out_val["type"] == 1) {
					foreach($sales_qty as $skey=>$sqty) {
						M("sales_detail")->where("order_no = '".$stock_out_val["source_no"] ."' AND goods_id = $skey")->save(array("stock_qty"=>array("exp", "stock_qty + $sqty")));
					}
				} elseif ($stock_out_val["type"] == 2) {
					foreach($sales_qty as $skey=>$sqty) {
						M("purchase_return_detail")->where("order_no = '".$stock_out_val["source_no"] ."' AND goods_id = $skey")->save(array("stock_qty"=>array("exp", "stock_qty + $sqty")));
					}
				}
				
				M()->commit();
			} catch(Exception $e) {
				M()->rollback();
				$berr = true;
			}
		}
		if($berr)
			return false;
		return true;
	}
	
	function erp_assign_storage_order($sales_id, $dc = "") {
		set_time_limit(0);
		
		if(!$sales_id) return false;
		
		$where = "AND id = $sales_id ";

		$sales_detail = array();
		$storages = array();
		$modify_time = "";
		$stock_out_id=0;
		
//		$sales = M("sales")->where("(status <> 1 AND status <> 6 AND status <> 8) AND (assign_status = 1 OR assign_status = 2) $where")->order("modify_time asc")->limit(5000)->select();
//		foreach($sales as $s) {

		$s = M("sales")->where("status=2 $where")->find();
		if (empty($s)) return false;
		
    $now = date("Y-m-d H:i:s");
			
			M()->startTrans();

			$s["assign_status"] = 1;
			$s["assign_result"] = 0;
			
			$modify_time = $s["modify_time"];
			$total_assign_qty = 0;
			try {

			  if(!empty($s["init_code"])){
			     $ret=M("download_intercept")->where("init_code='".$s["init_code"]."'")->find();
			     if(!empty($ret)){
			  			 E("销售订单[".$s["order_no"]."]被拦截");
			     }
			  }
        
			  if(empty($s["storage_code"])){
			  	  E("销售订单[".$s["order_no"]."]没有指定仓库");
			  }

			  if(empty($s["customer_code"])){
			  	  E("销售订单[".$s["order_no"]."]客户不存在");
			  }
				
				$customer = M("customer")->where("code = '".$s["customer_code"]. "'")->find();
				if(empty($customer)) {
					 E("客户对应不存在");
				}
				
				$count = 0;
				$sales_detail = M("sales_detail")->where("sales_id = " . $s["id"])->select();

        $sql=table("select case when b.id is null then 1 else 0 end miss ,a.barcode,a.qty,case when b.id is not null and a.qty>b.qty-b.qty_lock then 1 else 0 end stock
                    from @sales_detail a 
                    left join @stock2 b on b.storage_code='".$s["storage_code"]."' and a.goods_id=b.goods_id 
                    where a.sales_id=". $s["id"]." and (b.id is null or b.id is not null and a.qty>b.qty-b.qty_lock)");


        $ret = M()->query($sql);
        if (empty($ret))
				   $assign_all = true;
        else {
				   $assign_all = false;
				   $miss_count=0;
				   $miss="";
				   $stock_count=0;
				   $stock="";
				   
				   foreach($ret  as $row) {
				   	   if($row['miss']){
				   	   	   if($match_count<2){
				   	   	   	   $match=$match.($match?",":"").$row['barcode'];
				   	   	   }
				   	   	   $match_count++; 
				   	   }
				   	   if($row['stock']){
				   	   	   if($stock_count<2){
				   	   	   	   $stock=$stock.($stock?",":"").$row['barcode'];
				   	   	   }
				   	   	   $stock_count++; 
				   	   } 
				   	    
        	 }
				   unset($row);
        	 
        	 $str="";
        	 if($match_count>0)
        	     $str=$str.($str?"，":"").$match.($match_count>2?"等".$match_count."个":"")."未匹配";
        	 if($stock_count>0)
        	     $str=$str.($str?"，":"").$stock.($stock_count>2?"等".$stock_count."个":"")."库存不足";
        	     
					 E("$str");
        } 
/*
				$assign_all = true;
				foreach($sales_detail as $sd) {
					$detail_qty = intval($sd["qty"]);
					$stock3 = M("stock3")->where("storage_code = '".$s["storage_code"]."' AND qty - qty_lock > 0 AND goods_no = '".$sd["goods_no"]."' AND location_code <> '' AND location_code is not null")->order("qty - qty_lock desc")->select();
					if(empty($stock3)) {
						E("商品编号[".$sd["barcode"]."]无库存");
						$assign_all = false;
						break;
					}
					foreach($stock3 as $stock3_val) {
						$stockqty = intval($stock3_val["qty"]) - intval($stock3_val["qty_lock"]);
						if($stockqty <= 0) {
							continue;
						}
						$detail_qty -= $stockqty;
					}
					unset($stock3_val);
					if($detail_qty > 0) {
						$assign_all = false;
					}

					if(!$assign_all) {
						E("商品编号[".$sd["barcode"]."]库存不足");
						break;
					}
				}
				unset($sd);
*/				

				if($assign_all) {
					
					$location = array();
					$detail_location = array();
					foreach($sales_detail as $sd) {
						$detail_qty = intval($sd["qty"]);
						$stock3 = M("stock3")->where("storage_code = '".$s["storage_code"]."' AND qty - qty_lock > 0 AND goods_no = '".$sd["goods_no"]."' AND location_code <> '' AND location_code is not null")->order("qty - qty_lock desc")->select();
						if(empty($stock3)) {
							E("商品编号[".$sd["barcode"]."]的库存不足");
						}
						foreach($stock3 as $stock3_val) {
							if($detail_qty <= 0) break;
							$stockqty = intval($stock3_val["qty"]) - intval($stock3_val["qty_lock"]);
							if($stockqty <= 0) {
								continue;
							}
							$assign_qty = 0;
							if($stockqty < $detail_qty) {
								$assign_qty = $stockqty;
							} else {
								$assign_qty = $detail_qty;
							}

							M("sales_detail")->where("id=".$sd["id"])->save(array("oos_qty"=>0, "assign_qty"=>array("exp", "assign_qty + $assign_qty")));
							if(!stock3_lock($stock3_val["storage_id"], $stock3_val["location_code"], $sd["goods_id"], $s["id"], $s["order_no"], OrderType::$sales, $assign_qty)) {
								E("商品编号[".$sd["barcode"]."]锁定库存失败,数量:$assign_qty");
							}
							$total_assign_qty += $assign_qty;
							if(!isset($location[$sd["goods_id"]]) || !isset($location[$sd["goods_id"]][$stock3_val["location_code"]])) {
								$location[$sd["goods_id"]][$stock3_val["location_code"]] = $assign_qty;
							} else {
								$location[$sd["goods_id"]][$stock3_val["location_code"]] += $assign_qty;
							}

							if(isset($detail_location[$sd["goods_id"]]) && $detail_location[$sd["goods_id"]] != "") {
								$detail_location[$sd["goods_id"]] .= "|";
							}
							$detail_location[$sd["goods_id"]] = $stock3_val["location_code"] . "#" . $assign_qty;
							$detail_qty -= $assign_qty;
						}
						unset($stock3_val);
						if($detail_qty > 0) {
							E("商品编号[".$sd["barcode"]."]的库存不足");
						}
					}
					unset($sd);

					$tmpsave = array("assign_status"=>2, "assign_result"=>1, "assign_time"=>$now, "notice_status"=>1, "notice_time"=>$now,  "modify_time"=>$now);
//					if($s["status"] == 2) {
						$tmpsave["status"] = 4;  //已通知
//					}
					$tmp = M("sales")->where("id = ".$s["id"]. " AND status='2' AND modify_time = '$modify_time'")->save($tmpsave);
					$modify_time = $now;

					if(!$tmp) {
						E("销售订单被修改");
					}

					$stock_out = array();
					$stock_out["order_no"] = GenOrderNo("stock_out");
					$stock_out["tx_date"] = date("Y-m-d");
					$stock_out["type"] = 1;
					$stock_out["source_no"] = $s["order_no"];
					$stock_out["storage_code"] = $s["storage_code"];

					$stock_out["init_code"] = $s["init_code"];

					$stock_out["customer_code"] = $customer["code"];
					$stock_out["customer_name"] = $customer["short_name"];

					$stock_out["create_by"] = 0;
					$stock_out["qty"] = $s["qty"];
					$stock_out["amount"] = $s["amount"];
					$stock_out["boxs"] = 0;
					$stock_out["count"] = count($sales_detail);

					$stock_out["deliver_code"] = array("exp", "''");
					$stock_out["deliver_name"] = array("exp", "''");
					$stock_out["deliver_post"] = array("exp", "''");
					$stock_out["init_code"] = $s["init_code"];
					$stock_out["remarks"] = array("exp", "''");
					$stock_out["status"] = 0;
					$stock_out["confirm_status"] = 0;
					$stock_out["cancel_status"] = 0;
					$stock_out["create_time"] = date("Y-m-d H:i:s");
					$stock_out["create_user"] = "system";
					$stock_out["modify_time"] = date("Y-m-d H:i:s");
					$stock_out["modify_user"] = "system";
					$stock_out["order_qty"] = $s["qty"];
					$stock_out["assign_status"] = 1;
					$stock_out["assign_time"] = date("Y-m-d H:i:s");
					$stock_out["details"] = count($sales_detail);
					$stock_out_id = M("stock_out")->add($stock_out);

					$total_weight = 0;
					foreach($sales_detail as $sd) {
						$stock_out_detail = array();
						$stock_out_detail["stock_out_id"] = $stock_out_id;
						$stock_out_detail["order_no"] = $stock_out["order_no"];
						$stock_out_detail["storage_code"] = $s["storage_code"];
						$stock_out_detail["goods_id"] = $sd["goods_id"];
						$stock_out_detail["goods_no"] = $sd["goods_no"];
						$stock_out_detail["barcode"] = $sd["barcode"];
						$stock_out_detail["goods_name"] = $sd["goods_name"];
						$stock_out_detail["brand_code"] = $sd["brand_code"];
						$stock_out_detail["style_info"] = $sd["style_info"];
						$stock_out_detail["price"] = $sd["price"];
						$stock_out_detail["qty"] = $sd["qty"];
						$stock_out_detail["location"] = $detail_location[$sd["goods_id"]];
						$stock_out_detail["amount"] = $sd["amount"];
						$stock_out_detail["order_qty"] = $sd["qty"];
						M("stock_out_detail")->add($stock_out_detail);
					}
					unset($sales_detail, $sd);

					foreach($location as $key=>$val) {
						foreach($val as $item_key=>$item) {
							$data = array();
							$data["stock_out_id"] = $stock_out_id;
							$data["storage_code"] = $s["storage_code"];
							$data["location_code"] = $item_key;
							$data["goods_id"] = $key;
							$data["qty"] = $item;
							$data["assign_type"] = 1;
							$data["assign_time"] = date("Y-m-d H:i:s");
							M("stock_out_location")->add($data);
						}
					}

					unset($location, $key, $val, $item_key, $item);
				}
			} catch (Think\Exception $te) {
				M()->rollback();
				log_sales($s["id"], "assign", "配货失败", $te->getMessage(), 1, "", "","error");
				
				$tmpsave = array("assign_status"=>2, "assign_result"=>4, "assign_time"=>$now, "modify_time"=>$now);
				M("sales")->where("id = ".$s["id"]. " AND modify_time = '$modify_time'")->save($tmpsave);
				return false;
			} catch(Exception $e) {
				M()->rollback();
				log_sales($s["id"], "assign", "配货失败", $e->getMessage(), 1, "", "","error");

				$tmpsave = array("assign_status"=>2, "assign_result"=>4, "assign_time"=>$now, "modify_time"=>$now);
				M("sales")->where("id = ".$s["id"]. " AND modify_time = '$modify_time'")->save($tmpsave);
				return false;
			}
		  log_sales($s["id"], "assign", "配货成功", "共配货".$total_assign_qty."件", 1, "", "");
			M()->commit();
			
			if($assign_all) {
				$ret= erp_get_express($stock_out_id, $dc,$message);
				if(!$ret && $message){
		        log_sales($s["id"], "assign", "取快递失败",$message,  1, "", "");
				}
			}
		  return true;
	}

	function erp_get_express($stock_out_id,$dc, &$message="") {
		$message="";
		
		if(empty($stock_out_id)){ 
			  $message="传入参数错误";
			  return false;
		}
		
		$stock_out = M("stock_out")->where("id = $stock_out_id")->find();
		
		if (empty($stock_out)){
			  $message="出库单据不存在或状态非法";
			  return false;
		}
		if ($stock_out['deliver_post']){
			  return true;
		}
		if ($stock_out['status']!=0){
			  $message="出库单据非待审状态";
			  return false;
		}
		if ($stock_out['type']!="1"){
			  $message="出库单据非销售订单";
			  return false;
		}

		$order_no=$stock_out['source_no'];

		$s = M("sales")->where("order_no = '$order_no'")->find();
		if(empty($s)) {
			 $message="销售订单不存在";
			 return false;
	  }
		
		
		$customer = M("customer")->field("address, phone, mobile, deliver_code")->where("code = '".$s["customer_code"]. "'")->find();
		if(empty($customer)) {
			 $message="客户对应不存在";
			return false;
		}
		if($dc == "") {
			$dc = $customer["deliver_code"];
		}

		$j_tel = $customer["phone"];
		$j_address = $customer["address"];
		$j_name = $customer["name"];
		$pay_method = 1;

		$express_no = "";
		$origin_code = "";
		$dest_code = "";
		$express_data = "";
		$message = "";
		$total_weight = 0;
		$s["qty"] = intval($s["qty"]);


		$deliver_code = $dc;
		$deliver_name = M("deliver")->where("code = '".$dc."'")->getField("name");
		if(empty($deliver_name)) {
			 $message="快递公司对应不存在";
			return false;
		}
    $update_stock=false;
    $interface=false;

     
		if($dc == "SF") {
			$express_type = 38;
			$express_name = "顺丰特惠";
			$feeaccount = "0212107840";

      $interface=ShunfengInterface_OrderService($j_name, "", $j_tel, "", $j_address, $s["consignee"], $s["consignee"], $s["telphone"], $s["mobile"], $s["address"], $s["init_code"], $express_type, $pay_method,1, $feeaccount, $total_weight, "", "", $s["remarks"], $express_no, $origin_code, $dest_code, $message);
			if($interface) {
				 $message = "$deliver_name, $express_name, $express_no";
			   try {
				     $update_stock= M("stock_out")->where("id = $stock_out_id and status=0 and deliver_post=''")->save(array("express_account"=>$feeaccount, "express_name"=>$express_name, "express_type"=>$express_type, "deliver_name"=>$deliver_name, "deliver_code"=>$deliver_code, "deliver_post"=>$express_no, "origin_code"=>$origin_code, "dest_code"=>$dest_code));
			   } catch(Exception $e) {
			   	   $message.=", 更新出库单失败";
			   }
			}
		} elseif($dc == "HT") {
			$express_type = 4;
			$express_name = "标准快件";
			$feeaccount = "";
      $interface=HuitongInterface_OrderService($j_name, "", $j_tel, "", $j_address, $s["consignee"], $s["consignee"], $s["telphone"], $s["mobile"], $s["address"], $s["init_code"], $express_type, $pay_method,1, $feeaccount, $total_weight, "", "", $s["remarks"], $express_no, $origin_code, $dest_code, $express_data, $message);
			if($interface) {
				 $message = "$deliver_name, $express_name, $express_no";
			   try {
				    $update_stock=M("stock_out")->where("id = $stock_out_id")->save(array("express_account"=>$feeaccount, "express_name"=>$express_name, "express_type"=>$express_type, "deliver_name"=>$deliver_name, "deliver_code"=>$deliver_code, "deliver_post"=>$express_no, "origin_code"=>$origin_code, "dest_code"=>$dest_code, "express_data"=>$express_data));
			   } catch(Exception $e) {
			   	   $message.=", 更新出库单失败";
			   }
			}
		}

	  if($update_stock && $interface)
			 createLogOrder('stock_out',$stock_out_id,"更新快递成功","","",$message);
	  else {
	     if($interface)
			      createLogOrder('stock_out',$stock_out_id,"更新快递失败","","",$message);
			 else     
			      createLogOrder('stock_out',$stock_out_id,"快递($deliver_name)接口失败","","",$message);
     }

     return ($update_stock && $interface)?true:false;
	}
	
	function erp_update_platform_stock() {
		set_time_limit(0);
		$shops = M("shop")->where("allow_sync_stock = 1")->select();
		$now = date("Y-m-d H:i:s");
		$pre = C("DB_PREFIX");
		
		$err = array();
		
		verify_goods();
		check_shop_product();
		
		foreach($shops as $shop) {
			try {
				M()->startTrans();
				
				$sql = "update ".$pre."web_product as wp 
						left join 
				(select sku,sum(qty) as qty
				from (
				select b.storage_code,a.sku,(c.qty-c.qty_lock) as qty
				from ".$pre."web_product a
				LEFT JOIN ".$pre."shop_storage b on a.shop_code=b.shop_code
				LEFT JOIN ".$pre."stock2 c on b.storage_code=c.storage_code and a.sku=c.sku
				LEFT JOIN ".$pre."goods as d ON a.goods_no=d.goods_no 
				where a.shop_code='".$shop["code"]."' and a.verify_status=1 and a.sync_stock_set=1
				and b.storage_code is not NULL
				and c.sync_verify=0 and (c.shop_code='' or c.shop_code=a.shop_code) AND d.style_type <> 0 AND d.style_type is not null 
				) a
				group by sku) pp 
				on wp.sku = pp.sku 
				set wp.stock_qty = pp.qty, 
				stock_update_time = '$now', 
				require_stock_sync = 1, 
				require_stock_time = '$now',
				sync_stock_retry = 0,
				sync_stock_result = 0 
				WHERE wp.shop_code = '".$shop["code"] ."' AND wp.verify_status = 1 AND wp.sync_stock_set = 1 AND wp.qty_online <> pp.qty";
				
				M()->execute($sql);
				
				
// 				$sql = "update ".$pre."web_goods as wp
// 						left join
// 				(select goods_code,sum(qty) as qty
// 				from (
// 				select b.storage_code,a.goods_code,(c.qty-c.qty_lock) as qty
// 				from ".$pre."web_goods a
// 				LEFT JOIN ".$pre."shop_storage b on a.shop_code=b.shop_code
// 				LEFT JOIN ".$pre."stock2 c on b.storage_code=c.storage_code and a.goods_code=c.goods_no  
// 				LEFT JOIN ".$pre."goods as d ON a.goods_code=d.goods_no  
// 				where a.shop_code='".$shop["code"]."' and a.verify_status=1 and a.sync_stock_set=1
// 								and b.storage_code is not NULL
// 								and c.sync_verify=0 and (c.shop_code='' or c.shop_code=a.shop_code) AND d.style_type = 0 AND d.style_type is not null 
// 								) a
// 								group by goods_code) pp
// 								on wp.goods_code = pp.goods_code
// 								set wp.stock_qty = pp.qty,
// 								stock_update_time = '$now',
// 								require_stock_sync = 1,
// 								require_stock_time = '$now',
// 								sync_stock_retry = 0,
// 								sync_stock_result = 0
// 								WHERE wp.shop_code = '".$shop["code"] ."' AND wp.verify_status = 1 AND wp.sync_stock_set = 1 AND wp.qty_online <> pp.qty";
				
// 				M()->execute($sql);
				
// 				$data = M()->query($sql);
// 				if(empty($data))
// 					continue;
				
// 				$shop_storage = M("shop_storage")->where("shop_code = '".$shop["code"] ."'")->select();
// 				if(empty($shop_storage)) {
// 					continue;
// 				}
				
// 				$ssid = "";
// 				foreach($shop_storage as $ss) {
// 					if($ssid != '') $ssid .= "', '";
// 					$ssid .= $ss["storage_code"];
// 				}
				
// 				if($ssid == "") {
// 					continue;
// 				}
				
// 				$ssid ="'$ssid'";
				
// 				M()->startTrans();
// 				$web_products = M("web_product")->where("shop_code = '".$shop["code"] ."' AND verify_status = 1 AND sync_stock_set = 1")->select();
// 				foreach($web_products as $web_product) {
// 					$stock2 = M("stock2")->field("sum(qty - qty_lock) as qty")->where("sku = '".$web_product["sku"]."' AND sync_verify = 0 AND (shop_code = '".$shop["code"] ."' OR (shop_code == '' AND storage_code IN($ssid)))")->group("sku")->select();
// 					$qty = 0;
// 					foreach ($stock2 as $s) {
// 						$qty += $s["qty"];
// 					}
// 					M("web_product")->where("id = ".$web_product["id"])->save(array("stock_qty"=>$qty, "stock_update_time">$now, "require_stock_sync"=>1, "require_stock_time"=>$now));
// 				}
				M()->commit();
			} catch(Exception $e) {
				M()->rollback();
				$err[] = $e->getMessage();
				continue;
			}
		}
		
		if($err) {
			$errmsg = implode(";", $err);
			throw new Exception($errmsg);
		}
		
		return true;
	}
	
	//检查商品是否被多家店铺关联
	function check_shop_product() {
		M("stock2")->save(array("sync_verify"=>0));
		
		$pre = C("DB_PREFIX");
		$sql ="select a.storage_code,a.sku
		from (
				select a.storage_code,b.sku
				from (
						select storage_code,shop_code
						from ".$pre."shop_storage
						where storage_code in (select storage_code from  ".$pre."shop_storage group by storage_code HAVING count(*)>1)
				) a
				left join (
						select shop_code, sku
						from ".$pre."web_product
						where verify_status=1 and sku in (select sku from ".$pre."web_product where verify_status=1 GROUP BY sku HAVING count(*)>1)
				) b on a.shop_code = b.shop_code
				where b.sku is not null
				GROUP BY a.storage_code, b.sku
				HAVING count(*)>1
		) a
		left JOIN (
				select storage_code,sku from ".$pre."stock2 where shop_code='' 
		) c on c.storage_code = a.storage_code and c.sku=a.sku
		where c.storage_code is not NULL";
		$data = M()->query($sql);
		foreach($data as $d) {
			M("stock2")->where("storage_code = '".$d["storage_code"]."' AND sku = '".$d["sku"]."'")->save(array("sync_verify"=>1));
		}
	}
	
	function updateservcie($service_code) {
		$service = M("service")->where("service_code = '$service_code'")->find();
		if(!empty($service)) {
			$now = strtotime(date("Y-m-d H:i:s"));
			$next = strtotime("+".$service["run_period"]." minutes");
			M("service")->where("service_code = '$service_code'")->save(array("last_run_time"=>date("Y-m-d H:i:s"), "next_run_time"=>date("Y-m-d H:i:s", $next)));
		}
	}
	
	function erp_notice_deliver($order_id) {
		if(empty($order_id)) return false;
		$sales = M("sales")->field("storage_code")->where("id = $order_id")->find();
		if(empty($sales)) return false;
		
		$storage = M("storage")->field("interface")->where("code = '" .$sales["storage_code"]. "'")->find();
		if(empty($storage)) return false;
		
		if($storage["interface"] == "1") {
//			return erp_notice_deliver_jimu($order_id);
		} else if($storage["interface"] == "2") {
//			return erp_notice_deliver_eland($order_id);
		}
		
		return false;
	}
	


	function verify_goods() {
		set_time_limit(0);
		$goods = M("web_goods")->field("id, goods_id, goods_no")->where("verify_status = 0")->select();
		foreach($goods as $g) {
			$offline_goods = M("goods")->field("id")->where("goods_no = '". $g["goods_no"]."'")->find();
			$verify_status = empty($offline_goods) ? 2 : 1;
			//$sku_nums = M("web_product")->where("goods_id = ".$g["goods_id"])->count();
			M("web_goods")->where("id = ".$g["id"])->save(array("verify_status"=>$verify_status, "verify_time"=>date("Y-m-d H:i:s")));//, "sku_nums"=>$sku_nums
		}

		$products = M("web_product")->field("id, sku")->where("verify_status = 0")->select();
		foreach($products as $p) {
			$offline_product = M("product")->where("barcode = '".$p["sku"]."'")->find();
			$verify_status = empty($offline_product) ? 2 : 1;
			M("web_product")->where("id = ".$g["id"])->save(array("goods_no"=>$offline_product["goods_no"], "verify_status"=>$verify_status, "verify_time"=>date("Y-m-d H:i:s")));
		}
	}
	
	function sycn_stock() {
		set_time_limit(0);
		verify_goods();
		
		$shops = M("shop")->field("id, deliver_storage_code")->where("status = 1")->select();
		foreach ($shops as $shop) {
			sync_shop_goods_stock($shop);
		}
	}
	
	function sync_shop_goods_stock($shop_code) {
		set_time_limit(0);
		if(!is_array($shop_code)) {
			$shop = M("shop")->field("id, code, deliver_storage_code")->where("code = '$shop_code' AND status = 1")->find();
			if(empty($shop)) {
				$log["shop_code"] = $shop_code;
				$log["job"] = "sync_stock";
				$log["content"] = "店铺[$shop_code]不存在";
				M("log_monitor")->add($log);
				return false;
			}
		} else {
			$shop = $shop_code;
		}
		
		$storage = M("storage")->field("code")->where("code = '".$shop["deliver_storage_code"]."' AND status = 1")->find();
		if(empty($storage)) {
			$log["shop_code"] = $shop["code"];
			$log["job"] = "sync_stock";
			$log["content"] = "仓库[".$shop["deliver_storage_code"]."]不存在";
			M("log_monitor")->add($log);
			return false;
		}
		
		$goods = M("web_goods")->field("id, goods_id, putaway_status")->find();
		if(empty($goods) || $goods["putaway_status"] == 2) {
			return false;
		}
		
		foreach($goods as $g) {
			sync_shop_product_stock($shop["code"], $storage["code"], $g["goods_id"]);
		}
	}
	
	function sync_shop_product_stock($shop_code, $storage_code, $goods_id) {
		set_time_limit(0);
		
		$products = M("web_product")->field("id, sku, shop_code")->where("sync_status = 1 AND verify_status = 1 AND shop_code = '$shop_code' AND goods_id = '$goods_id'")->select();
		$goods = array();
		foreach($products as $p) {
			if(!isset($goods[$p["goods_id"]])) {
				$goods[$p["goods_id"]] = M("web_goods")->field("id, goods_id, putaway_status, style_type")->find();
			}
			
// 			if($goods[$p["goods_id"]]["putaway_status"] == 2) {
// 				continue;
// 			}

			$stock2 = M("stock2")->where("storage_code = '".$storage_code."' AND sku = '".$p["sku"] ."'")->find();
			$qty = 0;
			if(!empty($stock2)) {
				$qty = $stock2["qty"] - $stock2["qty_lock"];
				if($qty < 0) $qty = 0;
			}
			
			if($goods[$p["goods_id"]]["style_type"] == 0) {
				M("web_product")->where("id = ". $p["id"] . " AND ((download_update > stock_update_time AND qty_online <> $qty) || (download_update < stock_update_time))")->save(array("stock_qty"=>$qty, "stock_update_time"=>date("Y-m-d H:i:s")));
			} else {
				M("web_product")->where("id = ". $p["id"] . " AND ((download_update > stock_update_time AND qty_online <> $qty) || (download_update < stock_update_time))")->save(array("stock_qty"=>$qty, "stock_update_time"=>date("Y-m-d H:i:s")));
			}
		}
		
		return true;
	}
	
	function product_putaway($goods_no, $status) {
		if(!in_array($status, array(0,1,2))) return false;
		M("web_goods")->where("goods_no = '$goods_no'")->save(array("putaway_status"=>$status, "putaway_time"=>date("Y-m-d H:i:s")));
		return true;
	}
	
	function clean_data() {
		$SERVICE_CODE = "clean_data";
		$pre = C("DB_PREFIX");
		$sql[] = "truncate table ".$pre."log_webtrade";
		

		foreach($sql as $s) {
			M()->execute($s);
		}
		
		updateservcie($SERVICE_CODE);
	}
	
	function log_webtrade($web_trade_id, $type, $subject, $reason, $on_batch, $content_before, $content_after) {
		$weborder = M("web_trade")->where("id=$web_trade_id")->find();
		if(empty($weborder)) {
			return false;
		}
		
		$platform = M("platform")->where("code = '".$weborder["platform_code"]."'")->find();
		if(empty($platform)) {
			return false;
		}
		
		$data["web_trade_id"] = $web_trade_id;
		$data["trade_no"] = $weborder["trade_no"];
		$data["platform_code"] = $platform["code"];
		$data["type"] = $type;
		$data["subject"] = $subject;
		$data["reason"] = $reason;
		$data["on_batch"] = $on_batch;
		$data["content_before"] = $content_before;
		$data["content_after"] = $content_after;
		$data["create_time"] = date("Y-m-d H:i:s");
		$data["create_user"] = $on_batch == 1 ? "system" : session('usercode');
		
		M("log_webtrade")->add($data);
		return true;
	}
	
	function log_sales($sales_id, $type, $subject, $reason, $on_batch, $content_before, $content_after, $is_error="") {
		$sales = M("sales")->where("id=$sales_id")->find();
// 		if(empty($sales)) {
// 			return false;
// 		}
	
		$data["sales_id"] = empty($sales) ? 0 : $sales_id;
		$data["order_no"] = empty($sales) ? "" : $sales["order_no"];
		$data["type"] = $type;
		//$data["trade_no"] = $sales['trade_no'];
		$data["subject"] = $subject;
		if(!empty($reason))
		{
			$data["reason"] = $reason . '; '. (empty($sales) ? "拆分订单,已删除;" : "");
		}else 
		{
			$data["reason"] = (empty($sales) ? "拆分订单,已删除;" : "");
		}
		$data["on_batch"] = $on_batch;
		$data["is_error"] = $is_error!=""?1:0;
		$data["content_before"] = $content_before;
		$data["content_after"] = $content_after;
		$data["create_time"] = date("Y-m-d H:i:s");
		$data["create_user"] = $on_batch == 1 ? "system" : session('usercode');
	
		M("log_sales")->add($data);
		return true;
	}
	
	
	function table_Country(){
		$d=S('Country');
		if (!$d){
			$page_size = 1000;
			$sql = table("select id,code,name from @area where status=1 and parent_id=0  ORDER BY sort");
			$sql .= " LIMIT 0, $page_size";
			$data = M()->query($sql);
			$d = array();
			foreach($data as $val) {
				$d[$val["id"]] = $val;}
				S('Country',$d,array('expire'=> 3600000));
		}
		return $d;
	}

	function system_format($key, $val, $ez = 0) {
		if($ez) {
			$tmp = $val;
			switch ($key) {
				case "D":
				case "DT":
				case "T":
				case "DM":
				case "DTM":
				case "TM":
				case "DX":
				case "DTX":
				case "TX":
					if(strpos($tmp, '-') !== false || strpos($tmp, '/') !== false) {
						if(strpos($tmp, '1900') !== false) return "";
						$year = substr($tmp, 0, 4);
						$year = intval($year);
						if($year <= 1900) return "";
					}
					break;
				case "N":
				case "N0":
				case "N30":
				case "N3":
				case "F1":
				case "F2":
				case "F3":
				case "F4":
				case "F5":
				case "F6":
				case "F7":
				case "F31":
				case "F32":
				case "F33":
				case "F34":
				case "F35":
				case "F36":
				case "F37":
				case "F%":
				case "F%1":
				case "F%2":
					  if(strpos($tmp, ",") !== false) {
						   $tmp = str_replace(",", "", $tmp);
					  }
						if(is_numeric($tmp)) {
							$tmp = floatval($tmp);
						}else{
							return $tmp;
							$tmp = 0;
						}
					
					if((is_numeric($tmp) &&  floatval($tmp) == 0) || $tmp == "0") {
						return "";
					}
					break;
					
			}
		}
		
		switch ($key) {
			case "N":
			case "N0":
				return intval($val);
			case "N30":
			case "N3":
				$v = intval($val);
				$f = $v < 0;
                $v = abs($v);
				$len = strlen($v);
				$k = "";
				for($i = $len - 3;$i > 0;$i -= 3) {
					$k = "," . substr($v, $i, 3). $k;
					if($i - 3 <= 0) {
						$k = substr($v, 0, $i) . $k;
					}
				}
				if($k == "") {
					$k = $v;
				}
				if($f) $k = "-".$k;
				return $k;
			case "F1":
			case "F2":
			case "F3":
			case "F4":
			case "F5":
			case "F6":
			case "F7":
				if($key == "F1") $precision = 1;
				if($key == "F2") $precision = 2;
				if($key == "F3") $precision = 3;
				if($key == "F4") $precision = 4;
				if($key == "F5") $precision = 5;
				if($key == "F6") $precision = 6;
				if($key == "F7") $precision = 7;
				$k = round($val, $precision, PHP_ROUND_HALF_UP);
				return $k;
			case "F31":
			case "F32":
			case "F33":
			case "F34":
			case "F35":
			case "F36":
			case "F37":
				if($key == "F31") $precision = 1;
				if($key == "F32") $precision = 2;
				if($key == "F33") $precision = 3;
				if($key == "F34") $precision = 4;
				if($key == "F35") $precision = 5;
				if($key == "F36") $precision = 6;
				if($key == "F37") $precision = 7;
				$k = round($val, $precision, PHP_ROUND_HALF_UP);
				
				$pos = strpos($k, ".");
				if($pos === false) {
					$v1 = $k;
					$v2 = "";
				} else {
					$v1 = substr($k, 0, $pos);
					$v2 = substr($k, $pos + 1);
				}
				
				if(strlen($v2) != $precision) {
					$v2 = str_pad($v2, $precision, "0", STR_PAD_RIGHT);
				}
				if($v1 != 0)
					$v1 = system_format("N3", $v1);
				
				$k = $v1 ."." .$v2;
				return $k;
			case "F%":
				return intval($val * 100) . "%";
			case "F%1":
				$k = round(floatval($val * 100), 1, PHP_ROUND_HALF_UP);
				return $k . "%";
			case "F%2":
				$k = round(floatval($val * 100), 2, PHP_ROUND_HALF_UP);
				return $k . "%";
			case "D":
			case "DT":
			case "T":
			case "DM":
			case "DTM":
			case "TM":
			case "DX":
			case "DTX":
			case "TX":
				if($key == "D") $format = "Y/m/d";
				if($key == "DT") $format = "Y/m/d H:i:s";
				if($key == "T") $format = "H:i:s";
				if($key == "DM") $format = "Y/m";
				if($key == "DTM") $format = "Y/m/d H:i";
				if($key == "TM") $format = "H:i";
				if($key == "DX") $format = "Ymd";
				if($key == "DTX") $format = "YmdHis";
				if($key == "TX") $format = "His";
				
				if(is_numeric($val)) return date($format, $val);
				$v = strtotime($val);
				if($v == false || $v == -1) return "";
				return date($format, $v);
		}
		
		return $val;
	}
	
	function abc($a) {
		return true;
	}

    function step_add(&$step,$desc,$time,$condition){
        $step[]=array(
            'desc'=>$desc,
            'condition'=>$condition,
            'time'=>$time,
        );
    }

    function getOrderStep($step,$step1=array()){
        $s=array();
        $p=0;

        $break_flag=false;
        $cancel=$step1[0];
        $tagup=$step1[1];
        //if($step1[0]['type']=="") $step1[0]['type']="cancel";
        //if($step1[1]['type']=="") $step1[1]['type']="hangup";

        foreach ($step1 as $j=>$v) {
            $break_flag=$v['condition'] || $break_flag;
        }

        foreach ($step as $k=>$v) {
            $cls='';
            if($v['condition']){
                $cls='current';
                $p=$k;
            }else{
                if($break_flag){
						        foreach ($step1 as $j=>$x) {
						        	if($x['condition']){
			                    $s[]=array(
			                        'type'=>'cancel',
			                        'no'=>'&#xe62d;',
			                        'desc'=>$x['desc'],
			                        'time'=>mb_substr(system_format("DT", $x['time']),2,-3),
			                    );
			                    $k++;
						        	}
						        }
/*                	
                    $s[]=array(
                        'type'=>$cancel['condition']?'cancel':'hangup',
                        'no'=>'&#xe62d;',
                        'desc'=>$cancel['condition']?$cancel['desc']:$tagup['desc'],
                        'time'=>$cancel['condition']?mb_substr(system_format("DT", $cancel['time']),2,-3):mb_substr(system_format("DT", $tagup['time']),2,-3),
                    );
*/
                    $p=$k;
                    break;
                }

            }
            $s[]=array(
                'type'=>$cls,
                'no'=>$k+1,
                'desc'=>$v['desc'],
                'time'=>mb_substr(system_format("DT", $v['time']),2,-3),
            );

        }


        for($i=0;$i<$p;$i++){
            $s[$i]['type']='after';
        }



        return $s;

    }

    function view_log_order($tab_pagesize,$data,$type,$order_no,$id=0)
    {
        if($id>0)
        $viewkey="@log_order.order_id=$id and @log_order.type='$type'";
        else
        $viewkey="@log_order.order_no='$order_no' and @log_order.type='$type'";

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @log_order where $viewkey ");
        $search_sql = table("select @log_order.*,@user.name from @log_order left join @user on @user.code=@log_order.create_user Where $viewkey order by @log_order.id desc");

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

        $sql = $search_sql;
        $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
        $data["list"] = M()->query($sql);
        $pageClass = new \Think\Page($count,$page_size);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"], "");
        $data["page_size"] = $page_size;

        return $data;
    }


    function createLogApply($type,$order_id,$subject,$content=array(),$details=0,$error=""){
      $res=false;         
      $qty=0;
      $amount=0;
      $status=0;
      $company_id=0;
      $info="";
      $Apply_no="";
      if(!is_array($content)){
         $info=$content;
      }
      if(!is_array($content) || is_array($content) && count($content)==0) {
          if ($type) {
              $content = M($type)->find($order_id);
          }
      }
      if (is_array($content)){
          $qty=floatval($content['qty']);
          $amount=floatval($content['amount']);
          $status=intval($content['status']);
          $Apply_no=$content['ayyly_no'];
//          if(isset($content['customer_name'])){
//              $info.=($info?"|":"").$content['customer_name'];
//          }
//          if(isset($content['contract_no'])){
//              $info.=($info?"|":"")."合同[".$content['contract_no']."]";
//          }
      } else {
          $info=$content;
      }

      if($error!="")
         $info=$error;
      else {   
		      if($details<=0 && $order_id){
		         $stable="";
		         $key="";
		      	 switch($type){
		      	 	case "goods":
		      	 	    break;
		      	 	default:
		      	 	    $stable=$type."_detail";
		      	 	    $key=$type."_id";
		      	 	    break;
		      	}
		      	if($stable){
		      	//	 $where="$key=$order_id";
		      	//	 $details=M($stable)->where($where)->count();
		      	}
		      }
      }
      
        $data=array(
            'type'=>$type,
            'company_id'=>$company_id,
            'data_id'=>$order_id,
            'Apply_no'=>$Apply_no,
            'qty'=>$qty,
            'amount'=>$amount,
            'status'=>$status,
            'create_time'=>date('Y-m-d H:i:s'),
            'create_user'=>session(C("USER_AUTH_KEY")),
            'subject'=>$subject,
            'content'=>$info,
            'details'=>$details,
        );

        $res=M('log_apply')->add($data);
        return $res;
    }

function createLogOrder($type,$order_id,$subject,$content=array(),$details=0,$error=""){
    $res=false;
    $qty=0;
    $amount=0;
    $status=0;
    $info="";
    $order_no="";
    if(!is_array($content)){
        $info=$content;
    }
    if(!is_array($content) || is_array($content) && count($content)==0) {
        if ($type) {
            $content = M($type)->find($order_id);
        }
    }
    if (is_array($content)){
        $qty=floatval($content['qty']);
        $amount=floatval($content['amount']);
        $status=intval($content['status']);
        $order_no=$content['order_no'];
//          if(isset($content['customer_name'])){
//              $info.=($info?"|":"").$content['customer_name'];
//          }
//          if(isset($content['contract_no'])){
//              $info.=($info?"|":"")."合同[".$content['contract_no']."]";
//          }
    } else {
        $info=$content;
    }

    if($error!="")
        $info=$error;
    else {
        if($details<=0 && $order_id){
            $stable="";
            $key="";
            switch($type){
                case "goods":
                    break;
                default:
                    $stable=$type."_detail";
                    $key=$type."_id";
                    break;
            }
            if($stable){
                $where="$key=$order_id";
                $details=M($stable)->where($where)->count();
            }
        }
    }

    $data=array(
        'type'=>$type,
        'order_id'=>$order_id,
        'order_no'=>$order_no,
        'qty'=>$qty,
        'amount'=>$amount,
        'status'=>$status,
        'create_time'=>date('Y-m-d H:i:s'),
        'create_user'=>session(C("USER_AUTH_KEY")),
        'subject'=>$subject,
        'content'=>$info,
        'details'=>$details,
    );

    $res=M('log_order')->add($data);
    return $res;
}

function createLogCommon($type,$data_id,$subject,$content=array(),$fields='*',$data_save=array(),$key='code',$needsave=array()){
    $res=false;
    if(!empty($data_save)){
        $res=M('log_common')->add($data_save);
    }else{
        if(trim($type)!=''){
            $m=M($type);
            $r=$m->where("id='%d'",array(intval($data_id)))->field($fields)->find();

            if(is_array($content)){
                $change="";
                if($needsave){
                    foreach ($needsave as $k=>$v) {
                        if($r[$k]!=$content[$k]){
                            if($change)$change.=",";
                            $change.="[".$v.":".$r[$k]."]";
                        }
                    }
                    if($change)
                       $content = $change.";";
                    else
                       $content = "无修改;";
                }else
                    $content=getOrderChange($content,$r,$type);
            }
            if(!empty($r) && $content!="无修改;"){
                $data=array(
                    'type'=>$type,
                    'data_id'=>$data_id,
                    'data_code'=>$r["$key"],
                    'status'=>intval($r['status']),
                    'create_time'=>date('Y-m-d H:i:s'),
                    'create_user'=>session(C("USER_AUTH_KEY")),
                    'subject'=>$subject,
                    'content'=>$content,
                );
                $res=M('log_common')->add($data);
            }else{
                return true;
            }
        }
    }
    return $res;
}

    function getOrderChange($prev,$now,$table,$title=''){

        $skip=array(
            'id',
            'lastchanged',
            'modify_user',
            'modify_time',
            'create_user',
            'create_time'
        );

        $diff=array_diff_assoc($now,$prev);
        if(empty($now)){
            $diff=array_diff_assoc($prev,$now);
        }

        $change='';
        foreach ($diff as $k=>$v) {
            if(in_array($k,$skip))
                continue;
            //$change.="[".getTableComment($table,$k)."]:".((trim($prev[$k])=='')?'无':$prev[$k])."=>".((trim($now[$k])=='')?'无':$now[$k]).",";
            $fieldname=getTableComment($table,$k);
            if($fieldname){
            	  $arr = explode(":",$fieldname.":");
            	  $fieldname=$arr[0]; 
            }
            if($fieldname && (trim($now[$k])!='')){
                $change.="[$fieldname:".$now[$k]."],";
            }
        }
        $change=$title.(trim($change,',')==''?'无修改':trim($change,','));
        return trim($change)==''?'':$change.';';

    }


    function getTableComment($table,$field,$pix='erp_'){
        $r=M()->query("SHOW FULL FIELDS FROM $pix{$table}");
        $comment=$field;
        foreach ($r as $v) {
            if($v['Field']==$field)
                $comment=$v['Comment'];
        }
        return $comment;
    }


function getOrderChangeByJson($json,$saveConditions=array()){

    $skip=array(
        'id',
        'lastchanged',
        'modify_user',
        'modify_time'
    );

    if(empty($saveConditions))
        $saveConditions=array(
            'name',
            'status',
        );


    $change='';

    $needSave=false;

    foreach ($json as $k=>$v) {
        if(in_array($k,$saveConditions)){
            if($v->value!=$v->input->default_value){
                $needSave=true;
            }
        }
    }

    if(!$needSave)
        return false;

    foreach ($json as $k=>$v){
        if(in_array($k,$skip))
            continue;
        if($v->value!=$v->input->default_value)
            $change.="[".$v->label."]:".((trim($v->input->default_value)=='')?'无':$v->input->default_value)."=>".((trim($v->value)=='')?'无':$v->value).",";

    }

    return trim($change)==''?'':$change.';';

}


function getSkuStock($product_id){
   $r = M('stock1')->where("product_id='%d'",array($product_id))->find();
   return $r['qty'];
}

function change_to_quotes($str) {
	return sprintf("'%s'", $str);
}

function sql_condition($condition, $field, $value,$type="char",$opt="=",$skipcheck=0)  //opt = > < >= <= like likeleft likeright
{
	//if (!$skipcheck)
	//{
	//	if(!$value) return $condition ;
	//}
	$condition.=" AND ";
	if(!$opt)$opt="=";

	$field = table($field); // erp_

	switch($type)
	{
		case "int":
		case "num":
		case "bool":
			if(!$value) $value=0 ;
			if($opt=="both" || $opt=="left" || $opt=="right") $opt="=";
			$condition.=$field.$opt.$value;
			break;
		case "date":
		case "datetime":
			if(!$value)
				$tmp ="0000/00/00" ;
				else {
					$tmp = strtotime($value);
					$tmp = date("Y-m-d", $tmp);
				}
				$tmp .= " 00:00:00";
				$condition.=$field.$opt."'$tmp'";
				break;
		case "time":
			if(!$value)
				$tmp ="0000/00/00 00:00:00" ;
				else {
					$tmp = strtotime($value);
					$tmp = "0000/00/00 ".date("H:i:s", $tmp);
				}
				$condition.=$field.$opt."'$tmp'";
				break;
		case "timestamp":
			if(!$value)
				$tmp ="0000/00/00" ;
				else {
					$tmp = strtotime($value);
					$tmp = date("Y-m-d", $tmp);
				}
				$tmp1 = strtotime($tmp ." 00:00:00");
				$tmp2 = strtotime($tmp ." 23:59:59");
				$condition .= "$field >= '$tmp1' AND $field <= '$tmp2'";
				break;
		default:  //char
			if(!$value) $value="";
			switch($opt)
			{
				case "both":
					$condition .= $field." like '%$value%'";
					break;
				case "left":
					$condition .= $field." like '$value%'";
					break;
				case "right":
					$condition .= $field." like '%$value'";
					break;
				default:
					$condition .= $field.$opt."'$value'";
					break;
			}
			break;
	}
	return  $condition ;
}


function arr_compare($array1, $array2){
	$keys=array_keys($array1);
	$before=array();
	$after=array();
	$diff=array();
	foreach ($keys as $val)
	{
		if(isset($array2[$val]))
		{
			if($array1[$val]!=$array2[$val])
			{
				$before[$val]=$array1[$val];
				$after[$val]=$array2[$val];
			}
		}
	}
	if($before || $after)
	{
		$diff[1]=$before;
		$diff[2]=$after;
	}
	return  $diff;
}

function check_user_shop($shop_arr,$shop_code){
	if($shop_arr)
	{
		if(strstr($shop_arr,"'".$shop_code."'")<0)
		{
			return  false;
		}else 
		{
			return  true;
		}
	}
	return  false;
}

function getRoleShopChoose($id){
    $ss=M('role_shop')->where("role_id='%d'",array($id))->select();
    $scs=array();
    foreach ($ss as $sv) {
        $scs[]=$sv['shop_id'];
    }

    return join(",",$scs);
}

function getRoleUserChoose($id){
    $ss=M('role_user')->where("role_id='%d'",array($id))->select();
    $scs=array();
    foreach ($ss as $sv) {
        $scs[]=$sv['user_id'];
    }

    return join(",",$scs);
}

function getShopStorageChoose($code){
    $ss=M('shop_storage')->where("shop_code='%s'",array($code))->select();
    $scs=array();
    foreach ($ss as $sv) {
        $scs[]=$sv['storage_code'];
    }

    return join(",",$scs);
}


function getCategoryTree($items){
    foreach($items as $item)
        $items[$item['parent_id']]['son'][$item['id']] = &$items[$item['id']];
    return isset($items[0]['son']) ? $items[0]['son'] : array();
}

function getTreeData($tree,$selecttype){
    $html='';
    foreach($tree as $t){
        $html.= '<li><input j="'.json_encode($t).'" type="'.(strtolower($selecttype)== 'multi'?'checkbox':'radio').'" name="code[]" value="'.$t[code].'" show="'.$t[name].'">'.$t['name'].'</li>';
        if(isset($t['son'])){
            $html.= '<li><ul>'.getTreeData($t['son'],$selecttype).'</ul></li>';
        }
    }
    return $html;
}


function  order_notice($order_id){
	set_time_limit(0);
	$where = "";
	if($order_id != "") {
		$where = " AND a.id = $order_id";
		$usercode = session ( C ( 'USER_AUTH_KEY' ));
		if($usercode) {
			$where .= " AND ((a.lock_status = 1 AND a.lock_user = '$usercode') OR a.lock_status = 0)";
		} else {
			$where .= " AND a.lock_status = 0";
		}
	} 
	
	$sales = M("sales")->alias("a")->field("a.id, b.interface, a.trade_no")
	->join("__STORAGE__ as b ON a.storage_code = b.code", "LEFT")
	->where("a.status = 3 AND a.notice_status = 0 AND a.assign_status = 2 AND a.assign_result = 1 AND a.hangup_status = 0 AND b.interface = 2 AND TIMESTAMPDIFF(HOUR, a.assign_time, NOW()) >= 2 $where")
	->order("a.modify_time asc")
	->select();
	
	if(empty($sales)) return true;
	
	foreach ($sales as $s) {
		$tmp = splitorder($s["id"], 2, 0, 0, true);
			
		if($order_id != "") {
			if(is_array($tmp)) {
				foreach($tmp as $t) {
					M("sales")->where("id = $t AND trade_no = '".$s["trade_no"]."' status = 3 AND notice_status = 0 AND assign_status = 2 AND assign_result = 1 AND hangup_status = 0 AND TIMESTAMPDIFF(HOUR, assign_time, NOW()) >= 2")->save(array("lock_status"=>0, "notice_status"=>1, "notice_time"=>date("Y-m-d H:i:s"), "modify_time"=>date("Y-m-d H:i:s")));
				}
			}
			return $tmp;
		}
	}
	
	M("sales")->where("status = 3 AND qty = 1 AND notice_status = 0 AND assign_status = 2 AND assign_result = 1 AND hangup_status = 0 AND lock_status = 0 AND TIMESTAMPDIFF(HOUR, assign_time, NOW()) >= 2")->save(array("notice_status"=>1, "notice_time"=>date("Y-m-d H:i:s"), "modify_time"=>date("Y-m-d H:i:s")));
	return true;
	
}

function instr($source, $check) {
	$s = explode(",", $source);
	return in_array($check, $s);
}

function replace_address($address) {
	$address = str_replace("{", "", $address);
	$address = str_replace("}", "", $address);
	$address = str_replace("｛", "", $address);
	$address = str_replace("｝", "", $address);
	return $address;
}

function picking($product_id, &$data) {
	$gm = M("goods_bom")->where("parent_id = 0 AND product_id = $product_id")->find();
	if(empty($gm)) {
		return false;
	} else {
		$gs = M("goods_bom")->field("id, product_id")->where("parent_id = ".$gm["id"])->select();
		if(empty($gs)) {
			if(isset($data[$gm["product_id"]])) {
				$data[$gm["product_id"]]["qty"] += $gm["qty"];
			} else {
				$data[$gm["product_id"]] = $gm;
			}
		} else {
			foreach($gm as $v) {
				picking($v["product_id"], $data);
			}
		}
	}
}

function getSystemParameter($code, $value=true,$default="") {
	if($value){
		$para = M("system_parameter")->where("code = '$code' AND status = 1")->getField("value");
		if (trim($para)=="" && trim($default)!=""){
			  $para=$default;
		} 
	}	
	else 
		$para = M("system_parameter")->where("code = '$code'")->getField("status");
  return $para;  
}

function setSystemParameter($code, $value) {
    $result = M("system_parameter")->where("code = '$code' AND status = 1")->save(array("value"=>"$value"));
    if(!$result )
        throw new Exception("更新系统参数($code)失败-不存在或参数已失效");
    return true;
}

/**
 * 获取当前页面完整URL地址
 */
function get_url() {
	$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	$php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
	$relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
	return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}

function checkStorageLocation($storage_code,$location_code){
    $sl=M('storage_location')->where("storage_code='%s' AND code='%s'",array($storage_code,$location_code))->find();
    return empty($sl);

}
function checkStock3qty($storage_code,$location_code,$good_no,$qty){
	$sl=M('stock3')->where("storage_code='%s' AND location_code='%s' and goods_no='%s' and qty>='%s'",array($storage_code,$location_code,$good_no,$qty))->find();
	return empty($sl);
}
function getStock3goodsqty($storage_code,$location_code,$good_no){
	$sl=M('stock3')->where("storage_code='%s' AND location_code='%s' and goods_no='%s' ",array($storage_code,$location_code,$good_no))->find();
	if(empty($sl)){
		return 0;
	}else{
		return $sl['qty'];
	}
}

//Customer 客户档案
function exist_table_Customer_id($code,$id){
	$sql="SELECT * FROM @customer WHERE code='$code' AND ID <>'$id' LIMIT 1";
	$data = M()->query(table($sql));
	if (empty($data))
		return false;
	return $data[0];
}

//CustomerCategory 客户分类
function exist_table_CustomerCategory_id($code,$id){
	$sql="SELECT * FROM @customer_category WHERE code='$code' AND ID <>'$id' LIMIT 1";
	$data = M()->query(table($sql));
	if (empty($data))
		return false;
	return $data[0];
}

function production_update($qc_id, $assign_id, $qty, &$err,$release=false){
	try {
		if($release)
		{
			$qty=$qty*-1;
		}
		$model_assign=M("production_assign");		
		if(!empty($qc_id))
		{
			$model_qc=M("production_qc");
			$qc_info=$model_qc->where(
					array("order_no"=>$qc_id
					))->find();
			if(!$qc_info)
			{
				throw new Exception("质检信息不存在！");
			}
			
			$result=$model_qc->where(array(
					"order_no"=>$qc_id))->save(array("stock_qty"=>array("exp","stock_qty+".$qty)));
			if(!$result)
			{
				throw new Exception("更新质检信息失败！");
			}
			
			if(!empty($qc_info["assign_no"]))
			{
				$assigninfo=$model_assign->where(array(
						"assign_no"=>$qc_info["assign_no"]))->find();
			}						
		}else
		{
			if(!empty($assign_id))
			{
				$assigninfo=$model_assign->where(array("assign_no"=>$assign_id))->find();	
			}
		}
		
		if(!$assigninfo)
		{
			throw new Exception("任务信息不存在！");
		}
		
		$result=$model_assign->where(array(
				"id"=>$assigninfo['id'],
				//"plan_qty"=>array("exp",">=in_qty+$qty")				
		))->save(array("in_qty"=>array("exp","in_qty+".$qty),
				"act_qty"=>array("exp","act_qty+".$qty)
		));
		if(!$result)
		{
			throw new Exception("更新任务信息失败！");
		}
		
		if(empty($assigninfo['parent_assign_no']))
		{
			$model_production=M("production");
			$productioninfo=$model_production->find($assigninfo['production_id']);
			if(!$productioninfo)
			{
				throw new Exception("生产计划不存在！");
			}
				
			$result=$model_production->where(
					array("id"=>$assigninfo['production_id'],
							//"plan_qty"=>array("exp",">=act_qty+$qty")							
					))->save(array("act_qty"=>array("exp","act_qty+".$qty)));
			if(!$result)
			{
				throw new Exception("更新计划信息失败！");
			}
			if(!empty($productioninfo['source_no']))
			{
				$model_sales=M("sales_detail");
				$detailinfo=$model_sales->where(array(
						"order_no"=>$productioninfo['source_no'],
						"goods_id"=>$productioninfo['goods_id'],
				))->find();
				if(!$detailinfo)
				{
					throw new Exception("销售订单明细信息不存在！");
				}
				if($detailinfo['production_qty']>0){
				   if($detailinfo['production_qty']<$qty)
				   {
				   	$qty=$detailinfo['production_qty'];
				   }
				   $result=$model_sales->where(
				   		array("order_no"=>$productioninfo['source_no'],
				   				"goods_id"=>$productioninfo['goods_id'],
				   		))->save(array(
				   				"production_qty"=>array("exp","production_qty-".$qty)								
				   		));
				   		if(!$result)
				   		{
				   			throw new Exception("更新销售信息失败！");
				   		}
			  }
			}
			
		}
		return true;
	}catch (\Exception $ex)
	{
		$err=$ex->getMessage();
		return false;
	}
	
}

function ShunfengInterface_OrderService($j_company, $j_contact, $j_tel, $j_mobile, $j_address, $d_company, $d_contact, $d_tel, $d_mobile, $d_address, $orderid, $express_type, $pay_method, $parcel_quantity, $custid, $cargo_total_weight, $sendstarttime, $order_source, $remark, &$sExpressNo, &$sOriginCode, &$sDestCode, &$sMessage) {
	$j_province = "";
	$j_city = "";
	$j_county = "";
	$d_province = "";
	$d_city  = "";
	$d_county  = "";
	$sXml  = "";
	$oDoc  = new \DOMDocument();
	$sRetOrderNo  = "";
	$xNode = new \DOMNode();
	$arr = array();
	$sErrorMessage = "";

    $sMessage = "";
    $sExpressNo = "";
    $sDestCode = "";
    $sOriginCode = "";

    $j_address = trim($j_address);
    if(str_word_count($j_address, " ") >= 3) {
		$arr = explode(" ", $j_address);
		$j_province = $arr[0];
        $j_city = $arr[1];
        $j_county = $arr[2];
	}

	$d_address = str_replace("+", "十", $d_address);
	$d_address = str_replace("&", "@", $d_address);

    $d_address = trim($d_address);
    if(str_word_count($d_address, " ") >= 3) {
        $arr = explode(" ", $d_address);
        $d_province = $arr[0];
        $d_city = $arr[1];
        $d_county = $arr[2];
    }

	$j_address = str_replace(" ", "", $j_address);
	$d_address = str_replace(" ", "", $d_address);


    $sXml = "<Order j_company='" . $j_company . "' j_contact='" . $j_contact . "' j_tel='" . $j_tel . "' j_mobile='" . $j_mobile . "' j_province='" . $j_province . "' j_city='" . $j_city . "' j_county='" . $j_county . "' j_address='" . $j_address . "' " .
                  "d_company='" . $d_company . "' d_contact='" . $d_contact . "' d_tel='" . $d_tel . "' d_mobile='" . $d_mobile . "' d_province='" . $d_province . "' d_city='" . $d_city . "' d_county='" . $d_county . "' d_address='" . $d_address . "' " .
                  "orderid ='" . $orderid . "' express_type ='" . $express_type . "' pay_method ='" . $pay_method . "' parcel_quantity ='" . $parcel_quantity . "' custid ='" . $custid . "' cargo_total_weight ='" . $cargo_total_weight . "' sendstarttime ='" . $sendstarttime . "' order_source ='" . $order_source . "' remark ='" . $remark . "' > " .
            "</Order>";

    if(!XMLHttpPOST_ShunFeng("OrderService", $sXml, $oDoc, $sErrorMessage, $orderid)) {
        $sMessage =  $sErrorMessage;
        return false;
	}

	$xPath = new \DOMXPath($oDoc);
	$xNode =$xPath->query("Body/OrderResponse");
    if($xNode->length == 0) {
        $sMessage = "订单(" . $orderid . ")顺丰接口未返回快递信息(" . $oDoc->saveXML() . ")";
        return false;
    }

	$xNode = $xNode->item(0);

    $sRetOrderNo = GetXmlNodeValue($xNode, "orderid", true);
    $sExpressNo = GetXmlNodeValue($xNode, "mailno", true);
    $sDestCode = GetXmlNodeValue($xNode, "destcode", true);
    $sOriginCode = GetXmlNodeValue($xNode, "origincode", true);

    return $sExpressNo != "";
}

function ShunfengInterface_OrderChildsService($sMarketNo, $sExpressNo, $nums, &$sChilds, &$sMessage) {
	$sXml = "";
	$oDoc = new \DOMDocument();
	$sRetOrderNo = "";
	$xNode = "";
	$arr = array();
	$sErrorMessage = "";
	$lindex = 0;
	$smain_mailno = "";
	$sorderid = "";

    if(!($nums >= 1 && $nums <= 20)) {
        $sMessage = "顺丰快递子单最多20份";
        return false;
	}

	$sMessage = "";
	$sChilds = "";

    $sXml = "<OrderZD orderid ='" . $sMarketNo . "' parcel_quantity ='" . $nums . "'/>";

    if(!XMLHttpPOST_ShunFeng("OrderZDService", $sXml, $oDoc, $sErrorMessage, $sMarketNo)) {
        $sMessage =  $sErrorMessage;
        return false;
	}

	$xPath = new \DOMXPath($oDoc);
	$xNode = $xPath->query("Body/OrderZDResponse/OrderZDResponse");

    if($xNode->length == 0) {
        $sMessage = "订单(" . $sMarketNo . ")顺丰接口返回数据没有内容";
        return false;
    }

	$xNode = $xNode->item(0);
	$smain_mailno = GetXmlNodeValue($xNode, "main_mailno", true);
	$sChilds = GetXmlNodeValue($xNode, "mailno_zd", true);
    $sorderid = GetXmlNodeValue($xNode, "orderid", true);

    return $sChilds != "";
}

function XMLHttpPOST_ShunFeng($sServiceName, $sxmlcontent, &$oDoc, &$sErrorMessage) {
	$sErrorCode = "";
	$XmlHttp = "";
	$PostData = "";
	$sVerifyCode = "";
	$sResponse = "";
	$sXml = "";
	$xNode = "";
    $sUrl = "";

    $sErrorMessage = "";
	$EXPRESS_Url = "http://bsp-oisp.sf-express.com/bsp-oisp/sfexpressService?wsdl";
	$EXPRESS_InCode = "0212107840";
	$EXPRESS_Checkword = "cAh0YtjBVZ8A7D6A5blC0x7dn5TW2Nqm";
	$EXPRESS_FeeAccount = "0212107840";
    $sXml = "<Request service='" . $sServiceName . "' lang='zh-CN'><Head>" . $EXPRESS_InCode . "</Head><Body>" . $sxmlcontent . "</Body></Request>";

    $sVerifyCode = $sXml . $EXPRESS_Checkword;
    $sVerifyCode = strtoupper(md5($sVerifyCode));
    $sVerifyCode = GetEncoded($sVerifyCode);

    $sUrl = $EXPRESS_Url;

    $PostData = "xml=" . $sXml . "&verifyCode=" . urlencode($sVerifyCode);
	include_once APP_PATH."Api/Common/function.php";
	if(!$result = makeRequest($sUrl, $PostData, "POST")) {
		$sErrorMessage = "顺丰接口返回数据不存在";
		return false;
	}
	$oDoc = new \DOMDocument();
	if(!$oDoc->loadXML($result)) {
		$sErrorMessage = "读取顺丰接口数据错误";
		return false;
	}

	$xPath = new \DOMXPath($oDoc);
	$xNode = $xPath->query("Head");
	if($xNode->length == 0) {
		$sErrorMessage = "顺丰接口返回数据不存在";
		return false;
	}

	if($xNode->item(0)->nodeValue == "ERR") {
		$xNode = $xPath->query("ERROR");
		if($xNode->length == 0) {
			$sErrorMessage = "顺丰接口数据错误";
			return false;
		}
		$sErrorCode = GetXmlNodeValue($xNode->item(0), "code", true);
        $sErrorMessage = "顺丰接口数据错误(" . $sErrorCode . ")" .$xNode->item(0)->textContent;

		return false;
	}

    return true;
}

function HuitongInterface_OrderService($j_company, $j_contact, $j_tel, $j_mobile, $j_address, $d_company, $d_contact, $d_tel, $d_mobile, $d_address, $orderid, $express_type, $pay_method, $parcel_quantity, $custid, $cargo_total_weight, $sendstarttime, $order_source, $remark, &$sExpressNo, &$sOriginCode, &$sDestCode, &$sExpressData, &$sMessage) {
	$j_province = "";
	$j_city = "";$j_county = "";
	$d_province  = "";
	$d_city = "";
	$d_county = "";
	$sXml = "";
	$oDoc = new \DOMDocument();
	$sRetOrderNo = "";
	$xNode = new \DOMNode();
	$arr = array();
	$sErrorMessage  = "";
    $sMessage = "";
    $sExpressNo = "";
    $sDestCode = "";
    $sOriginCode = "";
    $sExpressData = "";

    $j_address = trim($j_address);
    if(str_word_count($j_address . " ", " ") >= 3) {
        $arr = explode(" ", $j_address . " ");
        $j_province = $arr[0];
		$j_city = $arr[1];
		$j_county = $arr[2];
    }

	$d_address = str_replace("+", "十", $d_address);
	$d_address = str_replace("&", "@", $d_address);

    $d_address = trim($d_address);
    if(str_word_count($d_address . " ", " ") >= 3) {
        $arr = explode(" ", $d_address . " ");
        $d_province = $arr[0];
        $d_city = $arr[1];
        $d_county = $arr[2];
    }

	$j_address = str_replace(" ", "", $j_address);
	$d_address = str_replace(" ", "", $d_address);

    $j_address = str_replace("·", ".", $j_address);
    $d_address = str_replace("·", ".", $d_address);

    $sXml = $sXml . GenXmlNode_HuiTong("sendMan", $j_contact, true);
    $sXml = $sXml . GenXmlNode_HuiTong("sendManPhone", $j_mobile, true);
    $sXml = $sXml . GenXmlNode_HuiTong("sendManAddress", $j_address, true);
    $sXml = $sXml . GenXmlNode_HuiTong("sendPostcode", "", true);
    $sXml = $sXml . GenXmlNode_HuiTong("sendProvince", $j_province, true);
    $sXml = $sXml . GenXmlNode_HuiTong("sendCity", $j_city, true);
    $sXml = $sXml . GenXmlNode_HuiTong("sendCounty", $j_county, true);
    $sXml = $sXml . GenXmlNode_HuiTong("receiveMan", $d_contact, true);
    $sXml = $sXml . GenXmlNode_HuiTong("receiveManPhone", $d_mobile);
    $sXml = $sXml . GenXmlNode_HuiTong("receiveManAddress", $d_address, true);

    $sXml = $sXml . GenXmlNode_HuiTong("receivePostcode", "", true);
    $sXml = $sXml . GenXmlNode_HuiTong("receiveProvince", $d_province, true);
    $sXml = $sXml . GenXmlNode_HuiTong("receiveCity", $d_city, true);
    $sXml = $sXml . GenXmlNode_HuiTong("receiveCounty", $d_county, true);
    $sXml = $sXml . GenXmlNode_HuiTong("txLogisticID", $orderid, true);
    $sXml = $sXml . GenXmlNode_HuiTong("itemName", "", true);
    $sXml = $sXml . GenXmlNode_HuiTong("itemWeight", $cargo_total_weight, true);
    $sXml = $sXml . GenXmlNode_HuiTong("itemCount", $parcel_quantity, true);
    $sXml = $sXml . GenXmlNode_HuiTong("remark", $remark, true);


    $sXml = GenXmlNode("EDIPrintDetailList", $sXml);

    $sXml = "<PrintRequest xmlns:ems=\"http://express.800best.com\"><deliveryConfirm>false</deliveryConfirm>" . $sXml . "</PrintRequest>";

    if(!XMLHttpPOST_HuiTong("BillPrintRequest", $sXml, $oDoc, $sErrorMessage, $orderid)) {
        $sMessage =  $sErrorMessage;
        return false;
	}

	$xPath = new \DOMXPath($oDoc);
	$xNode = $xPath->query("result");
    if($xNode->length == 0) {
        $sMessage = "订单(" . $orderid . ")百世接口返回数据没有内容";
        return false;
    }

	if($xNode->item(0)->nodeValue != "SUCCESS") {
        $sMessage = "订单(" . $orderid . ")百世接口获取单号失败";
        return false;
    }
	$xNode = $xPath->query("EDIPrintDetailList");
    $sRetOrderNo = GetXmlNodeValue($xNode->item(0), "txLogisticID");
    if($sRetOrderNo != $orderid) {
		$sMessage = "百世接口返回数据错误 - 订单号码不一致";
        return false;
    }

	$xNode = $xNode->item(0);
    $sExpressNo = GetXmlNodeValue($xNode, "mailNo");
    $sDestCode = GetXmlNodeValue($xNode, "markDestination");
    $sOriginCode = GetXmlNodeValue($xNode, "billProvideSiteName");

    $sExpressData = GetXmlNodeValue($xNode, "sortingCode") . "|" . GetXmlNodeValue($xNode, "pkgCode");

    return $sExpressNo != "";
}

function XMLHttpPOST_HuiTong($sServiceName, $sxmlcontent, &$oDoc, &$sErrorMessage, $orderid) {
	$sErrorCode = "";
    $XmlHttp = "";
    $PostData = "";
    $sVerifyCode = "";
    $sResponse = "";
    $sXml = "";
    $xNode = new \DOMNode();

    $sParternID = "";
    $sParternCode = "";
    $sUrl = "";

    $sErrorMessage = "";

//	$EXPRESS_InCode = "200082_0008";
//	$EXPRESS_Checkword = "X0fQPja961Yt";
//	$EXPRESS_Url = "http://ebill.ns.800best.com/ems/api/process";

	$EXPRESS_InCode = "208893_0006";
	$EXPRESS_Checkword = "pd2yp7HjejoW";
	$EXPRESS_Url = "http://ebill.ns.800best.com/ems/api/process";

    $sParternID = $EXPRESS_InCode;
	$sParternCode = $EXPRESS_Checkword;
    $sUrl = $EXPRESS_Url;

    $sXml = "<?xml version='1.0' encoding='UTF-8' standalone='yes'?>" . $sxmlcontent;

    $sVerifyCode = $sXml . $sParternCode;
    $sVerifyCode = md5($sVerifyCode);
    $sVerifyCode = GetEncoded($sVerifyCode);

	$PostData = "parternID=" . $sParternID .
               "&bizData=" . urlencode($sXml) .
               "&digest=" . urlencode($sVerifyCode) .
               "&serviceType=" . $sServiceName .
               "&msgId=" . $orderid;

	include_once APP_PATH."Api/Common/function.php";
    if(!$sResponse = makeRequest($sUrl, $PostData, "POSST")) {
		$sErrorMessage = $orderid . "汇通接口返回数据不存在";
		return false;
	}

	if(!$oDoc->loadXML($sResponse)) {
		$sErrorMessage = $orderid . "读取汇通接口数据错误";
		return false;
	}

	$xPath = new \DOMXPath($oDoc);
	$xNode = $xPath->query("result");
	if($xNode->length == 0) {
		$sErrorMessage = $orderid . "汇通接口返回数据不存在";
		return false;
	}
	if($xNode->item(0)->nodeValue == "FAIL") {
		$sErrorCode = GetXmlNodeValue($oDoc, "errorCode");
        $sErrorMessage = GetXmlNodeValue($oDoc, "errorDesc");
		return false;
	}

	$xNode = $xPath->query("success");
	if($xNode->item(0)->nodeValue == "false") {
		$sErrorCode = GetXmlNodeValue($oDoc, "reason");
        $sErrorMessage = $oDoc->textContent;
		return false;
	}
    return true;
}

function GetXmlNodeValue($xNode, $sNodeName, $attr = false) {
	if(!$xNode) return false;
	if($attr) {
		$tmp = $xNode->attributes->getNamedItem($sNodeName);
		if(!$tmp) return "";
	} else {
		$tmp = $xNode->getElementsByTagName($sNodeName);
		if(!$tmp) return "";
		$tmp = $tmp->item(0);
		if(!$tmp) return "";
	}

	return $tmp->nodeValue;
}

function GetEncoded($b) {
	$x = 0;
    $x1 = array();

    for($x = 0; $x <= 15;$x++) {
		$x1[$x] = hexdec(substr($b, $x * 2, 2));
	}

	$source = array();
	$length2 = 0;
	$Length = 0;
	$paddingCount = 0;
	$blockCount = 0;
    init($x1, $source, $Length, $length2, $paddingCount, $blockCount);
    $source2 = array();

    for($x = 0;$x <= $length2 - 1;$x++) {
		if ($x < $Length) {
			$source2[$x] = $source[$x];
        } else {
            $source2[$x] = 0;
        }
	}

    for($x = 0;$x <= $blockCount - 1;$x++) {
		$b1 = $source2[$x * 3];
		$b2 = $source2[$x * 3 + 1];
        $b3 = $source2[$x * 3 + 2];

        $temp1 = ($b1 & 252) / 4;

		$Temp = ($b1 & 3) * 16;
		$temp2 = ($b2 & 240) / 16;
		$temp2 = $temp2 + $Temp;

		$Temp = ($b2 & 15) * 4;
        $temp3 = ($b3 & 192) / 64;
        $temp3 = $temp3 + $Temp;

		$temp4 = $b3 & 63;

		$Buffer[$x * 4] = $temp1;
        $Buffer[$x * 4 + 1] = $temp2;
        $Buffer[$x * 4 + 2] = $temp3;
        $Buffer[$x * 4 + 3] = $temp4;
    }

    for($x = 0;$x<= $blockCount * 4 - 1;$x++) {
		$result[$x] = sixbit2char($Buffer[$x]);
    }

    switch($paddingCount) {
        case 1:
            $result[$blockCount * 4 - 1] = "=";
        case 2:
			$result[$blockCount * 4 - 1] = "=";
            $result[$blockCount * 4 - 2] = "=";
    }

	$GetEncoded = "";
    for($x = 0;$x <= count($result) - 1;$x++) {
		$GetEncoded .=  $result[$x];
    }
	return $GetEncoded;
}

function init($b, &$source, &$Length, &$length2, &$paddingCount, &$blockCount)
{
	$source = $b;
    $Length = count($b);
    if($Length % 3 == 0) {
		$paddingCount = 0;
        $blockCount = $Length / 3;
    } else {
		$paddingCount = 3 - ($Length % 3);
        $blockCount = ($Length + $paddingCount) / 3;
    }
	$length2 = $Length + $paddingCount;
}

function sixbit2char($b) {
	$arrBase64 = array();
	$cstBase64 = "A B C D E F G H I J K L M N O P Q R S T U V W X Y Z a b c d e f g h i j k l m n o p q r s t u v w x y z 0 1 2 3 4 5 6 7 8 9 + /";
	$arrBase64 = explode(" ", $cstBase64);

	if($b >= 0 && $b <= 63) {
        return $arrBase64[$b];
    } else {
        return "";
    }

}

function GenXmlNode_HuiTong($sNodeName, $sValue, $HAVECDATA = False, $sAttribute = "") {
    if(trim($sAttribute) != "") {
        $sAttribute = " " . $sAttribute;
    }

	$sValue = str_replace(chr(0), "", $sValue) . " ";//替换数据库内空信息，请勿删除

    if($HAVECDATA) {
        $sValue = "<![CDATA[" . $sValue . "]]>";
    }
    return "<" . trim($sNodeName) . $sAttribute . ">" . $sValue . "</" . trim($sNodeName) . ">";
}

function GenXmlNode($sNodeName, $sValue, $HAVECDATA = False, $sAttribute = "") {
	if(trim($sAttribute) != "") {
		$sAttribute = " " . $sAttribute;
	}

	if($HAVECDATA) {
		$sValue = "<![CDATA[" . $sValue . "]]>";
	}
	return "<" . trim($sNodeName) . $sAttribute . ">" . $sValue . "</" . trim($sNodeName) . ">";
}

function barcode_convert($barcode)
{
	$barcode = trim($barcode);
	switch(strlen($barcode))
	{
		case "18";
		$barcode=substr($barcode, 0,16);
		break;
		case "17";
		$barcode=substr($barcode, 0,15);
		break;
	}
	return $barcode;
}

function charlevel($level, $char="-"){
    $char=$char.$char;
	  if($level==2) return $char;
	  if($level==3) return $char.$char;
      if($level==4) return $char.$char.$char;
	  return "";
}

function tabTitle($title,$str="",$right="R", $len=0){
    if($str=="")
        return $title;
    $right=strtoupper($right);
    $strlen = strlen($str);
    $title=mb_substr($title,0,2,'utf-8');
    $char="-";
    $last=substr($title,strlen($title)-1,1);
    if($last==":" || $last=="-" || $last=="#"){
        $char="";
    }

    if ($len<=0 || $strlen <= $len)
        return $title.$char.$str;
    if( $right=="R" || $right=="RIGHT" )
        return $title.$char.substr($str,$strlen -$len,$len);
    else
        return $title.$char.substr($str,0,$len-1);
}

function mb_str_split($str){
    return preg_split('/(?<!^)(?!$)/u', $str );
}

function xfloatval($value){
    return round(floatval($value),3);
}

function enums($type,$start,$end,$templet="")
{
    $data = array();
    $start = trim(strtolower($start));
    $end = trim(strtolower($end));
    $type = trim(strtolower($type));
    switch ($type) {
        case "num":
            $start = intval($start);
            $end = intval($end);
            if ($start < 0) $start = 0;
            if ($end < 0) $end = $start + 10;
            if ($start <= $end) {
                if ($end - $start > 100) $end = $start + 100;
                for ($i = $start; $i <= $end; $i++) {
                    $data[$i] = array("id" => $i, "name" => $i);
                }
            } else {
                if ($start - $end > 100) $start = $end - 100;
                for ($i = $end; $i >= $start; $i--) {
                    $data[$i] = array("id" => $i, "name" => $i);
                }
            }
            break;
        case "year":
            switch ($start) {
                case "cur":
                case "now":
                    $start = date("Y");
                    break;
                case "min":
                    $start = 2016;
                    break;
                default:
                    $start = intval(substr($start, 0, 4));
                    if ($start < 1970) $start = 1970;
                    if ($start > 2020) $start = 2020;
                    break;
            }
            switch ($end) {
                case "cur":
                case "now":
                    $end = date("Y");
                    break;
                case "min":
                    $end = 2016;
                    break;
                default:
                    $end = intval(substr($end, 0, 4));
                    if ($end < 1970) $end = 1970;
                    if ($end > 2020) $end = 2020;
                    break;
            }

            if ($start <= $end) {
                if ($end - $start > 100) $end = $start + 100;
                for ($i = $start; $i <= $end; $i++) {
                    $data[$i] = array("id" => $i, "name" => $i);
                }
            } else {
                if ($start - $end > 100) $start = $end - 100;
                for ($i = $start; $i >= $end; $i--) {
                    $data[$i] = array("id" => $i, "name" => $i);
                }
            }
            break;
        case "month":

            switch ($start) {
                case "cur":
                case "now":
                    $start_year = date("Y");
                    $start_month = date("m");
                    break;
                case "end":
                    $start_year = date("Y");
                    $start_month = 12;
                    break;
                default:
                    $start_year = intval(substr($start, 0, 4));
                    $start_month = intval(substr($start, 5, 2));
                    break;
            }
            switch ($end) {
                case "cur":
                case "now":
                    $end_year = date("Y");
                    $end_month = date("m");
                    break;
                case "end":
                    $end_year = date("Y");
                    $end_month = 12;
                    break;
                default:
                    $end_year = intval(substr($end, 0, 4));
                    $end_month = intval(substr($end, 5, 2));
                    break;
            }
            if ($end_month < 1) $end_month = 1;
            if ($end_month > 12) $end_month = 12;
            if ($start_month < 1) $start_month = 1;
            if ($start_month > 12) $start_month = 12;
            //echo "start|$start_year|$start_month <br/>";
            //echo "end|$end_year|$end_month <br/>";

            $bless = $start_year >= $end_year;
            $last = "$end_year-" . str_pad($end_month, 2, "0", STR_PAD_LEFT);
            $i = 0;
            while (1) {
                $m = "$start_year-" . str_pad($start_month, 2, "0", STR_PAD_LEFT);

                //echo "nnnnn|$m| <br/>";
                $data[$i] = array("id" => $m, "name" => $m);
                if ($m == $last) break;

                if ($bless) {
                    $start_month--;
                    if ($start_month < 1) {
                        $start_month = 12;
                        $start_year--;
                    }
                    if ($start_year < $end_year) break;
                } else {
                    $start_month++;
                    if ($start_month > 12) {
                        $start_month = 1;
                        $start_year++;
                    }
                    if ($start_year > $end_year) break;
                }
                $i++;
            }
            break;
        default:
            break;
    }
    if($templet){
    	  foreach($data as $k=>$v){
    	  	  $data[$k]["name"]=str_replace("%", $data[$k]["name"], $templet); 
    	  }
    }
    return $data;
}

function years($first_year=2010,$next_after_now=5,$templet=""){

    $year = date("Y");
    if($first_year=="NOW" || $first_year=="CUR")
        $first_year= $year ;
    else{
        $first_year= intval($first_year);
        if($first_year<999 || $first_year>2100) $first_year=2010;
    }
    $next_after_now= intval($next_after_now);
    if($next_after_now<0 || $next_after_now>50) $next_after_now=5;

    $years=array();

    for($i=$first_year;$i<=($year+$next_after_now);$i++){
        $years[$i]= array("id"=>$i,"name"=>$i);
    }
    
    
    if($templet){
    	  foreach($data as $k=>$v){
    	  	  $years[$k]["name"]=str_replace("%", $years[$k]["name"], $templet); 
    	  }
    }

    return $years;
}

function subcode($type){
    $ret=M('subcode')->field('id,code,name')->where("status=1 and type='$type'")->order('sort')->select();

    $subcodes=array();
    foreach ($ret as $s){
        $subcodes[$s['id']]= array("id"=>$s['id'],"code"=>$s['code'],"name"=>$s['name']);
    }
    return $subcodes;
}

function subcode_view($type,$code){
    $ret=M('subcode')->field('name')->where("type='$type' and code='$code'" )->find();
    return $ret['name'];
}

function spaces($count){
//    echo  "spaces=$count";
    if($count>0 && $count<100){
        return str_repeat("&nbsp;", $count);
    } else
    {
        if($count<0) return "";
        if($count>100) return str_repeat("&nbsp;", 100);
    }
}
function strings($char,$count){
    if($count>0 && $count<100){
        return str_repeat($char, $count);
    } else
    {
        if($count<0) return "";
        if($count>100) return str_repeat($char, 100);
    }
}


function set_stat_day($stat_date)
{
    $stat_date = strtotime($stat_date);
    $txdate = date("Y-m-d", $stat_date);
    //$txweek = self::getweek($txdate);
    $txmonth = date("Y-m", $stat_date);
    //$txseason= date ( "Y", $stat_date ) . "." . ceil ( (date ( 'n', $stat_date  )) / 3 );
    $txyear = date("Y", $stat_date);

    $day = M("stat_day")->where("txdate= '" . $txdate . "'")->find();
    if (empty($day)) {
        $data ["txdate"] = $txdate;
        $data ["txmonth"] = $txmonth;
        $data ["txyear"] = $txyear;
        $data ["wait_stat"] = 1;
        $data ["status"] = 0;
        $data ["message"] = "";
        $data ["lastchanged"] = date("Y-m-d H:i:s");
        M("stat_day")->add($data);
    } else {
        if (!$day['wait_stat']) {
            $sql = "UPDATE @stat_day set wait_stat = 1, message ='', start_time = null , end_time = null where txdate = '" . $txdate . "'";
            M()->execute(table($sql));
        }
    }
}

function showcategory($list,$funcid,$parent_id=0,$isshow=true,$parent_name=""){
//           $cur_html='<div data-parent="parent-'.$funcid.'-'.$parent_id.'"'.(!$isshow?'style="display:none"':'').'><ul>';
//           foreach($list as $val) {
//
//               $cur_html.="<li>";
//               //$cur_html.='<i class="iconfont'.($val['child_nums'] <= 0?" no-child":"").'"><a href="javascript:void(0);" onclick="'.$funcid.'_load_bom(this);"></a></i>';
//               $cur_html.='<i class="iconfont'.($val['child_nums'] <= 0?" no-child":"").'"></i>';
//               $cur_html.='<a  data-id="'.$val['id'].'" url-create="'.U("/Home/EffectsCategory/index?func=create&id=".$val['id']).'" href="javascript:void(0);" tree-date-type="title" '.(!$isshow?'onclick="'.$funcid.'_load_bom_info('.$val['id'].');"':'onclick="'.$funcid.'_select_company(this);"') .'>'.$val['name'].'</a>';
//               if(isset($val["child_nums"]) && $val["child_nums"]>0)
//               {
//                $cur_html.=showcategory($val["child"],$funcid,$val['id'],false);
//               }
//
//               $cur_html.="</li>";
//
//            }
//           $cur_html.="</ul></div>";
//
//            return $cur_html;

    $cur_html='<ul  data-parent="parent-'.$funcid.'-'.$parent_id.'"'.(!$isshow?'style="display:none"':'').'>';
    foreach($list as $val) {

        $cur_html.='<li>';


        if($val['child_nums']<= 0)
        {
            $li_class="no-child";
            if($val["show_type"]==1)
            {
                $iocn="&#xe618";
            }else
            {
                $iocn="&#xe631";
            }
        }else
        {
            if($val["show_type"]==1)
            {
                $iocn="&#xe618";
            }else
            {
                $iocn="&#xe708";
            }
            $li_class="";
        }



        $cur_html.='<i class="iconfont '.$li_class.'"><a href="javascript:void(0);" onclick="'.$funcid.'_load_bom(this);">'.$iocn.';</a></i> ';
        $cur_parent_name=(empty($parent_name)?"":$parent_name."/").$val["name"];
        $cur_html.='<a  data-type="'.$val['show_type'].'" data-path="'.$cur_parent_name.'" data-id="'.$val['id'].'"  '.($isshow?'class="abe-ft14"':'').'  href="javascript:void(0);" tree-date-type="title" '.(!$isshow?'onclick="'.$funcid.'_load_bom_info('.$val['id'].',1);"':'onclick="'.$funcid.'_load_bom_info('.$val['id'].',0);"') .'>'.$val['name'].'</a>';
        if(isset($val["child_nums"]) && $val["child_nums"]>0)
        {
            $cur_html.=showcategory($val["child"],$funcid,(isset($val["company_id"])?$val['id']:0),false,$cur_parent_name);
        }
//
        $cur_html.="</li>";

    }
    $cur_html.="</ul>";

    return $cur_html;
}



function Gen_Number($type,$mainkey,$subkey, &$seqno=0)
{
    if (!$type || !$mainkey) {
        throw new Exception("gen number failed - type/mainkey is empty");
    }
    $seqno = 0;
    $id = 0;
    $model = M("system_gen");
    $save = array();
    $save["modify_time"]=date("Y-m-d H:i:s");

    $m = $model->field("id,seqno,lastchanged")->where("type='$type' and mainkey='$mainkey' and subkey='$subkey'")->find();
    if ($m) {
        $id = $m['id'];
        $save["seqno"] = $m['seqno'] + 1;
        $result = $model->where("id=$id and lastchanged='" . $m['lastchanged'] . "'")->save($save);
    } else {
        $save["type"] = $type;
        $save["mainkey"] = $mainkey;
        $save["subkey"] = $subkey;
        $save["seqno"] = 1;
        $save["create_time"]=date("Y-m-d H:i:s");
        $result = $id = $model->add($save);
    }
    if ($result) {
        $seqno=$save['seqno'];
        return $save['seqno'];
    } else {
        throw new Exception("gen number failed - unknow，retry again");
    }
}


function showtempletlist($list,$funcid,$parent_id=0,$isshow=true,$parent_name=""){
    $cur_html='<ul  data-parent="parent-'.$funcid.'-'.$parent_id.'"'.(!$isshow?'style="display:none"':'').'>';
    foreach($list as $val) {

        $cur_html.='<li>';
        $class_color="";
        $li_class="";
        if($val['child_nums']<= 0)
        {
            if($val["req_type"]!=1)
            {
                $li_class="no-child";
            }else
            {
                $li_class="arrow-deg";
                $class_color="abe-blue";
            }
            $li_class="no-child";
            if($val["type"]==0)
            {
                    $iocn="&#xe618";
            }else
            {
                    $iocn="&#xe631";
            }
        }else
        {

            if($val["type"]==0)
            {
                $iocn="&#xe618";
                if($isshow )
                {
                    $li_class="arrow-deg";
                }
            }else
            {
                if($isshow)
                {
                    $iocn="&#xe707";
                }else
                {
                    $iocn="&#xe708";
                }

            }
        }




        $cur_html.='<i class="iconfont '.$li_class.' "><a href="javascript:void(0);" onclick="'.$funcid.'_load_bom(this);">'.$iocn.';</a></i> ';
        $cur_parent_name=(empty($parent_name)?"":$parent_name."/").$val["subject"];
        if($val["type"]!=0)
        {
            $title="[".$val["type"]."类]".$val["subject"];

            if($val["score"]){
            //    $title.=" (共".$val["score"]."分)";
            }
        }else
        {
            if($val["req_type"]==1)
            {
                $title=$val["subject"].", ".$val["score"]."分, ".$val["req_category_name"]."";
            }else
            {
                $title=$val["subject"].", ".$val["score"]."分, ".subcode_view("question:kind", $val["req_kind"]).", ".$val["req_category_name"]."";
            }
        }
        $cur_html.='<a class="'.$class_color.'" data-type="'.$val['type'].'" data-path="'.$cur_parent_name.'" data-id="'.$val['id'].'"  '.($val["type"]!=0?'class="abe-ft14"':'').'  href="javascript:void(0);" tree-date-type="title" '.(!$isshow?'onclick="'.$funcid.'_load_bom_info('.$val['id'].','.$val['type'].');"':'onclick="'.$funcid.'_load_bom_info('.$val['id'].','.$val['type'].');"') .'>'.$title.'</a>';
        if(isset($val["child_nums"]) && $val["child_nums"]>0)
        {
            $cur_html.=showtempletlist($val["child"],$funcid,(isset($val["company_id"])?$val['id']:0),true,$cur_parent_name);
        }

//
        $cur_html.="</li>";

    }
    $cur_html.="</ul>";

    return $cur_html;
}

function scanSubject($seq, $str, $qk, $img, $wrap = false, $score = 0) {
    //字体	#楷体/#宋体/#黑体	题库<#楷体>可以改变部分阅读材</#楷体>料
    //字体尺寸	#F12/#F16/#F24	题库<#F16>可以改变部分阅读材</#F16>料
    //文字加粗	#B	题库<#B>可以改变部分阅读材</#B>料
    //下划实线	#U	题库<#U>可以改变部分阅读材</#U>料
    //文字加点	#D	题库<#D>可以改变部分阅读材</#D>料
    //文字加框	#K	题库<#K>可以改变部分阅读材</#K>料
    //固定填空	#Tn	题库<#Tn></#Tn>料，产生n个中文字的填空区域，缺省10，<100
    //整行填空	#TL	<#TL></# TL>， 产生一整行填空区域，</#TL>非必须
    //图像居左	#PL	<#PL></#PL>，</#PL>非必须，宽度220px高度220px以内
    //图像居中	#PC	<#PC></#PC>，</#PC>非必须
    //图像居右	#PR	<#PR></#PR>，</#PR>非必须
    //整行大图	#P	<#P></#P>，</#P>非必须, 自动缩放，居中整行宽度
    if(empty($str)) return $str;

    $str = str_replace("\r\n", chr(0), $str);
    $str = str_replace("\n", chr(0), $str);
    $str = str_replace("\r", chr(0), $str);
    $str = str_replace(chr(0), "\r\n", $str);
    $questionStem = explode("\r\n", $str);

    if(!$wrap) {
        if($qk == "xz" || $qk == "dx") {
            $questionStem[count($questionStem) - 1] .= "(<em class=\"abe-space\">". ($score != 0 ?$score."分":"")."</em>)";
        }
    }

    $str = $questionStem;
    $pre = array();
    foreach($str as $k=>$p) {
        $str[$k] = preProcess($p, $pre);
    }

    $patten = "/<#(.*?)>((?!<#).*?)<\/#>/i";
    $matches = array();
    $result = "";
    $lineIndex = 0;
    $pk = 0;
    foreach($str as $k=>$p) {
        $pt = "/\[#\s*([P|PL|PR|PC])+?\s*\]\[\/#\]/is";
        $imgItem = "";
        $imgItemEnd = "";
        if(preg_match($pt, $p, $matches) && $img != "") {
            switch (strtoupper($matches[1])) {
                case "PL":
                    $imgItem = "<span class=\"imgstyle abe-fl\"><img src=\"".$img."\" /><span>第".$seq."题图";
                    $imgItemEnd = "</span></span>";
                    break;
                case "PC":
                    $imgItem = "<span class=\"imgstyle-100p\"><img src=\"".$img."\" /><span>第".$seq."题图";
                    $imgItemEnd = "</span></span>";
                    break;
                case "PR":
                    $imgItem = "<span class=\"imgstyle abe-fr\"><img src=\"".$img."\" /><span>第".$seq."题图";
                    $imgItemEnd = "</span></span>";
                    break;
                case "P":
                    $imgItem = "<span class=\"imgstyle imgc\"><img src=\"".$img."\" /><span>第".$seq."题图";
                    $imgItemEnd = "</span></span>";
                    break;
            }

            $replacePatten = array("/\[#\s*([P|PL|PR|PC])+?\s*\]\[\/#\]/is");
            $p = preg_replace($replacePatten, "", $p, 1);
        }
        if($pk != 2) {
            $pk = 0;
            $p = scanLine($p, $pk);
        } else {
            $pktemp = 0;
            $p = scanLine($p, $pktemp);
        }

        if($imgItem != "") {
            $p = $p . $imgItem . $imgItemEnd;
        }

        $lineStart = "";
        $lineEnd = "";
        if(!$wrap) {
            if($pk == 1) {
                if($lineIndex == 0) {
                    $lineStart = "<dt class=\"num\">".($seq != 0 ? "<b>".$seq.".</b>" : "") ."<div class=\"des-info\">";
                    $lineEnd =  "</div></dt>";
                } else {
                    $lineStart = "<dd class=\"describe\"><div class=\"des-info\">";
                    $lineEnd = "</div></dd>";
                }
            } else if($pk == 0) {
                if($lineIndex == 0) {
                    $lineStart = "<dt class=\"num\">".($seq != 0 ? "<b>".$seq.".</b>" : "");
                    $lineEnd =  "</dt>";
                } else {
                    $lineStart = "<dd class=\"describe\">";
                    $lineEnd = "</dd>";
                }
            }
        } else {
            $lineStart .= "<p class=\"abe-txtl\">";
            $lineEnd = "</p>".$lineEnd;
        }

        $p = $lineStart.$p.$lineEnd;
        $result .= $p;
        $lineIndex++;
    }

    if($pk == 2) {
        if($seq != 0) {
            $lineStart = "<dt class=\"num reading\"><b>".$seq.".</b><div class=\"des-info\">";
            $lineEnd =  "</div></dt>";
        } else {
            $lineStart = "<dd class=\"describe reading\">"."<div class=\"des-info\">";
            $lineEnd =  "</div></dd>";
        }

        $result = $lineStart . $result . $lineEnd;
    } else {
        if($wrap) {
            $result = "<dd class=\"describe\">" . $result . "</dd>";
        }
    }
    return $result;
}

function scanLine($p, &$pk) {
    if(empty($p)) return $p;
    $pt = "/\[#(.*?)\]/is";
    $mt = array();
    preg_match_all($pt, $p, $mt);
    for($n = count($mt[1]) - 1;$n>=0;$n--) {
        $patten = "/\[#(".$mt[1][$n].")\](.*?)\[\/#\]/is";
        while (preg_match($patten, $p, $matches)) {
            $strStyle = "";
            $strTip = array();
            $strTipEnd = array();
            $m = explode(" ", $matches[1]);
            foreach($m as $key=>$item) {
                switch (strtoupper($item)) {
                    case "K":
                        $pk = 1;
                        break;
                    case "KA":
                        $pk = 2;
                        break;
                    case "楷体":
                        if($strStyle != "") $strStyle .= " ";
                        $strStyle .= "font-kt";
                        break;
                    case "宋体":
                        break;
                    case "黑体":
                        if($strStyle != "") $strStyle .= " ";
                        $strStyle .= "font-ht";
                        break;
                    case "F12":
                        if($strStyle != "") $strStyle .= " ";
                        $strStyle .= "font-s12";
                        break;
                    case "F16":
                        if($strStyle != "") $strStyle .= " ";
                        $strStyle .= "font-s16";
                        break;
                    case "F24":
                        if($strStyle != "") $strStyle .= " ";
                        $strStyle .= "font-s24";
                        break;
                    case "B":
                        $strTip[] = "<strong>";
                        $strTipEnd[] = "</strong>";
                        break;
                    case "U":
                        $strTip[] = "<u>";
                        $strTipEnd[] = "</u>";
                        break;
                    case "D":
                        if($strStyle != "") $strStyle .= " ";
                        $strStyle .= "bullets";
                        $pt = "";
                        $pi = 0;
                        while(true) {
                            if($pi >= mb_strlen($matches[2], "UTF-8")) {
                                break;
                            }
                            $pt .= "<i class='bull-i'>" . mb_substr($matches[2], $pi, 1, "UTF-8") . "</i>";
                            $pi++;
                        }
                        if($pt != "") {
                            $m0 = str_replace($matches[2], $pt, $matches[0]);
                            $p = str_replace($matches[0], $m0, $p);
                        }
                        break;
                    case "TL":
                        if($strStyle != "") $strStyle .= " ";
                        $strStyle .= "txtbox  t100p";
                        break;
                    case "WL":
                        if($strStyle != "") $strStyle .= " ";
                        $strStyle .= "abe-txtl";
                        break;
                    case "WR":
                        $strStyle .= "abe-txtr";
                        break;
                    case "WC":
                        $strStyle .= "abe-txtc";
                        break;
                    default:
                        break;
                }

                $subm = array();
                if(preg_match("/(T|t)(\d+)/is", $item, $subm)) {
                    if($strStyle != "") $strStyle .= " ";
                    $strStyle .= "t".$subm[2]."p";
                    break;
                }
            }

            if(!empty($strStyle)) {
                $strTip[] = "<span class=\"".$strStyle."\" >";
                $strTipEnd[] = "</span>";
            }

            if(count($strTip) > 0 || $pk) {
                $replaceStr = "";
                $replaceStrEnd = "";
                foreach($strTip as $key=>$item) {
                    $replaceStr .= $item;
                }
                for($i = count($strTipEnd)-1;$i>=0;$i--) {
                    $replaceStrEnd .= $strTipEnd[$i];
                }

                $replacePatten = array("/\[#(".$mt[1][$n].")\](.*?)\[\/#\]/is");//"/<#(.*?)>(.*?)<(\/#)>/i";
                $p = preg_replace($replacePatten, $replaceStr.'${2}'.$replaceStrEnd, $p, 1);
            } else {
                break;
            }
        }
    }
    return $p;
}

function preProcess($str, &$pre) {
    $start = 0;
    if(!empty($pre)) {
        $startElement = "[#";
        $endElement = "[/#]";
        while(true) {
            $posEnd = strpos($str, $endElement, $start);
            if($posEnd === FALSE) {
                break;
            }
            $posStart = strpos($str, $startElement, $start);
            if($posStart !== FALSE) {
                if($posEnd < $posStart) {
                    $str = $pre[count($pre) - 1].$str;
                    $start = $posEnd + mb_strlen($pre[count($pre) - 1],"utf-8") + mb_strlen($endElement,"utf-8");
                    $pre = unsetArray($pre, count($pre) - 1);
                } else {
                    $start = $posStart + mb_strlen($startElement,"utf-8");
                }
            } else {
                break;
            }
        }
    }

    $pt = "/\[#(.*?)\]/is";
    preg_match_all($pt, $str, $mt);
    $startCount = count($mt[0]);
    $endCount =  substr_count($str, "[/#]");

    $linePre = array();
    if($startCount != $endCount) {
        if($startCount > $endCount) {
            $count = $startCount - $endCount;
            for($i = $count - 1;$i >= 0;$i--) {
                $linePre[] = $mt[0][count($mt[0]) - 1 - $i];
                $str .= "[/#]";
            }
        } else {
            for($i = $endCount;$i > $startCount;$i--) {
                if(count($pre) > 0) {
                    $str = $pre[count($pre) - 1].$str;
                    $pre = unsetArray($pre, count($pre) - 1);
                } else {
                    return $str;
                }
            }
        }
    }
    if(!empty($pre)) {
        for($i = count($pre) - 1;$i>=0;$i--) {
            $str = $pre[$i].$str."[/#]";
        }
    }

    if(!empty($linePre)) {
        foreach($linePre as $l) {
            $pre[] = $l;
        }
    }

    return $str;
}

function unsetArray($a, $i) {
    if(empty($a)) return $a;
    if(!isset($a[$i])) return $a;
    unset($a[$i]);
    $c = array();
    foreach($a as $b) {
        $c[] = $b;
    }
    return $c;
}

 function get_templet_detail_sort($sort,$level){
    $left="";
    $seq=1;
    $length=3;
    if($sort){
        if($level==1)
            $seq=intval($sort)+1;
        else{
            $left=mb_substr($sort,0,$length*($level-1));
            $right=mb_substr($sort,$length*($level-1)+1,$length);
            $seq=intval($right)+1;
        }
    }
    return $left.str_pad($seq,$length,"0",STR_PAD_LEFT);
}