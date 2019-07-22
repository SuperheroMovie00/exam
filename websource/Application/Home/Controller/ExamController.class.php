<?php
namespace Home\Controller;

//
//注释: Exam - 试卷信息
//
use Home\Controller\BasicController;
use Think\Log;
class ExamController extends BasicController
{

    public function _init()
    {
        $funcs = $this->getUserRoleList($this->user, array('Exam', '/Home/Exam',));
        if ($funcs)
            $this->assign("rights", $funcs);
        else {
            $funcs = array(
                array("key" => "refresh", "func" => "Exam", "Action" => "refresh"),
                array("key" => "import", "func" => "/Home/Exam", "Action" => "import"),
                array("key" => "save", "func" => "/Home/Exam", "Action" => "save"),
                array("key" => "search", "func" => "/Home/Exam", "Action" => "view"),
                array("key" => "detail_import", "func" => "/Home/Exam", "Action" => "detail_import"),
                array("key" => "detail_select", "func" => "/Home/Exam", "Action" => "select_product"),
                array("key" => "tabcaozuorizhi", "func" => "/Home/Exam", "Action" => "tabcaozuorizhi"),
                array("key" => "edit_base", "func" => "/Home/Exam", "Action" => "edit_base"),
                array("key" => "order_edit", "func" => "/Home/Exam", "Action" => "edit_base"),
                array("key" => "order_detail", "func" => "/Home/Exam", "Action" => "detail_edit"),
                array("key" => "order_delete", "func" => "/Home/Exam", "Action" => "delete"),
                array("key" => "grid", "func" => "/Home/Exam", "Action" => "grid"),
                array("key" => "cancel", "func" => "/Home/Exam", "Action" => "cancel"),
                array("key" => "confirm", "func" => "/Home/Exam", "Action" => "confirm"),
                array("key" => "todummy", "func" => "/Home/Exam", "Action" => "todummy"),
                array("key" => "createPDF", "func" => "/Home/Exam", "Action" => "createPDF"),
                array("key" => "master_view", "func" => "/Home/Exam", "Action" => "view"),
                array("key" => "master_edit", "func" => "/Home/Exam", "Action" => "edit"),
                array("key" => "master_delete", "func" => "/Home/Exam", "Action" => "delete")
            );
            $this->assign("rights", $this->GetUserRights($this->user["id"], $funcs));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"], "Exam"));
    }

    public function index()
    {
        $data["pfuncid"] = I("request.pfuncid");
        $data["funcid"] = I("request.funcid");
        $data["zindex"] = I("request.zindex/d");
        if (empty($data["funcid"])) $data["funcid"] = "Exam";
        $this->GetLastUrl($data["funcid"]);

        $func = I("request.func");
        if ($func != "saveSelectProduct" && $func != "save") {
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
//// case for grid ////
            case "detail_edit":
                $this->detail_edit($data);
                break;
            case "detail_del":
                $this->detail_del($data);
                break;
            case "detail_save":
                $this->detail_save($data);
                break;
//// case for cancel ////
            case "cancel":
                $this->cancel($data);
                break;
            case "cancel_save":
                $this->cancel_save($data);
                break;
//// case for confirm ////
            case "confirm":
                $this->confirm($data);
                break;
            case "createPDF":
                $this->createPDF($data);
                break;
            case "confirm_save":
                $this->confirm_save($data);
                break;
//// case for todummy ////
            case "todummy":
                $this->todummy($data);
                break;
            case "todummy_save":
                $this->todummy_save($data);
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
    private function add($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            //读接入参数
            $type = I("request.type");
            $exam_no = I("request.exam_no");
            $templet_no = I("request.templet_no");
            $subject = I("request.subject");
            $count = I("request.count/d", 0);
            $score = I("request.score/d", 0);
            $req_time = I("request.req_time/d", 0);
            $req_content = I("request.req_content");
            $remarks = I("request.remarks");
            //赋初值
            $search["type"] = $type ? $type : "0";  //第一个选项
            $search["exam_no"] = $exam_no ? $exam_no : "";
            $search["templet_no"] = $templet_no ? $templet_no : "";
            $search["subject"] = $subject ? $subject : "";
            $search["count"] = $count ? $count : "";
            $search["score"] = $score ? $score : "";
            $search["req_time"] = $req_time ? $req_time : "";
            $search["req_content"] = $req_content ? $req_content : "";
            $search["remarks"] = $remarks ? $remarks : "";
        } else {
            $search = M(exam)->find($id);
            if (!$search) {
                $this->ajaxResult("试卷数据不存在");
            }
            $data["id"] = $search["id"];
        }
        $data["search"] = $search;
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Exam:add");
        echo $html;
    }

    private function save($data)
    {
        $id = I("request.id/d");
        //读取页面输入数据
        $type = I("request.type");
        $exam_no = I("request.exam_no");
        $templet_no = I("request.templet_no");
        $subject = I("request.subject");
        $count = I("request.count/d", 0);
        $score = I("request.score/d", 0);
        $req_time = I("request.req_time/d", 0);
        $req_content = I("request.req_content");
        $remarks = I("request.remarks");
        //非页面输入字段
        $input = array();
        //数据有效性校验，非空/数值负数，范围/日期与今日比较
        //数据校验 - 必输项不能为空
        if (!verify_value($type, "empty", "", "")) $this->ajaxError("类型 不能为空");
        if (!verify_value($exam_no, "empty", "", "")) $this->ajaxError("试卷编码 不能为空");
        if (!verify_value($count, "nagitive", "", "")) $this->ajaxError("题量 不能为负数");
        //if ($count < 100 || $count > 105) $this->ajaxError("校验样例 题量值在100-105之间");
        if (!verify_value($score, "nagitive", "", "")) $this->ajaxError("总分 不能为负数");
        //if ($score < 100 || $score > 105) $this->ajaxError("校验样例 总分值在100-105之间");
        if (!verify_value($req_time, "nagitive", "", "")) $this->ajaxError("时间要求 不能为负数");
        //if ($req_time < 100 || $req_time > 105) $this->ajaxError("校验样例 时间要求值在100-105之间");
        // "卷面要求" 长度超200位，没有生成非空检测
        // "备注" 长度超200位，没有生成非空检测
        $model = M("exam");
        //判断 exam_no 是否重复建立
        $orig = $model->where("exam_no='$exam_no'" . ($id ? " and id!=$id" : ""))->find();
        if ($orig) $this->ajaxError("试卷编码 $exam_no 已存在");
        //页面输入字段
        $input["type"] = $type;
        $input["exam_no"] = $exam_no;
        $input["templet_no"] = $templet_no;
        $input["subject"] = $subject;
        $input["count"] = $count;
        $input["score"] = $score;
        $input["req_time"] = $req_time;
        $input["req_content"] = $req_content;
        $input["remarks"] = $remarks;
        $input["modify_user"] = session(C("USER_AUTH_KEY"));
        $input["modify_time"] = date('Y-m-d H:i:s.n');
        $model->startTrans();


        $result = false;
        //需要存入日志的字段
        $needSave = array(
            'type' => '类型',
            'exam_no' => '试卷编码',
            'templet_no' => '模板编码',
            'subject' => '标题',
            'count' => '题量',
            'score' => '总分',
            'req_time' => '时间要求',
        );
        if (!$id) {
            //新增  建号操作
            $keycode = GenOrderNo("exam");
            $count = $model->where(array("exam_no" => $keycode))->count();
            if ($count > 0) {
                echo json_encode(array("msg" => message("%1 %2 已存在", "试卷", $keycode)));
                die ();
            }
            $input["exam_no"] = $keycode;
            $input["create_user"] = session(C("USER_AUTH_KEY"));
            $input["create_time"] = date('Y-m-d H:i:s.n');
            //新增数据 保存数据库
            $result = $id = $model->add($input);
            //建立操作日志
            $result = $result && createLogOrder('exam', $id, '新增试卷', '', "*", 'exam_no');
        } else {
            //id存在时判断数据库内数据是否存在
            $orig = $model->where("id='%d'", array($id))->find();
            if (empty($orig)) {
                $this->ajaxError("试卷数据不存在");
            }
            if ($orig["status"] != "0") {
                $this->ajaxError("试卷非编辑状态");
            }
            if($exam_no!=$orig["exam_no"]){
                $result=M("exam_detail")->where("exam_id=$id")->save(array("exam_no" => $exam_no));
            }

            //按主键更新数据
            $result = $model->where("id = $id")->save($input);
            $isSaveLog = false;
            foreach ($needSave as $key => $v) {
                if ($orig[$key] != $input[$key]) {
                    $isSaveLog = true;
                    break;
                }
            }
            if ($isSaveLog) {
                //建立操作日志
                $result = $result && createLogOrder('exam', $id, '变更试卷', $orig, '', '', 'exam_no', $needSave);
            }
        }
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
            echo json_encode(array("msg" => message("试卷保存发生错误")));
            die;
        }
        //完成后跳转
        $this->ajaxReturn($data ['pfuncid'], $data ['funcid'], "refresh", "", "closepopup", 1);
        //转到view页面
        $this->ajaxReturn("", "", U("Exam/index?func=view&id=$id&pfuncid=" . $data ['pfuncid']), tabtitle('试卷', $input["exam_no"]));
        die;
    }
//// source for add - end ////
//// source for import - begin ////
    private function import($data)
    {
        $data['orderid'] = I("get.id");
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Exam:import");
        echo $html;
    }

    private function cattext($string, $txt)
    {
        if ($string) $string .= ",";
        return $string . $txt;
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
            "templet_no" => "模板编码",
            "subject" => "标题",
            "count" => "题量",
            "score" => "总分",
            "req_time" => "时间要求",
            "req_content" => "卷面要求",
            "remarks" => "备注",
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
                if (!verify_value($row["type"], "empty", "", "")) $err_empty = $this->cattext($err_empty, $header["type"]);
                if (!verify_value($row["exam_no"], "empty", "", "")) $err_empty = $this->cattext($err_empty, $header["exam_no"]);
                if (strlen($row["type"]) > 0) {
                    //数值类型校验
                    if (!verify_value($row["type"], "num"))
                        $err_type = $this->cattext($err_type, $header["type"]);
                    else
                        if ($row["type"] < 0) $err_exist = $this->cattext($err_exist, $header["type"] . "是负数");
                }
                if (strlen($row["count"]) > 0) {
                    //数值类型校验
                    if (!verify_value($row["count"], "num"))
                        $err_type = $this->cattext($err_type, $header["count"]);
                    else
                        if ($row["count"] < 0) $err_exist = $this->cattext($err_exist, $header["count"] . "是负数");
                }
                if (strlen($row["score"]) > 0) {
                    //数值类型校验
                    if (!verify_value($row["score"], "num"))
                        $err_type = $this->cattext($err_type, $header["score"]);
                    else
                        if ($row["score"] < 0) $err_exist = $this->cattext($err_exist, $header["score"] . "是负数");
                }
                if (strlen($row["req_time"]) > 0) {
                    //数值类型校验
                    if (!verify_value($row["req_time"], "num"))
                        $err_type = $this->cattext($err_type, $header["req_time"]);
                    else
                        if ($row["req_time"] < 0) $err_exist = $this->cattext($err_exist, $header["req_time"] . "是负数");
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
        //判断 exam_no 是否重复建立
        $i = 0;
        foreach ($importdatas as $k => $row) {
            if ($k >= $row_data) {
                $j = 0;
                foreach ($importdatas as $k1 => $row1) {
                    if ($k1 >= $row_data and $k1 > $k) {
                        if ($row["exam_no"] == $row1["exam_no"]) {
                            $err .= "第 " . ($i + $row_data) . " 与 " . ($j + $row_data) . " 行 " . $header["exam_no"] . "\n";
                        }
                    }
                    $j++;
                }
            }
            $i++;
        }
        if ($err) {
            $this->ajaxResult("数据重复:\n" . $err);
        }
        $model = M("exam");
        //关键字重复导入覆盖方式
        $overwrite = true;
        if (!$overwrite) { //非覆盖方式检查是否重复
            //判断 exam_no 是否重复建立
            $i = 0;
            foreach ($importdatas as $k => $row) {
                if ($k >= $row_data) {
                    $m = $model->where("exam_no='" . $row["exam_no"] . "'")->find();
                    if ($m) $err .= "第 " . ($i + $row_data) . " 行 " . $header["exam_no"] . "\n";
                }
                $i++;
            }
            if ($err) {
                $this->ajaxResult("数据存在:\n" . $err);
            }
        }
        /* =========================== */
        /* 上传文件 - 数据存储         */
        /* =========================== */
        $model->startTrans();
        $total = 0;
        $new = 0;
        $edit = 0;
        foreach ($importdatas as $row) {
            $input = array();
            $id = 0;
            $m = array();
            //非导入字段-赋初值
            //导入字段
            $input["type"] = $row["type"];
            $input["exam_no"] = $row["exam_no"];
            $input["templet_no"] = $row["templet_no"];
            $input["subject"] = $row["subject"];
            $input["count"] = $row["count"];
            $input["score"] = $row["score"];
            $input["req_time"] = $row["req_time"];
            $input["req_content"] = $row["req_content"];
            $input["remarks"] = $row["remarks"];
            //modify_user/time字段
            $input["modify_user"] = session(C("USER_AUTH_KEY"));
            $input["modify_time"] = date('Y-m-d H:i:s.n');
            //检查是否存在
            //样例 $m = $model->where("code='".$row["code"]."'")->find();
            $orig = $model->where("exam_no='" . $row["exam_no"] . "'")->find();
            if (!$orig) {
                //新增
                $input["create_user"] = session(C("USER_AUTH_KEY"));
                $input["create_time"] = date('Y-m-d H:i:s.n');
                $result = $id = $model->add($input);
                $new++;
                //建立操作日志
                $result = $result && createLogOrder('exam', $id, '数据导入(新增)', $orig, '', '', 'exam_no', $header);
            } else {
                //覆盖
                $id = $orig['id'];
                $result = $model->where("id=$id")->save($input);
                $edit++;
                //建立操作日志
                $result = $result && createLogOrder('exam', $id, '数据导入(覆盖)', $orig, '', '', 'exam_no', $header);
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
//// source for grid - begin ////
    private function detail_edit($data)
    {
        //_pid 主档表  的id
        $id = I("request.id");
        if (!$id) {
            $this->ajaxError("试卷参数错误");
        }
        $master = M('exam')->where("id='%d' and status=0", array($id))->find();
        if (!$master) {
            $this->ajaxError("试卷不存在或非可编辑状态");
        }
        $data["search"] = $master;
        //如果对有主档权限控制，请在此进行处理
        //$this->checkCustomerTree($id);
        //if($this->user_shop_id && $this->user_shop_id!=$master["customer_id"]){
        //   $this->ajaxError("不能编辑他人订单");
        //}
        //检查主档内主要数据状态是否正确
        //$customer = M("customer")->where("id = " . $master["customer_id"] . " and status=1")->find();
        //if (!$customer) {
        //    $this->ajaxError("客户信息不存在或非有效状态");
        //}
        //$type=0 搜索exam_detail  $type=1 question
        $type = I("get.type/d");
        //_keyword默认搜索关键字
        $data["search"]["_keyword"] = I("get._keyword");
        //是否起始装载已提交的明细数据
        $data["search"]["loaddetail"] = I("get.loaddetail");
        $data["p"] = I("get.p/d");
        $data["zindex"] = I("get.zindex/d");
        $existdetail = 0;
        $data["id"] = $id;
        $where = "";
        if ($data["search"]["loaddetail"] == 1) {
            $_keyword = "";
            if (!empty($data["search"]["_keyword"])) {
                $_keyword .= " p.code like '%" . $data["search"]["_keyword"] . "%'";
                $_keyword .= " or p.name like '%" . $data["search"]["_keyword"] . "%'";
                $where .= " AND ($_keyword)";
            }
            //额外增加的搜索字段
            $data["page_size"] = I("get.pagesize/d");
            $data["page_size"] = $data["page_size"] <= 0 ? session("exam-grid-PageSize") : $data["page_size"];
            if (!$data["page_size"]) {
                $data["page_size"] = 50;
            }
            session("exam-grid-PageSize", $data["page_size"]);
            $pre = C("DB_PREFIX");
            $orderby = " ORDER BY p.id";
            $data["master"] = $master;
            $data["id"] = $id;
            $sql = "SELECT p.id
                          ,p.status
                          ,p.id as question_id
                          ,p.code as question_code
                          ,p.name as question_name
                          ,p.parent_id as question_parent_id
                          ,p.type as question_type
                          ,p.category_code as question_category_code
                          ,p.category_name as question_category_name
                          ,p.kind as question_kind
                          ,p.stem as question_stem
                          ,p.quiz as question_quiz
                          ,p.answer as question_answer
                          ,p.answer as question_analysis
                          ,p.childs as question_childs
                          ,p.img as question_img
                          ,ifnull(d.id,0) as _did
                          ,d.type
                          ,d.subject
                          ,d.seq
                          ,d.score
                          ,d.extract_count ";
            if ($type == 1) {
                $sql .= "FROM " . $pre . "exam_detail as d " .
                    "LEFT JOIN " . $pre . "question as p on d.question_id=p.id " .
                    "WHERE d.exam_id='" . $id . "' ";
                $orderby = " ORDER BY d.id";
            } else {
                $sql .= "FROM " . $pre . "question as p " .
                    "LEFT JOIN (select id
                                            ,question_id
                                            ,type
                                            ,subject
                                            ,seq
                                            ,score
                                            ,extract_count
                                      from " . $pre . "exam_detail
                                      where exam_id='" . $id . "') as d on d.question_id=p.id " .
                    "WHERE 1=1 $where"; //p.purchase_price >0
            }
            $count_sql = "SELECT count(1) AS cnt FROM (" . $sql . ") a";
            $sql .= $orderby;
            $count = 0;
            $count = M()->query($count_sql);
            $count = $count[0]["cnt"];
            $data["list_total"] = $count;
            if ($count < $data["page_size"])
                $tmp = 1;
            else {
                $tmp = intval($count / $data["page_size"]);
                if ($count % $data["page_size"] != 0) {
                    $tmp++;
                }
            }
            if (!$data["p"]) $data["p"] = 1;
            if ($data["p"] > $tmp) $data["p"] = $tmp;
            $sql .= " LIMIT " . (($data["p"] - 1) * $data["page_size"]) . ", " . $data["page_size"];
            $data["list"] = M()->query($sql);
            foreach ($data["list"] as $k => $v) {
                if ($v['_did']) {
                    $existdetail = 1;
                    break;
                }
            }
            $pageClass = new \Think\Page($count, $data["page_size"]);
            $pageClass->rollPage = 8;
            $data["page"] = $pageClass->show_drp($data["funcid"], "编辑试卷");
        }
        $data["search"]["loaddetail"] = 1;
        $data["existdetail"] = $existdetail;
        $this->detail_stat($master, $statinfo);
        $data["statinfo"] = $statinfo;
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Exam:grid");
        echo $html;
    }

    private function detail_save($data)
    {
        $id = I("request.id");
        $close = I("request.close");
        if (!$id) {
            $this->ajaxError("试卷参数错误");
        }
        $model = M("exam_detail");
        $master = M("exam")->where("id='%d' and status=0", array($id))->find();
        if (!$master) {
            $this->ajaxError("试卷不存在或非可编辑状态");
        }
        //如果对有主档权限控制，请在此进行处理
        //$this->checkCustomerTree($id);
        //if($this->user_shop_id && $this->user_shop_id!=$master["customer_id"]){
        //   $this->ajaxError("不能编辑他人订单");
        //}
        //检查主档内主要数据状态是否正确
        //$customer = M("customer")->where("id = " . $master["customer_id"] . " and status=1")->find();
        //if (!$customer) {
        //    $this->ajaxError("客户信息不存在或非有效状态");
        //}
        $_id = I("post._id");
        if (empty($_id)) {
            $this->ajaxError("明细信息不存在");
        }
        $model->startTrans();
        $result = false;
        $qty_total = 0;
        $gm = M('question');
        $chg_info = "";
        $add_info = "";
        $del_info = "";
        //删除有删除栏选择的记录
        $del = I("post.del");
        if (!empty($del)) {
            foreach ($del as $k => $v) {
                $ret = $model->field("question_code")->find($v);
                if ($ret) {
                    $result = $model->delete($v);
                    if (!$result) {
                        $this->ajaxError_func("明细数据删除失败", $data["funcid"] . "_focus");
                    }
                    $del_info .= ($del_info ? "," : "") . $ret['question_code'];
                }
            }
        }
        //保存有勾选栏选择的记录
        foreach ($_id as $k => $v) {
            //排除要删除的记录
            if (!empty($del)) {
                if (in_array($v, $del)) {
                    continue;
                }
            }
            $detail = array();
            //检查是否存在明细表的id
            $did = I("_did_" . $v);
            if ($did) {
                $detail = $model->find($did);
                if (!$detail) $this->ajaxError_func("明细信息不存在", $data["funcid"] . "_focus");
            }
            $g = $gm->find($v);
            if (!$g) $this->ajaxError_func("题库内($g[name])不存在", $data["funcid"] . "_focus");
            if (!$g["status"]) $this->ajaxError_func("题库内($g[name])无效状态", $data["funcid"] . "_focus");
            //读取输入数据
            $type = I("type_" . $v);
            $subject = I("subject_" . $v);
            $seq = intval(I("seq_" . $v));
            $score = intval(I("score_" . $v));
            $extract_count = intval(I("extract_count_" . $v));
            //输入数据进行校验
            if ($seq < 0) $this->ajaxError_func("题号 " . $seq . " 不能为负数", $data["funcid"] . "_focus");
            if ($score < 0) $this->ajaxError_func("分数 " . $score . " 不能为负数", $data["funcid"] . "_focus");
            if ($extract_count < 0) $this->ajaxError_func("抽取次数 " . $extract_count . " 不能为负数", $data["funcid"] . "_focus");
            //检查明细数据是否存在
            $ret = $model->field('id,question_code')->where("exam_id='%d' AND question_id='%d' ", array($id, $v))->find();
            if ($ret && $did && $ret['id'] != $did) $this->ajaxError_func("明细数据(" . $ret['question_code'] . ")已存在，不能重复录入", $data["funcid"] . "_focus");
            $cur_data = array();
            //复制 输入数据
            $cur_data['type'] = $type;
            $cur_data['subject'] = $subject;
            $cur_data['seq'] = $seq;
            $cur_data['score'] = $score;
            $cur_data['extract_count'] = $extract_count;
            //复制 主档表 exam 的字段
            $cur_data['exam_id'] = $id;
            $cur_data['exam_no'] = $master['exam_no'];
            //复制 搜索表 question 的对应字段
            $cur_data['question_id'] = $g['id'];
            $cur_data['question_code'] = $g['code'];
            $cur_data['question_name'] = $g['name'];
            $cur_data['question_parent_id'] = $g['parent_id'];
            $cur_data['question_type'] = $g['type'];
            $cur_data['question_category_code'] = $g['category_code'];
            $cur_data['question_category_name'] = $g['category_name'];
            $cur_data['question_kind'] = $g['kind'];
            $cur_data['question_stem'] = $g['stem'];
            $cur_data['question_quiz'] = $g['quiz'];
            $cur_data['question_answer'] = $g['answer'];
            $cur_data['question_analysis'] = $g['analysis'];//之后添加的列
            $cur_data['question_childs'] = $g['childs'];
            $cur_data['question_img'] = $g['img'];
            //$cur_data['question_id']=$v;
            //$cur_data['question_name']=$g['name'];
            //$cur_data['question_no']=$g['question_no'];
            //明细表是否存在要计算
            //$cur_data['qty']=$qty*$packing_qty;
            //$cur_data['price']=$g['purchase_price'];
            //$cur_data['amount']=round($cur_data['qty']*$cur_data['price'],2);
            //数据更新
            if ($detail) {
                $result = $model->where("id=" . $detail['id'])->save($cur_data);
                $chg_info .= ($chg_info ? "," : "") . $cur_data['question_code'];
            } else {
                $result = $model->add($cur_data);
                if (!$result) $this->ajaxError_func("新增数据(" . $cur_data['question_code'] . ")失败", $data["funcid"] . "_focus");
                $add_info .= ($add_info ? "," : "") . $cur_data['question_code'];
            }
        }
        //进行重新汇总
        $result = $this->detail_subtotal($id, $retinfo);
        if (!$result) $this->ajaxError_func("试卷汇总失败", $data["funcid"] . "_focus");
        $data['statinfo'] = $retinfo;
        $content = $add_info ? "添加[$add_info]" : "";
        if ($chg_info) $content .= ($content ? ", " : "") . "变动[$chg_info]";
        if ($del_info) $content .= ($content ? ", " : "") . "删除[$del_info]";
        $result = createLogOrder('exam', $id, '明细编辑', $content);
        if (!$result) $this->ajaxError_func("创建试卷日志失败", $data["funcid"] . "_focus");
        $model->commit();
        if ($close == "1") {
            $this->ajaxReturn($data["pfuncid"], $data["funcid"], "refresh");
        } else {
            $this->ajax_openLink($data["pfuncid"]);
            $this->ajax_func($data["funcid"] . "_clear()");
            $this->ajax_func($data["funcid"] . "_show", "'" . $retinfo . "'");
            $this->ajaxResult();
        }
    }

    private function detail_stat($master, &$return)
    {
        $details = $master['details'];
        $score = $master['score'];
        $return = sprintf("已添加 %d 条，总分 %d", $details, $score);
    }

    private function detail_subtotal($id, &$return)
    {
        $return = "";
        $detail = M("exam_detail")
            ->field('count(*) as cnt ,count(*) as details ,sum(score) as score ')
            ->where("exam_id=%d", array($id))
            ->select();
        $details = $detail[0]['details'];
        $score = $detail[0]['score'];
        $return = sprintf("已添加 %d 条，总分 %d", $details, $score);
        /*
                $detail = M("exam_detail")->where("exam_id=%d",array($id))->select();
                $amount=0;
                $qty=0;
                $details=0;
                foreach ($detail as $k=>$v) {
                    $qty+=$v['qty'];
                    $amount+=$v['price']*$v['qty'];
                    $details++;
                }
        */
        $result = M('exam')
            ->where("id='%d'", array($id))
            ->save(array(
                'details' => $details,
                'score' => $score,
                'modify_time' => date('Y-m-d H:i:s'),
                'modify_user' => session(C("USER_AUTH_KEY")),
            ));
        return $result;
    }
//// source for grid - end ////
//// source for cancel - begin ////
    private function cancel($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("试卷参数不存在");
        }
        $search = M('exam')->find($id);
        if (!$search)
            $this->ajaxResult("试卷不存在");
        if ($search['status'] == '7') {
            $this->ajaxResult("试卷已取消");
        }
        if ($search['status'] != '1') {
            $this->ajaxResult("试卷状态已变化，请重新处理");
        }
        $data["search"] = $search;
        $data["id"] = $data["search"]["id"];
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Exam:cancel");
        echo $html;
    }

    private function cancel_save($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("试卷参数不存在");
        }
        //id存在时判断数据库内数据是否存在
        $orig = M("exam")->where("id='%d'", array($id))->find();
        if (empty($orig)) {
            $this->ajaxError("试卷数据不存在");
        }
        if ($orig['status'] == '7') {
            $this->ajaxResult("试卷已取消");
        }
        if ($orig['status'] != '1') {
            $this->ajaxResult("试卷状态已变化，请重新处理");
        }
        $reason_tag = I("request.reason_tag");
        $reason = I("request.reason");
        if (!($reason_tag . $reason)) {
            $this->ajaxResult("试卷状态回退，需注明原因");
        }
        $statusdesc = "退回状态[取消], ";
        $input["status"] = "7";  // "文本类型"
        $content = $statusdesc . "备注: ";
        if ($reason_tag) {
            $content .= $reason_tag;
            if ($reason) $content .= ", " . $reason;
        } else {
            $content .= $reason;
        }
        $input["modify_user"] = session(C("USER_AUTH_KEY"));
        $input["modify_time"] = date('Y-m-d H:i:s.n');
        $model = M("exam");
        $model->startTrans();
        //按主键更新数据
        $result = $model->where("id = $id")->save($input);
        //建立操作日志
        $result = $result && createLogOrder('exam', $id, '状态调整', $content);
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
            echo json_encode(array("msg" => message("试卷保存发生错误")));
            die;
        }
        //完成后关闭并刷新父窗口
        $this->ajaxReturn($data ['pfuncid'], $data ['funcid'], "refresh", "", "closepopup");
        die;
    }
//// source for cancel - end ////
//// source for confirm - begin ////
    private function confirm($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("试卷参数不存在");
        }
        $search = M('exam')->find($id);
        if (!$search)
            $this->ajaxResult("试卷不存在");
        if ($search['status'] == '7') {
            $this->ajaxResult("试卷已取消");
        }
        if ($search['status'] != '0') {
            $this->ajaxResult("试卷状态已变化，请重新处理");
        }
        $data["search"] = $search;
        $data["id"] = $data["search"]["id"];
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Exam:confirm");
        echo $html;
    }

    private function confirm_save($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("试卷参数不存在");
        }
        //id存在时判断数据库内数据是否存在
        $orig = M("exam")->where("id='%d'", array($id))->find();
        if (empty($orig)) {
            $this->ajaxError("试卷数据不存在");
        }
        if ($orig['status'] == '7') {
            $this->ajaxResult("试卷已取消");
        }
        if ($orig['status'] != '0') {
            $this->ajaxResult("试卷状态已变化，请重新处理");
        }
        $reason_tag = I("request.reason_tag");
        $reason = I("request.reason");
        $detailtable = M("exam_detail")->where("exam_id = $id")->find();
        if (empty($detailtable)) {
            $this->ajaxResult("试卷明细数据不存在");
        }

        $detailtable = M("exam_detail")->where("exam_id = $id and (question_id=0 or question_id is null)")->find();
        if (empty($detailtable)) {
            $this->ajaxResult("试卷试题不存在");
        }

        $statusdesc = "状态[确认], ";
        $input["status"] = "1";  // "文本类型"
        $content = $statusdesc . "备注: ";
        if ($reason_tag) {
            $content .= $reason_tag;
            if ($reason) $content .= ", " . $reason;
        } else {
            $content .= $reason;
        }
        $input["modify_user"] = session(C("USER_AUTH_KEY"));
        $input["modify_time"] = date('Y-m-d H:i:s.n');
        $model = M("exam");
        $model->startTrans();
        //按主键更新数据
        $result = $model->where("id = $id")->save($input);
        //建立操作日志
        $result = $result && createLogOrder('exam', $id, '状态调整', $content);
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
            echo json_encode(array("msg" => message("试卷保存发生错误")));
            die;
        }
        //完成后关闭并刷新父窗口
        $this->ajaxReturn($data ['pfuncid'], $data ['funcid'], "refresh", "", "closepopup");
        die;
    }
//// source for confirm - end ////
//// source for todummy - begin ////
    private function todummy($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("试卷参数不存在");
        }
        $search = M('exam')->find($id);
        if (!$search)
            $this->ajaxResult("试卷不存在");
        if ($search['status'] == '7') {
            $this->ajaxResult("试卷已取消");
        }
        if ($search['status'] != '1') {
            $this->ajaxResult("试卷状态已变化，请重新处理");
        }
        $data["search"] = $search;
        $data["id"] = $data["search"]["id"];
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Exam:todummy");
        echo $html;
    }

    private function todummy_save($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("试卷参数不存在");
        }
        //id存在时判断数据库内数据是否存在
        $orig = M("exam")->where("id='%d'", array($id))->find();
        if (empty($orig)) {
            $this->ajaxError("试卷数据不存在");
        }
        if ($orig['status'] == '7') {
            $this->ajaxResult("试卷已取消");
        }
        if ($orig['status'] != '1') {
            $this->ajaxResult("试卷状态已变化，请重新处理");
        }
        $reason_tag = I("request.reason_tag");
        $reason = I("request.reason");
        if (!($reason_tag . $reason)) {
            $this->ajaxResult("试卷状态回退，需注明原因");
        }
        $statusdesc = "退回状态[草稿], ";
        $input["status"] = "0";  // "文本类型"
        $content = $statusdesc . "备注: ";
        if ($reason_tag) {
            $content .= $reason_tag;
            if ($reason) $content .= ", " . $reason;
        } else {
            $content .= $reason;
        }
        $input["modify_user"] = session(C("USER_AUTH_KEY"));
        $input["modify_time"] = date('Y-m-d H:i:s.n');
        $model = M("exam");
        $model->startTrans();
        //按主键更新数据
        $result = $model->where("id = $id")->save($input);
        //建立操作日志
        $result = $result && createLogOrder('exam', $id, '状态调整', $content);
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
            echo json_encode(array("msg" => message("试卷保存发生错误")));
            die;
        }
        //完成后关闭并刷新父窗口
        $this->ajaxReturn($data ['pfuncid'], $data ['funcid'], "refresh", "", "closepopup");
        die;
    }
//// source for todummy - end ////
//##combine_for_add_source##

//// source for status confirm ////

//// source for status view ////
    private function view($data)
    {
        $data["p"] = I("request.p/d");
            $data["pagesize"] = I("request.pagesize/d");

        $data["id"] = I("request.id/d");
        $data["no"] = I("request.no");
        if (!$data["id"] && !$data["no"]) {
            $this->ajaxError("试卷信息查询参数非法");
        }

        //condition
        $condition = "";
        $joinsql = "";
        //select search fields
        $selectmasterfields = "@exam.*";
        $sort="@exam.sort";

        $sql = table("select #selectfields# from @exam  #join# Where #viewkey# #condition# #orderby#");
        if ($data["id"])
            $viewkey = table("@exam.id=$data[id]");
        else
            $viewkey = table("@exam.exam_no='$data[no]'");
        $sql = str_replace("#selectfields#", table($selectmasterfields), $sql);
        $sql = str_replace("#join#", $joinsql, $sql);
        $sql = str_replace("#viewkey#", $viewkey, $sql);
        $sql = str_replace("#condition#", $condition, $sql);
        $sql = str_replace("#orderby#","", $sql);
        $search = M()->query($sql);
        if (!$search) {
            $this->ajaxError("试卷信息信息不存在");
        }
        $data["search"] = current($search);


        //按tabsheet - 开始
        $data["id"] = $data["search"]["id"];
        $data["search"]["_tab"] = $this->tabsheet_check(I("request._tab"));
        $page_size = $data["pagesize"];//session("Exam-".$data["search"]["_tab"]."-PageSize");
        switch ($data["search"]["_tab"]) {

            case "shijuanmingxi":
                $data = $this->tab_shijuanmingxi_exam_detail($page_size, $data);
                break;
            case "caozuorizhi":
                $data = $this->tab_caozuorizhi_log_order($page_size, $data);
                break;
            case "showview2":
                $data = $this->tab_showview2($page_size, $data);
                break;
            case "showanswer":
                $data = $this->tab_answer($page_size, $data);
                break;
            case "showanalysis":
                $data = $this->tab_showview2($page_size, $data);
                break;
            case "createPDF":
                $data = $this->createPDF($page_size, $data);
                break;

        }
        $data["search"]["_tab_" . $data["search"]["_tab"] . "_p"] = $data["p"];
        $data["search"]["_tab_" . $data["search"]["_tab"] . "_psize"] = $data["page_size"];
        //session("Exam-".$data["search"]["_tab"]."-PageSize", $data["page_size"]);
        //按tabsheet - 结束

        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Exam:view");
        echo $html;
    }

    //按tabsheet子程序 - 开始

    private function tab_shijuanmingxi_exam_detail($tab_pagesize, $data)
    {
        $orderby = "";
        $joinsql = "";


        $condition = " and @exam_detail.type=0";

        //select detail fields
        $selectfields = "@exam_detail.id ";
        $selectfields .= ",@exam_detail.seq ";
        $selectfields .= ",@exam_detail.score ";
        $selectfields .= ",@exam_detail.question_id ";
        $selectfields .= ",@exam_detail.question_type ";
        $selectfields .= ",@exam_detail.question_code ";
        $selectfields .= ",@exam_detail.question_category_name ";
        $selectfields .= ",@exam_detail.question_kind ";
        $selectfields .= ",@exam_detail.question_stem ";
        $selectfields .= ",@exam_detail.question_description ";
        $selectfields .= ",@exam_detail.question_quiz ";
        $selectfields .= ",@exam_detail.question_answer ";
        $selectfields .= ",@exam_detail.question_analysis";
        $selectfields .= ",@exam_detail.question_img ";
        $selectfields .= ",@exam_detail.extract_count ";

        $viewkey = "@exam_detail.exam_id='" . $data["search"]["id"] . "'";
        if (!$viewkey)
            $this->ajaxError("查询参数非法");
        //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @exam_detail  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @exam_detail  #join# Where #viewkey# #condition# #orderby#");

        $viewkey = table($viewkey);
        $condition = table($condition);
        $orderby = table($orderby);
        $selectfields = table($selectfields);

        $count_sql = str_replace("#condition#", $condition, $count_sql);
        $count_sql = str_replace("#viewkey#", $viewkey, $count_sql);
        $count_sql = str_replace("#join#", $joinsql, $count_sql);

        $count = M()->query($count_sql);
        $count = $count[0]["cnt"];

        if ($count < $page_size)
            $tmp = 1;
        else {
            $tmp = intval($count / $page_size);
            if ($count % $page_size != 0) {
                $tmp++;
            }
        }
        if (!$data["p"]) {
            $data["p"] = 1;
        }
        if ($data["p"] > $tmp) {
            $data["p"] = $tmp;
        }

        $sql = str_replace("#selectfields#", $selectfields, $search_sql);
        $sql = str_replace("#join#", $joinsql, $sql);
        $sql = str_replace("#viewkey#", $viewkey, $sql);
        $sql = str_replace("#condition#", $condition, $sql);
        $sql = str_replace("#orderby#", $orderby, $sql);
        $sql .= " LIMIT " . (($data["p"] - 1) * $page_size) . ", $page_size";
        $data["list"] = M()->query($sql);
        $pageClass = new \Think\Page($count, $page_size);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"], "");
        $data["page_size"] = $page_size;

        return $data;
    }

    private function tab_caozuorizhi_log_order($tab_pagesize, $data)
    {
        $orderby = "";
        $joinsql = "";


        $condition = "";


        //select detail fields
        $selectfields = "@log_order.status ";
        $selectfields .= ",@log_order.id ";
        $selectfields .= ",@log_order.create_time ";
        $selectfields .= ",@log_order.order_id ";
        $selectfields .= ",@log_order.order_no ";
        $selectfields .= ",@log_order.subject ";
        $selectfields .= ",@log_order.details ";
        $selectfields .= ",@log_order.qty ";
        $selectfields .= ",@log_order.amount ";
        $selectfields .= ",@log_order.content ";

        $viewkey = "@log_order.order_id='" . $data["search"]["id"] . "'";
        $viewkey .= " and @log_order.type='exam'";
        if (!$viewkey)
            $this->ajaxError("查询参数非法");
        //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @log_order  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @log_order  #join# Where #viewkey# #condition# #orderby#");
        $orderby = "order by @log_order.id desc";

        $viewkey = table($viewkey);
        $condition = table($condition);
        $orderby = table($orderby);
        $selectfields = table($selectfields);

        $count_sql = str_replace("#condition#", $condition, $count_sql);
        $count_sql = str_replace("#viewkey#", $viewkey, $count_sql);
        $count_sql = str_replace("#join#", $joinsql, $count_sql);

        $count = M()->query($count_sql);
        $count = $count[0]["cnt"];

        if ($count < $page_size)
            $tmp = 1;
        else {
            $tmp = intval($count / $page_size);
            if ($count % $page_size != 0) {
                $tmp++;
            }
        }
        if (!$data["p"]) {
            $data["p"] = 1;
        }
        if ($data["p"] > $tmp) {
            $data["p"] = $tmp;
        }

        $sql = str_replace("#selectfields#", $selectfields, $search_sql);
        $sql = str_replace("#join#", $joinsql, $sql);
        $sql = str_replace("#viewkey#", $viewkey, $sql);
        $sql = str_replace("#condition#", $condition, $sql);
        $sql = str_replace("#orderby#", $orderby, $sql);
        $sql .= " LIMIT " . (($data["p"] - 1) * $page_size) . ", $page_size";
        $data["list"] = M()->query($sql);
        $pageClass = new \Think\Page($count, $page_size);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"], "");
        $data["page_size"] = $page_size;

        return $data;
    }

    private function tab_showview2($tab_pagesize, $data)
    {
        //$this->display('Exam/view2');

        $id = I("get.id/d");
        if (empty($id)) {
            $this->ajaxError("非法操作");
        }
        $exam = M("exam")->where("id = $id")->find();
        if (empty($exam)) {
            $this->ajaxError("试卷不存在");
        }

//      $examDetailRaw = M("exam_detail")->where("exam_id = $id")->order("id asc")->select();
        $examDetailRaw = M("exam_detail")->where("exam_id = $id")->order("sort")->select();

        $examDetail = array();
        foreach ($examDetailRaw as $key => $item) {
            $examDetail[$item["id"]] = $item;
        }
        $detail = array();
        $questions = array();
        $index = -1;
        $currentId = 0;
        $currentType1Id = -1;
        $noHeader = false;
        foreach ($examDetail as $key => $item) {
            if ($item["question_type"] == 1) {
                $s = "(";
                if ($item["seq"] == 0) {
                    $m = M("exam_detail")->field("min(seq) as seq1, max(seq) as seq2")->where("exam_id = $id AND question_parent_id = " . $item["question_id"])->find();
                    if (!empty($m) && $m["seq1"] != $m["seq2"]) {
                        $s .= "第" . $m["seq1"] . "-" . $m["seq2"] . "题, 共";
                    }
                }
                $item["question_stem"] .= $s . $item["score"] . "分)";
            }
            $item["question_stem"] = scanSubject($item["seq"], $item["question_stem"], $item["question_kind"], $item["question_img"], false, $item["score"]);
            if ($item["question_description"] != "") {
                $item["question_description"] = "[#KA][/#]" . $item["question_description"];
            }
            $item["question_description"] = scanSubject($item["seq"], $item["question_description"], $item["question_kind"], $item["question_img"], true);
            $pk = false;
            $item["question_analysis"] = scanLine($item["question_analysis"], $pk);
            if ($item["question_img"] != "") {
                $item["hasImg"] = true;
            }
            $pk = false;
            if ($item["question_kind"] == "xz" || $item["question_kind"] == "dx") {
                $item["question_quiz_item"] = explode("|", $item["question_quiz"]);
                foreach ($item["question_quiz_item"] as $k => $r) {
                    $f = mb_substr($r, 0, 1);
                    $f = strtoupper($f);
                    $o = ord($f);
                    if ($o >= 65 && $o <= 90) {
                        $item["question_quiz_item"][$k] = mb_substr($r, 1);
                    }
                    if (mb_substr($item["question_quiz_item"][$k], 0, 2) == " .") {
                        $item["question_quiz_item"][$k] = " " . mb_substr($item["question_quiz_item"][$k], 2);
                    }
                    if (mb_substr($item["question_quiz_item"][$k], 0, 1) == ".") {
                        $item["question_quiz_item"][$k] = " " . mb_substr($item["question_quiz_item"][$k], 1);
                    }
                    $item["question_quiz_item"][$k] = scanLine($item["question_quiz_item"][$k], $pk);
                }
            } else {
                $item["question_quiz_item"] = scanLine($item["question_quiz_item"], $pk);
            }

            if ($item["type"] != 0) {
                if (!$item["question_id"]) {
                    $index--;
                    $currentId = $index;
                    $detail[$currentId] = $item;
                    //$detail[$currentId]["score"] = 0;
                    $noHeader = false;
                    continue;
                } else {
                    if ($currentId != $item["question_id"]) {
//                    $currentType1Id = $item['question_id'];
                        $currentId = $item['question_id'];
                        $detail[$currentId] = $item;
                        //$detail[$currentId]["score"] = 0;
                        $noHeader = false;
                        continue;
                    }
                }
            } else {
                if (count($detail) == 0) {
                    $detail[$currentId] = array("subject" => "无标题", "score" => 0);
                    $currentId = $index;
                    $index--;
                    $noHeader = true;
                } else {
                    if ($item["question_parent_id"] == 0 && $currentId > 0 && $noHeader) {
                        $detail[$currentId] = array("subject" => "无标题", "score" => 0);
                        $currentId = $index;
                        $index--;
                        $noHeader = true;
                    } else {
                        $noHeader = false;
                    }
                }
            }

            if ($item["type"] == 1) {
                if ($item["question_parent_id"] != 0) {
                    $detail[$currentId]["questions"][$item["question_parent_id"]][] = $item;
                    //$detail[$currentId]["score"] += $item["score"];
                } else {
                    $detail[$currentId]["questions"][$item["question_id"]][] = $item;
                }
            } else {
                if ($noHeader) {
                    $noHeader = false;
                }
                $detail[$currentId]["questions"][$item["question_id"]][] = $item;
                //$detail[$currentId]["score"] += $item["score"];
            }
        }

        $data["detail"] = $detail;

        return $data;
    }

    private function tab_answer($tab_pagesize, $data)
    {
        $id = I("get.id/d");
        if (empty($id)) {
            $this->ajaxError("非法操作");
        }
        $exam = M("exam")->where("id = $id")->find();
        if (empty($exam)) {
            $this->ajaxError("试卷不存在");
        }
        //$examDetailRaw = M("exam_detail")->field("seq, question_answer,type,subject")->where("exam_id = $id AND question_answer !='' AND question_answer is not null")->order("id asc")->select();  //2019-05-05修改之前
        $examDetailRaw = M("exam_detail")->field("seq, question_answer,type,subject")->where("exam_id = $id")->order("id asc")->select();

        $data["detail"] = $examDetailRaw;
        return $data;
    }

    private function tab_analysis($tab_pagesize, $data)
    {
        $id = I("get.id/d");
        if (empty($id)) {
            $this->ajaxError("非法操作");
        }
        $exam = M("exam")->where("id = $id")->find();
        if (empty($exam)) {
            $this->ajaxError("试卷不存在");
        }

        $examDetailRaw = M("exam_detail")->field("seq, question_analysis, question_answer")->where("exam_id = $id AND question_analysis !='' AND question_analysis is not null")->order("id asc")->select();

        $data["detail"] = $examDetailRaw;
        return $data;
    }

    private function tabsheet_check($itab)
    {
        $idefault = "showview2";
        switch ($itab) {
            case "shijuanmingxi":
            case "zujuanmoban":
            case "caozuorizhi":
            case "showview2":
            case "showanswer":
            case "showanalysis":
            case "createPDF":
                break;
            default:
                $itab = $idefault;
                break;
        }
        return $itab;
    }

    //按tabsheet子程序 - 结束

    private function deleteProcess($id)
    {
        $type = 1;
        $smo = M('exam')->where("id='%d'", array($id))->find();
        if (empty($smo)) {
            $this->ajaxResult("试卷信息数据不存在");
        }
        if ($smo['status'] != 0) {
            $this->ajaxResult("试卷信息状态不能删除");
        }

        $result = true;
        $result = $result && createLogOrder('exam', $id, ($smo['status'] ? '取消信息' : '删除记录'), '');
        if ($smo['status'] != 0) {
            $result = $result && M('exam')->where("id='%d'", array($id))->save(array('status' => 8, 'cancel_time' => date('Y-m-d H:i:s'), 'cancel_status' => 1));
        } else {
            $result = $result && M('exam')->where("id='%d'", array($id))->delete();
        }
        return $result;
    }




    private function order_delete($data)
    {

        $id = I("request.id/d");
        $type = I("request.type/d");
        if (!$id) {
            $this->ajaxResult("试卷信息参数不存在");
        }

        $m = M();
        $m->startTrans();
        $r = $this->deleteProcess($id);
        if ($r) {
            $m->commit();
        } else {
            $m->rollback();
        }

        $this->ajax_hideConfirm();
        if (!$type) {
            $this->ajax_closeTab($data ['funcid']);
        }
        $this->ajax_refresh($data ['pfuncid']);
        $this->ajaxResult();
        die;
    }

    private function detail_delete($data)
    {
        $data["id"] = I("request.id");

        if (!is_array($data["id"])) {
            $data["id"] = array($data["id"]);
        }

        $model = M('exam_detail');
        $model->startTrans();
        $result1 = true;
        $orderid = 0;
        $content = '';
        foreach ($data["id"] as $v) {
            $pd_delete = $model->where("id='%d'", array($v))->find();
            if ($orderid == 0) {
                $orderid = $pd_delete['exam_id'];
            }
            $result1 = $model->where("id='%d'", array($v))->delete();

            //写日志
            $content .= getOrderChange(array(), array(), 'exam', '删除商品[' . $pd_delete['goods_no'] . $pd_delete['goods_name'] . ']');

            if (!$result1) {
                break;
            }
        }

        //重新汇总 数量/金额，具体程序具体调整
        $rpd = $model->where("exam_id='%d'", array($orderid))->field('qty,price')->select();
        $amount = 0;
        $qty_total = 0;
        foreach ($rpd as $k => $v) {
            $qty_total += $v['qty'];
            $amount += $v['price'] * $v['qty'];
        }

        $result2 = M('exam')->where("id='%d'", array($orderid))->save(array('qty' => $qty_total, 'amount' => $amount));

        $smo = M('exam')->where("id='%d'", array($orderid))->find();
        if ($smo['status'] != 0) {
            $result2 = false;
        }

        $result1 = $result1 && createLogOrder('exam', $orderid, '删除试卷信息商品', $content);

        if ($result1 && $result2) {
            $model->commit();
        } else {
            $model->rollback();
        }

        $this->ajaxResult("", "", array("_asr.openLink"), array("'','" . $data["funcid"] . "','刷新', 1"));
    }

    private function selectProduct($data)
    {

        $data["search"]["category_id"] = I("get.category_id/a");
        $data["search"]["name"] = I("get.name");
        $data["search"]["goods_no"] = I("get.goods_no");
        $data["search"]["namelike"] = I("get.namelike/d");
        $data["orderid"] = I("request.id");
        $data["p"] = I("get.p/d");

        $where = "where 1=1";
        if (!empty($data["search"]["category_id"])) {
            $where .= " AND category_id IN (" . join(",", $data["search"]["category_id"]) . ")";
        }

        if (!empty($data["search"]["name"])) {
            if ($data["search"]["namelike"]) {
                $where .= " AND like '%" . $data["search"]["name"] . "%'";
            } else {
                $where .= " AND name = '" . $data["search"]["name"] . "'";
            }
        }

        if (!empty($data["search"]["goods_no"])) {
            $where .= " AND goods_no = '" . $data["search"]["goods_no"] . "'";
        }

        $data["page_size"] = I("get.pagesize/d");
        $data["page_size"] = $data["page_size"] <= 0 ? session("selectProduct-PageSize") : $data["page_size"];
        if (!$data["page_size"]) {
            $data["page_size"] = 10;
        }
        //$data["page_size"] = 2;
        session("selectProduct-PageSize", $data["page_size"]);

        $pre = C("DB_PREFIX");
        $count_sql = "SELECT count(*) AS cnt FROM " . $pre . "goods $where";
        $count = M()->query($count_sql);
        $count = $count[0]["cnt"];

        if ($count < $data["page_size"])
            $tmp = 1;
        else {
            $tmp = intval($count / $data["page_size"]);
            if ($count % $data["page_size"] != 0) {
                $tmp++;
            }
        }
        if (!$data["p"]) {
            $data["p"] = 1;
        }

        if ($data["p"] > $tmp) {
            $data["p"] = $tmp;
        }

        $sql = "SELECT g.* FROM " . $pre . "goods as g $where";
        $sql .= " LIMIT " . (($data["p"] - 1) * $data["page_size"]) . ", " . $data["page_size"];

        $data["list"] = M()->query($sql);

        $smo = M('exam')->where("id='%d'", array($data["orderid"]))->find();
        $model = M("exam_detail");
        $sm = M('stock2');
        $storage = M('storage')->where("code='%s'", array($smo['storage_code']))->find();


        foreach ($data["list"] as $k => $v) {
            $stock = $sm->where("storage_id='%d' AND goods_id='%d' ", array($storage['id'], $v['id']))->find();
            $data['list'][$k]['sctok'] = floatval($stock['qty']);
            $smd = $model->where("exam_id='%d' AND goods_id='%d' ", array($data["orderid"], $v['id']))->find();
            $data['list'][$k]['qty'] = floatval($smd['qty']);
        }

        $pageClass = new \Think\Page($count, $data["page_size"]);
        $pageClass->rollPage = 8;
        $data["page"] = $pageClass->show_drp($data["funcid"], "编辑商品信息");

        $categroy_list = M("category")->where("parent_id = 0")->select();
        $clist = array();
        foreach ($categroy_list as $category) {
            $clist[$category["id"]]["main"] = $category;
            $clist[$category["id"]]["detail"] = M("category")->where("parent_id = " . $category["id"])->select();
        }

        $data["categorys"] = $clist;

        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Exam:selectProduct");
        echo $html;
    }

    private function saveSelectProduct($data)
    {
        $orderid = I("request.orderid");
        $close = I("request.close");

        $id = I("id");
        $model = M("exam_detail");
        $smo = M('exam')->where("id='%d'", array($orderid))->find();
        if (empty($smo)) {
            $this->ajaxResult("试卷信息不存在");
        }
        $sm = M('stock2');
        $gm = M('goods');

        $model->startTrans();
        $result = false;
        foreach ($id as $k => $v) {
            $g = $gm->where("id='%d'", $v)->find();

            $qty = floatval(I("qty_" . $v));
            $storage_location = I("storage_location_" . $v);

            $smd = $model->where("exam_id='%d' AND goods_id='%d' ", array($orderid, $v))->find();

            $cur_data = array();
            $cur_data['goods_id'] = $v;
            $cur_data['exam_id'] = $orderid;
            $cur_data['order_no'] = $smo['order_no'];
            $cur_data['qty'] = $qty;
            $cur_data['order_qty'] = $qty;
            $cur_data['price'] = I("price_" . $v);
            $cur_data['amount'] = $cur_data['price'] * abs($qty);
            $cur_data['goods_no'] = $g['goods_no'];
            $cur_data['goods_name'] = $g['name'];
            $cur_data['brand_code'] = $g['brand_code'];
            $cur_data['style_info'] = $g['style_info'];
            $cur_data['barcode'] = $g['barcode'];
            $cur_data['location_code'] = $storage_location;
            $cur_data['storage_code'] = $smo["storage_code"];

            if (!empty($smd)) {
                $result = $model->where("exam_id='%d' AND goods_id='%d'", array($orderid, $v))->save($cur_data);
            } else {
                $result = $model->add($cur_data);

            }

            if (!$result) {
                break;
            }

        }

        $qty_total = $model->where("exam_id='%d'", array($orderid))->field("SUM(qty) qty_total,SUM(amount) amount_total")->find();

        $result2 = M('exam')->where("id='%d'", array($orderid))->save(array('qty' => $qty_total['qty_total'], 'amount' => $qty_total['amount_total'], 'modify_time' => date('Y-m-d H:i:s'), 'modify_user' => session(C("USER_AUTH_KEY"))));

        $sa = M('exam')->where("id='%d'", array($orderid))->find();

        if ($sa['status'] != 0) {
            $result2 = false;
        }

        if ($result && $result2) {
            $model->commit();
        } else {
            $model->rollback();
        }

        if ($close == "1") {
            $this->ajaxResult("", "", array("_asr.closePopup", "_asr.openLink"), array("'" . $data["funcid"] . "'", "'','" . $data["pfuncid"] . "','刷新', 1"));
        } else {
            $this->ajaxResult("", "", array("_asr.openLink"), array("'','" . $data["pfuncid"] . "','刷新', 1"));
        }

        die;
    }

    //试卷PDF下载
    public function createPDF()
    {
        $data = ($_GET);
        $id = $data['id'];
        if (empty($id)) {
            $this->ajaxError("非法操作");
        }
        $exam = M("exam")->where("id = $id")->find();
        if (empty($exam)) {
            $this->ajaxError("试卷不存在");
        }

        $sql = "select a.* " .
            "from @exam_detail a " .
            "where a.exam_id=" . $id . " " .
            "order by a.id";
        $sql = table($sql);
        $detail = M()->query($sql);
        if (!$detail) {
            $this->ajaxError("试卷题目不存在");
        }
        foreach ($detail as $k=>$r){
            if($r['question_type']==1){
                $first="";
                $last="";
                $score="";
                foreach ($detail as $c){
                    if($c['question_parent_id']==$r['question_id']){
                        if(!$first)$first=$c['seq'];
                        $last=$c['seq'];
                        $score+=$c['score'];
                    }
                }
                $detail[$k]["score"]=$score;
                $detail[$k]["subject"]="";
                if(!$r['seq'] && $first!=$last){
                    $detail[$k]["subject"]="第".$first."-".$last."题";
                }

            }

            if ($r['question_quiz']) {
                $quiz_array = explode('|', $r['question_quiz']);
                //判断每个选项的长度
                $item= array();
                foreach ($quiz_array as $key => $value) {
                    $value=trim($value);
                    $char1=strtoupper(mb_substr($value,0,1));
                    $char2=mb_substr($value,1,1);
                    if($char1>="A" && $char1<="D" && ($char2=="." || $char2==" ")){
                        $value=trim(mb_substr($value,3));
                    }
                    $item[]=$value;
                }
                $detail[$k]['question_quiz'] = $item;
            }
        }

        $url = $this->createPDF_process($exam, $detail);

        ob_start();
        $file = fopen($url['url'],"r");
        $fileName = date("Y-m-d").rand(1000,9999);
        Header('Content-Type: application/pdf');
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: ".filesize($url['url']));
        Header("Content-Disposition: attachment; filename= ".$fileName.".pdf");
        echo file_get_contents($url['url']);
        fclose($file);

    }

    private function    createPDF_process($exam, $detail)
    {
        set_time_limit(0);

        $dirUrl = "/Uploads/PDF/";
        $dir = $_SERVER['DOCUMENT_ROOT'] . $dirUrl;
        if(!file_exists($dir)){
            @mkdir($dir,0755);
        }
        $fileName = date("Y-m-d").rand(1000,9999);
        $dir .= $fileName;

        $pdf_file = $dir . ".pdf";


        Vendor('tcpdf.tcpdf');
        Vendor('tcpdf.examples.tcpdf_clude');
        $pdf = new \tcpdf('Landscape', 'pt', 'A4', true, 'UTF-8', false);

        //设置文件信息
        $pdf->SetCreator("system");//创建者
        $pdf->SetAuthor('');//作者
        $pdf->SetTitle($exam["subject"]);//文件标题
        $pdf->SetSubject('');//主题
        $pdf->SetKeywords(', , , , ');//关键词

        //设置默认等宽字体
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $header_top=50;

        $pdf->SetMargins('40', $header_top, '40', ture);

        //去掉默认的页头页脚
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        //设置自动分页符
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //设置行高
//        $pdf->setCellHeightRatio(1);
        //设置图像自适应比例
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        /*设置字体：
        字体类型（如helvetica(Helvetica)黑体，times (Times-Roman)罗马
        字体）、风格（B粗体，I斜体，underline下划线等）、字体大小 */
//        $pdf->SetFont('stsongstdlight', '', 10);

        //dump(VENDOR_PATH.'tcpdf/examples/images/image_demo.jpg');die;
        // 设置一些与语言相关的字符串 (optional)
        if (@file_exists(dirname(VENDOR_PATH . 'tcpdf/examples/lang/eng.php'))) {

            $l = array();
            require_once(VENDOR_PATH . 'tcpdf/examples/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $selectchar = array("A. ","B. ","C. ","D. ");

        /*增加一个页面:
       Orientation：orientation属性用来设置文档打印格式。 Landscape为横式打印，Portrait为纵向打印。
       Format：设置此页面的打印格式。
       Keepmargins：true，以当前的边幅代替默认边幅来重写页面边幅。
       Tocpage：true，所添加的页面将被用来显示内容表。*/
        $pdf->AddPage('P', 'A4', ture);
        //设置头部边幅
        $pdf->SetHeaderMargin(false);
        //设置底部边幅
        $pdf->SetFooterMargin(20);
        $page_width = 589;

        //选项间距
        $margin = 20;

        $title_x = 60;

        //左侧边距
        $start_x = 75;
        //页面输出宽度
        $title_width= $page_width - ($title_x * 2) ;
        $content_width = $page_width - ($title_x * 2) - ($start_x -$title_x);
        //标题X
        $seq_x = $start_x ;
        //内容X
        $stem_x = $seq_x +15;
        //内容宽度
        $stem_width = $content_width - 15;
        //图片居左x
        $pic_x = '';

        //图片高
        $pic_h = 140;
        //图片宽
        $pic_w = 210;
        //四分之一页宽
        $w4_width = ($stem_width-$start_x) / 4;
        $w4 = $w4_width - $margin*2;
        //二分之一页宽
        $w2_width = ($stem_width-$start_x) / 2;
        $w2 = $w2_width - $margin*2;

        //拼接
        foreach ($detail as $key => $list) {
            $faker = '';
            $this->pdf_setfont($pdf, 'stsongstdlight', '12', '', '', '');
            $y = $pdf->getY()+5;
            if ($list['type']) {
                $faker = $list['subject'];
                switch ($list['type']) {
                    case  1:
                        $this->pdf_setfont($pdf, 'simfang', '20', '', '', '');
                        $this->pdf_output($pdf, $title_width, $title_x, $y, $faker, 'C');
                        break;
                    case  2:
                        $this->pdf_setfont($pdf, 'simhei', '24', 'B', '', '');
                        $this->pdf_output($pdf, $title_width, $title_x, $y, $faker, 'C');
                        break;
                    case  3:
                        $this->pdf_setfont($pdf, 'simfang', '20', '', '', '');
                        $this->pdf_output($pdf, $title_width, $title_x, $y, $faker, 'C');
                        break;
                    case  4:
                        $this->pdf_setfont($pdf, 'simfang', '12', 'B', '', '');
                        $this->pdf_output($pdf, $title_width, $title_x, $y, $faker, 'L');
                        break;
                    case  5:
                        $this->pdf_setfont($pdf, 'simfang', '12', '', '', '');
                        $this->pdf_output($pdf, $title_width, $title_x, $y, $faker, 'L');
                        break;
                    case  6:
                        $this->pdf_setfont($pdf, 'simhei', '20', 'B', '', '');
                        $this->pdf_output($pdf, $title_width, $title_x, $y, $faker, 'C');
                        break;
                    case 7:
                        $faker .= "(共" . $list['score'] . "分)"."<br>" .$list['additional'];
                        $this->pdf_setfont($pdf, 'simfang', '16', 'B', '', '');
                        $this->pdf_output($pdf, $title_width, $title_x, $y, $faker, 'L');
                        break;
                }

            } else {

                $seq="";
                if ($list['seq'] > 0) {
                    if ($list['req_type'] && !$list['req_child_seq']) {
                        $seq = "[" . $list['seq'] . "]";
                    } else {
                        $seq = $list['seq'] . ".";
                    }
                    $this->pdf_output($pdf, $content_width, $seq_x, $y, $seq, 'L',false,$pagechanged);
                    if($pagechanged){
                        $this->pdf_setnewpage($pdf,$y);
                    }
                }

                if ($list['question_stem'] != '') {
                    $faker .= $list['question_stem'];
                }

                if ($list['question_type']==1) {
                    $faker .= " (";
                    if ($list['subject']) {
                         $faker .= $list['subject'] . ", ";
                    }
                    $faker .= "共" . $list['score'] . "分)";
                } else {
                    if ($list['score'] > 0) {
                        $faker .= " (" . $list['score'] . "分)";
                    }
                }
                $faker_html = $this->Convert_Define_ToHtml($faker, $border, $align_text, $fontname, $align_image, $err);
                if ($err) return $err;
                $this->pdf_output($pdf, $stem_width,($seq? $stem_x:$seq_x), $y, $faker_html, 'j',$border);
                $y = $pdf->getY() ;

                if ($list['question_description']) {
                    $faker = $list['question_description'];
                    $faker_html = $this->Convert_Define_ToHtml($faker, $border, $align_text, $fontname, $align_image, $err);
                    if ($err) return $err;
                    $this->pdf_output($pdf, $stem_width, ($seq? $stem_x:$seq_x), $y, $faker_html, 'j', $border);
                    $y = $pdf->getY() ;
                }

                if ($list['question_img']) {
                    //显示图片
                    $y = $pdf->getY() + 5;
                    $sign_pic_url = $_SERVER['DOCUMENT_ROOT'] . substr($list['question_img'], 1);
                    $pdf->Image($sign_pic_url, $start_x, $y, $pic_w, $pic_h, '', '', 'N', false, '', 'C');
                    if ($list['seq']) {
                        $y = $pdf->getY() + 5;
                        $content = "(第" . $list['seq'] . "题图)";
                        $this->pdf_output($pdf, $stem_width, $start_x, $y, $content, 'C');
                    }
                    $y = $pdf->getY() + 5;
                }
                //选项
                print_r($list);
                $boolean=true;
                if ($list['question_quiz']) {
                    $y+=3;
                    //if(is_array($list['question_quiz']))
                        $quiz_array = $list['question_quiz'];
                    //else
                    //    $quiz_array = explode('|', $list['question_quiz']);
                    $quiz_width = array();
                    //判断每个选项的长度
                    foreach ($quiz_array as $key => $value) {
                        $quiz_width[$key] = $pdf->GetStringWidth($value);

                        if(strstr($value,"/Uploads/img/")){
                            $boolean=false;
                        }

                    }
                    $style = 2;
                    if (max($quiz_width) < $w4)
                        $style = 4;
                    elseif (max($quiz_width) > $w2)
                        $style = 1;
                    if($boolean===false){
                        $style = 2;
                    }



                    switch ($style) {

                        /**
                         * 一行一个
                         */
                        case 1:
                            foreach ($quiz_array as $k => $v) {
                                $quiz_x = $stem_x;
                                $quiz_y = $y;
                                $this->pdf_output($pdf, $stem_width, $quiz_x, $quiz_y, $selectchar[$k].$quiz_array[$k], 'L');
                                $y = $pdf->getY();
                            }
                            break;

                        /**
                         * 两个两个一行
                         */
                        case 2:
                            //date :2019-6-25 加入
                            $ranks=0; //循环趟数

                            $optionpotox1=$start_x+5+10;          //选项中AB的x轴
                            $optionpotox2=$optionpotox1+210+5;    //选项中AB的y轴
                            $optionpotoy1=$y;                     //选项中CD的x轴
                            $optionpotoy2=$y+140+5;               //选项中CD的y轴

                            $optionpotoycc=array(array("$optionpotox1","$optionpotoy1"),array("$optionpotox1","$optionpotoy2")
                            ,array("$optionpotox2","$optionpotoy1"),array("$optionpotox2","$optionpotoy2"));


                            foreach ($quiz_array as $k => $v) {

                                if(strstr($v,"/Uploads/img/")==null){

                                    $quiz_x = $stem_x + (($k % 2) ? ($w2_width) : 0);
                                    $quiz_y = $y;


                                $this->pdf_output($pdf, $stem_width, $quiz_x, $quiz_y, $selectchar[$k].$quiz_array[$k], 'L',false, $pagechanged);
                                if ($pagechanged) {
                                    $this->pdf_setnewpage($pdf,$y);
                                }else{
                                    if ($k > 0 && ($k%2)){
                                        $y = $pdf->getY();
                                    }
                                }
                                }else{

                                    $y = $pdf->getY() + 5;
                                    $sign_pic_url = $_SERVER['DOCUMENT_ROOT'] . substr($v, 1);
                                 // date:2019-6-25 原因：将之前的x轴 y轴 改为根据foreach的数据
                                 // $pdf->Image($sign_pic_url, $start_x, $y, $pic_w, $pic_h, '', '', 'N', false, '', 'C');
                                    $pdf->Image($sign_pic_url, $optionpotoycc[$ranks][0], $optionpotoycc[$ranks][1], $pic_w, $pic_h, '', '', 'N', false, '', '');
                                    if ($list['seq']) {
                                        $y = $pdf->getY() + 5;

                                        $this->pdf_output($pdf, $stem_width, $start_x, $y, $content, 'C');
                                    }
                                    $y = $pdf->getY() + 5;
                                }
                                $ranks++;
                            }
                            break;
                        /**
                         * 四个一行
                         */
                        case 4:

                            foreach ($quiz_array as $k => $v) {
                                $quiz_x = $stem_x + $k * ($w4_width);
                                $quiz_y = $y;
                                $this->pdf_output($pdf, $stem_width, $quiz_x, $quiz_y, $selectchar[$k].$quiz_array[$k], 'L',false, $pagechanged);
                                if ($pagechanged) {
                                    $this->pdf_setnewpage($pdf,$y);
                                }
                            }
                            break;
                    }
                }
            }
        }

        ob_clean();
//        F含义：保存
//        D含义：下载
//        I函数：直接输出
        $pdf->Output($pdf_file, 'F');
        return array("msg"=>'200',"url"=>$pdf_file,);


    }

    public function pdf_setnewpage($pdf, &$y) {
        $page=$pdf->getPage();
        $pdf->setPage($page);
        $ret =$pdf->getMargins();
        $y=$ret["top"];
    }

    public function pdf_setfontbyarray($pdf,$font) {
        $this->pdf_setfont($pdf,$font[0],$font[1],$font[2]);
    }

    public function pdf_output($pdf, $content_width, $x = 0, $y, $content, $align = 'J', $border = false, &$pagechanged=false)
    {
        $pagechanged=false;
        $page1=$pdf->getPage();
        if ($align != 'L' && $align != 'C' && $align != 'R' && $align != 'J') {
            $align = 'J';
        }
        if($y>0){
            if($border)$y+=3;
        }
        else{
            $pdf->setY($pdf->getY()+3);
        }

        $pdf->writeHTMLCell($content_width, 2, $x, $y, $content, ($border ? 1 : 0), 1, false, true, $align ,  true);

        $pagechanged=($pdf->getPage()!=$page1);
        if($pagechanged && $border){
            $pdf->setY($pdf->getY()+3);
        }
    }

    public function pdf_setfont($pdf, $fontname = '', $fontsize = '', $fontbold = '', $fontunderline = '', $fontitalic = '')
    {
        if (!$fontname) {
            $fontname = 'stsongstdlight';
        }
        if (!$fontsize || $fontsize <= 0) {
            $fontsize = '12';
        }
        $style = '';
        if ($fontbold) {
            $style .= 'B';
        }
        if ($fontunderline) {
            $style .= 'U';
        }
        if ($fontitalic) {
            $style .= 'I';
        }
        $pdf->SetFont($fontname, $style, $fontsize);

    }

    //递归判断题干的自定义是否合法
    function Convert_Define_ToHtml($inp, &$border =false, &$align_text="", &$fontname="", &$align_image="", &$err="")
    {
//        $pic_url = $_SERVER['DOCUMENT_ROOT'] . "/Uploads/img/1.jpg";
//        $pic = '<img src="'.$pic_url.'" width="20" height="20" >';
//        $inp = str_replace("\n","<br/>$pic", $inp );
if(true){

        $inp=str_replace("\r\n","`",$inp);
        $inp=str_replace("\r","`",$inp);
        $inp=str_replace("\n","`",$inp);
        $i = strpos($inp, "`");
        if($i!==false) {
            $pic_url = $_SERVER['DOCUMENT_ROOT'] . "/Uploads/img/5.jpg";
            $pic = '<img src="'.$pic_url.'" width="20" height="10" >';
            $prefix="　".$pic;

            $str = "";

            $item = explode("`", $inp);
            foreach ($item as $k => $r) {
                if ($str) $str .= "<br/>";
                $r = trim($r);
                if ($r !== "") {
                    if (substr($r, 0, 2) == "[#") {
                        $m = strpos($r, "]", 1);       //第一个']'
                        if ($m !== false) {
                            $str .= mb_substr($r, 0, $m + 1);
                            $str .= $prefix;
                            $str .= mb_substr($r, $m);
                        } else {
                            $str .= $r;
                        }
                    } else {
                        $str .= $prefix;
                        $str .= $r;
                    }
                }
            }
            $inp = $str;
        }
}

        $err="";
        $arr = array("楷体", "宋体", "黑体", "F12", "F16", "F24", "B", "U",
            "D", "K", "T10", "T20", "TL", "PL", "PC", "PR", "P","WL","WC","WR");
        $item = array();
        $fontname = '';
        $border = false;
        $result=$this->Convert_Define_ToHtml_Process($arr,$item, $inp, false);
        if($result!==true){
            $err=$result;
            return false;
        }
        $output="";
        foreach($item as $k=>$r) {
            if ($r["flag"] == "T") {
                $output .= $r["value"];
            } else {
                $bclose = $r["flag"] == "C";
                switch ($r["value"]) {
                    case "font":
//                        if(!$bclose){
//                            $fontname = $r["extend"];
//                        }
                        $output .= !$bclose ? "<font " . $r["extend"] . ">" : "</font> ";
                        break;
                    case "B":
                        //$output .= !$bclose ? "<B>" : "</B>";
                        break;
                    case "U":
                        $output .= !$bclose ? "<U>" : "</U>";
                        break;
                    case "D":
                        break;
                    case "K":
                        $border = true;
                        break;
                    case "T5":
                    case "T6":
                    case "T7":
                    case "T8":
                    case "T9":
                    case "T10":
                    case "T11":
                    case "T12":
                    case "T13":
                    case "T14":
                    case "T15":
                    case "T16":
                    case "T17":
                    case "T18":
                    case "T19":
                    case "T20":
                    case "TL":
                        if (!$bclose) {
                            if ($r["value"] == "TL") {
                                $len = 60;
                            } else {
                                $len = substr($r["value"], 1);
                            }
                            $output .= str_pad("", $len, "_");
                        }
                        break;
                    case "PL":
                    case "PC":
                    case "PR":
                    case "P":
                        if (!$bclose) {
                            $align_image = $r["value"];
                        }
                        break;
                    case "WL":
                    case "WC":
                    case "WR":
                        if (!$bclose) {
                            $align_text = substr($r["value"], 1);
                        }
                        break;
                }

            }
        }
        return $output;
    }



    //递归判断题干的自定义是否合法
    function Convert_Define_ToHtml_Process($arr ,&$item, &$str,$start=false)
    {
        while (1) {
            if ($str == "") {
                //自动结束，没有结尾自动产生结尾
                return true;
            }

            $i = strpos($str, "[#");
            $j = strpos($str, "[/#");
            if ($i === false && $j === false) {
                //自动结束，没有结尾自动产生结尾
                $item[]=array("flag"=>"T","value"=>$str);
                return true;
            }

            //$j,$i多存在，j>i
            if ($i !== false && ($j > $i || $j === false)) {
                if($i>0) {
                    if ($start === false) {
                        $start = true;
                    }

                    //$value=substr($str,0,$i-1);
                    $value=mb_substr($str,0,$i);
                    $item[]=array("flag"=>"T","value"=>$value);
                }
                $m = strpos($str, "]", $i + 1);       //第一个']'
                if ($m === false) {
                    return "自定义标签存在[#起始,无结尾]";
                }
                //判断</#之后是不是> 如果不是跳出循环
                if (substr($str, $m, 1) != "]") {
                    return "自定义标签存在[#起始,无结尾]";
                }
                //判定$j中的自定义节点的值是否在数组中存在。
                //将多个值在数组中对比判断是否与数组中的一致。
                $custom = substr($str, $i + 2, $m - $i - 2);
                $arrRow = explode(" ", $custom);

                $font="";
                foreach ($arrRow as $r) {
                    if ($r && in_array($r, $arr) > 0) {
                        if (in_array($r, array("楷体", "宋体", "黑体", "F12", "F16", "F24")) > 0) {
                            if($start){
                                return "字体/字号只能定义在起始位置";   //图像不能与其他自定义属性相互嵌套
                            }
                            if (in_array($r, array("楷体", "宋体", "黑体")) > 0) {
                                if($r == '楷体'){
                                    $font.=" face=\"simkai\"";
                                }elseif($r == '宋体'){
                                    $font.=" face=\"simfang\"";
                                }elseif($r == '黑体'){
                                    $font.=" face=\"simhei\"";
                                } else{
                                    $font.=" face=\"".$r."\"";
                                }
//                                //$r=”stsongstdlight“;
//                                $font.=" face=\"".$r."\"";
                            }else{
                                $font.=" size=\"".substr($r,1)."\"";
                            }
                        }else{
                            $item[]=array("flag"=>"U","value"=>$r);
                        }
                    }
                }
                if($font){
                    $item[]=array("flag"=>"U","value"=>"font","extend"=>$font);
                }
                $str = substr($str, $m + 1, strlen($str) - $m);

                //将字符串截断
                $result=$this->Convert_Define_ToHtml_Process($arr,$item, $str, $start);
                if ($result!==true) {
                    return $result;
                }

                $arrrev = array_reverse($arrRow);
                foreach ($arrrev as $r) {
                    if ($r && in_array($r, $arr) > 0) {
                        if (!in_array($r, array("楷体", "宋体", "黑体", "F12", "F16", "F24")) > 0) {
                            $item[] = array("flag" => "C", "value" => $r);
                        }
                    }
                }
                if($font){
                    $item[]=array("flag"=>"C","value"=>"font");
                }
            } else {
                if($j>0) {
                    //$value=substr($str,0,$j-1);
                    $value=mb_substr($str,0,$j);

                    $item[]=array("flag"=>"T","value"=>$value);
                }
                $m = strpos($str, "]", $j + 1);       //第一个']'
                if ($m === false) {
                    return "自定义标签存在[/#起始,无结尾]";
                }
                $str = substr($str, $m + 1, strlen($str) - $m);
                return true;
            }
        }
    }

}