/*
Navicat MariaDB Data Transfer

Source Server         : localhost
Source Server Version : 100312
Source Host           : localhost:3307
Source Database       : demo

Target Server Type    : MariaDB
Target Server Version : 100312
File Encoding         : 65001

Date: 2020-08-14 16:17:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cmf_area_config
-- ----------------------------
DROP TABLE IF EXISTS `cmf_area_config`;
CREATE TABLE `cmf_area_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置编号',
  `ak_server` varchar(255) DEFAULT NULL COMMENT '应用密钥(服务端)',
  `ak_browser` varchar(255) DEFAULT NULL COMMENT '应用密钥(浏览器端)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cmf_area_config
-- ----------------------------
INSERT INTO `cmf_area_config` VALUES ('1', 'qHf0dPjbtW0SPrsLADsyY8Wv8zgQ0TvB', 'pmmO21Hk6Ixznv0qAqKOzGnVMiS4CFBQ');
