<?php
    //Area 地区
    function exist_table_Area($code){
         $sql="SELECT * FROM @area WHERE code='$code' LIMIT 1";
         $data = M()->query(table($sql));
         if (empty($data))
             return false;
         return $data[0];
     }


    //Company 公司信息
    function exist_table_Company($code){
         $sql="SELECT * FROM @company WHERE code='$code' LIMIT 1";
         $data = M()->query(table($sql));
         if (empty($data))
             return false;
         return $data[0];
     }


    //Customer 客户档案
    function exist_table_Customer($code){
         $sql="SELECT * FROM @customer WHERE code='$code' LIMIT 1";
         $data = M()->query(table($sql));
         if (empty($data))
             return false;
         return $data[0];
     }


    //CustomerCategory 客户分类
    function exist_table_CustomerCategory($code){
         $sql="SELECT * FROM @customer_category WHERE code='$code' LIMIT 1";
         $data = M()->query(table($sql));
         if (empty($data))
             return false;
         return $data[0];
     }


    //Department 部门信息
    function exist_table_Department($code){
         $sql="SELECT * FROM @department WHERE code='$code' LIMIT 1";
         $data = M()->query(table($sql));
         if (empty($data))
             return false;
         return $data[0];
     }


    //Question 题库
    function exist_table_Question($code){
         $sql="SELECT * FROM @question WHERE code='$code' LIMIT 1";
         $data = M()->query(table($sql));
         if (empty($data))
             return false;
         return $data[0];
     }


    //QuestionCategory 知识点分类
    function exist_table_QuestionCategory($code){
         $sql="SELECT * FROM @question_category WHERE code='$code' LIMIT 1";
         $data = M()->query(table($sql));
         if (empty($data))
             return false;
         return $data[0];
     }


    //QuestionSimilar 题库相似度
    function exist_table_QuestionSimilar($code){
         $sql="SELECT * FROM @question_similar WHERE code='$code' LIMIT 1";
         $data = M()->query(table($sql));
         if (empty($data))
             return false;
         return $data[0];
     }


    //Subcode 系统分类
    function exist_table_Subcode($code){
         $sql="SELECT * FROM @subcode WHERE code='$code' LIMIT 1";
         $data = M()->query(table($sql));
         if (empty($data))
             return false;
         return $data[0];
     }


    //SystemParameter 系统参数
    function exist_table_SystemParameter($code){
         $sql="SELECT * FROM @system_parameter WHERE code='$code' LIMIT 1";
         $data = M()->query(table($sql));
         if (empty($data))
             return false;
         return $data[0];
     }


    //User 用户信息
    function exist_table_User($username){
         $sql="SELECT * FROM @user WHERE username='$username' LIMIT 1";
         $data = M()->query(table($sql));
         if (empty($data))
             return false;
         return $data[0];
     }



?>