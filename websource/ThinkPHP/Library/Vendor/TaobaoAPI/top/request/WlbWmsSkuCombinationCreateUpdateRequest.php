<?php
/**
 * TOP API: taobao.wlb.wms.sku.combination.create.update request
 * 
 * @author auto create
 * @since 1.0, 2015.08.17
 */
class WlbWmsSkuCombinationCreateUpdateRequest
{
	/** 
	 * 组合子商品列表
	 **/
	private $destItem;
	
	/** 
	 * 需要创建组合关系的商品外部系统ID
	 **/
	private $itemId;
	
	/** 
	 * 货主编码
	 **/
	private $ownerUserId;
	
	/** 
	 * 组成组合商品比例
	 **/
	private $proportion;
	
	private $apiParas = array();
	
	public function setDestItem($destItem)
	{
		$this->destItem = $destItem;
		$this->apiParas["dest_item"] = $destItem;
	}

	public function getDestItem()
	{
		return $this->destItem;
	}

	public function setItemId($itemId)
	{
		$this->itemId = $itemId;
		$this->apiParas["item_id"] = $itemId;
	}

	public function getItemId()
	{
		return $this->itemId;
	}

	public function setOwnerUserId($ownerUserId)
	{
		$this->ownerUserId = $ownerUserId;
		$this->apiParas["owner_user_id"] = $ownerUserId;
	}

	public function getOwnerUserId()
	{
		return $this->ownerUserId;
	}

	public function setProportion($proportion)
	{
		$this->proportion = $proportion;
		$this->apiParas["proportion"] = $proportion;
	}

	public function getProportion()
	{
		return $this->proportion;
	}

	public function getApiMethodName()
	{
		return "taobao.wlb.wms.sku.combination.create.update";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->itemId,"itemId");
		RequestCheckUtil::checkNotNull($this->ownerUserId,"ownerUserId");
		RequestCheckUtil::checkNotNull($this->proportion,"proportion");
		RequestCheckUtil::checkMaxListSize($this->proportion,20,"proportion");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
