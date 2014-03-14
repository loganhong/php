/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50529
Source Host           : localhost:3306
Source Database       : logansite

Target Server Type    : MYSQL
Target Server Version : 50529
File Encoding         : 65001

Date: 2014-03-14 17:56:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `createdate` datetime DEFAULT NULL,
  `editdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------

-- ----------------------------
-- Table structure for `comment`
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `parentid` int(11) DEFAULT NULL,
  `articleid` int(11) DEFAULT NULL,
  `comment` varchar(1000) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `createdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for `tag`
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `tag` varchar(200) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `pass` char(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `editdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', 'dddd', '17ba0791499db908433b80f37c5fbc89b870084b', '1', null, '2014-03-14 14:21:13');
INSERT INTO `users` VALUES ('3', 'ddf', 'c1de9de9a43c051811c9db13ede7770f69dc2fd5', 'dfd', null, '2014-03-14 14:33:27');
INSERT INTO `users` VALUES ('4', 'sss', 'c1c93f88d273660be5358cd4ee2df2c2f3f0e8e7', 'sss', null, '2014-03-14 14:33:44');
INSERT INTO `users` VALUES ('5', 'sssd', 'c1c93f88d273660be5358cd4ee2df2c2f3f0e8e7', 'sssd', null, '2014-03-14 14:33:50');
INSERT INTO `users` VALUES ('6', 'sssdf', 'c1c93f88d273660be5358cd4ee2df2c2f3f0e8e7', 'sssdf', null, '2014-03-14 14:33:57');
INSERT INTO `users` VALUES ('7', 'sssdf的是', 'c1c93f88d273660be5358cd4ee2df2c2f3f0e8e7', 'sssdf稍等', null, '2014-03-14 14:34:07');
INSERT INTO `users` VALUES ('8', '的是', 'c1c93f88d273660be5358cd4ee2df2c2f3f0e8e7', '稍等', null, '2014-03-14 14:34:16');
INSERT INTO `users` VALUES ('9', '的是是', 'c1c93f88d273660be5358cd4ee2df2c2f3f0e8e7', '稍等是', null, '2014-03-14 14:34:23');
INSERT INTO `users` VALUES ('10', '是', 'c1c93f88d273660be5358cd4ee2df2c2f3f0e8e7', '的是', null, '2014-03-14 14:34:37');
INSERT INTO `users` VALUES ('11', '是', 'c1c93f88d273660be5358cd4ee2df2c2f3f0e8e7', 'www@jufine.com', null, '2014-03-14 14:34:52');
INSERT INTO `users` VALUES ('12', 'df', '17ba0791499db908433b80f37c5fbc89b870084b', 'df@jufine.com', null, '2014-03-14 14:35:21');
INSERT INTO `users` VALUES ('13', 'ss', 'c1c93f88d273660be5358cd4ee2df2c2f3f0e8e7', 'ss@jufine.com', null, '2014-03-14 14:35:35');
