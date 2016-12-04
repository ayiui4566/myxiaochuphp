--APP_NAME,Version：VERSION
--Mysql VERSION：5.5.15-log
--Create time：2013-10-09 11:56:25
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `t_username` varchar(200) DEFAULT NULL,
  `t_passward` varchar(200) DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `num` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
INSERT INTO `admins` VALUES ('6','admin','202cb962ac59075b964b07152d234b70','2013-10-09 11:19:01','127.0.0.1','');
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL COMMENT '编号',
  `fullname` varchar(30) DEFAULT NULL COMMENT '全名',
  `sex` varchar(5) DEFAULT NULL COMMENT '性别',
  `age` tinyint(3) DEFAULT NULL COMMENT '年龄',
  `peijingDate` date DEFAULT NULL COMMENT '配镜日期',
  `telphone` varchar(39) DEFAULT NULL COMMENT '手机',
  `address` varchar(255) DEFAULT NULL COMMENT '通信地址',
  `r-luoyanshili` varchar(10) DEFAULT NULL COMMENT '裸眼视力（右）：',
  `l-luoyanshili` varchar(10) DEFAULT NULL COMMENT '裸眼视力（左）：',
  `r-qiujing` varchar(10) DEFAULT NULL COMMENT '球镜（右）：',
  `l-qiujing` varchar(10) DEFAULT NULL COMMENT '球镜（左）：',
  `r-zhujing` varchar(10) DEFAULT NULL COMMENT '柱镜（右）：',
  `l-zhujing` varchar(10) DEFAULT NULL COMMENT '柱镜（左）：',
  `r-zhouxiang` varchar(10) DEFAULT NULL COMMENT '轴向（右）：',
  `l-zhouxiang` varchar(10) DEFAULT NULL COMMENT '轴向（左）：',
  `r-jiaozhengshili` varchar(10) DEFAULT NULL COMMENT '矫正视力（右）：',
  `l-jiaozhengshili` varchar(10) DEFAULT NULL COMMENT '矫正视力（左）：',
  `yuanyongtongju` int(10) DEFAULT NULL COMMENT '远用瞳距：',
  `yongtu` varchar(10) DEFAULT NULL COMMENT '用途：',
  `price` double DEFAULT NULL COMMENT '消费金额：',
  `buytime` int(11) DEFAULT NULL COMMENT '购买次数：',
  `jianpin` varchar(25) DEFAULT NULL COMMENT '简拼',
  `desc` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='客户表';
INSERT INTO `customers` VALUES ('5','kkkk','男','89','2013-10-06','','ddds','','','2','','','','','','','','0','','55','0','','');
INSERT INTO `customers` VALUES ('2','1213','男','34','0000-00-00','1','1','1','1','1','1','1','1','1','1','1','1','2','2','2','2','2','2');
INSERT INTO `customers` VALUES ('3','wqdqqq','男','45','2013-10-04','324234','fewfwef','ewf','f','few','f','fwe','f','fwe','f','fe','f','0','视远','56','43','nj','fsdf');
INSERT INTO `customers` VALUES ('4','jiangbo','男','78','2013-10-04','sdf','fsdf','','','','','','','','','','','0','视远','0','1','jb','d');
