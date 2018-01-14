
-- DROP TABLE IF EXISTS `tabname`;
-- varchar 可变型,必须设置长度,最大长度65535
-- char 定长度,最高255字符
--用户表,关联WHMCS的 tblclients
DROP TABLE IF EXISTS `ddweb_clients_user`;
CREATE TABLE `ddweb_clients_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `whmcs_tkval` VARCHAR(32) NOT NULL COMMENT 'whmcs_tkval',
  `whmcs_uid` int(11) NOT NULL COMMENT 'whmcs用户ID',
  `u_web_user` int(11) default NULL COMMENT '用户id',
  `u_token` varchar(64) default NULL COMMENT 'api token',
  `u_api_use_count` varchar(255) default NULL COMMENT 'api使用记录',
  `u_api_consume` double default NULL COMMENT 'api消费统计',
  `u_time` timestamp default '0000-00-00 00:00:00' NULL COMMENT '用户创建时间',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `ddweb_clients_user`;
CREATE TABLE `ddweb_clients_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_stat` int(1) default NULL COMMENT '用户状态',
  `u_web_user` int(11) default NULL COMMENT '用户id',
  `u_token` varchar(64) default NULL COMMENT 'api token',
  `u_api_use_count` varchar(255) default NULL COMMENT 'api使用记录',
  `u_api_consume` double default NULL COMMENT 'api消费统计',
  `u_time` timestamp default NULL COMMENT '用户创建时间',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--INSERT INTO `student` VALUES ('7', '重阳节', '33', '登高赏菊');