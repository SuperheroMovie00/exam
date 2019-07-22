<?php
namespace Common\Model;
use Think\Model;
class HolterOrigOnlineModel extends Model {
    protected $tableName = 'holter_orig_online';


	public function getHolterOrigOnlineIndex($holterId,$startTime,$endTime){

		$readSecond=30;
		$requiredSecond=20;
		$optionalSecond=$readSecond-$requiredSecond;
		$sampling=125;
		$samplingPoints=480;
		$unitSecond=$samplingPoints/$sampling;

		$readSecond=$unitSecond*$unitSecond;
		$ms2s=1000;

		$timeout=3000;


		//最少相隔1ms 因为现在间隔是变长
//		$startTime+=1;

		//$rets=$this->field('holter_id,data,starttime,endtime,times,hr_aver')->where("holter_id=%d and starttime>='%s' and endtime<='%s'",array($holterId,$startTime,$endTime))->order('starttime ASC')->select();
		$rets=$this->field('holter_id,data,starttime,endtime,times,hr_aver')->where("holter_id=%d and starttime>='%s'",array($holterId,$startTime))->order('starttime ASC')->select();


		$record=array();
		$heart=array();

        $p2=$endTime-$optionalSecond*$ms2s;
		$lastTime=$startTime;


		foreach ($rets as $k => $v) {

		   if($v['starttime'] - $lastTime >= $timeout  && $v['starttime']>=$p2 ){
			   break;
		   }
			$d=explode(':',$v['data']);
			foreach ($d as $kk=>$vv) {
				$record[$v['starttime']]['data'][$kk]=explode(',',$vv);
				$h['hr_aver']=$v['hr_aver'];
				$h['points']=count($record[$v['starttime']]['data'][$kk]);
				$heart[]=$h;
			}

			$record[$v['starttime']]['hr_aver']=$v['hr_aver'];

			$lastTime=$v['endtime'];
		}



		$last_time=$lastTime>0?$lastTime:-1;
		return array(
				"point"=>array(
					'ecg'=>$record,
					'sp02'=>array(),
					'hr'=>array(),
					'hr_aver'=>$heart,
				),
				"last_time"=>$last_time
		);

	}

	public function getHolterOrigOnlinePad($holterId,$startTime,$endTime){

		$readSecond=30;
		$requiredSecond=20;
		$optionalSecond=$readSecond-$requiredSecond;
		$sampling=125;
		$samplingPoints=480;
		$unitSecond=$samplingPoints/$sampling;

		$readSecond=$unitSecond*$unitSecond;
		$ms2s=1000;

		$timeout=3000;

		//最少相隔1ms 因为现在间隔是变长
//		$startTime+=1;

		$rets=$this->field('holter_id,data,data_breath,starttime,endtime,times,hr_aver')->where("holter_id=%d and starttime>='%s' and endtime<='%s'",array($holterId,$startTime,$endTime))->order('starttime ASC')->select();


		$record=array();
		$resp=array();
		$hr=array();

		$p2=$endTime-$optionalSecond*$ms2s;
		$lastTime=$startTime;


		foreach ($rets as $k => $v) {

			if($v['starttime'] - $lastTime >= $timeout  && $v['starttime']>=$p2 ){
				break;
			}
			$d=explode(':',$v['data']);
			$db=explode(':',$v['data_breath']);

			foreach ($d as $kk=>$vv) {
				$record[$v['starttime']]['data'][$kk]=explode(',',trim($vv,','));
//				$resp[$v['starttime']]['data'][$kk]=array_fill(0,count($record[$v['starttime']]['data'][0])/5,'3');
				$h['hr_aver']=$v['hr_aver'];
				$h['points']=count($record[$v['starttime']]['data'][$kk]);
				$hr[]=$h;
			}

			foreach ($db as $kb=>$vb) {
				$resp[$v['starttime']]['data'][$kb]=explode(',',trim($vb,','));
			}

			$lastTime=$v['endtime'];
		}


		$last_time=$lastTime>0?$lastTime:-1;
		return array(
				"point"=>array(
					'ecg'=>$record,
					'hr_aver'=>$hr,
					'resp'=>$resp,
					'pletn'=>array()
				),
				"last_time"=>$last_time
		);

	}


}