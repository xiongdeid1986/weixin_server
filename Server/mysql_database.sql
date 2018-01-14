-- --------------------------------------------------------
-- Host:                         www.ddweb.com.cn
-- Server version:               10.1.29-MariaDB - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for admin_develop
CREATE DATABASE IF NOT EXISTS `admin_develop` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `admin_develop`;

-- Dumping structure for table admin_develop.ddweb_clients_user
CREATE TABLE IF NOT EXISTS `ddweb_clients_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `whmcs_tkval` varchar(32) NOT NULL COMMENT 'whmcs_tkval',
  `whmcs_uid` int(11) NOT NULL COMMENT 'whmcs用户ID',
  `u_web_user` int(11) DEFAULT NULL COMMENT '用户id',
  `u_token` varchar(64) DEFAULT NULL COMMENT 'api token',
  `u_api_use_count` varchar(255) DEFAULT NULL COMMENT 'api使用记录',
  `u_api_consume` double DEFAULT NULL COMMENT 'api消费统计',
  `u_time` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '用户创建时间',
  `token` varchar(64) DEFAULT NULL COMMENT 'API令牌',
  `scope` int(2) DEFAULT '16' COMMENT '权限',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='create table ddweb_clients_weixin (\r\n	`id` int(11) NOT NULL AUTO_INCREMENT,\r\n	`u_id` int(11) NOT NULL COMMENT ''关联用户ID'',\r\n	`app_id` varchar(32) NOT NULL COMMENT ''开发者ID(AppID)'',\r\n	`app_secret` varchar(64) NOT NULL COMMENT ''开发者密码'',\r\n	`token` varchar(128) NOT NULL COMMENT ''令牌(Token)'',\r\n	`encoding_aes_key` varchar(80) NOT NULL COMMENT "消息加密密钥(EncodingAESKey)",\r\n	`encryption_decrypt` int(2) default ''0'' COMMENT "消息加解密方式",\r\n	`time` int(11) default ''0'' COMMENT "创建时间",\r\n	PRIMARY KEY (`id`)\r\n)';

-- Dumping data for table admin_develop.ddweb_clients_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `ddweb_clients_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `ddweb_clients_user` ENABLE KEYS */;

-- Dumping structure for table admin_develop.ddweb_clients_weixin
CREATE TABLE IF NOT EXISTS `ddweb_clients_weixin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL COMMENT '关联用户ID',
  `app_id` varchar(32) NOT NULL COMMENT '开发者ID(AppID)',
  `app_secret` varchar(64) NOT NULL COMMENT '开发者密码',
  `token` varchar(128) NOT NULL COMMENT '令牌(Token)',
  `encoding_aes_key` varchar(80) NOT NULL COMMENT '消息加密密钥(EncodingAESKey)',
  `encryption_decrypt` int(2) DEFAULT '0' COMMENT '消息加解密方式',
  `time` int(11) DEFAULT '0' COMMENT '创建时间',
  `openid` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table admin_develop.ddweb_clients_weixin: ~2 rows (approximately)
/*!40000 ALTER TABLE `ddweb_clients_weixin` DISABLE KEYS */;
REPLACE INTO `ddweb_clients_weixin` (`id`, `u_id`, `app_id`, `app_secret`, `token`, `encoding_aes_key`, `encryption_decrypt`, `time`, `openid`) VALUES
	(1, 1, 'wxade94928ff9602e5', '5ccb71c72d5669c633b2216cc70dddd4', 'ddwebtoken', '11', 0, 0, NULL),
	(2, 2, 'wx13746b04c2c0eedd', '1ac2a2ef82e8322faa09eba659ec59f4', 'ddwebdsto', '11', 0, 0, NULL);
/*!40000 ALTER TABLE `ddweb_clients_weixin` ENABLE KEYS */;

-- Dumping structure for table admin_develop.ddweb_customization_weixin_group_hidden_like
CREATE TABLE IF NOT EXISTS `ddweb_customization_weixin_group_hidden_like` (
  `uid` int(11) unsigned NOT NULL,
  `toid` int(11) unsigned DEFAULT NULL,
  `gid` int(11) unsigned NOT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `type` int(1) DEFAULT '0',
  `u_id` int(11) unsigned DEFAULT NULL,
  KEY `wxgroupid` (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='定制开发的微信群暗恋';

-- Dumping data for table admin_develop.ddweb_customization_weixin_group_hidden_like: ~16 rows (approximately)
/*!40000 ALTER TABLE `ddweb_customization_weixin_group_hidden_like` DISABLE KEYS */;
REPLACE INTO `ddweb_customization_weixin_group_hidden_like` (`uid`, `toid`, `gid`, `time`, `type`, `u_id`) VALUES
	(6, 5, 30, '2018-01-14 21:35:00', 0, NULL),
	(5, 4, 30, '2018-01-14 21:35:32', 0, NULL),
	(5, 6, 30, '2018-01-14 21:35:45', 0, NULL),
	(4, 5, 30, '2018-01-14 21:58:41', 0, NULL),
	(6, 4, 30, '2018-01-14 22:00:11', 0, NULL),
	(4, 5, 37, '2018-01-14 22:52:32', 0, NULL),
	(4, 6, 37, '2018-01-14 23:30:55', 0, NULL),
	(7, 6, 30, '2018-01-15 01:23:44', 0, NULL),
	(7, 6, 32, '2018-01-15 01:25:24', 0, NULL),
	(6, 5, 37, '2018-01-15 01:56:28', 0, NULL),
	(5, 7, 29, '2018-01-15 02:40:58', 0, NULL),
	(5, 6, 38, '2018-01-15 02:42:20', 0, NULL),
	(4, 7, 30, '2018-01-15 02:42:50', 0, NULL),
	(5, 7, 32, '2018-01-15 02:44:13', 0, NULL),
	(5, 6, 32, '2018-01-15 02:44:21', 0, NULL),
	(5, 7, 30, '2018-01-15 02:47:20', 0, NULL);
/*!40000 ALTER TABLE `ddweb_customization_weixin_group_hidden_like` ENABLE KEYS */;

-- Dumping structure for table admin_develop.ddweb_customization_weixin_group_hidden_like_config
CREATE TABLE IF NOT EXISTS `ddweb_customization_weixin_group_hidden_like_config` (
  `u_id` int(11) unsigned NOT NULL,
  `name` varchar(120) NOT NULL,
  `to_url` varchar(120) NOT NULL,
  `user` varchar(30) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='配置文件';

-- Dumping data for table admin_develop.ddweb_customization_weixin_group_hidden_like_config: ~0 rows (approximately)
/*!40000 ALTER TABLE `ddweb_customization_weixin_group_hidden_like_config` DISABLE KEYS */;
REPLACE INTO `ddweb_customization_weixin_group_hidden_like_config` (`u_id`, `name`, `to_url`, `user`, `pwd`) VALUES
	(2, '暗恋之星', 'https://www.ddweb.com.cn', 'admin', '123456');
/*!40000 ALTER TABLE `ddweb_customization_weixin_group_hidden_like_config` ENABLE KEYS */;

-- Dumping structure for table admin_develop.ddweb_group_weixin
CREATE TABLE IF NOT EXISTS `ddweb_group_weixin` (
  `gid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `u_id` int(11) unsigned DEFAULT NULL,
  KEY `gid` (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.ddweb_group_weixin: ~25 rows (approximately)
/*!40000 ALTER TABLE `ddweb_group_weixin` DISABLE KEYS */;
REPLACE INTO `ddweb_group_weixin` (`gid`, `uid`, `time`, `u_id`) VALUES
	(28, 4, '2018-01-14 12:19:07', NULL),
	(30, 4, '2018-01-14 20:27:54', NULL),
	(30, 5, '2018-01-14 21:30:43', NULL),
	(30, 6, '2018-01-14 21:34:36', NULL),
	(32, 6, '2018-01-14 22:01:27', NULL),
	(33, 4, '2018-01-14 22:30:42', NULL),
	(34, 4, '2018-01-14 22:36:30', NULL),
	(35, 4, '2018-01-14 22:36:38', NULL),
	(36, 4, '2018-01-14 22:37:01', NULL),
	(31, 4, '2018-01-14 22:37:47', NULL),
	(37, 6, '2018-01-14 22:39:59', NULL),
	(37, 4, '2018-01-14 22:50:34', NULL),
	(37, 5, '2018-01-14 22:51:39', NULL),
	(30, 7, '2018-01-15 01:23:23', NULL),
	(32, 7, '2018-01-15 01:24:00', NULL),
	(32, 5, '2018-01-15 01:46:22', NULL),
	(29, 7, '2018-01-15 01:52:27', NULL),
	(29, 5, '2018-01-15 01:55:27', NULL),
	(38, 6, '2018-01-15 01:57:34', NULL),
	(39, 4, '2018-01-15 01:58:58', NULL),
	(40, 4, '2018-01-15 02:02:14', NULL),
	(41, 4, '2018-01-15 02:11:54', NULL),
	(42, 4, '2018-01-15 02:13:13', NULL),
	(43, 4, '2018-01-15 02:35:22', NULL),
	(38, 5, '2018-01-15 02:40:37', NULL);
/*!40000 ALTER TABLE `ddweb_group_weixin` ENABLE KEYS */;

-- Dumping structure for table admin_develop.ddweb_user_weixins
CREATE TABLE IF NOT EXISTS `ddweb_user_weixins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `openId` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '微信ID',
  `nickName` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '昵称',
  `gender` int(1) DEFAULT NULL COMMENT '性别',
  `language` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '语言',
  `city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '城市',
  `province` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '省份',
  `country` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '国家',
  `avatarUrl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '头像',
  `time` timestamp NULL DEFAULT NULL COMMENT '时间',
  `extend` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table admin_develop.ddweb_user_weixins: ~4 rows (approximately)
/*!40000 ALTER TABLE `ddweb_user_weixins` DISABLE KEYS */;
REPLACE INTO `ddweb_user_weixins` (`id`, `openId`, `nickName`, `gender`, `language`, `city`, `province`, `country`, `avatarUrl`, `time`, `extend`, `u_id`) VALUES
	(4, 'o96Mm0ePW5OhLLiNRdWNohfyutg8', '蓦然回首', 1, 'en', 'Guiyang', 'Guizhou', 'China', 'https://wx.qlogo.cn/mmopen/vi_32/iaDiarhUgrr739Fw9YgrLogYOuCVjU2yppq7HM9QiaDTweA9KWuXep0LytUOibRYWM31uGzltm7d1M86bQucUibuDog/0', '2018-01-14 12:26:44', NULL, 2),
	(5, 'o96Mm0SMf_Z965PUQsogvoVnFrZs', '《推理笔记》', 2, 'zh_CN', 'Nanjing', 'Jiangsu', 'China', 'https://wx.qlogo.cn/mmopen/vi_32/HlrvJC0YiczoOibGfs2YRLfQnPXxw2KwQBvnEdOpMDfb7rJr5XSrtSF1E9OVO67AZHL2FbqQ9icala7212VwYplow/0', '2018-01-14 19:32:54', NULL, 2),
	(6, 'o96Mm0R2hnf9gaymQTHnz38qBa2o', '闯江湖', 0, 'zh_CN', '', '', '', 'https://wx.qlogo.cn/mmopen/vi_32/SnicDUPmqpsriaDRvh8loT7oxV4bneUhQ2zsuX5DNmQO2SicicohvRJ9IuwXcJadliaOHCpD3jpqOI8zHdcvCu4GAwg/0', '2018-01-14 21:34:00', NULL, 2),
	(7, 'o96Mm0XPE4Lnp1HsgNHzv-N_SEUw', '奇迹就在身边', 1, 'zh_CN', 'Pudong New District', 'Shanghai', 'China', 'https://wx.qlogo.cn/mmopen/vi_32/DVYaj1yyicAZvt2gSDChoHV9DyNLL30ybZbr2lejJ1qTelnMpiamJajEQQtgUcGeomAxicP8roj0hBGv5aHoEl7Cg/0', '2018-01-14 21:53:56', NULL, 2);
/*!40000 ALTER TABLE `ddweb_user_weixins` ENABLE KEYS */;

-- Dumping structure for table admin_develop.ddweb_user_wxgroups
CREATE TABLE IF NOT EXISTS `ddweb_user_wxgroups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `openGId` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户微信群';

-- Dumping data for table admin_develop.ddweb_user_wxgroups: ~16 rows (approximately)
/*!40000 ALTER TABLE `ddweb_user_wxgroups` DISABLE KEYS */;
REPLACE INTO `ddweb_user_wxgroups` (`id`, `openGId`, `u_id`) VALUES
	(28, 'G96Mm0X7JyMPnQosXOuJZydRXhlE', NULL),
	(29, 'G96Mm0VAoUdvRKlDR3PjFXmBdCM4', NULL),
	(30, 'G96Mm0T76vwTmsHSoP-Qjh1wLuCQ', NULL),
	(31, 'tG96Mm0b0TZU3uxLGphpyu0rkqmiE', NULL),
	(32, 'G96Mm0eyE6Tjd4h3FH9kbS8KHDEE', NULL),
	(33, 'G96Mm0bdAIm_XsEAV8UTev0gvLtc', NULL),
	(34, 'tG96Mm0ZWR4uHba4teP-XLeRMKpY4', NULL),
	(35, 'tG96Mm0a8QQD30m1v1Wj6jQrLjgAE', NULL),
	(36, 'tG96Mm0fAQFCfMw6UwLLBy2O-78Ns', NULL),
	(37, 'G96Mm0RMdP1VF0-w1thAT6ZWEF-k', NULL),
	(38, 'G96Mm0fJR-m9OGacyXOsnkjNeRJI', NULL),
	(39, 'tG96Mm0Uuo7Pkal1wGI7LhT5Pj-xo', NULL),
	(40, 'tG96Mm0eBym-DPMJyy6TE_o6RsiKI', NULL),
	(41, 'tG96Mm0TeYEJau3fla7GrFpxozJH8', NULL),
	(42, 'tG96Mm0WH_R6uvDSLxcaNdZtnn_KE', NULL),
	(43, 'tG96Mm0b2XzM3jM0_4D1wMz5Wfen0', NULL);
/*!40000 ALTER TABLE `ddweb_user_wxgroups` ENABLE KEYS */;

-- Dumping structure for table admin_develop.ddweb_weixin_group
CREATE TABLE IF NOT EXISTS `ddweb_weixin_group` (
  `uid` int(11) DEFAULT NULL,
  `gid` int(11) unsigned DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `u_id` int(11) unsigned DEFAULT NULL,
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='微及与群的关联表';

-- Dumping data for table admin_develop.ddweb_weixin_group: ~25 rows (approximately)
/*!40000 ALTER TABLE `ddweb_weixin_group` DISABLE KEYS */;
REPLACE INTO `ddweb_weixin_group` (`uid`, `gid`, `time`, `u_id`) VALUES
	(4, 28, '2018-01-14 12:19:07', NULL),
	(4, 30, '2018-01-14 20:27:54', NULL),
	(5, 30, '2018-01-14 21:30:43', NULL),
	(6, 30, '2018-01-14 21:34:36', NULL),
	(6, 32, '2018-01-14 22:01:27', NULL),
	(4, 33, '2018-01-14 22:30:42', NULL),
	(4, 34, '2018-01-14 22:36:30', NULL),
	(4, 35, '2018-01-14 22:36:38', NULL),
	(4, 36, '2018-01-14 22:37:01', NULL),
	(4, 31, '2018-01-14 22:37:47', NULL),
	(6, 37, '2018-01-14 22:39:59', NULL),
	(4, 37, '2018-01-14 22:50:34', NULL),
	(5, 37, '2018-01-14 22:51:39', NULL),
	(7, 30, '2018-01-15 01:23:23', NULL),
	(7, 32, '2018-01-15 01:24:00', NULL),
	(5, 32, '2018-01-15 01:46:22', NULL),
	(7, 29, '2018-01-15 01:52:27', NULL),
	(5, 29, '2018-01-15 01:55:27', NULL),
	(6, 38, '2018-01-15 01:57:34', NULL),
	(4, 39, '2018-01-15 01:58:58', NULL),
	(4, 40, '2018-01-15 02:02:14', NULL),
	(4, 41, '2018-01-15 02:11:54', NULL),
	(4, 42, '2018-01-15 02:13:13', NULL),
	(4, 43, '2018-01-15 02:35:22', NULL),
	(5, 38, '2018-01-15 02:40:37', NULL);
/*!40000 ALTER TABLE `ddweb_weixin_group` ENABLE KEYS */;

-- Dumping structure for table admin_develop.mod_onlinenic
CREATE TABLE IF NOT EXISTS `mod_onlinenic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lockstatus` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `domainid` (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table admin_develop.mod_onlinenic: ~0 rows (approximately)
/*!40000 ALTER TABLE `mod_onlinenic` DISABLE KEYS */;
/*!40000 ALTER TABLE `mod_onlinenic` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblaccounts
CREATE TABLE IF NOT EXISTS `tblaccounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `currency` int(10) NOT NULL,
  `gateway` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `description` text NOT NULL,
  `amountin` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fees` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amountout` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rate` decimal(10,5) NOT NULL DEFAULT '1.00000',
  `transid` text NOT NULL,
  `invoiceid` int(10) NOT NULL DEFAULT '0',
  `refundid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `invoiceid` (`invoiceid`),
  KEY `userid` (`userid`),
  KEY `date` (`date`),
  KEY `transid` (`transid`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblaccounts: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblaccounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblaccounts` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbladdonmodules
CREATE TABLE IF NOT EXISTS `tbladdonmodules` (
  `module` text NOT NULL,
  `setting` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbladdonmodules: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbladdonmodules` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbladdonmodules` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbladdons
CREATE TABLE IF NOT EXISTS `tbladdons` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `packages` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `billingcycle` text NOT NULL,
  `tax` text NOT NULL,
  `showorder` text NOT NULL,
  `downloads` text NOT NULL,
  `autoactivate` text NOT NULL,
  `suspendproduct` text NOT NULL,
  `welcomeemail` int(10) NOT NULL,
  `weight` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbladdons: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbladdons` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbladdons` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbladminlog
CREATE TABLE IF NOT EXISTS `tbladminlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminusername` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `logintime` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `lastvisit` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ipaddress` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `sessionid` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table admin_develop.tbladminlog: ~34 rows (approximately)
/*!40000 ALTER TABLE `tbladminlog` DISABLE KEYS */;
REPLACE INTO `tbladminlog` (`id`, `adminusername`, `logintime`, `lastvisit`, `ipaddress`, `sessionid`) VALUES
	(1, 'admin', '20171225211154', '20171225211154', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(2, 'admin', '20171225211210', '20171225211210', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(3, 'admin', '20171225211215', '20171225211215', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(4, 'admin', '20171225211215', '20171225211215', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(5, 'admin', '20171225211215', '20171225211215', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(6, 'admin', '20171225211216', '20171225211216', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(7, 'admin', '20171225211216', '20171225211216', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(8, 'admin', '20171225211216', '20171225211216', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(9, 'admin', '20171225211241', '20171225211241', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(10, 'admin', '20171225211241', '20171225211241', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(11, 'admin', '20171225211241', '20171225211241', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(12, 'admin', '20171225211241', '20171225211241', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(13, 'admin', '20171225211259', '20171225211259', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(14, 'admin', '20171225211307', '20171225211307', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(15, 'admin', '20171225211336', '20171225211336', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(16, 'admin', '20171225211447', '20171225211447', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(17, 'admin', '20171225211653', '20171225211653', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(18, 'admin', '20171225211759', '20171225211759', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(19, 'admin', '20171225211805', '20171225211805', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(20, 'admin', '20171225211921', '20171225211921', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(21, 'admin', '20171225211937', '20171225211937', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(22, 'admin', '20171225211943', '20171225211943', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(23, 'admin', '20171225211946', '20171225211946', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(24, 'admin', '20171225211948', '20171225211948', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(25, 'admin', '20171225212005', '20171225212005', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(26, 'admin', '20171225212005', '20171225212005', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(27, 'admin', '20171225212007', '20171225212007', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(28, 'admin', '20171225212009', '20171225212009', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(29, 'admin', '20171225212012', '20171225212012', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(30, 'admin', '20171225212020', '20171225212020', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(31, 'admin', '20171225212020', '20171225212020', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(32, 'admin', '20171225212023', '20171225212023', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(33, 'admin', '20171225212033', '20171225212033', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2'),
	(34, 'admin', '20171225212034', '20171225212034', '127.0.0.1', 'atk7sftffkd8oq34g7lap977a2');
/*!40000 ALTER TABLE `tbladminlog` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbladminperms
CREATE TABLE IF NOT EXISTS `tbladminperms` (
  `roleid` int(1) NOT NULL,
  `permid` int(1) NOT NULL,
  KEY `roleid_permid` (`roleid`,`permid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbladminperms: ~213 rows (approximately)
/*!40000 ALTER TABLE `tbladminperms` DISABLE KEYS */;
REPLACE INTO `tbladminperms` (`roleid`, `permid`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 4),
	(1, 5),
	(1, 6),
	(1, 7),
	(1, 8),
	(1, 9),
	(1, 10),
	(1, 11),
	(1, 12),
	(1, 13),
	(1, 14),
	(1, 15),
	(1, 16),
	(1, 17),
	(1, 18),
	(1, 19),
	(1, 20),
	(1, 21),
	(1, 22),
	(1, 23),
	(1, 24),
	(1, 25),
	(1, 26),
	(1, 27),
	(1, 28),
	(1, 29),
	(1, 30),
	(1, 31),
	(1, 32),
	(1, 33),
	(1, 34),
	(1, 35),
	(1, 36),
	(1, 37),
	(1, 38),
	(1, 39),
	(1, 40),
	(1, 41),
	(1, 42),
	(1, 43),
	(1, 44),
	(1, 45),
	(1, 46),
	(1, 47),
	(1, 48),
	(1, 49),
	(1, 50),
	(1, 51),
	(1, 52),
	(1, 53),
	(1, 54),
	(1, 55),
	(1, 56),
	(1, 57),
	(1, 58),
	(1, 59),
	(1, 60),
	(1, 61),
	(1, 62),
	(1, 63),
	(1, 64),
	(1, 65),
	(1, 66),
	(1, 67),
	(1, 68),
	(1, 69),
	(1, 70),
	(1, 71),
	(1, 72),
	(1, 73),
	(1, 74),
	(1, 75),
	(1, 76),
	(1, 77),
	(1, 78),
	(1, 79),
	(1, 80),
	(1, 81),
	(1, 82),
	(1, 83),
	(1, 84),
	(1, 85),
	(1, 86),
	(1, 87),
	(1, 88),
	(1, 89),
	(1, 90),
	(1, 91),
	(1, 92),
	(1, 93),
	(1, 94),
	(1, 95),
	(1, 96),
	(1, 97),
	(1, 98),
	(1, 99),
	(1, 100),
	(1, 101),
	(1, 102),
	(1, 103),
	(1, 104),
	(1, 105),
	(1, 106),
	(1, 107),
	(1, 108),
	(1, 109),
	(1, 110),
	(1, 111),
	(1, 112),
	(1, 113),
	(1, 114),
	(1, 115),
	(1, 116),
	(1, 117),
	(1, 118),
	(1, 119),
	(1, 120),
	(1, 122),
	(1, 123),
	(1, 124),
	(1, 125),
	(1, 125),
	(1, 126),
	(1, 126),
	(1, 127),
	(1, 128),
	(1, 129),
	(2, 1),
	(2, 2),
	(2, 3),
	(2, 4),
	(2, 5),
	(2, 6),
	(2, 7),
	(2, 8),
	(2, 9),
	(2, 10),
	(2, 11),
	(2, 12),
	(2, 13),
	(2, 14),
	(2, 15),
	(2, 16),
	(2, 17),
	(2, 18),
	(2, 19),
	(2, 20),
	(2, 21),
	(2, 22),
	(2, 23),
	(2, 24),
	(2, 25),
	(2, 26),
	(2, 27),
	(2, 28),
	(2, 29),
	(2, 30),
	(2, 31),
	(2, 32),
	(2, 33),
	(2, 34),
	(2, 35),
	(2, 36),
	(2, 37),
	(2, 38),
	(2, 39),
	(2, 40),
	(2, 41),
	(2, 42),
	(2, 43),
	(2, 44),
	(2, 45),
	(2, 46),
	(2, 47),
	(2, 48),
	(2, 49),
	(2, 50),
	(2, 51),
	(2, 52),
	(2, 71),
	(2, 73),
	(2, 85),
	(2, 98),
	(2, 99),
	(2, 101),
	(2, 104),
	(2, 105),
	(2, 110),
	(2, 120),
	(2, 123),
	(2, 124),
	(2, 125),
	(2, 125),
	(2, 126),
	(2, 126),
	(2, 128),
	(2, 129),
	(3, 38),
	(3, 39),
	(3, 40),
	(3, 41),
	(3, 42),
	(3, 43),
	(3, 44),
	(3, 50),
	(3, 105),
	(3, 125),
	(3, 125),
	(3, 126),
	(3, 128);
/*!40000 ALTER TABLE `tbladminperms` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbladminroles
CREATE TABLE IF NOT EXISTS `tbladminroles` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `widgets` text NOT NULL,
  `systememails` int(1) NOT NULL,
  `accountemails` int(1) NOT NULL,
  `supportemails` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbladminroles: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbladminroles` DISABLE KEYS */;
REPLACE INTO `tbladminroles` (`id`, `name`, `widgets`, `systememails`, `accountemails`, `supportemails`) VALUES
	(1, 'Full Administrator', 'activity_log,getting_started,income_forecast,income_overview,my_notes,network_status,open_invoices,orders_overview,paypal_addon,admin_activity,client_activity,system_overview,todo_list,whmcs_news,supporttickets_overview,calendar', 1, 1, 1),
	(2, 'Sales Operator', 'activity_log,getting_started,income_forecast,income_overview,my_notes,network_status,open_invoices,orders_overview,paypal_addon,client_activity,todo_list,whmcs_news,supporttickets_overview,calendar', 0, 1, 1),
	(3, 'Support Operator', 'activity_log,getting_started,my_notes,todo_list,whmcs_news,supporttickets_overview,calendar', 0, 0, 1);
/*!40000 ALTER TABLE `tbladminroles` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbladmins
CREATE TABLE IF NOT EXISTS `tbladmins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `roleid` int(1) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `passwordhash` varchar(255) NOT NULL DEFAULT '',
  `authmodule` text NOT NULL,
  `authdata` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `signature` text NOT NULL,
  `notes` text NOT NULL,
  `template` text NOT NULL,
  `language` text NOT NULL,
  `disabled` int(1) NOT NULL,
  `loginattempts` int(1) NOT NULL,
  `supportdepts` text NOT NULL,
  `ticketnotifications` text NOT NULL,
  `homewidgets` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbladmins: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbladmins` DISABLE KEYS */;
REPLACE INTO `tbladmins` (`id`, `roleid`, `username`, `password`, `passwordhash`, `authmodule`, `authdata`, `firstname`, `lastname`, `email`, `signature`, `notes`, `template`, `language`, `disabled`, `loginattempts`, `supportdepts`, `ticketnotifications`, `homewidgets`) VALUES
	(1, 1, 'admin', '$2y$10$KsCKUGKdaFPEfuR7qSzRnuQELMbPJtrPmFmUwm9dJmV8/17MylrOS', '$2y$10$FryNkZqGkqo.rK3do9BiHePoz60RiIWfyfuiHZk5kNv89JIRmtXY6', '', '', '狼', '雪', 'ddweb@ddweb.com.cn', '', 'Welcome to WHMCS!  Please ensure you have setup the cron job to automate tasks', 'blend', 'chinese', 0, 0, ',', '', 'getting_started:true,orders_overview:true,supporttickets_overview:true,my_notes:true,client_activity:true,open_invoices:true,activity_log:true|income_overview:true,system_overview:true,whmcs_news:true,sysinfo:true,admin_activity:true,todo_list:true,network_status:true,income_forecast:true|');
/*!40000 ALTER TABLE `tbladmins` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbladminsecurityquestions
CREATE TABLE IF NOT EXISTS `tbladminsecurityquestions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbladminsecurityquestions: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbladminsecurityquestions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbladminsecurityquestions` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblaffiliates
CREATE TABLE IF NOT EXISTS `tblaffiliates` (
  `id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `clientid` int(10) NOT NULL,
  `visitors` int(1) NOT NULL,
  `paytype` text NOT NULL,
  `payamount` decimal(10,2) NOT NULL,
  `onetime` int(1) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `withdrawn` decimal(10,2) NOT NULL DEFAULT '0.00',
  KEY `affiliateid` (`id`),
  KEY `clientid` (`clientid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblaffiliates: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblaffiliates` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblaffiliates` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblaffiliateshistory
CREATE TABLE IF NOT EXISTS `tblaffiliateshistory` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `affiliateid` int(10) NOT NULL,
  `date` date NOT NULL,
  `affaccid` int(10) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `affiliateid` (`affiliateid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblaffiliateshistory: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblaffiliateshistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblaffiliateshistory` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblaffiliatespending
CREATE TABLE IF NOT EXISTS `tblaffiliatespending` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `affaccid` int(10) NOT NULL DEFAULT '0',
  `amount` decimal(10,2) NOT NULL,
  `clearingdate` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clearingdate` (`clearingdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblaffiliatespending: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblaffiliatespending` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblaffiliatespending` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblaffiliateswithdrawals
CREATE TABLE IF NOT EXISTS `tblaffiliateswithdrawals` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `affiliateid` int(10) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `affiliateid` (`affiliateid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table admin_develop.tblaffiliateswithdrawals: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblaffiliateswithdrawals` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblaffiliateswithdrawals` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblannouncements
CREATE TABLE IF NOT EXISTS `tblannouncements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `title` text NOT NULL,
  `announcement` text NOT NULL,
  `published` text NOT NULL,
  `parentid` int(10) NOT NULL,
  `language` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblannouncements: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblannouncements` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblannouncements` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblbannedemails
CREATE TABLE IF NOT EXISTS `tblbannedemails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `domain` text NOT NULL,
  `count` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `domain` (`domain`(64))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblbannedemails: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblbannedemails` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbannedemails` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblbannedips
CREATE TABLE IF NOT EXISTS `tblbannedips` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `reason` text NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblbannedips: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblbannedips` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbannedips` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblbillableitems
CREATE TABLE IF NOT EXISTS `tblbillableitems` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `description` text NOT NULL,
  `hours` decimal(5,1) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `recur` int(5) NOT NULL DEFAULT '0',
  `recurcycle` text NOT NULL,
  `recurfor` int(5) NOT NULL DEFAULT '0',
  `invoiceaction` int(1) NOT NULL,
  `duedate` date NOT NULL,
  `invoicecount` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblbillableitems: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblbillableitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbillableitems` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblbrowserlinks
CREATE TABLE IF NOT EXISTS `tblbrowserlinks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblbrowserlinks: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblbrowserlinks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbrowserlinks` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblbundles
CREATE TABLE IF NOT EXISTS `tblbundles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `validfrom` date NOT NULL,
  `validuntil` date NOT NULL,
  `uses` int(4) NOT NULL,
  `maxuses` int(4) NOT NULL,
  `itemdata` text NOT NULL,
  `allowpromo` int(1) NOT NULL,
  `showgroup` int(1) NOT NULL,
  `gid` int(10) NOT NULL,
  `description` text NOT NULL,
  `displayprice` decimal(10,2) NOT NULL,
  `sortorder` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblbundles: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblbundles` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbundles` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblcalendar
CREATE TABLE IF NOT EXISTS `tblcalendar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `desc` text NOT NULL,
  `start` int(10) NOT NULL,
  `end` int(10) NOT NULL,
  `allday` int(1) NOT NULL,
  `adminid` int(10) NOT NULL,
  `recurid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblcalendar: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblcalendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcalendar` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblclientgroups
CREATE TABLE IF NOT EXISTS `tblclientgroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(45) NOT NULL,
  `groupcolour` varchar(45) DEFAULT NULL,
  `discountpercent` decimal(10,2) unsigned DEFAULT '0.00',
  `susptermexempt` text,
  `separateinvoices` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblclientgroups: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblclientgroups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblclientgroups` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblclients
CREATE TABLE IF NOT EXISTS `tblclients` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `companyname` text NOT NULL,
  `email` text NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `postcode` text NOT NULL,
  `country` text NOT NULL,
  `phonenumber` text NOT NULL,
  `password` text NOT NULL,
  `authmodule` text NOT NULL,
  `authdata` text NOT NULL,
  `currency` int(10) NOT NULL,
  `defaultgateway` text NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `taxexempt` text NOT NULL,
  `latefeeoveride` text NOT NULL,
  `overideduenotices` text NOT NULL,
  `separateinvoices` text NOT NULL,
  `disableautocc` text NOT NULL,
  `datecreated` date NOT NULL,
  `notes` text NOT NULL,
  `billingcid` int(10) NOT NULL,
  `securityqid` int(10) NOT NULL,
  `securityqans` text NOT NULL,
  `groupid` int(10) NOT NULL,
  `cardtype` varchar(255) NOT NULL DEFAULT '',
  `cardlastfour` text NOT NULL,
  `cardnum` blob NOT NULL,
  `startdate` blob NOT NULL,
  `expdate` blob NOT NULL,
  `issuenumber` blob NOT NULL,
  `bankname` text NOT NULL,
  `banktype` text NOT NULL,
  `bankcode` blob NOT NULL,
  `bankacct` blob NOT NULL,
  `gatewayid` text NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `ip` text NOT NULL,
  `host` text NOT NULL,
  `status` enum('Active','Inactive','Closed') NOT NULL DEFAULT 'Active',
  `language` text NOT NULL,
  `pwresetkey` text NOT NULL,
  `pwresetexpiry` int(10) NOT NULL,
  `emailoptout` int(1) NOT NULL,
  `overrideautoclose` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `firstname_lastname` (`firstname`(32),`lastname`(32)),
  KEY `email` (`email`(64))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblclients: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblclients` DISABLE KEYS */;
REPLACE INTO `tblclients` (`id`, `firstname`, `lastname`, `companyname`, `email`, `address1`, `address2`, `city`, `state`, `postcode`, `country`, `phonenumber`, `password`, `authmodule`, `authdata`, `currency`, `defaultgateway`, `credit`, `taxexempt`, `latefeeoveride`, `overideduenotices`, `separateinvoices`, `disableautocc`, `datecreated`, `notes`, `billingcid`, `securityqid`, `securityqans`, `groupid`, `cardtype`, `cardlastfour`, `cardnum`, `startdate`, `expdate`, `issuenumber`, `bankname`, `banktype`, `bankcode`, `bankacct`, `gatewayid`, `lastlogin`, `ip`, `host`, `status`, `language`, `pwresetkey`, `pwresetexpiry`, `emailoptout`, `overrideautoclose`) VALUES
	(2, '银灿', '熊', '贵州动点世纪科技有限公司', 'xiongdeid1986@gmail.com', '花果园街道', '', '贵阳市', '贵州省', '522000', 'CN', '', 'ab124e0b097780e2fc835761e5c73591:Wfc(N', '', '', 1, '', 0.00, '', '', '', '', '', '2017-12-25', '', 0, 0, 'dt/w9BnnVE9ZyaZI2KBNlIbos9U=', 0, '', '', _binary '', _binary '', _binary '', _binary '', '', '', _binary '', _binary '', '', '2017-12-29 15:37:47', '127.0.0.1', 'activate.adobe.com', 'Active', '', '', 0, 0, 0);
/*!40000 ALTER TABLE `tblclients` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblclientsfiles
CREATE TABLE IF NOT EXISTS `tblclientsfiles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `title` text NOT NULL,
  `filename` text NOT NULL,
  `adminonly` int(1) NOT NULL,
  `dateadded` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblclientsfiles: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblclientsfiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblclientsfiles` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblconfiguration
CREATE TABLE IF NOT EXISTS `tblconfiguration` (
  `setting` text NOT NULL,
  `value` text NOT NULL,
  KEY `setting` (`setting`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblconfiguration: ~223 rows (approximately)
/*!40000 ALTER TABLE `tblconfiguration` DISABLE KEYS */;
REPLACE INTO `tblconfiguration` (`setting`, `value`) VALUES
	('Language', 'english'),
	('CompanyName', '贵州动点世纪科技有限公司'),
	('Email', 'ddweb@ddweb.com.cn'),
	('Domain', 'http://www.ddweb.com.cn/'),
	('LogoURL', ''),
	('SystemURL', 'http://cloud.ddweb.com.cn/'),
	('SystemSSLURL', ''),
	('AutoSuspension', 'on'),
	('AutoSuspensionDays', '5'),
	('CreateInvoiceDaysBefore', '14'),
	('AffiliateEnabled', ''),
	('AffiliateEarningPercent', '0'),
	('AffiliateBonusDeposit', '0.00'),
	('AffiliatePayout', '0.00'),
	('AffiliateLinks', ''),
	('ActivityLimit', '1000'),
	('DateFormat', 'DD/MM/YYYY'),
	('PreSalesQuestions', ''),
	('Template', 'webhoster'),
	('AllowRegister', 'on'),
	('AllowTransfer', 'on'),
	('AllowOwnDomain', 'on'),
	('EnableTOSAccept', ''),
	('TermsOfService', ''),
	('AllowLanguageChange', 'on'),
	('Version', '5.3.14-release.1'),
	('AllowCustomerChangeInvoiceGateway', 'on'),
	('DefaultNameserver1', 'ns1.yourdomain.com'),
	('DefaultNameserver2', 'ns2.yourdomain.com'),
	('SendInvoiceReminderDays', '7'),
	('SendReminder', 'on'),
	('NumRecordstoDisplay', '50'),
	('BCCMessages', ''),
	('MailType', 'mail'),
	('SMTPHost', ''),
	('SMTPUsername', ''),
	('SMTPPassword', ''),
	('SMTPPort', '25'),
	('ShowCancellationButton', 'on'),
	('UpdateStatsAuto', 'on'),
	('InvoicePayTo', 'Address goes here...'),
	('SendAffiliateReportMonthly', 'on'),
	('InvalidLoginBanLength', '0'),
	('Signature', 'Signature goes here...'),
	('DomainOnlyOrderEnabled', 'on'),
	('TicketBannedAddresses', ''),
	('SendEmailNotificationonUserDetailsChange', 'on'),
	('TicketAllowedFileTypes', '.jpg,.gif,.jpeg,.png'),
	('CloseInactiveTickets', '0'),
	('InvoiceLateFeeAmount', '10.00'),
	('AutoTermination', ''),
	('AutoTerminationDays', '30'),
	('RegistrarAdminFirstName', ''),
	('RegistrarAdminLastName', ''),
	('RegistrarAdminCompanyName', ''),
	('RegistrarAdminAddress1', ''),
	('RegistrarAdminAddress2', ''),
	('RegistrarAdminCity', ''),
	('RegistrarAdminStateProvince', ''),
	('RegistrarAdminCountry', 'CN'),
	('RegistrarAdminPostalCode', ''),
	('RegistrarAdminPhone', ''),
	('RegistrarAdminFax', ''),
	('RegistrarAdminEmailAddress', ''),
	('RegistrarAdminUseClientDetails', 'on'),
	('Charset', 'utf-8'),
	('AutoUnsuspend', 'on'),
	('RunScriptonCheckOut', ''),
	('License', 'YzI3NTExZGFjY2EzNjk2MWM5ZDdlODg3ZmNhOGM5ZmM5NzA3MTNjYWlvak42TTNPaXdXWTI5V2JsSkZJ\nbjVXYWs1V1l5SmtJNllUTTZNM09pVVdiaDVtSTZRak96dG5PeW9UWTdFak9wMTNPaVVtZHBSM1lCSmlP\nMm96YzdJeWMxUlhZME5uSTZZak96dGpJeE1UTHlFVEw0RURNeUlpT3dFak96dGpJbFJYWWtWV2RrUkhl\nbDVtSTZFVE02TTNPaUFIY0JCQ1pwOW1jazVXUWlvVE14b3pjN0lTWnRGbWJpb0RONk0zZTZNak9odERN\nNmsyZTZrak9odGpJejUyYmtSV1lpb2pONk0zT2l3V1lRVjJjdVYyWXB4VVB5Vkdic1YyY2xKbEk2a1RN\nNk0zT2lNSFpzVldhbTEyYjBOWGRqSmlPeUVqT3oxM09pVW1kcFIzWUJKaU8yb3pjN0lDYmhaM2J0Vm1V\nZ2NtYnBSbWJoSm5RaW9qTnhvemM3cFRNNkUyT2lNbmJ2bEdkdzkyWnBabWJ2Tm1JNk1UTTZNWGY3SUNa\nMTlHYmp4bGJqNVNidk5tTGlWMmRrUm1McEJYWWNSM2J2SjNYM2QzZGNwRFJpb0ROem96YzdBak9wdG5P\neG9UWTdJeWN5bEdaa2xHYmhabkk2a2pPejEzT2lFakx3NENNdWNqTXhJaU81b3pjN0FqT3B0bk94b1RZ\nN0l5Y3dsR1pweFdZMkppTzRvemM5dGpJdU5tTHQ5Mll1SVdaM1JHWnVrR2NoNXlkM2RuSTZBak02TTNP\neG9UYTdJaWJqNVNidk5tTGlWMmRrUm1McEJYWWlvak54b3pjN0FqT3B0bk95b1RZN0l5Y3VsV1l0OUda\na2xHYmhabkk2SVRNNk0zT2lVV2JwUkZJbDUyVGlvRE82TTNPaVVHYmpsM1luNVdhc3hXYWlKaU95RWpP\nenRqSXlWbWRsNWtJNlVqT3p0aklsUlhZa1ZXZGtSSGVsNW1JNkVUTTZNM09pRXpNdElUTXRrRE13SWpJ\nNkFUTTZNM09pVUdkaFIyWmxKbkk2Y2pPenRUTTZJMk9pTTNjbE4yWWhSbmN2QkhjMU5uSTZNVE02TTNP\nd29qWTdJeWNsUlhZa0JYZHpWbWNwVlhjbEpuSTZVVE02TTNPaWNtYnBSbWJoSm5RZzhtVGdVMmN1VjJZ\ncHhFSWtWbWIzOWtJNlVqTTZNM09pVVdiaDVHZGpWSFp2SkhjaW9UTXhvemM3SVNOaW9UTTZNM09pUVdh\nME5XZGs5bWN3SmlPNW96YzdJQ3VQV09yRldPa1ptZWljYU9nS2Fla25ldXE2ZXVsNFNldUNlT3FLV3Vu\nM1dldDBpdUk2WXpNNk0zT2lVV2JoNUdabEpYWjBOWGFuVm1jaW9ETnhvemM3SVNaMmxHZGpGa0k2WWpP\nenRqSXpWSGRoUjNjaW9qTjZNM09pa1hackJTWno1V1pqbEdiZ3dHYmhSM2N1bGtJNmtUTTZNM09pa1ha\nckppT3pvemM3cERPeG9UWWFmY2E3ZDViNGJiNzJhZjUxNTI1ZjJlNmJiZGVmNjQ2OTI1ZDg3OTE9MDNP\naWtqTXlFek54QWpNaW9ETzZNM09pVUdkaFIyYWpWR2FqSmlPNW96YzdJU011VTJjaFZHYmxKWEwwRWpM\nejRTTmlvak54b3pjN0lpYnZsMmN5Vm1kamxHYmlWSGMwTlhaMEZHYmlvVE94b3pjOTEzT2lVbWRwUjNZ\nQkppTzJvemM3SXljMVJYWTBObkk2WWpPenRqSXhNVEx5RVRMNEVETXlJaU93RWpPenRqSWxSWFlrVldk\na1JIZWw1bUk2RVRNNk0zT2lNWFowRkdad1ZGSWs1V1lnUW5jdkJIYzFObEk2a1RNNk0zT2lVV2JoNW1J\nNlFqT3p0bk96b1RZN2dqT3AxM09pVW1kcFIzWUJKaU8yb3pjN0l5YzFSWFkwTm5JNllqT3p0akl4TVRM\neUVUTDRFRE15SWlPd0VqT3p0aklsUlhZa1ZXZGtSSGVsNW1JNkVUTTZNM09pNDJia1JXUWdRbmJsMVda\nbkZtYmgxRUkwTldacTltY1FKaU8wSWpPenRqSWwxV1l1SmlPMG96Yzdwek02RTJPM29UYTl0aklsWlhh\nME5XUWlvak42TTNPaU1YZDBGR2R6SmlPMm96YzdJU016MGlNeDBDT3hBak1pb0RNeG96YzdJU1owRkda\nbFZIWjBoWFp1SmlPeEVqT3p0akl1OVdhMGxHWkZCU1pzbG1ZdjFrSTZRVE02TTNPaVVXYmg1bUk2UWpP\nenRuT3pvVFk3WWpPcDEzT2lVbWRwUjNZQkppTzJvemM3SXljMVJYWTBObkk2WWpPenRqSXhNVEx5RVRM\nNEVETXlJaU93RWpPenRqSWxSWFlrVldka1JIZWw1bUk2RVRNNk0zT2lRWFlvTkVJbFpYYU1KaU81b3pj\nN0lTWnRGbWJpb0RONk0zZTZNak9odFRONmtXZjdJU1oybEdkakZrSTZZak96dGpJelZIZGhSM2Npb2pO\nNk0zT2lFek10SVRNdGdUTXdJakk2QVRNNk0zT2lVR2RoUldaMVJHZDRWbWJpb1RNeG96YzdJaWJ2Ukda\nQkJ5WnVsMmN1VjJZcHhrSTZVVE02TTNPaVVXYmg1bUk2UWpPenRuT3pvVFk3UWpPcDEzT2lVbWRwUjNZ\nQkppTzJvemM3SXljMVJYWTBObkk2WWpPenRqSXhNVEx5RVRMNEVETXlJaU93RWpPenRqSWxSWFlrVldk\na1JIZWw1bUk2RVRNNk0zT2lBSGNCQlNadTlHYVFsbUk2QVRNNk0zT2lVV2JoNW1JNlFqT3p0bk96b1RZ\nN01qT3AxM09pVW1kcFIzWUJKaU8yb3pjN0l5YzFSWFkwTm5JNllqT3p0akl4TVRMeUVUTDRFRE15SWlP\nd0VqT3p0aklsUlhZa1ZXZGtSSGVsNW1JNkVUTTZNM09pNDJia1JXUWdVMlpodDJZaEJGSWx4bVloSlhk\nbmxtWnU5MlFpb2pOeW96YzdJU1p0Rm1iaW9ETjZNM2U2TWpPaHRqTTZrV2Y3SVNaMmxHZGpGa0k2WWpP\nenRqSXpWSGRoUjNjMGMwNGVkODNiNzM2MzgyNDg1NjViMWU2NzEzMmY2NGQzM2NmN2ViOQ=='),
	('OrderFormTemplate', 'modern'),
	('AllowDomainsTwice', 'on'),
	('AddLateFeeDays', '5'),
	('TaxEnabled', ''),
	('DefaultCountry', 'CN'),
	('AutoRedirectoInvoice', 'gateway'),
	('EnablePDFInvoices', 'on'),
	('CaptchaSetting', ''),
	('SupportTicketOrder', 'ASC'),
	('SendFirstOverdueInvoiceReminder', '1'),
	('TaxType', 'Exclusive'),
	('DomainDNSManagement', '5.00'),
	('DomainEmailForwarding', '5.00'),
	('InvoiceIncrement', '1'),
	('ContinuousInvoiceGeneration', ''),
	('AutoCancellationRequests', 'on'),
	('SystemEmailsFromName', 'WHMCompleteSolution'),
	('SystemEmailsFromEmail', 'noreply@yourdomain.com'),
	('AllowClientRegister', 'on'),
	('BulkCheckTLDs', ''),
	('OrderDaysGrace', '0'),
	('CreditOnDowngrade', 'on'),
	('AcceptedCardTypes', 'Visa,MasterCard,Discover,American Express,JCB,EnRoute,Diners Club'),
	('TaxDomains', 'on'),
	('TaxLateFee', 'on'),
	('AdminForceSSL', 'on'),
	('ProductMonthlyPricingBreakdown', ''),
	('LateFeeType', 'Percentage'),
	('SendSecondOverdueInvoiceReminder', '0'),
	('SendThirdOverdueInvoiceReminder', '0'),
	('DomainIDProtection', '5.00'),
	('DomainRenewalNotices', '30,7,-3,0,0'),
	('SequentialInvoiceNumbering', ''),
	('SequentialInvoiceNumberFormat', '{NUMBER}'),
	('SequentialInvoiceNumberValue', '1'),
	('DefaultNameserver3', ''),
	('DefaultNameserver4', ''),
	('AffiliatesDelayCommission', '0'),
	('SupportModule', ''),
	('AddFundsEnabled', ''),
	('AddFundsMinimum', '10.00'),
	('AddFundsMaximum', '100.00'),
	('AddFundsMaximumBalance', '300.00'),
	('OrderDaysGrace', '0'),
	('DisableClientDropdown', ''),
	('CCProcessDaysBefore', '0'),
	('CCAttemptOnlyOnce', ''),
	('CCDaySendExpiryNotices', '25'),
	('BulkDomainSearchEnabled', 'on'),
	('AutoRenewDomainsonPayment', 'on'),
	('DomainAutoRenewDefault', 'on'),
	('CCRetryEveryWeekFor', '0'),
	('SupportTicketKBSuggestions', 'on'),
	('DailyEmailBackup', ''),
	('FTPBackupHostname', ''),
	('FTPBackupUsername', ''),
	('FTPBackupPassword', '7NJM3pPMA+4XOHgSEfAfFLUBKB0='),
	('FTPBackupDestination', '/'),
	('TaxL2Compound', ''),
	('EmailCSS', 'body,td { font-family: verdana; font-size: 11px; font-weight: normal; }\r\na { color: #0000ff; }'),
	('SEOFriendlyUrls', ''),
	('ShowCCIssueStart', ''),
	('ClientDropdownFormat', '1'),
	('TicketRatingEnabled', 'on'),
	('NetworkIssuesRequireLogin', 'on'),
	('ShowNotesFieldonCheckout', 'on'),
	('RequireLoginforClientTickets', 'on'),
	('NOMD5', ''),
	('CurrencyAutoUpdateExchangeRates', 'on'),
	('CurrencyAutoUpdateProductPrices', ''),
	('RequiredPWStrength', '0'),
	('MaintenanceMode', ''),
	('MaintenanceModeMessage', 'We are currently performing maintenance and will be back shortly.'),
	('SkipFraudForExisting', ''),
	('SMTPSSL', ''),
	('ContactFormDept', ''),
	('ContactFormTo', ''),
	('TicketEscalationLastRun', '2009-01-01 00:00:00'),
	('APIAllowedIPs', 'a:1:{i:0;a:2:{s:2:"ip";s:0:"";s:4:"note";s:0:"";}}'),
	('DisableSessionIPCheck', ''),
	('DisableSupportTicketReplyEmailsLogging', ''),
	('OverageBillingMethod', '1'),
	('CCNeverStore', ''),
	('CCAllowCustomerDelete', ''),
	('CreateDomainInvoiceDaysBefore', ''),
	('NoInvoiceEmailOnOrder', ''),
	('TaxInclusiveDeduct', ''),
	('LateFeeMinimum', '0.00'),
	('AutoProvisionExistingOnly', ''),
	('EnableDomainRenewalOrders', 'on'),
	('EnableMassPay', 'on'),
	('NoAutoApplyCredit', ''),
	('CreateInvoiceDaysBeforeMonthly', ''),
	('CreateInvoiceDaysBeforeQuarterly', ''),
	('CreateInvoiceDaysBeforeSemiAnnually', ''),
	('CreateInvoiceDaysBeforeAnnually', ''),
	('CreateInvoiceDaysBeforeBiennially', ''),
	('CreateInvoiceDaysBeforeTriennially', ''),
	('ClientsProfileUneditableFields', ''),
	('ClientDisplayFormat', '1'),
	('CCDoNotRemoveOnExpiry', ''),
	('GenerateRandomUsername', ''),
	('AddFundsRequireOrder', 'on'),
	('GroupSimilarLineItems', 'on'),
	('ProrataClientsAnniversaryDate', ''),
	('TCPDFFont', 'helvetica'),
	('CancelInvoiceOnCancellation', 'on'),
	('AttachmentThumbnails', 'on'),
	('EmailGlobalHeader', '&lt;p&gt;&lt;a href=&quot;{$company_domain}&quot; target=&quot;_blank&quot;&gt;&lt;img src=&quot;{$company_logo_url}&quot; alt=&quot;{$company_name}&quot; border=&quot;0&quot; /&gt;&lt;/a&gt;&lt;/p&gt;'),
	('EmailGlobalFooter', ''),
	('DomainSyncEnabled', 'on'),
	('DomainSyncNextDueDate', ''),
	('DomainSyncNextDueDateDays', '0'),
	('TicketMask', '%n%n%n%n%n%n'),
	('AutoClientStatusChange', '2'),
	('AllowClientsEmailOptOut', ''),
	('BannedSubdomainPrefixes', 'mail,mx,gapps,gmail,webmail,cpanel,whm,ftp,clients,billing,members,login,accounts,access'),
	('FreeDomainAutoRenewRequiresProduct', 'on'),
	('DomainToDoListEntries', 'on'),
	('InstanceID', '2MP4swgURhWg'),
	('token_namespaces', 'a:3:{s:13:"WHMCS.default";b:1;s:19:"WHMCS.admin.default";b:1;s:19:"WHMCS.domainchecker";b:0;}'),
	('LoginFailures', 'a:1:{s:9:"127.0.0.1";a:2:{s:5:"count";i:1;s:7:"expires";i:1514203980;}}'),
	('MaintenanceModeURL', ''),
	('ClientDateFormat', ''),
	('AllowIDNDomains', ''),
	('DomainSyncNotifyOnly', ''),
	('DefaultNameserver5', ''),
	('MailEncoding', '0'),
	('ShowClientOnlyDepts', ''),
	('TicketFeedback', ''),
	('PreventEmailReopening', '0'),
	('TicketEmailLimit', '10'),
	('UpdateLastReplyTimestamp', 'always'),
	('DownloadsIncludeProductLinked', ''),
	('PDFPaperSize', 'A4'),
	('AffiliateDepartment', ''),
	('CaptchaType', ''),
	('ReCAPTCHAPrivateKey', ''),
	('ReCAPTCHAPublicKey', ''),
	('sendFailedLoginWhitelist', '0'),
	('DisableAdminPWReset', ''),
	('proxyHeader', ''),
	('LogAPIAuthentication', '0'),
	('TwitterUsername', ''),
	('AnnouncementsTweet', ''),
	('AnnouncementsFBRecommend', ''),
	('AnnouncementsFBComments', ''),
	('GooglePlus1', ''),
	('ClientsProfileOptionalFields', ''),
	('DefaultToClientArea', ''),
	('DisplayErrors', ''),
	('SQLErrorReporting', ''),
	('HooksDebugMode', ''),
	('RegistrarModuleHooks', '');
/*!40000 ALTER TABLE `tblconfiguration` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblcontacts
CREATE TABLE IF NOT EXISTS `tblcontacts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `companyname` text NOT NULL,
  `email` text NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `postcode` text NOT NULL,
  `country` text NOT NULL,
  `phonenumber` text NOT NULL,
  `subaccount` int(1) NOT NULL DEFAULT '0',
  `password` text NOT NULL,
  `permissions` text NOT NULL,
  `domainemails` int(1) NOT NULL,
  `generalemails` int(1) NOT NULL,
  `invoiceemails` int(1) NOT NULL,
  `productemails` int(1) NOT NULL,
  `supportemails` int(1) NOT NULL,
  `affiliateemails` int(1) NOT NULL,
  `pwresetkey` text NOT NULL,
  `pwresetexpiry` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid_firstname_lastname` (`userid`,`firstname`(32),`lastname`(32)),
  KEY `email` (`email`(64))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblcontacts: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblcontacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcontacts` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblcredit
CREATE TABLE IF NOT EXISTS `tblcredit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `clientid` int(10) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `relid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblcredit: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblcredit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcredit` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblcurrencies
CREATE TABLE IF NOT EXISTS `tblcurrencies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` text NOT NULL,
  `prefix` text NOT NULL,
  `suffix` text NOT NULL,
  `format` int(1) NOT NULL,
  `rate` decimal(10,5) NOT NULL DEFAULT '1.00000',
  `default` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblcurrencies: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblcurrencies` DISABLE KEYS */;
REPLACE INTO `tblcurrencies` (`id`, `code`, `prefix`, `suffix`, `format`, `rate`, `default`) VALUES
	(1, 'RMB', '￥', 'RMB', 1, 1.00000, 1);
/*!40000 ALTER TABLE `tblcurrencies` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblcustomfields
CREATE TABLE IF NOT EXISTS `tblcustomfields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `relid` int(10) NOT NULL DEFAULT '0',
  `fieldname` text NOT NULL,
  `fieldtype` text NOT NULL,
  `description` text NOT NULL,
  `fieldoptions` text NOT NULL,
  `regexpr` text NOT NULL,
  `adminonly` text NOT NULL,
  `required` text NOT NULL,
  `showorder` text NOT NULL,
  `showinvoice` text NOT NULL,
  `sortorder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `serviceid` (`relid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblcustomfields: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblcustomfields` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcustomfields` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblcustomfieldsvalues
CREATE TABLE IF NOT EXISTS `tblcustomfieldsvalues` (
  `fieldid` int(10) NOT NULL,
  `relid` int(10) NOT NULL,
  `value` text NOT NULL,
  KEY `fieldid_relid` (`fieldid`,`relid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblcustomfieldsvalues: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblcustomfieldsvalues` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcustomfieldsvalues` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbldomainpricing
CREATE TABLE IF NOT EXISTS `tbldomainpricing` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `extension` text NOT NULL,
  `dnsmanagement` text NOT NULL,
  `emailforwarding` text NOT NULL,
  `idprotection` text NOT NULL,
  `eppcode` text NOT NULL,
  `autoreg` text NOT NULL,
  `order` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `extension_registrationperiod` (`extension`(32)),
  KEY `order` (`order`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbldomainpricing: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbldomainpricing` DISABLE KEYS */;
REPLACE INTO `tbldomainpricing` (`id`, `extension`, `dnsmanagement`, `emailforwarding`, `idprotection`, `eppcode`, `autoreg`, `order`) VALUES
	(1, '.com', '', '', '', '', 'bizcn', 1),
	(2, '.cn', '', '', '', '', 'bizcn', 2);
/*!40000 ALTER TABLE `tbldomainpricing` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbldomainreminders
CREATE TABLE IF NOT EXISTS `tbldomainreminders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `domain_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `recipients` text NOT NULL,
  `type` tinyint(4) NOT NULL,
  `days_before_expiry` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbldomainreminders: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbldomainreminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldomainreminders` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbldomainsadditionalfields
CREATE TABLE IF NOT EXISTS `tbldomainsadditionalfields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `domainid` int(10) NOT NULL,
  `name` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `domainid` (`domainid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbldomainsadditionalfields: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbldomainsadditionalfields` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldomainsadditionalfields` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbldownloadcats
CREATE TABLE IF NOT EXISTS `tbldownloadcats` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parentid` int(10) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `description` text NOT NULL,
  `hidden` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbldownloadcats: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbldownloadcats` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldownloadcats` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbldownloads
CREATE TABLE IF NOT EXISTS `tbldownloads` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` int(10) NOT NULL,
  `type` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `downloads` int(10) NOT NULL DEFAULT '0',
  `location` text NOT NULL,
  `clientsonly` text NOT NULL,
  `hidden` text NOT NULL,
  `productdownload` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`(32)),
  KEY `downloads` (`downloads`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbldownloads: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbldownloads` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldownloads` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblemailmarketer
CREATE TABLE IF NOT EXISTS `tblemailmarketer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `settings` text NOT NULL,
  `disable` int(1) NOT NULL,
  `marketing` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblemailmarketer: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblemailmarketer` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemailmarketer` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblemails
CREATE TABLE IF NOT EXISTS `tblemails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `to` text,
  `cc` text,
  `bcc` text,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblemails: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblemails` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemails` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblemailtemplates
CREATE TABLE IF NOT EXISTS `tblemailtemplates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `name` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `attachments` text NOT NULL,
  `fromname` text NOT NULL,
  `fromemail` text NOT NULL,
  `disabled` text NOT NULL,
  `custom` text NOT NULL,
  `language` text NOT NULL,
  `copyto` text NOT NULL,
  `plaintext` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`(32)),
  KEY `name` (`name`(64))
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblemailtemplates: ~42 rows (approximately)
/*!40000 ALTER TABLE `tblemailtemplates` DISABLE KEYS */;
REPLACE INTO `tblemailtemplates` (`id`, `type`, `name`, `subject`, `message`, `attachments`, `fromname`, `fromemail`, `disabled`, `custom`, `language`, `copyto`, `plaintext`) VALUES
	(1, 'product', 'Hosting Account Welcome Email', 'New Account Information', '<p>Dear {$client_name},</p><p align="center"><strong>PLEASE READ THIS EMAIL IN FULL AND PRINT IT FOR YOUR RECORDS</strong></p><p>Thank you for your order from us! Your hosting account has now been setup and this email contains all the information you will need in order to begin using your account.</p><p>If you have requested a domain name during sign up, please keep in mind that your domain name will not be visible on the internet instantly. This process is called propagation and can take up to 48 hours. Until your domain has propagated, your website and email will not function, we have provided a temporary url which you may use to view your website and upload files in the meantime.</p><p><strong>New Account Information</strong></p><p>Hosting Package: {$service_product_name}<br />Domain: {$service_domain}<br />First Payment Amount: {$service_first_payment_amount}<br />Recurring Amount: {$service_recurring_amount}<br />Billing Cycle: {$service_billing_cycle}<br />Next Due Date: {$service_next_due_date}</p><p><strong>Login Details</strong></p><p>Username: {$service_username}<br />Password: {$service_password}</p><p>Control Panel URL: <a href="http://{$service_server_ip}:2082/">http://{$service_server_ip}:2082/</a><br />Once your domain has propogated, you may also use <a href="http://www.{$service_domain}:2082/">http://www.{$service_domain}:2082/</a></p><p><strong>Server Information</strong></p><p>Server Name: {$service_server_name}<br />Server IP: {$service_server_ip}</p><p>If you are using an existing domain with your new hosting account, you will need to update the nameservers to point to the nameservers listed below.</p><p>Nameserver 1: {$service_ns1} ({$service_ns1_ip})<br />Nameserver 2: {$service_ns2} ({$service_ns2_ip}){if $service_ns3}<br />Nameserver 3: {$service_ns3} ({$service_ns3_ip}){/if}{if $service_ns4}<br />Nameserver 4: {$service_ns4} ({$service_ns4_ip}){/if}</p><p><strong>Uploading Your Website</strong></p><p>Temporarily you may use one of the addresses given below to manage your web site:</p><p>Temporary FTP Hostname: {$service_server_ip}<br />Temporary Webpage URL: <a href="http://{$service_server_ip}/~{$service_username}/">http://{$service_server_ip}/~{$service_username}/</a></p><p>And once your domain has propagated you may use the details below:</p><p>FTP Hostname: {$service_domain}<br />Webpage URL: <a href="http://www.{$service_domain}">http://www.{$service_domain}</a></p><p><strong>Email Settings</strong></p><p>For email accounts that you setup, you should use the following connection details in your email program:</p><p>POP3 Host Address: mail.{$service_domain}<br />SMTP Host Address: mail.{$service_domain}<br />Username: The email address you are checking email for<br />Password: As specified in your control panel</p><p>Thank you for choosing us.</p><p>{$signature}</p>', '', '', '', '', '', '', '', 0),
	(3, 'domain', 'Domain Registration Confirmation', 'Domain Registration Confirmation', '<p>\r\nDear {$client_name}, \r\n</p>\r\n<p>\r\nThis message is to confirm that your domain purchase has been successful. The details of the domain purchase are below: \r\n</p>\r\n<p>\r\nRegistration Date: {$domain_reg_date}<br />\r\nDomain: {$domain_name}<br />\r\nRegistration Period: {$domain_reg_period}<br />\r\nAmount: {$domain_first_payment_amount}<br />\r\nNext Due Date: {$domain_next_due_date} \r\n</p>\r\n<p>\r\nYou may login to your client area at {$whmcs_url} to manage your new domain. \r\n</p>\r\n<p>\r\n{$signature} \r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(4, 'product', 'Reseller Account Welcome Email', 'Reseller Account Information', '<p align="center">\r\n<strong>PLEASE PRINT THIS MESSAGE FOR YOUR RECORDS - PLEASE READ THIS EMAIL IN FULL.</strong>\r\n</p>\r\n<p>\r\nIf you have requested a domain name during sign up then this will not be visible on the internet for between 24 and 72 hours. This process is called Propagation. Until your domain has Propagated your website and email will not function, we have provided a temporary url which you may use to view your website and upload files in the meantime.\r\n</p>\r\n<p>\r\nDear {$client_name},\r\n</p>\r\n<p>\r\nThe reseller hosting account for {$service_domain} has been set up. The username and password below are for both cPanel to manage the website at {$service_domain} and WebHostManager to manage your Reseller Account.\r\n</p>\r\n<p>\r\n<strong>New Account Info</strong>\r\n</p>\r\n<p>\r\nDomain: {$service_domain}<br />\r\nUsername: {$service_username}<br />\r\nPassword: {$service_password}<br />\r\nHosting Package: {$service_product_name}\r\n</p>\r\n<p>\r\nControl Panel: <a href="http://{$service_server_ip}:2082/">http://{$service_server_ip}:2082/</a><br />\r\nWeb Host Manager: <a href="http://{$service_server_ip}:2086/">http://{$service_server_ip}:2086/</a>\r\n</p>\r\n<p>\r\n-------------------------------------------------------------------------------------------- <br />\r\n<strong>Web Host Manager Quick Start</strong> <br />\r\n-------------------------------------------------------------------------------------------- <br />\r\n<br />\r\nTo access your Web Host Manager, use the following address:<br />\r\n<br />\r\n<a href="http://{$service_server_ip}:2086/">http://{$service_server_ip}:2086/</a><br />\r\n<br />\r\nThe <strong>http://</strong> must be in the address line to connect to port :2086 <br />\r\nPlease use the username/password given above. <br />\r\n<br />\r\n<strong><em>To Create a New Account <br />\r\n</em></strong><br />\r\nThe first thing you need to do is scroll down on the left and click on &#39Add Package&#39 so that you can create your own hosting packages. You cannot install a domain onto your account without first creating packages.<br />\r\n<br />\r\n1. Click on &#39Create a New Account&#39 from the left hand side menu <br />\r\n2. Put the domain in the &#39Domain&#39 box (no www or http or spaces ? just domainname.com). After putting in the domain, hit TAB and it will automatically create a username. Also, enter a password for the account.<br />\r\n3. Your package selection should be one that you created earlier <br />\r\n4. Then press the create button <br />\r\n<br />\r\nThis will give you a confirmation page (you should print this for your records)\r\n</p>\r\n<p>\r\nPlease do not click on anything that you are not sure what it does. Please do not try to alter the WHM Theme from the selection box - fatal errors may occur. \r\n</p>\r\n<p>\r\n-------------------------------------------------------------------------------------------- \r\n</p>\r\n<p>\r\nTemporarily you may use one of the addresses given below manage your web site\r\n</p>\r\n<p>\r\nTemporary FTP Hostname: {$service_server_ip}<br />\r\nTemporary Webpage URL: <a href="http://{$service_server_ip}/~{$service_username}/">http://{$service_server_ip}/~{$service_username}/</a><br />\r\nTemporary Control Panel: <a href="http://{$service_server_ip}/cpanel">http://{$service_server_ip}/cpanel</a>\r\n</p>\r\n<p>\r\nOnce your domain has Propagated\r\n</p>\r\n<p>\r\nFTP Hostname: www.{$service_domain}<br />\r\nWebpage URL: <a href="http://www.{$service_domain}">http://www.{$service_domain}</a><br />\r\nControl Panel: <a href="http://www.{$service_domain}/cpanel">http://www.{$service_domain}/cpanel</a><br />\r\nWeb Host Manager: <a href="http://www.{$service_domain}/whm">http://www.{$service_domain}/whm</a>\r\n</p>\r\n<p>\r\n<strong>Mail settings</strong>\r\n</p>\r\n<p>\r\nCatch all email with your default email account\r\n</p>\r\n<p>\r\nPOP3 Host Address : mail.{$service_domain}<br />\r\nSMTP Host Address: mail.{$service_domain}<br />\r\nUsername: {$service_username}<br />\r\nPassword: {$service_password}\r\n</p>\r\n<p>\r\nAdditional mail accounts that you add\r\n</p>\r\n<p>\r\nPOP3 Host Address : mail.{$service_domain}<br />\r\nSMTP Host Address: mail.{$service_domain}<br />\r\nUsername : The FULL email address that you are picking up from (e.g. info@yourdomain.com). <br />\r\nIf your email client cannot accept a @ symbol, then you may replace this with a backslash .<br />\r\nPassword : As specified in your control panel \r\n</p>\r\n<p>\r\nThank you for choosing us.\r\n</p>\r\n<p>\r\n{$signature}\r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(7, 'support', 'Support Ticket Opened', 'New Support Ticket Opened', '<p>\r\n{$client_name},\r\n</p>\r\n<p>\r\nThank you for contacting our support team. A support ticket has now been opened for your request. You will be notified when a response is made by email. The details of your ticket are shown below.\r\n</p>\r\n<p>\r\nSubject: {$ticket_subject}<br />\r\nPriority: {$ticket_priority}<br />\r\nStatus: {$ticket_status}\r\n</p>\r\n<p>\r\nYou can view the ticket at any time at {$ticket_link}\r\n</p>\r\n<p>\r\n{$signature}\r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(8, 'support', 'Support Ticket Reply', 'Support Ticket Response', '<p>\r\n{$ticket_message}\r\n</p>\r\n<p>\r\n----------------------------------------------<br />\r\nTicket ID: #{$ticket_id}<br />\r\nSubject: {$ticket_subject}<br />\r\nStatus: {$ticket_status}<br />\r\nTicket URL: {$ticket_link}<br />\r\n----------------------------------------------\r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(9, 'general', 'Client Signup Email', 'Welcome', '<p>\r\nDear {$client_name}, \r\n</p>\r\n<p>\r\nThank you for signing up with us. Your new account has been setup and you can now login to our client area using the details below. \r\n</p>\r\n<p>\r\nEmail Address: {$client_email}<br />\r\nPassword: {$client_password} \r\n</p>\r\n<p>\r\nTo login, visit {$whmcs_url} \r\n</p>\r\n<p>\r\n{$signature} \r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(10, 'product', 'Service Suspension Notification', 'Service Suspension Notification', '<p>Dear {$client_name},</p><p>This is a notification that your service has now been suspended.  The details of this suspension are below:</p><p>Product/Service: {$service_product_name}<br />{if $service_domain}Domain: {$service_domain}<br />{/if}Amount: {$service_recurring_amount}<br />Due Date: {$service_next_due_date}<br />Suspension Reason: <strong>{$service_suspension_reason}</strong></p><p>Please contact us as soon as possible to get your service reactivated.</p><p>{$signature}</p>', '', '', '', '', '', '', '', 0),
	(13, 'invoice', 'Invoice Payment Confirmation', 'Invoice Payment Confirmation', '<p>Dear {$client_name},</p>\r\n<p>This is a payment receipt for Invoice {$invoice_num} sent on {$invoice_date_created}</p>\r\n<p>{$invoice_html_contents}</p>\r\n<p>Amount: {$invoice_last_payment_amount}<br />Transaction #: {$invoice_last_payment_transid}<br />Total Paid: {$invoice_amount_paid}<br />Remaining Balance: {$invoice_balance}<br />Status: {$invoice_status}</p>\r\n<p>You may review your invoice history at any time by logging in to your client area.</p>\r\n<p>Note: This email will serve as an official receipt for this payment.</p>\r\n<p>{$signature}</p>', '', '', '', '', '', '', '', 0),
	(14, 'invoice', 'Invoice Created', 'Customer Invoice', '<p>\r\nDear {$client_name}, \r\n</p>\r\n<p>\r\nThis is a notice that an invoice has been generated on {$invoice_date_created}. \r\n</p>\r\n<p>\r\nYour payment method is: {$invoice_payment_method} \r\n</p>\r\n<p>\r\nInvoice #{$invoice_num}<br />\r\nAmount Due: {$invoice_total}<br />\r\nDue Date: {$invoice_date_due} \r\n</p>\r\n<p>\r\n<strong>Invoice Items</strong> \r\n</p>\r\n<p>\r\n{$invoice_html_contents} <br />\r\n------------------------------------------------------ \r\n</p>\r\n<p>\r\nYou can login to your client area to view and pay the invoice at {$invoice_link} \r\n</p>\r\n<p>\r\n{$signature} \r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(15, 'invoice', 'Invoice Payment Reminder', 'Invoice Payment Reminder', '<p>\r\nDear {$client_name},\r\n</p>\r\n<p>\r\nThis is a billing reminder that your invoice no. {$invoice_num} which was generated on {$invoice_date_created} is due on {$invoice_date_due}.\r\n</p>\r\n<p>\r\nYour payment method is: {$invoice_payment_method}\r\n</p>\r\n<p>\r\nInvoice: {$invoice_num}<br />\r\nBalance Due: {$invoice_balance}<br />\r\nDue Date: {$invoice_date_due}\r\n</p>\r\n<p>\r\nYou can login to your client area to view and pay the invoice at {$invoice_link}\r\n</p>\r\n<p>\r\n{$signature}\r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(16, 'general', 'Order Confirmation', 'Order Confirmation', '<p>\r\nDear {$client_name}, \r\n</p>\r\n<p>\r\nWe have received your order and will be processing it shortly. The details of the order are below: \r\n</p>\r\n<p>\r\nOrder Number: <b>{$order_number}</b></p>\r\n<p>\r\n{$order_details} \r\n</p>\r\n<p>\r\nYou will receive an email from us shortly once your account has been setup. Please quote your order reference number if you wish to contact us about this order. \r\n</p>\r\n<p>\r\n{$signature}\r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(17, 'product', 'Dedicated/VPS Server Welcome Email', 'New Dedicated Server Information', '<p>\r\nDear {$client_name},<br />\r\n<br />\r\n<strong>PLEASE PRINT THIS MESSAGE FOR YOUR RECORDS - PLEASE READ THIS EMAIL IN FULL.</strong>\r\n</p>\r\n<p>\r\nWe are pleased to tell you that the server you ordered has now been set up and is operational.\r\n</p>\r\n<p>\r\n<strong>Server Details<br />\r\n</strong>=============================\r\n</p>\r\n<p>\r\n{$service_product_name}\r\n</p>\r\n<p>\r\nMain IP: {$service_dedicated_ip}<br />\r\nRoot pass: {$service_password}\r\n</p>\r\n<p>\r\nIP address allocation: <br />\r\n{$service_assigned_ips}\r\n</p>\r\n<p>\r\nServerName: {$service_domain}\r\n</p>\r\n<p>\r\n<strong>WHM Access<br />\r\n</strong>=============================<br />\r\n<a href="http://xxxxx:2086/">http://xxxxx:2086</a><br />\r\nUsername: root<br />\r\nPassword: {$service_password}\r\n</p>\r\n<p>\r\n<strong>Custom DNS Server Addresses</strong><br />\r\n=============================<br />\r\nThe custom DNS addresses you should set for your domain to use are: <br />\r\nPrimary DNS: {$service_ns1}<br />\r\nSecondary DNS: {$service_ns2}\r\n</p>\r\n<p>\r\nYou will have to login to your registrar and find the area where you can specify both of your custom name server addresses.\r\n</p>\r\n<p>\r\nAfter adding these custom nameservers to your domain registrar control panel, it will take 24 to 48 hours for your domain to delegate authority to your DNS server. Once this has taken effect, your DNS server has control over the DNS records for the domains which use your custom name server addresses. \r\n</p>\r\n<p>\r\n<strong>SSH Access Information<br />\r\n</strong>=============================<br />\r\nMain IP Address: xxxxxxxx<br />\r\nServer Name: {$service_domain}<br />\r\nRoot Password: xxxxxxxx\r\n</p>\r\n<p>\r\nYou can access your server using a free simple SSH client program called Putty located at:<br />\r\n<a href="http://www.securitytools.net/mirrors/putty/">http://www.securitytools.net/mirrors/putty/</a>\r\n</p>\r\n<p>\r\n<strong>Support</strong><br />\r\n=============================<br />\r\nFor any support needs, please open a ticket at {$whmcs_url}\r\n</p>\r\n<p>\r\nPlease include any necessary information to provide you with faster service, such as root password, domain names, and a description of the problem / or assistance needed. This will speed up the support time by allowing our administrators to immediately begin diagnosing the problem.\r\n</p>\r\n<p>\r\nThe manual for cPanel can be found here: <a href="http://www.cpanel.net/docs/cp/">http://www.cpanel.net/docs/cp/</a> <br />\r\nFor documentation on using WHM please see the following link: <a href="http://www.cpanel.net/docs/whm/index.html">http://www.cpanel.net/docs/whm/index.html</a>\r\n</p>\r\n<p>\r\n=============================\r\n</p>\r\n<p>\r\nIf you need to move accounts to the server use: Transfers Copy an account from another server with account password\r\n</p>\r\n<p>\r\n<a href="http://xxxxxxx:2086/scripts2/norootcopy">http://xxxxxxx:2086/scripts2/norootcopy</a>\r\n</p>\r\n<p>\r\nNote the other server must use cpanel to move it.\r\n</p>\r\n<p>\r\n=============================\r\n</p>\r\n<p>\r\n{$signature}\r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(18, 'product', 'Other Product/Service Welcome Email', 'New Product Information', '<p>\r\nDear {$client_name},\r\n</p>\r\n<p>\r\nYour order for {$service_product_name} has now been activated. Please keep this message for your records.\r\n</p>\r\n<p>\r\nProduct/Service: {$service_product_name}<br />\r\nPayment Method: {$service_payment_method}<br />\r\nAmount: {$service_recurring_amount}<br />\r\nBilling Cycle: {$service_billing_cycle}<br />\r\nNext Due Date: {$service_next_due_date}\r\n</p>\r\n<p>\r\nThank you for choosing us.\r\n</p>\r\n<p>\r\n{$signature}\r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(19, 'invoice', 'Credit Card Payment Confirmation', 'Credit Card Payment Confirmation', '<p>Dear {$client_name},</p>\r\n<p>This is a payment receipt for Invoice {$invoice_num} sent on {$invoice_date_created}</p>\r\n<p>{$invoice_html_contents}</p>\r\n<p>Amount: {$invoice_last_payment_amount}<br />Transaction #: {$invoice_last_payment_transid}<br />Total Paid: {$invoice_amount_paid}<br />Remaining Balance: {$invoice_balance}<br />Status: {$invoice_status}</p>\r\n<p>You may review your invoice history at any time by logging in to your client area.</p>\r\n<p>Note: This email will serve as an official receipt for this payment.</p>\r\n<p>{$signature}</p>', '', '', '', '', '', '', '', 0),
	(20, 'invoice', 'Credit Card Payment Failed', 'Credit Card Payment Failed', '<p>\r\nDear {$client_name}, \r\n</p>\r\n<p>\r\nThis is a notice that a recent credit card payment we attempted on the card we have registered for you failed. \r\n</p>\r\n<p>\r\nInvoice Date: {$invoice_date_created}<br />\r\nInvoice No: {$invoice_num}<br />\r\nAmount: {$invoice_total}<br />\r\nStatus: {$invoice_status} \r\n</p>\r\n<p>\r\nYou now need to login to your client area to pay the invoice manually. During the payment process you will be given the opportunity to change the card on record with us.<br />\r\n{$invoice_link} \r\n</p>\r\n<p>\r\nNote: This email will serve as an official receipt for this payment. \r\n</p>\r\n<p>\r\n{$signature}\r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(21, 'invoice', 'Credit Card Invoice Created', 'Customer Invoice', '<p> Dear {$client_name}, </p> <p> This is a notice that an invoice has been generated on {$invoice_date_created}. </p> <p> Your payment method is: {$invoice_payment_method} </p> <p> Invoice #{$invoice_num}<br /> Amount Due: {$invoice_total}<br /> Due Date: {$invoice_date_due} </p> <p> <strong>Invoice Items</strong> </p> <p> {$invoice_html_contents} <br /> ------------------------------------------------------ </p> <p> Payment will be taken automatically on {$invoice_date_due} from your credit card on record with us. To update or change the credit card details we hold for your account please login at {$invoice_link} and click Pay Now then following the instructions on screen. </p> <p> {$signature} </p>', '', '', '', '', '', '', '', 0),
	(22, 'affiliate', 'Affiliate Monthly Referrals Report', 'Affiliate Monthly Referrals Report', '<p>\r\nDear {$client_name}, \r\n</p>\r\n<p>\r\nThis is your monthly affiliate referrals report. You can view your referral statistics at any time by logging in to the client area. \r\n</p>\r\n<p>\r\nTotal Visitors Referred: {$affiliate_total_visits}<br />\r\nCurrent Earnings: {$affiliate_balance}<br />\r\nAmount Withdrawn: {$affiliate_withdrawn} \r\n</p>\r\n<p>\r\n<strong>Your New Signups this Month</strong> \r\n</p>\r\n<p>\r\n{$affiliate_referrals_table} \r\n</p>\r\n<p>\r\nRemember, you can refer new customers using your unique affiliate link: {$affiliate_referral_url} \r\n</p>\r\n<p>\r\n{$signature}\r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(23, 'support', 'Support Ticket Opened by Admin', '{$ticket_subject}', '{$ticket_message}', '', '', '', '', '', '', '', 0),
	(24, 'invoice', 'First Invoice Overdue Notice', 'First Invoice Overdue Notice', '<p> Dear {$client_name}, </p> <p> This is a billing notice that your invoice no. {$invoice_num} which was generated on {$invoice_date_created} is now overdue. </p> <p> Your payment method is: {$invoice_payment_method} </p> <p> Invoice: {$invoice_num}<br /> Balance Due: {$invoice_balance}<br /> Due Date: {$invoice_date_due} </p> <p> You can login to your client area to view and pay the invoice at {$invoice_link} </p> <p> {$signature} </p>', '', '', '', '', '', '', '', 0),
	(25, 'product', 'SHOUTcast Welcome Email', 'SHOUTcast New Account Information', '<p align="center">\r\n<strong>PLEASE READ THIS EMAIL IN FULL AND PRINT IT FOR YOUR RECORDS</strong> \r\n</p>\r\n<p>\r\nDear {$client_name}, \r\n</p>\r\n<p>\r\nThank you for your order from us! Your shoutcast account has now been setup and this email contains all the information you will need in order to begin using your account. \r\n</p>\r\n<p>\r\n<strong>New Account Information</strong> \r\n</p>\r\n<p>\r\nDomain: {$service_domain}<br />\r\nUsername: {$service_username}<br />\r\nPassword: {$service_password} \r\n</p>\r\n<p>\r\n<strong>Server Information</strong> \r\n</p>\r\n<p>\r\nServer Name: {$service_server_name}<br />\r\nServer IP: {$service_server_ip}<br />\r\nNameserver 1: {$service_ns1}<br />\r\nNameserver 1 IP: {$service_ns1_ip}<br />\r\nNameserver 2: {$service_ns2} <br />\r\nNameserver 2 IP: {$service_ns2_ip} \r\n</p>\r\n<p>\r\nThank you for choosing us. \r\n</p>\r\n<p>\r\n{$signature}\r\n</p>\r\n', '', '', '', '', '', '', '', 0),
	(26, 'general', 'Credit Card Expiring Soon', 'Credit Card Expiring Soon', '<p>Dear {$client_name}, </p><p>This is a notice to inform you that your {$client_cc_type} credit card ending with {$client_cc_number} will be expiring next month on {$client_cc_expiry}. Please login to update your credit card information as soon as possible and prevent any interuptions in service at {$whmcs_url}<br /><br />If you have any questions regarding your account, please open a support ticket from the client area.</p><p>{$signature}</p>', '', '', '', '', '', '', '', 0),
	(27, 'support', 'Support Ticket Auto Close Notification', 'Support Ticket Resolved', '<p>{$client_name},</p><p>This is a notification to let you know that we are changing the status of your ticket #{$ticket_id} to Closed as we have not received a response from you in over {$ticket_auto_close_time} hours.</p><p>Subject: {$ticket_subject}<br>Department: {$ticket_department}<br>Priority: {$ticket_priority}<br>Status: {$ticket_status}</p><p>If you have any further questions then please just reply to re-open the ticket.</p><p>{$signature}</p>', '', '', '', '', '', '', '', 0),
	(28, 'invoice', 'Credit Card Payment Due', 'Credit Card Payment Due', '<p>Dear {$client_name},</p><p>This is a notice to remind you that you have an invoice due on {$invoice_date_due}. We tried to bill you automatically but were unable to because we don\'t have your credit card details on file.</p><p>Invoice Date: {$invoice_date_created}<br>Invoice #{$invoice_num}<br>Amount Due: {$invoice_total}<br>Due Date: {$invoice_date_due}</p><p>Please login to our client area at the link below to submit your card details or make payment using a different method.</p><p>{$invoice_link}</p><p>{$signature}</p>', '', '', '', '', '', '', '', 0),
	(29, 'product', 'Cancellation Request Confirmation', 'Cancellation Request Confirmation', '<p>Dear {$client_name},</p><p>This email is to confirm that we have received your cancellation request for the service listed below.</p><p>Product/Service: {$service_product_name}<br />Domain: {$service_domain}</p><p>{if $service_cancellation_type=="Immediate"}The service will be terminated within the next 24 hours.{else}The service will be cancelled at the end of your current billing period on {$service_next_due_date}.{/if}</p><p>Thank you for using {$company_name} and we hope to see you again in the future.</p><p>{$signature}</p>', '', '', '', '', '', '', '', 0),
	(30, 'general', 'Password Reset Validation', 'Your login details for {$company_name}', '<p>Dear {$client_name},</p><p>Recently a request was submitted to reset your password for our client area. If you did not request this, please ignore this email. It will expire and become useless in 2 hours time.</p><p>To reset your password, please visit the url below:<br /><a href="{$pw_reset_url}">{$pw_reset_url}</a></p><p>When you visit the link above, you will have the opportunity to choose a new password.</p><p>{$signature}</p>', '', '', '', '', '', '', '', 0),
	(31, 'general', 'Automated Password Reset', 'Your new password for {$company_name}', '<p>Dear {$client_name},</p><p>As you requested, your password for our client area has now been reset.  Your new login details are as follows:</p><p>{$whmcs_link}<br />Email: {$client_email}<br />Password: {$client_password}</p><p>To change your password to something more memorable, after logging in go to My Details > Change Password.</p><p>{$signature}</p>', '', '', '', '', '', '', '', 0),
	(32, 'admin', 'Automatic Setup Failed', 'WHMCS Automatic Setup Failed', '<p>An order has received its first payment but the automatic provisioning has failed and requires you to manually check & resolve.</p>\r\n<p>Client ID: {$client_id}<br />{if $service_id}Service ID: {$service_id}<br />Product/Service: {$service_product}<br />Domain: {$service_domain}{else}Domain ID: {$domain_id}<br />Registration Type: {$domain_type}<br />Domain: {$domain_name}{/if}<br />Error: {$error_msg}</p>\r\n<p>{$whmcs_admin_link}</p>', '', '', '', '', '', '', '', 0),
	(33, 'admin', 'Automatic Setup Successful', 'WHMCS Automatic Setup Successful', '<p>An order has received its first payment and the product/service has been automatically provisioned successfully.</p>\r\n<p>Client ID: {$client_id}<br />{if $service_id}Service ID: {$service_id}<br />Product/Service: {$service_product}<br />Domain: {$service_domain}{else}Domain ID: {$domain_id}<br />Registration Type: {$domain_type}<br />Domain: {$domain_name}{/if}</p>\r\n<p>{$whmcs_admin_link}</p>', '', '', '', '', '', '', '', 0),
	(34, 'admin', 'Domain Renewal Failed', 'WHMCS Automatic Domain Renewal Failed', '<p>An invoice for the renewal of a domain has been paid but the renewal request submitted to the registrar failed.</p>\r\n<p>Client ID: {$client_id}<br />Domain ID: {$domain_id}<br />Domain Name: {$domain_name}<br />Error: {$error_msg}</p>\r\n<p>{$whmcs_admin_link}</p>', '', '', '', '', '', '', '', 0),
	(35, 'admin', 'Domain Renewal Successful', 'WHMCS Automatic Domain Renewal Successful', '<p>An invoice for the renewal of a domain has been paid and the renewal request was submitted to the registrar successfully.</p>\r\n<p>Client ID: {$client_id}<br />Domain ID: {$domain_id}<br />Domain Name: {$domain_name}</p>\r\n<p>{$whmcs_admin_link}</p>', '', '', '', '', '', '', '', 0),
	(36, 'admin', 'New Order Notification', 'WHMCS New Order Notification', '<p><strong>Order Information</strong></p>\r\n<p>Order ID: {$order_id}<br />\r\nOrder Number: {$order_number}<br />\r\nDate/Time: {$order_date}<br />\r\nInvoice Number: {$invoice_id}<br />\r\nPayment Method: {$order_payment_method}</p>\r\n<p><strong>Customer Information</strong></p>\r\n<p>Customer ID: {$client_id}<br />\r\nName: {$client_first_name} {$client_last_name}<br />\r\nEmail: {$client_email}<br />\r\nCompany: {$client_company_name}<br />\r\nAddress 1: {$client_address1}<br />\r\nAddress 2: {$client_address2}<br />\r\nCity: {$client_city}<br />\r\nState: {$client_state}<br />\r\nPostcode: {$client_postcode}<br />\r\nCountry: {$client_country}<br />\r\nPhone Number: {$client_phonenumber}</p>\r\n<p><strong>Order Items</strong></p>\r\n<p>{$order_items}</p>\r\n{if $order_notes}<p><strong>Order Notes</strong></p>\r\n<p>{$order_notes}</p>{/if}\r\n<p><strong>ISP Information</strong></p>\r\n<p>IP: {$client_ip}<br />\r\nHost: {$client_hostname}</p><p><a href="{$whmcs_admin_url}orders.php?action=view&id={$order_id}">{$whmcs_admin_url}orders.php?action=view&id={$order_id}</a></p>', '', '', '', '', '', '', '', 0),
	(37, 'admin', 'Service Unsuspension Failed', 'WHMCS Service Unsuspension Failed', '<p>This product/service has received its next payment but the automatic reactivation has failed.</p>\r\n<p>Client ID: {$client_id}<br />Service ID: {$service_id}<br />Product/Service: {$service_product}<br />Domain: {$service_domain}<br />Error: {$error_msg}</p>\r\n<p>{$whmcs_admin_link}</p>', '', '', '', '', '', '', '', 0),
	(38, 'admin', 'Service Unsuspension Successful', 'WHMCS Service Unsuspension Successful', '<p>This product/service has received its next payment and has been reactivated successfully.</p>\r\n<p>Client ID: {$client_id}<br />Service ID: {$service_id}<br />Product/Service: {$service_product}<br />Domain: {$service_domain}</p>\r\n<p>{$whmcs_admin_link}</p>', '', '', '', '', '', '', '', 0),
	(39, 'admin', 'Support Ticket Created', '[Ticket ID: {$ticket_tid}] New Support Ticket Opened', '<p>A new support ticket has been opened.</p>\r\n<p>Client: {$client_name}{if $client_id} #{$client_id}{/if}<br />Department: {$ticket_department}<br />Subject: {$ticket_subject}<br />Priority: {$ticket_priority}</p>\r\n<p>---<br />{$ticket_message}<br />---</p>\r\n<p>You can respond to this ticket by simply replying to this email or through the admin area at the url below.</p>\r\n<p><a href="{$whmcs_admin_url}supporttickets.php?action=viewticket&id={$ticket_id}">{$whmcs_admin_url}supporttickets.php?action=viewticket&id={$ticket_id}</a></p>', '', '', '', '', '', '', '', 0),
	(40, 'admin', 'Support Ticket Response', '[Ticket ID: {$ticket_tid}] New Support Ticket Response', '<p>A new support ticket response has been made.</p>\r\n<p>Client: {$client_name}{if $client_id} #{$client_id}{/if} <br />Department: {$ticket_department} <br />Subject: {$ticket_subject} <br />Priority: {$ticket_priority}</p>\r\n<p>--- <br />{$ticket_message} <br />---</p>\r\n<p>You can respond to this ticket by simply replying to this email or through the admin area at the url below.</p>\r\n<p><a href="{$whmcs_admin_url}supporttickets.php?action=viewticket&id={$ticket_id}">{$whmcs_admin_url}supporttickets.php?action=viewticket&id={$ticket_id}</a></p>', '', '', '', '', '', '', '', 0),
	(41, 'admin', 'New Cancellation Request', 'New Cancellation Request', '<p>A new cancellation request has been submitted.</p><p>Client ID: {$client_id}<br>Client Name: {$clientname}<br>Service ID: {$service_id}<br>Product Name: {$product_name}<br>Cancellation Type: {$service_cancellation_type}<br>Cancellation Reason: {$service_cancellation_reason}</p><p>{$whmcs_admin_link}</p>', '', '', '', '', '', '', '', 0),
	(42, 'admin', 'Support Ticket Flagged', 'New Support Ticket Flagged to You', '<p>A new support ticket has been flagged to you.</p><p>Ticket #: {$ticket_tid}<br>Client Name: {$client_name} (ID {$client_id})<br>Department: {$ticket_department}<br>Subject: {$ticket_subject}<br>Priority: {$ticket_priority}</p><p>----------------------<br />{$ticket_message}<br />----------------------</p><p><a href="{$whmcs_admin_url}supporttickets.php?action=viewticket&id={$ticket_id}">{$whmcs_admin_url}supporttickets.php?action=viewticket&id={$ticket_id}</a></p>', '', '', '', '', '', '', '', 0),
	(43, 'domain', 'Domain Transfer Failed', 'Domain Transfer Failed: {$domain_name}', '<p>Dear {$client_name},</p><p>Recently you placed a domain transfer order with us but unfortunately it has failed. The reason for the failure if available is shown below so once this has been resolved, please contact us to re-attempt the transfer.</p><p>Domain: {$domain_name}<br>Failure Reason: {$domain_transfer_failure_reason}</p><p>If you have any questions, please open a support ticket from our client area @ {$whmcs_link}</p><p>{$signature}</p>', '', '', '', '', '', '', '', 0),
	(44, 'general', 'Quote Accepted', 'Quote #{$quote_number} Accepted - {$quote_subject}', '<p>\r\nDear {$client_name}, \r\n</p>\r\n<p>\r\nThis is a confirmation that quote generated on {$quote_date_created} has been accepted by you and invoice # {$invoice_num} is generated.\r\n<p>\r\n{$signature} \r\n</p>', '', '', '', '', '', '', '', 0),
	(45, 'general', 'Quote Accepted Notification', 'Quote #{$quote_number} Accepted - {$quote_subject}', '<p>A quote has been accepted by the following customer.</p><p><strong>Customer Information</strong></p>\r\n<p>Customer ID: {$client_id}<br />\r\nName: {$clientname}<br />\r\nEmail: {$client_email}<br />\r\nCompany: {$client_company_name}<br />\r\nAddress 1: {$client_address1}<br />\r\nAddress 2: {$client_address2}<br />\r\nCity: {$client_city}<br />\r\nState: {$client_state}<br />\r\nPostcode: {$client_postcode}<br />\r\nCountry: {$client_country}<br />\r\nPhone Number: {$client_phonenumber}</p>\r\n<p><strong>Quote Information</strong></p>\r\n<p>Quote #: {$quote_number}<br />\r\nQuote Subject: {$quote_subject}</p><p><a href="{$whmcs_admin_url}quotes.php?action=manage&id={$quote_number}">{$whmcs_admin_url}quotes.php?action=manage&id={$quote_number}</a></p>', '', '', '', '', '', '', '', 0),
	(46, 'support', 'Replies Only Bounce Message', 'Online Submission Required', '<p>{$client_name},</p><p>Your email to our support system could not be accepted because we require you to submit all tickets via our online client support portal. You can do this at the URL below.</p><p><a href="{$whmcs_url}/submitticket.php">{$whmcs_url}/submitticket.php</a></p><p>{$signature}</p>', '', '', '', '', '', '', '', 0),
	(47, 'general', 'Unsubscribe Confirmation', 'Unsubscribe Confirmation', 'Dear {$client_name},<br /><br />We have now removed your email address from our mailing list.<br /><br />If this was a mistake or you change your mind, you can re-subscribe at any time from the My Details section of our client area.<br /><br /><a href="{$whmcs_url}/clientarea.php?action=details">{$whmcs_url}/clientarea.php?action=details</a><br /><br />{$signature}', '', '', '', '', '', '', '', 0);
/*!40000 ALTER TABLE `tblemailtemplates` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblfraud
CREATE TABLE IF NOT EXISTS `tblfraud` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fraud` text NOT NULL,
  `setting` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fraud` (`fraud`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblfraud: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblfraud` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfraud` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblhostingconfigoptions
CREATE TABLE IF NOT EXISTS `tblhostingconfigoptions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `relid` int(10) NOT NULL,
  `configid` int(10) NOT NULL,
  `optionid` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `relid_configid` (`relid`,`configid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblhostingconfigoptions: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblhostingconfigoptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblhostingconfigoptions` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblinvoiceitems
CREATE TABLE IF NOT EXISTS `tblinvoiceitems` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `invoiceid` int(10) NOT NULL DEFAULT '0',
  `userid` int(10) NOT NULL,
  `type` text NOT NULL,
  `relid` int(10) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `taxed` int(1) NOT NULL,
  `duedate` date DEFAULT NULL,
  `paymentmethod` text NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoiceid` (`invoiceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblinvoiceitems: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblinvoiceitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblinvoiceitems` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblknowledgebase
CREATE TABLE IF NOT EXISTS `tblknowledgebase` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `article` text NOT NULL,
  `views` int(10) NOT NULL DEFAULT '0',
  `useful` int(10) NOT NULL DEFAULT '0',
  `votes` int(10) NOT NULL DEFAULT '0',
  `private` text NOT NULL,
  `order` int(3) NOT NULL,
  `parentid` int(10) NOT NULL,
  `language` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblknowledgebase: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblknowledgebase` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblknowledgebase` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblknowledgebasecats
CREATE TABLE IF NOT EXISTS `tblknowledgebasecats` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parentid` int(10) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `description` text NOT NULL,
  `hidden` text NOT NULL,
  `catid` int(10) NOT NULL,
  `language` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`),
  KEY `name` (`name`(64))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblknowledgebasecats: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblknowledgebasecats` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblknowledgebasecats` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblknowledgebaselinks
CREATE TABLE IF NOT EXISTS `tblknowledgebaselinks` (
  `categoryid` int(10) NOT NULL,
  `articleid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblknowledgebaselinks: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblknowledgebaselinks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblknowledgebaselinks` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbllinks
CREATE TABLE IF NOT EXISTS `tbllinks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `clicks` int(10) NOT NULL,
  `conversions` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`(64))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbllinks: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbllinks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbllinks` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblmodulelog
CREATE TABLE IF NOT EXISTS `tblmodulelog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `module` text NOT NULL,
  `action` text NOT NULL,
  `request` text NOT NULL,
  `response` text NOT NULL,
  `arrdata` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblmodulelog: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblmodulelog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmodulelog` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblnetworkissues
CREATE TABLE IF NOT EXISTS `tblnetworkissues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `type` enum('Server','System','Other') NOT NULL,
  `affecting` varchar(100) DEFAULT NULL,
  `server` int(10) unsigned DEFAULT NULL,
  `priority` enum('Critical','Low','Medium','High') NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime DEFAULT NULL,
  `status` enum('Reported','Investigating','In Progress','Outage','Scheduled','Resolved') NOT NULL,
  `lastupdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblnetworkissues: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblnetworkissues` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblnetworkissues` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblnotes
CREATE TABLE IF NOT EXISTS `tblnotes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `adminid` int(10) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `note` text NOT NULL,
  `sticky` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblnotes: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblnotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblnotes` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblorders
CREATE TABLE IF NOT EXISTS `tblorders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ordernum` bigint(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `contactid` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `nameservers` text NOT NULL,
  `transfersecret` text NOT NULL,
  `renewals` text NOT NULL,
  `promocode` text NOT NULL,
  `promotype` text NOT NULL,
  `promovalue` text NOT NULL,
  `orderdata` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paymentmethod` text NOT NULL,
  `invoiceid` int(10) NOT NULL DEFAULT '0',
  `status` text NOT NULL,
  `ipaddress` text NOT NULL,
  `fraudmodule` text NOT NULL,
  `fraudoutput` text NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ordernum` (`ordernum`),
  KEY `userid` (`userid`),
  KEY `contactid` (`contactid`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblorders: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblorders` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblorders` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblorderstatuses
CREATE TABLE IF NOT EXISTS `tblorderstatuses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `color` text COLLATE utf8_unicode_ci NOT NULL,
  `showpending` int(1) NOT NULL,
  `showactive` int(1) NOT NULL,
  `showcancelled` int(1) NOT NULL,
  `sortorder` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table admin_develop.tblorderstatuses: ~4 rows (approximately)
/*!40000 ALTER TABLE `tblorderstatuses` DISABLE KEYS */;
REPLACE INTO `tblorderstatuses` (`id`, `title`, `color`, `showpending`, `showactive`, `showcancelled`, `sortorder`) VALUES
	(1, 'Pending', '#cc0000', 1, 0, 0, 10),
	(2, 'Active', '#779500', 0, 1, 0, 20),
	(3, 'Cancelled', '#888888', 0, 0, 1, 30),
	(4, 'Fraud', '#000000', 0, 0, 0, 40);
/*!40000 ALTER TABLE `tblorderstatuses` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblpaymentgateways
CREATE TABLE IF NOT EXISTS `tblpaymentgateways` (
  `gateway` text NOT NULL,
  `setting` text NOT NULL,
  `value` text NOT NULL,
  `order` int(1) NOT NULL,
  KEY `gateway_setting` (`gateway`(32),`setting`(32)),
  KEY `setting_value` (`setting`(32),`value`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblpaymentgateways: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblpaymentgateways` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpaymentgateways` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblpricing
CREATE TABLE IF NOT EXISTS `tblpricing` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` enum('product','addon','configoptions','domainregister','domaintransfer','domainrenew','domainaddons') NOT NULL,
  `currency` int(10) NOT NULL,
  `relid` int(10) NOT NULL,
  `msetupfee` decimal(10,2) NOT NULL,
  `qsetupfee` decimal(10,2) NOT NULL,
  `ssetupfee` decimal(10,2) NOT NULL,
  `asetupfee` decimal(10,2) NOT NULL,
  `bsetupfee` decimal(10,2) NOT NULL,
  `tsetupfee` decimal(10,2) NOT NULL,
  `monthly` decimal(10,2) NOT NULL,
  `quarterly` decimal(10,2) NOT NULL,
  `semiannually` decimal(10,2) NOT NULL,
  `annually` decimal(10,2) NOT NULL,
  `biennially` decimal(10,2) NOT NULL,
  `triennially` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblpricing: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblpricing` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpricing` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblproductconfiggroups
CREATE TABLE IF NOT EXISTS `tblproductconfiggroups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table admin_develop.tblproductconfiggroups: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblproductconfiggroups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproductconfiggroups` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblproductconfiglinks
CREATE TABLE IF NOT EXISTS `tblproductconfiglinks` (
  `gid` int(10) NOT NULL,
  `pid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table admin_develop.tblproductconfiglinks: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblproductconfiglinks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproductconfiglinks` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblproductconfigoptions
CREATE TABLE IF NOT EXISTS `tblproductconfigoptions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gid` int(10) NOT NULL DEFAULT '0',
  `optionname` text NOT NULL,
  `optiontype` text NOT NULL,
  `qtyminimum` int(10) NOT NULL,
  `qtymaximum` int(10) NOT NULL,
  `order` int(1) NOT NULL DEFAULT '0',
  `hidden` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productid` (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblproductconfigoptions: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblproductconfigoptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproductconfigoptions` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblproductconfigoptionssub
CREATE TABLE IF NOT EXISTS `tblproductconfigoptionssub` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `configid` int(10) NOT NULL,
  `optionname` text NOT NULL,
  `sortorder` int(10) NOT NULL DEFAULT '0',
  `hidden` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `configid` (`configid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblproductconfigoptionssub: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblproductconfigoptionssub` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproductconfigoptionssub` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblproductgroups
CREATE TABLE IF NOT EXISTS `tblproductgroups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `orderfrmtpl` text NOT NULL,
  `disabledgateways` text NOT NULL,
  `hidden` text NOT NULL,
  `order` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblproductgroups: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblproductgroups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproductgroups` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblproducts
CREATE TABLE IF NOT EXISTS `tblproducts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `gid` int(10) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `hidden` text NOT NULL,
  `showdomainoptions` text NOT NULL,
  `welcomeemail` int(1) NOT NULL DEFAULT '0',
  `stockcontrol` text NOT NULL,
  `qty` int(1) NOT NULL DEFAULT '0',
  `proratabilling` text NOT NULL,
  `proratadate` int(2) NOT NULL,
  `proratachargenextmonth` int(2) NOT NULL,
  `paytype` text NOT NULL,
  `allowqty` int(1) NOT NULL,
  `subdomain` text NOT NULL,
  `autosetup` text NOT NULL,
  `servertype` text NOT NULL,
  `servergroup` int(10) NOT NULL,
  `configoption1` text NOT NULL,
  `configoption2` text NOT NULL,
  `configoption3` text NOT NULL,
  `configoption4` text NOT NULL,
  `configoption5` text NOT NULL,
  `configoption6` text NOT NULL,
  `configoption7` text NOT NULL,
  `configoption8` text NOT NULL,
  `configoption9` text NOT NULL,
  `configoption10` text NOT NULL,
  `configoption11` text NOT NULL,
  `configoption12` text NOT NULL,
  `configoption13` text NOT NULL,
  `configoption14` text NOT NULL,
  `configoption15` text NOT NULL,
  `configoption16` text NOT NULL,
  `configoption17` text NOT NULL,
  `configoption18` text NOT NULL,
  `configoption19` text NOT NULL,
  `configoption20` text NOT NULL,
  `configoption21` text NOT NULL,
  `configoption22` text NOT NULL,
  `configoption23` text NOT NULL,
  `configoption24` text NOT NULL,
  `freedomain` text NOT NULL,
  `freedomainpaymentterms` text NOT NULL,
  `freedomaintlds` text NOT NULL,
  `recurringcycles` int(2) NOT NULL,
  `autoterminatedays` int(4) NOT NULL,
  `autoterminateemail` text NOT NULL,
  `upgradepackages` text NOT NULL,
  `configoptionsupgrade` text NOT NULL,
  `billingcycleupgrade` text NOT NULL,
  `upgradeemail` text NOT NULL,
  `overagesenabled` varchar(10) NOT NULL,
  `overagesdisklimit` int(10) NOT NULL,
  `overagesbwlimit` int(10) NOT NULL,
  `overagesdiskprice` decimal(6,4) NOT NULL,
  `overagesbwprice` decimal(6,4) NOT NULL,
  `tax` int(1) NOT NULL,
  `affiliateonetime` text NOT NULL,
  `affiliatepaytype` text NOT NULL,
  `affiliatepayamount` decimal(10,2) NOT NULL,
  `downloads` text NOT NULL,
  `order` int(1) NOT NULL,
  `retired` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`),
  KEY `name` (`name`(64))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblproducts: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblproducts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblproducts` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblpromotions
CREATE TABLE IF NOT EXISTS `tblpromotions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` text NOT NULL,
  `type` text NOT NULL,
  `recurring` int(1) DEFAULT NULL,
  `value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cycles` text NOT NULL,
  `appliesto` text NOT NULL,
  `requires` text NOT NULL,
  `requiresexisting` int(1) NOT NULL,
  `startdate` date NOT NULL,
  `expirationdate` date DEFAULT NULL,
  `maxuses` int(10) NOT NULL DEFAULT '0',
  `uses` int(10) NOT NULL DEFAULT '0',
  `lifetimepromo` int(1) NOT NULL,
  `applyonce` int(1) NOT NULL,
  `newsignups` int(1) NOT NULL,
  `existingclient` int(11) NOT NULL,
  `onceperclient` int(11) NOT NULL,
  `recurfor` int(3) NOT NULL,
  `upgrades` int(1) NOT NULL,
  `upgradeconfig` text NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblpromotions: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblpromotions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpromotions` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblquoteitems
CREATE TABLE IF NOT EXISTS `tblquoteitems` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `quoteid` int(10) NOT NULL,
  `description` text NOT NULL,
  `quantity` text NOT NULL,
  `unitprice` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `taxable` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblquoteitems: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblquoteitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblquoteitems` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblquotes
CREATE TABLE IF NOT EXISTS `tblquotes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `stage` enum('Draft','Delivered','On Hold','Accepted','Lost','Dead') NOT NULL,
  `validuntil` date NOT NULL,
  `userid` int(10) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `companyname` text NOT NULL,
  `email` text NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `postcode` text NOT NULL,
  `country` text NOT NULL,
  `phonenumber` text NOT NULL,
  `currency` int(10) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax1` decimal(10,2) NOT NULL,
  `tax2` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `proposal` text NOT NULL,
  `customernotes` text NOT NULL,
  `adminnotes` text NOT NULL,
  `datecreated` date NOT NULL,
  `lastmodified` date NOT NULL,
  `datesent` date NOT NULL,
  `dateaccepted` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblquotes: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblquotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblquotes` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblregistrars
CREATE TABLE IF NOT EXISTS `tblregistrars` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `registrar` text NOT NULL,
  `setting` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `registrar_setting` (`registrar`(32),`setting`(32))
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblregistrars: ~3 rows (approximately)
/*!40000 ALTER TABLE `tblregistrars` DISABLE KEYS */;
REPLACE INTO `tblregistrars` (`id`, `registrar`, `setting`, `value`) VALUES
	(7, 'bizcn', 'Username', 'cqP/V/xRfMQCp1ESiyjyT+g0mHMdE8sIiu0lIV3/E9Hv'),
	(8, 'bizcn', 'Password', '/GTMjH8eHubfGpHE0jXlXhXti0+80vPYA69PC9VB2Q=='),
	(9, 'bizcn', 'TestMode', 'e5eaV8JYjjaTNehR8bJyrHJfU88DIA==');
/*!40000 ALTER TABLE `tblregistrars` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblservergroups
CREATE TABLE IF NOT EXISTS `tblservergroups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `filltype` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblservergroups: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblservergroups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblservergroups` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblservergroupsrel
CREATE TABLE IF NOT EXISTS `tblservergroupsrel` (
  `groupid` int(10) NOT NULL,
  `serverid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblservergroupsrel: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblservergroupsrel` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblservergroupsrel` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblservers
CREATE TABLE IF NOT EXISTS `tblservers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `ipaddress` text NOT NULL,
  `assignedips` text NOT NULL,
  `hostname` text NOT NULL,
  `monthlycost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `noc` text NOT NULL,
  `statusaddress` text NOT NULL,
  `nameserver1` text NOT NULL,
  `nameserver1ip` text NOT NULL,
  `nameserver2` text NOT NULL,
  `nameserver2ip` text NOT NULL,
  `nameserver3` text NOT NULL,
  `nameserver3ip` text NOT NULL,
  `nameserver4` text NOT NULL,
  `nameserver4ip` text NOT NULL,
  `nameserver5` text NOT NULL,
  `nameserver5ip` text NOT NULL,
  `maxaccounts` int(10) NOT NULL DEFAULT '0',
  `type` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `accesshash` text NOT NULL,
  `secure` text NOT NULL,
  `active` int(1) NOT NULL,
  `disabled` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblservers: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblservers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblservers` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblsslorders
CREATE TABLE IF NOT EXISTS `tblsslorders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `serviceid` int(10) NOT NULL,
  `remoteid` text NOT NULL,
  `module` text NOT NULL,
  `certtype` text NOT NULL,
  `configdata` text NOT NULL,
  `provisiondate` date NOT NULL,
  `completiondate` datetime NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblsslorders: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblsslorders` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsslorders` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbltax
CREATE TABLE IF NOT EXISTS `tbltax` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `level` int(1) NOT NULL,
  `name` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `taxrate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `state_country` (`state`(32),`country`(2))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbltax: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbltax` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltax` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblticketbreaklines
CREATE TABLE IF NOT EXISTS `tblticketbreaklines` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `breakline` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblticketbreaklines: ~6 rows (approximately)
/*!40000 ALTER TABLE `tblticketbreaklines` DISABLE KEYS */;
REPLACE INTO `tblticketbreaklines` (`id`, `breakline`) VALUES
	(1, '> -----Original Message-----'),
	(2, '----- Original Message -----'),
	(3, '-----Original Message-----'),
	(4, '<!-- Break Line -->'),
	(5, '====== Please reply above this line ======'),
	(6, '_____');
/*!40000 ALTER TABLE `tblticketbreaklines` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblticketdepartments
CREATE TABLE IF NOT EXISTS `tblticketdepartments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `email` text NOT NULL,
  `clientsonly` text NOT NULL,
  `piperepliesonly` text NOT NULL,
  `noautoresponder` text NOT NULL,
  `hidden` text NOT NULL,
  `order` int(1) NOT NULL,
  `host` text NOT NULL,
  `port` text NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`(64))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblticketdepartments: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblticketdepartments` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblticketdepartments` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblticketescalations
CREATE TABLE IF NOT EXISTS `tblticketescalations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `departments` text NOT NULL,
  `statuses` text NOT NULL,
  `priorities` text NOT NULL,
  `timeelapsed` int(5) NOT NULL,
  `newdepartment` text NOT NULL,
  `newpriority` text NOT NULL,
  `newstatus` text NOT NULL,
  `flagto` text NOT NULL,
  `notify` text NOT NULL,
  `addreply` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblticketescalations: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblticketescalations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblticketescalations` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblticketfeedback
CREATE TABLE IF NOT EXISTS `tblticketfeedback` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ticketid` int(10) NOT NULL,
  `adminid` int(10) NOT NULL,
  `rating` int(2) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `ip` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table admin_develop.tblticketfeedback: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblticketfeedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblticketfeedback` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblticketlog
CREATE TABLE IF NOT EXISTS `tblticketlog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `tid` int(10) NOT NULL,
  `action` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblticketlog: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblticketlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblticketlog` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblticketmaillog
CREATE TABLE IF NOT EXISTS `tblticketmaillog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `to` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblticketmaillog: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblticketmaillog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblticketmaillog` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblticketpredefinedcats
CREATE TABLE IF NOT EXISTS `tblticketpredefinedcats` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parentid` int(10) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parentid_name` (`parentid`,`name`(64))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblticketpredefinedcats: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblticketpredefinedcats` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblticketpredefinedcats` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblticketpredefinedreplies
CREATE TABLE IF NOT EXISTS `tblticketpredefinedreplies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `catid` int(10) NOT NULL,
  `name` text NOT NULL,
  `reply` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblticketpredefinedreplies: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblticketpredefinedreplies` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblticketpredefinedreplies` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblticketreplies
CREATE TABLE IF NOT EXISTS `tblticketreplies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tid` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `contactid` int(10) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `date` datetime NOT NULL,
  `message` text NOT NULL,
  `admin` text NOT NULL,
  `attachment` text NOT NULL,
  `rating` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tid_date` (`tid`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblticketreplies: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblticketreplies` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblticketreplies` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblticketspamfilters
CREATE TABLE IF NOT EXISTS `tblticketspamfilters` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` enum('sender','subject','phrase') NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblticketspamfilters: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblticketspamfilters` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblticketspamfilters` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblticketstatuses
CREATE TABLE IF NOT EXISTS `tblticketstatuses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `color` text NOT NULL,
  `sortorder` int(2) NOT NULL,
  `showactive` int(1) NOT NULL,
  `showawaiting` int(1) NOT NULL,
  `autoclose` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblticketstatuses: ~6 rows (approximately)
/*!40000 ALTER TABLE `tblticketstatuses` DISABLE KEYS */;
REPLACE INTO `tblticketstatuses` (`id`, `title`, `color`, `sortorder`, `showactive`, `showawaiting`, `autoclose`) VALUES
	(1, 'Open', '#779500', 1, 1, 1, 0),
	(2, 'Answered', '#000000', 2, 1, 0, 1),
	(3, 'Customer-Reply', '#ff6600', 3, 1, 1, 1),
	(4, 'Closed', '#888888', 10, 0, 0, 0),
	(5, 'On Hold', '#224488', 5, 1, 0, 0),
	(6, 'In Progress', '#cc0000', 6, 1, 0, 0);
/*!40000 ALTER TABLE `tblticketstatuses` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbltickettags
CREATE TABLE IF NOT EXISTS `tbltickettags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ticketid` int(10) NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table admin_develop.tbltickettags: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbltickettags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltickettags` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbltodolist
CREATE TABLE IF NOT EXISTS `tbltodolist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `admin` int(10) NOT NULL DEFAULT '0',
  `status` text NOT NULL,
  `duedate` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `duedate` (`duedate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbltodolist: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbltodolist` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltodolist` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tbltransientdata
CREATE TABLE IF NOT EXISTS `tbltransientdata` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) NOT NULL,
  `data` text NOT NULL,
  `expires` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tbltransientdata: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbltransientdata` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbltransientdata` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblupgrades
CREATE TABLE IF NOT EXISTS `tblupgrades` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `orderid` int(10) NOT NULL,
  `type` text NOT NULL,
  `date` date NOT NULL,
  `relid` int(10) NOT NULL,
  `originalvalue` text NOT NULL,
  `newvalue` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `recurringchange` decimal(10,2) NOT NULL,
  `status` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `paid` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `orderid` (`orderid`),
  KEY `serviceid` (`relid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblupgrades: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblupgrades` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblupgrades` ENABLE KEYS */;

-- Dumping structure for table admin_develop.tblwhoislog
CREATE TABLE IF NOT EXISTS `tblwhoislog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `domain` text NOT NULL,
  `ip` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table admin_develop.tblwhoislog: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblwhoislog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblwhoislog` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
