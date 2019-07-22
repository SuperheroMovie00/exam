<?php
namespace Home\Controller;
use Common\Common\CURDTools;
class RoleNodeController extends BasicController {

    public function _init() {
        $funcs = array(
            array("key"=>"save","func"=>"/Home/RoleNode","Action"=>"save"),
            array("key"=>"selectUser","func"=>"/Home/RoleNode","Action"=>"selectUser"),
            array("key"=>"master_user","func"=>"/Home/RoleNode","Action"=>"master_user"),
            array("key"=>"master_rights","func"=>"/Home/RoleNode","Action"=>"master_rights"),
            array("key"=>"refresh","func"=>"/Home/RoleNode","Action"=>"refresh") ,
            array("key"=>"approval","func"=>"/Home/RoleNode","Action"=>"approval") ,
            array("key"=>"unapproval","func"=>"/Home/RoleNode","Action"=>"unapproval") ,
            array("key"=>"notice","func"=>"/Home/RoleNode","Action"=>"notice") ,
            array("key"=>"cancel","func"=>"/Home/RoleNode","Action"=>"cancel") ,
            array("key"=>"delete","func"=>"/Home/RoleNode","Action"=>"delete") ,
            array("key"=>"batch_delete","func"=>"/Home/RoleNode","Action"=>"batch_delete") ,
            array("key"=>"edit_order","func"=>"/Home/RoleNode","Action"=>"edit_order") ,
            array("key"=>"detail_import","func"=>"/Home/RoleNode","Action"=>"detail_import") ,
            array("key"=>"detail_add","func"=>"/Home/RoleNode","Action"=>"detail_add") ,
            array("key"=>"master_view","func"=>"/Home/RoleNode","Action"=>"view") ,
            array("key"=>"master_edit","func"=>"/Home/RoleNode","Action"=>"edit") ,
            array("key"=>"master_delete","func"=>"/Home/RoleNode","Action"=>"delete")
        );
        $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"RoleNode"));
    }

    public function index() {
        $data["pfuncid"] = I("request.pfuncid");
        $data["funcid"] = I("request.funcid");
        $data["zindex"] = I("request.zindex/d");
        if(empty($data["funcid"])) $data["funcid"] = "RoleNode";
        $this->GetLastUrl($data["funcid"]);

        $func = I("request.func");
        if($func != "saveSelectProduct" && $func != "save") {
            $this->GetLastUrl($data["funcid"]);
        }

        switch ($func) {
            case "add":
                $this->add($data);
                break;
            case "save":
                $this->save($data);
                break;
			case "master_rights":
            case "edit":
                $this->edit($data);
                break;
            case "delete":
                $this->delete($data);
                break;
            case "cancel":
                $this->delete($data);
                break;
            case "view":
                $this->view($data);
                break;
            case "detail_delete":
                $this->detail_delete($data);
                break;
            case "master_user":
            case "selectUser":
                $this->selectUser($data);
                break;
            case "saveSelectUser":
                $this->saveSelectUser($data);
                break;

        }
    }

    private function add($data) {
        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("RoleNode:add");
        echo $html;
    }

    private function edit($data) {

        $data["id"] =$id= I("request.id");

        $data['role']=M('role')->where("id='%d'",array($id))->find();
        if (!$data['role'])
        	$this->ajaxError("角色不存在");

        $sm=M('role_node')->where("role_id='%d'",array($data['id']))->field("*")->select();

        $sql1=table( " pid in (select id from @node where level=1 and status=1)");
        $sql2=table( " pid in (select id from @node where level=2 and status=1 and $sql1)");
        $sql3=table( " pid in (select id from @node where level=3 and status=1 and $sql2)");

        $n1=M('node')->where("level='%d' AND status = '%d'",array(1,1))->order('sort ASC')->select();
        $n2=M('node')->where("level='%d' AND status = '%d' and $sql1",array(2,1))->order('pid ASC,sort ASC')->select();
        $n3=M('node')->where("level='%d' AND status = '%d' and $sql2",array(3,1))->order('pid ASC,sort ASC')->select();
        $n4=M('node')->where("level='%d' AND status = '%d' and $sql3" ,array(4,1))->order('pid ASC,sort ASC')->select();

        $node_id_list=array();
        foreach ($sm as $v) {
            $node_id_list[]=$v['node_id'];
        }

        $n2_list=array();
        foreach ($n2 as $v) {
            $n2_list[$v['id']]=$v;
        }


        $n1_list=array();
        foreach ($n1 as $v) {
            $n1_list[$v['id']]=$v;
        }


        $n2_rowspan=array();
        foreach ($n2 as $k2=>$v2) {
            foreach ($n3 as $k3=>$v3) {
                if($v3['pid']==$v2['id']){
                    if(!isset($n2_rowspan[$v2['id']])){
                        $n2_rowspan[$v2['id']]=0;
                    }
                    $n2_rowspan[$v2['id']]+=1;
                }
            }
        }

        $n1_rowspan=array();
        foreach ($n1 as $k1=>$v1) {

            foreach ($n2 as $k2=>$v2) {
                if($v2['pid']==$v1['id']){
                    if(!isset($n1_rowspan[$v1['id']]))
                        $n1_rowspan[$v1['id']]=0;
                    if(isset($n2_rowspan[$v2['id']]))
                        $n1_rowspan[$v1['id']]+=$n2_rowspan[$v2['id']];
                    else{
                        $n1_rowspan[$v1['id']]+=1;
                    }
                }
            }
        }


        $data["sm"]=$sm;
        $data["n1"]=$n1;
        $data["n3"]=$n3;
        $data["n4"]=$n4;
        $data["n1_rowspan"]=$n1_rowspan;
        $data["n2_rowspan"]=$n2_rowspan;
        $data["n1_list"]=$n1_list;
        $data["n2_list"]=$n2_list;
        $data["node_id_list"]=$node_id_list;
        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("RoleNode:edit");
        echo $html;
    }

    private function view($data) {
        $data["p"] = I("request.p/d");
        $data["log_p"] = I("request.log_p/d");
        $data["id"] = I("request.id/d");
        $data["no"] = I("request.no");

        if(!$data["id"] && !$data["no"]) die;

        //condition
        $condition="";

        //select search fields
        $selectmasterfields="@role_node.id ";
        $selectmasterfields.=",@role_node.order_no ";
        $selectmasterfields.=",@role_node.storage_code ";
        $selectmasterfields.=",@role_node.staff_code ";
        $selectmasterfields.=",@role_node.customer_name ";
        $selectmasterfields.=",@role_node.qty ";
        $selectmasterfields.=",@role_node.amount ";
        $selectmasterfields.=",@role_node.stock_qty ";
        $selectmasterfields.=",@role_node.remarks ";
        $selectmasterfields.=",@role_node.type ";
        $selectmasterfields.=",@role_node.notice_status ";
        $selectmasterfields.=",@role_node.notice_time ";
        $selectmasterfields.=",@role_node.stock_status ";
        $selectmasterfields.=",@role_node.stock_time ";
        $selectmasterfields.=",@role_node.status ";
        $selectmasterfields.=",@role_node.complete_time ";
        $selectmasterfields.=",@role_node.confirm_status ";
        $selectmasterfields.=",@role_node.confirm_time ";
        $selectmasterfields.=",@role_node.cancel_status ";
        $selectmasterfields.=",@role_node.cancel_time ";
        $selectmasterfields.=",@role_node.create_time ";

        if($data["id"])
          $viewkey="id=".$data["id"];
        else
          $viewkey="order_no='".$data["no"]."'";

        $sql = table("select #selectfields# from @role_node  Where @role_node.#viewkey#");
        $sql = str_replace("#selectfields#",table($selectmasterfields),$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $search = M()->query($sql);
        if(!$search)
          die;

        $data["search"] = current($search);
        $data["id"] = $data["search"]["id"];

        $step=array();
        $step1=array();

        // 单据状态
        step_add( $step, '创建时间',$data["search"]['create_time']  ,true);
        step_add( $step, '已确认'  ,$data["search"]['confirm_time'] ,$data["search"]['status']>=1 && $data["search"]['confirm_status']==1);
        step_add( $step, '已通知'  ,$data["search"]['notice_time']  ,$data["search"]['status']>=1 && $data["search"]['notice_status']==1);
        if($data["search"]['status']>=1 && $data["search"]['stock_status']==1){
            step_add( $step, '处理中'  ,$data["search"]['stock_time'],$data["search"]['status']>=1 && $data["search"]['stock_status']==1);
        }
        step_add( $step, '已完成'  ,$data["search"]['complete_time']   ,$data["search"]['status']==2);

        // 取消/挂起
        step_add( $step1, '取消时间'  ,$data["search"]['cancel_time'] ,$data["search"]['cancel_status']==1);

        $step=getOrderStep($step,$step1);
        $data["step"]=$step;

        //select master fields
        $selectfields="@role_node_detail.id ";
        $selectfields.=",@role_node_detail.sku ";
        $selectfields.=",@role_node_detail.goods_no ";
        $selectfields.=",@role_node_detail.goods_name ";
        $selectfields.=",@role_node_detail.brand_code ";
        $selectfields.=",@role_node_detail.style_info ";
        $selectfields.=",@role_node_detail.barcode ";
        $selectfields.=",@role_node_detail.amount ";
        $selectfields.=",@role_node_detail.qty ";
        $selectfields.=",@role_node_detail.price ";
        $selectfields.=",@role_node_detail.stock_qty ";
        $selectfields.=",@role_node_detail.qty-@role_node_detail.stock_qty qtyoffset ";

        $sumfields="";
        $page_size = I("get.pagesize/d");
        if ($page_size<=0){
           $page_size = session("RoleNode-PageSize");
           if (!$page_size) {
                    $page_size = 10;
          }
        }
        session("RoleNode-PageSize", $page_size);

        $masterkey="role_node_id=".$data["search"]["id"];

        $count_sql = table("select count(*) as cnt from @role_node_detail  where @role_node_detail.#viewkey# #condition#");
        $count_sql = str_replace("#condition#",$condition,$count_sql);
        $count_sql = str_replace("#viewkey#",$masterkey,$count_sql);
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

        $orderby="";
        $sql = table("select #selectfields# from @role_node_detail  Where @role_node_detail.#viewkey# #condition# #orderby#");
        $sql = str_replace("#selectfields#",table($selectfields),$sql);
        $sql = str_replace("#viewkey#",$masterkey,$sql);
        $sql = str_replace("#orderby#",table($orderby),$sql);
        $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
        $data["list"] = M()->query($sql);
        $pageClass = new \Think\Page($count,$page_size);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"]);
        $data["page_size"] = $page_size;

        //操作日志
        $masterkey=$data["search"]["id"];
        $log_page_size= I("get.log_pagesize/d");
        if ($log_page_size<=0){
            $log_page_size = 10;
        }
        //$log_page_size = 20;

        $count_sql = table("select count(*) as cnt from @log_order where order_id=#viewkey#  and type='role_node'");
        $count_sql = str_replace("#viewkey#",$masterkey,$count_sql);
        $count = M()->query($count_sql);
        $count = $count[0]["cnt"];

        if($count < $log_page_size)
            $tmp = 1;
        else {
            $tmp = intval($count / $log_page_size);
            if($count % $log_page_size != 0) {
                $tmp++;
            }
        }
        if(!$data["log_p"]) {
            $data["log_p"] = 1;
        }
        if($data["log_p"] > $tmp) {
            $data["log_p"] = $tmp;
        }

        $sql = table("select * from @log_order Where order_id=#viewkey#  and type='role_node' order by create_time desc");
        $sql = str_replace("#viewkey#",$masterkey,$sql);
        $sql .= " LIMIT ". (($data["log_p"] - 1) * $log_page_size). ", $log_page_size";
        $data["log_list"] = M()->query($sql);

        $pageClass = new \Think\Page($count,$log_page_size);
        $pageClass->rollPage = 8;
        $pageClass->page_size_name='log_pagesize';
        $pageClass->setProperty('p','log_p');
        $pageClass->setProperty('nowPage',$data["log_p"]);

        $data["log_page"] = $pageClass->show_drp($data["funcid"]);
        $data["log_page_size"] = $log_page_size;

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("RoleNode:view");
        echo $html;
    }


    private function delete($data){
        $data["id"] = I("request.id");
        $m=M();
        $m->startTrans();
        $type=1;
        $r=$this->deleteProcess($data,$type);

        if($r){
            $m->commit();
        }else{
            $m->rollback();
        }
        if($type==1){
        $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideMask()"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Home/RoleNode/index?func=view&id=".$data['id']).  "','".filterFuncId("RoleNodeView_View","id=$data[id]")."','角色查看', 0",""));
        }else{
            $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink","_asr.hideMask()"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Summary/RoleNodeSummary/index?func=search&id=0").  "','".filterFuncId("RoleNodeView_View","id=0")."','角色列表', 0",""));
        }
    }

    private function deleteProcess($data,&$type) {


        $smo=M('role_node')->where("id='%d'",array($data["id"]))->find();

        $result=true;
        if($smo['status']!=0){
            $result=M('role_node')->where("id='%d'",array($data['id']))->save(array('status'=>8,'cancel_time'=>date('Y-m-d H:i:s'),'cancel_status'=>1));
            $result = $result && createLogOrder('role_node',$data['id'],'取消角色','');
        }else{
            $type=2;
            $result = $result && createLogOrder('role_node',$data['id'],'删除角色','');
            $result = $result && M('role_node')->where("id='%d'",array($data['id']))->delete();
            $pd=M('role_node_detail')->where("role_node_id='%d'",array($data['id']))->field('COUNT(1) c')->find();
            if($pd['c']>0){
                $result= $result && M('role_node_detail')->where("role_node_id='%d'",array($data['id']))->delete();
            }
        }


        return $result;
    }




    private function save($data) {
        $role_id=I("get.role_id/d");
        $node_id = I("get.node_id");

        if(!verify_value($role_id,"negitive","","")) {
            echo json_encode(array("msg"=>message("%1 必须输入","权限","")));
            die;
        }

        $model = M("role_node");
        $nm=M('node');
        $model->startTrans();
        $result=true;
        $rn=$model->where("role_id='%d'",array($role_id))->find();
        if(!empty($rn)){
            $result= $result && $model->where("role_id='%d'",array($role_id))->delete();
        }


        foreach ($node_id as $v) {
            $n=$nm->where("id='%d'",array($v))->find();

            $input=array(
                'node_id'=>$v,
                'role_id'=>$role_id,
                'node_name'=>$n["name"],
                'module'=>$n["module"],
                'level'=>$n['level'],
            );

            $result = $model->add($input);

        }
        $log=array(
            'type'=>'role_node',
            'data_id'=>$role_id,
            'data_code'=>'',
            'status'=>1,
            'create_time'=>date('Y-m-d H:i:s'),
            'create_user'=>session(C("USER_AUTH_KEY")),
            'subject'=>'修改权限',
            'content'=>'修改权限',
        );




        $result =$result && createLogCommon('','','','','',$log);

        if($result){
            $model->commit();
        }else{
            $model->rollback();
        }

        $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Summary/RoleSummary/index?func=search&").  "','".filterFuncId("RoleSummary_Search","id=0")."','角色列表', 0"));

        die;
    }
    private function selectUser($data) {
        $data['id']= $id = I("request.id/d");

        $data['role']=M('role')->where("id='%d'",array($id))->find();
        if (!$data['role'])
        	$this->ajaxError("角色不存在");

        $data['user']=M('user')->where("status='%d'",array(1))->order('department_id')->select();
        $ru=M('role_user')->where("role_id='%d'",array($id))->select();

        $role_user_list=array();

        foreach ($ru as $v) {
            $role_user_list[]=$v['user_id'];
        }

        $data['role_user_list']=$role_user_list;

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("RoleNode:selectUser");
        echo $html;
    }

    private function saveSelectUser($data) {
        $role_id = I("request.role_id");

        $sid=I("request.user_id");
        $model=M('role_user');
        $model->startTrans();
        $result=true;

        $rs=$model->where("role_id='%d'",array($role_id))->find();
        if(!empty($rs))
            $result = $result && $model->where("role_id='%d'",array($role_id))->delete();

        if($result===0)
            $result=true;

        foreach ($sid as $v) {
            $result = $result && $model->add(array('user_id'=>$v,'role_id'=>$role_id));
        }

        if($result){
            $model->commit();
        }else{
            $model->rollback();
        }

        $this->ajaxResult("", "",  array("_asr.closeTab","_asr.closePopup", "_asr.openLink"), array("$('#".$data["funcid"]."-Tab').find('a'), '".$data["funcid"]."'","'".$data["funcid"]."'", "'". U("/Summary/RoleSummary/index?func=search&").  "','".filterFuncId("RoleSummary_Search","id=0")."','角色列表', 0"));

    }














}
