<?php
namespace Home\Controller;
Vendor("Pinyin.Pinyin");
class IndexController extends BasicController {
    public function index(){
//        $model=M("User");
//        $model->where("a='%s' AND b='%s' and id=9999",array("2016-12-02 12:00:11","00:1:00"))->save(array("code"=>'1'));
//        print_r($this->queryStr);exit;


        $user_id=$this->user['id'];
        $side=$this->user['customer_id']?"1":"0";

        if($_SESSION[C('ADMIN_AUTH_KEY')] || C('USER_AUTH_ON')==false){

            $f_menu = M('node as a')->where(" a.level='%d' AND status='%d' and side='%d'",array(1,1,$side))
                ->field("DISTINCT title,name,id,is_admin,model,sort,ico,default_open")
                ->order("sort ASC,id ASC")
                ->select();
            $s_menu = M('node as a')->where(" a.level='%d' AND status='%d' and side='%d'",array(2,1,$side))
                ->field("DISTINCT title,name,pid,id,is_admin,model,sort,ico,default_open")
                ->order("sort ASC,id ASC")
                ->select();
            $t_menu = M('node as a')->where(" a.level='%d' AND status='%d' and side='%d'",array(3,1,$side))
                ->field("DISTINCT title,name,id,pid,a.module, a.btn_name,is_admin,model,sort,ico,default_open")
                ->order("sort ASC,id ASC")
                ->select();
            //print_r($s_menu);

        }else{

            //echo  "yyyyyyyyyyyyyy";

            $f_menu = M('node as a')->join(C('DB_PREFIX')."role_node as b  ON a.id=b.node_id")
                ->join(C('DB_PREFIX')."role_user as c ON b.role_id=c.role_id")->where("c.user_id='%d' AND a.level='%d' AND status='%d'",array($user_id,1,1))
                ->field("DISTINCT title,name,id,is_admin,model,sort,ico")
                ->order("sort ASC,id ASC")
                ->select();
            $s_menu = M('node as a')->join(C('DB_PREFIX')."role_node as b  ON a.id=b.node_id")
                ->join(C('DB_PREFIX')."role_user as c ON b.role_id=c.role_id")->where("c.user_id='%d' AND a.level='%d' AND status='%d'",array($user_id,2,1))
                ->field("DISTINCT title,name,pid,id,is_admin,model,sort,ico")
                ->order("sort ASC,id ASC")
                ->select();
            $t_menu = M('node as a')->join(C('DB_PREFIX')."role_node as b  ON a.id=b.node_id")
                ->join(C('DB_PREFIX')."role_user as c ON b.role_id=c.role_id")->where("c.user_id='%d' AND a.level='%d' AND status='%d'",array($user_id,3,1))
                ->field("DISTINCT title,name,id,pid,a.module, a.btn_name,is_admin,model,sort,ico")
                ->order("sort ASC,id ASC")
                ->select();
        }


        $data["f_menu"] = $f_menu;
        $data["s_menu"] = $s_menu;
        $data["t_menu"] = $t_menu;

        $notice = M('system_parameter')->field("value")->where("code='notice_open'")->find();
        $data["notice_open"] = $notice["value"];
        $notice = M('system_parameter')->field("value")->where("code='notice_title'")->find();
        $data["notice_title"] = $notice["value"];

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }

    	$this->display();
    }

    public function getPinyin() {
        $text = I("get.text");
        $pinyin = new \Pinyin();
        $a = mb_str_split($text);
        $p = "";
        foreach($a as $z) {
            //$txt = iconv("gb2312", "utf-8", $z);
            $p .= strtolower($pinyin->getFirstChar($z));
        }
        echo $p;
    }

//    private function mb_str_split($str){
//        return preg_split('/(?<!^)(?!$)/u', $str );
//    }

    public function test() {
        $this->user["customer_name"]="客户信息丢失或被禁止";
        print_r($this->user);
        die;
        $s = "AA#50|A#50|B#40";
        echo location_add($s, "B", 20);
    }
    
    public function open() {
    	$v = I("get.v");
    	if(!$v) {
    		echo 'false';
    		die;
    	}
    	
    	switch ($v) {
    		case "SalesOrder":
    			$SalesOrderController = new SalesOrderController();
    			echo $SalesOrderController->index();
    			break;
    	}
    	die;
    }
}