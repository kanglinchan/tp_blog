/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2016-10-01 01:00:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_access
-- ----------------------------
DROP TABLE IF EXISTS `blog_access`;
CREATE TABLE `blog_access` (
  `role_id` smallint(6) unsigned NOT NULL COMMENT '角色ID',
  `node_id` smallint(6) unsigned NOT NULL COMMENT '节点ID',
  `level` tinyint(1) NOT NULL,
  `module` varchar(45) NOT NULL DEFAULT '',
  KEY `grounp_id` (`role_id`),
  KEY `node_id` (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of blog_access
-- ----------------------------
INSERT INTO `blog_access` VALUES ('7', '7', '1', '');
INSERT INTO `blog_access` VALUES ('7', '13', '2', '');
INSERT INTO `blog_access` VALUES ('7', '14', '3', '');
INSERT INTO `blog_access` VALUES ('7', '8', '1', '');
INSERT INTO `blog_access` VALUES ('7', '10', '2', '');
INSERT INTO `blog_access` VALUES ('7', '11', '3', '');
INSERT INTO `blog_access` VALUES ('7', '18', '2', '');
INSERT INTO `blog_access` VALUES ('7', '19', '3', '');
INSERT INTO `blog_access` VALUES ('8', '7', '1', '');
INSERT INTO `blog_access` VALUES ('8', '13', '2', '');
INSERT INTO `blog_access` VALUES ('8', '14', '3', '');
INSERT INTO `blog_access` VALUES ('8', '8', '1', '');
INSERT INTO `blog_access` VALUES ('8', '18', '2', '');
INSERT INTO `blog_access` VALUES ('8', '19', '3', '');
INSERT INTO `blog_access` VALUES ('11', '7', '1', '');
INSERT INTO `blog_access` VALUES ('11', '13', '2', '');
INSERT INTO `blog_access` VALUES ('11', '14', '3', '');
INSERT INTO `blog_access` VALUES ('14', '7', '1', '');
INSERT INTO `blog_access` VALUES ('14', '13', '2', '');
INSERT INTO `blog_access` VALUES ('14', '14', '3', '');
INSERT INTO `blog_access` VALUES ('14', '22', '1', '');
INSERT INTO `blog_access` VALUES ('14', '23', '2', '');
INSERT INTO `blog_access` VALUES ('14', '24', '3', '');
INSERT INTO `blog_access` VALUES ('14', '25', '3', '');
INSERT INTO `blog_access` VALUES ('14', '26', '3', '');
INSERT INTO `blog_access` VALUES ('14', '27', '3', '');
INSERT INTO `blog_access` VALUES ('14', '28', '3', '');
INSERT INTO `blog_access` VALUES ('14', '29', '3', '');
INSERT INTO `blog_access` VALUES ('14', '31', '3', '');
INSERT INTO `blog_access` VALUES ('14', '32', '3', '');
INSERT INTO `blog_access` VALUES ('14', '33', '3', '');
INSERT INTO `blog_access` VALUES ('14', '34', '3', '');
INSERT INTO `blog_access` VALUES ('14', '35', '3', '');
INSERT INTO `blog_access` VALUES ('14', '36', '3', '');
INSERT INTO `blog_access` VALUES ('14', '37', '2', '');
INSERT INTO `blog_access` VALUES ('14', '38', '3', '');
INSERT INTO `blog_access` VALUES ('16', '22', '1', '');
INSERT INTO `blog_access` VALUES ('16', '23', '2', '');
INSERT INTO `blog_access` VALUES ('16', '24', '3', '');
INSERT INTO `blog_access` VALUES ('16', '25', '3', '');
INSERT INTO `blog_access` VALUES ('16', '26', '3', '');
INSERT INTO `blog_access` VALUES ('16', '27', '3', '');
INSERT INTO `blog_access` VALUES ('16', '28', '3', '');
INSERT INTO `blog_access` VALUES ('16', '29', '3', '');
INSERT INTO `blog_access` VALUES ('16', '31', '3', '');
INSERT INTO `blog_access` VALUES ('16', '32', '3', '');
INSERT INTO `blog_access` VALUES ('16', '33', '3', '');
INSERT INTO `blog_access` VALUES ('16', '34', '3', '');
INSERT INTO `blog_access` VALUES ('16', '35', '3', '');
INSERT INTO `blog_access` VALUES ('16', '36', '3', '');
INSERT INTO `blog_access` VALUES ('16', '37', '2', '');
INSERT INTO `blog_access` VALUES ('16', '38', '3', '');
INSERT INTO `blog_access` VALUES ('16', '39', '2', '');
INSERT INTO `blog_access` VALUES ('16', '40', '3', '');
INSERT INTO `blog_access` VALUES ('16', '41', '3', '');
INSERT INTO `blog_access` VALUES ('16', '42', '3', '');
INSERT INTO `blog_access` VALUES ('16', '43', '3', '');
INSERT INTO `blog_access` VALUES ('16', '44', '3', '');
INSERT INTO `blog_access` VALUES ('16', '45', '3', '');
INSERT INTO `blog_access` VALUES ('16', '46', '3', '');

-- ----------------------------
-- Table structure for blog_album
-- ----------------------------
DROP TABLE IF EXISTS `blog_album`;
CREATE TABLE `blog_album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '相册id',
  `title` char(12) NOT NULL DEFAULT '' COMMENT '相册名称',
  `cover` varchar(120) NOT NULL DEFAULT '' COMMENT '封面图片',
  `status` tinyint(4) NOT NULL COMMENT '是否显示',
  `u_id` int(11) NOT NULL COMMENT '外键关联user表',
  PRIMARY KEY (`id`),
  KEY `foreign_u_id` (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of blog_album
-- ----------------------------
INSERT INTO `blog_album` VALUES ('5', '罗素', '/uploads/cover/2016-09/07/57cfdc6f49a31.jpg', '1', '38');
INSERT INTO `blog_album` VALUES ('7', '妈的四九', '/uploads/cover/2016-09/07/57cfdca89f038.jpg', '1', '38');
INSERT INTO `blog_album` VALUES ('4', '康德是的是的', '/uploads/cover/2016-09/07/57cffaafb6987.jpg', '1', '38');
INSERT INTO `blog_album` VALUES ('8', '康德', '/uploads/cover/2016-09/07/57cfdd3901a32.jpg', '0', '38');
INSERT INTO `blog_album` VALUES ('9', '孟德斯鸠', '/uploads/cover/2016-09/07/57cfe0842b1a2.jpg', '1', '38');
INSERT INTO `blog_album` VALUES ('10', 'ffffff打发打发', '/uploads/cover/2016-09/07/57cffa3d76cd4.jpg', '0', '38');
INSERT INTO `blog_album` VALUES ('17', '地方大幅度发', '/uploads/cover/2016-09/09/57d2b370a6be3.jpg', '1', '1');

-- ----------------------------
-- Table structure for blog_article
-- ----------------------------
DROP TABLE IF EXISTS `blog_article`;
CREATE TABLE `blog_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` text NOT NULL COMMENT '文章内容',
  `cover` varchar(80) NOT NULL DEFAULT '' COMMENT '封面',
  `user_id` varchar(20) NOT NULL DEFAULT '' COMMENT '作者名称',
  `category_id` smallint(6) unsigned NOT NULL COMMENT '分类id',
  `create_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `last_modify_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `allow_comment` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否允许评论',
  `summary` varchar(255) NOT NULL DEFAULT '' COMMENT '概要对多255字',
  `view_count` smallint(6) unsigned zerofill NOT NULL DEFAULT '000000' COMMENT '浏览量',
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  KEY `foreign_category_id` (`category_id`) USING BTREE,
  KEY `foreign_user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_article
-- ----------------------------
INSERT INTO `blog_article` VALUES ('5', 'ererer', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/11/57d551aca5bf2.jpg', '38', '0', '2016-09-11 20:45:29', '2016-09-11 20:45:29', '1', 'erererre', '000000', '1');
INSERT INTO `blog_article` VALUES ('6', 'DFDFdffd', '&lt;p&gt;这里写你的初始化内容dfffffffffffffffffffffffffffffff&lt;/p&gt;', '/uploads/cover/2016-09/11/57d55239257d8.jpg', '38', '5', '2016-09-11 20:46:50', '2016-09-11 20:46:50', '1', 'fddfdfsf', '000000', '1');
INSERT INTO `blog_article` VALUES ('7', '问斩', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/12/57d58b8d01149.png', '38', '4', '2016-09-12 00:51:28', '2016-09-12 00:51:28', '1', '速度速度速度开始', '000000', '1');
INSERT INTO `blog_article` VALUES ('17', '地方大幅度发', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/15/57d97ca2cc643.jpeg', '38', '4', '2016-09-15 00:36:52', '2016-09-15 00:36:52', '0', '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789', '000000', '1');
INSERT INTO `blog_article` VALUES ('9', '是的是的', '&lt;p&gt;这里写你的初始化撒啊啊啊啊啊啊啊啊啊啊内容&lt;/p&gt;', '/uploads/cover/2016-09/12/57d58d40b3f36.jpg', '38', '5', '2016-09-12 00:58:42', '2016-09-12 00:58:42', '0', '0123456789\r\n0123456789\r\n0123456789\r\n0123456789\r\n0123456789\r\n0123456789\r\n01234567890\r\n123456789\r\n0123456789\r\n0123456789\r\n\r\n0123456789\r\n0123456789\r\n0123456789\r\n0123456789\r\n0123456789', '000000', '0');
INSERT INTO `blog_article` VALUES ('10', '打发打发', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/12/57d58db11f2ea.jpg', '38', '0', '2016-09-12 01:03:28', '2016-09-12 01:03:28', '1', '轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去去轻轻去去去去去去去的方法反反复复', '000000', '1');
INSERT INTO `blog_article` VALUES ('18', '是的是的', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/15/57d97deb504dc.jpeg', '38', '7', '2016-09-15 00:42:21', '2016-09-15 00:42:21', '0', '三段式', '000000', '1');
INSERT INTO `blog_article` VALUES ('19', '是的是的', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/15/57d98007ee65e.jpeg', '38', '5', '2016-09-15 00:51:24', '2016-09-15 00:51:24', '0', '三段式', '000000', '1');
INSERT INTO `blog_article` VALUES ('20', '是的是的', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/15/57d98022cace5.jpeg', '38', '5', '2016-09-15 00:52:11', '2016-09-15 00:52:11', '0', '三段式', '000000', '1');
INSERT INTO `blog_article` VALUES ('21', '是的是的', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/15/57d980a962482.jpeg', '38', '5', '2016-09-15 00:54:07', '2016-09-15 00:54:07', '0', '三段式', '000000', '1');
INSERT INTO `blog_article` VALUES ('22', '是的是的', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/15/57d980e4746e2.jpeg', '38', '5', '2016-09-15 00:55:08', '2016-09-15 00:55:08', '0', '三段式', '000000', '1');
INSERT INTO `blog_article` VALUES ('12', '是的是的', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/15/57d983821a2e9.jpeg', '38', '5', '2016-09-15 01:06:26', '2016-09-15 01:06:26', '0', '三段式', '000000', '1');
INSERT INTO `blog_article` VALUES ('16', '对方的付费的', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/15/57d97c3785741.jpeg', '38', '5', '2016-09-15 00:35:15', '2016-09-15 00:35:15', '0', '打发打发', '000000', '0');
INSERT INTO `blog_article` VALUES ('23', '是的是的', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/15/57d982e404d2e.jpeg', '38', '5', '2016-09-15 01:03:36', '2016-09-15 01:03:36', '0', '三段式', '000000', '1');
INSERT INTO `blog_article` VALUES ('15', '二二二问问问问', '&lt;p&gt;这里写你的初始化内容二二&lt;/p&gt;', '/uploads/cover/2016-09/15/57d9841dde728.jpeg', '38', '5', '2016-09-15 01:08:47', '2016-09-15 01:08:47', '0', '二二', '000000', '1');
INSERT INTO `blog_article` VALUES ('24', '是的是的', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/15/57d9833fc7b17.jpeg', '38', '5', '2016-09-15 01:05:04', '2016-09-15 01:05:04', '0', '三段式', '000000', '1');
INSERT INTO `blog_article` VALUES ('25', '覆盖广泛覆盖', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/15/57da702963afc.png', '38', '7', '2016-09-15 17:56:01', '2016-09-15 17:56:01', '1', '过分过分方法反反复复反复反复', '000000', '1');
INSERT INTO `blog_article` VALUES ('26', 'qw', '&lt;p&gt;这里写你的初始化内容说到底是谁的&lt;/p&gt;', '/uploads/cover/2016-09/15/57da6ec46a23d.png', '38', '7', '2016-09-15 17:50:16', '2016-09-15 17:50:16', '0', '地方大幅度发', '000000', '1');
INSERT INTO `blog_article` VALUES ('28', 'sdsdsd34', '&lt;p&gt;这里写你的初始化内容是的是的是的&lt;/p&gt;', '/uploads/cover/2016-09/15/57da6b9e2b9e9.jpg', '38', '6', '2016-09-15 17:36:39', '2016-09-15 17:36:39', '0', '发的顶顶顶顶顶的顶顶顶顶顶', '000000', '1');
INSERT INTO `blog_article` VALUES ('29', '是顶顶顶顶顶大大大', '&lt;p&gt;这里写你的初始化内容&lt;/p&gt;', '/uploads/cover/2016-09/15/57da8be293fcd.jpeg', '38', '4', '2016-09-15 19:54:17', '2016-09-15 19:54:17', '1', '当时都是实打实的', '000000', '1');
INSERT INTO `blog_article` VALUES ('30', 'ewew', '&lt;p&gt;ewewweew&lt;/p&gt;', '', '38', '7', '2016-09-16 01:25:18', '2016-09-16 01:25:18', '1', 'ewewew', '000000', '1');

-- ----------------------------
-- Table structure for blog_article_attribute
-- ----------------------------
DROP TABLE IF EXISTS `blog_article_attribute`;
CREATE TABLE `blog_article_attribute` (
  `article_id` smallint(6) NOT NULL COMMENT '关联表article',
  `attribute_id` smallint(6) NOT NULL COMMENT '关联attribute',
  KEY `foreign_article_id` (`article_id`),
  KEY `foreign_attribute_id` (`attribute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_article_attribute
-- ----------------------------
INSERT INTO `blog_article_attribute` VALUES ('26', '1');
INSERT INTO `blog_article_attribute` VALUES ('26', '2');
INSERT INTO `blog_article_attribute` VALUES ('26', '3');
INSERT INTO `blog_article_attribute` VALUES ('29', '1');
INSERT INTO `blog_article_attribute` VALUES ('28', '1');
INSERT INTO `blog_article_attribute` VALUES ('30', '1');

-- ----------------------------
-- Table structure for blog_attribute
-- ----------------------------
DROP TABLE IF EXISTS `blog_attribute`;
CREATE TABLE `blog_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性id',
  `name` char(10) NOT NULL DEFAULT '' COMMENT '属性名',
  `value` char(10) NOT NULL DEFAULT '' COMMENT '属性的值默认为英文名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_attribute
-- ----------------------------
INSERT INTO `blog_attribute` VALUES ('1', '热门', 'Toyota Hot');
INSERT INTO `blog_attribute` VALUES ('2', '推荐', 'recommend');
INSERT INTO `blog_attribute` VALUES ('3', '精华', 'essence');

-- ----------------------------
-- Table structure for blog_category
-- ----------------------------
DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `name` char(20) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(10) unsigned NOT NULL COMMENT '无符号',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_category
-- ----------------------------
INSERT INTO `blog_category` VALUES ('1', 'Home', '0', '50');
INSERT INTO `blog_category` VALUES ('2', 'php', '0', '50');
INSERT INTO `blog_category` VALUES ('3', 'Java', '0', '50');
INSERT INTO `blog_category` VALUES ('4', 'phpchild', '2', '50');
INSERT INTO `blog_category` VALUES ('5', 'phpchild2', '2', '100');
INSERT INTO `blog_category` VALUES ('6', 'jvavachid', '3', '100');
INSERT INTO `blog_category` VALUES ('7', 'javachild', '3', '100');
INSERT INTO `blog_category` VALUES ('8', '康林', '0', '50');
INSERT INTO `blog_category` VALUES ('9', 'c++', '0', '100');
INSERT INTO `blog_category` VALUES ('10', '地方大幅度发', '0', '50');
INSERT INTO `blog_category` VALUES ('15', '验证121212', '0', '50');

-- ----------------------------
-- Table structure for blog_comment
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论表id',
  `author` varchar(20) NOT NULL DEFAULT '' COMMENT '评论人名称',
  `email` varchar(64) NOT NULL DEFAULT '' COMMENT '评论人邮箱地址',
  `content` text NOT NULL,
  `pid` smallint(6) unsigned NOT NULL COMMENT '父id',
  `time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `article_id` int(11) NOT NULL COMMENT '文章id外建',
  PRIMARY KEY (`id`),
  KEY `foreign_article_id` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_comment
-- ----------------------------

-- ----------------------------
-- Table structure for blog_draft
-- ----------------------------
DROP TABLE IF EXISTS `blog_draft`;
CREATE TABLE `blog_draft` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '草稿id',
  `title` varchar(90) NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` text NOT NULL COMMENT '序列化内容',
  `last_save_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '最后保存的时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_draft
-- ----------------------------
INSERT INTO `blog_draft` VALUES ('1', '方法法国风格风格', '{&quot;title&quot;:&quot;方法法国风格风格&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;/uploads/temp/57da8a8ebbc19.png&quot;,&quot;tag&quot;:&quot;&quot;}', '2016-09-15 19:09:32');
INSERT INTO `blog_draft` VALUES ('2', '二二二二二二', '{&quot;title&quot;:&quot;二二二二二二&quot;,&quot;summary&quot;:&quot;二二二&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/11/57d54ff0d4b94.jpg&quot;,&quot;tag&quot;:&quot;fddfdf|地方大幅度|对方的付费的打发打发&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容sdsdsdddddddddddddddddd&lt;/p&gt;&quot;}', '2016-09-14 19:09:08');
INSERT INTO `blog_draft` VALUES ('6', '问斩', '{&quot;title&quot;:&quot;问斩&quot;,&quot;summary&quot;:&quot;速度速度速度开始&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58b8d01149.png&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 18:09:50');
INSERT INTO `blog_draft` VALUES ('3', 'fggfgf', '{&quot;title&quot;:&quot;fggfgf&quot;,&quot;summary&quot;:&quot;gfgfgfgfgfdfdfdfdf&quot;,&quot;category&quot;:&quot;5&quot;,&quot;cover&quot;:&quot;/uploads/temp/57d804b325a56.png&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-13 21:09:12');
INSERT INTO `blog_draft` VALUES ('4', '', '{&quot;title&quot;:&quot;&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-13 21:09:47');
INSERT INTO `blog_draft` VALUES ('5', 'sdsddsds', '{&quot;title&quot;:&quot;sdsddsds&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-13 21:09:45');
INSERT INTO `blog_draft` VALUES ('7', 'DFDFdffd', '{&quot;title&quot;:&quot;DFDFdffd&quot;,&quot;summary&quot;:&quot;fddfdfsf&quot;,&quot;category&quot;:&quot;5&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/11/57d55239257d8.jpg&quot;,&quot;tag&quot;:&quot;dfdfdf、发的辅导费&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容dfffffffffffffffffffffffffffffff&lt;/p&gt;&quot;}', '2016-09-14 18:09:56');
INSERT INTO `blog_draft` VALUES ('8', 'DFDFdffd', '{&quot;title&quot;:&quot;DFDFdffd&quot;,&quot;summary&quot;:&quot;fddfdfsf&quot;,&quot;category&quot;:&quot;5&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/11/57d55239257d8.jpg&quot;,&quot;tag&quot;:&quot;dfdfdf、发的辅导费&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容dfffffffffffffffffffffffffffffff&lt;/p&gt;&quot;}', '2016-09-14 18:09:16');
INSERT INTO `blog_draft` VALUES ('9', 'DFDFdffd', '{&quot;title&quot;:&quot;DFDFdffd&quot;,&quot;summary&quot;:&quot;fddfdfsf&quot;,&quot;category&quot;:&quot;5&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/11/57d55239257d8.jpg&quot;,&quot;tag&quot;:&quot;dfdfdf&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容dfffffffffffffffffffffffffffffff&lt;/p&gt;&quot;}', '2016-09-14 18:09:48');
INSERT INTO `blog_draft` VALUES ('11', '问斩', '{&quot;title&quot;:&quot;问斩&quot;,&quot;summary&quot;:&quot;速度速度速度开始&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58b8d01149.png&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 18:09:11');
INSERT INTO `blog_draft` VALUES ('12', '问斩', '{&quot;title&quot;:&quot;问斩&quot;,&quot;summary&quot;:&quot;速度速度速度开始&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58b8d01149.png&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 18:09:13');
INSERT INTO `blog_draft` VALUES ('13', '问斩', '{&quot;title&quot;:&quot;问斩&quot;,&quot;summary&quot;:&quot;速度速度速度开始&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58b8d01149.png&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 18:09:17');
INSERT INTO `blog_draft` VALUES ('14', '问斩', '{&quot;title&quot;:&quot;问斩&quot;,&quot;summary&quot;:&quot;速度速度速度开始&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58b8d01149.png&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 18:09:31');
INSERT INTO `blog_draft` VALUES ('15', '问斩', '{&quot;title&quot;:&quot;问斩&quot;,&quot;summary&quot;:&quot;速度速度速度开始&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58b8d01149.png&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 18:09:58');
INSERT INTO `blog_draft` VALUES ('16', '问斩', '{&quot;title&quot;:&quot;问斩&quot;,&quot;summary&quot;:&quot;速度速度速度开始&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58b8d01149.png&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 18:09:05');
INSERT INTO `blog_draft` VALUES ('17', '问斩更丰富反复反复反复反反复复', '{&quot;title&quot;:&quot;问斩更丰富反复反复反复反反复复&quot;,&quot;summary&quot;:&quot;速度速度速度开始&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58b8d01149.png&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 18:09:48');
INSERT INTO `blog_draft` VALUES ('18', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:53');
INSERT INTO `blog_draft` VALUES ('19', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:05');
INSERT INTO `blog_draft` VALUES ('20', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:34');
INSERT INTO `blog_draft` VALUES ('21', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:38');
INSERT INTO `blog_draft` VALUES ('22', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:54');
INSERT INTO `blog_draft` VALUES ('23', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:57');
INSERT INTO `blog_draft` VALUES ('24', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:14');
INSERT INTO `blog_draft` VALUES ('25', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:06');
INSERT INTO `blog_draft` VALUES ('26', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:34');
INSERT INTO `blog_draft` VALUES ('27', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:39');
INSERT INTO `blog_draft` VALUES ('28', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:06');
INSERT INTO `blog_draft` VALUES ('29', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:10');
INSERT INTO `blog_draft` VALUES ('30', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:39');
INSERT INTO `blog_draft` VALUES ('31', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:49');
INSERT INTO `blog_draft` VALUES ('32', '地方大幅度发', '{&quot;title&quot;:&quot;地方大幅度发&quot;,&quot;summary&quot;:&quot;0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789&quot;,&quot;category&quot;:&quot;4&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58bfe5dab5.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:11');
INSERT INTO `blog_draft` VALUES ('33', '从vVC', '{&quot;title&quot;:&quot;从vVC&quot;,&quot;summary&quot;:&quot;请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱请钱钱钱钱钱钱钱钱钱&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/12/57d58ef29080e.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:05');
INSERT INTO `blog_draft` VALUES ('34', ' 活该该好好干', '{&quot;title&quot;:&quot; 活该该好好干&quot;,&quot;summary&quot;:&quot;规划好哥哥好&quot;,&quot;category&quot;:&quot;5&quot;,&quot;cover&quot;:&quot;/uploads/picture/2016-09/13/57d7b7072832e.jpg&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-14 19:09:17');
INSERT INTO `blog_draft` VALUES ('35', 'sdsdsd34', '{&quot;title&quot;:&quot;sdsdsd34&quot;,&quot;summary&quot;:&quot;发的顶顶顶顶顶的顶顶顶顶顶&quot;,&quot;cover&quot;:&quot;/uploads/cover/2016-09/15/57da6b9e2b9e9.jpg&quot;,&quot;category&quot;:&quot;6&quot;,&quot;attribute[]&quot;:&quot;1&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容是的是的是的hgghghghgh&lt;/p&gt;&quot;}', '2016-09-15 17:09:39');
INSERT INTO `blog_draft` VALUES ('36', '12222222', '{&quot;title&quot;:&quot;12222222&quot;,&quot;summary&quot;:&quot;地方大幅度发&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:&quot;3&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 19:09:54');
INSERT INTO `blog_draft` VALUES ('37', '', '{&quot;title&quot;:&quot;&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:[[&quot;1&quot;,&quot;2&quot;],&quot;3&quot;],&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 20:09:43');
INSERT INTO `blog_draft` VALUES ('38', '是的是的是的是的', '{&quot;title&quot;:&quot;是的是的是的是的&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:[[&quot;1&quot;,&quot;2&quot;],&quot;3&quot;],&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 20:09:51');
INSERT INTO `blog_draft` VALUES ('39', '是的是的是的是的', '{&quot;title&quot;:&quot;是的是的是的是的&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:[[&quot;1&quot;,&quot;2&quot;],&quot;3&quot;],&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 20:09:54');
INSERT INTO `blog_draft` VALUES ('40', '', '{&quot;title&quot;:&quot;&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:[&quot;1&quot;,&quot;2&quot;,&quot;3&quot;],&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 20:09:39');
INSERT INTO `blog_draft` VALUES ('41', '', '{&quot;title&quot;:&quot;&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:&quot;2&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 21:09:58');
INSERT INTO `blog_draft` VALUES ('42', '', '{&quot;title&quot;:&quot;&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:&quot;2&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 21:09:00');
INSERT INTO `blog_draft` VALUES ('43', '发过个非官方', '{&quot;title&quot;:&quot;发过个非官方&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:&quot;2&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 21:09:06');
INSERT INTO `blog_draft` VALUES ('44', '发过个非官方', '{&quot;title&quot;:&quot;发过个非官方&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:&quot;2&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 21:09:08');
INSERT INTO `blog_draft` VALUES ('45', 'ewew', '{&quot;title&quot;:&quot;ewew&quot;,&quot;summary&quot;:&quot;ewewew&quot;,&quot;cover&quot;:&quot;/uploads/temp/57dacd4e5d3bd.jpeg&quot;,&quot;attribute&quot;:[&quot;1&quot;,&quot;1&quot;],&quot;tag&quot;:&quot;ewew&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;ewewweew&lt;/p&gt;&quot;}', '2016-09-16 00:09:47');
INSERT INTO `blog_draft` VALUES ('46', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:[&quot;1&quot;,&quot;2&quot;,&quot;3&quot;],&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 21:09:36');
INSERT INTO `blog_draft` VALUES ('47', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:[&quot;1&quot;,&quot;2&quot;,&quot;3&quot;],&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 21:09:44');
INSERT INTO `blog_draft` VALUES ('48', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:[&quot;2&quot;,&quot;3&quot;],&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 21:09:15');
INSERT INTO `blog_draft` VALUES ('49', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:[&quot;2&quot;,&quot;3&quot;],&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 21:09:49');
INSERT INTO `blog_draft` VALUES ('50', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;attribute[]&quot;:&quot;3&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 23:09:17');
INSERT INTO `blog_draft` VALUES ('51', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 23:09:28');
INSERT INTO `blog_draft` VALUES ('52', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 23:09:32');
INSERT INTO `blog_draft` VALUES ('53', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 23:09:07');
INSERT INTO `blog_draft` VALUES ('54', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 23:09:15');
INSERT INTO `blog_draft` VALUES ('55', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 23:09:44');
INSERT INTO `blog_draft` VALUES ('56', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 23:09:47');
INSERT INTO `blog_draft` VALUES ('57', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 23:09:56');
INSERT INTO `blog_draft` VALUES ('58', '是的是的122222222', '{&quot;title&quot;:&quot;是的是的122222222&quot;,&quot;summary&quot;:&quot;&quot;,&quot;cover&quot;:&quot;&quot;,&quot;tag&quot;:&quot;&quot;,&quot;visible&quot;:&quot;1&quot;,&quot;allowComment&quot;:&quot;1&quot;,&quot;content&quot;:&quot;&lt;p&gt;这里写你的初始化内容&lt;/p&gt;&quot;}', '2016-09-15 23:09:59');

-- ----------------------------
-- Table structure for blog_node
-- ----------------------------
DROP TABLE IF EXISTS `blog_node`;
CREATE TABLE `blog_node` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '节点ID',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '节点名称（英文名，对应应用控制器、应用、方法名）',
  `title` varchar(45) NOT NULL DEFAULT '' COMMENT '节点中文名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '启用状态',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注信息',
  `sort` smallint(6) NOT NULL DEFAULT '50' COMMENT '排序值（默认值为50）',
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父节点ID（如:方法pid对应相应的控制器）',
  `level` tinyint(1) NOT NULL COMMENT '节点类型：1:表示应用（模块）；2:表示控制器；3：表示方法',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='节点表';

-- ----------------------------
-- Records of blog_node
-- ----------------------------
INSERT INTO `blog_node` VALUES ('7', 'Home', '前台应用', '1', '', '1', '0', '1');
INSERT INTO `blog_node` VALUES ('13', 'Index', '首页控制器', '1', '', '1', '7', '2');
INSERT INTO `blog_node` VALUES ('14', 'testBlog', '测试', '1', '', '1', '13', '3');
INSERT INTO `blog_node` VALUES ('22', 'Admin', '后台应用', '1', '', '1', '0', '1');
INSERT INTO `blog_node` VALUES ('23', 'Rbac', 'Rbac管理', '1', '', '1', '22', '2');
INSERT INTO `blog_node` VALUES ('24', 'index', '用户列表', '1', '', '1', '23', '3');
INSERT INTO `blog_node` VALUES ('25', 'addUser', '添加用户', '1', '', '1', '23', '3');
INSERT INTO `blog_node` VALUES ('26', 'editUser', '编辑用户', '1', '', '1', '23', '3');
INSERT INTO `blog_node` VALUES ('27', 'removeUser', '删除用户', '1', '', '1', '23', '3');
INSERT INTO `blog_node` VALUES ('28', 'nodeList', '节点列表', '1', '', '1', '23', '3');
INSERT INTO `blog_node` VALUES ('29', 'addNode', '添加节点', '1', '', '1', '23', '3');
INSERT INTO `blog_node` VALUES ('31', 'removeNode', '删除节点', '1', '', '1', '23', '3');
INSERT INTO `blog_node` VALUES ('32', 'editNode', '编辑节点', '1', '', '1', '23', '3');
INSERT INTO `blog_node` VALUES ('33', 'roleList', '角色列表', '1', '', '1', '23', '3');
INSERT INTO `blog_node` VALUES ('34', 'editRole', '编辑角色', '1', '', '1', '23', '3');
INSERT INTO `blog_node` VALUES ('35', 'removeRole', '删除角色', '1', '', '1', '23', '3');
INSERT INTO `blog_node` VALUES ('36', 'addRole', '添加角色', '1', '', '1', '23', '3');
INSERT INTO `blog_node` VALUES ('37', 'Index', '后台首页', '1', '', '1', '22', '2');
INSERT INTO `blog_node` VALUES ('38', 'index', '首页', '1', '', '1', '37', '3');
INSERT INTO `blog_node` VALUES ('39', 'Album', '相册管理', '1', '', '1', '22', '2');
INSERT INTO `blog_node` VALUES ('40', 'index', '相册列表', '1', '', '1', '39', '3');
INSERT INTO `blog_node` VALUES ('41', 'addAlbum', '添加相册', '1', '', '1', '39', '3');
INSERT INTO `blog_node` VALUES ('42', 'uploadCover', '上传封面', '1', '', '1', '39', '3');
INSERT INTO `blog_node` VALUES ('43', 'editAlbum', '编辑相册', '1', '', '1', '39', '3');
INSERT INTO `blog_node` VALUES ('44', 'pictureList', '照片列表', '1', '', '1', '39', '3');
INSERT INTO `blog_node` VALUES ('45', 'addPicture', '添加照片', '1', '', '1', '39', '3');
INSERT INTO `blog_node` VALUES ('46', 'removeAlbum', '删除相册', '1', '', '1', '39', '3');

-- ----------------------------
-- Table structure for blog_picture
-- ----------------------------
DROP TABLE IF EXISTS `blog_picture`;
CREATE TABLE `blog_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '图片id',
  `picture` varchar(120) NOT NULL DEFAULT '' COMMENT '相册路径',
  `thumb` varchar(120) NOT NULL DEFAULT '' COMMENT '缩略图',
  `a_id` int(11) DEFAULT NULL COMMENT '外键关联album表',
  PRIMARY KEY (`id`),
  KEY `foreign_a_id` (`a_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_picture
-- ----------------------------
INSERT INTO `blog_picture` VALUES ('7', '/uploads/picture/2016-09/08/57d1832c6a37c.jpg', '/uploads/picture/2016-09/08/thumb-57d1832c6a37c.jpg', '5');
INSERT INTO `blog_picture` VALUES ('8', '/uploads/picture/2016-09/08/57d1832d1e2be.jpg', '/uploads/picture/2016-09/08/thumb-57d1832d1e2be.jpg', '5');
INSERT INTO `blog_picture` VALUES ('9', '/uploads/picture/2016-09/08/57d1832d78eb6.jpg', '/uploads/picture/2016-09/08/thumb-57d1832d78eb6.jpg', '5');
INSERT INTO `blog_picture` VALUES ('10', '/uploads/picture/2016-09/08/57d1832dedf86.jpg', '/uploads/picture/2016-09/08/thumb-57d1832dedf86.jpg', '5');
INSERT INTO `blog_picture` VALUES ('11', '/uploads/picture/2016-09/08/57d1832e308d4.jpg', '/uploads/picture/2016-09/08/thumb-57d1832e308d4.jpg', '5');
INSERT INTO `blog_picture` VALUES ('13', '/uploads/picture/2016-09/08/57d1832eba463.jpg', '/uploads/picture/2016-09/08/thumb-57d1832eba463.jpg', '5');
INSERT INTO `blog_picture` VALUES ('14', '/uploads/picture/2016-09/08/57d1832edb8b8.png', '/uploads/picture/2016-09/08/thumb-57d1832edb8b8.png', '5');
INSERT INTO `blog_picture` VALUES ('20', '/uploads/picture/2016-09/09/57d2d84ab927f.jpg', '/uploads/picture/2016-09/09/thumb-57d2d84ab927f.jpg', '5');

-- ----------------------------
-- Table structure for blog_role
-- ----------------------------
DROP TABLE IF EXISTS `blog_role`;
CREATE TABLE `blog_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '角色名称',
  `pid` tinyint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父角色对应ID',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '启用状态：0:表示禁用；1:表示启用',
  `remark` varchar(45) NOT NULL DEFAULT '' COMMENT '备注信息',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of blog_role
-- ----------------------------
INSERT INTO `blog_role` VALUES ('7', 'Admin', '0', '1', '权限最高');
INSERT INTO `blog_role` VALUES ('8', '验证', '0', '0', '权限最高2');
INSERT INTO `blog_role` VALUES ('11', 'test1212111', '0', '1', '权限最高21');
INSERT INTO `blog_role` VALUES ('14', 'Home', '0', '1', '344545454');
INSERT INTO `blog_role` VALUES ('16', 'superAdmin', '0', '1', '超级管理员');

-- ----------------------------
-- Table structure for blog_role_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_role_user`;
CREATE TABLE `blog_role_user` (
  `user_id` int(10) unsigned NOT NULL COMMENT '关联用户id',
  `role_id` smallint(6) unsigned NOT NULL COMMENT '关联角色id',
  KEY `user_id` (`user_id`),
  KEY `group_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户角色关联表';

-- ----------------------------
-- Records of blog_role_user
-- ----------------------------
INSERT INTO `blog_role_user` VALUES ('33', '7');
INSERT INTO `blog_role_user` VALUES ('33', '8');
INSERT INTO `blog_role_user` VALUES ('33', '11');
INSERT INTO `blog_role_user` VALUES ('36', '7');
INSERT INTO `blog_role_user` VALUES ('36', '8');
INSERT INTO `blog_role_user` VALUES ('36', '11');
INSERT INTO `blog_role_user` VALUES ('32', '7');
INSERT INTO `blog_role_user` VALUES ('32', '8');
INSERT INTO `blog_role_user` VALUES ('37', '7');
INSERT INTO `blog_role_user` VALUES ('37', '8');
INSERT INTO `blog_role_user` VALUES ('1', '16');
INSERT INTO `blog_role_user` VALUES ('38', '0');

-- ----------------------------
-- Table structure for blog_tag
-- ----------------------------
DROP TABLE IF EXISTS `blog_tag`;
CREATE TABLE `blog_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '标签名',
  `article_id` int(10) unsigned NOT NULL COMMENT '文章外建',
  PRIMARY KEY (`id`),
  KEY `foreign_article_id` (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=175 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_tag
-- ----------------------------
INSERT INTO `blog_tag` VALUES ('10', 'ewwwwww', '5');
INSERT INTO `blog_tag` VALUES ('11', '打发打发', '5');
INSERT INTO `blog_tag` VALUES ('12', '是的是的', '5');
INSERT INTO `blog_tag` VALUES ('13', 'dfdfdf', '6');
INSERT INTO `blog_tag` VALUES ('14', '1221', '15');
INSERT INTO `blog_tag` VALUES ('15', 'fddf', '15');
INSERT INTO `blog_tag` VALUES ('16', 'dfdfdf', '15');
INSERT INTO `blog_tag` VALUES ('17', '是的是的', '25');

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID（唯一识别号）',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `create_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '创建账户时间',
  `login_time` timestamp NOT NULL COMMENT '最近一次登录时间（时间戳）',
  `create_ip` varchar(15) NOT NULL COMMENT '最近登录的IP地址',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '启用状态：0:表示禁用；1:表示启用',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注信息',
  `salt` tinyint(1) DEFAULT '0' COMMENT '盐值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of blog_user
-- ----------------------------
INSERT INTO `blog_user` VALUES ('1', 'root', 'e10adc3949ba59abbe56e057f20f883e', '601168226@qq.com', '2016-09-02 16:47:41', '2016-08-27 23:14:26', '', '1', '拥有全部权限', '0');
INSERT INTO `blog_user` VALUES ('2', 'root2', 'e10adc3949ba59abbe56e057f20f883e', '601168226@qq.com2', '2016-08-28 15:18:41', '2016-08-27 23:14:26', '', '1', '', '0');
INSERT INTO `blog_user` VALUES ('3', 'root3', 'e10adc3949ba59abbe56e057f20f883e', '601168226@qq.com3', '2016-08-28 15:18:41', '2016-08-27 23:14:26', '', '1', '', '0');
INSERT INTO `blog_user` VALUES ('8', 'root8', 'e10adc3949ba59abbe56e057f20f883e', '601168226@qq.com8', '2016-08-28 15:18:41', '2016-08-27 23:14:26', '', '1', '', '0');
INSERT INTO `blog_user` VALUES ('9', 'root9', 'e10adc3949ba59abbe56e057f20f883e', '601168226@qq.com9', '2016-08-28 15:18:41', '2016-08-27 23:14:26', '', '1', '', '0');
INSERT INTO `blog_user` VALUES ('10', 'root10', 'e10adc3949ba59abbe56e057f20f883e', '601168226@qq.com10', '2016-08-28 15:18:41', '2016-08-27 23:14:26', '', '1', '', '0');
INSERT INTO `blog_user` VALUES ('11', 'root11', 'e10adc3949ba59abbe56e057f20f883e', '601168226@qq.com11', '2016-08-28 15:18:41', '2016-08-27 23:14:26', '', '1', '', '0');
INSERT INTO `blog_user` VALUES ('32', 'kuangxiumei123', 'e10adc3949ba59abbe56e057f20f883e', '12222@qq.com', '2016-09-02 00:02:53', '2016-09-01 16:41:12', '::1', '1', '', '0');
INSERT INTO `blog_user` VALUES ('33', 'kuangxiumei1231111', '123456', '123456@qq.com', '2016-09-01 17:22:56', '2016-09-01 17:22:56', '::1', '0', '', '0');
INSERT INTO `blog_user` VALUES ('36', 'CHENYANH', '123456', '1011119652206@qq.com', '2016-09-01 20:30:21', '2016-09-01 20:30:21', '::1', '0', '1011119652206@qq.com', '0');
INSERT INTO `blog_user` VALUES ('37', 'kuangxiumei123112', 'e10adc3949ba59abbe56e057f20f883e', '1221@qq.com', '2016-09-02 00:07:34', '2016-09-02 00:07:34', '::1', '1', '权限最高211', '0');
INSERT INTO `blog_user` VALUES ('38', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin@kanglin.me', '2016-09-02 17:21:54', '2016-09-02 17:21:54', '::1', '1', '超级管理员', '0');
SET FOREIGN_KEY_CHECKS=1;
