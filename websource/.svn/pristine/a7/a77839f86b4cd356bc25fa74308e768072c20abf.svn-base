<?php
/**
 * Created by PhpStorm.
 * User: Huajie
 * Date: 2016/11/7
 * Time: 12:18
 */

namespace Common\Common;
include_once COMMON_PATH . "Common/dropdown.php";
class CURDTools {

    private $tableName;
    private $saveData;
    private $log=array(
        'status'=>true,
        'needSave'=>array('name','status'),
        'table'=>'log_common',
        'struct'=>array(
            'type',
            'data_id',
            'data_code',
            'subject',
            'status',
            'content',
            'create_time',
            'create_user',
        )
    );

    public function __construct($log=array()){
        $this->log = empty($log)?$this->log:$log;
    }

    public function changeLogProperty($property,$val){
        if(isset($this->log[$property]))
            $this->log[$property]=$val;
    }

    private function getJSONTpl($name){
        $this->tableName=$name;
        $file_path=C('tpl_path')."/".$name.".json";
        $tpl=file_get_contents($file_path);

        if($tpl===false){
            return false;
        }

        $tpl=json_decode($tpl);
        foreach ($tpl as $v) {

            if($v->input->type=='select' && $v->input->datasource){
                $func=$v->input->datasource;
                if(function_exists($func)){
                    $r = $func();
                    $t=array();
                    foreach ($r as $val) {
                        $t[$val['id']]=$val['name'];
                    }

                    $v->input->value=$t;
                }
            }
        }

        $tpl=json_encode($tpl);
        return $tpl;

    }

    public function getJSONTplData($name){
       return (array)json_decode($this->getJSONTpl($name));
    }

    public function save($table,$data,$id='id',$where=''){
        $m=M($table);
        $u=array();

        foreach ($data as $k=>$v) {
            if(($k==$id && $v->value<=0) || !isset($v->value)){
                continue;
            }
            $u[$k]=$v->value;
        }

        $result=false;

        if(!empty($u)){
            if(trim($where)==''){
                if($u[$id]>0)
                    $result = $m->save($u);
                else
                    $result = $u[$id] = $m->add($u);
            }else{
                $result = $m->where($where)->save($u);
            }


            return $result;
        }
        return $result;
    }

    public function find($table,$where,$limit,$order='',$fields='*'){
        $m=M($table);
        if(trim($order)!=''){
            $m->order($order);
        }

        if($limit==1)
            return $m->where($where)->field($fields)->find();
        else{
            if(strtoupper($limit) == 'ALL'){
                return $m->where($where)->field($fields)->select();
            }

            return $m->where($where)->field($fields)->limit($limit)->select();

        }

    }

    public function del($table,$where){
        $m=M($table);
        $result=true;
        $m->startTrans();
        if($this->log['status']){
            $prev=$m->where($where)->find();
            $result=$result && $this->saveLog(array(
                    'type'=>$this->tableName,
                    'data_id'=>$prev['id'],
                    'data_code'=>$prev['code'],
                    'subject'=>'删除'.$this->tableName,
                    'status'=>$prev['status'],
                    'content'=>"删除".$this->tableName."信息[".$prev['code']."]$prev[name]",
                    'create_time'=>date('Y-m-d H:i:s'),
                    'create_user'=>session(C("USER_AUTH_KEY")),
            ));
        }
        $result=$result && $m->where($where)->delete();

        if($result){
            $m->commit();
        }else{
            $m->rollback();
        }

    }

    public function getToJSONData($name,$table,$where){
        $tpl=$this->getJSONTplData($name);
        $r=$this->find($table,$where,1);


        foreach ($tpl as $k=>$v) {

            if($r[$k]!=='' && $r[$k]!==null)
                $tpl[$k]->input->default_value=$r[$k];
            if(isset($r[$k]) && $tpl[$k]->update===false){
                $tpl[$k]->input->type='label';
            }
        }
        return $tpl;
    }

    public function getToJSONDataQuick($name,$where){
        return json_encode($this->getToJSONData($name,$name,$where));
    }

    public function setToJSONDataQuick($name,$data,$where='',$callback='',$trans=false){

        $this->saveData=$data;
        $tpl = $this->getJSONTplData($name);


        foreach ($tpl as $k=>$v) {

            if($tpl[$k]->update===false && $data[$k]===null){
                unset($data[$k]);
            }

            if(!isset($data[$k])){

                unset($tpl[$k]);
            }else{

                $err_msg=$this->verify($data[$k],$tpl[$k]->verify,$k);

                if($tpl[$k]->autoUpdate===true){
                    unset($data[$k]);
                }

                if($err_msg===true)
                    $tpl[$k]->value=$data[$k];
                else{
                    $this->result(1,$tpl[$k]->label.$err_msg,$data);
                }

            }

        }

        if($trans)
            M()->startTrans();

        $result=true;
        $isSaveLog=false;

        if($this->log['status']){
            $prev=(array)json_decode($this->getToJSONDataQuick($this->tableName,"id=".intval($tpl['id']->value)));

            foreach ($tpl as $k=>$v) {
                $v->input->default_value=$prev[$k]->input->default_value;
            }

            $content=getOrderChangeByJson($tpl,$this->log['needSave']);
            if($content!==false){
                $isSaveLog=true;
            }

            if($isSaveLog){

                $result = $result &&  $this->saveLog(array(
                        'type'=>$this->tableName,
                        'data_id'=>intval($tpl['id']->value),
                        'data_code'=>$prev['code']->input->default_value,
                        'subject'=>'修改'.$this->tableName,
                        'status'=>$tpl['status']->value,
                        'content'=>$content,
                        'create_time'=>date('Y-m-d H:i:s'),
                        'create_user'=>session(C("USER_AUTH_KEY")),
                    ));
            }

        }

        $result= $result && $this->save($name,$tpl,$id='id',$where);


        if($callback){
            $result=$result && $callback();
        }

        if($trans){
            if($result){
                M()->commit();
                $this->result();
            }else{
                M()->rollback();
                $this->result(1,'保存失败');
            }
        }else{
            $this->result();
        }
    }

    private function verify($value,$verify_list,$k){
        $msg=true;

        foreach ($verify_list as $vfunc) {

            $pos=strpos($vfunc,"|");
            $args=array();
            if($pos>0){
                $func=substr($vfunc,0,$pos);
                $tmpArgs=substr($vfunc,$pos+1);

                $tmpArgs=str_replace("#table#",$this->tableName,$tmpArgs);
                $tmpArgs=str_replace("###",$value,$tmpArgs);

                foreach ($this->saveData as $k=>$v) {
                    $tmpArgs=str_replace("#self_$k#",$v,$tmpArgs);
                }


                $args=explode(",",$tmpArgs);

                $vfunc=$func;
            }else{
                $args[]=$value;
            }

            $args[]=&$msg;

            $result=call_user_func_array($vfunc,$args);

            if(!$result){
                $msg="未找到该验证函数";
                break;
            }
            $msg=$args[count($args)-1];

            if($msg!==true)
                break;
        }
        return $msg;

    }

    public function result($is_err=0,$msg="操作成功",$data=array()){
        echo json_encode(array(
            'is_err'=>$is_err,
            'msg'=>$msg,
            'data'=>$data,

        ));
        exit;
    }

    protected function getLogTable(){
        $tpl=array();
        foreach ($this->log['struct'] as $v) {
            $tpl[$v]='';
        }
        return $tpl;
    }

    protected function saveLogProcess($data){
        $dataTpl=$this->getLogTable();
        foreach ($dataTpl as $k=>$v) {
            if(isset($data[$k])){
                $dataTpl[$k]=$data[$k];
            }
        }

        return $dataTpl;
    }

    public function saveLog($data,$table=''){
        $data=$this->saveLogProcess($data);
        return M($this->log['table'])->add($data);

    }

}