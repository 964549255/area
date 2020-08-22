/*
Navicat MariaDB Data Transfer

Source Server         : localhost
Source Server Version : 100312
Source Host           : localhost:3307
Source Database       : demo

Target Server Type    : MariaDB
Target Server Version : 100312
File Encoding         : 65001

Date: 2020-08-14 16:17:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cmf_area_record
-- ----------------------------
DROP TABLE IF EXISTS `cmf_area_record`;
CREATE TABLE `cmf_area_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录编号',
  `area_code` varchar(255) DEFAULT NULL COMMENT '地区编码',
  `member_id` int(11) DEFAULT NULL COMMENT '用户编号',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
