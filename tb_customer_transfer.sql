/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50542
 Source Host           : localhost
 Source Database       : huay

 Target Server Type    : MySQL
 Target Server Version : 50542
 File Encoding         : utf-8

 Date: 03/01/2016 23:56:43 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `tb_customer_transfer`
-- ----------------------------
DROP TABLE IF EXISTS `tb_customer_transfer`;
CREATE TABLE `tb_customer_transfer` (
  `cs_transfer_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` int(255) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `cs_transfer_amount` decimal(11,2) DEFAULT '0.00',
  `cs_transfer_date` datetime DEFAULT NULL,
  `transfer_id` int(11) DEFAULT '0',
  `cs_transfer_status` int(1) DEFAULT '0',
  `cs_tranfer_file` varchar(255) DEFAULT NULL,
  `noticed` int(1) DEFAULT '0',
  PRIMARY KEY (`cs_transfer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `tb_customer_transfer`
-- ----------------------------
BEGIN;
INSERT INTO `tb_customer_transfer` VALUES ('6', '8', '2', '1000.00', '2016-02-29 02:27:00', '0', '0', 'IMG_3160.jpg', '0'), ('10', '8', '4', '100000.00', '2016-02-29 02:34:00', '0', '0', 'IMG_3160.jpg', '0');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
