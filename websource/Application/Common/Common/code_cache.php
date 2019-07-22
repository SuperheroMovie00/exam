<?php
    //Area 地区 
    function table_Area_clearcache(){
        $Cache="Area";
        S("$Cache",null);
    }
    
    function table_Area(){
        $Cache="Area";
        $d=S("$Cache");
        if (!$d){
            $page_size = 1000;   
            $sql = table("select a.code,a.id,a.name from @area a  where  a.status=1  ORDER BY a.parent_id,a.sort,a.type,a.name");
            $sql .= " LIMIT 0, $page_size";
            $data = M()->query($sql);
            $d = array();
            foreach($data as $val) {
               $d[$val["code"]] = $val;}
            S("$Cache",$d,array('expire'=> 3600000));
        }

        return $d;
    }
    
    function get_table_Area($key, $name = "", $emptykey="", $seachbyid="0"){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $data= table_Area();
        if(!$data) return "? $key";
        if(!isset($data[$key])) return "? $key";
        if($name == "") return $data[$key];
        if(isset($data[$key][$name]))
            return $data[$key][$name];
        Else
            return "$name($key)";
    }
    
    function get_table_Area_byID($key, $name = "name", $emptykey=""){
        if (!$key) return "";
        $data= table_Area();
        if(!$data) return "? $key";
        if(!$name) $name="name";
        foreach($data as $item){
            if($key == $item["id"]) return $item[$name];
        }
        return "? $key";
    }
    
    function code_table_Area($name){
        if ($name=="" ) return "";
        $data= table_Area();
        if(!$data) return "";
        foreach($data as $key=>$item){
            if($name == $item["name"])
                return (string)$key;
        }
        return "";
    }


    //Company 公司信息 
    function table_Company_clearcache(){
        $Cache="Company";
        S("$Cache",null);
    }
    
    function table_Company(){
        $Cache="Company";
        $d=S("$Cache");
        if (!$d){
            $page_size = 1000;   
            $sql = table("select a.code,a.id,a.name from @company a  where  a.status=1  ORDER BY a.name");
            $sql .= " LIMIT 0, $page_size";
            $data = M()->query($sql);
            $d = array();
            foreach($data as $val) {
               $d[$val["code"]] = $val;}
            S("$Cache",$d,array('expire'=> 3600000));
        }

        return $d;
    }
    
    function get_table_Company($key, $name = "", $emptykey="", $seachbyid="0"){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $data= table_Company();
        if(!$data) return "? $key";
        if(!isset($data[$key])) return "? $key";
        if($name == "") return $data[$key];
        if(isset($data[$key][$name]))
            return $data[$key][$name];
        Else
            return "$name($key)";
    }
    
    function get_table_Company_byID($key, $name = "name", $emptykey=""){
        if (!$key) return "";
        $data= table_Company();
        if(!$data) return "? $key";
        if(!$name) $name="name";
        foreach($data as $item){
            if($key == $item["id"]) return $item[$name];
        }
        return "? $key";
    }
    
    function code_table_Company($name){
        if ($name=="" ) return "";
        $data= table_Company();
        if(!$data) return "";
        foreach($data as $key=>$item){
            if($name == $item["name"])
                return (string)$key;
        }
        return "";
    }


    //CustomerCategory 客户分类 
    function table_CustomerCategory_clearcache(){
        $Cache="CustomerCategory";
        S("$Cache",null);
    }
    
    function table_CustomerCategory(){
        $Cache="CustomerCategory";
        $d=S("$Cache");
        if (!$d){
            $page_size = 1000;   
            $sql = table("select a.code,a.id,a.name from @customer_category a  where  a.status=1  ORDER BY a.parent_id,a.sort,a.type,a.name");
            $sql .= " LIMIT 0, $page_size";
            $data = M()->query($sql);
            $d = array();
            foreach($data as $val) {
               $d[$val["code"]] = $val;}
            S("$Cache",$d,array('expire'=> 3600000));
        }

        return $d;
    }
    
    function get_table_CustomerCategory($key, $name = "", $emptykey="", $seachbyid="0"){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $data= table_CustomerCategory();
        if(!$data) return "? $key";
        if(!isset($data[$key])) return "? $key";
        if($name == "") return $data[$key];
        if(isset($data[$key][$name]))
            return $data[$key][$name];
        Else
            return "$name($key)";
    }
    
    function get_table_CustomerCategory_byID($key, $name = "name", $emptykey=""){
        if (!$key) return "";
        $data= table_CustomerCategory();
        if(!$data) return "? $key";
        if(!$name) $name="name";
        foreach($data as $item){
            if($key == $item["id"]) return $item[$name];
        }
        return "? $key";
    }
    
    function code_table_CustomerCategory($name){
        if ($name=="" ) return "";
        $data= table_CustomerCategory();
        if(!$data) return "";
        foreach($data as $key=>$item){
            if($name == $item["name"])
                return (string)$key;
        }
        return "";
    }


    //Department 部门信息 
    function table_Department_clearcache(){
        $Cache="Department";
        S("$Cache",null);
    }
    
    function table_Department(){
        $Cache="Department";
        $d=S("$Cache");
        if (!$d){
            $page_size = 1000;   
            $sql = table("select a.code,a.id,a.name from @department a  where  a.status=1  ORDER BY a.parent_id,a.sort,a.type,a.name");
            $sql .= " LIMIT 0, $page_size";
            $data = M()->query($sql);
            $d = array();
            foreach($data as $val) {
               $d[$val["code"]] = $val;}
            S("$Cache",$d,array('expire'=> 3600000));
        }

        return $d;
    }
    
    function get_table_Department($key, $name = "", $emptykey="", $seachbyid="0"){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $data= table_Department();
        if(!$data) return "? $key";
        if(!isset($data[$key])) return "? $key";
        if($name == "") return $data[$key];
        if(isset($data[$key][$name]))
            return $data[$key][$name];
        Else
            return "$name($key)";
    }
    
    function get_table_Department_byID($key, $name = "name", $emptykey=""){
        if (!$key) return "";
        $data= table_Department();
        if(!$data) return "? $key";
        if(!$name) $name="name";
        foreach($data as $item){
            if($key == $item["id"]) return $item[$name];
        }
        return "? $key";
    }
    
    function code_table_Department($name){
        if ($name=="" ) return "";
        $data= table_Department();
        if(!$data) return "";
        foreach($data as $key=>$item){
            if($name == $item["name"])
                return (string)$key;
        }
        return "";
    }


    //QuestionCategory 知识点分类 
    function table_QuestionCategory_clearcache(){
        $Cache="QuestionCategory";
        S("$Cache",null);
    }
    
    function table_QuestionCategory(){
        $Cache="QuestionCategory";
        $d=S("$Cache");
        if (!$d){
            $page_size = 1000;   
            $sql = table("select a.code,a.id,a.name from @question_category a  where  a.status=1  ORDER BY a.parent_id,a.sort,a.name");
            $sql .= " LIMIT 0, $page_size";
            $data = M()->query($sql);
            $d = array();
            foreach($data as $val) {
               $d[$val["code"]] = $val;}
            S("$Cache",$d,array('expire'=> 3600000));
        }

        return $d;
    }
    
    function get_table_QuestionCategory($key, $name = "", $emptykey="", $seachbyid="0"){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $data= table_QuestionCategory();
        if(!$data) return "? $key";
        if(!isset($data[$key])) return "? $key";
        if($name == "") return $data[$key];
        if(isset($data[$key][$name]))
            return $data[$key][$name];
        Else
            return "$name($key)";
    }
    
    function get_table_QuestionCategory_byID($key, $name = "name", $emptykey=""){
        if (!$key) return "";
        $data= table_QuestionCategory();
        if(!$data) return "? $key";
        if(!$name) $name="name";
        foreach($data as $item){
            if($key == $item["id"]) return $item[$name];
        }
        return "? $key";
    }
    
    function code_table_QuestionCategory($name){
        if ($name=="" ) return "";
        $data= table_QuestionCategory();
        if(!$data) return "";
        foreach($data as $key=>$item){
            if($name == $item["name"])
                return (string)$key;
        }
        return "";
    }


    //Role 角色 
    function table_Role_clearcache(){
        $Cache="Role";
        S("$Cache",null);
    }
    
    function table_Role(){
        $Cache="Role";
        $d=S("$Cache");
        if (!$d){
            $page_size = 1000;   
            $sql = table("select a.id,a.name from @role a  where  a.status=1  ORDER BY a.pid,a.name");
            $sql .= " LIMIT 0, $page_size";
            $data = M()->query($sql);
            $d = array();
            foreach($data as $val) {
               $d[$val["id"]] = $val;}
            S("$Cache",$d,array('expire'=> 3600000));
        }

        return $d;
    }
    
    function get_table_Role($key, $name = "", $emptykey="", $seachbyid="0"){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $data= table_Role();
        if(!$data) return "? $key";
        if(!isset($data[$key])) return "? $key";
        if($name == "") return $data[$key];
        if(isset($data[$key][$name]))
            return $data[$key][$name];
        Else
            return "$name($key)";
    }
    
    function get_table_Role_byID($key, $name = "name", $emptykey=""){
        if (!$key) return "";
        $data= table_Role();
        if(!$data) return "? $key";
        if(!$name) $name="name";
        foreach($data as $item){
            if($key == $item["id"]) return $item[$name];
        }
        return "? $key";
    }
    
    function code_table_Role($name){
        if ($name=="" ) return "";
        $data= table_Role();
        if(!$data) return "";
        foreach($data as $key=>$item){
            if($name == $item["name"])
                return (string)$key;
        }
        return "";
    }


    //SystemParameter 系统参数 
    function table_SystemParameter_clearcache(){
        $Cache="SystemParameter";
        S("$Cache",null);
    }
    
    function table_SystemParameter(){
        $Cache="SystemParameter";
        $d=S("$Cache");
        if (!$d){
            $page_size = 1000;   
            $sql = table("select a.code,a.id,a.name,a.value,a.status from @system_parameter a  where  a.status=1  ORDER BY a.sort,a.type,a.name");
            $sql .= " LIMIT 0, $page_size";
            $data = M()->query($sql);
            $d = array();
            foreach($data as $val) {
               $d[$val["code"]] = $val;}
            S("$Cache",$d,array('expire'=> 3600000));
        }

        return $d;
    }
    
    function get_table_SystemParameter($key, $name = "", $emptykey="", $seachbyid="0"){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $data= table_SystemParameter();
        if(!$data) return "? $key";
        if(!isset($data[$key])) return "? $key";
        if($name == "") return $data[$key];
        if(isset($data[$key][$name]))
            return $data[$key][$name];
        Else
            return "$name($key)";
    }
    
    function get_table_SystemParameter_byID($key, $name = "name", $emptykey=""){
        if (!$key) return "";
        $data= table_SystemParameter();
        if(!$data) return "? $key";
        if(!$name) $name="name";
        foreach($data as $item){
            if($key == $item["id"]) return $item[$name];
        }
        return "? $key";
    }
    
    function code_table_SystemParameter($name){
        if ($name=="" ) return "";
        $data= table_SystemParameter();
        if(!$data) return "";
        foreach($data as $key=>$item){
            if($name == $item["name"])
                return (string)$key;
        }
        return "";
    }


    //User 用户信息 
    function table_User_clearcache(){
        $Cache="User";
        S("$Cache",null);
    }
    
    function table_User(){
        $Cache="User";
        $d=S("$Cache");
        if (!$d){
            $page_size = 1000;   
            $sql = table("select a.code,a.id,a.name from @user a left join @department b on a.department_id=b.id where  a. status=1  ORDER BY a.sort,a.type,a.name");
            $sql .= " LIMIT 0, $page_size";
            $data = M()->query($sql);
            $d = array();
            foreach($data as $val) {
               $d[$val["code"]] = $val;}
            S("$Cache",$d,array('expire'=> 3600000));
        }

        return $d;
    }
    
    function get_table_User($key, $name = "", $emptykey="", $seachbyid="0"){
        if ($key=="" || $key!="" && $key==$emptykey) return "";
        $data= table_User();
        if(!$data) return "? $key";
        if(!isset($data[$key])) return "? $key";
        if($name == "") return $data[$key];
        if(isset($data[$key][$name]))
            return $data[$key][$name];
        Else
            return "$name($key)";
    }
    
    function get_table_User_byID($key, $name = "name", $emptykey=""){
        if (!$key) return "";
        $data= table_User();
        if(!$data) return "? $key";
        if(!$name) $name="name";
        foreach($data as $item){
            if($key == $item["id"]) return $item[$name];
        }
        return "? $key";
    }
    
    function code_table_User($name){
        if ($name=="" ) return "";
        $data= table_User();
        if(!$data) return "";
        foreach($data as $key=>$item){
            if($name == $item["name"])
                return (string)$key;
        }
        return "";
    }



?>