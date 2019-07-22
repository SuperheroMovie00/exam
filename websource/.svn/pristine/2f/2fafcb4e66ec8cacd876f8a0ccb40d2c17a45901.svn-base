<?php
/**
 * TOP API: taobao.wlb.wms.stock.pruduct.processing.notify request
 * 
 * @author auto create
 * @since 1.0, 2015.08.17
 */
class WlbWmsStockPruductProcessingNotifyRequest
{
	/** 
	 * 拓展属性，key-value结构，格式要求： 以英文分号“;”分隔每组key-value，以英文冒号“:”分隔key与value。如果value中带有分号，需要转成下划线“_”，如果带有冒号，需要转成中划线“-”
	 **/
	private $extendFields;
	
	/** 
	 * 原料商品列表
	 **/
	private $materialItems;
	
	/** 
	 * ERP单据编码
	 **/
	private $orderCode;
	
	/** 
	 * ERP单据创建时间
	 **/
	private $orderCreateTime;
	
	/** 
	 * 单据类型 1102 仓内加工作业单
	 **/
	private $orderType;
	
	/** 
	 * 计划数量
	 **/
	private $planQty;
	
	/** 
	 * ERP计划加工时间
	 **/
	private $planWorkTime;
	
	/** 
	 * 成品商品列表
	 **/
	private $productItems;
	
	/** 
	 * 备注
	 **/
	private $remark;
	
	/** 
	 * 加工类型: 1:仓内组合加工、2:仓内组合拆分
	 **/
	private $serviceType;
	
	/** 
	 * 仓库编码
	 **/
	private $storeCode;
	
	private $apiParas = array();
	
	public function setExtendFields($extendFields)
	{
		$this->extendFields = $extendFields;
		$this->apiParas["extend_fields"] = $extendFields;
	}

	public function getExtendFields()
	{
		return $this->extendFields;
	}

	public function setMaterialItems($materialItems)
	{
		$this->materialItems = $materialItems;
		$this->apiParas["material_items"] = $materialItems;
	}

	public function getMaterialItems()
	{
		return $this->materialItems;
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

	public function setOrderCreateTime($orderCreateTime)
	{
		$this->orderCreateTime = $orderCreateTime;
		$this->apiParas["order_create_time"] = $orderCreateTime;
	}

	public function getOrderCreateTime()
	{
		return $this->orderCreateTime;
	}

	public function setOrderType($orderType)
	{
		$this->orderType = $orderType;
		$this->apiParas["order_type"] = $orderType;
	}

	public function getOrderType()
	{
		return $this->orderType;
	}

	public function setPlanQty($planQty)
	{
		$this->planQty = $planQty;
		$this->apiParas["plan_qty"] = $planQty;
	}

	public function getPlanQty()
	{
		return $this->planQty;
	}

	public function setPlanWorkTime($planWorkTime)
	{
		$this->planWorkTime = $planWorkTime;
		$this->apiParas["plan_work_time"] = $planWorkTime;
	}

	public function getPlanWorkTime()
	{
		return $this->planWorkTime;
	}

	public function setProductItems($productItems)
	{
		$this->productItems = $productItems;
		$this->apiParas["product_items"] = $productItems;
	}

	public function getProductItems()
	{
		return $this->productItems;
	}

	public function setRemark($remark)
	{
		$this->remark = $remark;
		$this->apiParas["remark"] = $remark;
	}

	public function getRemark()
	{
		return $this->remark;
	}

	public function setServiceType($serviceType)
	{
		$this->serviceType = $serviceType;
		$this->apiParas["service_type"] = $serviceType;
	}

	public function getServiceType()
	{
		return $this->serviceType;
	}

	public function setStoreCode($storeCode)
	{
		$this->storeCode = $storeCode;
		$this->apiParas["store_code"] = $storeCode;
	}

	public function getStoreCode()
	{
		return $this->storeCode;
	}

	public function getApiMethodName()
	{
		return "taobao.wlb.wms.stock.pruduct.processing.notify";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->orderCode,"orderCode");
		RequestCheckUtil::checkNotNull($this->orderType,"orderType");
		RequestCheckUtil::checkNotNull($this->serviceType,"serviceType");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
