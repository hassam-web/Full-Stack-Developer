/*
Navicat MySQL Data Transfer
Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : batch-2-cms
Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001
Date: 2022-01-02 15:11:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'Bootstrap');
INSERT INTO `categories` VALUES ('2', 'Javascript');
INSERT INTO `categories` VALUES ('3', 'Php 2 is working');
INSERT INTO `categories` VALUES ('6', 'React');
INSERT INTO `categories` VALUES ('24', 'CATEGORY CHANGED');

-- ----------------------------
-- Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_status` varchar(100) DEFAULT NULL,
  `comment_content` text DEFAULT NULL,
  `comment_date` date DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('2', '3', '20', 'approved', 'this is awesome', '2021-12-22');
INSERT INTO `comments` VALUES ('3', '5', '20', 'approved', 'this is awesome', '2021-12-22');
INSERT INTO `comments` VALUES ('7', '5', '20', 'approved', 'this is awesome', '2021-12-22');
INSERT INTO `comments` VALUES ('11', '1', '20', 'approved', 'this is awesome', '2021-12-22');
INSERT INTO `comments` VALUES ('12', '1', '20', 'approved', 'this is awesome', '2021-12-22');
INSERT INTO `comments` VALUES ('13', '1', '20', 'approved', 'this is awesome', '2021-12-22');
INSERT INTO `comments` VALUES ('14', '1', '20', 'approved', 'wow this is soo funny', '2022-01-01');
INSERT INTO `comments` VALUES ('15', '1', '20', 'approved', 'second comment', '2022-01-01');
INSERT INTO `comments` VALUES ('16', '1', '20', 'approved', 'second comment', '2022-01-01');
INSERT INTO `comments` VALUES ('17', '1', '20', 'unapproved', 'Second COmment', '2022-01-01');
INSERT INTO `comments` VALUES ('18', '1', '20', 'approved', 'ASDASD', '2022-01-01');

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_category_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text DEFAULT NULL,
  `post_content` text NOT NULL,
  `post_tags` text DEFAULT NULL,
  `post_comment_count` int(11) DEFAULT NULL,
  `post_status` varchar(100) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', '2', 'What is Laravel', 'muzammil', '2021-11-03', '/uploads/posts/image-1.png', 'Laravel is a php framework', 'php', '0', 'publish');
INSERT INTO `posts` VALUES ('3', '2', 'What is Laravel', 'muzammil', '2021-11-03', '/uploads/posts/image-1.png', 'Laravel is a php framework', 'php', '0', 'publish');
INSERT INTO `posts` VALUES ('5', '2', 'What is Laravel', 'muzammil', '2021-11-03', '/uploads/posts/image-1.png', 'Laravel is a php framework', 'php', '0', 'publish');
INSERT INTO `posts` VALUES ('7', '0', '22-Jun-2001', '13-Jun-1986', '2008-10-07', '', 'Tempora Nam est dict', '23-May-2011', null, 'draft');
INSERT INTO `posts` VALUES ('8', '3', 'TITLE', 'Changed Author', '2000-03-12', '/uploads/posts/14348b9d-cce7-491d-9d64-1284d0a52f32.jpg', 'Post Content', 'php', null, 'draft');
INSERT INTO `posts` VALUES ('9', '1', '15-Nov-1982', '09-Jan-1988', '1983-07-03', '', 'Provident aliqua E', '19-Mar-1978', '0', 'draft');
INSERT INTO `posts` VALUES ('10', '3', '02-Sep-2011', '04-May-2002', '1971-09-04', 'image_5.jpg', 'Non doloribus ut et ', '08-Jul-1974', '0', 'draft');
INSERT INTO `posts` VALUES ('11', '1', '22-Aug-2006', '04-Apr-1985', '2021-10-22', 'image_5.jpg', 'Velit duis laborios', '09-Oct-1988', '0', 'draft');
INSERT INTO `posts` VALUES ('13', '6', '13-Oct-2004', '23-Aug-2008', '1971-12-15', 'image_5.jpg', 'Quidem officiis nisi', '30-Dec-1986', '0', 'publish');
INSERT INTO `posts` VALUES ('14', '3', '26-Feb-1996', '31-May-1995', '1992-01-24', 'image_5.jpg', 'Quam rerum voluptate', '04-Jul-1981', '0', 'draft');
INSERT INTO `posts` VALUES ('16', '1', '24-Jan-2018', '14-Jun-1977', '1993-06-08', 'mvc-diagram.png', 'Non eiusmod eos del', '01-May-2002', '0', 'publish');
INSERT INTO `posts` VALUES ('17', '2', '03-Jan-2013', '16-Sep-1988', '1998-08-24', '/uploads/posts/photo1.jpg', 'Cumque fugiat nesci', '09-Mar-2020', '0', 'draft');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_image` text DEFAULT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `randSalt` varchar(255) DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('19', 'nidazused', '$2y$10$depubdpbByB7QqRKga.Jj.3P8drnhb1rGc24Cmbm0Kxtp4jLjgVC2', 'Olivia', 'Anthony', 'lujizaqo@mailinator.com', 'images/users/f270e664-5df3-4e73-ad9b-ef4737002e3c.jpg', 'subscriber', '$2y$10$iusesomecrazystrings22', null);
INSERT INTO `users` VALUES ('20', 'muzammil2', '$2y$10$bX4aYcl5Za/27541sn7dyeVWY/NTwgH1EDXmaURzFKTS2Wit8RqEW', 'Muzammil', 'Rafay', 'muzammil.rafay@gmail.com', '/uploads/users/f270e664-5df3-4e73-ad9b-ef4737002e3c.jpg', 'admin', '$2y$10$iusesomecrazystrings22', null);
INSERT INTO `users` VALUES ('22', 'qiragig', '$2y$10$XYHc/2l/lY4FttAhnlKLze5X1A1ys63lZDdaM.c4HpmvXUwtwEV72', 'tunejof', 'mivafet', 'xulabi@mailinator.com', '/uploads/users/photo1.jpg', 'subscriber', '$2y$10$iusesomecrazystrings22', null);
