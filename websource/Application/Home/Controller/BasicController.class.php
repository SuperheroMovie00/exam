<?php
namespace Home\Controller;
use Think\Controller;
include_once COMMON_PATH . "Common/code_cache.php";
include_once COMMON_PATH . "Common/dropdown.php";
include_once COMMON_PATH . "Common/checktableexist.php";

class BasicController extends Controller {
  protected $__title = "";
  protected $__not_check_right_module = "Auth,Report,Api";
  protected $__not_check_right_action = "login,logout,loginAct,verify,verify_captcha,report_contrast,report_print";
  private $ajaxResultfunc = array();
  private $ajaxResultParam = array();
  protected $user_shop_id = 0;
  protected $user = array();
  public function _initialize() {
    $this->uid = session('USER_ID');
    $this->_initAccess();
    $this->_init();
  }

  private function _initAccess() {
        $actionName=ACTION_NAME;
        $action=I('get.func');
        if(trim($action)!=''){
            $actionName=$action;
        }

    $check_right = (in_array(CONTROLLER_NAME, explode ( ',', $this->__not_check_right_module)) && in_array($actionName, explode ( ',', $this->__not_check_right_action))) ? true : false;

        if(!$check_right) {
            $user_code=session ( C ( 'USER_AUTH_KEY' ) );
      if (! $user_code) {
        if($this->_isajax()) {
          $this->ajaxResult("请先登录", "", "window.location.href = '".PHP_FILE.C( 'USER_AUTH_GATEWAY' )."'");
        } else {
          redirect(PHP_FILE.C( 'USER_AUTH_GATEWAY' ));
        }
      }
      
      if (! S (  'USER_AUTH_TOKEN_'.$user_code ) ) {
                session ( C ( 'USER_AUTH_KEY' ),'' );
                session ( 'USER_ID','' );
                session ( 'usercode','' );
                session ( C ( 'ADMIN_AUTH_KEY' ),'' );
                if($this->_isajax()) {
                    $this->ajaxResult("请先登录", "", "window.location.href = '".PHP_FILE.C( 'USER_AUTH_GATEWAY' )."'");
                } else {
                    redirect(PHP_FILE.C( 'USER_AUTH_GATEWAY' ));
                }
            }

            if (S (  'USER_AUTH_TOKEN_'.$user_code  ) != md5($user_code .S ( 'USER_AUTH_TIME_'.$user_code ))) {
                session ( C ( 'USER_AUTH_KEY' ),'' );
                session ( 'USER_ID','' );
                session ( 'usercode','' );
                session ( C ( 'ADMIN_AUTH_KEY' ),'' );
                if($this->_isajax()) {
                    $this->ajaxResult("请先登录", "", "window.location.href = '".PHP_FILE.C( 'USER_AUTH_GATEWAY' )."'");
                } else {
                    redirect(PHP_FILE.C( 'USER_AUTH_GATEWAY' ));
                }
            }
            
            if(!$this->uid) {
        if($this->_isajax()) {
          $this->ajaxResult("请先登录", "", "window.location.href = '".PHP_FILE.C( 'USER_AUTH_GATEWAY' )."'");
        } else {
          redirect(PHP_FILE.C( 'USER_AUTH_GATEWAY' ));
        }
      }

      $this->user = M('user')->where('id = '.$this->uid)->find();
      if(empty($this->user)) {
        if($this->_isajax()) {
          $this->ajaxResult("请先登录", "", "window.location.href = '".PHP_FILE.C( 'USER_AUTH_GATEWAY' )."'");
        } else {
          redirect(PHP_FILE.C( 'USER_AUTH_GATEWAY' ));
                    exit;
        }
      }

        if($this->user["customer_id"]){
            $cust = M('customer')->where('id = '.$this->user["customer_id"]." and status=1")->find();
            if($cust )
               $this->user["customer_name"]=$cust['short_name'];
            else
               $this->user["customer_name"]="客户信息丢失或被禁止";
        }

      $this->user_shop_id = $this->user["customer_id"];
      $this->assign('user',$this->user);

            $notice_open = getSystemParameter("notice_open");
            if($notice_open) {
                $this->assign("notice_title", getSystemParameter("notice_title"));
            }

      import ( 'ORG.Util.RBAC' );

            if (! \Org\Util\Rbac::AccessDecision()) {

        if(!session(C("USER_AUTH_KEY"))) {
          if($this->_isajax()) {
            $this->ajaxResult("请先登录", "", "window.location.href = '".PHP_FILE.C( 'USER_AUTH_GATEWAY' )."'");
          } else {
            redirect(PHP_FILE.C( 'USER_AUTH_GATEWAY' ));
                        exit();
          }
        }

                if($this->_isajax()) {
                    $flag=I('get.func')!=''?1:0;
                    $this->errorAjax(L( '_VALID_ACCESS_' ),$flag);
        } else {
          $this->errorReturn(L( '_VALID_ACCESS_' ));
          exit();
        }
      } else {

        if (!$this->_isajax()) {
          if (!session( '?_header_access' ) || C( 'USER_AUTH_TYPE' ) == 2) {
            $access = \Org\Util\Rbac::getAccessList ( $this->uid );
            session ( '_header_access', $access ['APP'] );
          }
        }
      }
            if(!$this->_isajax()) {
                if(strtolower(CONTROLLER_NAME) != "index") {
                  if($_SERVER['REQUEST_URI'] != "" && $_SERVER['REQUEST_URI'] != "/") {
                      header("location: /index.php/Home/Index/index?_op_=". urlencode($_SERVER['REQUEST_URI']));
                      die;
                  }
                }
            }
    }
  }

    protected function errorAjax($msg,$flag){

        $data["pfuncid"] = I("request.pfuncid");
        $data["funcid"] = I("request.funcid");
        $data["zindex"] = I("request.zindex/d");
        if(empty($data["funcid"])) $data["funcid"] = "Year";
        $data["error"]=$msg;
        $data["waitSecond"]=3;

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }

        $html = $this->fetch(C('TMPL_ACTION_ERROR_AJAX'));

        if($flag==1){

            echo $html;
            exit;
        }else{
            $curd=new \Common\Common\CURDTools();
            $r=$curd->getJSONTplData("error");
            $r['error']->input->default_value=$html;
            echo(json_encode($r));
            exit;
        }


    }

    protected function errorReturn($msg){
        $data["pfuncid"] = I("request.pfuncid");
        $data["funcid"] = I("request.funcid");
        $data["zindex"] = I("request.zindex/d");
        if(empty($data["funcid"])) $data["funcid"] = "Year";
        $data["error"]=$msg;
        $data["waitSecond"]=3;

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }

        $html = $this->fetch(C('TMPL_ACTION_ERROR'));

        echo $html;
        exit;
    }

  protected function _isajax() {
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) ) {
      if('xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH']))
        return true;
    }
    if(!empty($_POST[C('VAR_AJAX_SUBMIT')]) || !empty($_GET[C('VAR_AJAX_SUBMIT')]))
      return true;

    if(I("request.__ajax", 0)) {
      return true;
    }
    return false;
  }

    protected function resturnErrorFile($summary,$msg){
        $dirPath=$_SERVER['DOCUMENT_ROOT'].'/Uploads/'.date('Y-m-d');
        $fileName=$summary.session('USER_ID').date('YmdHis').'.csv';
        mkdir($dirPath,0777,true);
        file_put_contents($dirPath.'/'.$fileName,mb_convert_encoding($msg,'GBK','UTF-8'));

        ob_start();
        header( "Content-type:  application/octet-stream ");
        header( "Accept-Ranges:  bytes ");
        header( "Content-Disposition:  attachment;  filename= $fileName ");
        $size=readfile($dirPath.'/'.$fileName);
        header( "Accept-Length: " .$size);
        exit;
    }

  protected function ajaxError($msg = "", $closeTab = false, $fundId = 0) {
      if($closeTab) {
          $this->ajax_closeTab($fundId);
      }

     $this->ajaxResult($msg); 
  }

    protected function ajaxError_func($msg = "", $msg_fun="") {
        $this->ajaxResult($msg,"","","","",$msg_fun);
    }

    protected function ajaxReturn($pfuncid="",$funcid="", $url = "", $title="" ,$action="closepopup",$continue=0)
    {   //$addnext - 是否存在继续添加
        //是简单模式， 只有pfuncid, url负责跳转，action负责动作, url参数内的动作高于action，url在pfuncid上跳转
        //判断简单模式1： 传入2个参数符合 $pfuncid窗口+$funcid动作（refresh/closepopup/closetab）， 进入简单模式
        //判断简单模式2： $pfuncid 与 $funcid，两者只转入一个参数                               ， 进入简单模式
        //
        //非简单模式，同时有pfuncid/funcid,
        //          $url(支持动作, 只服务于$pfuncid)，url在空上跳转
        //          $action（动作服务于$funcid）


        // 例如实现3个动作: 关闭自己(funcid)，刷新summary(pfuncid)，
        // 需要2次完成
        //

        if ($pfuncid != "" && (strtolower($funcid) == "refresh" || strtolower($funcid) == "closepopup" || strtolower($funcid) == "closetab")) {
            //转简单模式
            $action = $funcid;
            $funcid = "";
        }

        $action = strtolower($action);
        $url_action = strtolower($url);

        $this->ajax_hideConfirm();

        //非转简单模式
        if ($pfuncid != "" && $funcid != "") {
            //action 关联 $funcid, $url
            //$url   关联 $pfuncid, $url

            switch ($action) {
                case "closepopup":
                    $this->ajax_closePopup($funcid);
                    break;
                case "closetab":
                    $this->ajax_closeTab($funcid);
                    break;
                case "refresh":
                    $this->ajax_refresh($funcid);
                    break;
            }

            switch ($url_action) {
                case "refresh":
                    $this->ajax_refresh($pfuncid);
                    break;
                case "closetab":
                    $this->ajax_closeTab($pfuncid);
                    break;
                default:
                    if ($url != "") {
                        $this->ajax_openLink("", $url, $title);
                    }
                    break;
            }

        } else {
            //简单模式
            if ($url_action == "refresh" || $url_action == "closepopup" || $url_action == "closetab") {
                $url = "";
                $action = $url_action;
            }

            //刷新提交参数的页面
            if ($pfuncid == "")
                $pfuncid = $funcid;

            if($pfuncid!=""){
                switch ($action) {
                    case "refresh":
                        $this->ajax_refresh($pfuncid);
                        break;
                    case "closepopup":
                        $this->ajax_closePopup($pfuncid);
                        break;
                    case "closetab":
                        $this->ajax_closeTab($pfuncid);
                        break;
                }
            }

            if ($url != "") {
                if ($pfuncid=="") $pfuncid=filterFuncId($url,"");
                $this->ajax_openLink($pfuncid, $url, $title);
            }
        }
        if(!$continue){
            $this->ajaxResult();
        }
    }
  
  protected function ajaxResult($msg = "", $link = "", $func = 0, $funcParam = "",$msg_desc="",$msg_func=0) {
      $msg=str_replace("\n","<br>",$msg);

    $result = array();
    $result['msg_desc'] = $msg_desc;
    $result['msg_func'] = $msg_func;
    $result['msg'] = $msg;
    $result['link'] = $link;


    
    if(!$func) {
      $func = $this->ajaxResultfunc;
      $funcParam = $this->ajaxResultParam;
    }
    
    if(is_int($func)) {
      $result['callback'] = $func;
      $result['funcParam'] = $funcParam;
    } else {
      if(!is_array($func)) {
        $func = array($func);
      }
      $result['func'] = $func;
      if(!is_array($funcParam)) $funcParam = array($funcParam);
      $result['funcParam'] = $funcParam;
    }
    
    echo json_encode($result);
    die;
  }
  
  protected function ajax_openLink($funcid = 0, $url = "", $title = "刷新") {
    if($funcid) {
      if(!empty($url)) {
        $this->ajaxResultfunc[] = "_asr.openLink";
        $this->ajaxResultParam[] = "'$url','".$funcid."','$title', 1";
      } else {
        $this->ajaxResultfunc[] = "_asr.openLink";
        $this->ajaxResultParam[] = "'','".$funcid."','$title', 1";
      }
    } else {
      if(!empty($url)) {
        $this->ajaxResultfunc[] = "_asr.openLink";
        $this->ajaxResultParam[] = "'$url','".filterFuncId(ACTION_NAME, $url)."','$title', 0";
      }
    }
  }

  protected function ajax_submit($funcid, $formid, $url) {
      if(!empty($funcid)) {
          $this->ajaxResultfunc[] = "_asr.submit";
          $this->ajaxResultParam[] = "'".$funcid."', '".$formid."', '".$url."'";
      }
  }
  
  protected function ajax_closeTab($funcid) {
    if(!empty($funcid)) {
      $this->ajaxResultfunc[] = "_asr.closeTab";
      $this->ajaxResultParam[] = "'".$funcid."'";
    }
  }

    protected function ajax_popupFun($url) {
        $this->ajaxResultfunc[] = "_asr.popupFun";
        $this->ajaxResultParam[] = "'".$url."'";
    }

    protected function ajax_func($func, $param = "") {
        $this->ajaxResultfunc[] = $func;
        $this->ajaxResultParam[] = $param;
    }
  
  protected function ajax_hideConfirm() {
    $this->ajaxResultfunc[] = "_asr.hideConfirm()";
    $this->ajaxResultParam[] = "";
  }
  
  protected function ajax_closePopup($funcid) {
    if(!empty($funcid)) {
      $this->ajaxResultfunc[] = "_asr.closePopup";
      $this->ajaxResultParam[] = "'".$funcid."'";
    }
  }
  
  protected function ajax_refresh($funcid) {
    $this->ajax_openLink($funcid);
  }
  
  protected function refreshPage($funcid) {
    $this->ajax_openLink($funcid);
  }
  
  protected function closetab($msg, $funcid) {
    $a = array();
    $b = array();
    if($funcid) {
      $a = array("_asr.closeTab");
      $b = array("'$funcid'");
    }
    $this->ajaxResult($msg, "", $a, $b);
  }

    protected function getUserRoleList($user,$namespace){
      return array();
        $user_id=$user["id"];

        if($_SESSION[C('ADMIN_AUTH_KEY')] || C('USER_AUTH_ON')==false){
            $menu = M('node as a')->where(" a.level='%d'",array(4))
                ->field("DISTINCT title,id,a.module,a.btn_name")
                ->select();
        }else{
            $menu = M('node as a')->join(C('DB_PREFIX')."role_node as b  ON a.id=b.node_id")
                ->join(C('DB_PREFIX')."role_user as c ON b.role_id=c.role_id")->where("c.user_id='%d' AND a.level='%d'",array($user_id,4))
                ->field("DISTINCT title,id,a.module,a.btn_name")
                ->select();
        }

        $funcs=array();

        foreach ($menu as $v) {
            foreach ($namespace as $v2) {
                if($v['btn_name'] && strstr($v['module'],$v2)){
                    $funcs[]=array(
                        'key'=>$v['btn_name'],
                        'func'=>$v2,
                        'action'=>$v['module'],
                    );
                }
            }

        }

        return $this->GetUserRights($user_id,$funcs);

    }

    protected function GetUserRights($user_id,$funcs) {
        $funcs = $this->checkRoles($funcs);
        $result =array();
        foreach($funcs as $func) {
            $result[$func["key"]] = "1";
        }
        if(session ( C ( 'ADMIN_AUTH_KEY' ))) {
            $module = "/".MODULE_NAME ."/" .CONTROLLER_NAME;
            $funcs = M("node")->field("name as `key`")->where("level = 3 AND module = '$module'")->select();
            foreach($funcs as $func) {
                $result[$func["key"]] = "1";
            }
        } else {
            $roleUser = M("role_user")->where("user_id = ".$user_id)->find();
            if($roleUser) {
                $module = "/".MODULE_NAME ."/" .CONTROLLER_NAME;
                $funcs = M("role_node")->field("node_name as `key`")->where("level = 3 AND module = '$module' AND role_id = ".$roleUser["role_id"])->select();
                foreach($funcs as $func) {
                    $result[$func["key"]] = "1";
                }
            }
        }

        return $result;
    }

    private function checkRoles($funcs) {
        if(session ( C ( 'ADMIN_AUTH_KEY' ))) {
            $module = "/".MODULE_NAME ."/" .CONTROLLER_NAME;
            $m = M("node")->field("name as `key`")->where("level = 3 AND module = '$module'")->select();
            foreach($m as $v) {
                foreach($funcs as $key=>$func) {
                    if($func["key"] == $v["key"]) {
                        unset($funcs[$key]);
                        //$this->ajaxResult("模块".$module."的内置权限".$func["key"]."与数据库冲突");
                    }
                }
            }
        }
        return $funcs;
    }

  protected function GetUserColumnDefine($user_id, $summary_id) {
    $result = array();

        $usc=M('user_summary_column')->where("user_code='%s' AND summary='%s'",array(session(C("USER_AUTH_KEY")),$summary_id))
        ->order('sort')->select();
    
        foreach ($usc as $k=>$v) {
            $result[$v['column']]=$v['show'];
        }

//         print_r($result);
//         die;

        return $result;
  }

  public function _init()
  {
  }

  public function GetLastUrl($funcid) {
    $module = MODULE_NAME;
    $controller = CONTROLLER_NAME;
    $action = ACTION_NAME;
    $__last_url = "/index.php/$module/$controller/$action.html?";
    $__i = 0;
    foreach($_GET as $__key=>$__get) {
      if($__key != $funcid."-last-url") {
        if($__i > 0) $__last_url .= "&";
        $__last_url .= $__key."=".$__get;
        $__i++;
      }
    }
    $__last_url = urlencode($__last_url);
    $this->assign("__last_url", $__last_url);
    return $__last_url;
  }
  
  protected function get_user_shop() {
    
  }
}