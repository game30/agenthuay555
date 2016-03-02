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

 Date: 02/29/2016 19:15:45 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `tb_bank_transfer`
-- ----------------------------
BEGIN;
INSERT INTO `tb_bank_transfer` VALUES ('1', '1', '100000.00', '2016-02-27 02:12:42', '0', '0', '1'), ('3', '1', '100000.00', '2016-02-03 02:10:00', '0', '0', '1'), ('5', '1', '100000.00', '2016-02-27 02:15:00', '0', '0', '1'), ('6', '1', '100000.00', '2016-02-27 02:17:00', '0', '0', '1'), ('7', '3', '100000.00', '2016-02-27 19:50:00', '0', '0', '1'), ('8', '1', '15000.00', '2016-02-28 00:44:00', '0', '0', '1'), ('9', '3', '1000000.00', '2016-02-28 01:00:00', '0', '0', '1'), ('10', '3', '100000.00', '2016-02-28 01:01:00', '0', '0', '1'), ('11', '1', '100000.00', '2016-02-28 01:06:00', '0', '0', '1'), ('12', '1', '100000.00', '2016-02-28 01:08:00', '0', '0', '1'), ('13', '1', '100000.00', '2016-02-28 01:08:00', '0', '0', '1'), ('14', '3', '100000.00', '2016-02-28 01:13:00', '0', '0', '1'), ('15', '3', '100000.00', '2016-02-28 01:19:00', '0', '0', '1'), ('16', '4', '100000.00', '2016-02-29 18:02:00', '0', '0', '1');
COMMIT;

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
  PRIMARY KEY (`cs_transfer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `tb_customer_transfer`
-- ----------------------------
BEGIN;
INSERT INTO `tb_customer_transfer` VALUES ('1', '8', '2', '10000.00', '2016-02-29 01:58:00', null, null, 'mjcDf9FYca.jpg'), ('2', '8', '3', '20000.00', '2016-02-29 01:59:00', '0', '0', 'gBFOoYwCfI.jpg'), ('3', '8', '1', '1000.00', '2016-02-29 02:10:00', '0', '0', '4lvJYm1MXA.jpg'), ('4', '8', '1', '1000.00', '2016-02-29 02:15:00', '0', '0', 'fJIDI1jGt0.jpg'), ('5', '8', '1', '100.00', '2016-02-29 02:16:00', '0', '0', 'diAttBfmXr.jpg'), ('6', '8', '2', '1000.00', '2016-02-29 02:27:00', '0', '0', 'yuGR2C9TIx.jpg'), ('7', '8', '3', '10000.00', '2016-02-29 02:32:00', '0', '0', 'WYl4ycBMP3.jpg'), ('8', '8', '1', '20000.00', '2016-02-29 02:32:00', '0', '0', 'grOuTm5vPk.jpg'), ('9', '8', '3', '222222.00', '2016-02-29 02:33:00', '0', '0', 'pGh3iALWfq.jpg'), ('10', '8', '4', '100000.00', '2016-02-29 02:34:00', '0', '0', '9VLgTdhBSq.jpg'), ('11', '8', '1', '10000.00', '2016-02-29 02:42:00', '0', '0', 'LByiklyngc.jpg'), ('12', '8', '3', '10000.00', '2016-02-29 02:43:00', '0', '0', 'wG5kxp1WF0.jpg'), ('13', '8', '1', '1000000.00', '2016-02-29 02:43:00', '0', '0', 'bulb4VdiP7.jpg'), ('14', '8', '4', '100000.00', '2016-02-29 17:54:00', '0', '0', 'PtXcz3yir3.pdf'), ('15', '8', '2', '40000.00', '2016-02-29 17:55:00', '0', '0', 'PRxRzw8Od2.pdf');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
