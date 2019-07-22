<?php
namespace Home\Controller;
class CommonController extends BasicController {
	public function getArea() {
		$id = I("get.id/d");
		$lv = I("get.lv/d");
		$list = M("areas")->where("parent_id = $id")->select();
		echo json_encode($list);
		die;
	}
}