# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.42)
# Database: yii_admin
# Generation Time: 2017-06-30 09:53:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table yii_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `yii_admin`;

CREATE TABLE `yii_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL DEFAULT '' COMMENT '身份验证码',
  `password_hash` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `real_name` varchar(20) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `mobile` bigint(11) unsigned NOT NULL DEFAULT '0' COMMENT '手机号',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `create_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  `last_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上一次登录时间',
  `last_ip` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上一次登录IP',
  `status` tinyint(1) unsigned zerofill NOT NULL DEFAULT '1' COMMENT '状态 1正常 2禁用',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='管理员表';

LOCK TABLES `yii_admin` WRITE;
/*!40000 ALTER TABLE `yii_admin` DISABLE KEYS */;

INSERT INTO `yii_admin` (`id`, `username`, `auth_key`, `password_hash`, `real_name`, `mobile`, `email`, `create_id`, `last_at`, `last_ip`, `status`, `created_at`)
VALUES
	(1,'admin','9u_mzCfygUHZUJN7eDWzVbEME_nc3dZf','$2y$13$ndFwFszlfmiB4/4zgTOZOeMMGmbcRieoGXlWaJOA6xhiZWsDT/UfK','超级管理员',13141234768,'13141234768@163.com',1,1498702260,2130706433,1,1498635989),
	(4,'test123456','P5E0FKvCUpo_5f4EHZgxnvVx28jeT9OB','$2y$13$KIDd/YB2/6rNWm0ABAYW7uz5nwaY.rMf.YdzgnA/SN3MyuJFuMyzq','测试账号',13123456789,'1234567890@qq.com',1,1498816266,2130706433,1,1498707912);

/*!40000 ALTER TABLE `yii_admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table yii_auth_assignment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `yii_auth_assignment`;

CREATE TABLE `yii_auth_assignment` (
  `item_name` varchar(64) NOT NULL DEFAULT '' COMMENT '角色',
  `admin_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`item_name`,`admin_id`),
  CONSTRAINT `md_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `yii_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员用户表';

LOCK TABLES `yii_auth_assignment` WRITE;
/*!40000 ALTER TABLE `yii_auth_assignment` DISABLE KEYS */;

INSERT INTO `yii_auth_assignment` (`item_name`, `admin_id`, `created_at`)
VALUES
	('普通用户',4,1498792424),
	('超级管理员',1,1498784219);

/*!40000 ALTER TABLE `yii_auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table yii_auth_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `yii_auth_item`;

CREATE TABLE `yii_auth_item` (
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '权限,角色',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '类型 1-角色 2-权限',
  `describe` varchar(64) NOT NULL DEFAULT '' COMMENT '描述',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限角色表';

LOCK TABLES `yii_auth_item` WRITE;
/*!40000 ALTER TABLE `yii_auth_item` DISABLE KEYS */;

INSERT INTO `yii_auth_item` (`name`, `type`, `describe`, `created_at`)
VALUES
	('admin/create',2,'管理员创建',1498785080),
	('admin/delete',2,'管理员删除',1498813582),
	('admin/list',2,'管理员信息',1498784196),
	('admin/update',2,'管理员更新',1498813563),
	('admin/view',2,'管理员查看',1498785079),
	('menu/create',2,'菜单创建',1498815600),
	('menu/delete',2,'菜单删除',1498815679),
	('menu/list',2,'菜单管理',1498784219),
	('menu/update',2,'菜单更新',1498815664),
	('menu/view',2,'菜单查看',1498815628),
	('operate/list',2,'操作日志管理',1498784223),
	('permission/create',2,'权限创建',1498815229),
	('permission/delete',2,'权限删除',1498815272),
	('permission/list',2,'权限管理',1498784211),
	('permission/update',2,'权限更新',1498815247),
	('role/auth',2,'分配权限',1498815199),
	('role/create',2,'角色创建',1498815046),
	('role/delete',2,'角色删除',1498815183),
	('role/list',2,'角色管理',1498784200),
	('role/update',2,'角色更新',1498815101),
	('system',2,'系统管理',1498784188),
	('普通用户',1,'只有查看部分菜单的权限',1498721936),
	('超级管理员',1,'具有所有的权限，拥有更改系统的权限',1498707912);

/*!40000 ALTER TABLE `yii_auth_item` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table yii_auth_item_child
# ------------------------------------------------------------

DROP TABLE IF EXISTS `yii_auth_item_child`;

CREATE TABLE `yii_auth_item_child` (
  `parent` varchar(64) NOT NULL DEFAULT '' COMMENT '角色',
  `child` varchar(64) NOT NULL DEFAULT '' COMMENT '权限',
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `md_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `yii_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `md_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `yii_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限关系表';

LOCK TABLES `yii_auth_item_child` WRITE;
/*!40000 ALTER TABLE `yii_auth_item_child` DISABLE KEYS */;

INSERT INTO `yii_auth_item_child` (`parent`, `child`)
VALUES
	('admin/list','admin/create'),
	('超级管理员','admin/create'),
	('admin/list','admin/delete'),
	('普通用户','admin/list'),
	('超级管理员','admin/list'),
	('admin/list','admin/update'),
	('admin/list','admin/view'),
	('普通用户','admin/view'),
	('menu/list','menu/create'),
	('menu/list','menu/delete'),
	('普通用户','menu/list'),
	('超级管理员','menu/list'),
	('menu/list','menu/update'),
	('menu/list','menu/view'),
	('普通用户','menu/view'),
	('普通用户','operate/list'),
	('超级管理员','operate/list'),
	('permission/list','permission/create'),
	('permission/list','permission/delete'),
	('普通用户','permission/list'),
	('超级管理员','permission/list'),
	('permission/list','permission/update'),
	('role/list','role/auth'),
	('role/list','role/create'),
	('role/list','role/delete'),
	('普通用户','role/list'),
	('超级管理员','role/list'),
	('role/list','role/update'),
	('普通用户','system'),
	('超级管理员','system');

/*!40000 ALTER TABLE `yii_auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table yii_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `yii_menu`;

CREATE TABLE `yii_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `icon` varchar(32) NOT NULL DEFAULT '' COMMENT '图标',
  `route` varchar(64) NOT NULL DEFAULT '' COMMENT '路由规则',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

LOCK TABLES `yii_menu` WRITE;
/*!40000 ALTER TABLE `yii_menu` DISABLE KEYS */;

INSERT INTO `yii_menu` (`id`, `name`, `pid`, `icon`, `route`, `sort`, `created_at`)
VALUES
	(1,'系统管理',0,'fa-cog','system',1,0),
	(2,'管理员信息',1,'','admin/list',1,0),
	(3,'角色管理',1,'','role/list',2,0),
	(4,'权限管理',1,'','permission/list',3,0),
	(5,'菜单管理',1,'','menu/list',4,0),
	(6,'操作日志管理',1,'','operate/list',5,0);

/*!40000 ALTER TABLE `yii_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table yii_operate_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `yii_operate_log`;

CREATE TABLE `yii_operate_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `operate_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '操作ID',
  `type` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '操作类型',
  `module` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '操作模块',
  `describe` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT 'NUll' COMMENT '操作描述',
  `admin_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '操作人',
  `ip` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'IP',
  `created_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `INDEX_OPERATE` (`type`,`module`,`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='操作日志表';

LOCK TABLES `yii_operate_log` WRITE;
/*!40000 ALTER TABLE `yii_operate_log` DISABLE KEYS */;

INSERT INTO `yii_operate_log` (`id`, `operate_id`, `type`, `module`, `describe`, `admin_id`, `ip`, `created_at`)
VALUES
	(1,10,2,4,'',1,2130706433,1498470063),
	(2,10,2,4,'',1,2130706433,1498471379),
	(3,12,1,4,'',1,2130706433,1498471400),
	(4,12,3,4,'',1,2130706433,1498471478),
	(5,8,3,4,'',1,2130706433,1498471533),
	(6,1,7,4,'',1,2130706433,1498471558),
	(7,13,1,4,'',1,2130706433,1498471916),
	(8,13,3,4,'',1,2130706433,1498471923),
	(9,1,7,4,'',1,2130706433,1498521496),
	(10,12,1,4,'',1,2130706433,1498635916),
	(11,12,3,4,'',1,2130706433,1498635989),
	(12,0,1,2,'',1,2130706433,1498721179),
	(13,0,1,2,'创建角色',1,2130706433,1498721936),
	(14,0,2,2,'更新角色',1,2130706433,1498721978),
	(15,0,2,2,'更新角色',1,2130706433,1498722010),
	(16,0,2,2,'更新角色( 普通用户 )',1,2130706433,1498722277),
	(17,0,2,2,'( 普通用户 )',1,2130706433,1498722356),
	(18,1,2,4,'',1,2130706433,1498784061),
	(19,1,2,4,'',1,2130706433,1498784188),
	(20,2,2,4,'',1,2130706433,1498784196),
	(21,3,2,4,'',1,2130706433,1498784201),
	(22,4,2,4,'',1,2130706433,1498784211),
	(23,5,2,4,'',1,2130706433,1498784219),
	(24,6,2,4,'',1,2130706433,1498784223),
	(25,11,3,4,'',1,2130706433,1498784630),
	(26,10,3,4,'',1,2130706433,1498784633),
	(27,9,3,4,'',1,2130706433,1498784636),
	(28,7,3,4,'',1,2130706433,1498784638),
	(29,0,1,3,'( admin/create )',1,2130706433,1498785080),
	(30,4,2,1,'',1,2130706433,1498791576),
	(31,4,2,1,'',1,2130706433,1498792424),
	(32,0,4,2,'( 超级管理员 )',1,2130706433,1498807891),
	(33,0,4,2,'( 超级管理员 )',1,2130706433,1498807979),
	(34,0,4,2,'( 超级管理员 )',1,2130706433,1498807983),
	(35,7,1,4,'',1,2130706433,1498811883),
	(36,8,1,4,'',1,2130706433,1498811926),
	(37,9,1,4,'',1,2130706433,1498811953),
	(38,0,4,2,'( 普通用户 )',1,2130706433,1498812026),
	(39,4,2,1,'',4,2130706433,1498812100),
	(40,0,1,3,'( admin/update )',1,2130706433,1498813563),
	(41,0,1,3,'( admin/delete )',1,2130706433,1498813582),
	(42,0,1,3,'( admin/view )',1,2130706433,1498813622),
	(43,0,4,2,'( 普通用户 )',1,2130706433,1498813632),
	(44,8,3,4,'',1,2130706433,1498814968),
	(45,9,3,4,'',1,2130706433,1498814976),
	(46,7,3,4,'',1,2130706433,1498814978),
	(47,0,1,3,'( role/create )',1,2130706433,1498815046),
	(48,0,1,3,'( role/update )',1,2130706433,1498815101),
	(49,0,1,3,'( role/delete )',1,2130706433,1498815183),
	(50,0,1,3,'( role/auth )',1,2130706433,1498815199),
	(51,0,1,3,'( permission/create )',1,2130706433,1498815229),
	(52,0,1,3,'( permission/update )',1,2130706433,1498815247),
	(53,0,1,3,'( permission/delete )',1,2130706433,1498815272),
	(54,0,1,3,'( menu/view )',1,2130706433,1498815628),
	(55,0,1,3,'( menu/create )',1,2130706433,1498815645),
	(56,0,1,3,'( menu/update )',1,2130706433,1498815664),
	(57,0,1,3,'( menu/delete )',1,2130706433,1498815679),
	(58,0,4,2,'( 普通用户 )',1,2130706433,1498815718),
	(59,4,2,1,'',1,2130706433,1498815809),
	(60,0,4,2,'( 普通用户 )',1,2130706433,1498816247);

/*!40000 ALTER TABLE `yii_operate_log` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
