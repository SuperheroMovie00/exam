<?php

namespace Home\Controller;

//
//注释: Question - 题库信息
//
use Home\Controller\BasicController;
use Think\Log;
use \Home\Widget\LCSWidget;
use ZipArchive;

class QuestionController extends BasicController
{


    public function _init()
    {
        $funcs = $this->getUserRoleList($this->user, array('/Home/Question', 'Question',));
        if ($funcs)
            $this->assign("rights", $funcs);
        else {
            $funcs = array(
                array("key" => "import", "func" => "/Home/Question", "Action" => "import"),
                array("key" => "refresh", "func" => "Question", "Action" => "refresh"),
                array("key" => "save", "func" => "/Home/Question", "Action" => "save"),
                array("key" => "search", "func" => "/Home/Question", "Action" => "view"),
                array("key" => "detail_import", "func" => "/Home/Question", "Action" => "detail_import"),
                array("key" => "detail_select", "func" => "/Home/Question", "Action" => "select_product"),
                array("key" => "tabcaozuorizhi", "func" => "/Home/Question", "Action" => "tabcaozuorizhi"),
                array("key" => "edit_base", "func" => "/Home/Question", "Action" => "edit_base"),
                array("key" => "order_edit", "func" => "/Home/Question", "Action" => "edit_base"),
                array("key" => "order_delete", "func" => "/Home/Question", "Action" => "delete"),
                array("key" => "status_on", "func" => "/Home/Question", "Action" => "status_on"),
                array("key" => "status_off", "func" => "/Home/Question", "Action" => "status_off"),
                array("key" => "master_view", "func" => "/Home/Question", "Action" => "view")
            );
            $this->assign("rights", $this->GetUserRights($this->user["id"], $funcs));
        }
        $this->assign("colshow", $this->GetUserColumnDefine($this->user["id"], "Question"));
    }

    public function index()
    {
        $data["pfuncid"] = I("request.pfuncid");
        $data["funcid"] = I("request.funcid");
        $data["zindex"] = I("request.zindex/d");
        if (empty($data["funcid"])) $data["funcid"] = "Question";
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
//// case for status_on ////
            case "status_on":
                $this->status_on($data);
                break;
            case "status_on_save":
                $this->status_on_save($data);
                break;
//// case for status_off ////
            case "status_off":
                $this->status_off($data);
                break;
            case "status_off_save":
                $this->status_off_save($data);
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
            $category_code = I("request.category_code");
            $code = I("request.code");
            $name = I("request.name");
            $kind = I("request.kind");
            $stem = I("request.stem");
            $quiz = I("request.quiz");
            $description = I("request.description");
            $answer = I("request.answer");
            $analysis = I("request.analysis");
            $childs = I("request.childs/d", 0);
            //赋初值
            $search["type"] = $type ? $type : "0";  //第一个选项
            $search["category_code"] = $category_code ? $category_code : "";
            $search["code"] = $code ? $code : "";
            $search["name"] = $name ? $name : "";
            $search["kind"] = $kind ? $kind : "1";  //第一个选项
            $search["stem"] = $stem ? $stem : "";
            $search["quiz"] = $quiz ? $quiz : "";
            $search["description"] = $description ? $description : "";
            $search["answer"] = $answer ? $answer : "";
            $search["analysis"] = $analysis ? $analysis : "";
            $search["childs"] = $childs ? $childs : "";
        } else {
            $search = M(question)->find($id);
            if (!$search) {
                $this->ajaxResult("题库数据不存在");
            }
            $data["id"] = $search["id"];
        }
        $data["search"] = $search;
        //检查popup返回name
        if ($data['search']['category_code']) {
            $ret = M("question_category")
                ->field("name")
                ->where("code='" . $data['search']['category_code'] . "'")
                ->find();
            if ($ret) {
                $data["search"]["category_code_name"] = $ret["name"];
            }
        }
        //检查绑定赋值
        $data["search"]["category_code_name"] = $data["search"]["category_name"];
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Question:add");
        echo $html;
    }

    private function save($data)
    {

        $id = I("request.id/d");
        //读取页面输入数据
        $type = I("request.type");
        $category_code_name = I("request.category_code_name");
        $category_code = I("request.category_code");
        $code = I("request.code");
        $name = I("request.name");
        $kind = I("request.kind");


        //----------------------------------//
        //------------题干校验---------------//
        //----------------------------------//
        $stem = I("request.stem");
        $stemce  = $stem; /*将题干赋值到另外一个变量中，避免真实变量发生问题*/
        if($this->CheckDefine( $stemce,"")!==true){
            echo json_encode(array("msg" => message("题干:".$this->CheckDefine( $stemce,""))));
            die;
        }
        $stem=trim($stem);



        //----------------------------------//
        //------------设问校验---------------//
        //----------------------------------//
        $description = I("request.description");
        $description=trim($description);

        $quiz = I("request.quiz");
        $quizce  = $quiz;
        if($this->CheckDefine( $quizce,"")!==true){
            echo json_encode(array("msg" => message("答案:".$this->CheckDefine( $quizce,""))));
            die;
        }
        $quiz ==trim($quiz);
        $quiz = str_replace("\n", "|", $quiz);  //存入数据库时将选项中的回车符替换成管道符。


        $answer = I("request.answer");
        $input["answer"] = $answer;


        //----------------------------------//
        //------------解析校验---------------//
        //----------------------------------//
        $analysis = I("request.analysis");
        $analysisce =$analysis;
        if($this->CheckDefine( $analysisce,"")!==true){
            echo json_encode(array("msg" => message("解析:".$this->CheckDefine( $analysisce,""))));
            die;
        }
        $analysisce=trim($analysisce);

        $childs = I("request.childs/d", 0);


        //----------------------------------//
        //------------图片上传---------------//
        //----------------------------------//
        if ($_FILES['img'] && $_FILES['img']['error'] == 0) {
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
            $upload->savePath = ''; // 设置附件上传（子）目录
            // 上传文件
            $info = $upload->upload();
            $img = trim($upload->rootPath, '.') . $info['img']['savepath'] . $info['img']['savename'];
        } else {
            $img = false;
        }



        //非页面输入字段
        $input = array();
        //数据有效性校验，非空/数值负数，范围/日期与今日比较
        //数据校验 - 必输项不能为空
        if (!verify_value($type, "empty", "", "")) $this->ajaxError("类型 不能为空");
        if (!verify_value($code, "empty", "", "")) $this->ajaxError("编码 不能为空");
        if (!verify_value($name, "empty", "", "")) $this->ajaxError("名称 不能为空");
        // "题干" 长度超200位，没有生成非空检测
        // "设问" 长度超200位，没有生成非空检测
        // "答案" 长度超200位，没有生成非空检测
        // "解析" 长度超200位，没有生成非空检测
        if (!verify_value($childs, "nagitive", "", "")) $this->ajaxError("小题数 不能为负数");
        //if ($childs < 100 || $childs > 105) $this->ajaxError("校验样例 小题数值在100-105之间");
        if ($category_code) {
            $ret = M("question_category")
                ->field("id,code,name,status")
                ->where(" code='$category_code' ")->find();
            if (!$ret) $this->ajaxError("知识点码不存在");
            if ($ret['status'] == 0 || $ret['status'] == 8) $this->ajaxError("知识点码非有效状态");
        }
        $model = M("question");
        //判断 code 是否重复建立
        $orig = $model->where("code='$code'" . ($id ? " and id!=$id" : ""))->find();
        if ($orig) $this->ajaxError("编码 $code 已存在");
        //页面输入字段
        $input["type"] = $type;
        $input["category_code_name"] = $category_code_name;
        $input["category_code"] = $category_code;
        $input["code"] = $code;
        $input["name"] = $name;
        $input["kind"] = $kind;
        $input["stem"] = $stem;
        $input["quiz"] = $quiz;
        $input["description"] = $description;
        $input["answer"] = $answer;
        $input["analysis"] = $analysis;
        $input["childs"] = $childs;
        if ($img != false)
            $input["img"] = $img;
        $input["category_name"] = $category_code_name;
        $input["modify_user"] = session(C("USER_AUTH_KEY"));
        $input["modify_time"] = date('Y-m-d H:i:s.n');
        $model->startTrans();
        $result = false;
        //需要存入日志的字段
        $needSave = array(
            'type' => '类型',
            'category_code' => '知识点码',
            'code' => '编码',
            'name' => '名称',
            'kind' => '题型',
            'childs' => '小题数',
        );
        if (!$id) {
            //新增  建号操作
            $input["create_user"] = session(C("USER_AUTH_KEY"));
            $input["create_time"] = date('Y-m-d H:i:s.n');
            //新增数据 保存数据库
            $result = $id = $model->add($input);
            //建立操作日志
            $result = $result && createLogCommon('question', $id, '新增题库', '', "*", 'code');
        } else {
            //id存在时判断数据库内数据是否存在
            $orig = $model->where("id='%d'", array($id))->find();
            if (empty($orig)) {
                $this->ajaxError("题库数据不存在");
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
                $result = $result && createLogCommon('question', $id, '变更题库', $orig, '', '', 'code', $needSave);
            }
        }
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
            echo json_encode(array("msg" => message("题库保存发生错误")));
            die;
        }

        //完成后跳转
        $this->ajaxReturn($data ['pfuncid'], $data ['funcid'], "refresh", "", "closepopup", 1);
        //转到view页面
        $this->ajaxReturn("", "", U("Question/index?func=view&id=$id&pfuncid=" . $data ['pfuncid']), tabtitle('题库', $input["code"]));
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
        $html = $this->fetch("Question:import");
        echo $html;
    }

    //自定义标签中的自定义值与标准数组进行比较
    private function Conpare($costem)
    {
        $arr = array("楷体", "宋体", "黑体", "F12", "F16", "F24", "B", "U",
            "D", "K", "T10", "T20", "TL", "PL", "PC", "PR", "P");

        //将$costem用空格进行截开
        $arrRow = explode(" ", $costem);

        foreach ($arrRow as $r) {
            if (!(in_array($r, $arr) > 0)) {
                return false;
            }
        }
    }

    //递归判断题干的自定义是否合法
    function CheckDefine(&$str, $ondefine = false, $start=false )
    {
        $arr = array("楷体", "宋体", "黑体", "F12", "F16", "F24", "B", "U",
            "D", "K", "T10", "T20", "TL", "PL", "PC", "PR", "P","WL","WC","WR");

        //echo "<br/>".$str."<br/>";
        while (1) {
            //strlen($str) <= strrpos($str, "[/#")

            if ($str == "") {
                if (!$ondefine)
                    return true;
                else
                    return false;
            }

            $i = strpos($str, "[#");
            $j = strpos($str, "[/#");
            if ($i === false && $j === false) {
                if (!$ondefine)
                    return true;
                else
                    return false;
            }

            //$j,$i多存在，j>i
            if ($i !== false && ($j > $i || $j === false)) {
                if($i>0 && $start===false){
                    $start=true;
                }
                $m = strpos($str, "]", $i + 1);       //第一个']'
                if ($m === false) {
                    return "自定义标签非法，标签不完整";
                }
                //判断</#之后是不是> 如果不是跳出循环
                if (substr($str, $m, 1) != "]") {
                    return "自定义标签非法，标签不完整";
                }
                //判定$j中的自定义节点的值是否在数组中存在。
                //将多个值在数组中对比判断是否与数组中的一致。
                $custom = substr($str, $i + 2, $m - $i - 2);
                $arrRow = explode(" ", $custom);

                foreach ($arrRow as $r) {
                    if ($r != " ") {          //截取出的自定义属性中不为空的进行比较
                        if (in_array($r, $arr) > 0) {
                            if ($start && in_array($r, array("楷体", "宋体", "黑体", "F12", "F16", "F24")) > 0) {
                                return "字体/字号只能定义在起始位置";   //图像不能与其他自定义属性相互嵌套
                            }
                            if (in_array($r, array("PL", "PC", "PR", "P")) > 0) {
                                if (count($arrRow) > 1) {
                                    return "图像标签属性只能单独存在";   //图像不能与其他自定义属性相互嵌套
                                }

                                //判断其位置是否在最末尾
                                if (substr($str, $i + 2, 1) != "") { //判断开始符号之后的是否为空格
                                    if (substr($str, $m + 1, $j - $m - 1) == "") {  //取图片的自定义属性开始和结束之间的判断是否为空

                                        if (($j + 4 == strlen($str))) {  //判断其最后的一个结束符下标索引是否为字符串长度
                                            return true;
                                        } else {
                                            return "图片标签放在最后";
                                        }
                                    } else {
                                        return "图片标签开始结束之间需为空";
                                    }
                                } else {
                                    return "自定义图片符号前有空格";
                                }
                            }
                        } else {
                            return "自定义标签值非法,或开始有空格";
                        }
                    }
                }
                $str = substr($str, $m + 1, strlen($str) - $m);

                //将字符串截断

                if ($this->CheckDefine($str, true)) {
                    return "自定义标签摆放非法";
                }
            } else {
                $m = strpos($str, "]", $j + 1);       //第一个']'
                if ($m === false) {
                    return false;
                }
                $str = substr($str, $m + 1, strlen($str) - $m);
                //echo "<br/>".$str."<br/>";
                return false;
            }
        }
    }

    //整理文字
    private function Question_trim($str)
    {
        //去除左右空格
        $str = trim($str);
        //var_dump($str[strlen($str)]=")");

        //去除括号
        if ($str[strlen($str)] = ")")
            $cy = rtrim($str, ")");
        else
            $cy = rtrim($str, "）");
        $cy = rtrim($cy);
        if ($cy[strlen($cy)] = "(")
            $cy = rtrim($cy, "(");
        else
            $cy = rtrim($cy, "（");

        //去除最后换行
        //替换最后的换行;
        $str = rtrim($cy);

        //判断是否离开
        $x = $str[strlen($str)];//读取最后字符;

        if ($x == ")" || $x == "）") {
            $this->Question_trim($str);
        }
        return $str;
    }


    private function question_checkexist($ABCD, $ans)
    {
        //拼接题干与选项
        $punctuation = array("，", "：", "“", " ", "、", "。", "？", "）"
        , "的", "（", ",", ".", "！", "【", "】", "；", "_", "”", "《", "》"
        , "|", "=", "{", "}", "[", "]", "．");
        $ans = str_replace($punctuation, "", $ans);
        $anABCD = array();
        foreach ($ABCD as $k => $cc) {
            $anABCD[] = $cc;
        }

        foreach ($ans as $d => $an) {
            if (in_array($an, $anABCD)) {
                return true;
            } else {
                return false;
            }

        }
    }

    private function cattext($string, $txt)
    {
        if ($string) $string .= ",";
        return $string . $txt;
    }

    private function question_verify($header, &$row,$filename)
    {


        $err_type = "";
        $err_empty = "";
        $err_exist = "";
        $zipnamepath=substr($filename,0,-4);

        $k = $row["excelno"];

        $type = $row['type'];
        //=========================================//
        //按次序校验为空                             //
        //========================================//

        if ($row['code']) {
            $ret = M("question")->field('id')->where("code='" . $row['code'] . "'")->find();
            if (!$ret) {
                $err_exist = $this->cattext($err_exist, "题库[" . $row["code"] . "]不存在");
            }
            $row['id'] = $ret['id'];
        }



        //=========================================//
        //试题单元                                  //
        //========================================//
        if ($row['unit']) {

            $c=array("片段阅读","篇章阅读","组合阅读","写作","其他","片段写作","修改","文言文阅读");
            $result=array_search($row['unit'],$c);
            if($result===false){
                $err_exist = $this->cattext($err_exist, "试题单元[" . $row["unit"] . "]数值非法");
            }else{
                $row["unit"]=$result+1;
            }
        }


        //=========================================//
        //知识点                                   //
        //========================================//
        if (!verify_value($row["category_name"], "empty", "", "")) {
           // $err_empty = $this->cattext($err_empty, $header["category_name"]);
        } else {
            $ret = M("question_category")//指定要查的表的表名
            ->field("id,code,name,status")//要查的列名
            ->where("name='" . $row["category_name"] . "' ")
                ->find();//从数据库中查询条件是code知识点代码
            if (!$ret) {
                $err_exist = $this->cattext($err_exist, $header["category_name"] . "[" . $row["category_name"] . "]定义不存在");
            }
            $row["category_code"] = $ret['code'];
            $row["category_name"] = $ret['name'];
        }


        //=========================================//
        //题干                                     //
        //========================================//
        if (!verify_value($row["stem"], "empty", "", "")) {
            $err_empty = $this->cattext($err_empty, $header["stem"]);
        } else {
            //校验题干中的自定义标签
            if($this->CheckDefine($row["stem"],"")!==true)
                $err_type = $this->cattext($err_type, $header["stem"].":".$this->CheckDefine($row["stem"],""));
            $row['stem']=trim($row['stem']);
            //将题干中末尾的小括号去掉
            $row['stem']=rtrim($row['stem']);
            $row['stem']=trim($row['stem'],')');
            $row['stem']=trim($row['stem'],'(');
        }



        //========================================//
        //试题描述                                    //
        //=======================================//
        if(!verify_value($row["description"], "empty", "", "")){

        }else{
            if($row["unit"]==1){
                //试题描述加框(当试题单元为 片段阅读的时候)
                $row["description"]="[#K][/#]".$row["description"];
            }
        }

        //题型
        $req_answer = "";
        $row['kind'] = "";
        if ($type != '1') {
            if (!verify_value($row["kind1"], "empty", "", "")) {
                //$err_empty = $this->cattext($err_empty, $header["kind1"]);
            } else {
                $subcode01 = M("subcode")->field("value,code")->where("name='" . $row["kind1"] . "' " . " and " . "type='question:kind'")->find();
                if (!$subcode01) {
                    $err_exist = $this->cattext($err_exist, $header["kind1"] . "[" . $row["kind1"] . "]定义不存在");
                } else {
                    $row['kind'] = $subcode01['code'];
                    $req_answer = $subcode01['value'];
                }
            }
            $row['kind']=trim($row['kind']);

            $select_count = 0;

            if ($row["answerA"] . $row["answerB"] . $row["answerC"] . $row["answerD"]) {
                if ($row["answerD"]) {
                    if (!$row["answerA"] || !$row["answerB"] || !$row["answerC"]) {
                        $err_type = $this->cattext($err_type, "选项ABC存在空选项");
                    }
                    $select_count = 4;
                } else if ($row["answerC"]) {
                    if (!$row["answerA"] || !$row["answerB"]) {
                        $err_type = $this->cattext($err_type, "选项AB存在空选项");
                    }
                    $select_count = 3;
                } else {
                    if (!$row["answerA"] || !$row["answerB"]) {
                        $err_type = $this->cattext($err_type, "选项AB存在空选项");
                    }
                    $select_count = 2;
                }
            }

            /*if (!$req_answer) {
                if ($row["answer"]) {
                    $err_type = $this->cattext($err_type, $header["kind1"] . "[" . $row['kind1'] . "]未要求答案");
                }
            } else {
                if (!$row["answer"]) {
                    $err_type = $this->cattext($err_type, $header["kind1"] . "[" . $row['kind1'] . "]要求答案");
                }
            }*/


            if ($row["answer"] && $select_count > 0) {
                //转大写
                $row["answer"] = strtoupper($row["answer"]);
                switch ($row["kind"]) {
                    case "xz":
                        if (($select_count == 4 && $row["answer"] != "A" && $row["answer"] != "B" && $row["answer"] != "C" && $row["answer"] != "D") ||
                            ($select_count == 3 && $row["answer"] != "A" && $row["answer"] != "B" && $row["answer"] != "C") ||
                            ($select_count == 2 && $row["answer"] != "A" && $row["answer"] != "B")) {
                            $err_type = $this->cattext($err_type, "选项与答案不配套");
                        }
                        break;
                    case "dx":
                        //判断多选题 答案是否在 选项内  4个选项是abcd组合，3个选项是abc组合，2个选项是ab组合
                        //答案去重 AAA
                        //$row["answer"] = $this->question_trim_duplicate($row["answer"]);
                        $row["answer"] = preg_replace('/(.)\1+/u', '$1', $row["answer"]);
                        if (($select_count == 4 && $this->question_checkexist("ABCD", $row["answer"])) ||
                            ($select_count == 3 && $this->question_checkexist("ABC", $row["answer"])) ||
                            ($select_count == 2 && $this->question_checkexist("AB", $row["answer"]))) {
                            $err_type = $this->cattext($err_type, "选项与答案不配套");
                        }
                        break;
                }
            }

            $boolen=true;
            $f = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . $showtime = date("Y-m-d") . "/" .$zipnamepath."/". $row["answerA"];

            if (!file_exists($f)) {
                $boolen=false;
            }

            /**
             * 首先拿选项中的内容去找有没有图片
             */
            if($boolen){

            if ($row["answerA"]) {
                //如果图像不为空（需要验证必须在上传目录中存在）
                if (is_file($row["img"])) {
                    //图片在路径中存在
                } else {
                    //判断图像是否在上传并解压的目录下面
                    $f = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . $showtime = date("Y-m-d") . "/" .$zipnamepath."/". $row["answerA"];

                    if (!file_exists($f)) {
                        //var_dump($f);
                        //目标路径图片不存在
                        $err_empty = $this->cattext($err_empty, "图片不存在");

                    } else {

                        //旧文件地址
                        $oldfile = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . $showtime = date("Y-m-d") . "/" .$zipnamepath."/". $row["answerA"];
                        $newfile = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . $row["answerA"];
                        copy($oldfile, $newfile); //拷贝到新目录
                        //unlink($oldfile);//删除旧目录下的文件
                        $nickname = uniqid();
                        $extendname = substr($row["answerA"], -4);
                        $newname = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . date("Y-m-d") . $nickname . $extendname;
                        rename($_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . $row["answerA"], $newname);
                        //名一个新的名字
                        $Aimgurl = "/" . "Uploads" . "/" . "img" . "/" . date("Y-m-d") . $nickname . $extendname."|";
                    }
                }

            }
            if ($row["answerB"]) {
                //如果图像不为空（需要验证必须在上传目录中存在）
                if (is_file($row["img"])) {
                    //图片在路径中存在
                } else {
                    //判断图像是否在上传并解压的目录下面
                    $f = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . $showtime = date("Y-m-d") . "/" .$zipnamepath."/". $row["answerB"];

                    if (!file_exists($f)) {
                        //var_dump($f);
                        //目标路径图片不存在
                        $err_empty = $this->cattext($err_empty, "图片不存在");

                    } else {

                        //旧文件地址
                        $oldfile = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . $showtime = date("Y-m-d") . "/" .$zipnamepath."/". $row["answerB"];
                        $newfile = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . $row["answerB"];
                        copy($oldfile, $newfile); //拷贝到新目录
                        //unlink($oldfile);//删除旧目录下的文件
                        $nickname = uniqid();
                        $extendname = substr($row["answerB"], -4);
                        $newname = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . date("Y-m-d") . $nickname . $extendname;
                        rename($_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . $row["answerB"], $newname);
                        //名一个新的名字
                        $Bimgurl = "/" . "Uploads" . "/" . "img" . "/" . date("Y-m-d") . $nickname . $extendname."|";
                    }
                }

            }
            if ($row["answerC"]) {
                //如果图像不为空（需要验证必须在上传目录中存在）
                if (is_file($row["img"])) {
                    //图片在路径中存在
                } else {
                    //判断图像是否在上传并解压的目录下面
                    $f = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . $showtime = date("Y-m-d") . "/" .$zipnamepath."/". $row["answerC"];

                    if (!file_exists($f)) {
                        //var_dump($f);
                        //目标路径图片不存在
                        $err_empty = $this->cattext($err_empty, "图片不存在");

                    } else {

                        //旧文件地址
                        $oldfile = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . $showtime = date("Y-m-d") . "/" .$zipnamepath."/". $row["answerC"];
                        $newfile = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . $row["answerC"];
                        copy($oldfile, $newfile); //拷贝到新目录
                        //unlink($oldfile);//删除旧目录下的文件
                        $nickname = uniqid();
                        $extendname = substr($row["answerC"], -4);
                        $newname = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . date("Y-m-d") . $nickname . $extendname;
                        rename($_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . $row["answerC"], $newname);
                        //名一个新的名字
                        $Cimgurl= "/" . "Uploads" . "/" . "img" . "/" . date("Y-m-d") . $nickname . $extendname."|";
                    }
                }

            }
            if ($row["answerD"]) {
                //如果图像不为空（需要验证必须在上传目录中存在）
                if (is_file($row["img"])) {
                    //图片在路径中存在
                } else {
                    //判断图像是否在上传并解压的目录下面
                    $f = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . $showtime = date("Y-m-d") . "/" .$zipnamepath."/". $row["answerD"];

                    if (!file_exists($f)) {
                        //var_dump($f);
                        //目标路径图片不存在
                        $err_empty = $this->cattext($err_empty, "图片不存在");

                    } else {

                        //旧文件地址
                        $oldfile = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . $showtime = date("Y-m-d") . "/" .$zipnamepath."/". $row["answerD"];
                        $newfile = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . $row["answerD"];
                        copy($oldfile, $newfile); //拷贝到新目录
                        //unlink($oldfile);//删除旧目录下的文件
                        $nickname = uniqid();
                        $extendname = substr($row["answerD"], -4);
                        $newname = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . date("Y-m-d") . $nickname . $extendname;
                        rename($_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . $row["answerD"], $newname);
                        //名一个新的名字
                        $Dimgurl = "/" . "Uploads" . "/" . "img" . "/" . date("Y-m-d") . $nickname . $extendname;
                    }
                }

            }

                $row["quiz"]=$Aimgurl.$Bimgurl.$Cimgurl.$Dimgurl;
            }


            /**
             * 判断选项是否是图片（如果是的话，将不进行下一步）
             */
            if($boolen===false){

            //判断选项有没有ABCD没有加上Question_trim
            if (substr($row["answerA"], 0, 1) != "A") {
                $row["answerA"] = $this->Question_trim($row["answerA"]);
                $row["answerA"] = "A  " . $row["answerA"];
                $row["answerA"] = str_replace("|", "", $row["answerA"]);
                $row["answerA"]=trim($row["answerA"]);
                if($this->CheckDefine( $row["answerA"],"")!==true)
                    $err_type = $this->cattext($err_type, $header["answer"].":".$this->CheckDefine( $row["answerA"],""));
            }
            if (substr($row["answerB"], 0, 1) != "B") {
                $row["answerB"] = $this->Question_trim($row["answerB"]);
                $row["answerB"] = "B  " . $row["answerB"];
                $row["answerB"] = str_replace("|", "", $row["answerB"]);
                $row["answerB"]=trim($row["answerB"]);
                if($this->CheckDefine( $row["answerB"],"")!==true)
                    $err_type = $this->cattext($err_type, $header["answer"].":".$this->CheckDefine( $row["answerB"],""));
            }
            if (substr($row["answerC"], 0, 1) != "C") {
                $row["answerC"] = $this->Question_trim($row["answerC"]);//文字整理
                $row["answerC"] = "C  " . $row["answerC"];
                $row["answerC"] = str_replace("|", "", $row["answerC"]);
                $row["answerC"]=trim($row["answerC"]);
                if($this->CheckDefine( $row["answerC"],"")!==true)
                    $err_type = $this->cattext($err_type, $header["answer"].":".$this->CheckDefine( $row["answerC"],""));

            }
            if (substr($row["answerD"], 0, 1) != "D") {
                $row["answerD"] = $this->Question_trim($row["answerD"]);
                $row["answerD"] = "D  " . $row["answerD"];
                $row["answerD"] = str_replace("|", "", $row["answerD"]);
                $row["answerD"]=trim($row["answerD"]);
                if($this->CheckDefine( $row["answerD"],"")!==true)
                    $err_type = $this->cattext($err_type, $header["answer"].":".$this->CheckDefine( $row["answerD"],""));

            }

            //将答案使用管道符拼接起来
            if ($select_count > 0) {
                $quiz = $row["answerA"] . "|" . $row["answerB"];
                if ($row["answerD"] != "") {
                    $quiz .= "|" . $row["answerC"] . "|" . $row["answerD"];
                } else if ($row["answerC"] != "") {
                    $quiz .= "|" . $row["answerC"];
                }
                $row["quiz"] = $quiz;
            }
        }

        }

        //解析
        if (verify_value($row["analysis"], "empty", "", ""))
            if($this->CheckDefine( $row["analysis"],"")!==true)
                $err_type = $this->cattext($err_type, $header["analysis"].":".$this->CheckDefine( $row["analysis"],""));


        //判断图像路径是否为空
        if ($row["img"]) {
            //如果图像不为空（需要验证必须在上传目录中存在）
                    if (is_file($row["img"])) {
                //图片在路径中存在
            } else {
                //判断图像是否在上传并解压的目录下面
                $f = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . $showtime = date("Y-m-d") . "/" .$zipnamepath."/". $row["img"];

                if (!file_exists($f)) {
                    //var_dump($f);
                    //目标路径图片不存在
                    $err_empty = $this->cattext($err_empty, "图片不存在");

                } else {
                    //旧文件地址
                    $oldfile = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . $showtime = date("Y-m-d") . "/" .$zipnamepath."/". $row["img"];
                    $newfile = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . $row["img"];
                    copy($oldfile, $newfile); //拷贝到新目录
                    //unlink($oldfile);//删除旧目录下的文件
                    $nickname = uniqid();
                    $extendname = substr($row["img"], -4);
                    $newname = $_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . date("Y-m-d") . $nickname . $extendname;
                    rename($_SERVER['DOCUMENT_ROOT'] . "/" . "Uploads" . "/" . "img" . "/" . $row["img"], $newname);
                    //名一个新的名字
                    $row["img"] = "/" . "Uploads" . "/" . "img" . "/" . date("Y-m-d") . $nickname . $extendname;
                }
            }

        }
        $err = "";
        if ($err_empty || $err_exist || $err_type) {
            $err .= "第 " . ($k) . " 行校验失败\n";
            if ($err_empty) $err .= "    数据为空: " . $err_empty . "\n";
            if ($err_exist) $err .= "    定义非法：" . $err_exist . "\n";
            if ($err_type) $err .= "    校验非法: " . $err_type . "\n";
        }

        return $err;
    }

    private function question_save($model, $data, $header, &$result, $checkbox_value)
    {
        $model->startTrans();

        $result1 = true;
        $result = false;
        $orig = array();


        //首行为标准行 或 套题行
        $origid = $data[0]["id"];
        $code = $data[0]["code"];
        $type = $data[0]["type"];

         if (!$code) {
             $code = Gen_Number("question", "A", "A", $seqno);
             //$code = $data[0]["seq"];
	

             if ($origid) {
                 $orig = $model->find($origid);
                 if ($orig && $type == '1') {
                     $model->where("parent_id=" . $origid)->delete();
                 }
             }
         }

        $addrow = $orig ? false : true;
        $rowno = "";
        $parent_id = "0";
        foreach ($data as $l => $row) {
            $input = array();
            $rowno .= ($rowno ? "," : "") . $row["excelno"];
            if ($row["type"] == "2") {
                $orig = array();
                $input["code"] = $row["seq"] . "." . $l;
                $input["name"] = "子题" . $l;
            } else {
                // date:  2019-6-25  如果导入试题中没有编码的话，按照系统参数进行累加
               // $input["code"] = $code;
                $input["code"] = $row["seq"];
                $input["name"] = $row["type"] == "0" ? "标准题" : "套题";
            }
            if ($row["type"] == "1") {
                $row["childs"] = count($data) - 1;
            } else {
                $row["childs"] = "0";
            }

            //导入字段
            //$input["code"] = $row["seq"];
            $input["parent_id"] = $parent_id;
            $input["type"] = $row["type"];
            $input["category_name"] = $row["category_name"];
            $input["category_code"] = $row["category_code"];
            $input["img"] = $row["img"];

            /**
             * @date 2019-6-20
             * 新增的试题单元字段列
             */
            $input["unit"] = $row["unit"];

            $input["kind"] = $row["kind"];
            $input["stem"] = $row["stem"];
            $input["quiz"] = $row["quiz"];
            $input["answer"] = $row["answer"];
            $input["analysis"] = $row["analysis"];
            $input["childs"] = $row["childs"];

            $input["description"] = $row["description"];
            $input["status"] = "1";

            //modify_user/time字段
            $input["modify_user"] = session(C("USER_AUTH_KEY"));
            $input["modify_time"] = date('Y-m-d H:i:s.n');
            $input["import_time"] = date('Y-m-d H:i:s.n');
            //检查是否存在
            $ret = M("question")//指定要查的表的表名
            ->field("id,type")//要查的列名
            ->where("code='" . $row["seq"] . "'")
                ->find();//从数据库中查询条件是code知识点代码


            //类型是小题或者内容全的执行新增
            if (($row["type"] == "2" || $addrow) && !$ret) {
                //新增
                $input["create_user"] = session(C("USER_AUTH_KEY"));
                $input["create_time"] = date('Y-m-d H:i:s.n');
                $result = $id = $model->add($input);
            } else {
                //如果前端的状态为1则覆盖
                if ($checkbox_value == "1") {

                    if ($row["type"] == '0') {//如果是标准题(直接覆盖)
                        $result = $model->where("code='" . $row["seq"] . "'")->save($input);
                    }
                    if ($row["type"] == '1') {//如果是套题(新增套题头，删除掉下面的子題)
                        $result = $model->where("code='" . $row["seq"] . "'")->save($input);
                        M("question")->where("parent_id='" . $ret["id"] . "'")->delete();//将子題全部删除
                    }
                    if ($row["type"] == '2') {//
                        $ret2 = M("question")//指定要查的表的表名
                        ->field("id")//要查的列名
                        ->where("code='" . $row["seq"] . "' and type='1'")
                            ->find();//从数据库中查询条件是code知识点代码
                        $input["parent_id"] = $ret2["id"];
                        $result = $model->add($input);
                    }

                }else{
                    if ($row["type"] == '2') {//
                        $ret2 = M("question")//指定要查的表的表名
                        ->field("id")//要查的列名
                        ->where("code='" . $row["seq"] . "' and type='1'")
                            ->find();//从数据库中查询条件是code知识点代码
                        $input["parent_id"] = $ret2["id"];
                        $result = $model->add($input);
                    }
                }

            }

            if ($row["type"] != '2' && !$ret) {
                //建立相似度对比表
                $input = array();
                $input["id"] = $id;
                $input["code"] = $row["seq"];
                $input["kind"] = $row['type'] == "1" ? "taoti" : $row['kind'];
                $input["content"] = $row['trim'];
                if ($addrow)
                    $result1 = M("question_similar")->add($input);
                else
                    $result1 = M("question_similar")->where("id=$id")->save($input);
            }

            if ($row["type"] == '1' && !$ret) {
                $parent_id = $id;
            }
            if (!$result) {
                break;
            }
        }

        //建立操作日志
        if ($addrow)
            $result2 = createLogCommon('question', $id, '数据导入(新增)', $orig, '', '', 'code', $header);
        else
            $result2 = createLogCommon('question', $id, '数据导入(覆盖)', $orig, '', '', 'code', $header);


        if ($result) {
            $model->commit();

        } else {
            $model->rollback();

        }

        $err = ($result ? "主档" : "") . "|" . ($result1 ? "相似" : "") . "|" . ($result2 ? "日志" : "");
        return "第 $rowno 行导入" . ($result ? "成功" : "失败(" . $err . ")") . "\n";
    }


    private function question_similar($similar_value, $data, &$trim, $lcs)
    {
        $trim = "";
        $row_no = $data[0]["excelno"];
        $kind = $data[0]["kind"];
        if (count($data) > 1) {
            $kind = "taoti";
        }

        //拼接题干与选项
        $punctuation = array("，", "：", "“", " ", "、", "。", "？", "）"
        , "的", "（", ",", ".", "！", "【", "】", "；", "_", "”", "《", "》"
        , "|", "[#b]", "[/#b]", "[#楷体]", "[#宋体]", "[#黑体]", "[#F12]"
        , "[#F16]", "[#F24]", "[#B]", "[#U]", "[#D]", "[#K]", "[#T5]", "[#T10]", "[#T20]", "[/#T5]", "[/#T10]", "[/#T20]",
            "[#TL]", "[#PL]", "[#PC]", "[#PR]", "[#P]", "[/#楷体]", "[/#宋体]", "[/#黑体]", "[/#F12]"
        , "[/#F16]", "[/#F24]", "[/#B]", "[/#U]", "[/#D]", "[/#K]", "[/#Tn]",
            "[/#TL]", "[/#PL]", "[/#PC]","……","[/#PR]", "[/#P]", "=", "{", "}", "[", "]", "．");

        $new = "";
        foreach ($data as $k => $row) {
            $new .= $data[$k]["stem"] . $data[$k]["answerA"] . $data[$k]["answerB"] . $data[$k]["answerC"] . $data[$k]["answerD"] . $data[$k]["answer"];
        }

        $trim = str_replace($punctuation, "", $new);


        //查询
        $ret = M("question_similar")
            ->field("code,content")//要查的列名
            ->where("kind='" . $kind . "' ")->select();

        foreach ($ret as $o => $cc) {
            if ($trim == $cc["content"]) {
                $threshold = 1;

            } else {
                if(strlen($trim)<220 && strlen($cc["content"])<220){
                    $threshold=0.5;
                    //$threshold = $lcs->getSimilar($trim, $cc["content"]);
                    //$threshold = $lcs->getSimilar("灯迷又名文虎也称猜灯是我国特有一种雅俗共赏民间风俗浓郁文字联想游戏链面牛不出头打一下列生肖是#AhahajpgBhahajpgChahajpgDhah", "填入文中横线上诗句是A初闻涕泪满衣裳B感时花溅泪C玉容寂寞泪阑干D回看血泪相和流A");

                }else{
                    $threshold=0.5;
                    //$threshold = $lcs->getSimilar(substr($trim,0,60),substr($cc["content"],0,60));
                }
            }

            //判断相似度 大于阀值（则报错）

            if ($threshold > $similar_value) {
                //将从相似度表中拿到的id去题库表中根据id将code（编码）取出来

                return "第 $row_no 行与题库编码为：[" . $cc['code'] . "]";
            }
        }



        return "";

    }

    private function find_by_array_flip($array, $find)
    {
        $array = array_flip($array);
        return $array[$find];
    }





    public function list_dir($dir){
        $result = array();
        if (is_dir($dir)){
            $file_dir = scandir($dir);
            foreach($file_dir as $key=>$file){

                if ($file == '.' || $file == '..'){
                    continue;
                }
                elseif (is_dir($dir.$file)){

                    $result = array_merge($result, $this->list_dir($dir.$file.'/'));
                }
                else{

                    array_push($result, $dir.$file);
                }
            }
        }
        return $result;
    }



    private function import_save($data)
    {

        W("LCS");
        $lcs = new LCSWidget();

        set_time_limit(0);
        $orderid = I("request.orderid/d");


        $checkbox_value = $_POST["checkbox_value"];


        $file = $_FILES;
        //写入日志的时候附上csv的名字
        $csvname=$file["import"]["name"];

        $zipname=$file["img"]["name"];

        //var_dump($file);
        /* ========================================== */
        /*        上传文件 - 判断文件类型csv读取内容       */
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

        //校验上传图片压缩包合法性
        if (isset($file["img"]) && $file["img"]["error"] == 0) {
                if (is_uploaded_file($file['img']['tmp_name'])) {
                if (substr($file['img']['name'], -4) != ".zip") {
                    $this->ajaxResult("导入失败:请上传zip或者rar文件");
                }
            }
        }

        //上传图片压缩包
        if ($file['img'] && $file['img']['error'] == 0) {
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 31457283145728;// 设置附件上传大小
            $upload->exts = array("rar", "zip");// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
            $upload->savePath = ''; // 设置附件上传（子）目录
            // 上传文件
            $plan = $upload->upload();
            if ($plan) {

                //$savename=$plan["img"]["savename"];
                //$plan["img"]["savename"]=$file["img"]["name"];
                //文件路径 './Uploads/'.$plan["img"]["savepath"].$plan["img"]["savename"]
                $zip = new ZipArchive;


                //获取当前项目在电脑中的路径
                $res = $zip->open($_SERVER['DOCUMENT_ROOT'] . '/Uploads/' . $plan["img"]["savepath"] . $plan["img"]["savename"]);

                $filename = iconv("utf-8","gb2312",$_SERVER['DOCUMENT_ROOT'] . '/Uploads/' . $plan["img"]["savepath"] . $plan["img"]["savename"]);
                $path = iconv("utf-8","gb2312",$_SERVER['DOCUMENT_ROOT'] . '/Uploads/' . $plan["img"]["savepath"] . $plan["img"]["savename"]);
                $resource = zip_open($filename);

                /*while ($dir_resource = zip_read($resource)) {

                    $file_name = $path.zip_entry_name($dir_resource);
                    if($file_name){

                    }
                }*/

                // date : 2019-6-25   第一次尝试
                /*$filename = iconv("utf-8","gb2312",$_SERVER['DOCUMENT_ROOT'] . '/Uploads/' . $plan["img"]["savepath"] . $plan["img"]["savename"]);
                $path = iconv("utf-8","gb2312",$_SERVER['DOCUMENT_ROOT'] . '/Uploads/' . $plan["img"]["savepath"] . $plan["img"]["savename"]);
                $resource = zip_open($filename);
                $i = 1;
                while ($dir_resource = zip_read($resource)) {

                    if (zip_entry_open($resource,$dir_resource)) {
                        //获取当前项目的名称,即压缩包里面当前对应的文件名
                        $file_name = $path.zip_entry_name($dir_resource);
                        //以最后一个“/”分割,再用字符串截取出路径部分
                        $file_path = substr($file_name,0,strrpos($file_name, "/"));
                        if(!is_dir($file_path)){
                            mkdir($file_path,0777,true);
                        }
                        //如果不是目录，则写入文件
                        if(!is_dir($file_name)){
                            //读取这个文件
                            $file_size = zip_entry_filesize($dir_resource);
                            //最大读取6M，如果文件过大，跳过解压，继续下一个
                            if($file_size<(1024*1024*30)){
                                $file_content = zip_entry_read($dir_resource,$file_size);
                                file_put_contents($file_name,$file_content);
                            }else{
                                echo "<p> ".$i++." 此文件已被跳过，原因：文件过大， -> ".iconv("gb2312","utf-8",$file_name)." </p>";
                            }
                        }
                        zip_entry_close($dir_resource);
                    }
                }*/


                //date: 2019-6-25  第二次尝试
                /*$zipfile=$_SERVER['DOCUMENT_ROOT'] . '/Uploads/' . $plan["img"]["savepath"] . $plan["img"]["savename"];
                $res = $zip->open($zipfile);

                $toDir = $_SERVER['DOCUMENT_ROOT'] ."/Uploads/test";

                if(!file_exists($toDir)) {
                    mkdir($toDir);
                }

                $docnum = $zip->numFiles;

                for($i = 0; $i < $docnum; $i++) {
                    $statInfo = $zip->statIndex($i);
                    if($statInfo['crc'] == 0) {
                        //新建目录
                        mkdir($toDir.'/'.substr($statInfo['name'], 0,-1));
                    } else {
                        //拷贝文件
                        copy('zip://'.$zipfile.'#'.$statInfo['name'], $toDir.'/'.$statInfo['name']);
                    }
                }*/


                //date: 2019-6-25  第三次尝试
                /*$fileName = $plan["img"]["savename"];
                $uploads_dir = "/Uploads/".$plan["img"]["savepath"];
                $zipName  = $_SERVER['DOCUMENT_ROOT'] . '/Uploads/' . $plan["img"]["savepath"] . $plan["img"]["savename"];
                $toDir = $_SERVER['DOCUMENT_ROOT'].$uploads_dir.'/'.substr($fileName,0,strlen($fileName)-4);

                $res = $zip->open(iconv ( 'UTF-8', 'GB2312', $zipName));

                if ($res === TRUE){
                    if (!is_dir(iconv ( 'UTF-8', 'GB2312', $toDir))) {
                        mkdir(iconv ( 'UTF-8', 'GB2312', $toDir), 0777, true);
                    }
                    $docnum = $zip->numFiles;

                    for($i = 0; $i < $docnum; $i++) {
                        $statInfo = $zip->statIndex($i);
                        if($statInfo['crc'] == 0) {
                            //新建目录
                            mkdir(iconv ( 'UTF-8', 'GB2312', $toDir.'/'.$statInfo['name']), 0777, true);
                        } else {
                            //拷贝文件,特别的改动，iconv的位置决定copy能不能work
                            if(copy('zip://'.iconv ( 'UTF-8', 'GB2312', $zipName).'#'.$statInfo['name'], iconv ( 'UTF-8', 'GB2312', $toDir.'/'.$statInfo['name'])) == false){
                                echo 'faild to copy';
                            }
                        }
                    }
                    print_r(scandir(iconv ( 'UTF-8', 'GB2312',$toDir)));
                    $zip->close();//关闭处理的zip文件
                }
                else{
                    echo 'failed, code:'.$res.'<br>';
                }*/

                //echo $_SERVER['DOCUMENT_ROOT'].'/Uploads/'.$plan["img"]["savepath"].$plan["img"]["savename"];

                if ($res === TRUE) {
                    //解压缩到test文件夹

                    $zip->extractTo($_SERVER['DOCUMENT_ROOT'] . '/Uploads/' . $plan["img"]["savepath"]);
                    $dir=$_SERVER['DOCUMENT_ROOT'] . '/Uploads/' . $plan["img"]["savepath"]."import";
                    $files = array();
                    if($head = opendir($dir)){

                        while(($file = readdir($head)) !== false){

                            if($file != ".." && $file!="."){
                                if(is_dir($file)){
                                    $files[$file]=bianli1($dir.'/'.$file);
                                }else{
                                    $files[]=$file;
                                    $cccc=getfile($_SERVER['DOCUMENT_ROOT'] . '/Uploads/' . $plan["img"]["savepath"]."import".$file);
                                }
                            }

                        }
                    }
                    closedir($head);
                    $this->ajaxResult("图片上传成功");
                    $zip->close();
                } else {
                    $this->ajaxResult("图片上传失败");
                }
            }
        }


        /* ==================================================== */
        /* 上传文件 - 标题行列内容、列数、标题行、数据起始行    */
        /* ==================================================== */
        $header = array(
            "seq" => "编码",
            "unit"=>"试题单元",
            "kind1" => "题目类型",

            "category_name" => "知识点",
            "stem" => "题干",
            "description" => "试题描述",

            "answerA" => "A",
            "answerB" => "B",
            "answerC" => "C",

            "answerD" => "D",
            /*"code" => "编码",
            "name" => "名称",
            "kind" => "题型",
            "quiz" => "设问",*/
            "answer" => "答案",

            "analysis" => "解析",
            //"childs" => "小题数",
            "img" => "图像",
        );

        $row_header = 1;
        $row_data = 3;
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
                $importdatas[$n][$field[$i]] = trim(mb_convert_encoding($row[$i], 'utf-8', 'gbk'));
            }
            $n++;
        }
        fclose($h);
        if ($n < $row_data) $this->ajaxResult("导入失败:文件内没有数据");
        /* =========================== */
        /* 上传文件 - 标题校验         */
        /* =========================== */

        $sumnum = $n;

        $err = "";
        foreach ($importdatas[$row_header] as $key => $value) {
            if ($header[$key] != $value) $err = $this->cattext($err, $value);
        }
        if ($err) $this->ajaxResult("导入失败:标题列[$err]与模板定义不一致");

        /* =========================== */
        /* 上传文件 - 数据校验         */
        /* =========================== */
        //获取元素在数组中的位置下标索引
        $errs = "";
        $lastseq = "";
        $import = array();
        $codearr = array();


        foreach ($importdatas as $k => $r) {
            $row = $r;
            //将每一次的code存入$codearr数组中，之后的每次都要比较当次的code与数组中的code有没有重复的
            if ($k >= $row_data) {
                $row["excelno"] = $k;
                $row["type"] = '0';
                if ($row["seq"] != "") {
                    if ($lastseq != "" && $lastseq == $row["seq"]) {  //判断如果相同则为套题
                        $row["type"] = '2';
                    } else {
                        //判断的
                        if (in_array($row["seq"], $codearr)) {
                            $this->ajaxResult("code编码不合法，重复");
                        }
                        $lastseq = $row["seq"];
                        if ($k < $sumnum && $importdatas[$k + 1]["seq"] == $lastseq) {//小题编号
                            $row["type"] = '1';
                        }
                    }

                } else {
                    $lastseq = "";
                }

                $err = $this->question_verify($header, $row,$csvname);
                $errs .=$err ;

                //暂时启用有问题就报错，进行修改, 以后改成报错记录文件，下载下来
                // date  :2019-6-20  要显示所有的日志内容
                //if ($err) $this->ajaxError($err);

                if (!$err) {
                    $import[] = $row;
                }
            }
            $codearr[] = $row["seq"];
        }

        $file  = 'log.docx';


        if ($errs) {
            //将报错信息全部记录在日志中
            file_put_contents($file,  "\n\n".date("Y-m-d h:i:sa")."   ".$csvname ."\n". $errs,FILE_APPEND);
            $this->ajaxError($errs."已经记录日志文件");
            header('Content-Disposition:attachment;filename="'.urlencode("C:\xampp\htdocs\project\exploitproject\学库\exploit1\websource\log.txt").'"');
        }

        /* =========================== */
        /* 校验成功后进行套题合并处理
        /* =========================== */
        $question = array();
        $taoti = array();
        foreach ($import as $k => $row) {
            if ($row["type"] == "2") {
                $taoti[] = $row;
            } else {
                if ($taoti) $question[] = $taoti;
                $taoti = array();
                if ($row["type"] == "0") {
                    $question[] = array($row);
                } else {
                    $taoti[] = $row;
                }
            }
        }
        if ($taoti) $question[] = $taoti;

        /* =========================== */
        /* 上传文件 - 数据相似度阀值校验    */
        /* =========================== */
        $similar_value = getSystemParameter("similar_value");     //将数据库中的阈值取出
        if (!$similar_value || $similar_value < 0) {
            $this->ajaxError("相似度阀值没有设置 ");
        }
            foreach ($question as $k => $row) {
            $err = $this->question_similar($similar_value, $row,$trim , $lcs);

            $errs .= $err;

            //暂时启用有问题就报错，进行修改, 以后改成报错记录文件，下载下来
            //if ($err) $this->ajaxError($err . "相似度超阀值");

            $question[$k][0]['trim'] = $trim;
        }
        if ($errs) {
            $this->ajaxError("相似度超阀值\n" . $errs);
        }


        /* =========================== */
        /* 上传文件 - 数据存储         */
        /* =========================== */
        $success = 0;
        $failed = 0;
        $infos = "";
        $model = M("question");
        /**
         * 以上校验全部通过之后才会将全部的试题导入数据库
         */
        foreach ($question as $rows) {
            $info = $this->question_save($model, $rows, $header, $result, $checkbox_value);
            if ($result)
                $success += count($rows);
            else
                $failed += count($rows);
        }
        $total = $success + $failed;

        $this->ajax_hideConfirm();
        $this->ajax_closePopup($data ['funcid']);
        $this->ajax_refresh($data ['pfuncid']);
        $this->ajaxResult("本次导入 $total 条, 成功 $success 条, 失败 $failed 条\n" . $infos);
        die;
    }

//// source for import - end ////
//// source for status_on - begin ////
    function status_on($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("题库参数不存在");
        }
        $search = M('question')->find($id);
        if (!$search)
            $this->ajaxResult("题库不存在");
        if ($search['status'] == '7') {
            $this->ajaxResult("题库已取消");
        }
        if ($search['status'] != '0') {
            $this->ajaxResult("题库状态已变化，请重新处理");
        }
        $data["search"] = $search;
        $data["id"] = $data["search"]["id"];
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Question:status_on");
        echo $html;
    }

    private function status_on_save($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("题库参数不存在");
        }
        //id存在时判断数据库内数据是否存在
        $orig = M("question")->where("id='%d'", array($id))->find();
        if (empty($orig)) {
            $this->ajaxError("题库数据不存在");
        }
        if ($orig['status'] == '7') {
            $this->ajaxResult("题库已取消");
        }
        if ($orig['status'] != '0') {
            $this->ajaxResult("题库状态已变化，请重新处理");
        }
        $reason_tag = I("request.reason_tag");
        $reason = I("request.reason");
        $statusdesc = "状态[有效], ";
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
        $model = M("question");
        $model->startTrans();
        //按主键更新数据
        $result = $model->where("id = $id")->save($input);
        //建立操作日志
        $result = $result && createLogCommon('question', $id, '状态调整', $content);
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
            echo json_encode(array("msg" => message("题库保存发生错误")));
            die;
        }
        //完成后关闭并刷新父窗口
        $this->ajaxReturn($data ['pfuncid'], $data ['funcid'], "refresh", "", "closepopup");
        die;
    }

//// source for status_on - end ////
//// source for status_off - begin ////
    private function status_off($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("题库参数不存在");
        }
        $search = M('question')->find($id);
        if (!$search)
            $this->ajaxResult("题库不存在");
        if ($search['status'] == '7') {
            $this->ajaxResult("题库已取消");
        }
        if ($search['status'] != '1') {
            $this->ajaxResult("题库状态已变化，请重新处理");
        }
        $data["search"] = $search;
        $data["id"] = $data["search"]["id"];
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Question:status_off");
        echo $html;
    }

    private function status_off_save($data)
    {
        $id = I("request.id/d");
        if (!$id) {
            $this->ajaxResult("题库参数不存在");
        }
        //id存在时判断数据库内数据是否存在
        $orig = M("question")->where("id='%d'", array($id))->find();
        if (empty($orig)) {
            $this->ajaxError("题库数据不存在");
        }
        if ($orig['status'] == '7') {
            $this->ajaxResult("题库已取消");
        }
        if ($orig['status'] != '1') {
            $this->ajaxResult("题库状态已变化，请重新处理");
        }
        $reason_tag = I("request.reason_tag");
        $reason = I("request.reason");
        if (!($reason_tag . $reason)) {
            $this->ajaxResult("题库状态回退，需注明原因");
        }
        $statusdesc = "退回状态[无效], ";
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
        $model = M("question");
        $model->startTrans();
        //按主键更新数据
        $result = $model->where("id = $id")->save($input);
        //建立操作日志
        $result = $result && createLogCommon('question', $id, '状态调整', $content);
        if ($result) {
            $model->commit();
        } else {
            $model->rollback();
            echo json_encode(array("msg" => message("题库保存发生错误")));
            die;
        }
        //完成后关闭并刷新父窗口
        $this->ajaxReturn($data ['pfuncid'], $data ['funcid'], "refresh", "", "closepopup");
        die;
    }

//// source for status_off - end ////
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
            $this->ajaxError("题库查询参数非法");
        }

        //condition
        $condition = "";
        $joinsql = "";
        //select search fields
        $selectmasterfields = "@question.*";

        $selectmasterfields .= ",a.code question_code ";


        $sql = table("select #selectfields# from @question  #join# Where #viewkey# #condition# #orderby#");
        $joinsql .= table(" LEFT JOIN @question a ON a.id=@question.parent_id ");
        if ($data["id"])
            $viewkey = table("@question.id=$data[id]");
        else
            $viewkey = table("@question.code='$data[no]'");
        $sql = str_replace("#selectfields#", table($selectmasterfields), $sql);
        $sql = str_replace("#join#", $joinsql, $sql);
        $sql = str_replace("#viewkey#", $viewkey, $sql);
        $sql = str_replace("#condition#", $condition, $sql);
        $sql = str_replace("#orderby#", "", $sql);
        $search = M()->query($sql);
        if (!$search) {
            $this->ajaxError("题库信息不存在");
        }
        $data["search"] = current($search);


        //按tabsheet - 开始
        $data["id"] = $data["search"]["id"];
        $data["search"]["_tab"] = $this->tabsheet_check(I("request._tab"));
        $page_size = $data["pagesize"];//session("Question-".$data["search"]["_tab"]."-PageSize");
        switch ($data["search"]["_tab"]) {

            case "shijuanmingxi":
                $data = $this->tab_shijuanmingxi_exam_detail($page_size, $data);
                break;
            case "caozuorizhi":
                $data = $this->tab_caozuorizhi_log_common($page_size, $data);
                break;
            case "showview2":
                $data = $this->tab_showview2($page_size, $data);
                break;
        }
        $data["search"]["_tab_" . $data["search"]["_tab"] . "_p"] = $data["p"];
        $data["search"]["_tab_" . $data["search"]["_tab"] . "_psize"] = $data["page_size"];
        //session("Question-".$data["search"]["_tab"]."-PageSize", $data["page_size"]);
        //按tabsheet - 结束

        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }
        $html = $this->fetch("Question:view");
        echo $html;
    }

//按tabsheet子程序 - 开始

    private function tab_shijuanmingxi_exam_detail($tab_pagesize, $data)
    {
        $orderby = "";
        $joinsql = "";


        $condition = "";


        //select detail fields
        $selectfields = "@exam_detail.id ";
        $selectfields .= ",@exam_detail.exam_no ";
        $selectfields .= ",@exam_detail.type ";
        $selectfields .= ",@exam_detail.subject ";
        $selectfields .= ",@exam_detail.seq ";
        $selectfields .= ",@exam_detail.score ";
        $selectfields .= ",@exam_detail.question_type ";
        $selectfields .= ",@exam_detail.question_code ";
        $selectfields .= ",@exam_detail.question_name ";
        $selectfields .= ",@exam_detail.question_category_code ";
        $selectfields .= ",@exam_detail.question_category_name ";
        $selectfields .= ",@exam_detail.question_kind ";
        $selectfields .= ",@exam_detail.question_stem ";
        $selectfields .= ",@exam_detail.question_quiz ";
        $selectfields .= ",@exam_detail.question_answer ";
        $selectfields .= ",@exam_detail.question_img ";
        $selectfields .= ",@exam_detail.question_description ";
        $selectfields .= ",@exam_detail.extract_count ";
        $selectfields .= ",@exam_detail.create_time ";
        $selectfields .= ",@exam_detail.modify_time ";

        $viewkey = "@exam_detail.question_id='" . $data["search"]["id"] . "'";
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

    private function tab_caozuorizhi_log_common($tab_pagesize, $data)
    {
        $orderby = "";
        $joinsql = "";


        $condition = "";


        //select detail fields
        $selectfields = "@log_common.status ";
        $selectfields .= ",@log_common.id ";
        $selectfields .= ",@log_common.create_time ";
        $selectfields .= ",@log_common.data_id ";
        $selectfields .= ",@log_common.data_code ";
        $selectfields .= ",@log_common.subject ";
        $selectfields .= ",@log_common.content ";

        $viewkey = "@log_common.data_id='" . $data["search"]["id"] . "'";
        $viewkey .= " and @log_common.type='question'";
        if (!$viewkey)
            $this->ajaxError("查询参数非法");
        //      die;

        $page_size = $tab_pagesize;
        if (!$page_size) {
            $page_size = 10;
        }

        $count_sql = table("select count(*) as cnt from @log_common  #join# where #viewkey# #condition#");
        $search_sql = table("select #selectfields# from @log_common  #join# Where #viewkey# #condition# #orderby#");
        $orderby = "order by @log_common.id desc";

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
        $idefault = "showview2";
        switch ($itab) {

            case "shijuanmingxi":
            case "caozuorizhi":
            case "showview2":
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
        $smo = M('question')->where("id='%d'", array($id))->find();
        if (empty($smo)) {
            $this->ajaxResult("题库信息数据不存在");
        }
        if ($smo['status'] != 0) {
            $this->ajaxResult("题库信息状态不能删除");
        }

        $result = true;
        $result = $result && createLogCommon('question', $id, ($smo['status'] ? '取消信息' : '删除记录'), '');
        if ($smo['status'] != 0) {
            $result = $result && M('question')->where("id='%d'", array($id))->save(array('status' => 8, 'cancel_time' => date('Y-m-d H:i:s'), 'cancel_status' => 1));
        } else {
            $result = $result && M('question')->where("id='%d'", array($id))->delete();
        }
        return $result;
    }

    private function order_delete($data)
    {

        $id = I("request.id/d");
        $type = I("request.type/d");
        if (!$id) {
            $this->ajaxResult("题库信息参数不存在");
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

    private function tab_showview2($tab_pagesize, $data)
    {
        $id = I("get.id/d");
        if (empty($id)) {
            $this->ajaxError("非法操作");
        }
        $item = M("question")->where("id = $id")->find();
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
            if($key == 0) {
                $type = $items[$key]["type"];
            }
            $items[$key]["stem"] = scanSubject($items[$key]["type"] == 1 ? 0 : $seq, $items[$key]["stem"], $items[$key]["kind"], $items[$key]["img"]);
            $items[$key]["description"] = scanSubject($items[$key]["type"] == 1 ? 0 : $seq, $items[$key]["description"], $items[$key]["kind"], $items[$key]["img"], true);
            $pk = false;
            $item["analysis"] =  scanLine($item["analysis"], $pk);
            if ($items[$key]["img"] != "") {
                $items[$key]["hasImg"] = true;
            }
            $pk = false;
            if($items[$key]["kind"] == "xz" || $items[$key]["kind"] == "dx") {
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

            if($items[$key]["type"] != 1) {
                $seq++;
            }
        }

        $data["items"] = $items;
        return $data;
    }

}
