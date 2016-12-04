/*
Navicat MySQL Data Transfer

Source Server         : xiaochu
Source Server Version : 50515
Source Host           : localhost:3306
Source Database       : xiaochu

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-08-01 15:05:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `c_dayreward`
-- ----------------------------
DROP TABLE IF EXISTS `c_dayreward`;
CREATE TABLE `c_dayreward` (
  `id` int(11) NOT NULL DEFAULT '0',
  `gold` int(11) NOT NULL,
  `gems` int(11) NOT NULL,
  `powers` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_dayreward
-- ----------------------------
INSERT INTO `c_dayreward` VALUES ('1', '1000', '0', '');
INSERT INTO `c_dayreward` VALUES ('2', '0', '3', '');
INSERT INTO `c_dayreward` VALUES ('3', '1200', '0', '');
INSERT INTO `c_dayreward` VALUES ('4', '0', '0', '2011-1');
INSERT INTO `c_dayreward` VALUES ('5', '1400', '0', '');
INSERT INTO `c_dayreward` VALUES ('6', '0', '3', '');
INSERT INTO `c_dayreward` VALUES ('7', '1600', '0', '');
INSERT INTO `c_dayreward` VALUES ('8', '0', '0', '2012-1');
INSERT INTO `c_dayreward` VALUES ('9', '1800', '0', '');
INSERT INTO `c_dayreward` VALUES ('10', '0', '0', '2013-1');
INSERT INTO `c_dayreward` VALUES ('11', '2000', '0', '');
INSERT INTO `c_dayreward` VALUES ('12', '0', '3', '');
INSERT INTO `c_dayreward` VALUES ('13', '2200', '0', '');
INSERT INTO `c_dayreward` VALUES ('14', '0', '0', '2014-1');
INSERT INTO `c_dayreward` VALUES ('15', '2400', '0', '');
INSERT INTO `c_dayreward` VALUES ('16', '0', '3', '');
INSERT INTO `c_dayreward` VALUES ('17', '2600', '0', '');
INSERT INTO `c_dayreward` VALUES ('18', '0', '0', '2015-1');
INSERT INTO `c_dayreward` VALUES ('19', '2800', '0', '');
INSERT INTO `c_dayreward` VALUES ('20', '0', '0', '2016-1');
INSERT INTO `c_dayreward` VALUES ('21', '3000', '0', '');
INSERT INTO `c_dayreward` VALUES ('22', '0', '3', '');
INSERT INTO `c_dayreward` VALUES ('23', '3200', '0', '');
INSERT INTO `c_dayreward` VALUES ('24', '0', '0', '2017-1');
INSERT INTO `c_dayreward` VALUES ('25', '3400', '0', '');
INSERT INTO `c_dayreward` VALUES ('26', '0', '3', '');
INSERT INTO `c_dayreward` VALUES ('27', '3600', '0', '');
INSERT INTO `c_dayreward` VALUES ('28', '0', '0', '2014-1');
INSERT INTO `c_dayreward` VALUES ('29', '3800', '0', '');
INSERT INTO `c_dayreward` VALUES ('30', '0', '0', '2011-1');

-- ----------------------------
-- Table structure for `c_dresses`
-- ----------------------------
DROP TABLE IF EXISTS `c_dresses`;
CREATE TABLE `c_dresses` (
  `id` int(11) NOT NULL,
  `descs` varchar(255) NOT NULL,
  `star` int(11) NOT NULL,
  `titile` varchar(255) NOT NULL,
  `gems` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_dresses
-- ----------------------------
INSERT INTO `c_dresses` VALUES ('1', 'Looking prim and proper, like any young lady in the Victorian era should', '0', 'Classic Dress', '0');
INSERT INTO `c_dresses` VALUES ('2', 'Strait-laced school uniform that unfortunately has no place in Wonderland~', '25', 'School Uniform', '0');
INSERT INTO `c_dresses` VALUES ('3', 'Never be late again as you dash off in this dress, which comes with a waistcoat-watch!', '0', 'White Rabbit Dress', '10');
INSERT INTO `c_dresses` VALUES ('4', 'Happy unbirthday to you!  Grab a cup of tea and celebrate in this vibrant dress', '175', 'Mad Tea Party Dress', '0');
INSERT INTO `c_dresses` VALUES ('5', 'We\'re all mad here, especially for this fun and lovely purple feline dress', '280', 'Cheshire Dress', '0');

-- ----------------------------
-- Table structure for `c_props`
-- ----------------------------
DROP TABLE IF EXISTS `c_props`;
CREATE TABLE `c_props` (
  `id` int(11) NOT NULL DEFAULT '0',
  `addscoreBl` int(11) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `ename` varchar(255) DEFAULT NULL COMMENT '金币',
  `gold` int(11) DEFAULT NULL,
  `unlock` int(11) DEFAULT NULL COMMENT '解锁',
  `gems` int(11) DEFAULT NULL COMMENT '钻石',
  `score` int(11) DEFAULT NULL,
  `step` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_props
-- ----------------------------
INSERT INTO `c_props` VALUES ('2001', '0', 'gold', 'Gold', '0', '0', '0', '300', '0');
INSERT INTO `c_props` VALUES ('2002', '0', 'Start level with a Starter Cake', '关卡前炸弹', '4000', '12', '0', '800', '0');
INSERT INTO `c_props` VALUES ('2003', '0', 'Take out 3x3 area anywhere', 'Unbirthday Cake', '0', '0', '0', '800', '0');
INSERT INTO `c_props` VALUES ('2004', '0', 'Collect all pieces in row', 'Flying Hat', '0', '0', '0', '900', '0');
INSERT INTO `c_props` VALUES ('2005', '0', 'Collect all pieces in column', 'Flying Hat', '0', '0', '0', '900', '0');
INSERT INTO `c_props` VALUES ('2006', '0', 'Collect a row & column anywhere', 'Double Flying Hat', '0', '0', '0', '1500', '0');
INSERT INTO `c_props` VALUES ('2007', '0', 'Start level with a Double Flying Hat', '关卡前双勺', '4000', '17', '0', '1500', '0');
INSERT INTO `c_props` VALUES ('2008', '0', 'Get 3 extra moves', '加3步道具', '3000', '4', '0', '0', '3');
INSERT INTO `c_props` VALUES ('2009', '10', 'Get 10 percent extra points', '加10%分数', '2000', '11', '0', '0', '0');
INSERT INTO `c_props` VALUES ('2011', '0', '增加5移动步数', '加5步', '0', '6', '50', '0', '5');
INSERT INTO `c_props` VALUES ('2012', '0', '重新排列棋盘上所有甜品', '刷新棋盘', '0', '22', '30', '0', '0');
INSERT INTO `c_props` VALUES ('2013', '0', '收集棋盘上同一种甜品', '大礼盒', '0', '26', '70', '0', '0');
INSERT INTO `c_props` VALUES ('2014', '0', '收集冰糖和冰块', '小太阳', '0', '34', '40', '0', '0');
INSERT INTO `c_props` VALUES ('2015', '0', '强制交换两个相邻的甜品', '强制交换', '0', '38', '20', '0', '0');
INSERT INTO `c_props` VALUES ('2016', '0', '收集棋盘上的任何东西', '甜品夹子', '0', '8', '20', '0', '0');
INSERT INTO `c_props` VALUES ('2017', '0', '收集一行和一列甜品', '双勺', '0', '19', '40', '1500', '0');
INSERT INTO `c_props` VALUES ('2018', '0', '收集3x3的甜品', '甜品炸弹', '0', '14', '40', '800', '0');

-- ----------------------------
-- Table structure for `c_shop`
-- ----------------------------
DROP TABLE IF EXISTS `c_shop`;
CREATE TABLE `c_shop` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `desc` varchar(255) NOT NULL,
  `coin` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `price` varchar(255) DEFAULT NULL COMMENT '价格(人民币)',
  `extra` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商店表';

-- ----------------------------
-- Records of c_shop
-- ----------------------------
INSERT INTO `c_shop` VALUES ('1', '钻石x50', '一小袋钻石', '0', '50', 'goods1.png', '50', '100%');
INSERT INTO `c_shop` VALUES ('2', '钻石x100', '一大袋钻石', '0', '100', 'goods2.png', '95', '95%');
INSERT INTO `c_shop` VALUES ('3', '钻石x500', '一箱钻石', '0', '500', 'goods3.png', '450', '90%');
INSERT INTO `c_shop` VALUES ('4', '钻石x1200', '一大箱钻石', '0', '1200', 'goods4.png', '1000', '83%');

-- ----------------------------
-- Table structure for `c_tasks_main`
-- ----------------------------
DROP TABLE IF EXISTS `c_tasks_main`;
CREATE TABLE `c_tasks_main` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL COMMENT '关卡数',
  `itemid` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `gold` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_tasks_main
-- ----------------------------
INSERT INTO `c_tasks_main` VALUES ('1', '通过第10关', '通过第10关', '10', '2011', '1', '200');
INSERT INTO `c_tasks_main` VALUES ('2', '通过第20关', '通过第20关', '20', '2016', '1', '500');
INSERT INTO `c_tasks_main` VALUES ('3', '通过第30关', '通过第30关', '30', '2016', '1', '600');
INSERT INTO `c_tasks_main` VALUES ('4', '通过第40关', '通过第40关', '40', '2012', '1', '800');
INSERT INTO `c_tasks_main` VALUES ('5', '通过第50关', '通过第50关', '50', '2012', '1', '1000');
INSERT INTO `c_tasks_main` VALUES ('6', '通过第60关', '通过第60关', '60', '2011', '1', '1100');
INSERT INTO `c_tasks_main` VALUES ('7', '通过第70关', '通过第70关', '70', '2011', '1', '1200');
INSERT INTO `c_tasks_main` VALUES ('8', '通过第80关', '通过第80关', '80', '2015', '1', '1300');

-- ----------------------------
-- Table structure for `c_tasks_star`
-- ----------------------------
DROP TABLE IF EXISTS `c_tasks_star`;
CREATE TABLE `c_tasks_star` (
  `id` int(11) NOT NULL DEFAULT '0',
  `gems` int(11) DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_tasks_star
-- ----------------------------
INSERT INTO `c_tasks_star` VALUES ('1', '2', '15');
INSERT INTO `c_tasks_star` VALUES ('2', '3', '40');
INSERT INTO `c_tasks_star` VALUES ('3', '5', '55');
INSERT INTO `c_tasks_star` VALUES ('4', '5', '110');
INSERT INTO `c_tasks_star` VALUES ('5', '5', '130');
INSERT INTO `c_tasks_star` VALUES ('6', '5', '200');
INSERT INTO `c_tasks_star` VALUES ('7', '5', '225');
INSERT INTO `c_tasks_star` VALUES ('8', '5', '250');

-- ----------------------------
-- Table structure for `d_user_levelinfo`
-- ----------------------------
DROP TABLE IF EXISTS `d_user_levelinfo`;
CREATE TABLE `d_user_levelinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) NOT NULL DEFAULT '' COMMENT '用户关卡数据表',
  `level` int(11) DEFAULT NULL,
  `sc` int(11) DEFAULT NULL,
  `st` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `suoyin1` (`uid`) USING BTREE,
  KEY `suoyin2` (`level`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1163 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of d_user_levelinfo
-- ----------------------------
INSERT INTO `d_user_levelinfo` VALUES ('22', '2010', '1', '4100', '2');
INSERT INTO `d_user_levelinfo` VALUES ('79', '2005', '1', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('80', '2005', '2', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('81', '2005', '3', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('82', '2005', '4', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('83', '2005', '5', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('84', '2005', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('85', '2005', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('86', '2005', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('87', '2005', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('88', '2005', '10', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('89', '2005', '11', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('90', '2005', '12', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('91', '2005', '13', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('92', '2005', '14', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('93', '2005', '15', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('94', '2005', '16', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('95', '2005', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('96', '2005', '18', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('97', '2005', '19', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('98', '2005', '20', '64450', '3');
INSERT INTO `d_user_levelinfo` VALUES ('99', '2005', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('100', '2005', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('101', '2005', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('102', '2005', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('114', '2011', '1', '7800', '3');
INSERT INTO `d_user_levelinfo` VALUES ('115', '2017', '1', '11050', '3');
INSERT INTO `d_user_levelinfo` VALUES ('116', '2017', '2', '14300', '3');
INSERT INTO `d_user_levelinfo` VALUES ('117', '2019', '1', '5200', '2');
INSERT INTO `d_user_levelinfo` VALUES ('119', '2020', '1', '7400', '3');
INSERT INTO `d_user_levelinfo` VALUES ('121', '2018', '1', '8450', '3');
INSERT INTO `d_user_levelinfo` VALUES ('157', '2012', '1', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('158', '2012', '2', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('159', '2012', '3', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('160', '2012', '4', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('161', '2012', '5', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('162', '2012', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('163', '2012', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('164', '2012', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('165', '2012', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('166', '2013', '1', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('167', '2013', '2', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('168', '2013', '3', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('169', '2013', '4', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('170', '2013', '5', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('171', '2013', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('172', '2013', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('173', '2013', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('174', '2013', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('175', '2016', '1', '12750', '3');
INSERT INTO `d_user_levelinfo` VALUES ('176', '2016', '2', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('177', '2016', '3', '22000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('178', '2016', '4', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('179', '2016', '5', '11050', '2');
INSERT INTO `d_user_levelinfo` VALUES ('180', '2016', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('181', '2016', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('182', '2016', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('183', '2016', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('184', '2016', '10', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('185', '2016', '11', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('186', '2016', '12', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('187', '2016', '13', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('188', '2016', '14', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('189', '2016', '15', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('190', '2016', '16', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('191', '2016', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('192', '2016', '18', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('193', '2016', '19', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('194', '2016', '20', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('195', '2016', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('196', '2016', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('197', '2016', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('198', '2016', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('199', '2016', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('200', '2016', '26', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('201', '2016', '27', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('202', '2016', '28', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('203', '2016', '29', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('250', '2007', '1', '5050', '2');
INSERT INTO `d_user_levelinfo` VALUES ('251', '2007', '2', '11800', '3');
INSERT INTO `d_user_levelinfo` VALUES ('252', '2007', '3', '9700', '3');
INSERT INTO `d_user_levelinfo` VALUES ('253', '2007', '4', '12050', '3');
INSERT INTO `d_user_levelinfo` VALUES ('254', '2007', '5', '12800', '3');
INSERT INTO `d_user_levelinfo` VALUES ('255', '2007', '6', '19650', '3');
INSERT INTO `d_user_levelinfo` VALUES ('256', '2007', '7', '17900', '2');
INSERT INTO `d_user_levelinfo` VALUES ('257', '2007', '8', '24100', '3');
INSERT INTO `d_user_levelinfo` VALUES ('258', '2007', '9', '25450', '3');
INSERT INTO `d_user_levelinfo` VALUES ('259', '2007', '10', '20550', '3');
INSERT INTO `d_user_levelinfo` VALUES ('260', '2007', '11', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('261', '2007', '12', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('262', '2007', '13', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('263', '2007', '14', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('264', '2007', '15', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('265', '2007', '16', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('266', '2007', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('267', '2007', '18', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('268', '2007', '19', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('269', '2007', '20', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('270', '2007', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('271', '2007', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('272', '2007', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('273', '2007', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('274', '2007', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('275', '2007', '26', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('276', '2007', '27', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('277', '2007', '28', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('278', '2007', '29', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('279', '2007', '30', '20250', '2');
INSERT INTO `d_user_levelinfo` VALUES ('304', '2007', '31', '12050', '2');
INSERT INTO `d_user_levelinfo` VALUES ('305', '2009', '1', '7950', '3');
INSERT INTO `d_user_levelinfo` VALUES ('306', '2010', '2', '8500', '3');
INSERT INTO `d_user_levelinfo` VALUES ('307', '2010', '3', '10100', '3');
INSERT INTO `d_user_levelinfo` VALUES ('308', '2010', '4', '11200', '3');
INSERT INTO `d_user_levelinfo` VALUES ('309', '2010', '5', '10400', '2');
INSERT INTO `d_user_levelinfo` VALUES ('310', '2010', '6', '16600', '3');
INSERT INTO `d_user_levelinfo` VALUES ('311', '2010', '7', '22050', '3');
INSERT INTO `d_user_levelinfo` VALUES ('312', '2014', '1', '10150', '3');
INSERT INTO `d_user_levelinfo` VALUES ('313', '2014', '2', '15500', '3');
INSERT INTO `d_user_levelinfo` VALUES ('314', '2014', '3', '10200', '3');
INSERT INTO `d_user_levelinfo` VALUES ('315', '2014', '4', '10700', '3');
INSERT INTO `d_user_levelinfo` VALUES ('316', '2014', '5', '17450', '3');
INSERT INTO `d_user_levelinfo` VALUES ('317', '2014', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('318', '2014', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('319', '2014', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('320', '2014', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('321', '2014', '10', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('322', '2014', '11', '16050', '2');
INSERT INTO `d_user_levelinfo` VALUES ('323', '2014', '12', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('324', '2014', '13', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('325', '2014', '14', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('326', '2014', '15', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('327', '2014', '16', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('328', '2014', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('329', '2014', '18', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('330', '2014', '19', '16500', '1');
INSERT INTO `d_user_levelinfo` VALUES ('331', '2014', '20', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('332', '2014', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('333', '2014', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('334', '2014', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('335', '2014', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('336', '2014', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('337', '2014', '26', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('338', '2014', '27', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('413', '2021', '1', '7450', '3');
INSERT INTO `d_user_levelinfo` VALUES ('454', '2008', '1', '6300', '3');
INSERT INTO `d_user_levelinfo` VALUES ('455', '2008', '2', '11500', '3');
INSERT INTO `d_user_levelinfo` VALUES ('456', '2008', '3', '7800', '2');
INSERT INTO `d_user_levelinfo` VALUES ('458', '2005', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('472', '2007', '32', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('473', '2007', '33', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('474', '2007', '34', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('475', '2007', '35', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('476', '2008', '4', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('477', '2008', '5', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('478', '2008', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('479', '2008', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('480', '2008', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('481', '2008', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('482', '2008', '10', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('483', '2008', '11', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('484', '2008', '12', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('485', '2008', '13', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('486', '2008', '14', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('487', '2008', '15', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('488', '2008', '16', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('489', '2008', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('490', '2008', '18', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('491', '2008', '19', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('492', '2008', '20', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('493', '2008', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('494', '2008', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('495', '2008', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('496', '2008', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('497', '2008', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('498', '2009', '2', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('499', '2009', '3', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('500', '2009', '4', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('501', '2009', '5', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('502', '2009', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('503', '2009', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('504', '2009', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('505', '2009', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('506', '2009', '10', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('507', '2009', '11', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('508', '2009', '12', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('509', '2009', '13', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('510', '2009', '14', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('511', '2009', '15', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('512', '2009', '16', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('513', '2009', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('514', '2009', '18', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('515', '2009', '19', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('516', '2009', '20', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('517', '2009', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('518', '2009', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('519', '2009', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('520', '2009', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('521', '2009', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('522', '2010', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('523', '2010', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('524', '2010', '10', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('525', '2010', '11', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('526', '2010', '12', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('527', '2010', '13', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('528', '2010', '14', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('529', '2010', '15', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('530', '2010', '16', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('531', '2010', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('532', '2010', '18', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('533', '2010', '19', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('534', '2010', '20', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('535', '2010', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('536', '2010', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('537', '2010', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('538', '2010', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('539', '2010', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('540', '2010', '26', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('541', '2010', '27', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('542', '2010', '28', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('543', '2010', '29', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('544', '2010', '30', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('545', '2010', '31', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('546', '2010', '32', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('547', '2010', '33', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('548', '2010', '34', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('549', '2010', '35', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('550', '2010', '36', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('551', '2010', '37', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('552', '2014', '28', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('553', '2014', '29', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('554', '2014', '30', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('555', '2014', '31', '9200', '1');
INSERT INTO `d_user_levelinfo` VALUES ('556', '2014', '32', '19700', '2');
INSERT INTO `d_user_levelinfo` VALUES ('557', '2014', '33', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('558', '2014', '34', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('559', '2014', '35', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('560', '2009', '26', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('561', '2009', '27', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('562', '2009', '28', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('563', '2009', '29', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('564', '2009', '30', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('565', '2009', '31', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('566', '2009', '32', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('567', '2009', '33', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('568', '2009', '34', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('569', '2009', '35', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('570', '2009', '36', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('571', '2009', '37', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('572', '2009', '38', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('574', '2005', '26', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('575', '2005', '27', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('576', '2005', '28', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('577', '2005', '29', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('578', '2005', '30', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('579', '2005', '31', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('580', '2005', '32', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('581', '2005', '33', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('582', '2005', '34', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('583', '2017', '3', '21750', '3');
INSERT INTO `d_user_levelinfo` VALUES ('584', '2024', '1', '4950', '2');
INSERT INTO `d_user_levelinfo` VALUES ('585', '2024', '2', '17700', '3');
INSERT INTO `d_user_levelinfo` VALUES ('586', '2024', '3', '12600', '3');
INSERT INTO `d_user_levelinfo` VALUES ('587', '2024', '4', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('588', '2024', '5', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('589', '2024', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('590', '2024', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('591', '2024', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('592', '2024', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('593', '2024', '10', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('594', '2023', '1', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('595', '2023', '2', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('596', '2023', '3', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('597', '2023', '4', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('598', '2023', '5', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('599', '2023', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('600', '2023', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('601', '2023', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('602', '2023', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('603', '2023', '10', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('604', '2023', '11', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('605', '2023', '12', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('606', '2023', '13', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('607', '2023', '14', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('608', '2023', '15', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('609', '2023', '16', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('610', '2023', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('611', '2023', '18', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('612', '2023', '19', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('613', '2023', '20', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('614', '2023', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('615', '2023', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('616', '2023', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('617', '2023', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('618', '2023', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('619', '2023', '26', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('620', '2023', '27', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('621', '2023', '28', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('622', '2023', '29', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('623', '2023', '30', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('624', '2023', '31', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('625', '2023', '32', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('626', '2023', '33', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('627', '2023', '34', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('628', '2023', '35', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('629', '2023', '36', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('630', '2023', '37', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('631', '2023', '38', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('632', '2023', '39', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('633', '2023', '40', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('634', '2023', '41', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('635', '2023', '42', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('636', '2023', '43', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('637', '2023', '44', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('638', '2023', '45', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('639', '2023', '46', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('640', '2023', '47', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('641', '2023', '48', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('642', '2023', '49', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('643', '2023', '50', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('644', '2023', '51', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('645', '2023', '52', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('646', '2023', '53', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('647', '2023', '54', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('648', '2023', '55', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('649', '2023', '56', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('650', '2023', '57', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('651', '2023', '58', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('652', '2023', '59', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('653', '2023', '60', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('654', '2023', '61', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('655', '2023', '62', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('656', '2023', '63', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('657', '2023', '64', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('658', '2023', '65', '18900', '2');
INSERT INTO `d_user_levelinfo` VALUES ('695', '2017', '4', '25600', '3');
INSERT INTO `d_user_levelinfo` VALUES ('696', '2017', '5', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('697', '2017', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('698', '2017', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('699', '2017', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('700', '2017', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('701', '2017', '10', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('702', '2017', '11', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('703', '2017', '12', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('704', '2017', '13', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('705', '2017', '14', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('706', '2017', '15', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('707', '2017', '16', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('708', '2017', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('709', '2017', '18', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('710', '2017', '19', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('711', '2017', '20', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('712', '2017', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('713', '2017', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('714', '2017', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('715', '2017', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('716', '2017', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('717', '2017', '26', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('718', '2017', '27', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('719', '2017', '28', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('720', '2017', '29', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('756', '2017', '30', '14400', '1');
INSERT INTO `d_user_levelinfo` VALUES ('757', '2017', '31', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('758', '2017', '32', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('759', '2017', '33', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('760', '2017', '34', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('761', '2017', '35', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('762', '2017', '36', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('763', '2017', '37', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('764', '2017', '38', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('765', '2017', '39', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('766', '2017', '40', '13550', '1');
INSERT INTO `d_user_levelinfo` VALUES ('767', '2014', '36', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('768', '2014', '37', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('769', '2014', '38', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('770', '2014', '39', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('774', '2014', '40', '70200', '3');
INSERT INTO `d_user_levelinfo` VALUES ('775', '2014', '41', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('776', '2014', '42', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('777', '2014', '43', '19500', '2');
INSERT INTO `d_user_levelinfo` VALUES ('778', '2014', '44', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('779', '2014', '45', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('780', '2014', '46', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('781', '2014', '47', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('782', '2014', '48', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('783', '2014', '49', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('784', '2014', '50', '69600', '3');
INSERT INTO `d_user_levelinfo` VALUES ('785', '2017', '41', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('786', '2017', '42', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('787', '2017', '43', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('788', '2017', '44', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('789', '2017', '45', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('790', '2017', '46', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('791', '2017', '47', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('792', '2017', '48', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('793', '2017', '49', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('796', '2014', '51', '50700', '3');
INSERT INTO `d_user_levelinfo` VALUES ('797', '2014', '52', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('798', '2014', '53', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('799', '2014', '54', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('800', '2014', '55', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('801', '2014', '56', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('802', '2014', '57', '40100', '3');
INSERT INTO `d_user_levelinfo` VALUES ('803', '2014', '58', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('804', '2014', '59', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('824', '2025', '1', '6450', '3');
INSERT INTO `d_user_levelinfo` VALUES ('825', '2026', '1', '11100', '3');
INSERT INTO `d_user_levelinfo` VALUES ('826', '2025', '2', '18350', '3');
INSERT INTO `d_user_levelinfo` VALUES ('827', '2025', '3', '13800', '3');
INSERT INTO `d_user_levelinfo` VALUES ('828', '2025', '4', '14300', '3');
INSERT INTO `d_user_levelinfo` VALUES ('829', '2006', '1', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('831', '2016', '30', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('832', '2016', '31', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('834', '2015', '1', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('835', '2015', '2', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('836', '2015', '3', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('837', '2015', '4', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('838', '2015', '5', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('839', '2015', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('840', '2015', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('841', '2015', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('842', '2015', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('843', '2015', '10', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('844', '2015', '11', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('845', '2015', '12', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('846', '2015', '13', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('847', '2015', '14', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('848', '2015', '15', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('849', '2015', '16', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('850', '2015', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('851', '2015', '18', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('852', '2015', '19', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('853', '2015', '20', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('854', '2015', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('855', '2015', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('856', '2015', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('857', '2015', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('858', '2015', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('859', '2015', '26', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('860', '2015', '27', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('861', '2015', '28', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('862', '2015', '29', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('863', '2014', '60', '21100', '2');
INSERT INTO `d_user_levelinfo` VALUES ('864', '2014', '61', '14900', '1');
INSERT INTO `d_user_levelinfo` VALUES ('865', '2017', '50', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('866', '2017', '51', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('867', '2017', '52', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('868', '2017', '53', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('869', '2017', '54', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('870', '2017', '55', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('871', '2017', '56', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('872', '2017', '57', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('873', '2017', '58', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('874', '2017', '59', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('875', '2017', '60', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('876', '2017', '61', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('877', '2017', '62', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('878', '2017', '63', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('879', '2017', '64', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('880', '2017', '65', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('881', '2017', '66', '20950', '2');
INSERT INTO `d_user_levelinfo` VALUES ('882', '2017', '67', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('883', '2017', '68', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('884', '2017', '69', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('886', '2014', '62', '22450', '2');
INSERT INTO `d_user_levelinfo` VALUES ('887', '2014', '63', '18250', '2');
INSERT INTO `d_user_levelinfo` VALUES ('888', '2014', '64', '24400', '2');
INSERT INTO `d_user_levelinfo` VALUES ('889', '2014', '65', '39160', '3');
INSERT INTO `d_user_levelinfo` VALUES ('890', '2014', '66', '14300', '1');
INSERT INTO `d_user_levelinfo` VALUES ('891', '2014', '67', '25700', '2');
INSERT INTO `d_user_levelinfo` VALUES ('892', '2014', '68', '40350', '3');
INSERT INTO `d_user_levelinfo` VALUES ('893', '2014', '69', '28700', '2');
INSERT INTO `d_user_levelinfo` VALUES ('894', '2015', '30', '20050', '2');
INSERT INTO `d_user_levelinfo` VALUES ('895', '2018', '2', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('896', '2018', '3', '18900', '3');
INSERT INTO `d_user_levelinfo` VALUES ('897', '2018', '4', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('898', '2018', '5', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('899', '2018', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('900', '2018', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('901', '2018', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('902', '2018', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('903', '2018', '10', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('904', '2018', '11', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('905', '2018', '12', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('906', '2018', '13', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('907', '2018', '14', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('908', '2018', '15', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('909', '2018', '16', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('910', '2018', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('911', '2018', '18', '42800', '3');
INSERT INTO `d_user_levelinfo` VALUES ('912', '2018', '19', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('913', '2018', '20', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('914', '2018', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('915', '2018', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('916', '2018', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('917', '2018', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('918', '2018', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('919', '2018', '26', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('920', '2018', '27', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('921', '2018', '28', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('922', '2018', '29', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('923', '2018', '30', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('924', '2018', '31', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('925', '2018', '32', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('926', '2018', '33', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('927', '2018', '34', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('928', '2019', '2', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('929', '2019', '3', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('930', '2019', '4', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('931', '2019', '5', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('932', '2019', '6', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('933', '2019', '7', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('934', '2019', '8', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('935', '2019', '9', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('936', '2019', '10', '39150', '3');
INSERT INTO `d_user_levelinfo` VALUES ('937', '2019', '11', '22000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('938', '2019', '12', '36800', '3');
INSERT INTO `d_user_levelinfo` VALUES ('939', '2019', '13', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('940', '2019', '14', '49650', '3');
INSERT INTO `d_user_levelinfo` VALUES ('941', '2019', '15', '35100', '3');
INSERT INTO `d_user_levelinfo` VALUES ('942', '2019', '16', '16950', '2');
INSERT INTO `d_user_levelinfo` VALUES ('943', '2019', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('944', '2019', '18', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('945', '2019', '19', '46750', '3');
INSERT INTO `d_user_levelinfo` VALUES ('946', '2019', '20', '23850', '2');
INSERT INTO `d_user_levelinfo` VALUES ('947', '2019', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('948', '2019', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('949', '2019', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('950', '2019', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('951', '2019', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('952', '2019', '26', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('953', '2019', '27', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('954', '2019', '28', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('955', '2019', '29', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('956', '2019', '30', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('957', '2019', '31', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('958', '2019', '32', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('959', '2019', '33', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('960', '2019', '34', '39050', '3');
INSERT INTO `d_user_levelinfo` VALUES ('961', '2019', '35', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('962', '2019', '36', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('963', '2019', '37', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('964', '2019', '38', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('965', '2019', '39', '20000', '2');
INSERT INTO `d_user_levelinfo` VALUES ('966', '2019', '40', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('967', '2019', '41', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('968', '2019', '42', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('969', '2019', '43', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('970', '2019', '44', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('971', '2019', '45', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('972', '2019', '46', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('973', '2019', '47', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('974', '2019', '48', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('975', '2019', '49', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('976', '2019', '50', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('977', '2019', '51', '45550', '3');
INSERT INTO `d_user_levelinfo` VALUES ('978', '2019', '52', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('979', '2019', '53', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('980', '2019', '54', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('981', '2019', '55', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('982', '2019', '56', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('983', '2019', '57', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('984', '2019', '58', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('985', '2019', '59', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('986', '2019', '60', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('987', '2019', '61', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('988', '2019', '62', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('989', '2019', '63', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('990', '2019', '64', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('991', '2019', '65', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('992', '2019', '66', '20350', '2');
INSERT INTO `d_user_levelinfo` VALUES ('993', '2019', '67', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('994', '2019', '68', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('995', '2019', '69', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('996', '2016', '32', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('997', '2016', '33', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('998', '2016', '34', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('999', '2016', '35', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1000', '2016', '36', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1001', '2016', '37', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1002', '2016', '38', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1003', '2016', '39', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1004', '2016', '40', '16000', '2');
INSERT INTO `d_user_levelinfo` VALUES ('1005', '2015', '31', '17800', '2');
INSERT INTO `d_user_levelinfo` VALUES ('1006', '2015', '32', '14350', '2');
INSERT INTO `d_user_levelinfo` VALUES ('1007', '2016', '41', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1008', '2016', '42', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1009', '2016', '43', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1010', '2016', '44', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1011', '2016', '45', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1012', '2016', '46', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1013', '2016', '47', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1014', '2016', '48', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1015', '2016', '49', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1056', '2022', '1', '10850', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1097', '2016', '50', '53000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1101', '2021', '2', '19250', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1103', '2020', '2', '11250', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1104', '2022', '2', '15600', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1109', '2022', '3', '20400', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1110', '0000000000000000000000001A2EFFFC', '1', '6900', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1111', '2022', '4', '18200', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1112', '2022', '5', '23750', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1113', '2022', '6', '26250', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1114', '2022', '7', '29500', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1115', '2022', '8', '23100', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1116', '2022', '9', '32150', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1117', '0000000000000000000000001A2EFFFC', '2', '16200', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1118', '0000000000000000000000001A2EFFFC', '3', '19950', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1119', '0000000000000000000000001A2EFFFC', '4', '21800', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1120', '0000000000000000000000001A2EFFFC', '5', '17550', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1121', '0000000000000000000000001A2EFFFC', '6', '33300', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1122', '0000000000000000000000001A2EFFFC', '7', '30700', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1123', '0000000000000000000000001A2EFFFC', '8', '22900', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1124', '0000000000000000000000001A2EFFFC', '9', '15850', '2');
INSERT INTO `d_user_levelinfo` VALUES ('1125', '0000000000000000000000001A2EFFFC', '10', '24150', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1126', '0000000000000000000000001A2EFFFC', '11', '18040', '2');
INSERT INTO `d_user_levelinfo` VALUES ('1127', '0000000000000000000000001A2EFFFC', '12', '33100', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1128', '0000000000000000000000001A2EFFFC', '13', '15200', '2');
INSERT INTO `d_user_levelinfo` VALUES ('1129', '0000000000000000000000001A2EFFFC', '14', '26400', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1130', '2018', '35', '53800', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1131', '2018', '36', '21250', '2');
INSERT INTO `d_user_levelinfo` VALUES ('1132', '2018', '37', '27500', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1133', '2018', '38', '13800', '1');
INSERT INTO `d_user_levelinfo` VALUES ('1134', '2018', '39', '37150', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1135', '2018', '40', '22000', '2');
INSERT INTO `d_user_levelinfo` VALUES ('1136', '2018', '41', '18550', '1');
INSERT INTO `d_user_levelinfo` VALUES ('1137', '2018', '42', '24750', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1138', '2541D0905A9B6CF713474E84051F6D9F', '1', '7950', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1139', '2541D0905A9B6CF713474E84051F6D9F', '2', '6600', '2');
INSERT INTO `d_user_levelinfo` VALUES ('1140', '2541D0905A9B6CF713474E84051F6D9F', '3', '18850', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1141', '2541D0905A9B6CF713474E84051F6D9F', '4', '12400', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1142', '1471CCA71C53D2332E1772A32437E2CB', '1', '10350', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1143', '0000000000000000000000001A2EFFFC', '15', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1144', '0000000000000000000000001A2EFFFC', '16', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1145', '0000000000000000000000001A2EFFFC', '17', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1146', '0000000000000000000000001A2EFFFC', '18', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1147', '0000000000000000000000001A2EFFFC', '19', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1148', '0000000000000000000000001A2EFFFC', '20', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1149', '0000000000000000000000001A2EFFFC', '21', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1150', '0000000000000000000000001A2EFFFC', '22', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1151', '0000000000000000000000001A2EFFFC', '23', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1152', '0000000000000000000000001A2EFFFC', '24', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1153', '0000000000000000000000001A2EFFFC', '25', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1154', '0000000000000000000000001A2EFFFC', '26', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1155', '0000000000000000000000001A2EFFFC', '27', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1156', '0000000000000000000000001A2EFFFC', '28', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1157', '0000000000000000000000001A2EFFFC', '29', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1158', '0000000000000000000000001A2EFFFC', '30', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1159', '0000000000000000000000001A2EFFFC', '31', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1160', '0000000000000000000000001A2EFFFC', '32', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1161', '0000000000000000000000001A2EFFFC', '33', '2000', '3');
INSERT INTO `d_user_levelinfo` VALUES ('1162', '0000000000000000000000001A2EFFFC', '34', '2000', '3');

-- ----------------------------
-- Table structure for `d_user_mailbox`
-- ----------------------------
DROP TABLE IF EXISTS `d_user_mailbox`;
CREATE TABLE `d_user_mailbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to` varchar(255) NOT NULL DEFAULT '',
  `from` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `t` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `num` int(11) DEFAULT '0' COMMENT '数量',
  PRIMARY KEY (`id`),
  KEY `suoyin1` (`to`)
) ENGINE=InnoDB AUTO_INCREMENT=389 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of d_user_mailbox
-- ----------------------------
INSERT INTO `d_user_mailbox` VALUES ('364', '2014', '2017', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1469929598', 'gold', '500');
INSERT INTO `d_user_mailbox` VALUES ('365', '2016', '2017', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1469929644', 'gold', '500');
INSERT INTO `d_user_mailbox` VALUES ('366', '2016', '2017', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1469929644', 'life', '1');
INSERT INTO `d_user_mailbox` VALUES ('369', '2014', '2017', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1469929660', 'life', '1');
INSERT INTO `d_user_mailbox` VALUES ('370', '2022', '2017', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1469929662', 'life', '1');
INSERT INTO `d_user_mailbox` VALUES ('374', '2017', '2018', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1469929696', 'gold', '500');
INSERT INTO `d_user_mailbox` VALUES ('375', '2017', '2018', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1469929697', 'life', '1');
INSERT INTO `d_user_mailbox` VALUES ('377', '2016', '2018', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1469930004', 'life', '1');
INSERT INTO `d_user_mailbox` VALUES ('379', '2017', '2019', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1469930062', 'life', '1');
INSERT INTO `d_user_mailbox` VALUES ('380', '2014', '2019', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1469930064', 'gold', '500');
INSERT INTO `d_user_mailbox` VALUES ('381', '2017', '2019', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1469937528', 'gold', '500');
INSERT INTO `d_user_mailbox` VALUES ('382', '2014', '2019', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1470013137', 'gold', '500');
INSERT INTO `d_user_mailbox` VALUES ('383', '2014', '2019', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1470013138', 'life', '1');
INSERT INTO `d_user_mailbox` VALUES ('384', '2017', '2019', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1470013141', 'gold', '500');
INSERT INTO `d_user_mailbox` VALUES ('385', '2017', '2019', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1470013142', 'life', '1');
INSERT INTO `d_user_mailbox` VALUES ('386', '2019', '2018', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1470014710', 'life', '1');
INSERT INTO `d_user_mailbox` VALUES ('387', '2017', '2020', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1470015536', 'life', '1');
INSERT INTO `d_user_mailbox` VALUES ('388', '2017', '2021', 'hifuture', 'http://thirdapp0.qlogo.cn/qzopenapp/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6/50', '1470015673', 'life', '1');

-- ----------------------------
-- Table structure for `d_user_other`
-- ----------------------------
DROP TABLE IF EXISTS `d_user_other`;
CREATE TABLE `d_user_other` (
  `uid` varchar(255) NOT NULL DEFAULT '',
  `alldresses` varchar(255) DEFAULT NULL,
  `bag` varchar(255) DEFAULT NULL COMMENT '玩家背包数据',
  `block` text,
  `bnum` int(11) DEFAULT NULL,
  `curdress` int(11) DEFAULT NULL,
  `drs` int(11) DEFAULT NULL,
  `yellowdaypresent` int(11) DEFAULT '0' COMMENT '黄钻每日礼包是否领取',
  `yellownewpresent` int(11) DEFAULT '0' COMMENT '黄钻新手礼包是否领取的标志',
  `firstpackage` int(11) DEFAULT NULL COMMENT '是否购买了首冲',
  `notify` varchar(255) DEFAULT NULL COMMENT '新任务和新裙子提醒',
  `pl` int(11) DEFAULT NULL,
  `baoxiang` text,
  `sendlife` text COMMENT '已经送好友的命',
  `invite` varchar(255) DEFAULT NULL COMMENT '已经完成的任务',
  `totalstar` int(11) DEFAULT NULL COMMENT '总星星',
  `btask` varchar(255) DEFAULT '0' COMMENT '当前主线任务id',
  `bstarTask` varchar(255) DEFAULT '0' COMMENT '当前星星任务id',
  `dianInfo` varchar(11) DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='玩家背包数据';

-- ----------------------------
-- Records of d_user_other
-- ----------------------------
INSERT INTO `d_user_other` VALUES ('0000000000000000000000001A2EFFFC', '', '2011|2', '', '4', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '', '', '0|0', '99', '2|1', '2|1', '3|11|2400|1');
INSERT INTO `d_user_other` VALUES ('1471CCA71C53D2332E1772A32437E2CB', '', '', '', '0', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '', '2016|life,2016|gold', '', '3', '1|0', '1|0', '1|5|660|0');
INSERT INTO `d_user_other` VALUES ('2014', '', '2011|0,2016|0,2017|0,2012|0,2014|29,2013|1', '', '7', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '4|2|6|1,5|2|6|1,6|2|5|1,7|2|2|1000', '2017|life,2019|life,2019|gold,2017|gold', '0|0', '191', '7|0', '6|0', '2|8|1200|1');
INSERT INTO `d_user_other` VALUES ('2015', '', '2016|3,2011|2', '', '4', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '3|2|4|1', '', '', '93', '4|0', '4|0', '3|11|2400|1');
INSERT INTO `d_user_other` VALUES ('2016', '', '2012|2,2016|1,2011|2,2017|1', '', '6', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '3|2|7|1,4|2|4|1,5|2|4|1', '1471CCA71C53D2332E1772A32437E2CB|life,1471CCA71C53D2332E1772A32437E2CB|gold,1471CCA71C53D2332E1772A32437E2CB|askblock,1471CCA71C53D2332E1772A32437E2CB|asklife', '4|18', '149', '3|1', '2|1', '3|10|2400|1');
INSERT INTO `d_user_other` VALUES ('2017', '', '2014|2,2011|3,2012|2,2013|2', '-1|1.jpg|noname,-1|1.jpg|noname,2014|1.jpg|name2014', '7', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '7|2|9|1,6|2|7|1,5|2|5|1', '2014|gold,2016|gold,2016|life,2019|life,2018|life,2014|life,2022|life,2020|life,2021|life,2018|gold', '0|0', '202', '2|1', '1|1', '2|8|1200|0');
INSERT INTO `d_user_other` VALUES ('2018', '', '2011|1,2016|2,2012|1,2013|1', '', '5', '0', '0', '1', '1', '0', 'dress|0,task|0', '0', '3|2|2|200,4|2|4|1', '2019|life', '0|0', '120', '3|1', '3|1', '3|11|2400|1');
INSERT INTO `d_user_other` VALUES ('2019', '', '2011|1,2016|2,2012|2,2018|0', '', '7', '0', '0', '1', '1', '0', 'dress|0,task|0', '0', '4|2|7|1,7|2|10|1,6|2|5|1', '2014|gold,2014|life,2017|gold,2017|life', '0|0', '203', '4|1', '3|1', '2|7|1200|0');
INSERT INTO `d_user_other` VALUES ('2020', '', '2011|1', '', '1', '0', '0', '1', '1', '0', 'dress|0,task|0', '0', '', '2017|life', '0|0', '6', '2|0', '1|0', '3|11|2400|1');
INSERT INTO `d_user_other` VALUES ('2021', '', '2015|2,2011|1,2016|1', '', '1', '0', '0', '1', '1', '0', 'dress|0,task|0', '0', '4|2|11|1,3|2|11|1', '2017|life', '0|0', '6', '3|0', '3|0', '2|8|1200|0');
INSERT INTO `d_user_other` VALUES ('2022', '', '2011|1', '', '1', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '', '', '0|0', '27', '1|0', '1|1', '2|8|1200|1');
INSERT INTO `d_user_other` VALUES ('2023', '', '', '', '0', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '', '', '', '0', '1|0', '1|0', '1|5|660|1');
INSERT INTO `d_user_other` VALUES ('2024', '', '', '', '0', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '', '', '', '0', '1|0', '1|0', '1|5|660|0');
INSERT INTO `d_user_other` VALUES ('2025', '', '2018|1,2017|2', '', '0', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '', '2018|life,2017|life', '3|11', '0', '1|0', '1|0', '1|5|660|0');
INSERT INTO `d_user_other` VALUES ('2026', '', '', '', '0', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '', '', '', '0', '1|0', '1|0', '1|5|660|0');
INSERT INTO `d_user_other` VALUES ('2027', '', '', '', '0', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '', '', '0|0', '0', '1|0', '1|0', '1|0|200|1');
INSERT INTO `d_user_other` VALUES ('2028', '', '', '', '0', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '', '', '0|0', '0', '1|0', '1|0', '1|5|660|0');
INSERT INTO `d_user_other` VALUES ('2029', '', '2011|1,2015|1', '', '0', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '', '', '3|31', '0', '1|0', '1|0', '1|5|660|0');
INSERT INTO `d_user_other` VALUES ('2030', '', '2018|1,2014|1,2015|1', '', '0', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '', '', '3|21', '0', '1|0', '1|0', '1|5|660|0');
INSERT INTO `d_user_other` VALUES ('2541D0905A9B6CF713474E84051F6D9F', '', '2013|1,2011|2', '', '0', '0', '0', '0', '0', '0', 'dress|0,task|0', '0', '', '', '0|0', '11', '1|0', '1|0', '1|5|660|0');

-- ----------------------------
-- Table structure for `u_losecause`
-- ----------------------------
DROP TABLE IF EXISTS `u_losecause`;
CREATE TABLE `u_losecause` (
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '关卡id',
  `total` int(11) DEFAULT '0' COMMENT '玩的总次数',
  `lose` int(11) DEFAULT NULL COMMENT '失败次数',
  `loseType` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关卡失败率统计';

-- ----------------------------
-- Records of u_losecause
-- ----------------------------
INSERT INTO `u_losecause` VALUES ('1', '39', '8', '1|8');
INSERT INTO `u_losecause` VALUES ('2', '30', '11', '1|11');
INSERT INTO `u_losecause` VALUES ('3', '25', '7', '2|7');
INSERT INTO `u_losecause` VALUES ('4', '18', '9', '1|9');
INSERT INTO `u_losecause` VALUES ('5', '14', '7', '2|7');
INSERT INTO `u_losecause` VALUES ('6', '6', '1', '3|1');
INSERT INTO `u_losecause` VALUES ('7', '5', '0', '');
INSERT INTO `u_losecause` VALUES ('8', '6', '3', '4|3');
INSERT INTO `u_losecause` VALUES ('9', '3', '0', '');
INSERT INTO `u_losecause` VALUES ('10', '5', '2', '1|1,2|1,5|2');
INSERT INTO `u_losecause` VALUES ('11', '7', '4', '3|4,4|4,5|4');
INSERT INTO `u_losecause` VALUES ('12', '6', '4', '1|4,2|4,4|3');
INSERT INTO `u_losecause` VALUES ('13', '3', '2', '5|2,1|1,2|1');
INSERT INTO `u_losecause` VALUES ('14', '3', '1', '3|1,4|1,5|1');
INSERT INTO `u_losecause` VALUES ('15', '2', '1', '2|1,3|1');
INSERT INTO `u_losecause` VALUES ('16', '1', '0', '');
INSERT INTO `u_losecause` VALUES ('17', '3', '3', '2|3,3|2,4|3');
INSERT INTO `u_losecause` VALUES ('18', '3', '2', '1|2,3|2,5|1');
INSERT INTO `u_losecause` VALUES ('19', '13', '10', '4|10,2|9');
INSERT INTO `u_losecause` VALUES ('20', '3', '1', '1|1,3|1');
INSERT INTO `u_losecause` VALUES ('21', '1', '1', '5|1');
INSERT INTO `u_losecause` VALUES ('22', '3', '3', '1|3,2|3,5|2');
INSERT INTO `u_losecause` VALUES ('23', '2', '2', '2|2,3|1,5|1');
INSERT INTO `u_losecause` VALUES ('24', '2', '2', '1|2,3|2,4|2');
INSERT INTO `u_losecause` VALUES ('25', '1', '1', '1|1,3|1,5|1');
INSERT INTO `u_losecause` VALUES ('26', '5', '5', '2|5,3|5,4|5');
INSERT INTO `u_losecause` VALUES ('29', '5', '5', '2|5,5|5,1|4');
INSERT INTO `u_losecause` VALUES ('30', '7', '3', '1|3,4|3,3|2');
INSERT INTO `u_losecause` VALUES ('31', '10', '5', '2|5,11|2,3|5,21|2');
INSERT INTO `u_losecause` VALUES ('32', '16', '14', '4|14,5|13');
INSERT INTO `u_losecause` VALUES ('33', '5', '4', '1|4,2|4,11|3');
INSERT INTO `u_losecause` VALUES ('34', '4', '2', '1|2,5|2');
INSERT INTO `u_losecause` VALUES ('35', '4', '3', '2|3,11|1,3|3,21|2');
INSERT INTO `u_losecause` VALUES ('36', '3', '2', '1|2,11|1,4|2,21|1');
INSERT INTO `u_losecause` VALUES ('37', '2', '1', '2|1,5|1');
INSERT INTO `u_losecause` VALUES ('38', '2', '1', '1|1,2|1');
INSERT INTO `u_losecause` VALUES ('39', '6', '4', '2|4,11|3,4|4,21|1');
INSERT INTO `u_losecause` VALUES ('40', '26', '15', '11|4,4|15,3|14,21|7');
INSERT INTO `u_losecause` VALUES ('41', '6', '5', '1|5,2|5,11|5');
INSERT INTO `u_losecause` VALUES ('42', '9', '7', '2|7,3|7,12|6');
INSERT INTO `u_losecause` VALUES ('43', '15', '13', '4|13,5|13,22|11');
INSERT INTO `u_losecause` VALUES ('46', '2', '2', '1|2,2|2,12|2');
INSERT INTO `u_losecause` VALUES ('47', '1', '1', '1|1,2|1,12|1');
INSERT INTO `u_losecause` VALUES ('49', '2', '2', '2|2,12|2,5|2');
INSERT INTO `u_losecause` VALUES ('50', '11', '6', '2|5,3|3,12|1,22|3');
INSERT INTO `u_losecause` VALUES ('51', '9', '6', '1|6,3|6,4|6');
INSERT INTO `u_losecause` VALUES ('52', '3', '2', '3|2,12|2,4|2');
INSERT INTO `u_losecause` VALUES ('53', '4', '3', '1|3,12|3,5|3');
INSERT INTO `u_losecause` VALUES ('54', '3', '3', '3|3,12|3,4|3');
INSERT INTO `u_losecause` VALUES ('57', '2', '0', '');
INSERT INTO `u_losecause` VALUES ('58', '1', '1', '1|1,3|1,12|1');
INSERT INTO `u_losecause` VALUES ('59', '8', '7', '2|7,4|7,5|7');
INSERT INTO `u_losecause` VALUES ('60', '9', '4', '1|4,3|4,12|3');
INSERT INTO `u_losecause` VALUES ('61', '5', '2', '2|2,4|2,5|2');
INSERT INTO `u_losecause` VALUES ('62', '19', '17', '1|17,2|17,3|17');
INSERT INTO `u_losecause` VALUES ('63', '24', '21', '1|20,4|18,5|20');
INSERT INTO `u_losecause` VALUES ('64', '7', '5', '2|4,3|3,22|3');
INSERT INTO `u_losecause` VALUES ('65', '8', '4', '1|4,4|4,5|4');
INSERT INTO `u_losecause` VALUES ('66', '21', '16', '1|16,2|15,3|15');
INSERT INTO `u_losecause` VALUES ('67', '3', '2', '4|2,5|1,21|1');
INSERT INTO `u_losecause` VALUES ('68', '4', '3', '4|1,5|1,21|2');
INSERT INTO `u_losecause` VALUES ('69', '5', '3', '1|3,2|2,3|2');
INSERT INTO `u_losecause` VALUES ('70', '17', '15', '1|15,4|15,22|15');

-- ----------------------------
-- Table structure for `u_pay`
-- ----------------------------
DROP TABLE IF EXISTS `u_pay`;
CREATE TABLE `u_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '交易流水号',
  `openid` varchar(255) DEFAULT NULL,
  `appid` varchar(255) DEFAULT NULL,
  `ts` varchar(255) DEFAULT NULL COMMENT '时间戳',
  `payitem` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `billno` varchar(255) DEFAULT NULL COMMENT '交易流水号',
  `version` varchar(255) DEFAULT NULL,
  `zoneid` varchar(255) DEFAULT NULL,
  `providetype` varchar(255) DEFAULT NULL COMMENT '发货类型0表示道具购买，1表示营销活动中的道具赠送，2表示交叉营销任务集市中的奖励发放。',
  `amt` varchar(255) DEFAULT NULL COMMENT 'Q点/Q币消耗金额或财付通游戏子账户的扣款金额',
  `payamt_coins` varchar(255) DEFAULT NULL COMMENT '扣取的游戏币总数',
  `pubacct_payamt_coins` varchar(255) DEFAULT NULL COMMENT '扣取的抵用券总金额，单位为Q点',
  `sig` varchar(255) DEFAULT NULL COMMENT '请求串的签名',
  `addgems` int(11) DEFAULT '0' COMMENT '实际发送的钻石数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of u_pay
-- ----------------------------
INSERT INTO `u_pay` VALUES ('4', '0000000000000000000000001A2EFFFC', '1105455691', '4546666', '1*50*2', '5467913636', '123456789', 'v3', '0', '0', '100', '0', '0', '45566', '100');

-- ----------------------------
-- Table structure for `u_user`
-- ----------------------------
DROP TABLE IF EXISTS `u_user`;
CREATE TABLE `u_user` (
  `uid` varchar(255) NOT NULL,
  `nick` varchar(255) DEFAULT NULL,
  `cd` varchar(255) NOT NULL,
  `charge` int(11) NOT NULL,
  `chargetime` int(11) NOT NULL,
  `gems` int(11) NOT NULL,
  `getreward` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `level` int(11) NOT NULL COMMENT '玩家最大关卡数',
  `life` int(11) NOT NULL,
  `life2` int(11) DEFAULT '0',
  `login` varchar(255) NOT NULL,
  `logincount` varchar(255) NOT NULL,
  `maxlife` int(11) NOT NULL,
  `recover` int(11) NOT NULL,
  `register` varchar(255) NOT NULL,
  `xp` int(11) NOT NULL,
  `openkey` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of u_user
-- ----------------------------
INSERT INTO `u_user` VALUES ('0000000000000000000000001A2EFFFC', 'name0000000000000000000000001A2EFFFC', '0', '0', '0', '200', '1', '30460', '35', '5', '1', '1469846323', '7', '5', '0', '1469362636', '0', 'D269315EC60D42C75CD201888E715FE5');
INSERT INTO `u_user` VALUES ('1471CCA71C53D2332E1772A32437E2CB', 'name1471CCA71C53D2332E1772A32437E2CB', '0', '0', '0', '17', '1', '2000', '2', '5', '0', '1469678230', '2', '5', '0', '1469616694', '0', null);
INSERT INTO `u_user` VALUES ('2014', 'name2014', '0', '0', '0', '3632', '1', '3580', '70', '5', '1', '1469929548', '11', '5', '0', '1468709525', '0', '1581C1F04F75E6C1FD52A9FB0A63D393');
INSERT INTO `u_user` VALUES ('2015', 'name2015', '0', '0', '0', '1775', '1', '13740', '33', '5', '5', '1469707353', '5', '5', '0', '1468797629', '0', null);
INSERT INTO `u_user` VALUES ('2016', 'name2016', '0', '0', '0', '686', '1', '22360', '51', '5', '4', '1469700208', '8', '5', '0', '1468798534', '0', null);
INSERT INTO `u_user` VALUES ('2017', 'name2017', '0', '0', '0', '1367', '1', '17360', '70', '5', '4', '1469929593', '10', '5', '0', '1468798956', '0', '1581C1F04F75E6C1FD52A9FB0A63D393');
INSERT INTO `u_user` VALUES ('2018', 'name2018', '0', '0', '0', '7', '1', '7320', '43', '5', '6', '1470015482', '11', '5', '0', '1468799037', '0', '1581C1F04F75E6C1FD52A9FB0A63D393');
INSERT INTO `u_user` VALUES ('2019', 'name2019', '0', '0', '0', '432', '1', '20800', '70', '5', '29', '1470014668', '9', '5', '0', '1468799137', '0', '1581C1F04F75E6C1FD52A9FB0A63D393');
INSERT INTO `u_user` VALUES ('2020', 'name2020', '0', '0', '0', '4713', '1', '8580', '3', '5', '6', '1470015648', '6', '5', '0', '1468911965', '0', '1581C1F04F75E6C1FD52A9FB0A63D393');
INSERT INTO `u_user` VALUES ('2021', 'name2021', '0', '0', '0', '102', '1', '8760', '3', '5', '6', '1470015710', '3', '5', '0', '1469262788', '0', '1581C1F04F75E6C1FD52A9FB0A63D393');
INSERT INTO `u_user` VALUES ('2022', 'name2022', '0', '0', '0', '105', '1', '8360', '10', '5', '0', '1470028607', '6', '5', '0', '1469262978', '0', '1581C1F04F75E6C1FD52A9FB0A63D393');
INSERT INTO `u_user` VALUES ('2023', 'name2023', '0', '0', '0', '10', '1', '2000', '1', '5', '0', '1469707426', '1', '5', '0', '1469707426', '0', null);
INSERT INTO `u_user` VALUES ('2024', 'name2024', '0', '0', '0', '10', '1', '2000', '1', '5', '0', '1469707600', '1', '5', '0', '1469707600', '0', null);
INSERT INTO `u_user` VALUES ('2025', 'name2025', '0', '0', '0', '10', '1', '2000', '1', '5', '0', '1469713954', '1', '5', '0', '1469707804', '0', null);
INSERT INTO `u_user` VALUES ('2026', 'name2026', '0', '0', '0', '10', '1', '2000', '1', '5', '0', '1469707933', '1', '5', '0', '1469707933', '0', null);
INSERT INTO `u_user` VALUES ('2027', 'name2027', '0', '0', '0', '10', '1', '2000', '1', '5', '0', '1469708159', '1', '5', '0', '1469708006', '0', null);
INSERT INTO `u_user` VALUES ('2028', 'name2028', '0', '0', '0', '10', '1', '2000', '1', '5', '0', '1469708176', '1', '5', '0', '1469708171', '0', null);
INSERT INTO `u_user` VALUES ('2029', 'name2029', '0', '0', '0', '12', '1', '2000', '1', '5', '0', '1469708784', '1', '5', '0', '1469708212', '0', null);
INSERT INTO `u_user` VALUES ('2030', 'name2030', '0', '0', '0', '10', '1', '2000', '1', '5', '0', '1469709054', '1', '5', '0', '1469708892', '0', null);
INSERT INTO `u_user` VALUES ('2541D0905A9B6CF713474E84051F6D9F', 'name2541D0905A9B6CF713474E84051F6D9F', '0', '0', '0', '9', '1', '5600', '5', '5', '0', '1469923928', '5', '5', '0', '1469604617', '0', '1581C1F04F75E6C1FD52A9FB0A63D393');
