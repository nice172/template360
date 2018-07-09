/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : 127.0.0.1:3306
Source Database       : template360

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-07-09 17:54:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tpl_user
-- ----------------------------
DROP TABLE IF EXISTS `tpl_user`;
CREATE TABLE `tpl_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `passsalt` varchar(20) NOT NULL DEFAULT '' COMMENT '密码加密',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `register_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '注册ip',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tpl_user
-- ----------------------------
INSERT INTO `tpl_user` VALUES ('1', 'admin', 'eff4f49a128b27ca2babbbb53ad666fd', '686ab1', '354575573@qq.com', '1531122010', '10.10.0.99', '10.10.0.99', '1531129616');
INSERT INTO `tpl_user` VALUES ('3', 'nice172', '22f299656eb1e9cf7a41486642802679', 'a0b755', '354575573@qq.com', '1531122042', '10.10.0.99', '', '0');
