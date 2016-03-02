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

<<<<<<< HEAD
 Date: 03/01/2016 15:33:03 PM
=======
 Date: 03/01/2016 23:56:43 PM
>>>>>>> origin/master
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
<<<<<<< HEAD
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
=======
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
>>>>>>> origin/master

-- ----------------------------
--  Records of `tb_customer_transfer`
-- ----------------------------
BEGIN;
<<<<<<< HEAD
INSERT INTO `tb_customer_transfer` VALUES ('1', '8', '2', '10000.00', '2016-02-29 01:58:00', null, null, 'mjcDf9FYca.jpg', '0'), ('2', '8', '3', '20000.00', '2016-02-29 01:59:00', '0', '0', 'gBFOoYwCfI.jpg', '0'), ('3', '8', '1', '1000.00', '2016-02-29 02:10:00', '0', '0', '4lvJYm1MXA.jpg', '0'), ('4', '8', '1', '1000.00', '2016-02-29 02:15:00', '0', '0', 'fJIDI1jGt0.jpg', '0'), ('5', '8', '1', '100.00', '2016-02-29 02:16:00', '0', '0', 'diAttBfmXr.jpg', '0'), ('6', '8', '2', '1000.00', '2016-02-29 02:27:00', '0', '0', 'yuGR2C9TIx.jpg', '0'), ('7', '8', '3', '10000.00', '2016-02-29 02:32:00', '0', '0', 'WYl4ycBMP3.jpg', '0'), ('8', '8', '1', '20000.00', '2016-02-29 02:32:00', '0', '0', 'grOuTm5vPk.jpg', '0'), ('9', '8', '3', '222222.00', '2016-02-29 02:33:00', '0', '0', 'pGh3iALWfq.jpg', '0'), ('10', '8', '4', '100000.00', '2016-02-29 02:34:00', '0', '0', '9VLgTdhBSq.jpg', '0'), ('11', '8', '1', '10000.00', '2016-02-29 02:42:00', '0', '0', 'LByiklyngc.jpg', '0'), ('12', '8', '3', '10000.00', '2016-02-29 02:43:00', '0', '0', 'wG5kxp1WF0.jpg', '0'), ('13', '8', '1', '1000000.00', '2016-02-29 02:43:00', '0', '0', 'bulb4VdiP7.jpg', '0'), ('14', '8', '4', '100000.00', '2016-02-29 17:54:00', '0', '0', 'PtXcz3yir3.pdf', '0'), ('15', '8', '2', '40000.00', '2016-02-29 17:55:00', '0', '0', 'PRxRzw8Od2.pdf', '0');
=======
INSERT INTO `tb_customer_transfer` VALUES ('6', '8', '2', '1000.00', '2016-02-29 02:27:00', '0', '0', 'IMG_3160.jpg', '0'), ('10', '8', '4', '100000.00', '2016-02-29 02:34:00', '0', '0', 'IMG_3160.jpg', '0');
>>>>>>> origin/master
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
