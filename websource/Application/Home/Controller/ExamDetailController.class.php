<?php
namespace Home\Controller;

//
//注释: ExamDetail - 试卷明细信息
//
use Home\Controller\BasicController;
use Think\Log;
class ExamDetailController extends BasicController {

    public function _init() {
        $funcs = $this->getUserRoleList($this->user,array( 'ExamDetail', '/Home/ExamDetail', ));
        if ($funcs)
            $this->assign("rights",  $funcs);
        else{
            $funcs = array(
                         array("key"=>"refresh","func"=>"ExamDetail","Action"=>"refresh") ,
                         array("key"=>"search","func"=>"/Home/ExamDetail","Action"=>"view") ,
                         array("key"=>"detail_import","func"=>"/Home/ExamDetail","Action"=>"detail_import") ,
                         array("key"=>"detail_select","func"=>"/Home/ExamDetail","Action"=>"select_product") ,
                         array("key"=>"tabcaozuorizhi","func"=>"/Home/ExamDetail","Action"=>"tabcaozuorizhi") ,
                         array("key"=>"edit_base","func"=>"/Home/ExamDetail","Action"=>"edit_base") ,
                         array("key"=>"order_edit","func"=>"/Home/ExamDetail","Action"=>"edit_base") ,
                         array("key"=>"order_delete","func"=>"/Home/ExamDetail","Action"=>"delete")
             );
            $this->assign("rights",  $this->GetUserRights($this->user["id"],$funcs ));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"],"ExamDetail"));
    }

    public function index() {
      $data["pfuncid"] = I("request.pfuncid");
      $data["funcid"] = I("request.funcid");
      $data["zindex"] = I("request.zindex/d");
      if(empty($data["funcid"])) $data["funcid"] = "ExamDetail";
      $this->GetLastUrl($data["funcid"]);

      $func = I("request.func");
      if($func != "saveSelectProduct" && $func != "save") {
        $this->GetLastUrl($data["funcid"]);
      }

      switch ($func) {

//// case for add ////
        case "edit":
        case "edit_base":
        case "add":
          $this->add($data);
          break;
        case "save":
          $this->save($data);
          break;
//// case for import ////
        case "import":
          $this->import($data);
          break;
        case "import_save":
          $this->import_save($data);
          break;
//##combine_for_add_switch_case##

//// case for view ////
        case "view":
          $this->view($data);
          break;
        case "delete":
          $this->order_delete($data);
          break;
        case "detail_delete":
          $this->detail_delete($data);
          break;
        case "detail_add":
          $this->selectProduct($data);
          break;
        case "saveSelectProduct":
          $this->saveSelectProduct($data);
          break;
        default :
          $this->ajax_refresh($data ['funcid']);
          break;

      }
    }

//// source for add - begin ////
    private function add($data) {
       $id = I("request.id/d");
       if(!$id){
          //读接入参数
          $type = I("request.type");
          $exam_no = I("request.exam_no");
          $subject = I("request.subject");
          $seq = I("request.seq/d",0);
          $score = I("request.score/d",0);
          $question_type = I("request.question_type");
          $question_code = I("request.question_code");
          $question_name = I("request.question_name");
          $question_category_code = I("request.question_category_code");
          $question_kind = I("request.question_kind");
          $question_stem = I("request.question_stem");
          $question_quiz = I("request.question_quiz");
          $question_answer = I("request.question_answer");
          $extract_count = I("request.extract_count/d",0);
          //赋初值
          $search["type"] = $type?$type:"0";  //第一个选项
          $search["exam_no"] = $exam_no?$exam_no:"";
          $search["subject"] = $subject?$subject:"";
          $search["seq"] = $seq?$seq:"";
          $search["score"] = $score?$score:"";
          $search["question_type"] = $question_type?$question_type:"0";  //第一个选项
          $search["question_code"] = $question_code?$question_code:"";
          $search["question_name"] = $question_name?$question_name:"";
          $search["question_category_code"] = $question_category_code?$question_category_code:"";
          $search["question_kind"] = $question_kind?$question_kind:"1";  //第一个选项
          $search["question_stem"] = $question_stem?$question_stem:"";
          $search["question_quiz"] = $question_quiz?$question_quiz:"";
          $search["question_answer"] = $question_answer?$question_answer:"";
          $search["extract_count"] = $extract_count?$extract_count:"";
       } else {
          $search = M(exam_detail)->find($id);
          if(!$search){
              $this->ajaxResult("试卷明细数据不存在" );
          }
          $data["id"] = $search["id"];
       }
       $data["search"] = $search;
       //检查popup返回name
       if($data['search']['question_category_code']){
          $ret=M( "question_category" )
               ->field("name")
               ->where("code='".$data['search']['question_category_code']."'")
               ->find();
          if($ret){
               $data["search"]["question_category_code_name"] = $ret["name"];
          }
       }
       //检查绑定赋值
       $data["search"]["question_category_code_name"] = $data["search"]["question_category_name"];
       foreach($data as $key=>$val) {
           $this->assign($key, $val);
       }
       $html = $this->fetch("ExamDetail:add");
       echo $html;
    }
    private function save($data) {
       $id=I("request.id/d" );
       //读取页面输入数据
       $type = I("request.type");
       $exam_no = I("request.exam_no");
       $subject = I("request.subject");
       $seq = I("request.seq/d",0);
       $score = I("request.score/d",0);
       $question_type = I("request.question_type");
       $question_code = I("request.question_code");
       $question_name = I("request.question_name");
       $question_category_code_name = I("request.question_category_code_name");
       $question_category_code = I("request.question_category_code");
       $question_kind = I("request.question_kind");
       $question_stem = I("request.question_stem");
       $question_quiz = I("request.question_quiz");
       $question_answer = I("request.question_answer");
       $question_img = I("request.question_img");
       $extract_count = I("request.extract_count/d",0);
       //非页面输入字段
       $input = array();
       //数据有效性校验，非空/数值负数，范围/日期与今日比较
       //数据校验 - 必输项不能为空
       if(!verify_value($type,"empty","","")) $this->ajaxError("类型 不能为空");
       // "标题" 长度超200位，没有生成非空检测
       if(!verify_value($seq,"nagitive","","")) $this->ajaxError("题号 不能为负数");
           //if ($seq < 100 || $seq > 105) $this->ajaxError("校验样例 题号值在100-105之间");
       if(!verify_value($score,"nagitive","","")) $this->ajaxError("分数 不能为负数");
           //if ($score < 100 || $score > 105) $this->ajaxError("校验样例 分数值在100-105之间");
       // "试题题干" 长度超200位，没有生成非空检测
       // "试题设问" 长度超200位，没有生成非空检测
       // "试题答案" 长度超200位，没有生成非空检测
       if(!verify_value($extract_count,"nagitive","","")) $this->ajaxError("抽取次数 不能为负数");
           //if ($extract_count < 100 || $extract_count > 105) $this->ajaxError("校验样例 抽取次数值在100-105之间");
       if($question_category_code){
           $ret = M("question_category")
                  ->field("id,code,name,status")
                  ->where(" code='$question_category_code' ")->find();
           if(!$ret)  $this->ajaxError("知识点码不存在");
           if($ret['status']==0 || $ret['status']==8)   $this->ajaxError("知识点码非有效状态");
       }
       $model = M("exam_detail");
       //页面输入字段
       $input["type"] = $type;
       $input["exam_no"] = $exam_no;
       $input["subject"] = $subject;
       $input["seq"] = $seq;
       $input["score"] = $score;
       $input["question_type"] = $question_type;
       $input["question_code"] = $question_code;
       $input["question_name"] = $question_name;
       $input["question_category_code_name"] = $question_category_code_name;
       $input["question_category_code"] = $question_category_code;
       $input["question_kind"] = $question_kind;
       $input["question_stem"] = $question_stem;
       $input["question_quiz"] = $question_quiz;
       $input["question_answer"] = $question_answer;
       $input["question_img"] = $question_img;
       $input["extract_count"] = $extract_count;
       $input["question_category_name"] = $question_category_code_name;
       $input["modify_user"] = session(C("USER_AUTH_KEY"));
       $input["modify_time"] =  date('Y-m-d H:i:s.n');
       $model->startTrans();
       $result=false;
       //需要存入日志的字段
       $needSave=array(
            'type'=>'类型',
            'exam_no'=>'试卷编码',
            'seq'=>'题号',
            'score'=>'分数',
            'question_type'=>'试题类型',
            'question_code'=>'试题编码',
            'question_name'=>'试题名称',
            'question_category_code'=>'知识点码',
            'question_kind'=>'试题题型',
            'extract_count'=>'抽取次数',
       );
       if(!$id) {
          //新增  建号操作
          $input["create_user"] = session(C("USER_AUTH_KEY"));
          $input["create_time"] = date('Y-m-d H:i:s.n');
          //新增数据 保存数据库
          $result = $id = $model->add($input);
          //建立操作日志
          $result = $result && createLogOrder('exam_detail',$id,'新增试卷明细','',"*",'');
       } else {
          //id存在时判断数据库内数据是否存在
          $orig=$model->where("id='%d'",array($id))->find();
          if(empty($orig)) {
               $this->ajaxError("试卷明细数据不存在");
          }
          //按主键更新数据
          $result = $model->where("id = $id")->save($input);
          $isSaveLog=false;
          foreach ($needSave as $key=>$v) {
              if($orig[$key]!=$input[$key]) {
                  $isSaveLog=true;
                  break;
              }
          }
          if($isSaveLog){
            //建立操作日志
            $result = $result && createLogOrder('exam_detail',$id,'变更试卷明细',$orig,'','','',$needSave);
          }
       }
       if($result){
           $model->commit();
       }else{
           $model->rollback();
           echo json_encode(array("msg"=>message("试卷明细保存发生错误")));
           die;
       }
       //完成后跳转
       $this->ajaxReturn($data ['pfuncid'],$data ['funcid'],"refresh", "","closepopup", 1 );
       //转到view页面
       $this->ajaxReturn("","",U("ExamDetail/index?func=view&id=$id&pfuncid=".$data ['pfuncid']), '信息查看' );
       die;
    }
//// source for add - end ////
//// source for import - begin ////
    private function import($data){
      $data['orderid'] = I("get.id");
      foreach($data as $key=>$val) {
        $this->assign($key, $val);
      }
      $html = $this->fetch("ExamDetail:import");
      echo $html;
    }
    private function cattext($string, $txt)
    {
        if($string)$string.=",";
        return $string.$txt;
    }
    private function import_save($data)
    {
        $orderid = I("request.orderid/d");
        $file = $_FILES;
        /* ========================================== */
        /* 上传文件 - 判断文件类型csv读取内容         */
        /* ========================================== */
        if (empty($file)) {
            $this->ajaxResult("导入失败:请上传csv文件");
        }
        if (isset($file["import"]) && $file["import"]["error"] == 0) {
            if (is_uploaded_file($file['import']['tmp_name'])) {
                if (substr($file['import']['name'], -4) != ".csv") {
                    $this->ajaxResult("导入失败:请上传csv文件");
                }
            }
        }
        /* ==================================================== */
        /* 上传文件 - 标题行列内容、列数、标题行、数据起始行    */
        /* ==================================================== */
        $header = array(
            "type" => "类型",
            "exam_no" => "试卷编码",
            "subject" => "标题",
            "seq" => "题号",
            "score" => "分数",
            "question_type" => "试题类型",
            "question_code" => "试题编码",
            "question_name" => "试题名称",
            "question_category_code" => "知识点码",
            "question_kind" => "试题题型",
            "question_stem" => "试题题干",
            "question_quiz" => "试题设问",
            "question_answer" => "试题答案",
            "extract_count" => "抽取次数",
                       );
        $row_header = 1;
        $row_data = 2;
        $field = array_keys($header);
        $field_count = count($field);
        /* =========================== */
        /* 上传文件 - 读取内容         */
        /* =========================== */
        $h = fopen($file['import']['tmp_name'], 'r');
        $importdatas = array();
        $n = 1;
        while ($row = fgetcsv($h)) {
            if ($n < $row_header) {
                $n++;
                continue;
            }
            $num = count($row);
            if ($n == $row_header) {
                if ($field_count != $num) $this->ajaxResult("导入失败:标题列数与模板不一致");
            } else if ($num > $field_count) {
                $num = $field_count;
            }
            for ($i = 0; $i < $num; $i++) {
                if ($n == 1) continue;
                $importdatas[$n][$field[$i]] = mb_convert_encoding($row[$i], 'utf-8', 'gbk');
            }
            $n++;
        }
        fclose($h);
        if ($n < $row_data) $this->ajaxResult("导入失败:文件内没有数据");
        /* =========================== */
        /* 上传文件 - 标题校验         */
        /* =========================== */
        $err = "";
        foreach ($importdatas[$row_header] as $key => $value) {
            if ($header[$key] != $value) $err = $this->cattext($err, $value);
        }
        if ($err) $this->ajaxResult("导入失败:标题列[$err]与模板定义不一致");
        /* =========================== */
        /* 上传文件 - 数据校验         */
        /* =========================== */
        $i = 0;
        foreach ($importdatas as $k => $row) {
            if ($k >= $row_data) {
               $err_type = "";
               $err_empty = "";
               $err_exist = "";
               if(!verify_value($row["type"],"empty","","")) $err_empty=$this->cattext($err_empty, $header["type"]);
               if (strlen($row["type"])>0) {
               //数值类型校验
                  if (!verify_value($row["type"], "num"))
                      $err_type = $this->cattext($err_type, $header["type"]);
                  else
                      if ($row["type"] < 0) $err_exist = $this->cattext($err_exist, $header["type"] . "是负数");
               }
               if (strlen($row["seq"])>0) {
               //数值类型校验
                  if (!verify_value($row["seq"], "num"))
                      $err_type = $this->cattext($err_type, $header["seq"]);
                  else
                      if ($row["seq"] < 0) $err_exist = $this->cattext($err_exist, $header["seq"] . "是负数");
               }
               if (strlen($row["score"])>0) {
               //数值类型校验
                  if (!verify_value($row["score"], "num"))
                      $err_type = $this->cattext($err_type, $header["score"]);
                  else
                      if ($row["score"] < 0) $err_exist = $this->cattext($err_exist, $header["score"] . "是负数");
               }
               if (strlen($row["question_type"])>0) {
               //数值类型校验
                  if (!verify_value($row["question_type"], "num"))
                      $err_type = $this->cattext($err_type, $header["question_type"]);
                  else
                      if ($row["question_type"] < 0) $err_exist = $this->cattext($err_exist, $header["question_type"] . "是负数");
               }
               if (strlen($row["extract_count"])>0) {
               //数值类型校验
                  if (!verify_value($row["extract_count"], "num"))
                      $err_type = $this->cattext($err_type, $header["extract_count"]);
                  else
                      if ($row["extract_count"] < 0) $err_exist = $this->cattext($err_exist, $header["extract_count"] . "是负数");
               }
               if(strlen($row["question_category_code"])>0){
                   $ret = M("question_category")
                          ->field("id,code,name,status")
                          ->where(" code='".$row["question_category_code"]."' ")->find();
                   if(!$ret)  $err_exist = $this->cattext($err_exist, $header["question_category_code"]."不存在");
                   if($ret['status']==0 || $ret['status']>=7) $this->cattext($err_exist, $header["question_category_code"]."非有效状态");
               }
               if ($err_empty || $err_exist || $err_type) {
                   $err .= "第 " . ($i + $row_data) . " 行校验失败\n";
                   if ($err_empty) $err .= "    数据为空: " . $err_empty . "\n";
                   if ($err_exist) $err .= "    数据非法：" . $err_exist . "\n";
                   if ($err_type) $err .= "    类型非法: " . $err_type . "\n";
               }
           }
           $i++;
       }
       if ($err) {
           $this->ajaxResult("数据重复:\n" . $err);
       }
       $model = M("exam_detail");
       //关键字重复导入覆盖方式
       $overwrite=true;
       if(!$overwrite){ //非覆盖方式检查是否重复
          if ($err) {
              $this->ajaxResult("数据存在:\n" . $err);
          }
       }
       /* =========================== */
       /* 上传文件 - 数据存储         */
       /* =========================== */
        $model->startTrans();
        $total=0;
        $new=0;
        $edit=0;
        foreach ($importdatas as $row) {
            $input = array();
            $id = 0;
            $m = array();
            //非导入字段-赋初值
            //导入字段
            $input["type"] = $row["type"];
            $input["exam_no"] = $row["exam_no"];
            $input["subject"] = $row["subject"];
            $input["seq"] = $row["seq"];
            $input["score"] = $row["score"];
            $input["question_type"] = $row["question_type"];
            $input["question_code"] = $row["question_code"];
            $input["question_name"] = $row["question_name"];
            $input["question_category_code"] = $row["question_category_code"];
            $input["question_kind"] = $row["question_kind"];
            $input["question_stem"] = $row["question_stem"];
            $input["question_quiz"] = $row["question_quiz"];
            $input["question_answer"] = $row["question_answer"];
            $input["extract_count"] = $row["extract_count"];
            $input["question_category_name"] = $row["question_category_code_name"];
            //modify_user/time字段
            $input["modify_user"] = session(C("USER_AUTH_KEY"));
            $input["modify_time"] =  date('Y-m-d H:i:s.n');
            //检查是否存在
            //样例 $m = $model->where("code='".$row["code"]."'")->find();
            if (!$orig) {
                  //新增
                $input["create_user"] = session(C("USER_AUTH_KEY"));
                $input["create_time"] =  date('Y-m-d H:i:s.n');
                $result = $id = $model->add($input);
                $new++;
                //建立操作日志
                    $result = $result && createLogOrder('exam_detail', $id, '数据导入(新增)',$orig,'','','',$header);
            } else {
                  //覆盖
                $id = $orig['id'];
                $result = $model->where("id=$id")->save($input);
                $edit++;
                //建立操作日志
                $result = $result && createLogOrder('exam_detail',$id,'数据导入(覆盖)',$orig,'','','',$header);
            }
            if (!$result) {
                break;
            }
            $total++;
        }
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
        }
        $this->ajax_hideConfirm();
        $this->ajax_closePopup($data ['funcid']);
        $this->ajax_refresh($data ['pfuncid']);
        $this->ajaxResult("本次导入 $total 条, 新增 $new 条, 覆盖 $edit 条");
        die;
        //$this->ajaxReturn($data ['pfuncid'], $data ['funcid'], "refresh", "", "closepopup");
    }
//// source for import - end ////
//##combine_for_add_source##

//// source for status confirm ////

//// source for status view ////
    private function view($data) {
        $data["p"] = I("request.p/d");
        $data["pagesize"] = I("request.pagesize/d");

        $data["id"] = I("request.id/d");
        $data["no"] = I("request.no");
        if(!$data["id"] && !$data["no"]) {
           $this->ajaxError("试卷明细信息查询参数非法");
        }

        //condition
        $condition="";
        $joinsql="";
        //select search fields
        $selectmasterfields="@exam_detail.*";



        $sql = table("select #selectfields# from @exam_detail  #join# Where #viewkey# #condition# #orderby#");
        if($data["id"])
           $viewkey=table("@exam_detail.id=$data[id]");
        else
           $viewkey=table("@exam_detail.id='$data[no]'");
        $sql = str_replace("#selectfields#",table($selectmasterfields),$sql);
        $sql = str_replace("#join#",$joinsql,$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#","",$sql);
        $search = M()->query($sql);
        if(!$search){
           $this->ajaxError("试卷明细信息信息不存在");
        }
        $data["search"] = current($search);


        //按tabsheet - 开始
        $data["id"] = $data["search"]["id"];
        $data["search"]["_tab"] = $this->tabsheet_check(I("request._tab"));
        $page_size=$data["pagesize"] ;//session("ExamDetail-".$data["search"]["_tab"]."-PageSize");
        switch($data["search"]["_tab"])
        {

          case "mingxi":
               $data = $this->tab_mingxi_templet_detail($page_size,$data);
               break;
          case "caozuorizhi":
               $data = $this->tab_caozuorizhi_log_order($page_size,$data);
               break;

        }
        $data["search"]["_tab_".$data["search"]["_tab"]."_p"]=$data["p"];
        $data["search"]["_tab_".$data["search"]["_tab"]."_psize"]=$data["page_size"];
        //session("ExamDetail-".$data["search"]["_tab"]."-PageSize", $data["page_size"]);
        //按tabsheet - 结束

        foreach($data as $key=>$val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("ExamDetail:view");
        echo $html;
    }

    //按tabsheet子程序 - 开始

    private function tab_mingxi_templet_detail($tab_pagesize,$data)
    {
        $orderby="";
        $joinsql="";


        $condition = "" ;


        //select detail fields
        $selectfields="@templet_detail.id ";
        $selectfields.=",@templet_detail.templet_no ";
        $selectfields.=",@templet_detail.type ";
        $selectfields.=",@templet_detail.subject ";
        $selectfields.=",@templet_detail.seq ";
        $selectfields.=",@templet_detail.score ";
        $selectfields.=",@templet_detail.req_type ";
        $selectfields.=",@templet_detail.req_category_code ";
        $selectfields.=",@templet_detail.req_category_name ";
        $selectfields.=",@templet_detail.req_kind ";
        $selectfields.=",@templet_detail.req_child_count ";
        $selectfields.=",@templet_detail.req_child_seq ";
        $selectfields.=",@templet_detail.extract ";
        $selectfields.=",@templet_detail.create_time ";
        $selectfields.=",@templet_detail.modify_time ";

        $viewkey="@templet_detail.id='".$data["search"]["templet_detail_id"]."'";
     if(!$viewkey)
           $this->ajaxError("查询参数非法");
     //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @templet_detail  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @templet_detail  #join# Where #viewkey# #condition# #orderby#");

        $viewkey = table($viewkey);
        $condition = table($condition);
        $orderby= table($orderby);
        $selectfields= table($selectfields);

        $count_sql = str_replace("#condition#",$condition,$count_sql);
        $count_sql = str_replace("#viewkey#",$viewkey,$count_sql);
        $count_sql = str_replace("#join#",$joinsql,$count_sql);

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

        $sql = str_replace("#selectfields#",$selectfields,$search_sql);
        $sql = str_replace("#join#",$joinsql,$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
        $data["list"] = M()->query($sql);
        $pageClass = new \Think\Page($count,$page_size);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"],"");
        $data["page_size"] = $page_size;

        return $data;
    }

    private function tab_caozuorizhi_log_order($tab_pagesize,$data)
    {
        $orderby="";
        $joinsql="";


        $condition = "" ;


        //select detail fields
        $selectfields="@log_order.status ";
        $selectfields.=",@log_order.id ";
        $selectfields.=",@log_order.create_time ";
        $selectfields.=",@log_order.order_id ";
        $selectfields.=",@log_order.order_no ";
        $selectfields.=",@log_order.subject ";
        $selectfields.=",@log_order.details ";
        $selectfields.=",@log_order.qty ";
        $selectfields.=",@log_order.amount ";
        $selectfields.=",@log_order.content ";

        $viewkey="@log_order.order_id='".$data["search"]["id"]."'";
        $viewkey.=" and @log_order.type='exam_detail'";
     if(!$viewkey)
           $this->ajaxError("查询参数非法");
     //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @log_order  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @log_order  #join# Where #viewkey# #condition# #orderby#");
        $orderby="order by @log_order.id desc";

        $viewkey = table($viewkey);
        $condition = table($condition);
        $orderby= table($orderby);
        $selectfields= table($selectfields);

        $count_sql = str_replace("#condition#",$condition,$count_sql);
        $count_sql = str_replace("#viewkey#",$viewkey,$count_sql);
        $count_sql = str_replace("#join#",$joinsql,$count_sql);

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

        $sql = str_replace("#selectfields#",$selectfields,$search_sql);
        $sql = str_replace("#join#",$joinsql,$sql);
        $sql = str_replace("#viewkey#",$viewkey,$sql);
        $sql = str_replace("#condition#",$condition,$sql);
        $sql = str_replace("#orderby#",$orderby,$sql);
        $sql .= " LIMIT ". (($data["p"] - 1) * $page_size). ", $page_size";
        $data["list"] = M()->query($sql);
        $pageClass = new \Think\Page($count,$page_size);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"],"");
        $data["page_size"] = $page_size;

        return $data;
    }



    private function tabsheet_check($itab)
    {
        $idefault="mingxi";
        switch($itab)
        {

          case "mingxi":
          case "caozuorizhi":

              break;
          default:
              $itab=$idefault;
              break;
         }
        return $itab;
    }
    //按tabsheet子程序 - 结束

    private function deleteProcess($id) {
        $type=1;
        $smo=M('exam_detail')->where("id='%d'",array($id))->find();
        if(empty($smo)) {
            $this->ajaxResult("试卷明细信息数据不存在");
        }
        if($smo['status']!=0){
            $this->ajaxResult("试卷明细信息状态不能删除");
        }

        $result=true;
        $result = $result && createLogOrder('exam_detail',$id,($smo['status']?'取消信息':'删除记录'),'');
        if($smo['status']!=0){
            $result = $result && M('exam_detail')->where("id='%d'",array($id))->save(array('status'=>8,'cancel_time'=>date('Y-m-d H:i:s'),'cancel_status'=>1));
        }else{
            $result = $result && M('exam_detail')->where("id='%d'",array($id))->delete();
        }
        return $result;
    }

    private function order_delete($data) {

        $id=I("request.id/d" );
        $type=I("request.type/d" );
        if(!$id) {
             $this->ajaxResult("试卷明细信息参数不存在");
        }

        $m=M();
        $m->startTrans();
        $r=$this->deleteProcess($id);
        if($r){
            $m->commit();
        }else{
            $m->rollback();
        }

        $this->ajax_hideConfirm();
        if(!$type){
            $this->ajax_closeTab($data ['funcid']);
        }
        $this->ajax_refresh($data ['pfuncid']);
        $this->ajaxResult();
        die;
    }
}
