/*
Navicat MySQL Data Transfer

Source Server         : bbs
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : think

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2015-04-28 11:51:22
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `p2_lucky`
-- ----------------------------
DROP TABLE IF EXISTS `p2_lucky`;
CREATE TABLE `p2_lucky` (
  `id` tinyint(2) NOT NULL COMMENT '编号',
  `min` varchar(40) NOT NULL COMMENT '最小角度',
  `max` varchar(40) NOT NULL COMMENT '最大角度',
  `prize` varchar(50) NOT NULL COMMENT '表示提示',
  `v` tinyint(3) NOT NULL COMMENT '概率1-100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户基本信息';

-- ----------------------------
-- Records of p2_lucky
-- ----------------------------
INSERT INTO `p2_lucky` VALUES ('1', '1', '29', '一等奖', '1');
INSERT INTO `p2_lucky` VALUES ('2', '302', '328', '二等奖', '2');
INSERT INTO `p2_lucky` VALUES ('3', '242', '268', '三等奖', '5');
INSERT INTO `p2_lucky` VALUES ('4', '182', '208', '四等奖', '7');
INSERT INTO `p2_lucky` VALUES ('5', '122', '148', '五等奖', '10');
INSERT INTO `p2_lucky` VALUES ('6', '62', '88', '六等奖', '25');
INSERT INTO `p2_lucky` VALUES ('7', '32, 92, 152, 212, 272, 332', '58, 118, 178, 238, 298, 358', '七等奖', '50');
