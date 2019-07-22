<?php
namespace Summary\Widget;
use Think\Controller;
class AreaWidget extends Controller {
	public function show($tragetname,$value){
		$model=M("Area");
		$area_list=$model->where(array('parent_id'=>1))->select();
		$areawidget=array();
		if(!empty($value))
		{
			$arr=explode('/', $value);
			if(isset($arr[0]))
			{
				$areawidget['province']=$arr[0];
			}
			if(isset($arr[1]))
			{
				$areawidget['city']=$arr[1];
			}
			if(isset($arr[2]))
			{
				$areawidget['area']=$arr[2];
			}
			if(isset($arr[3]))
			{
				$areawidget['street']=$arr[3];
			}
				
		}
		$this->assign("areawidget",$areawidget);
		$this->assign("areawidget_name",$tragetname);
		$this->assign("area_list",$area_list);
		$this->display('Widget:Area:show');
	}
}