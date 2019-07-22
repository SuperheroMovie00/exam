<?php
    //Area[type]  地区[类型]
    function table_Area_type(){
        return array("0"=>array("id"=>"0","name"=>"国家"),
                     "1"=>array("id"=>"1","name"=>"省市"),
                     "2"=>array("id"=>"2","name"=>"地区"),
                     "3"=>array("id"=>"3","name"=>"县市"),
                     "4"=>array("id"=>"4","name"=>"区域"),
                     "5"=>array("id"=>"5","name"=>"街道"));
    }

    function get_table_Area_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Area_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Area_type($value){
        if ($value=="") return "";
        $arr=table_Area_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Area[status]  地区[状态]
    function table_Area_status(){
        return array("1"=>array("id"=>"1","name"=>"有效"),
                     "0"=>array("id"=>"0","name"=>"无效"));
    }

    function get_table_Area_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Area_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Area_status($value){
        if ($value=="") return "";
        $arr=table_Area_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Company[province]  公司信息[省份]
    function table_Company_province(){
        return array("func:subcode('province')"=>array("id"=>"func:subcode('province')","name"=>""));
    }

    function get_table_Company_province($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Company_province();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Company_province($value){
        if ($value=="") return "";
        $arr=table_Company_province();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Company[status]  公司信息[状态]
    function table_Company_status(){
        return array("1"=>array("id"=>"1","name"=>"有效"),
                     "0"=>array("id"=>"0","name"=>"无效"));
    }

    function get_table_Company_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Company_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Company_status($value){
        if ($value=="") return "";
        $arr=table_Company_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //CompanyUser[level]  公司用户[级别]
    function table_CompanyUser_level(){
        return array("0"=>array("id"=>"0","name"=>"无"),
                     "1"=>array("id"=>"1","name"=>"一级"),
                     "2"=>array("id"=>"2","name"=>"二级"));
    }

    function get_table_CompanyUser_level($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_CompanyUser_level();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_CompanyUser_level($value){
        if ($value=="") return "";
        $arr=table_CompanyUser_level();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Customer[type]  客户档案[客户类型]
    function table_Customer_type(){
        return array("1"=>array("id"=>"1","name"=>"客户"),
                     "0"=>array("id"=>"0","name"=>"合伙"));
    }

    function get_table_Customer_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Customer_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Customer_type($value){
        if ($value=="") return "";
        $arr=table_Customer_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Customer[customer_level]  客户档案[层级]
    function table_Customer_customer_level(){
        return array("0"=>array("id"=>"0","name"=>"未分"),
                     "1"=>array("id"=>"1","name"=>"1级"),
                     "2"=>array("id"=>"2","name"=>"2级"),
                     "3"=>array("id"=>"3","name"=>"3级"),
                     "4"=>array("id"=>"4","name"=>"4级"),
                     "5"=>array("id"=>"5","name"=>"5级"),
                     "6"=>array("id"=>"6","name"=>"6级"));
    }

    function get_table_Customer_customer_level($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Customer_customer_level();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Customer_customer_level($value){
        if ($value=="") return "";
        $arr=table_Customer_customer_level();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Customer[status]  客户档案[状态]
    function table_Customer_status(){
        return array("0"=>array("id"=>"0","name"=>"无效"),
                     "1"=>array("id"=>"1","name"=>"有效"));
    }

    function get_table_Customer_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Customer_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Customer_status($value){
        if ($value=="") return "";
        $arr=table_Customer_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //CustomerCategory[type]  客户分类[客户类型]
    function table_CustomerCategory_type(){
        return array("1"=>array("id"=>"1","name"=>"供应商"),
                     "0"=>array("id"=>"0","name"=>"销售客户"));
    }

    function get_table_CustomerCategory_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_CustomerCategory_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_CustomerCategory_type($value){
        if ($value=="") return "";
        $arr=table_CustomerCategory_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //CustomerCategory[status]  客户分类[状态]
    function table_CustomerCategory_status(){
        return array("1"=>array("id"=>"1","name"=>"有效"),
                     "0"=>array("id"=>"0","name"=>"无效"));
    }

    function get_table_CustomerCategory_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_CustomerCategory_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_CustomerCategory_status($value){
        if ($value=="") return "";
        $arr=table_CustomerCategory_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Department[type]  部门信息[类型]
    function table_Department_type(){
        return array("0"=>array("id"=>"0","name"=>"管理"),
                     "1"=>array("id"=>"1","name"=>"财务"),
                     "2"=>array("id"=>"2","name"=>"生产"),
                     "3"=>array("id"=>"3","name"=>"仓储"));
    }

    function get_table_Department_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Department_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Department_type($value){
        if ($value=="") return "";
        $arr=table_Department_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Department[status]  部门信息[状态]
    function table_Department_status(){
        return array("1"=>array("id"=>"1","name"=>"有效"),
                     "0"=>array("id"=>"0","name"=>"无效"));
    }

    function get_table_Department_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Department_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Department_status($value){
        if ($value=="") return "";
        $arr=table_Department_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Exam[type]  试卷[类型]
    function table_Exam_type(){
        return array("0"=>array("id"=>"0","name"=>"练习"),
                     "1"=>array("id"=>"1","name"=>"期中"),
                     "2"=>array("id"=>"2","name"=>"期末"));
    }

    function get_table_Exam_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Exam_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Exam_type($value){
        if ($value=="") return "";
        $arr=table_Exam_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Exam[status]  试卷[状态]
    function table_Exam_status(){
        return array("0"=>array("id"=>"0","name"=>"草稿"),
                     "1"=>array("id"=>"1","name"=>"确认"),
                     "7"=>array("id"=>"7","name"=>"取消"));
    }

    function get_table_Exam_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Exam_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Exam_status($value){
        if ($value=="") return "";
        $arr=table_Exam_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //ExamDetail[type]  试卷明细[类型]
    function table_ExamDetail_type(){
        return array("0"=>array("id"=>"0","name"=>"题目"),
                     "1"=>array("id"=>"1","name"=>"1类标题"),
                     "2"=>array("id"=>"2","name"=>"2类标题"),
                     "3"=>array("id"=>"3","name"=>"3类标题"),
                     "4"=>array("id"=>"4","name"=>"4类标题"),
                     "5"=>array("id"=>"5","name"=>"5类标题"),
                     "6"=>array("id"=>"6","name"=>"6类标题"),
                     "7"=>array("id"=>"7","name"=>"7类标题"));
    }

    function get_table_ExamDetail_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_ExamDetail_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_ExamDetail_type($value){
        if ($value=="") return "";
        $arr=table_ExamDetail_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //ExamDetail[question_type]  试卷明细[试题类型]
    function table_ExamDetail_question_type(){
        return array("0"=>array("id"=>"0","name"=>"标准"),
                     "1"=>array("id"=>"1","name"=>"套题"),
                     "2"=>array("id"=>"2","name"=>"小题"));
    }

    function get_table_ExamDetail_question_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_ExamDetail_question_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_ExamDetail_question_type($value){
        if ($value=="") return "";
        $arr=table_ExamDetail_question_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //ExamDetail[question_kind]  试卷明细[试题题型]
    function table_ExamDetail_question_kind(){
        return array("subcode('question:kind')"=>array("id"=>"subcode('question:kind')","name"=>""));
    }

    function get_table_ExamDetail_question_kind($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_ExamDetail_question_kind();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_ExamDetail_question_kind($value){
        if ($value=="") return "";
        $arr=table_ExamDetail_question_kind();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //LogCommon[type]  公共日志[类型]
    function table_LogCommon_type(){
        return array("user"=>array("id"=>"user","name"=>"用户"),
                     "style1"=>array("id"=>"style1","name"=>"颜色"),
                     "style2"=>array("id"=>"style2","name"=>"尺码"),
                     "year"=>array("id"=>"year","name"=>"年份"),
                     "shop"=>array("id"=>"shop","name"=>"店铺"),
                     "season"=>array("id"=>"season","name"=>"季节"),
                     "payment"=>array("id"=>"payment","name"=>"支付方式"),
                     "platform"=>array("id"=>"platform","name"=>"平台"),
                     "goods"=>array("id"=>"goods","name"=>"商品"),
                     "group"=>array("id"=>"group","name"=>"分组"),
                     "department"=>array("id"=>"department","name"=>"部门"),
                     "deliver"=>array("id"=>"deliver","name"=>"配送"),
                     "customer"=>array("id"=>"customer","name"=>"供应商"),
                     "category"=>array("id"=>"category","name"=>"分类"),
                     "brand"=>array("id"=>"brand","name"=>"品牌"),
                     "area"=>array("id"=>"area","name"=>"地区"),
                     "activity"=>array("id"=>"activity","name"=>"活动"),
                     "return_reason"=>array("id"=>"return_reason","name"=>"退货理由"),
                     "storage"=>array("id"=>"storage","name"=>"仓库"));
    }

    function get_table_LogCommon_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_LogCommon_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_LogCommon_type($value){
        if ($value=="") return "";
        $arr=table_LogCommon_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //LogModel[type]  模块日志[类型]
    function table_LogModel_type(){
        return array("1"=>array("id"=>"1","name"=>"login"),
                     "2"=>array("id"=>"2","name"=>"logout"),
                     "3"=>array("id"=>"3","name"=>"model"));
    }

    function get_table_LogModel_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_LogModel_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_LogModel_type($value){
        if ($value=="") return "";
        $arr=table_LogModel_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //LogOrder[type]  凭据日志[类型]
    function table_LogOrder_type(){
        return array("sales"=>array("id"=>"sales","name"=>"销售订单"),
                     "stockin"=>array("id"=>"stockin","name"=>"仓库入库"),
                     "stockout"=>array("id"=>"stockout","name"=>"仓库出库"),
                     "stockmove"=>array("id"=>"stockmove","name"=>"仓库移仓"),
                     "stockadjust"=>array("id"=>"stockadjust","name"=>"仓库调整"),
                     "stockcheck"=>array("id"=>"stockcheck","name"=>"仓库盘点"),
                     "trade"=>array("id"=>"trade","name"=>"贸易链"));
    }

    function get_table_LogOrder_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_LogOrder_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_LogOrder_type($value){
        if ($value=="") return "";
        $arr=table_LogOrder_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Node[status]  模块功能[状态]
    function table_Node_status(){
        return array("1"=>array("id"=>"1","name"=>"有效"),
                     "0"=>array("id"=>"0","name"=>"无效"));
    }

    function get_table_Node_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Node_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Node_status($value){
        if ($value=="") return "";
        $arr=table_Node_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Node[is_admin]  模块功能[超级用户]
    function table_Node_is_admin(){
        return array("1"=>array("id"=>"1","name"=>"是"),
                     "0"=>array("id"=>"0","name"=>"否"));
    }

    function get_table_Node_is_admin($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Node_is_admin();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Node_is_admin($value){
        if ($value=="") return "";
        $arr=table_Node_is_admin();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Node[default_open]  模块功能[缺省展开]
    function table_Node_default_open(){
        return array("1"=>array("id"=>"1","name"=>"是"),
                     "0"=>array("id"=>"0","name"=>"否"));
    }

    function get_table_Node_default_open($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Node_default_open();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Node_default_open($value){
        if ($value=="") return "";
        $arr=table_Node_default_open();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Question[type]  题库[类型]
    function table_Question_type(){
        return array("0"=>array("id"=>"0","name"=>"标准"),
                     "1"=>array("id"=>"1","name"=>"套题"),
                     "2"=>array("id"=>"2","name"=>"小题"));
    }

    function get_table_Question_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Question_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Question_type($value){
        if ($value=="") return "";
        $arr=table_Question_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Question[unit]  题库[分类]
    function table_Question_unit(){
        return array("1"=>array("id"=>"1","name"=>"片段阅读"),
                     "2"=>array("id"=>"2","name"=>"篇章阅读"),
                     "3"=>array("id"=>"3","name"=>"组合阅读"),
                     "4"=>array("id"=>"4","name"=>"写作"),
                     "5"=>array("id"=>"5","name"=>"片段写作"),
                     "6"=>array("id"=>"6","name"=>"修改"),
                     "7"=>array("id"=>"7","name"=>"文言文阅读"),
                     "8"=>array("id"=>"8","name"=>"其他"));
    }

    function get_table_Question_unit($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Question_unit();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Question_unit($value){
        if ($value=="") return "";
        $arr=table_Question_unit();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Question[kind]  题库[题型]
    function table_Question_kind(){
        return array("subcode('question:kind')"=>array("id"=>"subcode('question:kind')","name"=>""));
    }

    function get_table_Question_kind($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Question_kind();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Question_kind($value){
        if ($value=="") return "";
        $arr=table_Question_kind();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Question[status]  题库[状态]
    function table_Question_status(){
        return array("0"=>array("id"=>"0","name"=>"无效"),
                     "1"=>array("id"=>"1","name"=>"有效"));
    }

    function get_table_Question_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Question_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Question_status($value){
        if ($value=="") return "";
        $arr=table_Question_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //QuestionCategory[approval_require]  知识点分类[审批要求]
    function table_QuestionCategory_approval_require(){
        return array("0"=>array("id"=>"0","name"=>"无"),
                     "1"=>array("id"=>"1","name"=>"互审"),
                     "2"=>array("id"=>"2","name"=>"一级"),
                     "3"=>array("id"=>"3","name"=>"二级"));
    }

    function get_table_QuestionCategory_approval_require($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_QuestionCategory_approval_require();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_QuestionCategory_approval_require($value){
        if ($value=="") return "";
        $arr=table_QuestionCategory_approval_require();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //QuestionCategory[onlyone]  知识点分类[单一题目]
    function table_QuestionCategory_onlyone(){
        return array("0"=>array("id"=>"0","name"=>"否"),
                     "1"=>array("id"=>"1","name"=>"是"));
    }

    function get_table_QuestionCategory_onlyone($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_QuestionCategory_onlyone();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_QuestionCategory_onlyone($value){
        if ($value=="") return "";
        $arr=table_QuestionCategory_onlyone();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //QuestionCategory[status]  知识点分类[状态]
    function table_QuestionCategory_status(){
        return array("0"=>array("id"=>"0","name"=>"无效"),
                     "1"=>array("id"=>"1","name"=>"有效"));
    }

    function get_table_QuestionCategory_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_QuestionCategory_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_QuestionCategory_status($value){
        if ($value=="") return "";
        $arr=table_QuestionCategory_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //QuestionSimilar[kind]  题库相似度[题型]
    function table_QuestionSimilar_kind(){
        return array("subcode('question:kind')"=>array("id"=>"subcode('question:kind')","name"=>""));
    }

    function get_table_QuestionSimilar_kind($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_QuestionSimilar_kind();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_QuestionSimilar_kind($value){
        if ($value=="") return "";
        $arr=table_QuestionSimilar_kind();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Role[status]  角色[状态]
    function table_Role_status(){
        return array("1"=>array("id"=>"1","name"=>"有效"),
                     "0"=>array("id"=>"0","name"=>"无效"));
    }

    function get_table_Role_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Role_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Role_status($value){
        if ($value=="") return "";
        $arr=table_Role_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Role[approval]  角色[审批级别]
    function table_Role_approval(){
        return array("0"=>array("id"=>"0","name"=>"无"),
                     "1"=>array("id"=>"1","name"=>"一级"),
                     "2"=>array("id"=>"2","name"=>"二级"),
                     "3"=>array("id"=>"3","name"=>"特权"));
    }

    function get_table_Role_approval($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Role_approval();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Role_approval($value){
        if ($value=="") return "";
        $arr=table_Role_approval();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Subcode[is_system]  系统分类[系统定义]
    function table_Subcode_is_system(){
        return array("1"=>array("id"=>"1","name"=>"是"),
                     "0"=>array("id"=>"0","name"=>"否"));
    }

    function get_table_Subcode_is_system($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Subcode_is_system();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Subcode_is_system($value){
        if ($value=="") return "";
        $arr=table_Subcode_is_system();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Subcode[status]  系统分类[状态]
    function table_Subcode_status(){
        return array("1"=>array("id"=>"1","name"=>"有效"),
                     "0"=>array("id"=>"0","name"=>"无效"));
    }

    function get_table_Subcode_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Subcode_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Subcode_status($value){
        if ($value=="") return "";
        $arr=table_Subcode_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //SystemParameter[type]  系统参数[类型]
    function table_SystemParameter_type(){
        return array("trade"=>array("id"=>"trade","name"=>"贸易"),
                     "panel"=>array("id"=>"panel","name"=>"平台"));
    }

    function get_table_SystemParameter_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_SystemParameter_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_SystemParameter_type($value){
        if ($value=="") return "";
        $arr=table_SystemParameter_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //SystemParameter[status]  系统参数[状态]
    function table_SystemParameter_status(){
        return array("1"=>array("id"=>"1","name"=>"有效"),
                     "0"=>array("id"=>"0","name"=>"无效"));
    }

    function get_table_SystemParameter_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_SystemParameter_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_SystemParameter_status($value){
        if ($value=="") return "";
        $arr=table_SystemParameter_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //SystemParameter[allow_edit]  系统参数[允许编辑]
    function table_SystemParameter_allow_edit(){
        return array("1"=>array("id"=>"1","name"=>"允许"),
                     "0"=>array("id"=>"0","name"=>"禁止"));
    }

    function get_table_SystemParameter_allow_edit($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_SystemParameter_allow_edit();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_SystemParameter_allow_edit($value){
        if ($value=="") return "";
        $arr=table_SystemParameter_allow_edit();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Templet[type]  组卷模板[类型]
    function table_Templet_type(){
        return array("0"=>array("id"=>"0","name"=>"练习"),
                     "1"=>array("id"=>"1","name"=>"期中"),
                     "2"=>array("id"=>"2","name"=>"期末"));
    }

    function get_table_Templet_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Templet_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Templet_type($value){
        if ($value=="") return "";
        $arr=table_Templet_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //Templet[status]  组卷模板[状态]
    function table_Templet_status(){
        return array("0"=>array("id"=>"0","name"=>"草稿"),
                     "1"=>array("id"=>"1","name"=>"确认"),
                     "7"=>array("id"=>"7","name"=>"取消"));
    }

    function get_table_Templet_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_Templet_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_Templet_status($value){
        if ($value=="") return "";
        $arr=table_Templet_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //TempletDetail[type]  组卷模板明细[类型]
    function table_TempletDetail_type(){
        return array("0"=>array("id"=>"0","name"=>"题目"),
                     "1"=>array("id"=>"1","name"=>"1类标题"),
                     "2"=>array("id"=>"2","name"=>"2类标题"),
                     "3"=>array("id"=>"3","name"=>"3类标题"),
                     "4"=>array("id"=>"4","name"=>"4类标题"),
                     "5"=>array("id"=>"5","name"=>"5类标题"),
                     "6"=>array("id"=>"6","name"=>"6类标题"),
                     "7"=>array("id"=>"7","name"=>"7类标题"));
    }

    function get_table_TempletDetail_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_TempletDetail_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_TempletDetail_type($value){
        if ($value=="") return "";
        $arr=table_TempletDetail_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //TempletDetail[req_type]  组卷模板明细[要求类型]
    function table_TempletDetail_req_type(){
        return array("0"=>array("id"=>"0","name"=>"标准"),
                     "1"=>array("id"=>"1","name"=>"套题"));
    }

    function get_table_TempletDetail_req_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_TempletDetail_req_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_TempletDetail_req_type($value){
        if ($value=="") return "";
        $arr=table_TempletDetail_req_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //TempletDetail[req_kind]  组卷模板明细[要求题型]
    function table_TempletDetail_req_kind(){
        return array("subcode('question:kind')"=>array("id"=>"subcode('question:kind')","name"=>""));
    }

    function get_table_TempletDetail_req_kind($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_TempletDetail_req_kind();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_TempletDetail_req_kind($value){
        if ($value=="") return "";
        $arr=table_TempletDetail_req_kind();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //TempletDetail[req_child_count]  组卷模板明细[套题小题数]
    function table_TempletDetail_req_child_count(){
        return array("func:enums('num',1,9)"=>array("id"=>"func:enums('num',1,9)","name"=>""));
    }

    function get_table_TempletDetail_req_child_count($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_TempletDetail_req_child_count();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_TempletDetail_req_child_count($value){
        if ($value=="") return "";
        $arr=table_TempletDetail_req_child_count();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //TempletDetail[req_child_seq]  组卷模板明细[套题小题号]
    function table_TempletDetail_req_child_seq(){
        return array("0"=>array("id"=>"0","name"=>"不分配"),
                     "1"=>array("id"=>"1","name"=>"分配题号"));
    }

    function get_table_TempletDetail_req_child_seq($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_TempletDetail_req_child_seq();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_TempletDetail_req_child_seq($value){
        if ($value=="") return "";
        $arr=table_TempletDetail_req_child_seq();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //TempletDetail[req_unit]  组卷模板明细[要求分类]
    function table_TempletDetail_req_unit(){
        return array("1"=>array("id"=>"1","name"=>"片段阅读"),
                     "2"=>array("id"=>"2","name"=>"篇章阅读"),
                     "3"=>array("id"=>"3","name"=>"组合阅读"),
                     "4"=>array("id"=>"4","name"=>"写作"),
                     "5"=>array("id"=>"5","name"=>"片段写作"),
                     "6"=>array("id"=>"6","name"=>"修改"),
                     "7"=>array("id"=>"7","name"=>"文言文阅读"),
                     "8"=>array("id"=>"8","name"=>"其他"));
    }

    function get_table_TempletDetail_req_unit($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_TempletDetail_req_unit();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_TempletDetail_req_unit($value){
        if ($value=="") return "";
        $arr=table_TempletDetail_req_unit();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //TempletDetail[extract]  组卷模板明细[抽取要求]
    function table_TempletDetail_extract(){
        return array("0"=>array("id"=>"0","name"=>"无要求"),
                     "1"=>array("id"=>"1","name"=>"重未使用"),
                     "2"=>array("id"=>"2","name"=>"使用少优先"));
    }

    function get_table_TempletDetail_extract($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_TempletDetail_extract();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_TempletDetail_extract($value){
        if ($value=="") return "";
        $arr=table_TempletDetail_extract();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //User[status]  用户信息[状态]
    function table_User_status(){
        return array("1"=>array("id"=>"1","name"=>"有效"),
                     "0"=>array("id"=>"0","name"=>"无效"));
    }

    function get_table_User_status($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_User_status();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_User_status($value){
        if ($value=="") return "";
        $arr=table_User_status();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //User[type]  用户信息[类型]
    function table_User_type(){
        return array("0"=>array("id"=>"0","name"=>"管理"),
                     "1"=>array("id"=>"1","name"=>"业务"));
    }

    function get_table_User_type($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_User_type();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_User_type($value){
        if ($value=="") return "";
        $arr=table_User_type();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //User[sex]  用户信息[性别]
    function table_User_sex(){
        return array("1"=>array("id"=>"1","name"=>"男"),
                     "0"=>array("id"=>"0","name"=>"女"),
                     "2"=>array("id"=>"2","name"=>"保密"));
    }

    function get_table_User_sex($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_User_sex();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_User_sex($value){
        if ($value=="") return "";
        $arr=table_User_sex();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }

    //User[superadmin]  用户信息[是否管理员]
    function table_User_superadmin(){
        return array("0"=>array("id"=>"0","name"=>"否"),
                     "1"=>array("id"=>"1","name"=>"是"));
    }

    function get_table_User_superadmin($key, $name="", $emptykey=""){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $arr=table_User_superadmin();
        if(isset($arr[$key])) {
            if($name=="") $name="name";
            if(isset($arr[$key][$name]))
                return $arr[$key][$name];
        }
        return "? $key";
    }

    function code_table_User_superadmin($value){
        if ($value=="") return "";
        $arr=table_User_superadmin();
        foreach($arr as $key=>$item){
            if ($value==$item["name"])
                return $key;
        }
        return "";
    }


?>