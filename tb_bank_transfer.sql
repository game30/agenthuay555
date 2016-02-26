/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50538
 Source Host           : localhost
 Source Database       : huay

 Target Server Type    : MySQL
 Target Server Version : 50538
 File Encoding         : utf-8

 Date: 02/27/2016 02:17:41 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `tb_bank_transfer`
-- ----------------------------
DROP TABLE IF EXISTS `tb_bank_transfer`;
CREATE TABLE `tb_bank_transfer` (
  `bk_transfer_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` int(11) DEFAULT NULL,
  `bk_transfer_amount` decimal(11,2) DEFAULT '0.00',
  `bk_transfer_date` datetime DEFAULT NULL,
  `cs_transfer_id` int(11) DEFAULT NULL,
  `bk_transfer_status` int(1) DEFAULT '0',
  `m_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`bk_transfer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `tb_bank_transfer`
-- ----------------------------
BEGIN;
INSERT INTO `tb_bank_transfer` VALUES ('1', '1', '100000.00', '2016-02-27 02:12:42', '0', '0', '1'), ('2', '1', '100000.00', '0000-00-00 00:00:00', '0', '0', '1'), ('3', '1', '100000.00', '2016-02-03 02:10:00', '0', '0', '1'), ('4', '1', '100000.00', '0000-00-00 00:00:00', '0', '0', '1'), ('5', '1', '100000.00', '2016-02-27 02:15:00', '0', '0', '1'), ('6', '1', '100000.00', '2016-02-27 02:17:00', '0', '0', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
