<?php
namespace Summary\Widget;
use Think\Controller;
class SummaryWidget extends Controller {
	public function javascript($class){
		$widget="Widget:$class:javascript";
    $templateFile   =   $this->view->parseTemplate($widget);
    if(!is_file($templateFile)) return ;
		layout(false);
		$this->display($widget);
	}
}