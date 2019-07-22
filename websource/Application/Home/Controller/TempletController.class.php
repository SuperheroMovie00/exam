<?php

namespace Home\Controller;

//
//注释: Templet - 组卷模板信息
//
use Home\Controller\BasicController;
use Think\Log;

class TempletController extends BasicController
{

    public function _init()
    {
        $funcs = $this->getUserRoleList($this->user, array('Templet', '/Home/Templet',));
        if ($funcs)
            $this->assign("rights", $funcs);
        else {
            $funcs = array(
                array("key" => "refresh", "func" => "Templet", "Action" => "refresh"),
                array("key" => "import", "func" => "/Home/Templet", "Action" => "import"),
                array("key" => "save", "func" => "/Home/Templet", "Action" => "save"),
                array("key" => "search", "func" => "/Home/Templet", "Action" => "view"),
                array("key" => "detail_import", "func" => "/Home/Templet", "Action" => "detail_import"),
                array("key" => "detail_select", "func" => "/Home/Templet", "Action" => "select_product"),
                array("key" => "tabshijuan", "func" => "/Home/Templet", "Action" => "tabshijuan"),
                array("key" => "tabcaozuorizhi", "func" => "/Home/Templet", "Action" => "tabcaozuorizhi"),
                array("key" => "edit_base", "func" => "/Home/Templet", "Action" => "edit_base"),
                array("key" => "order_edit", "func" => "/Home/Templet", "Action" => "edit_base"),
                array("key" => "order_detail", "func" => "/Home/Templet", "Action" => "detail_edit"),
                array("key" => "order_delete", "func" => "/Home/Templet", "Action" => "delete"),
                array("key" => "cancel", "func" => "/Home/Templet", "Action" => "cancel"),
                array("key" => "confirm", "func" => "/Home/Templet", "Action" => "confirm"),
                array("key" => "todummy", "func" => "/Home/Templet", "Action" => "todummy"),
                array("key" => "toexam", "func" => "/Home/Templet", "Action" => "toexam"),
                array("key" => "grid", "func" => "/Home/Templet", "Action" => "grid"),
                array("key" => "master_view", "func" => "/Home/Templet", "Action" => "view"),
                array("key" => "master_edit", "func" => "/Home/Templet", "Action" => "edit"),
                array("key" => "master_delete", "func" => "/Home/Templet", "Action" => "delete")
            );
            $this->assign("rights", $this->GetUserRights($this->user["id"], $funcs));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"], "Templet"));
    }

    public function index()
    {
        $data["pfuncid"] = I("request.pfuncid");
        $data["funcid"] = I("request.funcid");
        $data["zindex"] = I("request.zindex/d");
        if (empty($data["funcid"])) $data["funcid"] = "Templet";
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
            case "manage":
                $this->manage($data);
                break;
            case "loaddetailinfo":
                $this->loaddetailinfo($data);
                break;
            case "check_templet":
                $this->check_templet($data);
                break;
            case "create_exam":
                $this->create_exam($data);
                break;
            case "getexam_detail":
                $this->getexam_detail($data);
                break;
            case "select_question":
                $this->select_question($data);
                break;
            case "select_questioner":
                $this->select_questioner($data);
                break;
            case "move_up":
                $this->move_up($data);
                break;
            case "exam":
                $this->exam($data);
                break;
            case "examorder_deleteer":
                $this->examorder_deleteer($data);
                break;

            case "detailarea1":
                $this->detailarea1($data);
                break;
            case "detailarea2":
                $this->detailarea2($data);
                break;
            case "examview":
                $this->examview($data);
                break;
            case "tree":
                $this->tree($data);
                break;
            case "rechoose_question":
                $this->rechoose_question($data);
                break;
            case "questionview":
                $this->questionview($data);
                break;
            case "question_save":
                $this->question_save($data);
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
            $templet_no = I("request.templet_no");
            $subject = I("request.subject");
            $count = I("request.count/d", 0);
            $score = I("request.score/d", 0);
            $req_time = I("request.req_time/d", 0);
            $req_content = I("request.req_content");
            $remarks = I("request.remarks");
            //赋初值
            $search["type"] = $type ? $type : "0";  //第一个选项
            $search["templet_no"] = $templet_no ? $templet_no : "";
            $search["subject"] = $subject ? $subject : "";
            $search["count"] = $count ? $count : "";
            $search["score"] = $score ? $score : "";
            $search["req_time"] = $req_time ? $req_time : "";
            $search["req_content"] = $req_content ? $req_content : "";
            $search["remarks"] = $remarks ? $remarks : "";
        } else {
            $search = M(templet)->find($id);
            if (!$search) {
                $this->ajaxResult("组卷模板数据不存在");
            }
            $data["id"] = $search["id"];
        }
        $data["search"] = $search;
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:add");
        echo $html;
    }

    private function save($data)
    {
        $id = I("request.id/d");
        //读取页面输入数据
        $type = I("request.type");
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
        if (!verify_value($templet_no, "empty", "", "")) $this->ajaxError("编码 不能为空");
        if (!verify_value($count, "nagitive", "", "")) $this->ajaxError("题量 不能为负数");
        //if ($count < 100 || $count > 105) $this->ajaxError("校验样例 题量值在100-105之间");
        if (!verify_value($score, "nagitive", "", "")) $this->ajaxError("总分 不能为负数");
        //if ($score < 100 || $score > 105) $this->ajaxError("校验样例 总分值在100-105之间");
        if (!verify_value($req_time, "nagitive", "", "")) $this->ajaxError("时间要求 不能为负数");
        //if ($req_time < 100 || $req_time > 105) $this->ajaxError("校验样例 时间要求值在100-105之间");
        // "卷面要求" 长度超200位，没有生成非空检测
        // "备注" 长度超200位，没有生成非空检测
        $model = M("templet");
        //判断 templet_no 是否重复建立
        $orig = $model->where("templet_no='$templet_no'" . ($id ? " and id!=$id" : ""))->find();
        if ($orig) $this->ajaxError("编码 $templet_no 已存在");
        //页面输入字段
        $input["type"] = $type;
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
            'templet_no' => '编码',
            'subject' => '标题',
            'count' => '题量',
            'score' => '总分',
            'req_time' => '时间要求',
        );
        if (!$id) {
            //新增  建号操作

            // date:2019-6-19 原因：使用教师自己输入的编码  $keycode = GenOrderNo("templet");
            $keycode = $input["templet_no"];

            $count = $model->where(array("templet_no" => $keycode))->count();
            if ($count > 0) {
                echo json_encode(array("msg" => message("%1 %2 已存在", "组卷模板", $keycode)));
                die ();
            }
            $input["templet_no"] = $keycode;
            $input["create_user"] = session(C("USER_AUTH_KEY"));
            $input["create_time"] = date('Y-m-d H:i:s.n');
            //新增数据 保存数据库
            $result = $id = $model->add($input);
            //建立操作日志
            $result = $result && createLogOrder('templet', $id, '新增组卷模板', '', "*", 'templet_no');
        } else {
            //id存在时判断数据库内数据是否存在
            $orig = $model->where("id='%d'", array($id))->find();
            if (empty($orig)) {
                $this->ajaxError("组卷模板数据不存在");
            }
            if ($orig["status"] != "0") {
                $this->ajaxError("组卷模板非编辑状态");
            }
            if ($templet_no != $orig["templet_no"]) {
                M("templet_detail")->where("templet_id = $id")->save(array("templet_no" => $templet_no));
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
                $result = $result && createLogOrder('templet', $id, '变更组卷模板', $orig, '', '', 'templet_no', $needSave);
            }
        }
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
            echo json_encode(array("msg" => message("组卷模板保存发生错误")));
            die;
        }
        //完成后跳转
        $this->ajaxReturn($data ['pfuncid'], $data ['funcid'], "refresh", "", "closepopup", 1);
        //转到view页面
        $this->ajaxReturn("", "", U("Templet/index?func=view&id=$id&pfuncid=" . $data ['pfuncid']), tabtitle('组卷模板', $input["templet_no"]));
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
        $html = $this->fetch("Templet:import");
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
            "templet_no" => "编码",
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
                if (!verify_value($row["templet_no"], "empty", "", "")) $err_empty = $this->cattext($err_empty, $header["templet_no"]);
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
        //判断 templet_no 是否重复建立
        $i = 0;
        foreach ($importdatas as $k => $row) {
            if ($k >= $row_data) {
                $j = 0;
                foreach ($importdatas as $k1 => $row1) {
                    if ($k1 >= $row_data and $k1 > $k) {
                        if ($row["templet_no"] == $row1["templet_no"]) {
                            $err .= "第 " . ($i + $row_data) . " 与 " . ($j + $row_data) . " 行 " . $header["templet_no"] . "\n";
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
        $model = M("templet");
        //关键字重复导入覆盖方式
        $overwrite = true;
        if (!$overwrite) { //非覆盖方式检查是否重复
            //判断 templet_no 是否重复建立
            $i = 0;
            foreach ($importdatas as $k => $row) {
                if ($k >= $row_data) {
                    $m = $model->where("templet_no='" . $row["templet_no"] . "'")->find();
                    if ($m) $err .= "第 " . ($i + $row_data) . " 行 " . $header["templet_no"] . "\n";
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
            $orig = $model->where("templet_no='" . $row["templet_no"] . "'")->find();
            if (!$orig) {
                //新增
                $input["create_user"] = session(C("USER_AUTH_KEY"));
                $input["create_time"] = date('Y-m-d H:i:s.n');
                $result = $id = $model->add($input);
                $new++;
                //建立操作日志
                $result = $result && createLogOrder('templet', $id, '数据导入(新增)', $orig, '', '', 'templet_no', $header);
            } else {
                //覆盖
                $id = $orig['id'];
                $result = $model->where("id=$id")->save($input);
                $edit++;
                //建立操作日志
                $result = $result && createLogOrder('templet', $id, '数据导入(覆盖)', $orig, '', '', 'templet_no', $header);
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
//// source for cancel - begin ////
    private function cancel($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("组卷模板参数不存在");
        }
        $search = M('templet')->find($id);
        if (!$search)
            $this->ajaxResult("组卷模板不存在");
        if ($search['status'] == '7') {
            $this->ajaxResult("组卷模板已取消");
        }
        if ($search['status'] != '1') {
            $this->ajaxResult("组卷模板状态已变化，请重新处理");
        }
        $data["search"] = $search;
        $data["id"] = $data["search"]["id"];
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:cancel");
        echo $html;
    }

    private function cancel_save($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("组卷模板参数不存在");
        }
        //id存在时判断数据库内数据是否存在
        $orig = M("templet")->where("id='%d'", array($id))->find();
        if (empty($orig)) {
            $this->ajaxError("组卷模板数据不存在");
        }
        if ($orig['status'] == '7') {
            $this->ajaxResult("组卷模板已取消");
        }
        if ($orig['status'] != '1') {
            $this->ajaxResult("组卷模板状态已变化，请重新处理");
        }
        $reason_tag = I("request.reason_tag");
        $reason = I("request.reason");
        if (!($reason_tag . $reason)) {
            $this->ajaxResult("组卷模板状态回退，需注明原因");
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
        $model = M("templet");
        $model->startTrans();
        //按主键更新数据
        $result = $model->where("id = $id")->save($input);
        //建立操作日志
        $result = $result && createLogOrder('templet', $id, '状态调整', $content);
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
            echo json_encode(array("msg" => message("组卷模板保存发生错误")));
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
            $this->ajaxResult("组卷模板参数不存在");
        }
        $search = M('templet')->find($id);
        if (!$search)
            $this->ajaxResult("组卷模板不存在");
        if ($search['status'] == '7') {
            $this->ajaxResult("组卷模板已取消");
        }
        if ($search['status'] != '0') {
            $this->ajaxResult("组卷模板状态已变化，请重新处理");
        }
        $data["search"] = $search;
        $data["id"] = $data["search"]["id"];
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:confirm");
        echo $html;
    }

    private function confirm_save($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("组卷模板参数不存在");
        }


        //id存在时判断数据库内数据是否存在
        $orig = M("templet")->where("id='%d'", array($id))->find();
        if (empty($orig)) {
            $this->ajaxError("组卷模板数据不存在");
        }
        if ($orig['status'] == '7') {
            $this->ajaxResult("组卷模板已取消");
        }
        if ($orig['status'] != '0') {
            $this->ajaxResult("组卷模板状态已变化，请重新处理");
        }

        $this->templetdetail_trim($id);
        $this->verify_templet($id);

        $reason_tag = I("request.reason_tag");
        $reason = I("request.reason");
        $detailtable = M("templet_detail")->where("templet_id = $id")->find();
        if (empty($detailtable)) {
            $this->ajaxResult("组卷模板明细数据不存在");
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
        $model = M("templet");
        $model->startTrans();
        //按主键更新数据
        $result = $model->where("id = $id")->save($input);
        //建立操作日志
        $result = $result && createLogOrder('templet', $id, '状态调整', $content);
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
            echo json_encode(array("msg" => message("组卷模板保存发生错误")));
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
            $this->ajaxResult("组卷模板参数不存在");
        }
        $search = M('templet')->find($id);
        if (!$search)
            $this->ajaxResult("组卷模板不存在");
        if ($search['status'] == '7') {
            $this->ajaxResult("组卷模板已取消");
        }
        if ($search['status'] != '1') {
            $this->ajaxResult("组卷模板状态已变化，请重新处理");
        }
        $data["search"] = $search;
        $data["id"] = $data["search"]["id"];
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:todummy");
        echo $html;
    }

    private function todummy_save($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("组卷模板参数不存在");
        }
        //id存在时判断数据库内数据是否存在
        $orig = M("templet")->where("id='%d'", array($id))->find();
        if (empty($orig)) {
            $this->ajaxError("组卷模板数据不存在");
        }
        if ($orig['status'] == '7') {
            $this->ajaxResult("组卷模板已取消");
        }
        if ($orig['status'] != '1') {
            $this->ajaxResult("组卷模板状态已变化，请重新处理");
        }
        $reason_tag = I("request.reason_tag");
        $reason = I("request.reason");
        if (!($reason_tag . $reason)) {
            $this->ajaxResult("组卷模板状态回退，需注明原因");
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
        $model = M("templet");
        $model->startTrans();
        //按主键更新数据
        $result = $model->where("id = $id")->save($input);
        //建立操作日志
        $result = $result && createLogOrder('templet', $id, '状态调整', $content);
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
            echo json_encode(array("msg" => message("组卷模板保存发生错误")));
            die;
        }
        //完成后关闭并刷新父窗口
        $this->ajaxReturn($data ['pfuncid'], $data ['funcid'], "refresh", "", "closepopup");
        die;
    }
//// source for todummy - end ////
//// source for grid - begin ////
    private function detail_edit($data)
    {
        //_pid 主档表  的id
        $id = I("request.id");
        if (!$id) {
            $this->ajaxError("组卷模板参数错误");
        }
        $master = M('templet')->where("id='%d' and status=0", array($id))->find();
        if (!$master) {
            $this->ajaxError("组卷模板不存在或非可编辑状态");
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
        //$type=0 搜索templet_detail  $type=1
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
                $where .= " AND ($_keyword)";
            }
            //额外增加的搜索字段
            $data["page_size"] = I("get.pagesize/d");
            $data["page_size"] = $data["page_size"] <= 0 ? session("templet-grid-PageSize") : $data["page_size"];
            if (!$data["page_size"]) {
                $data["page_size"] = 50;
            }
            session("templet-grid-PageSize", $data["page_size"]);
            $pre = C("DB_PREFIX");
            $orderby = " ORDER BY p.id";
            $data["master"] = $master;
            $data["id"] = $id;
            $sql = "SELECT d.id as _did
                          ,d.type
                          ,d.subject
                          ,d.seq
                          ,d.score
                          ,d.req_type
                          ,d.req_category_name
                          ,d.req_kind
                          ,d.req_child_count
                          ,d.req_child_seq
                          ,d.extract ";
            if ($type == 1) {
                $sql .= "FROM " . $pre . "templet_detail as d " .
                    "WHERE d.templet_id='" . $id . "' ";
                $orderby = " ORDER BY d.id";
            } else {
                $sql .= "FROM " . $pre . "templet_detail as d " .
                    "WHERE d.templet_id='" . $id . "' $where";
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
            $data["page"] = $pageClass->show_drp($data["funcid"], "编辑组卷模板");
        }
        $data["search"]["loaddetail"] = 1;
        $data["existdetail"] = $existdetail;
        $this->detail_stat($master, $statinfo);
        $data["statinfo"] = $statinfo;
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:grid");
        echo $html;
    }

    private function detail_save($data)
    {
        $id = I("request.id");
        $close = I("request.close");
        if (!$id) {
            $this->ajaxError("组卷模板参数错误");
        }
        $model = M("templet_detail");
        $master = M("templet")->where("id='%d' and status=0", array($id))->find();
        if (!$master) {
            $this->ajaxError("组卷模板不存在或非可编辑状态");
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
        $_did = I("post._did");
        $_id = I("post._id");
        if (empty($_id)) {
            $this->ajaxError("明细信息不存在");
        }
        $model->startTrans();
        $result = false;
        $qty_total = 0;
        $chg_info = "";
        $add_info = "";
        $del_info = "";
        foreach ($_id as $k => $v) {
            $detail = array();
            $did = I("_did_" . $v);
            if ($did) {
                $detail = $model->find($did);
                if (!$detail) $this->ajaxError_func("明细信息不存在", $data["funcid"] . "_focus");
            }
            //读取输入数据
            $type = I("type_" . $v);
            $subject = I("subject_" . $v);
            $seq = intval(I("seq_" . $v));
            $score = intval(I("score_" . $v));
            $req_type = I("req_type_" . $v);
            $req_category_name = I("req_category_name_" . $v);
            $req_kind = I("req_kind_" . $v);
            $req_child_count = I("req_child_count_" . $v);
            $req_child_seq = I("req_child_seq_" . $v);
            $extract = I("extract_" . $v);
            //输入数据进行校验
            if ($seq < 0) $this->ajaxError_func("题号 " . $seq . " 不能为负数", $data["funcid"] . "_focus");
            if ($score < 0) $this->ajaxError_func("分数 " . $score . " 不能为负数", $data["funcid"] . "_focus");
            //检查明细数据是否存在
            $cur_data = array();
            //复制 输入数据
            $cur_data['type'] = $type;
            $cur_data['subject'] = $subject;
            $cur_data['seq'] = $seq;
            $cur_data['score'] = $score;
            $cur_data['req_type'] = $req_type;
            $cur_data['req_category_name'] = $req_category_name;
            $cur_data['req_kind'] = $req_kind;
            $cur_data['req_child_count'] = $req_child_count;
            $cur_data['req_child_seq'] = $req_child_seq;
            $cur_data['extract'] = $extract;
            //复制 主档表 templet 的字段
            $cur_data['templet_id'] = $id;
            $cur_data['templet_no'] = $master['templet_no'];
            //明细表是否存在要计算
            //$cur_data['qty']=$qty*$packing_qty;
            //$cur_data['price']=$g['purchase_price'];
            //$cur_data['amount']=round($cur_data['qty']*$cur_data['price'],2);
            //数据更新
            if ($detail) {
                $result = $model->where("id=" . $detail['id'])->save($cur_data);
                $chg_info .= ($chg_info ? "," : "") . $cur_data['type'];
            } else {
                $result = $model->add($cur_data);
                if (!$result) $this->ajaxError_func("新增数据(" . $cur_data['type'] . ")失败", $data["funcid"] . "_focus");
                $add_info .= ($add_info ? "," : "") . $cur_data['type'];
            }
        }
        $del = I("post.del");
        $del_info = "";
        if (!empty($del)) {
            foreach ($del as $k => $v) {
                $ret = $model->field("type")->find($v);
                if ($ret) {
                    $result = $model->delete($v);
                    if (!$result) {
                        $this->ajaxError_func("明细数据删除失败", $data["funcid"] . "_focus");
                    }
                    $del_info .= ($del_info ? "," : "") . $ret['type'];
                }
            }
        }
        //进行重新汇总
        $result = $this->detail_subtotal($id, $retinfo);
        if (!$result) $this->ajaxError_func("组卷模板汇总失败", $data["funcid"] . "_focus");
        $data['statinfo'] = $retinfo;
        $content = $add_info ? "添加[$add_info]" : "";
        if ($chg_info) $content .= ($content ? ", " : "") . "变动[$chg_info]";
        if ($del_info) $content .= ($content ? ", " : "") . "删除[$del_info]";
        $result = createLogOrder('templet', $id, '明细编辑', $content);
        if (!$result) $this->ajaxError_func("创建组卷模板日志失败", $data["funcid"] . "_focus");
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
        $return = sprintf("已添加 %d 条, 总分 %d", $details, $score);
    }

    private function detail_subtotal($id, &$return)
    {
        $return = "";
        $detail = M("templet_detail")
            ->field('count(*) as cnt ,count(*) as details ,sum(score) as score ')
            ->where("templet_id=%d", array($id))
            ->select();
        $details = $detail[0]['details'];
        $score = $detail[0]['score'];
        $return = sprintf("已添加 %d 条, 总分 %d", $details, $score);
        /*
        $detail = M("templet_detail")->where("templet_id=%d",array($id))->select();
        $amount=0;
        $qty=0;
        $details=0;
        foreach ($detail as $k=>$v) {
            $qty+=$v['qty'];
            $amount+=$v['price']*$v['qty'];
            $details++;
        }
*/
        $result = M('templet')
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
            $this->ajaxError("组卷模板信息查询参数非法");
        }

        //condition
        $condition = "";
        $joinsql = "";
        //select search fields
        $selectmasterfields = "@templet.*";


        $sql = table("select #selectfields# from @templet  #join# Where #viewkey# #condition# #orderby#");
        if ($data["id"])
            $viewkey = table("@templet.id=$data[id]");
        else
            $viewkey = table("@templet.templet_no='$data[no]'");
        $sql = str_replace("#selectfields#", table($selectmasterfields), $sql);
        $sql = str_replace("#join#", $joinsql, $sql);
        $sql = str_replace("#viewkey#", $viewkey, $sql);
        $sql = str_replace("#condition#", $condition, $sql);
        $sql = str_replace("#orderby#", "", $sql);
        $search = M()->query($sql);
        if (!$search) {
            $this->ajaxError("组卷模板信息信息不存在");
        }
        $data["search"] = current($search);


        //按tabsheet - 开始
        $data["id"] = $data["search"]["id"];
        $data["search"]["_tab"] = $this->tabsheet_check(I("request._tab"));
        $page_size = $data["pagesize"];//session("Templet-".$data["search"]["_tab"]."-PageSize");
        switch ($data["search"]["_tab"]) {

            case "mingxi":
                $data = $this->tab_mingxi_templet_detail($page_size, $data);
                break;
            case "shijuan":
                $data = $this->tab_shijuan_exam($page_size, $data);
                break;
            case "caozuorizhi":
                $data = $this->tab_caozuorizhi_log_order($page_size, $data);
                break;

        }
        $data["search"]["_tab_" . $data["search"]["_tab"] . "_p"] = $data["p"];
        $data["search"]["_tab_" . $data["search"]["_tab"] . "_psize"] = $data["page_size"];
        //session("Templet-".$data["search"]["_tab"]."-PageSize", $data["page_size"]);
        //按tabsheet - 结束

        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:view");
        echo $html;
    }

    //按tabsheet子程序 - 开始

    private function tab_mingxi_templet_detail($tab_pagesize, $data)
    {
        $orderby = "order by @templet_detail.sort";
        $joinsql = "";


        $condition = "";


        //select detail fields
        $selectfields = "@templet_detail.id ";
        $selectfields .= ",@templet_detail.type ";
        $selectfields .= ",@templet_detail.subject ";
        $selectfields .= ",@templet_detail.seq ";
        $selectfields .= ",@templet_detail.score ";
        $selectfields .= ",@templet_detail.req_type ";
        $selectfields .= ",@templet_detail.req_category_name ";
        $selectfields .= ",@templet_detail.req_kind ";
        $selectfields .= ",@templet_detail.req_child_count ";
        $selectfields .= ",@templet_detail.req_child_seq ";
        $selectfields .= ",@templet_detail.extract ";

        $viewkey = "@templet_detail.templet_id='" . $data["search"]["id"] . "'";
        if (!$viewkey)
            $this->ajaxError("查询参数非法");
        //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }
        $page_size = 1000;

        $count_sql = table("select count(*) as cnt from @templet_detail  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @templet_detail  #join# Where #viewkey# #condition# #orderby#");

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

    private function tab_shijuan_exam($tab_pagesize, $data)
    {
        $orderby = "";
        $joinsql = "";


        $condition = "";


        //select detail fields
        $selectfields = "@exam.status ";
        $selectfields .= ",@exam.id ";
        $selectfields .= ",@exam.exam_no ";
        $selectfields .= ",@exam.type ";
        $selectfields .= ",@exam.subject ";
        $selectfields .= ",@exam.count ";
        $selectfields .= ",@exam.score ";
        $selectfields .= ",@exam.req_time ";
        $selectfields .= ",@exam.req_content ";
        $selectfields .= ",@exam.remarks ";
        $selectfields .= ",@exam.create_time ";
        $selectfields .= ",@exam.modify_time ";

        $viewkey = "@exam.templet_id='" . $data["search"]["id"] . "'";
        if (!$viewkey)
            $this->ajaxError("查询参数非法");
        //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @exam  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @exam  #join# Where #viewkey# #condition# #orderby#");

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
        $viewkey .= " and @log_order.type='templet'";
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


    private function tabsheet_check($itab)
    {
        $idefault = "mingxi";
        switch ($itab) {

            case "mingxi":
            case "shijuan":
            case "caozuorizhi":

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
        $smo = M('templet')->where("id='%d'", array($id))->find();
        if (empty($smo)) {
            $this->ajaxResult("组卷模板信息数据不存在");
        }
        if ($smo['status'] != 0) {
            $this->ajaxResult("组卷模板信息状态不能删除");
        }

        $result = true;
        $result = $result && createLogOrder('templet', $id, ($smo['status'] ? '取消信息' : '删除记录'), '');
        if ($smo['status'] != 0) {
            $result = $result && M('templet')->where("id='%d'", array($id))->save(array('status' => 8, 'cancel_time' => date('Y-m-d H:i:s'), 'cancel_status' => 1));
        } else {
            $result = $result && M('templet')->where("id='%d'", array($id))->delete();
        }
        return $result;
    }

        private function order_delete($data)
    {

        $id = I("request.id/d");
        $type = I("request.type/d");
        if (!$id) {
            $this->ajaxResult("组卷模板信息参数不存在");
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

        $model = M('templet_detail');
        $model->startTrans();
        $result1 = true;
        $orderid = 0;
        $content = '';
        foreach ($data["id"] as $v) {
            $pd_delete = $model->where("id='%d'", array($v))->find();
            if ($orderid == 0) {
                $orderid = $pd_delete['templet_id'];
            }
            $result1 = $model->where("id='%d'", array($v))->delete();

            //写日志
            $content .= getOrderChange(array(), array(), 'templet', '删除商品[' . $pd_delete['goods_no'] . $pd_delete['goods_name'] . ']');

            if (!$result1) {
                break;
            }
        }

        //重新汇总 数量/金额，具体程序具体调整
        $rpd = $model->where("templet_id='%d'", array($orderid))->field('qty,price')->select();
        $amount = 0;
        $qty_total = 0;
        foreach ($rpd as $k => $v) {
            $qty_total += $v['qty'];
            $amount += $v['price'] * $v['qty'];
        }

        $result2 = M('templet')->where("id='%d'", array($orderid))->save(array('qty' => $qty_total, 'amount' => $amount));

        $smo = M('templet')->where("id='%d'", array($orderid))->find();
        if ($smo['status'] != 0) {
            $result2 = false;
        }

        $result1 = $result1 && createLogOrder('templet', $orderid, '删除组卷模板信息商品', $content);

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

        $smo = M('templet')->where("id='%d'", array($data["orderid"]))->find();
        $model = M("templet_detail");
        $sm = M('stock2');
        $storage = M('storage')->where("code='%s'", array($smo['storage_code']))->find();


        foreach ($data["list"] as $k => $v) {
            $stock = $sm->where("storage_id='%d' AND goods_id='%d' ", array($storage['id'], $v['id']))->find();
            $data['list'][$k]['sctok'] = floatval($stock['qty']);
            $smd = $model->where("templet_id='%d' AND goods_id='%d' ", array($data["orderid"], $v['id']))->find();
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
        $html = $this->fetch("Templet:selectProduct");
        echo $html;
    }

    private function saveSelectProduct($data)
    {
        $orderid = I("request.orderid");
        $close = I("request.close");

        $id = I("id");
        $model = M("templet_detail");
        $smo = M('templet')->where("id='%d'", array($orderid))->find();
        if (empty($smo)) {
            $this->ajaxResult("组卷模板信息不存在");
        }
        $sm = M('stock2');
        $gm = M('goods');

        $model->startTrans();
        $result = false;
        foreach ($id as $k => $v) {
            $g = $gm->where("id='%d'", $v)->find();

            $qty = floatval(I("qty_" . $v));
            $storage_location = I("storage_location_" . $v);

            $smd = $model->where("templet_id='%d' AND goods_id='%d' ", array($orderid, $v))->find();

            $cur_data = array();
            $cur_data['goods_id'] = $v;
            $cur_data['templet_id'] = $orderid;
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
                $result = $model->where("templet_id='%d' AND goods_id='%d'", array($orderid, $v))->save($cur_data);
            } else {
                $result = $model->add($cur_data);

            }

            if (!$result) {
                break;
            }

        }

        $qty_total = $model->where("templet_id='%d'", array($orderid))->field("SUM(qty) qty_total,SUM(amount) amount_total")->find();

        $result2 = M('templet')->where("id='%d'", array($orderid))->save(array('qty' => $qty_total['qty_total'], 'amount' => $qty_total['amount_total'], 'modify_time' => date('Y-m-d H:i:s'), 'modify_user' => session(C("USER_AUTH_KEY"))));

        $sa = M('templet')->where("id='%d'", array($orderid))->find();

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

    private function manage($data)
    {
        $id = I("id/d", 0);
        $data["pfuncid"] = $data["funcid"];

        $data["templet_id"] = $id;
        $model = M("Templet");
        $info = $model->where(array("id" => $id))->find();
        if (!$info) {
            $this->ajaxError("模板信息不存在");
        }
        $data["templet"] = $info;
        $model = M("TempletDetail");
//        $list=$model->where(array("templet_id"=>$id))->order("seq")->select();
//        $data["templet_list"]=$list;
        $data["templet_list"] = $this->gettemplet_detail_list($id);


        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }

        $html = $this->fetch("Templet:manage");
        echo $html;
    }

    private function loaddetailinfo($data)
    {
        $data["p"] = I("request.p/d");
        $id = I("get.id/d");
        $exam_id = I("get.exam_id/d");
        $type = I("get.t/d");
//        if(empty($id)) {
//            $this->ajaxResult("非法操作");
//        }

        $model = M("TempletDetail");
        $info = $model->where(array("id" => $id))->find();
        $data["templet_detail"] = $info;
        $data["templet_id"] = $info["templet_id"];

        if (!$info["type"]) {


        }

        $model = M("Templet");
        $templet_info = $model->where(array("id" => $info["templet_id"]))->find();
        $data["templet_info"] = $templet_info;

        if (false) {

            $exam_id = $templet_info["exam_id"];


            if ($exam_id > 0) {
                $model = M("ExamDetail");


                $count = $model->where(array("exam_id" => $exam_id))->count();
                $page_size = I("request.pagesize/d");
                if ($page_size <= 0) {
                    $page_size = 10;
                }
                if ($count < 100) {
                    $page_size = 100;
                }

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


                $list = $model->where(array("exam_id" => $exam_id))
                    ->limit((($data["p"] - 1) * $page_size) . ", $page_size")
                    ->select();


                $pageClass = new \Think\Page($count, $page_size);
                $pageClass->rollPage = 8;

                $data["page"] = $pageClass->show_summary($data["funcid"], "");
                $data["page_size"] = $page_size;

                $data["list"] = $list;

            }
        }


        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:info");
        echo $html;
    }


    public $templet_detail_list = array();

    private function gettemplet_detail_list($id, $parent_id = 0)
    {
        $model_detail = M("TempletDetail");
        $detail_list = $model_detail->where(array("templet_id" => $id, "parent_id" => $parent_id))
            ->order("sort,seq")->select();
        foreach ($detail_list as $k => $item) {
            $list = $this->gettemplet_detail_list($id, $item['id']);
            $detail_list[$k]["child"] = $list;
            $detail_list[$k]["child_nums"] = count($list);
        }
        return $detail_list;
    }

    private function templetdetail_trim($id)
    {
        $model_d = M("TempletDetail");
        $result = $model_d->field("id,parent_id,sort,level,type,req_type,req_child_count,req_child_seq,score")
            ->where(array("templet_id" => $id))
            ->order("parent_id,sort")
            ->select();
        if (!$result) {
            return;
        }

        $detail = array();
        foreach ($result as $k => $d) {
            $d["flag"] = "0";
            $detail[$d["id"]] = $d;
        }

        $imax = 0;
        $score = 0;
        $this->templetdetail_sort($detail, "0", 1, "", $imax, $score);

        foreach ($detail as $k => $row) {
            if (!$row["flag"]) {
                $imax++;
                $detail[$k]["parent_id"] = "0";
                $detail[$k]["level"] = "1";
                $detail[$k]["sort"] = str_pad($imax, 3, "0", STR_PAD_LEFT);
                $detail[$k]["flag"] = "2";
            }
        }

        foreach ($detail as $k => $row) {
            if ($row["flag"] == "2") {
                $upd = array();
                $upd["level"] = $row["level"];
                $upd["parent_id"] = $row["parent_id"];
                $upd["sort"] = $row["sort"];
                $upd["score"] = $row["score"];

                $model_d->where("id=$k")->save($upd);
            }
        }

    }

    private function verify_templet($id)
    {
        $model = M("Templet");
        $info = $model->where(array("id" => $id))->find();
        if (!$info) {
            $this->ajaxError("模板信息不存在！");
        }
        if (!$info["score"] && !$info["count"]) {
            $this->ajaxError("模板试卷总分/题量为设置");
        }

        $score = 0;
        $count = 0;
        $model_d = M("TempletDetail");

        $seq = 1;
        $result = $model_d->field("id,seq,score,type,req_category_code,req_category_name,req_type,req_child_count,req_child_seq")
            ->where(array("templet_id" => $id, "type" => "0"))
            ->order("seq")
            ->select();
        foreach ($result as $k => $d) {
            if ($d["seq"] <= 0) {
                $this->ajaxResult("题号错误：检查第" . $d["seq"] . "题题号");
            }
            if ($d["seq"] < $seq) {
                $this->ajaxResult("题号重复：检查第" . $d["seq"] . "题重复定义");
            }
            if ($d["seq"] > $seq) {
                $this->ajaxResult("漏题检查：第" . $seq . "题不存在, 请检查是否漏题或子题未分配题号" . $d["seq"]);
            }
            if ($d["req_type"] && $d["req_child_seq"]) {
                $seq += $d["req_child_count"];
            } else {
                $seq++;
            }
        }

        $seq = 1;
        $result = $model_d->field("id,parent_id,seq,score,type,req_category_code,req_category_name,req_type,req_child_count,req_child_seq")
            ->where(array("templet_id" => $id, "type" => "0"))
            ->order("sort")
            ->select();
        foreach ($result as $k => $d) {
            if ($d["seq"] != $seq) {
                $this->ajaxResult("题号顺序错误: 调整第" . $d["seq"] . "题位置");
            }
            if (!$d["parent_id"]) {
                $this->ajaxResult("试题上级错误: 第" . $d["seq"] . "题应在7类标题下");
            }
            if ($d["score"] <= 0) {
                $this->ajaxResult("试题分数错误: 第" . $d["seq"] . "题分数没有设置");
            }
            $category = M("question_category")->where(array("code" => $d["req_category_code"]))->find();
            if (!$category) {
                $this->ajaxResult("知识点错误: 第" . $d["seq"] . "题知识点(" . $d["req_category_name"] . ")不存在");
            }
            if ($d["req_type"] && $d["req_child_seq"]) {
                $seq += $d["req_child_count"];
                $count += $d["req_child_count"];
            } else {
                $count++;
                $seq++;
            }

            $score += $d["score"];
        }

        if ($score != $info["score"] || $count != $info["count"]) {
            $this->ajaxError("模板试卷总分[" . $info["score"] . "]题量[" . $info["count"] . "]与<br>明细合计分数[" . $score . "]题量[" . $count . "]不一致");
        }

        return true;
    }

    private function check_templet($data)
    {
        $id = I("get.id/d");

        $this->templetdetail_trim($id);

        $this->verify_templet($id);

        $this->ajax_func($data["funcid"] . "_tree_refresh()");
        $this->ajaxResult("校验成功");
    }


    private function templetdetail_sort(&$detail, $parent_id, $level, $psort, &$imax, &$score)
    {
        $length = 3;
        $imax = 0;
        $score = 0;
        $curscore = 0;
        if ($parent_id === "0") {
            $level = 1;
            $psort = "";
        }
        foreach ($detail as $k => $row) {
            if ($row["parent_id"] === $parent_id) {
                $detail[$k]["flag"] = "1";
                $sort = $row["sort"];
                $left = mb_substr($row["sort"], 0, $length * ($level - 1));
                $right = mb_substr($row["sort"], $length * ($level - 1) + 1, $length);
                $seq = intval($right);
                if ($left === $psort && $seq >= $imax + 1 && $row["level"] = $level) {
                    $imax = $seq;
                } else {
                    $imax++;
                    $sort = $psort . str_pad($imax, $length, "0", STR_PAD_LEFT);
                    $detail[$k]["sort"] = $sort;
                    $detail[$k]["level"] = $level;
                    $detail[$k]["flag"] = "2";
                }

                if ($row["type"]) {
                    $curscore = 0;
                    $iseq = 0;
                    $this->templetdetail_sort($detail, $row["id"], $level + 1, $sort, $iseq, $curscore);
                    if (($row["type"] == 7 || $row["type"] == 8) && $row["score"] != $curscore) {
                        $detail[$k]["score"] = $curscore;
                        $detail[$k]["flag"] = "2";
                    }
                } else {
                    $curscore = $row["score"];
                }

                $score += $curscore;
            }
        }
    }

    private function create_exam($data)
    {
        $id = I("get.tid/d");
        $exam_id = I("get.examid/d");
        $model = M("Templet");
        $info = $model->where(array("id" => $id))->find();
        if (!$info) {
            $this->ajaxError("模板信息不存在！");
        }
        $model_d = M("TempletDetail");
        $list = $model_d->where(array("templet_id" => $id))->order("sort,seq")->select();
        $model->startTrans();
        $model_e = M("Exam");
        $model_e_d = M("ExamDetail");

        if ($exam_id) {
            $ex = $model_e->find($exam_id);
            if (!ex) {
                $this->ajaxError("试卷信息不存在！");
            }
            $exam_no = $ex["exam_no"];
            $cur_data["create_user"] = $ex["create_user"];
            $cur_data["create_time"] = $ex["create_time"];

            $model_e_d->where("exam_id=" . $exam_id)->delete();
        } else {
            //$exam_no=GenOrderNo("exam");
            $seqno = Gen_Number("exam", "templet", date('Y'));
            //GenOrderNo("exam");
            //$info["templet_no"]."-".
            $exam_no = date('Y') . "-" . str_pad($seqno, 4, "0", STR_PAD_LEFT);
            $cur_data["create_user"] = session(C("USER_AUTH_KEY"));
            $cur_data["create_time"] = date('Y-m-d H:i:s.n');
        }
        $cur_data["exam_no"] = $exam_no;
        $cur_data["templet_id"] = $info["id"];
        $cur_data["templet_no"] = $info["templet_no"];
        $cur_data["type"] = $info["type"];
        $cur_data["subject"] = $info["subject"];
        $cur_data["details"] = $info["details"];
        $cur_data["count"] = $info["count"];
        $cur_data["score"] = $info["score"];
        $cur_data["req_time"] = $info["req_time"];
        $cur_data["req_content"] = $info["req_content"];
        $cur_data["remarks"] = $info["remarks"];
        $cur_data["status"] = 0;
        $cur_data["modify_user"] = session(C("USER_AUTH_KEY"));
        $cur_data["modify_time"] = date('Y-m-d H:i:s.n');

        if ($exam_id)
            $exam_id = $model_e->where("id=" . $exam_id)->save($cur_data);
        else
            $exam_id = $model_e->add($cur_data);
        $err_msg = array();
        foreach ($list as $k => $val) {
            if ($val[type] == 0) {
                $err_msg_sign = "";
                $this->select_question_sign($exam_id, $val['id'], $err_msg_sign);
                if (!empty($err_msg_sign)) {
                    $err_msg[] = $err_msg_sign;
                }
            } else {
                $cur_data = array();
                $cur_data["exam_id"] = $exam_id;
                $cur_data["exam_no"] = $exam_no;
                $cur_data["templet_id"] = $id;
                $cur_data["templet_detail_id"] = $val["id"];
                $cur_data["type"] = $val["type"];
                $cur_data["subject"] = $val["subject"];
                $cur_data["seq"] = $val["seq"];
                $cur_data["sort"] = $val["sort"];
                $cur_data["create_user"] = session(C("USER_AUTH_KEY"));
                $cur_data["create_time"] = date('Y-m-d H:i:s.n');
                $cur_data["modify_user"] = session(C("USER_AUTH_KEY"));
                $cur_data["modify_time"] = date('Y-m-d H:i:s.n');
                $model_e_d->add($cur_data);
            }
        }

        $model->where(array("id" => $id))->save(array("exam_id" => $exam_id));

        $model->commit();

        if (!$err_msg) {
            $err_msg = "试卷($exam_no)抽取完成, 请查看抽取结果";
        }
//        $err_msg=array();


        $this->ajax_hideConfirm();
        $this->ajax_func($data ['funcid'] . "_create_exam_callback", "'试卷($exam_no)抽取完成, 请查看抽取结果'");
        $this->ajaxResult("");

    }


    private function examdeleteProcess($id)
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


    private function examorder_deleteer($data)
    {

        $id = I("request.id/d");
        $type = I("request.type/d");
        if (!$id) {
            $this->ajaxResult("试卷信息参数不存在");
        }

        $m = M();
        $m->startTrans();
        $r = $this->examdeleteProcess($id);
        if ($r) {
            $m->commit();
        } else {
            $m->rollback();
        }

        //date :2019-6-28 将原来的
        /*$this->ajax_hideConfirm();
        if (!$type) {
            $this->ajax_closeTab($data ['funcid']); //关闭当前的窗口
        }*/

        $this->ajax_hideConfirm();
        $this->ajax_func($data ['funcid'] . "_create_exam_callback", "'删除试卷成功'");
        $this->ajaxResult("");
        die;
    }





    private function getexam_detail($data)
    {
        $id = I("get.id/d");
        $model = M("ExamDetail");
        $list = $model->where(array("exam_id" => $id, "parent_id" => 0))->select();
        $data["exam_list"] = $list;
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:exam_detail");
        echo $html;
    }


    private function select_questioner($data)
    {
        $id = I("get.tid/d");
        $t = I("t");
        $model = M("Templet");
        $info = $model->where(array("id" => $id))->find();
        if (!$info) {
            $this->ajaxError("模板信息不存在！");
        }
        $model_d = M("TempletDetail");
        $list = $model_d->where(array("templet_id" => $id))->select();
        $model->startTrans();
        $model_e = M("Exam");
        $model_e_d = M("ExamDetail");

        $ids = I("Key");
        if (!is_array($ids)) {
            $ids = array($ids);
        }

        $err_msg = array();
        foreach ($ids as $k => $cur_id) {
            $detail_info = $model_e_d->where(array("id" => $cur_id))->find();
            if (!$detail_info) {
                $this->ajaxError("试题明细不存在！");
            }
            $err_msg_sign = "";
            $this->select_question_signer($detail_info["exam_id"], $detail_info["templet_detail_id"], $err_msg_sign, $cur_id, "", $codeno);

            if (!empty($err_msg_sign)) {
                $err_msg[] = $err_msg_sign;
            }
            $ccc = $codeno;
        }


        $model->commit();

        //$this->ajax_func($data ['pfuncid']."_select_question_callback","'".join("</br>",$err_msg)."'");
        if ($t !== 1) {
            if (!empty($err_msg)) {
                $this->ajaxResult(join(",", $err_msg));
            } else {
                $detail_info = $model_e_d->where(array("id" => $cur_id))->find();
                $this->ajax_func($data ['funcid'] . "_select_question_callback", $detail_info["question_id"]);
            }
        } else {
            $this->ajax_func($data ['funcid'] . "_select_question_callback", "'试题抽取完毕，请查看'");
        }
        $data['code'] = $ccc;
        $this->ajaxResult();
        //$this->questionviewer($ccc);
    }


    private function select_question($data)
    {
        $id = I("get.tid/d");
        $t = I("t");
        $model = M("Templet");
        $info = $model->where(array("id" => $id))->find();
        if (!$info) {
            $this->ajaxError("模板信息不存在！");
        }
        $model_d = M("TempletDetail");
        $list = $model_d->where(array("templet_id" => $id))->select();
        $model->startTrans();
        $model_e = M("Exam");
        $model_e_d = M("ExamDetail");

        $ids = I("Key");
        if (!is_array($ids)) {
            $ids = array($ids);
        }

        $err_msg = array();
        foreach ($ids as $k => $cur_id) {
            $detail_info = $model_e_d->where(array("id" => $cur_id))->find();
            if (!$detail_info) {
                $this->ajaxError("试题明细不存在！");
            }
            $err_msg_sign = "";
            $this->select_question_sign($detail_info["exam_id"], $detail_info["templet_detail_id"], $err_msg_sign, $cur_id);

            if (!empty($err_msg_sign)) {
                $err_msg[] = $err_msg_sign;
            }
        }


        $model->commit();

        //$this->ajax_func($data ['pfuncid']."_select_question_callback","'".join("</br>",$err_msg)."'");
        if ($t !== 1) {
            if (!empty($err_msg)) {
                $this->ajaxResult(join(",", $err_msg));
            } else {
                $detail_info = $model_e_d->where(array("id" => $cur_id))->find();
                $this->ajax_func($data ['funcid'] . "_select_question_callback", $detail_info["question_id"]);
            }
        } else {
            $this->ajax_func($data ['funcid'] . "_select_question_callback", "'试题抽取完毕，请查看'");
        }
        $this->ajaxResult();

    }

    private function move_up($data)
    {
        $id = I("id/d", 0);
        $p_id = I("pid/d", 0);
        $move_up = I("move_up/d", 0);
        $model = M("TempletDetail");

        if ($id <= 0) {
            $this->ajaxError("模板明细id不存在！");
        }
        $info = $model->where(array("id" => $id))->find();
        if (!$info) {
            $this->ajaxError("模板明细信息不存在！");
        }
        $info_p = $model->where(array("id" => $p_id))->find();
        if (!$info_p) {
            $this->ajaxError("上级模板明细信息不存在！");
        }
        $model->startTrans();
        $sort_length = 3;
        $per_sort = mb_substr($info_p["sort"], 0, $info_p["level"] * $sort_length);
        $sort = mb_substr($info["sort"], 0, $info["level"] * $sort_length);
        $start = $info_p["level"] * $sort_length + 1;
        $sort_len = mb_strlen($info_p["sort"]) + 1 - $start;

        $list = $model->where(array("templet_id" => $info["templet_id"], "sort" => array("like", "$per_sort%")))->field("id")->select();
        $ids = array_column($list, "id");

        $model->where(array("templet_id" => $info_p["templet_id"], "sort" => array("like", "$sort%")))->save(array("sort" => array("exp", "CONCAT('$per_sort',MID(sort,$start,$sort_len))")));
        //$model->where(array("id"=>$id))->save(array("sort"=>$info_p["sort"]));


        if (count($ids) > 0) {
            $model->where(array("templet_id" => $info["templet_id"], "id" => array("in", $ids)))->save(array("sort" => array("exp", "CONCAT('$sort',MID(sort,$start,$sort_len))")));
        }
        //$model->where(array("id"=>$p_id))->save(array("sort"=>$info["sort"]));


        //        if($info_p["sort"]!=$info["sort"])
//        {
//
//            $model->where(array("id"=>$id))->save(array("sort"=>$info_p["sort"]));
//            $model->where(array("id"=>$p_id))->save(array("sort"=>$info["sort"]));
//        }else
//        {
//            $model->where(array("id"=>$id))->save(array("sort"=>($info_p["sort"]-1)));
//        }

        //$model->rollback();
        $model->commit();

        $this->ajax_hideConfirm();
        $this->ajax_func($data['funcid'] . "_move_up_callback", "'$move_up'");
        $this->ajaxResult();

    }

    private function select_question_sign($exam_id, $templet_detail_id, &$err_msg, $exam_detail_id = 0, $question_id = 0)
    {
        $err_msg = "";
        $err_info = "没有找到符合要求的题目";
        $model_d = M("TempletDetail");
        $model_e_d = M("ExamDetail");
        $model_e = M("Exam");
        $model_q = M("Question");
        $exam_info = $model_e->where(array("id" => $exam_id))->find();
        $templet_detail_info = $model_d->where(array("id" => $templet_detail_id))->find();
        if (!$templet_detail_info) {
            $this->ajaxError("模板明细信息不存在！");
        }

        if ($templet_detail_info["type"] == 0) {
            $where = array(
                "type" => $templet_detail_info["req_type"],

            );
            $question_list = $model_e_d->where(array(
                "exam_id" => $exam_id,
                "type" => $templet_detail_info["req_type"],
                "question_id" => array("gt", 0)
            ))->field("question_id")->select();
            if ($question_list) {
                $question_ids = array_column($question_list, 'question_id');
                if ($question_id >= 0) {
                    if (in_array($question_id, $question_ids)) {
                        $err_msg = "此题已在此试卷中";
                        return false;
                    }
                } else {
                    $where["id"] = array("not in", $question_ids);
                }
            }
            $category_codewhere = null;

            if ($question_id <= 0) {
                if (!empty($templet_detail_info["req_category_code"])) {
                    // date:2019-6-21  原因：将原来的固定的category_code更换成固定开头（category_code）的模糊查询  $where["category_code"] = $templet_detail_info["req_category_code"];
                    $category_codewhere = "category_code like '" . $templet_detail_info["req_category_code"] . "%'";
                }
                if (!empty($templet_detail_info["req_kind"])) {
                    $where["kind"] = $templet_detail_info["req_kind"];
                }
                if ($templet_detail_info["req_type"] == 1) {
                    $where["parent_id"] = 0;
                    $where["childs"] = $templet_detail_info["req_child_count"];
                }
                $order = "";
                switch ($templet_detail_info["extract"]) {
                    case "2":
                        $order = "`using`";
                        break;
                    case "1":
                        $where["using"] = 0;
                        break;
                }
            } else {

                if (!empty($templet_detail_info["req_category_code"])) {
                    // date:2019-6-21  原因：将原来的固定的category_code更换成固定开头（category_code）的模糊查询  $where["category_code"] = $templet_detail_info["req_category_code"];
                    $category_codewhere = "category_code like '" . $templet_detail_info["req_category_code"] . "%'";
                }
                if (!empty($templet_detail_info["req_kind"])) {
                    $where["kind"] = $templet_detail_info["req_kind"];
                }

                $where["id"] = $question_id;
                $order = "id";
            }

            /* date:2019-6-21 原因：没有随机抽取试卷    $question_info=$model_q->where($where)->order($order)->find();*/
            /**
             * 新添加的生成随机的一道题
             */
            if ($where["id"] == null) {
                $question_info = $model_q->field(" count(*) as num ")->where($where)->where($category_codewhere)->order($order)->select();
                $random = rand(1, $question_info[0]["num"]) - 1;
                $question_info = $model_q->where($where)->where($category_codewhere)->limit($random . ",1")->order($order)->select();
                $question_info = $question_info[0];
            } else {
                $question_info = $model_q->where($where)->where($category_codewhere)->order($order)->find();
            }

            if (!$question_info && $question_id==0) {
                //$this->ajaxError("没有找到符合要求的题目");
                $err_msg = "模板(" . $templet_detail_info["subject"] . ")" . $err_info;
                if ($question_id > 0) {
                    return false;
                }
            }else{
                $err_msg = "此题不符合该试题的抽题规则";
            }

            $cur_data = array();
            if ($exam_detail_id > 0) {
                $detail_info = $model_e_d->where(array("id" => $exam_detail_id))->find();
                $cur_data = $detail_info;
                unset($cur_data['id']);
            } else {
                $cur_data["exam_id"] = $exam_id;
                $cur_data["exam_no"] = $exam_info["exam_no"];
                $cur_data["templet_id"] = $templet_detail_info["templet_id"];
                $cur_data["templet_detail_id"] = $templet_detail_info["id"];
                $cur_data["sort"] = $templet_detail_info["sort"];
                $cur_data["type"] = $templet_detail_info["type"];
                $cur_data["subject"] = $templet_detail_info["subject"];
                $cur_data["seq"] = $templet_detail_info["seq"];
                $cur_data["score"] = $templet_detail_info["score"];
                $cur_data["create_user"] = session(C("USER_AUTH_KEY"));
                $cur_data["create_time"] = date('Y-m-d H:i:s.n');
                $cur_data["modify_user"] = session(C("USER_AUTH_KEY"));
                $cur_data["modify_time"] = date('Y-m-d H:i:s.n');
            }

            if ($question_info) {
                $cur_data["question_parent_id"] = $question_info["parent_id"];
                $cur_data["question_id"] = $question_info["id"];
                $cur_data["question_type"] = $question_info["type"];
                $cur_data["question_code"] = $question_info["code"];
                $cur_data["question_name"] = $question_info["name"];
                $cur_data["question_category_code"] = $question_info["category_code"];
                $cur_data["question_category_name"] = $question_info["category_name"];
                $cur_data["question_kind"] = $question_info["kind"];
                $cur_data["question_stem"] = $question_info["stem"];
                $cur_data["question_quiz"] = $question_info["quiz"];
                $cur_data["question_answer"] = $question_info["answer"];
                $cur_data["question_childs"] = $question_info["childs"];
                $cur_data["question_img"] = $question_info["img"];
                $cur_data["question_analysis"] = $question_info["analysis"];
                $cur_data["question_description"] = $question_info["description"];
            } else {
                $cur_data["question_name"] = $err_info;
                $cur_data["question_type"] = $templet_detail_info["type"];
                $cur_data["question_category_code"] = $templet_detail_info["req_category_code"];
                $cur_data["question_category_name"] = $templet_detail_info["req_category_name"];
                $cur_data["question_kind"] = $templet_detail_info["req_kind"];
            }

            if ($exam_detail_id > 0) {
                $model_e_d->where(array("id" => $exam_detail_id))->save($cur_data);
            } else {
                $exam_detail_id = $model_e_d->add($cur_data);
            }

            if ($templet_detail_info["req_type"] == 1) {
                if ($exam_detail_id > 0 && $detail_info["question_id"] > 0) {
                    $model_e_d->where(array("exam_id" => $exam_id, "question_parent_id" => $detail_info["question_id"]))->delete();
                }
                if ($question_info) {
                    $question_list = $model_q->where(array("parent_id" => $question_info["id"]))->select();
                    if ($templet_detail_info["req_child_seq"] == 1) {
                        if ($templet_detail_info["req_child_count"] > 0) {
                            $score_avg = intval($templet_detail_info["score"] / $templet_detail_info["req_child_count"]);
                            $score_left = $templet_detail_info["score"] % $templet_detail_info["req_child_count"];
                        }
                    }

                    $cur_seq = $templet_detail_info["seq"];
                    $sort = $templet_detail_info["sort"];
                    $level = $templet_detail_info["level"] + 1;
                    foreach ($question_list as $k => $question_info) {
                        if ($templet_detail_info["req_child_seq"] == 1) {
                            $cur_seq++;
                        }
                        $cur_data["seq"] = $cur_seq;
                        $score = $score_avg;
                        if ($score_left > 0) {
                            $score++;
                            $score_left--;
                        }
                        $sort = get_templet_detail_sort($sort, $level);
                        $cur_data["sort"] = $sort;
                        $cur_data["score"] = $score;
                        $cur_data["question_parent_id"] = $question_info["parent_id"];
                        $cur_data["question_id"] = $question_info["id"];
                        $cur_data["question_type"] = $question_info["type"];
                        $cur_data["question_code"] = $question_info["code"];
                        $cur_data["question_name"] = $question_info["name"];
                        $cur_data["question_category_code"] = $question_info["category_code"];
                        $cur_data["question_category_name"] = $question_info["category_name"];
                        $cur_data["question_kind"] = $question_info["kind"];
                        $cur_data["question_stem"] = $question_info["stem"];
                        $cur_data["question_quiz"] = $question_info["quiz"];
                        $cur_data["question_answer"] = $question_info["answer"];
                        $cur_data["question_childs"] = $question_info["childs"];
                        $cur_data["question_img"] = $question_info["img"];
                        $cur_data["question_analysis"] = $question_info["analysis"];
                        $model_e_d->add($cur_data);
                    }
                }
            }
            return true;
        }
    }

    private function select_question_signer($exam_id, $templet_detail_id, &$err_msg, $exam_detail_id = 0, $question_id = 0, &$questionno)
    {
        $err_msg = "";
        $err_info = "没有找到符合要求的题目";
        $model_d = M("TempletDetail");
        $model_e_d = M("ExamDetail");
        $model_e = M("Exam");
        $model_q = M("Question");
        $exam_info = $model_e->where(array("id" => $exam_id))->find();
        $templet_detail_info = $model_d->where(array("id" => $templet_detail_id))->find();
        if (!$templet_detail_info) {
            $this->ajaxError("模板明细信息不存在！");
        }

        if ($templet_detail_info["type"] == 0) {
            $where = array(
                "type" => $templet_detail_info["req_type"],

            );
            $question_list = $model_e_d->where(array(
                "exam_id" => $exam_id,
                "type" => $templet_detail_info["req_type"],
                "question_id" => array("gt", 0)
            ))->field("question_id")->select();
            if ($question_list) {
                $question_ids = array_column($question_list, 'question_id');
                if ($question_id >= 0) {
                    if (in_array($question_id, $question_ids)) {
                        $err_msg = "此题已在此试卷中";
                        return false;
                    }
                } else {
                    $where["id"] = array("not in", $question_ids);
                }
            }
            $category_codewhere = null;
            if ($question_id <= 0) {
                if (!empty($templet_detail_info["req_category_code"])) {
                    // date:2019-6-21  原因：将原来的固定的category_code更换成固定开头（category_code）的模糊查询  $where["category_code"] = $templet_detail_info["req_category_code"];
                    $category_codewhere = "category_code like '" . $templet_detail_info["req_category_code"] . "%'";
                }
                if (!empty($templet_detail_info["req_kind"])) {
                    $where["kind"] = $templet_detail_info["req_kind"];
                }
                if ($templet_detail_info["req_type"] == 1) {
                    $where["parent_id"] = 0;
                    $where["childs"] = $templet_detail_info["req_child_count"];
                }
                $order = "";
                switch ($templet_detail_info["extract"]) {
                    case "2":
                        $order = "`using`";
                        break;
                    case "1":
                        $where["using"] = 0;
                        break;
                }
            } else {
                $where["id"] = $question_id;
                $order = "id";
            }

            /* date:2019-6-21 原因：没有随机抽取试卷    $question_info=$model_q->where($where)->order($order)->find();*/
            /**
             * 新添加的生成随机的一道题
             */
            $question_info = $model_q->field(" count(*) as num ")->where($where)->where($category_codewhere)->order($order)->select();
            $random = rand(1, $question_info[0]["num"]) - 1;
            $question_info = $model_q->where($where)->where($category_codewhere)->limit($random . ",1")->order($order)->select();
            $question_info = $question_info[0];
            $questionno = $question_info["code"];

            if (!$question_info) {
                //$this->ajaxError("没有找到符合要求的题目");
                $err_msg = "模板(" . $templet_detail_info["subject"] . ")" . $err_info;
                if ($question_id > 0) {
                    return false;
                }
                // return false;
            }

            return true;
        }
    }


    private function update_templet_detail_sort($id, $parent_id = 0)
    {
        $model_detail = M("TempletDetail");
        $detail_list = $model_detail->where(array("templet_id" => $id, "parent_id" => $parent_id))
            ->order("sort,seq")->select();
        $parent_info = $model_detail->where(array("id" => $parent_id))->find();
        if (!$parent_info) {
            $last_sort = "";
        } else {
            $last_sort = $parent_info["sort"];
        }
        foreach ($detail_list as $k => $item) {
            //echo $last_sort."<br>";
            $sort = get_templet_detail_sort($last_sort, $item["level"]);
            $model_detail->where(array("id" => $item["id"]))->save(array("sort" => $sort));
            $this->update_templet_detail_sort($id, $item['id']);
            $last_sort = $sort;
        }
        $model_detail->rollback();
    }

    private function exam($data)
    {
        $id = I("id/d", 0);
        $data["pfuncid"] = $data["funcid"];

        $data["templet_id"] = $id;
        $model = M("Templet");
        $info = $model->where(array("id" => $id))->find();
        if (!$info) {
            $this->ajaxError("模板信息不存在");
        }
        $data["templet"] = $info;
        $data["templet_list"] = $this->gettemplet_detail_list($id);


        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }

        $html = $this->fetch("Templet:exam");
        echo $html;
    }


    public function detailarea1($data)
    {
        $condition = "";
        $masterkey = "";
        $join = "";
        $data["p"] = I("request.p/d");

        $data["tab"] = I("request.tab");
        $search["id"] = I("request.id/d");
        $condition .= " and @exam.templet_id=" . $search["id"];
        $masterkey .= " id=" . $search["id"];
        $data["search"] = M("templet")->where($masterkey)->find();


        if (!$search)   // no param
            $this->ajaxError("查询参数非法");

        $selectfields = "@exam.status ";
        $selectfields .= ",@exam.exam_no ";
        $selectfields .= ",@exam.subject ";
        $selectfields .= ",@exam.type ";
        $selectfields .= ",@exam.score ";
        $selectfields .= ",@exam.count ";
        $selectfields .= ",@exam.modify_time ";
        $selectfields .= ", @exam.id";

        $page_size = 1000;              //no paging ,hardcode=1000

        $condition = $condition;
        $count_sql = "select count(*) as cnt from @exam  #join# where 1=1 #condition#";
        $count_sql = str_replace("#condition#", $condition, $count_sql);
        $count_sql = str_replace("#join#", $join, $count_sql);

        $count_sql = table($count_sql);
        $count_sql = str_replace("·mailchar·", "@", $count_sql);

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

        $orderby = "order by @exam.id";
        $sql = "select #selectfields# from @exam  #join# Where 1=1 #condition# #orderby#";
        $sql = str_replace("#selectfields#", $selectfields, $sql);
        $sql = str_replace("#join#", $join, $sql);
        $sql = str_replace("#condition#", $condition, $sql);
        $sql = str_replace("#orderby#", $orderby, $sql);
        $sql .= " LIMIT " . (($data["p"] - 1) * $page_size) . ", $page_size";

        $sql = table($sql);
        $sql = str_replace("·mailchar·", "@", $sql);

        $data["list"] = M()->query($sql);

        $data["page"] = "";
        $data["page_size"] = $page_size;

        $data["master"] = M("templet")->where($masterkey)->find();

        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:detailarea1");
        echo $html;
    }

    public function detailarea2($data)
    {
        $condition = "";
        $masterkey = "";
        $join = "";
        $data["p"] = I("request.p/d");

        $data["tab"] = I("request.tab");
        $search["id"] = I("request.id/d");
        $condition .= " and @exam_detail.exam_id=" . $search["id"];
        $masterkey .= " id=" . $search["id"];
        $data["search"] = M("exam")->where($masterkey)->find();


        if (!$search)   // no param
            $this->ajaxError("查询参数非法");

        $selectfields = "@exam_detail.subject ";
        $selectfields .= ",@exam_detail.templet_id ";
        $selectfields .= ",@exam_detail.type ";
        $selectfields .= ",@exam_detail.question_id ";
        $selectfields .= ", @exam_detail.question_code";
        $selectfields .= ", @exam_detail.create_time";
        $selectfields .= ",@exam_detail.question_type ";
        $selectfields .= ",@exam_detail.question_name ";
        $selectfields .= ",@exam_detail.question_kind ";
        $selectfields .= ",@exam_detail.question_category_name ";
        $selectfields .= ",@exam_detail.seq ";
        $selectfields .= ",@exam_detail.score ";
        $selectfields .= ", @exam_detail.id";

        $page_size = 1000;              //no paging ,hardcode=1000

        $condition = $condition;
        $count_sql = "select count(*) as cnt from @exam_detail  #join# where 1=1 #condition#";
        $count_sql = str_replace("#condition#", $condition, $count_sql);
        $count_sql = str_replace("#join#", $join, $count_sql);

        $count_sql = table($count_sql);
        $count_sql = str_replace("·mailchar·", "@", $count_sql);

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

        $orderby = "order by @exam_detail.sort";
        $sql = "select #selectfields# from @exam_detail  #join# Where 1=1 #condition# #orderby#";
        $sql = str_replace("#selectfields#", $selectfields, $sql);
        $sql = str_replace("#join#", $join, $sql);
        $sql = str_replace("#condition#", $condition, $sql);
        $sql = str_replace("#orderby#", $orderby, $sql);
        $sql .= " LIMIT " . (($data["p"] - 1) * $page_size) . ", $page_size";

        $sql = table($sql);
        $sql = str_replace("·mailchar·", "@", $sql);

        $data["list"] = M()->query($sql);


        $examname = M("exam")->field("id,subject,exam_no")->where("id=" . $search["id"])->select();
        $examid = $examname[0]["id"];
        $examnamename = $examname[0]["subject"];
        $exam_no = $examname[0]["exam_no"];
        $data["examname"] = $examnamename;
        $data["exam_no"] = $exam_no;
        $data["examid"] = $examid;

        $data["page"] = "";
        $data["page_size"] = $page_size;

        $data["master"] = M("templet")->where($masterkey)->find();

        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:detailarea2");
        echo $html;
    }

    private function examview($data)
    {
        $id = I("get.id/d");
        if (empty($id)) {
            $this->ajaxError("非法操作");
        }
        $exam = M("exam")->where("id = $id")->find();
        if (empty($exam)) {
            $this->ajaxError("试卷不存在");
        }

        $examDetailRaw = M("exam_detail")->where("exam_id = $id")->order("id asc")->select();
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

        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:examview");
        echo $html;
    }

    private function tree($data)
    {
        $id = I("id/d", 0);
        $data["pfuncid"] = $data["funcid"];

        $data["templet_id"] = $id;
        $model = M("Templet");
        $info = $model->where(array("id" => $id))->find();
        if (!$info) {
            $this->ajaxError("模板信息不存在");
        }
        $data["templet"] = $info;
        $data["templet_list"] = $this->gettemplet_detail_list($id);


        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:tree");
        echo $html;
    }

    private function rechoose_question($data)
    {
        $id = I("id/d", 0);
        if ($id <= 0) {
            $this->ajaxError("试题信息id不存在");
        }
        $model = M("exam_detail");
        $exam_detail_info = $model->where(array("id" => $id))->find();
        if (!exam_detail_info) {
            $this->ajaxError("试题信息不存在");
        }
        $data["exam_detail"] = $exam_detail_info;


        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:rechoose_question");
        echo $html;
    }

    private function questionviewer($code)
    {
        $code = $code;
        if (empty($code)) {
            $id = I("id/d");
            if (empty($id)) {
                $this->ajaxError("非法操作");
            }
            $where = array("id" => $id);
        } else {
            $where = array("code" => $code);
        }

        $item = M("question")->where($where)->find();
        if ($item["type"] == 1) {
            $subItem = M("question")->where("parent_id = " . $item["id"])->select();
        }

        $items[] = $item;
        foreach ($subItem as $key => $row) {
            $items[] = $row;
        }

        $seq = 1;
        $type = 0;
        foreach ($items as $key => $row) {
            if ($key == 0) {
                $type = $items[$key]["type"];
            }
            $items[$key]["stem"] = scanSubject($items[$key]["type"] == 1 ? 0 : $seq, $items[$key]["stem"], $items[$key]["kind"], $items[$key]["img"]);
            $items[$key]["description"] = scanSubject($items[$key]["type"] == 1 ? 0 : $seq, $items[$key]["description"], $items[$key]["kind"], $items[$key]["img"], true);
            $pk = false;
            $item["analysis"] = scanLine($item["analysis"], $pk);
            if ($items[$key]["img"] != "") {
                $items[$key]["hasImg"] = true;
            }
            $pk = false;
            if ($items[$key]["kind"] == "xz" || $items[$key]["kind"] == "dx") {
                $items[$key]["quiz_item"] = explode("|", $items[$key]["quiz"]);
                foreach ($items[$key]["quiz_item"] as $k => $r) {
                    $f = mb_substr($r, 0, 1);
                    $f = strtoupper($f);
                    $o = ord($f);
                    if ($o >= 65 && $o <= 90) {
                        $items[$key]["quiz_item"][$k] = mb_substr($r, 1);
                    }

                    if (mb_substr($items[$key]["quiz_item"][$k], 0, 2) == " .") {
                        $items[$key]["quiz_item"][$k] = " " . mb_substr($items[$key]["quiz_item"][$k], 2);
                    }
                    if (mb_substr($items[$key]["quiz_item"][$k], 0, 1) == ".") {
                        $items[$key]["quiz_item"][$k] = " " . mb_substr($items[$key]["quiz_item"][$k], 1);
                    }

                    $item[$key]["quiz_item"][$k] = scanLine($item[$key]["quiz_item"][$k], $pk);
                }
            } else {
                $item[$key]["quiz_item"] = scanLine($item[$key]["quiz_item"], $pk);
            }

            if ($items[$key]["type"] != 1) {
                $items[$key]["seq"] = $seq;
            } else {
                $items[$key]["seq"] = 0;
            }

            if ($items[$key]["type"] != 1) {
                $seq++;
            }
        }
        $data["items"] = $items;

        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:questionview");
        echo $html;
    }


    private function questionview($data)
    {
        $code = I("code");
        if (empty($code)) {
            $id = I("id/d");
            if (empty($id)) {
                $this->ajaxError("非法操作");
            }
            $where = array("id" => $id);
        } else {
            $where = array("code" => $code);
        }

        $item = M("question")->where($where)->find();
        if ($item["type"] == 1) {
            $subItem = M("question")->where("parent_id = " . $item["id"])->select();
        }

        $items[] = $item;
        foreach ($subItem as $key => $row) {
            $items[] = $row;
        }

        $seq = 1;
        $type = 0;
        foreach ($items as $key => $row) {
            if ($key == 0) {
                $type = $items[$key]["type"];
            }
            $items[$key]["stem"] = scanSubject($items[$key]["type"] == 1 ? 0 : $seq, $items[$key]["stem"], $items[$key]["kind"], $items[$key]["img"]);
            $items[$key]["description"] = scanSubject($items[$key]["type"] == 1 ? 0 : $seq, $items[$key]["description"], $items[$key]["kind"], $items[$key]["img"], true);
            $pk = false;
            $item["analysis"] = scanLine($item["analysis"], $pk);
            if ($items[$key]["img"] != "") {
                $items[$key]["hasImg"] = true;
            }
            $pk = false;
            if ($items[$key]["kind"] == "xz" || $items[$key]["kind"] == "dx") {
                $items[$key]["quiz_item"] = explode("|", $items[$key]["quiz"]);
                foreach ($items[$key]["quiz_item"] as $k => $r) {
                    $f = mb_substr($r, 0, 1);
                    $f = strtoupper($f);
                    $o = ord($f);
                    if ($o >= 65 && $o <= 90) {
                        $items[$key]["quiz_item"][$k] = mb_substr($r, 1);
                    }

                    if (mb_substr($items[$key]["quiz_item"][$k], 0, 2) == " .") {
                        $items[$key]["quiz_item"][$k] = " " . mb_substr($items[$key]["quiz_item"][$k], 2);
                    }
                    if (mb_substr($items[$key]["quiz_item"][$k], 0, 1) == ".") {
                        $items[$key]["quiz_item"][$k] = " " . mb_substr($items[$key]["quiz_item"][$k], 1);
                    }

                    $item[$key]["quiz_item"][$k] = scanLine($item[$key]["quiz_item"][$k], $pk);
                }
            } else {
                $item[$key]["quiz_item"] = scanLine($item[$key]["quiz_item"], $pk);
            }

            if ($items[$key]["type"] != 1) {
                $items[$key]["seq"] = $seq;
            } else {
                $items[$key]["seq"] = 0;
            }

            if ($items[$key]["type"] != 1) {
                $seq++;
            }
        }
        $data["items"] = $items;

        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Templet:questionview");
        echo $html;
    }

    private function question_save($data)
    {
        $id = I("id/d", 0);
        $code = I("code");
        $lockertype = I("lockertype");

        if ($lockertype == 1) {

        } else {
            if (empty($code)) {
                $this->ajaxResult("题号不存在,请输入题号");
            }

            $model = M("exam_detail");
            $exam_info = $model->where(array("id" => $id))->find();
            if (!$exam_info && $lockertype != 1) {
                $this->ajaxResult("试卷试题信息不存在");
            }
            $model_q = M("question");
            $question_info = $model_q->where(array("code" => $code))->find();
            if (!$question_info) {
                $this->ajaxResult("试题信息不存在");
            }

//            if($exam_info["req_type"]!=$question_info["type"])
//            {
//                $this->ajaxResult("抽取试题类型与原题类型不同");
//            }
//            if($exam_info["kind"]!=$question_info["kind"])
//            {
//                $this->ajaxResult("抽取试题类型与原题类型不同");
//            }
//            if($exam_info["req_childs"]!=$question_info["childs"])
//            {
//                $this->ajaxResult("抽取试题小题数与原题不同");
//            }
            $err_msg_sign = "";
            $model->startTrans();

            //date : 2019-6-28 原因:将原来的没有查询到题然后将报错信息输出改为判断报错信息有没有，如果有则终断
            /*if (!$this->select_question_sign($exam_info["exam_id"], $exam_info['templet_detail_id'], $err_msg_sign, $exam_info["id"], $question_info["id"])) {
                $this->ajaxResult($err_msg_sign);
            }*/

            $this->select_question_sign($exam_info["exam_id"], $exam_info['templet_detail_id'], $err_msg_sign, $exam_info["id"], $question_info["id"]);
            if($err_msg_sign!=null){
                $this->ajaxResult($err_msg_sign);
            }



            $model->commit();

        }
        $this->ajax_closePopup($data["funcid"]);
        $this->ajax_func($data ['pfuncid'] . "_select_question_callback", "'试题抽取完毕，请查看'");
        $this->ajaxResult();

    }
}
