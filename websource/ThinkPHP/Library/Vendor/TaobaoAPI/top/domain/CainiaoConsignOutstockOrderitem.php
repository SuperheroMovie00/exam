<?php

/**
 * 商品信息
 * @author auto create
 */
class CainiaoConsignOutstockOrderitem
{
	
	/** 
	 * 商家对商品的编码
	 **/
	public $item_code;
	
	/** 
	 * 商品ID
	 **/
	public $item_id;
	
	/** 
	 * 应发商品数量
	 **/
	public $item_qty;
	
	/** 
	 * 商品缺货数量
	 **/
	public $lack_qty;
	
	/** 
	 * 失败原因（系统报缺，实物报缺)
	 **/
	public $reason;	
}
?>