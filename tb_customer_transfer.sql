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

 Date: 02/26/2016 23:52:22 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `tb_customer_transfer`
-- ----------------------------
DROP TABLE IF EXISTS `tb_customer_transfer`;
CREATE TABLE `tb_customer_transfer` (
  `cs_transfer_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `cs_transfer_amount` decimal(11,2) DEFAULT '0.00',
  `cs_transfer_date` datetime DEFAULT NULL,
  `transfer_id` int(11) DEFAULT NULL,
  `cs_transfer_status` int(1) DEFAULT '0',
  PRIMARY KEY (`cs_transfer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
