/*
Navicat MySQL Data Transfer

Source Server         : my
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : dial

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-03-01 17:17:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sw_assign_prize
-- ----------------------------
DROP TABLE IF EXISTS `sw_assign_prize`;
CREATE TABLE `sw_assign_prize` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '指定获奖人表主键id',
  `dial_id` int(11) NOT NULL COMMENT '指定奖品id',
  `dial_name` varchar(255) DEFAULT NULL COMMENT '指定奖品名称',
  `user_id` int(11) NOT NULL COMMENT '指定人ID',
  `user_name` varchar(255) DEFAULT NULL COMMENT '指定人名称',
  `admin_id` int(11) NOT NULL COMMENT '创建者ID',
  `admin_name` varchar(255) DEFAULT NULL COMMENT '创建人名称',
  `creat_time` varchar(255) DEFAULT NULL COMMENT '创建时间',
  `interval_time` varchar(255) DEFAULT NULL COMMENT '获奖时间间隔',
  `prize_num` int(11) DEFAULT NULL COMMENT '获取剩余次数',
  `is_del` int(1) NOT NULL DEFAULT '1' COMMENT '1正常2删除',
  `update_time` varchar(255) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_assign_prize
-- ----------------------------
INSERT INTO `sw_assign_prize` VALUES ('1', '2', '提高白条额度', '2', '2333', '1', 'admin', '1487812749', '2', '1', '1', null);
INSERT INTO `sw_assign_prize` VALUES ('5', '2', '提高白条额度', '2', '2333', '1', 'admin', '1488344762', '3', '3', '2', null);
INSERT INTO `sw_assign_prize` VALUES ('6', '3', '免分期服务费', '2', '2333', '1', 'admin', '1488350541', '0', '3', '1', '1488353312');

-- ----------------------------
-- Table structure for sw_dial
-- ----------------------------
DROP TABLE IF EXISTS `sw_dial`;
CREATE TABLE `sw_dial` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '装盘奖品ID',
  `min` double(11,2) NOT NULL COMMENT '最小角度',
  `max` double(11,2) NOT NULL COMMENT '最大角度',
  `prize_name` varchar(255) DEFAULT NULL COMMENT '奖品',
  `probability` double(11,2) NOT NULL COMMENT '中奖概率',
  `is_del` int(1) NOT NULL DEFAULT '1' COMMENT '1启用，2停用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_dial
-- ----------------------------
INSERT INTO `sw_dial` VALUES ('1', '1.00', '51.43', '未中奖', '35.00', '1');
INSERT INTO `sw_dial` VALUES ('2', '51.43', '103.86', '提高白条额度', '10.00', '1');
INSERT INTO `sw_dial` VALUES ('3', '103.86', '154.29', '免分期服务费', '10.00', '1');
INSERT INTO `sw_dial` VALUES ('4', '154.29', '205.72', '免单5元', '20.00', '1');
INSERT INTO `sw_dial` VALUES ('5', '205.72', '254.15', '免单10元', '15.00', '1');
INSERT INTO `sw_dial` VALUES ('6', '254.15', '308.58', '免单50元', '5.00', '1');
INSERT INTO `sw_dial` VALUES ('7', '308.58', '360.00', '免单4999元', '5.00', '1');

-- ----------------------------
-- Table structure for sw_manager
-- ----------------------------
DROP TABLE IF EXISTS `sw_manager`;
CREATE TABLE `sw_manager` (
  `mg_id` int(11) NOT NULL AUTO_INCREMENT,
  `mg_name` varchar(32) NOT NULL,
  `mg_pwd` varchar(32) NOT NULL,
  `mg_time` int(10) unsigned NOT NULL COMMENT '时间',
  `mg_role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `mg_phone` varchar(11) DEFAULT NULL,
  `mg_stute` int(1) NOT NULL DEFAULT '1' COMMENT '1正常2停用',
  PRIMARY KEY (`mg_id`),
  KEY `mg_id` (`mg_id`) USING BTREE,
  KEY `mg_name` (`mg_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_manager
-- ----------------------------
INSERT INTO `sw_manager` VALUES ('1', 'admin', '123456', '0', '0', null, '1');
INSERT INTO `sw_manager` VALUES ('2', 'tom', '123456', '0', '1', null, '1');
INSERT INTO `sw_manager` VALUES ('3', 'linken', '123456', '0', '2', null, '1');
INSERT INTO `sw_manager` VALUES ('4', 'mary', '123456', '1387785044', '2', null, '1');
INSERT INTO `sw_manager` VALUES ('5', 'yuehan', '123456', '1387785056', '1', null, '2');
INSERT INTO `sw_manager` VALUES ('6', '3', '4', '1487649753', '1', null, '2');
INSERT INTO `sw_manager` VALUES ('17', 'qwe', '123456', '1487654837', '1', '15126499915', '1');
INSERT INTO `sw_manager` VALUES ('18', 'yzw', '132456', '1488190002', '1', '18236197061', '1');

-- ----------------------------
-- Table structure for sw_prizeinfo
-- ----------------------------
DROP TABLE IF EXISTS `sw_prizeinfo`;
CREATE TABLE `sw_prizeinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '获奖信息表',
  `dial_id` int(11) NOT NULL COMMENT '奖品ID',
  `dial_name` varchar(255) DEFAULT NULL COMMENT '奖品名称',
  `user_id` int(11) NOT NULL COMMENT '获奖人ID',
  `user_name` varchar(255) DEFAULT NULL COMMENT '获奖人姓名',
  `creat_time` varchar(255) NOT NULL COMMENT '获奖时间',
  `is_grant` int(1) NOT NULL DEFAULT '1' COMMENT '1未发放2已发放',
  `is_del` int(1) NOT NULL DEFAULT '1' COMMENT '1正常2删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_prizeinfo
-- ----------------------------
INSERT INTO `sw_prizeinfo` VALUES ('1', '3', '免分期服务费', '2', '2333', '1488353312', '1', '1');

-- ----------------------------
-- Table structure for sw_user
-- ----------------------------
DROP TABLE IF EXISTS `sw_user`;
CREATE TABLE `sw_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `username` varchar(128) NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '登录密码',
  `user_email` varchar(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `user_sex` tinyint(4) NOT NULL DEFAULT '1' COMMENT '性别',
  `user_qq` varchar(32) NOT NULL DEFAULT '' COMMENT 'qq',
  `user_tel` varchar(32) NOT NULL DEFAULT '' COMMENT '手机',
  `user_xueli` tinyint(4) NOT NULL DEFAULT '1' COMMENT '学历',
  `user_hobby` varchar(32) NOT NULL DEFAULT '' COMMENT '爱好',
  `user_introduce` text COMMENT '简介',
  `user_time` int(11) DEFAULT NULL,
  `last_time` int(11) NOT NULL DEFAULT '0',
  `is_del` int(1) NOT NULL DEFAULT '1' COMMENT '1正常2删除',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of sw_user
-- ----------------------------
INSERT INTO `sw_user` VALUES ('1', 'zhangsanff', '1234', 'zhangsanff', '1', '', '18236197061', '1', '', '', null, '0', '1');
INSERT INTO `sw_user` VALUES ('2', '2333', '2333', '2111', '1', '', '18236197061', '1', '', null, null, '0', '1');
