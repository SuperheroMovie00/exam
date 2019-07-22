<?php
//Activity[is_enabled]  活动[是否启用]
static $Activity_is_enabled = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Activity[status]  活动[状态]
static $Activity_status = array("0"=>array("id"=>"0","name"=>"无效"),
		"1"=>array("id"=>"1","name"=>"有效"),
		"8"=>array("id"=>"8","name"=>"取消"),
		"9"=>array("id"=>"9","name"=>"删除"));

//ActivityGroup[type]  活动分组[类型]
static $ActivityGroup_type = array("1"=>array("id"=>"1","name"=>"开单送"),
		"2"=>array("id"=>"2","name"=>"首单送"),
		"3"=>array("id"=>"3","name"=>"金额到送"),
		"4"=>array("id"=>"4","name"=>"数量到送"));

//ActivityGroup[is_mutex]  活动分组[是否互斥]
static $ActivityGroup_is_mutex = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//ActivityGroup[is_enabled]  活动分组[是否启用]
static $ActivityGroup_is_enabled = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Area[type]  地区[类型]
static $Area_type = array("0"=>array("id"=>"0","name"=>"国家"),
		"1"=>array("id"=>"1","name"=>"省市"),
		"2"=>array("id"=>"2","name"=>"地区"),
		"3"=>array("id"=>"3","name"=>"县市"),
		"4"=>array("id"=>"4","name"=>"区域"),
		"5"=>array("id"=>"5","name"=>"街道"));

//Area[status]  地区[状态]
static $Area_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Brand[is_system]  品牌[是否系统内置]
static $Brand_is_system = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Brand[status]  品牌[状态]
static $Brand_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Buyer[sex]  买家[性别]
static $Buyer_sex = array("0"=>array("id"=>"0","name"=>"女"),
		"1"=>array("id"=>"1","name"=>"男"),
		"2"=>array("id"=>"2","name"=>"保密"));

//Buyer[is_blacklist]  买家[是否黑名单]
static $Buyer_is_blacklist = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Buyer[status]  买家[状态]
static $Buyer_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//BuyerConsignee[status]  买家收货人[状态]
static $BuyerConsignee_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Category[visibility]  分类[首页显示]
static $Category_visibility = array("1"=>array("id"=>"1","name"=>"显示"),
		"0"=>array("id"=>"0","name"=>"不显示"));

//Category[status]  分类[状态]
static $Category_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Customer[status]  供应商[状态]
static $Customer_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Deliver[is_system]  配送方式[是否系统内置]
static $Deliver_is_system = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Deliver[status]  配送方式[状态]
static $Deliver_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Department[status]  部门[状态]
static $Department_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Goods[type]  商品信息[类型]
static $Goods_type = array("0"=>array("id"=>"0","name"=>"普通"),
		"1"=>array("id"=>"1","name"=>"补邮"),
		"2"=>array("id"=>"2","name"=>"赠品"));

//Goods[is_real]  商品信息[是否实物]
static $Goods_is_real = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Goods[putaway]  商品信息[上下架状态]
static $Goods_putaway = array("0"=>array("id"=>"0","name"=>"未上架"),
		"1"=>array("id"=>"1","name"=>"申请上架"),
		"2"=>array("id"=>"2","name"=>"已上架"),
		"3"=>array("id"=>"3","name"=>"已下架"));

//Goods[status]  商品信息[状态]
static $Goods_status = array("0"=>array("id"=>"0","name"=>"库存"),
		"1"=>array("id"=>"1","name"=>"可售"),
		"9"=>array("id"=>"9","name"=>"删除"));

//HangupTag[is_system]  挂起标签[系统内置]
static $HangupTag_is_system = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//HangupTag[status]  挂起标签[状态]
static $HangupTag_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//LogData[type]  单据处理日志[单据类型]
static $LogData_type = array("1"=>array("id"=>"1","name"=>"网络订单"),
		"2"=>array("id"=>"2","name"=>"销售订单"),
		"3"=>array("id"=>"3","name"=>"采购通知单"),
		"4"=>array("id"=>"4","name"=>"仓库入库单"),
		"5"=>array("id"=>"5","name"=>"仓库出库单"),
		"6"=>array("id"=>"6","name"=>"仓库移仓单"),
		"7"=>array("id"=>"7","name"=>"仓库调整单"),
		"8"=>array("id"=>"8","name"=>"仓库盘点单"));

//LogModel[type]  模块日志[类型]
static $LogModel_type = array("1"=>array("id"=>"1","name"=>"login"),
		"2"=>array("id"=>"2","name"=>"logout"),
		"3"=>array("id"=>"3","name"=>"model"));

//OrderSwitch[is_enabled]  转单规则[是否启用]
static $OrderSwitch_is_enabled = array("0"=>array("id"=>"0","name"=>"关闭"),
		"1"=>array("id"=>"1","name"=>"启用"));

//OrderTag[type]  标签[类型]
static $OrderTag_type = array("0"=>array("id"=>"0","name"=>"网单"),
		"1"=>array("id"=>"1","name"=>"退单"));

//OrderTag[is_system]  标签[系统内置]
static $OrderTag_is_system = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//OrderTag[status]  标签[状态]
static $OrderTag_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Payment[type]  支付方式[类型]
static $Payment_type = array("0"=>array("id"=>"0","name"=>"担保交易"),
		"1"=>array("id"=>"1","name"=>"货到付款"));

//Payment[is_system]  支付方式[系统内置]
static $Payment_is_system = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Payment[status]  支付方式[状态]
static $Payment_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Platform[is_system]  销售平台[系统内置]
static $Platform_is_system = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Platform[status]  销售平台[状态]
static $Platform_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Product[type]  商品sku[类型]
static $Product_type = array("0"=>array("id"=>"0","name"=>"普通"),
		"1"=>array("id"=>"1","name"=>"补邮"),
		"2"=>array("id"=>"2","name"=>"赠品"));

//Product[is_real]  商品sku[是否实物]
static $Product_is_real = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Product[putaway]  商品sku[上架状态]
static $Product_putaway = array("0"=>array("id"=>"0","name"=>"未上架"),
		"1"=>array("id"=>"1","name"=>"申请上架"),
		"2"=>array("id"=>"2","name"=>"已上架"),
		"3"=>array("id"=>"3","name"=>"已下架"));

//Product[status]  商品sku[状态]
static $Product_status = array("0"=>array("id"=>"0","name"=>"无效"),
		"1"=>array("id"=>"1","name"=>"有效"),
		"9"=>array("id"=>"9","name"=>"删除"));

//Purchase[type]  采购通知单[采购类型]
static $Purchase_type = array("0"=>array("id"=>"0","name"=>"采购进货"),
		"1"=>array("id"=>"1","name"=>"采购退货"));

//Purchase[notice_status]  采购通知单[通知状态]
static $Purchase_notice_status = array("0"=>array("id"=>"0","name"=>"未通知"),
		"1"=>array("id"=>"1","name"=>"已通知"));

//Purchase[stock_status]  采购通知单[入库状态]
static $Purchase_stock_status = array("0"=>array("id"=>"0","name"=>"未入库"),
		"1"=>array("id"=>"1","name"=>"已入库"));

//Purchase[status]  采购通知单[状态]
static $Purchase_status = array("0"=>array("id"=>"0","name"=>"未确认"),
		"1"=>array("id"=>"1","name"=>"已确认"),
		"2"=>array("id"=>"2","name"=>"已完成"),
		"9"=>array("id"=>"9","name"=>"删除"));

//ReturnReason[is_system]  退货原因[系统内置]
static $ReturnReason_is_system = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//ReturnReason[status]  退货原因[状态]
static $ReturnReason_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Sales[payment_status]  销售订单[付款状态]
static $Sales_payment_status = array("0"=>array("id"=>"0","name"=>"未付款"),
		"1"=>array("id"=>"1","name"=>"已付款"));

//Sales[invoice_status]  销售订单[开票需求]
static $Sales_invoice_status = array("0"=>array("id"=>"0","name"=>"不开票"),
		"1"=>array("id"=>"1","name"=>"要开票"),
		"2"=>array("id"=>"2","name"=>"已开票"));

//Sales[deliver_status]  销售订单[仓库发货]
static $Sales_deliver_status = array("0"=>array("id"=>"0","name"=>"未发货"),
		"1"=>array("id"=>"1","name"=>"已发货"));

//Sales[cancel_status]  销售订单[作废状态]
static $Sales_cancel_status = array("0"=>array("id"=>"0","name"=>"未作废"),
		"1"=>array("id"=>"1","name"=>"已作废"));

//Sales[notice_status]  销售订单[通知配货]
static $Sales_notice_status = array("0"=>array("id"=>"0","name"=>"未通知"),
		"1"=>array("id"=>"1","name"=>"已通知"));

//Sales[confirm_type]  销售订单[确认类型]
static $Sales_confirm_type = array("0"=>array("id"=>"0","name"=>"不需要"),
		"1"=>array("id"=>"1","name"=>"问题订单"),
		"2"=>array("id"=>"2","name"=>"部分缺货"),
		"3"=>array("id"=>"3","name"=>"全部缺货"));

//Sales[confirm_status]  销售订单[确认状态]
static $Sales_confirm_status = array("0"=>array("id"=>"0","name"=>"未确认"),
		"1"=>array("id"=>"1","name"=>"已确认"));

//Sales[status]  销售订单[状态]
static $Sales_status = array("0"=>array("id"=>"0","name"=>"待付款"),
		"1"=>array("id"=>"1","name"=>"待确认"),
		"2"=>array("id"=>"2","name"=>"待配货"),
		"3"=>array("id"=>"3","name"=>"配货中"),
		"4"=>array("id"=>"4","name"=>"已发货"),
		"5"=>array("id"=>"5","name"=>"已作废"),
		"9"=>array("id"=>"9","name"=>"删除"));

//Sales[is_hangup]  销售订单[是否挂起]
static $Sales_is_hangup = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//SalesConfirm[type]  订单审单明细[问题类型]
static $SalesConfirm_type = array("1"=>array("id"=>"1","name"=>"买家留言"),
		"2"=>array("id"=>"2","name"=>"外国订单"),
		"3"=>array("id"=>"3","name"=>"退款申请"),
		"4"=>array("id"=>"4","name"=>""),
		"5"=>array("id"=>"5","name"=>""));

//SalesConfirm[status]  订单审单明细[状态]
static $SalesConfirm_status = array("0"=>array("id"=>"0","name"=>"未确认"),
		"1"=>array("id"=>"1","name"=>"已确认"),
		"9"=>array("id"=>"9","name"=>"被取消"));

//Season[status]  季节[状态]
static $Season_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Season[is_system]  季节[是否系统内置]
static $Season_is_system = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Shop[status]  店铺[状态]
static $Shop_status = array("0"=>array("id"=>"0","name"=>"无效"),
		"1"=>array("id"=>"1","name"=>"有效"),
		"9"=>array("id"=>"9","name"=>"删除"));

//ShopProduct[is_matched]  店铺商品[是否吻合]
static $ShopProduct_is_matched = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//StockAdjust[type]  仓库调整单[类型]
static $StockAdjust_type = array("1"=>array("id"=>"1","name"=>"差异调整"),
		"2"=>array("id"=>"2","name"=>"拆装调整"),
		"3"=>array("id"=>"3","name"=>"盘点调整"),
		"4"=>array("id"=>"4","name"=>"期初调整"));

//StockAdjust[status]  仓库调整单[状态]
static $StockAdjust_status = array("0"=>array("id"=>"0","name"=>"未确认"),
		"1"=>array("id"=>"1","name"=>"已确认"),
		"2"=>array("id"=>"2","name"=>"已验收"),
		"8"=>array("id"=>"8","name"=>"已取消"),
		"9"=>array("id"=>"9","name"=>"已删除"));

//StockIn[type]  仓库入库单[类型]
static $StockIn_type = array("0"=>array("id"=>"0","name"=>"采购进货"),
		"1"=>array("id"=>"1","name"=>"销售退货"));

//StockIn[status]  仓库入库单[状态]
static $StockIn_status = array("0"=>array("id"=>"0","name"=>"未确认"),
		"1"=>array("id"=>"1","name"=>"已确认"),
		"2"=>array("id"=>"2","name"=>"已验收"),
		"8"=>array("id"=>"8","name"=>"已取消"),
		"9"=>array("id"=>"9","name"=>"已删除"));

//StockMove[status]  移仓单[状态]
static $StockMove_status = array("0"=>array("id"=>"0","name"=>"待确认"),
		"1"=>array("id"=>"1","name"=>"已确认"),
		"2"=>array("id"=>"2","name"=>"已出库"),
		"3"=>array("id"=>"3","name"=>"已入库"),
		"8"=>array("id"=>"8","name"=>"已取消"),
		"9"=>array("id"=>"9","name"=>"已删除"));

//StockMovement[type]  库存异动[单据类型]
static $StockMovement_type = array("1"=>array("id"=>"1","name"=>"网络订单"),
		"2"=>array("id"=>"2","name"=>"销售订单"),
		"3"=>array("id"=>"3","name"=>"采购通知单"),
		"4"=>array("id"=>"4","name"=>"仓库入库单"),
		"5"=>array("id"=>"5","name"=>"仓库出库单"),
		"6"=>array("id"=>"6","name"=>"仓库移仓单"),
		"7"=>array("id"=>"7","name"=>"仓库调整单"),
		"8"=>array("id"=>"8","name"=>"仓库盘点单"));

//StockMovement[is_stockout]  库存异动[是否出库]
static $StockMovement_is_stockout = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//StockOut[status]  仓库出库单[状态]
static $StockOut_status = array("0"=>array("id"=>"0","name"=>"未确认"),
		"2"=>array("id"=>"2","name"=>"已确认"),
		"3"=>array("id"=>"3","name"=>"已验收"),
		"8"=>array("id"=>"8","name"=>"已取消"),
		"9"=>array("id"=>"9","name"=>"已删除"));

//StockOut[type]  仓库出库单[出库类型]
static $StockOut_type = array("1"=>array("id"=>"1","name"=>"销售出库"),
		"2"=>array("id"=>"2","name"=>"采购退货"));

//StockOut[is_stocked]  仓库出库单[是否出库]
static $StockOut_is_stocked = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Storage[type]  仓库[类别]
static $Storage_type = array("0"=>array("id"=>"0","name"=>"虚仓"),
		"1"=>array("id"=>"1","name"=>"实仓"));

//Storage[is_deliver]  仓库[缺货商品是否配送]
static $Storage_is_deliver = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Storage[status]  仓库[状态]
static $Storage_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Style1[status]  规格1(颜色)[状态]
static $Style1_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Style1[is_system]  规格1(颜色)[是否系统内置]
static $Style1_is_system = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//Style2[status]  规格2(尺码)[状态]
static $Style2_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Style2[is_system]  规格2(尺码)[是否系统内置]
static $Style2_is_system = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//User[status]  用户[状态]
static $User_status = array("0"=>array("id"=>"0","name"=>"无效"));

//User[superadmin]  用户[是否超级管理员]
static $User_superadmin = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//User[sex]  用户[性别]
static $User_sex = array("0"=>array("id"=>"0","name"=>"女"),
		"1"=>array("id"=>"1","name"=>"男"),
		"2"=>array("id"=>"2","name"=>"保密"));

//WebOrder[invoice_status]  网络订单[开票需求]
static $WebOrder_invoice_status = array("0"=>array("id"=>"0","name"=>"不开票"),
		"1"=>array("id"=>"1","name"=>"要开票"),
		"2"=>array("id"=>"2","name"=>"已开票"));

//WebOrder[payment_status]  网络订单[支付状态]
static $WebOrder_payment_status = array("0"=>array("id"=>"0","name"=>"未付款"),
		"1"=>array("id"=>"1","name"=>"已付款"));

//WebOrder[switch_allow]  网络订单[允许转单]
static $WebOrder_switch_allow = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//WebOrder[switch_failed]  网络订单[转单失败]
static $WebOrder_switch_failed = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//WebOrder[switch_status]  网络订单[转单状态]
static $WebOrder_switch_status = array("0"=>array("id"=>"0","name"=>"未转单"),
		"1"=>array("id"=>"1","name"=>"已转单"));

//WebOrder[status]  网络订单[状态]
static $WebOrder_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"8"=>array("id"=>"8","name"=>"已取消"),
		"9"=>array("id"=>"9","name"=>"已删除"));

//WebRefund[refund_all]  网络退单[整单退款]
static $WebRefund_refund_all = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//WebRefund[switch_allow]  网络退单[允许转单]
static $WebRefund_switch_allow = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//WebRefund[switch_failed]  网络退单[转单失败]
static $WebRefund_switch_failed = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));

//WebRefund[switch_status]  网络退单[转单状态]
static $WebRefund_switch_status = array("0"=>array("id"=>"0","name"=>"未转单"),
		"1"=>array("id"=>"1","name"=>"已转单"));

//WebRefund[status]  网络退单[状态]
static $WebRefund_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"8"=>array("id"=>"8","name"=>"已取消"),
		"9"=>array("id"=>"9","name"=>"已删除"));

//Year[status]  年份[状态]
static $Year_status = array("1"=>array("id"=>"1","name"=>"有效"),
		"0"=>array("id"=>"0","name"=>"无效"));

//Year[is_system]  年份[是否系统内置]
static $Year_is_system = array("1"=>array("id"=>"1","name"=>"是"),
		"0"=>array("id"=>"0","name"=>"否"));