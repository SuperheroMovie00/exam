<?php
/**
 * TOP API: taobao.qimen.entryorder.confirm request
 * 
 * @author auto create
 * @since 1.0, 2017.06.23
 */
class EntryorderConfirmRequest
{
	/** 
	 * 入库单信息
	 **/
	private $entryOrder;
	
	/** 
	 * 扩展属性
	 **/
	private $extendProps;
	
	/** 
	 * 商品信息列表
	 **/
	private $items;
	
	/** 
	 * 订单信息
	 **/
	private $orderLines;
	
	private $apiParas = array();
	
	public function setEntryOrder($entryOrder)
	{
		$this->entryOrder = $entryOrder;
		$this->apiParas["entryOrder"] = $entryOrder;
	}

	public function getEntryOrder()
	{
		return $this->entryOrder;
	}

	public function setExtendProps($extendProps)
	{
		$this->extendProps = $extendProps;
		$this->apiParas["extendProps"] = $extendProps;
	}

	public function getExtendProps()
	{
		return $this->extendProps;
	}

	public function setItems($items)
	{
		$this->items = $items;
		$this->apiParas["items"] = $items;
	}

	public function getItems()
	{
		return $this->items;
	}

	public function setOrderLines($orderLines)
	{
		$this->orderLines = $orderLines;
		$this->apiParas["orderLines"] = $orderLines;
	}

	public function getOrderLines()
	{
		return $this->orderLines;
	}

	public function getApiMethodName()
	{
		return "taobao.qimen.entryorder.confirm";
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
