/*
Navicat MySQL Data Transfer

Source Server         : xiaochu
Source Server Version : 50515
Source Host           : localhost:3306
Source Database       : xiaochu

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-09-27 20:08:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `u_msg`
-- ----------------------------
DROP TABLE IF EXISTS `u_msg`;
CREATE TABLE `u_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `nick` varchar(255) DEFAULT NULL,
  `vipinfo` varchar(255) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `timestr` varchar(255) DEFAULT NULL COMMENT '插入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of u_msg
-- ----------------------------
