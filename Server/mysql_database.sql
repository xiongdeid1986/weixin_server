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



-- Dumping data for table admin_develop.tblwhoislog: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblwhoislog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblwhoislog` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
