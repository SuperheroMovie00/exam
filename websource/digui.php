<!--
--><?php
/*

private function CheckDefine(&$str, $last=false)
{
    $arr = array("楷体", "宋体", "黑体", "F12", "F16", "F24", "B", "U",
        "D", "K", "T10", "T20", "TL", "PL", "PC", "PR", "P");

    echo "<br/>".$str."<br/>";

    while (1) {
        //strlen($str) <= strrpos($str, "[/#")

        if ($str == "") {
            if (!$last)
                return true;
            else
                return false;
        }
        $i = strpos($str, "[#");
        $j = strpos($str, "[/#");
        if ($i === false && $j === false) {
            if (!$last)
                return true;
            else
                return false;
        }

        //$j,$i多存在，j>i
        if ($i!==false && ($j > $i || $j===false)) {
            $m = strpos($str, "]", $i+1);       //第一个']'
            if($m===false){
                return false;
            }
            //判断</#之后是不是> 如果不是跳出循环
            if (substr($str, $m, 1) != "]") {
                return false;
            }
            //判定$j中的自定义节点的值是否在数组中存在。
            //将多个值在数组中对比判断是否与数组中的一致。
            $custom = substr($str, $i + 2, $m - $i - 2);
            $arrRow = explode(" ", $custom);

            foreach ($arrRow as $r) {
                if ($r != " ") {          //截取出的自定义属性中不为空的进行比较

                    if (in_array($r, $arr) > 0) {
                        if (in_array($r, array("PL", "PC", "PR", "P")) > 0) {
                            if (count($arrRow) > 1) {
                                return false;   //图像不能与其他自定义属性相互嵌套
                            }

                            //判断其位置是否在最末尾
                            if (substr($str, $i + 2, 1) == " ") { //判断开始符号之后的是否为空格
                                if (substr($str, $m + 1, $j - $m - 1) == " ") {  //取图片的自定义属性开始和结束之间的判断是否为空
                                    if ($j + 4 == strlen($str)) {  //判断其最后的一个结束符下标索引是否为字符串长度
                                        return true;
                                    }
                                }
                            }
                        }
                    } else {
                        return false;
                    }
                }
            }
            $str = substr($str, $m + 1, strlen($str) - $m);

            //将字符串截断

            if (CheckDefine($str, true)) {
                return false;
            }
        } else {
            $m = strpos($str, "]", $j+1);       //第一个']'
            if($m===false){
                return false;
            }
            $str = substr($str, $m + 1, strlen($str) - $m);
            echo "<br/>".$str."<br/>";
            return true;
        }
    }
}

$custom = "1踩踩踩2[#B 楷体 U K]3踩踩踩踩4[#B 楷体 U K]5踩踩踩踩踩6[/#]7踩踩踩踩8[/#]9踩踩从a[#B 楷体 U K]b踩踩踩踩踩c[/#]踩踩踩踩踩踩踩从";


$this->CheckDefine($custom ,"");


*/



?>