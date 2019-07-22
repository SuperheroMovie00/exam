/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : examination

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2019-03-27 15:52:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for erp_area
-- ----------------------------
DROP TABLE IF EXISTS `erp_area`;
CREATE TABLE `erp_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT NULL COMMENT '上一级id',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型:0;国家#1;省市#2;地区#3;县市#4;区域#5;街道',
  `code` varchar(30) DEFAULT NULL COMMENT '地区代码',
  `name` varchar(50) DEFAULT NULL COMMENT '地区名称',
  `sort` int(11) DEFAULT '9999' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:1;有效#0;无效',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='地区';

-- ----------------------------
-- Records of erp_area
-- ----------------------------

-- ----------------------------
-- Table structure for erp_company
-- ----------------------------
DROP TABLE IF EXISTS `erp_company`;
CREATE TABLE `erp_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL COMMENT '公司代码',
  `name` varchar(50) DEFAULT NULL COMMENT '公司名称',
  `full_name` varchar(100) DEFAULT NULL COMMENT '公司全称',
  `province` varchar(50) DEFAULT NULL COMMENT '省份',
  `city` varchar(50) DEFAULT NULL COMMENT '城市',
  `area` varchar(50) DEFAULT NULL COMMENT '县区',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `postcode` varchar(50) DEFAULT NULL COMMENT '邮编',
  `phone` varchar(50) DEFAULT NULL COMMENT '电话',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机',
  `linkman` varchar(50) DEFAULT NULL COMMENT '联系人',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:1;有效#0;无效',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_code` (`code`),
  KEY `idx_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COMMENT='公司信息';

-- ----------------------------
-- Records of erp_company
-- ----------------------------
INSERT INTO `erp_company` VALUES ('1', '0001', '测试公司1', null, null, null, null, null, null, null, null, null, '1', null, null, null, null, '2018-12-12 17:50:35');
INSERT INTO `erp_company` VALUES ('2', '0002', '测试公司2', '', '', '', '', '', '', '', '', '', '1', '2019-01-25 15:16:03', '', '2019-01-25 15:16:08', '', '2018-12-12 17:50:35');
INSERT INTO `erp_company` VALUES ('38', 'ZDHX', '中电豪信', '江苏中电豪信电子科技有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-03-10 18:36:46');
INSERT INTO `erp_company` VALUES ('39', 'AT', '艾拓', '江苏艾拓电子有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-03-10 18:36:38');
INSERT INTO `erp_company` VALUES ('40', 'AP', '安品', '江苏安品金属材料有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-03-10 18:36:41');
INSERT INTO `erp_company` VALUES ('41', 'BB', '百步', '江苏百步国际贸易有限公司', '', null, null, '', '', null, '', '', '1', '2019-02-25 15:27:07', 'admin', '2019-03-15 17:09:00', '1', '2019-03-15 17:09:00');
INSERT INTO `erp_company` VALUES ('42', 'BC', '倍驰', '江苏倍驰能源有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-03-10 18:36:54');
INSERT INTO `erp_company` VALUES ('43', 'BYD', '博意德', '江苏博意德国际贸易有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-03-10 18:36:58');
INSERT INTO `erp_company` VALUES ('44', 'DJL', '东津联', '江苏东津联国际贸易有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-03-10 18:37:04');
INSERT INTO `erp_company` VALUES ('45', 'GJ', '贵佳', '江苏贵佳商贸有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-03-10 18:37:07');
INSERT INTO `erp_company` VALUES ('46', 'JSHX', '江苏华信', '江苏华信辉创能源科技有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08');
INSERT INTO `erp_company` VALUES ('47', 'HDS', '煌鼎森', '江苏煌鼎森国际贸易有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08');
INSERT INTO `erp_company` VALUES ('48', 'JH', '嘉奕和', '江苏嘉奕和铜业科技发展有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08');
INSERT INTO `erp_company` VALUES ('49', 'BJ', '宝靖', '江阴宝靖有色金属材料有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09');
INSERT INTO `erp_company` VALUES ('50', 'DS', '达赛', '江阴达赛贸易有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09');
INSERT INTO `erp_company` VALUES ('51', 'DQ', '德桥', '江阴德桥金属材料有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10');
INSERT INTO `erp_company` VALUES ('52', 'FY', '富悦', '江阴富悦贸易有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10');
INSERT INTO `erp_company` VALUES ('53', 'KZ', '凯竹', '江阴市凯竹贸易有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11');
INSERT INTO `erp_company` VALUES ('54', 'SD', '双东', '江阴市双东金属材料有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11');
INSERT INTO `erp_company` VALUES ('55', 'XG', '翔冠', '江阴翔冠国际贸易有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11');
INSERT INTO `erp_company` VALUES ('56', 'HC', '宏呈', '上海宏呈冶金科技发展有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11');
INSERT INTO `erp_company` VALUES ('57', 'JQ', '景清', '上海景清数码科技有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12');
INSERT INTO `erp_company` VALUES ('58', 'LW', '乐蜗', '上海乐蜗实业有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12');
INSERT INTO `erp_company` VALUES ('59', 'XT', '轩泰', '上海轩泰国际贸易有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12');
INSERT INTO `erp_company` VALUES ('60', 'YZ', '翼泽', '上海翼泽实业有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12');
INSERT INTO `erp_company` VALUES ('61', 'ZT', '震添', '上海震添国际贸易有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12');
INSERT INTO `erp_company` VALUES ('62', 'XB', '锡标', '无锡锡标华东标准件有限公司', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12');
INSERT INTO `erp_company` VALUES ('64', 'ZJKS', '浙江康烁', '浙江康烁', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-03-11 15:06:10');
INSERT INTO `erp_company` VALUES ('65', 'YZYX', '禹州亚新', '禹州亚新', null, null, null, null, null, null, null, null, '1', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-03-11 15:06:09');

-- ----------------------------
-- Table structure for erp_company_user
-- ----------------------------
DROP TABLE IF EXISTS `erp_company_user`;
CREATE TABLE `erp_company_user` (
  `company_id` int(11) NOT NULL COMMENT '公司id',
  `department_id` int(11) NOT NULL COMMENT '部门id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '员工级别：2：二级，1：一级，0：互审',
  PRIMARY KEY (`company_id`,`department_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公司用户';

-- ----------------------------
-- Records of erp_company_user
-- ----------------------------
INSERT INTO `erp_company_user` VALUES ('1', '1', '1', '99');
INSERT INTO `erp_company_user` VALUES ('1', '1', '2', '1');
INSERT INTO `erp_company_user` VALUES ('1', '1', '3', '0');
INSERT INTO `erp_company_user` VALUES ('1', '1', '4', '2');
INSERT INTO `erp_company_user` VALUES ('2', '2', '1', '2');
INSERT INTO `erp_company_user` VALUES ('2', '2', '2', '2');
INSERT INTO `erp_company_user` VALUES ('2', '2', '3', '0');
INSERT INTO `erp_company_user` VALUES ('38', '3', '1', '99');

-- ----------------------------
-- Table structure for erp_customer
-- ----------------------------
DROP TABLE IF EXISTS `erp_customer`;
CREATE TABLE `erp_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '客户类型:1;终端客户#0;合伙人',
  `parent_id` int(11) DEFAULT NULL COMMENT '上级ID',
  `customer_category_code` varchar(30) DEFAULT NULL COMMENT '分类',
  `customer_category_name` varchar(50) DEFAULT NULL COMMENT '客户分类',
  `code` varchar(30) DEFAULT NULL COMMENT '客户代码',
  `name` varchar(100) DEFAULT NULL COMMENT '客户名称',
  `prefix` varchar(50) DEFAULT NULL COMMENT '拼音缩写',
  `full_name` varchar(100) DEFAULT NULL COMMENT '客户全称',
  `province` varchar(50) DEFAULT NULL COMMENT '省份',
  `city` varchar(50) DEFAULT NULL COMMENT '城市',
  `area` varchar(50) DEFAULT NULL COMMENT '县区',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `postcode` varchar(50) DEFAULT NULL COMMENT '邮编',
  `phone` varchar(50) DEFAULT NULL COMMENT '电话',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机',
  `linkman` varchar(50) DEFAULT NULL COMMENT '联系人',
  `remarks` varchar(200) DEFAULT NULL COMMENT '备注信息',
  `invoice_address` varchar(100) DEFAULT NULL COMMENT '开票地址',
  `invoice_phone` varchar(50) DEFAULT NULL COMMENT '开票电话',
  `invoice_account` varchar(50) DEFAULT NULL COMMENT '开票账户',
  `invoice_taxno` varchar(50) DEFAULT NULL COMMENT '开票税号',
  `last_address` varchar(255) DEFAULT NULL COMMENT '最近收货',
  `customer_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '层级:0;未分#1;1级#2;2级#3;3级#4;4级#5;5级#6;6级',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:0;无效#1;有效',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='客户档案';

-- ----------------------------
-- Records of erp_customer
-- ----------------------------
INSERT INTO `erp_customer` VALUES ('1', '1', '0', null, null, '111', '22222', '22', '33', '44', null, null, '', null, null, '', '', '', null, null, null, null, null, '0', '0', '2019-03-13 13:44:26', '1', '2019-03-13 18:08:52', 'admin', '2019-03-13 20:08:40');
INSERT INTO `erp_customer` VALUES ('48', '1', '1001', null, null, '11', 'a1', 'py', 'aaaa', '江苏', null, null, '', null, null, '133312343434', '111', '快乐', null, null, null, null, null, '1', '1', '2019-03-13 19:30:10', 'admin', '2019-03-13 20:17:51', 'admin', '2019-03-13 20:17:51');
INSERT INTO `erp_customer` VALUES ('49', '2', '1002', null, null, '22', 'b2', 'ay', 'bbbb', '上海', null, null, '', null, null, '133312343434', '222', '潇洒', null, null, null, null, null, '2', '0', '2019-03-13 19:30:10', 'admin', '2019-03-13 19:33:27', 'admin', '2019-03-13 19:33:27');
INSERT INTO `erp_customer` VALUES ('50', '3', '1003', null, null, '33', 'c3', 'zy', 'cccc', '河北', null, null, '', null, null, '133312343434', '333', '能力', null, null, null, null, null, '3', '0', '2019-03-13 19:30:10', 'admin', '2019-03-13 19:33:27', 'admin', '2019-03-13 19:33:27');

-- ----------------------------
-- Table structure for erp_customer_category
-- ----------------------------
DROP TABLE IF EXISTS `erp_customer_category`;
CREATE TABLE `erp_customer_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '客户类型:1;供应商#0;销售客户',
  `code` varchar(30) DEFAULT NULL COMMENT '分类代码',
  `name` varchar(150) DEFAULT NULL COMMENT '分类名称',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `parent_id` int(11) DEFAULT NULL COMMENT '上级分类id',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '层级',
  `sort` int(11) DEFAULT '9999' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:1;有效#0;无效',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='客户分类';

-- ----------------------------
-- Records of erp_customer_category
-- ----------------------------

-- ----------------------------
-- Table structure for erp_department
-- ----------------------------
DROP TABLE IF EXISTS `erp_department`;
CREATE TABLE `erp_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL COMMENT '公司id',
  `code` varchar(30) DEFAULT NULL COMMENT '代码',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `parent_id` int(11) DEFAULT NULL COMMENT '上级id',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型:0;管理#1;财务#2;生产#3;仓储',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '层级',
  `sort` int(11) DEFAULT '9999' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:1;有效#0;无效',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='部门';

-- ----------------------------
-- Records of erp_department
-- ----------------------------
INSERT INTO `erp_department` VALUES ('1', '1', 'd001', '测试部门1', '0', '0', '100', '105', '1', null, null, '2019-02-28 16:38:53', '1', '2019-02-28 16:38:53');
INSERT INTO `erp_department` VALUES ('2', '2', 'd002', '测试部门2', '1', '0', '105', '105', '0', '2019-01-22 16:17:29', '', '2019-02-28 16:39:03', '1', '2019-02-28 16:39:03');

-- ----------------------------
-- Table structure for erp_effects
-- ----------------------------
DROP TABLE IF EXISTS `erp_effects`;
CREATE TABLE `erp_effects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL COMMENT '公司id',
  `department_id` int(11) DEFAULT NULL COMMENT '部门id',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型:0;资产类#1;证照类#2;物品类',
  `category_code` varchar(50) DEFAULT NULL COMMENT '分类',
  `code` varchar(50) DEFAULT NULL COMMENT '编码',
  `name` varchar(100) DEFAULT NULL COMMENT '名称',
  `prefix` varchar(30) DEFAULT NULL COMMENT '缩写码',
  `barcode` varchar(50) DEFAULT NULL COMMENT '条码',
  `content` text COMMENT '描述',
  `img` varchar(255) DEFAULT NULL COMMENT '图像',
  `is_kef` tinyint(4) NOT NULL DEFAULT '0' COMMENT '管控:0;否#1;是',
  `is_real` tinyint(4) NOT NULL DEFAULT '0' COMMENT '实物:0;否#1;是',
  `address` varchar(100) DEFAULT NULL COMMENT '所在地',
  `custodian_id` int(11) DEFAULT NULL COMMENT '保管人id',
  `custodian_name` varchar(50) DEFAULT NULL COMMENT '保管人',
  `allow_borrow` tinyint(4) NOT NULL DEFAULT '0' COMMENT '外借:0;不可#1;允许',
  `apply_no` varchar(50) DEFAULT NULL COMMENT '关联申请',
  `apply_id` int(11) DEFAULT '0' COMMENT '关联申请id',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:0;无效#1;正常#2;外借',
  `sort` smallint(8) DEFAULT '0' COMMENT '排序',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更改时间',
  `approval_require` tinyint(4) DEFAULT '0',
  `limit_days` int(11) DEFAULT '0' COMMENT '天数限制',
  `alias` varchar(100) DEFAULT NULL COMMENT '物品别名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=947 DEFAULT CHARSET=utf8 COMMENT='公司物品';

-- ----------------------------
-- Records of erp_effects
-- ----------------------------
INSERT INTO `erp_effects` VALUES ('1', '1', '1', '0', '000002', 'wp001', '物品1', 'wp', '', '', null, '0', '0', '', '1', null, '0', '', '0', '0', '0', null, null, '2019-03-15 17:15:51', 'admin', '2019-03-15 17:15:51', '1', '1', '11111');
INSERT INTO `erp_effects` VALUES ('2', '1', '1', '0', '', 'wp002', '物品2', '', '', '', '', '0', '0', '', '1', '', '0', '', '0', '1', '0', '2018-12-18 17:11:44', '', '2019-01-30 21:42:38', 'admin', '2019-01-31 14:38:33', '2', '0', null);
INSERT INTO `erp_effects` VALUES ('3', '1', '1', '0', '', 'wp003', '物品3', '', '', '', '', '0', '0', '', '1', '', '0', '', '0', '1', '0', '2018-12-18 17:11:44', '', '2019-01-30 21:43:31', 'admin', '2019-01-31 14:38:34', '3', '0', null);
INSERT INTO `erp_effects` VALUES ('4', '1', '1', '0', '', 'wp004', '物品4', '', '', '', '', '0', '0', '', '1', '', '0', '', null, '1', '0', '2018-12-18 17:11:44', '', '2018-12-18 17:11:57', '', '2019-01-22 21:08:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('5', '1', '1', '0', '', 'wp005', '物品5', '', '', '', '', '0', '0', '', '1', '', '0', '', null, '0', '0', '2018-12-18 17:11:44', '', '2019-03-15 17:35:26', 'admin', '2019-03-15 17:35:26', '2', '0', null);
INSERT INTO `erp_effects` VALUES ('6', '1', '1', '0', '', 'wp006', '物品6', '', '', '', '', '0', '0', '', '1', '', '0', '', null, '1', '0', '2018-12-18 17:11:44', '', '2018-12-18 17:11:57', '', '2019-01-22 21:08:10', '3', '0', null);
INSERT INTO `erp_effects` VALUES ('7', '1', '1', '0', '', 'wp007', '物品7', '', '', '', '', '0', '0', '', '1', '', '0', '', null, '1', '0', '2018-12-18 17:11:44', '', '2018-12-18 17:11:57', '', '2019-01-22 21:08:15', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('8', '2', '2', '0', '', 'wp008', '物品8', '', '', '', '', '0', '0', '', '4', '', '0', '', null, '1', '0', '2019-01-22 16:19:28', '', '2019-01-22 16:19:32', '', '2019-01-22 21:08:27', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('9', '2', '2', '0', '', 'wp009', '物品9', '', '', '', '', '0', '0', '', '4', '', '0', '', null, '1', '0', '2018-12-18 17:11:44', '', '2018-12-18 17:11:57', '', '2019-01-22 21:08:28', '2', '0', null);
INSERT INTO `erp_effects` VALUES ('10', '2', '2', '0', '', 'wp010', '物品10', '', '', '', '', '0', '0', '', '4', '', '0', '', null, '1', '0', '2018-12-18 17:11:44', '', '2018-12-18 17:11:57', '', '2019-01-22 21:08:29', '3', '0', null);
INSERT INTO `erp_effects` VALUES ('11', '2', '2', '0', '', 'wp011', '物品11', '', '', '', '', '0', '0', '', '4', '', '0', '', null, '1', '0', '2018-12-18 17:11:44', '', '2018-12-18 17:11:57', '', '2019-01-22 21:08:29', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('12', '2', '2', '0', '', 'wp012', '物品12', '', '', '', '', '0', '0', '', '4', '', '0', '', null, '1', '0', '2018-12-18 17:11:44', '', '2018-12-18 17:11:57', '', '2019-01-22 21:08:30', '2', '0', null);
INSERT INTO `erp_effects` VALUES ('13', '2', '2', '0', '', 'wp013', '物品13', '', '', '', '', '0', '0', '', '4', '', '0', '', null, '1', '0', '2018-12-18 17:11:44', '', '2018-12-18 17:11:57', '', '2019-01-22 21:08:30', '3', '0', null);
INSERT INTO `erp_effects` VALUES ('14', '2', '2', '0', '', 'wp014', '物品14', '', '', '', '', '0', '0', '', '4', '', '0', '', null, '1', '0', '2018-12-18 17:11:44', '', '2018-12-18 17:11:57', '', '2019-01-22 21:08:31', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('481', '38', '1', '1', '000002', '000001', '中电豪信营业执照正本', 'ZDHXYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('482', '38', '1', '1', '000002', '000002', '中电豪信营业执照副本', 'ZDHXYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('483', '38', '1', '1', '000002', '000003', '中电豪信开户许可证', 'ZDHXKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('484', '38', '1', '2', '000003', '000004', '中电豪信1#公章', 'ZDHX1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('485', '38', '1', '2', '000003', '000005', '中电豪信1#财务章', 'ZDHX1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('486', '38', '1', '2', '000003', '000006', '中电豪信1#法人章', 'ZDHX1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('487', '38', '1', '2', '000003', '000007', '中电豪信2#公章', 'ZDHX2#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('488', '38', '1', '2', '000003', '000008', '中电豪信2#财务章', 'ZDHX2#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('489', '38', '1', '2', '000003', '000009', '中电豪信2#法人章', 'ZDHX2#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('490', '38', '1', '2', '000003', '000010', '中电豪信3#公章', 'ZDHX3#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('491', '38', '1', '2', '000003', '000011', '中电豪信3#财务章', 'ZDHX3#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('492', '38', '1', '2', '000003', '000012', '中电豪信3#法人章', 'ZDHX3#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('493', '38', '1', '2', '000003', '000013', '中电豪信4#公章', 'ZDHX4#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('494', '38', '1', '2', '000003', '000014', '中电豪信4#财务章', 'ZDHX4#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('495', '38', '1', '2', '000003', '000015', '中电豪信4#法人章', 'ZDHX4#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('496', '38', '1', '2', '000003', '000016', '中电豪信5#公章', 'ZDHX5#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('497', '38', '1', '2', '000003', '000017', '中电豪信5#财务章', 'ZDHX5#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('498', '38', '1', '2', '000003', '000018', '中电豪信6#公章', 'ZDHX6#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('499', '38', '1', '2', '000003', '000019', '中电豪信6#财务章', 'ZDHX6#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('500', '38', '1', '2', '000003', '000020', '中电豪信6#法人章', 'ZDHX6#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('501', '38', '1', '2', '000003', '000021', '中电豪信6#-1公章', 'ZDHX6#-1GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('502', '38', '1', '2', '000003', '000022', '中电豪信6#-1财务章', 'ZDHX6#-1CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('503', '38', '1', '2', '000003', '000023', '中电豪信6#-1法人章', 'ZDHX6#-1FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('504', '38', '1', '2', '000003', '000024', '中电豪信7#公章', 'ZDHX7#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('505', '38', '1', '2', '000003', '000025', '中电豪信7#财务章', 'ZDHX7#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('506', '38', '1', '2', '000003', '000026', '中电豪信7#法人章', 'ZDHX7#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('507', '38', '1', '2', '000004', '000027', '中电豪信招商银行U盾经办', 'ZDHXZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('508', '38', '1', '2', '000004', '000028', '中电豪信招商银行U盾复核', 'ZDHXZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('509', '38', '1', '2', '000004', '000029', '中电豪信浙商银行U盾经办', 'ZDHXZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('510', '38', '1', '2', '000004', '000030', '中电豪信浙商银行U盾复核', 'ZDHXZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('511', '38', '1', '2', '000004', '000031', '中电豪信工商银行U盾经办', 'ZDHXGSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('512', '38', '1', '2', '000004', '000032', '中电豪信工商银行U盾复核', 'ZDHXGSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('513', '38', '1', '2', '000004', '000033', '中电豪信上海银行U盾经办', 'ZDHXSHYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('514', '38', '1', '2', '000004', '000034', '中电豪信上海银行U盾复核', 'ZDHXSHYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('515', '38', '1', '2', '000004', '000035', '中电豪信哈尔滨银行U盾经办', 'ZDHXHEBYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('516', '38', '1', '2', '000004', '000036', '中电豪信哈尔滨银行U盾复核', 'ZDHXHEBYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('517', '38', '1', '2', '000004', '000037', '中电豪信江苏银行U盾经办', 'ZDHXJSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('518', '38', '1', '2', '000004', '000038', '中电豪信江苏银行U盾复核', 'ZDHXJSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('519', '38', '1', '2', '000004', '000039', '中电豪信华润银行U盾经办', 'ZDHXHRYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('520', '38', '1', '2', '000004', '000040', '中电豪信华润银行U盾复核', 'ZDHXHRYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('521', '38', '1', '2', '000004', '000041', '中电豪信民生银行U盾经办', 'ZDHXMSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('522', '38', '1', '2', '000004', '000042', '中电豪信民生银行U盾复核', 'ZDHXMSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('523', '38', '1', '2', '000004', '000043', '中电豪信包商银行U盾经办', 'ZDHXBSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('524', '38', '1', '2', '000004', '000044', '中电豪信包商银行U盾复核', 'ZDHXBSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('525', '38', '1', '2', '000004', '000045', '中电豪信包商银行U盾主管', 'ZDHXBSYXUDZG', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('526', '38', '1', '2', '000004', '000046', '中电豪信恒丰银行U盾经办', 'ZDHXHFYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('527', '38', '1', '2', '000004', '000047', '中电豪信恒丰银行U盾复核', 'ZDHXHFYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('528', '38', '1', '2', '000004', '000048', '中电豪信宁波银行U盾经办', 'ZDHXNBYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('529', '39', '1', '1', '000002', '000049', '艾拓营业执照正本', 'ATYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('530', '39', '1', '1', '000002', '000050', '艾拓营业执照副本', 'ATYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('531', '40', '1', '1', '000002', '000051', '安品营业执照正本', 'APYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('532', '40', '1', '1', '000002', '000052', '安品营业执照副本', 'APYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('533', '40', '1', '1', '000002', '000053', '安品开户许可证', 'APKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('534', '40', '1', '2', '000003', '000054', '安品1#公章', 'AP1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('535', '40', '1', '2', '000003', '000055', '安品1#财务章', 'AP1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('536', '40', '1', '2', '000003', '000056', '安品1#法人章', 'AP1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('537', '40', '1', '2', '000003', '000057', '安品2#公章', 'AP2#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('538', '40', '1', '2', '000003', '000058', '安品2#财务章', 'AP2#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('539', '40', '1', '2', '000003', '000059', '安品2#法人章', 'AP2#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('540', '40', '1', '2', '000003', '000060', '安品3#公章', 'AP3#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('541', '40', '1', '2', '000003', '000061', '安品3#财务章', 'AP3#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('542', '40', '1', '2', '000003', '000062', '安品3#法人章', 'AP3#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('543', '40', '1', '2', '000004', '000063', '安品浙商银行U盾经办', 'APZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('544', '40', '1', '2', '000004', '000064', '安品浙商银行U盾复核', 'APZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('545', '40', '1', '2', '000004', '000065', '安品南京银行U盾经办', 'APNJYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('546', '40', '1', '2', '000004', '000066', '安品南京银行U盾复核', 'APNJYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('547', '40', '1', '2', '000004', '000067', '安品平安银行U盾复核', 'APPAYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('548', '40', '1', '2', '000004', '000068', '安品建设银行U盾经办', 'APJSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('549', '40', '1', '2', '000004', '000069', '安品建设银行U盾复核', 'APJSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('550', '40', '1', '2', '000004', '000070', '安品恒丰银行U盾经办', 'APHFYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('551', '41', '1', '1', '000002', '000071', '百步营业执照正本', 'BBYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('552', '41', '1', '1', '000002', '000072', '百步营业执照副本', 'BBYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('553', '41', '1', '1', '000002', '000073', '百步开户许可证', 'BBKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('554', '41', '1', '2', '000004', '000074', '百步浙商银行U盾经办', 'BBZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('555', '41', '1', '2', '000004', '000075', '百步浙商银行U盾复核', 'BBZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('556', '41', '1', '2', '000004', '000076', '百步浦发银行U盾经办', 'BBPFYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('557', '42', '1', '1', '000002', '000077', '倍驰营业执照正本', 'BCYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('558', '42', '1', '1', '000002', '000078', '倍驰营业执照副本', 'BCYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('559', '42', '1', '1', '000002', '000079', '倍驰开户许可证', 'BCKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('560', '42', '1', '2', '000003', '000080', '倍驰1#公章', 'BC1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('561', '42', '1', '2', '000003', '000081', '倍驰1#财务章', 'BC1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('562', '42', '1', '2', '000003', '000082', '倍驰1#法人章', 'BC1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('563', '42', '1', '2', '000004', '000083', '倍驰浙商银行U盾经办', 'BCZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('564', '43', '1', '1', '000002', '000084', '博意德营业执照正本', 'BYDYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('565', '43', '1', '1', '000002', '000085', '博意德营业执照副本', 'BYDYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('566', '43', '1', '1', '000002', '000086', '博意德开户许可证', 'BYDKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('567', '43', '1', '2', '000003', '000087', '博意德1#公章', 'BYD1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('568', '43', '1', '2', '000003', '000088', '博意德1#财务章', 'BYD1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('569', '43', '1', '2', '000003', '000089', '博意德1#法人章', 'BYD1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('570', '43', '1', '2', '000004', '000090', '博意德建设银行U盾经办', 'BYDJSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('571', '43', '1', '2', '000004', '000091', '博意德建设银行U盾复核', 'BYDJSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('572', '44', '1', '1', '000002', '000092', '东津联营业执照正本', 'DJLYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('573', '44', '1', '1', '000002', '000093', '东津联营业执照副本', 'DJLYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('574', '44', '1', '1', '000002', '000094', '东津联开户许可证', 'DJLKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('575', '44', '1', '2', '000003', '000095', '东津联1#公章', 'DJL1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('576', '44', '1', '2', '000003', '000096', '东津联1#财务章', 'DJL1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('577', '44', '1', '2', '000003', '000097', '东津联1#法人章', 'DJL1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('578', '44', '1', '2', '000003', '000098', '东津联2#公章', 'DJL2#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('579', '44', '1', '2', '000003', '000099', '东津联2#财务章', 'DJL2#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('580', '44', '1', '2', '000003', '000100', '东津联2#法人章', 'DJL2#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('581', '44', '1', '2', '000003', '000101', '东津联3#公章', 'DJL3#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('582', '44', '1', '2', '000003', '000102', '东津联3#财务章', 'DJL3#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('583', '44', '1', '2', '000003', '000103', '东津联3#法人章', 'DJL3#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('584', '44', '1', '2', '000004', '000104', '东津联浙商银行U盾经办', 'DJLZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('585', '44', '1', '2', '000004', '000105', '东津联浙商银行U盾复核', 'DJLZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('586', '44', '1', '2', '000004', '000106', '东津联招商银行U盾经办', 'DJLZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('587', '44', '1', '2', '000004', '000107', '东津联招商银行U盾复核', 'DJLZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('588', '44', '1', '2', '000004', '000108', '东津联江苏银行U盾经办', 'DJLJSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('589', '44', '1', '2', '000004', '000109', '东津联江苏银行U盾复核', 'DJLJSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('590', '44', '1', '2', '000004', '000110', '东津联恒丰银行U盾经办', 'DJLHFYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('591', '45', '1', '1', '000002', '000111', '贵佳营业执照正本', 'GJYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('592', '45', '1', '1', '000002', '000112', '贵佳营业执照副本', 'GJYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('593', '45', '1', '1', '000002', '000113', '贵佳开户许可证', 'GJKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('594', '45', '1', '2', '000003', '000114', '贵佳1#公章', 'GJ1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('595', '45', '1', '2', '000003', '000115', '贵佳1#财务章', 'GJ1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('596', '45', '1', '2', '000003', '000116', '贵佳1#法人章', 'GJ1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('597', '45', '1', '2', '000004', '000117', '贵佳浙商银行U盾经办', 'GJZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('598', '45', '1', '2', '000004', '000118', '贵佳浙商银行U盾复核', 'GJZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('599', '45', '1', '2', '000004', '000119', '贵佳民生银行U盾经办', 'GJMSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('600', '45', '1', '2', '000004', '000120', '贵佳民生银行U盾复核', 'GJMSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('601', '45', '1', '2', '000004', '000121', '贵佳交通银行U盾经办', 'GJJTYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('602', '46', '1', '1', '000002', '000122', '江苏华信营业执照正本', 'JSHXYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('603', '46', '1', '1', '000002', '000123', '江苏华信营业执照副本', 'JSHXYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('604', '46', '1', '1', '000002', '000124', '江苏华信开户许可证', 'JSHXKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('605', '46', '1', '2', '000003', '000125', '江苏华信1#公章', 'JSHX1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('606', '46', '1', '2', '000003', '000126', '江苏华信1#财务章', 'JSHX1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('607', '46', '1', '2', '000003', '000127', '江苏华信1#法人章', 'JSHX1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('608', '46', '1', '2', '000003', '000128', '江苏华信4#公章', 'JSHX4#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('609', '46', '1', '2', '000003', '000129', '江苏华信4#财务章', 'JSHX4#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('610', '46', '1', '2', '000003', '000130', '江苏华信4#法人章', 'JSHX4#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('611', '46', '1', '2', '000003', '000131', '江苏华信5#公章', 'JSHX5#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('612', '46', '1', '2', '000003', '000132', '江苏华信5#财务章', 'JSHX5#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('613', '46', '1', '2', '000003', '000133', '江苏华信5#法人章', 'JSHX5#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('614', '46', '1', '2', '000004', '000134', '江苏华信浙商银行U盾经办', 'JSHXZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('615', '46', '1', '2', '000004', '000135', '江苏华信浙商银行U盾复核', 'JSHXZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('616', '46', '1', '2', '000004', '000136', '江苏华信民生银行U盾经办', 'JSHXMSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('617', '46', '1', '2', '000004', '000137', '江苏华信民生银行U盾复核', 'JSHXMSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('618', '46', '1', '2', '000004', '000138', '江苏华信光大银行U盾经办', 'JSHXGDYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('619', '46', '1', '2', '000004', '000139', '江苏华信光大银行U盾复核', 'JSHXGDYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('620', '46', '1', '2', '000004', '000140', '江苏华信哈密银行U盾经办', 'JSHXHMYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('621', '46', '1', '2', '000004', '000141', '江苏华信哈密银行U盾复核', 'JSHXHMYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('622', '46', '1', '2', '000004', '000142', '江苏华信宁波通商银行U盾经办', 'JSHXNBTSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('623', '47', '1', '1', '000002', '000143', '煌鼎森营业执照正本', 'HDSYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('624', '47', '1', '1', '000002', '000144', '煌鼎森营业执照副本', 'HDSYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('625', '47', '1', '1', '000002', '000145', '煌鼎森开户许可证', 'HDSKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('626', '47', '1', '2', '000003', '000146', '煌鼎森1#公章', 'HDS1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('627', '47', '1', '2', '000003', '000147', '煌鼎森1#财务章', 'HDS1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('628', '47', '1', '2', '000003', '000148', '煌鼎森1#法人章', 'HDS1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('629', '47', '1', '2', '000004', '000149', '煌鼎森建设银行U盾经办', 'HDSJSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('630', '47', '1', '2', '000004', '000150', '煌鼎森建设银行U盾复核', 'HDSJSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('631', '48', '1', '1', '000002', '000151', '嘉奕和营业执照正本', 'JHYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('632', '48', '1', '1', '000002', '000152', '嘉奕和营业执照副本', 'JHYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', 'admin', '2019-02-25 15:27:08', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('633', '48', '1', '1', '000002', '000153', '嘉奕和开户许可证', 'JHKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('634', '48', '1', '2', '000003', '000154', '嘉奕和1#公章', 'JH1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('635', '48', '1', '2', '000003', '000155', '嘉奕和1#财务章', 'JH1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('636', '48', '1', '2', '000003', '000156', '嘉奕和1#法人章', 'JH1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('637', '48', '1', '2', '000003', '000157', '嘉奕和2#公章', 'JH2#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('638', '48', '1', '2', '000003', '000158', '嘉奕和2#财务章', 'JH2#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('639', '48', '1', '2', '000003', '000159', '嘉奕和2#法人章', 'JH2#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('640', '48', '1', '2', '000003', '000160', '嘉奕和3#公章', 'JH3#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('641', '48', '1', '2', '000003', '000161', '嘉奕和3#财务章', 'JH3#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('642', '48', '1', '2', '000003', '000162', '嘉奕和3#法人章', 'JH3#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('643', '48', '1', '2', '000003', '000163', '嘉奕和4#公章', 'JH4#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('644', '48', '1', '2', '000003', '000164', '嘉奕和4#财务章', 'JH4#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('645', '48', '1', '2', '000003', '000165', '嘉奕和4#法人章', 'JH4#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('646', '48', '1', '2', '000004', '000166', '嘉奕和浙商银行U盾经办', 'JHZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('647', '48', '1', '2', '000004', '000167', '嘉奕和浙商银行U盾复核', 'JHZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('648', '48', '1', '2', '000004', '000168', '嘉奕和北京银行U盾经办', 'JHBJYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('649', '48', '1', '2', '000004', '000169', '嘉奕和北京银行U盾复核', 'JHBJYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('650', '48', '1', '2', '000004', '000170', '嘉奕和民生银行U盾经办', 'JHMSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('651', '48', '1', '2', '000004', '000171', '嘉奕和民生银行U盾复核', 'JHMSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('652', '48', '1', '2', '000004', '000172', '嘉奕和平安银行U盾经办', 'JHPAYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('653', '48', '1', '2', '000004', '000173', '嘉奕和平安银行U盾复核', 'JHPAYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('654', '48', '1', '2', '000004', '000174', '嘉奕和浦发银行U盾经办', 'JHPFYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('655', '48', '1', '2', '000004', '000175', '嘉奕和浦发银行U盾复核', 'JHPFYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('656', '48', '1', '2', '000004', '000176', '嘉奕和哈密银行U盾经办', 'JHHMYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('657', '48', '1', '2', '000004', '000177', '嘉奕和哈密银行U盾复核', 'JHHMYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('658', '48', '1', '2', '000004', '000178', '嘉奕和招商银行U盾经办', 'JHZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('659', '48', '1', '2', '000004', '000179', '嘉奕和招商银行U盾复核', 'JHZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('660', '48', '1', '2', '000004', '000180', '嘉奕和营口银行U盾复核', 'JHYKYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('661', '48', '1', '2', '000004', '000181', '嘉奕和华润银行U盾经办', 'JHHRYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('662', '48', '1', '2', '000004', '000182', '嘉奕和华润银行U盾复核', 'JHHRYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('663', '48', '1', '2', '000004', '000183', '嘉奕和哈尔滨银行U盾经办', 'JHHEBYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('664', '48', '1', '2', '000004', '000184', '嘉奕和哈尔滨银行U盾复核', 'JHHEBYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('665', '48', '1', '2', '000004', '000185', '嘉奕和上海银行U盾经办', 'JHSHYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('666', '49', '1', '1', '000002', '000186', '宝靖营业执照正本', 'BJYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('667', '49', '1', '1', '000002', '000187', '宝靖营业执照副本', 'BJYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('668', '49', '1', '1', '000002', '000188', '宝靖开户许可证', 'BJKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('669', '49', '1', '2', '000003', '000189', '宝靖1#公章', 'BJ1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('670', '49', '1', '2', '000003', '000190', '宝靖1#财务章', 'BJ1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('671', '49', '1', '2', '000003', '000191', '宝靖1#法人章', 'BJ1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('672', '49', '1', '2', '000003', '000192', '宝靖2#公章', 'BJ2#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('673', '49', '1', '2', '000003', '000193', '宝靖2#财务章', 'BJ2#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('674', '49', '1', '2', '000003', '000194', '宝靖2#法人章', 'BJ2#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('675', '49', '1', '2', '000003', '000195', '宝靖3#公章', 'BJ3#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('676', '49', '1', '2', '000003', '000196', '宝靖3#财务章', 'BJ3#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('677', '49', '1', '2', '000003', '000197', '宝靖3#法人章', 'BJ3#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('678', '49', '1', '2', '000004', '000198', '宝靖浙商银行U盾经办', 'BJZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('679', '49', '1', '2', '000004', '000199', '宝靖浙商银行U盾复核', 'BJZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('680', '49', '1', '2', '000004', '000200', '宝靖民生银行U盾经办', 'BJMSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('681', '49', '1', '2', '000004', '000201', '宝靖民生银行U盾复核', 'BJMSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('682', '49', '1', '2', '000004', '000202', '宝靖建设银行U盾经办', 'BJJSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('683', '50', '1', '1', '000002', '000203', '达赛营业执照正本', 'DSYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('684', '50', '1', '1', '000002', '000204', '达赛营业执照副本', 'DSYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('685', '50', '1', '1', '000002', '000205', '达赛机构信用代码证', 'DSJGXYDMZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('686', '50', '1', '1', '000002', '000206', '达赛开户许可证', 'DSKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('687', '50', '1', '2', '000003', '000207', '达赛1#公章', 'DS1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('688', '50', '1', '2', '000003', '000208', '达赛1#财务章', 'DS1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('689', '50', '1', '2', '000003', '000209', '达赛1#法人章', 'DS1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('690', '50', '1', '2', '000003', '000210', '达赛2#公章', 'DS2#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('691', '50', '1', '2', '000003', '000211', '达赛2#财务章', 'DS2#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('692', '50', '1', '2', '000003', '000212', '达赛2#法人章', 'DS2#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('693', '50', '1', '2', '000003', '000213', '达赛3#公章', 'DS3#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('694', '50', '1', '2', '000003', '000214', '达赛3#财务章', 'DS3#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('695', '50', '1', '2', '000003', '000215', '达赛3#法人章', 'DS3#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('696', '50', '1', '2', '000003', '000216', '达赛7#公章', 'DS7#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('697', '50', '1', '2', '000003', '000217', '达赛7#财务章', 'DS7#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('698', '50', '1', '2', '000003', '000218', '达赛7#法人章', 'DS7#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('699', '50', '1', '2', '000004', '000219', '达赛浙商银行U盾经办', 'DSZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('700', '50', '1', '2', '000004', '000220', '达赛浙商银行U盾复核', 'DSZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', 'admin', '2019-02-25 15:27:09', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('701', '50', '1', '2', '000004', '000221', '达赛招商银行U盾经办', 'DSZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('702', '50', '1', '2', '000004', '000222', '达赛招商银行U盾复核', 'DSZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('703', '50', '1', '2', '000004', '000223', '达赛上海银行U盾经办', 'DSSHYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('704', '50', '1', '2', '000004', '000224', '达赛上海银行U盾复核', 'DSSHYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('705', '51', '1', '1', '000002', '000225', '德桥营业执照正本', 'DQYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('706', '51', '1', '1', '000002', '000226', '德桥营业执照副本', 'DQYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('707', '51', '1', '1', '000002', '000227', '德桥机构信用代码证', 'DQJGXYDMZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('708', '51', '1', '1', '000002', '000228', '德桥开户许可证', 'DQKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('709', '51', '1', '2', '000003', '000229', '德桥1#公章', 'DQ1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('710', '51', '1', '2', '000003', '000230', '德桥1#财务章', 'DQ1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('711', '51', '1', '2', '000003', '000231', '德桥1#法人章', 'DQ1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('712', '51', '1', '2', '000003', '000232', '德桥2#公章', 'DQ2#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('713', '51', '1', '2', '000003', '000233', '德桥2#财务章', 'DQ2#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('714', '51', '1', '2', '000003', '000234', '德桥3#公章', 'DQ3#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('715', '51', '1', '2', '000003', '000235', '德桥3#财务章', 'DQ3#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('716', '51', '1', '2', '000003', '000236', '德桥3#法人章', 'DQ3#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('717', '51', '1', '2', '000003', '000237', '德桥4#公章', 'DQ4#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('718', '51', '1', '2', '000003', '000238', '德桥4#财务章', 'DQ4#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('719', '51', '1', '2', '000003', '000239', '德桥4#法人章', 'DQ4#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('720', '51', '1', '2', '000003', '000240', '德桥6#公章', 'DQ6#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('721', '51', '1', '2', '000003', '000241', '德桥6#财务章', 'DQ6#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('722', '51', '1', '2', '000003', '000242', '德桥6#法人章', 'DQ6#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('723', '51', '1', '2', '000003', '000243', '德桥5#公章', 'DQ5#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('724', '51', '1', '2', '000004', '000244', '德桥浙商银行U盾经办', 'DQZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('725', '51', '1', '2', '000004', '000245', '德桥浙商银行U盾复核', 'DQZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('726', '51', '1', '2', '000004', '000246', '德桥光大银行U盾经办', 'DQGDYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('727', '51', '1', '2', '000004', '000247', '德桥光大银行U盾复核', 'DQGDYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('728', '51', '1', '2', '000004', '000248', '德桥民生银行U盾经办', 'DQMSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('729', '51', '1', '2', '000004', '000249', '德桥民生银行U盾复核', 'DQMSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('730', '51', '1', '2', '000004', '000250', '德桥包商银行U盾经办', 'DQBSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('731', '51', '1', '2', '000004', '000251', '德桥包商银行U盾复核', 'DQBSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('732', '51', '1', '2', '000004', '000252', '德桥浦发银行U盾经办', 'DQPFYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('733', '51', '1', '2', '000004', '000253', '德桥浦发银行U盾复核', 'DQPFYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('734', '51', '1', '2', '000004', '000254', '德桥广发银行U盾经办', 'DQGFYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('735', '51', '1', '2', '000004', '000255', '德桥广发银行U盾复核', 'DQGFYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('736', '51', '1', '2', '000004', '000256', '德桥招商银行U盾经办', 'DQZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('737', '51', '1', '2', '000004', '000257', '德桥招商银行U盾复核', 'DQZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('738', '51', '1', '2', '000004', '000258', '德桥廊坊银行U盾复核', 'DQLFYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('739', '51', '1', '2', '000004', '000259', '德桥哈密银行U盾经办', 'DQHMYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('740', '51', '1', '2', '000004', '000260', '德桥哈密银行U盾复核', 'DQHMYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('741', '51', '1', '2', '000004', '000261', '德桥恒丰银行U盾经办', 'DQHFYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('742', '51', '1', '2', '000004', '000262', '德桥恒丰银行U盾复核', 'DQHFYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('743', '51', '1', '2', '000004', '000263', '德桥郑州银行U盾经办', 'DQZZYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('744', '52', '1', '1', '000002', '000264', '富悦营业执照正本', 'FYYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('745', '52', '1', '1', '000002', '000265', '富悦营业执照副本', 'FYYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('746', '52', '1', '1', '000002', '000266', '富悦机构信用代码证', 'FYJGXYDMZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('747', '52', '1', '1', '000002', '000267', '富悦开户许可证', 'FYKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('748', '52', '1', '2', '000003', '000268', '富悦1#公章', 'FY1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('749', '52', '1', '2', '000003', '000269', '富悦1#财务章', 'FY1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('750', '52', '1', '2', '000003', '000270', '富悦1#法人章', 'FY1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('751', '52', '1', '2', '000003', '000271', '富悦2#公章', 'FY2#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('752', '52', '1', '2', '000003', '000272', '富悦2#财务章', 'FY2#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('753', '52', '1', '2', '000003', '000273', '富悦3#公章', 'FY3#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('754', '52', '1', '2', '000003', '000274', '富悦3#财务章', 'FY3#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('755', '52', '1', '2', '000003', '000275', '富悦3#法人章', 'FY3#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('756', '52', '1', '2', '000003', '000276', '富悦4#公章', 'FY4#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('757', '52', '1', '2', '000003', '000277', '富悦4#财务章', 'FY4#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('758', '52', '1', '2', '000003', '000278', '富悦4#法人章', 'FY4#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('759', '52', '1', '2', '000004', '000279', '富悦浙商银行U盾经办', 'FYZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('760', '52', '1', '2', '000004', '000280', '富悦浙商银行U盾复核', 'FYZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('761', '52', '1', '2', '000004', '000281', '富悦民生银行U盾经办', 'FYMSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('762', '52', '1', '2', '000004', '000282', '富悦民生银行U盾复核', 'FYMSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('763', '52', '1', '2', '000004', '000283', '富悦大连银行U盾经办', 'FYDLYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('764', '52', '1', '2', '000004', '000284', '富悦大连银行U盾复核', 'FYDLYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('765', '52', '1', '2', '000004', '000285', '富悦哈密银行U盾经办', 'FYHMYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('766', '52', '1', '2', '000004', '000286', '富悦哈密银行U盾复核', 'FYHMYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('767', '52', '1', '2', '000004', '000287', '富悦郑州银行U盾经办', 'FYZZYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', 'admin', '2019-02-25 15:27:10', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('768', '52', '1', '2', '000004', '000288', '富悦郑州银行U盾复核', 'FYZZYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('769', '52', '1', '2', '000004', '000289', '富悦渤海银行U盾经办', 'FYBHYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('770', '52', '1', '2', '000004', '000290', '富悦渤海银行U盾复核', 'FYBHYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('771', '52', '1', '2', '000004', '000291', '富悦浦发银行U盾经办', 'FYPFYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('772', '52', '1', '2', '000004', '000292', '富悦浦发银行U盾复核', 'FYPFYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('773', '52', '1', '2', '000004', '000293', '富悦恒丰银行U盾经办', 'FYHFYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('774', '52', '1', '2', '000004', '000294', '富悦恒丰银行U盾复核', 'FYHFYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('775', '52', '1', '2', '000004', '000295', '富悦宁波通商银行银行U盾经办', 'FYNBTSYXYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('776', '52', '1', '2', '000004', '000296', '富悦宁波通商银行银行U盾复核', 'FYNBTSYXYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('777', '52', '1', '2', '000004', '000297', '富悦中旅银行U盾经办', 'FYZLYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('778', '52', '1', '2', '000004', '000298', '富悦中旅银行U盾复核', 'FYZLYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('779', '52', '1', '2', '000004', '000299', '富悦江南农村商业银行U盾经办', 'FYJNNCSYYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('780', '53', '1', '1', '000002', '000300', '凯竹营业执照正本', 'KZYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('781', '53', '1', '1', '000002', '000301', '凯竹营业执照副本', 'KZYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('782', '53', '1', '1', '000002', '000302', '凯竹机构信用代码证', 'KZJGXYDMZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('783', '53', '1', '1', '000002', '000303', '凯竹开户许可证', 'KZKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('784', '53', '1', '2', '000003', '000304', '凯竹3#公章', 'KZ3#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('785', '53', '1', '2', '000003', '000305', '凯竹3#财务章', 'KZ3#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('786', '53', '1', '2', '000003', '000306', '凯竹3#法人章', 'KZ3#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('787', '53', '1', '2', '000003', '000307', '凯竹8#公章', 'KZ8#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('788', '53', '1', '2', '000003', '000308', '凯竹8#财务章', 'KZ8#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('789', '53', '1', '2', '000003', '000309', '凯竹8#法人章', 'KZ8#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('790', '53', '1', '2', '000003', '000310', '凯竹7#公章', 'KZ7#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('791', '53', '1', '2', '000004', '000311', '凯竹浙商银行U盾经办', 'KZZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('792', '53', '1', '2', '000004', '000312', '凯竹浙商银行U盾复核', 'KZZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('793', '53', '1', '2', '000004', '000313', '凯竹民生银行U盾经办', 'KZMSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('794', '53', '1', '2', '000004', '000314', '凯竹民生银行U盾复核', 'KZMSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('795', '53', '1', '2', '000004', '000315', '凯竹廊坊银行U盾复核', 'KZLFYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('796', '53', '1', '2', '000004', '000316', '凯竹工商银行U盾经办', 'KZGSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('797', '53', '1', '2', '000004', '000317', '凯竹工商银行U盾复核', 'KZGSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('798', '53', '1', '2', '000004', '000318', '凯竹中原银行U盾经办', 'KZZYYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('799', '54', '1', '1', '000002', '000319', '双东营业执照正本', 'SDYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('800', '54', '1', '1', '000002', '000320', '双东营业执照副本', 'SDYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('801', '54', '1', '1', '000002', '000321', '双东机构信用代码证', 'SDJGXYDMZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('802', '54', '1', '1', '000002', '000322', '双东开户许可证', 'SDKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('803', '54', '1', '2', '000003', '000323', '双东1#公章', 'SD1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('804', '54', '1', '2', '000003', '000324', '双东1#财务章', 'SD1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('805', '54', '1', '2', '000003', '000325', '双东1#法人章', 'SD1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('806', '54', '1', '2', '000003', '000326', '双东2#公章', 'SD2#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('807', '54', '1', '2', '000003', '000327', '双东2#财务章', 'SD2#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('808', '54', '1', '2', '000003', '000328', '双东2#法人章', 'SD2#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('809', '54', '1', '2', '000004', '000329', '双东浙商银行U盾经办', 'SDZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('810', '54', '1', '2', '000004', '000330', '双东浙商银行U盾复核', 'SDZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('811', '54', '1', '2', '000004', '000331', '双东建设银行U盾经办', 'SDJSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('812', '54', '1', '2', '000004', '000332', '双东建设银行U盾复核', 'SDJSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('813', '54', '1', '2', '000004', '000333', '双东哈密银行U盾经办', 'SDHMYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('814', '55', '1', '1', '000002', '000334', '翔冠营业执照正本', 'XGYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('815', '55', '1', '1', '000002', '000335', '翔冠营业执照副本', 'XGYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('816', '55', '1', '1', '000002', '000336', '翔冠开户许可证', 'XGKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('817', '55', '1', '2', '000003', '000337', '翔冠1#公章', 'XG1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('818', '55', '1', '2', '000003', '000338', '翔冠1#财务章', 'XG1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('819', '55', '1', '2', '000003', '000339', '翔冠1#法人章', 'XG1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('820', '55', '1', '2', '000003', '000340', '翔冠2#公章', 'XG2#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('821', '55', '1', '2', '000003', '000341', '翔冠2#财务章', 'XG2#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('822', '55', '1', '2', '000003', '000342', '翔冠2#法人章', 'XG2#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('823', '55', '1', '2', '000003', '000343', '翔冠3#公章', 'XG3#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('824', '55', '1', '2', '000004', '000344', '翔冠浙商银行U盾经办', 'XGZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('825', '55', '1', '2', '000004', '000345', '翔冠浙商银行U盾复核', 'XGZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('826', '55', '1', '2', '000004', '000346', '翔冠建设银行U盾经办', 'XGJSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('827', '55', '1', '2', '000004', '000347', '翔冠建设银行U盾复核', 'XGJSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('828', '55', '1', '2', '000004', '000348', '翔冠宁波银行U盾经办', 'XGNBYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('829', '55', '1', '2', '000004', '000349', '翔冠宁波银行U盾复核', 'XGNBYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('830', '55', '1', '2', '000004', '000350', '翔冠民生银行U盾经办', 'XGMSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('831', '55', '1', '2', '000004', '000351', '翔冠民生银行U盾复核', 'XGMSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('832', '56', '1', '1', '000002', '000352', '宏呈营业执照正本', 'HCYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', 'admin', '2019-02-25 15:27:11', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('833', '56', '1', '1', '000002', '000353', '宏呈营业执照副本', 'HCYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('834', '56', '1', '1', '000002', '000354', '宏呈机构信用代码证', 'HCJGXYDMZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('835', '56', '1', '1', '000002', '000355', '宏呈开户许可证', 'HCKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('836', '56', '1', '2', '000003', '000356', '宏呈1#公章', 'HC1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('837', '56', '1', '2', '000003', '000357', '宏呈1#财务章', 'HC1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('838', '56', '1', '2', '000003', '000358', '宏呈1#法人章', 'HC1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('839', '56', '1', '2', '000004', '000359', '宏呈招商银行U盾经办', 'HCZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('840', '56', '1', '2', '000004', '000360', '宏呈招商银行U盾复核', 'HCZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('841', '56', '1', '2', '000004', '000361', '宏呈宁波银行U盾经办', 'HCNBYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('842', '57', '1', '1', '000002', '000362', '景清营业执照正本', 'JQYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('843', '57', '1', '1', '000002', '000363', '景清营业执照副本', 'JQYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('844', '57', '1', '1', '000002', '000364', '景清机构信用代码证', 'JQJGXYDMZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('845', '57', '1', '1', '000002', '000365', '景清开户许可证', 'JQKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('846', '57', '1', '2', '000003', '000366', '景清1#公章', 'JQ1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('847', '57', '1', '2', '000003', '000367', '景清1#财务章', 'JQ1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('848', '57', '1', '2', '000003', '000368', '景清1#法人章', 'JQ1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('849', '57', '1', '2', '000004', '000369', '景清招商银行U盾经办', 'JQZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('850', '57', '1', '2', '000004', '000370', '景清招商银行U盾复核', 'JQZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('851', '57', '1', '2', '000004', '000371', '景清农业银行U盾经办', 'JQNYYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('852', '57', '1', '2', '000004', '000372', '景清农业银行U盾复核', 'JQNYYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('853', '57', '1', '2', '000004', '000373', '景清上海农商银行U盾经办', 'JQSHNSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('854', '58', '1', '1', '000002', '000374', '乐蜗营业执照正本', 'LWYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('855', '58', '1', '1', '000002', '000375', '乐蜗营业执照副本', 'LWYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('856', '58', '1', '1', '000002', '000376', '乐蜗开户许可证', 'LWKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('857', '58', '1', '2', '000003', '000377', '乐蜗1#公章', 'LW1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('858', '58', '1', '2', '000003', '000378', '乐蜗1#财务章', 'LW1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('859', '58', '1', '2', '000003', '000379', '乐蜗1#法人章', 'LW1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('860', '58', '1', '2', '000004', '000380', '乐蜗渤海银行U盾经办', 'LWBHYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('861', '59', '1', '1', '000002', '000381', '轩泰营业执照正本', 'XTYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('862', '59', '1', '1', '000002', '000382', '轩泰营业执照副本', 'XTYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('863', '59', '1', '1', '000002', '000383', '轩泰机构信用代码证', 'XTJGXYDMZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('864', '59', '1', '1', '000002', '000384', '轩泰开户许可证', 'XTKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('865', '59', '1', '2', '000003', '000385', '轩泰1#公章', 'XT1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('866', '59', '1', '2', '000003', '000386', '轩泰1#财务章', 'XT1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('867', '59', '1', '2', '000003', '000387', '轩泰1#法人章', 'XT1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('868', '59', '1', '2', '000003', '000388', '轩泰2#法人章', 'XT2#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('869', '59', '1', '2', '000004', '000389', '轩泰招商银行U盾经办', 'XTZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('870', '59', '1', '2', '000004', '000390', '轩泰招商银行U盾复核', 'XTZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('871', '59', '1', '2', '000004', '000391', '轩泰民生银行U盾经办', 'XTMSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('872', '59', '1', '2', '000004', '000392', '轩泰民生银行U盾复核', 'XTMSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('873', '59', '1', '2', '000004', '000393', '轩泰农业银行U盾经办', 'XTNYYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('874', '60', '1', '1', '000002', '000394', '翼泽营业执照正本', 'YZYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('875', '60', '1', '1', '000002', '000395', '翼泽营业执照副本', 'YZYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('876', '60', '1', '1', '000002', '000396', '翼泽开户许可证', 'YZKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('877', '60', '1', '2', '000003', '000397', '翼泽1#公章', 'YZ1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('878', '60', '1', '2', '000003', '000398', '翼泽1#财务章', 'YZ1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('879', '60', '1', '2', '000003', '000399', '翼泽1#法人章', 'YZ1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('880', '60', '1', '2', '000004', '000400', '翼泽工商银行U盾经办', 'YZGSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('881', '60', '1', '2', '000004', '000401', '翼泽工商银行U盾复核', 'YZGSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('882', '60', '1', '2', '000004', '000402', '翼泽民生银行U盾经办', 'YZMSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('883', '60', '1', '2', '000004', '000403', '翼泽民生银行U盾复核', 'YZMSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('884', '60', '1', '2', '000004', '000404', '翼泽渤海银行U盾经办', 'YZBHYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('885', '60', '1', '2', '000004', '000405', '翼泽渤海银行U盾复核', 'YZBHYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('886', '61', '1', '1', '000002', '000406', '震添营业执照正本', 'ZTYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('887', '61', '1', '1', '000002', '000407', '震添营业执照副本', 'ZTYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('888', '61', '1', '1', '000002', '000408', '震添机构信用代码证', 'ZTJGXYDMZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('889', '61', '1', '1', '000002', '000409', '震添开户许可证', 'ZTKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('890', '61', '1', '2', '000003', '000410', '震添1#公章', 'ZT1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('891', '61', '1', '2', '000003', '000411', '震添1#财务章', 'ZT1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('892', '61', '1', '2', '000003', '000412', '震添1#法人章', 'ZT1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('893', '61', '1', '2', '000004', '000413', '震添上海银行U盾经办', 'ZTSHYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('894', '61', '1', '2', '000004', '000414', '震添上海银行U盾复核', 'ZTSHYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('895', '61', '1', '2', '000004', '000415', '震添上海农商银行U盾经办', 'ZTSHNSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('896', '61', '1', '2', '000004', '000416', '震添上海农商银行U盾复核', 'ZTSHNSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('897', '62', '1', '1', '000002', '000417', '锡标营业执照正本', 'XBYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:12', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('898', '62', '1', '1', '000002', '000418', '锡标营业执照副本', 'XBYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('899', '62', '1', '1', '000002', '000419', '锡标机构信用代码证', 'XBJGXYDMZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('900', '62', '1', '1', '000002', '000420', '锡标开户许可证', 'XBKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('901', '62', '1', '2', '000003', '000421', '锡标1#公章', 'XB1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('902', '62', '1', '2', '000003', '000422', '锡标1#财务章', 'XB1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('903', '62', '1', '2', '000003', '000423', '锡标1#法人章', 'XB1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('904', '62', '1', '2', '000003', '000424', '锡标3#公章', 'XB3#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('905', '62', '1', '2', '000003', '000425', '锡标3#财务章', 'XB3#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('906', '62', '1', '2', '000003', '000426', '锡标3#法人章', 'XB3#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('907', '62', '1', '2', '000003', '000427', '锡标4#公章', 'XB4#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('908', '62', '1', '2', '000003', '000428', '锡标4#财务章', 'XB4#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('909', '62', '1', '2', '000003', '000429', '锡标4#法人章', 'XB4#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('910', '62', '1', '2', '000003', '000430', '锡标7#公章', 'XB7#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('911', '62', '1', '2', '000003', '000431', '锡标7#财务章', 'XB7#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('912', '62', '1', '2', '000003', '000432', '锡标7#法人章', 'XB7#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('913', '62', '1', '2', '000003', '000433', '锡标8#财务章', 'XB8#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('914', '62', '1', '2', '000003', '000434', '锡标8#法人章', 'XB8#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('915', '62', '1', '2', '000003', '000435', '锡标10#财务章', 'XB10#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('916', '62', '1', '2', '000003', '000436', '锡标10#法人章', 'XB10#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('917', '62', '1', '2', '000004', '000437', '锡标浙商银行U盾经办', 'XBZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('918', '62', '1', '2', '000004', '000438', '锡标浙商银行U盾复核', 'XBZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('919', '62', '1', '2', '000004', '000439', '锡标民生银行U盾经办', 'XBMSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('920', '62', '1', '2', '000004', '000440', '锡标民生银行U盾复核', 'XBMSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('921', '62', '1', '2', '000004', '000441', '锡标中原银行U盾经办', 'XBZYYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('922', '63', '1', '1', '000002', '000442', '安晟瑞信营业执照正本', 'ARXYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('923', '63', '1', '1', '000002', '000443', '安晟瑞信营业执照副本', 'ARXYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('924', '63', '1', '1', '000002', '000444', '安晟瑞信开户许可证', 'ARXKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('925', '63', '1', '2', '000004', '000445', '安晟瑞信建设银行U盾经办', 'ARXJSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('926', '63', '1', '2', '000004', '000446', '安晟瑞信建设银行U盾复核', 'ARXJSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('927', '64', '1', '1', '000002', '000447', '富德隆营业执照正本', 'FDLYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('928', '64', '1', '1', '000002', '000448', '富德隆营业执照副本', 'FDLYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('929', '64', '1', '1', '000002', '000449', '富德隆开户许可证', 'FDLKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('930', '64', '1', '2', '000004', '000450', '富德隆浙商银行U盾经办', 'FDLZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('931', '65', '1', '1', '000002', '000451', '康烁营业执照正本', 'KSYYZZZB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('932', '65', '1', '1', '000002', '000452', '康烁营业执照副本', 'KSYYZZFB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('933', '65', '1', '1', '000002', '000453', '康烁开户许可证', 'KSKHXKZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('934', '65', '1', '2', '000003', '000454', '康烁1#公章', 'KS1#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('935', '65', '1', '2', '000003', '000455', '康烁1#财务章', 'KS1#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('936', '65', '1', '2', '000003', '000456', '康烁1#法人章', 'KS1#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('937', '65', '1', '2', '000003', '000457', '康烁2#公章', 'KS2#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('938', '65', '1', '2', '000003', '000458', '康烁2#财务章', 'KS2#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('939', '65', '1', '2', '000003', '000459', '康烁2#法人章', 'KS2#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('940', '65', '1', '2', '000003', '000460', '康烁3#公章', 'KS3#GZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('941', '65', '1', '2', '000003', '000461', '康烁3#财务章', 'KS3#CWZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('942', '65', '1', '2', '000003', '000462', '康烁3#法人章', 'KS3#FRZ', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('943', '65', '1', '2', '000004', '000463', '康烁浙商银行U盾经办', 'KSZSYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('944', '65', '1', '2', '000004', '000464', '康烁浙商银行U盾复核', 'KSZSYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('945', '65', '1', '2', '000004', '000465', '康烁中信银行U盾经办', 'KSZXYXUDJB', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);
INSERT INTO `erp_effects` VALUES ('946', '65', '1', '2', '000004', '000466', '康烁中信银行U盾复核', 'KSZXYXUDFH', null, null, null, '0', '1', null, '1', '默认管理员', '1', null, '0', '1', '0', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', 'admin', '2019-02-25 15:27:13', '1', '0', null);

-- ----------------------------
-- Table structure for erp_effects_category
-- ----------------------------
DROP TABLE IF EXISTS `erp_effects_category`;
CREATE TABLE `erp_effects_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL COMMENT '上级id',
  `code` varchar(50) DEFAULT NULL COMMENT '代码',
  `name` varchar(100) DEFAULT NULL COMMENT '名称',
  `approval_require` tinyint(4) NOT NULL DEFAULT '0' COMMENT '审批要求:0;无#1;互审#2;一级#3;二级',
  `alarm_days` int(11) DEFAULT '0' COMMENT '提前报警(天)',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:0;无效#1;有效',
  `sort` smallint(8) DEFAULT '0' COMMENT '排序',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更改时间',
  `company_id` int(11) DEFAULT NULL COMMENT '公司id',
  `full_path` varchar(100) DEFAULT NULL COMMENT '路径',
  `onlyone` tinyint(4) NOT NULL DEFAULT '0' COMMENT '单一物品:0;否#1;是',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '层级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='物品分类';

-- ----------------------------
-- Records of erp_effects_category
-- ----------------------------
INSERT INTO `erp_effects_category` VALUES ('7', '0', '00', '物品', '1', '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-03-22 11:07:08', '38', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('8', '7', '0001', '证照', '1', '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-03-22 11:07:05', '38', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('9', '7', '0002', '章', '1', '0', '1', '0', '2019-02-25 15:27:06', 'admin', '2019-02-25 15:27:06', 'admin', '2019-03-22 11:07:05', '38', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('10', '7', '0003', '银行网银', '1', '0', '1', '0', '2019-02-25 15:27:07', 'admin', '2019-02-25 15:27:07', 'admin', '2019-03-22 11:07:05', '38', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('11', '0', '05', '阿胶', '0', '0', '1', '0', '2019-03-11 16:11:00', '1', '2019-03-11 16:11:00', '1', '2019-03-22 11:16:52', '38', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('12', '0', '01', '草豆蔻', '3', '3', '1', '0', '2019-03-11 16:13:25', '1', '2019-03-21 13:28:12', '1', '2019-03-22 11:05:30', '38', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('13', '12', '0101', '3333333333333', '0', '0', '1', '0', '2019-03-15 19:37:23', '1', '2019-03-15 19:37:23', '1', '2019-03-22 11:16:51', '38', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('14', '13', '010101', '44444444444', '0', '0', '1', '0', '2019-03-15 19:37:30', '1', '2019-03-15 19:37:30', '1', '2019-03-22 11:16:51', '38', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('15', '14', '01010101', '555555555555', '0', '0', '1', '0', '2019-03-15 19:37:37', '1', '2019-03-15 19:37:37', '1', '2019-03-22 11:16:51', '38', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('16', '12', '0101', '草豆蔻', '0', '0', '1', '0', '2019-03-18 15:41:51', '1', '2019-03-18 15:41:51', '1', '2019-03-22 11:06:06', '38', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('17', '0', '03', '22222222222222', '0', '11', '1', '0', '2019-03-22 11:03:39', '1', '2019-03-22 11:04:21', '1', '2019-03-22 11:09:05', '39', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('18', '17', '0301', '33333333333333333333', '0', '0', '1', '0', '2019-03-22 11:03:50', '1', '2019-03-22 11:04:07', '1', '2019-03-22 11:09:07', '39', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('19', '18', '030101', '55555555555555', '0', '0', '1', '0', '2019-03-22 11:15:59', '1', '2019-03-22 11:15:59', '1', '2019-03-22 11:15:59', '39', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('20', '0', '06', 'aaaaaaaaaa', '0', '0', '1', '0', '2019-03-22 12:38:01', '1', '2019-03-22 12:38:01', '1', '2019-03-22 12:38:01', '40', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('21', '0', '07', '323123', '0', '0', '1', '0', '2019-03-27 15:10:55', '1', '2019-03-27 15:10:55', '1', '2019-03-27 15:10:55', '45', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('22', '21', '0701', '434444444', '0', '0', '1', '0', '2019-03-27 15:11:16', '1', '2019-03-27 15:11:16', '1', '2019-03-27 15:11:16', '45', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('23', '21', '0702', '555555', '0', '0', '1', '0', '2019-03-27 15:11:25', '1', '2019-03-27 15:11:25', '1', '2019-03-27 15:11:25', '45', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('24', '0', '08', '4444444', '0', '0', '1', '0', '2019-03-27 15:11:37', '1', '2019-03-27 15:11:37', '1', '2019-03-27 15:11:37', '45', null, '0', '0');
INSERT INTO `erp_effects_category` VALUES ('25', '0', '09', '333333', '0', '0', '1', '0', '2019-03-27 15:41:12', '1', '2019-03-27 15:41:12', '1', '2019-03-27 15:41:12', '8', null, '0', '0');

-- ----------------------------
-- Table structure for erp_effects_category_list
-- ----------------------------
DROP TABLE IF EXISTS `erp_effects_category_list`;
CREATE TABLE `erp_effects_category_list` (
  `effects_category_id` int(11) NOT NULL COMMENT '分类id',
  `effects_id` int(11) NOT NULL COMMENT '物品id',
  PRIMARY KEY (`effects_category_id`,`effects_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='物品分类清单';

-- ----------------------------
-- Records of erp_effects_category_list
-- ----------------------------
INSERT INTO `erp_effects_category_list` VALUES ('10', '483');
INSERT INTO `erp_effects_category_list` VALUES ('10', '488');
INSERT INTO `erp_effects_category_list` VALUES ('12', '489');
INSERT INTO `erp_effects_category_list` VALUES ('12', '490');
INSERT INTO `erp_effects_category_list` VALUES ('12', '491');

-- ----------------------------
-- Table structure for erp_exam
-- ----------------------------
DROP TABLE IF EXISTS `erp_exam`;
CREATE TABLE `erp_exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_no` varchar(50) DEFAULT NULL COMMENT '试卷编码',
  `templet_id` int(11) DEFAULT NULL COMMENT '模板id',
  `templet_no` varchar(50) DEFAULT NULL COMMENT '模板编码',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型:0;练习#1;期中#2;期末',
  `subject` varchar(150) DEFAULT NULL COMMENT '标题',
  `details` int(11) DEFAULT '0' COMMENT '明细数',
  `count` int(11) DEFAULT '0' COMMENT '题量',
  `score` int(11) DEFAULT '0' COMMENT '总分',
  `req_time` int(11) DEFAULT '0' COMMENT '时间要求(分钟)',
  `req_content` text COMMENT '卷面要求',
  `remarks` text COMMENT '备注',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:0;草稿#1;确认#7;取消',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6) COMMENT '更改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_exam_no` (`exam_no`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='试卷';

-- ----------------------------
-- Records of erp_exam
-- ----------------------------
INSERT INTO `erp_exam` VALUES ('1', '15529977154107939', null, '11111', '0', '222222222222', '2', '22', '77', '120', '11111111111111', '', '0', '2019-03-19 20:15:15', 'admin', '2019-03-25 21:41:03', 'admin', '2019-03-25 21:41:03.902044');

-- ----------------------------
-- Table structure for erp_exam_detail
-- ----------------------------
DROP TABLE IF EXISTS `erp_exam_detail`;
CREATE TABLE `erp_exam_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) DEFAULT NULL COMMENT '试卷id',
  `exam_no` varchar(50) DEFAULT NULL COMMENT '试卷编码',
  `templet_id` int(11) DEFAULT NULL COMMENT '模板id',
  `templet_detail_id` int(11) DEFAULT NULL COMMENT '模板明细id',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型:0;标题#1;题目',
  `subject` text COMMENT '标题',
  `seq` int(11) DEFAULT '0' COMMENT '题号',
  `score` int(11) DEFAULT '0' COMMENT '分数',
  `question_parent_id` int(11) DEFAULT NULL COMMENT '套题id',
  `question_id` int(11) DEFAULT NULL COMMENT '题库id',
  `question_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '试题类型:0;标准#1;套题#2;小题',
  `question_code` varchar(50) DEFAULT NULL COMMENT '试题编码',
  `question_name` varchar(100) DEFAULT NULL COMMENT '试题名称',
  `question_category_code` varchar(50) DEFAULT NULL COMMENT '知识点码',
  `question_category_name` varchar(100) DEFAULT NULL COMMENT '试题知识点',
  `question_kind` varchar(50) DEFAULT NULL COMMENT '试题题型',
  `question_stem` text COMMENT '试题题干',
  `question_quiz` text COMMENT '试题设问',
  `question_answer` text COMMENT '试题答案',
  `question_childs` int(11) DEFAULT '0' COMMENT '试题小题数',
  `question_img` varchar(255) DEFAULT NULL COMMENT '试题图像',
  `extract_count` int(11) DEFAULT '0' COMMENT '抽取次数',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6) COMMENT '更改时间',
  PRIMARY KEY (`id`),
  KEY `idx_examno` (`exam_no`),
  KEY `idx_examid` (`exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='试卷明细';

-- ----------------------------
-- Records of erp_exam_detail
-- ----------------------------
INSERT INTO `erp_exam_detail` VALUES ('27', '1', '15529977154107939', null, null, '0', '11', '22', '33', null, '1', '0', '111', '矮地茶1', '知识点51', '知识点5122222', 'dx', '423423423', '423434', '4234234234', '0', null, '44', null, null, null, null, '2019-03-25 21:40:26.330387');
INSERT INTO `erp_exam_detail` VALUES ('28', '1', '15529977154107939', null, null, '0', '22', '33', '44', null, '5', '0', '555', '矮地茶1', '知识点51', '知识点5122222', 'dx', '423423423', '423434', '4234234234', '0', null, '55', null, null, null, null, '2019-03-25 21:41:03.900508');

-- ----------------------------
-- Table structure for erp_log_common
-- ----------------------------
DROP TABLE IF EXISTS `erp_log_common`;
CREATE TABLE `erp_log_common` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` datetime DEFAULT NULL COMMENT '处理时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '处理人员',
  `type` varchar(30) DEFAULT NULL COMMENT '类型:user;用户#style1;颜色#style2;尺码#year;年份#shop;店铺#season;季节#payment;支付方式#platform;平台#goods;商品#group;分组#department;部门#deliver;配送#customer;供应商#category;分类#brand;品牌#area;地区#activity;活动#return_reason;退货理由#storage;仓库',
  `data_id` int(11) DEFAULT NULL COMMENT '信息id',
  `data_code` varchar(50) DEFAULT NULL COMMENT '代码',
  `subject` varchar(100) DEFAULT NULL COMMENT '标题',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `content` text COMMENT '内容',
  `lastchanged` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8 COMMENT='信息处理日志';

-- ----------------------------
-- Records of erp_log_common
-- ----------------------------
INSERT INTO `erp_log_common` VALUES ('1', '2019-02-28 16:38:53', 'admin', 'department', '1', 'd001', '变更部门信息', '1', '[上级:0],[层级:100],[排序:105],[状态:1];', '2019-02-28 16:38:53');
INSERT INTO `erp_log_common` VALUES ('2', '2019-02-28 16:39:03', 'admin', 'department', '2', 'd002', '变更部门信息', '0', '[上级:1],[层级:105],[排序:105];', '2019-02-28 16:39:03');
INSERT INTO `erp_log_common` VALUES ('3', '2019-02-28 16:39:45', 'admin', 'apply', '1', 'AP15447015586768272', '变更出借申请信息', '0', '[申请人员:2],[物品编码:000020],[物品名称:中电豪信6#法人章];', '2019-02-28 16:39:45');
INSERT INTO `erp_log_common` VALUES ('4', '2019-02-28 16:40:49', 'admin', 'apply', '1', 'AP15447015586768272', '变更出借申请信息', '1', ';', '2019-02-28 16:40:49');
INSERT INTO `erp_log_common` VALUES ('5', '2019-02-28 18:48:14', 'admin', 'project', '1', '0001', '变更项目信息', '1', '[处理状态:1];', '2019-02-28 18:48:14');
INSERT INTO `erp_log_common` VALUES ('6', '2019-02-28 19:42:57', 'admin', 'trade', '14', null, '删除贸易链信息', '0', '', '2019-02-28 19:42:57');
INSERT INTO `erp_log_common` VALUES ('7', '2019-02-28 19:43:53', 'admin', 'trade', '15', null, '删除贸易链信息', '0', '', '2019-02-28 19:43:53');
INSERT INTO `erp_log_common` VALUES ('8', '2019-03-08 13:47:30', 'admin', 'project', '1', '0001', '状态调整', '0', '状态[无效], 备注: 2 , 1111111111111', '2019-03-08 13:47:30');
INSERT INTO `erp_log_common` VALUES ('9', '2019-03-08 13:47:38', 'admin', 'project', '1', '0001', '状态调整', '1', '状态[有效], 备注: 1 , 111111', '2019-03-08 13:47:38');
INSERT INTO `erp_log_common` VALUES ('10', '2019-03-08 15:14:56', 'admin', 'project', '1', '0001', '状态调整', '0', '状态[无效], 备注: 2 , ', '2019-03-08 15:14:56');
INSERT INTO `erp_log_common` VALUES ('11', '2019-03-08 15:15:01', 'admin', 'project', '1', '0001', '状态调整', '1', '状态[有效], 备注: 1 , 2222', '2019-03-08 15:15:01');
INSERT INTO `erp_log_common` VALUES ('12', '2019-03-08 17:43:45', 'admin', 'project', '1', '0001', '状态调整', '2', '状态[结束], 备注: 1 , ', '2019-03-08 17:43:45');
INSERT INTO `erp_log_common` VALUES ('13', '2019-03-08 17:50:50', 'admin', 'project', '1', '0001', '状态调整', '1', '状态[有效], 备注:  , ', '2019-03-08 17:50:50');
INSERT INTO `erp_log_common` VALUES ('14', '2019-03-08 17:50:56', 'admin', 'project', '1', '0001', '状态调整', '2', '状态[结束], 备注: 1 , ', '2019-03-08 17:50:56');
INSERT INTO `erp_log_common` VALUES ('15', '2019-03-08 17:55:51', 'admin', 'project', '1', '0001', '状态调整', '1', '状态[有效], 备注:  , ', '2019-03-08 17:55:51');
INSERT INTO `erp_log_common` VALUES ('16', '2019-03-08 17:57:37', 'admin', 'project', '1', '0001', '状态调整', '2', '状态[结束], 备注: 正常操作 , ', '2019-03-08 17:57:37');
INSERT INTO `erp_log_common` VALUES ('17', '2019-03-08 17:57:42', 'admin', 'project', '1', '0001', '状态调整', '1', '状态[有效], 备注:  , ', '2019-03-08 17:57:42');
INSERT INTO `erp_log_common` VALUES ('18', '2019-03-08 20:02:08', 'admin', 'project', '1', '0001', '状态调整', '0', '状态[无效], 备注: 其他原因 , 222222222222222', '2019-03-08 20:02:08');
INSERT INTO `erp_log_common` VALUES ('19', '2019-03-08 20:03:23', 'admin', 'project', '1', '0001', '状态调整', '1', '状态[有效], 备注: 正常操作 , ', '2019-03-08 20:03:23');
INSERT INTO `erp_log_common` VALUES ('20', '2019-03-08 20:03:30', 'admin', 'project', '1', '0001', '状态调整', '2', '状态[结束], 备注: 正常操作 , ', '2019-03-08 20:03:30');
INSERT INTO `erp_log_common` VALUES ('21', '2019-03-08 20:03:52', 'admin', 'project', '1', '0001', '状态调整', '1', '状态[有效], 备注: 资料错误 , ', '2019-03-08 20:03:52');
INSERT INTO `erp_log_common` VALUES ('22', '2019-03-08 20:04:29', 'admin', 'project', '1', '0001', '状态调整', '2', '状态[结束], 备注: 正常操作 , ', '2019-03-08 20:04:29');
INSERT INTO `erp_log_common` VALUES ('23', '2019-03-08 20:04:36', 'admin', 'project', '1', '0001', '状态调整', '1', '状态[有效], 备注:  , 333333', '2019-03-08 20:04:36');
INSERT INTO `erp_log_common` VALUES ('24', '2019-03-08 20:07:27', 'admin', 'project', '1', '0001', '状态调整', '2', '状态[结束], 备注: 正常操作', '2019-03-08 20:07:27');
INSERT INTO `erp_log_common` VALUES ('25', '2019-03-08 20:07:37', 'admin', 'project', '1', '0001', '状态调整', '1', '状态[有效], 备注: 3123123123123123123', '2019-03-08 20:07:37');
INSERT INTO `erp_log_common` VALUES ('26', '2019-03-08 20:07:47', 'admin', 'project', '1', '0001', '状态调整', '0', '状态[无效], 备注: 信息变化, 3213123213123123', '2019-03-08 20:07:47');
INSERT INTO `erp_log_common` VALUES ('27', '2019-03-08 20:36:54', 'admin', 'project', '1', '0001', '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-08 20:36:54');
INSERT INTO `erp_log_common` VALUES ('28', '2019-03-08 20:37:22', 'admin', 'project', '2', '0002', '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-08 20:37:22');
INSERT INTO `erp_log_common` VALUES ('29', '2019-03-08 20:37:44', 'admin', 'project', '3', null, '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-08 20:37:44');
INSERT INTO `erp_log_common` VALUES ('30', '2019-03-08 20:37:59', 'admin', 'project', '3', null, '状态调整', '0', '状态[无效], 备注: rwerwerwer', '2019-03-08 20:37:59');
INSERT INTO `erp_log_common` VALUES ('31', '2019-03-08 20:41:43', 'admin', 'project', '3', null, '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-08 20:41:43');
INSERT INTO `erp_log_common` VALUES ('32', '2019-03-08 20:42:08', 'admin', 'project', '1', '0001', '状态调整', '0', '状态[无效], 备注: 333333', '2019-03-08 20:42:08');
INSERT INTO `erp_log_common` VALUES ('33', '2019-03-08 20:43:00', 'admin', 'project', '1', '0001', '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-08 20:43:00');
INSERT INTO `erp_log_common` VALUES ('34', '2019-03-08 20:43:13', 'admin', 'project', '3', null, '状态调整', '0', '状态[无效], 备注: 3333333', '2019-03-08 20:43:13');
INSERT INTO `erp_log_common` VALUES ('35', '2019-03-08 21:35:07', 'admin', 'project', '1', '0001', '状态调整', '0', '状态[无效], 备注: 1231231', '2019-03-08 21:35:07');
INSERT INTO `erp_log_common` VALUES ('36', '2019-03-08 21:46:17', 'admin', 'project', '1', '0001', '变更项目信息', '0', '[项目地址:湖北省公安县麻豪口镇沙场新街141号沙场药店],[申请起始:2019-03-09 00:00:00],[申请结束:2019-03-10 00:00:00];', '2019-03-08 21:46:17');
INSERT INTO `erp_log_common` VALUES ('37', '2019-03-08 21:46:26', 'admin', 'project', '1', '0001', '变更项目信息', '0', '[申请起始:2019-03-12 00:00:00];', '2019-03-08 21:46:26');
INSERT INTO `erp_log_common` VALUES ('38', '2019-03-08 21:50:26', 'admin', 'project', '1', '0001', '变更项目信息', '0', '[申请起始:2019-03-08 00:00:00];', '2019-03-08 21:50:26');
INSERT INTO `erp_log_common` VALUES ('39', '2019-03-08 21:50:42', 'admin', 'project', '1', '0001', '变更项目信息', '0', ';', '2019-03-08 21:50:42');
INSERT INTO `erp_log_common` VALUES ('40', '2019-03-10 15:58:14', 'admin', 'day_price', '1', null, '新增每日价格区间', '0', '', '2019-03-10 15:58:14');
INSERT INTO `erp_log_common` VALUES ('41', '2019-03-10 21:22:34', 'admin', 'trade', '5', null, '删除贸易链信息', '0', '', '2019-03-10 21:22:34');
INSERT INTO `erp_log_common` VALUES ('42', '2019-03-10 21:22:39', 'admin', 'trade', '4', null, '删除贸易链信息', '0', '', '2019-03-10 21:22:39');
INSERT INTO `erp_log_common` VALUES ('43', '2019-03-10 21:22:52', 'admin', 'trade', '1', null, '删除贸易链信息', '0', '', '2019-03-10 21:22:52');
INSERT INTO `erp_log_common` VALUES ('44', '2019-03-10 21:28:41', 'admin', 'trade', '6', null, '删除贸易链信息', '0', '', '2019-03-10 21:28:41');
INSERT INTO `erp_log_common` VALUES ('45', '2019-03-10 21:55:42', 'admin', 'trade', '8', null, '状态调整', '0', '状态[草稿], 备注: 资料错误, 333333', '2019-03-10 21:55:42');
INSERT INTO `erp_log_common` VALUES ('46', '2019-03-10 21:56:30', 'admin', 'trade', '8', null, '状态调整', '1', '状态[有效], 备注: ', '2019-03-10 21:56:30');
INSERT INTO `erp_log_common` VALUES ('47', '2019-03-10 22:09:00', 'admin', 'trade', '7', null, '状态调整', '1', '状态[有效], 备注: ', '2019-03-10 22:09:00');
INSERT INTO `erp_log_common` VALUES ('48', '2019-03-10 22:59:15', 'admin', 'trade', '8', '192', '状态调整', '7', '[取消人员:admin],[取消时间:2019-03-10 22:59:15];', '2019-03-10 22:59:15');
INSERT INTO `erp_log_common` VALUES ('49', '2019-03-11 14:15:58', 'admin', 'trade', '9', null, '状态调整', '1', '状态[有效], 备注: ', '2019-03-11 14:15:58');
INSERT INTO `erp_log_common` VALUES ('50', '2019-03-11 14:17:27', 'admin', 'trade', '9', null, '状态调整', '0', '状态[草稿], 备注: werwerwer', '2019-03-11 14:17:27');
INSERT INTO `erp_log_common` VALUES ('51', '2019-03-11 14:20:25', 'admin', 'trade', '9', null, '状态调整', '1', '状态[有效], 备注: ', '2019-03-11 14:20:25');
INSERT INTO `erp_log_common` VALUES ('52', '2019-03-11 14:21:19', 'admin', 'trade', '9', null, '状态调整', '0', '状态[草稿], 备注: rrrr\r\n', '2019-03-11 14:21:19');
INSERT INTO `erp_log_common` VALUES ('53', '2019-03-11 14:21:22', 'admin', 'trade', '9', null, '删除贸易链信息', '0', '', '2019-03-11 14:21:22');
INSERT INTO `erp_log_common` VALUES ('54', '2019-03-11 14:28:31', 'admin', 'trade', '11', null, '状态调整', '1', '状态[有效], 备注: ', '2019-03-11 14:28:31');
INSERT INTO `erp_log_common` VALUES ('55', '2019-03-11 14:37:36', 'admin', 'trade', '11', null, '状态调整', '0', '状态[草稿], 备注: 资料错误', '2019-03-11 14:37:36');
INSERT INTO `erp_log_common` VALUES ('56', '2019-03-11 14:37:39', 'admin', 'trade', '11', null, '状态调整', '1', '状态[有效], 备注: ', '2019-03-11 14:37:39');
INSERT INTO `erp_log_common` VALUES ('57', '2019-03-11 14:37:44', 'admin', 'trade', '11', null, '状态调整', '0', '状态[草稿], 备注: 信息变化', '2019-03-11 14:37:44');
INSERT INTO `erp_log_common` VALUES ('58', '2019-03-11 14:40:43', 'admin', 'trade', '11', null, '状态调整', '1', '状态[有效], 备注: ', '2019-03-11 14:40:43');
INSERT INTO `erp_log_common` VALUES ('59', '2019-03-11 14:40:52', 'admin', 'trade', '11', null, '状态调整', '0', '状态[草稿], 备注: 信息变化', '2019-03-11 14:40:52');
INSERT INTO `erp_log_common` VALUES ('60', '2019-03-11 14:41:43', 'admin', 'trade', '11', null, '删除贸易链信息', '0', '', '2019-03-11 14:41:43');
INSERT INTO `erp_log_common` VALUES ('61', '2019-03-11 14:42:16', 'admin', 'trade', '12', null, '状态调整', '1', '状态[有效], 备注: ', '2019-03-11 14:42:16');
INSERT INTO `erp_log_common` VALUES ('62', '2019-03-11 15:00:48', 'admin', 'trade', '12', null, '状态调整', '0', '状态[草稿], 备注: r33r', '2019-03-11 15:00:48');
INSERT INTO `erp_log_common` VALUES ('63', '2019-03-11 15:00:51', 'admin', 'trade', '12', null, '删除贸易链信息', '0', '', '2019-03-11 15:00:51');
INSERT INTO `erp_log_common` VALUES ('64', '2019-03-11 15:01:07', 'admin', 'trade', '13', null, '删除贸易链信息', '0', '', '2019-03-11 15:01:07');
INSERT INTO `erp_log_common` VALUES ('65', '2019-03-11 15:06:42', 'admin', 'trade', '14', null, '状态调整', '1', '状态[有效], 备注: ', '2019-03-11 15:06:42');
INSERT INTO `erp_log_common` VALUES ('66', '2019-03-11 15:06:57', 'admin', 'trade', '14', null, '状态调整', '0', '状态[草稿], 备注: 资料错误', '2019-03-11 15:06:57');
INSERT INTO `erp_log_common` VALUES ('67', '2019-03-11 15:07:11', 'admin', 'trade', '14', null, '状态调整', '1', '状态[有效], 备注: ', '2019-03-11 15:07:11');
INSERT INTO `erp_log_common` VALUES ('68', '2019-03-11 15:08:38', 'admin', 'trade', '14', null, '状态调整', '0', '状态[草稿], 备注: 资料错误', '2019-03-11 15:08:38');
INSERT INTO `erp_log_common` VALUES ('69', '2019-03-11 15:09:01', 'admin', 'trade', '14', null, '删除贸易链信息', '0', '', '2019-03-11 15:09:01');
INSERT INTO `erp_log_common` VALUES ('70', null, null, null, null, null, null, '0', null, '2019-03-11 16:11:00');
INSERT INTO `erp_log_common` VALUES ('71', null, null, null, null, null, null, '0', null, '2019-03-11 16:13:25');
INSERT INTO `erp_log_common` VALUES ('72', '2019-03-11 16:34:34', 'admin', 'effects', '481', '000001', '添加分类', '1', '添加[中电豪信营业执照正本=草豆蔻]', '2019-03-11 16:34:34');
INSERT INTO `erp_log_common` VALUES ('73', '2019-03-12 15:36:36', 'admin', 'customer', '1', '15523761760745285', '删除客户档案信息', '0', '', '2019-03-12 15:36:36');
INSERT INTO `erp_log_common` VALUES ('74', '2019-03-12 15:37:15', 'admin', 'customer', '2', '15523762250703109', '删除客户档案信息', '0', '', '2019-03-12 15:37:15');
INSERT INTO `erp_log_common` VALUES ('75', '2019-03-12 16:15:11', 'admin', 'customer', '3', '15523785036915637', '删除客户档案信息', '0', '', '2019-03-12 16:15:12');
INSERT INTO `erp_log_common` VALUES ('76', '2019-03-12 16:15:25', 'admin', 'customer', '4', '15523785181911231', '删除客户档案信息', '0', '', '2019-03-12 16:15:25');
INSERT INTO `erp_log_common` VALUES ('77', '2019-03-12 16:16:11', 'admin', 'customer', '5', '15523785440177137', '删除客户档案信息', '0', '', '2019-03-12 16:16:11');
INSERT INTO `erp_log_common` VALUES ('78', '2019-03-12 16:23:32', 'admin', 'customer', '6', '15523789773205237', '删除客户档案信息', '0', '', '2019-03-12 16:23:32');
INSERT INTO `erp_log_common` VALUES ('79', '2019-03-12 16:28:56', 'admin', 'customer', '7', '15523790231131451', '删除客户档案信息', '0', '', '2019-03-12 16:28:56');
INSERT INTO `erp_log_common` VALUES ('80', '2019-03-12 16:35:17', 'admin', 'customer', '8', '15523793504192515', '删除客户档案信息', '0', '', '2019-03-12 16:35:17');
INSERT INTO `erp_log_common` VALUES ('81', '2019-03-12 17:56:54', 'admin', 'customer', '9', '15523807455569147', '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-12 17:56:54');
INSERT INTO `erp_log_common` VALUES ('82', '2019-03-12 18:38:45', 'admin', 'customer', '16', '1113', '删除客户档案信息', '0', '', '2019-03-12 18:38:45');
INSERT INTO `erp_log_common` VALUES ('83', '2019-03-12 18:40:04', 'admin', 'customer', '14', '客户代码11', '删除客户档案信息', '0', '', '2019-03-12 18:40:04');
INSERT INTO `erp_log_common` VALUES ('84', '2019-03-12 19:03:16', 'admin', 'customer', '9', '15523807455569147', '状态调整', '0', '状态[无效], 备注: 资料错误, 1111', '2019-03-12 19:03:16');
INSERT INTO `erp_log_common` VALUES ('85', '2019-03-12 19:06:09', 'admin', 'customer', '13', '3123123', '删除客户档案信息', '0', '', '2019-03-12 19:06:09');
INSERT INTO `erp_log_common` VALUES ('86', '2019-03-12 19:31:31', 'admin', 'customer', '15', '3830', '删除客户档案信息', '0', '', '2019-03-12 19:31:31');
INSERT INTO `erp_log_common` VALUES ('87', '2019-03-12 19:32:32', 'admin', 'customer', '12', '3825', '删除客户档案信息', '0', '', '2019-03-12 19:32:32');
INSERT INTO `erp_log_common` VALUES ('88', '2019-03-12 19:33:34', 'admin', 'customer', '11', '15523826331741739', '删除客户档案信息', '0', '', '2019-03-12 19:33:34');
INSERT INTO `erp_log_common` VALUES ('89', '2019-03-12 19:35:43', 'admin', 'customer', '10', '15523807752795586', '删除客户档案信息', '0', '', '2019-03-12 19:35:43');
INSERT INTO `erp_log_common` VALUES ('90', '2019-03-12 19:36:54', 'admin', 'customer', '9', '15523807455569147', '删除客户档案信息', '0', '', '2019-03-12 19:36:54');
INSERT INTO `erp_log_common` VALUES ('92', '2019-03-12 19:37:48', 'admin', 'customer', '17', '312321', '删除客户档案信息', '0', '', '2019-03-12 19:37:48');
INSERT INTO `erp_log_common` VALUES ('94', '2019-03-12 19:39:51', 'admin', 'customer', '18', 'ee321', '删除客户档案信息', '0', '', '2019-03-12 19:39:51');
INSERT INTO `erp_log_common` VALUES ('96', '2019-03-12 19:46:49', 'admin', 'customer', '19', '2222', '删除客户档案信息', '0', '', '2019-03-12 19:46:49');
INSERT INTO `erp_log_common` VALUES ('97', '2019-03-12 19:50:13', 'admin', 'effects', '481', '000001', '删除分类', '1', '删除[中电豪信营业执照正本=草豆蔻]', '2019-03-12 19:50:13');
INSERT INTO `erp_log_common` VALUES ('98', '2019-03-12 19:52:14', 'admin', 'effects', '490', '000010', '添加分类', '1', '添加[中电豪信3#公章=草豆蔻]', '2019-03-12 19:52:14');
INSERT INTO `erp_log_common` VALUES ('99', '2019-03-12 19:56:45', 'admin', 'effects', '491', '000011', '添加分类', '1', '添加[中电豪信2#法人章=草豆蔻,中电豪信3#财务章=草豆蔻]', '2019-03-12 19:56:45');
INSERT INTO `erp_log_common` VALUES ('102', '2019-03-12 20:26:08', 'admin', 'customer', '21', '3830', '删除记录', '0', '', '2019-03-12 20:26:08');
INSERT INTO `erp_log_common` VALUES ('104', '2019-03-12 20:26:58', 'admin', 'customer', '22', '3123123333', '删除记录', '0', '', '2019-03-12 20:26:58');
INSERT INTO `erp_log_common` VALUES ('105', '2019-03-12 20:28:34', 'admin', 'customer', '20', '3123123', '删除记录', '0', '', '2019-03-12 20:28:34');
INSERT INTO `erp_log_common` VALUES ('107', '2019-03-12 20:40:55', 'admin', 'customer', '23', '111', '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-12 20:40:55');
INSERT INTO `erp_log_common` VALUES ('108', '2019-03-12 20:41:28', 'admin', 'customer', '23', '111', '状态调整', '0', '状态[无效], 备注: rrrr', '2019-03-12 20:41:28');
INSERT INTO `erp_log_common` VALUES ('109', '2019-03-12 20:41:33', 'admin', 'customer', '23', '111', '状态调整', '1', '状态[有效], 备注: 正常操作, 44444', '2019-03-12 20:41:33');
INSERT INTO `erp_log_common` VALUES ('110', '2019-03-13 13:42:41', 'admin', 'customer', '23', '111', '状态调整', '0', '状态[无效], 备注: 6456456456456', '2019-03-13 13:42:41');
INSERT INTO `erp_log_common` VALUES ('111', '2019-03-13 13:43:04', 'admin', 'customer', '23', '111', '变更客户档案', '0', '[层级:4];', '2019-03-13 13:43:04');
INSERT INTO `erp_log_common` VALUES ('112', '2019-03-13 13:44:06', 'admin', 'customer', '23', '111', '变更客户档案', '0', '[客户全称:大打算打算打手电],[拼音缩写:ddsdsdsd];', '2019-03-13 13:44:06');
INSERT INTO `erp_log_common` VALUES ('113', '2019-03-13 13:44:14', 'admin', 'customer', '23', '111', '删除记录', '0', '', '2019-03-13 13:44:14');
INSERT INTO `erp_log_common` VALUES ('115', '2019-03-13 18:07:42', 'admin', 'customer', '24', '111', '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-13 18:07:42');
INSERT INTO `erp_log_common` VALUES ('116', '2019-03-13 18:07:45', 'admin', 'customer', '25', '22', '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-13 18:07:45');
INSERT INTO `erp_log_common` VALUES ('117', '2019-03-13 18:07:48', 'admin', 'customer', '26', '11', '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-13 18:07:48');
INSERT INTO `erp_log_common` VALUES ('118', '2019-03-13 18:07:50', 'admin', 'customer', '27', '33', '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-13 18:07:50');
INSERT INTO `erp_log_common` VALUES ('119', '2019-03-13 18:08:48', 'admin', 'customer', '24', '111', '状态调整', '0', '状态[无效], 备注: 资料错误', '2019-03-13 18:08:48');
INSERT INTO `erp_log_common` VALUES ('132', '2019-03-13 19:14:34', 'admin', 'customer', '39', '11', '新增导入', '0', '[客户类型:1],[上级ID:1001],[客户代码:11],[客户名称:a1],[拼音缩写:py],[客户全称:aaaa],[省份:江苏],[手机:133312343434],[联系人:111],[备注信息:快乐],[层级:1],[状态:0],[创建时间:2019-03-13 19:14:34],[创建人员:admin];', '2019-03-13 19:14:34');
INSERT INTO `erp_log_common` VALUES ('133', '2019-03-13 19:14:34', 'admin', 'customer', '40', '22', '新增导入', '0', '[客户类型:2],[上级ID:1002],[客户代码:22],[客户名称:b2],[拼音缩写:ay],[客户全称:bbbb],[省份:上海],[手机:133312343434],[联系人:222],[备注信息:潇洒],[层级:2],[状态:0],[创建时间:2019-03-13 19:14:34],[创建人员:admin];', '2019-03-13 19:14:34');
INSERT INTO `erp_log_common` VALUES ('134', '2019-03-13 19:14:34', 'admin', 'customer', '41', '33', '新增导入', '0', '[客户类型:3],[上级ID:1003],[客户代码:33],[客户名称:c3],[拼音缩写:zy],[客户全称:cccc],[省份:河北],[手机:133312343434],[联系人:333],[备注信息:能力],[层级:3],[状态:0],[创建时间:2019-03-13 19:14:34],[创建人员:admin];', '2019-03-13 19:14:34');
INSERT INTO `erp_log_common` VALUES ('135', '2019-03-13 19:17:34', 'admin', 'customer', '42', '11', '新增导入', '0', '[客户类型:1],[上级ID:1001],[客户代码:11],[客户名称:a1],[拼音缩写:py],[客户全称:aaaa],[省份:江苏],[手机:133312343434],[联系人:111],[备注信息:快乐],[层级:1],[状态:0];', '2019-03-13 19:17:34');
INSERT INTO `erp_log_common` VALUES ('136', '2019-03-13 19:17:34', 'admin', 'customer', '43', '22', '新增导入', '0', '[客户类型:2],[上级ID:1002],[客户代码:22],[客户名称:b2],[拼音缩写:ay],[客户全称:bbbb],[省份:上海],[手机:133312343434],[联系人:222],[备注信息:潇洒],[层级:2],[状态:0];', '2019-03-13 19:17:34');
INSERT INTO `erp_log_common` VALUES ('137', '2019-03-13 19:17:34', 'admin', 'customer', '44', '33', '新增导入', '0', '[客户类型:3],[上级ID:1003],[客户代码:33],[客户名称:c3],[拼音缩写:zy],[客户全称:cccc],[省份:河北],[手机:133312343434],[联系人:333],[备注信息:能力],[层级:3],[状态:0];', '2019-03-13 19:17:34');
INSERT INTO `erp_log_common` VALUES ('138', '2019-03-13 19:24:38', 'admin', 'customer', '42', '11', '数据导入(覆盖)', '0', ';', '2019-03-13 19:24:38');
INSERT INTO `erp_log_common` VALUES ('139', '2019-03-13 19:24:38', 'admin', 'customer', '43', '22', '数据导入(覆盖)', '0', ';', '2019-03-13 19:24:38');
INSERT INTO `erp_log_common` VALUES ('140', '2019-03-13 19:24:38', 'admin', 'customer', '44', '33', '数据导入(覆盖)', '0', ';', '2019-03-13 19:24:38');
INSERT INTO `erp_log_common` VALUES ('141', '2019-03-13 19:24:55', 'admin', 'customer', '42', '11', '数据导入(覆盖)', '0', ';', '2019-03-13 19:24:55');
INSERT INTO `erp_log_common` VALUES ('142', '2019-03-13 19:24:55', 'admin', 'customer', '43', '22', '数据导入(覆盖)', '0', ';', '2019-03-13 19:24:55');
INSERT INTO `erp_log_common` VALUES ('143', '2019-03-13 19:24:55', 'admin', 'customer', '44', '33', '数据导入(覆盖)', '0', ';', '2019-03-13 19:24:55');
INSERT INTO `erp_log_common` VALUES ('144', '2019-03-13 19:27:22', 'admin', 'customer', '45', '11', '数据导入(新增)', '0', null, '2019-03-13 19:27:22');
INSERT INTO `erp_log_common` VALUES ('145', '2019-03-13 19:27:22', 'admin', 'customer', '46', '22', '数据导入(新增)', '0', null, '2019-03-13 19:27:22');
INSERT INTO `erp_log_common` VALUES ('146', '2019-03-13 19:27:22', 'admin', 'customer', '47', '33', '数据导入(新增)', '0', null, '2019-03-13 19:27:22');
INSERT INTO `erp_log_common` VALUES ('147', '2019-03-13 19:30:10', 'admin', 'customer', '48', '11', '数据导入(新增)', '0', '[客户类型:1],[上级:1001],[客户代码:11],[客户简称:a1],[客户全称:aaaa],[拼音缩写:py],[省份:江苏],[手机:133312343434],[联系人:111],[层级:1],[备注信息:快乐];', '2019-03-13 19:30:10');
INSERT INTO `erp_log_common` VALUES ('148', '2019-03-13 19:30:10', 'admin', 'customer', '49', '22', '数据导入(新增)', '0', '[客户类型:2],[上级:1002],[客户代码:22],[客户简称:b2],[客户全称:bbbb],[拼音缩写:ay],[省份:上海],[手机:133312343434],[联系人:222],[层级:2],[备注信息:潇洒];', '2019-03-13 19:30:10');
INSERT INTO `erp_log_common` VALUES ('149', '2019-03-13 19:30:10', 'admin', 'customer', '50', '33', '数据导入(新增)', '0', '[客户类型:3],[上级:1003],[客户代码:33],[客户简称:c3],[客户全称:cccc],[拼音缩写:zy],[省份:河北],[手机:133312343434],[联系人:333],[层级:3],[备注信息:能力];', '2019-03-13 19:30:10');
INSERT INTO `erp_log_common` VALUES ('150', '2019-03-13 19:31:24', 'admin', 'customer', '48', '11', '数据导入(覆盖)', '0', ';', '2019-03-13 19:31:24');
INSERT INTO `erp_log_common` VALUES ('151', '2019-03-13 19:31:24', 'admin', 'customer', '49', '22', '数据导入(覆盖)', '0', ';', '2019-03-13 19:31:24');
INSERT INTO `erp_log_common` VALUES ('152', '2019-03-13 19:31:24', 'admin', 'customer', '50', '33', '数据导入(覆盖)', '0', ';', '2019-03-13 19:31:24');
INSERT INTO `erp_log_common` VALUES ('153', '2019-03-13 20:17:51', 'admin', 'customer', '48', '11', '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-13 20:17:51');
INSERT INTO `erp_log_common` VALUES ('154', '2019-03-14 11:59:57', 'admin', 'system_parameter', '2', 'notice_title', '变更系统参数', '1', '[类型:panel];', '2019-03-14 11:59:57');
INSERT INTO `erp_log_common` VALUES ('155', '2019-03-14 12:00:06', 'admin', 'system_parameter', '3', 'notice_path', '变更系统参数', '1', '[类型:panel];', '2019-03-14 12:00:06');
INSERT INTO `erp_log_common` VALUES ('156', '2019-03-14 12:00:14', 'admin', 'system_parameter', '1', 'notice_open', '变更系统参数', '1', '[类型:panel];', '2019-03-14 12:00:14');
INSERT INTO `erp_log_common` VALUES ('157', null, null, null, null, null, null, '0', null, '2019-03-15 17:50:52');
INSERT INTO `erp_log_common` VALUES ('158', '2019-03-15 17:52:34', 'admin', 'trade', '16', null, '状态调整', '1', '状态[有效], 备注: ', '2019-03-15 17:52:34');
INSERT INTO `erp_log_common` VALUES ('159', '2019-03-15 17:53:40', 'admin', 'trade', '16', null, '状态调整', '0', '状态[草稿], 备注: 资料错误', '2019-03-15 17:53:40');
INSERT INTO `erp_log_common` VALUES ('160', '2019-03-15 17:54:05', 'admin', 'trade', '16', null, '状态调整', '1', '状态[有效], 备注: ', '2019-03-15 17:54:05');
INSERT INTO `erp_log_common` VALUES ('161', null, null, null, null, null, null, '0', null, '2019-03-19 19:26:44');
INSERT INTO `erp_log_common` VALUES ('162', '2019-03-19 19:34:13', 'admin', 'question', '1', '111', '变更题库', '0', '[题型:dx];', '2019-03-19 19:34:13');
INSERT INTO `erp_log_common` VALUES ('163', '2019-03-21 19:41:29', 'admin', 'question', '1', '111', '变更题库', '0', '[知识点码:知识点51];', '2019-03-21 19:41:29');
INSERT INTO `erp_log_common` VALUES ('164', '2019-03-25 11:48:38', 'admin', 'question', '2', '222', '变更题库', '0', '[知识点码:知识点41];', '2019-03-25 11:48:38');
INSERT INTO `erp_log_common` VALUES ('165', '2019-03-25 11:51:22', 'admin', 'question', '2', '222', '状态调整', '1', '状态[有效], 备注: 正常操作', '2019-03-25 11:51:22');
INSERT INTO `erp_log_common` VALUES ('166', '2019-03-25 11:51:28', 'admin', 'question', '2', '222', '状态调整', '0', '退回状态[无效], 备注: 5345345', '2019-03-25 11:51:28');
INSERT INTO `erp_log_common` VALUES ('167', '2019-03-25 16:30:06', 'admin', 'question', '2', '222', '状态调整', '0', '退回状态[无效], 备注: weqweqwe\r\n', '2019-03-25 16:30:06');
INSERT INTO `erp_log_common` VALUES ('168', '2019-03-25 17:12:05', 'admin', 'question', '6', '666', '状态调整', '0', '退回状态[无效], 备注: rwerwrew', '2019-03-25 17:12:05');
INSERT INTO `erp_log_common` VALUES ('169', '2019-03-25 17:24:47', 'admin', 'question', '3', '333', '状态调整', '0', '退回状态[无效], 备注: 6666', '2019-03-25 17:24:47');
INSERT INTO `erp_log_common` VALUES ('170', '2019-03-25 17:47:10', 'admin', 'question', '10', '000', '状态调整', '0', '退回状态[无效], 备注: 信息变化, 545', '2019-03-25 17:47:10');
INSERT INTO `erp_log_common` VALUES ('171', '2019-03-25 19:01:50', 'admin', 'question', '2', '222', '变更题库', '0', '[知识点码:知识点53];', '2019-03-25 19:01:50');
INSERT INTO `erp_log_common` VALUES ('172', null, null, null, null, null, null, '0', null, '2019-03-25 19:03:54');
INSERT INTO `erp_log_common` VALUES ('173', '2019-03-26 11:31:50', 'admin', 'question', '10', '000', '变更题库', '0', '[知识点码:51];', '2019-03-26 11:31:50');
INSERT INTO `erp_log_common` VALUES ('174', null, null, null, null, null, null, '0', null, '2019-03-27 15:41:12');

-- ----------------------------
-- Table structure for erp_log_model
-- ----------------------------
DROP TABLE IF EXISTS `erp_log_model`;
CREATE TABLE `erp_log_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '类型:1;login#2;logout#3;model',
  `model` varchar(50) DEFAULT NULL COMMENT '模块',
  `action` varchar(50) DEFAULT NULL COMMENT '动作',
  `ip_address` varchar(50) DEFAULT NULL COMMENT 'IP地址',
  `create_time` datetime DEFAULT NULL COMMENT '处理时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '处理人员',
  `lastchanged` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模块日志';

-- ----------------------------
-- Records of erp_log_model
-- ----------------------------

-- ----------------------------
-- Table structure for erp_log_order
-- ----------------------------
DROP TABLE IF EXISTS `erp_log_order`;
CREATE TABLE `erp_log_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` datetime DEFAULT NULL COMMENT '处理时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '处理人员',
  `type` varchar(30) DEFAULT NULL COMMENT '类型:sales;销售订单#stockin;仓库入库#stockout;仓库出库#stockmove;仓库移仓#stockadjust;仓库调整#stockcheck;仓库盘点',
  `order_id` int(11) DEFAULT NULL COMMENT '单据id',
  `order_no` varchar(50) DEFAULT NULL COMMENT '单据号码',
  `subject` varchar(100) DEFAULT NULL COMMENT '标题',
  `details` int(4) DEFAULT '0' COMMENT '明细条数',
  `qty` decimal(18,3) DEFAULT '0.000' COMMENT '数量',
  `amount` decimal(18,2) DEFAULT '0.00' COMMENT '金额',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `content` text COMMENT '内容',
  `lastchanged` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COMMENT='单据处理日志';

-- ----------------------------
-- Records of erp_log_order
-- ----------------------------
INSERT INTO `erp_log_order` VALUES ('71', '2001-01-01 00:00:00', '2_create_user', '3_type', '70', 'testx_70', '4_subject', '5', '6.000', '7.00', '8', '9_content', '2010-01-01 00:00:00');
INSERT INTO `erp_log_order` VALUES ('72', '2011-01-01 00:00:00', '12_create_user', '13_type', '70', 'testx_70', '14_subject', '15', '16.000', '17.00', '18', '19_content', '2020-01-01 00:00:00');
INSERT INTO `erp_log_order` VALUES ('73', '2021-01-01 00:00:00', '22_create_user', '23_type', '70', 'testx_70', '24_subject', '25', '26.000', '27.00', '28', '29_content', '2030-01-01 00:00:00');
INSERT INTO `erp_log_order` VALUES ('74', '2031-01-01 00:00:00', '32_create_user', '33_type', '70', 'testx_70', '34_subject', '35', '36.000', '37.00', '38', '39_content', '2037-01-01 00:00:00');
INSERT INTO `erp_log_order` VALUES ('75', '2041-01-01 00:00:00', '42_create_user', '43_type', '70', 'testx_70', '44_subject', '45', '46.000', '47.00', '48', '49_content', '2037-01-01 00:00:00');
INSERT INTO `erp_log_order` VALUES ('76', '2051-01-01 00:00:00', '52_create_user', '53_type', '70', 'testx_70', '54_subject', '55', '56.000', '57.00', '58', '59_content', '2037-01-01 00:00:00');
INSERT INTO `erp_log_order` VALUES ('122', '2019-03-25 19:59:15', 'admin', 'testx', '50', null, '变更测试表111', '0', '0.000', '0.00', '0', '', '2019-03-25 19:59:15');
INSERT INTO `erp_log_order` VALUES ('123', '2019-03-25 21:12:20', 'admin', 'testx', '40', null, '变更测试表111', '0', '0.000', '0.00', '0', '', '2019-03-25 21:12:20');
INSERT INTO `erp_log_order` VALUES ('124', '2019-03-25 21:40:26', 'admin', 'exam', '1', null, '明细编辑', '1', '0.000', '0.00', '0', '添加[111]', '2019-03-25 21:40:26');
INSERT INTO `erp_log_order` VALUES ('125', '2019-03-25 21:41:03', 'admin', 'exam', '1', null, '明细编辑', '2', '0.000', '0.00', '0', '添加[555], 变动[111]', '2019-03-25 21:41:03');

-- ----------------------------
-- Table structure for erp_node
-- ----------------------------
DROP TABLE IF EXISTS `erp_node`;
CREATE TABLE `erp_node` (
  `id` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '模块名称',
  `title` varchar(50) DEFAULT NULL COMMENT '模块描述',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:1;有效#0;无效',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `sort` int(11) DEFAULT '9999' COMMENT '排序',
  `pid` int(11) DEFAULT '0' COMMENT '父层',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '级别',
  `module` varchar(255) DEFAULT NULL COMMENT '模块说明',
  `model` varchar(30) DEFAULT NULL COMMENT '启动方式',
  `btn_name` varchar(50) DEFAULT NULL COMMENT '按钮名称',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '超级用户:1;是#0;否',
  `ico` varchar(50) DEFAULT NULL COMMENT '图标',
  `default_open` smallint(4) NOT NULL DEFAULT '0' COMMENT '默认是否打开',
  `side` smallint(4) NOT NULL DEFAULT '0' COMMENT '交易方',
  `menu` tinyint(4) NOT NULL DEFAULT '0' COMMENT '菜单',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模块功能';

-- ----------------------------
-- Records of erp_node
-- ----------------------------
INSERT INTO `erp_node` VALUES ('10', 'X10', '题库模板组卷', '1', null, '9999', '0', '1', null, '', null, '0', null, '1', '0', '1');
INSERT INTO `erp_node` VALUES ('1002', 'X1002', '题库信息', '1', null, '9999', '10', '2', null, '', null, '0', null, '1', '0', '1');
INSERT INTO `erp_node` VALUES ('100205', 'X100205', '题库列表', '1', null, '9999', '1002', '3', '/Summary/QuestionSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('100210', 'X100210', '知识点列表', '1', null, '9999', '1002', '3', '/Summary/QuestionCategorySummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('1003', 'X1003', '组卷信息', '1', '', '9999', '10', '2', '', '', '', '0', '', '1', '0', '1');
INSERT INTO `erp_node` VALUES ('100310', 'X100310', '组卷模板列表', '1', null, '9999', '1003', '3', '/Summary/TempletSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('100315', 'X100315', '组卷模板明细列表', '1', null, '9999', '1003', '3', '/Summary/TempletDetailSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('1004', 'X1004', '试卷信息', '1', null, '9999', '10', '2', null, null, null, '0', null, '1', '0', '1');
INSERT INTO `erp_node` VALUES ('100405', 'X100405', '试卷列表', '1', null, '9999', '1004', '3', '/Summary/ExamSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('100410', 'X100410', '试卷明细列表', '1', null, '9999', '1004', '3', '/Summary/ExamDetailSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('1005', 'X1005', '用户信息', '1', null, '9999', '10', '2', null, '', null, '0', null, '1', '0', '1');
INSERT INTO `erp_node` VALUES ('100505', 'X100505', '公司列表', '0', null, '9999', '1005', '3', '/Summary/CompanySummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('100515', 'X100515', '用户列表', '1', null, '9999', '1005', '3', '/Summary/UserSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('1025', 'X1025', '基础数据', '1', null, '9999', '10', '2', null, '', null, '0', null, '1', '0', '1');
INSERT INTO `erp_node` VALUES ('102505', 'X102505', '系统参数列表', '1', null, '9999', '1025', '3', '/Summary/SystemParameterSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('102506', 'X102506', '系统序号列表', '1', null, '9999', '1025', '3', '/Summary/SystemGenSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('102510', 'X102510', '系统分类列表', '1', null, '9999', '1025', '3', '/Summary/SubcodeSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('1030', 'X1030', '安全管理', '1', '', '9999', '10', '2', '', '', '', '0', '', '1', '0', '1');
INSERT INTO `erp_node` VALUES ('103005', 'X103005', '角色列表', '1', '', '9999', '1030', '3', '/Summary/RoleSummary/index?func=search', '', '', '1', '', '0', '0', '1');
INSERT INTO `erp_node` VALUES ('103010', 'X103010', '角色模块关系列表', '1', '', '9999', '1030', '3', '/Summary/RoleNodeSummary/index?func=search', '', '', '0', '', '0', '0', '1');
INSERT INTO `erp_node` VALUES ('103015', 'X103015', '角色用户关系列表', '1', '', '9999', '1030', '3', '/Summary/RoleUserSummary/index?func=search', '', '', '0', '', '0', '0', '1');
INSERT INTO `erp_node` VALUES ('1035', 'X1035', '运行日志', '1', null, '9999', '10', '2', null, '', null, '0', null, '1', '0', '1');
INSERT INTO `erp_node` VALUES ('103505', 'X103505', '物品申请日志列表', '0', null, '9999', '1035', '3', '/Summary/ApplyLogSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('103510', 'X103510', '凭据日志列表', '1', null, '9999', '1035', '3', '/Summary/LogOrderSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('103515', 'X103515', '公共日志列表', '1', null, '9999', '1035', '3', '/Summary/LogCommonSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('103520', 'X103520', '模块日志列表', '1', null, '9999', '1035', '3', '/Summary/LogModelSummary/index?func=search', '', null, '0', null, '0', '0', '1');
INSERT INTO `erp_node` VALUES ('99', 'X99', '功能测试', '1', '', '9999', '0', '1', '', '', '', '0', '', '1', '0', '1');
INSERT INTO `erp_node` VALUES ('9999', 'X9999', '测试菜单', '1', null, '9999', '99', '2', null, '', null, '0', null, '1', '0', '1');
INSERT INTO `erp_node` VALUES ('999901', 'X999901', '物品分类维护(参考)', '1', '', '9999', '9999', '3', '/Home/EffectsCategory/index?func=search', '', '', '0', '', '0', '0', '1');

-- ----------------------------
-- Table structure for erp_question
-- ----------------------------
DROP TABLE IF EXISTS `erp_question`;
CREATE TABLE `erp_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型:0;标准#1;套题#2;小题',
  `parent_id` int(11) DEFAULT NULL COMMENT '套题id',
  `code` varchar(50) DEFAULT NULL COMMENT '编码',
  `name` varchar(100) DEFAULT NULL COMMENT '名称',
  `category_code` varchar(50) DEFAULT NULL COMMENT '知识点码',
  `category_name` varchar(100) DEFAULT NULL COMMENT '知识点',
  `kind` varchar(50) DEFAULT NULL COMMENT '题型',
  `stem` text COMMENT '题干',
  `quiz` text COMMENT '设问',
  `answer` text COMMENT '答案',
  `childs` int(11) DEFAULT '0' COMMENT '小题数',
  `img` varchar(255) DEFAULT NULL COMMENT '图像',
  `using` int(11) DEFAULT '0' COMMENT '使用',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:0;无效#1;有效',
  `sort` int(11) DEFAULT '9999' COMMENT '排序',
  `import_time` datetime DEFAULT NULL COMMENT '导入时间',
  `import_user` varchar(30) DEFAULT NULL COMMENT '导入人员',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6) COMMENT '更改时间',
  `analysis` text COMMENT '解析',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_code` (`code`),
  KEY `idx_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='题库';

-- ----------------------------
-- Records of erp_question
-- ----------------------------
INSERT INTO `erp_question` VALUES ('1', '0', '0', '111', '矮地茶1', '知识点51', '知识点5122222', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '1', '0', '2019-03-19 19:26:43', null, '2019-03-19 19:26:43', 'admin', '2019-03-21 19:41:29', 'admin', '2019-03-26 13:11:27.625625', null);
INSERT INTO `erp_question` VALUES ('2', '0', '1', '111.1', '矮地茶12', '知识点53', '知识点5111111', 'dx', '423423423', '423434', '4234234234', '0', '/Uploads/2019-03-25/5c98b1e8a014e.jpg', '0', '0', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-25 19:01:50', 'admin', '2019-03-26 13:11:54.061466', null);
INSERT INTO `erp_question` VALUES ('3', '0', '1', '111.2', '矮地茶123', '知识点51', '知识点511111', 'dx', '423423423', '423434', '4234234234', '0', '/Uploads/2019-03-25/5c98aee097997.jpg', '0', '0', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-25 18:35:12', 'admin', '2019-03-26 13:11:56.007501', null);
INSERT INTO `erp_question` VALUES ('4', '0', '1', '111.3', '矮地茶1234', '知识点51', '知识点5122222', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '0', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-21 19:41:29', 'admin', '2019-03-26 13:11:57.985614', null);
INSERT INTO `erp_question` VALUES ('5', '0', '0', '555', '矮地茶1', '知识点51', '知识点5122222', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '1', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-21 19:41:29', 'admin', '2019-03-26 13:11:31.614481', null);
INSERT INTO `erp_question` VALUES ('6', '0', '0', '666', '矮地茶12', '知识点41', '知识点5111111', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '0', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-25 17:17:56', 'admin', '2019-03-26 13:11:31.960829', null);
INSERT INTO `erp_question` VALUES ('7', '0', '0', '777', '矮地茶123', '知识点51', '知识点511111', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '1', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-21 19:41:29', 'admin', '2019-03-26 13:11:32.248368', null);
INSERT INTO `erp_question` VALUES ('8', '0', '0', '888', '矮地茶1234', '知识点51', '知识点5122222', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '0', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-21 19:41:29', 'admin', '2019-03-26 13:11:32.585242', null);
INSERT INTO `erp_question` VALUES ('9', '0', '0', '999', '矮地茶1', '知识点51', '知识点5122222', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '1', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-21 19:41:29', 'admin', '2019-03-26 13:11:32.926573', null);
INSERT INTO `erp_question` VALUES ('10', '0', '0', '000', '矮地茶12', '51', '知识点51', 'dx', '423423423', '423434', '4234234234', '0', '/Uploads/2019-03-26/5c999e4babc54.jpg', '0', '0', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-26 11:41:57', 'admin', '2019-03-26 13:11:33.239990', null);
INSERT INTO `erp_question` VALUES ('11', '0', '0', 'aaa', '矮地茶123', '知识点51', '知识点511111', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '1', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-21 19:41:29', 'admin', '2019-03-26 13:11:33.547045', null);
INSERT INTO `erp_question` VALUES ('12', '0', '0', 'bbb', '矮地茶1234', '知识点51', '知识点5122222', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '0', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-21 19:41:29', 'admin', '2019-03-26 13:11:33.851061', null);
INSERT INTO `erp_question` VALUES ('13', '0', '0', 'ccc', '矮地茶1', '知识点51', '知识点5122222', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '1', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-21 19:41:29', 'admin', '2019-03-26 13:11:34.152095', null);
INSERT INTO `erp_question` VALUES ('14', '0', '0', 'ddd', '矮地茶12', '知识点41', '知识点5111111', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '1', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-25 11:51:28', 'admin', '2019-03-26 13:11:34.451601', null);
INSERT INTO `erp_question` VALUES ('15', '0', '0', 'eee', '矮地茶123', '知识点51', '知识点511111', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '1', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-21 19:41:29', 'admin', '2019-03-26 13:11:34.755174', null);
INSERT INTO `erp_question` VALUES ('16', '0', '0', 'fff', '矮地茶1234', '知识点51', '知识点5122222', 'dx', '423423423', '423434', '4234234234', '0', null, '0', '0', '0', '2019-03-19 19:26:43', '', '2019-03-19 19:26:43', 'admin', '2019-03-21 19:41:29', 'admin', '2019-03-26 13:11:35.064836', null);
INSERT INTO `erp_question` VALUES ('17', '0', '0', '4444', '55555555', '知识点51', null, 'tk', '', '', '', '0', null, '0', '0', '0', null, null, '2019-03-25 19:03:54', 'admin', '2019-03-25 19:03:54', 'admin', '2019-03-26 13:11:36.132860', null);

-- ----------------------------
-- Table structure for erp_question_category
-- ----------------------------
DROP TABLE IF EXISTS `erp_question_category`;
CREATE TABLE `erp_question_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL COMMENT '上级id',
  `code` varchar(50) DEFAULT NULL COMMENT '代码',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `full_path` varchar(100) DEFAULT NULL COMMENT '路径',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '层级',
  `approval_require` tinyint(4) NOT NULL DEFAULT '0' COMMENT '审批要求:0;无#1;互审#2;一级#3;二级',
  `alarm_days` int(11) DEFAULT '0' COMMENT '提前报警(天)',
  `onlyone` tinyint(4) NOT NULL DEFAULT '0' COMMENT '单一题目:0;否#1;是',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:0;无效#1;有效',
  `sort` int(11) DEFAULT '9999' COMMENT '排序',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6) COMMENT '更改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_code` (`code`),
  KEY `idx_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='题目分类';

-- ----------------------------
-- Records of erp_question_category
-- ----------------------------
INSERT INTO `erp_question_category` VALUES ('1', '0', '1', '知识点1', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('2', '0', '2', '知识点2', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('3', '0', '3', '知识点3', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('4', '0', '4', '知识点4', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('5', '0', '5', '知识点5', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('6', '1', '11', '知识点11', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('7', '1', '12', '知识点12', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('8', '1', '13', '知识点13', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('9', '2', '21', '知识点21', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('10', '2', '22', '知识点22', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('11', '2', '23', '知识点23', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('12', '2', '24', '知识点24', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('13', '4', '41', '知识点41', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('14', '4', '42', '知识点42', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('15', '5', '51', '知识点51', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('16', '5', '52', '知识点52', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');
INSERT INTO `erp_question_category` VALUES ('17', '5', '53', '知识点53', null, '0', '0', '0', '0', '1', '0', null, null, null, null, '2019-03-21 13:17:37.681023');

-- ----------------------------
-- Table structure for erp_role
-- ----------------------------
DROP TABLE IF EXISTS `erp_role`;
CREATE TABLE `erp_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:1;有效#0;无效',
  `name` varchar(20) DEFAULT NULL COMMENT '角色',
  `pid` int(11) DEFAULT '0' COMMENT '父层',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `approval` tinyint(4) NOT NULL DEFAULT '0' COMMENT '审批级别:0;无#1;一级#2;二级#3;特权',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色';

-- ----------------------------
-- Records of erp_role
-- ----------------------------

-- ----------------------------
-- Table structure for erp_role_node
-- ----------------------------
DROP TABLE IF EXISTS `erp_role_node`;
CREATE TABLE `erp_role_node` (
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `node_id` int(11) NOT NULL COMMENT '模块id',
  `node_name` varchar(50) DEFAULT NULL COMMENT '模块名称',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '层级',
  `module` varchar(50) DEFAULT NULL COMMENT '模块说明',
  PRIMARY KEY (`role_id`,`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色模块关系';

-- ----------------------------
-- Records of erp_role_node
-- ----------------------------

-- ----------------------------
-- Table structure for erp_role_user
-- ----------------------------
DROP TABLE IF EXISTS `erp_role_user`;
CREATE TABLE `erp_role_user` (
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色用户关系';

-- ----------------------------
-- Records of erp_role_user
-- ----------------------------

-- ----------------------------
-- Table structure for erp_subcode
-- ----------------------------
DROP TABLE IF EXISTS `erp_subcode`;
CREATE TABLE `erp_subcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL COMMENT '分类',
  `parent_id` int(11) DEFAULT NULL COMMENT '父层ID',
  `code` varchar(50) NOT NULL COMMENT '代码',
  `name` varchar(100) DEFAULT NULL COMMENT '名称',
  `value` varchar(200) DEFAULT NULL COMMENT '参数',
  `sort` int(11) DEFAULT '9999' COMMENT '排序',
  `is_system` tinyint(4) NOT NULL DEFAULT '0' COMMENT '系统定义:1;是#0;否',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:1;有效#0;无效',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_unique` (`type`,`code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='分类数据';

-- ----------------------------
-- Records of erp_subcode
-- ----------------------------
INSERT INTO `erp_subcode` VALUES ('1', 'question:kind', null, 'xz', '选择题', '', '999999', '0', '1', '2019-03-19 19:20:50', '', '2019-03-19 19:20:50', '', '2019-03-19 19:20:50');
INSERT INTO `erp_subcode` VALUES ('2', 'question:kind', null, 'tk', '填空题', '', '999999', '0', '1', '2019-03-19 19:20:50', '', '2019-03-19 19:20:50', '', '2019-03-19 19:21:56');
INSERT INTO `erp_subcode` VALUES ('3', 'question:kind', null, 'dx', '多选题', '', '999999', '0', '1', '2019-03-19 19:20:50', '', '2019-03-19 19:20:50', '', '2019-03-19 19:21:55');
INSERT INTO `erp_subcode` VALUES ('4', 'question:kind', null, 'yd', '阅读题', '', '999999', '0', '1', '2019-03-19 19:20:50', '', '2019-03-19 19:20:50', '', '2019-03-19 19:21:55');
INSERT INTO `erp_subcode` VALUES ('5', 'question:kind', null, 'zw', '作文题', '', '999999', '0', '1', '2019-03-19 19:20:50', '', '2019-03-19 19:20:50', '', '2019-03-19 19:21:55');

-- ----------------------------
-- Table structure for erp_system_gen
-- ----------------------------
DROP TABLE IF EXISTS `erp_system_gen`;
CREATE TABLE `erp_system_gen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL COMMENT '类型',
  `mainkey` varchar(50) DEFAULT NULL COMMENT '主键',
  `subkey` varchar(50) DEFAULT NULL COMMENT '子键',
  `seqno` int(11) DEFAULT '0' COMMENT '最后序号',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `lastchanged` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6) COMMENT '更改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_type_mainkey_subkey` (`type`,`mainkey`,`subkey`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='创建序号';

-- ----------------------------
-- Records of erp_system_gen
-- ----------------------------
INSERT INTO `erp_system_gen` VALUES ('1', 'contract_no', 'ZDHX', '2019', '11', null, '2019-03-15 17:52:12', '2019-03-15 17:52:12.898722');
INSERT INTO `erp_system_gen` VALUES ('2', 'contract_no', 'AT', '2019', '39', null, '2019-03-17 22:14:39', '2019-03-17 22:14:39.743985');
INSERT INTO `erp_system_gen` VALUES ('3', 'contract_no', 'AP', '2019', '11', null, '2019-03-15 17:52:12', '2019-03-15 17:52:12.903894');
INSERT INTO `erp_system_gen` VALUES ('4', 'contract_no', 'BB', '2019', '11', null, '2019-03-15 17:52:12', '2019-03-15 17:52:12.906449');
INSERT INTO `erp_system_gen` VALUES ('5', 'contract_no', 'ZJKS', '2019', '2', '2019-03-11 15:06:22', '2019-03-11 15:09:26', '2019-03-11 15:09:26.719180');
INSERT INTO `erp_system_gen` VALUES ('6', 'contract_no', 'YZYX', '2019', '2', '2019-03-11 15:06:22', '2019-03-11 15:09:26', '2019-03-11 15:09:26.722202');

-- ----------------------------
-- Table structure for erp_system_parameter
-- ----------------------------
DROP TABLE IF EXISTS `erp_system_parameter`;
CREATE TABLE `erp_system_parameter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL COMMENT '类型:trade;贸易#panel;平台',
  `code` varchar(50) NOT NULL COMMENT '代码',
  `name` varchar(100) DEFAULT NULL COMMENT '名称',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:1;有效#0;无效',
  `value` varchar(255) DEFAULT NULL COMMENT '数据',
  `allow_edit` tinyint(4) NOT NULL DEFAULT '0' COMMENT '允许编辑:1;允许#0;禁止',
  `sort` int(11) DEFAULT '9999' COMMENT '排序',
  `remarks` varchar(255) DEFAULT NULL COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of erp_system_parameter
-- ----------------------------
INSERT INTO `erp_system_parameter` VALUES ('1', 'panel', 'notice_open', '公告是否开启', '1', '1', '1', '999999', '1-开启/0-关闭');
INSERT INTO `erp_system_parameter` VALUES ('2', 'panel', 'notice_title', '公告滚动提示信息', '1', '2018年11月公告', '1', '999999', '左侧菜单下滚动文字信息');
INSERT INTO `erp_system_parameter` VALUES ('3', 'panel', 'notice_path', '公告文件名称', '1', '201811.html', '1', '999999', '上传到upload/notice下的公告静态页面');
INSERT INTO `erp_system_parameter` VALUES ('4', 'trade', 'dayprice_lastimportdate', '导入价格最近日期', '1', '2019/03/10', '1', '999999', null);

-- ----------------------------
-- Table structure for erp_templet
-- ----------------------------
DROP TABLE IF EXISTS `erp_templet`;
CREATE TABLE `erp_templet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `templet_no` varchar(50) DEFAULT NULL COMMENT '编码',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型:0;练习#1;期中#2;期末',
  `subject` varchar(150) DEFAULT NULL COMMENT '标题',
  `details` int(11) DEFAULT '0' COMMENT '明细数',
  `count` int(11) DEFAULT '0' COMMENT '题量',
  `score` int(11) DEFAULT '0' COMMENT '总分',
  `req_time` int(11) DEFAULT '0' COMMENT '时间要求(分钟)',
  `req_content` text COMMENT '卷面要求',
  `remarks` text COMMENT '备注',
  `using` int(11) DEFAULT '0' COMMENT '使用',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:0;草稿#1;确认#7;取消',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6) COMMENT '更改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_templet_no` (`templet_no`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='组卷模板';

-- ----------------------------
-- Records of erp_templet
-- ----------------------------
INSERT INTO `erp_templet` VALUES ('1', '15529975188519362', '0', '1111111', '0', '30', '150', '120', '1.111111\r\n2.222222\r\n3.333333', '11111111111111', '0', '0', '2019-03-19 20:11:58', 'admin', '2019-03-19 21:02:49', 'admin', '2019-03-19 21:02:49.148730');

-- ----------------------------
-- Table structure for erp_templet_detail
-- ----------------------------
DROP TABLE IF EXISTS `erp_templet_detail`;
CREATE TABLE `erp_templet_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `templet_id` int(11) DEFAULT NULL COMMENT '模板id',
  `templet_no` varchar(50) DEFAULT NULL COMMENT '模板编码',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型:0;标题#1;题目',
  `subject` text COMMENT '标题',
  `seq` int(11) DEFAULT '0' COMMENT '题号',
  `score` int(11) DEFAULT '0' COMMENT '分数',
  `req_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '要求类型:0;标准#1;套题',
  `req_category_code` varchar(50) DEFAULT NULL COMMENT '知识点码',
  `req_category_name` varchar(100) DEFAULT NULL COMMENT '要求知识点',
  `req_kind` varchar(50) DEFAULT NULL COMMENT '要求题型',
  `req_child_count` tinyint(4) NOT NULL DEFAULT '0' COMMENT '套题小题数',
  `req_child_seq` tinyint(4) NOT NULL DEFAULT '0' COMMENT '套题小题号:0;不分配#1;分配题号',
  `extract` tinyint(4) NOT NULL DEFAULT '0' COMMENT '抽取要求:0;无要求#1;重未使用#2;使用少优先',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6) COMMENT '更改时间',
  PRIMARY KEY (`id`),
  KEY `idx_templetno` (`templet_no`),
  KEY `idx_templetid` (`templet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='组卷模板明细';

-- ----------------------------
-- Records of erp_templet_detail
-- ----------------------------

-- ----------------------------
-- Table structure for erp_user
-- ----------------------------
DROP TABLE IF EXISTS `erp_user`;
CREATE TABLE `erp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态:1;有效#0;无效',
  `department_id` int(11) DEFAULT NULL COMMENT '部门id',
  `code` varchar(50) DEFAULT NULL COMMENT '用户名',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `sex` tinyint(4) NOT NULL DEFAULT '0' COMMENT '性别:0;女#1;男#2;保密',
  `passwordsource` varchar(50) DEFAULT NULL COMMENT '密码',
  `password` varchar(50) DEFAULT NULL COMMENT '登入密码',
  `mobilephone` varchar(50) DEFAULT NULL COMMENT '手机号码',
  `superadmin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否超级管理员:1;是#0;否',
  `errpwd_count` int(11) DEFAULT '0' COMMENT '密码错误次数',
  `remarks` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(30) DEFAULT NULL COMMENT '创建人员',
  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
  `modify_user` varchar(30) DEFAULT NULL COMMENT '修改人员',
  `lastchanged` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更改时间',
  `company_id` int(11) DEFAULT NULL COMMENT '公司id',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '员工级别',
  `header_ico` varchar(100) DEFAULT NULL COMMENT '头像',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型:0;管理#1;业务',
  `sort` int(11) DEFAULT '9999' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户';

-- ----------------------------
-- Records of erp_user
-- ----------------------------
INSERT INTO `erp_user` VALUES ('1', '1', '1', 'admin', '超级管理员', '0', null, '96e79218965eb72c92a549dd5a330112', '', '1', '0', null, null, null, null, null, '2019-03-25 13:10:52', '1', '2', null, '0', '999999');
INSERT INTO `erp_user` VALUES ('2', '1', '1', '0001', '一级主管', '0', '', 'e10adc3949ba59abbe56e057f20f883e', '', '1', '0', '', '2019-01-21 15:56:55', '', '2019-01-21 15:56:58', '', '2018-12-25 20:54:59', '1', '1', '', '0', '999999');
INSERT INTO `erp_user` VALUES ('3', '1', '1', '0002', '普通职员', '0', '', 'e10adc3949ba59abbe56e057f20f883e', '', '1', '0', '', '2019-01-21 15:56:55', '', '2019-01-21 15:56:58', '', '2018-12-25 20:54:59', '1', '0', '', '0', '999999');
INSERT INTO `erp_user` VALUES ('4', '1', '1', '0003', '二级主管', '0', '', 'e10adc3949ba59abbe56e057f20f883e', '', '1', '0', '', '2019-01-21 15:56:55', '', '2019-01-21 15:56:58', '', '2018-12-25 20:54:59', '1', '0', '', '0', '999999');

-- ----------------------------
-- Table structure for erp_user_summary_column
-- ----------------------------
DROP TABLE IF EXISTS `erp_user_summary_column`;
CREATE TABLE `erp_user_summary_column` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(30) DEFAULT NULL COMMENT '用户代码',
  `summary` varchar(50) DEFAULT NULL COMMENT '列表名称',
  `column` varchar(200) DEFAULT NULL COMMENT '数据列',
  `show` tinyint(4) DEFAULT '0' COMMENT '显示:0;隐藏#1;显示',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户列表显示设置';

-- ----------------------------
-- Records of erp_user_summary_column
-- ----------------------------

-- ----------------------------
-- Table structure for erp_user_tree
-- ----------------------------
DROP TABLE IF EXISTS `erp_user_tree`;
CREATE TABLE `erp_user_tree` (
  `company_id` int(11) NOT NULL COMMENT '公司id',
  `department_id` int(11) NOT NULL COMMENT '部门id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY (`company_id`,`department_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户树';

-- ----------------------------
-- Records of erp_user_tree
-- ----------------------------

-- ----------------------------
-- Procedure structure for del_idx
-- ----------------------------
DROP PROCEDURE IF EXISTS `del_idx`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `del_idx`(IN p_tablename varchar(200), IN p_idxname VARCHAR(200))
begin 
DECLARE str VARCHAR(250); 
  set @str=concat(' drop index ',p_idxname,' on ',p_tablename); 
  select count(*) into @cnt from information_schema.statistics where table_name=p_tablename and index_name=p_idxname ; 
  if @cnt >0 then 
    PREPARE stmt FROM @str; 
    EXECUTE stmt ; 
  end if; 
end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for gen_number
-- ----------------------------
DROP PROCEDURE IF EXISTS `gen_number`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gen_number`(IN p_type varchar(50), IN p_main varchar(50), IN p_sub VARCHAR(50), OUT o_num INT(11))
begin 
    DECLARE num INT(11) DEFAULT null;
    DECLARE t_error INTEGER DEFAULT 0;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET t_error=1;-- 异常时设置为1
    START TRANSACTION;
		select seqno into num from erp_system_gen where type=p_type and mainkey=p_main and subkey=p_sub; 
    IF (num is null)  THEN
		   SET num=0;
			 insert into erp_system_gen (type,mainkey,subkey,seqno,create_time,modify_time) values (p_type, p_main, p_sub,1,now(),now());
    else
			 update erp_system_gen set seqno=seqno+1,modify_time=NOW() where type=p_type and mainkey=p_main and subkey=p_sub and seqno=num; 
		end if; 
		IF t_error = 1 THEN
		    set o_num=-1;
        ROLLBACK;
    ELSE 
			 SET o_num=num+1;
       COMMIT;
		END IF;
--    select o_num;
end
;;
DELIMITER ;
