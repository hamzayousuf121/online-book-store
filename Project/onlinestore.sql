/*
Navicat MySQL Data Transfer

Source Server         : bookstore
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : onlinestore

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-08-23 14:35:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bookrecord`
-- ----------------------------
DROP TABLE IF EXISTS `bookrecord`;
CREATE TABLE `bookrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `description` varchar(255) DEFAULT '',
  `url` varchar(100) NOT NULL,
  `price` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bookrecord
-- ----------------------------
INSERT INTO `bookrecord` VALUES ('1', 'react js', 'this is a react book', 'http://sites.google.com/view/webhost/112/', '$50');
INSERT INTO `bookrecord` VALUES ('3', 'hanmza ', 'gsiodbsid baiisb', 'kiodfjkod fiasd sdios', '24');
INSERT INTO `bookrecord` VALUES ('4', 'hanmza ', 'gsiodbsid baiisb', 'kiodfjkod fiasd sdios', '24');
INSERT INTO `bookrecord` VALUES ('5', 'hanmza ', 'gsiodbsid baiisb', 'kiodfjkod fiasd sdios', '24');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(90) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(60) NOT NULL DEFAULT '',
  `status` smallint(2) NOT NULL DEFAULT 0,
  `activationKey` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
