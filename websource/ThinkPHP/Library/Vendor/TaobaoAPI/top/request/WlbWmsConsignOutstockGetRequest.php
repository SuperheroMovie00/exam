<?php
/**
 * TOP API: taobao.wlb.wms.consign.outstock.get request
 * 
 * @author auto create
 * @since 1.0, 2015.09.22
 */
class WlbWmsConsignOutstockGetRequest
{
	/** 
	 * 菜鸟订单编码,cnOrderCode与orderCode必须有一个值不可为空
	 **/
	private $cnOrderCode;
	
	/** 
	 * ERP订单编码,cnOrderCode与orderCode必须有一个值不可为空
	 **/
	private $orderCode;
	
	private $apiParas = array();
	
	public function setCnOrderCode($cnOrderCode)
	{
		$this->cnOrderCode = $cnOrderCode;
		$this->apiParas["cn_order_code"] = $cnOrderCode;
	}

	public function getCnOrderCode()
	{
		return $this->cnOrderCode;
	}

	public function setOrderCode($orderCode)
	{
		$this->orderCode = $orderCode;
		$this->apiParas["order_code"] = $orderCode;
	}

	public function getOrderCode()
	{
		return $this->orderCode;
	}

	public function getApiMethodName()
	{
		return "taobao.wlb.wms.consign.outstock.get";
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
