<?php

namespace Common\Model;
use Think\Model;

class HolterOrigModel extends Model{
    protected $tableName = 'holter_orig';
    private static $sampling=125;
    private static $chNums=1;

    public function abnormal_getorigdata($holter_id,$startTime,$endTime){

        $r=array();

        if($endTime-$startTime+1<=60 && timeFormatisSame($startTime,$endTime,'i')){
            $r = $this->abnormal_getorigdata_read($holter_id,$startTime,$endTime-$startTime+1);
        }else{
            $prevTime=dateModifyByString(date('Y-m-d H:i:00',$startTime),'+1 min -1 seconds');
            $nextTime=dateModifyByString(date('Y-m-d H:i:00',$startTime),'+1 min');

            $r1 = $this->abnormal_getorigdata_read($holter_id,$startTime,$prevTime-$startTime+1);
            $r2 = $this->abnormal_getorigdata_read($holter_id,$nextTime,$endTime-$nextTime);

            foreach ($r1 as $k=>$v) {
                $r[$k]=array_merge($r1[$k],$r2[$k]);
            }


//            $r.= $this->abnormal_getorigdata_read($holter_id,$nextTime,$endTime-$nextTime);
        }


       return $r;

    }

    private function readFile($handle,$seek,$length){
        fseek($handle, $seek);
        $r=fread($handle,$length);
        $temp=unpack('H*', $r);
        return $temp[1];
    }

    private function readFileValue($handle,$seek,$length){
        fseek($handle, $seek);
        $r=fread($handle,$length);
        $temp=unpack('H*', $r);
        return hexdec($temp[1]);
    }

    private function abnormal_getorigdata_read($holter_id,$startTime,$times){

        $timeValue=dateModifyByStamp($startTime,'+0 seconds','YmdHi');

        $ho=$this->field('filepath,datafile,isfilter,filterfile')->where("holter_id='%d' AND timevalue='%s'",array($holter_id,$timeValue))->find();

        if(empty($ho)){
            $ret=array();
            for($j=0;$j<self::$chNums;$j++){
                $ret[$j]=array();
            }

            return $ret;
        }

        $filterFilePath=$ho['filterfile'];
        $dataFilePath=$_SERVER['DOCUMENT_ROOT'].'/'.trim($ho['filepath'],'./').'/'.$ho['datafile'];

        return $this->origdata_readfile($filterFilePath,$dataFilePath,$startTime,$times);

    }

    public function getbreathdata_read($holter_id,$startTime,$times){

        $timeValue=dateModifyByStamp($startTime,'+0 seconds','YmdHi');

        $ho=M('holter_orig_breath')->field('filepath,datafile')->where("holter_id='%d' AND timevalue='%s'",array($holter_id,$timeValue))->find();

        if(empty($ho)){
            $ret=array();
            for($j=0;$j<self::$chNums;$j++){
                $ret[$j]=array();
            }

            return $ret;
        }

        $dataFilePath=$_SERVER['DOCUMENT_ROOT'].'/'.trim($ho['filepath'],'./').'/'.$ho['datafile'];
        $filterPath=$ho['filterfile'];

        if($ho['isfilter']<=0){
            $filterPath.='_notfile';
        }

        return $this->origbreathdata_readfile($filterPath,$dataFilePath,$startTime,$times);

    }




    public function origbreathdata_readfile($filterFilePath,$dataFilePath,$startTime,$times){


//        从数据库读出 现暂定为只有一通道
//        $ch=$ho[chanels];
        $ch=self::$chNums;

        $readSize=2;

        $ret=array();
        for($j=0;$j<$ch;$j++){
            $ret[$j]=array();
        }

        if(is_file($filterFilePath)){
            $filePath=$filterFilePath;

            $handle = fopen($filePath, "r");

            if(!$handle){
                fclose($handle);
                return $ret;
            }


            $n=date('s',$startTime);

            $startPos=$n*self::$sampling*$readSize;
            $step=$times*self::$sampling*$readSize;

            $temp=$this->readFile($handle,$startPos,$step);

        }else{
            $filePath=$dataFilePath;

            $handle = fopen($filePath, "r");

            if(!$handle){
                fclose($handle);
                return $ret;
            }


            $n=date('s',$startTime);

            $startPos=$n*self::$sampling*$readSize;
            $step=$times*self::$sampling*$readSize;

            $temp=$this->readFile($handle,$startPos,$step);

        }


//        print_r($temp);exit();
//        print_r($startTime.','.$times.','.$startPos.','.$step);exit();


        if($ch==1){
            for($i=0;$i<strlen($temp);$i+=$readSize*2){

                $val=$temp[$i].$temp[$i+1].$temp[$i+2].$temp[$i+3];

                if(hexdec($temp[$i])>7 ){
                    $val= -(hexdec("FFFF")-hexdec($val)+1);
                }else{
                    $val=hexdec($val);
                }
                $ret[0][]=$val;
            }
        }else{
            for($j=0;$j<$ch;$j++){
                for($i=$j*$readSize*2;$i<strlen($temp);$i+=$readSize*2*$ch){
                    $val=$temp[$i].$temp[$i+1].$temp[$i+2].$temp[$i+3];

                    if(hexdec($temp[$i])>7 ){
                        $val= -(hexdec("FFFF")-hexdec($val)+1);
                    }else{
                        $val=hexdec($val);
                    }

                    $ret[$j][]=$val;

                }

            }
        }

        fclose($handle);

        return $ret;

  }

    public function origdata_readfile($filterFilePath,$dataFilePath,$startTime,$times,$drawLog=false,$starttimedatabase=''){

//        从数据库读出 现暂定为只有一通道
//        $ch=$ho[chanels];
        $ch=self::$chNums;

        $readSize=2;

        $ret=array();
        for($j=0;$j<$ch;$j++){
            $ret[$j]=array();
        }




        if(is_file($filterFilePath)){
            $filePath=$filterFilePath;

            $handle = fopen($filePath, "r");

            if(!$handle){
                fclose($handle);
                return $ret;
            }

            $n=date('s',$startTime);
            if($starttimedatabase!=''){
                $n=$startTime-$starttimedatabase;
            }


            $startPos=$n*self::$sampling*$readSize;
            $step=$times*self::$sampling*$readSize;

            if($drawLog){
                \Think\Log::write("read one min file type:filter startPos:$startPos step:$step",'INFO');
            }

            $temp=$this->readFile($handle,$startPos,$step);

        }else{
            $filePath=$dataFilePath;

            $handle = fopen($filePath, "r");

            if(!$handle){
                fclose($handle);
                return $ret;
            }

            $file_header_length=$this->readFileValue($handle,2,1);

            if($file_header_length<=0){
                fclose($handle);
                return $ret;
            }

//            print_r($file_header_length);exit;

            $file_header_length=pow(2,$file_header_length);

            $data_header_length=10;

            $data_start=$file_header_length+$data_header_length;

            $data_type=$this->readFile($handle,$data_start,1);

            if($data_type!='00'){
                fclose($handle);
                return $ret;
            }

            $data_size=$this->readFileValue($handle,$data_start+1,2);
            $data_size-=3;

            if($data_size<=0){
                fclose($handle);
                return $ret;
            }


            //开始时间的00秒的时间戳
            $n=date('s',$startTime);

            if($starttimedatabase!=''){
                $n=$startTime-$starttimedatabase;
            }


            //起始位置
            $startPos=$data_start+3+$n*self::$sampling*$readSize;
            $step=$times*self::$sampling*$readSize;

            if($drawLog){
                \Think\Log::write("read one min file type:orig startPos:$startPos step:$step",'INFO');
            }

            if($step>$data_size){
                $step=$data_size;
            }

            $temp=$this->readFile($handle,$startPos,$step);

        }


//        print_r($temp);exit();
//        print_r($startTime.','.$times.','.$startPos.','.$step);exit();


        if($ch==1){
            for($i=0;$i<strlen($temp);$i+=$readSize*2){

                $val=$temp[$i].$temp[$i+1].$temp[$i+2].$temp[$i+3];

                if(hexdec($temp[$i])>7 ){
                    $val= -(hexdec("FFFF")-hexdec($val)+1);
                }else{
                    $val=hexdec($val);
                }
                $ret[0][]=$val;
            }
        }else{
            for($j=0;$j<$ch;$j++){
                for($i=$j*$readSize*2;$i<strlen($temp);$i+=$readSize*2*$ch){
                    $val=$temp[$i].$temp[$i+1].$temp[$i+2].$temp[$i+3];

                    if(hexdec($temp[$i])>7 ){
                        $val= -(hexdec("FFFF")-hexdec($val)+1);
                    }else{
                        $val=hexdec($val);
                    }

                    $ret[$j][]=$val;

                }

            }
        }

        fclose($handle);
//        print_r($ret);exit;
        return $ret;


    }


}