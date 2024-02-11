/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : carpass

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 08/07/2020 09:20:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for xman_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `xman_admin_user`;
CREATE TABLE `xman_admin_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户账号',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `register_time` datetime(0) NOT NULL DEFAULT '1990-10-10 00:00:00',
  `age` tinyint(3) NOT NULL DEFAULT 0,
  `birthday` date NOT NULL DEFAULT '1990-10-10',
  `sex` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:男,0:女',
  `isdel` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:被删除 1 未被删除',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '预留字段',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xman_admin_user
-- ----------------------------
INSERT INTO `xman_admin_user` VALUES (2, 'admin11', '$2y$10$sUo9d.WTUwzlMwn/kzEtM.Z5drArRtcV2kda.qzAkTsZQqhEhJpTO', '176124388881', '123@qq.com1', 'Admin', '1990-10-10 00:00:00', 0, '1990-10-16', 1, 0, 1);
INSERT INTO `xman_admin_user` VALUES (16, 'testdemo1', '$2y$10$4N6V9FpbLdd0kQseIj.B0eD/jcviniUcrOUjGNAsUEsZ4M9Q8eOpS', '17612312', '123123', '测试账号', '1990-10-10 00:00:00', 0, '2018-06-11', 1, 0, 1);
INSERT INTO `xman_admin_user` VALUES (17, 'testdemo', '$2y$10$sUo9d.WTUwzlMwn/kzEtM.Z5drArRtcV2kda.qzAkTsZQqhEhJpTO', '18812345678', 'i@xiny9.com', 'TestUser', '1990-10-10 00:00:00', 0, '2018-07-10', 1, 0, 1);

-- ----------------------------
-- Table structure for xman_api
-- ----------------------------
DROP TABLE IF EXISTS `xman_api`;
CREATE TABLE `xman_api`  (
  `id` int(10) NOT NULL,
  `time` int(10) DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `project` int(10) DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `api` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `savetime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xman_api
-- ----------------------------
INSERT INTO `xman_api` VALUES (1, 120, 'htp://www.baidu.com', 12217, 'api-4h9BIdRn', 'Keke0819', 'B1ECA6C890B2B5E54E676ED2E6515290A8', 'http://www.huli667.com:81/sms/api/', '0', 'msg', 'phone', 'sms', '1594171224');

-- ----------------------------
-- Table structure for xman_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `xman_auth_group`;
CREATE TABLE `xman_auth_group`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '角色描述',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `rules` varchar(2048) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xman_auth_group
-- ----------------------------
INSERT INTO `xman_auth_group` VALUES (1, '超级管理员', '拥有所有权限', 1, '27,154,29,12,65,66,17,1,2,5,6,10,18,41,42,43,32,37,38,39,40,19,44,45,46,47,48,50,149,150,151,152,153,156,157');
INSERT INTO `xman_auth_group` VALUES (5, 'testdemo', '展示所用角色组', 1, '27,116,117,118,164,165,166,172,173,174,29,12,63,65,67,17,1,18,32,19,47,48,159,145,146,147,151,152,153,154,163');

-- ----------------------------
-- Table structure for xman_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `xman_auth_group_access`;
CREATE TABLE `xman_auth_group_access`  (
  `uid` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  UNIQUE INDEX `uid_group_id`(`uid`, `group_id`) USING BTREE,
  INDEX `uid`(`uid`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xman_auth_group_access
-- ----------------------------
INSERT INTO `xman_auth_group_access` VALUES (1, 1);
INSERT INTO `xman_auth_group_access` VALUES (2, 1);
INSERT INTO `xman_auth_group_access` VALUES (15, 1);
INSERT INTO `xman_auth_group_access` VALUES (17, 5);
INSERT INTO `xman_auth_group_access` VALUES (18, 1);
INSERT INTO `xman_auth_group_access` VALUES (19, 1);

-- ----------------------------
-- Table structure for xman_auth_menus
-- ----------------------------
DROP TABLE IF EXISTS `xman_auth_menus`;
CREATE TABLE `xman_auth_menus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '菜单名字',
  `pid` int(11) NOT NULL DEFAULT 0 COMMENT '0父级菜单',
  `rule_id` int(11) NOT NULL DEFAULT 0 COMMENT '绑定的规则id url',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'iconfont icon-menu1' COMMENT '菜单图标',
  `target` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '打开位置',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xman_auth_menus
-- ----------------------------
INSERT INTO `xman_auth_menus` VALUES (1, '内容管理', 0, 27, 'iconfont xman-file-text', 'default');
INSERT INTO `xman_auth_menus` VALUES (39, '卡密管理', 1, 150, 'iconfont xman-menu', 'default');
INSERT INTO `xman_auth_menus` VALUES (40, '接口设置', 1, 154, 'iconfont xman-menu', 'default');
INSERT INTO `xman_auth_menus` VALUES (41, '公告设置', 1, 156, 'iconfont xman-menu', 'default');

-- ----------------------------
-- Table structure for xman_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `xman_auth_rule`;
CREATE TABLE `xman_auth_rule`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否支持表达式 1支持',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `condition` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '表达式',
  `is_url` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0：不是url 1：url',
  `pid` int(11) NOT NULL DEFAULT 0 COMMENT '父级权限',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 158 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xman_auth_rule
-- ----------------------------
INSERT INTO `xman_auth_rule` VALUES (1, 'admin/auth/rule', '规则管理', 1, 1, '', 1, 17);
INSERT INTO `xman_auth_rule` VALUES (2, 'admin/auth/add_rule', '添加规则', 1, 1, '', 0, 1);
INSERT INTO `xman_auth_rule` VALUES (5, 'admin/auth/fast_change_rule', '快速更改规则状态', 1, 1, '', 0, 1);
INSERT INTO `xman_auth_rule` VALUES (6, 'admin/auth/edit_rule', '修改规则', 1, 1, '', 0, 1);
INSERT INTO `xman_auth_rule` VALUES (10, 'admin/auth/del_rule', '删除规则', 1, 1, '', 0, 1);
INSERT INTO `xman_auth_rule` VALUES (12, 'system_log', '系统日志', 1, 1, '', 0, 29);
INSERT INTO `xman_auth_rule` VALUES (17, 'auth', '权限管理', 1, 1, '', 0, 29);
INSERT INTO `xman_auth_rule` VALUES (18, 'admin/auth/admin_user', '用户管理', 1, 1, '', 1, 17);
INSERT INTO `xman_auth_rule` VALUES (19, 'admin/auth/menus', '菜单管理', 1, 1, '', 1, 29);
INSERT INTO `xman_auth_rule` VALUES (27, 'content', '内容管理', 1, 1, '', 0, 0);
INSERT INTO `xman_auth_rule` VALUES (29, 'system', '系统设置', 1, 1, '', 0, 0);
INSERT INTO `xman_auth_rule` VALUES (32, 'admin/auth/group', '角色组管理', 1, 1, '', 1, 17);
INSERT INTO `xman_auth_rule` VALUES (37, 'admin/auth/add_group', '添加角色组', 1, 1, '', 0, 32);
INSERT INTO `xman_auth_rule` VALUES (38, 'admin/auth/edit_group', '修改角色组', 1, 1, '', 0, 32);
INSERT INTO `xman_auth_rule` VALUES (39, 'admin/auth/del_group', '删除角色组', 1, 1, '', 0, 32);
INSERT INTO `xman_auth_rule` VALUES (40, 'admin/auth/fast_change_group', '快速修改角色组', 1, 1, '', 0, 32);
INSERT INTO `xman_auth_rule` VALUES (41, 'admin/auth/add_admin', '添加后台用户', 1, 1, '', 0, 18);
INSERT INTO `xman_auth_rule` VALUES (42, 'admin/auth/edit_admin', '修改后台用户', 1, 1, '', 0, 18);
INSERT INTO `xman_auth_rule` VALUES (43, 'admin/auth/del_admin', '删除后台用户', 1, 1, '', 0, 18);
INSERT INTO `xman_auth_rule` VALUES (44, 'admin/auth/add_menu', '添加菜单', 1, 1, '', 0, 19);
INSERT INTO `xman_auth_rule` VALUES (45, 'admin/auth/edit_menu', '修改菜单', 1, 1, '', 0, 19);
INSERT INTO `xman_auth_rule` VALUES (46, 'admin/auth/del_menu', '删除菜单', 1, 1, '', 0, 19);
INSERT INTO `xman_auth_rule` VALUES (47, 'admin/auth/change_menu_sort', '菜单排序', 1, 1, '', 0, 19);
INSERT INTO `xman_auth_rule` VALUES (48, 'admin/makecode/index', '代码生成器', 1, 1, '', 1, 29);
INSERT INTO `xman_auth_rule` VALUES (50, 'admin/makecode/make', '生成代码', 1, 1, '', 1, 48);
INSERT INTO `xman_auth_rule` VALUES (65, 'admin/systemloginlog/index', '登录日志', 1, 1, '', 1, 12);
INSERT INTO `xman_auth_rule` VALUES (66, 'admin/systemloginlog/delete', '删除登录日志', 1, 1, '', 0, 65);
INSERT INTO `xman_auth_rule` VALUES (149, 'admin/index/changepass', '修改密码', 1, 1, '', 0, 0);
INSERT INTO `xman_auth_rule` VALUES (150, 'admin/code/index', '卡密管理', 1, 1, '', 1, 0);
INSERT INTO `xman_auth_rule` VALUES (151, 'admin/code/add', '卡密/添加', 1, 1, '', 0, 150);
INSERT INTO `xman_auth_rule` VALUES (152, 'admin/code/edit', '卡密/修改', 1, 1, '', 0, 150);
INSERT INTO `xman_auth_rule` VALUES (153, 'admin/code/delete', '卡密/删除', 1, 1, '', 0, 150);
INSERT INTO `xman_auth_rule` VALUES (154, 'admin/api/index', '接口设置', 1, 1, '', 1, 27);
INSERT INTO `xman_auth_rule` VALUES (156, 'admin/notice/index', 'Notice管理', 1, 1, '', 1, 0);
INSERT INTO `xman_auth_rule` VALUES (157, 'admin/notice/edit', 'Notice/修改', 1, 1, '', 0, 156);

-- ----------------------------
-- Table structure for xman_code
-- ----------------------------
DROP TABLE IF EXISTS `xman_code`;
CREATE TABLE `xman_code`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '卡密',
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0' COMMENT '状态:0=未使用,1=已使用',
  `addtime` datetime(0) DEFAULT NULL COMMENT '添加时间',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '使用手机号',
  `sms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '短信内容',
  `usertime` datetime(0) DEFAULT NULL COMMENT '使用时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '卡密' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xman_code
-- ----------------------------
INSERT INTO `xman_code` VALUES (27, '14EYT6Kc4cp4fpNbGAbsdoAJFLPYxFjn', '1', '2020-07-07 11:36:02', '16565056702', '[PUBG]?验证码689453。验证码有效3分钟', '2020-07-08 08:48:49');
INSERT INTO `xman_code` VALUES (26, 'N3A612WvIDjry0RyxkxhQJRXiAMKIP1g', '1', '2020-07-07 11:36:02', '16565056698', '[PUBG]?验证码395726。验证码有效3分钟', '2020-07-07 21:40:15');
INSERT INTO `xman_code` VALUES (25, 'rIOy1oxnJgVaYcYq9Jt5M6dKYVJZ4Bfa', '1', '2020-07-07 11:36:02', '13834288634', '[PUBG]?验证码893645。验证码有效3分钟', '2020-07-08 08:51:51');
INSERT INTO `xman_code` VALUES (24, '5E3Kg66gprisH2SpnvOHDmtmEgyWDuC4', '0', '2020-07-07 11:36:02', NULL, NULL, NULL);
INSERT INTO `xman_code` VALUES (23, 'k11GM26AY3e5QSsc54X4O43gtANsbXDn', '0', '2020-07-07 11:36:02', NULL, NULL, NULL);
INSERT INTO `xman_code` VALUES (22, '3OY8YTbVRxaqXbQcmrAd9oyvQgitc0Da', '0', '2020-07-07 11:36:02', NULL, NULL, NULL);
INSERT INTO `xman_code` VALUES (21, 'izRxx1NUXP3OoLHL7KrKqS0ZagiZgQKV', '1', '2020-07-07 11:36:02', '16565056152', '[PUBG]?验证码213694。验证码有效3分钟', '2020-07-08 08:41:44');
INSERT INTO `xman_code` VALUES (20, 'QpwTsvVdZV0GmHVpV40S4yTQHlDZyEtb', '0', '2020-07-07 11:36:02', NULL, NULL, NULL);
INSERT INTO `xman_code` VALUES (19, 'yaL6FbpgkaX8Y3WNwF9HixWd7vEZMFnQ', '0', '2020-07-07 11:36:02', NULL, NULL, NULL);
INSERT INTO `xman_code` VALUES (18, 'zdXI4OygCu5RXoOkMj2JXOGpKwuo0Bf8', '0', '2020-07-07 11:36:02', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for xman_notice
-- ----------------------------
DROP TABLE IF EXISTS `xman_notice`;
CREATE TABLE `xman_notice`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '顶部公告',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT '底部公告',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xman_notice
-- ----------------------------
INSERT INTO `xman_notice` VALUES (1, '这是顶部公告这是顶部公告这是顶部公告这是顶部公告这是顶部公告这是顶部公告这是顶部公告这是顶部公告这是顶部公告这是顶部公告这是顶部公告这是顶部公告', '&lt;div style=&quot;text-align: center;&quot;&gt;&lt;p&gt;输入卡密点击无反应，刷新网页等五秒，或者更换浏览器即可解决&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;/div&gt;&lt;div style=&quot;text-align: center;&quot;&gt;&lt;p&gt;有任何问题联系上级或者投诉，非常感谢大家，有问题一定要反馈到上级投诉&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;/div&gt;&lt;div style=&quot;text-align: center;&quot;&gt;&lt;p&gt;卡密激活未接收验证码卡密永不作废，只有卡密接收到验证码卡密才会作废，第一次使用请点击使用说明&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;/div&gt;&lt;div style=&quot;text-align: center;&quot;&gt;&lt;p&gt;获取到的手机号一定要等到120秒后再刷新网页，获取验证码120秒内禁止刷新网页，每个手机号请等待120秒，如果120秒未接验证码请重新获取手机号。&lt;/p&gt;&lt;/div&gt;');

-- ----------------------------
-- Table structure for xman_system_login_log
-- ----------------------------
DROP TABLE IF EXISTS `xman_system_login_log`;
CREATE TABLE `xman_system_login_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_user_id` int(11) NOT NULL COMMENT '管理员账号',
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT 'IP地址',
  `os` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '' COMMENT '操作系统',
  `browser` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '浏览器型号',
  `logtime` datetime(0) NOT NULL COMMENT '登录时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2084 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xman_system_login_log
-- ----------------------------
INSERT INTO `xman_system_login_log` VALUES (1, 2, '127.0.0.1', '', '谷歌浏览器', '2018-07-22 12:34:43');
INSERT INTO `xman_system_login_log` VALUES (2, 2, '127.0.0.1', 'Windows NT 10.0', 'Chrome/67.0.3396.99', '2018-07-22 15:04:58');
INSERT INTO `xman_system_login_log` VALUES (3, 2, '127.0.0.1', 'Windows NT 10.0', 'Chrome/67.0.3396.99', '2018-07-22 19:35:58');
INSERT INTO `xman_system_login_log` VALUES (4, 2, '127.0.0.1', 'Windows NT 10.0', 'Chrome/67.0.3396.99', '2018-07-22 19:36:05');
INSERT INTO `xman_system_login_log` VALUES (2078, 2, '127.0.0.1', 'Windows NT 10.0', 'Chrome/75.0.3770.100', '2019-10-29 09:43:00');
INSERT INTO `xman_system_login_log` VALUES (2079, 2, '127.0.0.1', 'Windows NT 10.0', 'Chrome/78.0.3904.70', '2019-10-29 14:49:31');
INSERT INTO `xman_system_login_log` VALUES (2080, 2, '127.0.0.1', 'Windows NT 10.0', 'Chrome/83.0.4103.106', '2020-06-27 16:00:12');
INSERT INTO `xman_system_login_log` VALUES (2081, 2, '127.0.0.1', 'Windows NT 10.0', 'Chrome/75.0.3770.100', '2020-07-02 21:30:56');
INSERT INTO `xman_system_login_log` VALUES (2082, 2, '127.0.0.1', 'Windows NT 10.0', 'Chrome/83.0.4103.106', '2020-07-07 17:18:10');
INSERT INTO `xman_system_login_log` VALUES (2083, 2, '127.0.0.1', 'Windows NT 10.0', 'Chrome/83.0.4103.106', '2020-07-08 08:52:25');

-- ----------------------------
-- Table structure for xman_system_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `xman_system_operation_log`;
CREATE TABLE `xman_system_operation_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '操作名称',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '访问地址',
  `way_state` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '访问方式:0=GET,1=POST,2=AJAX',
  `usetime` float(12, 6) NOT NULL DEFAULT 0.000000 COMMENT '耗时(s)',
  `usemem` float(18, 6) NOT NULL DEFAULT 0.000000 COMMENT '使用内存(kb)',
  `result` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '操作结果:0=失败,1=成功',
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '提示信息',
  `admin_user_id` int(11) NOT NULL COMMENT '管理员',
  `createtime` datetime(0) NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4567 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xman_system_operation_log
-- ----------------------------
INSERT INTO `xman_system_operation_log` VALUES (4546, '接口设置', 'http://www.carpass.com/admin/Api/index?s=admin/Api/index', '1', 0.001259, 8.000000, '1', '���ӳɹ�', 2, '2020-07-06 19:51:04');
INSERT INTO `xman_system_operation_log` VALUES (4547, '卡密/删除', 'http://www.carpass.com/admin/Code/delete?s=admin/Code/delete', '1', 0.001688, 7.000000, '1', '删除成功', 2, '2020-07-07 11:35:57');
INSERT INTO `xman_system_operation_log` VALUES (4548, '添加规则', 'http://www.car.com/admin/auth/add_rule?s=admin/auth/add_rule', '1', 0.031233, 3.000000, '1', '添加成功', 2, '2020-07-07 22:12:52');
INSERT INTO `xman_system_operation_log` VALUES (4549, '修改角色组', 'http://www.car.com/admin/auth/edit_group?s=admin/auth/edit_group', '1', 0.023991, 7.000000, '1', '操作成功', 2, '2020-07-07 22:14:04');
INSERT INTO `xman_system_operation_log` VALUES (4550, '添加菜单', 'http://www.car.com/admin/auth/add_menu?s=admin/auth/add_menu', '1', 0.020859, 7.000000, '1', '操作成功', 2, '2020-07-07 22:14:25');
INSERT INTO `xman_system_operation_log` VALUES (4551, '生成代码', 'http://www.car.com/admin/Makecode/make?s=admin/Makecode/make', '1', 0.002212, 42.000000, '0', 'F:/phpstudy_pro/WWW/carpass/Application/Admin/Controller/NoticeController.class.php 文件已存在，请删除或者使用覆盖模式', 2, '2020-07-07 22:25:45');
INSERT INTO `xman_system_operation_log` VALUES (4552, '生成代码', 'http://www.car.com/admin/Makecode/make?s=admin/Makecode/make', '1', 0.001832, 42.000000, '0', 'F:/phpstudy_pro/WWW/carpass/Application/Admin/Controller/NoticeController.class.php 文件已存在，请删除或者使用覆盖模式', 2, '2020-07-07 22:25:49');
INSERT INTO `xman_system_operation_log` VALUES (4553, '生成代码', 'http://www.car.com/admin/Makecode/make?s=admin/Makecode/make', '1', 0.063459, 25.000000, '1', '<span style=\'color:green\'>成功</span> F:/phpstudy_pro/WWW/carpass/Application/Admin/Controller/NoticeController.class.php <br><span style=\'color:green\'>成功</span> F:/phpstudy_pro/WWW/carpass/Application/Admin/View/Notice/edit.html <br><span style=\'color:green\'>成功</span> F:/phpstudy_pro/WWW/carpass/Application/Admin/View/Notice/index.html <br>规则：<br>admin/notice/index<br>admin/notice/edit<br>规则创建<span class=\'layui-blue\'>成功</span><br>请自行创建菜单、绑定规则，以及角色组授权', 2, '2020-07-07 22:25:52');
INSERT INTO `xman_system_operation_log` VALUES (4554, '修改角色组', 'http://www.car.com/admin/auth/edit_group?s=admin/auth/edit_group', '1', 0.032266, 7.000000, '1', '操作成功', 2, '2020-07-07 22:26:17');
INSERT INTO `xman_system_operation_log` VALUES (4555, '修改菜单', 'http://www.car.com/admin/auth/edit_menu?s=admin/auth/edit_menu', '1', 0.024186, 7.000000, '1', '操作成功', 2, '2020-07-07 22:26:31');
INSERT INTO `xman_system_operation_log` VALUES (4556, 'Notice/修改', 'http://www.car.com/admin/Notice/edit?s=admin/Notice/edit', '1', 0.002059, 9.000000, '1', '操作成功', 2, '2020-07-07 22:29:05');
INSERT INTO `xman_system_operation_log` VALUES (4557, 'Notice/修改', 'http://www.car.com/admin/Notice/edit?s=admin/Notice/edit', '1', 0.001115, 9.000000, '1', '操作成功', 2, '2020-07-07 22:31:52');
INSERT INTO `xman_system_operation_log` VALUES (4558, '删除菜单', 'http://www.car.com/admin/auth/del_menu?s=admin/auth/del_menu', '1', 0.030794, 5.000000, '1', '删除成功', 2, '2020-07-08 08:52:55');
INSERT INTO `xman_system_operation_log` VALUES (4559, '删除菜单', 'http://www.car.com/admin/auth/del_menu?s=admin/auth/del_menu', '1', 0.034311, 5.000000, '1', '删除成功', 2, '2020-07-08 08:53:14');
INSERT INTO `xman_system_operation_log` VALUES (4560, '删除菜单', 'http://www.car.com/admin/auth/del_menu?s=admin/auth/del_menu', '1', 0.034671, 5.000000, '1', '删除成功', 2, '2020-07-08 08:53:20');
INSERT INTO `xman_system_operation_log` VALUES (4561, '删除菜单', 'http://www.car.com/admin/auth/del_menu?s=admin/auth/del_menu', '1', 0.028409, 5.000000, '1', '删除成功', 2, '2020-07-08 08:53:26');
INSERT INTO `xman_system_operation_log` VALUES (4562, '删除菜单', 'http://www.car.com/admin/auth/del_menu?s=admin/auth/del_menu', '1', 0.011376, 5.000000, '1', '删除成功', 2, '2020-07-08 08:53:31');
INSERT INTO `xman_system_operation_log` VALUES (4563, '删除菜单', 'http://www.car.com/admin/auth/del_menu?s=admin/auth/del_menu', '1', 0.028590, 5.000000, '1', '删除成功', 2, '2020-07-08 08:53:34');
INSERT INTO `xman_system_operation_log` VALUES (4564, '删除菜单', 'http://www.car.com/admin/auth/del_menu?s=admin/auth/del_menu', '1', 0.010365, 5.000000, '1', '删除成功', 2, '2020-07-08 08:53:37');
INSERT INTO `xman_system_operation_log` VALUES (4565, '删除菜单', 'http://www.car.com/admin/auth/del_menu?s=admin/auth/del_menu', '1', 0.027183, 5.000000, '1', '删除成功', 2, '2020-07-08 08:53:40');
INSERT INTO `xman_system_operation_log` VALUES (4566, '删除菜单', 'http://www.car.com/admin/auth/del_menu?s=admin/auth/del_menu', '1', 0.011405, 5.000000, '1', '删除成功', 2, '2020-07-08 08:53:43');

-- ----------------------------
-- Table structure for xman_system_skin
-- ----------------------------
DROP TABLE IF EXISTS `xman_system_skin`;
CREATE TABLE `xman_system_skin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `framecolor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '框架颜色',
  `topcolor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '顶部背景',
  `leftcolor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '左侧背景',
  `topbottomcolor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '顶部底边',
  `menucolor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '三级菜单',
  `user_id` int(11) DEFAULT 0 COMMENT '用户ID',
  `state` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '2' COMMENT '皮肤类型:1=系统主题,2=用户主题',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '皮肤名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xman_system_skin
-- ----------------------------
INSERT INTO `xman_system_skin` VALUES (7, '#019688', '#23262e', '#393d49', '#5fb878', '#2b2e37', 0, '1', 'layui风格');
INSERT INTO `xman_system_skin` VALUES (10, '#409eff', '#23262e', '#393d49', '#c9c9c9', '#2b2e37', 0, '1', 'element风格');
INSERT INTO `xman_system_skin` VALUES (12, '#d25757', '#23262e', '#393d49', '#f79b40', '#2b2e37', 0, '1', '活力少女');
INSERT INTO `xman_system_skin` VALUES (16, '#cc3366', '#23262e', '#393d49', '#e36467', '#2b2e37', 0, '1', '玫红');
INSERT INTO `xman_system_skin` VALUES (20, '#eeca00', '#23262e', '#393d49', '#505050', '#2b2e37', 0, '1', '土豪金');
INSERT INTO `xman_system_skin` VALUES (31, '#ef0f0f', '#06f059', '#0de0f4', '#2727b6', '#bb0bd6', 0, '1', '辣眼睛');
INSERT INTO `xman_system_skin` VALUES (35, '#01aaed', '#23262e', '#393d49', '#ffd700', '#2b2e37', 0, '1', '默认');

-- ----------------------------
-- Table structure for xman_test
-- ----------------------------
DROP TABLE IF EXISTS `xman_test`;
CREATE TABLE `xman_test`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `week` enum('monday','tuesday','wednesday') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'monday' COMMENT '星期:monday=星期一,tuesday=星期二,wednesday=星期三',
  `genderdata` enum('male','female') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'male' COMMENT '性别:male=男,female=女',
  `textarea` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片',
  `attachfile` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '附件',
  `keywords` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '关键字',
  `price` float(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '价格',
  `startdate` date NOT NULL COMMENT '开始日期',
  `activitytime` datetime(0) NOT NULL COMMENT '活动时间(datetime)',
  `year` year NOT NULL COMMENT '年',
  `times` time(0) NOT NULL COMMENT '时间',
  `switch` tinyint(1) NOT NULL DEFAULT 1 COMMENT '上架状态:0=下架,1=正常',
  `ttswitch` tinyint(1) NOT NULL DEFAULT 0 COMMENT '开关:0=OFF,1=ON',
  `teststate` set('1','2','3') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '测试复选:1=选项1,2=选项2,3=选项3,',
  `test2state` set('0','1','2') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '2' COMMENT '爱好:0=唱歌,1=跳舞,2=嫖娼',
  `editor_content` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '富文本',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `test`(`keywords`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '测试表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of xman_test
-- ----------------------------
INSERT INTO `xman_test` VALUES (34, 'wednesday', 'male', 'test内容112', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180904/5b8e4c306b210.jpg', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180908/5b93dc91e6658.PNG', 'test x-man', 99.80, '2018-07-25', '2018-07-25 22:16:40', 2018, '22:16:43', 1, 0, '1,2,3', '0,1', '&lt;p style=&quot;text-align: left;&quot;&gt;&lt;img alt=&quot;[嘻嘻]&quot; src=&quot;https://x.imxiny.com/Public/static/layui/images/face/1.gif&quot;&gt;本控制器完全由代码生成器生成！&lt;/p&gt;&lt;p&gt;&lt;b&gt;&lt;i&gt;&lt;u&gt;&lt;strike&gt;11111111111111&lt;/strike&gt;&lt;/u&gt;&lt;/i&gt;&lt;/b&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt;22222222222222&lt;img alt=&quot;login-top.jpg&quot; src=&quot;https://testyao.oss-cn-beijing.aliyuncs.com/images/20180813/5b7199f6b0635.jpg&quot;&gt;&lt;/b&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt;&lt;img alt=&quot;1.png&quot; src=&quot;https://testyao.oss-cn-beijing.aliyuncs.com/images/20180725/5b588676172a1.png&quot;&gt;&lt;br&gt;&lt;/b&gt;&lt;/p&gt;');
INSERT INTO `xman_test` VALUES (35, 'monday', 'male', '123', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180725/5b588694bbe48.png', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180725/5b58869b8fb63.png', '123', 0.00, '2018-07-25', '2018-07-25 22:18:04', 2018, '22:18:08', 1, 1, '1', '0', '');
INSERT INTO `xman_test` VALUES (36, 'monday', 'male', '123', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180726/5b59528c98d61.jpg', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180726/5b595290eef32.jpg', '1231', 0.00, '2018-07-26', '2018-07-26 12:48:16', 2018, '12:48:19', 0, 0, '1,2', '0,1', '123&lt;img src=&quot;http://x.imxiny.com/Public/static/layui/images/face/26.gif&quot; alt=&quot;[怒]&quot;&gt;&lt;img src=&quot;http://x.imxiny.com/Public/static/layui/images/face/66.gif&quot; alt=&quot;[奥特曼]&quot;&gt;');
INSERT INTO `xman_test` VALUES (37, 'monday', 'female', '55', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180801/5b6114e01121e.png', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180801/5b6114c22fde0.txt', 'yyy', 0.00, '2018-08-01', '2018-08-01 10:02:51', 2018, '10:02:55', 0, 0, '1,2', '0,1', 'uyuyy');
INSERT INTO `xman_test` VALUES (38, 'monday', 'female', '423t', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180816/5b756f63bf2b4.png', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180816/5b756f6c0f7d3.png', '432', 0.03, '2018-08-16', '2018-08-30 00:00:00', 2018, '20:35:10', 1, 1, '1', '0,1,2', '&lt;img src=&quot;https://testyao.oss-cn-beijing.aliyuncs.com/images/20180905/5b8fcd68398f6.jpg&quot; alt=&quot;ebec-fzcyxmv1244862.jpg&quot;&gt;');

-- ----------------------------
-- Table structure for xman_update_log
-- ----------------------------
DROP TABLE IF EXISTS `xman_update_log`;
CREATE TABLE `xman_update_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '更新内容',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '图片',
  `addtime` datetime(0) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xman_update_log
-- ----------------------------
INSERT INTO `xman_update_log` VALUES (1, '修改菜单管理图标选择样式', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180816/5b752d8ac9f48.png', '2018-08-15 19:04:04');
INSERT INTO `xman_update_log` VALUES (3, '顶部标签栏添加右键菜单包含刷新、关闭等功能', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180816/5b7589437fdd3.png', '2018-08-16 22:25:08');
INSERT INTO `xman_update_log` VALUES (4, '左侧导航栏增加搜索功能', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180816/5b7594def0e9f.png', '2018-08-16 23:14:39');
INSERT INTO `xman_update_log` VALUES (5, '代码生成器增加color控件，IE不支持', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180818/5b77d6265b55b.png', '2018-08-18 16:17:42');
INSERT INTO `xman_update_log` VALUES (6, '强大的可定制皮肤功能，自己制作专属皮肤,系统内置了几种风格，有更好的配色请联系我', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180818/5b77d642ee31d.png', '2018-08-18 16:18:43');
INSERT INTO `xman_update_log` VALUES (7, '菜单、权限管理引入treetable', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180822/5b7d2dbf74325.png', '2018-08-22 17:32:44');
INSERT INTO `xman_update_log` VALUES (8, '恭喜layui更新2.4，本框架今晚升级，啊哈哈哈😁😁😁😁', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180828/5b851520753e2.png', '2018-08-28 17:25:54');
INSERT INTO `xman_update_log` VALUES (9, '新版layui,还是等等吧，没有那么好。https://fly.layui.com/jie/32937/', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180828/5b855f3d30657.png', '2018-08-28 22:42:04');
INSERT INTO `xman_update_log` VALUES (10, 'layui升级到v2.4.1，皮肤修改做了调整。其他升级不够稳定，未使用', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180829/5b868e8aa6038.png', '2018-08-29 20:16:08');
INSERT INTO `xman_update_log` VALUES (11, '添加NProgress网站整体进度条，用代码生成器做出的页面都包含此效果', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180904/5b8deb7c97ef4.png', '2018-09-03 21:03:03');
INSERT INTO `xman_update_log` VALUES (12, 'layui版本2.4.1 =&gt; 2.4.3 左侧导航动态滚动条', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180904/5b8e935899999.png', '2018-09-04 22:15:25');
INSERT INTO `xman_update_log` VALUES (13, '代码生成器添加多表支持。可到内容管理-文章管理进行体验。更多详情到代码生成器中查看！', 'https://testyao.oss-cn-beijing.aliyuncs.com/images/20180912/5b98cb1592e66.jpg', '2018-09-12 16:15:15');

SET FOREIGN_KEY_CHECKS = 1;
