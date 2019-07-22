<?php

/**
 * 物流订单信息
 * @author auto create
 */
class LocOrder
{
	
	/** 
	 * 物流承运商
	 **/
	public $carrier;
	
	/** 
	 * 物流订单号
	 **/
	public $order_code;
	
	/** 
	 * 运费
	 **/
	public $shipping_fee;
	
	/** 
	 * 物流订单状态编码
	 **/
	public $status_code;
	
	/** 
	 * 物流运单号
	 **/
	public $tracking_no;
	
	/** 
	 * 交易订单号
	 **/
	public $trade_id;	
}
?>