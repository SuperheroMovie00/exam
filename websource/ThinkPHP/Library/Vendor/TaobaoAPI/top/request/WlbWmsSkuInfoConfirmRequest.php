<?php
/**
 * TOP API: taobao.wlb.wms.sku.info.confirm request
 * 
 * @author auto create
 * @since 1.0, 2016.01.29
 */
class WlbWmsSkuInfoConfirmRequest
{
	/** 
	 * 商品资料回告
	 **/
	private $content;
	
	private $apiParas = array();
	
	public function setContent($content)
	{
		$this->content = $content;
		$this->apiParas["content"] = $content;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getApiMethodName()
	{
		return "taobao.wlb.wms.sku.info.confirm";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
