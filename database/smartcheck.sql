/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : smartcheck

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-06-08 18:07:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_active_qrcode
-- ----------------------------
DROP TABLE IF EXISTS `tbl_active_qrcode`;
CREATE TABLE `tbl_active_qrcode` (
  `id` int(11) NOT NULL,
  `guid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `serial` int(255) NOT NULL,
  `active_time` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_active_qrcode
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_company
-- ----------------------------
DROP TABLE IF EXISTS `tbl_company`;
CREATE TABLE `tbl_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_tax` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_company
-- ----------------------------
INSERT INTO `tbl_company` VALUES ('1', 'Công ty An Hà', null, 'anha@smartcheck.vn', '0987654321', 'Hà Nội', 'smartcheck.vn', '0123456', 'Giới thiệu công ty', '1', '2018-06-04 16:39:45', '2018-06-04 16:39:45', null);
INSERT INTO `tbl_company` VALUES ('2', 'Công ty Kiến Lửa', null, 'kienlua@example.com', '0987654321', 'Hà Nội', 'kienlua.vn', '02222222', 'kienlua.vn', '1', '2018-06-06 14:22:51', '2018-06-06 14:22:51', null);

-- ----------------------------
-- Table structure for tbl_partner
-- ----------------------------
DROP TABLE IF EXISTS `tbl_partner`;
CREATE TABLE `tbl_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_partner
-- ----------------------------
INSERT INTO `tbl_partner` VALUES ('1', '1', 'Nhà phân phối An Hà', '0987654321', 'Hà Nội', 'pp@smartcheck.vn', null, '1', '2018-06-04 17:06:40', '2018-06-04 17:06:40', null);
INSERT INTO `tbl_partner` VALUES ('2', '1', 'Nhà phân phối An Hà 2', '0987654321', 'HN', 'anha2@gmail.com', null, '1', '2018-06-06 09:47:19', '2018-06-06 09:47:19', null);
INSERT INTO `tbl_partner` VALUES ('3', '1', 'công ty An Hà 2', '0987654321', 'Hà Nội', 'anha2@gmail.com', null, '1', '2018-06-06 13:58:41', '2018-06-06 14:17:56', null);
INSERT INTO `tbl_partner` VALUES ('4', '1', 'Nhà phân phối miền bắc', '0987654321', 'Hà Nội', 'abc@gmail.com', null, '2', '2018-06-06 16:37:43', '2018-06-06 16:37:43', null);

-- ----------------------------
-- Table structure for tbl_partner_qrcode
-- ----------------------------
DROP TABLE IF EXISTS `tbl_partner_qrcode`;
CREATE TABLE `tbl_partner_qrcode` (
  `guid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `partner_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `start` int(255) DEFAULT NULL,
  `end` int(255) DEFAULT NULL,
  `amount` int(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`guid`,`partner_id`,`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_partner_qrcode
-- ----------------------------
INSERT INTO `tbl_partner_qrcode` VALUES ('d6d91adc-9d42-a60f-4838-2c500b910cda', '1', '1', '1', '51', '51', null, null, null, null);

-- ----------------------------
-- Table structure for tbl_product
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `introimage` varchar(255) DEFAULT NULL,
  `date_output` date DEFAULT NULL COMMENT 'ngày sản xuất',
  `protected_time` int(10) DEFAULT NULL COMMENT 'thời gian bảo hành',
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_product
-- ----------------------------
INSERT INTO `tbl_product` VALUES ('1', '1', 'SP001', 'SẢn phẩm chính hãng', 'upload/product/2018/06/05/TSOuQ4kgwuDG1Cenei8t63oZXJeXUCVlRFmA2TgU.jpeg', '2018-06-05', '3', '<p>sản phẩm chính hãng con cá vàng</p>', '1', '2018-06-05 06:05:11', '2018-06-05 06:05:11', null);
INSERT INTO `tbl_product` VALUES ('2', '1', 'SP004', 'Sản phẩm thương hiệu người tiêu dùng', 'upload/product/2018/06/06/5qItShYzY973FDEJzp5ByHKdDd0Ajs9L27LMnlA4.jpeg', '2018-06-06', '1', '<p>Sản phẩm thương hiệu người tiêu dùng</p>', '1', '2018-06-06 13:49:30', '2018-06-06 14:04:28', null);
INSERT INTO `tbl_product` VALUES ('3', '1', 'SP003', 'Sản phẩm thương hiệu thời trang', 'upload/product/2018/06/06/o71f16MQLKsAkzGFQabvLtCERn3z7wq9PPgnty0T.jpeg', '2018-06-07', '3', '<p>Sản phẩm thương hiệu thời trang</p>', '1', '2018-06-06 13:56:25', '2018-06-06 14:04:06', null);
INSERT INTO `tbl_product` VALUES ('4', '1', 'SP002', 'Sản phẩm thương hiệu mới', 'upload/product/2018/06/06/nrjXpXrSTNYIN4cwShYicAo3gfdMtZ6pBdxZI5cb.jpeg', '2018-06-09', '3', '<p>Sản phẩm thương hiệu mới</p>', '1', '2018-06-06 13:57:14', '2018-06-06 14:03:41', null);
INSERT INTO `tbl_product` VALUES ('5', '1', 'SP005', 'Sản phẩm siêu lợi nhuận', 'upload/product/2018/06/06/3lRHvwFg7e4ixX0PhFBYm34nuWlT5v3jW7TfLZuH.jpeg', '2018-06-06', '2', '<p>Sản phẩm siêu lợi nhuận<br></p>', '2', '2018-06-06 16:39:43', '2018-06-06 16:39:43', null);

-- ----------------------------
-- Table structure for tbl_product_qrcode
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_qrcode`;
CREATE TABLE `tbl_product_qrcode` (
  `guid` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `start` int(255) DEFAULT NULL,
  `end` int(255) DEFAULT NULL,
  `amount` int(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`guid`,`product_id`,`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_product_qrcode
-- ----------------------------
INSERT INTO `tbl_product_qrcode` VALUES ('d6d91adc-9d42-a60f-4838-2c500b910cda', '1', '1', '1', '30', '30', null, null, null, null);
INSERT INTO `tbl_product_qrcode` VALUES ('d6d91adc-9d42-a60f-4838-2c500b910cda', '2', '1', '31', '45', '15', null, null, null, null);
INSERT INTO `tbl_product_qrcode` VALUES ('d6d91adc-9d42-a60f-4838-2c500b910cda', '3', '1', '46', '70', '25', null, null, null, null);
INSERT INTO `tbl_product_qrcode` VALUES ('d6d91adc-9d42-a60f-4838-2c500b910cda', '4', '1', '71', '100', '30', null, null, null, null);

-- ----------------------------
-- Table structure for tbl_qrcode
-- ----------------------------
DROP TABLE IF EXISTS `tbl_qrcode`;
CREATE TABLE `tbl_qrcode` (
  `guid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `start` int(255) DEFAULT NULL,
  `end` int(255) DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`guid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_qrcode
-- ----------------------------
INSERT INTO `tbl_qrcode` VALUES ('d6d91adc-9d42-a60f-4838-2c500b910cda', '1', '1', '100', null, '1', '2018-06-05 10:04:01', '2018-06-05 10:04:01', null);

-- ----------------------------
-- Table structure for tbl_users
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `introimage` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', 'admin@smartcheck.vn', '$2y$10$UWRvFt8OHEyH3DolmFCwHefs8q3dOhAkJNi2qJ5Ys5uMjhhvcii0m', null, 'Admin', null, null, 'Vu1RU2J25pX42NR7ooTm0N1cmfLYUvILICzV2ksA3XBUBXDQM8ETNID5FG0X', '1', null, '1', '2018-05-31 16:46:08', '2018-05-31 16:46:15', null);
INSERT INTO `tbl_users` VALUES ('2', 'doanhnghiep@smartcheck.vn', '$2y$10$UWRvFt8OHEyH3DolmFCwHefs8q3dOhAkJNi2qJ5Ys5uMjhhvcii0m', null, 'Doanh nghiệp', null, null, '1apng6ssOoFTZwqQq02iYpF8wPejr1rEYdV2m7DBaObyG2dhCtkskiWkBuxM', '2', '1', '1', '2018-06-05 17:59:10', '2018-06-05 17:59:15', null);

-- ----------------------------
-- Table structure for tbl_user_company
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_company`;
CREATE TABLE `tbl_user_company` (
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user_company
-- ----------------------------
INSERT INTO `tbl_user_company` VALUES ('2', '1');
