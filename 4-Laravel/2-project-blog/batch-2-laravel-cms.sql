/*
Navicat MySQL Data Transfer
Source Server         : localhost
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : batch-2-laravel-cms
Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001
Date: 2022-01-22 17:39:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('12', 'Laravel', '2021-12-03 18:46:18', '2021-12-03 18:46:18');
INSERT INTO `categories` VALUES ('13', 'Wordpress', '2021-12-03 18:46:22', '2021-12-03 18:46:22');
INSERT INTO `categories` VALUES ('14', 'React 2', '2021-12-03 23:46:30', '2021-12-03 18:46:30');
INSERT INTO `categories` VALUES ('15', 'New Category', '2021-12-05 13:50:35', '2021-12-05 13:50:35');

-- ----------------------------
-- Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_user_id` int(11) DEFAULT NULL,
  `comment_post_id` int(11) DEFAULT NULL,
  `comment_content` text,
  `comment_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('27', '5', '3', 'new comment', 'unapproved', '2021-12-26 18:13:10', '2021-12-26 13:13:10');
INSERT INTO `comments` VALUES ('28', '5', '3', 'new comment', 'unapproved', '2021-12-26 18:13:10', '2021-12-26 13:13:10');
INSERT INTO `comments` VALUES ('30', '5', '3', 'new comment', 'approved', '2021-12-26 18:13:17', '2021-12-26 13:13:17');
INSERT INTO `comments` VALUES ('31', '5', '3', 'asdf', 'approved', '2021-12-26 18:13:19', '2021-12-26 13:13:19');
INSERT INTO `comments` VALUES ('32', '5', '3', 'This post is really awesome', 'unapproved', '2021-12-26 18:13:10', '2021-12-26 13:13:10');
INSERT INTO `comments` VALUES ('33', '5', '3', 'latest comment', 'unapproved', '2021-12-26 18:13:10', '2021-12-26 13:13:10');
INSERT INTO `comments` VALUES ('34', '5', '3', 'ASDASDASD', 'unapproved', '2021-12-26 18:13:10', '2021-12-26 13:13:10');
INSERT INTO `comments` VALUES ('35', '5', '3', 'NEW COMMENT', 'approved', '2021-12-28 23:40:54', '2021-12-28 18:40:54');

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_category_id` int(11) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_author` varchar(255) DEFAULT NULL,
  `post_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `post_image` text,
  `post_content` text,
  `post_tags` varchar(255) DEFAULT NULL,
  `post_status` varchar(255) DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('3', '13', 'Post Title', 'Shuja', null, 'post_images/1638819285.jpg', 'Wow I really this course this is another course', 'vue,react,laravel,react native', 'published', '2021-12-18 00:07:01', '2021-12-18 00:07:01');
INSERT INTO `posts` VALUES ('4', '14', 'Illo magna nisi tene', 'Excepturi labore rep', '1972-01-19 00:00:00', 'post_images/1639916400.jpg', 'Placeat voluptate a', 'Ut quo et rerum proi', 'published', '2021-12-19 12:20:00', '2021-12-19 12:20:00');
INSERT INTO `posts` VALUES ('5', '15', 'Anim excepturi adipi', 'Laboris commodo aliq', '2004-09-03 00:00:00', 'post_images/1639921286.jpg', 'Repellendus Et prae', 'Et qui sed commodi d', 'published', '2021-12-19 13:41:26', '2021-12-19 13:41:26');
INSERT INTO `posts` VALUES ('6', '14', 'Reprehenderit quos a', 'Similique impedit r', '1994-06-01 00:00:00', 'post_images/1640113035.png', 'Duis in voluptate la', 'Officiis aut porro e', 'published', '2021-12-21 18:57:15', '2021-12-21 18:57:15');
INSERT INTO `posts` VALUES ('7', '12', 'Sequi dolore commodo', 'Nam eaque eu commodo', '1993-10-17 00:00:00', 'post_images/1640372288.png', 'Exercitation non obc', 'Itaque tempore cumq', 'draft', '2021-12-24 18:58:08', '2021-12-24 18:58:08');

-- ----------------------------
-- Table structure for `post_user`
-- ----------------------------
DROP TABLE IF EXISTS `post_user`;
CREATE TABLE `post_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post_user
-- ----------------------------
INSERT INTO `post_user` VALUES ('9', '4', '5');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_image` text,
  `user_role` varchar(255) DEFAULT NULL,
  `token` text,
  `is_online` int(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'lodotejupu', '$2y$10$Bj6Vzrw9RzhUCyxW18iZO.P7xDIOxe4HzBSPzMH/RlaLv9AituG9y', 'Denton', 'Whitley', 'binij@mailinator.com', null, 'Subscriber', null, '0', '2021-12-10 23:49:39', '2021-12-10 23:49:39');
INSERT INTO `users` VALUES ('3', 'lebijehyp', '$2y$10$7Bb6v.p/0.iHl1Ennoyjn.uodPeQZRkxuU.aOupt9blnL35G0WPvO', 'Ray', 'Jacobs', 'nytyzo@mailinator.com', null, 'Subscriber', null, '0', '2021-12-10 23:49:38', '2021-12-10 23:49:38');
INSERT INTO `users` VALUES ('4', 'jybetitaqa', '$2y$10$XoGsjZ0mptp4Kt33YwKUzeQb1bBHm5TYCn8cPs25pCokzKfkAxV9.', 'bezalepyf', 'Berry', 'meqawasa@mailinator.com', null, 'admin', null, '0', '2021-12-15 00:09:53', '2021-12-14 19:09:53');
INSERT INTO `users` VALUES ('5', 'Muzammil', '$2y$10$rp8LEVdZ7L206wGi0ea5YOrOLwr.mE.ltTlrSIGzpQIF7W7jVLx8y', 'Muzammil', 'Rafay', 'muzammil.rafay@gmail.com', 'user_images/1640524205.jpg', 'admin', null, '0', '2021-12-26 18:10:05', '2021-12-26 13:10:05');
INSERT INTO `users` VALUES ('6', 'tezano', '$2y$10$poeK8wmj5Df.1XaAXng0NOt5Yy8PVG0udZxZ66UyFa4IyRQAhuQaS', 'belytu', '1992-07-26', null, null, 'subscriber', null, '0', '2021-12-14 18:56:46', '2021-12-14 18:56:46');
INSERT INTO `users` VALUES ('7', 'bufuvasaqy', '$2y$10$S1.KZEafsSoVup.q994hde0P7t6O/lN1VuVCQ60nJrSPyh7d2mi5G', 'rogotuxeb', '1989-07-15', null, null, 'admin', null, '0', '2021-12-14 18:57:42', '2021-12-14 18:57:42');
INSERT INTO `users` VALUES ('8', 'siqov', '$2y$10$at5Q3Ss5CJJaQbibw1dpRe.eZskpIZRC2sLavBp6192QuUqJ0Oxki', 'cysakuvo', '1974-02-13', 'qotyzun@mailinator.com', null, 'subscriber', null, '0', '2021-12-14 18:58:33', '2021-12-14 18:58:33');
INSERT INTO `users` VALUES ('9', 'sazunemoh', '$2y$10$AvOXP7rEpcdkHMzskrxjvOcOtpdtcWVxBGEGvqblogzsmWkiZmxcG', 'zafed', 'Weber', 'hucyj@mailinator.com', 'user_images/1639509542.png', 'admin', null, '0', '2021-12-15 00:19:02', '2021-12-14 19:19:02');
INSERT INTO `users` VALUES ('10', 'wivyri', '$2y$10$KqLo5y8qO4MYIxnjIM1Uq.JI.VBUEx56VXOpiTeZlLhDBXfVpXcTu', 'vykebisa', 'Dickerson', 'qilez@mailinator.com', 'user_images/1639509303.jpg', 'admin', null, '0', '2021-12-14 19:15:03', '2021-12-14 19:15:03');
