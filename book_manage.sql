/*
 Navicat Premium Data Transfer

 Source Server         : 本地数据库
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : book_manage

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 01/07/2020 20:50:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for access
-- ----------------------------
DROP TABLE IF EXISTS `access`;
CREATE TABLE `access`  (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of access
-- ----------------------------
INSERT INTO `access` VALUES (1, '管理员', '0,2,4,5,6,8');
INSERT INTO `access` VALUES (2, '普通用户', '0,1,3,7');

-- ----------------------------
-- Table structure for book
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book`  (
  `isbn` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '国际标准书号',
  `call_num` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '索书号',
  `book_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图书名',
  `book_author` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图书作者',
  `publisher` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '出版社',
  `cate_id` int(255) NULL DEFAULT NULL COMMENT '分类',
  `price` decimal(10, 2) NULL DEFAULT NULL COMMENT '价格',
  `book_status` tinyint(255) NULL DEFAULT 0 COMMENT '状态（0可借，1不可借）',
  `quantity` int(255) NULL DEFAULT NULL COMMENT '数量',
  `lend_times` int(13) NULL DEFAULT 0 COMMENT '借阅次数',
  `brrow_nums` int(255) NULL DEFAULT NULL COMMENT '已借出数量',
  PRIMARY KEY (`isbn`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES ('9787010147147', '1-1001', '乡土中国1', '费孝通', '人民出版社', 1, 21.00, 0, 2, 0, 0);
INSERT INTO `book` VALUES ('9787111251217', '3-1001', '编译原理（第2版）', '阿霍', '机械工业出版社', 3, 89.00, 0, 3, 0, 0);
INSERT INTO `book` VALUES ('9787111558422', '3-1002', 'Go程序设计语言', '艾伦A. A. 多诺万', '机械工业出版社', 3, 71.90, 0, 2, 0, 0);
INSERT INTO `book` VALUES ('9787111599715', '3-1003', '计算机网络：自顶向下方法', '詹姆斯·F.库罗斯', '机械工业出版社', 3, 89.00, 0, 2, 0, 0);
INSERT INTO `book` VALUES ('9787111641247', '3-1004', '深入理解Java虚拟机：JVM高级特性与最佳实践', '周志明', '机械工业出版社', 3, 129.00, 0, 2, 0, 0);
INSERT INTO `book` VALUES ('9787115472588', '3-1005', '鸟哥的Linux私房菜 基础学习篇 第四版', '鸟哥', '人民邮电出版社', 3, 118.00, 0, 2, 0, 0);
INSERT INTO `book` VALUES ('9787208140820', '2-1001', '痛苦的中国人', '彼得·汉德克', '上海人民出版社', 2, 49.00, 0, 3, 0, 0);
INSERT INTO `book` VALUES ('9787302423287', '3-1006', '机器学习', '周志华', '清华大学出版社', 3, 88.00, 0, 2, 0, 0);
INSERT INTO `book` VALUES ('9787506380263', '1-1002', '人间失格', '太宰治', '作家出版社', 1, 25.00, 0, 2, 0, 0);
INSERT INTO `book` VALUES ('9787506382502', '2-1002', '瓦尔登湖', '亨利戴维梭罗', '作家出版社', 2, 25.00, 0, 2, 0, 0);
INSERT INTO `book` VALUES ('9787508353944', '3-1007', '深入理解LINUX内核（第三版）', '博韦，西斯特', '中国电力出版社', 3, 98.00, 0, 1, 0, 0);
INSERT INTO `book` VALUES ('9787508690469', '2-1003', '切尔诺贝利的祭祷', 'S.A.阿列克谢耶维奇', '中信出版社', 2, 58.00, 0, 2, 0, 0);
INSERT INTO `book` VALUES ('9787530212912', '4-1001', '楼兰', '井上靖', '北京十月文艺出版社', 4, 25.00, 0, 1, 0, 0);
INSERT INTO `book` VALUES ('9787544278843', '2-1004', '当我谈跑步时，我谈些什么', '村上春树', '南海出版公司', 2, 35.90, 0, 2, 0, 0);
INSERT INTO `book` VALUES ('9787800806063', '1-1003', '厚黑学', '李宗吾', '群言出版社', 1, 29.80, 0, 2, 0, 0);

-- ----------------------------
-- Table structure for cate
-- ----------------------------
DROP TABLE IF EXISTS `cate`;
CREATE TABLE `cate`  (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`cate_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cate
-- ----------------------------
INSERT INTO `cate` VALUES (1, '社会');
INSERT INTO `cate` VALUES (2, '外国随笔');
INSERT INTO `cate` VALUES (3, '计算机');
INSERT INTO `cate` VALUES (4, '历史');
INSERT INTO `cate` VALUES (13, '测试');
INSERT INTO `cate` VALUES (14, '测试111');

-- ----------------------------
-- Table structure for lend_info
-- ----------------------------
DROP TABLE IF EXISTS `lend_info`;
CREATE TABLE `lend_info`  (
  `lend_id` int(255) NOT NULL AUTO_INCREMENT COMMENT '借阅id',
  `user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '读者id',
  `isbn` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '国际图书号',
  `lend_time` timestamp(0) NULL DEFAULT current_timestamp(0) COMMENT '借出时间',
  `return_time` varchar(0) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '应还时间',
  `lend_status` tinyint(1) NULL DEFAULT NULL COMMENT '状态（待批准1，批准2，未批准3，申请归还4，已归还5，借阅取消6）',
  `admin_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '管理员id',
  PRIMARY KEY (`lend_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lend_info
-- ----------------------------
INSERT INTO `lend_info` VALUES (1, '1', '9787010147147', '2020-06-29 10:40:03', NULL, 3, '2');
INSERT INTO `lend_info` VALUES (2, '1', '9787010147147', '2020-06-30 10:43:58', NULL, 5, '2');
INSERT INTO `lend_info` VALUES (3, '1', '9787111251217', '2020-06-30 15:18:02', NULL, 5, '2');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` tinyint(255) NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `href` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (0, '首页', 1, 'layui-icon layui-icon-home', 'view/console/console1.php');
INSERT INTO `menu` VALUES (1, '图书信息', 1, 'layui-icon layui-icon-read', 'view/book/book.html');
INSERT INTO `menu` VALUES (2, '图书管理', 1, 'layui-icon layui-icon-read', 'view/book/book_manage.php');
INSERT INTO `menu` VALUES (3, '我的借阅', 1, 'layui-icon layui-icon-key', 'view/lend/lend_info.html');
INSERT INTO `menu` VALUES (4, '借阅管理', 1, 'layui-icon layui-icon-key', 'view/lend/lend_manage.html');
INSERT INTO `menu` VALUES (5, '用户管理', 1, 'layui-icon layui-icon-user', 'view/user_manage/user.html');
INSERT INTO `menu` VALUES (6, '分类管理', 1, 'layui-icon layui-icon-template-1', 'view/book/cate_manage.php');
INSERT INTO `menu` VALUES (7, '我的信息', 1, 'layui-icon layui-icon-user', 'view/person/person.html');
INSERT INTO `menu` VALUES (8, '系统管理', 1, 'layui-icon layui-icon-set', 'view/console/system.html');

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `release_time` datetime(0) NULL DEFAULT current_timestamp(0),
  `admin_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notice
-- ----------------------------
INSERT INTO `notice` VALUES (1, '123123', '123123', '2020-06-29 13:23:07', '2');
INSERT INTO `notice` VALUES (2, '123123', '123123123', '2020-06-29 13:25:17', '2');
INSERT INTO `notice` VALUES (3, '2342', '4234234234', '2020-06-29 13:26:06', '2');
INSERT INTO `notice` VALUES (4, '测试公告', '测试公告测试公告测试公告测试公告测试公告测试公告测试公告测试公告', '2020-06-29 14:01:39', '2');
INSERT INTO `notice` VALUES (5, '测试公告222', '测试公告测试公告测试公告测试公告测试公告测试公告测试公告测试公告', '2020-06-29 14:01:43', '2');
INSERT INTO `notice` VALUES (6, '测试公告121212', '测试公告测试公告测试公告测试公告测试公告测试公告测试公告测试公告', '2020-06-29 14:01:48', '2');
INSERT INTO `notice` VALUES (7, '测试公告1231231', '测试公告测试公告测试公告测试公告测试公告测试公告测试公告测试公告', '2020-06-29 14:01:52', '2');
INSERT INTO `notice` VALUES (8, '测试公告5555', '测试公告测试公告测试公告测试公告测试公告测试公告测试公告测试公告', '2020-06-29 14:01:59', '2');
INSERT INTO `notice` VALUES (9, '测试111111', '11111', '2020-06-30 15:21:52', '2');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(255) NOT NULL AUTO_INCREMENT COMMENT '读者id',
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '读者名',
  `tel` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '电话',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `user_status` tinyint(1) NULL DEFAULT 1 COMMENT '状态，1正常，0封禁',
  `borrow_times` int(13) NULL DEFAULT 0 COMMENT '借阅次数',
  `overdue_times` int(13) NULL DEFAULT 0 COMMENT '超期未还次数',
  `access_id` int(1) NULL DEFAULT 2,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'pmh111', '13012345678', 'qwer@qq.com', 'cf79ae6addba60ad018347359bd144d2', 1, 5, 0, 2);
INSERT INTO `user` VALUES (2, 'admin', '', '', '5d93ceb70e2bf5daa84ec3d0cd2c731a', 1, 0, 0, 1);

SET FOREIGN_KEY_CHECKS = 1;
