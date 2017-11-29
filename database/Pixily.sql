/*
 Navicat Premium Data Transfer

 Source Server         : SAKKA
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : 127.0.0.1
 Source Database       : Pixily

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 11/28/2017 19:18:42 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `albums`
-- ----------------------------
DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(25) DEFAULT NULL,
  `album_name` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `albums`
-- ----------------------------
BEGIN;
INSERT INTO `albums` VALUES ('1', '5a1d37572a5ec9.80111262', 'Nature', '2017-11-28 14:14:35', '2017-11-28 14:14:37');
COMMIT;

-- ----------------------------
--  Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comments` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `comments_photos`
-- ----------------------------
DROP TABLE IF EXISTS `comments_photos`;
CREATE TABLE `comments_photos` (
  `id` int(11) NOT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `comments_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `likes`
-- ----------------------------
DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `photos`
-- ----------------------------
DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(25) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `caption` varchar(30) DEFAULT NULL,
  `lat` decimal(20,0) DEFAULT NULL,
  `lon` decimal(20,0) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `photos`
-- ----------------------------
BEGIN;
INSERT INTO `photos` VALUES ('1', '5a1d37572a5ec9.80111262', '1', 'How r u doing', null, null, 'http://172.18.12.57/mobile/public/images/5a1c57a81e2cc.78187065.png', '2017-11-27 19:21:28', '2017-11-27 19:21:28'), ('2', '5a1d37572a5ec9.80111262', '1', 'How r u doing', null, null, 'http://172.18.12.57/mobile/public/images/5a1c59d2628e6.105290814.png', '2017-11-27 19:30:42', '2017-11-27 19:30:42'), ('3', '5a1d37572a5ec9.80111262', '1', 'How r u doing', null, null, 'http://172.18.12.57/mobile/public/images/5a1c59e443526.487048699.png', '2017-11-27 19:31:00', '2017-11-27 19:31:00');
COMMIT;

-- ----------------------------
--  Table structure for `tags`
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(10) DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` varchar(25) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `salt` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('5a1d36b40cbcf3.17562062', 'Jake', '3CChtJsXAn1x8SSa7Z8FerGdk/QyZjY0YTMxYjc4', 'afrojive7@gmail.com', '2f64a31b78', '2017-11-28 11:13:08', '2017-11-28 11:13:08'), ('5a1d37572a5ec9.80111262', 'Hillary', 'RKSU6HuIsBjRr1iARaw61agQmrtkYmQ3YTVhZDk3', 'emodatt08@gmail.com', 'dbd7a5ad97', '2017-11-28 11:15:51', '2017-11-28 11:15:51');
COMMIT;

-- ----------------------------
--  Table structure for `users_profiles`
-- ----------------------------
DROP TABLE IF EXISTS `users_profiles`;
CREATE TABLE `users_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `profile_pic` varchar(20) DEFAULT NULL,
  `profile_banner_pic` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
