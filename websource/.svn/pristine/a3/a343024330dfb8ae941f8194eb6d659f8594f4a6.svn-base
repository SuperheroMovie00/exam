/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50537
Source Host           : 127.0.0.1:3306
Source Database       : asr2017wms

Target Server Type    : MYSQL
Target Server Version : 50537
File Encoding         : 65001

Date: 2018-04-02 20:18:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for erp_node
-- ----------------------------
DROP TABLE IF EXISTS `erp_node`;
CREATE TABLE `erp_node` (
  `id` varchar(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '模块名称',
  `title` varchar(50) DEFAULT NULL COMMENT '模块描述',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态:1;有效#0;无效',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `sort` smallint(6) DEFAULT '0' COMMENT '排序',
  `pid` int(11) DEFAULT '0' COMMENT '父层',
  `level` tinyint(1) DEFAULT '0' COMMENT '级别',
  `module` varchar(255) DEFAULT NULL COMMENT '模块说明',
  `model` varchar(30) DEFAULT NULL COMMENT '启动方式',
  `btn_name` varchar(50) DEFAULT NULL COMMENT '按钮名称',
  `is_admin` tinyint(4) DEFAULT '0',
  `ico` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模块功能';

-- ----------------------------
-- Records of erp_node
-- ----------------------------
INSERT INTO `erp_node` VALUES ('10', 'X10', '主页', '0', null, '9999', '0', '1', null, '', null, '0', '&#xe608;');
INSERT INTO `erp_node` VALUES ('15', 'X15', '销售管理', '1', null, '9999', '0', '1', null, '', null, '0', '&#xe60c;');
INSERT INTO `erp_node` VALUES ('1500', 'X1500', '平台交易', '1', '', '9999', '15', '2', '', '', '', '0', '');
INSERT INTO `erp_node` VALUES ('150000', 'X150000', '平台商品信息列表', '1', '', '9999', '1500', '3', '/Summary/PlatformGoodsSummary/index?func=search', '', '', '0', '');
INSERT INTO `erp_node` VALUES ('150005', 'X150005', '平台交易订单列表', '1', '', '9999', '1500', '3', '/Summary/PlatformSalesSummary/index?func=search', '', '', '0', '');
INSERT INTO `erp_node` VALUES ('150010', 'X150010', '平台发货回传列表', '1', '', '9999', '1500', '3', '/Summary/UploadSalesSummary/index?func=search', '', '', '0', '');
INSERT INTO `erp_node` VALUES ('150015', 'X150015', '平台退货回传列表', '1', '', '9999', '1500', '3', '/Summary/UploadRefundSummary/index?func=search', '', '', '0', '');
INSERT INTO `erp_node` VALUES ('150020', 'X150020', '平台入库回传列表', '0', '', '9999', '1500', '3', '/Summary/UploadPurchaseSummary/index?func=search', '', '', '0', '');
INSERT INTO `erp_node` VALUES ('150025', 'X150025', '平台订单拦截列表', '1', '', '9999', '1500', '3', '/Summary/DownloadInterceptSummary/index?func=search', ' ', '', '0', '');
INSERT INTO `erp_node` VALUES ('1501', 'X1500', '客户信息', '1', null, '9999', '15', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('150100', 'X150000', '客户分类信息', '1', null, '9999', '1501', '3', '/Summary/CustomerCategorySummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('150105', 'X150005', '客户信息列表', '1', null, '9999', '1501', '3', '/Summary/CustomerSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('1505', 'X1505', '销售订单', '1', null, '9999', '15', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('150510', 'X150510', '销售订单列表', '1', null, '9999', '1505', '3', '/Summary/SalesSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('150515', 'X150515', '销售订单商品明细', '1', null, '9999', '1505', '3', '/Summary/SalesDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('150516', 'X150516', '-', '1', null, '9999', '1505', '3', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('150517', 'X150517', '发货中订单列表', '1', null, '9999', '1505', '3', '/Summary/SalesUndeliverSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('150518', 'X150518', '已交货订单列表', '1', null, '9999', '1505', '3', '/Summary/SalesDeliverSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('1510', 'X1510', '销售退单', '0', null, '9999', '15', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('151005', 'X151005', '销售退单列表', '0', null, '9999', '1510', '3', '/Summary/SalesRefundSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('151010', 'X151010', '销售退单商品明细', '0', null, '9999', '1510', '3', '/Summary/SalesRefundDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('1520', 'X1520', '订单配货', '1', null, '9999', '15', '2', '', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('152001', 'X152001', '批量配货处理', '1', null, '9999', '1520', '3', '/Home/SalesAssign/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('152002', 'X2505', '配货日志列表', '0', null, '9999', '1520', '3', '/Summary/LogSalesAssignSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('152006', 'X400515', '新增商品分类', '0', null, '9999', '4005', '3', '/Home/Category/add', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('152008', 'X152008', '配货日志列表', '1', null, '9999', '1520', '3', '/Summary/LogSalesAssignSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('152009', 'X152009', '-', '1', null, '9999', '1520', '3', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('152025', 'X152025', '配货失败列表', '1', null, '9999', '1520', '3', '/Summary/SalesMissSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('153010', 'X153010', '订单发货处理', '0', null, '9999', '1530', '3', '/Home/StockOut/index?func=delivery', 'pop', null, '0', null);
INSERT INTO `erp_node` VALUES ('20', 'X20', '采购管理', '1', null, '9999', '0', '1', null, '', null, '0', '&#xe60b;');
INSERT INTO `erp_node` VALUES ('2000', 'X2000', '平台交易', '1', null, '9999', '20', '2', '/Summary/SalesHangupSummary/index?func=search', null, null, '0', null);
INSERT INTO `erp_node` VALUES ('200000', 'X200000', '平台采购通知', '1', null, '9999', '2000', '3', '/Summary/PurchasePlatformSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('200005', 'X200005', '平台入库回传', '1', null, '9999', '2000', '3', '/Summary/UploadPurchaseSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2002', 'X2002', '供应商信息', '1', null, '9999', '20', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('200200', 'X200200', '客户分类信息', '1', null, '9999', '2002', '3', '/Summary/SupplyCategorySummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('200205', 'X200205', '客户信息列表', '1', null, '9999', '2002', '3', '/Summary/SupplySummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2005', 'X2005', '采购进货', '1', null, '9999', '20', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('200505', 'X200505', '采购订单列表', '1', null, '9999', '2005', '3', '/Summary/PurchaseSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('200510', 'X200510', '采购订单商品明细', '1', null, '9999', '2005', '3', '/Summary/PurchaseDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2010', 'X2010', '采购退货', '0', null, '9999', '20', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('201005', 'X201005', '采购退单列表', '0', null, '9999', '2010', '3', '/Summary/PurchaseReturnSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('201010', 'X201010', '采购退单商品明细', '0', null, '9999', '2010', '3', '/Summary/PurchaseReturnDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('24', 'X24', '生产管理', '0', null, '9999', '0', '1', null, '', null, '0', '&#xe606;');
INSERT INTO `erp_node` VALUES ('2400', 'X2400', '信息登记', '1', null, '9999', '24', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('240000', 'X240000', '商品信息列表', '1', null, '9999', '2400', '3', '/Summary/GoodsSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('240001', 'X242001', '商品BOM列表', '1', null, '9999', '2400', '3', '/Summary/GoodsBomSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('240002', 'X242002', '质检指标列表', '1', null, '9999', '2400', '3', '/Summary/GoodsQcSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('240005', 'X242005', '生产设备列表', '1', null, '9999', '2400', '3', '/Summary/DeviceSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2402', 'X2402', '生产计划', '1', null, '9999', '24', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('240200', 'X240200', '生产计划列表', '1', null, '9999', '2402', '3', '/Summary/ProductionSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('240205', 'X240205', '生产任务分配列表', '1', null, '9999', '2402', '3', '/Summary/ProductionAssignSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2405', 'X2405', '任务执行', '1', null, '9999', '24', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('240500', 'X240500', '领料通知列表', '1', null, '9999', '2405', '3', '/Summary/ProductionStockSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('240501', 'X240501', '领料通知商品列表', '1', null, '9999', '2405', '3', '/Summary/ProductionStockDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('240505', 'X240505', '生产工时列表', '1', null, '9999', '2405', '3', '/Summary/ProductionHourSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('240506', 'X240506', '生产工时明细列表', '1', null, '9999', '2405', '3', '/Summary/ProductionHourDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('240510', 'X240510', '生产质检列表', '1', null, '9999', '2405', '3', '/Summary/ProductionQcSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2410', 'X2410', '产品管理', '1', null, '9999', '24', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('241000', 'X241000', '生产产品列表', '1', null, '9999', '2410', '3', '/Summary/ProductionRegSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2415', 'X2415', '生产出入库', '1', null, '9999', '24', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('241501', 'X241501', '生产领料出库列表', '1', null, '9999', '2415', '3', '/Summary/PstockOutSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('241502', 'X241502', '生产领料出库商品列表', '1', null, '9999', '2415', '3', '/Summary/PstockOutDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('241515', 'X241515', '生产入库列表', '1', null, '9999', '2415', '3', '/Summary/PstockInSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('241516', 'X241516', '生产入库商品列表', '1', null, '9999', '2415', '3', '/Summary/PstockInDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('25', 'X25', '仓库管理', '1', null, '9999', '0', '1', null, '', null, '0', '&#xe60b;');
INSERT INTO `erp_node` VALUES ('2500', 'X2500', '商品信息', '1', null, '9999', '25', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('250000', 'X250000', '商品分类列表', '1', null, '9999', '2500', '3', '/Summary/CategorySummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('250005', 'X250005', '商品品牌列表', '1', null, '9999', '2500', '3', '/Summary/BrandSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('250010', 'X250010', '商品信息列表', '1', null, '9999', '2500', '3', '/Summary/GoodsSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2510', 'X2510', '库存信息', '1', null, '9999', '25', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('251000', 'X251000', '商品库存列表', '1', null, '9999', '2510', '3', '/Summary/Stock1Summary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('251005', 'X251005', '仓库库存列表', '1', null, '9999', '2510', '3', '/Summary/Stock2Summary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('251010', 'X251019', '库位库存列表', '1', null, '9999', '2510', '3', '/Summary/Stock3Summary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('251015', 'X251015', '仓库商品异动列表', '1', null, '9999', '2510', '3', '/Summary/StockMovement2Summary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2515', 'X2515', '商品入库', '1', null, '9999', '25', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('251510', 'X251510', '采购到货通知', '1', null, '9999', '2515', '3', '/Summary/PurchaseDeliverSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('251515', 'X251515', '商品入库列表', '1', null, '9999', '2515', '3', '/Summary/StockInSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('251525', 'X251525', '商品入库商品明细', '1', null, '9999', '2515', '3', '/Summary/StockInDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2517', 'X2517', '商品出库', '1', null, '9999', '25', '2', null, null, null, '0', null);
INSERT INTO `erp_node` VALUES ('251701', 'X251701', '订单发货处理', '1', null, '9999', '2517', '3', '/Home/StockOut/index?func=delivery', 'pop', null, '0', null);
INSERT INTO `erp_node` VALUES ('251710', 'X251710', '商品出库列表', '1', null, '9999', '2517', '3', '/Summary/StockOutSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('251715', 'X251715', '商品出库商品明细', '1', null, '9999', '2517', '3', '/Summary/StockOutDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2520', 'X2520', '库存调整', '1', null, '9999', '25', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('252005', 'X252005', '库存调整列表', '1', null, '9999', '2520', '3', '/Summary/StockAdjustSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('252010', 'X252010', '库存调整商品明细', '1', null, '9999', '2520', '3', '/Summary/StockAdjustDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2525', 'X2525', '商品移仓', '1', null, '9999', '25', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('252505', 'X252505', '商品移仓列表  ', '1', null, '9999', '2525', '3', '/Summary/StockMoveSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('252510', 'X252510', '商品移仓商品明细', '1', null, '9999', '2525', '3', '/Summary/StockMoveDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('2530', 'X2530', '仓库盘点', '1', null, '9999', '25', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('253005', 'X253005', '仓库盘点列表', '1', null, '9999', '2530', '3', '/Summary/StockCheckSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('253010', 'X253010', '仓库盘点商品明细', '1', null, '9999', '2530', '3', '/Summary/StockCheckDetailSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('35', 'X35', '系统管理', '1', null, '9999', '0', '1', null, '', null, '0', '&#xe606;');
INSERT INTO `erp_node` VALUES ('3500', 'X3500', '部门用户', '1', null, '9999', '35', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('350000', 'X350000', '用户列表', '1', null, '9999', '3500', '3', '/Summary/UserSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('350005', 'X350005', '部门列表', '1', null, '9999', '3500', '3', '/Summary/DepartmentSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('3501', 'X3501', '仓库管理', '1', null, '9999', '35', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('350105', 'X350105', '仓库列表', '1', null, '9999', '3501', '3', '/Summary/StorageSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('350110', 'X350110', '仓库库位列表', '1', null, '9999', '3501', '3', '/Summary/StorageLocationSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('3503', 'X3503', '基础数据', '1', null, '9999', '35', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('350300', 'X350300', '国家地区列表', '1', null, '9999', '3503', '3', '/Summary/AreaSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('350305', 'X350305', '销售平台列表', '0', null, '9999', '3503', '3', '/Summary/PlatformSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('350310', 'X350310', '物流配送列表', '1', null, '9999', '3503', '3', '/Summary/DeliverSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('350315', 'X350315', '订单支付列表', '1', null, '9999', '3503', '3', '/Summary/PaymentSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('350320', 'X350320', '数据字典列表', '1', null, '9999', '3503', '3', '/Summary/SubcodeSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('350325', 'X350325', '挂起标签列表', '0', null, '9999', '3503', '3', '/Summary/HangupTagSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('350330', 'X350330', '退货原因列表', '0', null, '9999', '3503', '3', '/Summary/ReturnReasonSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('3505', 'X3505', '权限管理', '1', null, '9999', '35', '2', null, '', null, '1', null);
INSERT INTO `erp_node` VALUES ('350500', 'X350500', '角色列表', '1', null, '9999', '3505', '3', '/Summary/RoleSummary/index?func=search', '', null, '1', null);
INSERT INTO `erp_node` VALUES ('350515', 'X350515', '角色/模块关系', '0', null, '9999', '3505', '3', '/Summary/RoleNodeSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('350520', 'X350520', '模块功能列表', '0', null, '9999', '3505', '3', '/Summary/NodeSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('3510', 'X3510', '服务管理', '1', null, '9999', '35', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('351000', 'X351000', '系统服务列表', '1', null, '9999', '3510', '3', '/Summary/ServiceSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('351005', 'X351005', '接口授权列表', '1', null, '9999', '3510', '3', '/Summary/SystemInterfaceSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('3515', 'X3515', '日志列表', '1', null, '9999', '35', '2', null, '', null, '0', null);
INSERT INTO `erp_node` VALUES ('351520', 'X351520', '销售订单处理日志', '1', null, '9999', '3515', '3', '/Summary/LogSalesSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('351525', 'X351525', '进销存单据处理日志', '1', null, '9999', '3515', '3', '/Summary/LogOrderSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('351530', 'X351530', '公用数据处理日志', '1', null, '9999', '3515', '3', '/Summary/LogCommonSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('351535', 'X351535', '系统功能使用日志', '1', null, '9999', '3515', '3', '/Summary/LogModelSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('40', 'X40', '测试使用', '1', null, '9999', '0', '1', '', '', null, '0', '&#xe608;');
INSERT INTO `erp_node` VALUES ('4000', 'X4000', '列表', '1', null, '9999', '40', '2', '/Home/Service/index/func/systemautoservice', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('400000', 'X400000', '分组列表', '1', null, '9999', '4000', '3', '/Summary/GroupSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('400005', 'X400005', '分组用户列表', '1', null, '9999', '4000', '3', '/Summary/GroupUserSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('400010', 'X400010', '分组店铺列表', '1', null, '9999', '4000', '3', '/Summary/GroupShopSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('400020', 'X400020', '系统服务', '1', '', '9999', '4000', '3', '/Home/Service/index/func/systemautoservice', '', '', '0', null);
INSERT INTO `erp_node` VALUES ('400030', 'X400030', '系统参数', '1', null, '9999', '4000', '3', '/Home/SystemParameter/index/func/showlist', null, null, '0', null);
INSERT INTO `erp_node` VALUES ('400040', 'X400040', '新增匹配', '1', null, '9999', '4000', '3', '/Home/WebRefundStorage/index?func=add', null, null, '1', null);
INSERT INTO `erp_node` VALUES ('400050', 'X400050', '仓库退货列表', '1', null, '9999', '4000', '3', '/Summary/RefundStorageSummary/index?func=search', null, null, '0', null);
INSERT INTO `erp_node` VALUES ('400060', 'X400060', '销售列表测试X', '1', null, '9999', '4000', '3', '/Summary/SalesTestSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('400070', 'X400070', '开发设计', '1', null, '9999', '4000', '3', '/Summary/NodeDesignTest/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('400510', 'X400510', '资源库列表', '0', null, '9999', '4005', '3', '/Summary/ResourceSummary/index?func=search', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('400530', 'X400530', '新增规格2(尺码)', '0', null, '9999', '4005', '3', '/Home/Style2/add', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('400535', 'X400535', '新增年份', '0', null, '9999', '4005', '3', '/Home/Year/add', '', null, '0', null);
INSERT INTO `erp_node` VALUES ('400570', 'X400570', '新增标签', '0', null, '9999', '4005', '3', '/Home/OrderTag/add', '', null, '0', null);
