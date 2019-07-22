<?php

/**
 * 商品SKU更新OuterId时候用的数据
 * @author auto create
 */
class UpdateSkuOuterId
{
	
	/** 
	 * 被更新的Sku的商家外部id；如果清空，传空串
	 **/
	public $outer_id;
	
	/** 
	 * Sku属性串。格式:pid:vid;pid:vid,如: 1627207:3232483;1630696:3284570,表示机身颜色:军绿色;手机套餐:一电一充
	 **/
	public $properties;
	
	/** 
	 * SKU的ID
	 **/
	public $sku_id;	
}
?>