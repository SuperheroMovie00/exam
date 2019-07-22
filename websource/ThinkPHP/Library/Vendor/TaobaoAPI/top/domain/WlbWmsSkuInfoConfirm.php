<?php

/**
 * 商品资料回告
 * @author auto create
 */
class WlbWmsSkuInfoConfirm
{
	
	/** 
	 * 条形码，多条码请用”；”分隔
	 **/
	public $bar_code;
	
	/** 
	 * 毛重，单位克
	 **/
	public $gross_weight;
	
	/** 
	 * 高度，单位厘米
	 **/
	public $height;
	
	/** 
	 * 后端商品ID
	 **/
	public $item_id;
	
	/** 
	 * 长度，单位厘米
	 **/
	public $length;
	
	/** 
	 * 净重，单位克
	 **/
	public $net_weight;
	
	/** 
	 * 体积，单位立方厘米
	 **/
	public $volume;
	
	/** 
	 * 宽度，单位厘米
	 **/
	public $width;	
}
?>